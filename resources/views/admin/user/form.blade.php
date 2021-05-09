@extends('layouts.admin')
@section('title', 'Mero_Dokan')
@section( 'main-content')
<div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0">User Listing</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item">
                <a href="{{ route(auth()->user()->role) }}">Home</a></li>
              <li class="breadcrumb-item active">
                <a href="{{ route('user.index') }}">User Listing</a></li>
                <li class="breadcrumb-item active">
                   User Listing</li>
                
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
                <h3 class="card-title">User Form</h3>

                 
              </div>
              <!-- /.card-header -->
              <div class="card-body p-0">
                <div class="d-md-flex">
                  <div class="p-3 flex-fill" style="overflow: hidden">
                    @if(isset($detail))
                    {{Form::open(['url'=>route('user.update',$detail->id) , 'class'=>'form ','files'=>true ])}}
                    @method('patch')
                    @else
                    {{Form::open(['url'=>route('user.store') , 'class'=>'form ','files'=>true ])}}
                    @endif
                    <div class="form-group row">

                       {{  Form::label('name', 'Full Name:',['class'=>'col-sm-3']) }}
                       <div class="col-sm-9">
                         {{ Form::text('name',@$detail->name,['class'=>'form-control form-control-sm','required'=>'true','placeholder'=>'Enter Your Full Name Here' ,'id'=>'name']) }}
                        @error('name')
                        <span class="text-danger">{{ $message }}</span>
                          
                        @enderror
                        </div>
                    </div>
               @if(!isset($detail))
                    <div class="form-group row">

                      {{  Form::label('email', 'Email(Username):',['class'=>'col-sm-3']) }}
                      <div class="col-sm-9">
                        {{ Form::email('email',@$detail->email,['class'=>'form-control form-control-sm','required'=>'true','placeholder'=>'Enter Your User Email Here' ,'id'=>'email']) }}
                       @error('email')
                       <span class="text-danger">{{ $message }}</span>
                         
                       @enderror
                       </div>
                   </div>

                   <div class="form-group row">

                    {{  Form::label('password', 'Password:',['class'=>'col-sm-3']) }}
                    <div class="col-sm-9">
                      {{ Form::password('password',['class'=>'form-control form-control-sm','required'=>'true','placeholder'=>'Enter Your Password Here' ,'id'=>'password']) }}
                     @error('password')
                     <span class="text-danger">{{ $message }}</span>
                       
                     @enderror
                     </div>
                 </div>

                 <div class="form-group row">

                  {{  Form::label('password_confirmation', 'Re-Password:',['class'=>'col-sm-3']) }}
                  <div class="col-sm-9">
                    {{ Form::password('password_confirmation',['class'=>'form-control form-control-sm','required'=>'true','placeholder'=>'Enter Your Re Password Here' ,'id'=>'password_confirmation']) }}
                   
                   </div>
               </div>

             @endif

                 <div class="form-group row">

                  {{  Form::label('role', 'Role:',['class'=>'col-sm-3']) }}
                  <div class="col-sm-9">
                    {{ Form::select('role',['customer'=>'Buyer','seller'=>'Seller'],@$detail->role,['class'=>'form-control form-control-sm','required'=>'true'  ,'id'=>'role']) }}
                   @error('role')
                   <span class="text-danger">{{ $message }}</span>
                     
                   @enderror
                   </div>
               </div>

               <div class="form-group row">

                {{  Form::label('phone', 'Phone Number:',['class'=>'col-sm-3']) }}
                <div class="col-sm-9">
                  {{ Form::tel('phone',@$detail->phone,['class'=>'form-control form-control-sm','required'=>'true','placeholder'=>'Enter Your  Phone Number Here' ,'id'=>'phone']) }}
                 @error('phone')
                 <span class="text-danger">{{ $message }}</span>
                   
                 @enderror
                 </div>
             </div>

             <div class="form-group row">

              {{  Form::label('shipping_address', 'Shipping Address:',['class'=>'col-sm-3']) }}
              <div class="col-sm-9">
                {{ Form::textarea('shipping_address',@$detail->shipping_address,['class'=>'form-control form-control-sm','required'=>'true','placeholder'=>'Enter Your Shipping Address Here','rows'=>5,'style'=>'resize:none' ,'id'=>'shipping_address']) }}
               @error('shipping_address1')
               <span class="text-danger">{{ $message }}</span>
                 
               @enderror
               </div>
           </div>


           <div class="form-group row">

            {{  Form::label('billing_address', 'Billing Address:',['class'=>'col-sm-3']) }}
            <div class="col-sm-9">
              {{ Form::textarea('billing_address',@$detail->billing_address,['class'=>'form-control form-control-sm','required'=>'true','placeholder'=>'Enter Your Billing Address Here','rows'=>5,'style'=>'resize:none' ,'id'=>'shipping_address']) }}
             @error('billing_address1')
             <span class="text-danger">{{ $message }}</span>
               
             @enderror
             </div>
         </div>


                     <div class="form-group row">

                       {{  Form::label('status', 'Status:',['class'=>'col-sm-3']) }}
                       <div class="col-sm-9">
                         {{ Form::select('status',['active'=>'Active','inactive'=>'Suspend'],@$detail->status,['class'=>'form-control form-control-sm','required'=>'true'  ,'id'=>'status']) }}
                        @error('status')
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
                      @php $url = asset('uploads/user/'.$detail->image);@endphp
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