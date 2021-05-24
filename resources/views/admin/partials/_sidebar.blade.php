  
     <aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <a href="{{ route(auth()->user()->role) }}" class="brand-link">
      <img src="{{ asset('image/logo.png') }}" alt="Logo" class="brand-image img-circle elevation-3" style="opacity: .8">
      <span class="brand-text font-weight-light">MeroDokan CMS</span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">
      <!-- Sidebar user panel (optional) -->
      <div class="user-panel mt-3 pb-3 mb-3 d-flex">
        <div class="image">

          @if(!empty(auth()->user()->user_info ) && file_exists(public_path('uploads/user/'.auth()->user()->user_info->images)))
          <img src="{{ asset('uploads/user/'.auth()->user()->user_info->image) }}" class="img-circle elevation-2"  >
          @else
          <img src="{{ asset('image/user.png') }}" alt="{{ auth()->user()->name }}">
          @endif
        </div>
        <div class="info">
          <a   class="d-block">{{ auth()->user()->name }} </a>
        </div>
      </div>

      <!-- SidebarSearch Form -->
      

      <!-- Sidebar Menu -->
      <nav class="mt-2">
        <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
          <!-- Add icons to the links using the .nav-icon class
               with font-awesome or any other icon font library -->
          <li class="nav-item">
            <a href="{{ route(auth()->user()->role) }}" class="nav-link active">
              <i class="nav-icon fas fa-tachometer-alt"></i>
              <p>
                Dashboard
              
              </p>
            </a>
            
          </li>
         
           
      
          <li class="nav-item">
            <a href="#" class="nav-link">
              <i class="nav-icon fas fa-images"></i>
              <p>
                  Slider Manager
                <i class="right fas fa-angle-left"></i>
              </p>
            </a>
            <ul class="nav nav-treeview offset-1">
              <li class="nav-item">
                <a href="{{ route('banner.create') }}" class="nav-link">
                <i class="fas fa-plus"></i>
                  <p>Add Banner</p>
                </a>
              </li>
            </ul>

            <ul class="nav nav-treeview offset-1">
              <li class="nav-item">
              <a href="{{ route('banner.index') }}"  class="nav-link">
                  
                  <i class="fas fa-list"></i>
                  <p>List Banner</p>
                </a>
              </li>
            </ul>
          </li>
           
          <li class="nav-item">
            <a href="#" class="nav-link">
              <i class="nav-icon fas fa-sitemap"></i>
              <p>
                  Category Manager
                <i class="right fas fa-angle-left"></i>
              </p>
            </a>
            <ul class="nav nav-treeview offset-1">
              <li class="nav-item">
                <a href="{{ route('category.create')}}" class="nav-link">
                <i class="fas fa-plus"></i>
                  <p>Add Category</p>
                </a>
              </li>
            </ul>
            <ul class="nav nav-treeview offset-1">
              <li class="nav-item">
                <a href="{{ route('category.index') }}" class="nav-link">
                  <i class="fas fa-list"></i>
                  <p>List Category</p>
                </a>
              </li>
            </ul>
          </li>

          <li class="nav-item">
            <a href="#" class="nav-link">
              <i class="nav-icon fas fa-bold"></i>
              <p>
                  Brand Manager
                <i class="right fas fa-angle-left"></i>
              </p>
            </a>
             <ul class="nav nav-treeview offset-1">
              <li class="nav-item">
                <a href="{{ route('brand.create') }}" class="nav-link">
                  <i class="fas fa-plus"></i>
                  <p>Add Brand</p>
                </a>
              </li>
            </ul>
            <ul class="nav nav-treeview offset-1">
              <li class="nav-item">
                <a href="{{ route('brand.index') }}" class="nav-link">
                  <i class="fas fa-list"></i>
                  <p>List Brand</p>
                </a>
              </li>
            </ul>
          </li>
      
          <li class="nav-item">
            <a href="#" class="nav-link">
              <i class="nav-icon fas fa-users"></i>
              <p>
                  User Manager
                <i class="right fas fa-angle-left"></i>
              </p>
            </a>
            <ul class="nav nav-treeview offset-1">
              <li class="nav-item">
                <a href="{{ route('user.create') }}" class="nav-link">
                  <i class="fas fa-plus"></i>
                  <p>Add User</p>
                </a>
              </li>
            </ul>
            <ul class="nav nav-treeview offset-1">
              <li class="nav-item">
                <a href="{{ route('user.show','customer') }}" class="nav-link">
                  <i class="fas fa-list"></i>
                  <p>List Customer</p>
                </a>
              </li>
            </ul>

            <ul class="nav nav-treeview offset-1">
              <li class="nav-item">
                <a href="{{ route('user.show','seller') }}" class="nav-link">
                  <i class="fas fa-list"></i>
                  <p>List Seller</p>
                </a>
              </li>
            </ul>

          </li>

          <li class="nav-item">
            <a href="#" class="nav-link">
              <i class="nav-icon fab fa-product-hunt"></i>
              <p>
                  Product Manager
                <i class="right fas fa-angle-left"></i>
              </p>
            </a>
            <ul class="nav nav-treeview offset-1">
              <li class="nav-item">
                <a href="{{ route('product.create') }}" class="nav-link">
                  <i class="fas fa-plus"></i>
                  <p>Add Product</p>
                </a>
              </li>
            </ul>

            <ul class="nav nav-treeview offset-1">
              <li class="nav-item">
                <a href="{{ route('product.index' ) }}" class="nav-link">
                  <i class="fas fa-list"></i>
                  <p>List Product</p>
                </a>
              </li>
            </ul>

          </li>

           <li class="nav-item">
            <a href="#" class="nav-link">
              <i class="nav-icon fas fa-shopping-cart"></i>
              <p>
                  Order Manager
                <i class="right fas fa-angle-left"></i>
              </p>
            </a>
            <ul class="nav nav-treeview offset-1">
              <li class="nav-item">
                <a href="#" class="nav-link">
                  <i class="fas fa-plus"></i>
                  <p>Add </p>
                </a>
              </li>
            </ul>
          </li>

            
          <li class="nav-item">
            <a href="#" class="nav-link">
              <i class="nav-icon fas fa-comments"></i>
              <p>
                  Comments Manager
                <i class="right fas fa-angle-left"></i>
              </p>
            </a>
            <ul class="nav nav-treeview offset-1">
              <li class="nav-item">
                <a href="#" class="nav-link">
                  <i class="fas fa-plus"></i>
                  <p>Add</p>
                </a>
              </li>
            </ul>
          </li>

           <li class="nav-item">
            <a href="#" class="nav-link">
              <i class="nav-icon fas fa-gift"></i>
              <p>
                  Offers Manager
                <i class="right fas fa-angle-left"></i>
              </p>
            </a>
            <ul class="nav nav-treeview offset-1">
              <li class="nav-item">
                <a href="#" class="nav-link">
                  <i class="fas fa-plus"></i>
                  <p>Add</p>
                </a>
              </li>
            </ul>
          </li>

           <li class="nav-item">
            <a href="#" class="nav-link">
              <i class="nav-icon fas fa-money-bill"></i>
              <p>
                  Transcations Manager
                <i class="right fas fa-angle-left"></i>
              </p>
            </a>
            <ul class="nav nav-treeview offset-1">
              <li class="nav-item">
                <a href="#" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Level 2</p>
                </a>
              </li>
            </ul>
          </li>


           <li class="nav-item">
            <a href="{{ route('page.index') }}" class="nav-link">
              <i class="nav-icon fas fa-file"></i>
              <p>
                  Pages Manager
                <i class="right fas fa-angle-left"></i>
              </p>
            </a>
             
          </li>

           <li class="nav-item">
            <a href="#" class="nav-link">
              <i class="nav-icon fas fa-ad"></i>
              <p>
                  Promotion Manager
                <i class="right fas fa-angle-left"></i>
              </p>
            </a>
            <ul class="nav nav-treeview offset-1">
              <li class="nav-item">
                <a href="#" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Level 2</p>
                </a>
              </li>
            </ul>
          </li>

      </nav>
      <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
  </aside>
