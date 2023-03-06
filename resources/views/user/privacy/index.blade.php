@extends('layouts.user')
@section('head')
    <style>
        #cart_items
        {
            padding-bottom: 60px;
        }
        .li-item
        {
            list-style-type: disclosure-closed;
            padding-bottom: 5px;
        }
    </style>
@endsection
@section('content')
<section id="cart_items">
    <div class="container">
        @include('layouts.user.breadcrumb')
        <div class="row">
            @include('user.parts.category-policy')
            <h1>Privacy Policy</h1>
            <hr>

            <div class="row">
                <div class="col-sm-2"></div>
                <div class="col-sm-8">
                    <ul>
                        <li class="li-item">This Privacy Policy is intended to help you understand how the website collects and uses your personal information through your use of the website, including any information that may be provided through the website when you register. account, register to receive communications from us, or when you purchase products or services, request additional service information from us.</li>
                        <li class="li-item">We use your personal information to communicate as necessary in connection with your use of our website, to answer questions or to send documents and information you request.</li>
                        <li class="li-item">Our website takes information security seriously and uses best practices to protect customer information and payments.. </li>
                        <li class="li-item">All transaction information will be kept confidential unless required by law enforcement.</li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</section> <!--/#cart_items-->
@endsection
@section('script')
	
@endsection