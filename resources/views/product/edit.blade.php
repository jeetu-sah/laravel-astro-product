@extends('layout.master')

@section('main-content')
<!-- Begin Page Content -->
<div class="container-fluid">
    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Product Details</h1>
        <a href='{{ url("product") }}' class="d-none d-sm-inline-block btn btn-sm btn-info"><i
                class="fas fa-arrow-left"></i> Back</a>
    </div>

    <!-- Content Row -->
    <div class="row">
        <!-- Area Chart -->
        <div class="col-xl-12 col-lg-12">

            <!--PRODUCTS DETAILS START-->
            @include('product.component.product_detail')
            <!--PRODUCTS DETAILS END-->

            <!--Product SEO COMPONENT START-->
            @include('product.component.seo_tab')
            <!--Product SEO COMPONENT END-->
            <div class="card shadow mb-4">
                <!-- Card Header - Accordion -->
                <a href="#collapseCardProductImage" class="d-block card-header py-3"
                    data-toggle="collapse" role="button" aria-expanded="true" aria-controls="collapseCardProductImage">
                    <h6 class="m-0 font-weight-bold text-primary">Product Images</h6>
                </a>
                <!-- Card Content - Collapse -->
                <div class="collapse show" id="collapseCardProductImage">
                    <div class="card-body">
                        <div class="col-lg-12">
                            <a href='{{ url("catalog/product/$product->id/upload-image") }}'
                                class="d-none d-sm-inline-block btn btn-md btn-success shadow-sm">
                                <i class="fas fa-images"></i> Upload Images</a>
                            <div class="row mt-3">
                                @foreach($productsImages as $image)

                                <div class="col-md-3">
                                    <div class="card">
                                        <img src="{{ asset('storage/app/private/'.$image->image_url) }}" class="card-img-top img-fluid" alt="..." style="width: 18rem; height: 18rem">

                                        <div class="card-body">
                                            <h5 class="card-title">{{$image->image_name ?? '--'}}</h5>
                                            <h5 class="card-title">{{$image->alt_name ?? '--'}}</h5>

                                            <input type="hidden" name="_token" value="9MuE1ge6VYQTIwT3qiROdrK2KpZvfZr5U0VUhaiq" autocomplete="off">
                                            <input type="hidden" name="_method" value="DELETE">
                                            <a href='{{ url("product/$product->id/delete-image/$image->id") }}' class="btn btn-danger deleteProductImage"><i class="fas fa-fw fa-trash"></i></a>
                                        </div>
                                    </div>
                                </div>
                                @endforeach
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

</div>
<!--DELETE PRODUCT CATEGORY IMAGES POPUP CODE START-->
<div class="modal" tabindex="-1" id="deleteProductImageModal" role="dialog">
    <div class="modal-dialog" role="document">
        <form action="" method="POST" id="deleteProductImageForm">
            @method('DELETE')

            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Delete Product Images</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="alert" id="alertInfo" role="alert" style="display: none;"></div>
                    <h4>Are you sure want to delete this record?</h4>
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-primary">Save changes</button>
                    <button type="button" class="btn btn-secondary closeProductDeleteImage" data-dismiss="modal">Close</button>
                </div>
            </div>
        </form>
    </div>
</div>
<!--DELETE PRODUCT CATEGORY IMAGES POPUP CODE START-->
<!-- /.container-fluid -->
@endsection()
@section('script')
<script>
    //edit seo
    $(document).on('click', '.editSeo', function(e) {
        e.preventDefault();
        let type = $(this).data('tab');
        if (type === 'form') {
            $('#seoView').hide();
            $('#seoEdit').show();
        } else {
            $('#seoView').show();
            $('#seoEdit').hide();
        }
    });
    //edit Product details
    $(document).on('click', '.editProductDetail', function(e) {
        e.preventDefault();
        let type = $(this).data('tab');
        if (type === 'form') {
            $('#productDetailView').hide();
            $('#productDetailEdit').show();

            $('.select2').select2({
                width: '100%'
            });
        } else {
            $('#productDetailView').show();
            $('#productDetailEdit').hide();
        }
    });
    //on delete button click.
    $(document).on('click', '.deleteProductImage', function(e) {
        e.preventDefault();
        const routeUrl = $(this).attr('href');
        $("#deleteProductImageForm").attr('action', routeUrl);
        $('#deleteProductImageModal').modal({
            keyboard: false,
            show: true,
            backdrop: 'static'
        });
    })

    $(document).on('submit', '#deleteProductImageForm', function(e) {
        e.preventDefault();
        $.ajax({
            url: $(this).attr('action'),
            method: 'DELETE',
            contentType: false,
            cache: false,
            processData: false,
            success: async function(response) {
                const result = jQuery.parseJSON(response);
                const alertClass = (result.status == 200) ? 'alert alert-success' : 'alert alert-danger';
                $("#alertInfo").show().removeClass().addClass(alertClass);
                if (result.status == 200) {
                    $('#alertInfo').html(result.msg)
                    setTimeout(() => {
                        $('.closeProductDeleteImage').click();
                        $("#alertInfo").removeClass().html('')
                    }, 1000)
                }
            },
            error: function(xhr) {
                alert('Something went wrong!');
                console.log(xhr.responseText);
            }
        });
    });

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