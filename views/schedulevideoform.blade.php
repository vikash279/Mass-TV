@extends('layouts.master')

@section('title', 'Schedule Video Form')

@section('content')


 <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0">Schedule Video Form</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="{{ url('dashboard') }}">Home</a></li>
              <li class="breadcrumb-item"><a href="{{ url('schedulevideo') }}">Schedule Video</a></li>
              <li class="breadcrumb-item active">Schedule Video Form</li>
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
                <h3 class="card-title">Schedule Video Form</h3>
                
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

              <form action="{{ url('scheduleuploadedvideo') }}" method="post" enctype="multipart/form-data">
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
                    
                    <?php 
                     $source = url('videos').'/'.$videos->source;
                     
                     ?>
                    <div class="form-group">
                    <label for="exampleInputFile">Source</label>
                    <input type="text" name="source" value="{{$videos->source}}" class="form-control" readonly>
                   </div>
                  
                   <div class="form-group">
                    <label for="exampleInputFile">Subtitle</label>
                    <input type="text" name="subtitle" value="{{$videos->subtitle}}" class="form-control">
                  </div>
                  
                  <div class="form-group">
                    <label for="exampleInputFile">Schedule Time</label>
                    <input type="text" name="schedule_time" placeholder="22:00:00"  class="form-control" />
                  </div>
                  
                  <div class="form-group">
                    <label for="exampleInputFile">Video Duration</label>
                    <input type="text" name="duration" placeholder="01:00:10" class="form-control" />
                  </div>
                  
                  <div class="form-group">
                    <label for="exampleInputFile">Schedule Date</label>
                    <input type="date" id="schedule_date" name="schedule_date" class="form-control">
                  </div>
                  
                  </div>
                 
                </div>
                <!-- /.card-body -->

                <div class="card-footer">
                  <button type="submit" name="btnSubmit" value="livelivebutton" class="btn btn-primary">Live Video</button>
                  <button type="submit" name="btnSubmit" value="ondemandbutton" class="btn btn-primary">On Demand Video</button>
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
      <script>
          var timepicker = new TimePicker('time', {
              lang: 'en',
              theme: 'dark'
            });
            
            var input = document.getElementById('time');
            
            timepicker.on('change', function(evt) {
              
              var value = (evt.hour || '00') + ':' + (evt.minute || '00');
              evt.element.value = value;
            
            });
            
            
            var timepicker = new TimePicker('time1', {
              lang: 'en',
              theme: 'dark'
            });
            
            var input = document.getElementById('time1');
            
            timepicker.on('change', function(evt) {
              
              var value = (evt.hour || '00') + ':' + (evt.minute || '00');
              evt.element.value = value;
            
            });
      </script>
    </section>
    @endsection