@extends('layouts.master')

@section('title', 'Edit Admin Upload Video')

@section('content')


 <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0">Edit Admin Upload Video</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="{{ url('dashboard') }}">Home</a></li>
              <li class="breadcrumb-item"><a href="{{ url('category') }}">Admin Uploaded Video</a></li>
              <li class="breadcrumb-item active">Edit Admin Upload Video</li>
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
                <h3 class="card-title">Edit Admin Upload Video Form</h3>
                
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

              <form action="{{ url('updateadminuploadvideo') }}" method="post" enctype="multipart/form-data">
                  @csrf
                <div class="card-body">
                  <div class="form-group">
                    <label for="exampleInputEmail1">Title</label>
                    <input type="text" name="title" value="{{$videos->title}}" class="form-control">
                    <input type="hidden" name="id" value="{{$videos->id}}" class="form-control">
                  </div>
                 
                  <div class="form-group">
                    <label for="exampleInputFile">Category</label>
                    <!--<input type="text" name="category" value="{{$videos->category}}" class="form-control">-->
                     <select class="form-control" id="sel1" name="category">
                        <option selected disabled>Please select category</option>
                        <?php foreach($cat as $val){ ?>
                        <option value="{{$val->name}}"<?php  if($val->name== $videos->category){echo "selected";}?>>{{$val->name}}</option>
                        <?php } ?>
                      </select>
                    </div>
                    
                    <?php if(!empty($videos->thumb)){
                     $image = url('images').'/'.$videos->thumb;
                     }else{
                     $image = "";
                     }  
                     ?>
                    <div class="form-group">
                    <label for="exampleInputFile">Thumbnail</label>
                    <img src="{{$image}}" id="img1" class="img1" height="100px" width="100px">
                    <input type="text" name="thumb" value="{{$videos->thumb}}" class="form-control">
                    <input type="file" name="thumb1" class="form-control">
                    </div>
                    
                    <?php if(!empty($videos->source)){
                     $source = url('videos').'/'.$videos->source;
                     }else{
                     $source = "";
                     }  
                     ?>
                    <div class="form-group">
                    <label for="exampleInputFile">Source</label>
                    <input type="text" name="source" value="{{$videos->source}}" class="form-control">
                    <input type="file" name="source1" class="form-control">
                   </div>
                  
                   <div class="form-group">
                    <label for="exampleInputFile">Subtitle</label>
                    <input type="text" name="subtitle" value="{{$videos->subtitle}}" class="form-control">
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