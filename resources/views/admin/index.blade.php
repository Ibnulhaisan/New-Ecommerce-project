@extends('layouts.admin')

@section('main-content position-relative max-height-vh-100 h-100 border-radius-lg')
    <div class="card">
        <div class="card-body">

        </div>
        <div class="d-flex flex-wrap">
        <div class="card-footer position-relative d-flex align-items-center justify-content-center"  style="width: 275px; height: 10px; background-color: #1662c5; margin-right: 50px; margin-left: 30px; margin-bottom: 50px; margin-top: 30px">
            <h6 style="color: #FFFFFF">Total Categories: {{$categoryCount}}</h6>
        </div>
        <br>
        <div class="card-footer d-flex align-items-center justify-content-center"  style="width: 275px; height: 10px; background-color: #52637e; margin-right: 50px; margin-top: 30px; ">
            <h6 style="color: #FFFFFF">Total Products: {{$productCount}} </h6>
        </div>
        <br>
        <div class="card-footer position-relative d-flex align-items-center justify-content-center"  style="width: 275px; height: 10px; background-color: #FFA726; margin-right: 50px;margin-top: 30px">
            <h6 style="color: #FFFFFF">Total users: {{$userCount}}</h6>
        </div>
        <br>
        <div class="card-footer position-relative d-flex align-items-center justify-content-center"  style="width: 275px; height: 10px; background-color: #13a3d2; margin-right: 50px; margin-left: 30px ; margin-bottom: 50px">
            <h6 style="color: #FFFFFF">Total Orders: {{$orderCount}}</h6>
        </div>
        <br>
        <div class="card-footer position-relative d-flex align-items-center justify-content-center"  style="width: 275px; height: 10px; background-color: #49a3f1; margin-right: 50px;">
            <h6 style="color: #FFFFFF">Pending Orders: {{$pendingOrderCount}}</h6>
        </div>
        <br>
        <div class="card-footer position-relative d-flex align-items-center justify-content-center"  style="width: 275px; height: 10px; background-color: #c1134e; margin-right: 50px;">
            <h6 style="color: #FFFFFF">Complete Orders: {{$completeOrderCount}}</h6>
        </div>
    </div>
    </div>

@endsection
