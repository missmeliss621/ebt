<table >
    <thead>
        <tr>
            <td data-field="name">Name</td>
            <td data-field="address">Address</td>
            <td data-field="email"> email </td>
            <td data-field="username"> Username </td>
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
