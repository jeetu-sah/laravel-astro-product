@extends('layout.master')

@section('main-content')
<!-- Begin Page Content -->
<div class="container-fluid">

    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Image Gallery</h1>
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
                    <h6 class="m-0 font-weight-bold text-primary">Upload Image</h6>
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
                    <form action="{{ route('image-gallery.store') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="form-group row">
                            <div class="col-sm-4">
                                <button type="button" id="addMore" class="btn btn-success"><i class="fas fa-fw fa-plus"></i></button>
                            </div>

                        </div>

                        <div class="form-group row">
                            <div class="col-sm-4">
                                <label for="imageName" class="small">Image Name</label>
                                <input type="text" class="form-control form-control-sm"
                                    name="imageName[]"
                                    value="test name"
                                    placeholder="Enter Image Name" />
                            </div>
                            <div class="col-sm-4">
                                <label for="altname" class="small">Image alt name</label>
                                <input type="text" class="form-control form-control-sm"
                                    value="Image alt name"
                                    name="altname[]"
                                    placeholder="Enter Alt Name" />
                            </div>
                            <div class="col-sm-3">
                                <label for="imageName" class="small">Choose File</label>
                                <input type="file" class="form-control form-control-sm"
                                    name="images[]"
                                    placeholder="Enter Alt Name" />
                            </div>

                        </div>
                        <div class="form-group row row-section-div" id="row-section" style="display: none;">
                            <div class="col-sm-4">
                                <label for="imageName" class="small">Image Name</label>
                                <input type="text" class="form-control form-control-sm"
                                    name="imageName[]"
                                    value="test name"
                                    placeholder="Enter Image Name" />
                            </div>
                            <div class="col-sm-4">
                                <label for="altname" class="small">Image alt name</label>
                                <input type="text" class="form-control form-control-sm"
                                    value="Image alt name"
                                    name="altname[]"
                                    placeholder="Enter Alt Name" />
                            </div>
                            <div class="col-sm-3">
                                <label for="imageName" class="small">Choose File</label>
                                <input type="file" class="form-control form-control-sm"
                                    name="images[]"
                                    placeholder="Enter Alt Name" />
                            </div>
                            <div class="col-sm-1">
                                <button style="margin-top: 25px;" type="button" class="btn btn-danger form-control-sm removeButton"><i class="fas fa-fw fa-trash"></i></button>
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
    $(document).on('click', '#addMore', function(e) {
        e.preventDefault();
        const rowSection = $('#row-section').html();
        const copySection = $("<div>", {
            "class": "form-group row row-section-div"
        });
        copySection.append(rowSection)
        $('#row-section').after(copySection);
    });

    $(document).on('click', '.removeButton', function(e) {
        e.preventDefault();
        $(this).closest('.row-section-div').remove();
    })
</script>
@endsection