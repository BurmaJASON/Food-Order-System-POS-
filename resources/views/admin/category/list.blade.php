@extends('admin.layouts.master')
@section('title','Category List')

@section('content')
<!-- MAIN CONTENT-->
<div class="main-content">
    <div class="section__content section__content--p30">
        <div class="container-fluid">
            <div class="col-md-12">
                <!-- DATA TABLE -->
                <div class="table-data__tool">
                    <div class="table-data__tool-left">
                        <div class="overview-wrap">
                            <h2 class="title-1">Category List</h2>

                        </div>
                    </div>
                    <div class="table-data__tool-right">
                        <a href="{{ route('category#createPage') }}">
                            <button class="au-btn au-btn-icon au-btn--green au-btn--small">
                                <i class="zmdi zmdi-plus"></i>add category
                            </button>
                        </a>
                        {{-- <button class="au-btn au-btn-icon au-btn--green au-btn--small">
                            CSV download
                        </button> --}}
                    </div>
                </div>

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
                        <form action="{{ route('category#list') }}" method="GET">
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
                        <h3><i class="fa-solid fa-database me-2"></i>  {{ $categories->total() }}</h3>
                    </div>
                </div>

                @if (count($categories)!=0)
                <div class="table-responsive table-responsive-data2">
                    <table class="table table-data2 text-center">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Category Name</th>
                                <th>Created Date</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($categories as $category)
                            <tr class="tr-shadow">
                                <td>{{ $category->id }}</td>
                                <td class="col-6">{{ $category->name }}</td>
                                <td>{{ $category->created_at->format('j-m-Y') }}</td>
                                <td>
                                    <div class="table-data-feature">
                                        <a href="{{ route('category#editPage',$category->id) }}" class="me-3">
                                            <button class="item " data-toggle="tooltip" data-placement="top" title="Edit">
                                                <i class="zmdi zmdi-edit"></i>
                                            </button>
                                        </a>
                                        <a href="{{ route('category#delete',$category->id) }}">
                                            <button class="item" data-toggle="tooltip" data-placement="top" title="Delete">
                                                <i class="zmdi zmdi-delete"></i>
                                            </button>
                                        </a>
                                    </div>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                    <div class="mt-3">
                        {{ $categories->links() }}

                        {{-- {{ $categories->appends(request()->query())->links() }} --}}
                    </div>
                </div>
                @else
                <h1 class="text-center text-secondary mt-5">There is no Category Here!</h1>
                @endif
                <!-- END DATA TABLE -->
            </div>
        </div>
    </div>
</div>
<!-- END MAIN CONTENT-->
@endsection
