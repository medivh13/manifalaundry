@extends('layouts.layout')

@section('content')
<div class="col-lg-12 panels" style="margin-left: -5px;margin-bottom: 25px;">
  <div class="panel panel-default">
    <div class="panel-heading">
      <strong id="title">{{$title}}</strong>
      <div class="float-right">
      <button type="button" class="btn btn-second" onclick="window.history.back()">
        <i class="fa fa-backward"></i> Back
      </button>
    </div>
    </div>
    <br>
    <div class="panel-body">
      <div class="row">
        <div class="table-responsive">
          <div class="col-md-12 classic">
            <table class="table table-brodered" id="table">
              <tr>
                <th style="text-align:center; vertical-align:middle;">No</th>
                <th style="text-align:center; vertical-align:middle;">Layanan</th>
                <th style="text-align:center; vertical-align:middle;">Quantity</th>
                <th style="text-align:center; vertical-align:middle;">Harga</th>
              </tr>
              @foreach($product as $key => $val)
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
          </div>
        </div>
      </div>
      <div class="float-right">
        <div class="table-responsive">
          <div class="col-md-7 classic">
            <table class="table table-bordered table-hover" id="table2"><!-- buat triger di js #table-->
              <thead>
                <th width="30%"><center> - </center></th><th><center> - </center></th>
              </thead>
              <tbody>
                <tr>
                  <td><center>Total Biaya</center></td><td><center>{{$total}}</center></td>
                </tr>
                <tr>
                  <td><center>Total Bayar</center></td><td><input type="text" placeholder="0" style="text-align: center;"></td>
                </tr>
                <tr>
                  <td><center>Kembali</center></td><td><input type="text" placeholder="0" value="0" style="text-align: center;"></td>
                </tr>
              </tbody>
            </table>
        </div>
      </div>
      <button type="button" class="btn btn-success float-right">
              <i class="fa fa-print"></i><span class="tombol"> Proses</span>
            </button>
    </div>
    
  </div>
</div>
@endsection
@section('css')
<link rel="stylesheet" type="text/css" href="{{ asset('template/DataTables2/datatables.min.css') }}" />
<style type="text/css">
.AlignR{
  text-align: right;
}
.AlignC{
  text-align: center;
}
@media only screen and (max-width: 1026px) {
  .tombol {
    display: none;
  }
}
</style>
@endsection
@section('js')
<script type="text/javascript" src="{{ asset('template/DataTables2/datatables.min.js') }}"></script>
<script type="text/javascript">
 (function ( $ ){
  $.ajaxSetup({
    headers: {
      'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    },
  });
  // getData();
})( jQuery );
</script>
@endsection