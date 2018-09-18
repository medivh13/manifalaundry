@extends('layouts.layout')

@section('content')
<div class="col-lg-12 panels" style="margin-left: -5px;margin-bottom: 25px;">
  <div class="panel panel-default">
    <div class="panel-heading">
      <strong id="title">{{$title}}</strong>
      <span class="float-right" style="margin-top: -6px;">
        <!-- <button type="button" class="btn btn-success btn-sm tambah" data-toggle="modal"><i class="fa fa-plus"></i> Add</button> -->
        <a href="{{URL('admin/order')}}" class="btn btn-secondary">
          <i class="fa fa-refresh"></i> New</a>
        
      </span>
    </div>
    <br>
    <form id="jxForm" novalidate="novalidate" method="POST" action="{{ URL('admin/order') }}" enctype="multipart/form-data">
      {{ csrf_field() }}
      <div class="panel-body">
        <div class="col-lg-6">
          <div class="form-group">
            <label for="date" class="control-label mb-1">Order's Date</label>
            <input id="date" type="text" class="form-control date" name="date" placeholder="Pick Date" value="{{$tanggal}}" readonly>
          </div>
          <div class="form-group">
            <label for="code" class="control-label mb-1">Code</label>
            <input id="code" type="text" class="form-control" name="code" placeholder="Order's Code"  value="{{$code}}"readonly>
          </div>
          <div class="form-group">
            <label for="customer" class="control-label mb-1">Customer</label>
            <input id="customer" type="text" class="form-control customer" name="customer" placeholder="Customer Name">
            <em id="customer-error" class="error invalid-feedback">Please input a Customer</em>
          </div>
          <div class="form-group">
            <label for="alamat" class="control-label mb-1">Alamat</label>
            <input id="alamat" type="text" class="form-control alamat" name="alamat" placeholder="Alamat Customer">
            <em id="alamat-error" class="error invalid-feedback">Please input a Address</em>
            <label for="telp" class="control-label mb-1">No. HP</label>
            <input id="telp" type="text" class="form-control telp" name="telp" placeholder="No. HP yg bisa dihubungi">
            <em id="telp-error" class="error invalid-feedback">Please input a Phone Number</em>
          </div>
          <div class="form-group">
            <label for="customer" class="control-label mb-1">Keterangan</label>
            <input id="keterangan" type="text" class="form-control created_at" name="keterangan" placeholder="Keterangan">
          </div>
        </div>
      </div>
      <div class = "col-lg-6">
        <div class="form-group">
          <div class="col-sm-12">
            <select name="product_id" class="form-control product_id" data-placeholder="Pilih Layanan">
              @foreach ($product as $key => $val)
              <option value="{{$val->id}}">{{ ucwords($val->name) }}</option>
              @endforeach
            </select>
          </div>
        </div><br><br>
        <div class="form-group">
          <div class="col-md-12">
            <button type="button" id="add_prod" class="btn btn-info btn-xs float-right add_prod"><i class="fa fa-plus"></i></button><br><br>
            <table class="table table-bordered table-hover table3">
              <thead>
                <tr>
                  <th width="10%";>No</th>
                  <th style="text-align:center;">Layanan</th>
                  <th style="text-align:center;">Quantity</th>
                  <th style="text-align:center;">Action</th>
                </tr>
              </thead>
              <tbody>
              </tbody>
            </table>
            <button type="submit" id="saving" class="btn btn-primary btn-sm float-right saving"><i class="fa fa-save"></i> Submit</button>
          </div>
        </div>
      </div>
    </form>
  </div>
</div>
</div>
@endsection

@section('js')
<script>
  (function ( $ ){

    var array_prod = [];
    var index =0;
    var prod ='';

    $.ajaxSetup({
      headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
      },
    });
    $('.customer').focus();
    $('.telp').keypress(validateNumber);

  // $('.created_at').datepicker({
  //   format: "yyyy-mm-dd",
  //   autoclose: true,
  //   todayHighlight: true,
  //   orientation: "auto"
  // });

  // $(document).off("change",".created_at").on("change", ".created_at", function() {
  //   codegen($(this).val());
  // });
  //codegen();

  $(document).off('click', '.add_prod').on('click', '.add_prod', function(e){
    // alert('cek');
    var tbl = $('.table3');
    if(array_prod.includes($('.product_id').val())){
      // alert('Please Choose Another Product');
      toastr.error('Service Already Chosen, Please Choose Another');
      return false;
    }else{
      array_prod.push($('.product_id').val());
      index = index +1;
      prod = prodname($('.product_id').val());
    }
    tbl.find('tbody').append(
      '<tr>'+
      '<td class="nomor">'+index+'</td>'+
      '<center><td>'+prod+' <input type="hidden" class="form-control" name="product[]" value="'+$('.product_id').val()+'"></td></center>'+
      '<center><td><input type="text" class="form-control" name="amount[]" id="amount"><em id="amount-error" class="error invalid-feedback">Please input an Amount</em></td></center>'+
      '<td><center>'+
      '<button type="button" data-match="'+$('.product_id').val()+'" class="btn btn-xs btn-danger remove_prod"><i class="fa fa-trash"></i></button>'+
      '</center></td>'+
      '</tr>'
      );
    $('#amount').keypress(validateNumber);
  });

  $(document).off('click', '.remove_prod').on('click', '.remove_prod', function(){
    for(var i = array_prod.length; i--;) {
      if(array_prod[i] === $(this).attr('data-match')) {
        array_prod.splice(i, 1);
      }
    }
    $(this).closest('tr').detach();
    index = index - 1;
  });
  // $(document).off('keypress', '#amount').on('keypress', '#amount', function(){
  //   validateNumber()
  // });
   

  $("#jxForm").validate({
    rules:{
      customer:{required:true},
      telp:{required:true},
      alamat:{required:true},
      amount:{required:true},
    },
    messages:{
      customer:{
        required:'Please Input Customer Name',
        //minlength:'Name must consist of at least 2 characters'
      },
      telp:{
        required:'Please Input Phone Number',
        //minlength:'Name must consist of at least 2 characters'
      },
      alamat:{
        required:'Please Input Customer Address',
        //minlength:'Name must consist of at least 2 characters'
      },
      amount:{
        required:'Please Input Amount',
        //minlength:'Name must consist of at least 2 characters'
      },
    },
    errorElement:'em',
    errorPlacement:function(error,element){
      error.addClass('invalid-feedback');
    },
    highlight:function(element,errorClass,validClass){
      $(element).addClass('is-invalid').removeClass('is-valid');
    },
    unhighlight:function(element,errorClass,validClass){
      $(element).addClass('is-valid').removeClass('is-invalid');
    }
  });

  $('#jxForm').submit(function(){
    let _this = $(this)
    setTimeout(function(){
      _this[0].reset()
      $('.table3').find('tbody').html('');
      toastr.success('Order Berhasil');
    }, 1500)
  })

})( jQuery );

function prodname(id){
  var name ='';
  jQuery.ajax({
    async: false,
    type: 'GET',
    url: 'order/prodname/'+id,
    dataType: "JSON",
    data: {},
    success: function(response){
      name = response.name;
    }
  });
  name = name.toLowerCase().replace(/\b[a-z]/g, function(letter) {
    return letter.toUpperCase();
  });
  return name;
}

function codegen(){
  jQuery.ajax({
    type: 'GET',
    url: 'order/codegen/'+ jQuery('#date').val(),
    dataType: "JSON",
    data: {},
    success: function(response){
      jQuery("[name='code']").val(response);
    }
  });
}
</script>
@endsection