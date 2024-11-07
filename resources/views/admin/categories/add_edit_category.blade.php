@extends('admin.layouts.layout')
@section('content')
    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <div class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1 class="m-0">Categories Management</h1>
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
                            <form name="categoryForm" id="categoryForm"
                                @if (empty($category['id'])) action="{{ url('admin/add-edit-category') }}" @else action="{{ url('admin/add-edit-category/' . $category['id']) }}" @endif
                                method="post" enctype="multipart/form-data">@csrf
                                <div class="card-body">
                                    <div class="form-group">
                                        <label for="category_name">Category Name*</label>
                                        <input type="text" class="form-control" name="category_name" id="category_name"
                                            placeholder="Enter Category Name..."
                                            @if (!empty($category['category_name'])) value="{{ $category['category_name'] }}" @endif>
                                    </div>
                                    <div class="form-group">
                                        <label for="category_image">Category Image</label>
                                        <input type="file" class="form-control" name="category_image"
                                            id="category_image">
                                    </div>
                                    <div class="form-group">
                                        <label for="category_discount">Category Discount</label>
                                        <input type="text" class="form-control" name="category_discount"
                                            id="category_discount" placeholder="Enter Category Discount...">
                                    </div>
                                    <div class="form-group">
                                        <label for="url">Category URL*</label>
                                        <input type="text" class="form-control" name="url" id="url"
                                            placeholder="Enter Category URL...">
                                    </div>
                                    <div class="form-group">
                                        <label for="description">Category Description*</label>
                                        <textarea name="description" id="description" class="form-control" rows="3"
                                            placeholder="Enter Category Description..."></textarea>
                                    </div>
                                    <div class="form-group">
                                        <label for="meta_title">Meta Title*</label>
                                        <input type="text" class="form-control" name="meta_title" id="meta_title"
                                            placeholder="Enter Meta Title..."
                                            @if (!empty($category['meta_title'])) value="{{ $category['meta_title'] }}" @endif>
                                    </div>
                                    <div class="form-group">
                                        <label for="meta_description">Meta Description*</label>
                                        <input type="text" class="form-control" name="meta_description"
                                            id="meta_description" placeholder="Enter Meta Description..."
                                            @if (!empty($category['meta_description'])) value="{{ $category['meta_description'] }}" @endif>
                                    </div>
                                    <div class="form-group"></div>
                                    <label for="meta_keywords">Meta Keywords*</label>
                                    <input type="text" class="form-control" name="meta_keywords" id="meta_keywords"
                                        placeholder="Enter Meta Keywords..."
                                        @if (!empty($category['meta_keywords'])) value="{{ $category['meta_keywords'] }}" @endif>
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
