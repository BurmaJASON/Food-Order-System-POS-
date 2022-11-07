@extends('admin.layouts.master')
@section('title','Category List')

@section('content')
<!-- MAIN CONTENT-->
<div class="main-content">
    <div class="section__content section__content--p30">
        <div class="container-fluid">
            <div class="col-md-12">
                @if (session('deleteSuccess'))
                <div class="col-6 offset-6">
                    <div class="alert alert-warning alert-dismissible fade show" role="alert">
                        <i class="fa-solid fa-circle-xmark"></i> {{ session('deleteSuccess') }}
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                      </div>
                </div>
                @endif
                <!-- DATA TABLE -->
                    <div class="table-responsive table-responsive-data2">
                        <h3>Total - {{ $users->total() }}</h3>
                    @if(count($users) != 0)
                        <table class="table table-data2 text-center">
                            <thead>
                                <tr>
                                    <th>Image</th>
                                    <th>Name</th>
                                    <th>Email</th>
                                    <th>Gender</th>
                                    <th>Address</th>
                                    <th>Role</th>
                                    <th></th>
                                </tr>
                            </thead>
                            <tbody id="dataList">
                                @foreach ($users as $user)
                                <tr>
                                    <input type="hidden" id="userId" value="{{ $user->id }}">
                                    <td>
                                        @if($user->image == null)
                                            @if($user->gender  == 'male')
                                                <img src="https://freesvg.org/img/abstract-user-flat-4.png" class="img-thumbnail shadow" alt="">
                                            @else
                                                <img src="https://www.smiledesigndentalfl.com/wp-content/uploads/2022/05/femal-placeholder.png" class="img-thumbnail shadow" alt="">
                                            @endif
                                        @else
                                            <img src="{{ asset('storage/'.$user->image) }}" alt="" class="img-thumbnail shadow">
                                        @endif
                                    </td>
                                    <td >{{ $user->name }}</td>
                                    <td>{{ $user->email }}</td>
                                    <td>{{ $user->gender }}</td>
                                    <td>{{ $user->address }}</td>
                                    <td>
                                        <select class="roleChange" >
                                            <option value="user"  @if ($user->role == 'user')
                                                selected
                                            @endif>User</option>
                                            <option value="admin" @if ($user->role == 'admin')
                                                selected
                                            @endif>Admin</option>
                                        </select>
                                    </td>
                                    <td>
                                        <div class="table-data-feature">
                                            <a href="{{ route('admin#deleteUser',$user->id) }}" class="me-2">
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
                            {{ $users->links() }}

                            {{-- {{ $categories->appends(request()->query())->links() }} --}}
                        </div>
                    @else
                        <h1 class="text-center text-secondary mt-5">There is no User Yet!</h1>
                    @endif
                    </div>
                <!-- END DATA TABLE -->
            </div>
        </div>
    </div>
</div>
<!-- END MAIN CONTENT-->
@endsection

@section('scriptSection')
<script>
    $(document).ready(function(){
        //change role
        $('.roleChange').change(function(){
            $currentRole = $(this).val();
            $parentNode = $(this).parents("tr");
            $userId = $parentNode.find('#userId').val();
            $data = {
                'userId' : $userId,
                'role' : $currentRole,
            };

            $.ajax({
                type: 'get',
                url: '/user/change/role',
                data : $data,
                dataType : 'json',
            })
            location.reload();
        })
    })
</script>
@endsection
