<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\CategoryProduct;
use App\Models\Company;
use App\Models\Image;
use App\Models\Product;
use App\Models\Stock;
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
    public function __construct(Request $request)
    {
        $this->middleware('permission:product-list|product-create|product-edit|product-delete', ['only' => ['index', 'show']]);
        $this->middleware('permission:product-create', ['only' => ['create', 'store']]);
        $this->middleware('permission:product-delete', ['only' => ['destroy']]);
        $this->middleware('permission:stock-list', ['only' => ['stock']]);
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data = Product::get();
        return view('contents.product.index',compact('data'));
    }


    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $categories = Category::get();
        return view('contents.product.create',compact('categories'));
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
        "name" => $request["name"],
        "part_number" => $request["part_number"],
        "unit_price" => $request["unit_price"],
        "mrp" => $request["mrp"],
        "dealer_total_price" => $request["dealer_total_price"],
        "qty" => $request["qty"],
        "category" => $request["category"],
        "description" => $request["description"],
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
        $product = Product::where('id',decrypt($id))->latest()->first();
        $categories = Category::get();
        return view('contents.product.show', compact('product','categories'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $product = Product::where('id',$id)->latest()->first();
        return view('contents.product.edit', compact('product','categories'));
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
        "name" => $request["name"],
        "part_number" => $request["part_number"],
        "unit_price" => $request["unit_price"],
        "mrp" => $request["mrp"],
        "dealer_total_price" => $request["dealer_total_price"],
        "qty" => $request["qty"],
        "category" => $request["category"],
        "description" => $request["description"],
        ];
        $product = Product::where('id',$id)

        ->update($data);

            return redirect()->route('product.index')->with('success', 'Record updated successfully !');
    }

    public function import(Request $request){
        DB::beginTransaction();
                try {
        if(isset($request->file)){
            $headers = ['Part Description','Part Number','Unit Price','MRP','Qty','Dealer Total Price'];
            $csv_data = CsvImportController::import_csv($request,$headers);
            if(!empty($csv_data)){
                foreach ($csv_data as $key => $value) {
                    $order = Product::create([
                        'name' => $value['Part Description'],
                        'part_number' => $value['Part Number'],
                        'unit_price' => floatval(str_replace(',', '', $value['Unit Price'])),
                        'dealer_total_price' => floatval(str_replace(',', '', $value['MRP'])),
                        'description' => $value['Part Description'],
                        'qty' => intval(str_replace(',', '', $value['Qty'])),
                        'mrp' => floatval(str_replace(',', '', $value['MRP'])),
                    ]);

                }

            }
        }

        DB::commit();
        return redirect()->back()->with('success', 'Product uploaded successfully');;
        } catch (\Exception $e) {
            dd($e);
            // something went wrong
            DB::rollback();
            return redirect()->back()->with('error', 'Product uploaded Unsucccesfully,Something wrong in Headers');;

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
        $product = Product::where('id',$id)->delete();
        return redirect()->route('product.index')->with('success', 'Record deleted successfully !');
    }
}
