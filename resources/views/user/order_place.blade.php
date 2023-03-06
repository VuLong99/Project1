@extends('layouts.user')
@section('content')

<section id="cart_items">
    <div class="container">
        <div class="breadcrumbs">
            <ol class="breadcrumb">
                <li><a href="{{URL::to('home')}}">Home Page</a></li>
                <li class="active">Cart</li>
            </ol>
        </div>
		<div class="register-req">
			<p>Thank you for your purchase</p>
		</div>
        <div class="table-responsive cart_info">
		<?php
			$content = Cart::content();
		?>
            <table class="table table-condensed">
                <thead>
                    <tr class="cart_menu">
                        <td class="image">Image</td>
                        <td class="description">Product-Name</td>
                        <td class="price">Price</td>
                        <td class="qty">Amount</td>
                        <td class="total">Into money</td>
                        <td></td>
                    </tr>
                </thead>
                <tbody>
				@foreach($content as $v_content)
                    <tr>
                        <td class="cart_product">
                            <a href="#"><img class="img_cart" src="{{asset('images/product/14.jpg')}}" alt=""></a>
                        </td>
                        <td class="cart_description">
                            <h4><a href="#">{{$v_content->name}}</a></h4>
                            <p>{{('Mã sản phẩm: '.$v_content->id)}}</p>
                        </td>
                        <td class="cart_price">
                            <p>{{number_format($v_content->price)}}</p>
                        </td>
                        <td class="cart_quantity">
                            <div class="cart_quantity_button">
                                <form method="post">
                                	<!-- <input class="cart_quantity_input" type="text" min="1" name="cart_quantity" value="{{$v_content->qty}}" autocomplete="off" size="2" readonly> -->
									<p>{{$v_content->qty}}</p>
								</form>
                            </div>
                        </td>
                        <td class="cart_total">
                            <p class="cart_total_price">
								<?php
									$subtotal = $v_content->price * $v_content->qty;
									echo number_format($subtotal);
								?>
							</p>
                        </td>
                    </tr>
					@endforeach
                </tbody>
            </table>
        </div>
    </div>
</section> <!--/#cart_items-->
<section id="do_action">
	<div class="container">
		<div class="row">
			<div class="col-sm-6">
				<div class="total_area">
					<ul>
						<li>Delivery charges:  <span>Free</span></li>
						<li>Total amount: <span>{{Cart::subtotal()}}</span></li>
					</ul>
				</div>
			</div>
		</div>
	</div>
</section><!--/#do_action-->

@endsection