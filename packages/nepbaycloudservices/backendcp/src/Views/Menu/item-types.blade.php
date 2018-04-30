<div class="modal-header">
    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
    <h4 class="modal-title" id="gridSystemModalLabel">Menu Item Type</h4>
</div>
<div class="modal-body">
    <div class="panel-group" id="accordion">
        @foreach($menuItems as $key=>$menuitem)
        @if( isset($menuitem['frontend']))
        
        <div class="panel panel-default">
            <div class="panel-heading">
                <h4 class="panel-title"><a data-toggle="collapse" data-parent="#accordion" href="#collapse{{$key}}">{{$menuitem['title']}}</a></h4>
            </div>
            <div id="collapse{{$key}}" class="panel-collapse collapse">
                <div class="panel-body">
                    <ul class="list-group">
                        @if( isAssoc($menuitem['frontend']['menu']))
                            @php
                            $url = isset( $menuitem['frontend']['menu']['url'] ) ? route( $menuitem['frontend']['menu']['url'] ): $menuitem['frontend']['menu']['title'];
                            @endphp
                            <li class="list-group-item"><a href="#" data-url="{{$url}}" @if( isset($menuitem['frontend']['menu']['component'])) data-component="{{$menuitem['frontend']['menu']['component']}}" data-type="{{$menuitem['frontend']['menu']['type']}}" @endif>{{$menuitem['frontend']['menu']['title']}}</a></li>
                        @else
                            @foreach($menuitem['frontend']['menu'] as $menu)
                                @php
                                $url = isset( $menu['url'] )? route( $menu['url'] ): $menu['title'];
                                @endphp
                                <li class="list-group-item"><a href="#" data-url="{{$url}}" @if( isset($menu['component']) ) data-component="{{$menu['component']}}" @endif data-type="{{$menu['type']}}">{{$menu['title']}}</a></li>
                                @endforeach
                        @endif
                    </ul>
                </div>
            </div>
        </div>
        @endif
        @endforeach
        
         <div class="panel panel-default">
            <div class="panel-heading">
                <h4 class="panel-title"><a data-toggle="collapse" data-parent="#accordion" href="#collapseExt">Others</a></h4>
            </div>
            <div id="collapseExt" class="panel-collapse collapse">
                <div class="panel-body">
                    <ul class="list-group">                       
                        <li class="list-group-item"><a href="#" data-url="Exernal Link" data-external="yes">URL</a></li>
                        <li class="list-group-item"><a href="#" data-url="Short Code" data-shortcode="yes">Short Code</a></li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="modal-footer">
    <button type="button" class="btn btn-primary" data-dismiss="modal">Close</button>    
</div>