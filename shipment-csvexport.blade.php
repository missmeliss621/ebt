<table>
    <thead>
        <tr>
            <td data-field="shipment_id">Shipment ID</td>
            @if(Auth::user()->is_admin)
                <th data-field="facility">Facility</th>
            @endif
            <td data-field="quantity">Shipping Date</td>
            <td data-field="description"> Received Date </td>
        </tr>
    </thead>
    <tbody>
        @foreach($shipments as $shipment)
            @if(Auth::user()->is_admin)
                <tr>
                    <td> {{$shipment->id}}</td>
                    <td>
                        @foreach($users as $user)
                            @if($shipment->user_id == $user->id)
                                 {{$user->name}}
                             @endif
                        @endforeach
                    </td>
                    <td> {{$shipment->shipped_date}} </td>
                    <td> {{$shipment->recieved_date}} </td>
                </tr>
            @elseif($shipment->user_id == 1)
                <tr>
                    <td> {{$shipment->id}}</td>
                    <td> {{$shipment->shipped_date}} </td>
                    <td> {{$shipment->recieved_date}} </td>
                </tr>
            @endif
        @endforeach
    </tbody>
</table>
