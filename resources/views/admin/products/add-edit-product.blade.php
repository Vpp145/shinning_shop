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
                                        <select name="category_id" id="parent_id" class="form-control">
                                            <option value="">Select Category Level</option>

                                            @foreach ($get_categories as $main_category)
                                                <option value="{{ $main_category['id'] }}"
                                                    @if (!empty(@old('category_id')) && $main_category['id'] == $old['category_id']) selected @elseif(!empty($product['category_id']) && $product['category_id'] == $main_category['id'])
                                                                selected @endif>
                                                    {{ $main_category['category_name'] }}</option>

                                                @if (!empty($main_category['sub_categories']))
                                                    @foreach ($main_category['sub_categories'] as $sub_category)
                                                        <option value="{{ $sub_category['id'] }}"
                                                            @if (!empty(@old('category_id')) && $sub_category['id'] == $old['category_id']) selected @elseif(!empty($product['category_id']) && $product['category_id'] == $sub_category['id']) selected @endif>
                                                            &raquo;&nbsp;{{ $sub_category['category_name'] }}</option>

                                                        @if (!empty($sub_category['sub_categories']))
                                                            @foreach ($sub_category['sub_categories'] as $sub_sub_category)
                                                                <option value="{{ $sub_sub_category['id'] }}"
                                                                    @if (!empty(@old('category_id')) && $sub_sub_category['id'] == $old['category_id']) selected @elseif(!empty($product['category_id']) && $product['category_id'] == $sub_sub_category['id']) selected @endif>
                                                                    &nbsp;&nbsp;&nbsp;&raquo;&raquo;&nbsp;{{ $sub_sub_category['category_name'] }}
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
                                        <input type="text" class="form-control" name="product_code"
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
                                    <?php $family_colors = \App\Models\Color::colors(); ?>
                                    <div class="form-group">
                                        <label for="family_color">Family Color</label>
                                        <select name="family_color" id="family_color" class="form-control">
                                            <option value="">Select Family Color</option>
                                            @foreach ($family_colors as $color)
                                                <option value="{{ $color->color_name }}"
                                                    @if (isset($product['family_color']) && $product['family_color'] == $color->color_name) selected @endif>
                                                    {{ $color->color_name }}</option>
                                            @endforeach
                                        </select>
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
                                        <label for="product_weight">Product Weight</label>
                                        <input type="text" class="form-control" name="product_weight"
                                            id="product_weight" placeholder="Enter Product Weight..."
                                            @if (!empty($product['product_weight'])) value="{{ $product['product_weight'] }}"
                                            @else value="{{ old('product_weight') }}" @endif>
                                    </div>
                                    <div class="form-group">
                                        <label for="product_images">Product Images (Recommended Size: 1040 x 1200)</label>
                                        <input type="file" class="form-control" name="products_images[]"
                                            id="products_images" multiple accept="images/*">
                                        <table cellspacing="10" cellpadding="10" style="padding: 5px;">
                                            <tr>
                                                @foreach ($product['images'] as $image)
                                                    <td>
                                                        <a target="_blank"
                                                            href="{{ url('front/images/products/small/' . $image['image']) }}">
                                                            <img style="width: 60px"
                                                                src="{{ asset('front/images/products/small/' . $image['image']) }}">
                                                        </a>&nbsp;
                                                        <input type="hidden" name="image[]"
                                                            value="{{ $image['image'] }}">
                                                        <input style="width: 40px" type="text" placeholder="Sort"
                                                            name="image_sort[]" value="{{ $image['image_sort'] }}">
                                                        <a style="color: #3f6ed3" class="confirmDelete"
                                                            title="Delete Product Image" href="javascript:void(0)"
                                                            record='product-image' style="color:#3f6ed3"
                                                            recordid="{{ $image['id'] }}"><i
                                                                class="fas fa-trash"></i></a>
                                                    </td>
                                                @endforeach
                                            </tr>
                                        </table>
                                    </div>
                                    <div class="form-group">
                                        <label for="product_attributes">Product Attributes</label>
                                        <div class="field_wrapper">
                                            <input required title="Required" type="text" name="sku[]"
                                                id="sku" placeholder="Enter SKU..." style="width: 120px">
                                            <input required title="Required" type="text" name="size[]"
                                                id="size" placeholder="Enter SIZE..." style="width: 120px">
                                            <input required title="Required" type="text" name="price[]"
                                                id="price" placeholder="Enter PRICE..." style="width: 120px">
                                            <input required title="Required" type="text" name="stock[]"
                                                id="stock" placeholder="Enter STOCK..." style="width: 120px">
                                            <a href="javascript:void(0);" class="add_button" title="Add field"><i
                                                    class="fas fa-plus"></i></a>
                                        </div>
                                    </div>
                                    @if (count($product['attributes']) > 0)
                                        <div class="form-group">
                                            <label>Attributes</label>
                                            <table cellpadding="5"
                                                style="background-color: #f5f5f5 !important; width: 100%;">
                                                <tr>
                                                    <th>SKU</th>
                                                    <th>Size</th>
                                                    <th>Price</th>
                                                    <th>Stock</th>
                                                    <th>Action</th>
                                                </tr>
                                                @foreach ($product['attributes'] as $attribute)
                                                    <input style="display: none;" type="text" name="attrId[]"
                                                        value="{{ $attribute['id'] }}">
                                                    <tr>
                                                        <td>{{ $attribute['sku'] }}</td>
                                                        <td>{{ $attribute['size'] }}</td>
                                                        <td>
                                                            <input style="width: 100px" type="number" name="price[]"
                                                                value="{{ $attribute['price'] }}" required>
                                                        </td>
                                                        <td>
                                                            <input style="width: 100px" type="number" name="stock[]"
                                                                value="{{ $attribute['stock'] }}" required>
                                                        </td>
                                                        <td>
                                                            @if ($attribute['status'] == 1)
                                                                <a class="updateAttributeStatus"
                                                                    id="attribute-{{ $attribute['id'] }}"
                                                                    href="javascript:void(0)"
                                                                    attribute_id="{{ $attribute['id'] }}"><i
                                                                        class="fas fa-toggle-on"></i></a>
                                                            @else
                                                                <a class="updateAttributeStatus"
                                                                    id="attribute-{{ $attribute['id'] }}"
                                                                    href="javascript:void(0)"
                                                                    attribute_id="{{ $attribute['id'] }}"><i
                                                                        class="fas fa-toggle-off"></i></a>
                                                            @endif
                                                            &nbsp;&nbsp;
                                                            <a class="confirmDelete" title="Delete Attribute"
                                                                href="javascript:void(0)" record='attribute'
                                                                recordid="{{ $attribute['id'] }}"><i
                                                                    class="fas fa-trash"></i></a>
                                                        </td>
                                                    </tr>
                                                @endforeach
                                            </table>
                                        </div>
                                    @endif
                                    <div class="form-group">
                                        <label for="product_video">Product Video (Recommended Size: less than 2 MB)</label>
                                        <input type="file" class="form-control" name="product_video"
                                            id="product_video">
                                        @if (!empty($product['product_video']))
                                            <a target="_blank"
                                                href="{{ url('front/video/products/' . $product['product_video']) }}">View
                                                Video</a>&nbsp;&nbsp;
                                            <a href="javascript::void(0)" class="confirmDelete" record='product-video'
                                                recordid="{{ $product['id'] }}"><i class="fas fa-trash"></i></a>
                                        @endif
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
                                        <textarea name="wash_care" id="wash_care" class="form-control" rows="3" placeholder="Enter Wash Care...">
                                            @if (!empty($product['wash_care']))
{{ $product['wash_care'] }}
@else
{{ old('wash_care') }}
@endif
                                        </textarea>
                                    </div>
                                    <div class="form-group">
                                        <label for="search_keywords">Search Keywords</label>
                                        <textarea name="search_keywords" id="search_keywords" class="form-control" rows="3"
                                            placeholder="Enter Wash Care...">
                                            @if (!empty($product['search_keywords']))
{{ $product['search_keywords'] }}
@else
{{ old('search_keywords') }}
@endif
                                        </textarea>
                                    </div>
                                    <div class="form-group">
                                        <label for="fabric">Select Fabric</label>
                                        <select name="fabric" id="fabric" class="form-control">
                                            <option value="">Select</option>
                                            @foreach ($product_filters['fabric_array'] as $fabric)
                                                <option value="{{ $fabric }}"
                                                    @if (!empty(@old('fabric')) && @old('fabric') == $fabric) selected
                                                @elseif(!empty($product['fabric']) && $product['fabric'] == $fabric)
                                                selected @endif>
                                                    {{ $fabric }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="form-group">
                                        <label for="pattern">Select Pattern</label>
                                        <select name="pattern" id="pattern" class="form-control">
                                            <option value="">Select</option>
                                            @foreach ($product_filters['pattern_array'] as $pattern)
                                                <option value="{{ $pattern }}"
                                                    @if (!empty(@old('pattern')) && @old('pattern') == $pattern) selected
                                                    @elseif(!empty($product['pattern']) && $product['pattern'] == $pattern)
                                                    selected @endif>
                                                    {{ $pattern }}
                                                </option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="form-group">
                                        <label for="sleeve">Select Sleeve</label>
                                        <select name="sleeve" id="sleeve" class="form-control">
                                            <option value="">Select</option>
                                            @foreach ($product_filters['sleeve_array'] as $sleeve)
                                                <option value="{{ $sleeve }}"
                                                    @if (!empty(@old('sleeve')) && @old('sleeve') == $sleeve) selected
                                                @elseif(!empty($product['sleeve']) && $product['sleeve'] == $sleeve)
                                                selected @endif>
                                                    {{ $sleeve }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="form-group">
                                        <label for="fit">Select Fit</label>
                                        <select name="fit" id="fit" class="form-control">
                                            <option value="">Select</option>
                                            @foreach ($product_filters['fit_array'] as $fit)
                                                <option value="{{ $fit }}"
                                                    @if (!empty(@old('fit')) && @old('fit') == $fit) selected
                                                @elseif(!empty($product['fit']) && $product['fit'] == $fit)
                                                selected @endif>
                                                    {{ $fit }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="form-group">
                                        <label for="occasion">Select Occasion</label>
                                        <select name="occasion" id="occasion" class="form-control">
                                            <option value="">Select</option>
                                            @foreach ($product_filters['occasion_array'] as $occasion)
                                                <option value="{{ $occasion }}"
                                                    @if (!empty(@old('occasion')) && @old('occasion') == $occasion) selected
                                                @elseif(!empty($product['occasion']) && $product['occasion'] == $occasion)
                                                selected @endif>
                                                    {{ $occasion }}</option>
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
                                    <div class="form-group">
                                        <label for="is_featured">Featured Item</label>
                                        <input type="checkbox" name="is_featured" id="is_featured" value="yes"
                                            @if (!empty($product['is_featured']) && $product['is_featured'] == 'yes') checked @endif>
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
