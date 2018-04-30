@extends('backendcp::template')
@section('content')
<div class="container-fluid">
	<div class="row">
		<div class="col-lg-8 p-r-0 title-margin-right">
			<div class="page-header">
				<div class="page-title">
					<h1>{!! __('backendcp::category.title') !!}</h1>
				</div>
			</div>
		</div>
		<!-- /# column -->
		<div class="col-lg-4 p-l-0 title-margin-left">
			<div class="page-header">
				<div class="page-title">
					<ol class="breadcrumb text-right">
						<li><a href="#">{!! __('backendcp::general.dashboard') !!}</a></li>
						<li class="active">{!! __('backendcp::category.breadcrum.list') !!}</li>
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
					<div class="card-header">
						@if (session('status'))
					    <div class="alert alert-success">
					        {{ session('status') }}
					    </div>
						@endif						
					</div>
					<div class="bootstrap-data-table-panel">
						<div class="table-responsive">
							<table id="bootstrap-data-category" class="table table-striped table-bordered">
								<thead>
									<tr>
										<th>{!! __('backendcp::general.list.name') !!}</th>
										<th>{!! __('backendcp::general.list.icon') !!}</th>
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
<link href="{{ asset('backendcp/assets/css/lib/data-table/dataTables.bootstrap.min.css')}}" rel="stylesheet" />
<link href="{{ asset('backendcp/assets/css/lib/data-table/buttons.bootstrap.min.css')}}" rel="stylesheet" />
@endsection
@section('footer-scripts')
<script src="{{ asset('backendcp/assets/js/lib/data-table/datatables.min.js')}}"></script>
<script type="text/javascript">
        $(function() {
            var table = $('#bootstrap-data-category').DataTable({
                processing: true,
                responsive:true,
                serverSide: true,
                ajax: '{!! route('category.data') !!}',
                columns: [
                    { data: 'title', name: 'title' },
                    { data: 'icon', name: 'icon' },                   
                    { data: 'status', name: 'status' },
                    { data: 'created_at', name: 'created_at' },
                    { data: 'actions', name: 'actions'}
                ]                               
            });            

        });
    </script>

@endsection