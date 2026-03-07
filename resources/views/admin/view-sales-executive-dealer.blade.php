@extends('admin.layout.main')
@section('main-section')
@push('title')
<title>Dashboard</title>
@endpush
	<div class="page-wrapper">
    <div class="content">
        <div class="page-header">
            <div class="add-item d-flex">
                <div class="page-title">
                    <h4 class="fw-bold">Dealer Details</h4>
                    <h6>Manage your Dealers</h6>
                </div>
            </div>
            <div class="page-btn">
                <a href="#" class="btn btn-primary addOfficeTeam" data-bs-toggle="modal" data-bs-target="#addOfficeTeam" id ='Add'>
                    <i class="ti ti-circle-plus me-1"></i>Add User
                </a>
            </div>  
        </div>

        <!-- Sales Manager Table -->
        <div class="card mt-3">
            <div class="card-body p-0">
                <div class="table-responsive">
                    <table class="table datatable">
                        <thead class="thead-light">
                            <tr>
                                <th>#</th>
                                <th>S.no</th>
                                <th>Name</th>
                                <th>Phone</th>
                                <th>Email</th>
                                <th>Designation</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($data as $row)
                                <tr>
                                    <td>{{ $row['coordinator'] }}</td>
                                    <td>{{ $row['reporting_manager'] }}</td>
                                    <td>{{ $row['business_categories'] }}</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
          <div class="card">
            <div class="card-body p-0">
                <div class="table-responsive">
                    <table class="table datatable">
                        <thead class="thead-light">
                            <tr>
                                <th>#</th>
                                <th>S.no</th>
                                <th>Name</th>
                                <th>Phone</th>
                                <th>Email</th>
                                <th>Designation</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($data as $row)
                                <tr>
                                    <td>{{ $row['coordinator'] }}</td>
                                    <td>{{ $row['reporting_manager'] }}</td>
                                    <td>{{ $row['business_categories'] }}</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
         
    </div>
</div>
@endsection