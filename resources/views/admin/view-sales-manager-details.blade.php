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
                    <h4 class="fw-bold">Sales Manager Details</h4>
                    <h6>Manage your Sales Manager</h6>
                </div>
            </div>
            <div class="page-btn">
                <a href="#" class="btn btn-primary addOfficeTeam" data-bs-toggle="modal" data-bs-target="#addOfficeTeam" id ='Add'>
                    <i class="ti ti-circle-plus me-1"></i>Add User
                </a>
            </div>  
        </div>

        <!-- Sales Manager Table -->
        <div class="card">
            <div class="card-body p-0">
                <div class="table-responsive">
                    <table class="table datatable">
                        <thead class="thead-light">
                            <tr>
                                <th>Coordinator</th>
                                <th>Reporting Manager</th>
                                <th>Business category</th>
                                                     
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

<div class="modal fade" id="modalId">
    <div class="modal-dialog " role="document">
        <form method="POST" class="needs-validation" action="{{route('storeSalesManager')}}">
			@csrf
            <div class="modal-content">
                <div class="modal-header">
					
                    <h5 class="modal-title" id="modalTitleId">
                        Teams
                    </h5>
					<button type="button" class="close bg-danger text-white fs-16" data-bs-dismiss="modal" aria-label="Close">
						<span aria-hidden="true">&times;</span>
					</button>
                </div>
                <div class="modal-body">
					<input type="hidden" name="id" value = "{{ $id }}">
                    <div class="mb-3 col-md-12">
                        <label for=" " class="form-label">Sales Coordinator</label>
                        <select class="form-select" id="sales_coordinator" name="sales_coordinator" required>
                            <option value="">----Select Coordinator----</option>
                           	@foreach($coordinators as $id => $name)
							<option value="{{ $id }}">{{ $name }}</option>
							@endforeach
                        </select>
                    </div>

                    <div class="mb-3 col-md-12">
                        <label for=" " class="form-label">Business Category</label>
                        <select class="select2" id="business_category" name="business_category[]" multiple="multiple" required>
                        </select>
                    </div>

                    <div class="mb-3 col-md-12">
                        <label for=" " class="form-label">Reporting Manager</label>
                        <select class="select2" id="vp" name="vp" required>

                        </select>
                    </div>
                </div>
                <div class="modal-footer">
                  	<button type="button" class="btn me-2 btn-secondary" data-bs-dismiss="modal">Cancel</button>
					<button type="submit" class="btn btn-primary" id = 'submitBtn' >Add user</button>
                </div>
            </div>
        </form>
    </div>
</div>

<script>
    $("#Add").on("click", function() {
        $("#modalId").modal("show");
    })
    $("#sales_coordinator").on("change", function() {
        $.ajax({
            method: 'POST',
            url: "{{ route('getCoordinatorData') }}",
            dataType: 'text',
            data: {
            id: $(this).val(),
            user_type: "{{ $user_type }}",
				_token: "{{ csrf_token() }}"
			},
            success: function(data) {
                data = JSON.parse(data);
                var html = "";
                data.data.business_category.forEach(element => {
                    html += "<option value=" + element.id + ">" + element.name + "</option>";
                });
                $("#business_category").html(html).trigger('change');
                var vp = "";
                data.data.vp.forEach(element => {
                    vp += "<option value=" + element.id + ">" + element.name + "</option>";
                });
                $("#vp").html(vp)

            },
            complete: function(data) {
                $('#wait').hide();
            }
        });

    });
</script>
@endsection