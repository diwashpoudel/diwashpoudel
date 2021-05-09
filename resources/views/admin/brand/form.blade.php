@extends('layouts.admin')
@section('title', 'Mero_Dokan')
@section( 'main-content')
<div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0">Brand Listing</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item">
                <a href="{{ route(auth()->user()->role) }}">Home</a></li>
              <li class="breadcrumb-item active">
                <a href="{{ route('brand.index') }}">Brand Listing</a></li>
                <li class="breadcrumb-item active">
                   Brand Listing</li>
                
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
                <h3 class="card-title">Brand Form</h3>

                 
              </div>
              <!-- /.card-header -->
              <div class="card-body p-0">
                <div class="d-md-flex">
                  <div class="p-3 flex-fill" style="overflow: hidden">
                    @if(isset($detail))
                    {{Form::open(['url'=>route('brand.update',$detail->id) , 'class'=>'form ','files'=>true ])}}
                    @method('patch')
                    @else
                    {{Form::open(['url'=>route('brand.store') , 'class'=>'form ','files'=>true ])}}
                    @endif
                    <div class="form-group row">

                       {{  Form::label('title', 'Title:',['class'=>'col-sm-3']) }}
                       <div class="col-sm-9">
                         {{ Form::text('title',@$detail->title,['class'=>'form-control form-control-sm','required'=>'true','placeholder'=>'Enter Your Brand Title Here' ,'id'=>'title']) }}
                        @error('title')
                        <span class="text-danger">{{ $message }}</span>
                          
                        @enderror
                        </div>
                    </div>

                    
                      


           <div class="form-group row ">
              {{ form::label('image','Image:',['class'=>'col-sm-3']) }}
              <div class="col-sm-3">

                  {{ form::file('image' ,['required'=>false, 'id'=>'image','accept'=>'image/*', 'onchange'=>'readURL(this ,"thumb")']) }}
                  @error('image')
                    <span class="text-danger">{{ $message }}</span>
                  @enderror
                    
               
              </div>
                  <div class="col-sm-2">
                    @if(isset($detail) && $detail->image !== null)
                      @php $url = asset('uploads/brand/'.$detail->image);@endphp
                      @else
                      @php  $url =  asset('image/noimage.png');@endphp
                    @endif
                         
                  
                     <img src="{{ $url }}" class="img img-thumbnail " id="thumb">  
                    </div>
                </div>
      </div>
                </div>


      <div class="form-group row">

                        
                       <div class="offset-4 col-sm-9">
                     {{ Form::button('<i class="fas fa-times"></i> Cancel',['class'=>'btn btn-sm btn-danger','data-dismiss'=>'modal','type'=>'reset']) }}
                     {{ Form::button('<i class="fas fa-paper-plane"></i> Save' ,['class'=>'btn btn-sm btn-success','type'=>'submit']) }}
                        </div>
                    </div>

                      {{Form::close()}}
 
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