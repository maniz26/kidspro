@extends('backendcp::template')
@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-lg-8 p-r-0 title-margin-right">
            <div class="page-header">
                <div class="page-title">
                    <ol class="breadcrumb">
                        <li><a href="{{route('admin.root')}}">{!! __('backendcp::general.dashboard') !!}</a></li>
                        <li><a href="{{route('admin.menu.list')}}">{!! __('backendcp::menu.title') !!}</a></li>                        
                        <li><a href="{{route('admin.menu.item.list')}}">{!! __('backendcp::menuitem.title') !!}</a></li>
                        <li class="active">{!! __('backendcp::menuitem.breadcrum.edit') !!}</li>
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
            
            <!-- /# column -->
            <div class="col-lg-12">
                <div class="card alert">
                    <div class="card-header">
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
                    <div class="card-body">
                        <div class="horizontal-form-elements">
                            <form method="post" action="{{route('admin.menu.item.update')}}" class="form-horizontal">
                                {{ csrf_field()}}
                                <input type="hidden" name="id" value="{{$item->id}}">
                                <div class="row">
                                    <div class="form-group">
                                        <label class="col-sm-2 control-label">{!! __('backendcp::menu.fields.name') !!}</label>
                                        <div class="col-sm-8">
                                            <input type="text" name="title" class="form-control" value="{{$item->title}}">
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="col-sm-2 control-label">{!! __('backendcp::menu.fields.menu') !!}</label>
                                        <div class="col-sm-8">
                                            <select class="form-control select2" name="menu_id"> 
                                                <option value="">{!! __('backendcp::country.fields.root') !!}</option>                                              
                                                @foreach($menus as $menu)
                                                <option value="{{$menu->id}}" @if( $item->menu_id== $menu->id) selected @endif>{{$menu->title}}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                    <div class="menuItems">
                                        <div class="form-group">
                                            <label class="col-sm-2 control-label">{!! __('backendcp::menu.fields.parent') !!}</label>
                                            <div class="col-sm-8">
                                                <select class="form-control select2" name="parent_id">
                                                    <option value="0">{!! __('backendcp::country.fields.root') !!}</option>
                                                    @foreach($menuItems as $menu)
                                                    <option value="{{$menu->id}}" @if($menu->id == $item->parent_id) selected @endif>{{$menu->title}}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="form-group ">
                                        <label class="col-sm-2 control-label">{!! __('backendcp::menu.fields.menu_item_type') !!}</label>
                                        <div class="input-group input-group-default col-sm-8">
                                            <span class="input-group-btn"><button class="btn btn-primary select-items-type" type="button"><i class="ti-view-list-alt"></i> {!! __('backendcp::menu.fields.select') !!}</button></span>
                                            <input type="text"  name="menu_item_type" class="form-control" readonly value="{{$item->menu_link}}">
                                            <input type="hidden" name="menu_link" value="{{$item->menu_link}}">
                                        </div>
                                        
                                    </div>

                                    
                                    <div class="form-group content-group hidden-group" @if(!$item->content_link) style="display:none;" @endif>
                                        <label class="col-sm-2 control-label">{!! __('backendcp::menu.fields.menu_item_type') !!}</label>
                                        <div class="input-group input-group-default col-sm-8">
                                            <span class="input-group-btn"><button class="btn btn-primary select-content-type" type="button"><i class="ti-view-list-alt"></i> {!! __('backendcp::menu.fields.select') !!}</button></span>
                                            <input type="text"  name="content_item_type" class="form-control" readonly value="{{$item->content_link}}">
                                            <input type="hidden" name="content_link" value="{{$item->content_link}}">
                                        </div>
                                        
                                    </div>

                                     <div class="form-group external-group hidden-group" @if(!$item->external_link) style="display:none;" @endif>
                                        <label class="col-sm-2 control-label">{!! __('backendcp::menu.fields.link') !!}</label>
                                        <div class="col-sm-8">
                                            <input type="text" name="external_link" class="form-control" value="{{$item->external_link}}">
                                        </div>
                                    </div>

                                     
                                    <div class="form-group">
                                        <label class="col-sm-2 control-label">{!! __('backendcp::menu.fields.target') !!}</label>
                                        <div class="col-sm-8">
                                            <select class="form-control select2" name="target"> 
                                                <option value="1" @if(1 == $item->target) selected @endif>{!! __('backendcp::menu.fields.target_parent') !!}</option>
                                                <option value="2" @if(2 == $item->target) selected @endif>{!! __('backendcp::menu.fields.target_new') !!}</option>                                                                                                
                                            </select>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="col-sm-2 control-label">{!! __('backendcp::country.fields.status') !!}</label>
                                        <div class="checkbox">
                                            <label>
                                                <input type="radio" value="1" name="status" @if(1 == $item->status) checked @endif> {!! __('backendcp::country.fields.publish') !!}
                                            </label>
                                            <label>
                                                <input type="radio" value="0" name="status" @if(0 == $item->status) checked @endif> {!! __('backendcp::country.fields.unpublish') !!}
                                            </label>
                                        </div>
                                    </div>
                                    
                                    <div class="form-group">
                                        <label class="col-sm-2 control-label"></label>
                                        <div class="col-sm-10">
                                            <button type="submit" class="btn btn-default btn-lg m-b-10 bg-warning m-t-30 border-none m-r-5 sbmt-btn">{!! __('backendcp::general.fields.save') !!}</button>
                                        </div>
                                    </div>
                                    
                                </div>
                            </form>
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


    @if($item->content_link)
          $('.select-content-type').click(function(e){
            e.preventDefault();
            $('#module_items_type').modal('show') ;      
            $('#module_items_type').find('.modal-content').load("{{url('backend/menu/item/component/ContentModule/BACKEND')}}");
        });
    @endif

});

$(document).on('click','.list-group-item a',function(e){
    e.preventDefault();
    var url = $(this).data('url');
    var component = $(this).data('component');
    var external = $(this).data('external');
    var type = $(this).data('type');
    $('.hidden-group').hide();
    if(typeof(component) != 'undefined' ){ 
        $('.content-group').show();
        $('.select-content-type').click(function(e){
            e.preventDefault();
            $('#module_items_type').modal('show') ;      
            //$('#module_items_type').find('.modal-content').load("{{url('backend/menu/item/component')}}/"+ component);
            $('#module_items_type').find('.modal-content').load("{{url('backend/menu/item/component')}}/"+ component+'/'+type);
        });
          
    }else if(typeof(external) != 'undefined' ){
        $('.external-group').show();
        $('input[name="content_link"]').prop('value','');

    }else{       
        $('input[name="content_link"]').prop('value','');
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