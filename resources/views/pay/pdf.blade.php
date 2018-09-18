<!DOCTYPE html>
<html lang="en"><head>
  <title>Order</title>
  <!-- public\css -->
  <link rel="stylesheet" href="{{ public_path('css/app.css') }}">
  <style type="text/css">
  @page{margin: 3%}
  html{font-size: 12px;font-family: arial}
  .logo { width: 30%;height: 30%;top: 0px;}
  .table ,th {text-align: center; vertical-align: middle;}
  /*.table, th, td {wrap-text:true;}*/
</style>

</head><body style="background-color: white;">
  <div class="float-right" style="font-family: cursive;"> The Manifa Laundry</div>
  <div class="col-md-12">
    <div class="float-left"><img src="data:image/png;base64, {!! base64_encode(QrCode::format('png')->size(75)->generate($code)) !!} "></div>
    
    <br><br>
    <table class="table">
      <tr>
        <th colspan="2"></th>
        <td colspan="2" style="text-align:right; vertical-align:middle;">{{$tgl_bayar}}</td>
      </tr>
      <tr>
        <th style="text-align:center; vertical-align:middle;">No</th>
        <th style="text-align:center; vertical-align:middle;">Layanan</th>
        <th style="text-align:center; vertical-align:middle;">Quantity</th>
        <th style="text-align:right; vertical-align:middle;">Harga</th>
      </tr>
      @foreach($product_name as $key => $val)
      <tr>
        <td style="text-align:center; vertical-align:middle;">{{$key+1}}</td>
        <td style="text-align:center; vertical-align:middle;">{{ucwords($val)}}</td>
        <td style="text-align:center; vertical-align:middle;">{{$jumlah[$key]}}</td>
        <td style="text-align:right; vertical-align:middle;">{{formatPrice($product_harga[$key])}}</td>
      </tr>
      @endforeach
      <tr>
        <td colspan = "2"></td>
        <td style="text-align:right;">Total</td>
        <td style="text-align:right; vertical-align:middle;">: {{formatPrice($total_biaya)}}</td>
      </tr>
      <tr>
        <td colspan = "2"></td>
        <td style="text-align:right;">Tunai</td>
        <td style="text-align:right; vertical-align:middle;">: {{formatPrice($jml_bayar)}}</td>
      </tr>
      <tr>
        <td colspan = "2"></td>
        <td style="text-align:right;">Kembali</td>
        <td style="text-align:right; vertical-align:middle;">: {{formatPrice($jml_kembali)}}</td>
      </tr>
    </table>
  </div>
</body></html>