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
    
</head><body>
            <div><img class="logo" src="{{ public_path('template/images/manifa.jpg') }}" alt="Logo"></div>
            <div style="right: 0; position: fixed; left: 320"><img src="data:image/png;base64, {!! base64_encode(QrCode::format('png')->size(100)->generate($code)) !!} "></div>
        <br><br>
        <table>
          <tr>
            <td><label>Customer : {{$customer}}</label></td>
          </tr>
          <tr>
            <td><label>Alamat : {{$alamat}}</label></td>
          </tr>
          <tr>
            <td><label>Telp : {{$telp}}</label></td>
          </tr>
        </table><br><br>
        <table class="table" style="border: 1px black solid;">
          <tr>
            <th>Order No.</th><th>: {{$code}}</th>
          </tr>
        </table>
        <br><br>
        <table class="table" style="border: 1px black solid;">
          <tr>
            <th style="text-align:center; vertical-align:middle;">No</th>
            <th style="text-align:center; vertical-align:middle;">Layanan</th>
            <th style="text-align:center; vertical-align:middle;">Quantity</th>
            <th style="text-align:center; vertical-align:middle;">Harga</th>
          </tr>
          @foreach($product_name as $key => $val)
          <tr>
            <td style="text-align:center; vertical-align:middle;">{{$key+1}}</td>
            <td style="text-align:center; vertical-align:middle;">{{ucwords($val)}}</td>
            <td style="text-align:center; vertical-align:middle;">{{$amount[$key]}}</td>
            <td style="text-align:center; vertical-align:middle;">@Rp {{$harga[$key]}}</td>
          </tr>
          @endforeach
          <tr>
            <td colspan = "2"></td>
            <td style="text-align:center; vertical-align:middle;">Total</td>
            <td style="text-align:center; vertical-align:middle;">Rp {{$total}} ,-</td>
          </tr>
        </table>
</body></html>