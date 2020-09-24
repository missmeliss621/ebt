<table class="table myTable">
    <thead>
        <tr>
            <td data-field="shipment_id">Shipment ID</td>
            <td data-field="facility">Facility</td>
            <td data-field="quantity">Product Name</td>
            <td data-field="product_code">Product Code</td>
            <td data-field="description"> Quantity </td>
        </tr>
    </thead>
    <tbody>

        @foreach($shipments as $shipment)
            @foreach($shipment->getProductsWithCount() as $pc)
                <tr>
                    <td>{{ $shipment->id }}</td>
                    <td>{{ $shipment->user->name }}</td>
                    <td>{{ $pc['product']->name }}</td>
                    <td>{{ $pc['product']->product_code }}</td>
                    <td>{{ $pc['count'] }}</td>
                </tr>
            @endforeach
        @endforeach

    </tbody>
</table>
