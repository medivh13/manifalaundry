@extends('layouts.layout')

@section('content')
<div class="col-lg-12 panels" style="margin-left: -5px;margin-bottom: 25px;">
  <div class="panel panel-default">
    <div class="panel-heading">
      <strong id="title">{{$title}}</strong>
    </div>
    <br>
    <div class="panel-body">
      <div class="row">
        <div class="table-responsive">
          <div class="col-md-12 classic">
            <table class="table table-bordered table-hover" id="table"><!-- buat triger di js #table-->
              <thead>
                <tr>
                  <th width="5%";>#</th>
                  <th style="text-align:center;">Code</th>
                  <th style="text-align:center;">Customer</th>
                  <th style="text-align:center;">Order</th>
                  <th style="text-align:center;">Finish</th>
                  <th style="text-align:center;">Action</th>
                </tr>
              </thead>
            </table>
          </div>
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
<script type="text/javascript" src="{{ asset('template/DataTables2/datatables.min.js') }}"></script>
<script type="text/javascript">
 (function ( $ ){
  $.ajaxSetup({
    headers: {
      'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    },
  });
  getData();

  $(document).off('click', '.cetak').on('click', '.cetak', function(){
    // alert($(this).attr('idt'));
    cetak($(this).attr('idt'));
  });

})( jQuery );

function reloadTable(){
  table.ajax.reload(null,false); //reload datatable ajax
}
function getData(){
  jQuery.noConflict();
  table = jQuery('#table').DataTable({
    dom: "lBfrtip",
    processing: true,
    serverSide: true,
    responsive: true,
    destroy: true,
    bFilter:true,
    searching: true,
    order: [],
    ajax: 'pay/show',

    columns: [
    {data: 'nomor',name: 'nomor',orderable: false, searchable: false, render: function(data, type, row, meta) {  return meta.row + meta.settings._iDisplayStart + 1; }},
    {data: 'code', name: 'code', orderable: true, searchable: true},
    // {data: 'customer', name: 'customer', orderable: true, searchable: true,  sClass: "AlignR"},
    {data: 'customer', name: 'customer', orderable: true, searchable: true},
    {data: 'created_at', name: 'created_at', orderable: true, searchable: true},
    {data: 'tgl_selesai', name: 'tgl_selesai', orderable: true, searchable: true},
    // {data: 'status', name: 'status', orderable: true, searchable: true},
    {data: 'action', name: 'action', orderable: false, searchable: false},
    ],
  });
}
function cetak(id){
  jQuery.ajax({
    type: 'GET',
    url: 'order/cetak/'+id,
    dataType: "JSON",
    data: {},
    success: function(response){
      // jQuery("[name='code']").val(response);
      reloadTable();
      toastr.success('Cetak Pembayaran Berhasil');
    }
  });
}

</script>
@endsection