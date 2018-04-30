@extends('backendcp::template')
@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-lg-8 p-r-0 title-margin-right">
            <div class="page-header">
                <div class="page-title">
                    <ol class="breadcrumb ">
                        <li><i class="ti-home"></i> <a href="#">{!! __('backendcp::general.dashboard') !!}</a></li>
                        <li><a href="#">{!! __('backendcp::menu.title') !!}</a></li>
                        <li class="active">{!! __('backendcp::menu.breadcrum.edit') !!}</li>
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
    <section id="main-content">
        <div class="row">
            <form name="adminForm" class="form-horizontal" action="{{route('admin.menu.update')}}" method="post" enctype="multipart/form-data">
            {{ csrf_field()}}
            <input type="hidden" name="id" value="{{$menu->id}}">
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-header pr">
                         @if (count($errors) > 0)
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
                        
                            <div class="form-group {{ $errors->first('title', 'has-error') }}">
                                <label for="title" class="col-sm-2 control-label">
                                    @lang('backendcp::menu.fields.name')
                                </label>
                                <div class="col-sm-8">
                                    <input type="text" name="title" class="form-control" placeholder="{{ __('backendcp::menu.fields.title_placeholder') }}" value="{{ $menu->title or old('title')}}">
                                </div>
                            </div>  

                            <div class="form-group {{ $errors->first('position', 'has-error') }}">
                                <label for="title" class="col-sm-2 control-label">
                                    @lang('backendcp::menu.fields.position')
                                </label>
                                <div class="col-sm-8">
                                   <select class="form-control border-none input-flat bg-ash" name="position">
                                     <option value="0">{{ __('backendcp::general.fields.root') }}</option> 
                                        @foreach($templatepositions['positions']['position'] as $position)    
                                       <option value="{{$position['@attributes']['name']}}" @if( $position['@attributes']['name'] ==  $menu->position ) selected @endif>{{$position['@attributes']['name']}}</option>                                    
                                    @endforeach
                                    
                                </select>
                                </div>
                            </div>  

                            <div class="form-group {{ $errors->first('status', 'has-error') }}">
                                <label for="title" class="col-sm-2 control-label">
                                    @lang('backendcp::general.fields.status')
                                </label>
                                <div class="col-sm-8">
                                    <select class="form-control border-none input-flat bg-ash" name="status">

                                    <option value="1" @if( $menu->status == 1 ) selected @endif >{!! __('backendcp::general.fields.publish') !!}</option>
                                    <option value="0" @if( $menu->status == 0 ) selected @endif >{!! __('backendcp::general.fields.unpublish') !!}</option>
                                </select>
                                </div>
                            </div>  

                            <div class="form-group">
                                    <label class="col-sm-2 control-label"></label>
                                    <div class="col-sm-10">
                                        <button type="submit" class="btn btn-default btn-lg m-b-10 bg-warning m-t-30 border-none m-r-5 sbmt-btn">{!! __('backendcp::general.fields.save') !!}</button>
                                    </div>
                                </div>                         
                        
                    </div>
                    <!-- /# card -->
                </div>
                <!-- /# column -->
            </div>
           
            </form>
            <!-- /# row -->
             @include('backendcp::footer')
        </section>
    </div>
    @endsection

@section('header-scripts')
    
    <link href="{{ asset('backendcp/assets/vendors/jasny-bootstrap/css/jasny-bootstrap.css') }}" rel="stylesheet">
    <link href="{{ asset('backendcp/assets/vendors/summernote/summernote.css') }}" rel="stylesheet" />
    <link rel="stylesheet" type="text/css" href="{{ asset('backendcp/assets/vendors/iCheck/css/all.css') }}"/>
    
@stop

@section('footer-scripts')
    <script src="{{ asset('backendcp/assets/vendors/jasny-bootstrap/js/jasny-bootstrap.js') }}"  type="text/javascript"></script>
    <script src="{{ asset('backendcp/assets/vendors/summernote/summernote.min.js') }}" type="text/javascript"></script>
    <script type="text/javascript" src="{{ asset('backendcp/assets/vendors/iCheck/js/icheck.js') }}"></script>
    <script type="text/javascript">
        $(document).ready(function(){
            

            $('.textarea').summernote({
                 height: 300,
                placeholder: "{{ __('backendcp::content.fields.fulltext_placeholder') }}",
                fontNames: ['Lato', 'Arial', 'Courier New'],

            });
        });
    </script>
@stop