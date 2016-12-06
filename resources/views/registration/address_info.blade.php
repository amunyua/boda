<form action="" method="post" class="">
    <a href="#add-address" class="btn btn-sm btn-labeled btn-primary data-toggle">
        <span class="btn-label"><i class="glyphicon glyphicon-plus-sign"></i></span>Add Address
    </a><br><br>

    <table id="table1" class="table table-hover">
        <thead>
        <tr>
            <th>Address#</th>
            <th>County</th>
            <th>Town</th>
            <th>Postal Address</th>
            <th>Address Type</th>
            <th>Address Type</th>
            <th>Phone#</th>
            <th>Edit</th>
            <th>Delete</th>
        </tr>
        </thead>
        <tbody>
        @if(count($addresses))
            @foreach($addresses as $address)
                <tr>
                    <td>{{ $address->id }}</td>
                    <td>{{ $address->county }}</td>
                    <td>{{ $address->city }}</td>
                    <td>{{ $address->postal_address }}</td>
                    <td>{{ $address->physical_address }}</td>
                    <td>{{ $address->physical_address }}</td>
                    <td>{{ $address->phone_no }}</td>
                    <td><a href="#edit_address" edit-id="{{ $address->id }}" action="{{ url('update-address/'.$address->id) }}" class="btn btn-xs btn-success edit_address" data-toggle="modal">Edit</a> </td>
                    <td><form method="post" action="{{ url('/delete-address/'.$address->id) }}">
                            {{ csrf_field() }}
                            <input type="hidden" name="masterfile_id" value="{{ $mf->id }}">
                            <input type="submit" name="DELETE" value="Delete" class="btn btn-danger btn-xs delete_address">
                            {{ method_field('DELETE') }}
                        </form>
                    </td>
                </tr>
            @endforeach
        @endif
        </tbody>
    </table>
</form>
