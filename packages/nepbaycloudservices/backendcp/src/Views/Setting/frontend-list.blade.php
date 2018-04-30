<div class="row">
<div class="col-md-6">
	<div class="Popularcat">
		<ul>
			@foreach($categories as $category)
			<li><a href="{{route('frontend.category.list',$category->alias)}}"> <img src="{{asset('uploads/'.$category->icon)}}" alt="{{$category->translate($locator)->title}}"> <span>{{$category->translate($locator)->title}}</span></a></li>
			@endforeach
		</ul>
	</div>
</div>
<div class="col-md-6">
	<div class="Add"><img src="{{asset('classified/img/image.jpg')}}" alt="Ad" class="img-fluid"></div>
	<div class="Add mt-5"><img src="{{asset('classified/img/image.jpg')}}" alt="Ad" class="img-fluid"></div>
</div>
</div>
