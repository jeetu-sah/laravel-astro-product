@extends('layout.master')

@section('main-content')
<!-- Begin Page Content -->
<div class="container-fluid">

    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Create Product</h1>
        <a href="#" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm"><i
                class="fas fa-download fa-sm text-white-50"></i> Generate Report</a>
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
                    <div class="dropdown no-arrow">
                        <a class="dropdown-toggle" href="#" role="button" id="dropdownMenuLink"
                            data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            <i class="fas fa-ellipsis-v fa-sm fa-fw text-gray-400"></i>
                        </a>
                        <div class="dropdown-menu dropdown-menu-right shadow animated--fade-in"
                            aria-labelledby="dropdownMenuLink">
                            <div class="dropdown-header">Dropdown Header:</div>
                            <a class="dropdown-item" href="#">Action</a>
                            <a class="dropdown-item" href="#">Another action</a>
                            <div class="dropdown-divider"></div>
                            <a class="dropdown-item" href="#">Something else here</a>
                        </div>
                    </div>
                </div>
                <!-- Card Body -->
                <div class="card-body">
                    <form action="{{ route('product.store') }}" method="POST">
                        @csrf
                        <!-- <div class="form-group">
                            <label for="categoryName" class="small">Select Product Category</label>
                            <select name="parentCategory" id="parentCategory" class="form-control form-control-sm">
                                <option value="">Select parent Category</option>
                                @forelse($categories as $category)
                                <option value="{{$category->id}}">{{$category->name}}</option>
                                @empty
                                <option value="">Parent Category Not available!!!</option>
                                @endforelse()

                            </select>
                        </div> -->
                        <div class="form-group">
                            <label for="parentCategory" class="small">Select Product Category</label>
                            <select name="parentCategory" id="parentCategory" class="form-control form-control-sm select2">
                                <option value="">Select parent Category</option>
                                @forelse($categories as $category)
                                <option value="{{ $category->id }}">{{ $category->name }}</option>
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
                            <div class="col-sm-4">
                                <label for="productCode" class="small">Product Code</label>
                                <input type="text" value="DemoTest" class="form-control form-control-sm" id="productCode" name="productCode" placeholder="Enter Product Code" />
                            </div>
                            <div class="col-sm-4">
                                <label for="price" class="small">Price</label>
                                <input type="number" class="form-control form-control-sm" id="price" name="price" placeholder="Price" value="10" />
                            </div>
                            <div class="col-sm-4">
                                <label for="sellingPrice" class="small">Selling Price</label>
                                <input type="number" class="form-control form-control-sm" id="price" name="sellingPrice" placeholder="Selling Price" value="8" />
                            </div>
                        </div>

                        <div class="form-group row">
                            <div class="col-sm-4">
                                <label for="quantity" class="small">Quantity</label>
                                <input type="number" class="form-control form-control-sm" id="quantity" name="quantity" placeholder="Enter Product Quantity" value="100" />
                            </div>
                            <div class="col-sm-4">
                                <label for="alertQuantity" class="small">Alert Quantity</label>
                                <input type="number" class="form-control form-control-sm" id="alertQuantity" name="alertQuantity" placeholder="Enter Alert Quantity" value="10" />
                            </div>
                            <div class="col-sm-4">
                                <label for="productType" class="small">Product Type</label>
                                <select name="productType" id="productType" class="form-control form-control-sm">
                                    <option value="simple-product">Simple Product</option>
                                    <option value="group-product">Group Product</option>
                                </select>
                            </div>

                        </div>
                        <div class="form-group row">
                            <div class="col-sm-4">
                                <label for="productStatus" class="small">Status</label>
                                <select name="productStatus" id="productStatus" class="form-control form-control-sm">
                                    <option value="draft">Draft</option>
                                    <option value="in-live">In Live</option>
                                </select>
                            </div>
                            <div class="col-sm-4">
                                <label for="availableStatus" class="small">Available Status</label>
                                <select name="availableStatus" id="availableStatus" class="form-control form-control-sm">
                                    <option value="available">Available</option>
                                    <option value="out-of-stock">Out Of Stock</option>
                                </select>
                            </div>
                            <div class="col-sm-4">
                                <label for="availableStatus" class="small">Product SKU</label>
                                <input type="text" class="form-control form-control-sm" id="product_sku" name="product_sku" placeholder="Enter Alert Quantity" value="PRODUCTSKU" />

                            </div>

                        </div>
                        <div class="form-group row">
                            <div class="col-sm-12">
                                <label for="editor" class="small">Description <span class="text-danger">*</span></label>
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
    const quillProduct = new Quill('#descriptionProductEditor', {
        theme: 'snow'
    });
    $(document).on('blur', '#descriptionProductEditor', function(e) {
        e.preventDefault();
        $('#descriptionProduct').val(quillProduct.root.innerHTML);
    });
</script>
@endsection