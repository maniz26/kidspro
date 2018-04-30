<ul>
@foreach($menusItems as $menuItem)
	@php
		if( $menuItem->content_link) {
			$link = $menuItem->content_link;
		}elseif( $menuItem->external_link ){
			$link = $menuItem->external_link;
		}else{
			$link = $menuItem->menu_link;
		}		
	@endphp
	<li><a href="{{$link}}" target="{{$menuItem->target}}">{{$menuItem->title}}</a></li>
@endforeach
</ul>