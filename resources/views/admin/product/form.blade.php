@extends('layouts.admin')
@section('title', 'Mero_Dokan')
@section('scripts')
  <script>
    $('#category_id').change(function(){
      var cat_id = $(this).val();
      var sub_cat_id ={{ isset($detail) ? $detail->sub_category_id : 0}};
      var brand_id ={{ isset($detail) ? $detail->brand_id : 0}};



      $.ajax(
        {
          url:"{{ route('get-category') }}",
          type:"get",
          data:{
                //_token : "{{ csrf_token() }}",
                cat_id: cat_id
          },

        success: function(response){
          if(typeof(response)!= 'object'){
            response = JSON.parse(response);
          }

          // console.log(response);
          var sub_cats_drop = "<option value=''>--Select AnyOne--</option>";
             var brand_drop = "<option value=''>--Select AnyOne--</option>";
          if(response.error== false ){
           
              if(response.data.child_cats.length != 0)
              {
                $.each(response.data.child_cats , function(index,value)
                {
                  sub_cats_drop += "<option value = '"+index+"' "  ;
                  if(sub_cat_id != 0 && sub_cat_id == index)
                  {
                      sub_cats_drop += 'selected';
                  }
                  sub_cats_drop += ">"+value+"</option>";
                  
                })
              }

              if(response.data.brand.length != 0)
              {
                $.each(response.data.brand , function(index,value)
                {
                  brand_drop += "<option value = '"+value.brand_id+"'";
                  if(brand_id != 0 && brand_id == brand_info.brand_id)
                  {
                      brand_drop += 'selected';
                  }
                
                  brand_drop += " >"+value.brands.title+"</option>";
                })
              }
        
          }
          $('#sub_category_id').html(sub_cats_drop);
           $('#product_brand_id').html(brand_drop);

        },

        

        }
      );
    });

    @if(isset($detail))
      $('#category_id').change();
    @endif
  </script>
