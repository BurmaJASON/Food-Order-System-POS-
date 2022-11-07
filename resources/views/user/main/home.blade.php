@extends('user.layout.master')


@section('content')
 <!-- Shop Start -->
 <div class="container-fluid">
    <div class="row px-xl-5">
        <!-- Shop Sidebar Start -->
        <div class="col-lg-3 col-md-4">
            <!-- Price Start -->
            <h5 class="section-title position-relative text-uppercase mb-3"><span class="bg-secondary pr-3">Filter by category</span></h5>
            <div class="bg-light p-4 mb-30">
                <form>
                    <div class="bg-dark text-white px-3 py-1 d-flex align-items-center justify-content-between mb-3">
                        <label class="mt-2" for="price-all">Pizza Categories</label>
                        <span class="badge border font-weight-normal ">{{ count($categories) }}</span>
                    </div>
                    <a href="{{ route('user#home') }}" class="text-dark">
                        <div class=" d-flex align-items-center justify-content-between mb-3 shadow-sm px-2">
                            <label class="" for="price-1">All Items</label>
                            {{-- <span class="badge border font-weight-normal">150</span> --}}
                        </div>
                    </a>
                    @foreach ($categories as $category)
                    <a href="{{ route('user#filter',$category->id ) }}" class="text-dark">
                        <div class=" d-flex align-items-center justify-content-between mb-3 shadow-sm px-2">
                            <label class="" for="price-1">{{ $category->name }}</label>
                            {{-- <span class="badge border font-weight-normal">150</span> --}}
                        </div>
                    </a>

                    @endforeach

                </form>
            </div>
            <!-- Price End -->

            <!-- Color Start -->
            {{-- <h5 class="section-title position-relative text-uppercase mb-3"><span class="bg-secondary pr-3">Filter by color</span></h5>
            <div class="bg-light p-4 mb-30">
                <form>
                    <div class="custom-control custom-checkbox d-flex align-items-center justify-content-between mb-3">
                        <input type="checkbox" class="custom-control-input" checked id="color-all">
                        <label class="custom-control-label" for="price-all">All Color</label>
                        <span class="badge border font-weight-normal text-dark">1000</span>
                    </div>
                    <div class="custom-control custom-checkbox d-flex align-items-center justify-content-between mb-3">
                        <input type="checkbox" class="custom-control-input" id="color-1">
                        <label class="custom-control-label" for="color-1">Black</label>
                        <span class="badge border font-weight-normal text-dark">150</span>
                    </div>
                    <div class="custom-control custom-checkbox d-flex align-items-center justify-content-between mb-3">
                        <input type="checkbox" class="custom-control-input" id="color-2">
                        <label class="custom-control-label" for="color-2">White</label>
                        <span class="badge border font-weight-normal text-dark">295</span>
                    </div>
                    <div class="custom-control custom-checkbox d-flex align-items-center justify-content-between mb-3">
                        <input type="checkbox" class="custom-control-input" id="color-3">
                        <label class="custom-control-label" for="color-3">Red</label>
                        <span class="badge border font-weight-normal text-dark">246</span>
                    </div>
                    <div class="custom-control custom-checkbox d-flex align-items-center justify-content-between mb-3">
                        <input type="checkbox" class="custom-control-input" id="color-4">
                        <label class="custom-control-label" for="color-4">Blue</label>
                        <span class="badge border font-weight-normal text-dark">145</span>
                    </div>
                    <div class="custom-control custom-checkbox d-flex align-items-center justify-content-between">
                        <input type="checkbox" class="custom-control-input" id="color-5">
                        <label class="custom-control-label" for="color-5">Green</label>
                        <span class="badge border font-weight-normal text-dark">168</span>
                    </div>
                </form>
            </div> --}}
            <!-- Color End -->

            <!-- Size Start -->
            {{-- <h5 class="section-title position-relative text-uppercase mb-3"><span class="bg-secondary pr-3">Filter by size</span></h5>
            <div class="bg-light p-4 mb-30">
                <form>
                    <div class="custom-control custom-checkbox d-flex align-items-center justify-content-between mb-3">
                        <input type="checkbox" class="custom-control-input" checked id="size-all">
                        <label class="custom-control-label" for="size-all">All Size</label>
                        <span class="badge border font-weight-normal text-dark">1000</span>
                    </div>
                    <div class="custom-control custom-checkbox d-flex align-items-center justify-content-between mb-3">
                        <input type="checkbox" class="custom-control-input" id="size-1">
                        <label class="custom-control-label" for="size-1">XS</label>
                        <span class="badge border font-weight-normal text-dark">150</span>
                    </div>
                    <div class="custom-control custom-checkbox d-flex align-items-center justify-content-between mb-3">
                        <input type="checkbox" class="custom-control-input" id="size-2">
                        <label class="custom-control-label" for="size-2">S</label>
                        <span class="badge border font-weight-normal text-dark">295</span>
                    </div>
                    <div class="custom-control custom-checkbox d-flex align-items-center justify-content-between mb-3">
                        <input type="checkbox" class="custom-control-input" id="size-3">
                        <label class="custom-control-label" for="size-3">M</label>
                        <span class="badge border font-weight-normal text-dark">246</span>
                    </div>
                    <div class="custom-control custom-checkbox d-flex align-items-center justify-content-between mb-3">
                        <input type="checkbox" class="custom-control-input" id="size-4">
                        <label class="custom-control-label" for="size-4">L</label>
                        <span class="badge border font-weight-normal text-dark">145</span>
                    </div>
                    <div class="custom-control custom-checkbox d-flex align-items-center justify-content-between">
                        <input type="checkbox" class="custom-control-input" id="size-5">
                        <label class="custom-control-label" for="size-5">XL</label>
                        <span class="badge border font-weight-normal text-dark">168</span>
                    </div>
                </form>
            </div>
            <div class="">
                <button class="btn btn btn-warning w-100">Order</button>
            </div> --}}
            <!-- Size End -->
        </div>
        <!-- Shop Sidebar End -->


        <!-- Shop Product Start -->
        <div class="col-lg-9 col-md-8">
            <div class="row pb-3">
                @if (session('sendSuccess'))
                <div class="col-6 offset-6">
                    <div class="alert alert-success alert-dismissible fade show" role="alert">
                        <i class="fa-solid fa-check"></i> {{ session('sendSuccess') }}
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                      </div>
                </div>
                @endif
                <div class="col-12 pb-1">
                    <div class="d-flex align-items-center justify-content-between mb-4">
                        <div>
                            <a href="{{ route('user#cartList') }}">
                                <button type="button" class="btn btn-dark rounded position-relative">
                                    <i class="fa-solid fa-cart-shopping  "></i>
                                    <span class="position-absolute top-0 start-100 translate-middle badge rounded-pill bg-danger">
                                        {{ count($cart) }}
                                    </span>
                                    </button>
                                </button>
                            </a>
                            <a href="{{ route('user#history') }}" class="ms-3">
                                <button type="button" class="btn btn-dark rounded position-relative">
                                    <i class="fa-solid fa-clock-rotate-left me-2  "></i>History
                                    <span class="position-absolute top-0 start-100 translate-middle badge rounded-pill bg-danger">
                                        {{ count($orders) }}
                                    </span>
                                    </button>
                                </button>
                            </a>
                        </div>
                        <div class="ml-2">
                            <div class="btn-group">
                                <select name="sorting" id="sortingOptions"  class="form-control">
                                    <option >Sorting</option>
                                    <option value="new">Newest</option>
                                    <option value="old">Oldest</option>
                                </select>
                            </div>
                        </div>
                    </div>
                </div>

                <span id="dataList" class="row">
                    @if (count($pizzas) != 0)
                        @foreach ($pizzas as $pizza)
                            <div class="col-lg-4 col-md-6 col-sm-6 pb-1" >
                                <div class="product-item bg-light mb-4" id="myForm" >
                                    <div class="product-img position-relative overflow-hidden">
                                        <img class="img-fluid w-100" src="{{ asset('storage/'.$pizza->image) }}" alt="" style="height:190px">
                                        <div class="product-action">
                                            {{-- <a class="btn btn-outline-dark btn-square" href=""><i class="fa fa-shopping-cart"></i></a> --}}
                                            <a class="btn btn-outline-dark btn-square" href="{{ route('user#pizzaDetails',$pizza->id) }}"  title="Detail"><i class="fa fa-circle-info"></i></a>
                                        </div>
                                    </div>
                                    <div class="text-center py-4">
                                        <a class="h6 text-decoration-none text-truncate" href="{{ route('user#pizzaDetails',$pizza->id) }}">{{ $pizza->name }}</a>
                                        <div class="d-flex align-items-center justify-content-center mt-2">
                                            <h5>{{ $pizza->price }} mmk</h5>
                                                {{-- <h6 class="text-muted ml-2"><del>25000</del></h6> --}}
                                        </div>
                                    </div>
                                </div>
                            </div>


                        @endforeach

                    @else
                        <h2 class="text-center shadow-sm mt-5 col-6 offset-3 py-3">
                            <i class="fa-solid fa-pizza-slice me-2"></i>
                            There is No Pizza!
                        </h2>
                    @endif
                </span>



            </div>
        </div>
        <!-- Shop Product End -->
    </div>
