@extends('layouts.app')

@section('content')



<!-- main container -->
<div class='container-fluid'>
    <!-- main row -->
    <div class="row justify-content-center">
        <!-- left col -->
        <div class="col-md-6">
            <div class="row">
                <div class="card-body">
                    <!--  Company row -->
                    <div class="row mt-1">
                        <div class="col-lg-4 text-left">
                            <label>
                                Company
                            </label>
                        </div>
                        <div class="col-lg-8 ">
                            <select id="combo_company" class="form-control form-control-sm select2 select2-purple combo_company" data-dropdown-css-class="select2-purple" style="width: 100%;" name="combo_company">
                                <option>Loading...</option>
                            </select>
                        </div>
                    </div>
                    <!-- end Company row -->

                    <!--  First Name row -->
                    <div class="row mt-1">
                        <div class="col-lg-4 text-left">
                            <label>
                                First Name
                            </label>
                        </div>
                        <div class="col-lg-8 ">
                            <input type="text" class="form-control form-control-sm" id="txt_first_name" placeholder="First Name">
                            <span id="lbl_validation_txt_first_name" class="text-danger validation_msg"> </span>
                        </div>
                    </div>
                    <!-- end First Name row -->

                    <!-- Last Name -->
                    <div class="row mt-1">
                        <div class="col-lg-4 text-left">
                            <label>
                                Last Name
                            </label>
                        </div>
                        <div class="col-lg-8">
                            <input type="text" class="form-control form-control-sm" id="txt_last_name" placeholder="Last Name">
                            <span id="lbl_validation_txt_last_name" class="text-danger validation_msg"> </span>
                        </div>
                    </div>
                    <!-- end Last Name -->

                    <!-- Email -->
                    <div class="row mt-1">
                        <div class="col-lg-4 text-left">
                            <label>
                                Email
                            </label>
                        </div>
                        <div class="col-lg-8">
                            <input type="email" class="form-control form-control-sm" id="txt_email" placeholder="Email">
                            <span id="lbl_validation_current_txt_email" class="text-danger validation_msg"> </span>
                        </div>
                    </div>
                    <!-- end Email -->

                    <!-- Phone -->
                    <div class="row mt-1">
                        <div class="col-lg-4 text-left">
                            <label>
                                Phone
                            </label>
                        </div>
                        <div class="col-lg-8">
                            <input type="number" class="form-control form-control-sm" id="txt_phone" placeholder="Phone">
                            <span id="lbl_validation_txt_phone" class="text-danger validation_msg"> </span>
                        </div>
                    </div>
                    <!-- end Phone -->

                    <div class="d-flex flex-row-reverse mt-2 p-1">
                        <button class="btn btn-info btn-sm float-right mx-1" id="btn_employee_clear_form">Clear</button>
                        <button class="btn btn-danger btn-sm d-none mx-1" id="btn_employee_delete">Delete</button>
                        <button class="btn btn-warning btn-sm d-none mx-1" id="btn_employee_update">Update</button>
                        <button class="btn btn-success btn-sm mx-1" id="btn_employee_save">Save</button>
                    </div>
                </div>

            </div>
        </div>
        <!--/ left col -->

        <!-- rigth col -->
        <div class='col-md-6'>
            <div class="card-body">

                <table class="table table-sm table-bordered" id="tbl_employee" style="width:100%">
                    <thead class="thead-light">
                        <tr>
                            <th scope="col">First Name</th>
                            <th scope="col">Last Name</th>
                            <th scope="col">Email</th>
                            <th scope="col">Phone</th>
                            <th scope="col">Company</th>
                            <th scope="col">Select</th>
                        </tr>
                    </thead>
                    <tbody class="tbl_employee">



                    </tbody>
                </table>


            </div>
        </div>
        <!--/ rigth col -->



    </div>
    <!--  /main row -->

</div>
<!--/ main container -->




@endsection