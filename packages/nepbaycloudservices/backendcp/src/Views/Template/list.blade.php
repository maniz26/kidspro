@extends('backendcp::template')
@section('content')
    <script type="text/javascript">
        $(function() {
            $('#myframe').hide();
            $('#close').hide();

        });
        function changeFrame(id,name) {
            $('#myframe').attr('src','http://localhost:8000/backend/template/preview/'+name+'/'+id);
            $('#myframe').attr('height','100%');
            $('#myframe').attr('width','100%');
            $('#myModal').show();
            $('#myframe').show();
            $('#close').show();
            // $("#myframe").modal({keyboard: true});
        }
        function closeFrame() {
            $('#myframe').hide();
            $('#close').hide();
        }
    </script>

    <div class="container">
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
                                    <div class="col-md-6">
                                        <div class="polaroid">
                                            <h3><b>{!! $d->title !!}</b></h3>
                                            <img src="/{!!$d->photo!!}" alt="image load failed" style="width: 100%;height: 300px;">
                                            <div class="container1">
                                                @if ($d->status == 1)
                                                    <button class="btn btn-warning" disabled>Activated</button>
                                                @else
                                                    <a href="{{route('admin.template.use',[$d->id,$title])}}" class="btn btn-primary" style="width:75px">Activate</a>
                                                    <button  class="btn btn-success" onclick="return changeFrame({!! $d->id !!},'{!! $d->title !!}');" data-toggle="modal" data-target="#myModal">Live Preview</button>
                                                @endif
                                            </div>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    </div>
                    <!-- /# column -->
                </div>
                <!-- /# row -->
                @include('backendcp::footer')
            </section>
            <div class="modal fade" id="myModal" role="dialog">
                <div class="modal-dialog" style="width: 100%;height:580px ;margin: 50px auto 50px auto;">
                    <!-- Modal content-->
                    <div class="modal-content">
                        <div class="modal-body" >
                            <iframe id="myframe" src=" " scrolling="auto" style="position:fixed; top:0px; left:0px; bottom:0px; right:0px;display:block; width:100%; height:100%;  margin:0; padding-left:0px; overflow:hidden; z-index:999999;" >
                            </iframe>
                        </div>
                    </div>
                </div>
            </div>

        </div>

    </div>
@endsection
