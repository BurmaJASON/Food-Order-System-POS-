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
                            <h2 class="title-1">Admin List</h2>

                        </div>
                    </div>
                    <div class="table-data__tool-right">
                        <a href="{{ route('category#createPage') }}">
                            <button class="au-btn au-btn-icon au-btn--green au-btn--small">
                                <i class="zmdi zmdi-plus"></i>add category
                            </button>
                        </a>
                        <button class="au-btn au-btn-icon au-btn--green au-btn--small">
                            CSV download
                        </button>
                    </div>
                </div> --}}

                {{-- Category Create Success --}}
                @if (session('createSuccess'))
                <div class="col-6 offset-6">
                    <div class="alert alert-success alert-dismissible fade show" role="alert">
                        <i class="fa-solid fa-check"></i> {{ session('createSuccess') }}
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                      </div>
                </div>
                @endif

                {{-- Category Delete Success --}}
                @if (session('deleteSuccess'))
                <div class="col-6 offset-6">
                    <div class="alert alert-warning alert-dismissible fade show" role="alert">
                        <i class="fa-solid fa-circle-xmark"></i> {{ session('deleteSuccess') }}
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                      </div>
                </div>
                @endif

                <div class="row">
                    <div class="col-3 p-1">
                        <h4 class="text-secondary">Search Key: <strong class="text-black">{{ request('key') }}</strong></h4>
                    </div>
                    <div class="col-4 offset-5">
                        <form action="{{ route('admin#list') }}" method="GET">
                            @csrf
                            <div class="d-flex">
                                <input type="text" class="form-control" name="key" placeholder="Search..." value="{{ request('key') }}">
                                <button class="btn btn-dark" type="submit">
                                    <i class="fa-solid fa-magnifying-glass"></i>
                                </button>
                            </div>
                        </form>
                    </div>
                </div>

                <div class="row mt-3">
                    <div class="col-1 offset-10 bg-white shadow-sm text-center  p-2">
                        <h3><i class="fa-solid fa-database me-2"></i> {{ $admins->total() }} </h3>
                    </div>
                </div>

                <div class="table-responsive table-responsive-data2">
                    <table class="table table-data2 text-center">
                        <thead>
                            <tr>
                                <th>Image</th>
                                <th>Name</th>
                                <th>Email</th>
                                <th>Gender</th>
                                <th>Phone</th>
                                <th>Address</th>
                                <th></th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($admins as $admin)
                                @if($admin->role == "admin")
                                    <tr class="tr-shadow">
                                        <td class="col-2">
                                            @if ($admin->image == null)
                                                @if($admin->gender == 'male')
                                                    <img src="https://freesvg.org/img/abstract-user-flat-4.png" class="img-thumbnail shadow" alt="">
                                                @else
                                                    <img src="https://www.smiledesigndentalfl.com/wp-content/uploads/2022/05/femal-placeholder.png" class="img-thumbnail shadow" alt="">
                                                @endif
                                            @else
                                                <img src="{{ asset('storage/'.$admin->image) }}" class="img-thumbnail shadow" alt="">
                                            @endif
                                        </td>
                                        <td>{{ $admin->name }}</td>
                                        <td>{{ $admin->email }}</td>
                                        <td>{{ $admin->gender }}</td>
                                        <td>{{ $admin->phone }}</td>
                                        <td>{{ $admin->address }}</td>
                                        <td>

                                            <div class="table-data-feature">
                                                @if (Auth::user()->id == $admin->id)

                                                @else
                                                    <a href="#" class="me-2 changeRole"  >
                                                        <button class="item" data-toggle="tooltip" data-placement="top" title="Change to User Role">
                                                            <i class="fa-solid fa-person-circle-minus"></i>
                                                        </button>
                                                    </a>
                                                    <a href="{{ route('admin#delete',$admin->id) }}" class="me-2">
                                                        <button class="item" data-toggle="tooltip" data-placement="top" title="Delete">
                                                            <i class="zmdi zmdi-delete"></i>
                                                        </button>
                                                    </a>
                                                    <input type="hidden" class="adminId" value="{{ $admin->id }}">
                                                @endif
                                            </div>
                                        </td>

                                    </tr>
                                @endif
                            @endforeach
                        </tbody>
                    </table>
                    <div class="mt-3">
                        {{ $admins->links() }}

                        {{-- {{ $categories->appends(request()->query())->links() }} --}}
                    </div>
                </div>

            </div>
        </div>
    </div>
</div>
<!-- END MAIN CONTENT-->
@endsection

@section('scriptSection')
<script>
    $(document).ready(function(){
        //change admin role to user
        $('.changeRole').click(function(){
            $parentNode = $(this).parents("tr");
            $adminId = $parentNode.find('.adminId').val();
            $data ={
                'adminId' : $adminId
            };

            $.ajax({
                type : 'get',
                url : '/admin/change/role',
                data : $data,
                dataType : 'json',
            })
            location.reload();
        })
    })
</script>
@endsection
