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
                            <a href="{{ route('admin#list') }}">
                                <i class="fa-solid fa-arrow-left fs-4 text-dark" ></i>
                            </a>
                        </div>
                        <div class="card-title">
                            <h3 class="text-center title-2">Change Role</h3>
                        </div>
                        <hr>
                        <form action="{{ route('admin#change',$account->id) }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            <div class="row">
                                <div class="col-4 offset-1">
                                    @if($account->image == null)
                                        @if($account->gender  == 'male')
                                            <img src="https://freesvg.org/img/abstract-user-flat-4.png" class="img-thumbnail shadow" alt="">
                                        @else
                                            <img src="https://www.smiledesigndentalfl.com/wp-content/uploads/2022/05/femal-placeholder.png" class="img-thumbnail shadow" alt="">
                                        @endif
                                    @else
                                        <img src="{{ asset('storage/'.$account->image) }}" alt="" for="image">
                                    @endif
                                    <div class="mt-3">
                                        <button class="btn btn-dark col-12" type="submit">
                                            Change Role <i class="fa-solid fa-circle-chevron-right ms-1"></i>
                                        </button>
                                    </div>
                                </div>
                                <div class="col-6">
                                    <div class="form-group">
                                        <label  class="control-label mb-1">Name</label>
                                        <input name="name" type="text" class="form-control @error('name') is-invalid @enderror" value="{{ old('name',$account->name) }}" placeholder="Enter Admin Name..." disabled>
                                        @error('name')
                                            <div class="invalid-feedback">
                                                {{ $message }}
                                            </div>
                                        @enderror
                                    </div>
                                    <div class="form-group">
                                        <label  class="control-label mb-1">Role</label>
                                        <select name="role" class="form-control" >
                                            <option value="admin" @if($account->role == 'admin') selected @endif>Admin</option>
                                            <option value="user" @if($account->role == 'user') selected @endif>User</option>
                                        </select>
                                    </div>
                                    <div class="form-group">
                                        <label  class="control-label mb-1">Email</label>
                                        <input name="email" disabled type="email" class="form-control @error('email') is-invalid @enderror" value="{{ old('email',$account->email) }}" placeholder="Enter Admin Email...">
                                        @error('email')
                                            <div class="invalid-feedback">
                                                {{ $message }}
                                            </div>
                                        @enderror
                                    </div>
                                    <div class="form-group">
                                        <label  class="control-label mb-1">Phone</label>
                                        <input name="phone" disabled type="" class="form-control @error('phone') is-invalid @enderror" value="{{ old('phone',$account->phone) }}" placeholder="Enter Admin Phone...">
                                        @error('phone')
                                            <div class="invalid-feedback">
                                                {{ $message }}
                                            </div>
                                        @enderror
                                    </div>
                                    <div class="form-group">
                                        <label  class="control-label mb-1">Gender</label>
                                        <select name="gender"  disabled class="form-control @error('gender') is-invalid @enderror" >
                                            <option value="">Choose Gender</option>
                                            <option value="male" @if ($account->gender=='male')
                                                selected
                                            @endif>Male</option>
                                            <option value="female" @if ($account->gender=='female')
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
                                        <textarea name="address" disabled class="form-control @error('address') is-invalid @enderror" placeholder="Enter Admin Address...">{{ old('address',$account->address) }}</textarea>
                                        @error('address')
                                            <div class="invalid-feedback">
                                                {{ $message }}
                                            </div>
                                        @enderror
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
