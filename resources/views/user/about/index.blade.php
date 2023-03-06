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
            margin:5px 0;
        }
        .li-item-child
        {
            list-style-type: disc;
            margin:5px 0;
        }
    </style>
@endsection
@section('content')
<section id="cart_items">
    <div class="container">
        @include('layouts.user.breadcrumb')
        <div class="row">
            @include('user.parts.category-policy')
            <h1>Introduction</h1>
            <hr>

            <div class="row">
                <div class="col-sm-2"></div>
                <div class="col-sm-8">
                    <ul>
                        <li class="li-item">About page helps customers understand your store better. Please provide specific information about the business, about the store, contact information. This will help customers feel confident when buying on your website.</li>
                        <li class="li-item">
                            <span>A few suggestions for About page content:</span>
                            <ul>
                                <li class="li-item-child">Who are you</li>
                                <li class="li-item-child">What is your business value?</li>
                                <li class="li-item-child">Store Address</li>
                                <li class="li-item-child">How long have you been in this industry?</li>
                                <li class="li-item-child">How long have you been in the online business?</li>
                                <li class="li-item-child">Who is your team?</li>
                                <li class="li-item-child">Contact Info</li>
                                <li class="li-item-child">Liên kết Links to social networking sites (Twitter, Facebook)</li>
                            </ul>
                        </li>
                        {{-- <li class="li-item">You can edit or delete this article here or add new articles in the Content Page management.</li> --}}
                    </ul>
                </div>
            </div>
        </div>
    </div>
</section> <!--/#cart_items-->
@endsection
@section('script')
	
@endsection