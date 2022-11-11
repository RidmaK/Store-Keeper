<?php

namespace App\Http\Controllers;

use App\Models\Customer;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Disapamok\Modules\SriLanka;
class CustomerController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $cities = $this->getCities();
        $customers = Customer::paginate(10);
        return view('contents.customer.index', compact('customers','cities'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $cities = $this->getCities();
        return view('contents.customer.create', compact('cities'));
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
        if(count($Check_customer)>0){
            return redirect()->route('customer.index')->with('error', 'Record allready exist !');

        }else{
            Customer::create($requestData);
            return redirect()->route('customer.index')->with('success', 'Record added successfully !');
        }

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $cities = $this->getCities();
        $customer = Customer::where('id',$id)->latest()->first();
        return view('contents.customer.show', compact('customer','cities'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $cities = $this->getCities();
        $customer = Customer::where('id',$id)->latest()->first();
        return view('contents.customer.edit', compact('customer','cities'));
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
        $requestData['name'] = $request->name;
        $requestData['address1'] = $request->address1;
        $requestData['address2'] = $request->address2;
        $requestData['city'] = $request->city;
        $requestData['phone'] = $request->phone;
        $requestData['type'] = $request->type;
        $Check_customer = Customer::where('id',$id)->update($requestData);
            return redirect()->route('customer.index')->with('success', 'Record updated successfully !');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $customer = Customer::where('id',$id)->delete();
        return redirect()->route('customer.index')->with('success', 'Record deleted successfully !');
    }

    public function getCitiesFunction(){

        dd(SriLanka::getCities('Ampara'));
        return SriLanka::getCities('District'); // Returns cities of a district
    }

    public function getProvincesFunction(){
        return SriLanka::getProvinces(); // Returns all provinces
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
