@extends('backendcp::template')
@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-lg-8 p-r-0 title-margin-right">
            <div class="page-header">
                <div class="page-title">
                    <ol class="breadcrumb ">
                        <li><i class="ti-home"></i> <a href="#">{!! __('backendcp::general.dashboard') !!}</a></li>
                        <li><a href="#">{!! __('plugins::activity.title') !!}</a></li>
                        <li class="active">{!! __('plugins::activity.breadcrum.edit') !!}</li>
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
                        
                    </div>
                    <div class="card-body">
                        <div class="horizontal-form-elements">
                            
                            <form class="form-horizontal" method="post" action="{{route('admin.module.update')}}" enctype="multipart/form-data">
                                {{ csrf_field()}}
                              
                                <input type="hidden" name="id" value="{{$module->id}}">
                              
                                
                                <div class="row">
                                    <div class="form-group">
                                        <label class="col-sm-2 control-label">{!! __('backendcp::module.fields.name') !!}</label>
                                        <div class="col-sm-8">
                                            
                                            <input type="text" name="name" class="form-control"  @if( isset($module)) value="{{$module->name or old('name')}}" @else value="{{old('name')}}" @endif>
                                            
                                        </div>
                                    </div>
                                    {!! $params !!}
                                    <div class="form-group">
                                        <label class="col-sm-2 control-label">{!! __('backendcp::module.fields.position') !!}</label>
                                        <div class="col-sm-8">
                                            <select class="form-control border-none input-flat bg-ash" name="position">
                                                <option value="0">{{ __('backendcp::general.fields.root') }}</option>
                                                @foreach($templatepositions['positions']['position'] as $position)
                                                <option value="{{$position['@attributes']['name']}}" @if( isset($module->position) &&  $module->position ==  $position['@attributes']['name'] ) )
                                                    selected
                                                    @elseif( $position['@attributes']['name'] == old('category_id') ) selected @endif>{{$position['@attributes']['name']}}</option>
                                                @endforeach
                                                
                                            </select>
                                        </div>
                                    </div>

                                     <div class="form-group">
                                    <label class="col-sm-2 control-label">{!! __('backendcp::general.fields.status') !!}</label>
                                    <div class="col-sm-6">
                                        <label class="control-label">
                                            <input type="radio" value="1" class="square" name="status" @if($module->status == 1) checked @endif> {!! __('backendcp::general.fields.publish') !!}
                                            <input type="radio" value="0" class="square" name="status" @if($module->status == 0) checked @endif> {!! __('backendcp::general.fields.unpublish') !!}
                                        </label>
                                    </div>
                                </div>
                                    <div class="form-group">
                                        <label class="col-sm-2 control-label"></label>
                                        <div class="col-sm-10">
                                            <button type="submit" class="btn btn-default">{!! __('backendcp::general.fields.save') !!}</button>
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
@section('header-scripts')
<link href="{{ asset('backendcp/assets/vendors/jasny-bootstrap/css/jasny-bootstrap.css') }}" rel="stylesheet">
@endsection
@section('footer-scripts')
<script src="{{ asset('backendcp/assets/vendors/jasny-bootstrap/js/jasny-bootstrap.js') }}"  type="text/javascript"></script>

@endsection