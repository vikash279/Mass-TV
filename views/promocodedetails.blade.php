@extends('layouts.master')

@section('title', 'Promo Code')

@section('content')


 <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0">Promo Code</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">Promo Code</li>
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
                <h3 class="card-title">Promo Code</h3>
                <a href="{{ url('addpromocode') }}" style="float:right">Add Promo Code</a>
              </div>
              <!-- /.card-header -->
              <div class="card-body">
                <table class="table table-bordered">
                  <thead>
                    <tr>
                      <th style="width: 10px">#</th>
                      <th>Name</th>
                      <th>Discount</th>
                      <th style="width: 40px">Action</th>
                    </tr>
                  </thead>
                  <tbody>
                     <?php $x = 1; ?> 
                     @foreach($details as $val) 
                   <?php  
                     if($val->status == "1"){
                     $status = "Acive";
                     }else{
                     $status = "Inactive";
                     }  
                     ?>
                     
                    <tr>
                      <td>{{$x++}}</td>
                      <td>{{$val->promo_code_name}}</td>
                      <td>{{$val->discount}}</td>
                      <td><form action="#" method="POST">
                       <a class="btn btn-info btn-sm" href="{{ url('editpromocode',$val->id)}}">Edit</a>
                       <a class="btn btn-danger btn-sm" href="{{ url('deletepromocode',$val->id)}}">Delete</a>
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
        <!-- /.row -->
        
        <!-- /.row -->
      
        <!-- /.row -->
        
        <!-- /.row -->
        
        <!-- /.row -->
      </div><!-- /.container-fluid -->
    </section>
    @endsection