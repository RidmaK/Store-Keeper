@extends('dashboard.dashboard')

@section('mainContent')
<div class="container-fluid py-4">
    <div class="row p-3 pt-2">
        <div class="col-xl-3 col-sm-6 mb-xl-0 mb-3">
            <div class="card z-index-2 ">
              <div class="card-header p-0 position-relative mt-n4 mx-3 z-index-2 bg-transparent">
                <div class="bg-gradient-info shadow-info border-radius-lg py-3 pe-1">
                    <center><h5 style="color: black">Customers</h5></center>
                </div>
              </div>
              <div class="card-body">
                <center><p class="mb-0 ">Selling <strong class=" ">{{ $sellings }}</strong></p>

                    <p class="mb-0 ">Buying <strong class=" ">{{ $buyings }}</strong></p></center>
                    <hr class="dark horizontal">
              </div>
            </div>
          </div>
          <div class="col-xl-3 col-sm-6 mb-xl-0 mb-3">
            <div class="card z-index-2 ">
              <div class="card-header p-0 position-relative mt-n4 mx-3 z-index-2 bg-transparent">
                <div class="bg-gradient-primary shadow-primary border-radius-lg py-3 pe-1">
                    <center><h5 style="color: black">Employees</h5></center>
                </div>
              </div>
              <div class="card-body">
                <center><h2 class="mb-0 ">{{ $users }}</h2></center>
                <hr class="dark horizontal">
              </div>
            </div>
          </div>
          @php
              $totSales = (float)$sales['price_recondition'] + (float)$sales['price_reusable'];
              $totBuy = (float)$buying['price_recondition'] + (float)$buying['price_reusable'];
          @endphp
          <div class="col-xl-3 col-sm-6 mb-xl-0 mb-3">
            <div class="card z-index-2  ">
              <div class="card-header p-0 position-relative mt-n4 mx-3 z-index-2 bg-transparent">
                <div class="bg-gradient-success shadow-success border-radius-lg py-3 pe-1">
                    <center><h5 style="color: black">Profit</h5></center>
                </div>
              </div>
              <div class="card-body">
                <h6 class="mb-0 "> Daily Profit </h6>
                <p class="text-sm "> (<span class="font-weight-bolder">
                    {{ $totSales - $totBuy }} LKR
                </span>) increase in sales. </p>
                <hr class="dark horizontal">
              </div>
            </div>
          </div>
          <div class="col-xl-3 col-sm-6 mb-xl-0 mb-3">
            <div class="card z-index-2  ">
              <div class="card-header p-0 position-relative mt-n4 mx-3 z-index-2 bg-transparent">
                <div class="bg-gradient-danger shadow-danger border-radius-lg py-3 pe-1">
                    <center><h5 style="color: black">Sales</h5></center>
                </div>
              </div>
              <div class="card-body">
                <h6 class="mb-0 "> Daily Sales </h6>
                <p class="text-sm "> (<span class="font-weight-bolder">
                    {{ $totSales }} LKR
                </span>) increase in sales. </p>
                <hr class="dark horizontal">
              </div>
            </div>
          </div>
    </div>
    <div class="row p-3 pt-2">

        <div class="col-xl-3 col-sm-6 mb-xl-0 mb-3">
            <div class="card p-3 pt-2">
                <div class="icon icon-lg icon-shape bg-gradient-dark shadow-dark text-center border-radius-xl mt-n4 position-absolute">
                <i class="material-icons opacity-10">weekend</i>
                </div>
                <div class="card-header p-3 pt-2">
                    <div class="card-body p-3 pt-2">
                        <div class="text-end pt-1">
                        <h4 class="mb-0">Today</h4>
                        </div>
                    </div>
                </div>
                @foreach ($stockDay as $stock)
                    <div class="card-body p-3 pt-2">
                        <div class=" pt-1">
                        <p class="text-sm mb-0 text-capitalize">{{ $categories[$stock->category] }}</p>
                        <h4 class="mb-0">{{ (float)$stock->weight_recondition + (float)$stock->weight_reusable  }} Kg</h4>
                        </div>
                    </div>
                    <hr class="dark horizontal my-0">
                @endforeach
            </div>
        </div>
        <div class="col-xl-3 col-sm-6 mb-xl-0 mb-3">
            <div class="card p-3 pt-2" >
                <div class="icon icon-lg icon-shape bg-gradient-dark shadow-dark text-center border-radius-xl mt-n4 position-absolute">
                <i class="material-icons opacity-10">apartment</i>
                </div>
                <div class="card-header p-3 pt-2">
                    <div class="card-body p-3 pt-2">
                        <div class="text-end pt-1">
                        <h4 class="mb-0">Overalls</h4>
                        </div>
                    </div>
                </div>
                @foreach ($stocks as $stock)
                    <div class="card-body p-3 pt-2">
                        <div class=" pt-1">
                        <p class="text-sm mb-0 text-capitalize">{{ $categories[$stock->category] }}</p>
                        <h4 class="mb-0">{{ (float)$stock->weight_recondition + (float)$stock->weight_reusable  }} Kg</h4>
                        </div>
                    </div>
                    <hr class="dark horizontal my-0">
                @endforeach
            </div>
        </div>
    </div>
  </div>
@endsection
