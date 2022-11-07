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
        <div class="container-fluid row">

            <div class="col-lg-12 ">
                <div class="card">
                    <div class="card-body">
                        <div class=" ms-3 pt-2">
                            {{-- <a href="{{ route('product#list') }}"> --}}
                                <i class="fa-solid fa-arrow-left fs-4 text-dark" onclick="history.back()"></i>
                            {{-- </a> --}}
                        </div>
                        {{-- <div class="card-title">
                            <h3 class="text-center title-2">Pizza Details</h3>
                        </div> --}}

                        <hr>
                        <div class="row">
                            <div class="col-4 offset-1 mt-2">

                                <img src="{{ asset('storage/'.$pizza->image) }}" alt="">

                            </div>
                            <div class="col-7  mt-2">

                                <div class="">
                                    <span class="h4 text-dark me-2">
                                        {{ $pizza->name }}
                                    </span>
                                    <span class="">({{ $pizza->category_name }})</span>
                                </div>

                                <span class="my-3 btn btn-warning btn-sm">
                                    <i class="fa-solid fa-money-bill-1-wave me-2 fs-5"></i>
                                    {{ $pizza->price }}   mmks
                                </span>
                                <span class="my-3 btn btn-warning btn-sm">
                                    <i class="fa-solid fa-clock me-2 fs-5"></i>
                                    {{ $pizza->waiting_time }}  mins
                                </span>
                                <span class="my-3 btn btn-warning btn-sm">
                                    <i class="fa-solid fa-eye me-2 fs-5"></i>
                                    {{ $pizza->view_count }}
                                </span>
                                <span class="my-3 btn btn-sm btn-warning ">
                                    <i class="fa-solid fa-user-clock me-2 fs-5"></i>
                                    {{ $pizza->created_at->format('j M Y') }}
                                </span>
                                <h5 class="my-2 ">
                                    <i class="fa-solid fa-file-lines me-2 fs-5 text-dark"></i>
                                    Description
                                </h5>
                                <div class="ms-4">
                                    {{ $pizza->description }}
                                </div>

                            </div>
                        </div>
                        {{-- <div class="row">
                            <div class="col-2 offset-10 mt-2">
                                <a href="{{ route('admin#edit') }}">
                                    <button class="btn btn-dark">
                                        <i class="fa-solid fa-pen-to-square me-2"></i>
                                        Edit Pizza
                                    </button>
                                </a>
                            </div>
                        </div> --}}
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- END MAIN CONTENT-->
@endsection
