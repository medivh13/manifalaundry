@extends('layouts.layout')

@section('content')
<div class="col-lg-12 panels" style="margin-left: -5px;margin-bottom: 25px;">
  <div class="panel panel-default">
    <div class="panel-heading">
      <strong id="title">{{$title}}</strong>
      <span class="float-right" style="margin-top: -6px;">
        <a class="btn btn-success btn-sm tambah" href="{{route('product.create')}}"><i class="fa fa-plus"></i><span class="tombol"> Add</span></a>
      </span>
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
    </div>
    <div class="float-right">
      <button type="button" class="btn btn-second" onclick="window.history.back()">
        <i class="fa fa-backward"></i>&nbsp; Back
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

// function reloadTable(){
//   table.ajax.reload(null,false); //reload datatable ajax
// }
// function getData(){
//   jQuery.noConflict();
//   table = jQuery('#table').DataTable({
//     dom: "lBfrtip",
//     processing: true,
//     serverSide: true,
//     responsive: true,
//     destroy: true,
//     bFilter:true,
//     // searching: true,
//     order: [],
//     // ajax: 'monitoring-order/show',

//     // columns: [
//     // {data: 'nomor',name: 'nomor',orderable: false, searchable: false, render: function(data, type, row, meta) {  return meta.row + meta.settings._iDisplayStart + 1; }},
//     // {data: 'code', name: 'code', orderable: true, searchable: true},
//     // // {data: 'customer', name: 'customer', orderable: true, searchable: true,  sClass: "AlignR"},
//     // {data: 'customer', name: 'customer', orderable: true, searchable: true},
//     // {data: 'status', name: 'status', orderable: true, searchable: true},
//     // {data: 'created_at', name: 'created_at', orderable: true, searchable: true},
//     // {data: 'tgl_selesai', name: 'tgl_selesai', orderable: true, searchable: true},
//     // {data: 'action', name: 'action', orderable: false, searchable: false},
//     // ],
//   });
// }
</script>
@endsection