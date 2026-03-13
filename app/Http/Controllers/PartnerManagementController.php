<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\DealerCategory;
use App\Models\Dealer;
use App\Models\CategoryDiscount;
use App\Models\PartnerType;
use App\Models\Product;
use App\Models\Customer;
use Illuminate\Support\Facades\DB;
use Yajra\DataTables\Facades\DataTables;

class PartnerManagementController extends Controller
{
    public function index(){
        $dealerCategories = DealerCategory::get();
        return view('admin.dealer-category', compact('dealerCategories'));
    }

    /**
     * Show dealer listing page.
     */
    public function dealers()
    {
        $dealers = DB::table('dealer as a')
            ->leftJoin('dealer_category as b', 'a.dealer_category_id', '=', 'b.id')
            ->select('a.*', 'b.name as category')
            ->get();
        $dealerCategories = DealerCategory::get();
        $states = DB::table('state_district')->distinct()->pluck('state');
        return view('admin.add-dealer', compact('dealers', 'dealerCategories', 'states'));
    }

    /**
     * Get cities by state.
     */
    public function getCities(Request $request)
    {
        $state = $request->query('state');
        $cities = DB::table('state_district')
            ->where('state', $state)
            ->distinct()
            ->pluck('district');
        return response()->json($cities);
    }

    /**
     * Save or update dealer record.
     */
    public function saveDealer(Request $request)
    { 
        $data = $request->only([
            'name',
            'phone',
            'email',
            'pincode',
            'address',
            'state',
            'city',
            'gst',
            'pan_number',
            'adhar_number',
            'team_ids',
            'dealer_category_id',
            'category',
            'company'
        ]);

        if ($request->id) {
            $dealer = Dealer::find($request->id);
            if ($dealer) {
                $dealer->update($data);
                $message = 'Dealer updated successfully';
            } else {
                return redirect()->back()->with('error', 'Dealer not found');
            }
        } else {
            Dealer::create($data);
            $message = 'Dealer created successfully';
        }

        return redirect()->back()->with('success', $message);
    }
    public function save(Request $request) {

         $request->validate([
            'name' => 'required',
        ]);
        if ($request->id) {
            $category = DealerCategory::find($request->id);
            $category->update([
                'name' => $request->name
            ]);
        } else {
            DealerCategory::create([
                'name' => $request->name
            ]);
        }
        return redirect()->back()->with('success', 'Dealer category saved successfully');
    }
    public function brandDiscount($id) {
       $dealerCategory = DealerCategory::find($id);
        if (!$dealerCategory) {
            return redirect()->back()->with('error', 'Dealer category not found');
        }
        $categoryDiscount = CategoryDiscount::where('dealer_category_id', $id)->first();
        if (!$categoryDiscount) {
            $data = DB::table('products as a')
            ->join('product_categories as b', 'a.product_category_id', '=', 'b.id')
            ->select('b.id', 'b.name' . ' as name', DB::raw('0 as discount'))
            ->distinct()
            ->get();
        } else {
            $data = CategoryDiscount::where('dealer_category_id', $id)->select('category_id as id', 'category_name as name', 'discount')->get();
        }
        $dealerBrands = DB::table('products as a')
            ->join('product_categories as b', 'a.product_category_id', '=', 'b.id')
            ->select('b.id', 'b.name')
            ->distinct()
            ->get();
        return view('admin.brand-discount', compact('data', 'dealerBrands', 'dealerCategory'));
    }
    public function addBrandDiscount(Request $request, $id)
    {
        try {
            $request->validate([
                'brand' => 'required',
                'discount' => 'required',
            ]);
            $category_id = explode('_', $request->brand)[0];
            $category_name = explode('_', $request->brand)[1];
            $categoryDiscount = CategoryDiscount::where('category_id',$category_id)
                ->where('dealer_category_id', $id)
                ->first();

            if (!$categoryDiscount) {
                CategoryDiscount::create([
                    'category_name' =>  $category_name,
                    'category_id' => $category_id,
                    'dealer_category_id' => $id,
                    'discount' => $request->discount
                ]);

                return redirect()->back()->with('success', 'Added Successfully');

            } else {

                return redirect()->back()->with('error', 'Already Added');
            }

        } catch (\Throwable $th) {

            return redirect()->back()->with('error', $th->getMessage());
        }
    }

    public function saveBrandDiscount(Request $request, $id)
    {
        try {

            $data = [];
            if (!empty($request->category)) {
                foreach ($request->category as $key => $values) {
                    [$category_id, $category_name] = explode('_', $key);
                    $data[] = [
                        'category_id' => $category_id,
                        'category_name' => $category_name,
                        'dealer_category_id' => $id,
                        'discount' => $values[0] ?? 0,
                    ];
                }
                if (!empty($data)) {
                    CategoryDiscount::upsert(
                        $data,
                        ['category_id', 'dealer_category_id'],
                        ['discount']
                    );
                }
            }

            return redirect()->back()->with('success', 'Saved Successfully');

        } catch (\Throwable $th) {
            return redirect()->back()->with('error', $th->getMessage());
        }
    }

