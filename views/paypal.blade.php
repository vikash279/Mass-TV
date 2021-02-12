@extends('layouts.master')

@section('title', 'Category ')

@section('content')


 <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0">Paypal</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="{{ url('dashboard') }}">Home</a></li>
              <li class="breadcrumb-item"><a href="{{ url('category') }}">Purchased Video</a></li>
              <li class="breadcrumb-item active">Payment For Video</li>
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
               <!--  <h3 class="card-title">Add Master Category Data</h3> -->
                
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
             
                <div class="flex-center position-ref full-height">
  
            <div class="content">
               <!--  <h1>Mass TV </h1> -->
                  
                <table border="0" cellpadding="10" cellspacing="0" align="center"><tr><td align="center"></td></tr><tr><td align="center"><a href="https://www.paypal.com/in/webapps/mpp/paypal-popup" title="How PayPal Works" onclick="javascript:window.open('https://www.paypal.com/in/webapps/mpp/paypal-popup','WIPaypal','toolbar=no, location=no, directories=no, status=no, menubar=no, scrollbars=yes, resizable=yes, width=1060, height=700'); return false;"><img src="https://www.paypalobjects.com/webstatic/mktg/Logo/pp-logo-200px.png" border="0" alt="PayPal Logo"></a></td></tr></table>
                <br><br>

       <form action="{{ url('payment') }}" method="post" enctype="multipart/form-data">
                  @csrf
                <div class="card-body">
                 <div class="form-group">
                    <label for="exampleInputEmail1">User Name</label>
                    <input type="text" name="username" value="{{$userdetails->name}}"  readonly>
                    <input type="hidden" name="user_id" value="{{$userdetails->user_id}}">
                  </div>
                   <div class="form-group">
                    <label for="exampleInputEmail1">Paypal ID</label>
                    <input type="text" name="amount" value="{{$userdetails->paypal_id}}" readonly>
                 </div>
                  <div class="form-group">
                    <label for="exampleInputEmail1">Amount</label>
                    <input type="text" name="amount" placeholder="Enter Amount" required>
                 </div>
                
                  </div>
                 
               
                <!-- /.card-body -->

                <div class="card-footer">
                  <button type="submit" class="btn btn-primary">Pay</button>
                </div>
              </form>     
               
  
            </div>

            </div>
            <!-- /.card -->
            </div>
            
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