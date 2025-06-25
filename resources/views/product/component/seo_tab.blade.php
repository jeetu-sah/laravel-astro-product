<div class="card shadow mb-4">
    <!-- Card Header - Accordion -->
    <a href="#collapseCardProductSeo" class="d-block card-header py-3"
        data-toggle="collapse" role="button" aria-expanded="true" aria-controls="collapseCardProductSeo">
        <h6 class="m-0 font-weight-bold text-primary">Product SEO Management</h6>
    </a>
    <!-- Card Content - Collapse -->
    <div class="collapse show" id="collapseCardProductSeo">
        <div class="card-body">
            <div class="col-lg-12">
                <!-- View Mode -->
                <div id="seoView">
                    <div class="mb-2"><strong>Meta Title:</strong> <span id="seoTitleText">Amazing Product</span></div>
                    <div class="mb-2"><strong>Meta Keywords:</strong> <span id="seoKeywordsText">fashion, clothing, shirt</span></div>
                    <div class="mb-2"><strong>Meta Description:</strong>
                        <p id="seoDescriptionText">This is a great product for people who love style and comfort.</p>
                    </div>
                    <button type="button" class="btn btn-sm btn-primary editSeo" data-tab="form">Edit</button>
                </div>

                <!-- Edit Mode -->
                <div id="seoEdit" style="display: none;">
                    <form action="{{ route('catalog.product.seo', ['id' => $product->id]) }}" data-request="ajaxSubmit" method="POST">
                        @csrf()
                        <div class="mb-3">
                            <label for="seoTitle" class="form-label">Meta Title</label>
                            <input type="text" class="form-control" name="meta_title" id="meta_title" value="{{$product->meta_title}}" />
                        </div>

                        <div class="mb-3">
                            <label for="seoKeywords" class="form-label">Meta Keywords</label>
                            <input type="text" class="form-control"
                                id="meta_keywords"
                                name="meta_keywords"
                                value="{{$product->meta_keyword}}" />
                        </div>

                        <div class="mb-3">
                            <label for="seoDescription" class="form-label">Meta Description</label>
                            <textarea class="form-control"
                                id="meta_description"
                                name="meta_description"
                                rows="3">{{$product->meta_description}}</textarea>
                        </div>

                        <button class="btn btn-sm btn-success ajaxSubmit" type="submit">Save</button>
                        <button type="button" class="btn btn-sm btn-secondary editSeo" data-tab="list">Cancel</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>