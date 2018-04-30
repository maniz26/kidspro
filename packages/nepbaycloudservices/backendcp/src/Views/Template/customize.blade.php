@extends('backendcp::template')
@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-8 p-r-0 title-margin-right">
                <div class="page-header">
                    <div class="page-title">
                        <ol class="breadcrumb ">
                            <li><i class="ti-home"></i> <a href="{{route('admin.root')}}">{!! __('backendcp::general.dashboard') !!}</a></li>
                            <li class="active" ><a href="{{route('admin.template.list')}}">Template</a></li>
                            <li class="active">{!! $title !!}</li>
                        </ol>
                    </div>
                </div>
            </div>
            <!-- /# column -->
            <div class="col-lg-4 p-l-0 title-margin-left">
                <div class="page-header">

                </div>
            </div>
            <!-- /# column -->
        </div>
        <!-- /# row -->
        <section id="main-content">
            <div class="row">
                <div class="col-lg-12">
                    <div class="card alert">
                        <div class="row card-header">
                            <h4>Templates</h4>
                        </div>
                        <style>
                            div.polaroid {
                                width: 100%;
                                background-color: white;
                                box-shadow: 0 4px 8px 0 rgba(0, 0, 0, 0.2), 0 6px 20px 0 rgba(0, 0, 0, 0.19);
                                margin-bottom: 25px;
                            }
                            div.container1{
                                text-align: center;
                                padding: 10px 20px;
                            }
                        </style>
                        <div class="row">
                            @foreach($data as $d)
                                @if($title=="Header")
                                    <div class="col-sm-12">
                                        <div class="polaroid">
                                            <h3><b>{!! $d->title !!}</b></h3>
                                            <img src="/{!!$d->photo!!}" alt="image load failed" style="width: 100%;height: 150px;">
                                            <div class="container1">
                                                @if ($d->status == 1)
                                                    <button class="btn btn-warning" disabled>Activated</button>
                                                @else
                                                    <a href="{{route('admin.template.use',[$d->id,$title])}}" class="btn btn-primary" style="width:75px">Activate</a>
                                                @endif
                                            </div>
                                        </div>
                                    </div>
                                @else
                                    <div class="col-lg-6">
                                    <div class="polaroid">
                                        @if($title=="Footer")
                                            <h3><b>{!! $d->title !!}</b></h3>
                                            <img src="/{!!$d->photo!!}" alt="image load failed" style="width: 100%;height: 200px;">
                                        @else
                                            <h3><b>{!! $d->title !!}</b></h3>
                                            <img src="/{!!$d->photo!!}" alt="image load failed" style="width: 100%;height: 250px;">
                                        @endif
                                        <div class="container1">
                                            @if ($d->status == 1)
                                                <button class="btn btn-warning" disabled>Activated</button>
                                            @else
                                                <a href="{{route('admin.template.use',[$d->id,$title])}}" class="btn btn-primary" style="width:75px">Activate</a>
                                            @endif
                                        </div>
                                    </div>
                                </div>
                                @endif
                            @endforeach
                        </div>
                    </div>
                </div>
                <!-- /# column -->
            </div>
            <!-- /# row -->
            @include('backendcp::footer')
        </section>
    </div>
@endsection
