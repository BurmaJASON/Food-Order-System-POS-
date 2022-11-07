@extends('user.layout.master')


@section('content')
<!-- Breadcrumb Start -->
{{-- <div class="container-fluid">
    <div class="row px-xl-5">
        <div class="col-12">
            <nav class="breadcrumb bg-light mb-30">
                <a class="breadcrumb-item text-dark" href="#">Home</a>
                <a class="breadcrumb-item text-dark" href="#">Shop</a>
                <span class="breadcrumb-item active">Shopping Cart</span>
            </nav>
        </div>
    </div>
</div> --}}
<!-- Breadcrumb End -->

<!-- Cart Start -->
<div class="container-fluid" style="height: 400px">
    <div class="row px-xl-5">
        <div class="col-lg-8 offset-2 table-responsive mb-5">
            <table class="table table-light table-borderless table-hover text-center mb-0" id="dataTable">
                <thead class="thead-dark">
                    <tr id="header">
                        <th>Date</th>
                        <th>Order ID</th>
                        <th>Total Price</th>
                        <th>Status</th>
                    </tr>
                </thead>
                <tbody class="align-middle">
                    @foreach($orders as $order)
                    <tr>
                        <td class="align-middle">{{ $order->created_at->format('j-F-Y') }}</td>
                        <td class="align-middle">{{ $order->order_code }}</td>
                        <td class="align-middle">{{ $order->total_price }}</td>
                        <td class="align-middle">
                            @if($order->status == 0)
                                <span class="text-primary " disabled> <i class="fa-solid fa-clock me-1"></i> Pending...</span>
                            @elseif($order->status == 1)
                                <span class="text-success " disabled> <i class="fa-solid fa-check me-1"></i> Success...</span>
                            @elseif($order->status == 2)
                                <span class="text-danger " disabled> <i class="fa-solid fa-triangle-exclamation me-1"></i> Rejected...</span>
                            @endif
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
            <div class="mt-3">
                {{ $orders->links() }}
            </div>
        </div>
    </div>
</div>
<!-- Cart End -->
@endsection





