@extends('layouts.user')
@section('head')
    <style>
        .error
        {
            padding-top: 2px;
        }
        .d-none
        {
            display: none;
        }
        .box_discount_code
        {
            margin-top: 5px;
            padding: 5px 5px 5px 10px;
            background-color: lavender;
            display: inline-block;
            border-radius: 10px;
        }
        .close_discount
        {
            border-left: 1px #00000021 solid;
            padding: 5px;
            margin-left: 10px;
        }
        .box-address
        {
            display: flex;
            align-items: flex-end;
            margin-bottom: 5px;
        }
        .box-address label
        {
            margin: 0;
            flex: auto;
        }
        .btn-address
        {
            padding: 3px 10px;
            border-radius: 5px;
            cursor: pointer;
            border-radius: 5px;
            background-color: #FE980F ;
            color: white ;
            border: 2px solid #FE980F ;
            transition: all 0.3s ease 0s;
        }
        .btn-address[disabled]{
            pointer-events: none;
            cursor: not-allowed;
            opacity: .65;
            filter: alpha(opacity=65);
            -webkit-box-shadow: none;
            box-shadow: none;
        }
        .btn-address:hover
        {
            background-color: transparent ;
            color: #FE980F ;
        }
        .btn-close
        {
            padding-top: 4px !important;
            padding-left: 15px !important;
            opacity: 1;
            color:red;
        }
        .btn-close:hover
        {
            color:red;
        }
        select
        {
            width: 100%;
            border-radius: 5px;
            height: 34px;
        }
        .w-50
        {
            width: 50px;
        }
        .w-100-percent
        {
            width: 100%;
        }
    </style>
@endsection
@section('content')

