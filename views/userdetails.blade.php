@extends('layouts.master')

@section('title', 'User Details')

@section('content')
<style>
    table {
   
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
            <h1 class="m-0">User Details</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">User Details</li>
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
                <h3 class="card-title">User Details</h3>
                <!--<a href="#" style="float:right">Add Users</a>-->
              </div>
              <!-- /.card-header -->
              <div class="card-body">
                <table class="table table-bordered">
                  <thead>
                    <tr>
                      <th style="width: 10px">#</th>
                      <th>Name</th>
                      <th>Email</th>
                      <th>Phone</th>
                      <th>Profile Image</th>
                      <th style="width: 40px">Action</th>
                    </tr>
                  </thead>
                  <tbody>
                     <?php $x = 1; ?> 
                     @foreach($users as $val) 
                     
                     <?php  
                     if(!empty($val->profile_picture)){
                     $image = url('images').'/'.$val->profile_picture;
                     }else{
                     $image = "";
                     }  
                     ?>
                    <tr>
                      <td>{{$x++}}</td>
                      <td>{{$val->name}}</td>
                      <td>{{$val->email}}</td>
                      <td>{{$val->phone_number}}</td>
                      <?php if(!empty($image)){ ?>
                      <td><img src="{{$image}}" height="100" width="100"></td>
                      <?php }else{ ?>
                      <td>No Image Found</td>
                      <?php } ?>
                      <td><form action="#" method="POST">
                       <a class="btn btn-info btn-sm" href="{{ url('userdetailsbyid',$val->id)}}">Details</a>
                       <a class="btn btn-danger btn-sm" href="{{ url('uservideosbyid',$val->id)}}">Videos</a>
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
            </div>
            <!-- /.card -->

            
            <!-- /.card -->
          </div>
          <!-- /.col -->
         
          <!-- /.col -->
        </div>
         {!! $users->links() !!} 
        <!-- /.row -->
        
        <!-- /.row -->
      
        <!-- /.row -->
        
        <!-- /.row -->
        
        <!-- /.row -->
      </div><!-- /.container-fluid -->
    </section>
    @endsection