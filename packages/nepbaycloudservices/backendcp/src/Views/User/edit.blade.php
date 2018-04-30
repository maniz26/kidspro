@extends('backendcp::template')
@section('content')
<div class="container-fluid">
	<div class="row">
		<div class="col-lg-8 p-r-0 title-margin-right">
			<div class="page-header">
				<div class="page-title">
					<ol class="breadcrumb ">
						<li><i class="ti-home"></i> <a href="#">{!! __('backendcp::general.dashboard') !!}</a></li>
						<li><a href="#">{!! __('backendcp::user.title') !!}</a></li>
						<li class="active">{!! __('backendcp::user.breadcrum.edit') !!}</li>
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
			<form name="adminForm" class="form-horizontal" action="{{route('admin.user.update')}}" method="post" enctype="multipart/form-data">
			{{ csrf_field()}}
			<input type="hidden" name="id" value="{{$user->userID}}">
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
									@lang('backendcp::user.fields.name')
								</label>
								<div class="col-sm-8">
									<input type="text" name="name" class="form-control" placeholder="{{ __('backendcp::user.fields.name') }}" value="{{$user->name  or old('name')}}">
								</div>
							</div>

							<div class="form-group {{ $errors->first('title', 'has-error') }}">
								<label for="title" class="col-sm-2 control-label">
									@lang('backendcp::user.fields.email')
								</label>
								<div class="col-sm-8">
									<input type="text" name="email" class="form-control" placeholder="{{ __('backendcp::user.fields.email') }}" value="{{$user->email  or old('email')}}">
								</div>
							</div>

							<div class="form-group {{ $errors->first('title', 'has-error') }}">
								<label for="title" class="col-sm-2 control-label">
									@lang('backendcp::user.fields.phone_number')
								</label>
								<div class="col-sm-8">
									<input type="text" name="contact_number" class="form-control" placeholder="{{ __('backendcp::user.fields.phone_number') }}" value="{{$user->phone_number  or old('phone_number')}}">
								</div>
							</div>

							<div class="form-group {{ $errors->first('title', 'has-error') }}">
								<label for="title" class="col-sm-2 control-label">
									@lang('backendcp::user.fields.address')
								</label>
								<div class="col-sm-8">
									<input type="text" name="address" class="form-control" placeholder="{{ __('backendcp::user.fields.address') }}" value="{{$user->address  or old('address')}}">
								</div>
							</div>

							<div class="form-group {{ $errors->first('title', 'has-error') }}">
								<label for="title" class="col-sm-2 control-label">
									@lang('backendcp::user.fields.country')
								</label>
								<div class="col-sm-8">
									<select name="country_id" class="form-control">
										 <option value="">Select Country</option>
	                                        @foreach($countries as $code=>$country)
	                                        <option value="{{$code}}" @if( $user->country_id == $code) selected @endif>{{$country}}</option>
	                                        @endforeach
									</select>
								</div>
							</div>

							<div class="form-group {{ $errors->first('title', 'has-error') }}">
								<label for="title" class="col-sm-2 control-label">
									@lang('backendcp::user.fields.city')
								</label>
								<div class="col-sm-8">
									<input type="text" name="city_id" class="form-control" placeholder="{{ __('backendcp::user.fields.city') }}" value="{{$user->city_id  or old('city_id')}}">
								</div>
							</div>

							

							<div class="form-group">
                                <label for="image" class="col-sm-2 control-label">
                                    @lang('backendcp::user.fields.avatar')
                                </label>
                                <div class="col-sm-8">
                                    <div class="fileinput fileinput-new" data-provides="fileinput">
                                        <div class="fileinput-new thumbnail" style="width: 150px; height: 150px;">
                                            @if($user->avatar)
                                               <img src="{{asset('uploads/users/'.$user->avatar)}}">
                                            @else
                                            	<img src="http://placehold.it/150x150" alt="profile pic">
                                            @endif
                                        </div>
                                        <div class="fileinput-preview fileinput-exists thumbnail" style="max-width: 150px; max-height: 150px;"></div>
                                        <div>
                                            <span class="btn btn-default btn-file">
                                                <span class="fileinput-new">{!! __('backendcp::user.fields.select_img') !!}</span>
                                                <span class="fileinput-exists">{!! __('backendcp::user.fields.change') !!}</span>
                                                <input id="avatar" name="avatar" type="file" class="form-control"/>
                                            </span>
                                            <a href="#" class="btn btn-danger fileinput-exists"
                                               data-dismiss="fileinput">{!! __('backendcp::user.fields.remove') !!}</a>
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
								<label>{!! __('backendcp::user.fields.group') !!}</label>
								<select class="form-control border-none input-flat bg-ash" name="role">									
									<option value="1" @if($user->role==1 ) selected @endif >Super Admin</option>
									<option value="2" @if($user->role==2 ) selected @endif >Registered User</option>
								</select>
							</div>
						</div>
					<button class="btn btn-default btn-lg m-b-10 bg-warning m-t-30 border-none m-r-5 sbmt-btn" type="submit">{!! __('backendcp::user.fields.save') !!}</button>
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
                placeholder: "{{ __('backendcp::user.fields.fulltext_placeholder') }}",
                fontNames: ['Lato', 'Arial', 'Courier New'],

            });
        });
    </script>
@stop