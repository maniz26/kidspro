@extends('backendcp::template')
@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-lg-8 p-r-0 title-margin-right">
            <div class="page-header">
                <div class="page-title">
                    <h1>Dashboard</h1>
                </div>
            </div>
        </div>
        <!-- /# column -->
        <div class="col-lg-4 p-l-0 title-margin-left">
            <div class="page-header">
                <div class="page-title">
                    <ol class="breadcrumb text-right">
                        <li><a href="#">Dashboard</a></li>
                        <li class="active">Hotel Room</li>
                    </ol>
                </div>
            </div>
        </div>
        <!-- /# column -->
    </div>
    <!-- /# row -->
    <section id="main-content">
        <div class="row">
            <div class="col-md-3">
                <div class="card alert">
                    <div class="card-header pr">
                        <h4>Page Layout</h4>
                    </div>
                    <form>
                        <div class="basic-form m-t-20">
                            <div class="card-body">
                                    <p class="text-muted m-b-15">Select the below page to edit layout:</p>

                                    <div class="list-group">
                                     @foreach($components as $key=>$component)
                                        <a href="{{route('backend.layout',$component['view'])}}" class="list-group-item @if($page ==$component['view']) active @endif">
                                            <h4 class="list-group-item-heading">{{$component['title']}}</h4>
                                            <p class="list-group-item-text">{{$key}}</p>
                                        </a>
                                        @endforeach                                        
                                    </div>
                                </div>
                        </div>
                                             
                    </form>
                    
                    <button class="btn btn-default btn-lg m-b-10 m-l-5 sbmt-btn" type="button">Reset</button>
                </div>
            </div>
            <div class="col-lg-9">
                <div class="card alert">
                    <div class="card-header pr">
                        <h4>Positions</h4>
                        
                        <div class="card-header-right-icon">
                           

                        <button class="btn btn-default btn-lg m-b-10 bg-warning border-none m-r-5 sbmt-btn" type="button">Add Module</button>
                        </div>
                    </div>
                    <div class="card-body">
                        <iframe src="{{route('backend.layout.position',$page)}}" width="1000" height="500"></iframe>
                        <div class="table-responsive">
                            <table class="table student-data-table m-t-20">
                                <thead>
                                    <tr>
                                        <th><label><input type="checkbox" value=""></label>Hotel Name</th>
                                        <th>Room No</th>
                                        <th>Room Type</th>
                                        <th>No Of Bed</th>
                                        <th>Cost Per Bed</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td><label><input type="checkbox" value=""></label>Boys-104</td>
                                        <td>
                                            204
                                        </td>
                                        <td>Big</td>
                                        <td>
                                            03
                                        </td>
                                        <td>
                                            $50.00
                                        </td>
                                        <td>
                                            <span><a href=""><i class="ti-eye color-default"></i></a> </span>
                                            <span><a href=""><i class="ti-pencil-alt color-success"></i></a></span>
                                            <span><a href=""><i class="ti-trash color-danger"></i> </a></span>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td><label><input type="checkbox" value=""></label>Boys-210</td>
                                        <td>
                                            204
                                        </td>
                                        <td>mediam</td>
                                        <td>
                                            03
                                        </td>
                                        <td>
                                            $50.00
                                        </td>
                                        <td>
                                            <span><a href=""><i class="ti-eye color-default"></i></a> </span>
                                            <span><a href=""><i class="ti-pencil-alt color-success"></i></a></span>
                                            <span><a href=""><i class="ti-trash color-danger"></i> </a></span>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td><label><input type="checkbox" value=""></label>Girls-320</td>
                                        <td>
                                            204
                                        </td>
                                        <td>Big</td>
                                        <td>
                                            03
                                        </td>
                                        <td>
                                            $50.00
                                        </td>
                                        <td>
                                            <span><a href=""><i class="ti-eye color-default"></i></a> </span>
                                            <span><a href=""><i class="ti-pencil-alt color-success"></i></a></span>
                                            <span><a href=""><i class="ti-trash color-danger"></i> </a></span>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td><label><input type="checkbox" value=""></label>Boys-110</td>
                                        <td>
                                            204
                                        </td>
                                        <td>Big</td>
                                        <td>
                                            03
                                        </td>
                                        <td>
                                            $50.00
                                        </td>
                                        <td>
                                            <span><a href=""><i class="ti-eye color-default"></i></a> </span>
                                            <span><a href=""><i class="ti-pencil-alt color-success"></i></a></span>
                                            <span><a href=""><i class="ti-trash color-danger"></i> </a></span>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td><label><input type="checkbox" value=""></label>Girls-110</td>
                                        <td>
                                            204
                                        </td>
                                        <td>mediam</td>
                                        <td>
                                            03
                                        </td>
                                        <td>
                                            $50.00
                                        </td>
                                        <td>
                                            <span><a href=""><i class="ti-eye color-default"></i></a> </span>
                                            <span><a href=""><i class="ti-pencil-alt color-success"></i></a></span>
                                            <span><a href=""><i class="ti-trash color-danger"></i> </a></span>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td><label><input type="checkbox" value=""></label>Boys-110</td>
                                        <td>
                                            204
                                        </td>
                                        <td>small</td>
                                        <td>
                                            03
                                        </td>
                                        <td>
                                            $50.00
                                        </td>
                                        <td>
                                            <span><a href=""><i class="ti-eye color-default"></i></a> </span>
                                            <span><a href=""><i class="ti-pencil-alt color-success"></i></a></span>
                                            <span><a href=""><i class="ti-trash color-danger"></i> </a></span>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td><label><input type="checkbox" value=""></label>Girls-110</td>
                                        <td>
                                            204
                                        </td>
                                        <td>Big</td>
                                        <td>
                                            03
                                        </td>
                                        <td>
                                            $50.00
                                        </td>
                                        <td>
                                            <span><a href=""><i class="ti-eye color-default"></i></a> </span>
                                            <span><a href=""><i class="ti-pencil-alt color-success"></i></a></span>
                                            <span><a href=""><i class="ti-trash color-danger"></i> </a></span>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td><label><input type="checkbox" value=""></label>Boys-110</td>
                                        <td>
                                            204
                                        </td>
                                        <td>Mediam</td>
                                        <td>
                                            03
                                        </td>
                                        <td>
                                            $50.00
                                        </td>
                                        <td>
                                            <span><a href=""><i class="ti-eye color-default"></i></a> </span>
                                            <span><a href=""><i class="ti-pencil-alt color-success"></i></a></span>
                                            <span><a href=""><i class="ti-trash color-danger"></i> </a></span>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td><label><input type="checkbox" value=""></label>Grils-110</td>
                                        <td>
                                            204
                                        </td>
                                        <td>Big</td>
                                        <td>
                                            03
                                        </td>
                                        <td>
                                            $50.00
                                        </td>
                                        <td>
                                            <span><a href=""><i class="ti-eye color-default"></i></a> </span>
                                            <span><a href=""><i class="ti-pencil-alt color-success"></i></a></span>
                                            <span><a href=""><i class="ti-trash color-danger"></i> </a></span>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td><label><input type="checkbox" value=""></label>Boys-110</td>
                                        <td>
                                            204
                                        </td>
                                        <td>small</td>
                                        <td>
                                            03
                                        </td>
                                        <td>
                                            $50.00
                                        </td>
                                        <td>
                                            <span><a href=""><i class="ti-eye color-default"></i></a> </span>
                                            <span><a href=""><i class="ti-pencil-alt color-success"></i></a></span>
                                            <span><a href=""><i class="ti-trash color-danger"></i> </a></span>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
            <!-- /# column -->
        </div>
        <!-- /# row -->
        <div class="row">
            <div class="col-lg-12">
                <div class="footer">
                    <p>This dashboard was generated on <span id="date-time"></span> <a href="#" class="page-refresh">Refresh Dashboard</a></p>
                </div>
            </div>
        </div>
    </section>
</div>
@endsection