    /**
     * View dealer sales manager allocation page.
     */
    public function viewDealerSalesManager($id)
    {
        $dealer = Dealer::findOrFail($id);

        // Get all sales managers not allocated to this dealer
        $allocatedTeamIds = $dealer->team_ids ? explode(',', $dealer->team_ids) : [];
        $availableSalesManagers = DB::table('users as a')
            ->leftJoin('designation as b', 'a.designation', '=', 'b.id')
            ->where('a.user_type', 'Sales manager')
            ->whereNotIn('a.id', $allocatedTeamIds)
            ->select('a.id', 'a.name', 'a.phone', 'a.email', 'b.name as designation')
            ->get();

        // Get allocated sales managers
        $allocatedSalesManagers = [];
        if (!empty($allocatedTeamIds)) {
            $allocatedSalesManagers = DB::table('users as a')
                ->leftJoin('designation as b', 'a.designation', '=', 'b.id')
                ->whereIn('a.id', $allocatedTeamIds)
                ->select('a.id', 'a.name', 'a.phone', 'a.email', 'b.name as designation')
                ->get();
        }

        return view('admin.view-dealer-sales-manager', compact('dealer', 'availableSalesManagers', 'allocatedSalesManagers'));
    }

    /**
     * Allocate sales managers to dealer.
     */
    public function allocateDealerSalesManager(Request $request, $id)
    {
        $request->validate([
            'ids' => 'required|array',
            'ids.*' => 'integer|exists:users,id'
        ]);

        $dealer = Dealer::findOrFail($id);
        $ids = implode(',', $request->ids);

        if ($dealer->team_ids) {
            $dealer->update(['team_ids' => $dealer->team_ids . ',' . $ids]);
        } else {
            $dealer->update(['team_ids' => $ids]);
        }

        return redirect()->back()->with('success', 'Sales managers allocated successfully');
    }

    /**
     * Unallocate sales manager from dealer.
     */
    public function unallocateDealerSalesManager($dealerId, $userId)
    {
        $dealer = Dealer::findOrFail($dealerId);

        if ($dealer->team_ids) {
            $teamIds = explode(',', $dealer->team_ids);
            $teamIds = array_filter($teamIds, function($id) use ($userId) {
                return $id != $userId;
            });
            $newTeamIds = implode(',', $teamIds);
            $dealer->update(['team_ids' => $newTeamIds]);
        }

        return redirect()->back()->with('success', 'Sales manager unallocated successfully');
    }

    /**
     * View brand allocation page for dealer.
     */
    public function allocateBrandDealer($id)
    {
        $dealer = Dealer::findOrFail($id);

        // Get all available product categories
        $availableCategories = DB::table('products as p')
            ->join('product_categories as pc', 'p.product_category_id', '=', 'pc.id')
            ->select('pc.id', 'pc.name as category')
            ->where('pc.active', 1)
            ->distinct()
            ->get();

        // Get allocated categories
        $allocatedCategories = [];
        if ($dealer->category) {
            $categoryIds = explode(',', $dealer->category);
            $allocatedCategories = DB::table('product_categories')
                ->whereIn('id', $categoryIds)
                ->select('id', 'name as category')
                ->get();
        }

        return view('admin.allocate-brand-dealer', compact('dealer', 'availableCategories', 'allocatedCategories'));
    }

    /**
     * Display price list for a dealer and category.
     */
    public function viewDealerPriceList($id, $categoryId)
    {
        $dealer = Dealer::findOrFail($id);

        $category = DB::table('product_categories')->where('id', $categoryId)->first();
        if (!$category) {
            return redirect()->back()->with('error', 'Category not found');
        }

        // fetch discount for dealer category
        $categoryDiscount = CategoryDiscount::where('category_id', $categoryId)
            ->where('dealer_category_id', $dealer->dealer_category_id)
            ->first();

        // fetch products for this category along with any custom dealer price
        $products = DB::table('products as p')
            ->leftJoin('dealer_price as dp', function ($join) use ($dealer) {
                $join->on('p.id', '=', 'dp.product_id')
                     ->where('dp.dealer_id', $dealer->id);
            })
            ->where('p.product_category_id', $categoryId)
            ->select('p.*', 'dp.price as dealer_price', 'dp.updated_at as dealer_price_updated')
            ->get();
        return view('admin.view-dealer-price-list', compact('dealer', 'category', 'categoryDiscount', 'products'));
    }

