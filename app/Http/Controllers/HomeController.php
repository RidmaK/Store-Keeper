<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Customer;
use App\Models\Product;
use App\Models\Stock;
use App\Models\User;
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
    $currentDate = now()->format('Y-m-d');
      $data['stocks'] = Stock::get();
      $data['buying'] = Customer::where('customer_type',1)->count();
      $data['selling'] = Customer::where('customer_type',2)->count();
      $data['users'] = User::count();
      $data['stockDay'] = Product::whereDate('created_at',$currentDate)->groupBy('category')
            ->selectRaw('sum(weight_recondition) as weight_recondition,sum(weight_reusable) as weight_reusable, category')
            ->get();
      $data['categories'] = Category::pluck('name','id')->toArray();
        return view('contents.index',$data);
    }
}
