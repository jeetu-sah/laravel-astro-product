@extends('layout.master')

@section('main-content')
<!-- Begin Page Content -->
<div class="container-fluid">
    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Product Details</h1>
        <a href="#" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm"><i
                class="fas fa-download fa-sm text-white-50"></i> Generate Report</a>
    </div>

    <!-- Content Row -->
    <div class="row">
        <!-- Area Chart -->
        <div class="col-xl-12 col-lg-12">
            <div class="card shadow mb-4">
                <!-- Card Header - Accordion -->
                <a href="#collapseCardExample" class="d-block card-header py-3" data-toggle="collapse" role="button" aria-expanded="true" aria-controls="collapseCardExample">
                    <h6 class="m-0 font-weight-bold text-primary">Product Details</h6>
                </a>
                <!-- Card Content - Collapse -->
                <div class="collapse show" id="collapseCardExample">
                    <div class="card-body">
                        <div class="col-lg-7">
                            <form class="ps-lg-4">
                                <!-- Product title -->
                                <h3 class="mt-0 font-weight-bold text-success text-uppercase mb-1">{{ $product->product_name  ?? '--'}} ({{ $product->product_code ?? ''}}) <a href="javascript: void(0);" class="text-muted"><i class="fas fa-fw fa-edit"></i></a> </h3>
                                <p class="mb-1">Added Date: 09/12/2018</p>
                                <p class="font-16">
                                    <span class="text-warning mdi mdi-star"></span>
                                    <span class="text-warning mdi mdi-star"></span>
                                    <span class="text-warning mdi mdi-star"></span>
                                    <span class="text-warning mdi mdi-star"></span>
                                    <span class="text-warning mdi mdi-star"></span>
                                </p>

                                <!-- Product stock -->
                                <div class="mt-3">
                                    <h4><span class="badge badge-danger">Instock</span></h4>
                                </div>

                                <!-- Product description -->
                                <div class="mt-4">
                                    <h6 class="font-14">Price:</h6>
                                    <h3> $ {{$product->price}}</h3>
                                </div>
                                <div class="mt-4">
                                    <h6 class="font-14">Selling Price:</h6>
                                    <h3> $ {{$product->selling_price}}</h3>
                                </div>

                                <!-- Quantity -->
                                <div class="mt-4">
                                    <h6 class="font-14">Quantity</h6>
                                    <div class="d-flex">
                                        <input type="number" min="1" value="1" class="form-control" placeholder="Qty" style="width: 90px;">
                                        &nbsp;
                                        &nbsp;
                                        <button type="button" class="btn btn-danger ms-2"><i class="mdi mdi-cart me-1"></i> Add to cart</button>
                                    </div>
                                </div>

                                <!-- Product description -->
                                <div class="mt-4">
                                    <h6 class="font-14">Short Description:</h6>
                                    <p>{!! $product->short_description ?? '--' !!} </p>
                                </div>
                                <div class="mt-4">
                                    <h6 class="font-14">Description:</h6>
                                    <p>{!! $product->description ?? '--' !!} </p>
                                </div>

                                <!-- Product information -->
                                <div class="mt-4">
                                    <div class="row">
                                        <div class="col-md-4">
                                            <h6 class="font-14">Available Stock:</h6>
                                            <p class="text-sm lh-150">1784</p>
                                        </div>
                                        <div class="col-md-4">
                                            <h6 class="font-14">Number of Orders:</h6>
                                            <p class="text-sm lh-150">5,458</p>
                                        </div>
                                        <div class="col-md-4">
                                            <h6 class="font-14">Revenue:</h6>
                                            <p class="text-sm lh-150">$8,57,014</p>
                                        </div>
                                    </div>
                                </div>

                            </form>
                        </div>
                    </div>
                </div>
            </div>
            <div class="card shadow mb-4">
                <!-- Card Header - Accordion -->
                <a href="#collapseCardProductImage" class="d-block card-header py-3" data-toggle="collapse" role="button" aria-expanded="true" aria-controls="collapseCardProductImage">
                    <h6 class="m-0 font-weight-bold text-primary">Product Images</h6>
                </a>
                <!-- Card Content - Collapse -->
                <div class="collapse show" id="collapseCardProductImage">
                    <div class="card-body">
                        <div class="col-lg-7">
                            <a href='{{ url("product/$product->id/upload-image") }}'
                                class="d-none d-sm-inline-block btn btn-md btn-success shadow-sm">
                                <i class="fas fa-images"></i> Upload Images</a>
                        </div>
                    </div>
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