    /**
     * Save brand allocation for dealer.
     */
    public function allocateBrandDealerSave(Request $request, $id)
    {
        $request->validate([
            'category' => 'required|array',
            'category.*' => 'string'
        ]);

        $dealer = Dealer::findOrFail($id);
        $categories = implode(',', $request->category);

        if ($dealer->category) {
            $dealer->update(['category' => $dealer->category . ',' . $categories]);
        } else {
            $dealer->update(['category' => $categories]);
        }

        return redirect()->back()->with('success', 'Brands allocated successfully');
    }
   public function showPartnerTypes(Request $request)
    {
        $query = PartnerType::query();
        if ($request->has('type') && $request->type != '') {
            $query->where('type', $request->type);
        }
        $partnerTypes = $query->get();
        $states = DB::table('state_district')->distinct()->pluck('state');
        return view('admin.partner-type', compact('partnerTypes', 'states'));
    }
    public function savePartnerType(Request $request)
    { 
        $data = $request->only([
            'company',
            'name',
            'number',
            'dob',
            'doa',
            'address',
            'state',
            'city',
            'active',
            'type',
            'remarks'
        ]);

        if ($request->id) {
            $dealer = PartnerType::find($request->id);
            if ($dealer) {
                $dealer->update($data);
                $message = 'Partner type updated successfully';
            } else {
                return redirect()->back()->with('error', 'Partner type not found');
            }
        } else {
             $dealer = PartnerType::where('number', $request->number)->first();
            if ($dealer) {
                return redirect()->back()->with('error', 'Partner type already exists');
            }
            PartnerType::create($data);
            $message = 'Partner type created successfully';
        }

        return redirect()->back()->with('success', $message);
    }
    public function showClients()
    {
        $clients = Customer::where('active', 1)->get();
        $states = DB::table('state_district')->distinct()->pluck('state');
        return view('admin.client', compact('clients', 'states'));
    }
    public function saveClient(Request $request) 
    {
         $data = $request->only([
            'name',
            'number',
            'email',
            'address',
            'state',
            'city',
            'district',
            'company',
            'gst',
            'city',
            'pincode',
            'ship_address',
            'ship_state',
            'ship_district',
            'ship_city',
            'ship_pincode',
            'active',
        ]);

        if ($request->id) {
            $customer = Customer::find($request->id);
            if ($customer) {
                $customer->update($data);
                $message = 'Dealer updated successfully';
            } else {
                return redirect()->back()->with('error', 'Client not found');
            }
        } else {
            $customer = Customer::where('number', $request->number)->first();
            if ($customer) {
                return redirect()->back()->with('error', 'Client already exists');
            }
            Customer::create($data);
            $message = 'Client created successfully';
        }
        return redirect()->back()->with('success', $message);
    }
    public function clientsData(Request $request)
    {
        // Use all needed columns including shipping and GST info
        $clients = Customer::select(
            'id',
            'company',
            'name',
            'number',
            'address',
            'state',
            'city',
            'active',
            'gst',
            'district',
            'pincode',
            'ship_address',
            'ship_state',
            'ship_district',
            'ship_city',
            'ship_pincode',
            'active',
        )->where('active', 1);

        // Search filter with optimized LIKE queries
        if ($request->has('search') && $request->search['value']) {
            $searchValue = $request->search['value'];
            $clients->where(function($query) use ($searchValue) {
                $query->where('name', 'like', "{$searchValue}%")      // Prefix match for better index usage
                    ->orWhere('company', 'like', "{$searchValue}%")
                    ->orWhere('number', 'like', "{$searchValue}%");
            });
        }

        // Add order by if specified
        if ($request->has('order') && count($request->order)) {
            $orderColumn = $request->order[0]['column'];
            $orderDir = $request->order[0]['dir'];
            
            $columns = ['id', 'company', 'name', 'number', 'address', 'state', 'city', 'active'];
            if (isset($columns[$orderColumn])) {
                $clients->orderBy($columns[$orderColumn], $orderDir);
            }
        } else {
            $clients->orderBy('id', 'desc');
        }

        return DataTables::of($clients)
            ->addIndexColumn()
            ->editColumn('active', function ($row) {
                return $row->active == 1 
                    ? '<span class="badge bg-success">Active</span>'
                    : '<span class="badge bg-danger">Inactive</span>';
            })
            ->addColumn('action', function ($row) {
                return '<a class="editClient p-2" data-id="'.$row->id.'" data-data=\''.json_encode($row).'\'>
                            <i class="feather-edit"></i>
                        </a>';
            })
            ->rawColumns(['active','action'])
            ->make(true);
    }
}
