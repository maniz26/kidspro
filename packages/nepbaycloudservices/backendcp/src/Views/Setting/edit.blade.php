@extends('backendcp::template')
@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-lg-8 p-r-0 title-margin-right">
            <div class="page-header">
                <div class="page-title">                 
                     <ol class="breadcrumb">
                        <li><a href="#">{!! __('backendcp::general.dashboard') !!}</a></li>
                        <li class="active">{!! __('backendcp::setting.title') !!}</li>
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
        
            <div class="col-lg-12 display_message"></div>
        

        <form name="adminForm" id="ncs-setting-form" class="form-horizontal" action="{{route('admin.setting.update')}}" method="post" enctype="multipart/form-data">
        <div class="row">
            <!-- /# column -->

            <div class="col-lg-6">
                <div class="card alert">
                    <div class="card-header">
                        <h4>Site</h4>
                    </div>
                    <div class="card-body">
                        <div class="horizontal-form-elements">
                            
                            <div class="row">
                                <div class="form-group">
                                    <label class="col-sm-3 control-label">{!! __('backendcp::setting.fields.name') !!}</label>
                                    <div class="col-sm-9">
                                        <input type="text" name="name"  class="form-control" value="{{config('app.name')}}">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-sm-3 control-label">{!! __('backendcp::setting.fields.title') !!}</label>
                                    <div class="col-sm-9">
                                        <input type="text" name="title"  class="form-control" value="{{config('packagebridge.title')}}">
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label class="col-sm-3 control-label">{!! __('backendcp::setting.fields.site_url') !!}</label>
                                    <div class="col-sm-9">                                        
                                        <input type="text" name="site_url"  class="form-control" value="{{config('packagebridge.site_url')}}">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-sm-3 control-label">{!! __('backendcp::setting.fields.keywords') !!}</label>
                                    <div class="col-sm-9">
                                        <input type="text" name="keywords"  class="form-control" value="{{config('packagebridge.keywords')}}">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-sm-3 control-label">{!! __('backendcp::setting.fields.description') !!}</label>
                                    <div class="col-sm-9">
                                        <textarea name="description"  class="form-control">{{config('packagebridge.description')}}</textarea>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-sm-3 control-label">{!! __('backendcp::setting.fields.copyright') !!}</label>
                                    <div class="col-sm-9">
                                        <input type="text" name="copyright"  class="form-control" value="{{config('packagebridge.copyright')}}">
                                    </div>
                                </div>
                              
                                <div class="form-group">
                                    <label class="col-sm-3 control-label">{!! __('backendcp::setting.fields.favicon') !!}</label>
                                    <div class="col-sm-9">
                                        <img src="{{asset('uploads/'.config('packagebridge.favicon'))}}" class="favicon_img" style="max-width:80px;">
                                        <input  type="file" value="Readonly value" name="favicon" id="favicon">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-sm-3 control-label">{!! __('backendcp::setting.fields.mode') !!}</label>
                                    <div class="col-sm-9 checkbox">
                                        <input type="radio" name="mode"  value="1" @if(config('packagebridge.mode') == '1'|| empty(config('packagebridge.mode')) ) checked @endif> Live
                                        <input type="radio" name="mode"  value="0" @if(config('packagebridge.mode') == '0') checked @endif> Maintenance
                                    </div>
                                </div>
                                
                                <!-- /# column -->
                            </div>
                          
                        </div>
                    </div>
                </div>
                <!-- /# card -->
            </div>
            <div class="col-lg-6">
                <div class="card alert">
                    <div class="card-header">
                        <h4>Social Login</h4>
                    </div>
                    <div class="card-body">
                        <div class="horizontal-form-elements">
                            <div class="row">                                
                                <div class="form-group">
                                    <label class="col-sm-3 control-label">{!! __('backendcp::setting.fields.facebook_client_id') !!}</label>
                                    <div class="col-sm-9">
                                        <input type="text" name="facebook_client_id"  class="form-control" value="{{config('packagebridge.facebook_client_id')}}">                                        
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-sm-3 control-label">{!! __('backendcp::setting.fields.facebook_client_secret') !!}</label>
                                    <div class="col-sm-9">
                                        <input type="text" name="facebook_client_secret"  class="form-control" value="{{config('packagebridge.facebook_client_secret')}}">
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label class="col-sm-3 control-label">{!! __('backendcp::setting.fields.twitter_client_id') !!}</label>
                                    <div class="col-sm-9">
                                        <input type="text" name="twitter_client_id"  class="form-control" value="{{config('packagebridge.twitter_client_id')}}">                                        
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-sm-3 control-label">{!! __('backendcp::setting.fields.twitter_client_secret') !!}</label>
                                    <div class="col-sm-9">
                                        <input type="text" name="twitter_client_secret"  class="form-control" value="{{config('packagebridge.twitter_client_secret')}}">
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label class="col-sm-3 control-label">{!! __('backendcp::setting.fields.google_client_id') !!}</label>
                                    <div class="col-sm-9">
                                        <input type="text" name="google_client_id"  class="form-control" value="{{config('packagebridge.google_client_id')}}">                                        
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-sm-3 control-label">{!! __('backendcp::setting.fields.google_client_secret') !!}</label>
                                    <div class="col-sm-9">
                                        <input type="text" name="google_client_secret"  class="form-control" value="{{config('packagebridge.google_client_secret')}}">
                                    </div>
                                </div>
                                
                                <!-- /# column -->
                            </div>
                            
                        </div>
                    </div>
                </div>
            </div>


           
        </div>

        <div class="row">
             <div class="col-lg-6">
                <div class="card alert">
                    <div class="card-header">
                        <h4>Flight API Credentials</h4>
                    </div>
                    <div class="card-body">
                        <div class="horizontal-form-elements">
                            <div class="row">                                
                                <div class="form-group">
                                    <label class="col-sm-3 control-label">{!! __('backendcp::setting.fields.dm_username') !!}</label>
                                    <div class="col-sm-9">
                                        <input type="text" name="dm_username"  class="form-control" value="{{config('domflight.dm_username')}}">                                        
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-sm-3 control-label">{!! __('backendcp::setting.fields.dm_end_point') !!}</label>
                                    <div class="col-sm-9">
                                        <input type="text" name="dm_end_point"  class="form-control" value="{{config('domflight.dm_end_point')}}">
                                    </div>
                                </div>
                                 <div class="form-group">
                                    <label class="col-sm-3 control-label">{!! __('backendcp::setting.fields.dm_password') !!}</label>
                                    <div class="col-sm-9">
                                        <input type="text" name="dm_password"  class="form-control" value="{{config('domflight.dm_password')}}">
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label class="col-sm-3 control-label">{!! __('backendcp::setting.fields.dm_agent_id') !!}</label>
                                    <div class="col-sm-9">
                                        <input type="text" name="dm_agent_id"  class="form-control" value="{{config('domflight.dm_agent_id')}}">                                        
                                    </div>
                                </div>                            
                                
                                <!-- /# column -->
                            </div>
                            
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-lg-6">
                <div class="card alert">
                    <div class="card-header">
                        <h4>Googel Recaptcha Credentials</h4>
                    </div>
                    <div class="card-body">
                        <div class="horizontal-form-elements">
                            <div class="row">                                
                                <div class="form-group">
                                    <label class="col-sm-3 control-label">{!! __('backendcp::setting.fields.google_rechatcha_key') !!}</label>
                                    <div class="col-sm-9">
                                        <input type="text" name="google_rechatcha_key"  class="form-control" value="{{config('recaptcha.google_rechatcha_key')}}">                                        
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-sm-3 control-label">{!! __('backendcp::setting.fields.google_rechatcha_secret') !!}</label>
                                    <div class="col-sm-9">
                                        <input type="text" name="google_rechatcha_secret"  class="form-control" value="{{config('recaptcha.google_rechatcha_secret')}}">
                                    </div>
                                </div>
                                                        
                                
                                <!-- /# column -->
                            </div>
                            
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">

             <div class="col-lg-6">
                <div class="card alert">
                    <div class="card-header">
                        <h4>2c2p Credentials</h4>
                    </div>
                    <div class="card-body">
                        <div class="horizontal-form-elements">
                            <div class="row">                                
                                <div class="form-group">
                                    <label class="col-sm-3 control-label">{!! __('backendcp::setting.fields.url_2c2p') !!}</label>
                                    <div class="col-sm-9">
                                        <input type="text" name="url_2c2p"  class="form-control" value="{{config('payment.url_2c2p')}}">                                        
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-sm-3 control-label">{!! __('backendcp::setting.fields.version_2c2p') !!}</label>
                                    <div class="col-sm-9">
                                        <input type="text" name="version_2c2p"  class="form-control" value="{{config('payment.version_2c2p')}}">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-sm-3 control-label">{!! __('backendcp::setting.fields.merchant_id_2c2p') !!}</label>
                                    <div class="col-sm-9">
                                        <input type="text" name="merchant_id_2c2p"  class="form-control" value="{{config('payment.merchant_id_2c2p')}}">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-sm-3 control-label">{!! __('backendcp::setting.fields.merchant_name_2c2p') !!}</label>
                                    <div class="col-sm-9">
                                        <input type="text" name="merchant_name_2c2p"  class="form-control" value="{{config('payment.merchant_name_2c2p')}}">
                                    </div>
                                </div>
                                  <div class="form-group">
                                    <label class="col-sm-3 control-label">{!! __('backendcp::setting.fields.secretKey_2c2p') !!}</label>
                                    <div class="col-sm-9">
                                        <input type="text" name="secretKey_2c2p"  class="form-control" value="{{config('payment.secretKey_2c2p')}}">
                                    </div>
                                </div>
                                                        
                                
                                <!-- /# column -->
                            </div>
                            
                        </div>
                    </div>
                </div>
            </div>
            
        </div>
         <div class="row">            
            <div class="col-lg-12">
                <div class="card-body">
                    <div class="row">
                        <div class="form-group">
                            
                            <div class="col-sm-12">
                                <button type="button" class="btn btn-default btn-lg m-b-10 bg-warning m-t-30 border-none m-r-5 sbmt-btn ncs-setting-btn"  style="float: right;">{!! __('backendcp::setting.fields.save') !!}</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- /# column -->
        </div>
        <!-- /# row -->
        </form>

        @include('backendcp::footer')
        
    </section>
