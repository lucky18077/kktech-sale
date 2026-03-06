<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\AreaMaster;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use App\Models\BusinessCategory;

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
        $vicePresidents = User::where('user_type', 'Vice President')->whereIn('parent_id', $parentIds)->get();
        return view('admin.vp', compact('areamst','users', 'vicePresidents'));
    }
    public function addVp(Request $request)
    {
        $user = new User();
        $user->name = $request->name;
        $user->email = $request->email;
        $user->password = $request->password;
        $user->area_id = $request->area;
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
        $user = new User();
        $user->name = $request->name;
        $user->email = $request->email;
        $user->password = $request->password;
        $user->parent_id = Auth::user()->id;
        $user->area_id = $request->area;
        $user->business_category = implode(',', $request->business_category);
        $user->is_active = $request->usr_active;
        $user->user_type = $request->usr_role;
        $user->save();

        return redirect()->back()->with('success','Coordinator Added Successfully');
    }
}
