@extends('layout.master')

@section('main-content')
<!-- Begin Page Content -->
<div class="container-fluid">

    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Upload Products Image</h1>
        <a href='{{ url("product/$product->id/edit") }}' class="d-none d-sm-inline-block btn btn-sm btn-info"><i
                class="fas fa-arrow-left"></i> Back</a>
    </div>

    <!-- Content Row -->
    <div class="row">
        <!-- Area Chart -->
        <div class="col-xl-12 col-lg-12">
            <div class="card shadow mb-4">
                <!-- Card Header - Dropdown -->
                <div
                    class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                    <h6 class="m-0 font-weight-bold text-primary">Upload Products Image</h6>
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
                    <form action='{{ url("product/$product->id/upload-image") }}' method="POST">
                        @csrf
                        <div class="row mb-5">
                            <div class="col-md-12" style="display: flex; justify-content: space-between">
                                <div style="display: inline-flex;">
                                    <input type="text" class="form-control" name="searchText" id="searchText" /> &nbsp; &nbsp;
                                    <button type="submit" class="btn btn-success form-control-sm" name="searchPhotos" id="searchPhotos"><i class="fas fa-fw fa-search"></i>&nbsp;Upload Images</button>
                                </div>
                                <div>
                                    <button type="submit" class="btn btn-primary form-control-sm" name="savePhotos" id="savePhotos"><i class="fas fa-fw fa-images"></i>&nbsp;Upload Images</button>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            @forelse($images as $image)
                            <div class="col-md-3">
                                <div class="card">
                                    <img src="{{ asset('storage/app/private/'.$image->image_url) }}" class="card-img-top img-fluid" alt="..." style="width: 18rem; height: 18rem">

                                    <div class="card-body">
                                        <h5 class="card-title">{{$image->image_name ?? ''}}</h5>
                                        <h5 class="card-title">{{$image->alt_name ?? ''}}</h5>
                                        <div class="custom-control custom-checkbox large">
                                            <input type="checkbox" class="custom-control-input" id="customCheck{{$image->id}}" name="images[]" value="{{ $image->id }}" />
                                            <label class="custom-control-label" for="customCheck{{$image->id}}">Select Image</label>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            @empty
                            <div class="col-md-3">
                                <div class="card" style="width: 18rem;">
                                    <img src="https://www.w3schools.com/bootstrap4/paris.jpg" class="card-img-top" alt="...">

                                    <div class="card-body">
                                        <a href="#" class="btn btn-primary">Go somewhere</a>
                                    </div>
                                </div>
                            </div>
                            @endforelse
                        </div>
                        @if($images->count() < 12)
                            <div class="row mt-5" style="display:flex; justify-content: center;">

                            <button type="button" class="btn btn-primary form-control-sm" name="savePhotos" id="savePhotos">Load More</button>
                </div>
                @endif
                </form>
            </div>
        </div>
    </div>
</div>

</div>
<!-- /.container-fluid -->
@endsection()