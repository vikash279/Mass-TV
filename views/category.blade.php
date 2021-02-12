@extends('layouts.master')

@section('title', 'Category ')

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
            <h1 class="m-0">Category</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">Category</li>
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
                <h3 class="card-title">Master Category Data</h3>
                <a href="{{ url('addcategory') }}" style="float:right">Add Category</a>
              </div>
              <!-- /.card-header -->
              <div class="card-body">
                <table class="table table-bordered" id="cat">
                  <thead>
                    <tr>
                      <th style="width: 10px">#</th>
                      <th>Name</th>
                      <th>Banner</th>
                      <th>Status</th>
                      <th style="width: 40px">Action</th>
                    </tr>
                  </thead>
                  <tbody>
                     <?php $x = 1; ?> 
                     @foreach($category as $val) 
                   <?php  
                     if($val->status == "1"){
                     $status = "Acive";
                     }else{
                     $status = "Inactive";
                     }  
                     ?>
                     
                     <?php  
                     if(!empty($val->banner_image)){
                     $image = url('images').'/'.$val->banner_image;
                     }else{
                     $image = "";
                     }  
                     ?>
                    <tr>
                      <td>{{$x++}}</td>
                      <td>{{$val->name}}</td>
                      <?php if(!empty($image)){ ?>
                      <td><img src="{{$image}}" height="100" width="100"></td>
                      <?php }else{ ?>
                      <td>No Banner Found</td>
                      <?php } ?>
                      <td>{{$status}}</td>
                      <td><form action="#" method="POST">
                       <a class="btn btn-info btn-sm" href="{{ url('editcat',$val->id)}}">Edit</a>
                       <a class="btn btn-primary btn-sm" href="{{ url('activecat',$val->id)}}">Activate</a>
                       <a class="btn btn-danger btn-sm" href="{{ url('deactivecat',$val->id)}}">Deactivate</a>
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
              <!--<div class="card-footer clearfix">-->
              <!--  <ul class="pagination pagination-sm m-0 float-right">-->
              <!--    <li class="page-item"><a class="page-link" href="#">&laquo;</a></li>-->
              <!--    <li class="page-item"><a class="page-link" href="#">1</a></li>-->
              <!--    <li class="page-item"><a class="page-link" href="#">2</a></li>-->
              <!--    <li class="page-item"><a class="page-link" href="#">3</a></li>-->
              <!--    <li class="page-item"><a class="page-link" href="#">&raquo;</a></li>-->
              <!--  </ul>-->
              <!--</div>-->
            </div>
            <!-- /.card -->

            
            <!-- /.card -->
          </div>
          <!-- /.col -->
         
          <!-- /.col -->
        </div>
       {!! $category->links() !!}
        <!-- /.row -->
        
        <!-- /.row -->
      
        <!-- /.row -->
        
        <!-- /.row -->
        
        <!-- /.row -->
      </div>
      <!-- /.container-fluid -->
    
    </section>
    @endsection