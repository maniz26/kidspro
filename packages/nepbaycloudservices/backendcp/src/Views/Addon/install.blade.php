@extends('backendcp::template')
@section('content')
  <div class="container-fluid">
                <div class="row">
                    <div class="col-lg-8 p-r-0 title-margin-right">
                        <div class="page-header">
                            <div class="page-title">
                                <h1><span>{!! __('backendcp::addon.title') !!}</span></h1>
                            </div>
                        </div>
                    </div>
                    <!-- /# column -->
                    <div class="col-lg-4 p-l-0 title-margin-left">
                        <div class="page-header">
                            <div class="page-title">
                                <ol class="breadcrumb text-right">
                                    <li><a href="#">{!! __('backendcp::general.dashboard') !!}</a></li>
                                    <li><a href="#">{!! __('backendcp::addon.title') !!}</a></li>
                                    <li class="active">{!! __('backendcp::addon.breadcrum.create') !!}</li>
                                </ol>
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
                                       
                                        {!! TranslatableBootForm::open()->action( route('addons.save') )->attributes()->multipart()->post()->class('form-horizontal') !!}
                                            <div class="row">
                                                      <div class="form-group">
                                                        <label class="col-sm-2 control-label">{!! __('backendcp::addon.fields.upload') !!}</label>
                                                        <div class="col-sm-10">
                                                            <input type="file" name="addon">
                                                        </div>
                                                    </div>                                                 
                                                  
                                                    <div class="form-group">
                                                        <label class="col-sm-2 control-label">{!! __('backendcp::addon.fields.status') !!}</label>
                                                        <div class="checkbox">
			                                                <label>
																<input type="radio" value="1" name="status" checked> {!! __('backendcp::addon.fields.publish') !!}
															</label>
															<label>
																<input type="radio" value="0" name="status"> {!! __('backendcp::addon.fields.unpublish') !!}
															</label>
			                                            </div>
                                                    </div>
                                                  
                                                    
                                                   

                                                     <div class="form-group">
                                                        <label class="col-sm-2 control-label"></label>
                                                        <div class="col-sm-10">
                                                            <button type="submit" class="btn btn-default">{!! __('backendcp::addon.fields.save') !!}</button>
                                                        </div>
                                                    </div>

													
                                                    
                                                
                                                <!-- /# column -->
                                                
                                                <!-- /# column -->
                                            </div>
                                         {!! TranslatableBootForm::close() !!}
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