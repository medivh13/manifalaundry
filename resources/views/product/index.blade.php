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
            <table class="table table-bordered table-hover" id="table"><!-- buat triger di js #table-->
              <thead>
                <tr>
                  <th width="5%";>#</th>
                  <th style="text-align:center;">Name</th>
                  <th style="text-align:center;">Price</th>
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
  $(document).off('click', '.hapus').on('click', '.hapus', function(e){
    var id = $(this).attr('idt');
    swal({
      title: "Are you sure?",
      text: "Once deleted, you will not be able to recover this!",
      icon: "warning",
      buttons: true,
      dangerMode: true,
    })
    .then((willDelete) => {
      if (willDelete) {
        $.ajax({
          url: 'product/'+id,
          type: "DELETE",
          dataType: "JSON",
          data: {
            _method: 'DELETE',
          },
          success: function () {
            swal("Item Deleted", {
              icon: "success",
            });
            reloadTable();
          }
        });
      }else{
        swal("Delete Cancel");
      }
    });
  });//hapus


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
    ajax: 'product/show',

    columns: [
    {data: 'nomor',name: 'nomor',orderable: false, searchable: false, render: function(data, type, row, meta) {  return meta.row + meta.settings._iDisplayStart + 1; }},
    {data: 'name', name: 'name', orderable: true, searchable: true},
    {data: 'harga', name: 'harga', orderable: true, searchable: true,  sClass: "AlignR"},
    {data: 'action', name: 'action', orderable: true, searchable: true},
    ],
  });
}
</script>
@endsection