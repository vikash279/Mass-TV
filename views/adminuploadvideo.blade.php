@extends('layouts.master')

@section('title', 'Admin Upload Video')

@section('content')


 <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0">Admin Upload Video</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="{{ url('dashboard') }}">Home</a></li>
              <li class="breadcrumb-item"><a href="{{ url('category') }}">Admin Uploaded Video</a></li>
              <li class="breadcrumb-item active">Upload Video</li>
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
                <h3 class="card-title">Admin Upload Video Form</h3>
                
              </div>

              <form action="{{ url('uploadvideo') }}" method="post" enctype="multipart/form-data">
                  @csrf
                <div class="card-body">
                  <div class="form-group">
                    <label for="exampleInputEmail1">Title</label>
                    <input type="text" name="title" class="form-control">
                  </div>
                 
                  <div class="form-group">
                    <label for="exampleInputFile">Category</label>
                    <!--<input type="text" name="category" class="form-control">-->
                    <select class="form-control" id="sel1" name="category">
                        <option selected disabled>Please select category</option>
                        <?php foreach($cat as $val){ ?>
                        <option value="{{$val->name}}">{{$val->name}}</option>
                        <?php } ?>
                      </select>
                    </div>
                    
                    <div class="form-group">
                    <label for="exampleInputFile">Thumbnail</label>
                    <input type="file" name="thumb" class="form-control">
                    </div>
                    <div class="form-group">
                    <label for="exampleInputFile">Source</label>
                    <input type="file" name="source" class="form-control">
                   </div>
                  
                   <div class="form-group">
                    <label for="exampleInputFile">Subtitle</label>
                    <input type="text" name="subtitle" class="form-control">
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