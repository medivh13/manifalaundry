@extends('layouts.layout')

@section('content')
<div class="container">
  <div class="col-sm-6 col-lg-3">
    <div class="card text-white bg-flat-color-1">
      <div class="card-body pb-0">
        <h4 class="mb-0">
          <span class="count">{{$userval}}</span>
        </h4>
        <p class="text-light">Jumlah User</p>
        <div class="chart-wrapper px-0" style="height:70px;" height="70">
          <canvas id="widgetChart1"></canvas>
        </div>
      </div>
    </div>
  </div>
</div>

<div class="container">
  <div class="col-sm-6 col-lg-3">
    <div class="card text-white bg-flat-color-3">
      <div class="card-body pb-0">
        <h4 class="mb-0">
          <span class="count">{{$productval}}</span>
        </h4>
        <p class="text-light">Jumlah Product</p>
        <div class="chart-wrapper px-0" style="height:70px;" height="70">
          <canvas id="widgetChart2"></canvas>
        </div>
      </div>
    </div>
  </div>
</div>
@endsection
@section('js')
<script type="text/javascript">
/*(function ( $ ){
alert($('#cek').val());
})( jQuery );*/

</script>
@endsection
