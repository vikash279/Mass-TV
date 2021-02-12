@extends('layouts.master')

@section('title', 'Live Videos')

@section('content')
<link rel="stylesheet" href="https://ajax.googleapis.com/ajax/libs/jqueryui/1.10.4/themes/smoothness/jquery-ui.css">
<style>
    table {
    border-collapse:collapse;
}
table tr td {
    border: 1px solid red;
    padding:2px 15px 2px 15px;
    width:50px;
}
#tabs ul li.drophover {
    color:green;
}
}
</style>
<style>
    table {
    display: block;
    overflow-x: auto;
    white-space: nowrap;
}
</style>
 <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0">Live Videos</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">Live Videos</li>
            </ol>
          </div><!-- /.col -->
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
                  	@if ($message = Session::get('success'))

                <div class="alert alert-success alert-block">
                
                    <button type="button" class="close" data-dismiss="alert">×</button>    
                
                    <strong>{{ $message }}</strong>
                
                </div>
                
                @endif
                
                  
                
                @if ($message = Session::get('error'))
                
                <div class="alert alert-danger alert-block">
                
                    <button type="button" class="close" data-dismiss="alert">×</button>    
                
                    <strong>{{ $message }}</strong>
                
                </div>
                
                @endif

  <section class="content">
      <div class="container-fluid">
        <div class="row">
          <div class="col-md-12">
            <div class="card">
              <div class="card-header">
                <h3 class="card-title">Live Videos</h3>
                <!--<a href="#" style="float:right">Upload Video</a>-->
              </div>
              <!-- /.card-header -->
              <div class="card-body">
                <div id="tabs">
    <!--<ul>-->
    <!--    <li><a href="#current"><span>Current</span></a>-->

    <!--    </li>-->
    <!--    <li><a href="#archive"><span>Archive</span></a>-->

    <!--    </li>-->
    <!--    <li><a href="#future"><span>Future</span></a>-->

    <!--    </li>-->
    <!--</ul>-->
    <div id="current">
        <div id="table1">
            <table class="table table-bordered">
                <!--<thead>-->
                <!--    <tr>-->
                <!--      <th style="width: 10px">#</th>-->
                <!--      <th>Title</th>-->
                <!--      <th>Category</th>-->
                <!--      <th>Thumbnail</th>-->
                <!--      <th>Source</th>-->
                <!--      <th>Schedule Time</th>-->
                <!--      <th>Schedule Date</th>-->
                      <!--<th style="width: 40px">Action</th>-->
                <!--    </tr>-->
                <!--  </thead>-->
                <tbody>
                    <tr>
                      <td style="width: 10px">#</td>
                      <td>Title</td>
                      <td>Category</td>
                      <td>Thumbnail</td>
                      <td>Source</td>
                      <td>Schedule Time</td>
                      <td>Schedule Date</td>
                      <!--<th style="width: 40px">Action</th>-->
                    </tr>
                   
                    <?php $x = 1; ?> 
                     @foreach($videos as $val) 
                     
                     <?php  
                     if(!empty($val->thumb)){
                     $thumb = url('images').'/'.$val->thumb;
                     }else{
                     $thumb = "";
                     }  
                     ?>
                    <tr>
                      <td>{{$x++}}</td>
                      <td>{{$val->title}}</td>
                      <td>{{$val->category}}</td>
                      <?php if(!empty($thumb)){ ?>
                      <td><img src="{{$thumb}}" height="100" width="100"></td>
                      <?php }else{ ?>
                      <td>No Thumbnail Found</td>
                      <?php } ?>
                      <td><a href="{{url('videos').'/'.$val->source}}" target="_blank">{{$val->source}}</a></td>
                      <td>{{$val->schedule_time}}</td>
                      <td>{{$val->schedule_date}}</td>
                      <!--<td><form action="#" method="POST">-->
                      <!-- <a class="btn btn-info btn-sm" href="{{ url('editadminuploadvideo',$val->id)}}">Edit</a>-->
                      <!-- @csrf-->
                      <!--<button type="submit" class="btn btn-danger btn-sm">Deactivate</button>-->
                      <!--</form></td>-->
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
    <!--<div id="archive">-->
    <!--    <div id="table2">-->
    <!--        <table>-->
    <!--            <tbody>-->
    <!--                <tr>-->
    <!--                    <td>COL0</td>-->
    <!--                    <td>COL1</td>-->
    <!--                    <td>COL2</td>-->
    <!--                </tr>-->
    <!--                <tr>-->
    <!--                    <td>a00</td>-->
    <!--                    <td>a01</td>-->
    <!--                    <td>a02</td>-->
    <!--                </tr>-->
    <!--                <tr>-->
    <!--                    <td>a10</td>-->
    <!--                    <td>a11</td>-->
    <!--                    <td>a12</td>-->
    <!--                </tr>-->
    <!--                <tr>-->
    <!--                    <td>a20</td>-->
    <!--                    <td>a21</td>-->
    <!--                    <td>a22</td>-->
    <!--                </tr>-->
    <!--            </tbody>-->
    <!--        </table>-->
    <!--    </div>-->
    <!--</div>-->
    <!--<div id="future">-->
    <!--    <div id="table3">-->
    <!--        <table>-->
    <!--            <tbody>-->
    <!--                <tr>-->
    <!--                    <td>COL0</td>-->
    <!--                    <td>COL1</td>-->
    <!--                    <td>COL2</td>-->
    <!--                </tr>-->
    <!--                <tr>-->
    <!--                    <td>f00</td>-->
    <!--                    <td>f01</td>-->
    <!--                    <td>f02</td>-->
    <!--                </tr>-->
    <!--                <tr>-->
    <!--                    <td>f10</td>-->
    <!--                    <td>f11</td>-->
    <!--                    <td>f12</td>-->
    <!--                </tr>-->
    <!--                <tr>-->
    <!--                    <td>f20</td>-->
    <!--                    <td>f21</td>-->
    <!--                    <td>f22</td>-->
    <!--                </tr>-->
    <!--            </tbody>-->
    <!--        </table>-->
    <!--    </div>-->
    <!--</div>-->
</div>
            
               
              </div>
              <!-- /.card-body -->

            
            <!-- /.card -->
          </div>
           
          <!-- /.col -->
         
          <!-- /.col -->
        </div>
      
        <!-- /.row -->
        
        <!-- /.row -->
      
        <!-- /.row -->
        
        <!-- /.row -->
        
        <!-- /.row -->
      </div><!-- /.container-fluid -->
      <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
      <script src="https://ajax.googleapis.com/ajax/libs/jqueryui/1.10.4/jquery-ui.min.js"></script>
    <script>
        $("#tabs").tabs();

        $("tbody").sortable({
            items: "> tr:not(:first)",
            appendTo: "parent",
            helper: "clone"
        }).disableSelection();
        
        $("#tabs ul li a").droppable({
            hoverClass: "drophover",
            tolerance: "pointer",
            drop: function(e, ui) {
                var tabdiv = $(this).attr("href");
                $(tabdiv + " table tr:last").after("<tr>" + ui.draggable.html() + "</tr>");
                ui.draggable.remove();
            }
        });

    </script>  
    </section>
    @endsection