@extends('backendcp::template')
@section('content')
<div class="container-fluid">
	<div class="row">
		<div class="col-lg-8 p-r-0 title-margin-right">
			<div class="page-header">
				<div class="page-title">
					<h1>{!! __('plugins::customfield.title') !!}</h1>
				</div>
			</div>
		</div>
		<!-- /# column -->
		<div class="col-lg-4 p-l-0 title-margin-left">
			<div class="page-header">
				<div class="page-title">
					<ol class="breadcrumb text-right">
						<li><a href="#">{!! __('backendcp::general.dashboard') !!}</a></li>
						<li class="active">{!! __('plugins::customfield.breadcrum.list') !!}</li>
					</ol>
				</div>
			</div>
		</div>
		<!-- /# column -->
	</div>
	<!-- /# row -->
	<section id="main-content">
		<div class="row">
			<div class="col-lg-12">
				<div class="card alert">
					<div class="row card-header">
						@if (session('status'))
					    <div class="alert alert-success">
					        {{ session('status') }}
					    </div>
						@endif	

						<h4>
                        {!! __('plugins::customfield.breadcrum.list') !!}
                    	</h4>


						<div class="card-header-right-icon">
	                        <ul>
	                            <li>
	                                <a href="{{ route('admin.customfield.new') }}" class="btn btn-success btn-sm">
	                                    <span class="glyphicon glyphicon-plus"></span> {!! __('plugins::customfield.breadcrum.create') !!}
	                                </a>
	                            </li>
	                        </ul>
	                    </div>	
						
					</div>
					<div class="bootstrap-data-table-panel">
						<div class="table-responsive">
							<table id="bootstrap-data-table-customfield" class="table table-striped table-bordered">
								<thead>
									<tr>
										<th><input type="checkbox" class="chk_boxes" label="check all"/></th>
										<th>{!! __('plugins::customfield.list.label') !!}</th>			
										<th>{!! __('plugins::customfield.list.type') !!}</th>
										<th>{!! __('backendcp::general.list.status') !!}</th> 
									    <th>{!! __('backendcp::general.list.created') !!}</th> 
										<th>{!! __('backendcp::general.list.actions') !!}</th>
									</tr>
								</thead>
								<tbody>
								</tbody>
							</table>
						</div>
					</div>
				</div>
				<!-- /# card -->
			</div>
			<!-- /# column -->
		</div>
		<!-- /# row -->
		@include('backendcp::footer')
	</section>
</div>
@endsection
@section('header-scripts')
<link href="{{ asset('backendcp/assets/vendors/datatables/css/dataTables.bootstrap.css')}}" rel="stylesheet" />
<link href="{{ asset('backendcp/assets/css/pages/tables.css')}}" rel="stylesheet" />
@endsection
@section('footer-scripts')
<script src="{{ asset('backendcp/assets/vendors/datatables/js/jquery.dataTables.js')}}"></script>
<script src="{{ asset('backendcp/assets/vendors/datatables/js/dataTables.bootstrap.js')}}"></script>
<script type="text/javascript">
        $(function() {
            var table = $('#bootstrap-data-table-customfield').DataTable({
                processing: true,
                responsive:true,
                serverSide: true,
                ajax: '{!! route('admin.customfield.data') !!}',
                columns: [
                 	{ data: 'checkbox', name: 'checkbox',orderable:false},                    
                    { data: 'label_text', name: 'label_text' },
                    { data: 'type', name: 'type' },
                    { data: 'status', name: 'status' },
                    { data: 'created_at', name: 'created_at' },
                    { data: 'actions', name: 'actions',orderable:false}
                ]                               
            });            

        });
    </script>

@endsection