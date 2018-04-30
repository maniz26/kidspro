<div class="form-group">
    <label class="col-sm-2 control-label">{!! __('backendcp::menuitem.fields.parent') !!}</label>
    <div class="col-sm-8">
        <select class="form-control select2" name="parent_id">
            <option value="0">{!! __('backendcp::general.fields.root') !!}</option>
            @foreach($menuItems as $menu)
            <option value="{{$menu->id}}">{{$menu->title}}</option>
            @endforeach
        </select>
    </div>
</div>