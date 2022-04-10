<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\CategoryAllocation;
use App\Models\SubCategory;
use Illuminate\Http\Request;

class CategoryAllocationController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $category_allocations = CategoryAllocation::join('categories as c','c.pro_mc_id','category_allocations.pro_mc_id')
        ->join('sub_categories as sc','sc.pro_sc_id','category_allocations.pro_sc_id')
        ->select([
            'category_allocations.id',
            'c.pro_mc_name',
            'sc.pro_sc_name',
            'category_allocations.status'
        ])
        ->paginate(10);
        // dd($category_allocations);
        return view('contents.category_sub_category_allocation.index', compact('category_allocations'));
    }

    public function load_sub_category(Request $request){
        $id = $request->id;

        $category_allocations = CategoryAllocation::join('categories as c','c.pro_mc_id','category_allocations.pro_mc_id')
        ->join('sub_categories as sc','sc.pro_sc_id','category_allocations.pro_sc_id')
        ->select([
            'category_allocations.pro_sc_id',
            'category_allocations.pro_mc_id',
            'c.pro_mc_name',
            'sc.pro_sc_name',
            'category_allocations.status'
        ])->whereIn('category_allocations.pro_mc_id',$id)->where('category_allocations.status',1)->get();
        return $category_allocations;
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $categories = Category::get();
        $sub_categories = SubCategory::get();
        return view('contents.category_sub_category_allocation.create', compact('categories','sub_categories'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $categories = $request->pro_mc_ids;
        $sub_categories = $request->pro_sc_ids;
        foreach($categories as $category){
            foreach($sub_categories as $sub_category){
                $check_category = CategoryAllocation::where('pro_mc_id',$category)->where('pro_sc_id',$sub_category)->whereNotNull('deleted_at')->latest()->first();
                if(!$check_category){
                    $allocate = new CategoryAllocation();
                    $allocate->pro_mc_id = $category;
                    $allocate->pro_sc_id = $sub_category;
                    $allocate->save();
                }
            }
        }
        return redirect()->route('category_allocation.index')->with('success', 'Record added successfully !');
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
        $category_allocations = CategoryAllocation::join('categories as c','c.pro_mc_id','category_allocations.pro_mc_id')
        ->join('sub_categories as sc','sc.pro_sc_id','category_allocations.pro_sc_id')
        ->select([
            'category_allocations.id',
            'c.pro_mc_name',
            'sc.pro_sc_name',
            'category_allocations.status'
        ])->where('category_allocations.id',$id)->get();
        return view('contents.category_sub_category_allocation.edit', compact('category_allocations'));
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
        $Check_category = CategoryAllocation::where('id',$id)
        ->update([
            'status' => $request->status,
        ]);
            return redirect()->route('category_allocation.index')->with('success', 'Record updated successfully !');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $category_allocation = CategoryAllocation::where('id',$id)->delete();
        return redirect()->route('category_allocation.index')->with('success', 'Record deleted successfully !');
    }
}
