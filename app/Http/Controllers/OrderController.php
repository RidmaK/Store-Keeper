<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\User;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;
use App\Imports\ImportOder;
use Yajra\DataTables\DataTables;
use App\Exports\ExportOrder;
use App\Exports\ExportSingleOrder;
use App\Models\Dealer;
use App\Models\DealerProduct;
use App\Models\Product;
use Illuminate\Support\Facades\DB;

class OrderController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $data = Order::OrderBy('id', 'DESC')->paginate(500);
        $product = Product::all();
        $dealers = Dealer::all();
        return view('contents.orders.index', compact('data','product','dealers'))
            ->with('i', ($request->input('page', 1) - 1) * 5);
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function deliveyIndex(Request $request)
    {
        $data = Order::OrderBy('id', 'DESC')->paginate(500);
        $product = Product::all();
        $dealers = Dealer::all();
        $deliveries = DealerProduct::all();
        return view('contents.orders.index', compact('data','product','dealers','deliveries'))
            ->with('i', ($request->input('page', 1) - 1) * 5);
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function in(Request $request)
    {
        $data = DealerProduct::where('reason','in')->OrderBy('id', 'DESC')->paginate(500);
        return view('contents.orders.delivery', compact('data'))
            ->with('i', ($request->input('page', 1) - 1) * 5);
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function out(Request $request)
    {
        $data = DealerProduct::where('reason','dealer')->OrderBy('id', 'DESC')->paginate(500);
        return view('contents.orders.delivery', compact('data'))
            ->with('i', ($request->input('page', 1) - 1) * 5);
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function return(Request $request)
    {
        $data = DealerProduct::where('reason','return')->OrderBy('id', 'DESC')->paginate(500);
        return view('contents.orders.delivery', compact('data'))
            ->with('i', ($request->input('page', 1) - 1) * 5);
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function todayOrder(Request $request)
    {
        $data = Order::whereDate('created_at',now())->OrderBy('id', 'DESC')->paginate(500);
        $product = Product::all();
        return view('contents.orders.today-index', compact('data','product'))
            ->with('i', ($request->input('page', 1) - 1) * 5);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function getOrderDetails(Request $request)
    {
        $data = Product::find($request->id);
        return $data;
    }
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $product = Product::all()->pluck('name','id')->toArray();
        $request['waybill_id'] = $this->latest()['waybill_id'] + 1;
        $request['order_id'] = $this->latest()['order_id'] + 1;
        $order = Order::create([
            'waybill_id' => $request['waybill_id'],
            'order_id' => $request['order_id'],
            'stage' => $request['stage'] ?? 1,
            'full_name' => $request['name'],
            'email' => $request['email'],
            'phone' => $request['phone'],
            'address' => $request['address'],
            'district' => $request['district'],
            'description' => $product[$request['product']],
            'cod' => $request['cod'],
            'actual_value' => $request['actual_value'],
            'source' => 'CANMO ONLINE STORE',
        ]);

        return redirect()->route('order.today')
            ->with('success', 'Order created successfully');
    }
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function setStage(Request $request)
    {
        $request['waybill_id'] = $this->latest()['waybill_id'] + 1;
        $request['order_id'] = $this->latest()['order_id'] + 1;
        $order = Order::where('id',$request->id)->update([
            'waybill_id' => $request['waybill_id'],
            'order_id' => $request['order_id'],
            'stage' => $request['stage'],
        ]);
            $getOrder = Order::find($request->id);
            $data['id'] = $getOrder->id;
            $data['stage'] = config('constants.stages')[$getOrder->stage];
        return $data;
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }
    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function getOrderData(Request $request)
    {

        $product = Product::all()->pluck('name','id')->toArray();
        $data = Product::whereNotNull('created_at');
        return Datatables()->of($data)
            ->filter(function ($query) use ($request) {
                if ($request->has('type') && $request->get('type') != '') {
                    $query->whereDate('created_at',now());
                }

                if ($request->has('product') && $request->get('product') != '' && $request->get('product') != 'select') {
                    $query->where('description',$request->get('product'));
                }

                if ($request->has('from_date') && $request->get('from_date') != '' && $request->has('to_date') && $request->get('to_date') != '') {
                    if ($request->get('from_date') == $request->get('to_date')) {
                        $query->whereDate('created_at', '=', $request->get('from_date'));
                    } else {
                        $query->whereDate('created_at', '>=', $request->get('from_date'));
                        $query->whereDate('created_at', '<=', $request->get('to_date'));
                    }
                }
            })
            ->editColumn('updated_at', function ($pns) {
                return (date_format($pns->updated_at,"Y-m-d H:i:s"));
            })
            ->editColumn('created_at', function ($pns) {
                return (date_format($pns->created_at,"Y-m-d H:i:s"));
            })
            ->addColumn('name', function ($pns) {
                return '<a onclick="getOrder('.$pns->id.')" style="cursor: pointer;" class="cm-status success">'.strLimit($pns->name).'</a>';
            })
            ->addColumn('unit_price', function ($pns) use($product) {
                return $pns->unit_price;
            })
            ->addColumn('qty', function ($pns) use($product) {
                return $pns->qty + $pns->in_qty - $pns->out_qty;
            })
            ->addColumn('description', function ($pns) use($product) {
                return $pns->description;
            })
            ->escapeColumns(['id'])

            ->make(true);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        if($request->has('type') && $request->get('type') == 1){

            if($request['stage'] != 5){
                $request['waybill_id'] = $this->latest()['waybill_id'] + 1;
                $request['order_id'] = $this->latest()['order_id'] + 1;
                // $request['source'] = isset($request->source) ? $request->source : '';
                $order = Order::where('id',$request->id)->update([
                    'waybill_id' => $request['waybill_id'],
                    'order_id' => $request['order_id'],
                    'description' => $request['description'],
                    'stage' => $request['stage'],
                    'district' => $request['district'],
                    'cod' => $request['cod'],
                    'actual_value' => $request['actual_value'],
                ]);
                return Order::find($request->id);
            }else{
                $order = Order::where('id',$request->id)->forceDelete();
                return Order::latest()->first();
            }


        }

    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function updateStockInDetails(Request $request, $id)
    {
        $productfind = Product::find($request['id']);

        $data = [
        "in_qty" => $productfind->in_qty + $request["qty"],
        ];
        $product = Product::where('id',$request['id'])
        ->update($data);



        $productDealer = DealerProduct::create([
            'product_id' => $request['id'],
            'qty' => $request["qty"],
            'reason' => 'in'
        ]);

        $data =[
                    'id' => $productfind->id,
                    'status' => true,
                ];
        return $data;
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function updateStockWarrentyDetails(Request $request, $id)
    {
        $productfind = Product::find($request['id']);
        $data = [
            "out_qty" => $productfind->out_qty + $request["qty"],
        ];
        $currentStock = $productfind->qty + $productfind->in_qty -$productfind->out_qty;
        if(($currentStock - $request["qty"]) >= 0){
            $product = Product::where('id',$request['id'])
            ->update($data);

            $qty = $request["qty"];


            $productDealer = DealerProduct::create([
                'product_id' => $request['id'],
                'qty' => $qty,
                'reason' => 'return'
            ]);

                $data =[
                    'id' => $productfind->id,
                    'status' => true,
                ];
            return $data;
        }else{
            $data =[
                    'id' => '',
                    'status' => false,
                ];
            return $data;
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function updateStockOutDetails(Request $request, $id)
    {
        $productfind = Product::find($request['id']);
        $data = [
            "out_qty" => $productfind->out_qty + $request["qty"],
        ];
        $currentStock = $productfind->qty + $productfind->in_qty -$productfind->out_qty;
        if(($currentStock - $request["qty"]) >= 0){
            $product = Product::where('id',$request['id'])
            ->update($data);


            $qty = $request["qty"];

            $productDealer = DealerProduct::create([
                'product_id' => $request['id'],
                'dealer_id' => $request['dealer'],
                'qty' => $qty,
                'reason' => 'dealer'
            ]);

                $data =[
                    'id' => $productfind->id,
                    'status' => true,
                ];
            return $data;
        }else{
            $data =[
                    'id' => '',
                    'status' => false,
                ];
            return $data;
        }

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function latest()
    {
        $data['waybill_id'] = Order::whereRaw('waybill_id = (select max(`waybill_id`) from orders)')->first()->waybill_id ?? 100000000;
        $data['order_id'] = Order::whereRaw('order_id = (select max(`order_id`) from orders)')->first()->order_id ?? 100000000;

        return $data;
    }

    public function importView(Request $request){
        return view('importFile');
    }

    public function import(Request $request){
        DB::beginTransaction();
                try {
                    $product = Product::all()->pluck('name','id')->toArray();
        if(isset($request->file)){
            $headers = ['form_name','FULL_NAME','PHONE','STREET_ADDRESS'];
            $csv_data = CsvImportController::import_csv($request,$headers);
            if(!empty($csv_data)){
                foreach ($csv_data as $key => $value) {
                    $street = str_replace('±', '', $value['STREET_ADDRESS']);
                    $order = Order::create([
                        'full_name' => $value['FULL_NAME'],
                        'phone' => str_replace("p:","",$value['PHONE']),
                        'address' => $street,
                        'source' => $value['form_name'],
                        'description' => $product[$request['product']],
                        'stage' => 1
                    ]);
                }

            }
        }

        DB::commit();
        return redirect()->back()->with('success', 'Order uploaded successfully');;
        } catch (\Exception $e) {
            // dd($e);
            // something went wrong
            DB::rollback();
        }
    }

    // public function exportOrders(Request $request){
    //     return Excel::download(new ExportOrder, 'orders.xlsx');
    // }

    public function exportOrder(Request $request,$id){
        return Excel::download(new ExportSingleOrder($id), 'koombiyo_Order_Upload_New_Template.xlsx');
    }

    public function exportOrders(Request $request){

        dd($request->all());
        $myFile = Excel::download(new ExportOrder($request), 'koombiyo_Order_Upload_New_Template.xlsx');

        $response = [
            'name' => 'Invoice-list-'.now().'.xlsx',
            'file' => 'data:application/vnd.ms-excel;base64,'.base64_encode($myFile),
        ];

        return response()->json($response);
    }



}
