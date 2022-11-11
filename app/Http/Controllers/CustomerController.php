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
        $categories = Customer::paginate(10);
        return view('contents.customer.index', compact('categories'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $cities = [];
        foreach(SriLanka::getProvinces() as $province){
            foreach(SriLanka::getDiscricts($province) as $district){
                foreach(SriLanka::getCities($district) as $city){
                   array_push($cities,$city);
               }
            }
        }

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
        $data =[
            'pro_mc_name' => $request->pro_mc_name,
            'pro_mc_code' => $request->pro_mc_code,
            'pro_mc_short_name' => $request->pro_mc_short_name,
        ];
        $Check_category = Customer::orwhere($data)->get();
        if(count($Check_category)>0){
            return redirect()->route('customer.index')->with('error', 'Record allready exist !');

        }else{
            Customer::create($request->all());
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
        $category = Category::where('pro_mc_id',$id)->get();
        $category->transform(function ($cat) {
            return [
                'pro_mc_id'=>$cat->pro_mc_id,
                'pro_mc_name'=>$cat->pro_mc_name,
                'pro_mc_code'=>$cat->pro_mc_code,
                'pro_mc_short_name'=>$cat->pro_mc_short_name,
            ];
        });
        return response()->json($category[0]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $category = Category::where('pro_mc_id',$id)->latest()->first();
        return view('contents.category.edit', compact('category'));
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
        $Check_category = Category::where('pro_mc_id',$id)
        ->update([
            'pro_mc_name' => $request->pro_mc_name,
            'pro_mc_code' => $request->pro_mc_code,
            'pro_mc_short_name' => $request->pro_mc_short_name,
            'status' => $request->status,
        ]);
            return redirect()->route('category.index')->with('success', 'Record updated successfully !');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $category = Category::where('pro_mc_id',$id)->delete();
        return redirect()->route('category.index')->with('success', 'Record deleted successfully !');
    }

    public function getCitiesFunction(){

        dd(SriLanka::getCities('Ampara'));
        return SriLanka::getCities('District'); // Returns cities of a district
    }

    public function getProvincesFunction(){
        return SriLanka::getProvinces(); // Returns all provinces
    }

    public function getDiscrictsFunction(){
        return SriLanka::getDiscricts('Province'); // Returns disdricts of a province
    }

}
