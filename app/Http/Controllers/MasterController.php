<?php

namespace App\Http\Controllers;

use App\Models\BusinessCategory;
use App\Models\Department;
use App\Models\PropertyStage;
use App\Models\Source;
use Illuminate\Http\Request;

class MasterController extends Controller
{
    public function businessCategory(Request $request)
    {
        $businessCategories = BusinessCategory::all();
        return view('admin.business-category', compact('businessCategories'));
    }
    public function saveBusinessCategory(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'active' => 'required'
        ]);
        if ($request->id) {
            $category = BusinessCategory::find($request->id);
            $category->update([
                'name' => $request->name,
                'active' => $request->active
            ]);
        } else {
            BusinessCategory::create([
                'name' => $request->name,
                'active' => $request->active
            ]);
        }
        return redirect()->back()->with('success', 'Category saved successfully');
    }

    public function department(Request $request)
    {
        $departments = Department::all();
        return view('admin.department', compact('departments'));
    }
    public function saveDepartment(Request $request)
    {
        $request->validate([
            'dept_name' => 'required',
            'active' => 'required'
        ]);
        if ($request->id) {
            $department = Department::find($request->id);
            $department->update([
                'dept_name' => $request->dept_name,
                'active' => $request->active
            ]);
        } else {
            Department::create([
                'dept_name' => $request->dept_name,
                'active' => $request->active
            ]);
        }
        return redirect()->back()->with('success', 'Department saved successfully');
    }

    public function propertyStage(Request $request)
    {
        $propertyStages = PropertyStage::all();
        return view('admin.property-stage', compact('propertyStages'));
    }
    public function savePropertyStage(Request $request)
    {
        $request->validate([
            'stage_name' => 'required',
            'active' => 'required'
        ]);
        if ($request->id) {
            $propertyStage = PropertyStage::find($request->id);
            $propertyStage->update([
                'stage_name' => $request->stage_name,
                'active' => $request->active
            ]);
        } else {
            PropertyStage::create([
                'stage_name' => $request->stage_name,
                'active' => $request->active
            ]);
        }
        return redirect()->back()->with('success', 'Property Stage saved successfully');
    }

    public function source(Request $request)
    {
        $sources = Source::all();
        return view('admin.source', compact('sources'));
    }
    public function saveSource(Request $request)
    {
        $request->validate([
            'source_name' => 'required',
            'active' => 'required'
        ]);
        if ($request->id) {
            $source = Source::find($request->id);
            $source->update([
                'source_name' => $request->source_name,
                'active' => $request->active
            ]);
        } else {
            Source::create([
                'source_name' => $request->source_name  ,
                'active' => $request->active
            ]);
        }
        return redirect()->back()->with('success', 'Source saved successfully');
    }
}
