@extends('layouts.layout')

@section('content')
  <div class="col-sm-12">
    <div class="col-sm-6 col-lg-3">
      <div class="card text-white bg-flat-color-1">
        <div class="card-body pb-0">
          <h4 class="mb-0">
            <span class="count">{{$userval}}</span>
          </h4>
          <p class="text-light">Jumlah User</p>
          <div class="chart-wrapper px-0" style="height:70px;" height="70"><iframe class="chartjs-hidden-iframe" tabindex="-1" style="display: block; overflow: hidden; border: 0px; margin: 0px; top: 0px; left: 0px; bottom: 0px; right: 0px; height: 100%; width: 100%; position: absolute; pointer-events: none; z-index: -1;"></iframe>
            <canvas id="widgetChart1" height="140" width="996" style="display: block; width: 498px; height: 70px;"></canvas>
          </div>
        </div>
      </div>
    </div>
    <div class="col-sm-6 col-lg-3">
      <div class="card text-white bg-flat-color-3">
        <div class="card-body pb-0">
          <h4 class="mb-0">
            <span class="count">{{$productval}}</span>
          </h4>
          <p class="text-light">Jumlah Layanan</p>
          <div class="chart-wrapper px-0" style="height:70px;" height="70"><iframe class="chartjs-hidden-iframe" tabindex="-1" style="display: block; overflow: hidden; border: 0px; margin: 0px; top: 0px; left: 0px; bottom: 0px; right: 0px; height: 100%; width: 100%; position: absolute; pointer-events: none; z-index: -1;"></iframe>
            <canvas id="widgetChart2" height="218" width="938" style="display: block; width: 469px; height: 109px;"></canvas>
          </div>
        </div>
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
<script type="text/javascript">
/*(function ( $ ){
alert($('#cek').val());
})( jQuery );*/

</script>
@endsection