</div>
<!-- Shop End -->

@endsection

@push('scriptSource')
<script>
    $(document).ready(function(){

        // $sortingOptions = $('#sortingOptions').val();
        $('#sortingOptions').change(()=>{
            $eventOption = $('#sortingOptions').val();

            if($eventOption == 'new'){
                $.ajax({
                    type : 'get',
                    url : '/user/ajax/pizzaList',
                    data : {'status' : 'new'},
                    dataType : 'json',
                    success : function(response){
                        $list = '';
                        for($i =0; $i < response.length ;$i++){
                        $list += `
                            <div class="col-lg-4 col-md-6 col-sm-6 pb-1" >
                                <div class="product-item bg-light mb-4" id="myForm">
                                    <div class="product-img position-relative overflow-hidden">
                                        <img class="img-fluid w-100" src="{{ asset('storage/${response[$i].image}') }}" alt="" style="height: 200px">
                                        <div class="product-action">
                                            <a class="btn btn-outline-dark btn-square" href=""><i class="fa fa-shopping-cart"></i></a>
                                            <a class="btn btn-outline-dark btn-square" href=""><i class="fa fa-circle-info"></i></a>
                                        </div>
                                    </div>
                                    <div class="text-center py-4">
                                        <a class="h6 text-decoration-none text-truncate" href="">${response[$i].name}</a>
                                        <div class="d-flex align-items-center justify-content-center mt-2">
                                            <h5>${response[$i].price} kyats</h5>
                                            {{-- <h6 class="text-muted ml-2"><del>25000</del></h6> --}}
                                        </div>
                                    </div>
                                </div>
                            </div>
                        `;
                        };
                        $('#dataList').html($list);
                    }
                })
            }else if($eventOption == 'old'){
                $.ajax({
                    type : 'get',
                    url : '/user/ajax/pizzaList',
                    data : {'status' : 'old'},
                    dataType : 'json',
                    success : function(response){
                        $list = '';
                        for($i =0; $i < response.length ;$i++){
                        $list += `
                            <div class="col-lg-4 col-md-6 col-sm-6 pb-1" >
                                <div class="product-item bg-light mb-4" id="myForm">
                                    <div class="product-img position-relative overflow-hidden">
                                        <img class="img-fluid w-100" src="{{ asset('storage/${response[$i].image}') }}" alt="" style="height: 200px">
                                        <div class="product-action">
                                            <a class="btn btn-outline-dark btn-square" href=""><i class="fa fa-shopping-cart"></i></a>
                                            <a class="btn btn-outline-dark btn-square" href=""><i class="fa fa-circle-info"></i></a>
                                        </div>
                                    </div>
                                    <div class="text-center py-4">
                                        <a class="h6 text-decoration-none text-truncate" href="">${response[$i].name}</a>
                                        <div class="d-flex align-items-center justify-content-center mt-2">
                                            <h5>${response[$i].price} kyats</h5>
                                            {{-- <h6 class="text-muted ml-2"><del>25000</del></h6> --}}
                                        </div>
                                    </div>
                                </div>
                            </div>
                        `;
                        };
                        $('#dataList').html($list);
                    }
                })
            }
        });



});

</script>
@endpush
