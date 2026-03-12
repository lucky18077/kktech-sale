<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Models\LeadMaster;
use App\Models\Dealer;
use App\Models\Customer;
use App\Models\Source;
use App\Models\PartnerType;
use App\Models\PropertyStage;
use App\Models\ProductCategory;
use App\Models\ProductSubCategory;
use App\Models\User;
use App\Models\PropertyCategory;
use App\Models\BusinessCategory;
use App\Models\LeadProduct;
use App\Models\LeadStatus;
use Illuminate\Support\Facades\DB;
use Yajra\DataTables\Facades\DataTables;
class LeadController extends Controller
{
    public function index()
    {
        $users = DB::table('users as a')
            ->join('user_mgmt as b', 'a.id', '=', 'b.user_id')
            ->select('a.id', 'a.name')
            ->distinct()
            ->get();
        $dealers = Dealer::pluck('name', 'id');
        $clients = Customer::where('active', 1)
            ->select('id', 'name', 'number')
            ->get();
        $sources = Source::where('active', 1)
            ->pluck('source_name', 'id');
        // Single query for partner types
        $partnerTypes = PartnerType::select('id','name','type')->get();
        $plumbers = $partnerTypes->where('type', 'Plumber')->pluck('name', 'id');
        $architects = $partnerTypes->where('type', 'Architect')->pluck('name', 'id');
        $mep = $partnerTypes->where('type', 'Mep')->pluck('name', 'id');
        $propertyStage = PropertyStage::where('active', 1)->pluck('stage_name', 'id');
        $states = DB::table('state_district')->distinct()->pluck('state');
        $productCategory = ProductCategory::where('active', 1)->pluck('name', 'id');
        $productSubCategory = ProductSubCategory::where('active', 1)->pluck('name', 'id');

        return view('admin.add-lead', compact(
            'users',
            'dealers',
            'clients',
            'sources',
            'plumbers',
            'architects',
            'mep',
            'states',
            'propertyStage',
            'productCategory',
            'productSubCategory'
        ));
    }
    public function store(Request $request)
    {
        $products = json_decode($request->prod_list, true);

        if ($request->customer_type == 'dealer' && empty($request->dealer_id)) {
            return back()->with('error','Select Dealer');
        }

        if ($request->customer_type == 'customer' && empty($request->client_id)) {
            return back()->with('error','Select Customer');
        }

        if(empty($products) || count($products)==0){
            return back()->with('error','Add at least one product');
        }

        foreach($products as $p){
            if(empty($p['id']) || empty($p['qty']) || $p['qty'] <= 0){
                return back()->with('error','Invalid product data');
            }
        }

        /* ======================
        SAVE DATA
        ====================== */
        DB::beginTransaction();
        try {

           $client_id = $request->customer_type == "dealer"
            ? $request->dealer_id
            : $request->client_id;
            $lead = LeadMaster::create([
                'source_id' => $request->source,
                'state' => $request->lead_state,
                'city' => $request->lead_city,
                'address' => $request->address,
                'last_comment' => $request->remarks,
                'user_id' => $request->sales_manager_id,
                'type' => $request->category_type,
                'catg_id' => $request->category_id,
                'sub_catg_id' => $request->sub_category_id,
                'plumber_id' => $request->plumber,
                'architect_id' => $request->architect,
                'property_stage_id' => $request->property_stage,
                'client_id' => $client_id,
                'mep_id' => $request->mep,
                'customer_type' => $request->customer_type,
                'business_category_id' => $request->business_category,
                'status_id' => 1
            ]);

            foreach($products as $item){

                LeadProduct::create([
                    'lead_id' => $lead->id,
                    'product_id' => $item['id'],
                    'qty' => $item['qty']
                ]);

            }
            DB::commit();
            return redirect()->back()->with('success','Lead added successfully');

        }
        catch(\Exception $e){
            DB::rollBack();
            return back()->with('error',$e->getMessage());
        }

    }
    public function getPropertyCategory(Request $request)
    {
        $type = $request->input('type');
        if (! $type) {
            return response()->json(['error' => 'Type is required'], 400);
        }
        $options = '';
        $categories = PropertyCategory::where('type', $type)->where('active', 1)->get();
        if (! empty($categories)) {
            foreach ($categories as $row) {
                $options .= '<option value="'.$row->id.'">'.$row->name.'</option>';
            }
        }
       
        if (empty($options)) {
                $options = '<option selected disabled>----Select----</option>';
        }
        return response()->json($options);
    }

