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
    public function showVps()
    {
        $areamst = AreaMaster::where('active', 1)->get();
        $parentIds = explode(',', Auth::user()->parent_id ?? '');
        $parentsIds[] = Auth::user()->id;
        $users = User::where('user_type', 'sales coordinator')
                    ->whereNotIn('id', $parentIds)
                    ->get();
        $vicePresidents = User::where('user_type', 'Vice President')->get();
        return view('admin.vp', compact('areamst','users', 'vicePresidents'));
    }
    public function addVp(Request $request)
    {
            $request->validate([
                'name' => 'required',
                'email' => 'required',
                'password' => 'required',
                'area' => 'required',
                'phone' => 'required',
                'usr_active' => 'required',
                'usr_role' => 'required',
            ]);
        $user = User::where('phone', $request->phone)->first();
        if ($user) {
            return redirect()->back()->with('error', 'VP with this phone number already exists.');
        } elseif ($request->id) {
            $user = User::find($request->id);
            $user->update([
                'name' => $request->name,
                'email' => $request->email,
                'password' => $request->password,
                'phone' => $request->phone,
                'parent_id' => implode(',', $request->parent_id ?? []),
                'is_active' => $request->is_active,
                'user_type' => $request->usr_role
            ]);
            return redirect()->back()->with('success', 'VP updated successfully');
        }
        $user = new User();
        $user->name = $request->name;
        $user->email = $request->email;
        $user->password = $request->password;
        $user->phone = $request->phone;
        $user->parent_id = implode(',', $request->parent_id ?? []);
        $user->is_active = $request->is_active;
        $user->user_type = $request->usr_role;
        $user->save();

        return redirect()->back()->with('success','VP Added Successfully');
    }
     public function showCoordinators()
    {
        $parentsIds = explode(',', Auth::user()->parent_id ?? '');
        $parentsIds[] = Auth::user()->id;
       // Get all assigned business_category ids
        $assigned_categories = User::where('user_type', 'Sales Coordinator')->pluck('business_category') // returns collection of comma-separated strings->filter() // remove nulls
        ->map(function($item) {
                return explode(', ', $item); // split each user's categories
        })
        ->flatten() // merge all arrays into one
        ->unique() // remove duplicates
        ->toArray();
        $coordinates = User::where('user_type', 'Sales Coordinator')->whereIn('parent_id', $parentsIds)->get();
        // Fetch categories not assigned yet
        $businessCategories = BusinessCategory::whereNotIn('id', $assigned_categories)->get();
        $areaMst = AreaMaster::where('active', 1)->get();
        return view('admin.coordinator', compact('businessCategories','areaMst', 'coordinates'));
        
    }
    public function addCoordinator(Request $request)
    {
         $request->validate([
            'name' => 'required',
            'email' => 'required',
            'password' => 'required',
            'business_category' => 'required',
            'usr_active' => 'required',
            'usr_role' => 'required',
        ]);
        $user = User::where('email', $request->email)->first();
        if ($user) {
            return redirect()->back()->with('error', 'Coordinator with this email already exists.');
        } elseif ($request->id) {
            $user = User::find($request->id); 
            $user->update([
                'name' => $request->name,
                'email' => $request->email,
                'password' => $request->password,
                'parent_id' => Auth::user()->id,
                'business_category' => implode(',', $request->business_category),
                'is_active' => $request->usr_active,
                'user_type' => $request->usr_role
            ]);
            return redirect()->back()->with('success', 'Coordinator updated successfully');
        }
        $user = new User();
        $user->name = $request->name;
        $user->email = $request->email;
        $user->password = $request->password;
        $user->parent_id = Auth::user()->id;
        // $user->area_id = $request->area;
        $user->business_category = implode(',', $request->business_category);
        $user->is_active = $request->usr_active;
        $user->user_type = $request->usr_role;
        $user->save();
        return redirect()->back()->with('success','Coordinator Added Successfully');
    }
    public function showSalesManager()
    {
       $salesManagers = DB::table('users as a')
        ->join('designation as b', 'a.designation', '=', 'b.id')
        ->select('a.*', 'b.name as designation')
        ->whereIn('a.user_type', ['Sales manager', 'Sales executive'])
        ->get();
        // dd($salesManagers);
        $designations = Designation::get();
        return view('admin.sale-manager-executive', compact('salesManagers', 'designations'));
        
    }
    public function showDesignations()
    {
        $designations = Designation::get();
        return view('admin.designation', compact('designations'));
        
    }
    public function addDesignation(Request $request) 
    {
            $request->validate([
                    'name' => 'required'
            ]);
            if ($request->id) {
                $department = Designation::find($request->id);
                $department->update([
                    'name' => $request->name,
                ]);
            } else {
                Designation::create([
                    'name' => $request->name,
                ]);
            }
            return redirect()->back()->with('success', 'Designation saved successfully');
    }
    public function showOfficeTeams(Request $request) 
    {
            $teams = DB::table('office_team as a')
                    ->join('department as b', 'a.department', '=', 'b.id')
                    ->select('a.*', 'b.title as department', 'b.id as dep_id')
                    ->get();
            $departments = Department::where('active', 1)->get();
            return view('admin.officeTeams', compact('teams','departments'));
    }
    public function addOfficeTeams(Request $request) 
    {
           $request->validate([
                'name' => 'required',
                'mobile'=> 'required',
                'department' => 'required',
                'active' => 'required'
            ]);
            if ($request->id) {
                $department = OfficeTeam::find($request->id);
                $department->update([
                    'name' => $request->name,
                    'mobile' => $request->mobile,
                    'department' => $request->department,
                    'active' => $request->active
                ]);
            } else {
                OfficeTeam::create([
                    'name' => $request->name,
                    'mobile' => $request->mobile,
                    'department' => $request->department,
                    'active' => $request->active
                ]);
            }
            return redirect()->back()->with('success', 'Department saved successfully'); 
    }
    public function addSalesManager(Request $request) 
    {
           $request->validate([
                'name' => 'required',
                'email'=> 'required',
                'phone' => 'required',
                'usr_role' => 'required',
                'designation' => 'required',
                'is_active' =>'required',
                'password' =>'required'

            ]);
            if ($request->id) {
                $user = User::find($request->id);
                $user->update([
                    'name' => $request->name,
                    'email' => $request->email,
                    'phone' => $request->phone,
                    'designation' => $request->designation,
                    'user_type' => $request->usr_role,
                    'is_active' => $request->is_active,
                    'password' => $request->password
                ]);
            } else {
                User::create([
                   'name' => $request->name,
                    'email' => $request->email,
                    'phone' => $request->phone,
                    'designation' => $request->designation,
                    'user_type' => $request->usr_role,
                    'is_active' => $request->is_active,
                    'password' => $request->password
                ]);
            }
            return redirect()->back()->with('success', 'Sales manager/Executive saved successfully'); 
    }
}
