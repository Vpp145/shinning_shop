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
                            <form name="productForm" id="productForm"
                                @if (empty($product['id'])) action="{{ url('admin/add-edit-product') }}" @else action="{{ url('admin/add-edit-product/' . $product['id']) }}" @endif
                                method="post" enctype="multipart/form-data">@csrf
                                <div class="card-body">
                                    <div class="form-group">
                                        <label for="parent_id">Select Category*</label>
                                        <select name="parent_id" id="parent_id" class="form-control">
                                            <option value="">Select Category Level</option>
                                            <option value="0" @if (empty($product['parent_id'])) selected @endif>Main
                                                Category</option>

                                            @foreach ($get_categories as $main_category)
                                                @php
                                                    $selectedMain =
                                                        isset($product['parent_id']) &&
                                                        $product['parent_id'] == $main_category['id']
                                                            ? 'selected'
                                                            : '';
                                                @endphp
                                                <option value="{{ $main_category['id'] }}" {{ $selectedMain }}>
                                                    {{ $main_category['category_name'] }}</option>

                                                @if (!empty($main_category['sub_categories']))
                                                    @foreach ($main_category['sub_categories'] as $sub_category)
                                                        @php
                                                            $selectedSub =
                                                                isset($category['parent_id']) &&
                                                                $category['parent_id'] == $sub_category['id']
                                                                    ? 'selected'
                                                                    : '';
                                                        @endphp
                                                        <option value="{{ $sub_category['id'] }}" {{ $selectedSub }}>
                                                            &raquo;&nbsp;{{ $sub_category['category_name'] }}</option>

                                                        @if (!empty($sub_category['sub_categories']))
                                                            @foreach ($sub_category['sub_categories'] as $sub_sub_category)
                                                                @php
                                                                    $selectedSubSub =
                                                                        isset($category['parent_id']) &&
                                                                        $category['parent_id'] ==
                                                                            $sub_sub_category['id']
                                                                            ? 'selected'
                                                                            : '';
                                                                @endphp
                                                                <option value="{{ $sub_sub_category['id'] }}"
                                                                    {{ $selectedSubSub }}>
                                                                    &nbsp;&raquo;&nbsp;&nbsp;&nbsp;{{ $sub_sub_category['category_name'] }}
                                                                </option>
                                                            @endforeach
                                                        @endif
                                                    @endforeach
                                                @endif
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="form-group">
                                        <label for="product_name">Product Name*</label>
                                        <input type="text" class="form-control" name="product_name" id="product_name"
                                            placeholder="Enter Product Name..."
                                            @if (!empty($product['product_name'])) value="{{ $product['product_name'] }}"
                                            @else value="{{ old('product_name') }}" @endif>
                                    </div>
                                    <div class="form-group">
                                        <label for="product_code">Product Code</label>
                                        <input type="text" class="form-control" name="category_discount"
                                            id="category_discount" placeholder="Enter Product Code..."
                                            @if (!empty($product['product_code'])) value="{{ $product['product_code'] }}"
                                            @else value="{{ old('product_code') }}" @endif>
                                    </div>
                                    <div class="form-group">
                                        <label for="product_color">Product Color</label>
                                        <input type="text" class="form-control" name="product_color" id="product_color"
                                            placeholder="Enter Product Color..."
                                            @if (!empty($product['product_color'])) value="{{ $product['product_color'] }}"
                                            @else value="{{ old('product_color') }}" @endif>
                                    </div>
                                    <div class="form-group">
                                        <label for="family_color">Family Color</label>
                                        <input type="text" class="form-control" name="family_color" id="family_color"
                                            placeholder="Enter Family Color..."
                                            @if (!empty($product['family_color'])) value="{{ $product['family_color'] }}"
                                            @else value="{{ old('family_color') }}" @endif>
                                    </div>
                                    <div class="form-group">
                                        <label for="group_code">Group Code</label>
                                        <input type="text" class="form-control" name="group_code" id="group_code"
                                            placeholder="Enter Group Code..."
                                            @if (!empty($product['group_code'])) value="{{ $product['group_code'] }}"
                                            @else value="{{ old('group_code') }}" @endif>
                                    </div>
                                    <div class="form-group">
                                        <label for="product_price">Product Price*</label>
                                        <input type="text" class="form-control" name="product_price" id="product_price"
                                            placeholder="Enter Product Price..."
                                            @if (!empty($product['product_price'])) value="{{ $product['product_price'] }}" @else value="{{ old('product_price') }}" @endif>
                                    </div>
                                    <div class="form-group">
                                        <label for="product_discount">Product Discount (%)</label>
                                        <input type="text" class="form-control" name="product_discount"
                                            id="product_discount" placeholder="Enter Product Discount..."
                                            @if (!empty($product['product_discount'])) value="{{ $product['product_discount'] }}"
                                            @else value="{{ old('product_discount') }}" @endif>
                                    </div>
                                    <div class="form-group">
                                        <label for="discount_type">Discount Type</label>
                                        <input type="text" class="form-control" name="discount_type"
                                            id="discount_type" placeholder="Enter Discount Type..."
                                            @if (!empty($product['discount_type'])) value="{{ $product['discount_type'] }}"
                                            @else value="{{ old('discount_type') }}" @endif>
                                    </div>
                                    <div class="form-group">
                                        <label for="final_price"> Final Price</label>
                                        <input type="text" class="form-control" name="final_price" id="final_price"
                                            placeholder="Enter Final Price..."
                                            @if (!empty($product['final_price'])) value="{{ $product['final_price'] }}"
                                            @else value="{{ old('final_price') }}" @endif>
                                    </div>
                                    <div class="form-group">
                                        <label for="product_weight">Product Weight</label>
                                        <input type="text" class="form-control" name="product_weight"
                                            id="product_weight" placeholder="Enter Product Weight..."
                                            @if (!empty($product['product_weight'])) value="{{ $product['product_weight'] }}"
                                            @else value="{{ old('product_weight') }}" @endif>
                                    </div>
                                    <div class="form-group">
                                        <label for="product_video">Product Video</label>
                                        <input type="file" class="form-control" name="product_video"
                                            id="product_video">
                                    </div>
                                    <div class="form-group">
                                        <label for="description">Description</label>
                                        <textarea name="description" id="description" class="form-control" rows="3"
                                            placeholder="Enter Description...">
                                            @if (!empty($product['description']))
{{ $product['description'] }}
@else
{{ old('description') }}
@endif
                                        </textarea>
                                    </div>
                                    <div class="form-group">
                                        <label for="wash_care">Wash Care</label>
                                        <input type="text" name="wash_care" id="wash_care" class="form-control"
                                            rows="3" placeholder="Enter Wash Care..."
                                            @if (!empty($product['wash_care'])) value="{{ $product['wash_care'] }}"
                                            @else value="{{ old('wash_care') }}" @endif>
                                    </div>
                                    <div class="form-group">
                                        <label for="search_keywords">Search Keywords</label>
                                        <input type="text" name="search_keywords" id="search_keywords"
                                            class="form-control" rows="3" placeholder="Enter Search Keywords..."
                                            @if (!empty($product['search_keywords'])) value="{{ $product['search_keywords'] }}"
                                            @else value="{{ old('search_keywords') }}" @endif>
                                    </div>
                                    <div class="form-group">
                                        <label for="fabric">Select Fabric</label>
                                        <select name="fabric" id="fabric" class="form-control">
                                            <option value="">Select</option>
                                            @foreach ($product_filters['fabric_array'] as $fabric)
                                                <option value="{{ $fabric }}">{{ $fabric }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="form-group">
                                        <label for="pattern">Select Pattern</label>
                                        <select name="pattern" id="pattern" class="form-control">
                                            <option value="">Select</option>
                                            @foreach ($product_filters['pattern_array'] as $pattern)
                                                <option value="{{ $pattern }}">{{ $pattern }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="form-group">
                                        <label for="sleeve">Select Sleeve</label>
                                        <select name="sleeve" id="sleeve" class="form-control">
                                            <option value="">Select</option>
                                            @foreach ($product_filters['sleeve_array'] as $sleeve)
                                                <option value="{{ $sleeve }}">{{ $sleeve }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="form-group">
                                        <label for="fit">Select Fit</label>
                                        <select name="fit" id="fit" class="form-control">
                                            <option value="">Select</option>
                                            @foreach ($product_filters['fit_array'] as $fit)
                                                <option value="{{ $fit }}">{{ $fit }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="form-group">
                                        <label for="occasion">Select Occasion</label>
                                        <select name="occasion" id="occasion" class="form-control">
                                            <option value="">Select</option>
                                            @foreach ($product_filters['occasion_array'] as $occasion)
                                                <option value="{{ $occasion }}">{{ $occasion }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="form-group">
                                        <label for="meta_title">Meta Title</label>
                                        <input type="text" class="form-control" name="meta_title" id="meta_title"
                                            placeholder="Enter Meta Title..."
                                            @if (!empty($product['meta_title'])) value="{{ $product['meta_title'] }}"
                                            @else value="{{ old('meta_title') }}" @endif>
                                    </div>
                                    <div class="form-group">
                                        <label for="meta_description">Meta Description</label>
                                        <input type="text" class="form-control" name="meta_description"
                                            id="meta_description" placeholder="Enter Meta Description..."
                                            @if (!empty($product['meta_description'])) value="{{ $product['meta_description'] }}"
                                            @else value="{{ old('meta_description') }}" @endif>
                                    </div>
                                    <div class="form-group">
                                        <label for="meta_keywords">Meta Keywords</label>
                                        <input type="text" class="form-control" name="meta_keywords"
                                            id="meta_keywords" placeholder="Enter Meta Keywords..."
                                            @if (!empty($product['meta_keywords'])) value="{{ $product['meta_keywords'] }}" @else value="{{ old('meta_keywords') }}" @endif>
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
