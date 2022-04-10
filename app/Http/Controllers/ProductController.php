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
        return view('contents.product.index', compact('products'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $product = Product::get();
        $categories = Category::get();
        $sub_categories = SubCategory::get();
        return view('contents.product.create', compact('product','categories','sub_categories'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

       $sub_categories = $request->pro_sc_ids;

       $data =[
        'pro_name' => $request->pro_name,
        'pro_code' => $request->pro_code,
        'pro_short_name' => $request->pro_short_name,
        ];
        $Check_product = Product::orwhere($data)->get();
        if(count($Check_product)>0){
            return redirect()->route('product.index')->with('error', 'Record allready exist !');

        }else{
        DB::beginTransaction();
        try {
                $product = new Product();
                $product->pro_name = $request->pro_name;
                $product->pro_code = $request->pro_code;
                $product->pro_short_name = $request->pro_short_name;
                $product->pro_description = $request->pro_description;
                $product->save();
                dd($request->images);
                foreach ($request->file('images') as $imagefile) {
                    $get_product = Product::orwhere($data)->latest()->first();

                    $image = new Image();
                    $path = $imagefile->store('/images/resource', ['disk' =>   'my_files']);
                    $image->url = $path;
                    $image->product_id = $get_product->pro_id;
                    $image->save();
                }

                foreach($sub_categories as $sub_category){
                $category = explode(',',$sub_category);
                $get_product = Product::orwhere($data)->latest()->first();
                    $Category_product = new CategoryProduct();
                    $Category_product->pro_id = $get_product->pro_id;
                    $Category_product->pro_mc_id = $category[0];
                    $Category_product->pro_sc_id = $category[1];
                    $Category_product->save();
                }
            DB::commit();
            return redirect()->route('product.index')->with('success', 'RECORD HAS BEEN SUCCESSFULLY INSERTED!');
            } catch (\Exception $e) {
                DB::rollback();
                return redirect()->route('product.index')->with('error', 'RECORD HAS NOT BEEN SUCCESSFULLY INSERTED!');
            }
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

    public function search(Request $request) {
        // get the search term
        $text = $request->input('text');
        $category_id = $request->category_id;


        // search the product table
        $productCategory = Product::Leftjoin('category_products as cp','products.pro_id','cp.pro_id')
        ->Leftjoin('product_prices as pp','products.pro_id','pp.pro_id')
        ->join('categories as c','c.pro_mc_id','cp.pro_mc_id')
        ->join('sub_categories as sc','sc.pro_sc_id','cp.pro_sc_id')
        ->whereDate('pp.date_to','>=',now())
        ->whereDate('pp.date_from','<=',now());

        if ($text && $text != "") {
            $productCategory->orwhere('c.pro_mc_name', 'Like', '%'.$text.'%');
            $productCategory->orwhere('sc.pro_sc_name', 'Like', '%'.$text.'%');
            $productCategory->orwhere('products.pro_name', 'Like', '%'.$text.'%');
        }
        if ($category_id && $category_id != "") {
            $productCategory->whereIn('c.pro_mc_id', [$category_id]);
        }
        // dd($productCategory->toSql());
        $productCategory = $productCategory->get();
        $collection = new Collection();
        foreach ($productCategory as $item) {

            $collection->push((object)[
                'pro_id' => $item['pro_id'],
                'pro_name' => $item['pro_name'],
                'pro_description' => $item['pro_description'],
                'price' => $item['price'],
            ]);
        }
        $grouped = $collection->groupBy('pro_id');

        $grouped->all();
        // return the results
        return response()->json($grouped);
    }
    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function display($id)
    {

        $product = Product::where('products.pro_id',$id)
        ->Leftjoin('product_prices as pp','products.pro_id','pp.pro_id')
        ->whereDate('pp.date_to','>=',now())
        ->whereDate('pp.date_from','<=',now())
        ->get();
        // dd($product);
        $productCategory = CategoryProduct::join('products as p','p.pro_id','category_products.pro_id')
        ->Leftjoin('product_prices as pp','p.pro_id','pp.pro_id')
        ->join('categories as c','c.pro_mc_id','category_products.pro_mc_id')
        ->join('sub_categories as sc','sc.pro_sc_id','category_products.pro_sc_id')
        ->where('category_products.pro_id',$id)
        ->whereDate('pp.date_to','>=',now())
        ->whereDate('pp.date_from','<=',now())
        ->get();

        return view('contents.product.view', compact('product','productCategory'));
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
        $product = Product::where('pro_id',$id)->delete();
        return redirect()->route('product.index')->with('success', 'Record deleted successfully !');
    }
}
