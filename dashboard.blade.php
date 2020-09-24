@extends('layouts.master')

@include('partials.navbar')

@section('content')

<div class="container-fluid">
    <div class="row">
        <div class="col-md-6">
            <h3 class="hidden-sm hidden-xs header_name">{{Auth::user()->name}} Dashboard</h3>
        </div>
        <div id="auth-logo" class="col-md-4 col-md-offset-2">
            <img class="pull-right" src="{{Auth::user()->image_url}}" width="242" height="64">
        </div>
    </div>
</div>

<div class="container-fluid">
    <div class="row table-background">
        <div class="col-md-6">
            <div class="panel panel-default">
                <div class="panel-heading no-pad">
                    <div class="col-md-4 some-pad">
                        <p>Shipment History</p>
                    </div>
                </div>
                <table class="table myTable">
                    <thead>
                        <tr>
                            <th data-field="shipment_id"> (Click ID <br /> for more info) <br /> <br />Shipment ID</th>
                            @if(Auth::user()->is_admin)
                                <th data-field="facility">Facility</th>
                            @endif
                            <th data-field="quantity">Shipping Date</th>
                            <th data-field="description"> Recieved Date </th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($shipments as $shipment)
                        {{-- Need to make user id variable based on logged in user --}}
                        @if(Auth::user()->is_admin)
                        <tr>
                            <td>

                                <a href="/qr?shipNo={{$shipment->id}}"> {{$shipment->id}} </a>

                                @if($shipment->shipped_date == "0000-00-00 00:00:00" &&
                                $shipment->recieved_date == "0000-00-00 00:00:00")
                                    <span class="label label-default pull-right">At Supplier</span>
                                @elseif($shipment->shipped_date != "0000-00-00 00:00:00" &&
                                $shipment->recieved_date == "0000-00-00 00:00:00")
                                    <span class="label label-warning pull-right">In Transit</span>
                                @elseif($shipment->shipped_date != "0000-00-00 00:00:00" &&
                                $shipment->recieved_date != "0000-00-00 00:00:00")
                                    <span class="label label-success pull-right">Recieved</span>
                                @elseif($shipment->shipped_date == "0000-00-00 00:00:00" &&
                                $shipment->recieved_date != "0000-00-00 00:00:00")
                                    <span class="label label-success pull-right">Recieved</span>
                                @endif

                            <td>
                                @foreach($users as $user)
                                    @if($shipment->user_id == $user->id)
                                         {{$user->name}}
                                     @endif
                                @endforeach
                            </td>

                            <td>
                                @if($shipment->shipped_date == "0000-00-00 00:00:00")
                                        --
                                @else
                                    {{date('D, M d, Y ', strtotime($shipment->shipped_date))}}
                                @endif
                            </td>
                            <td>
                                @if($shipment->recieved_date == "0000-00-00 00:00:00")
                                    --
                                @else
                                    {{date('D, M d, Y ', strtotime($shipment->recieved_date))}}
                                @endif
                              </td>
                        </tr>
                        @elseif($shipment->user_id == Auth::user()->id)
                        <tr>
                            <td>

                                <a href="/qr?shipNo={{$shipment->id}}"> {{$shipment->id}} </a>

                                    @if($shipment->shipped_date == "0000-00-00 00:00:00" &&
                                    $shipment->recieved_date == "0000-00-00 00:00:00")
                                        <span class="label label-default pull-right">At Supplier</span>
                                    @elseif($shipment->shipped_date != "0000-00-00 00:00:00" &&
                                    $shipment->recieved_date == "0000-00-00 00:00:00")
                                        <span class="label label-warning pull-right">In Transit</span>
                                    @elseif($shipment->shipped_date != "0000-00-00 00:00:00" &&
                                    $shipment->recieved_date != "0000-00-00 00:00:00")
                                        <span class="label label-success pull-right">Recieved</span>
                                    @elseif($shipment->shipped_date == "0000-00-00 00:00:00" &&
                                    $shipment->recieved_date != "0000-00-00 00:00:00")
                                        <span class="label label-success pull-right">Recieved</span>
                                    @endif

                            </td>
                            <td>
                                @if($shipment->shipped_date == "0000-00-00 00:00:00")
                                    --
                                @else
                                    {{date('D, M d, Y ', strtotime($shipment->shipped_date))}}
                                @endif
                            </td>
                            <td>
                                @if($shipment->recieved_date == "0000-00-00 00:00:00")
                                    --
                                @else
                                    {{date('D, M d, Y ', strtotime($shipment->recieved_date))}}
                                @endif
                            </td>
                        </tr>
                        @endif
                        @endforeach
                    </tbody>
                </table>
                <div class="export">
                {{ HTML::linkAction('ShipmentsController@exportShipmentHistory', 'Export Shipment History', array(), array('class' => 'btn')) }}
                </div>
            </div>
        </div>
        <div class="col-md-6">
            <div class="panel panel-default">
                <div class="panel-heading no-pad">
                    <div class="col-sm-6 col-lg-6 some-pad">
                        <p>Current Inventory</p>
                    </div>
                </div>
                <table class="table myTable">
                    <thead>
                        <tr>
                            @if(Auth::user()->is_admin)
                                <th data-field="quantity">Facility</th>
                            @endif
                            <th data-field="donor_no">Product Code</th>
                            <th data-field="description"> Product Name </th>
                            <th data-field="allograft_id">Unique Product ID</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($inventory as $inventory)
                            @if(Auth::user()->is_admin)
                                @if($inventory->is_active)
                                    <tr>
                                        <td>
                                            @foreach($users as $user)
                                                @if($inventory->user_id == $user->id)
                                                    {{$user->name}}
                                                @endif
                                            @endforeach
                                        </td>
                                        @foreach($products as $product)
                                            @if($inventory->product_id == $product->id)
                                                <td>
                                                    {{$product->product_code}}
                                                </td>
                                                <td>
                                                    {{$product->name}}
                                                </td>
                                                <td>
                                                    {{$inventory->unique_product_id}}
                                                </td>
                                            @endif
                                        @endforeach
                                    </tr>
                                @endif
                            @elseif($inventory->user_id == Auth::user()->id)
                                @if($inventory->is_active)
                                    <tr>
                                        @foreach($products as $product)
                                            @if($inventory->product_id == $product->id)
                                                <td>
                                                    {{$product->product_code}}
                                                </td>
                                                <td>
                                                    {{$product->name}}
                                                </td>
                                                <td>
                                                    {{$inventory->unique_product_id}}
                                                </td>
                                            @endif
                                        @endforeach
                                    </tr>
                                @endif
                            @endif
                        @endforeach
                    </tbody>
                </table>
            <div class="export">
                {{ HTML::linkAction('InventoryController@exportInventoryHistory', 'Export Inventory History', array(), array('class' => 'btn')) }}
            </div>
            </div>
        </div>
    </div>
    <div class="row table-background">
        @if(Auth::user()->is_admin)
            <div class="col-md-6">
                <div class="panel panel-default">
                    <div class="panel-heading no-pad">
                        <div class="col-md-4 some-pad">
{{-- Table below shows users, only available to supplier and distributor --}}
                            <div>
                                <p>Users</p>
                            </div>
                        </div>
                    </div>
                    <table class="table myTable">
                        <thead>
                            <tr>
                                <th data-field="name">Name</th>
                                <th data-field="address">Address</th>
                                <th data-field="email"> email </th>
                                <th data-field="username"> Username </th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($users as $user)
                                <tr>
                                    <td> {{$user->name}}</td>
                                    <td> {{$user->address}} </td>
                                    <td> {{$user->email}} </td>
                                    <td> {{$user->username}} </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                    <div class="export">
                    {{ HTML::linkAction('UsersController@exportUsers', 'Export Users', array(), array('class' => 'btn')) }}
                    </div>
                </div>
            </div>
        @endif
        @if(Auth::user()->is_admin)
            <div class="col-md-6">
                <div class="panel panel-default">
                    <div class="panel-heading no-pad">
                        <div class="col-md-4 some-pad">
                            <div>
                                <p>Sales</p>
                            </div>
                        </div>
                    </div>
                    <!-- Table below shows sales for distributor and supplier  -->
                    <table class="table myTable">
                        <thead>
                            <tr>
                                <th data-field="shipment_id">Shipment ID</th>
                                <th data-field="facility">Facility</th>
                                <th data-field="quantity">Product Name</th>
                                <th data-field="product_code">Product Code</th>
                                <th data-field="description"> Quantity </th>
                            </tr>
                        </thead>
                        <tbody>

                        @foreach($shipments as $shipment)
                            @foreach($shipment->getProductsWithCount() as $pc)
                                <tr>
                                    <td>
                                        <a href="/qr?shipNo={{$shipment->id}}"> {{$shipment->id}} </a>
                                    </td>
                                    <td>{{ $shipment->user->name }}</td>
                                    <td>{{ $pc['product']->name }}</td>
                                    <td>{{ $pc['product']->product_code }}</td>
                                    <td>{{ $pc['count'] }}</td>
                                </tr>
                            @endforeach
                        @endforeach

                        </tbody>
                    </table>

                    <div class="export">
                    {{ HTML::linkAction('ProductShipmentsController@exportSales', 'Export Sales', array(), array('class' => 'btn')) }}
                    </div>
        @endif

                </div>
            </div>
    </div>
</div>
<div class="container sales-rep">
    <div class="row">
        <div class="col-md-1">
            <img src="img/glenn-jordan-headshot.jpg" width="70" height="70">
        </div>
        <div class="col-md-11">
            <p>Your support contact is:</h4>
            <p>Glenn Jordan</h5>
            <p>Sales, Eventus Biologics</p>
            <p>
                <a href="tel:210.420.4020">210.420.4020</a>
            </p>
        </div>
    </div>
</div>

@stop

@section ('bottomscript')
<script>
    $(document).ready(function(){
        $('.myTable').DataTable();
    });
</script>
@stop
