@foreach($menuItems as $menuitem)
	@if(isAssoc($menuitem['submenu']))
		<li><a href="{{$menuitem['submenu']['url']}} "><i class="{{$menuitem['icon']}}"></i>{{$menuitem['submenu']['title']}} </a></li>
	@else
		<li class="active"><a class="sidebar-sub-toggle"><i class="{{$menuitem['icon']}}"></i> {{$menuitem['title']}} <span class="sidebar-collapse-icon ti-angle-down"></span></a>
			<ul>
				@if(!isset($menuitem['submenu']['single']))
				@foreach($menuitem['submenu'] as $submenuitem)
				<li><a href="{{$submenuitem['url']}} ">{{$submenuitem['title']}} </a></li>
				@endforeach
				@else
				<li><a href="{{$menuitem['submenu']['single']['url']}} ">{{$menuitem['submenu']['single']['title']}} </a></li>
				@endif
			</ul>
		</li>
	@endif
@endforeach	