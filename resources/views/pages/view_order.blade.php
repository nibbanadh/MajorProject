@extends('layouts.app')
@section('content')
    <div class="contact_form">
        <div class="container">
            <div class="row">
                <div class="col-md-6">
                    <div class="card">
                        <div class="card-header"><strong>Order Details</strong></div>
                        <div class="card-body">
                            <table class="table">
                                <tr>
                                    <th>Payment Type: </th>
                                    <td>{{ $order->payment_type }}</td>
                                </tr>
                                <tr>
                                    <th>Payment Id: </th>
                                    <td>{{ $order->payment_id }}</td>
                                </tr>
                                <tr>
                                    <th>Total: </th>
                                    <td>Rs. {{ $order->total }}</td>
                                </tr>
                                <tr>
                                    <th>Month: </th>
                                    <td>{{ $order->month }}</td>
                                </tr>
                                <tr>
                                    <th>Date: </th>
                                    <td>{{ $order->date }}</td>
                                </tr>
                            </table>
                        </div>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="card">
                        <div class="card-header"><strong>Delivery Details</strong></div>
                        <div class="card-body">
                            <table class="table">
                                <tr>
                                    <th>Name: </th>
                                    <td>{{ $shipping->ship_name }}</td>
                                </tr>
                                <tr>
                                    <th>Phone: </th>
                                    <td>{{ $shipping->ship_phone }}</td>
                                </tr>
                                <tr>
                                    <th>Email: </th>
                                    <td>{{ $shipping->ship_email }}</td>
                                </tr>
                                <tr>
                                    <th>Address: </th>
                                    <td>{{ $shipping->ship_address }}</td>
                                </tr>
                                <tr>
                                    <th>City: </th>
                                    <td>{{ $shipping->ship_city }}</td>
                                </tr>
                                <tr>
                                    <th>Status: </th>
                                    <td>
                                        @if($order->status == 0)
                                            <span class="badge badge-warning">Pending</span>
                                        @elseif($order->status == 1)
                                            <span class="badge badge-info">Payment Accepted</span>
                                        @elseif($order->status == 2)
                                            <span class="badge badge-warning">In Process</span>
                                        @elseif($order->status == 3)
                                            <span class="badge badge-success">Delivered</span>
                                        @else
                                            <span class="badge badge-danger">Cancelled</span>
                                        @endif
                                    </td>
                                </tr>
                            </table>
                        </div>
                    </div>
                </div>
            </div><br><br>
            <div class="row">
                <div class="col-lg-12">
                    <div class="card pd-20 pd-sm-40">
                        <div class="card-header"><strong>Product Details</strong></div>
                        <div class="card-body">
                            <table class="table scrollable display responsive nowrap">
                                <thead>
                                <tr>
                                    <th class="wd-15p">Product Id</th>
                                    <th class="wd-15p">Product Name</th>
                                    <th class="wd-15p">Image </th>
                                    <th class="wd-20p">Color</th>
                                    <th class="wd-20p">Size</th>
                                    <th class="wd-20p">Quantity</th>
                                    <th class="wd-20p">Unit Price</th>
                                    <th class="wd-20p">Total</th>

                                </tr>
                                </thead>
                                <tbody>
                                @foreach($details as $row)
                                <tr>
                                    <td>{{ $row->product_code }}</td>
                                    <td>{{ $row->product_name }}</td>
                                    <td><img src="{{ URL::to($row->image_one) }}" height="50px;" width="50px;"></td>

                                    <td>{{ $row->color }}</td>
                                    <td>{{ $row->size }}</td>
                                    <td>{{ $row->quantity }}</td>
                                    <td>Rs. {{ $row->singleprice }}</td>
                                    <td>Rs. {{ $row->totalprice }}</td>
                                </tr>
                                @endforeach
                                </tbody>
                            </table>
                        </div><!-- table-wrapper -->

                    </div><!-- card -->
                </div>
            </div>
        </div>
    </div>  
<script src="{{ asset('public/frontend/js/custom.js')}}"></script>  
@endsection