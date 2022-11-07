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
<div class="container-fluid">
    <div class="row px-xl-5">
        <div class="col-lg-8 table-responsive mb-5">
            <table class="table table-light table-borderless table-hover text-center mb-0" id="dataTable">
                <thead class="thead-dark">
                    <tr id="header">
                        <th></th>
                        <th>Products</th>
                        <th>Price</th>
                        <th>Quantity</th>
                        <th>Total</th>
                        <th>Remove</th>
                    </tr>
                </thead>
                <tbody class="align-middle">
                    @foreach ($cartList as $cart)
                    <tr>
                        {{-- <input type="hidden" value="{{ $cart->pizza_price }}" id="price"> --}}
                        <td class="align-middle"><img src="{{ asset('storage/'.$cart->product_image) }}" alt="" style="width: 50px;" class=" shadow"></td>
                        <td class="align-middle">
                            {{ $cart->pizza_name }}
                            <input type="hidden" class="productId" value="{{ $cart->product_id }}">
                            <input type="hidden" class="userId" value="{{ $cart->user_id }}">
                        </td>
                        <td class="align-middle" id="price">{{ $cart->pizza_price }}MMks</td>
                        <td class="align-middle">
                            <div class="input-group quantity mx-auto" style="width: 100px;">
                                <div class="input-group-btn">
                                    <button class="btn btn-sm btn-primary btn-minus" >
                                    <i class="fa fa-minus"></i>
                                    </button>
                                </div>
                                <input type="text" class="form-control form-control-sm bg-secondary border-0 text-center" value="{{ $cart->qty }}"  id="qty">
                                <div class="input-group-btn">
                                    <button class="btn btn-sm btn-primary btn-plus">
                                        <i class="fa fa-plus"></i>
                                    </button>
                                </div>
                            </div>
                        </td>

                        <td class="align-middle" id="total"> {{ $cart->pizza_price * $cart->qty }}MMks</td>
                        <td class="align-middle">
                            <a href="{{ route('user#clearItem',$cart->id) }}">
                                <button class="btn btn-sm btn-danger btnRemove"><i class="fa fa-times"></i></button>
                            </a>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        <div class="col-lg-4">
            <h5 class="section-title position-relative text-uppercase mb-3"><span class="bg-secondary pr-3">Cart Summary</span></h5>
            <div class="bg-light p-30 mb-5">
                <div class="border-bottom pb-2">
                    <div class="d-flex justify-content-between mb-3">
                        <h6>Subtotal</h6>
                        <h6 id="subTotalPrice">{{ $totalPrice }} MMks</h6>
                    </div>
                    @if(count($cartList) != 0)
                    <div class="d-flex justify-content-between">
                        <h6 class="font-weight-medium">Deliver</h6>
                        <h6 class="font-weight-medium">3000 MMks</h6>
                    </div>
                    @else
                    <div class="d-flex justify-content-between">
                        <h6 class="font-weight-medium">Deliver</h6>
                        <h6 class="font-weight-medium">0 MMks</h6>
                    </div>
                    @endif

                </div>
                <div class="pt-2">
                    <div class="d-flex justify-content-between mt-2">
                        <h5>Total</h5>
                        @if(count($cartList) != 0)
                            <h5 id="finalPrice">{{ $totalPrice + 3000 }} MMks</h5>
                        @else
                            <h5 id="finalPrice">{{ $totalPrice }} MMks</h5>
                        @endif
                    </div>
                    <button id="orderBtn" class="btn btn-block btn-primary font-weight-bold my-3 py-3">
                        Proceed To Checkout
                    </button>
                    @if(count($cartList) != 0)
                    <button id="clearBtn" class="btn btn-block btn-danger font-weight-bold my-3 py-3">
                        Clear Cart
                    </button>
                    @endif

                </div>
            </div>
        </div>
    </div>
</div>
<!-- Cart End -->
@endsection


@push('scriptSource')
<script src="{{ asset('js/cart.js') }}"></script>
<script>
    $('#orderBtn').click(function(){

        $orderList = [];
        $random = Math.floor(Math.random() * 10000001);
        $userId = $(".userId").val();
        $("#dataTable tr:not('#header')").each(function(index,row){
            $orderList.push({
                'user_id' : $userId,
                'product_id' : $(row).find('.productId').val(),
                'qty' : $(row).find('#qty').val(),
                'total' :Number($(row).find('#total').text().replace('MMks','')),
                'order_code' : 'POS'+ $userId + $random,
            });
        });

        $.ajax({
            type: 'get',
            url : '/user/ajax/order',
            data : Object.assign({},$orderList),
            dataType : 'json',
            success : function(response){
                if(response.message == 'order completed'){
                    window.location.href = "/user/home";
                }
            }
        });
    });

    //when clear button click
    $('#clearBtn').click(function(){
        $('#dataTable tbody  tr').remove();
        $('#subTotalPrice').html('0 MMKs');
        $('#finalPrice').html('0 MMks');

        $.ajax({
            type: 'get',
            url : '/user/ajax/clear/cart',
            dataType : 'json',
            success : function(response){
                if(response.message == 'order completed'){
                    window.location.href = "/user/cart/list";
                }
            }
        });
    });
</script>
@endpush





