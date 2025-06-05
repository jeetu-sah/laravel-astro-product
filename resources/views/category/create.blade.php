@extends('layout.master')

@section('main-content')
<!-- Begin Page Content -->
<div class="container-fluid">

    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Create Category</h1>
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
                    <h6 class="m-0 font-weight-bold text-primary">Create Category</h6>
                    <a href="{{ route('catalog.category.index') }}"
                        class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm">
                        <i class="fas fa-list fa-sm text-white-50"></i> List Categories</a>
                </div>
                <!-- Card Body -->
                <div class="card-body">
                    <form action="{{ route('catalog.category.store') }}" method="POST">
                        @csrf
                        <div class="form-group">
                            <label for="parentCategory" class="small">Parent Category</label>
                            <select name="parentCategory" id="parentCategory" class="form-control form-control-sm select2">
                                <option value="">Select parent Category</option>
                                @forelse($categories as $category)
                                <option value="{{ $category->id }}">{{ $category->name }}</option>
                                @empty
                                <option value="">Parent Category Not available!!!</option>
                                @endforelse
                            </select>
                        </div>

                        <div class="form-group">
                            <label for="categoryName" class="small">Category Name</label>
                            <input type="text" class="form-control form-control-sm" id="categoryName" name="categoryName" placeholder="Enter Category Name" />
                        </div>

                        <div class="form-group">
                            <label for="status" class="small">Status</label>
                            <select name="status" id="status" class="form-control form-control-sm">
                                <option value="active">Active</option>
                                <option value="inactive">Inactive</option>
                            </select>
                        </div>

                        <div class="form-group">
                            <label for="editor" class="small">Short Description </label>
                            <textarea type="text" class="form-control form-control-sm"
                                id="shortDescription"
                                name="shortDescription"
                                placeholder="Enter Short Description"></textarea>

                        </div>
                        <div class="form-group">
                            <label for="editor" class="small">Description </label>
                            <div id="descriptionCategoryEditor" style="height: 200px;"></div>
                            <div style="display: none;">
                                <input type="text" name="descriptionCategory" id="descriptionCategory" />
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
    const quillCategory = new Quill('#descriptionCategoryEditor', {
        theme: 'snow'
    });
    $(document).on('blur', '#descriptionCategoryEditor', function(e) {
        e.preventDefault();
        $('#descriptionCategory').val(quillCategory.root.innerHTML);
    });
</script>
@endsection