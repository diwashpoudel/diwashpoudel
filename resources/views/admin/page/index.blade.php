 @extends('layouts.admin')
@section('title', 'Mero_Dokan')
@section( 'main-content')
<div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0">Dashboard</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item">
                <a href="{{ route(auth()->user()->role) }}">Home</a></li>
               <li class="breadcrumb-item active">Page List</li>
            </ol>
          </div><!-- /.col -->
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
  <section class="content">
      <div class="container-fluid">
        <!-- Info boxes -->
    

        <!-- Main row -->
        <div class="row">
          <!-- Left col -->
          <div class="col-md-12">
            <!-- MAP & BOX PANE -->
            <div class="card">
              <div class="card-header">
                <h3 class="card-title">List Page</h3>
                 
                 
              </div>
              <!-- /.card-header -->
              <div class="card-body p-0">
                <div class="d-md-flex">
                  <div class="p-3 flex-fill" style="overflow: hidden">
                  
                   <table class="table table-sm table-hover table-bordered">
                      <thead class="table-dark">
                        <th>Title</th>
                        <th>Summary</th>
                        <th>Image</th>
                         <th>Action</th>
                      </thead>

                      <tbody>
                        @if($data)
                          @foreach ($data as $key=>$value)
                          <tr>
                            <td>
                              {{ $value->title }}
                            </td>
                          <td>
                                  {{ $value->summary }}   
                          </td>  
                            <td>
                              <a href="{{ asset('uploads/page'.$value->image) }}" data-lightbox="page-{{ $value->id }}" data-title="{{ $value->title }}">View Images</a>
                            
                            </td>  
                             <td>
                                    <a href="{{route('page.edit',$value->id)}}" class="btn btn-sm btn-success">
                                      <i class="fa fa-pen"></i>
                                    </a>

                                      
                                   
                            </td>
                          </tr>

                              
                          @endforeach
                        @endif
                      </tbody>


                   </table>
 
                </div><!-- /.d-md-flex -->
              </div>
              <!-- /.card-body -->
            </div>
            
          </div>
          </div>
          <!-- /.col -->

            
        </div>
        <!-- /.row -->
      </div><!--/. container-fluid -->
    </section>
 
    @endsection

 
         