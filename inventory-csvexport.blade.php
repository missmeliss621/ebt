<table>
    <thead>
        <tr>
        @if(Auth::user()->is_admin)
            <td data-field="facility">Facility</td>
        @endif
        <td data-field="shipment_id">Shipment ID</td>
        <td data-field="quantity">Availability</td>
        <td data-field="donor_no">Product Code</td>
        <td data-field="description"> Product Name </td>
        <td data-field="allograft_id">Unique Product ID</td>
        <td data-field="allograft_id">Product Used Date</td>
    </tr>
    </thead>
    <tbody>
    @foreach($inventory as $inventory)
        @if(Auth::user()->is_admin)
            <tr>
                <td>
                    @foreach($users as $user)
                        @if($inventory->user_id == $user->id)
                            {{$user->name}}
                        @endif
                    @endforeach
                </td>
                <td>
                    @foreach($shipments as $shipment)
                        @if ($inventory->user_id == $shipment->user_id
                            && $inventory->created_at == $shipment->created_at)
                            {{$shipment->id}}
                        @endif
                    @endforeach
                </td>
                <td>
                    @if($inventory->is_active == 1)
                        Available
                    @else
                        Used
                    @endif
                </td>
                <td>
                    @foreach($products as $product)
                      @if($inventory->product_id == $product->id)
                        {{$product->product_code}}
                      @endif
                    @endforeach
                </td>
                <td>
                    @foreach($products as $product)
                        @if($inventory->product_id == $product->id)
                            {{$product->name}}
                        @endif
                    @endforeach
                </td>

              <td>{{$inventory->unique_product_id}}</td>

              <td>{{$inventory->used_at}}</td>
            </tr>
        @elseif($inventory->user_id == Auth::user()->id)
            <tr>
                <td>
                    @foreach($shipments as $shipment)
                        @if ($inventory->user_id == $shipment->user_id
                            && $inventory->created_at == $shipment->created_at)
                            {{$shipment->id}}
                        @endif
                    @endforeach
                </td>
                <td>
                    @if($inventory->is_active == 1)
                        Available
                    @else
                        Used
                    @endif
                </td>

                <td>
                    @foreach($products as $product)
                        @if($inventory->product_id == $product->id)
                            {{$product->product_code}}
                        @endif
                    @endforeach
                </td>

                <td>
                    @foreach($products as $product)
                        @if($inventory->product_id == $product->id)
                            {{$product->name}}
                        @endif
                    @endforeach
                </td>

                <td>{{$inventory->unique_product_id}}</td>

                <td>{{$inventory->used_at}}</td>
            </tr>
        @endif
    @endforeach


    </tbody>
</table>
