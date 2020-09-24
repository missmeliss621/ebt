@extends('layouts.master')

@include('partials.navbar')

@section('content')

<div class="container-fluid">
    <div class="row">
        <div class="guy-img"></div>
    </div>
    <div class="row cross-row">
        <div class="hidden-xs hidden-sm col-lg-3 col-lg-offset-3">
            <div class="circle red create-shipment-steps">
                <h1>1</h1>
            </div>
        </div>
        <div class="hidden-xs hidden-sm col-lg-3">
            <div class="circle blue create-shipment-steps">
                <h1>2</h1>
            </div>
        </div>
    </div>
    <div class="row cross-text">
        <div class="hidden-xs hidden-sm col-lg-3 col-lg-offset-3">
            <p class="cross-text-red">Place cursor in the "Scan Unique Product ID" field.</p>
        </div>
        <div class="hidden-xs hidden-sm col-lg-3">
            <p class="cross-text-blue">Submit.</p>
        </div>
    </div>
</div>

<div class="container">
    <div class="row create-shipment">
        <div class="col-lg-8 col-lg-offset-2">
            {{ Form::open(array('action' => array('InventoryController@update'),'class'=>'form-group', 'method'=>'POST')) }}
            <div class="form-group">
                {{ Form::label('unique_product_id', 'Product ID') }}
                {{ Form::text('unique_product_id', null ,array('class'=>'form-control', 'placeholder'=>'Scan Product ID Barcode', 'value'=> "{{{ Input::old('product_id') }}}")) }}
            </div>
        <button type="submit" class="btn btn-primary">Update Inventory</button>
        </div>
        {{ Form::close() }}
    </div>
</div>

@stop
