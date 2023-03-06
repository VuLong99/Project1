@extends('layouts.user')
@section('content')
@foreach($infor_contact as $key => $contact)
<div id="contact-page" class="container">
    <div class="bg">
        <!-- <div class="row">    		
            <div class="col-sm-12">    			   			
                
            </div>			 		
        </div>    	 -->
        <div class="row">  	
            <div class="col-sm-8">
                <h2 class="title text-center">Contact Us</h2>    			    				    				
                <div id="map" class="contact-map">
                {!!$contact->map!!}
                </div>
            </div>
            <div class="col-sm-4">
                <div class="contact-info">
                    <h2 class="title text-center">Contact Information</h2>
                    <address>
                        <p>Flash-Cart Inc.</p>
                        <p>Address: {{$contact->address}}</p>
                        <p>Phone: {{$contact->phone}}</p>
                        <p>Open Time: {{$contact->time}}</p>
                        <p>Email: {{$contact->email}}</p>
                    </address>
                    
                </div>
            </div>    			
        </div>  
    </div>	
</div><!--/#contact-page-->
@endforeach
@endsection