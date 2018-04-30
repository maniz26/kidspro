@extends('backendcp::template')
@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-lg-8 p-r-0 title-margin-right">
            <div class="page-header">
                <div class="page-title">
                    <h1><span>{!! __('plugins::customfield.title') !!}</span></h1>
                </div>
            </div>
        </div>
        <!-- /# column -->
        <div class="col-lg-4 p-l-0 title-margin-left">
            <div class="page-header">
                <div class="page-title">
                    <ol class="breadcrumb text-right">
                        <li><a href="{{route('admin.root')}}">{!! __('backendcp::general.dashboard') !!}</a></li>
                        <li><a href="{{route('admin.customfield.list')}}">{!! __('plugins::customfield.title') !!}</a></li>
                        <li class="active">{!! __('plugins::customfield.breadcrum.create') !!}</li>
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
                            <form action="{{route('admin.customfield.update')}}" class="form-horizontal" id="createCustoms" role="form" method="post" >
                            {{ csrf_field()}}
                            <input type="hidden" name="id" value="{!! old('id',$custom->id) !!}" />
                            <div class="row">
                                <div class="form-group">
                                    <label class="col-sm-2 control-label">{!! __('backendcp::country.fields.name') !!}</label>
                                    <div class="col-sm-6">
                                          <select name="type" id="typeSelect" class="form-control select2">
                                            <option value="text" @if($custom->type == 'text' )selected="selected" @endif>{!! __('plugins::customfield.fields.text') !!}</option>
                                            <option value="textarea" @if($custom->type == 'textarea' )selected="selected" @endif>{!! __('plugins::customfield.fields.textarea') !!}</option>
                                            <option value="select" @if($custom->type == 'select' )selected="selected" @endif>{!! __('plugins::customfield.fields.select') !!}</option>
                                            <option value="mselect" @if($custom->type == 'mselect' )selected="selected" @endif>{!! __('plugins::customfield.fields.multi_select') !!}</option>
                                            <option value="checkbox" @if($custom->type == 'checkbox' )selected="selected" @endif>{!! __('plugins::customfield.fields.checkbox') !!}</option>
                                            <option value="radio" @if($custom->type == 'radio' )selected="selected" @endif>{!! __('plugins::customfield.fields.radio') !!}</option>
                                            <option value="image" @if($custom->type == 'image' )selected="selected" @endif>{!! __('plugins::customfield.fields.image') !!}</option>
                                            <option value="editor" @if($custom->type == 'editor' )selected="selected" @endif>{!! __('plugins::customfield.fields.editor') !!}</option>
                                            </select>
                                    </div>
                                </div>

                                 
                                <div class="form-group {{ $errors->first('label_text', 'has-error') }}">
                                    <label for="label_text" class="col-sm-2 control-label">
                                        {!! __('plugins::customfield.list.label') !!}
                                    </label>
                                    <div class="col-sm-6">
                                        <input type="text" name="label_text" value="{{old('label_text',$params->label_text)}}" class="form-control" placeholder="Field Label Text">
                                    </div>
                                </div>

                                <div class="form-group placeholder {{ $errors->first('placeholder', 'has-error') }}">
                                    <label for="placeholder" class="col-sm-2 control-label">
                                        {!! __('plugins::customfield.fields.placeholder') !!}
                                    </label>
                                    <div class="col-sm-6">
                                        <input type="text" name="placeholder" value="{{old('placeholder',$params->placeholder)}}" class="form-control" placeholder="Field Placeholder">
                                    </div>
                                </div>

                                <div class="form-group help_text {{ $errors->first('help_text', 'has-error') }}">
                                    <label for="help_text" class="col-sm-2 control-label">
                                        {!! __('plugins::customfield.fields.help_text') !!}
                                    </label>
                                    <div class="col-sm-6">
                                        <input type="text" name="help_text"  value="{{old('placeholder',$params->help_text)}}" class="form-control" placeholder="Field Help Text">
                                    </div>
                                </div>

                                <div class="form-group required {{ $errors->first('required', 'has-error') }}">
                                    <label for="required" class="col-sm-2 control-label">
                                         {!! __('plugins::customfield.fields.required') !!} 
                                    </label>
                                    <div class="col-sm-6">
                                        <div class="checkbox">
                                            <input type="checkbox" id="required" name="required" class="square" value="1"  @if($params->required == 1)checked="checked" @endif>
                                        </div>
                                    </div>
                                </div>

                                <div class="selectField" style="display: none;">
                                    <div class="form-group {{ $errors->first('options', 'has-error') }}">
                                        <label for="options" class="col-sm-2 control-label">
                                            
                                            {!! __('plugins::customfield.fields.options') !!} 
                                        </label>
                                        <div class="col-sm-6">
                                            <textarea name="options" rows="5" class="form-control" placeholder="e.g: One,Two,Three">{{old('options',$params->options)}}</textarea>
                                        </div>
                                    </div>
                                    <div class="form-group {{ $errors->first('values', 'has-error') }}">
                                        <label for="values" class="col-sm-2 control-label">
                                            {!! __('plugins::customfield.fields.values') !!} 
                                        </label>
                                        <div class="col-sm-6">
                                            <textarea name="values" rows="5" class="form-control" placeholder="e.g: 1,2,3">{{old('options',$params->values)}}</textarea>
                                        </div>
                                    </div>
                                </div>

                                <div class="checkboxField" style="display: none;">
                                    <div class="form-group {{ $errors->first('checkboxes', 'has-error') }}">
                                        <label for="checkboxes" class="col-sm-2 control-label">
                                            {!! __('plugins::customfield.fields.checkboxes') !!}
                                        </label>
                                        <div class="col-sm-6">
                                            <textarea name="checkboxes" rows="5" class="form-control" placeholder="e.g: One,Two,Three">{{old('options',$params->checkboxes)}}</textarea>
                                        </div>
                                    </div>
                                    <div class="form-group {{ $errors->first('checkboxes_values', 'has-error') }}">
                                        <label for="checkboxes_values" class="col-sm-2 control-label">                                            
                                             {!! __('plugins::customfield.fields.checkboxes_values') !!}
                                        </label>
                                        <div class="col-sm-6">
                                            <textarea name="checkboxes_values" rows="5" class="form-control" placeholder="e.g: 1,2,3">{{old('options',$params->checkboxes_values)}}</textarea>
                                        </div>
                                    </div>
                                </div>

                                <div class="radioField" style="display: none;">
                                    <div class="form-group {{ $errors->first('radios', 'has-error') }}">
                                        <label for="radios" class="col-sm-2 control-label">                                            
                                            {!! __('plugins::customfield.fields.radios') !!}
                                        </label>
                                        <div class="col-sm-6">
                                            <textarea name="radios" rows="5" class="form-control" placeholder="e.g: One,Two,Three">{{old('options',$params->radios)}}</textarea>
                                        </div>
                                    </div>
                                    <div class="form-group {{ $errors->first('radios_values', 'has-error') }}">
                                        <label for="radios_values" class="col-sm-2 control-label">                                            
                                            {!! __('plugins::customfield.fields.radio_values') !!}
                                        </label>
                                        <div class="col-sm-6">
                                            <textarea name="radios_values" rows="5" class="form-control" placeholder="e.g: 1,2,3">{{old('options',$params->radios_values)}}</textarea>
                                        </div>
                                    </div>
                                </div>

                                <div style="display: none;" class="form-group default_text {{ $errors->first('default_text', 'has-error') }}">
                                    <label for="default_text" class="col-sm-2 control-label">                                        
                                        {!! __('plugins::customfield.fields.default_text') !!}
                                    </label>
                                    <div class="col-sm-6">
                                        <textarea name="default_text" rows="5" class="form-control field" data-type="textarea-splir"><{{old('options',$params->default_text)}}/textarea>
                                    </div>
                                </div>

                                <div class="form-group input_size {{ $errors->first('input_size', 'has-error') }}">
                                    <label for="input_size" class="col-sm-2 control-label">                                        
                                        {!! __('plugins::customfield.fields.input_size') !!}
                                    </label>
                                    <div class="col-sm-6">
                                        <select name="input_size" id="input_sizeSelect" class="form-control">
                                            <option value="col-md-1" @if($params->input_size == 'col-md-1' )selected="selected" @endif>Mini</option>
                                            <option value="col-md-2" @if($params->input_size == 'col-md-2' )selected="selected" @endif>Small</option>
                                            <option value="col-md-4" @if($params->input_size == 'col-md-4' )selected="selected" @endif>Medium</option>
                                            <option value="col-md-5" @if($params->input_size == 'col-md-5' )selected="selected" @endif>Large</option>
                                            <option value="col-md-6" @if($params->input_size == 'col-md-6' )selected="selected" @endif>Xlarge</option>
                                            <option value="col-md-8" @if($params->input_size == 'col-md-8' )selected="selected" @endif>Xxlarge</option>
                                        </select>
                                    </div>
                                </div>


                                <div class="form-group">
                                    <label class="col-sm-2 control-label">{!! __('backendcp::country.fields.status') !!}</label>
                                    <div class="col-sm-6">
                                        <label class="control-label">
                                            <input type="radio" value="1" class="square" name="status" @if($custom->status == 1) checked @endif> {!! __('backendcp::country.fields.publish') !!}
                                            <input type="radio" value="0" class="square" name="status" @if($custom->status == 0) checked @endif> {!! __('backendcp::country.fields.unpublish') !!}
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
    <!--page level css -->
    <link href="{{ asset('backendcp/assets/vendors/jasny-bootstrap/css/jasny-bootstrap.css') }}" rel="stylesheet">
    <link href="{{ asset('backendcp/assets/vendors/bootstrap3-wysihtml5-bower/css/bootstrap3-wysihtml5.min.css') }}"  rel="stylesheet" media="screen"/>
    <link href="{{ asset('backendcp/assets/css/pages/editor.css') }}" rel="stylesheet" type="text/css"/>
    <!--end of page level css-->

    <link rel="stylesheet" type="text/css" href="{{ asset('backendcp/assets/vendors/iCheck/css/all.css') }}"/>
    <link href="{{ asset('backendcp/assets/vendors/select2/css/select2.min.css') }}" rel="stylesheet" />
    <link href="{{ asset('backendcp/assets/vendors/select2/css/select2-bootstrap.css') }}" rel="stylesheet" />
