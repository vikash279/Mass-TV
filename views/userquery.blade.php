@extends('layouts.master')

@section('title', 'User Query')

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
            <h1 class="m-0">User Query</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">User Query</li>
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
                <h3 class="card-title">User Query</h3>
                <!--<a href="#" style="float:right">Upload Video</a>-->
              </div>
              <!-- /.card-header -->
              <div class="card-body">
                <table class="table table-bordered" id="videotable">
                  <thead>
                    <tr>
                      <th style="width: 10px">#</th>
                      <th>User Name</th>
                      <th>Query</th>
                      <th>Response</th>
                      <th style="width: 40px">Action</th>
                    </tr>
                  </thead>
                  <tbody>
                     <?php $x = 1; ?> 
                     @foreach($query as $val) 
                     
                    <tr>
                      <td>{{$x++}}</td>
                      <td>{{$val->user_id}}</td>
                      <td>{{$val->query}}</td>
                      <td>{{$val->response}}</td>
                      <td><form action="#" method="POST">
                        <?php  if(empty($val->response)){ ?>
                       <a class="btn btn-info btn-sm" href="{{ url('replyuserquery',$val->id)}}">Reply</a>
                       <?php }else{ ?>
                       
                       <?php } ?>
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
{!! $query->links() !!}
        <!-- /.row -->
        
        <!-- /.row -->
      
        <!-- /.row -->
        
        <!-- /.row -->
        
        <!-- /.row -->
      </div><!-- /.container-fluid -->
     </div> 
    </section>
    @endsection