    /**
     * Return property sub‑categories for a given category id.
     */
    public function getSubCategory(Request $request)
    {
        $cat = $request->input('category_id');
        $options = '';
        if ($cat) {
            $subs = \App\Models\PropertySubCategory::where('property_category_id', $cat)
                      ->where('active',1)->get();
            foreach ($subs as $row) {
                $options .= '<option value="'.$row->id.'">'.$row->name.'</option>';
            }
        }
        if (empty($options)) {
            $options = '<option selected disabled>----Select----</option>';
        }
        return response()->json($options);
    }

    /**
     * Return business categories and dealers for a sales manager.
     */
    public function getBusinessCategory(Request $request)
    {
        try {

            $request->validate([
                'sales_manager_id' => 'required|integer'
            ]);
            $token = session('token');

            /* CHECK AUTH USER */
            $cr = User::where('token', $token)
                ->where('is_active', 1)
                ->first();

            if (!$cr) {
                return response()->json([
                    'error' => true,
                    'msg' => 'Unauthorized user',
                    'data' => []
                ]);
            }

            /* GET SALES MANAGER */
            $user = User::find($request->sales_manager_id);

            if (!$user) {
                return response()->json([
                    'error' => true,
                    'msg' => 'Sales manager not found',
                    'data' => []
                ]);
            }

            /* GET DEALERS */
            $dealer = DB::table('dealer')
                ->whereRaw("FIND_IN_SET(?, team_ids)", [$user->id])
                ->get();

            /* GET USER MANAGEMENT RECORDS */
            $userMgmt = DB::table('user_mgmt')
                ->where('user_id', $user->id)
                ->pluck('business_category_id');

            /* GET BUSINESS CATEGORY */
            $businessCategory = DB::table('business_category')
                ->whereIn('id', $userMgmt)
                ->get();

            return response()->json([
                'error' => false,
                'msg' => '',
                'data' => [
                    'dealer' => $dealer,
                    'business_category' => $businessCategory
                ]
            ]);
        } catch (\Exception $e) {

            return response()->json([
                'error' => true,
                'msg' => $e->getMessage(),
                'data' => []
            ]);
        }
    }

    /**
     * Return product categories (option list). If a business category is provided, filter by it.
     */
    public function getProductCategory(Request $request)
    {
        $business = $request->input('business_category');
        $query = \App\Models\ProductCategory::where('active',1);
        // if you have relationship between product categories and business categories, apply filter here
        $cats = $query->get();
        $options = '<option value="">Select category</option>';
        foreach ($cats as $c) {
            $options .= '<option value="'.$c->id.'">'.$c->name.'</option>';
        }
        return response()->json($options);
    }

    public function getProductSubCategory(Request $request)
    {
        $catId = $request->input('prod_category_id');
        $subs = \App\Models\ProductSubCategory::where('product_category_id', $catId)
                    ->where('active',1)->get();
        $options = '<option value="">Select</option>';
        foreach ($subs as $s) {
            $options .= '<option value="'.$s->id.'">'.$s->name.'</option>';
        }
        return response()->json($options);
    }

    public function getProductLead(Request $request)
    {
        $cat = $request->input('prod_category_id');
        $sub = $request->input('prod_subcategory_id');
        $query = \App\Models\Product::where('active',1);
        if ($cat) {
            $query->where('product_category_id', $cat);
        }
        if ($sub) {
            $query->where('product_subcategory_id', $sub);
        }
        $products = $query->get();
        $options = '<option value="">Select Product</option>';
        foreach ($products as $p) {
            $options .= '<option value="'.$p->id.'">'.$p->name.'</option>';
        }
        return response()->json($options);
    }
    
