<!-- Modal -->
<div class="modal fade" id="edit-profile" tabindex="-1" aria-labelledby="change-passwordLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="edit-profileLabel">Edit Profile</h5>
        <button type="button" class="btn btn-sm btn-danger " data-dismiss="modal" aria-label="Close">
          <i class="fas fa-times"></i>
        </button>
      </div>
      {{ Form::open(['url'=>route('user.update',auth()->user()->id),'files'=>true]) }}
      @method('patch')
      <div class="modal-body">
          <div class="row mb-3">
              {{ form::label('name','Name:',['class'=>'col-sm-3']) }}
              <div class="col-sm-9">
                  {{ form::text('name',auth()->user()->name, ['class'=>'form-control form-control-sm','required'=>false,'placeholder'=>'Enter Your Name','id'=>'name']) }}
                  @error('name')
                    <span class="text-danger">{{ $message }}</span>
                  @enderror
            </div>

          </div>

          <div class="row mb-3">
              {{ form::label('phone','Phone Number:',['class'=>'col-sm-3']) }}
              <div class="col-sm-9">
                  {{ form::tel('phone',auth()->user()->userInfo->phone??null ,['class'=>'form-control form-control-sm','required'=>false,'placeholder'=>'Enter Your Phone Number','id'=>'phone']) }}
                  @error('phone')
                    <span class="text-danger">{{ $message }}</span>
                  @enderror
                    
               
              </div>

          </div>
             <div class="row mb-3">
              {{ form::label('shipping_address','Shipping Address:',['class'=>'col-sm-3']) }}
              <div class="col-sm-9">
                  {{ form::textarea('shipping_address',auth()->user()->userInfo->shipping_address??null ,['class'=>'form-control form-control-sm','required'=>false,'rows'=>3, 'style'=>'resize:none','placeholder'=>'Enter Your Shipping Address','id'=>'shipping_address']) }}
                  @error('shipping_address')
                    <span class="text-danger">{{ $message }}</span>
                  @enderror
                    
               
              </div>

          </div>

             <div class="row mb-3">
              {{ form::label('billing_address','Billing Address:',['class'=>'col-sm-3']) }}
              <div class="col-sm-9">
                  {{ form::textarea('billing_address',auth()->user()->userInfo->billing_address??null ,['class'=>'form-control form-control-sm','required'=>false,'rows'=>3, 'style'=>'resize:none','placeholder'=>'Enter Your billing Address','id'=>'billing_address']) }}
                  @error('billing_address')
                    <span class="text-danger">{{ $message }}</span>
                  @enderror
                    
               
              </div>

          </div>

            <div class="row mb-3">
              {{ form::label('image','Image:',['class'=>'col-sm-3']) }}
              <div class="col-sm-3">
                  {{ form::file('image' ,['required'=>false, 'id'=>'image','accept'=>'image/*', 'onchange'=>'readURL(this ,"thumb")']) }}
                  @error('image')
                    <span class="text-danger">{{ $message }}</span>
                  @enderror
                    
               
              </div>
                  <div class="col-sm-2">
                    @if(isset(auth()->user()->userInfo) && auth()->user()->userInfo->images !=null && file_exist('public/users/'.auth()->user()->userInfo->images))
                          @php  $url = asset('uploads/user/'.auth()->user()->userInfo->images);@endphp
                    @else
                         @php  $url =  asset('image/user.png');@endphp
                    @endif
                     <img src="{{ $url }}" alt="{{ auth()->user()->name }}" class="img img-thumbnail img-circle" id="thumb">  
                    </div>
                </div>
      </div>
      <div class="modal-footer">
        {{ Form::button('<i class="fas fa-times"></i> Close',['class'=>'btn btn-sm btn-danger','data-dismiss'=>'modal','type'=>'reset']) }}
         {{ Form::button('<i class="fas fa-paper-plane"></i> Save' ,['class'=>'btn btn-sm btn-success','type'=>'submit']) }}
        

      {{ form::close() }}
    </div>
  </div>
</div>
</div>


<div class="modal fade" id="password-change" tabindex="-1" aria-labelledby="password-changeLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="password-changeLabel">Change Password</h5>
        <button type="button" class="btn btn-sm btn-danger " data-dismiss="modal" aria-label="Close">
          <i class="fas fa-times"></i>
        </button>
      </div>
      {{ Form::open(['url'=>route('change-password', auth()->user()->id),'files'=>true]) }}
                 @method('patch')
      <div class="modal-body">
          <div class="row mb-3">
              {{ form::label('password','Password:',['class'=>'col-sm-3']) }}
              <div class="col-sm-9">
                  {{ form::password('password',  ['class'=>'form-control form-control-sm','required'=>true,'placeholder'=>'Enter Your Password','id'=>'password']) }}
                  @error('password')
                    <span class="text-danger">{{ $message }}</span>
                  @enderror
            </div>

          </div>

            <div class="row mb-3">
              {{ form::label('conformation_password','RePassword:',['class'=>'col-sm-3']) }}
              <div class="col-sm-9">
                  {{ form::password('conformation_password', ['class'=>'form-control form-control-sm','required'=>true,'placeholder'=>'Enter Your Re Password','id'=>'confirmpassword']) }}
                  @error('conformation_password')
                    <span class="text-danger">{{ $message }}</span>
                  @enderror
            </div>

          </div>
          
 </div>
      <div class="modal-footer">
        {{ Form::button('<i class="fas fa-times"></i> Close',['class'=>'btn btn-sm btn-danger','data-dismiss'=>'modal']) }}
         {{ Form::button('<i class="fas fa-paper-plane"></i> Update Password' ,['class'=>'btn btn-sm btn-success','type'=>'submit']) }}
   {{ form::close() }}
    </div>
  </div>
</div>


 <script src="{{ mix('js/manifest.js') }}"></script>
  <script src="{{ mix('js/vendor.js') }}"></script>
   <script src="{{ mix('js/admin.js') }}"></script>
 @yield('scripts')


 <script>

   $(document).on('click','.profile-edit-button', function (e) {
          e.preventDefault();
          $('#edit-profile').modal('show');

          
   });

  $(document).on('click','.password-change', function (e) {
       e.preventDefault();
          $('#password-change').modal('show');
   });
 </script>
  



</body>
</html>
