<?php

namespace App\Http\Controllers;

use App\Models\SubCategory;
use Illuminate\Http\Request;

class SubCategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $sub_categories = SubCategory::paginate(10);
        return view('contents.sub_category.index', compact('sub_categories'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $sub_categories = SubCategory::get();
        return view('contents.sub_category.create', compact('sub_categories'));
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
            'pro_sc_name' => $request->pro_sc_name,
            'pro_sc_code' => $request->pro_sc_code,
            'pro_sc_short_name' => $request->pro_sc_short_name,
        ];
        $Check_sub_category = SubCategory::orwhere($data)->get();
        if(count($Check_sub_category)>0){
            return redirect()->route('sub_category.index')->with('error', 'Record allready exist !');

        }else{
            SubCategory::create($data);
            return redirect()->route('sub_category.index')->with('success', 'Record added successfully !');
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
        $sub_category = SubCategory::where('pro_sc_id',$id)->get();
        $sub_category->transform(function ($cat) {
            return [
                'pro_sc_id'=>$cat->pro_sc_id,
                'pro_sc_name'=>$cat->pro_sc_name,
                'pro_sc_code'=>$cat->pro_sc_code,
                'pro_sc_short_name'=>$cat->pro_sc_short_name,
            ];
        });
        return response()->json($sub_category[0]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $sub_category = SubCategory::where('pro_sc_id',$id)->latest()->first();
        return view('contents.sub_category.edit', compact('sub_category'));
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
        $Check_category = SubCategory::where('pro_sc_id',$id)
        ->update([
            'pro_sc_name' => $request->pro_sc_name,
            'pro_sc_code' => $request->pro_sc_code,
            'pro_sc_short_name' => $request->pro_sc_short_name,
            'status' => $request->status,
        ]);
            return redirect()->route('sub_category.index')->with('success', 'Record updated successfully !');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $sub_category = SubCategory::where('pro_sc_id',$id)->delete();
        return redirect()->route('sub_category.index')->with('success', 'Record deleted successfully !');
    }
}
