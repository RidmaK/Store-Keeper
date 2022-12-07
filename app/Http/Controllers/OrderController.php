<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\User;
use Illuminate\Http\Request;

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

        return view('contents.orders.index', compact('data'))
            ->with('i', ($request->input('page', 1) - 1) * 5);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function getOrderDetails(Request $request)
    {
        $data = Order::find($request->id);
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

        $request['waybill_id'] = $this->latest()['waybill_id'] + 1;
        $request['order_id'] = $this->latest()['order_id'] + 1;
        $order = Order::create([
            'waybill_id' => $request['waybill_id'],
            'order_id' => $request['order_id'],
            'stage' => $request['stage'],
            'full_name' => $request['name'],
            'email' => $request['email'],
            'phone' => $request['phone'],
            'address' => $request['address'],
            'district' => $request['district'],
            'description' => $request['description'],
            'cod' => $request['cod'],
            'actual_value' => $request['actual_value'],
            'source' => 'CANMO ONLINE STORE',
        ]);

        return redirect()->route('order.index')
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


}
