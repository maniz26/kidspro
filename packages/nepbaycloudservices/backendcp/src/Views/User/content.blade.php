<div class="ArticlePage">
  <div class="container">
    <div class="row">
      <div class="col-md-9">
        <div class="LcolArticle">
          <h1> <span></span> {{$content->title}}</h1>
          @if($content->image)
          <div class="InnberBanner"> <img src="{{ asset('uploads/contents/'.$content->image)}}" alt="{{$content->title}}" class="img-fluid"></div>
          @endif
          <div class="Articleinfo">{!! $content->fulltext !!}</div>
        </div>
      </div>
      {!! Packagebridge::_dispatchModule('offer',['method' =>'offerSideBar','component'=>'plugins']) !!}
   
          </div>
        </div>
      </div>