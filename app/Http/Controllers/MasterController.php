<?php

namespace App\Http\Controllers;

use App\Models\BusinessCategory;
use App\Models\Department;
use App\Models\Product;
use App\Models\PropertyStage;
use App\Models\Source;
use App\Models\ProductCategory;
use App\Models\ProductSubcategory;
use App\Models\ProductUOM;
use App\Models\PropertyCategory;
use App\Models\PropertySubCategory;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

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
                'source_name' => $request->source_name,
                'active' => $request->active
            ]);
        }
        return redirect()->back()->with('success', 'Source saved successfully');
    }

    public function propertyCategory(Request $request)
    {
        $propertyCategories = PropertyCategory::all();
        return view('admin.property-category', compact('propertyCategories'));
    }
    public function savePropertyCategory(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'active' => 'required'
        ]);
        if ($request->id) {
            $propertyCategory = PropertyCategory::find($request->id);
            $propertyCategory->update([
                'name' => $request->name,
                'active' => $request->active
            ]);
        } else {
            PropertyCategory::create([
                'name' => $request->name,
                'active' => $request->active
            ]);
        }
        return redirect()->back()->with('success', 'Property Category saved successfully');
    }

    public function propertySubCategory(Request $request)
    {
        $propertySubCategories = PropertySubcategory::with('propertyCategory')->get();
        $propertyCategories = ProductCategory::all();
        return view('admin.property-sub-category', compact('propertySubCategories', 'propertyCategories'));
    }
    public function savePropertySubCategory(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'active' => 'required'
        ]);
        if ($request->id) {
            $propertySubCategory = PropertySubcategory::find($request->id);
            $propertySubCategory->update([
                'property_category_id' => $request->property_category_id,
                'name' => $request->name,
                'active' => $request->active
            ]);
        } else {
            PropertySubCategory::create([
                'property_category_id' => $request->property_category_id,
                'name' => $request->name,
                'active' => $request->active
            ]);
        }
        return redirect()->back()->with('success', 'Property Sub-Category saved successfully');
    }

    public function productCategory(Request $request)
    {
        $productCategories = ProductCategory::all();
        return view('admin.product-category', compact('productCategories'));
    }
    public function saveProductCategory(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'active' => 'required'
        ]);
        if ($request->id) {
            $productCategory = ProductCategory::find($request->id);
            $productCategory->update([
                'name' => $request->name,
                'active' => $request->active
            ]);
        } else {
            ProductCategory::create([
                'name' => $request->name,
                'active' => $request->active
            ]);
        }
        return redirect()->back()->with('success', 'Product Category saved successfully');
    }

    public function productSubCategory(Request $request)
    {
        $productSubCategories = ProductSubcategory::with('productCategory')->get();
        $productCategories = ProductCategory::all();
        return view('admin.product-sub-category', compact('productSubCategories', 'productCategories'));
    }
    public function saveProductSubCategory(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'active' => 'required'
        ]);
        if ($request->id) {
            $productSubCategory = ProductSubcategory::find($request->id);
            $productSubCategory->update([
                'product_category_id' => $request->product_category_id,
                'name' => $request->name,
                'active' => $request->active
            ]);
        } else {
            ProductSubcategory::create([
                'product_category_id' => $request->product_category_id,
                'name' => $request->name,
                'active' => $request->active
            ]);
        }
        return redirect()->back()->with('success', 'Product Sub-Category saved successfully');
    }

    public function productUOM(Request $request)
    {
        $productUOMs = ProductUOM::all();
        return view('admin.product-uom', compact('productUOMs'));
    }

    public function saveProductUOM(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'active' => 'required'
        ]);
        if ($request->id) {
            $productUOM = ProductUOM::find($request->id);
            $productUOM->update([
                'name' => $request->name,
                'active' => $request->active
            ]);
        } else {
            ProductUOM::create([
                'name' => $request->name,
                'active' => $request->active
            ]);
        }
        return redirect()->back()->with('success', 'Product UOM saved successfully');
    }

    public function products(Request $request)
    {
        $businessCategories = BusinessCategory::where('active', 1)->get();
        $productCategories = ProductCategory::where('active', 1)->get();
        $productSubCategories = ProductSubcategory::where('active', 1)->get();
        $productUOMs = ProductUOM::where('active', 1)->get();
        $products = Product::with('businessCategory', 'productCategory', 'productSubCategory', 'productUOM')->get();
        return view('admin.products', compact('businessCategories', 'productCategories', 'productSubCategories', 'productUOMs', 'products'));
    }

    public function saveProduct(Request $request)
    {
        $request->validate([
            'business_category_id' => 'required',
            'product_category_id' => 'required',
            'product_subcategory_id' => 'required',
            'product_uom_id' => 'required',
            'warranty_days' => 'required',
        ]);
        $barcode = str_pad(mt_rand(0, 999999999999), 12, '0', STR_PAD_LEFT);
        $file = null;
        if ($request->hasFile('img')) {
            $file = time() . '.' . $request->img->extension();
            $request->img->move(public_path('product-images'), $file);
        }
        if ($request->id) {
            $product = Product::find($request->id);
            if (!$file) {
                $file = $product->img;
            }
            $product->update([
                'business_category_id' => $request->business_category_id,
                'product_category_id' => $request->product_category_id,
                'product_subcategory_id' => $request->product_subcategory_id,
                'product_uom_id' => $request->product_uom_id,
                'warranty_days' => $request->warranty_days,
                'name' => $request->name,
                'description' => $request->description,
                'img' => $file,
                'price' => $request->price,
                'dealer_price' => $request->dealer_price,
                'purchase_price' => $request->purchase_price,
                'hsn_code' => $request->hsn_code,
                'gst_tax' => $request->gst_tax,
                'min_stock' => $request->min_stock,
                'cess_tax' => $request->cess_tax,
                'active' => $request->active
            ]);
        } else {
            Product::create([
                'business_category_id' => $request->business_category_id,
                'product_category_id' => $request->product_category_id,
                'product_subcategory_id' => $request->product_subcategory_id,
                'product_uom_id' => $request->product_uom_id,
                'warranty_days' => $request->warranty_days,
                'name' => $request->name,
                'description' => $request->description,
                'img' => $file,
                'price' => $request->price,
                'dealer_price' => $request->dealer_price,
                'purchase_price' => $request->purchase_price,
                'hsn_code' => $request->hsn_code,
                'min_stock' => $request->min_stock,
                'gst_tax' => $request->gst_tax,
                'cess_tax' => $request->cess_tax,
                'barcode' => $barcode,
                'active' => $request->active
            ]);
        }
        return redirect()->back()->with('success', 'Product saved successfully');
    }

    public function importProducts(Request $request)
    {
        $request->validate([
            'file' => 'required|mimes:csv'
        ]);

        try {
            $file = $request->file('file');
            $handle = fopen($file->getRealPath(), "r");
            $businessCategories = BusinessCategory::pluck('id', 'name')->toArray();
            $existingHsn = Product::pluck('hsn_code')->toArray();
            $hsnCheck = [];
            $products = [];
            $row = 0;
            while (($data = fgetcsv($handle, 1000, ",")) !== FALSE) {
                if ($row == 0) {
                    $row++;
                    continue;
                }
                if (empty($data[0])) {
                    $row++;
                    continue;
                }
                $business_category_id = $businessCategories[$data[1]] ?? null;

                if (!$business_category_id) {
                    $row++;
                    continue;
                }
                $category = ProductCategory::firstOrCreate(
                    ['name' => $data[2]],
                    ['business_category_id' => $business_category_id]
                );
                $subcategory = ProductSubcategory::firstOrCreate(
                    [
                        'name' => $data[3],
                        'product_category_id' => $category->id
                    ]
                );
                $uom = ProductUom::firstOrCreate([
                    'name' => $data[4]
                ]);
                $hsn = $data[8];
                if (in_array($hsn, $existingHsn) || in_array($hsn, $hsnCheck)) {
                    $row++;
                    continue;
                }
                $hsnCheck[] = $hsn;
                $barcode = str_pad(mt_rand(0, 999999999999), 12, '0', STR_PAD_LEFT);
                $products[] = [
                    'name' => $data[0],
                    'barcode' => $barcode,
                    'business_category_id' => $business_category_id,
                    'product_category_id' => $category->id,
                    'product_subcategory_id' => $subcategory->id,
                    'product_uom_id' => $uom->id,
                    'price' => $data[5],
                    'dealer_price' => $data[6],
                    'purchase_price' => $data[7],
                    'hsn_code' => $hsn,
                    'gst_tax' => $data[9],
                    'cess_tax' => $data[10],
                    'min_stock' => $data[11],
                    'warranty_days' => $data[12],
                    'active' => $data[13],
                    'created_at' => now(),
                    'updated_at' => now()
                ];
                $row++;
            }
            fclose($handle);
            DB::beginTransaction();
            if (!empty($products)) {
                Product::insert($products);
            }
            DB::commit();
            return redirect()->back()->with('success', count($products) . ' Products imported successfully');
        } catch (\Exception $e) {
            DB::rollBack();
            return redirect()->back()->with('error', 'Import failed: ' . $e->getMessage());
        }
    }
}
