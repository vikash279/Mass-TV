@extends('layouts.master')

@section('title', 'Live Videos')

@section('content')

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
                <table class="table table-bordered" id="videotable">
                  <thead>
                    <tr>
                      <th style="width: 10px">#</th>
                      <th>Title</th>
                      <th>Category</th>
                      <th>Thumbnail</th>
                      <th>Source</th>
                      <th>Start Time</th>
                      <th>End Time</th>
                      <th>Schedule Date</th>
                      <th style="width: 40px">Action</th>
                    </tr>
                  </thead>
                  <tbody>
                     <?php $x = 1; ?> 
                     @foreach($videos as $val) 
                     
                     <?php  
                     if(!empty($val->thumb)){
                     $thumb = url('images').'/'.$val->thumb;
                     }else{
                     $thumb = "";
                     }  
                     ?>
                     <?php
                      date_default_timezone_set("Asia/Kolkata");
                      $time = date('H:i:s');
                     ?>
                    <tr>
                      <td>{{$x++}}</td>
                      <?php if($val->schedule_time <= $time and $val->duration >= $time) { ?>
                      <td><i class="fa fa-play-circle" aria-hidden="true"></i>{{$val->title}}</td>
                      <?php }else{ ?>
                      <td>{{$val->title}}</td>
                      <?php } ?>
                      <td>{{$val->category}}</td>
                      <?php if(!empty($thumb)){ ?>
                      <td><img src="{{$thumb}}" height="100" width="100"></td>
                      <?php }else{ ?>
                      <td>No Thumbnail Found</td>
                      <?php } ?>
                      <td><a href="{{url('videos').'/'.$val->source}}" target="_blank">{{$val->source}}</a></td>
                      <td>{{$val->schedule_time}}</td>
                      <td>{{$val->duration}}</td>
                      <td>{{$val->schedule_date}}</td>
                      <td><form action="#" method="POST">
                       <a class="btn btn-info btn-sm" href="{{ url('editlivevideo',$val->id)}}">Edit</a>
                       <a class="btn btn-danger btn-sm" href="{{ url('makevideoads',$val->id)}}">Auto Fill</a>
                       @csrf
                      <!--<button type="submit" class="btn btn-danger btn-sm">Deactivate</button>-->
                      </form></td>
                    </tr>
                     @endforeach
                  </tbody>
                  
                </table>
               
              </div>
              <!-- /.card-body -->

            
            <!-- /.card -->
          </div>
           
          <!-- /.col -->
         
          <!-- /.col -->
        </div>
         {!! $videos->links() !!}
        <!-- /.row -->
        
        <!-- /.row -->
      
        <!-- /.row -->
        
        <!-- /.row -->
        
        <!-- /.row -->
      </div><!-- /.container-fluid -->
     
    </section>
    @endsection