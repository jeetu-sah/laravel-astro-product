@extends('layout.master')

@section('main-content')
<!-- Begin Page Content -->
<div class="container-fluid">

    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Create Attribute Value</h1>
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
                    <h6 class="m-0 font-weight-bold text-primary">Create Attribute Value For {{$attribute->name ?? '--'}}</h6>
                    <a href="{{ route('attributes.index') }}"
                        class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm">
                        <i class="fas fa-list fa-sm text-white-50"></i> List Attributes</a>
                </div>
                <!-- Card Body -->
                <div class="card-body">
                    <form action="{{ route('attributes.attributes-values.store',['attributeId' => $attribute->id]) }}" method="POST">
                        @csrf
                        <div class="form-group">
                            <label for="categoryName" class="small">Attribute Value</label>
                            <input type="text" class="form-control form-control-sm" id="attributeValue"
                                name="attributeValue" placeholder="Enter Attribute Value" />
                        </div>
                        <div class="form-group">
                            <label for="categoryName" class="small">Sort Order</label>
                            <input type="number" class="form-control form-control-sm" id="sortOrder"
                                name="sortOrder" placeholder="Enter sort order" />
                        </div>

                        <button type="submit" name="submit" id="submit" class="btn btn-primary">Submit</button>
                    </form>
                </div>
            </div>
            <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary">Attribute Values</h6>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <div id="dataTable_wrapper" class="dataTables_wrapper dt-bootstrap4">

                            <div class="row">
                                <div class="col-sm-12">
                                    <table class="table table-bordered dataTable" id="dataTable" width="100%" cellspacing="0" role="grid" aria-describedby="dataTable_info" style="width: 100%;">
                                        <thead>
                                            <tr role="row">
                                                <th class="sorting sorting_asc" tabindex="0" aria-controls="dataTable" rowspan="1" colspan="1" aria-sort="ascending" aria-label="Name: activate to sort column descending" style="width: 145.333px;">Value</th>
                                                <th class="sorting" tabindex="0" aria-controls="dataTable" rowspan="1" colspan="1" aria-label="Position: activate to sort column ascending" style="width: 225.333px;">Slug</th>
                                                <th class="sorting" tabindex="0" aria-controls="dataTable" rowspan="1" colspan="1" aria-label="Office: activate to sort column ascending" style="width: 102.333px;">Sort Order</th>
                                                <th class="sorting" tabindex="0" aria-controls="dataTable" rowspan="1" colspan="1" aria-label="Age: activate to sort column ascending" style="width: 43.3333px;">Action</th>
                                            </tr>
                                        </thead>
                                        <tfoot>
                                            <tr>
                                                <th rowspan="1" colspan="1">Value</th>
                                                <th rowspan="1" colspan="1">slug</th>
                                                <th rowspan="1" colspan="1">Sort order</th>
                                                <th rowspan="1" colspan="1">Action</th>
                                            </tr>
                                        </tfoot>
                                        <tbody>
                                            @forelse($attributeValues as $attributeValue)
                                            <tr class="even">
                                                <td class="sorting_1">{{$attributeValue->value ?? '--'}}</td>
                                                <td>{{$attributeValue->slug ?? '--'}}</td>
                                                <td>{{$attributeValue->sort_order ?? '--'}}</td>
                                                <td>--</td>
                                            </tr>
                                            @empty
                                            <tr class="even">
                                                <td class="sorting_1">No record found.</td>
                                            </tr>
                                            @endforelse

                                        </tbody>
                                    </table>
                                </div>
                            </div>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

</div>
<!-- /.container-fluid -->
@endsection()