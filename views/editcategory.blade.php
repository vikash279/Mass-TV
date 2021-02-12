@extends('layouts.master')

@section('title', 'Category ')

@section('content')


 <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0">Edit Category</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="{{ url('dashboard') }}">Home</a></li>
              <li class="breadcrumb-item"><a href="{{ url('category') }}">Category</a></li>
              <li class="breadcrumb-item active">Edit Category</li>
            </ol>
          </div><!-- /.col -->
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>

  <section class="content">
      <div class="container-fluid">
        <div class="row">
          <div class="col-md-12">
            <div class="card">
              <div class="card-header">
                <h3 class="card-title">Edit Master Category Data</h3>
                
              </div>

              <form action="{{ url('updatecategory') }}" method="post" enctype="multipart/form-data">
                  @csrf
                <div class="card-body">
                  <div class="form-group">
                    <label for="exampleInputEmail1">Banner Name</label>
                    <input type="text" name="name" class="form-control" value="{{$category->name}}">
                    <input type="hidden" name="id" class="form-control" value="{{$category->id}}">
                  </div>
                  <?php if(!empty($category->banner_image)){
                     $image = url('images').'/'.$category->banner_image;
                     }else{
                     $image = "";
                     }  
                     ?>
                  <div class="form-group">
                    <label for="exampleInputFile">Banner Image</label>
                    <img src="{{$image}}" id="img1" class="img1" height="100px" width="100px">
                    <input type="file" name="banner_image" class="form-control" value="{{$category->banner_image}}">
                        
                    </div>
                  </div>
                 
                </div>
                <!-- /.card-body -->

                <div class="card-footer">
                  <button type="submit" class="btn btn-primary">Submit</button>
                </div>
              </form>
            </div>
            <!-- /.card -->

            
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
    </section>
    @endsection