@extends('admin.layouts.master')
@section('title','Category List')

@section('content')
<!-- MAIN CONTENT-->
<div class="main-content">
    <div class="section__content section__content--p30">
        <div class="container-fluid">
            <div class="col-md-12">
                <!-- DATA TABLE -->
                {{-- <div class="table-data__tool">
                    <div class="table-data__tool-left">
                        <div class="overview-wrap">
                            <h2 class="title-1">Ordered Products</h2>

                        </div>
                    </div>
                </div> --}}

                {{-- Product Create Success --}}
                {{-- @if (session('createSuccess'))
                <div class="col-6 offset-6">
                    <div class="alert alert-success alert-dismissible fade show" role="alert">
                        <i class="fa-solid fa-check"></i> {{ session('createSuccess') }}
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                      </div>
                </div>
                @endif --}}

                {{-- Product Delete Success --}}
                {{-- @if (session('deleteSuccess'))
                <div class="col-6 offset-6">
                    <div class="alert alert-warning alert-dismissible fade show" role="alert">
                        <i class="fa-solid fa-circle-xmark"></i> {{ session('deleteSuccess') }}
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                      </div>
                </div>
                @endif --}}

                {{-- <div class="row mt-3">
                    <div class="col-1 offset-10 bg-white shadow-sm text-center  p-2">
                        <h3><i class="fa-solid fa-database me-2"></i>{{ count($orderLists) }}</h3>
                    </div>
                </div> --}}

                {{-- @if(count($pizzas) != 0) --}}
                    <div class="table-responsive table-responsive-data2">
                        <a href="{{ route('admin#orderList') }}" class="text-dark">
                            <i class="fa-solid fa-arrow-left-long"></i>Back
                        </a>
                        <div class="row col-6 card mt-3 rounded">
                            <div class="card-header">
                                <h3><i class="fa-solid fa-clipboard me-2"></i> Order Info</h3>
                            </div>
                            <div class="card-body">
                                <div class="row my-1">
                                    <div class="col">
                                        <i class="fa-solid fa-user me-1"></i> Customer Name :
                                    </div>
                                    <div class="col">
                                       {{ strtoupper($orderLists[0]->user_name) }}
                                    </div>
                                </div>
                                <div class="row my-1">
                                    <div class="col">
                                        <i class="fa-solid fa-barcode me-1"></i> Order Code :
                                    </div>
                                    <div class="col">
                                        {{ strtoupper($orderLists[0]->order_code) }}
                                    </div>
                                </div>
                                <div class="row my-1">
                                    <div class="col">
                                        <i class="fa-regular fa-clock me-1 "></i> Order Date :
                                    </div>
                                    <div class="col">
                                        {{ strtoupper($orderLists[0]->created_at->format('M-j-Y')) }}
                                    </div>
                                </div>
                                <div class="row my-1">
                                    <div class="col">
                                        <i class="fa-solid fa-truck me-1"></i> Deli Fee :
                                    </div>
                                    <div class="col">
                                        3000 MMks
                                    </div>
                                </div>
                                <div class="row my-1">
                                    <div class="col">
                                        <i class="fa-solid fa-money-bill-wave me-1 "></i>Total :
                                    </div>
                                    <div class="col">
                                        {{ $order->total_price }} MMks
                                    </div>
                                </div>
                            </div>
                        </div>
                        <table class="table table-data2 text-center">
                            <thead>
                                <tr>
                                    <th>Product Image</th>
                                    <th>Product Name</th>
                                    <th>Order Date</th>
                                    <th>Qty</th>
                                    <th>Amount</th>
                                </tr>
                            </thead>
                            <tbody id="dataList">
                                @foreach($orderLists as $orderList)
                                <tr class="tr-shadow">
                                    <td class="col-2">
                                        <img src="{{ asset('storage/'.$orderList->product_image) }}" class="img-thumbnail shadow-sm " alt="">
                                    </td>
                                    <td >{{ $orderList->product_name }}</td>
                                    <td >{{ $orderList->created_at->format('M-j-Y') }}</td>
                                    <td >{{ $orderList->qty }}</td>
                                    <td >{{ $orderList->total}} MMks</td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                        <div class="mt-3">
                            {{-- {{ $orders->links() }} --}}

                            {{-- {{ $categories->appends(request()->query())->links() }} --}}
                        </div>
                    </div>
                {{-- @else
                    <h1 class="text-center text-secondary mt-5">There is no Pizza Here!</h1>
                @endif --}}

                <!-- END DATA TABLE -->
            </div>
        </div>
    </div>
</div>
<!-- END MAIN CONTENT-->
@endsection

