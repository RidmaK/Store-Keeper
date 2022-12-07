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
        $latest = Order::latest()->first();
        $request['waybill_id'] = $latest->waybill_id ++;
        $request['order_id'] = $latest->order_id ++;
        // $request['source'] = isset($request->source) ? $request->source : '';
       $order = Order::create([
        'waybill_id' => $request['waybill_id'],
        'order_id' => $request['order_id'],
        'waybill_id' => $request['waybill_id'],
       ]);

        dd($order);
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
            $latest = Order::latest()->first();
            $request['waybill_id'] = $latest->waybill_id ++;
            $request['order_id'] = $latest->order_id ++;
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
}