@endsection
@section( 'main-content')
<div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0">Product Listing</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item">
                <a href="{{ route(auth()->user()->role) }}">Home</a></li>
              <li class="breadcrumb-item active">
                <a href="{{ route('product.index') }}">Product Listing</a></li>
                <li class="breadcrumb-item active">
                   Product Listing</li>
                
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
                <h3 class="card-title">Product Form</h3>

                 
              </div>
              <!-- /.card-header -->
              <div class="card-body p-0">
                <div class="d-md-flex">
                  <div class="p-3 flex-fill" style="overflow: hidden">
                    @if(isset($detail))
                    {{Form::open(['url'=>route('product.update',$detail->id) , 'class'=>'form ','files'=>true ])}}
                    @method('patch')
                    @else
                    {{Form::open(['url'=>route('product.store') , 'class'=>'form ','files'=>true ])}}
                    @endif

                    <div class="form-group row">

                       {{  Form::label('title', 'Title:',['class'=>'col-sm-3']) }}
                       <div class="col-sm-9">
                         {{ Form::text('title',@$detail->title,['class'=>'form-control form-control-sm','required'=>'true','placeholder'=>'Enter Product Title Here' ,'id'=>'title']) }}
                        @error('title')
                        <span class="text-danger">{{ $message }}</span>
                          
                        @enderror
                        </div>
                    </div>

                     <div class="form-group row">

                       {{  Form::label('summary', 'Summry:',['class'=>'col-sm-3']) }}
                       <div class="col-sm-9">
                         {{ Form::textarea('summary', @$detail->summary,['class'=>'form-control form-control-sm','required'=>'true','placeholder'=>'Enter Your Product summary Here' ,'id'=>'summary','rows'=>5,'style'=>'resize:none']) }}
                        @error('summary')
                        <span class="text-danger">{{ $message }}</span>
                          
                        @enderror
                        </div>
                    </div>

                    
                    <div class="form-group row">

                      {{  Form::label('description', 'Description:',['class'=>'col-sm-3']) }}
                      <div class="col-sm-9">
                        {{ Form::textarea('description', @html_entity_decode($detail->description),['class'=>'form-control form-control-sm','required'=>'false','placeholder'=>'Enter Product description Here' ,'id'=>'description_id','rows'=>5,'style'=>'resize:none']) }}
                       @error('description')
                       <span class="text-danger">{{ $message }}</span>
                         
                       @enderror
                       </div>
                   </div>


                     <div class="form-group row">

                       {{  Form::label('category_id', 'Category:',['class'=>'col-sm-3']) }}
                       <div class="col-sm-9">
                         {{ Form::select('category_id', @$category_data,@$detail->category_id,['class'=>'form-control form-control-sm','required'=>'true' ,'placeholder'=>'--------Select Any Category ------' ,'id'=>'category_id']) }}
                        @error('category_id')
                        <span class="text-danger">{{ $message }}</span>
                          
                        @enderror
                        </div>
                    </div>


                    <div class="form-group row">

                      {{  Form::label('sub_category_id', 'Sub-Category:',['class'=>'col-sm-3']) }}
                      <div class="col-sm-9">
                        {{ Form::select('sub_category_id',[] ,@$detail->sub_category_id,['class'=>'form-control form-control-sm','required'=>'false' ,'placeholder'=>'--------Select Category ------' ,'id'=>'sub_category_id']) }}
                       @error('sub_category_id')
                       <span class="text-danger">{{ $message }}</span>
                         
                       @enderror
                       </div>
                   </div>

                   <div class="form-group row">

                    {{  Form::label('brand_id', 'Brand:',['class'=>'col-sm-3']) }}
                    <div class="col-sm-9">
                      {{ Form::select('brand_id',[] ,@$detail->brand_id,['class'=>'form-control form-control-sm','required'=>'false' ,'placeholder'=>'--------Select Brand ------'  ,'id'=>'product_brand_id']) }}
                     @error('brand_id')
                     <span class="text-danger">{{ $message }}</span>
                       
                     @enderror
                     </div>
                 </div>

                 <div class="form-group row">

                  {{  Form::label('price', 'Price(NPR):',['class'=>'col-sm-3']) }}
                  <div class="col-sm-9">
                    {{ Form::number('price',@$detail->price,['class'=>'form-control form-control-sm','required'=>'true','placeholder'=>'Enter Product price Here' ,'id'=>'price','min'=>1]) }}
                   @error('price')
                   <span class="text-danger">{{ $message }}</span>
                     
                   @enderror
                   </div>
               </div>


               <div class="form-group row">

                {{  Form::label('discount', 'Discount(%):',['class'=>'col-sm-3']) }}
                <div class="col-sm-9">
                  {{ Form::number('discount',@$detail->discount,['class'=>'form-control form-control-sm','required'=>'false','placeholder'=>'Enter Product discount Here' ,'id'=>'discount','min'=>1,'max'=>90]) }}
                 @error('discount')
                 <span class="text-danger">{{ $message }}</span>
                   
                 @enderror
                 </div>
             </div>

             <div class="form-group row">

              {{  Form::label('featured', 'featured:',['class'=>'col-sm-3']) }}
              <div class="col-sm-9">
                {{ Form::checkbox('featured','1',@$detail->featured,[ 'required'=>'false','id'=>'featured']) }}Yes
               @error('featured')
               <span class="text-danger">{{ $message }}</span>
                 
               @enderror
               </div>
           </div>


                    <div class="form-group row">
                      {{  Form::label('', 'Status:',['class'=>'col-sm-3']) }}
                      <div class="col-sm-9">
                        {{ Form::select('status',['active'=>'Published','inactive'=>'Unpublished'],@$detail->status,['class'=>'form-control form-control-sm','required'=>'true'  ,'id'=>'status']) }}
                       @error('status')
                       <span class="text-danger">{{ $message }}</span>
                         
                       @enderror
                       </div>
                   </div>

                  
                  
                   <div class="form-group row">
                    {{  Form::label('seller_id', 'Seller:',['class'=>'col-sm-3']) }}
                    <div class="col-sm-9">
                      {{ Form::select('seller_id',$seller,@$detail->seller_id,['class'=>'form-control form-control-sm','required'=>'false'  ,'id'=>'seller_id','placeholder'=>'----Select Seller----']) }}
                     @error('seller_id')
                     <span class="text-danger">{{ $message }}</span>
                       
                     @enderror
                     </div>
                 </div>



           <div class="form-group row ">
              {{ form::label('image','Image:',['class'=>'col-sm-3']) }}
              <div class="col-sm-3">

                  {{ form::file('image[]' ,['required'=>false, 'id'=>'product_image','accept'=>'image/*', 'onchange'=>'readURL(this ,"thumb")','multiple'=>'true']) }}
                  @error('image')
                    <span class="text-danger">{{ $message }}</span>
                  @enderror
                    
               
              </div>
                  <div class="col-sm-2">
                    @if(isset($detail) && $detail->image !== null)
                      @php $url = asset('uploads/product/'.$detail->image);@endphp
                      @else
                      @php  $url =  asset('image/noimage.png');@endphp
                    @endif
                         
                  
                     <img src="{{ $url }}" class="img img-thumbnail " id="thumb">  
                    </div>
                </div>
      </div>
  </div>
    @if(isset($detail) && !empty($detail->getImages))
        <div class="form-group row">
          @foreach ($detail->getImages as $image)
            <div class="col-sm-12 col-md-">
              <img src="{{ asset('uploads/product/'.$image->name) }}" alt="" class="img img-fluid img-thumbnail">
            {{ Form::checkbox('delimage[]',$image->name,false) }}Delete
            </div>
          @endforeach
        </div>
    @endif


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