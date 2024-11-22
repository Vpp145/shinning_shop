@extends('admin.layouts.layout')
@section('content')
    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <div class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1 class="m-0">Banners Management</h1>
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
                            <form name="bannerForm" id="bannerForm"
                                @if (empty($banner['id'])) action="{{ url('admin/add-edit-banner') }}" @else action="{{ url('admin/add-edit-banner/' . $banner['id']) }}" @endif
                                method="post" enctype="multipart/form-data">@csrf

                                <div class="card-body">
                                    <div class="form-group">
                                        <label for="type">Banner Type</label>
                                        <select name="type" id="type" class="form-control">
                                            <option value="">Select Banner Type</option>
                                            <option value="slider" @if (!empty($banner['type']) && $banner['type'] == 'slider') selected @endif>
                                                Slider
                                            </option>
                                            <option value="fix_1" @if (!empty($banner['type']) && $banner['type'] == 'fix_1') selected @endif>
                                                Fix 1
                                            </option>
                                            <option value="fix_2" @if (!empty($banner['type']) && $banner['type'] == 'fix_2') selected @endif>
                                                Fix 2
                                            </option>
                                            <option value="fix_3" @if (!empty($banner['type']) && $banner['type'] == 'fix_3') selected @endif>
                                                Fix 3
                                            </option>
                                            <option value="fix_4" @if (!empty($banner['type']) && $banner['type'] == 'fix_4') selected @endif>
                                                Fix 4
                                            </option>
                                        </select>
                                        </select>
                                    </div>
                                    <div class="form-group">
                                        <label for="image">Banner Image</label>
                                        <input type="file" class="form-control-file" id="image" name="image">
                                        @if (!empty($banner['image']))
                                            <a target="_blank"
                                                href="{{ url('front/images/banners/' . $banner['image']) }}">View
                                                Image</a>
                                            <input type="hidden" name="current_image" value="{{ $banner['image'] }}">
                                        @endif
                                    </div>
                                    <div class="form-group">
                                        <label for="link">Banner Link</label>
                                        <input type="text" class="form-control" id="link" name="link"
                                            placeholder="Enter Banner Link"
                                            value="{{ !empty($banner['link']) ? $banner['link'] : old('link') }}">
                                    </div>
                                    <div class="form-group">
                                        <label for="title">Banner Title</label>
                                        <input type="text" class="form-control" id="title" name="title"
                                            value="{{ !empty($banner['title']) ? $banner['title'] : old('title') }}"
                                            placeholder="Enter Title">
                                    </div>
                                    <div class="form-group">
                                        <label for="alt">Banner Alternate Text</label>
                                        <input type="text" class="form-control" id="alt" name="alt"
                                            placeholder="Enter Banner Alternate Text"
                                            value="{{ !empty($banner['alt']) ? $banner['alt'] : old('alt') }}">
                                    </div>
                                    <div class="form-group">
                                        <label for="sort">Banner Sort</label>
                                        <input type="number" class="form-control" id="sort" name="sort"
                                            placeholder="Enter Banner Sort"
                                            value="{{ !empty($banner['sort']) ? $banner['sort'] : old('sort') }}">
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
