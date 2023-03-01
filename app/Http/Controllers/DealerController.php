<?php

namespace App\Http\Controllers;

use App\Models\Dealer;
use App\Models\User;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;
use App\Imports\ImportOder;
use Yajra\DataTables\DataTables;
use App\Exports\ExportOrder;
use App\Exports\ExportSingleOrder;
use App\Models\Product;
use Illuminate\Support\Facades\DB;

class DealerController extends Controller
{

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function __construct(Request $request)
    {
        $this->middleware('permission:dealer-list|dealer-create|dealer-edit|dealer-delete', ['only' => ['index', 'show']]);
        $this->middleware('permission:dealer-create', ['only' => ['create', 'store']]);
        $this->middleware('permission:dealer-delete', ['only' => ['destroy']]);
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $data = Dealer::OrderBy('id', 'DESC')->paginate(500);
        return view('contents.dealer.index', compact('data'))
            ->with('i', ($request->input('page', 1) - 1) * 5);
    }
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function getOrderDetails(Request $request)
    {
        $data = Dealer::find($request->id);
        return $data;
    }
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('contents.dealer.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $requestCreate['service_dealer'] = $request['service_dealer'];
        $requestCreate['contact_person'] = $request['contact_person'];
        $requestCreate['phone'] = $request['phone'];
        $requestCreate['address'] = $request['address'];
        $requestCreate['district'] = $request['district'];
        $requestCreate['description'] = $request['description'];

        $order = Dealer::create($requestCreate);

        return redirect()->route('dealer.index')
            ->with('success', 'Dealer created successfully');
    }

   /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $dealer = Dealer::where('id',decrypt($id))->latest()->first();
        return view('contents.dealer.show', compact('dealer'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $dealer = Dealer::where('id',$id)->latest()->first();
        return view('contents.dealer.edit', compact('dealer'));
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

        $requestCreate['service_dealer'] = $request['service_dealer'];
        $requestCreate['contact_person'] = $request['contact_person'];
        $requestCreate['phone'] = $request['phone'];
        $requestCreate['address'] = $request['address'];
        $requestCreate['district'] = $request['district'];
        $requestCreate['description'] = $request['description'];
        $order = Dealer::where('id',$id)->update($requestCreate);

        return redirect()->route('dealer.index')
            ->with('success', 'Dealer updated successfully');

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $dealer = Dealer::where('id',$id)->delete();
        return redirect()->route('dealer.index')->with('success', 'Record deleted successfully !');
    }

    public function import(Request $request){
        DB::beginTransaction();
                try {
        if(isset($request->file)){
            $headers = ['Service Dealer','Contact Person','Address','District','Contact no'];
            $csv_data = CsvImportController::import_csv($request,$headers);
            if(!empty($csv_data)){
                foreach ($csv_data as $key => $value) {
                    $street = str_replace('±', '', $value['Address']);
                    $order = Dealer::create([
                        'service_dealer' => $value['Service Dealer'],
                        'contact_person' => $value['Contact Person'],
                        'address' => $street,
                        'district' => $value['District'],
                        'phone' => str_replace("p:","",$value['Contact no']),
                    ]);
                }

            }
        }

        DB::commit();
        return redirect()->back()->with('success', 'Dealer uploaded successfully');;
        } catch (\Exception $e) {
            // dd($e);
            // something went wrong
            DB::rollback();
        }
    }



}
