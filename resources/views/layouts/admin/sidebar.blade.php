<!-- Side Navbar -->
<nav class="side-navbar">
  <div class="side-navbar-wrapper">
    <!-- Sidebar Header    -->
    <div class="sidenav-header d-flex align-items-center justify-content-center">
      <!-- User Info-->
      <div class="sidenav-header-inner text-center cursor">
        <a target="_blank" href="{{route('user.profile.index')}}" class="nav-link logout"> 
          <img src="{{ (Auth::check() && !empty(Auth::user()->avatar)) ? asset(Auth::user()->avatar) : asset('images/none-user.png')}}" alt="person" class="img-fluid rounded-circle">
          <h2 class="h5">{{Auth::user()->username}}
        </a>
        {{-- <span>Web Developer</span> --}}
      </div>
      <!-- Small Brand information, appears on minimized sidebar-->
    <div class="sidenav-header-logo"><a href="{{route('home')}}" class="brand-small text-center"><strong class="text-primary">E</strong></a></div>
    </div>
    <!-- Sidebar Navigation Menus-->
    <div class="main-menu">
      {{-- <h5 class="sidenav-heading">Main</h5> --}}
      <ul id="side-main-menu" class="side-menu list-unstyled">                  
        <li class=@if(isset($isDashboard) && $isDashboard) {{'active'}} @endif><a href="{{route('admin.dashboard.index')}}"> <i class="icon-home"></i>Dashboard</a></li>
        {{-- <li><a href="{{route('admin.profile.index')}}"> <i class="fa fa-user"></i>Profile</a></li> --}}
        <li class=@if(isset($isSlide) && $isSlide) {{'active'}} @endif><a href="{{route('admin.slide.index')}}"> <i class="fa fa-sliders"></i></i>Slideshow</a></li>
        <li class=@if(isset($isUser) && $isUser) {{'active'}} @endif><a href="#exampledropdownDropdown" id="manager-user" aria-expanded="false" data-toggle="collapse"> <i class="fa fa-users"></i>Account Manage</a>
          <ul id="exampledropdownDropdown" class="collapse list-unstyled ">
            <li><a href="{{route('admin.user.index')}}">Account</a></li>
            <li><a href="{{route('admin.role.index')}}">Role</a></li>
          </ul>
        </li>
        <li class=@if(isset($isProduct) && $isProduct) {{'active'}} @endif><a href="#exampledropdownDropdown1" id="manager-product" aria-expanded="false" data-toggle="collapse"> <i class="icon-interface-windows"></i>Product Manage</a>
          <ul id="exampledropdownDropdown1" class="collapse list-unstyled ">
            <li><a href="{{route('admin.category.index')}}">Caregory</a></li>
            <li><a href="{{route('admin.product.index')}}">Product</a></li>
            <li><a href="{{route('admin.color.index')}}">Color</a></li>
            <li><a href="{{route('admin.size.index')}}">Size</a></li>
            <li><a href="{{route('admin.tag.index')}}">Keyword</a></li>
          </ul>
        </li>
        <li class=@if(isset($isPost) && $isPost) {{'active'}} @endif><a href="#exampledropdownDropdown2" id="manager-post" aria-expanded="false" data-toggle="collapse"> <i class="fa fa-list"></i>Posts Manage</a>
          <ul id="exampledropdownDropdown2" class="collapse list-unstyled ">
            <li><a href="{{route('admin.post_cate.index')}}">Category</a></li>
            <li><a href="{{route('admin.post.index')}}">Post</a></li>
          </ul>
        </li>
        {{-- <li class=@if(isset($isInforContact) && $isInforContact) {{'active'}} @endif><a href="{{route('admin.infor_contact.index')}}"> <i class="fa fa-address-book"></i></i>Contact Info</a></li> --}}
        <li class=@if(isset($isOrder) && $isOrder) {{'active'}} @endif><a href="{{route('admin.order.index')}}"> <i class="fa fa-cart-plus"></i>Order</a></li>
        {{-- <li class=@if(isset($isBill) && $isBill) {{'active'}} @endif><a href="{{route('admin.bill.index')}}"><i class="icon-bill"></i></i>Bill</a></li> --}}
        <li class=@if(isset($isOpinion) && $isOpinion) {{'active'}} @endif><a href="{{route('admin.opinion.index')}}"> <i class="fa fa-comments"></i>Comment</a></li>
        <li class=@if(isset($isWishlist) && $isWishlist) {{'active'}} @endif><a href="{{route('admin.wishlist.index')}}"> <i class="fa fa-heart"></i>Favourite</a></li>
       <!--  <li class=@if(isset($isDiscount) && $isDiscount) {{'active'}} @endif><a href="{{route('admin.discount.index')}}"> <i class="fa fa-percent"></i>Discount</a></li> -->
        <li class=@if(isset($isShip) && $isShip) {{'active'}} @endif><a href="{{route('admin.ship.index')}}"><i class="fa fa-money"></i>Transport fee</a></li>
      </ul>
    </div>
  </div>
</nav>
