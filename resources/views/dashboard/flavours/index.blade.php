@extends('dashboard.layouts.master')
@section('css')
<!-- Internal Data table css -->
<link href="{{URL::asset('dashboard/plugins/datatable/css/dataTables.bootstrap4.min.css')}}" rel="stylesheet" />
<link href="{{URL::asset('dashboard/plugins/datatable/css/buttons.bootstrap4.min.css')}}" rel="stylesheet">
<link href="{{URL::asset('dashboard/plugins/datatable/css/responsive.bootstrap4.min.css')}}" rel="stylesheet" />
<link href="{{URL::asset('dashboard/plugins/datatable/css/jquery.dataTables.min.css')}}" rel="stylesheet">
<link href="{{URL::asset('dashboard/plugins/datatable/css/responsive.dataTables.min.css')}}" rel="stylesheet">
<link href="{{URL::asset('dashboard/plugins/select2/css/select2.min.css')}}" rel="stylesheet">
@endsection
@section('page-header')
		<!-- breadcrumb -->
        <div class="breadcrumb-header justify-content-between">
            
        </div>
        <!-- breadcrumb -->
@endsection
@section('content')
		<!-- row opened -->
		<div class="row row-sm">
			<div class="col-xl-12">
				<div class="card">

					<div class="card-header pb-0">
						<div class="d-flex justify-content-between">
							
							<a href="{{route('flavours.create')}}" 
							class="btn btn-primary" role="button" aria-pressed="true">New Flavour`</a>

							<button type="button"
							class="btn btn-secondary pd-x-30 mg-r-5 mg-t-5"
							onclick="window.history.back();">
							Back
							</button>
							
						</div>
					</div>

					<div class="card-header pb-0">
						<div class="d-flex justify-content-between">
							<h4 class="card-title mg-b-0">Flavours</h4>
							<i class="mdi mdi-dots-horizontal text-gray"></i>
						</div>
						<p class="tx-12 tx-gray-500 mb-2">Example of Valex Simple Table.</p>
					</div>
					<div class="card-body">
						<div class="table-responsive">
							<table class="table text-md-nowrap" id="example1">
								<thead>
									<tr>
										<th class="wd-15p border-bottom-0">Name</th>
                                    	<th class="wd-20p border-bottom-0">Components</th>

										<th class="wd-15p border-bottom-0">Created</th>
										<th class="wd-10p border-bottom-0">Update</th>
										<th class="wd-25p border-bottom-0">Actions</th>
									</tr>
								</thead>
								<tbody>
									@foreach ($flavours as $flavour )
										<tr>
											<td>{{$flavour->name}}</td>
                                    		<td>{{$flavour->components_count}}</td>

											<td>{{$flavour->created_at}}</td>
											<td>{{$flavour->updated_at}}</td>
											<td>
												<div class="dropdown">
													<button class="btn btn-sm btn-primary dropdown-toggle" type="button" id="dropdownMenuButton{{ $flavour->id }}" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
														Actions
													</button>
													<div class="dropdown-menu" aria-labelledby="dropdownMenuButton{{ $flavour->id }}">
														<a class="dropdown-item modal-effect text-info" data-effect="effect-scale"
														data-toggle="modal"
														href="#edit{{ $flavour->id }}">
															<i class="las la-pen"></i> Edit
														</a>
														
													
														<form action="{{ route('flavours.destroy', $flavour->id) }}" method="POST" 
															{{-- onsubmit="return confirm('Are you sure you want to delete this brand?');"  --}}
															style="display:inline;">
															@csrf
															@method('DELETE')
															<button type="submit" class="dropdown-item modal-effect text-danger">
																<i class="las la-trash"></i> Delete
															</button>
														</form>
														<a class="dropdown-item modal-effect text-warning" data-effect="effect-scale" 
														{{-- href="#delete{{ $flavour->id }}" --}}
														>
															<i class="las la-eye"></i> Show
														</a>
													</div>

												</div>
											</td>
											@include('dashboard.flavours.edit')
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
@section('js')
<!-- Internal Data tables -->
<script src="{{URL::asset('dashboard/plugins/datatable/js/jquery.dataTables.min.js')}}"></script>
<script src="{{URL::asset('dashboard/plugins/datatable/js/dataTables.dataTables.min.js')}}"></script>
<script src="{{URL::asset('dashboard/plugins/datatable/js/dataTables.responsive.min.js')}}"></script>
<script src="{{URL::asset('dashboard/plugins/datatable/js/responsive.dataTables.min.js')}}"></script>
<script src="{{URL::asset('dashboard/plugins/datatable/js/jquery.dataTables.js')}}"></script>
<script src="{{URL::asset('dashboard/plugins/datatable/js/dataTables.bootstrap4.js')}}"></script>
<script src="{{URL::asset('dashboard/plugins/datatable/js/dataTables.buttons.min.js')}}"></script>
<script src="{{URL::asset('dashboard/plugins/datatable/js/buttons.bootstrap4.min.js')}}"></script>
<script src="{{URL::asset('dashboard/plugins/datatable/js/jszip.min.js')}}"></script>
<script src="{{URL::asset('dashboard/plugins/datatable/js/pdfmake.min.js')}}"></script>
<script src="{{URL::asset('dashboard/plugins/datatable/js/vfs_fonts.js')}}"></script>
<script src="{{URL::asset('dashboard/plugins/datatable/js/buttons.html5.min.js')}}"></script>
<script src="{{URL::asset('dashboard/plugins/datatable/js/buttons.print.min.js')}}"></script>
<script src="{{URL::asset('dashboard/plugins/datatable/js/buttons.colVis.min.js')}}"></script>
<script src="{{URL::asset('dashboard/plugins/datatable/js/dataTables.responsive.min.js')}}"></script>
<script src="{{URL::asset('dashboard/plugins/datatable/js/responsive.bootstrap4.min.js')}}"></script>
<!--Internal  Datatable js -->
<script src="{{URL::asset('dashboard/js/table-data.js')}}"></script>
@endsection