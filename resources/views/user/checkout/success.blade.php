@extends('layouts.user')
@section('head')
    <style>
        .t-center
        {
            text-align: center;
        }
        .t-right
        {
            text-align: right;
        }
    </style>
@endsection
@section('content')
<section id="cart_items">
    <div class="container">
        @include('layouts.user.breadcrumb')
    
        <div class="review-payment">
            <h1 class="">Information line #{{$order->id}}</h1>
        </div>
        <hr>

        <div class="row">
            <div class="col-sm-4 col-6">
                <p><span class="fw-bold">First and last name:</span> {{$order->fullname}}</p>
            </div>
            <div class="col-sm-4 col-6">
                <p><span class="fw-bold">Email:</span> {{$order->email}}</p>
            </div>
            <div class="col-sm-4 col-6">
                <p><span class="fw-bold">Phone Number:</span> {{$order->phone}}</p>
            </div>
        </div>

        <div class="row">
            <div class="col-sm-4 col-6">
                <p><span class="fw-bold">Address:</span> {{$order->address}}</p>
            </div>
            <div class="col-sm-4 col-6">
                <p><span class="fw-bold">Method:</span> {{getMethodPayment($order->payment)}}</p>
            </div>
            <div class="col-sm-4 col-6">
                <p><span class="fw-bold">Order date:</span> {{format_date($order->created_at)}}</p>
            </div>
        </div>

        <div class="row">
            <div class="col-sm-4 col-6">
                <p><span class="fw-bold">Status:</span> {{ $order->payment->status ? "Order paid" : 'The order has not been paid' }}</p>
            </div> 
            <div class="col-sm-4 col-6">
                <p><span class="fw-bold">Note:</span> {{ $order->note }}</p>
            </div>
        </div>
        <div class="table-responsive cart_info">
            <table class="table table-condensed">
                <thead>
                    <tr class="cart_menu">
                        <th></th>
                        <th class="stt">STT</th>
                        <th class="image">Image</th>
                        <th class="description">Product</th>
                        <th class="price t-center">Price</th>
                        <th class="quantity t-center">Amount</th>
                        <th class="total t-center">Discount</th>
                        <th class="total t-center">Into money</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($order->order_detail as $key=>$item)
                    <tr>
                        <td></td>
                        <td>
                            <p class="cart_quantity_custom t-center">{{$key + 1}}</p>
                        </td>
                        <td class="cart_checkout">
                            <center><img width="80px" @if(empty($item->product_detail->product->getImagePrimary())) src="{{asset('images/product/no-image-product.png')}}" @else src="{{asset($item->product_detail->product->getImagePrimary())}}" @endif alt=""></center>
                        </td>
                        <td class="cart_description">
                            <h4><a href="{{ url('product/'.$item->product_detail->product->id.'/detail') }}">{{$item->product_detail->name}}</a></h4>
                            <p>{{('Mã sản phẩm: '.$item->product_detail->product->id)}}</p>
                            <p>{{$item->product_detail->color->name}}/{{$item->product_detail->size->name}}</p>
                        </td>
                        <td class="cart_price">
                            <p class="t-center">{{ format_price($item->product_detail->product->price)}}&#8363;</p>
                        </td>
                        <td class="cart_quantity">
                            <div class="cart_quantity_button">
                                <p class="cart_quantity_custom t-center">{{$item->quantity}}</p>
                            </div>
                        </td>
                        <td class="cart_total">
                            <p class="cart_quantity_custom t-center">{{$item->discount->sale_percent ?? '0'}}%</p>
                        </td>
                        <td class="checkout_total">
                            <p class="cart_quantity_custom t-center">{{ format_price($item->price) }}&#8363;</p> 
                        </td>
                    </tr>
                    @endforeach
                    <tr>
                        <td colspan="6">&nbsp;</td>
                        <td colspan="2">
                            <table class="table table-condensed total-result">
                                <tr>
                                    <td class="fw-bold f-16">Total amount:</td>
                                    <td class="fw-bold f-16 t-right">{{ format_price($order->total + $order->sale_price) }}&#8363;</td>
                                </tr>
                                <tr>
                                    <td class="fw-bold f-16">Transport fee:</td>
                                    <td class="fw-bold f-16 t-right">{{ format_price($order->payment->ship->fee) }}&#8363;</td>
                                </tr>
                                <tr>
                                    <td class="fw-bold f-16">Money down:</td>
                                    <td class="fw-bold f-16 t-right">- {{ format_price($order->sale_price) }}&#8363;</td>
                                </tr>
                                <tr class="shipping-co f-16st">
                                    <td class="fw-bold f-16">Money to be paid:</td>
                                    <td class="fw-bold f-16 t-right">{{ format_price($order->payment->amount) }}&#8363;</td>										
                                </tr>
                            </table>
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
</section> <!--/#cart_items-->
@endsection
@section('script')
	
@endsection