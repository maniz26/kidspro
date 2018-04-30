@if($content)
	
	@if(isset($content->seo) && $content->seo != '')
		<?php $seo = json_decode($content->seo,true);?>
		@if($seo['metatitle'] != null)
			<title>{{$seo['metatitle']}}</title>
			<meta property="og:title" content="{{$seo['metatitle']}}" />
			<meta name="twitter:title" content="{{$seo['metatitle']}}">
		@else
			@if($content->title != '')				
				<title>{!! $content->title !!}</title>
				<meta property="og:title" content="{{ $content->title }}" />
				<meta name="twitter:title" content="{{ $content->title }}">			
			@endif
		@endif
		@if($seo['metadesc'] != null)
			<meta property="og:description" content="{{$seo['metadesc']}}">
			<meta name="description" content="{{$seo['metadesc']}}">
			<meta name="twitter:description" content="{{$seo['metadesc']}}">
		@endif
		@if($seo['metakey'] != null)
			<meta name="keywords" content="{{$seo['metakey']}}">
		@endif
		@if( isset($image) && $image != '')
			<meta property="og:image" content="{{url($image)}}" />
			<meta name="twitter:card" content="{{url($image)}}">
		@endif
	@else
		@if(isset($content->title) && $content->title != '')
			
			<title>{{ $content->title }}</title>
			<meta property="og:title" content="{{ $content->title }}" />
			<meta name="twitter:title" content="{{ $content->title }}">		
		@endif

		@if( isset($content->description) && $content->description != '')
			<meta property="og:description" content="{{$content->description}}">
			<meta name="description" content="{{$content->description}}">
			<meta name="twitter:description" content="{{$content->description}}">
		@endif

		@if( isset($content->keywords) && $content->keywords != '')
			<meta name="keywords" content="{{$content->keywords}}">
		@endif
		@if( isset($image) && $image != '')
			<meta property="og:image" content="{{url($image)}}" />
			<meta name="twitter:card" content="{{url($image)}}">
		@endif
	@endif
@endif