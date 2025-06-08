@extends('layout.master')

@section('main-content')
<!-- Begin Page Content -->
<div class="container-fluid">

    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Product varient</h1>
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
                    <h6 class="m-0 font-weight-bold text-primary"> Varient of {{ $product->product_name ?? '--'}}</h6>
                    <a href="{{ route('catalog.product-varient.create', ['productId' => $product->id]) }}"
                        class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm">
                        <i class="fas fa-plus fa-sm text-white-50"></i> Create Products Varient </a>
                </div>
                <!-- Card Body -->
                <div class="card-body">
                    <table id="productsVarientsAjaxTable" class="display" style="width:100%">
                        <thead>
                            <tr>
                                <th>Image</th>
                                <th>Product SKU</th>
                                <th>Price</th>
                                <th>Stock</th>
                                <th>Status</th>
                                <th>Action Btns</th>
                            </tr>
                        </thead>
                    </table>
                </div>
            </div>
        </div>
    </div>

</div>
<!-- /.container-fluid -->
@endsection()

@section('script')
<script>
    $(document).ready(function() {
        let varientListUrl = "{{ route('catalog.product-varient.agaxList',['productId' => ':productId']) }}";
        let productId = "{{$product->id}}";
        const varientListRoutes = varientListUrl.replace(':productId', productId)
        console.log('varientListUrl', varientListRoutes)

        new DataTable('#productsVarientsAjaxTable', {
            responsive: true,
            ajax: {
                url: varientListRoutes,
                data: function(d) {
                    // Custom parameters can be added here if needed
                    // Example:
                    // d.filter = $('#filter-input').val();
                }
            },
            columns: [{
                    data: 'images'
                },
                {
                    data: 'product_sku'
                },
                {
                    data: 'price'
                },

                {
                    data: 'stock'
                },

                {
                    data: 'status'
                },

                {
                    data: 'action',

                    orderable: false
                }
            ],

            processing: true,
            serverSide: true
        });
    });
</script>

@endsection