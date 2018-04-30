@extends('backendcp::template')
@section('content')
<div class="container-fluid">
	<div class="row">
		<div class="col-lg-8 p-r-0 title-margin-right">
			<div class="page-header">
				<div class="page-title">
                    <ol class="breadcrumb ">
                        <li><i class="ti-home"></i> <a href="{{route('admin.root')}}">{!! __('backendcp::general.dashboard') !!}</a></li>
                        <li><a href="{{route('admin.menu.list')}}">{!! __('backendcp::menu.title') !!}</a></li>  
                        <li class="active">{!! __('backendcp::menuitem.title') !!}</li>        

                    </ol>
                </div>				
			</div>
		</div>
		<!-- /# column -->
		<div class="col-lg-4 p-l-0 title-margin-left">
			<div class="page-header">
				<div class="page-title">
					
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
                     <form method="post" action="" name="adminForm" id="adminForm">
                     {{csrf_field()}}
                     <input type="hidden" name="action">
					<div class="row card-header">
						@if (session('success'))
					    <div class="alert  alert-info">
                            <a href="#" class="close" data-dismiss="alert" aria-label="close">×</a>
                            {{ session('success') }}
                        </div>
						@endif	

						<h4>@lang('backendcp::menuitem.title')	 </h4>
                       

						  <div class="card-header-right-icon">
                            <ul>
                                <li>
                                    <a href="{{ route('admin.menu.item.batch.delete') }}"  class="btn btn-danger btn-addon m-b-10 btn-do-action" data-action="delete">
                                        <i class="fa fa-trash"></i> @lang('backendcp::general.fields.delete')
                                    </a>
                                </li>
                                <li>
                                    <a href="{{ route('admin.menu.item.batch.unpublish') }}" class="btn btn-warning btn-addon m-b-10 btn-do-action" data-action="unpublish">
                                        <i class="fa fa-close"></i> @lang('backendcp::general.fields.unpublish')
                                    </a>
                                </li>
                                <li>
                                    <a href="{{ route('admin.menu.item.batch.publish') }}" class="btn btn-success btn-addon m-b-10 btn-do-action" data-action="publish">
                                        <i class="fa fa-check"></i> @lang('backendcp::general.fields.publish')
                                    </a>
                                </li>
                                
                                
                                <li>
                                    <a href="{{ route('admin.menu.item.new') }}" class="btn btn-primary  btn-addon m-b-10">
                                        <i class="glyphicon glyphicon-plus"></i> @lang('backendcp::menuitem.fields.new')
                                    </a>
                                </li>
                            </ul>
                        </div>
						
					</div>
					<div class="bootstrap-data-table-panel">
						<div class="table-responsive">
							<table id="bootstrap-data-table-menu" class="table table-striped table-bordered">
								<thead>
									<tr>
                                        <th><span class="Sorting"></span></th>
										<th><input type="checkbox" class="chk_boxes" label="check all"/></th>
										<th>{!! __('backendcp::general.list.name') !!}</th>										
                                        <th>{!! __('backendcp::menuitem.fields.menu') !!}</th>
										<th>{!! __('backendcp::general.list.status') !!}</th>
									    <th>{!! __('backendcp::general.list.created') !!}</th> 
										<th>{!! __('backendcp::general.list.actions') !!}</th>
									</tr>
								</thead>
								<tbody id="tablecontents">
								</tbody>
							</table>
						</div>
					</div>
                </form>
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
<script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
<script type="text/javascript">
        $(function() {
            var table = $('#bootstrap-data-table-menu').DataTable({
                processing: true,
                responsive:true,
                serverSide: true,
                ajax: '{!! route('admin.menu.item.data') !!}',
                columns: [
                	{ data: 'dragnndrop', name: 'dragnndrop',  orderable:false},
                    { data: 'checkbox', name: 'checkbox',orderable:false,width:'2%'},
                    { data: 'title', name: 'title' },                    
                    { data: 'menu_id', name: 'menu_id' },
                    { data: 'status', name: 'status' },
                    { data: 'created_at', name: 'created_at' },
                    { data: 'actions', name: 'actions', orderable:false, width:'10%'}
                ],
                order: [],
                columnDefs: [
                    { "orderable": false, "targets": 'no-sort' }
                ],
                /*columnDefs: [{
                	targets: 0,
                	orderable: false
                }],*/
                createdRow: function ( row, data, index ) {
                    //console.log(data)
                    $(row).addClass('ui-state-default');
                    $(row).attr('data-id',data.id);
                }/*,
                search: { "regex": true }*/

                

            });

            var options='<option value="">All</option>';
            @foreach($menus as $menu)
                options += '<option value="{{$menu->id}}">{{$menu->title}}</option>';
            @endforeach

            $('select[name="bootstrap-data-table-menu_length"').parents('.col-sm-6').append('<div calass="col-sm-2"><div><label>Menu:</label> <select id="filter_menu" class="form-control input-sm">'+options+'</select></div></div>');

            $('#filter_menu').on( 'change', function () {
                    var val= $(this).prop('value');
                   
                    filterGlobal(val);
            } );

            function filterGlobal (val) {
               
                $('#bootstrap-data-table-menu').DataTable().column(2).search(val).draw();
                //$('#bootstrap-data-table-menu').DataTable().columns('menu_id').search(val ? '^'+val+'$' : '', true, false).draw();
            }

                   
            $('.chk_boxes').click(function() {
            	$('.checkbox').prop('checked', this.checked);
	        });

	        $('#deleteSelected').click( function () {
	            alert( $('.checkbox').data().length +' row(s) selected' );
	        });

	        $('.btn-do-action').click(function(e){                
	            e.preventDefault();

	            if( $('.checkbox:checked').length == 0){
	                alert("{{ __('backendcp::menuitem.action.alert')}}");
	                return false;
	            }

	            if( $(this).data('action') =='delete'){
	                var conf =confirm("{{ __('backendcp::menuitem.delete.alert')}}");
	                if(!conf)
	                    return false;
	            }

	            $('#adminForm').prop('action',$(this).prop('href'));
	            $('#adminForm').submit();
	        });  

        });

       $(document).on('click','.checkbox',function(){
        var allchecked = true;
        $('.checkbox').map(function(){
            if( $(this).prop('checked') == false){
                allchecked = this.checked;
            }
        });
        $('.chk_boxes').prop('checked', allchecked);
    
    	});

        
        $( "#tablecontents" ).sortable({
            items: "tr",
            cursor: 'move',
            opacity: 0.6,
            handle: 'td:first',
            update: function(event, ui) {
                var order = [];
                $('tr.ui-state-default').each(function(index,element) {
                    order.push({
                        id: $(this).attr('data-id'),
                        position: index+1
                    });
                });
                console.log(order);
                $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': '{{csrf_token()}}'
                    }
                });
                $.ajax({
                    type: "POST", 
                    dataType: "json", 
                    url: "{{route('admin.menu.item.order.save')}}",
                    data: {order},
                    success: function(response) {
                        if (response.status == "success") {
                            console.log(response);
                        } else {
                            console.log(response);
                        }
                    }
                });
            }
        }); 


        $(document).on('mouseover','#tablecontents td:first',function(){
              $(this).css('cursor','pointer') ;
        });

    </script>

    <div class="modal fade" id="delete_content" tabindex="-1" role="dialog" aria-labelledby="user_delete_confirm_title" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content"></div>
        </div>
    </div>
    <script>
    $(function () {
        $('body').on('hidden.bs.modal', '.modal', function () {
            $(this).removeData('bs.modal');
        });
    });
    </script>

@endsection