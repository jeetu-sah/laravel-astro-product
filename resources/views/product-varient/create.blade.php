@extends('layout.master')

@section('main-content')
<!-- Begin Page Content -->
<div class="container-fluid">

    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Create product varient</h1>
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
                    <h6 class="m-0 font-weight-bold text-primary">Create Product varient for {{$product->product_name}}</h6>
                    <a href="{{ route('catalog.product.index') }}"
                        class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm">
                        <i class="fas fa-list fa-sm text-white-50"></i> List Products</a>
                </div>
                <!-- Card Body -->
                <div class="card-body">
                    <form action="{{ route('catalog.product-varient.store', ['productId' => $product->id ]) }}" method="POST">
                        @csrf
                        <div class="form-group row">
                            @forelse($productAttributes as $attribute)
                                @include('field-generator.field_generator', ['attribute' => $attribute])
                            <!-- <div class="col-sm-4">
                                <label for="price" class="small">{{$attribute->name}}</label>
                                
                                <input type="number" class="form-control form-control-sm" id="price" name="price" placeholder="Price" value="10" />
                            </div> -->
                            @empty
                            <h1>There is no products attributes available!!!</h1>
                            @endforelse

                            <div class="col-sm-4 mb-4">
                                <label for="quantity" class="small">Quantity</label>
                                <input type="number" class="form-control form-control-sm" id="quantity" name="quantity" placeholder="Enter Product Quantity" value="100" />
                            </div>
                            <div class="col-sm-4 mb-4">
                                <label for="alertQuantity" class="small">Alert Quantity</label>
                                <input type="number" class="form-control form-control-sm" 
                                    id="alertQuantity" 
                                    name="alertQuantity" 
                                    placeholder="Enter Alert Quantity" value="{{ old('alertQuantity') }}" />
                            </div>
                            <div class="col-sm-4 mb-4">
                                <label for="availableStatus" class="small">Available Status</label>
                                <select name="availableStatus" id="availableStatus" class="form-control form-control-sm">
                                    <option value="available">Available</option>
                                    <option value="out-of-stock">Out Of Stock</option>
                                </select>
                            </div>
                            <div class="col-sm-4 mb-4">
                                <label for="availableStatus" class="small">Product SKU</label>
                                <input type="text" class="form-control form-control-sm" 
                                    id="product_sku" 
                                    name="product_sku" 
                                    placeholder="Enter Product SKU" value="{{ old('product_sku') }}"  />

                            </div>
                            <div class="col-sm-4">
                                <label for="price" class="small">Product Price</label>
                                <input type="text" class="form-control form-control-sm" id="price" name="price" placeholder="Enter Price" value="{{ old('price') }}" />

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