@if($content && $content->seo != '')
    <?php $seo = json_decode($content->seo,true);?>
    <div class="form-group @if(isset($class)){{$class}} @endif">
        <label for="metakey" class="col-sm-2 control-label">
            {!! __('addons::seo.fields.metatitle') !!}
        </label>
        <div class="col-sm-8">
            <input type="text" name="metatitle" class="form-control" placeholder="{!! __('addons::seo.fields.metatitle') !!}" value="{!! old('metatitle',$seo['metatitle']) !!}">
        </div>
    </div>
    <div class="form-group @if(isset($class)){{$class}} @endif">
        <label for="metakey" class="col-sm-2 control-label">
            {!! __('addons::seo.fields.metakey') !!}
        </label>
        <div class="col-sm-8">
            <textarea id="metakey" name="metakey" rows="3" class="form-control resize_vertical" placeholder="{!! __('addons::seo.fields.metakey') !!}">{!! old('metakey',$seo['metakey']) !!}</textarea>
        </div>
    </div>
    <div class="form-group @if(isset($class)){{$class}} @endif">
        <label for="metadesc" class="col-sm-2 control-label">
            {!! __('addons::seo.fields.metadesc') !!}
        </label>
        <div class="col-sm-8">
            <textarea id="metadesc" name="metadesc" rows="3" class="form-control resize_vertical" placeholder="{!! __('addons::seo.fields.metadesc') !!}">{!! old('metadesc',$seo['metadesc']) !!}</textarea>
        </div>
    </div>
@else
    <div class="form-group @if(isset($class)){{$class}} @endif">
        <label for="metakey" class="col-sm-2 control-label">
           {!! __('addons::seo.fields.metatitle') !!}
        </label>
        <div class="col-sm-8">
            <input type="text" name="metatitle" class="form-control" placeholder="{!! __('addons::seo.fields.metatitle') !!}" value="{!! old('metatitle') !!}">
        </div>
    </div>
    <div class="form-group @if(isset($class)){{$class}} @endif">
        <label for="metakey" class="col-sm-2 control-label">
            {!! __('addons::seo.fields.metakey') !!}
        </label>
        <div class="col-sm-8">
            <textarea id="metakey" name="metakey" rows="3" class="form-control resize_vertical" placeholder="{!! __('addons::seo.fields.metakey') !!}">{!! old('metakey') !!}</textarea>
        </div>
    </div>
    <div class="form-group @if(isset($class)){{$class}} @endif">
        <label for="metadesc" class="col-sm-2 control-label">
            {!! __('addons::seo.fields.metadesc') !!}
        </label>
        <div class="col-sm-8">
            <textarea id="metadesc" name="metadesc" rows="3" class="form-control resize_vertical" placeholder="{!! __('addons::seo.fields.metadesc') !!}">{!! old('metadesc') !!}</textarea>
        </div>
    </div>
@endif