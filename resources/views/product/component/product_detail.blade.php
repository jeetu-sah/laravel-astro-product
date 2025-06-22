<div class="card shadow mb-4">
    <!-- Card Header - Accordion -->
    <a href="#collapseCardExample" class="d-block card-header py-3" data-toggle="collapse" role="button" aria-expanded="true" aria-controls="collapseCardExample">
        <h6 class="m-0 font-weight-bold text-primary">Product Details</h6>
    </a>
    <!-- Card Content - Collapse -->
    <div class="collapse show" id="collapseCardExample">
        <div class="card-body">
            <div class="col-lg-12">
                <!-- View Mode -->
                <div id="productDetailView">
                    <div class="mb-2"><strong>{{ __('Product Category')}}:</strong> <span>{{$product?->category?->name ?? '--'}}</span></div>
                    <div class="mb-2"><strong>{{ __('Product Name')}}:</strong> <span>{{$product->product_name ?? '--'}}</span></div>
                    <div class="mb-2"><strong>{{ __('Product code')}}:</strong> <span>{{$product->product_code ?? '--'}}</span></div>
                    <div class="mb-2"><strong>{{ __('Basic price')}}:</strong> <span>{{$product->basic_price ?? '--'}}</span></div>
                    <div class="mb-2"><strong>{{ __('Status')}}:</strong> <span>{{$product->product_status ?? '--'}}</span></div>
                    <div class="mb-2"><strong>{{ __('Product Type')}}:</strong> <span>{{$product->product_type ?? '--'}}</span></div>
                    <div class="mb-2"><strong>{{ __('Short Description')}}:</strong>
                        <p id="seoDescriptionText">
                            {!! $product->short_description ?? '--' !!}
                        </p>
                    </div>
                    <div class="mb-2"><strong>{{ __('Description')}}:</strong>
                        <p id="seoDescriptionText">
                            {!! $product->description ?? '--' !!}
                        </p>
                    </div>
                    <button type="button" class="btn btn-sm btn-primary editProductDetail" data-tab="form">{{ __('Edit')}}</button>
                </div>

                <!-- Edit Mode -->
                <div id="productDetailEdit" style="display: none;">
                    <form action="{{ route('catalog.product.product_details', ['id' => $product->id]) }}" method="POST">
                        @csrf()
                        <div class="form-group">
                            <label for="parentCategory" class="small">Select Product Category</label>
                            <select name="parentCategory" id="parentCategory"
                                class="form-control form-control-sm select2">
                                <option value="">Select parent Category</option>
                                @forelse($categories as $category)
                                <option value="{{ $category->id }}"
                                    {{  $product->id == $category->id ? 'selected' : '' }}>
                                    {{ $category->name }}
                                </option>
                                @empty
                                <option value="">Parent Category Not available!!!</option>
                                @endforelse
                            </select>
                        </div>

                        <div class="form-group">
                            <label for="productName" class="small">Product Name</label>
                            <input type="text" class="form-control form-control-sm"
                                id="productName"
                                value="{{$product->product_name}}"
                                name="productName"
                                placeholder="Enter Product Name" />
                        </div>
                        <div class="form-group row">
                            <div class="col-sm-6 mb-2">
                                <label for="productCode" class="small">Product Code</label>
                                <input type="text"
                                    value="{{$product->product_code}}"
                                    class="form-control form-control-sm"
                                    id="productCode" name="productCode" placeholder="Enter Product Code" />
                            </div>
                            <div class="col-sm-6 mb-2">
                                <label for="productCode" class="small">Product Basic price</label>
                                <input type="text"
                                    value="{{$product->basic_price}}"
                                    class="form-control form-control-sm"
                                    id="basic_price"
                                    name="basic_price"
                                    placeholder="Product Basic price" />
                            </div>
                            <div class="col-sm-6">
                                <label for="productType" class="small">Product Type</label>
                                <select name="productType" id="productType" class="form-control form-control-sm">
                                    @forelse($productTypes as $productType)
                                    <option value="{{$productType->slug}}" {{ ($product->product_type == $productType->slug) ? 'selected' : ''}}>{{$productType->name}}</option>

                                    @empty
                                    <option value="group-product">No record Found</option>
                                    @endforelse

                                </select>
                            </div>
                            <div class="col-sm-6">
                                <label for="productStatus" class="small">Status</label>
                                <select name="productStatus" id="productStatus" class="form-control form-control-sm">
                                    <option value="draft">Draft</option>
                                    <option value="in-live">In Live</option>
                                </select>
                            </div>
                        </div>

                        <div class="form-group row">
                            <div class="col-sm-12">
                                <label for="editor" class="small">Short Description</label>
                                <div id="shortDescriptionProductEditor" style="height: 200px;">
                                    {!! $product->short_description !!}
                                </div>
                                <div style="display:none;">
                                    <input type="text" name="shortDescriptionProduct" id="shortDescriptionProduct" value="{{$product->short_description}}" />
                                </div>
                            </div>
                        </div>
                        <div class="form-group row">
                            <div class="col-sm-12">
                                <label for="editor" class="small">Description</label>
                                <div id="descriptionProductEditor" style="height: 200px;">
                                    {!! $product->description !!}
                                </div>
                                <div style="display:none;">
                                    <input type="text" name="descriptionProduct" id="descriptionProduct" value="{{$product->description}}" />
                                </div>
                            </div>
                        </div>

                        <button class="btn btn-sm btn-success ajaxSubmit" data-submit="ajaxSubmit" type="submit">{{ __('Save')}}</button>
                        <button type="button" class="btn btn-sm btn-secondary editProductDetail" data-tab="list">{{ __('Cancel')}}</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>