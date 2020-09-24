@extends('layouts.master')

@include('partials.navbar')
@section('content')


  {{-- In order for page to load, URL must contain ?shipID=### When creating shipment from dashboard for supplier --}}
<?php
$shipNo=Input::get('shipNo');
?>
@foreach($shipments as $shipment)
    @if($shipNo == $shipment->id)
        @foreach($users as $user)
            @if($shipment->user_id == $user->id)
                <?php
                    $username= $user->name;
                    $userID= $user->id;
                ?>
            @endif
        @endforeach
    @endif
@endforeach

<div class="container">
    @if (Auth::User()->is_admin)
    <div class="row">
        <div class="col-md-4 col-md-offset-4">
            <img src="data:image/png;base64, {{ base64_encode(QrCode::format('png')->size(300)
                ->merge('../public/img/eb-logo-100x100.png', .15, true)->generate("ebtracker.com/inventoryAndShipmentUpdate/$shipNo")) }} ">
                <?php QrCode::size(200)->generate("$shipNo", "../public/qrcodes/$shipNo"); ?>
        </div>
    </div>
    <div class="row">
        <div class="col-md-8 col-md-offset-4">
            <p>Shipment Number: <strong>{{$shipNo}}</strong> &nbsp;&nbsp; |&nbsp;&nbsp;Delivery for: <strong>{{$username}}</strong></p>
        </div>
    </div>
    @else
    <div class="row">
        <div class="col-md-8 col-md-offset-4">
            <p style="padding-top:10rem; padding-bottom:2rem;">Shipment Number: <strong>{{$shipNo}}</strong> &nbsp;&nbsp; |&nbsp;&nbsp;Delivery for: <strong>{{$username}}</strong></p>
        </div>
    </div>
    @endif
    <div class="row">
        <div class="col-md-10 col-md-offset-1">
            <table class="table table-bordered table-striped myTable dataTable">
        <thead>
          <tr>
              <th data-field="quantity"> Quantity </th>
              <th data-field="product code"> Product Code </th>
              <th data-field="description"> Description </th>
              <th data-field="size"> Size </th>
          </tr>
        </thead>

        <tbody>

            @foreach($productsCount as $productCount)
                <tr>
                    <td>
                        {{$productCount['count'];}}
                    </td>

                    <td>
                        {{$productCount['product']->product_code;}}
                    </td>

                    <td>
                        {{$productCount['product']->name}}
                    </td>

                    <td>
                        {{$productCount['product']->size}}
                    </td>

                </tr>
            @endforeach

        </tbody>
    </table>
        </div>
    </div>
</div>

@stop
