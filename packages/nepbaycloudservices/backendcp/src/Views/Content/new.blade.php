@extends('backendcp::template')
@section('content')
<div class="container-fluid">
	<div class="row">
		<div class="col-lg-8 p-r-0 title-margin-right">
			<div class="page-header">
				<div class="page-title">
					<ol class="breadcrumb ">
						<li><i class="ti-home"></i> <a href="#">{!! __('backendcp::general.dashboard') !!}</a></li>
						<li><a href="#">{!! __('backendcp::content.title') !!}</a></li>
						<li class="active">{!! __('backendcp::content.breadcrum.create') !!}</li>
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
			<form name="adminForm" class="form-horizontal" action="{{route('admin.content.save')}}" method="post" enctype="multipart/form-data">
			{{ csrf_field()}}
			<div class="col-lg-9">
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
									@lang('backendcp::content.fields.title')
								</label>
								<div class="col-sm-8">
									<input type="text" name="title" class="form-control" placeholder="{{ __('backendcp::content.fields.title_placeholder') }}" value="{{ old('title')}}">
								</div>
							</div>
							<div class="form-group">
								<label for="introtext" class="col-sm-2 control-label">
									@lang('backendcp::content.fields.introtext')
								</label>
								<div class="col-sm-8">
									<textarea name="introtext" placeholder="{{ __('backendcp::content.fields.introtext_placeholder') }}" class="form-control" >{{ old('title')}}</textarea>									
								</div>
							</div>

							<div class="form-group" {{ $errors->first('fulltext', 'has-error') }}>
								<label for="introtext" class="col-sm-2 control-label">
									@lang('backendcp::content.fields.fulltext')
								</label>
								<div class="col-sm-8">
									<textarea name="fulltext" placeholder="{{ __('backendcp::content.fields.fulltext_placeholder') }}" class="textarea form-control">{{ old('title')}}</textarea>									
								</div>
							</div>

							<div class="form-group">
                                <label for="image" class="col-sm-2 control-label">
                                    @lang('backendcp::content.fields.image')
                                </label>
                                <div class="col-sm-8">
                                    <div class="fileinput fileinput-new" data-provides="fileinput">
                                        <div class="fileinput-new thumbnail" style="width: 150px; height: 150px;">
                                            <img src="http://placehold.it/150x150" alt="profile pic">
                                        </div>
                                        <div class="fileinput-preview fileinput-exists thumbnail" style="max-width: 150px; max-height: 150px;"></div>
                                        <div>
                                            <span class="btn btn-default btn-file">
                                                <span class="fileinput-new">{!! __('backendcp::content.fields.select_img') !!}</span>
                                                <span class="fileinput-exists">{!! __('backendcp::content.fields.change') !!}</span>
                                                <input id="image" name="image" type="file" class="form-control"/>
                                            </span>
                                            <a href="#" class="btn btn-danger fileinput-exists"
                                               data-dismiss="fileinput">{!! __('backendcp::content.fields.remove') !!}</a>
                                        </div>
                                    </div>
                                </div>
                            </div>
						
					</div>
					<!-- /# card -->
				</div>
				<!-- /# column -->
			</div>
			<div class="col-md-3">
				<div class="card alert">					
						<div class="basic-form m-t-20">
							<div class="form-group">
								<label>{!! __('backendcp::content.fields.category') !!}</label>
								<select class="form-control border-none input-flat bg-ash" name="category_id">
									@foreach($categories as $category)
									<option value="{{$category->id}}" @if($category->id == old('category_id')) selected @endif >{{$category->title}}</option>
									@endforeach
									
								</select>
							</div>
						</div>

						<div class="basic-form m-t-20">
							<div class="form-group">
								<label>{!! __('backendcp::content.fields.status') !!}</label>								
								<select class="form-control border-none input-flat bg-ash" name="status">

									<option value="1" selected >{!! __('backendcp::content.fields.publish') !!}</option>
									<option value="0" @if( null!== old('status') && old('status') != 1 ) selected @endif >{!! __('backendcp::content.fields.unpublish') !!}</option>
								</select>
								
							</div>
						</div>

						<div class="basic-form m-t-20">
							<div class="form-group">
								<label>{!! __('backendcp::content.fields.featured') !!}</label>
								<select class="form-control border-none input-flat bg-ash" name="featured">
									<option value="0" selected >{!! __('backendcp::content.fields.no') !!}</option>
									<option value="1" @if( old('featured') == 1 ) selected @endif>{!! __('backendcp::content.fields.yes') !!}</option>
									
								</select>
							</div>
						</div>
					
					<button class="btn btn-default btn-lg m-b-10 bg-warning m-t-30 border-none m-r-5 sbmt-btn" type="submit">{!! __('backendcp::content.fields.save') !!}</button>
				</div>
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
            $('input[type="checkbox"].square, input[type="radio"].square').iCheck({
                checkboxClass: 'icheckbox_square-green',
                radioClass: 'iradio_square-green',
                increaseArea: '20%'
            });

            $('.textarea').summernote({
            	 height: 300,
                placeholder: "{{ __('backendcp::content.fields.fulltext_placeholder') }}",
                fontNames: ['Lato', 'Arial', 'Courier New'],

            });
        });
    </script>
@stop