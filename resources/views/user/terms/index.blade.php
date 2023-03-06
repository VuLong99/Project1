@extends('layouts.user')
@section('head')
    <style>
        #cart_items
        {
            padding-bottom: 60px;
        }
        .li-item
        {
            margin-bottom: 5px;
        }
        .li-item::marker 
        {
            font-weight: bold; 
        }
        .li-item-child
        {
            list-style-type: disclosure-closed;
            padding-bottom: 5px;
            padding-top: 5px;
        }
    </style>
@endsection
@section('content')
<section id="cart_items">
    <div class="container">
        @include('layouts.user.breadcrumb')
        <div class="row">
            @include('user.parts.category-policy')
            <h1>Terms of Service</h1>
            <hr>

            <div class="row">
                <div class="col-sm-2"></div>
                <div class="col-sm-8">
                    <ol>
                        <li class="li-item">
                            <span class="fw-bold mb-5-custom">Introduce</span>
                            <ul>
                                <li class="li-item-child">Welcome customers to our website.</li>
                                <li class="li-item-child">When you visit our website, you agree to these terms. The Website reserves the right to change, modify, add or remove any part of these Terms of Sale, at any time. Changes are effective immediately upon posting on the website without prior notice. And when you continue to use the website, after changes to these Terms are posted, it means that you accept those changes.</li>
                                <li class="li-item-child">Please check back often to keep up to date with our changes.</li>
                            </ul>
                        </li>
                        <li class="li-item">
                            <span class="fw-bold mb-5-custom">Instructions for using the website</span>
                            <ul>
                                <li class="li-item-child">When accessing our website, customers must be at least 18 years old, or access under the supervision of a parent or legal guardian. Customers ensure that they have all civil acts to perform goods purchase and sale transactions in accordance with current regulations of Vietnamese law.</li>
                                <li class="li-item-child">During the registration process, you agree to receive promotional emails from the website. If you do not wish to continue receiving mail, you may opt-out by clicking the link at the bottom of any promotional email.</li>
                            </ul>
                        </li>
                        <li class="li-item">
                            <span class="fw-bold mb-5-custom">Safe and convenient payment</span>
                            <ul>
                               <li class="li-item-child">Buyers can refer to the following payment methods and choose to apply the appropriate method:</li>
                               <li class="li-item-child"><span class="fw-bold">Cách 1:</span> Direct payment (buyers receive goods at the seller's address)</li>
                               <li class="li-item-child"><span class="fw-bold">Cách 2:</span> Pay later (COD – Delivery and collection site)</li>
                               <li class="li-item-child"><span class="fw-bold">Cách 3:</span> Pay later (COD – Delivery and collection site)</li>
                            </ul>
                        </li>
                    </ol>
                </div>
            </div>
        </div>
    </div>
</section> <!--/#cart_items-->
@endsection
@section('script')
	
@endsection