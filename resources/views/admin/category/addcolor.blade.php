@extends('layouts.admin')

@section('main-content position-relative max-height-vh-100 h-100 border-radius-lg')
    <div class="card">
        <div class="card-header">
            <h4>Add Color</h4>
        </div>
        <div class="card-body">
            <form action="{{url('insert-color')}}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="row">
                    <div class="col-md-6 mb-3">
                        <label for="">Name</label>
                        <input type="text" class="form-control" name="name">
                    </div>
                    <div class="col-md-6 mb-3">
                        <label for="">Code</label>
                        <input type="text" class="form-control" name="code">
                    </div>
                    <div class="col-md-12">
                        <button type="submit" class="btn btn-primary">Submit</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
@endsection
