@extends('backendcp::template')
@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-lg-8 p-r-0 title-margin-right">
            <div class="page-header">
                <div class="page-title">
                    <ol class="breadcrumb ">
                        <li><i class="ti-home"></i> <a href="{{route('admin.root')}}">{!! __('backendcp::general.dashboard') !!}</a></li>
                        <li><a href="#">{!! __('backendcp::contentcategory.title') !!}</a></li>
                        <li class="active">{!! __('backendcp::contentcategory.breadcrum.categories') !!}</li>
                    </ol>
                </div>
            </div>
        </div>
        <!-- /# column -->
        <div class="col-lg-4 p-l-0 title-margin-left">
            <div class="page-header">
                
            </div>
        </div>
        <!-- /# column -->
    </div>
    <!-- Main content -->
    <section id="main-content">
        <div class="row">
            <div class="col-lg-12">
                <div class="card alert">
                    <form method="post" action="" name="adminForm" id="adminForm">
                    {{csrf_field()}}
                    <input type="hidden" name="action">
                    <div class=" row card-header">
                        @if (session('success'))
                        <div class="alert  alert-info">
                            <a href="#" class="close" data-dismiss="alert" aria-label="close">×</a>
                            {{ session('success') }}
                        </div>
                        @endif
                        <h4>
                        @lang('backendcp::contentcategory.breadcrum.categories')
                        </h4>
                        <div class="card-header-right-icon">
                            <ul>
                                <li>
                                    <a href="{{ route('admin.content.category.batch.delete') }}"  class="btn btn-danger btn-addon m-b-10 btn-do-action" data-action="delete">
                                        <i class="fa fa-trash"></i> @lang('backendcp::contentcategory.fields.delete')
                                    </a>
                                </li>
                                <li>
                                    <a href="{{ route('admin.content.category.batch.unpublish') }}" class="btn btn-warning btn-addon m-b-10 btn-do-action" data-action="unpublish">
                                        <i class="fa fa-close"></i> @lang('backendcp::contentcategory.fields.unpublish')
                                    </a>
                                </li>
                                <li>
                                    <a href="{{ route('admin.content.category.batch.publish') }}" class="btn btn-success btn-addon m-b-10 btn-do-action" data-action="publish">
                                        <i class="fa fa-check"></i> @lang('backendcp::contentcategory.fields.publish')
                                    </a>
                                </li>
                                
                                
                                <li>
                                    <a href="{{ route('admin.content.category.new') }}" class="btn btn-primary  btn-addon m-b-10">
                                        <i class="glyphicon glyphicon-plus"></i> @lang('backendcp::contentcategory.fields.new')
                                    </a>
                                </li>
                            </ul>
                        </div>
                    </div>
                    <div class="bootstrap-data-table-panel">
                        <div class="table-responsive">
                            <table class="table table-striped table-bordered" id="contentTable">
                                <thead>
                                    <tr>
                                        <th><input type="checkbox" class="chk_boxes" label="check all"/></th>
                                        <th>@lang('backendcp::contentcategory.fields.title')</th>                                      
                                        <th>@lang('backendcp::contentcategory.fields.image')</th>
                                        <th>@lang('backendcp::contentcategory.fields.featured')</th>
                                        <th>@lang('backendcp::contentcategory.fields.status')</th>
                                        <th>@lang('backendcp::contentcategory.fields.created_at')</th>
                                        <th>@lang('backendcp::contentcategory.fields.actions')</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    
                                </tbody>
                            </table>
                        </div>
                    </div>
                    </form>
                </div>
            </div>
            </div>    <!-- row-->
            @include('backendcp::footer')
        </section>
    </div>
    @endsection
    @section('header-scripts')
    <link href="{{ asset('backendcp/assets/vendors/datatables/css/dataTables.bootstrap.css')}}" rel="stylesheet" />
    <link href="{{ asset('backendcp/assets/css/pages/tables.css')}}" rel="stylesheet" />
    @endsection
    {{-- page level scripts --}}
    @section('footer-scripts')
    <style type="text/css">
    .btn-xs{
    
    }
    </style>
    <script src="{{ asset('backendcp/assets/vendors/datatables/js/jquery.dataTables.js')}}"></script>
    <script src="{{ asset('backendcp/assets/vendors/datatables/js/dataTables.bootstrap.js')}}"></script>
    <script>
    $(function() {
        var table = $('#contentTable').DataTable({
            processing: true,
            responsive:true,
            serverSide: true,
            ajax: '{!! route('admin.content.category.data') !!}',
                columns: [
                { data: 'checkbox', name: 'checkbox'},
                { data: 'title', name: 'title' },               
                { data: 'image', name: 'image' },
                { data: 'featured', name: 'featured' },
                { data: 'status', name: 'status' },
                { data: 'created_at', name: 'created_at' },
                { data: 'actions', name: 'actions', orderable:false}
                ],
                columnDefs: [ {
                targets: 0,
                orderable: false
                }]        
        });

        $('.chk_boxes').click(function() {
            $('.checkbox').prop('checked', this.checked);
        });
        $('#deleteSelected').click( function () {
            alert( $('.checkbox').data().length +' row(s) selected' );
        });

        $('.btn-do-action').click(function(e){                
            e.preventDefault();

            if( $('.checkbox:checked').length == 0){
                alert("{{ __('backendcp::contentcategory.action.alert')}}");
                return false;
            }

            if( $(this).data('action') =='delete'){
                var conf =confirm("{{ __('backendcp::contentcategory.delete.alert')}}");
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