@extends('layouts.master')

@section('title', 'User Details')

@section('content')


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
              <li class="breadcrumb-item"><a href="{{ url('dashboard') }}">Home</a></li>
              <li class="breadcrumb-item active">User Details</li>
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
                <h3 class="card-title">User Details</h3>
                
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

              <form action="#" method="post" enctype="multipart/form-data">
                  @csrf
                <div class="card-body">
                  <div class="form-group">
                    <label for="exampleInputEmail1">Name</label>
                    <input type="text" name="subscription_type" value="{{$details->name}}" class="form-control" readonly>
                    
                  </div>
                 
                  <div class="form-group">
                    <label for="exampleInputFile">email</label>
                    <input type="text" name="subscription_date" value="{{$details->email}}" class="form-control" readonly>
                    <input type="hidden" name="id" value="{{$details->id}}" class="form-control">
                    </div>
                    
                   
                    <div class="form-group">
                    <label for="exampleInputFile">Phone</label>
                    <input type="text" name="subscription_amount" value="{{$details->phone_number}}" class="form-control" readonly>
                   </div>
                   
                     <?php  
                     if(!empty($details->profile_picture)){
                     $profilepic = url('images/profile_picture').'/'.$details->profile_picture;
                     }else{
                     $profilepic = "";
                     }  
                     ?>
                   <div class="form-group">
                    <label for="exampleInputFile">Profile Picture</label>
                    <img src="{{$profilepic}}" id="img1" class="img1" height="100px" width="100px">
                    <input type="text" name="subscription_amount" value="{{$details->profile_picture}}" class="form-control" readonly>
                   </div>
                   
                   <div class="form-group">
                    <label for="exampleInputFile">City</label>
                    <input type="text" name="subscription_amount" value="{{$details->city}}" class="form-control" readonly>
                   </div>
                   
                   <div class="form-group">
                    <label for="exampleInputFile">State</label>
                    <input type="text" name="subscription_amount" value="{{$details->state}}" class="form-control" readonly>
                   </div>
                   
                   <div class="form-group">
                    <label for="exampleInputFile">Country</label>
                    <input type="text" name="subscription_amount" value="{{$details->country}}" class="form-control" readonly>
                   </div>
                  
                  </div>
                 
                </div>
                <!-- /.card-body -->

                <!--<div class="card-footer">-->
                <!--  <button type="button" class="btn btn-primary">Back</button>-->
                <!--</div>-->
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