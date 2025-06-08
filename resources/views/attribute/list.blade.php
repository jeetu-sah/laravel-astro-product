@extends('layout.master')

@section('main-content')
<!-- Begin Page Content -->
<div class="container-fluid">

    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Attribute list</h1>
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
                    <h6 class="m-0 font-weight-bold text-primary">Attribute list</h6>
                    <a href="{{ route('attributes.create') }}" 
                        class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm">
                        <i class="fas fa-plus fa-sm text-white-50"></i> Create Attribute</a>

                </div>
                <!-- Card Body -->
                <div class="card-body">
                    <table id="categoryAjaxTable" class="display" style="width:100%">
                        <thead>
                            <tr>
                            
                                <th>Name</th>
                                <th>Type</th>
                                <th>Status</th>
                                <th>Action </th>
                            </tr>
                        </thead>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="modal" tabindex="-1" id="myModal" role="dialog">
    <div class="modal-dialog" role="document">
        <form action="" method="POST" id="deleteCategoryForm">
            @method('DELETE')

            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Delete Category</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <h4>Are you sure want to delete this record?</h4>
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-primary">Save changes</button>
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                </div>
            </div>
        </form>
    </div>
</div>
<!-- /.container-fluid -->
@endsection()

@section('script')
<script>
    $(document).ready(function() {
        new DataTable('#categoryAjaxTable', {
            responsive: true,
            ajax: {
                url: "{{ url('attributes/ajaxlist') }}",
                data: function(d) {
                    // Custom parameters can be added here if needed
                    // Example:
                    // d.filter = $('#filter-input').val();
                }
            },
            columns: [
                {
                    data: 'name'
                },

                {
                    data: 'type'
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

        //on delete button click.
        $(document).on('click', '.deleteCategory', function(e) {
            e.preventDefault();
            const routeUrl = $(this).attr('href');
            $("#deleteCategoryForm").attr('action', routeUrl);

            $('#myModal').modal({
                keyboard: false,
                show: true,
                backdrop: 'static'
            })
        })

        //deleteCategoryForm
        $(document).on('submit', '#deleteCategoryForm', function(e) {
            e.preventDefault();
            $.ajax({
                url: $(this).attr('action'),
                method: 'DELETE',
                contentType: false,
                cache: false,
                processData: false,
                success: async function(response) {
                    await $('#categoryAjaxTable').DataTable().ajax.reload(null, false);
                },
                error: function(xhr) {
                    alert('Something went wrong!');
                    console.log(xhr.responseText);
                }
            });
        });
    });
</script>

@endsection