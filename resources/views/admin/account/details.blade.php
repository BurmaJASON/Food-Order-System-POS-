@extends('admin.layouts.master')
@section('title','Category List')

@section('content')
<!-- MAIN CONTENT-->
<div class="main-content">
    <div class="row">
        <div class="col-5 offset-5 mb-2">
            @if (session('updateSuccess'))
                <div class="">
                    <div class="alert alert-success alert-dismissible fade show" role="alert">
                        <i class="fa-solid fa-check"></i> {{ session('updateSuccess') }}
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                </div>
            @endif
        </div>
    </div>
    <div class="section__content section__content--p30">
        <div class="container-fluid">

            <div class="col-lg-10 offset-1">
                <div class="card">
                    <div class="card-body">
                        <div class="card-title">
                            <h3 class="text-center title-2">Account Info</h3>
                        </div>

                        <hr>
                        <div class="row">
                            <div class="col-3 offset-2 mt-2">
                                @if(Auth::user()->image == null)
                                    @if(Auth::user()->gender  == 'male')
                                        <img src="https://freesvg.org/img/abstract-user-flat-4.png" class="img-thumbnail shadow" alt="">
                                    @else
                                        <img src="https://www.smiledesigndentalfl.com/wp-content/uploads/2022/05/femal-placeholder.png" class="img-thumbnail shadow" alt="">
                                    @endif
                                @else
                                    <img src="{{ asset('storage/'.Auth::user()->image) }}" alt="" class="img-thumbnail shadow">
                                @endif
                            </div>
                            <div class="col-5 offset-1 mt-2">
                                <h4 class="mt-1 ">
                                    <i class="fa-solid fa-user-pen me-2"></i>
                                    {{ Auth::user()->name }}
                                </h4>
                                <h4 class="my-2 ">
                                    <i class="fa-solid fa-envelope me-2"></i>
                                    {{ Auth::user()->email }}
                                </h4>
                                <h4 class="my-2 ">
                                    <i class="fa-solid fa-phone me-2"></i>
                                    {{ Auth::user()->phone }}
                                </h4>
                                <h4 class="my-2 ">
                                    <i class="fa-solid fa-mars-and-venus me-2"></i>
                                    {{ Auth::user()->gender }}
                                </h4>
                                <h4 class="my-2 ">
                                    <i class="fa-solid fa-address-card me-2"></i>
                                    {{ Auth::user()->address }}
                                </h4>
                                <h4 class="my-2 ">
                                    <i class="fa-solid fa-user-clock me-2"></i>
                                    {{ Auth::user()->created_at->format('j M Y') }}
                                </h4>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-3 offset-9 my-2">
                                <a href="{{ route('admin#edit') }}">
                                    <button class="btn btn-dark">
                                        <i class="fa-solid fa-pen-to-square me-2"></i>
                                        Edit Profile
                                    </button>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- END MAIN CONTENT-->
@endsection
