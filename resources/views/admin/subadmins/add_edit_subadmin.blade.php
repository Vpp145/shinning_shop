@extends('admin.layouts.layout')
@section('content')
    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <div class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1 class="m-0">Admin Management</h1>
                    </div><!-- /.col -->
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="dashboard">Home</a></li>
                            <li class="breadcrumb-item active">{{ $title }}</li>
                        </ol>
                    </div><!-- /.col -->
                </div><!-- /.row -->
            </div><!-- /.container-fluid -->
        </div>
        <!-- /.content-header -->

        <!-- Main content -->
        <section class="content">
            <div class="container-fluid">
                <div class="row">
                    <!-- left column -->
                    <div class="col-md-6">
                        <!-- general form elements -->
                        <div class="card card-primary">
                            <div class="card-header">
                                <h3 class="card-title">{{ $title }}</h3>
                            </div>
                            <!-- /.card-header -->
                            @if (Session::has('error_message'))
                                <div class="alert alert-danger alert-dismissible fade show mt-5" role="alert">
                                    <strong>Error!</strong>{{ Session::get('error_message') }}
                                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                            @endif
                            @if (Session::has('success_message'))
                                <div class="alert alert-success alert-dismissible fade show mt-5" role="alert">
                                    <strong>Success!</strong>{{ Session::get('success_message') }}
                                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                            @endif
                            @if ($errors->any())
                                <div class="alert alert-danger">
                                    <ul>
                                        @foreach ($errors->all() as $error)
                                            <li>{{ $error }}</li>
                                        @endforeach
                                    </ul>
                                </div>
                            @endif
                            <!-- form start -->
                            <form name="subadminForm" id="subadminForm"
                                @if (empty($subadmin['id'])) action="{{ url('admin/add-edit-sub-admin') }}" @else action="{{ url('admin/add-edit-sub-admin/' . $subadmin['id']) }}" @endif
                                method="post" enctype="multipart/form-data">@csrf
                                <div class="card-body">
                                    <div class="form-group col-md-6">
                                        <label for="subadmin_name">Subadmin Name*</label>
                                        <input type="text" class="form-control" name="subadmin_name" id="subadmin_name"
                                            placeholder="Enter Subadmin Name..."
                                            @if (!empty($subadmin['name'])) value="{{ $subadmin['name'] }}" @else value="{{ old('name') }}" @endif>
                                    </div>
                                    <div class="form-group col-md-6">
                                        <label for='subadmin_mobile'>Subadmin Mobile*</label>
                                        <input type="text" class="form-control" name="subadmin_mobile"
                                            id="subadmin_mobile" placeholder="Enter Subadmin Mobile..."
                                            @if (!empty($subadmin['mobile'])) value="{{ $subadmin['mobile'] }}" @else value="{{ old('mobile') }}" @endif>
                                    </div>
                                    <div class="form-group col-md-6">
                                        <label for="subadmin_email">Subadmin Email*</label>
                                        <input type="email" class="form-control" name="subadmin_email" id="subadmin_email"
                                            placeholder="Enter Subadmin Email..."
                                            @if (!empty($subadmin['email'])) value="{{ $subadmin['email'] }}" @else value="{{ old('email') }}" @endif>
                                    </div>
                                    <div class="form-group col-md-6">
                                        <label for="subaddmin_password">Subadmin Password</label>
                                        <input type="password" class="form-control" name="subadmin_password"
                                            id="subadmin_password" placeholder="Enter Subadmin Password..."
                                            @if ($subadmin['id'] == '') required @endif>
                                    </div>
                                    <div class="form-group col-md-6">
                                        <label for="subadmin_image">Subadmin Image</label>
                                        <input type="file" class="form-control" name="subadmin_image"
                                            id="subadmin_image">
                                        @if (!empty($subadmin['image']))
                                            <a target="_blank"
                                                href="{{ url('admin/img/photos/' . $subadmin['image']) }}">View
                                                Image</a>
                                            <input type="hidden" name="current_subadmin_image"
                                                value="{{ Auth::guard('admin')->user()->image }}">
                                        @endif
                                    </div>
                                </div>

                                <div class="card-footer">
                                    <button type="submit" class="btn btn-primary">Submit</button>
                                </div>
                            </form>
                        </div>
                        <!-- /.card -->
                    </div>
                    <!--/.col (left) -->
                </div>
                <!-- /.row -->
            </div><!-- /.container-fluid -->
        </section>
        <!-- /.content -->


    </div>
    <!-- /.content-wrapper -->
@endsection
