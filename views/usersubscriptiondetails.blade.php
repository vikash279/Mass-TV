@extends('layouts.master')

@section('title', 'Users Subscription Details')

@section('content')


 <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0">Users Subscription Details</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">Users Subscription Details</li>
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
                <h3 class="card-title">Users Subscription Details</h3>
                <!--<a href="#" style="float:right">Upload Video</a>-->
              </div>
              <!-- /.card-header -->
              <div class="card-body">
                <table class="table table-bordered" id="videotable">
                  <thead>
                    <tr>
                      <th style="width: 10px">#</th>
                      <th>User</th>
                      <th>Time</th>
                      <th>Date</th>
                      <th>Amount</th>
                      <th>Type</th>
                      <th>Action</th>
                    </tr>
                  </thead>
                  <tbody>
                     <?php $x = 1; ?> 
                     @foreach($details as $val) 
                     
                    <tr>
                      <td>{{$x++}}</td>
                      <td>{{$val->name}}</td>
                      <td>{{$val->subscription_time}}</td>
                      <td>{{$val->subscription_date}}</td>
                      <td>{{$val->subscription_amount}}</td>
                      <td>{{$val->subscription_type}}</td>
                      <td><form action="#" method="POST">
                       <a class="btn btn-info btn-sm" href="{{ url('userdetailsbyid',$val->user_id)}}">User Details</a>
                       @csrf
                      <!--<button type="submit" class="btn btn-danger btn-sm">Deactivate</button>-->
                      </form></td>
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
         {!! $details->links() !!}
        <!-- /.row -->
        
        <!-- /.row -->
      
        <!-- /.row -->
        
        <!-- /.row -->
        
        <!-- /.row -->
      </div><!-- /.container-fluid -->
      
    </section>
    @endsection