<!DOCTYPE html>
<html>
<head>
<style>
table {
  font-family: arial, sans-serif;
  border-collapse: collapse;
  width: 100%;
}
caption {
  caption-side: bottom;
}
.top_left {
    text-align: right;
}
.information {
    text-align: right;
}


/* .company {
    width: 290px;
    padding: 30px 50px 0px 0px;
    height: 100px;
    z-index: 999;
    background-image: linear-gradient(to bottom, #ff8100, #fb5d5d);
    border-radius: 0px 100px 101px 0px;

} */
#customers td, #customers th {
  border: 1px solid #ddd;
  padding: 8px;
}
#customers th {
  padding-top: 12px;
  padding-bottom: 12px;
  text-align: left;
  background-color: #ff8100;
  color: white;
}
#customers {
    margin: 20px auto 0 auto;
}

.invoice_button  tr .invoice_download {
    padding: 0;
    border: none;
}
.invoice_button tr .invoice_download a{
    padding: 10px 50px;
    text-align: center;
    border-radius: 25px;
    background-color: #ff8100;
    margin: 10px 0;
    border: none;
    box-shadow: 0px 0px 16px -6px rgba(0, 0, 0, .5);
    color: #fff;
    font-size: 1.25rem;
    text-transform: uppercase;
    text-decoration: none;
    letter-spacing: 1px;
    outline: none;
    cursor: pointer;

}


</style>
</head>
<body>
<table style="max-width: 1200px; margin: 0 auto" >
  <tr>
    <td style="text-align: left; width: 70%"> <img width="300" src="https://i.postimg.cc/66RW8FFx/suzayet-white-logo-back.png" alt="logo"></td>
    <td class="top_left" style="width: 30%">
        <table>
            <tr>
                <td style="text-align:right; font-weight: 600;
                color: #fb5d5d;
                font-size: 30px; padding-bottom: 8px;">INVOICE<br/></td>
            </tr>
            <tr>
                <td class="top_left" style="width: 30%" >Invoice Number: # {{ App\Models\BillingDetails::where('order_id', $order_id)->first()->order_id }}<br/>
                    Invoice Date: {{ App\Models\BillingDetails::where('order_id', $order_id)->first()->created_at->format('d/M/y') }}<br/></td>
            </tr>
        </table>
    </td>
  </tr>
  <tr >
    <td colspan="2">
        <table>
            <tr>
                <td>
                    <span style="font-weight: 700">Address:-</span><br />
                    {{ App\Models\BillingDetails::where('order_id', $order_id)->first()->address }}
                </td>

                <td class="information">
                    {{ App\Models\BillingDetails::where('order_id', $order_id)->first()->company }}<br /> {{ App\Models\BillingDetails::where('order_id', $order_id)->first()->name }}<br /> {{ App\Models\BillingDetails::where('order_id', $order_id)->first()->email }}
                </td>
            </tr>
        </table>
    </td>
</tr>
</table>
<table id="customers" style="max-width: 1200px; ">
    <tr>
      <th>Product Name</th>
      <th>Price</th>
      <th>Discount</th>
      <th>Total</th>
    </tr>

    @php
        $total = 0;
    @endphp
    @foreach (App\Models\ProductOrder::where('order_id', $order_id)->get() as $order_product)
    <tr>
        <td>{{ $order_product->product->product_name }}</td>
        <td>${{ $order_product->product->product_price }}</td>
        <td>${{ $order_product->order->discount }}</td>
        <td style="border: none;"></td>
        @php
            $total+= $order_product->product->product_price;
        @endphp
    </tr>
    @endforeach
  </table>
  <table style="max-width: 1200px; margin: 0 auto;">
      <tr>
          <td width="32%"></td>
          <td width="28%"></td>
          <td width="28%"></td>
          <td width="12%" style="font-weight:700; color: #fb5d5d;">${{  $total }}</td>
      </tr>
  </table>
  <table class="invoice_button" style="max-width: 1200px; margin: 0 auto; text-align: center; margin-top: 50px;">
    <tr rowspan="3" class="invoice_download_tr">
        <td class="invoice_download"><a href="{{ route('invoice.download', $order_id) }}" class="view">Download</a></td>
    </tr>
  </table>

</body>
</html>

