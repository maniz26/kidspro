@extends('backendcp::template')
@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-lg-8 p-r-0 title-margin-right">
            <div class="page-header">
                <div class="page-title">
                    <ol class="breadcrumb ">
                        <li><i class="ti-home"></i> <a href="#">{!! __('backendcp::general.dashboard') !!}</a></li>                        
                        <li><a href="{{route('admin.menu.list')}}">{!! __('backendcp::menu.title') !!}</a></li>                        
                        <li><a href="{{route('admin.menu.item.list')}}">{!! __('backendcp::menuitem.title') !!}</a></li>
                        <li class="active">{!! __('backendcp::menuitem.breadcrum.create') !!}</li>
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
            <form method="post" action="{{route('admin.menu.item.save')}}" class="form-horizontal">
                {{ csrf_field()}}
                <!-- /# column -->
                <div class="col-lg-12">
                    <div class="card">
                        <div class="card-header pr">
                            @if ($errors->any())
                            <div class="alert alert-danger">
                                <ul>
                                    @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div>
                            @endif
                        </div>
                        <div class="card">
                            
                            
                            <div class="form-group">
                                <label class="col-sm-2 control-label">{!! __('backendcp::menuitem.fields.name') !!}</label>
                                <div class="col-sm-8">
                                    <input type="text" name="title" class="form-control">
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-sm-2 control-label">{!! __('backendcp::menuitem.fields.menu') !!}</label>
                                <div class="col-sm-8">
                                    <select class="form-control select2" name="menu_id">
                                        <option value="">{!! __('backendcp::general.fields.root') !!}</option>
                                        @foreach($menus as $menu)
                                        <option value="{{$menu->id}}">{{$menu->title}}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="menuItems"></div>
                            <div class="form-group">
                                <label class="col-sm-2 control-label">{!! __('backendcp::menu.fields.menu_item_type') !!}</label>
                                <div class="col-sm-8 input-group input-group-default">
                                    <span class="input-group-btn"><button class="btn btn-primary select-items-type" type="button"><i class="ti-view-list-alt"></i> {!! __('backendcp::menu.fields.select') !!}</button></span>
                                    <input type="text"  name="menu_item_type" class="form-control" readonly>
                                    <input type="hidden" name="menu_link">
                                </div>
                                
                            </div>
                            
                            <div class="form-group content-group hidden-group" style="display: none;">
                                <label class="col-sm-2 control-label">{!! __('backendcp::menu.fields.select_content') !!}</label>
                                <div class="col-sm-8 input-group input-group-default">
                                    <span class="input-group-btn"><button class="btn btn-primary select-content-type" type="button"><i class="ti-view-list-alt"></i> {!! __('backendcp::menu.fields.select') !!}</button></span>
                                    <input type="text"  name="content_item_type" class="form-control" readonly>
                                    <input type="hidden" name="content_link">
                                </div>
                                
                            </div>
                            
                            <div class="form-group external-group hidden-group" style="display: none;">
                                <label class="col-sm-2 control-label">{!! __('backendcp::menu.fields.link') !!}</label>
                                <div class="col-sm-8">
                                    <input type="text" name="external_link" class="form-control">
                                </div>
                            </div>

                            <div class="form-group shortcode-group hidden-group" style="display: none;">
                                <label class="col-sm-2 control-label">{!! __('backendcp::menu.fields.short_code') !!}</label>
                                <div class="col-sm-8">
                                    <input type="text" name="short_code" class="form-control">
                                </div>
                            </div>
                            
                            <div class="form-group">
                                <label class="col-sm-2 control-label">{!! __('backendcp::menu.fields.target') !!}</label>
                                <div class="col-sm-8">
                                    <select class="form-control select2" name="target">
                                        <option value="1">{!! __('backendcp::menu.fields.target_parent') !!}</option>
                                        <option value="2">{!! __('backendcp::menu.fields.target_new') !!}</option>
                                    </select>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-sm-2 control-label">{!! __('backendcp::country.fields.status') !!}</label>
                                <div class="col-sm-8">
                                    <select class="form-control border-none input-flat bg-ash" name="status">
                                        <option value="1" selected >{!! __('backendcp::general.fields.publish') !!}</option>
                                        <option value="0" @if( null!== old('status') && old('status') != 1 ) selected @endif >{!! __('backendcp::general.fields.unpublish') !!}</option>
                                    </select>
                                </div>
                            </div>
                            
                            <div class="form-group">
                                <label class="col-sm-2 control-label"></label>
                                <div class="col-sm-8">
                                    <button type="submit" class="btn btn-default btn-lg m-b-10 bg-warning m-t-30 border-none m-r-5 sbmt-btn">{!! __('backendcp::general.fields.save') !!}</button>
                                </div>
                            </div>
                            
                            
                            
                            
                        </div>
                    </div>
                    <!-- /# card -->
                </div>
            </form>
            
            <!-- /# column -->
        </div>
        <!-- /# row -->
        
        @include('backendcp::footer')
        
    </section>
</div>
@endsection
@section('footer-scripts')
<script type="text/javascript">
$(document).ready(function(){
    $('.select-items-type').click(function(e){
        e.preventDefault();
        $('#menu_items_type').modal('show')
        $('#menu_items_type').find('.modal-content').load("{{route('admin.menu.item.type')}}");
    });
    $('select[name="menu_id"]').change(function(e){
        var menu_id = $(this).prop('value');

        if(menu_id =='')
            menu_id = 0;
        $('.menuItems').load("{{url('backend/menu/item/menuitems')}}/" + menu_id );
    });
});


$(document).on('click','.list-group-item a',function(e){
    e.preventDefault();
    var url = $(this).data('url');
    var component = $(this).data('component');
    var external = $(this).data('external');
    var shortcode = $(this).data('shortcode');
    var type = $(this).data('type');
    $('.hidden-group').hide();
    $('input[name="content_link"]').prop('value','');
    $('input[name="external_link"]').prop('value','');
    $('input[name="short_code"]').prop('value','');
    
    if(typeof(component) != 'undefined' ){
        $('.content-group').show();
        $('.select-content-type').click(function(e){
            e.preventDefault();
            $('#module_items_type').modal('show') ;
            $('#module_items_type').find('.modal-content').load("{{url('backend/menu/item/component')}}/"+ component+'/'+type);
        });
    }else if(typeof(external) != 'undefined' ){
        $('.external-group').show();
    }else if(typeof(shortcode) != 'undefined' ){
        
        $('.shortcode-group').show();

    }

    $('input[name="menu_item_type"]').prop('value', url);
    $('input[name="menu_link"]').prop('value',url);
    $('#menu_items_type').modal('hide');
});

$(document).on('click','.menu-content-items a',function(e){
    e.preventDefault();
    var url = $(this).data('url');
    $('input[name="content_item_type"]').prop('value',url);
    $('input[name="content_link"]').prop('value',url);
    $('#module_items_type').modal('hide');
});

</script>
<div class="modal fade" id="menu_items_type" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">Loading..</div>
    </div>
</div>
<div class="modal fade" id="module_items_type" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">Loading..</div>
    </div>
</div>
@endsection