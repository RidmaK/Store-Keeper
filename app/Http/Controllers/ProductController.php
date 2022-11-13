<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\CategoryProduct;
use App\Models\Image;
use App\Models\Product;
use App\Models\SubCategory;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Storage;
class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $products = Product::paginate(10);
        return view('contents.Inventry.index',compact('products'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('contents.Inventry.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

       $data = [
        "customer_id" => $request["customer_id"],
        "name" => $request["name"],
        "description" => $request["description"],
        "category" => $request["category"],
        "weight_recondition" => $request["weight_recondition"],
        "price_recondition" => $request["price_recondition"],
        "weight_reusable" => $request['weight_reusable'],
        "price_reusable" => $request['price_reusable'],
        ];

        DB::beginTransaction();
        try {

            $product = Product::create($data);
            DB::commit();
            return redirect()->route('product.index')->with('success', 'RECORD HAS BEEN SUCCESSFULLY INSERTED!');
            } catch (\Exception $e) {
                DB::rollback();
                return redirect()->route('product.index')->with('error', 'RECORD HAS NOT BEEN SUCCESSFULLY INSERTED!');
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

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {

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
        $data = [
            "customer_id" => $request["customer_id"],
            "name" => $request["name"],
            "description" => $request["description"],
            "category" => $request["category"],
            "weight_recondition" => $request["weight_recondition"],
            "price_recondition" => $request["price_recondition"],
            "weight_reusable" => $request['weight_reusable'],
            "price_reusable" => $request['price_reusable'],
            ];
        $product = Product::where('id',$id)

        ->update($data);
            return redirect()->route('product.index')->with('success', 'Record updated successfully !');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $product = Product::where('id',$id)->delete();
        return redirect()->route('product.index')->with('success', 'Record deleted successfully !');
    }
}
