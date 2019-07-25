@extends('partials.main')

@section('content')
<br><br><br><br><br><br>
<div class="container ">
    <h2>{{ $title }} <a href="{{ route('locations.create') }}" class="btn btn-primary" >New Location </a></h2>
    <table class="table table-striped">
        <thead>
            <tr>
                <td>#</td>
                <td>Address</td>
                <td>Edit</td>
                <td>Delete</td>
            </tr>
        </thead>
        <tbody>
            @foreach ($locations as $location)
                <tr>
                    <td>{{ $location->id }}</td>
                    <td>{{ $location->address }}</td>
                    <td><a href="{{ route('locations.edit', $location) }}" class="btn btn-info"><i class="fa fa-edit"></i></a></td>
                    <td>
                        <form action="{{ route('locations.destroy', $location) }}" method="POST">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger"><i class="fa fa-trash"></i></button>
                        </form>
                        
                </tr>
           @endforeach       
        </tbody>
    </table>

</div>


@endsection
