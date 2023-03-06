@extends('layouts.user')
@section('content')

<div id="contact-page" class="container">
    <div class="bg">
        <div class="row">    		
            <div class="col-sm-12">    			   			
                <h2 class="title text-center">Contact us</h2>    			    				    				
                <!-- <div id="gmap" class="contact-map">
                </div> -->
            </div>			 		
        </div>    	
        <div class="row">  	
            <div class="col-sm-8">
                <div class="contact-form">
                    <h2 class="title text-center">Contact</h2>
                    <div class="status alert alert-success" style="display: none"></div>
                    <form id="form-contact" action="" method="POST" class="searchform">
                    @csrf
                        <input name="name" id="contact-name"  type="text" placeholder="FullName"/>
                        <div class="error error-name" 	@if($errors->has('name')) style="display:block" @endif>{{$errors->first('name')}}</div>
                        <input name="email" id="contact-email"  type="text" placeholder="email"/>
                        <div class="error error-email" 	@if($errors->has('email')) style="display:block" @endif>{{$errors->first('email')}}</div>
                        <textarea id="contact-content" name="content"  rows="5" placeholder="Content"></textarea>
                        <div class="error error-content" @if($errors->has('content')) style="display:block" @endif>{{$errors->first('content')}}</div>
                        
                        <button class="btn btn-default btn-send btn-custom">Save</button>
                    </form>
                </div>
            </div>
            <div class="col-sm-4">
                <div class="contact-info">
                    <h2 class="title text-center">Contact Info</h2>
                    <address>
                        <p>E-Shopper Inc.</p>
                        <p>An Tam Village, An Ninh Commune, Binh Luc District, Ha Nam Province</p>
                        <p>Ha Nam Province</p>
                        <p>Mobile: 0941126321</p>
                        <p>Email: anhvandz02@gmail.com</p>
                    </address>
                    <div class="social-networks">
                        <h2 class="title text-center">Social Network</h2>
                        <ul>
                            <li>
                                <a href="#"><i class="fa fa-facebook"></i></a>
                            </li>
                            <li>
                                <a href="#"><i class="fa fa-twitter"></i></a>
                            </li>
                            <li>
                                <a href="#"><i class="fa fa-google-plus"></i></a>
                            </li>
                            <li>
                                <a href="#"><i class="fa fa-youtube"></i></a>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>    			
        </div>  
    </div>	
</div><!--/#contact-page-->
@endsection