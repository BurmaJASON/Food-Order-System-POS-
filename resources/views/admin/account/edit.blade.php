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
                        <div class="card-title">
                            <h3 class="text-center title-2">Edit Profile</h3>
                        </div>
                        <hr>
                        <form action="{{ route('admin#update',Auth::user()->id) }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            <div class="row">
                                <div class="col-4 offset-1">
                                    @if(Auth::user()->image == null)
                                        @if(Auth::user()->gender  == 'male')
                                            <img src="https://freesvg.org/img/abstract-user-flat-4.png" class="img-thumbnail shadow" alt="">
                                        @else
                                            <img src="https://www.smiledesigndentalfl.com/wp-content/uploads/2022/05/femal-placeholder.png" class="img-thumbnail shadow" alt="">
                                        @endif
                                    @else
                                        <img src="{{ asset('storage/'.Auth::user()->image) }}" alt="" for="image" class="img-thumbnail shadow">
                                    @endif
                                    <div class="mt-1">
                                        <input type="file" class="form-control @error('image') is-invalid @enderror" name="image">
                                        @error('image')
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
                                        <input name="name" type="text" class="form-control @error('name') is-invalid @enderror" value="{{ old('name',Auth::user()->name) }}" placeholder="Enter Admin Name...">
                                        @error('name')
                                            <div class="invalid-feedback">
                                                {{ $message }}
                                            </div>
                                        @enderror
                                    </div>
                                    <div class="form-group">
                                        <label  class="control-label mb-1">Email</label>
                                        <input name="email" type="email" class="form-control @error('email') is-invalid @enderror" value="{{ old('email',Auth::user()->email) }}" placeholder="Enter Admin Email...">
                                        @error('email')
                                            <div class="invalid-feedback">
                                                {{ $message }}
                                            </div>
                                        @enderror
                                    </div>
                                    <div class="form-group">
                                        <label  class="control-label mb-1">Phone</label>
                                        <input name="phone" type="number" class="form-control @error('phone') is-invalid @enderror" value="{{ old('phone',Auth::user()->phone) }}" placeholder="Enter Admin Phone...">
                                        @error('phone')
                                            <div class="invalid-feedback">
                                                {{ $message }}
                                            </div>
                                        @enderror
                                    </div>
                                    <div class="form-group">
                                        <label  class="control-label mb-1">Gender</label>
                                        <select name="gender"  class="form-control @error('gender') is-invalid @enderror" >
                                            <option value="">Choose Gender</option>
                                            <option value="male" @if (Auth::user()->gender=='male')
                                                selected
                                            @endif>Male</option>
                                            <option value="female" @if (Auth::user()->gender=='female')
                                                selected
                                            @endif>Female</option>
                                        </select>
                                        @error('gender')
                                            <div class="invalid-feedback">
                                                {{ $message }}
                                            </div>
                                        @enderror
                                    </div>
                                    <div class="form-group">
                                        <label  class="control-label mb-1">Address</label>
                                        <textarea name="address" class="form-control @error('address') is-invalid @enderror" placeholder="Enter Admin Address...">{{ old('address',Auth::user()->address) }}</textarea>
                                        @error('address')
                                            <div class="invalid-feedback">
                                                {{ $message }}
                                            </div>
                                        @enderror
                                    </div>
                                    <div class="form-group">
                                        <label  class="control-label mb-1">Role</label>
                                        <input name="role" type="text" class="form-control" value="{{ Auth::user()->role }}" disabled>
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
