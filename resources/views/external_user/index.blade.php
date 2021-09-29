@extends('layouts.app')

@section('content')

<div class="container-fluid">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Users</div>

                <!-- new btn row -->
                <div class='row'>
                    <a href="/user/create" class="btn btn-success mx-4 mt-2">Create New User</a>

                </div>
                <!--/ new btn row -->

                <div class="card-body">
                    <!--  tbl holder -->
                    <div class="card">
                        <div class="card-header">Users List</div>

                        <div class="card-body">

                            <table class="table table-bordered">
                                <thead class="thead-light">
                                    <tr>
                                        <th scope="col">Full Name</th>
                                        <th scope="col">Contact No.</th>

                                        <th scope="col">Address</th>
                                        <th scope="col">Edit/Delete</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php $number = 0; ?>
                                    @foreach ($externalUsers as $externalUser)

                                    <tr>
                                        <td>{{$externalUser->full_name}}</td>
                                        <td>{{$externalUser->contact_no}}</td>

                                        <td>{{$externalUser->address}}</td>
                                        <td>
                                            <div class="btn-group">
                                                <a href="/user/edit/{{$externalUser->id}}" class="btn  btn-sm btn-light ">Edit</a>
                                                <a href="/user/delete/{{$externalUser->id}}" class="btn btn-sm  btn-danger ">Delete</a>

                                            </div>
                                        </td>
                                    </tr>

                                    @endforeach

                                </tbody>
                            </table>
                            {{ $externalUsers->links() }}
                        </div>
                    </div>
                    <!-- end tbl holder -->
                </div>
            </div>
        </div>
    </div>
</div>


@endsection