<section id="cart_items" class="section-checkout">
    <div class="container">
        @include('layouts.user.breadcrumb')
        {{-- @include('layouts.message.message') --}}
        <h1>Pay</h1>
        <hr>


    @if(Session::has('cart') && count(Session::get('cart')) > 0)
       
       {{-- <hr> --}}
        @php 
            $discount = Session::get('discount_cart');
            $sale_percent = 0;
            if(!empty($discount))
            {
                $sale_percent = $discount->sale_percent;
            }
        @endphp
        <div class="shopper-informations pb-50">
            <div class="row">
                <div class="col-sm-6">
                    {{-- Show Item --}}
                    <div class="bill-to">
                        <p>Order information</p>
                        <hr>
                        <table class="table table-condensed table-checkout">
                            <thead>
                                <tr class="checkout_menu">
                                    <th class="image">Item</th>
                                    <th class="description"></th>
                                    <th class="total">Total</th>
                                </tr>
                            </thead>
                            <tbody>
                                @php $total = 0; @endphp
                                @foreach(Session::get('cart') as $item)
                                    <tr>
                                        @php $total += $item['price'] * $item['qty'] @endphp
                                        <td class="checkout_image">
                                            <div class="box-checkout-image">
                                                <img class="checkout_img" @if(empty(getImageProduct($item['product']))) src="{{asset('images/product/no-image-product.png')}}" @else src="{{asset(getImageProduct($item['product']))}}" @endif alt="">
                                                <span class="box-count-checkout"><span class="count-checkout">{{ $item['qty'] }}</span></span>
                                            </div>
                                        </td>
                                        <td class="checkout-info">
                                            <p class="checkout-info__title">{{$item['name']}}</p>
                                            <p class="checkout-info__attr">{{ $item['options']['color']['name'] }}/{{ $item['options']['size']['name'] }}</p>
                                        </td>
                                        <td class="cart_total">
                                            <p class="cart_total_price" id="checkout_price_{{$item['id']}}_{{$item['options']['color']['id'] }}_{{$item['options']['size']['id'] }}">{{  format_price( $item['price'] * $item['qty'] - ($item['price'] * $item['qty'] * $sale_percent / 100) )}}&#8363;</p>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                        
                    </div>
                    <hr>
                    {{-- Discount --}}
                    <div class="row">
                        <div class="col-sm-12">
                            <div class="form-group shopper-info">
                                <label for="input-discount-checkout">Discount code (if any)</label>
                                <form class="discount-checkout" id="form-discount">
                                    <input type="text" name="input_discount" id="input-discount-checkout" placeholder="Nhập mã giảm giá" class="form-control input-discount-checkout" >
                                    
                                    <button type="submit" @if(!Auth::check()) disabled @endif class="btn btn-custom">Use</button>
                                    <button type="button" @if(!Auth::check()) disabled @endif data-target="#modal-discount"  data-toggle="modal" class="ml-10px btn btn-custom">Choose discount</button>
                                </form>
                                <div class="error error-discount">Failure</div>
                                <div class="error success-discount" @if(!empty($discount)) style="display:block" @endif>@if(!empty($discount))Use discount code successfully @endif</div>
                                <div class="container-discount">
                                    @if(!empty($discount))
                                    <div class="box_discount_code">
                                        <div class="discount_code">{{$discount->discount_code}}<span class="close_discount cursor" onclick="removeDiscount()" aria-hidden="true">×</span></div>
                                    </div>
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>
                    <hr>
                    {{-- Total --}}
                    <div class="row">
                        <div class="col-sm-12">
                            <table class="table table-checkout-price">
                                <tbody>
                                    <tr>
                                        <td class="td-title td-left">Tạm tính</td>
                                        <td class="td-price td-right" id="total_price">{{  format_price($total - ($total * $sale_percent / 100))}}&#8363;</td>
                                    </tr>
                                    <tr>
                                        <td class="td-title td-left">Tiền giảm</td>
                                        <td class="td-price td-right" id="total_sale_price">- {{format_price($total * $sale_percent / 100)}}&#8363;</td>
                                    </tr>
                                    <tr>
                                        @php 
                                            $fee_ship = !empty($ship) ? $ship->fee : 0; 
                                            // dd($ship->fee);
                                         @endphp
                                        <td class="td-title td-left">Transport fee</td>
                                        <td class="td-price td-right"  id="ship_price">{{ format_price( ( $fee_ship) )}}&#8363;</td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                    <hr>
                    {{-- Total --}}
                    <div class="row">
                        <div class="col-sm-12">
                            <table class="table table-checkout-price">
                                <tbody>
                                    <tr>
                                        <td class="td-title td-left"><h4>Total</h4></td>
                                        <td class="td-price td-right" id="payment_price"><h4>{{ format_price($total - ($total * $sale_percent / 100) + $fee_ship) }}&#8363;</h4></td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>			
                <div class="col-sm-6">
                    <div class="shopper-info">
                        <p>Shipment Details</p>
                        <hr>
                        <form id="form-checkout" class="" action="{{url('/checkout')}}" method="POST">
                            @csrf
                            <input type="hidden" name="list_product" value="{{json_encode(Session::get('cart'))}}">
                            <input type="hidden" name="discount" id="discount">
                            <div class="step-one">
                                <h2 class="heading">Please choose a payment method</h2>
                            </div>
                            <div class="checkout-options">
                                <ul class="nav">
                                    @if(Auth::check())
                                    <li>
                                        <div>
                                            <label>
                                                <input class="input-radio-custom bank" type="radio" value="vnpay" name="payment">
                                                <img class="w-50" src="{{ asset('images/vnpay.png')}}" alt="Image VNPay">
                                                VNPay</label>
                                        </div>
                                    </li>
                                    <li>
                                        <div>
                                            
                                            <label>
                                                <input class="input-radio-custom no-bank" type="radio" value="momo" name="payment">
                                                <img class="w-50" src="{{ asset('images/momo.png')}}" alt="Image Momo">
                                                Momo</label>
                                        </div>
                                    </li>
                                    @endif
                                    <li class="w-100-percent">
                                        <div><label><input class="input-radio-custom no-bank" type="radio" checked value="delivery" name="payment">Payment on delivery</label></div>
                                    </li>
                                </ul>
                            </div><!--/checkout-options-->
                    
                            <div class="form-group">
                                <label for="fullname">First and last name <span class="input-required">*<span></label>
                                <input type="text" @if(Auth::check()) {{--disabled--}} @endif id="fullname" name="fullname" value="{{$user->username ?? ''}}" placeholder="Nhập họ và tên" class="form-control input-checkout" >
                                <div class="error error-fullname" 	@if($errors->has('fullname')) style="display:block" @endif>{{$errors->first('fullname')}}</div>
                            </div>
                            <div class="form-group">
                                <label for="email">Email <span class="input-required">*<span></label>
                                <input type="email" id="email" @if(Auth::check() && !empty($user->email)) {{--disabled--}} @endif name="email"  value="{{$user->email ?? ''}}" placeholder="Nhập email" class="form-control input-checkout" >
                                <div class="error error-email" 	@if($errors->has('email')) style="display:block" @endif>{{$errors->first('email')}}</div>
                            </div>
                            <div class="form-group">
                                <label for="phone">Phone Number <span class="input-required">*<span></label>
                                <input type="text" id="phone" name="phone" @if(Auth::check() && !empty($user->phone)) {{--disabled--}} @endif value="{{$user->phone ?? ''}}" placeholder="Nhập số điện thoại" class="form-control input-checkout" >
                                <div class="error error-phone" 	@if($errors->has('phone')) style="display:block" @endif>{{$errors->first('phone')}}</div>
                            </div>
                            <div class="form-group box-city">
                                <div class="box-address">
                                    <label for="province">Province/City<span class="input-required">*<span></label> 
                                    <button class="btn-address" @if(!Auth::check()) disabled @endif data-target="#modal-address"  data-toggle="modal">Choose an address</button>
                                </div>
                                <select name="province" id="province" class="custom-select">
                                    <option value="">---Select province/city---</option> 
                                    @foreach ($cities as $city)
                                        <option @if(!empty($address_primary) && $address_primary->province_id == $city->id)) selected @endif value="{{$city->id}}">{{$city->name_with_type}}</option>
                                    @endforeach
                                </select>
                                <div class="error error-province" @if($errors->has('province')) style="display:block" @endif>{{$errors->first('province')}}</div>
                            </div>
                            <div class="form-group box-district">
                                <label for="district">District <span class="input-required">*<span></label>
                                <select name="district" id="district" class="custom-select">
                                    <option value="">---Select district---</option>
                                    @if(!empty($district_primary))
                                        @foreach ($district_primary as $district)
                                            <option @if(!empty($address_primary) && $address_primary->district_id == $district->id)) selected @endif value="{{$district->id}}">{{$district->name_with_type}}</option>
                                        @endforeach
                                    @endif
                                </select>
                                <div class="error error-district" 	@if($errors->has('district')) style="display:block" @endif>{{$errors->first('district')}}</div>
                            </div>
                            <div class="form-group box-ward">
                                <label for="ward" >Commune/Ward/Town <span class="input-required">*<span></label>
                                <select name="ward" id="ward" class="custom-select">
                                    <option value="">---Select Commune/Ward/Town---</option>
                                    @if(!empty($ward_primary))
                                        @foreach ($ward_primary as $ward)
                                            <option @if(!empty($address_primary) && $address_primary->ward_id == $ward->id)) selected @endif value="{{$ward->id}}">{{$ward->name_with_type}}</option>
                                        @endforeach
                                    @endif
                                </select>
                                <div class="error error-ward" 	@if($errors->has('ward')) style="display:block" @endif>{{$errors->first('ward')}}</div>
                            </div>
                            <div class="form-group">
                                <label for="address">House No, Road/Ham/Village/Xom <span class="input-required">*<span></label>
                                <input type="text" id="address" name="address"  @if(!empty($address_primary)) value="{{$address_primary->street}}" @endif placeholder="Nhập địa chỉ" class="form-control input-checkout" >
                                <div class="error error-address" 	@if($errors->has('address')) style="display:block" @endif>{{$errors->first('address')}}</div>
                            </div>
                            @if(Auth::check())
                            <div class="form-group box-bank">
                                <label for="bank">Bank(Pay by VNPay e-wallet)</label>
                                <select name="bank" id="bank" disabled>
                                    <option value="">---Select a bank---</option>
                                    <option value="ncb">National Bank - NCB</option>
                                </select>
                                <div class="error error-bank" 	@if($errors->has('bank')) style="display:block" @endif>{{$errors->first('bank')}}</div>
                            </div>
                            @endif
                            <div class="form-group">
                                <label for="note">Note</label>
                                <textarea type="text" id="note" rows="5" name="note" placeholder="Nhập ghi chú" class="form-control" ></textarea>
                            </div>
                            <div class="form-group">
                                <button class="btn btn-custom btn-checkout-submit" type="submit" id="btn-complete">Completed</button>
                                <a id="btn-cart" class="btn btn-custom" href="{{url('/cart')}}"><i class="fa fa-angle-left" style="padding-right:10px;"></i>Continue shopping</a>
                            </div>
                        </form>
                    </div>
                </div>
              	
            </div>
        </div>
    @else 
    <div class="container">
        <div class="row">
            <div class="col-12">
                <p class="message-cart">There are no products in the cart, please select the product before checkout</p>
                <p class="message-cart">If you use an e-wallet but haven't paid yet. Please check your order for payment again</p>
            </div>
        </div>
    </div>
    @endif
    </div>
    @if(Auth::check())
    
    <div class="modal fade" id="modal-discount" tabindex="-1" role="dialog"  data-backdrop="static">
        <div class="modal-dialog modal-dialog-centered" >
          <div class="modal-content">
      
            <!-- Modal Header -->
            <div class="modal-header">
              <h4 class="modal-title">Choose discount</h4>
            </div>
    
            <!-- Modal body -->
            <div class="modal-body" style="max-height: 350px;overflow: auto;">
              <div class="form-group row">
                <div class="col-sm-12">
                    <div class="show-discount">
                        <ul class="ul-discount">
                            @if(count($list_discount) > 0)
                                @foreach ($list_discount as $item)
                                <li class="li-discount">
                                    <div class="box-li-discount">
                                        <span>
                                            <input type="radio" name="check_discount" id="discount_{{$item->id}}" class="item-discount">
                                            <label for="discount_{{$item->id}}">{{$item->discount_code}}</label>
                                        </span>
                                        <span class="discount-plus" data-dismiss="modal" onclick="addDiscount('{{$item->discount_code}}')"><i class="fa fa-plus-square"></i></span>
                                    </div>
                                    <div class="content-li-discount">
                                        <div>Discount type: {{$item->type == 'product' ? 'sản phẩm' : 'danh mục'}}</div>
                                        <div>Discount code: {{$item->sale_percent}}%</div>
                                        <div>Time application: {{format_date($item->start_date)}} - {{format_date($item->end_date)}}</div>
                                        <div>Some {{$item->type == 'product' ? 'sản phẩm' : 'danh mục'}}: </div>
                                        <ul>
                                            @foreach ($item->getItemDiscount() as $key=>$value)
                                            <li>{{$value->name}}</li>
                                            @endforeach
                                        </ul>
                                    </div>
                                </li>
                                @endforeach
                            @else
                                <li class="li-discount">
                                    <div>No discount</div>
                                </li>
                            @endif
                        </ul>
                    </div>
                </div>
              </div>
            </div>     

             <!-- Modal footer -->
            <div class="modal-footer">
                <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
            </div>
          </div>
        </div>
    </div>

    
    <div class="modal fade" id="modal-address" tabindex="-1" role="dialog"  data-backdrop="static">
        <div class="modal-dialog modal-dialog-centered" >
          <div class="modal-content">
      
            <!-- Modal Header -->
            <div class="modal-header">
              <h4 class="modal-title">Address history</h4>
            </div>
    
            <!-- Modal body -->
            <div class="modal-body" style="max-height: 350px;overflow: auto;">
              <div class="form-group row">
                <div class="col-sm-12">
                    <div class="show-discount">
                        <ul class="ul-discount" id="ul-address">
                            {{-- {{dd(!empty($address))}} --}}
                            @if(count($address) > 0)
                                @foreach ($address as $key=>$value)
                                <li class="li-discount">
                                    <div class="box-li-discount">
                                        <span>
                                            <input type="radio" name="check_discount" id="discount_{{$value->id}}" class="item-discount">
                                            <label for="discount_{{$value->id}}">Địa chỉ {{$key + 1}}</label>
                                        </span>
                                        <button type="button" class="btn-close close discount-plus" aria-label="Close">
                                            <span aria-hidden="true" onclick="deleteAddress('{{$value->street}}',{{$value->ward->id}},{{$value->district->id}},{{$value->province->id}})">&times;</span>
                                        </button>
                                        <span class="discount-plus" data-dismiss="modal" onclick="addAddress('{{$value->street}}',{{$value->ward->id}},{{$value->district->id}},{{$value->province->id}})"><i class="fa fa-plus-square"></i></span>
                                    </div>
                                    <div class="content-li-discount">
                                        <div>{{$value->street}}, {{$value->ward->name_with_type}}, {{$value->district->name_with_type}}, {{$value->province->name_with_type}}</div>
                                    </div>
                                </li>
                                @endforeach
                            @else
                                <li class="li-discount">
                                No address
                                </li>
                            @endif
                        </ul>
                    </div>
                </div>
              </div>
            </div>     

             <!-- Modal footer -->
            <div class="modal-footer">
                <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
            </div>
          </div>
        </div>
    </div>
    @endif
</section>

@endsection
@section('script')
	<script src="{{ asset('js/checkout.js')}}"></script> 
    <script>
        $('input[name="payment"]').on('change', function () {
            if ($(this).prop('checked')) {
                if(!$(this).hasClass('bank'))
                {
                    $('#bank').prop('disabled',true);
                    $("#bank").val($("#bank option:first").val());
                }
                else
                {                
                    $('#bank').prop('disabled',false);
                }
            }
        })

    </script>
@endsection