</div>
@endsection
@section('footer-scripts')
<script type="text/javascript">

var faviconLoader = document.getElementById('favicon');
faviconLoader.addEventListener('change', handlefaviconImage, false);


function handlefaviconImage(e) {
    var reader = new FileReader();
    reader.onload = function (event) {
        $('.favicon_img').attr('src',event.target.result);
    }
    reader.readAsDataURL(e.target.files[0]);
}


$(document).ready(function(){
    $('.ncs-setting-btn').click(function(e){
       
        e.preventDefault();
        $.ajaxSetup({
            headers: {
            'X-CSRF-TOKEN': '{{csrf_token()}}'
            }
        });

        var frm = document.getElementById('ncs-setting-form');
        var formData = new FormData(frm);
        $.ajax({
            url: "{{route('admin.setting.update')}}",
            data: formData,
            type: 'POST',
            contentType: false, // NEEDED, DON'T OMIT THIS (requires jQuery 1.6+)
            processData: false, // NEEDED, DON'T OMIT THIS
            //dataType: 'json',
            beforeSend: function(xhr) {},
            success: function(data) {
                    $('.display_message').append('<div class="alert alert-info">Setting Updated.<a href="#" class="close" data-dismiss="alert" aria-label="close">×</a></div>');

            },
            error: function(data) {
                console.log('Error:', data);
            }
        });
    });
});
</script>
@endsection