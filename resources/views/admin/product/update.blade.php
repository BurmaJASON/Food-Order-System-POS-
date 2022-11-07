@extends('admin.layouts.master')
@section('title','Category List')

@section('content')
<!-- MAIN CONTENT-->
<div class="main-content">
    <div class="section__content section__content--p30">
        <div class="container-fluid">

            <div class="col-lg-10 offset-1">
                <div class="card">
                    <div class="card-body">
                        <div class=" ms-3 pt-2">
                             <i class="fa-solid fa-arrow-left fs-4 text-dark" onclick="history.back()"></i>
                             {{-- <a href="{{ route('product#list') }}">
                                <i class="fa-solid fa-arrow-left fs-4 text-dark"></i>
                            </a> --}}
                        </div>
                        <div class="">
                            <h3 class="text-center">Update Pizza</h3>
                        </div>
                        <hr>
                        <form action="{{ route('product#update',$pizza->id) }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            <div class="row">
                                <div class="col-4 offset-1">
                                    <img src="{{ asset('storage/'.$pizza->image) }}" alt="" for="image">

                                    <div class="mt-1">
                                        <input type="file" class="form-control @error('pizzaImage') is-invalid @enderror" name="pizzaImage">
                                        @error('pizzaImage')
                                            <div class="invalid-feedback">
                                                {{ $message }}
                                            </div>
                                        @enderror
                                    </div>
                                    <div class="mt-3">
                                        <button class="btn btn-dark col-12" type="submit">
                                            Update <i class="fa-solid fa-circle-chevron-right ms-1"></i>
                                        </button>
                                    </div>
                                </div>
                                <div class="col-6">
                                    <div class="form-group">
                                        <label  class="control-label mb-1">Name</label>
                                        <input name="pizzaName" type="text" class="form-control @error('pizzaName') is-invalid @enderror" value="{{ old('pizzaName',$pizza->name) }}" placeholder="Enter Pizza Name...">
                                        @error('pizzaName')
                                            <div class="invalid-feedback">
                                                {{ $message }}
                                            </div>
                                        @enderror
                                    </div>
                                    <div class="form-group">
                                        <label  class="control-label mb-1">Descripiton</label>
                                        <textarea name="pizzaDescription" class="form-control @error('pizzaDescription') is-invalid @enderror" placeholder="Enter Pizza Description...">{{ old('pizzaDescription',$pizza->description) }}</textarea>
                                        @error('pizzaDescription')
                                            <div class="invalid-feedback">
                                                {{ $message }}
                                            </div>
                                        @enderror
                                    </div>
                                    <div class="form-group">
                                        <label  class="control-label mb-1">Pizza Categories</label>
                                        <select name="pizzaCategory"  class="form-control @error('pizzaCategory') is-invalid @enderror" >
                                            <option value="">Choose Pizza Category</option>
                                            @foreach ($categories as $category)
                                                <option value="{{ $category->id }}" @if ($pizza->category_id == $category->id)
                                                    selected
                                                @endif>{{ $category->name }}</option>
                                            @endforeach
                                        </select>
                                        @error('pizzaCategory')
                                            <div class="invalid-feedback">
                                                {{ $message }}
                                            </div>
                                        @enderror
                                    </div>
                                    <div class="form-group">
                                        <label  class="control-label mb-1">Price</label>
                                        <input name="pizzaPrice" type="number" class="form-control @error('pizzaPrice') is-invalid @enderror" value="{{ old('pizzaPrice',$pizza->price) }}" placeholder="Enter Pizza Price...">
                                        @error('pizzaPrice')
                                            <div class="invalid-feedback">
                                                {{ $message }}
                                            </div>
                                        @enderror
                                    </div>
                                    <div class="form-group">
                                        <label  class="control-label mb-1">Waiting Time</label>
                                        <input name="pizzaWaitingTime" type="number" class="form-control @error('pizzaWaitingTime') is-invalid @enderror" value="{{ old('pizzaWaitingTime',$pizza->waiting_time) }}" placeholder="Enter Pizza WaitingTime...">
                                        @error('pizzaWaitingTime')
                                            <div class="invalid-feedback">
                                                {{ $message }}
                                            </div>
                                        @enderror
                                    </div>
                                    <div class="form-group">
                                        <label  class="control-label mb-1">View Count</label>
                                        <input name="viewCount" disabled class="form-control " value="{{ $pizza->view_count }}" >
                                    </div>
                                    <div class="form-group">
                                        <label  class="control-label mb-1">Created Date</label>
                                        <input name="createdAt"  class="form-control" value="{{ $pizza->created_at->format('j M Y') }}" disabled>

                                    </div>
                                </div>
                            </div>


                        </form>

                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- END MAIN CONTENT-->
@endsection
