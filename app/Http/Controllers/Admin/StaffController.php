<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\AreaMaster;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use App\Models\BusinessCategory;
use App\Models\Designation;
use App\Models\Department;
use App\Models\OfficeTeam;
use App\Models\UserManagement;

class StaffController extends Controller
{

    /* -------------------- Vice Presidents -------------------- */

    public function showVps()
    {
        $adminId = Auth::user()->id;
        
        // Get only coordinators under this admin (unassigned or assigned to VPs under this admin)
        $users = User::where('user_type', 'Sales Coordinator')
            ->where('parent_id', $adminId)
            ->get();
        
        // Get VPs created by this admin only
        $vicePresidents = User::where('user_type', 'Vice President')
            ->where('parent_id', $adminId)
            ->get();
        
        return view('admin.vp', compact('users', 'vicePresidents'));
    }

    public function addVp(Request $request)
    {
        $validator = validator($request->all(), [
            'name' => 'required',
            'email' => 'required|email',
            'password' => 'required',
            'phone' => 'required',
            'is_active' => 'required',
            'usr_role' => 'required'
        ]);
        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput();
        }
        if ($request->id) {
            $user = User::findOrFail($request->id);
            $user->update([
                'name' => $request->name,
                'email' => $request->email,
                'password' => $request->password,
                'phone' => $request->phone,
                'is_active' => $request->is_active,
                'user_type' => $request->usr_role
            ]);
            
            // Handle coordinator reassignment during VP edit
            // First, unassign all coordinators currently assigned to this VP (set back to admin)
            DB::statement('UPDATE users SET parent_id = ? WHERE parent_id = ? AND user_type = "Sales Coordinator"', [$user->parent_id, $user->id]);
            
            // Then assign selected coordinators to this VP
            if ($request->coordinators) {
                User::whereIn('id', $request->coordinators)->update(['parent_id' => $user->id]);
            }
            
            return back()->with('success', 'VP updated successfully');
        }
        if (User::where('phone', $request->phone)->exists()) {
            return back()->with('error', 'VP with this phone number already exists.');
        }
        $vp = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => $request->password,
            'phone' => $request->phone,
            'parent_id' => Auth::id(),
            'is_active' => $request->is_active,
            'user_type' => $request->usr_role
        ]);

        // Assign selected coordinators to this VP
        if ($request->coordinators) {
            User::whereIn('id', $request->coordinators)->update(['parent_id' => $vp->id]);
        }

        return back()->with('success', 'VP Added Successfully');
    }

    public function getVpCoordinators($vpId)
    {
        $vp = User::findOrFail($vpId);
        $adminId = $vp->parent_id;
        
        // Get currently assigned coordinators to this VP
        $assignedIds = User::where('parent_id', $vpId)
            ->where('user_type', 'Sales Coordinator')
            ->pluck('id')
            ->toArray();
        
        // Get unassigned coordinators under the same admin
        $unassignedCoordinators = User::where('user_type', 'Sales Coordinator')
            ->where('parent_id', $adminId)
            ->select('id', 'name')
            ->get()
            ->toArray();
        
        // Get currently assigned coordinators with their details (for display with context)
        $currentAssignedCoordinators = User::whereIn('id', $assignedIds)
            ->where('user_type', 'Sales Coordinator')
            ->select('id', 'name')
            ->get()
            ->toArray();
        
        // Merge: available (unassigned) + currently assigned
        $availableCoordinators = array_merge($unassignedCoordinators, $currentAssignedCoordinators);
        // Remove duplicates
        $seen = [];
        $availableCoordinators = array_filter($availableCoordinators, function($item) use (&$seen) {
            if (in_array($item['id'], $seen)) {
                return false;
            }
            $seen[] = $item['id'];
            return true;
        });
        
        return response()->json([
            'assigned' => $assignedIds,
            'available' => array_values($availableCoordinators)  // Re-index array
        ]);
    }

    /* -------------------- Coordinators -------------------- */

    public function showCoordinators()
    {
        $adminId = Auth::user()->id;

        // Get all VPs under this admin
        $vpIds = User::where('user_type', 'Vice President')
            ->where('parent_id', $adminId)
            ->where('is_active', 1)
            ->pluck('id')
            ->toArray();

        // Get coordinators assigned to these VPs
        $coordinates = User::where('user_type', 'Sales Coordinator')
            ->whereIn('parent_id', $vpIds)
            ->with('parent')
            ->get();
        
        // Get all business category IDs that are already assigned to ANY coordinator
        $assignedCategoryIds = [];
        foreach ($coordinates as $coordinator) {
            if ($coordinator->business_category) {
                $categoryIds = array_filter(array_map('trim', explode(',', $coordinator->business_category)));
                $assignedCategoryIds = array_merge($assignedCategoryIds, $categoryIds);
            }
        }
        
        // Get all categories (for reference in case of editing)
        $allCategories = BusinessCategory::all()->keyBy('id');
        
        // Get only unassigned business categories for the dropdown
        $businessCategories = BusinessCategory::whereNotIn('id', array_unique($assignedCategoryIds))->get();
        
        // Get unassigned coordinators (those under this admin, not assigned to any VP)
        $unassignedCoordinators = User::where('user_type', 'Sales Coordinator')
            ->where('parent_id', $adminId)
            ->where('is_active', 1)
            ->get();
        
        // Get VPs from same admin (coordinators can only be assigned to VPs under same admin)
        $vicePresidents = User::where('user_type', 'Vice President')
            ->where('parent_id', $adminId)
            ->where('is_active', 1)
            ->get();
        
        return view('admin.coordinator', compact('businessCategories', 'coordinates', 'allCategories', 'unassignedCoordinators', 'vicePresidents'));
    }

    public function addCoordinator(Request $request)
    {
        $rules = [
            'name' => 'required',
            'email' => 'required|email',
            'password' => 'required',
            'business_category' => 'required',
            'usr_active' => 'required',
            'usr_role' => 'required'
        ];

        // parent_id is optional for new coordinators (will default to admin)
        // For editing, parent_id cannot be changed if already assigned

        $validator = validator($request->all(), $rules);

        if ($validator->fails()) {
            return back()->withErrors($validator)->withInput();
        }

        if ($request->id) {
            $user = User::findOrFail($request->id);

            // Only allow editing if coordinator is already assigned (already has parent_id)
            if (!$user->parent_id) {
                return back()->with('error', 'Cannot edit coordinator. Please assign to a VP first.');
            }

            $user->update([
                'name' => $request->name,
                'email' => $request->email,
                'password' => $request->password,
                'phone' => $request->mobile,
                // parent_id is locked - cannot be changed once assigned
                'business_category' => implode(',', $request->business_category ?? []),
                'is_active' => $request->usr_active,
                'user_type' => $request->usr_role
            ]);

            return back()->with('success', 'Coordinator updated successfully');
        }

        if (User::where('email', $request->email)->exists()) {
            return back()->with('error', 'Coordinator with this email already exists.');
        }

        // Verify selected VP belongs to same admin (if provided)
        if ($request->parent_id) {
            $vp = User::findOrFail($request->parent_id);
            $adminIds = explode(',', Auth::user()->parent_id ?? '');
            $adminIds[] = Auth::user()->id;
            
            if (!in_array($vp->parent_id, $adminIds) && $vp->parent_id != Auth::id()) {
                return back()->with('error', 'Selected VP does not belong to your admin hierarchy.');
            }
        }

        User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => $request->password,
            'phone' => $request->mobile,
            'parent_id' => $request->parent_id ?: Auth::id(),  // Assign to selected VP or admin if not specified
            'business_category' => implode(',', $request->business_category),
            'is_active' => $request->usr_active,
            'user_type' => $request->usr_role
        ]);

        return back()->with('success', 'Coordinator Added Successfully');
    }

    /* -------------------- Sales Managers / Executives -------------------- */

    public function showSalesManager()
    {

        $salesManagers = DB::table('users as a')
            ->join('designation as b', 'a.designation', '=', 'b.id')
            ->select('a.*', 'b.name as designation_name', 'a.designation as designation')
            ->whereIn('a.user_type', ['Sales manager', 'Sales executive'])
            ->get();

        $designations = Designation::all();

        return view('admin.sale-manager-executive', compact('salesManagers', 'designations'));
    }

    public function addSalesManager(Request $request)
    {

        $validator = validator($request->all(), [
            'name' => 'required',
            'email' => 'required|email',
            'phone' => 'required',
            'usr_role' => 'required',
            'designation' => 'required',
            'is_active' => 'required',
            'password' => 'required'
        ]);

        if ($validator->fails()) {
            return back()->withErrors($validator)->withInput();
        }

        $data = [
            'name' => $request->name,
            'email' => $request->email,
            'phone' => $request->phone,
            'designation' => $request->designation,
            'user_type' => $request->usr_role,
            'is_active' => $request->is_active,
            'password' => $request->password
        ];

        if ($request->id) {

            User::findOrFail($request->id)->update($data);
        } else {

            User::create($data);
        }

        return back()->with('success', 'Sales manager/Executive saved successfully');
    }

    /* -------------------- Designations -------------------- */

    public function showDesignations()
    {
        $designations = Designation::all();
        return view('admin.designation', compact('designations'));
    }

    public function addDesignation(Request $request)
    {

        $validator = validator($request->all(), [
            'name' => 'required'
        ]);

        if ($validator->fails()) {
            return back()->withErrors($validator)->withInput();
        }

        Designation::updateOrCreate(
            ['id' => $request->id],
            ['name' => $request->name]
        );

        return back()->with('success', 'Designation saved successfully');
    }

    /* -------------------- Office Teams -------------------- */

    public function showOfficeTeams()
    {

        $teams = DB::table('office_team as a')
            ->join('department as b', 'a.department', '=', 'b.id')
            ->select('a.*', 'b.title as department', 'b.id as dep_id')
            ->get();

        $departments = Department::where('active', 1)->get();

        return view('admin.officeTeams', compact('teams', 'departments'));
    }

    public function addOfficeTeams(Request $request)
    {

        $validator = validator($request->all(), [
            'name' => 'required',
            'mobile' => 'required',
            'department' => 'required',
            'active' => 'required'
        ]);

        if ($validator->fails()) {
            return back()->withErrors($validator)->withInput();
        }

        OfficeTeam::updateOrCreate(
            ['id' => $request->id],
            [
                'name' => $request->name,
                'mobile' => $request->mobile,
                'department' => $request->department,
                'active' => $request->active
            ]
        );

        return back()->with('success', 'Department saved successfully');
    }
    /* Comment : View Sales Manager and Sales Executive Details */
    public function viewSalesManagerDetails($id)
    {
        // Fetch the main user to get the role (user_type)
        $mainUser = User::find($id);
        // Fetch all user management entries for this user
        $userMgmts = UserManagement::where('user_id', $id)->get();

        // Collect all coordinator and manager IDs
        $userIds = $userMgmts->pluck('coordinator_id')
                    ->merge($userMgmts->pluck('reporting_manager_id'))
                    ->unique();
        // Fetch all users in one query
        $users = User::whereIn('id', $userIds)
                    ->pluck('name', 'id');
        // Collect all business category IDs
        $allCategoryIds = $userMgmts->flatMap(fn($u) => explode(',', $u->business_category_id))
                                    ->unique();
        // Fetch all business categories
        $businessCategories = BusinessCategory::whereIn('id', $allCategoryIds)
                                ->pluck('name', 'id');
        // Prepare final rows ready for Blade
        $data = $userMgmts->map(function($user) use ($users, $businessCategories) {
            $categoryNames = collect(explode(',', $user->business_category_id))
                                ->map(fn($id) => $businessCategories[$id] ?? null)
                                ->filter()
                                ->implode(', ');

            return [
                'coordinator' => $users[$user->coordinator_id] ?? '',
                'reporting_manager' => $users[$user->reporting_manager_id] ?? '',
                'business_categories' => $categoryNames,
            ];
        });

        $coordinators = User::where('user_type', 'Sales Coordinator')->pluck('name', 'id');

        // Get the main user's role
        $user_type = $mainUser->user_type ?? '';

        // Pass user_type to Blade
        return view('admin.view-sales-manager-executive-details', compact('data', 'coordinators', 'id', 'user_type'));
    }
    public function getCoordinatorData(Request $request)
    {
        $data = [];
        $error = true;
        $msg = '';
        $coordinator = User::where('id', $request->id)->where('is_active', 1)->first();
        if (!$coordinator) {
            return response()->json([
                'data' => null,
                'error' => true,
                'msg' => 'User not found or inactive'
            ]);
        }
        $businessCategoryIds = explode(',', $coordinator->business_category ?? '');
        $businessCategory = BusinessCategory::whereIn('id', $businessCategoryIds)->get(['id', 'name']);

        // 4. Fetch reporting managers (vp) for this coordinator
        $vp = User::whereRaw("FIND_IN_SET(?, parent_id)", [$coordinator->id])->get(['id','name']);
        $data['business_category'] = $businessCategory;
        $data['vp'] = $vp;
        $error = false;

        return response()->json([
            'data' => $data,
            'error' => $error,
            'msg' => $msg
        ]);
    }
    public function storeSalesManager(Request $request)
    {
        $validator = validator($request->all(), [
            'sales_coordinator' => 'required',
            'business_category' => 'required|array',
            'vp' => 'required'
        ]);
        $business_category = implode(',', $request->business_category);
        $exists = UserManagement::where('user_id', $request->id)
            ->whereRaw("FIND_IN_SET(business_category_id, ?)", [$business_category])
            ->first();
        if ($exists) {
            return redirect()->back()->with('error', 'Already Added.');
        }
        UserManagement::create([
            'user_id' => $request->id,
            'coordinator_id' => $request->sales_coordinator,
            'business_category_id' => implode(',', $request->business_category),
            'reporting_manager_id' => $request->vp,
        ]);

        return redirect()->back()->with('success', 'User Added Successfully.');
    }
}