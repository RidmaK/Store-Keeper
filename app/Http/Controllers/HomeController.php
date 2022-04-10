<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Product;
use App\Models\SubCategory;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $categories = Category::get();
        $sub_categories = SubCategory::get();

        $productCategory = Product::join('category_products as cp','products.pro_id','cp.pro_id')
        ->Leftjoin('product_prices as pp','products.pro_id','pp.pro_id')
        ->join('categories as c','c.pro_mc_id','cp.pro_mc_id')
        ->join('sub_categories as sc','sc.pro_sc_id','cp.pro_sc_id')
        ->whereDate('pp.date_to','>=',now())
        ->whereDate('pp.date_from','<=',now())
        ->get();

        $collection = new Collection();
        foreach ($productCategory as $item) {

            $collection->push((object)[
                'pro_id' => $item['pro_id'],
                'pro_name' => $item['pro_name'],
                'pro_description' => $item['pro_description'],
                'price' => $item['price'],
                'url' => $item['url'],
            ]);
        }
        $productCategories = $collection->groupBy('pro_id');

        $productCategories->all();
        return view('home',compact('productCategories','categories','sub_categories'));
    }
}
