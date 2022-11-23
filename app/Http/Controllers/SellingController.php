<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Company;
use App\Models\Customer;
use App\Models\Product;
use App\Models\Sale;
use App\Models\Stock;
use Disapamok\Modules\SriLanka;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class SellingController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $sellings = Sale::paginate(10);
        $categories = Category::pluck('name','id')->toArray();
        return view('contents.selling.index', compact('sellings','categories'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $cities = $this->getCities();
        $categories = Category::pluck('name','id')->toArray();
        return view('contents.selling.create', compact('cities','categories'));
    }


    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $requestData['phone'] = $request->phone;
        $Check_customer = Customer::orwhere($requestData)->get();
        $requestData['name'] = $request->name;
        $requestData['address1'] = $request->address1;
        $requestData['address2'] = $request->address2;
        $requestData['city'] = $request->city;
        $requestData['type'] = $request->type;
        $requestData['customer_type'] = 2;
        if(count($Check_customer) == 0){
             Customer::create($requestData);
        }
        $customer = Customer::where('phone',$request->phone)->first();
            $data = [
            "customer_id" => $customer["id"],
            "category" => $request["category"],
            "weight_recondition" => $request["weight_recondition"],
            "price_recondition" => $request["price_recondition"],
            "weight_reusable" => $request['weight_reusable'],
            "price_reusable" => $request['price_reusable'],
            ];

            DB::beginTransaction();
            try {

            $sale = Sale::create($data);

            if($sale){
                $stock = Stock::where('category',$sale->category)->first();
                if($stock){
                    $stock->weight_recondition = $stock->weight_recondition - $sale->weight_recondition;
                    $stock->weight_reusable = $stock->weight_reusable - $sale->weight_reusable;
                    $stock->save();
                }
            }

            DB::commit();
            } catch (\Exception $e) {
                DB::rollback();
            }

            return redirect()->route('selling.index')->with('success', 'Customer added successfully !');

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
        //
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

    public function getCities(){

        $cities = [];
        foreach(SriLanka::getProvinces() as $province){
            foreach(SriLanka::getDiscricts($province) as $district){
                foreach(SriLanka::getCities($district) as $city){
                   array_push($cities,$city);
               }
            }
        }
        return $cities;
    }
}
