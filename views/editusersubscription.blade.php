@extends('layouts.master')

@section('title', 'Edit Subscription Plan')

@section('content')


 <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0">Edit Subscription Plan</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="{{ url('dashboard') }}">Home</a></li>
              <li class="breadcrumb-item"><a href="#">Subscription</a></li>
              <li class="breadcrumb-item active">Edit Subscription Plan</li>
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
                <h3 class="card-title">Edit User Subscription</h3>
                
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

              <form action="{{ url('updateusersubscription') }}" method="post" enctype="multipart/form-data">
                  @csrf
                <div class="card-body">
                  <div class="form-group">
                    <label for="exampleInputEmail1">Name</label>
                    <input type="text" name="name" value="{{$details->name}}" class="form-control" readonly>
                    
                  </div>
                 
                  <div class="form-group">
                    <label for="exampleInputFile">Plan</label>
                    <input type="text" name="plan" value="{{$details->plan}}" class="form-control" readonly>
                    <input type="hidden" name="id" value="{{$details->id}}" class="form-control">
                    </div>
                    
                   
                    <div class="form-group">
                    <label for="exampleInputFile">Amount</label>
                    <input type="text" name="amount" value="{{$details->price}}" class="form-control" required>
                   </div>
                   
                   <div class="form-group">
                    <label for="exampleInputFile">Currency</label>
                    <input type="text" name="currency" value="{{$details->currency}}" class="form-control" required>
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