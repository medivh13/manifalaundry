@extends('layouts.layout')
@section('content')
<form id="jxForm" novalidate="novalidate" method="POST" action="{{ route('product.store') }}" enctype="multipart/form-data">
{{ csrf_field() }}

<div class="animate fadeIn">
<div class="row">
  <div class="col-lg-2"></div>
  <div class="col-md-8">
    <p>
      <button type="button" class="btn btn-primary" onclick="window.history.back()">
        <i class="fa fa-backward"></i>&nbsp; Back to List
      </button>
    </p>
    <div class="card">
      <div class="card-header">
        <i class="fa fa-align-justify"></i> Add New Service
      </div>
      <div class="card-body">
        <div class="form-group">
          <div class="option-card">
            <div class="form-group">
              <label class="col-form-label" for="name">Name
              </label>
              <input type="text" class="form-control" id="name" name="name" placeholder="Name" aria-describedby="name-error">
              <em id="name-error" class="error invalid-feedback">Please enter a service name</em>
            </div>
            <div class="form-group">
              <label class="col-form-label" for="harga">Harga
              </label>
              <input type="text" class="form-control" id="harga" name="harga" placeholder="" aria-describedby="harga-error">
              <em id="harga-error" class="error invalid-feedback">Please enter a price</em>
            </div>

            <div class="modal-footer">
              <button type="button" class="btn btn-secondary" onclick="window.history.back()">
                <i class="fa fa-times-rectangle"></i>&nbsp; Cancel
              </button>
              <button type="submit" class="btn btn-primary" value="Sign up">Save</button>
            </div>
          </div>
        </div>
      </div>
    </div>
</form>
@endsection
@section('css')

@endsection
@section('js')

<script>
(function ( $ ){

  $('#harga').keypress(validateNumber);

  

  $("#jxForm").validate({
    rules:{
      name:{required:true},
      harga:{required:true},
    },
    messages:{
      name:{
        required:'Please Input Product Name',
        //minlength:'Name must consist of at least 2 characters'
      },
      harga:{
        required:'Please Input Price',
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

})( jQuery );

</script>

@endsection
