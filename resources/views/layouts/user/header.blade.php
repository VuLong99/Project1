<header id="header"><!--header-->
  <div class="header_top"><!--header_top-->
    <div class="container">
      <div class="row">
        <div class="col-sm-6">
          <div class="contactinfo">
            <ul class="nav nav-pills">
              <li><a href="#"><i class="fa fa-phone"></i> 0984561592</a></li>
              <li><a href="#"><i class="fa fa-phone"></i>0762888888 </a></li>
              <li><a href="#"><i class="fa fa-envelope"></i>dinhlong0762@gmail.com</a></li>
            </ul>
          </div>
        </div>
      </div>
    </div>
  </div><!--/header_top-->
  <!-- oke oong -->
  <div class="header-middle"><!--header-middle-->
    <div class="container">
      <div class="row">
        <div class="col-sm-4">
          <div class="logo pull-left">
            <a href="{{route('home')}}"><img style="width: 100px" src="{{ asset('user/images/home/logo.png') }}" alt="" /></a>
          </div>
        </div>
        <div class="col-sm-8">
          <div class="shop-menu pull-right">
            <ul class="nav navbar-nav" style="display:inline">
              <li ><a style="color: #FE980F;" href="{{URL::to('wishlist')}}"><i class="fa fa-star"></i>Wishlist</a></li>
              <li><a href="{{url('/checkout')}}"><i class="fa fa-crosshairs"></i> Payment</a></li>
              <li class="box-cart">
                <a href="{{URL::to('cart')}}"><i class="fa fa-shopping-cart"></i> Cart</a>
                <span class="box-count-cart">
                  @if(Session::has('cart') && (count(Session::get('cart')) > 0))
                      <span class="count-cart">{{count(Session::get('cart'))}}</span>
                  @else
                      {{''}}
                  @endif
                </span>
              </li>
              @if(!Auth::check())
                <li><a href="{{route('login')}}"><i class="fa fa-lock"></i>Login</a></li>
              @else
                {{-- <li><a href="#"><i class="fa fa-user"></i> Account</a></li> --}}
                <li class="dropdown"><a href="#"><i class="fa fa-user"></i>{{ Auth::user()->username }}</a>
                  <ul role="menu" class="sub-menu sub-menu-custom">
                      @if(Auth::user()->checkAdmin())
                        <li><a target="_blank" href="{{route('admin.dashboard.index')}}">Management</a></li>
                      @endif
                      <li><a href="{{route('user.profile.index')}}">Account Information</a></li>
                      <li><a href="{{route('user.change_password.get')}}">Change Password</a></li>
                      <li><a  href="{{route('user.order.index')}}">Order</a></li>
                      <li><a  href="{{route('user.discount.index')}}">Discount</a></li>
                      <li><a href="{{ route('logout') }}">Logout</a></li>
                  </ul>
              </li> 
              @endif
            </ul>
          </div>
        </div>
      </div>
    </div>
  </div><!--/header-middle-->

  <div class="header-bottom"><!--header-bottom-->
    <div class="container">
      <div class="row">
        <div class="col-sm-9">
          <div class="navbar-header">
            <button type="button" class="navbar-toggle toggle-custom" data-toggle="collapse" data-target=".navbar-collapse">
              <span class="sr-only">Toggle navigation</span>
              <span class="icon-bar"></span>
              <span class="icon-bar"></span>
              <span class="icon-bar"></span>
            </button>
          </div>
          <div class="mainmenu pull-left">
            <ul class="nav navbar-nav collapse navbar-collapse">
              <li><a href="{{URL::to('home')}}" {{--class="active"--}}>Home</a></li>
              <li class="dropdown"><a class="cursor">Category<i class="fa fa-angle-down"></i></a>
                <ul role="menu" class="sub-menu">
                @foreach($categories as $key => $cate)
                  <li><a href="{{URL::to('/category/'.$cate->id)}}">{{$cate->name}}</a></li>
                @endforeach
                </ul>
              </li>
              <li class="dropdown"><a class="cursor">News every day<i class="fa fa-angle-down"></i></a>
                <ul role="menu" class="sub-menu">
                  @foreach($category_post as $key => $cate)
                    <li><a href="{{URL::to('/post-cate/'.$cate->post_path)}}">{{$cate->post_name}}</a></li>
                  @endforeach
                </ul>
              </li>
              <li><a href="{{URL::to('infor-contact')}}">Contact</a></li>
            </ul>
          </div>
        </div>
        <div class="col-sm-3">
          <form action="{{URL::to('/home')}}" method="get" autocomplete="off">
							<div class="search_box pull-right" style="display: flex;">
								<input type="text" id="key_word" name="key_word" placeholder="Search...." style="width: 302px;"/>
								<input type="submit" style="margin-top:0, color:#000000; display: flex;" class="btn btn-custom btn-default search" value="Search"/>
							</div>
              <div id="search_ajax"></div>
					</form>
        </div>
      </div>
    </div>
  </div><!--/header-bottom-->
</header><!--/header-->
