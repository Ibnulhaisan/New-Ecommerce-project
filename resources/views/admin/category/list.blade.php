@extends('layouts.admin')

@section('main-content position-relative max-height-vh-100 h-100 border-radius-lg')
    <div class="card">
        <div class="card-header">
            <h4>Colors Page</h4>
            <hr>
        </div>
        <div class="card-body">
            <table class="table table-bordered table-striped">
                <thead>
                <tr>
                    <th>Id</th>
                    <th>Name</th>
                    <th>Code</th>
                </tr>
                </thead>
                <tbody>
                @foreach($colors as $item)
                    <tr>
                        <td>{{ $item->id }}</td>
                        <td>{{ $item->name }}</td>
                        <td>{{ $item->code }}</td>
                        <td>
                            <a href="{{ url('edit-color/'.$item->id) }}" class="btn btn-primary">Edit</a>
                            <a href="{{ url('delete-color/'.$item->id) }}" class="btn btn-danger">Delete</a>
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>
    </div>
@endsection
