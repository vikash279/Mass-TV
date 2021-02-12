@extends('layouts.master')

@section('title', 'Users Uploaded Video')

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
            <h1 class="m-0">User's Uploaded Video</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">User's Uploaded Video</li>
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
                <h3 class="card-title">User's Uploaded Video</h3>
                <!--<a href="#" style="float:right">Upload Video</a>-->
              </div>
              <!-- /.card-header -->
              <div class="card-body">
                <table class="table table-bordered" id="videotable">
                  <thead>
                    <tr>
                      <th style="width: 10px">#</th>
                      <th>User Name</th>
                      <th>Title</th>
                      <th>Category</th>
                      <th>Thumbnail</th>
                      <th>Source</th>
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
                    <tr>
                      <td>{{$x++}}</td>
                      <td>{{$val->name}}</td>
                      <td>{{$val->title}}</td>
                      <td>{{$val->category}}</td>
                      <?php if(!empty($thumb)){ ?>
                      <td><img src="{{$thumb}}" height="100" width="100"></td>
                      <?php }else{ ?>
                      <td>No Thumbnail Found</td>
                      <?php } ?>
                      <td><a href="{{url('videos').'/'.$val->source}}" target="_blank">{{$val->source}}</a></td>
                      <td><form action="#" method="POST">
                       <a class="btn btn-info btn-sm" href="{{ url('edituseruploadvideo',$val->id)}}">Edit</a>
                       <?php if($val->admin_approved != 1){ ?>
                       <a class="btn btn-primary btn-sm" href="{{ url('approvevideo',$val->id)}}">Approve</a>
                       <?php } ?>
                       <a class="btn btn-danger btn-sm" href="{{ url('deletevideo',$val->id)}}">Delete</a>
                       @csrf
                      <!--<button type="submit" class="btn btn-danger btn-sm">Deactivate</button>-->
                      </form></td>
                      <!--<td><a href="{{ url('activecat')}}"><i class="fa fa-thumbs-up" aria-hidden="true"></i></a>|-->
                      <!--<a href="#"><i class="fa fa-thumbs-down" aria-hidden="true"></i></a>|-->
                      <!--<a href="#"><i class="fa fa-upload" aria-hidden="true"></i></a></td>-->
                    </tr>
                     @endforeach
                  </tbody>
                  
                </table>
               
              </div>
              <!-- /.card-body -->
            <!--  <div class="card-footer clearfix">-->
            <!--    <ul class="pagination pagination-sm m-0 float-right">-->
            <!--      <li class="page-item"><a class="page-link" href="#">&laquo;</a></li>-->
            <!--      <li class="page-item"><a class="page-link" href="#">1</a></li>-->
            <!--      <li class="page-item"><a class="page-link" href="#">2</a></li>-->
            <!--      <li class="page-item"><a class="page-link" href="#">3</a></li>-->
            <!--      <li class="page-item"><a class="page-link" href="#">&raquo;</a></li>-->
            <!--    </ul>-->
            <!--  </div>-->
            <!--</div>-->
            <!-- /.card -->

            
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