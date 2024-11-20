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
                                <div class="alert alert-danger alert-dismissible fade show" role="alert">
                                    <strong>Error!</strong>{{ Session::get('error_message') }}
                                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                            @endif
                            @if (Session::has('success_message'))
                                <div class="alert alert-success alert-dismissible fade show" role="alert">
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
                            <form name="subadminForm" id="subadminForm" action="{{ url('admin/update-role/' . $id) }}"
                                method="post" enctype="multipart/form-data">
                                @csrf
                                <input type="hidden" name="subadmin_id" value="{{ $id }}">

                                @php
                                    // Set default values for checkbox states
                                    $view_cms_pages = $edit_cms_pages = $full_cms_pages = '';
                                    $view_categories = $edit_categories = $full_categories = '';
                                    $view_products = $edit_products = $full_products = '';

                                    if (!empty($subadmin_roles)) {
                                        foreach ($subadmin_roles as $role) {
                                            if ($role['module'] == 'cms_pages') {
                                                $view_cms_pages = $role['view_access'] == 1 ? 'checked' : '';
                                                $edit_cms_pages = $role['edit_access'] == 1 ? 'checked' : '';
                                                $full_cms_pages = $role['full_access'] == 1 ? 'checked' : '';
                                            }
                                            if ($role['module'] == 'categories') {
                                                $view_categories = $role['view_access'] == 1 ? 'checked' : '';
                                                $edit_categories = $role['edit_access'] == 1 ? 'checked' : '';
                                                $full_categories = $role['full_access'] == 1 ? 'checked' : '';
                                            }
                                            if ($role['module'] == 'products') {
                                                $view_products = $role['view_access'] == 1 ? 'checked' : '';
                                                $edit_products = $role['edit_access'] == 1 ? 'checked' : '';
                                                $full_products = $role['full_access'] == 1 ? 'checked' : '';
                                            }
                                        }
                                    }
                                @endphp

                                <div class="card-body">
                                    <div class="form-group col-md-12">
                                        <label for="title">CMS Pages: &nbsp;&nbsp;&nbsp;</label>
                                        <input type="checkbox" name="cms_pages_view" value="1" {{ $view_cms_pages }}>
                                        View Access
                                        &nbsp;&nbsp;&nbsp;
                                        <input type="checkbox" name="cms_pages_edit" value="1" {{ $edit_cms_pages }}>
                                        View/Edit Access
                                        &nbsp;&nbsp;&nbsp;
                                        <input type="checkbox" name="cms_pages_full" value="1" {{ $full_cms_pages }}>
                                        Full Access
                                    </div>

                                    <div class="form-group col-md-12">
                                        <label for="title">Categories: &nbsp;&nbsp;&nbsp;</label>
                                        <input type="checkbox" name="categories_view" value="1"
                                            {{ $view_categories }}>
                                        View Access
                                        &nbsp;&nbsp;&nbsp;
                                        <input type="checkbox" name="categories_edit" value="1"
                                            {{ $edit_categories }}>
                                        View/Edit Access
                                        &nbsp;&nbsp;&nbsp;
                                        <input type="checkbox" name="categories_full" value="1"
                                            {{ $full_categories }}>
                                        Full Access
                                    </div>

                                    <div class="form-group col-md-12">
                                        <label for="title">Products: &nbsp;&nbsp;&nbsp;</label>
                                        <input type="checkbox" name="products_view" value="1" {{ $view_products }}>
                                        View Access
                                        &nbsp;&nbsp;&nbsp;
                                        <input type="checkbox" name="products_edit" value="1" {{ $edit_products }}>
                                        View/Edit Access
                                        &nbsp;&nbsp;&nbsp;
                                        <input type="checkbox" name="products_full" value="1" {{ $full_products }}>
                                        Full Access
                                    </div>
                                </div>

                                <div class="form-group col-md-6">
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
