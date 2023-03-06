<table>
    <thead>
    <tr></tr>
    <tr><th colspan="9" style="text-align:center;color:red;background-color:yellow;font-weight:bold;font-size: 16px;">Thống kê hoá đơn</th></tr>
    <tr></tr>
    <tr>
        <th></th>
        <th style="font-weight:bold">Creator: </th>
        <th>{{Auth::user()->username}}</th>
        <th></th>
        <th></th>
        <th style="font-weight:bold">Name of the store: </th>
        <th>{{ config('app.name','EShopper') }}</th>
        
    </tr>
    <tr>
        <th></th>
        <th style="font-weight:bold">Date created: </th>
        <th>{{\Carbon\Carbon::now()->format('d/m/Y')}}</th>
        <th></th>
        <th></th>
        <th style="font-weight:bold">Currency unit: </th>
        <th>VND</th>
    </tr>
    <tr>
        <th></th>
        <th style="font-weight:bold">From date: </th>
        <th>{{format_date($from_date)}}</th> 
        <th></th>
        <th></th>
        <th style="font-weight:bold">To date: </th>
        <th>{{format_date($to_date)}}</th>
    </tr>
    <tr></tr>
    <tr>
        <th style="font-weight:bold;color:white;background-color:blue;border-bottom:1px black solid;border-right:1px black solid">STT</th>
        <th style="font-weight:bold;color:white;background-color:blue;border-bottom:1px black solid;border-right:1px black solid">Mã đơn hàng</th>
        <th style="font-weight:bold;color:white;background-color:blue;border-bottom:1px black solid;border-right:1px black solid">Họ và tên</th>
        <th style="font-weight:bold;color:white;background-color:blue;border-bottom:1px black solid;border-right:1px black solid">Email</th>
        <th style="font-weight:bold;color:white;background-color:blue;border-bottom:1px black solid;border-right:1px black solid">Địa chỉ</th>
        <th style="font-weight:bold;color:white;background-color:blue;border-bottom:1px black solid;border-right:1px black solid">Phương thức</th>
        <th style="font-weight:bold;color:white;background-color:blue;border-bottom:1px black solid;border-right:1px black solid">Ngày tạo</th>
        <th style="font-weight:bold;color:white;background-color:blue;border-bottom:1px black solid;border-right:1px black solid">Ghi chú</th>
        <th style="font-weight:bold;color:white;background-color:blue;border-bottom:1px black solid;border-right:1px black solid">Tổng tiền</th>
    </tr>
    </thead>
    <tbody>
    @php $sum = 0 @endphp
    @foreach($orders as $key=>$order)
        @php $sum += $order->total @endphp
        <tr>
            <td style="border:1px black solid;vertical-align: text-top;text-align:center;">{{ $key +1}}</td>
            <td style="border:1px black solid;vertical-align: text-top;text-align:center;">{{ $order->id }}</td>
            <td style="border:1px black solid;vertical-align: text-top;">{{ $order->fullname }}</td>
            <td style="border:1px black solid;vertical-align: text-top;">{{ $order->email }}</td>
            <td style="border:1px black solid;vertical-align: text-top;">{{ $order->address }}</td>
            <td style="border:1px black solid;vertical-align: text-top;">{{ getMethodPaymentDashboard( $order->method )}}</td>
            <td style="border:1px black solid;vertical-align: text-top;">{{ $order->date }}</td>
            <td style="border:1px black solid;vertical-align: text-top;">{{ $order->note }}</td>
            <td style="border:1px black solid;vertical-align: text-top;">{{ format_price($order->total)}}</td>
        </tr>
    @endforeach
    <tr></tr>
     <tr>
         <td></td>
         <td colspan="7" style="font-size: 13px;font-weight:bold;color:black;">Total</td>
         <td style="font-size: 13px;font-weight:bold;color:black;">{{format_price($sum)}}</td>
    </tr>
    </tbody>
</table>