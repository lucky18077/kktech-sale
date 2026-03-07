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

class StaffController extends Controller
{

    /* -------------------- Vice Presidents -------------------- */

    public function showVps()
    {
        $parentIds = explode(',', Auth::user()->parent_id ?? '');
        $users = User::where('user_type', 'sales coordinator')
            ->whereNotIn('id', $parentIds)
            ->get();
        $vicePresidents = User::where('user_type', 'Vice President')->get();
        return view('admin.vp', compact('users', 'vicePresidents'));
    }

    public function addVp(Request $request)
    {
        $validator = validator($request->all(), [
            'name' => 'required|string|max:255',
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
                'parent_id' => implode(',', $request->parent_id ?? []),
                'is_active' => $request->is_active,
                'user_type' => $request->usr_role
            ]);
            return back()->with('success', 'VP updated successfully');
        }
        if (User::where('phone', $request->phone)->exists()) {
            return back()->with('error', 'VP with this phone number already exists.');
        }
        User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => $request->password,
            'phone' => $request->phone,
            'parent_id' => implode(',', $request->parent_id ?? []),
            'is_active' => $request->is_active,
            'user_type' => $request->usr_role
        ]);

        return back()->with('success', 'VP Added Successfully');
    }

    /* -------------------- Coordinators -------------------- */

    public function showCoordinators()
    {
        $parentIds = explode(',', Auth::user()->parent_id ?? '');
        $parentIds[] = Auth::user()->id;

        $assignedCategories = User::where('user_type', 'Sales Coordinator')
            ->pluck('business_category')
            ->filter()
            ->map(fn($item) => explode(',', $item))
            ->flatten()
            ->unique()
            ->toArray();

        $coordinates = User::where('user_type', 'Sales Coordinator')
            ->whereIn('parent_id', $parentIds)
            ->get();
        $businessCategories = BusinessCategory::whereNotIn('id', $assignedCategories)->get();
        return view('admin.coordinator', compact('businessCategories', 'coordinates'));
    }

    public function addCoordinator(Request $request)
    {

        $validator = validator($request->all(), [
            'name' => 'required',
            'email' => 'required|email',
            'password' => 'required',
            'business_category' => 'required',
            'usr_active' => 'required',
            'usr_role' => 'required'
        ]);

        if ($validator->fails()) {
            return back()->withErrors($validator)->withInput();
        }

        if ($request->id) {

            $user = User::findOrFail($request->id);

            $user->update([
                'name' => $request->name,
                'email' => $request->email,
                'password' => $request->password,
                'phone' => $request->mobile,
                'parent_id' => Auth::id(),
                'business_category' => implode(',', $request->business_category ?? []),
                'is_active' => $request->usr_active,
                'user_type' => $request->usr_role
            ]);

            return back()->with('success', 'Coordinator updated successfully');
        }

        if (User::where('email', $request->email)->exists()) {
            return back()->with('error', 'Coordinator with this email already exists.');
        }

        User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => $request->password,
            'phone' => $request->mobile,
            'parent_id' => Auth::id(),
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
            ->select('a.*', 'b.name as designation')
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
}