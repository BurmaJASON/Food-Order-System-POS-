@extends('admin.layouts.master')
@section('title','Category List')

@section('content')
<!-- MAIN CONTENT-->
<div class="main-content">
    <div class="section__content section__content--p30">
        <div class="container-fluid">
            <div class="row">
                <div class="col-3 offset-8">
                    <a href="{{ route('product#list') }}"><button class="btn bg-dark text-white my-3">List</button></a>
                </div>
            </div>
            <div class="col-lg-6 offset-3">
                <div class="card">
                    <div class="card-body">
                        <div class="card-title">
                            <h3 class="text-center title-2">Create Your Pizza</h3>
                        </div>
                        <hr>
                        <form action="{{ route('product#create') }}" method="post" novalidate="novalidate" enctype="multipart/form-data">
                            @csrf
                            <div class="form-group">
                                <label  class="control-label mb-1">Name</label>
                                <input name="pizzaName" type="text" class="form-control @error('pizzaName')
                                is-invalid
                                @enderror" value="{{ old('pizzaName') }}" placeholder="Enter Pizza Name...">
                                @error('pizzaName')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>

                            <div class="form-group">
                                <label  class="control-label mb-1">Category</label>
                                <select name="pizzaCategory" class="form-control @error('pizzaCategory')
                                is-invalid
                                @enderror">
                                    <option value="">Choose Your Category</option>
                                    @foreach ($categories as $category)
                                        <option value="{{ $category->id }}">{{ $category->name }}</option>
                                    @endforeach
                                </select>
                                @error('pizzaCategory')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>

                            <div class="form-group">
                                <label  class="control-label mb-1">Description</label>
                                <textarea name="pizzaDescription" class="form-control @error('pizzaDescription')
                                is-invalid
                                @enderror" placeholder="Enter Description...">{{ old('pizzaDescription') }}</textarea>
                                @error('pizzaDescription')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>

                            <div class="form-group">
                                <label  class="control-label mb-1">Image</label>
                                <input name="pizzaImage" type="file" class="form-control @error('pizzaImage')
                                is-invalid
                                @enderror" value="{{ old('pizzaImage') }}">
                                @error('pizzaImage')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>

                            <div class="form-group">
                                <label  class="control-label mb-1">Waiting Time</label>
                                <input name="pizzaWaitingTime" type="number" class="form-control @error('pizzaWaitingTime')
                                is-invalid
                                @enderror" value="{{ old('pizzaWaitingTime') }}" placeholder="Enter Waiting Time...">
                                @error('pizzaWaitingTime')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>

                            <div class="form-group">
                                <label  class="control-label mb-1">Price</label>
                                <input name="pizzaPrice" type="text" class="form-control @error('pizzaPrice')
                                is-invalid
                                @enderror" value="{{ old('pizzaPrice') }}" placeholder="Enter Pizza Price...">
                                @error('pizzaPrice')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>

                            <div class="mt-3  offset-8">
                                <button id="payment-button" type="submit" class="btn btn-lg btn-info btn-block">
                                    <span id="payment-button-amount">Create</span>
                                    {{-- <span id="payment-button-sending" style="display:none;">Sending…</span> --}}
                                    <i class="fa-solid fa-circle-right"></i>
                                </button>
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
