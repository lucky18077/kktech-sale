<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
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
use App\Models\LeadComment;
use App\Models\Quote;
use App\Models\QuoteDetail;
use App\Models\Sale;
use App\Models\DealerPrice;
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
        return $options;
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
        return $options;
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
        return $options;
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
        return $options;
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
        return $options;
    }
    
    /**
     * Show leads by status - generic method for all status pages
     */
    public function leadsByStatus($statusName)
    {
        $statusNames = ['new-lead', 'pending-lead', 'processing-lead', 'call-scheduled', 'visit-scheduled', 'visit-done', 'lost-lead', 'converted-lead'];
        
        if (!in_array($statusName, $statusNames)) {
            abort(404);
        }
        
        $leadStatus = LeadStatus::get();
        // load lists used by the add/edit modal so we can render full dropdowns
        $users = DB::table('users as a')
            ->join('user_mgmt as b', 'a.id', '=', 'b.user_id')
            ->select('a.id', 'a.name')
            ->distinct()
            ->get();
        $dealers = Dealer::pluck('name', 'id');
        $clients = Customer::where('active', 1)
            ->select('id', 'name', 'number')
            ->get();
        $sources = Source::where('active', 1)->pluck('source_name', 'id');
        $partnerTypes = PartnerType::select('id','name','type')->get();
        $plumbers = $partnerTypes->where('type', 'Plumber')->pluck('name', 'id');
        $architects = $partnerTypes->where('type', 'Architect')->pluck('name', 'id');
        $mep = $partnerTypes->where('type', 'Mep')->pluck('name', 'id');
        $propertyStage = PropertyStage::where('active', 1)->pluck('stage_name', 'id');
        $states = DB::table('state_district')->distinct()->pluck('state');
        $businessCategory = BusinessCategory::where('active',1)->pluck('name','id');
        $propertyCategory = PropertyCategory::where('active',1)->pluck('name','id');
        $propertySubCategory = [];

        // map status slug to readable heading
        $statusMapping = [
            'new-lead' => 'NEW LEAD',
            'pending-lead' => 'PENDING',
            'processing-lead' => 'PROCESSING',
            'call-scheduled' => 'CALL SCHEDULED',
            'visit-scheduled' => 'VISIT SCHEDULED',
            'visit-done' => 'VISIT DONE',
            'lost-lead' => 'LOST',
            'converted-lead' => 'CONVERTED'
        ];
        
        $statusDisplay = $statusMapping[$statusName];
        
        return view('admin.lead-status', compact(
            'leadStatus', 'statusDisplay', 'statusName',
            'users','dealers','clients','sources','plumbers','architects','mep',
            'propertyStage','states','businessCategory','propertyCategory','propertySubCategory'
        ));
    }

    /**
     * Individual status page methods for convenience
     */
    public function getNewLead() 
    {
        return $this->leadsByStatus('new-lead');
    }

    public function pendingLead()
    {
        return $this->leadsByStatus('pending-lead');
    }

    public function processingLead()
    {
        return $this->leadsByStatus('processing-lead');
    }

    public function callScheduledLead()
    {
        return $this->leadsByStatus('call-scheduled');
    }

    public function visitScheduledLead()
    {
        return $this->leadsByStatus('visit-scheduled');
    }

    public function visitDoneLead()
    {
        return $this->leadsByStatus('visit-done');
    }

    public function lostLead()
    {
        return $this->leadsByStatus('lost-lead');
    }

    public function convertedLead()
    {
        return $this->leadsByStatus('converted-lead');
    }
    
    public function getLeads(Request $request)
    {
        $user = Auth::user();
        $searchValue = $request->input('search')['value'] ?? '';

        // Get user's business categories from parent_id coordinators
        $businessCategoryIds = [];
        if ($user->parent_id) {
            $parents = User::whereIn('id', explode(',', $user->parent_id))
                ->pluck('business_category')
                ->filter()
                ->unique()
                ->values()
                ->toArray();
            $businessCategoryIds = array_merge($businessCategoryIds, $parents);
        }
        if ($user->business_category) {
            $businessCategoryIds = array_merge($businessCategoryIds, explode(',', $user->business_category));
        }
        $businessCategoryIds = array_unique(array_filter($businessCategoryIds));

        // Get business category names
        $businessCats = BusinessCategory::whereIn('id', $businessCategoryIds)->pluck('name')->toArray();

        // Build base query
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
                'lead_mst.city as lead_city',
                'lead_mst.state as lead_state',
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

        // Filter by user's business categories
        if (!empty($businessCats)) {
            $data->where(function($query) use ($businessCats) {
                foreach ($businessCats as $cat) {
                    $query->orWhereRaw("lead_mst.business_category LIKE ?", ["%$cat%"]);
                }
            });
        }

        // Handle status filters
        $status = $request->input('status', '');
        $conversion = $request->input('conversion', '');

        if ($conversion == "Partial" || $conversion == "Completed") {
            $data->where('lead_mst.conversion_type', strtolower($conversion));
        } elseif ($status == "CONVERTED" && empty($conversion)) {
            $data->where('lead_mst.status', 'CONVERTED')
                ->whereNotIn('lead_mst.conversion_type', ['completed', 'partial']);
        } elseif ($status !== "All" && !empty($status)) {
            $data->where('lead_status.name', $status);
        }

        // Handle search across multiple fields
        if ($searchValue) {
            $data->where(function($query) use ($searchValue) {
                $query->where('customers.name', 'LIKE', "%$searchValue%")
                      ->orWhere('customers.address', 'LIKE', "%$searchValue%")
                      ->orWhere('customers.city', 'LIKE', "%$searchValue%")
                      ->orWhere('customers.state', 'LIKE', "%$searchValue%")
                      ->orWhere('customers.number', 'LIKE', "%$searchValue%")
                      ->orWhere('dealer.name', 'LIKE', "%$searchValue%")
                      ->orWhere('dealer.address', 'LIKE', "%$searchValue%")
                      ->orWhere('dealer.city', 'LIKE', "%$searchValue%")
                      ->orWhere('dealer.state', 'LIKE', "%$searchValue%")
                      ->orWhere('dealer.phone', 'LIKE', "%$searchValue%")
                      ->orWhere('lead_mst.id', 'LIKE', "%$searchValue%")
                      ->orWhere('plumber.name', 'LIKE', "%$searchValue%")
                      ->orWhere('architect.name', 'LIKE', "%$searchValue%")
                      ->orWhere('mep.name', 'LIKE', "%$searchValue%");
            });
        }

        // Sort and paginate via DataTables
        return DataTables::of($data)
            ->addIndexColumn()
            ->addColumn('action', function($row){
                return '
                    <button class="btn btn-sm btn-warning btn-comment" data-id="'.$row->lead_id.'" title="Comments">
                        <i class="fa fa-eye"></i>
                    </button>
                    <button class="btn btn-sm btn-primary btn-products" data-id="'.$row->lead_id.'" title="Products">
                        <i class="fa fa-cart-flatbed-suitcase"></i>
                    </button>
                    <button class="btn btn-sm btn-info btn-edit" data-id="'.$row->lead_id.'" title="Edit">
                        <i class="fa fa-pencil text-white"></i>
                    </button>
                    <button class="btn btn-sm btn-danger deleteLead" data-id="'.$row->lead_id.'" title="Delete">
                        <i class="fa fa-trash"></i>
                    </button>
                ';
            })
            ->rawColumns(['action'])
            ->make(true);
    }

    /**
     * Get single lead with related data for modal
     */
    public function showLead(Request $request)
    {
        try {
            $lead = LeadMaster::find($request->id);
            
            if (!$lead) {
                return response()->json(['error' => true, 'msg' => 'Lead not found', 'data' => null]);
            }

            $data = $lead->toArray();

            // attach client/dealer details for convenience
            if ($lead->customer_type === 'customer') {
                $cust = Customer::find($lead->client_id);
                if ($cust) {
                    $data['client_name'] = $cust->name;
                    $data['client_number'] = $cust->number;
                    $data['client_state'] = $cust->state;
                    $data['client_city'] = $cust->city;
                    $data['client_address'] = $cust->address;
                }
            } elseif ($lead->customer_type === 'dealer') {
                $dlr = Dealer::find($lead->client_id);
                if ($dlr) {
                    $data['client_name'] = $dlr->name;
                    $data['client_number'] = $dlr->phone;
                    $data['client_state'] = $dlr->state;
                    $data['client_city'] = $dlr->city;
                    $data['client_address'] = $dlr->address;
                }
            }

            return response()->json(['error' => false, 'msg' => '', 'data' => $data]);
        } catch (\Exception $e) {
            return response()->json(['error' => true, 'msg' => $e->getMessage(), 'data' => null]);
        }
    }

    /**
     * Get all comments for a lead
     */
    public function showComment(Request $request)
    {
        try {
            // manual query so we don't rely on soft deletes or a user record always existing
            $comments = \DB::table('lead_comments')
                ->leftJoin('users', 'lead_comments.user_id', '=', 'users.id')
                ->where('lead_id', $request->id)
                ->select('lead_comments.*', 'users.name', 'users.user_type')
                ->get();

            return response()->json($comments);
        } catch (\Exception $e) {
            return response()->json(['error' => true, 'msg' => $e->getMessage()]);
        }
    }

    /**
     * Get quote products for a lead
     */
    public function showProduct(Request $request)
    {
        try {
            $products = DB::table('quotes_det')
                ->join('quotes_mst', 'quotes_det.quote_id', '=', 'quotes_mst.id')
                ->join('products', 'quotes_det.product_id', '=', 'products.id')
                ->leftJoin('dealer', 'quotes_det.dealer_id', '=', 'dealer.id')
                ->select(
                    'quotes_det.*',
                    'products.name',
                    'quotes_mst.created_at',
                    'dealer.name as dealer_name',
                    DB::raw('quotes_det.price - (quotes_det.price/100 * quotes_det.discount) as discount_price')
                )
                ->where('quotes_mst.lead_id', $request->id)
                ->get();

            return response()->json($products);
        } catch (\Exception $e) {
            return response()->json(['error' => true, 'msg' => $e->getMessage()]);
        }
    }

    /**
     * Get dealer list and lead products for a lead
     */
    public function getDealer(Request $request)
    {
        try {
            $lead = LeadMaster::find($request->id);
            
            if (!$lead) {
                return response()->json(['error' => true, 'msg' => 'Lead not found', 'data' => null]);
            }

            $user = User::find($lead->user_id);
            
            // Get dealers assigned to the user
            $dealers = DB::table('dealer')
                ->whereRaw("FIND_IN_SET(?, team_ids)", [$user->id])
                ->get();

            // Get lead products
            $lead_products = DB::table('quotes_det')
                ->join('quotes_mst', 'quotes_det.quote_id', '=', 'quotes_mst.id')
                ->join('products', 'quotes_det.product_id', '=', 'products.id')
                ->select(
                    'quotes_det.id',
                    'products.name',
                    'quotes_det.qty',
                    'quotes_mst.created_at'
                )
                ->where('quotes_mst.lead_id', $lead->id)
                ->get();

            return response()->json([
                'error' => false,
                'data' => [
                    'customer_type' => $lead->customer_type,
                    'dealer' => $dealers,
                    'lead_products' => $lead_products
                ]
            ]);
        } catch (\Exception $e) {
            return response()->json(['error' => true, 'msg' => $e->getMessage(), 'data' => null]);
        }
    }

    /**
     * Update lead with all fields
     */
    public function updateLead(Request $request)
    {
        DB::beginTransaction();
        try {
            $lead = LeadMaster::find($request->id);
            
            if (!$lead) {
                return response()->json(['error' => true, 'msg' => 'Lead not found']);
            }

            // Check if CONVERTED status requires PI
            if ($request->status == 'CONVERTED') {
                $quote = Quote::where('lead_id', $request->id)->where('status', 2)->first();
                if (!$quote) {
                    return response()->json(['error' => true, 'msg' => 'Please Create PI first']);
                }
            }

            // Track if address changed
            $addressChanged = ($lead->address != $request->address);

            $updateData = [
                'source_id' => $request->source,
                'state' => $request->state,
                'city' => $request->city,
                'type' => $request->property_type,
                'catg_id' => $request->property_category,
                'sub_catg_id' => $request->property_subcategory,
                'plumber_id' => $request->plumber,
                'architect_id' => $request->architect,
                'property_stage_id' => $request->property_stage,
                'address' => $request->address,
                'gst' => $request->gst ?? null,
                'mep_id' => $request->mep,
                'conversion_type' => $request->conversion_type ?? null,
                // new editable header fields
                'customer_type' => $request->customer_type,
                'business_category_id' => $request->business_category,
                'user_id' => $request->sales_manager_id,
            ];
            // adjust client_id based on type
            if($request->customer_type === 'dealer'){
                $updateData['client_id'] = $request->dealer_id;
            } else {
                $updateData['client_id'] = $request->client_id;
            }

            // Change status if status name is passed (not ID)
            if (!is_numeric($request->status)) {
                $status = LeadStatus::where('name', $request->status)->first();
                if ($status) {
                    $updateData['status_id'] = $status->id;
                }
            } else {
                $updateData['status_id'] = $request->status;
            }

            // Add remind date/time if CALL SCHEDULED or VISIT SCHEDULED
            if (in_array($request->status, ['CALL SCHEDULED', 'VISIT SCHEDULED'])) {
                $updateData['remind_date'] = $request->call_date ?? null;
                $updateData['remind_time'] = $request->call_time ?? null;
            }

            $lead->update($updateData);

            // Mark quote products as delivered if submitted
            if ($request->has('ids') && !empty($request->ids)) {
                foreach ($request->ids as $id) {
                    $id = trim($id, "'\"");
                    QuoteDetail::find($id)->update(['is_delivered' => 1]);
                }

                // Check if all products delivered
                $undelivered = QuoteDetail::join('quotes_mst', 'quotes_det.quote_id', '=', 'quotes_mst.id')
                    ->where('quotes_mst.lead_id', $lead->id)
                    ->where('quotes_det.is_delivered', 0)
                    ->count();

                $lead->conversion_type = ($undelivered > 0) ? 'Partial' : 'Completed';
                $lead->save();
            }

            // Handle dealer assignments
            if ($request->has('dealer_ids') && !empty($request->dealer_ids)) {
                foreach ($request->dealer_ids as $id) {
                    $detail = QuoteDetail::find($id);
                    if ($detail) {
                        $product = $detail->product;
                        $dealerPrice = $product->dealer_price ?? 0;
                        $detail->update([
                            'is_dealer' => 1,
                            'dealer_id' => $request->dealer_id,
                            'dealer_price' => $dealerPrice
                        ]);
                    }
                }
            }

            // Add comment
            $comment = $request->comment;
            if ($addressChanged) {
                $comment = "Address Change: Old Address " . $lead->address . ", New Address: " . $request->address . ", Comment: " . $comment;
            }

            LeadComment::create([
                'lead_id' => $lead->id,
                'user_id' => auth()->id(),
                'comment' => $comment,
                'status' => $request->status ?? 'Updated',
                'remind_date' => $request->call_date ?? null,
                'remind_time' => $request->call_time ?? null
            ]);

            DB::commit();
            return response()->json(['error' => false, 'msg' => 'Lead updated successfully']);
        } catch (\Exception $e) {
            DB::rollBack();
            return response()->json(['error' => true, 'msg' => $e->getMessage()]);
        }
    }

    /**
     * Delete lead and cascading data
     */
    public function destroy(Request $request)
    {
        DB::beginTransaction();
        try {
            // Password verification from legacy
            if ($request->password != 'kktech@123') {
                return response()->json(['error' => true, 'msg' => 'Incorrect password']);
            }

            $lead = LeadMaster::find($request->id);
            if (!$lead) {
                return response()->json(['error' => true, 'msg' => 'Lead not found']);
            }

            // Delete cascading data
            LeadComment::where('lead_id', $lead->id)->delete();
            LeadProduct::where('lead_id', $lead->id)->delete();
            $lead->delete();

            DB::commit();
            return response()->json(['error' => false, 'msg' => 'Lead deleted successfully']);
        } catch (\Exception $e) {
            DB::rollBack();
            return response()->json(['error' => true, 'msg' => $e->getMessage()]);
        }
    }

    /**
     * Get city list by state
     */
    public function getCity(Request $request)
    {
        try {
            $cities = DB::table('state_district')
                ->where('state', $request->state)
                ->select('District')
                ->distinct()
                ->get();

            $options = '<option value="">Select City</option>';
            foreach ($cities as $city) {
                $options .= '<option value="'.$city->District.'">'.$city->District.'</option>';
            }

            return $options;
        } catch (\Exception $e) {
            return '<option value="">Error loading cities</option>';
        }
    }
}

