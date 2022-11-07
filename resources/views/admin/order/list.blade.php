@extends('admin.layouts.master')
@section('title','Category List')

@section('content')
<!-- MAIN CONTENT-->
<div class="main-content">
    <div class="section__content section__content--p30">
        <div class="container-fluid">
            <div class="col-md-12">
                <!-- DATA TABLE -->
                <div class="table-data__tool">
                    <div class="table-data__tool-left">
                        <div class="overview-wrap">
                            <h2 class="title-1">Order List</h2>

                        </div>
                    </div>
                </div>

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
                        <h3><i class="fa-solid fa-database me-2"></i>{{ count($orders) }}</h3>
                    </div>
                </div> --}}

                <form action="{{ route('admin#changeStatus') }}" method="get" class="col-5 offset-7">
                    @csrf
                    <div class="input-group mb-3" >
                        <div class="input-group-append">
                            <span class="input-group-text">
                                <i class="fa-solid fa-database me-2"></i>{{ count($orders) }}
                            </span>
                        </div>
                        <select name="orderStatus" class="custom-select  form-control" id="inputGroupSelect02">
                            <option value="">All</option>
                            <option value="0" @if (request('orderStatus')=="0")
                                selected
                            @endif>Pending</option>
                            <option value="1" @if (request('orderStatus')=="1")
                                 selected
                            @endif>Accept</option>
                            <option value="2" @if (request('orderStatus')=="2")
                                selected
                            @endif>Reject</option>
                        </select>
                        <div class="input-group-append">
                            <button type="submit" class="input-group-text btn sm btn-dark">
                                Search
                            </button>
                        </div>

                    </div>
                </form>




                @if(count($orders) != 0)
                    <div class="table-responsive table-responsive-data2">
                        <table class="table table-data2 text-center">
                            <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>User Name</th>
                                    <th>Order Date</th>
                                    <th>Order Code</th>
                                    <th>Amount</th>
                                    <th>Status</th>
                                </tr>
                            </thead>
                            <tbody id="dataList">
                                @foreach($orders as $order)
                                <tr class="tr-shadow">
                                    <td class="orderId">{{ $order->id }}</td>
                                    <td>{{ $order->user_name }}</td>
                                    <td>{{ $order->created_at->format('M-j-Y') }}</td>
                                    <td>
                                        <a href="{{ route('admin#listInfo',$order->order_code) }}" >{{ $order->order_code }}</a>
                                    </td>
                                    <td >{{ $order->total_price }} MMks</td>
                                    <td>
                                        <select name="status" class="form-control statusChange" >
                                            <option value="0"  @if ($order->status == 0) selected  @endif>Pending</option>
                                            <option value="1" @if ($order->status == 1) selected  @endif>Accept</option>
                                            <option value="2" @if ($order->status == 2) selected  @endif>Reject</option>
                                        </select>
                                    </td>

                                </tr>
                                @endforeach


                            </tbody>
                        </table>
                        <div class="mt-3">
                            {{-- {{ $orders->links() }} --}}

                            {{-- {{ $categories->appends(request()->query())->links() }} --}}
                        </div>
                    </div>
                @else
                    <h1 class="text-center text-secondary mt-5">There is no Order Here!</h1>
                @endif

                <!-- END DATA TABLE -->
            </div>
        </div>
    </div>
</div>
<!-- END MAIN CONTENT-->
@endsection

@section('scriptSection')
<script>
    $(document).ready(function(){
        // $('#OrderStatus').change(function(){
        //     $status = $('#OrderStatus').val();
        //     console.log($status);
        //     $.ajax({
        //         type:'get',
        //         url: "http://127.0.0.1:8000/order/ajaxStatus",
        //         data:{
        //             'status': $status,
        //         },
        //         dataType: 'json',
        //         success: function(response){
        //             //append
        //             $list = '';
        //                 for($i =0; $i < response.length ;$i++){

        //                     $months = ['Jan','Feb','Mar','Apr','May','Jun','Jul','Aug','Sept','Oct','Nov','Dec'];
        //                     $dbDate = new Date(response[$i].created_at);
        //                     $finalDate = $months[$dbDate.getMonth()]+"-"+$dbDate.getDate()+"-"+$dbDate.getFullYear()

        //                     if(response[$i].status == 0){
        //                         $statusMessage = `
        //                                         <select name="status" class="form-control statusChange" >
        //                                             <option value="0" selected>Pending</option>

        //                                             <option value="1">Accept</option>

        //                                             <option value="2">Reject</option>

        //                                         </select>
        //                                         `
        //                     }else if(response[$i].status == 1){
        //                         $statusMessage = `
        //                                         <select name="status" class="form-control statusChange" >
        //                                             <option value="0" >Pending</option>

        //                                             <option value="1" selected>Accept</option>

        //                                             <option value="2">Reject</option>

        //                                         </select>
        //                                         `
        //                     }else if(response[$i].status == 2){
        //                         $statusMessage = `
        //                                         <select name="status" class="form-control statusChange" >
        //                                             <option value="0" >Pending</option>

        //                                             <option value="1" >Accept</option>

        //                                             <option value="2" selected>Reject</option>

        //                                         </select>
        //                                         `
        //                     }

        //                 $list += `
        //                         <tr class="tr-shadow">
        //                             <td class="orderId">${response[$i].id} </td>
        //                             <td>${response[$i].user_name} </td>
        //                             <td>${$finalDate} </td>
        //                             <td>${response[$i].order_code} </td>
        //                             <td>${response[$i].total_price} MMks </td>
        //                             <td>${$statusMessage}</td>
        //                         </tr>
        //                 `;
        //                 };
        //                 $('#dataList').html($list);
        //             // console.log(response);
        //         }
        //     });


        // });
        //change status
        $('.statusChange').change(function(){
            $parentNode = $(this).parents('tr');
            $currentStatus = $(this).val();
            $orderId = $parentNode.find('.orderId').html()
            $data ={
                'status' : $currentStatus,
                'orderId': $orderId,
            };
            console.log($data);
            $.ajax({
                type: 'get',
                url: '/order/ajax/change/status',
                data: $data,
                dataType: 'json',

            })
            // window.location.href = "http://127.0.0.1:8000/order/list";

        })

    })
</script>
@endsection
