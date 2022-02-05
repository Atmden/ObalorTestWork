<table>
    <thead>
    <tr>
        <th>Name</th>
        <th>Email</th>
        <th>Age</th>
        <th>Location</th>
        <th>Error</th>
        <th>Comment error</th>
    </tr>
    </thead>
    <tbody>
    @foreach($errors as $error)

        <tr>
            <td>{{ $error->values()['name'] }}</td>
            <td>{{ $error->values()['email'] }}</td>
            <td>{{ $error->values()['age'] }}</td>
            <td>{{ $error->values()['location'] }}</td>
            <td>{{ $error->attribute() }}</td>
            <td>{{ implode(' ',$error->errors()) }}</td>
        </tr>
    @endforeach
    </tbody>
</table>
