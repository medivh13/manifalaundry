@extends('layouts.layout')

@section('content')
<div class="col-lg-12 panels" style="margin-left: -5px;margin-bottom: 25px;">
  <div class="panel panel-default">
    <div class="panel-heading">
      <strong id="title">{{$title}}</strong>
      <span class="float-right" style="margin-top: -6px;">
        <button type="button" class="btn btn-success btn-sm tambah" data-toggle="modal"><i class="fa fa-plus"></i> Add</button>
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
                  <th width="10%";>#</th>
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

<!-- <div class="modal modal-modal inmodal fade" tabindex="-1" role="dialog"  aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <form enctype="multipart/form-data" id="save_form" role="form" method="POST">
        <input type="hidden" name="_token" value="{{ csrf_token() }}">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal" ><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
        </div>
        <div class="modal-body">
          <div class="form-group">
            <div class="col-sm-9">
              <input type="hidden" class="form-control" name="id">
            </div>
          </div>
          <div class="row form-group">
            <label class="col col-md-3 form-control-label">Name</label>
            <div class="col-md-9">
              <input type="text" class="form-control name" name="name" placeholder="Customer Name">
            </div>
          </div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-white" data-dismiss="modal"><i class="fa fa-chevron-left"></i> Cancel</button>
          <button type="button" id="saving" class="btn btn-primary saving"><i class="fa fa-save"></i> Save</button>
        </div>
      </form>
    </div>
  </div>
</div> -->
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
</style>
@endsection
@section('js')
<script type="text/javascript" src="{{ asset('template/DataTables2/datatables.min.js') }}"></script>
<script type="text/javascript">
 (function ( $ ){
  getData();
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