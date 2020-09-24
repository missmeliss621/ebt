@extends('layouts.master')

@include('partials.navbar')

@section('content')

<div class="container-fluid">
    <div class="row">
        <div class="girl-img"></div>
    </div>
    <div class="row cross-row">
        <div class="hidden-xs hidden-sm col-md-12">
            <div class="row">
                <div class="col-md-4">
                    <div class="circle red create-shipment-steps">
                        <h1>1</h1>
                    </div>
                </div>
                <div class="hidden-xs hidden-sm col-md-4">
                    <div class="circle blue create-shipment-steps">
                        <h1>2</h1>
                    </div>
                </div>
                <div class="hidden-xs hidden-sm col-md-4">
                    <div class="circle grey create-shipment-steps">
                        <h1>3</h1>
                    </div>
                </div>
            </div>

            <div class="row cross-text">

                <div class="hidden-xs hidden-sm col-md-4">
                    <p class="cross-text-red">Enter the facility's username.<br>Enter the product code.</p>

                </div>
                <div class="hidden-xs hidden-sm col-md-4">
                    <p class="cross-text-blue">Place cursor in the "Scan Unique Product ID" field. Add more fields as needed.</p>
                </div>
                <div class="hidden-xs hidden-sm col-md-4">
                    <p class="cross-text-grey">Submit.</p>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="container">
    <div class="row create-shipment">
        <div class="col-md-8 col-md-offset-2">
            {{ Form::open(array('action' => 'ShipmentsController@createShipment','class'=>'form-group')) }}
        <div class="form-group">
            {{ Form::text('username', null, array('class'=>'form-control form-margin','name'=>'username', 'placeholder'=>'username', 'value'=>"{{{ Input::old('username') }}}")) }}

            {{ Form::text('product_code', null, array('class'=>'form-control form-margin','name'=>'product_code[]', 'placeholder'=>'Enter Product Code', 'value'=>"{{{ Input::old('company_name') }}}")) }}

            {{ Form::text('unique_product_id', null, array('class'=>'form-control form-margin','name'=>'unique_product_id[]', 'placeholder'=>'Scan Unique Product ID Here', 'value'=>"{{{ Input::old('unique_product_id') }}}"))}}
        </div>

        <div class="input_fields_wrap">
            <div class="form-group"><input type="hidden" name="mytext[]"></div>
        </div>

        <button class="add_field_button btn btn-primary">Add More Fields</button>
        <button type="submit" class="btn btn-primary">Submit New Shipment</button>

            {{ Form::close() }}


        </div>
    </div>
</div>


@stop

@section('bottomscript')
    {{ HTML::script('js/addentryforms.js') }}
@stop
