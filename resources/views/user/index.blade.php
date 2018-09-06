@extends('layouts.layout')

@section('content')
<div class="col-lg-12 panels" style="margin-left: -5px;margin-bottom: 25px;">
  <div class="panel panel-default">
    <div class="panel-heading">
      <strong id="title">{{$title}}</strong>
      <span class="pull-right" style="margin-top: -6px;">
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
                  <th width="10%";>No</th>
                  <th style="text-align:center;">Name</th>
                  <th style="text-align:center;">Email</th>
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

<div class="modal modal-modal inmodal fade" tabindex="-1" role="dialog"  aria-hidden="true">
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
              <input type="text" class="form-control name" name="name" placeholder="Name">
            </div>
          </div>
          <div class="row form-group">
            <label class="col col-md-3 form-control-label">Email</label>
            <div class="col-md-9">
              <input type="email" class="form-control name" name="email" placeholder="Email">
            </div>
          </div>
          <div class="row form-group">
            <label class="col col-md-3 form-control-label">Password</label>
            <div class="col-md-9">
              <input type="password" class="form-control name" name="password" placeholder="Password">
            </div>
          </div>
          <div class="row form-group">
            <label class="col col-md-3 form-control-label">Confirm Password</label>
            <div class="col-md-9">
              <input type="password" class="form-control name" name="password_confirmation" placeholder="Password Confirmation">
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
</div>
@endsection
@section('css')
<script type="text/javascript" src="{{ asset('template/DataTables2/datatables.min.js') }}"></script>
<link rel="stylesheet" type="text/css" href="{{ asset('template/DataTables2/datatables.min.css') }}" />
<style type="text/css">

</style>
@endsection
@section('js')
<script type="text/javascript" src="{{ asset('template/DataTables2/datatables.min.js') }}"></script>
<script>
(function ( $ ){
  $.ajaxSetup({
    headers: {
      'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    },
  });
  getData();

  $(document).off('hidden.bs.modal','.modal-modal').on('hidden.bs.modal','.modal-modal', function (e) {
    $(this)
    .find("input,textarea,select")
    .val('')
    .end();
    /*.find("input[type=checkbox], input[type=radio]")
    .prop("checked", "")
    .end();*/
  });

  $(document).off('click', '.tambah').on('click', '.tambah', function(e){
    modalShow();
  });

  $(document).off('click', '.saving').on('click', '.saving', function(e){
  $.ajax({
  url: 'user',
  type: "POST",
  data:  new FormData( $('#save_form')[0]),
  contentType: false,
  dataType: "json",
  cache: false,
  processData:false,
  success : function (response) {
  if(response){
  toastr.success('Penyimpanan Berhasil');
  $('#save_form')[0].reset();
  }else{
  toastr.danger('Penyimpanan Gagal');
  }
  },
  error   : function ( jqXhr, json, errorThrown ) {
  }
  }).done(function(json){
    reloadTable();
    modalHide();
  }).fail(function( jqXHR, json ) {

  });



  });//saving

  $(document).off('click', '.hapus').on('click', '.hapus', function(e){
    var id = $(this).attr('idt');
    if (confirm('Anda yakin ingin menghapus?')) {
      $.ajax({
        url: 'user/'+id,
        type: "DELETE",
        dataType: "JSON",
        data: {
          _method: 'DELETE',
        },
        success: function (response) {
          if(response){
            toastr.success('Hapus Berhasil');
          }else{
            toastr.danger('Hapus Gagal');
          }

        }
      });
      //location.reload();
      reloadTable();
    }
  });

  $(document).off('click', '.ubah').on('click', '.ubah', function(e){
  var id = $(this).attr('idt');
  $.ajax({
  url: 'user/'+id+'/edit',
  type: 'get',
  dataType: "JSON",
  data: {

  },
  success: function (response){
  $("[name='id']").val(response.id);
  $("[name='name']").val(response.name);
  $("[name='email']").val(response.email);
  modalShow();
  }
  });
  });//ubah


})( jQuery );

function reloadTable(){
  table.ajax.reload(null,false); //reload datatable ajax
}
function modalShow(){
  jQuery('.modal-modal').modal('show');
}
function modalHide(){
  jQuery('.modal-modal').modal('hide');
}
function getData(){
  jQuery.noConflict();
  table = jQuery('#table').DataTable({
    dom: "lBfrtip",
    processing: true,
    responsive: true,
    serverSide: true,
    destroy: true,
    bFilter:true,
    searching: true,
    order: [],
    ajax: 'user/show',

    columns: [
      {data: 'no', name: 'no', orderable: true, searchable: false},
      {data: 'name', name: 'name', orderable: true, searchable: true},
      {data: 'email', name: 'email', orderable: true, searchable: true},
      {data: 'action', name: 'action', orderable: true, searchable: true},
    ],
  });
}


</script>
@endsection
