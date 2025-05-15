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
                    <h6 class="m-0 font-weight-bold text-primary">Image Gallery</h6>
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
                        <div class="row mb-5">
                            <div class="col-md-12">
                                <button type="submit" class="btn btn-primary form-control-sm" name="savePhotos" id="savePhotos">Submit</button>
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
                                        <form action="{{ route('image-gallery.destroy', [$image->id]) }}" method="POST">
                                            @csrf
                                            @method('DELETE')

                                            <button type="submit" class="btn btn-danger"><i class="fas fa-fw fa-trash"></i></button>
                                        </form>
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

