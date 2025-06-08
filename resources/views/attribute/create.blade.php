@extends('layout.master')

@section('main-content')
<!-- Begin Page Content -->
<div class="container-fluid">

    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Create Attribute</h1>
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
                    <h6 class="m-0 font-weight-bold text-primary">Create Attribute</h6>
                    <a href="{{ route('attributes.index') }}"
                        class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm">
                        <i class="fas fa-list fa-sm text-white-50"></i> List Attribute</a>
                </div>
                <!-- Card Body -->
                <div class="card-body">
                    <form action="{{ route('attributes.store') }}" method="POST">
                        @csrf

                        <div class="form-group row">
                            <div class="col-sm-6">
                                <label for="attribute_name" class="small">Name</label>
                                <input type="text" class="form-control form-control-sm" id="attribute_name" name="attribute_name" placeholder="Enter Attribute Name" />
                            </div>
                            <div class="col-sm-6">
                                <label for="attribute_code" class="small">Code</label>
                                <input type="text" class="form-control form-control-sm" id="attribute_code" name="attribute_code" placeholder="Enter Attribute Code" />
                            </div>
                        </div>

                        <div class="form-group row mt-2">
                            <div class="col-sm-4">
                                <label for="is_required" class="small">Is Required</label>
                                <select name="is_required" id="is_required" class="form-control form-control-sm">
                                    <option value="yes">YES</option>
                                    <option value="no">NO</option>
                                </select>
                            </div>
                            <div class="col-sm-4">
                                <label for="is_filterable" class="small">Is Filterable</label>
                                <select name="is_filterable" id="is_filterable" class="form-control form-control-sm">
                                    <option value="yes">YES</option>
                                    <option value="no">NO</option>
                                </select>
                            </div>
                            <div class="col-sm-4">
                                <label for="status" class="small">Status</label>
                                <select name="status" id="status" class="form-control form-control-sm">
                                    <option value="active">Active</option>
                                    <option value="inactive">Inactive</option>
                                </select>
                            </div>
                        </div>
                        <div class="form-group row mt-2">
                            <div class="col-sm-4">
                                <label for="type" class="small">Type</label>
                                <select name="type" id="type" class="form-control form-control-sm">
                                    @forelse($fieldTypes as $fieldType)
                                    <option value="{{ $fieldType->code }}">{{$fieldType->label}}</option>
                                    @empty
                                    <option disabled>No record found</option>
                                    @endforelse
                                </select>
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="editor" class="small">Description </label>
                            <div id="descriptionAttributeEditor" style="height: 200px;"></div>
                            <div style="display: none;">
                                <input type="text" name="description" id="descriptionAttribute" />
                            </div>
                        </div>

                        <button type="submit" name="submit" id="submit" class="btn btn-primary">Create</button>
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
    const quillCategory = new Quill('#descriptionAttributeEditor', {
        theme: 'snow'
    });
    $(document).on('blur', '#descriptionAttributeEditor', function(e) {
        e.preventDefault();
        $('#descriptionAttribute').val(quillCategory.root.innerHTML);
    });
</script>
@endsection