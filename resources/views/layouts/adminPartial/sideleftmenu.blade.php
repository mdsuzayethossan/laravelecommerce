<label class="sidebar-label">Navigation</label>
<div class="sl-sideleft-menu">
  <a href="{{url('/home')}}" class="sl-menu-link @yield('dahboardactive')">
    <div class="sl-menu-item">
      <i class="menu-item-icon icon ion-ios-home-outline tx-22"></i>
      <span class="menu-item-label">Dashboard</span>
    </div><!-- menu-item -->
  </a><!-- sl-menu-link -->
 <a href="{{url('/')}}" class="sl-menu-link">
    <div class="sl-menu-item">
      <i class="menu-item-icon icon ion-ios-photos-outline tx-20"></i>
      <span class="menu-item-label">Visit Site</span>
    </div><!-- menu-item -->
  </a><!-- sl-menu-link -->
    {{--
  <a href="#" class="sl-menu-link">
    <div class="sl-menu-item">
      <i class="menu-item-icon ion-ios-pie-outline tx-20">
      <span class="menu-item-label">Navigation bar</span>
      <i class="menu-item-arrow fa fa-angle-down"></i>
    </div><!-- menu-item -->
  </a><!-- sl-menu-link -->
  <ul class="sl-menu-sub nav flex-column">
    <li class="nav-item"><a href="{{ route('logos') }}" class="nav-link">Logos</a></li>
    <li class="nav-item"><a href="{{ route('menus') }}" class="nav-link">Menus</a></li>
    <li class="nav-item"><a href="{{ route('submenus') }}" class="nav-link">Submenus</a></li>
  </ul> --}}
  <a href="#" class="sl-menu-link @if (Route::currentRouteName() == 'logos' || Route::currentRouteName() == 'menus' || Route::currentRouteName() == 'submenus')

  {{ 'active' }}

  @endif">
    <div class="sl-menu-item">
      <i class="menu-item-icon ion-ios-pie-outline tx-20"></i>
      <span class="menu-item-label">Navigation bar</span>
      <i class="menu-item-arrow fa fa-angle-down"></i>
    </div><!-- menu-item -->
  </a><!-- sl-menu-link -->
  <ul class="sl-menu-sub nav flex-column">
    <li class="nav-item"><a href="{{ route('logos') }}" class="nav-link">Logos</a></li>
    <li class="nav-item"><a href="{{ route('menus') }}" class="nav-link">Menus</a></li>
    <li class="nav-item"><a href="{{ route('submenus') }}" class="nav-link">Submenus</a></li>
  </ul>

  <a href="#" class="sl-menu-link @yield('categoryactive')">
    <div class="sl-menu-item">
      <i class="menu-item-icon icon ion-ios-paper-outline tx-22"></i>
      <span class="menu-item-label">Category</span>
      <i class="menu-item-arrow fa fa-angle-down"></i>
    </div><!-- menu-item -->
  </a><!-- sl-menu-link -->
  <ul class="sl-menu-sub nav flex-column">
    <li class="nav-item"><a href="{{url('/category')}}" class="nav-link">View & Add Category</a></li>

  </ul>
  {{-- subcategory --}}
  <a href="#" class="sl-menu-link @yield('subcategoryactive')">
    <div class="sl-menu-item">
      <i class="menu-item-icon icon ion-ios-paper-outline tx-22"></i>
      <span class="menu-item-label">Subcategory</span>
      <i class="menu-item-arrow fa fa-angle-down"></i>
    </div><!-- menu-item -->
  </a><!-- sl-menu-link -->
  <ul class="sl-menu-sub nav flex-column">
    <li class="nav-item"><a href="{{url('/subcategory')}}" class="nav-link">View & Add Subategory</a></li>
  </ul>

  {{-- Color And Size --}}
  <a href="#" class="sl-menu-link @yield('color&sizeactive')">
    <div class="sl-menu-item">
      <i class="menu-item-icon icon ion-ios-paper-outline tx-22"></i>
      <span class="menu-item-label">Color & Size</span>
      <i class="menu-item-arrow fa fa-angle-down"></i>
    </div><!-- menu-item -->
  </a><!-- sl-menu-link -->
  <ul class="sl-menu-sub nav flex-column">
    <li class="nav-item"><a href="{{url('/color_size')}}" class="nav-link">Add Color & Size</a></li>
  </ul>

  {{-- subcategory --}}
  <a href="#" class="sl-menu-link @yield('productactive')">
    <div class="sl-menu-item">
      <i class="menu-item-icon icon ion-ios-paper-outline tx-22"></i>
      <span class="menu-item-label">Product</span>
      <i class="menu-item-arrow fa fa-angle-down"></i>
    </div><!-- menu-item -->
  </a><!-- sl-menu-link -->
  <ul class="sl-menu-sub nav flex-column">
    <li class="nav-item"><a href="{{route('add.product')}}" class="nav-link">View & Add Product</a></li>

  </ul>
  {{-- cart --}}
  <a href="#" class="sl-menu-link @yield('couponactive')">
    <div class="sl-menu-item">
      <i class="menu-item-icon icon ion-ios-paper-outline tx-22"></i>
      <span class="menu-item-label">Coupon</span>
      <i class="menu-item-arrow fa fa-angle-down"></i>
    </div><!-- menu-item -->
  </a><!-- sl-menu-link -->
  <ul class="sl-menu-sub nav flex-column">
    <li class="nav-item"><a href="{{route('coupon')}}" class="nav-link">Coupon Add & view</a></li>

  </ul>

</div><!-- sl-sideleft-menu -->
