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
               <li class="breadcrumb-item active">Product List</li>
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
                <h3 class="card-title">List Product</h3>
                <a href="{{ route('product.create') }}" class="float-right btn btn-sm btn-success">
                  <i class="fas fa-plus"> Create Product</i>
                </a>
                 
              </div>
              <!-- /.card-header -->
              <div class="card-body p-0">
                <div class="d-md-flex">
                  <div class="p-3 flex-fill" style="overflow: hidden">
                  
                   <table class="table table-sm table-hover table-bordered">
                      <thead class="table-dark">
                        <th>Title</th>
                        <th>Category</th>
                        <td>Brand</td>
                        <th>Price</th>
                        <th>Featured</th>
                        <th>Status</th>
                        <th>Seller</th>
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
                              {{ $value->categoryInfo->title }}
                              @if($value->sub_category_id)
                                  <sub>
                                      {{ $value->subCategoryInfo->title }}
                                  </sub>
                              @endif
                         </td> 
                         <td>
                            {{ @$value->brandInfo->title }}
                        </td> 
                            <td>
                                  NPR.{{ number_format($value->actual_cost) }}            
                            </td>
                            <td>
                                {{ ($value->featured == 1) ? 'yes' : 'No' }}
                            </td>  
                            <td>
                              <span class="badge badge-{{ $value->status == 'active' ? 'success' :'danger'}}"> {{ ucfirst($value->status) }}</span>
                             
                            </td> 
                             <td>
                              {{ @$value->sellerInfo->name}}
                            </td>
                              <td>
                                    <a href="{{route('product.edit',$value->id)}}" class="btn btn-sm btn-success">
                                      <i class="fa fa-pen"></i>
                                    </a>

                                      <a href="javascript:;" class="btn btn-sm btn-danger delete_btn">
                                      <i class="fas fa-trash"></i>
                                    </a>
                                    {{ Form::open(['url'=>route('product.destroy' ,$value->id) , "class"=>"delete_form"]  )  }}
                                    @method('delete')
                                    {{ Form::close()}}
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

 
         