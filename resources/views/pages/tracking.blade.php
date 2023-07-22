@extends('layouts.app')
@section('content')

    <div class="contact_form">
        <div class="container">
            <div class="row">
                <div class="col-5 offset-lg-1">
                    <div class="contact_form_title"><h4>Order Details</h4></div>
                    <ul class="list-group col-lg-12">
                        <li class="list-group-item"><b>Payment Type:</b> {{ $track->payment_type }}</li>
                        <li class="list-group-item"><b>Transection Id:</b> {{ $track->payment_id }}</li>
                        <li class="list-group-item"><b>Balance Id:</b> {{ $track->blnc_transection }}</li>
                        <li class="list-group-item"><b>Subtotal:</b> Rs. {{ $track->subtotal }}</li>
                        <li class="list-group-item"><b>Shipping:</b> Rs. {{ $track->shipping }}</li>
                        <li class="list-group-item"><b>VAT:</b> Rs. {{ $track->vat }}</li>
                        <li class="list-group-item"><b>Total:</b> Rs. {{ $track->total }}</li>
                        <li class="list-group-item"><b>Month:</b> {{ $track->month }}</li>
                        <li class="list-group-item"><b>Date:</b> {{ $track->date }}</li>
                        <li class="list-group-item"><b>Year:</b> {{ $track->year }}</li>
                    </ul>
                </div>
                <div class="col-5 offset-lg-1">
                    <div class="contact_form_title"><h4>Order Tracking</h4></div>
                    <div class="progress">
                        @if($track->status == 0)
                            <div class="progress-bar bg-danger" role="progressbar" style="width: 15%" aria-valuenow="15" aria-valuemin="0" aria-valuemax="100"></div>
                        @elseif($track->status == 1)
                            <div class="progress-bar bg-danger" role="progressbar" style="width: 15%" aria-valuenow="15" aria-valuemin="0" aria-valuemax="100"></div>
                            <div class="progress-bar bg-primary" role="progressbar" style="width: 20%" aria-valuenow="20" aria-valuemin="0" aria-valuemax="100"></div>
                        @elseif($track->status == 2)
                            <div class="progress-bar bg-danger" role="progressbar" style="width: 15%" aria-valuenow="15" aria-valuemin="0" aria-valuemax="100"></div>
                            <div class="progress-bar bg-primary" role="progressbar" style="width: 20%" aria-valuenow="20" aria-valuemin="0" aria-valuemax="100"></div>
                            <div class="progress-bar bg-info" role="progressbar" style="width: 30%" aria-valuenow="30" aria-valuemin="0" aria-valuemax="100"></div>
                            
                        @elseif($track->status == 3)
                            <div class="progress-bar bg-danger" role="progressbar" style="width: 15%" aria-valuenow="15" aria-valuemin="0" aria-valuemax="100"></div>
                            <div class="progress-bar bg-primary" role="progressbar" style="width: 20%" aria-valuenow="20" aria-valuemin="0" aria-valuemax="100"></div>
                            <div class="progress-bar bg-info" role="progressbar" style="width: 30%" aria-valuenow="30" aria-valuemin="0" aria-valuemax="100"></div>
                            <div class="progress-bar bg-success" role="progressbar" style="width: 35%" aria-valuenow="35" aria-valuemin="0" aria-valuemax="100"></div>
                        @else
                            <div class="progress-bar bg-danger" role="progressbar" style="width: 100%" aria-valuenow="100" aria-valuemin="100" aria-valuemax="100"></div>
                        @endif
                        
                    </div><br>
                    @if($track->status == 0)
                        <h5>Note: Order are Under Review</h5>
                    @elseif($track->status == 1)
                        @if($track->payment_type == 'oncash')
                            <h5>Note: Order Accept Under Process</h5>
                        @else
                            <h5>Note: Payment Accept Under Process</h5>
                        @endif
                        
                    @elseif($track->status == 2)
                        <h5>Note: Packing Done Handover Process</h5>
                    @elseif($track->status == 3)
                        <h5>Note: Order Delivered</h5>
                    @else
                        <h5>Note: Sorry, Your Order are Cancelled</h5>
                    @endif
                </div>
                
            </div>
        </div>
    </div>
    <script src="{{ asset('public/frontend/js/custom.js')}}"></script>
@endsection