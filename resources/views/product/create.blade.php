@extends('layout.master')

@section('main-content')
<!-- Begin Page Content -->
<div class="container-fluid">

    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Create Product</h1>
        <!-- <a href="#" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm"><i
                class="fas fa-download fa-sm text-white-50"></i> Generate Report</a> -->
    </div>

    <!-- Content Row -->
    <div class="row">
        <!-- Area Chart -->
        <div class="col-xl-12 col-lg-12">
            <div class="card shadow mb-4">
                <!-- Card Header - Dropdown -->
                <div
                    class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                    <h6 class="m-0 font-weight-bold text-primary">Create Product</h6>
                    <a href="{{ route('catalog.product.index') }}"
                        class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm">
                        <i class="fas fa-list fa-sm text-white-50"></i> List Products</a>
                </div>
                <!-- Card Body -->
                <div class="card-body">
                    <form action="{{ route('catalog.product.store') }}" method="POST">
                        @csrf
                        <div class="form-group">
                            <label for="parentCategory" class="small">Select Product Category</label>
                            <select name="parentCategory" id="parentCategory" class="form-control form-control-sm select2">
                                <option value="">Select parent Category</option>
                                @forelse($categories as $category)
                                <option value="{{ $category->id }}" {{ old('parentCategory') == $category->id ? 'selected' : '' }}>
                                    {{ $category->name }}
                                </option>
                                @empty
                                <option value="">Parent Category Not available!!!</option>
                                @endforelse
                            </select>
                        </div>

                        <div class="form-group">
                            <label for="productName" class="small">Product Name</label>
                            <input type="text" class="form-control form-control-sm"
                                id="productName"
                                value="Demo Product"
                                name="productName"
                                placeholder="Enter Product Name" />
                        </div>
                        <div class="form-group row">
                            <div class="col-sm-6 mb-2">
                                <label for="productCode" class="small">Product Code</label>
                                <input type="text" value="DemoTest" class="form-control form-control-sm" id="productCode" name="productCode" placeholder="Enter Product Code" />
                            </div>
                            <div class="col-sm-6 mb-2">
                                <label for="productCode" class="small">Product Basic price</label>
                                <input type="text" value="{{ old('basic_price') }}" class="form-control form-control-sm" id="basic_price" name="basic_price" placeholder="Product Basic price" />
                            </div>
                            <div class="col-sm-6">
                                <label for="productType" class="small">Product Type</label>
                                <select name="productType" id="productType" class="form-control form-control-sm">
                                    <option value="simple-product">Simple Product</option>
                                    <option value="group-product">Group Product</option>
                                </select>
                            </div>
                            <div class="col-sm-6">
                                <label for="productStatus" class="small">Status</label>
                                <select name="productStatus" id="productStatus" class="form-control form-control-sm">
                                    <option value="draft">Draft</option>
                                    <option value="in-live">In Live</option>
                                </select>
                            </div>
                        </div>
                        <div class="form-group row">
                            <div class="col-sm-12">
                                <label for="meta_title" class="small">Meta Title</label>
                                <input type="text" id="meta_title" name="meta_title" class="form-control form-control-sm" placeholder="Meta Title" />
                            </div>
                        </div>
                        <div class="form-group row">
                            <div class="col-sm-12">
                                <label for="editor" class="small">Short Description</label>
                                <div id="shortDescriptionProductEditor" style="height: 200px;"></div>
                                <div style="display:none;">
                                    <input type="text" name="shortDescriptionProduct" id="shortDescriptionProduct" />
                                </div>
                            </div>
                        </div>
                        <div class="form-group row">
                            <div class="col-sm-12">
                                <label for="editor" class="small">Description</label>
                                <div id="descriptionProductEditor" style="height: 200px;"></div>
                                <div style="display:none;">
                                    <input type="text" name="descriptionProduct" id="descriptionProduct" />
                                </div>
                            </div>
                        </div>

                        <button type="submit" name="submit" id="submit" class="btn btn-primary">Submit</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

</div>
<!-- /.container-fluid -->
@endsection()
@section('script')
<script>
    const shortDescriptionQuillProduct = new Quill('#shortDescriptionProductEditor', {
        theme: 'snow'
    });

    $(document).on('blur', '#descriptionProductEditor', function(e) {
        e.preventDefault();
        $('#shortDescriptionProduct').val(shortDescriptionQuillProduct.root.innerHTML);
    });

    const descriptionProduct = new Quill('#descriptionProductEditor', {
        theme: 'snow'
    });

    $(document).on('blur', '#descriptionProductEditor', function(e) {
        e.preventDefault();
        $('#descriptionProduct').val(descriptionProduct.root.innerHTML);
    });
</script>
@endsection