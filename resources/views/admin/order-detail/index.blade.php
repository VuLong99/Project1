@extends('layouts.admin')
@section('head')
  <style>
      .f-09-em
      {
        font-size: 0.9em;
      }
  </style>   
@endsection
@section('content')
<section class="charts">
  <section>
        <div class="container-fluid">
          <!-- Page Header-->
          <header> 
            <h1 class="h3 display">Order details</h1>
          </header>
          <div class="row">
            <div class="col-lg-12">
              <div class="card">
                <div class="card-body">
                  <div class=" row">

                    <div class="col-sm-6">
                      <div class="row">
                        <div class="col-3 f-09-em label">Full name:</div>
                        <div class="col-9 f-09-em">{{$order->fullname}}</div>
                      </div>
                    </div>
                    
                    <div class="col-sm-6">
                      <div class="row">
                        <div class="col-3 f-09-em label">Email:</div>
                        <div class="col-9 f-09-em">{{$order->email}}</div>
                      </div>
                    </div>
                  </div>
                  <hr>

                  <div class=" row">
                    <div class="col-sm-6">
                      <div class="row">
                        <div class="col-3 f-09-em label">Phone number:</div>
                        <div class="col-9 f-09-em">{{$order->phone}}</div>
                      </div>
                    </div>
              
                    <div class="col-sm-6">
                      <div class="row">
                        <div class="col-3 f-09-em label">Address:</div>
                        <div class="col-9 f-09-em">{{$order->address}}</div>
                      </div>
                    </div>
                  </div>
                  <hr>

                  <div class=" row">
                    <div class="col-sm-6">
                      <div class="row">
                        <div class="col-3 f-09-em label">Payment methods:</div>
                        <div class="col-9 f-09-em">{{ getMethodPayment($order->payment) }}</div>
                      </div>
                    </div>
              
                    <div class="col-sm-6">
                      <div class="row">
                        <div class="col-3 f-09-em label">Date created:</div>
                        <div class="col-9 f-09-em">{{format_datetime($order->created_at)}}</div>
                      </div>
                    </div>
                  </div>
                  <hr>

                  <div class=" row">
                    <div class="col-sm-6">
                      <div class="row">
                        <div class="col-3 f-09-em label">Status:</div>
                        <div class="col-9 f-09-em">{{ $order->payment->status ? "Đã thanh toán" : 'Chưa thanh toán' }}</div>
                      </div>
                    </div>
                    <div class="col-sm-6">
                      <div class="row">
                        <div class="col-3 f-09-em label">Note:</div>
                        <div class="col-9 f-09-em">{{ $order->note }}</div>
                      </div>
                    </div>
                  </div>
                  <hr>
                </div>

                <div class="card-body">
                  <div class="table-responsive">
                    <table class="table table-striped table-hover">
                      <thead>
                        <tr>
                          <th>Product</th>
                          <th>Size</th>
                          <th>Color</th>
                          <th>Quantity</th>
                          <th>Price</th>
                        </tr>
                      </thead>
                      <tbody>
                        @foreach($rows as $row)
                        <tr>
                          <td>{{ $row->product_detail->product->name}}</td>
                          <td>{{ $row->product_detail->size->name}}</td>
                          <td>{{ $row->product_detail->color->name }}</td>
                          <td>{{ $row->quantity }}</td>
                          <td>{{ format_price($row->product_detail->product->price) }}&#8363;</td>
                          {{-- <td>
                            <span class="edit cursor" data-id="{{ $row->id }}"  data-name="{{ $row->name }}"><i class="fa fa-edit"></i></span>
                          </td> --}}
                        </tr>
                        @endforeach
                      </tbody>
                    </table>
                    <div class="mt-3" style="display: flex;justify-content: center;"><center>{{ $rows->withQueryString()->links() }}</center></div>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>  
  </section>
</section>
@endsection
@section('script')
  <script >
  </script> 
@endsection
