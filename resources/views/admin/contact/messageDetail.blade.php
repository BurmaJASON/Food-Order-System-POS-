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



                    <div class="table-responsive table-responsive-data2">
                        <a href="{{ route('response#message') }}" class="text-dark">
                            <i class="fa-solid fa-arrow-left-long"></i>Back
                        </a>
                        <div class="row col-8 offset-2 card mt-3 rounded">
                            <div class="card-header">
                                <h3><i class="fa-regular fa-envelope-open"></i> User Message</h3>
                            </div>
                            <div class="card-body  ">
                                <div class="row my-3">
                                    <div class="col-3">
                                        <i class="fa-solid fa-user me-1"></i> User Name :
                                    </div>
                                    <div class="col">
                                       {{ $message->name }}
                                    </div>
                                </div>
                                <div class="row my-3">
                                    <div class="col-3">
                                        <i class="fa-regular fa-paper-plane me-1"></i> Email :
                                    </div>
                                    <div class="col">
                                       {{ $message->email }}
                                    </div>
                                </div>
                                <div class="row my-3">
                                    <div class="col-3">
                                        <i class="fa-solid fa-calendar-days me-1"></i>  Date :
                                    </div>
                                    <div class="col">
                                       {{ $message->created_at->format('M-j-Y') }}
                                    </div>
                                </div>
                                <div class="row my-3">
                                    <div class="col-3">
                                        <i class="fa-solid fa-comment-dots me-1"></i>  Message :
                                    </div>
                                    <div class="col">
                                        <textarea class="form-control" cols="30" rows="16" disabled>{{ $message->message }}</textarea>
                                    </div>
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