    public function getNewLead() 
    {
        $leadStatus = LeadStatus::get();
       return view('admin.lead-status', compact('leadStatus'));
    }
    
    public function getLeads(Request $request)
    {
       $data = DB::table('lead_mst')
        ->select(
            'lead_mst.*',
            'lead_mst.id as lead_id',
            'lead_mst.type as property_type',
            'sources.id as source_id',
            'sources.source_name as source',

            DB::raw("
                CASE 
                    WHEN lead_mst.customer_type = 'dealer' 
                    THEN dealer.id 
                    ELSE customers.id 
                END as client_id
            "),

            DB::raw("
                CASE 
                    WHEN lead_mst.customer_type = 'dealer' 
                    THEN dealer.name 
                    ELSE customers.name 
                END as client_name
            "),

            DB::raw("
                CASE 
                    WHEN lead_mst.customer_type = 'dealer' 
                    THEN dealer.phone 
                    ELSE customers.number 
                END as client_number
            "),

            DB::raw("
                CASE 
                    WHEN lead_mst.customer_type = 'dealer' 
                    THEN dealer.city 
                    ELSE customers.city 
                END as client_city
            "),

            DB::raw("
                CASE 
                    WHEN lead_mst.customer_type = 'dealer' 
                    THEN dealer.state 
                    ELSE customers.state 
                END as client_state
            "),
             DB::raw("
                CASE 
                    WHEN lead_mst.customer_type = 'dealer' 
                    THEN dealer.address 
                    ELSE customers.address 
                END as client_address
            "),

            'plumber.id as plumber_id',
            'plumber.name as plumber',

            'architect.id as architect_id',
            'architect.name as architect',

            'mep.id as mep_id',
            'mep.name as mep',

            'business_category.id as business_category_id',
            'business_category.name as business_category',

            'property_stage.id as property_stage_id',
            'property_stage.stage_name as property_stage',

            'lead_status.id as status_id',
            'lead_status.name as status',

            'property_categories.id as property_category_id',
            'property_categories.name as property_category',

            'property_subcategories.id as property_subcategory_id',
            'property_subcategories.name as property_subcategory',

            'users.id as user_id',
            'users.name as user_name',
            'users.user_type as role',

            'lead_mst.address as lead_address',
            'lead_mst.lead_date'
        )
        ->leftJoin('sources','sources.id','=','lead_mst.source_id')
        ->leftJoin('lead_status','lead_status.id','=','lead_mst.status_id')
        ->leftJoin('customers', function($join){
            $join->on('customers.id','=','lead_mst.client_id')
                ->where('lead_mst.customer_type','=','customer');
        })
        ->leftJoin('dealer', function($join){
            $join->on('dealer.id','=','lead_mst.client_id')
                ->where('lead_mst.customer_type','=','dealer');
        })
        ->leftJoin('property_categories','property_categories.id','=','lead_mst.catg_id')
        ->leftJoin('property_subcategories','property_subcategories.id','=','lead_mst.sub_catg_id')
        ->leftJoin('partnertypes as plumber','plumber.id','=','lead_mst.plumber_id')
        ->leftJoin('partnertypes as architect','architect.id','=','lead_mst.architect_id')
        ->leftJoin('partnertypes as mep','mep.id','=','lead_mst.mep_id')
        ->leftJoin('business_category','business_category.id','=','lead_mst.business_category_id')
        ->leftJoin('property_stage','property_stage.id','=','lead_mst.property_stage_id')
        ->leftJoin('users','users.id','=','lead_mst.user_id');
        return DataTables::of($data)
            ->addColumn('action', function($row){
                return '
                <button class="btn btn-sm btn-primary" onclick=\'showLead('.json_encode($row).')\'>View</button>
                <button class="btn btn-sm btn-danger deleteLead" data-id="'.$row->lead_id.'">Delete</button>
                ';

            })
            ->rawColumns(['action'])
            ->make(true);
    }
}
