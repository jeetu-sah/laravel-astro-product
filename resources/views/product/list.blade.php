@extends('layout.master')

@section('main-content')
<!-- Begin Page Content -->
<div class="container-fluid">

    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Product List</h1>
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
                    <h6 class="m-0 font-weight-bold text-primary">Product list</h6>
                    <a href="{{ route('catalog.product.create') }}"
                        class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm">
                        <i class="fas fa-plus fa-sm text-white-50"></i> Create Products</a>
                </div>
                <!-- Card Body -->
                <div class="card-body">


                    <table id="productsAjaxTable" class="display" style="width:100%">
                        <thead>
                            <tr>
                                <th>Image</th>
                                <th>Products No.</th>
                                <th>Name</th>
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

        new DataTable('#productsAjaxTable', {
            responsive: true,
            ajax: {
                url: "{{ url('catalog/product/agaxList') }}",
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
                    data: 'product_code'
                },
                {
                    data: 'name'
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