@stop

@section('footer-scripts')
    <script src="{{ asset('backendcp/assets/vendors/jasny-bootstrap/js/jasny-bootstrap.js') }}"  type="text/javascript"></script>
    <script src="{{asset('backendcp/assets/vendors/tinymce/tinymce.min.js')}}" type="text/javascript"></script>
    <script type="text/javascript" src="{{ asset('backendcp/assets/vendors/iCheck/js/icheck.js') }}"></script>
    <script type="text/javascript" src="{{ asset('backendcp/assets/vendors/select2/js/select2.js') }}"></script>
    <script src="{{ asset('backendcp/assets/vendors/bootstrapvalidator/js/bootstrapValidator.min.js') }}" type="text/javascript"></script>
    <script type="text/javascript">
        $(document).ready(function(){
            $('input[type="checkbox"].square, input[type="radio"].square').iCheck({
                checkboxClass: 'icheckbox_square-green',
                radioClass: 'iradio_square-green',
                increaseArea: '20%'
            });
           
           
            $("#typeSelect").select2({
                theme:"bootstrap",
                placeholder:"Select a value"
            });
            $("#input_sizeSelect").select2({
                theme:"bootstrap",
                placeholder:"Select a value"
            });
            

            $('.select2').on('select2:selecting', function(e) {
                var sel = e.params.args.data.id;
                if(sel == 'select' || sel == 'mselect'){
                    $('.placeholder').hide();
                    $('.help_text').hide();
                    $('.required').hide();
                    $('.default_text').hide();
                    $('.radioField').hide();
                    $('.checkboxField').hide();
                    $('.input_size').slideDown(300);
                    $('.selectField').slideDown(300);
                }else if(sel == 'textarea' || sel == 'editor'){
                    $('.placeholder').hide();
                    $('.help_text').hide();
                    $('.required').hide();
                    $('.input_size').hide();
                    $('.radioField').hide();
                    $('.checkboxField').hide();
                    $('.selectField').hide();
                    $('.default_text').slideDown(300);
                }else if(sel == 'checkbox'){
                    $('.placeholder').hide();
                    $('.help_text').hide();
                    $('.required').hide();
                    $('.input_size').hide();
                    $('.default_text').hide();
                    $('.radioField').hide();
                    $('.selectField').hide();
                    $('.checkboxField').slideDown(300);
                }else if(sel == 'radio'){
                    $('.placeholder').hide();
                    $('.help_text').hide();
                    $('.required').hide();
                    $('.input_size').hide();
                    $('.default_text').hide();
                    $('.checkboxField').hide();
                    $('.selectField').hide();
                    $('.radioField').slideDown(300);
                }else if(sel == 'text'){
                    $('.placeholder').slideDown(300);
                    $('.help_text').slideDown(300);
                    $('.required').slideDown(300);
                    $('.input_size').slideDown(300);
                    $('.default_text').hide();
                    $('.radioField').hide();
                    $('.checkboxField').hide();
                    $('.selectField').hide();
                }else if(sel == 'image'){
                    $('.placeholder').hide();
                    $('.help_text').hide();
                    $('.required').hide();
                    $('.default_text').hide();
                    $('.radioField').hide();
                    $('.checkboxField').hide();
                    $('.selectField').hide();
                    $('.input_size').hide();
                }else{
                    $('.placeholder').slideDown(300);
                    $('.help_text').slideDown(300);
                    $('.required').slideDown(300);
                    $('.input_size').slideDown(300);
                }
            });

            $("#createCustoms").bootstrapValidator({
                fields: {                    
                    label_text: {
                        validators: {
                            notEmpty: {
                                message: 'The Label Text is required'
                            }
                        },
                        required: true,
                        minlength: 3
                    }
                }
            });
        });
    </script>
@stop