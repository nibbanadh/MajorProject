@extends('admin.admin_layouts')

@section('admin_content')

<!-- ########## START: MAIN PANEL ########## -->
<div class="sl-mainpanel">

    <div class="sl-pagebody">

        <div class="card pd-20 pd-sm-40">
            <div class="col-12">
                <h6 class="card-body-title pull-left">Order Details</h6>
                <span class="fa fa-print print-icon pull-right" onclick="printDiv('print_invoice')">Print</span>
                <div class="clearfix"></div>
            </div>
            <div class="row">
                <div class="col-md-6">
                    <div class="card">
                        <div class="card-header"><strong>Order</strong> Details</div>
                        <div class="card-body">
                            <table class="table">
                                <tr>
                                    <th>Name: </th>
                                    <th>{{ $order->name }}</th>
                                </tr>
                                <tr>
                                    <th>Phone: </th>
                                    <th>{{ $order->phone }}</th>
                                </tr>
                                <tr>
                                    <th>Payment Type: </th>
                                    <th>{{ $order->payment_type }}</th>
                                </tr>
                                <tr>
                                    <th>Payment Id: </th>
                                    <th>{{ $order->payment_id }}</th>
                                </tr>
                                <tr>
                                    <th>Total: </th>
                                    <th>Rs. {{ $order->total }}</th>
                                </tr>
                                <tr>
                                    <th>Month: </th>
                                    <th>{{ $order->month }}</th>
                                </tr>
                                <tr>
                                    <th>Date: </th>
                                    <th>{{ $order->date }}</th>
                                </tr>
                            </table>
                        </div>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="card">
                        <div class="card-header"><strong>Delivery</strong> Details</div>
                        <div class="card-body">
                            <table class="table">
                                <tr>
                                    <th>Name: </th>
                                    <th>{{ $shipping->ship_name }}</th>
                                </tr>
                                <tr>
                                    <th>Phone: </th>
                                    <th>{{ $shipping->ship_phone }}</th>
                                </tr>
                                <tr>
                                    <th>Email: </th>
                                    <th>{{ $shipping->ship_email }}</th>
                                </tr>
                                <tr>
                                    <th>Address: </th>
                                    <th>{{ $shipping->ship_address }}</th>
                                </tr>
                                <tr>
                                    <th>City: </th>
                                    <th>{{ $shipping->ship_city }}</th>
                                </tr>
                                <tr>
                                    <th>Status: </th>
                                    <th>
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
                                    </th>
                                </tr>
                                @if($order->return_order == 1 )
                                <tr>
                                    <th>Return Status: </th>
                                    <th><span class="badge badge-warning">Pending</span></th>
                                </tr>
                                @elseif($order->return_order == 2)
                                <tr>
                                    <th>Return Status: </th>
                                    <th><span class="badge badge-success">Success</span></th>
                                </tr>
                                @else

                                @endif
                            </table>
                        </div>
                    </div>
                </div>
            </div>

            @if($order->return_reason != null)
            <div class="row">
                <div class="col-lg-6">
                    <div class="card">
                        <div class="card-header"><strong>Return Reason</strong></div>
                        <p>{{ $order->return_reason }}</p>
                    </div><!-- card -->
                </div>
            </div><br>
            @endif

            <div class="row">
                <div class="col-lg-12">
                    <div class="card">
                        <div class="card-header"><strong>Product Details</strong></div>
                        <div class="table-wrapper card-body">
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

            <div class="form-layout-footer ">
                @if($order->status == 0)
                <a href="{{ url('admin/payment/accept/'.$order->id) }}" class="btn btn-info mg-r-5">Accept Order</a>
                <a href="{{ url('admin/payment/cancel/'.$order->id) }}" class="btn btn-danger">Cancel Order</a>
                @elseif($order->status == 1)
                <a href="{{ url('admin/delivery/process/'.$order->id) }}" class="btn btn-info">Process Delivery</a>
                @elseif($order->status == 2)
                <div class="row">
                    <div class="col-lg-6">
                        <div class="card">
                            <div class="card-header"><strong>Delivery Details</strong></div>
                            <div class="table-wrapper card-body">
                                <form action="{{ route('admin.delivery.done') }}" method="post">
                                    @csrf
                                    <div class="form-group">
                                        <label for="delivery_by">Delivery By:</label>
                                        <input type="text" class="form-control" id="delivery_by" name="delivery_by" placeholder="Enter Name" required>
                                        <input type="hidden" name="order_id" value="{{ $order->id }}">
                                    </div><br>
                                    <button class="btn btn-success" type="submit">Delivery Done</button>
                                </form>
                            </div>

                        </div><!-- card -->
                    </div>
                </div>

                @elseif($order->status == 4)
                <strong class="text-danger">Order Cancelled.</strong>
                @else
                @if($order->return_order == 2)
                <strong class="text-success">This order was returned.</strong>
                @else
                <div class="row">
                    <div class="col-lg-6">
                        <div class="card">
                            <div class="card-header"><strong>Delivery Details</strong></div>
                            <div class="table-wrapper card-body">
                                <table class="table">
                                    <tr>
                                        <th>Delivery By: </th>
                                        <th>{{ $order->delivery_by }}</th>
                                    </tr>
                                </table>
                            </div>

                        </div><!-- card -->
                    </div>
                </div>
                <div class="col-12">
                    @if(empty($order->invoice_verify))
                        <form action="{{ route('admin.invoice.verify') }}" method="post" enctype="multipart/form-data">
                            @csrf
                            <div class="row">
                                <div class="col-12"><label for="invoice_verify">Invoice Receipt(Image Only):</label></div>
                                <div class="col-4 form-group">
                                    <input type="file" class="form-control" id="invoice_verify" name="invoice_verify" placeholder="Invoice Receipt File" required>
                                    <input type="hidden" name="order_id" value="{{ $order->id }}">
                                </div> 
                                <div class="col-4">
                                    <button class="btn btn-info" type="submit">Save Invoice Receipt</button>                            
                                </div>                       
                            </div>
                        </form> 
                    @else
                        <div class="col-6 p-1"><a href="{{ asset($order->invoice_verify) }}" target="_blank"><img src="{{ asset($order->invoice_verify) }}" alt="invoice image" style="max-width:300px;"></a></div>
                    @endif               
                </div>

                <strong class="text-success">This product are successfully delivered.</strong>
                @endif

                @endif
            </div><!-- form-layout-footer -->


        </div><!-- card -->

    </div><!-- sl-pagebody -->

</div><!-- sl-mainpanel -->
<!-- ########## END: MAIN PANEL ########## -->

<!-- invioice print -->
<style>
    .hide{
        display: none;
    }
    .print-icon{
        background: #5b93d3;
        color: white;
        padding: 10px;
    }
    .print-icon:hover{
        padding: 11px;
        opacity: 0.9;
    }
</style>
<div class="hide" id="print_invoice">
    <div class="container">
        <div class="row">
            <div class="span4">
                <address>
                    <strong>Onnepa Pvt Ltd</strong><br>

                    Tarakeshwor-2<br>
                    Kathmandu, Nepal
                </address>
            </div>
            <div class="span4 invoice-back">
                <table class="invoice-head">
                    <tbody>
                        <tr>
                            <td class="pull-right"><strong>Customer Id:</strong></td>
                            <td>{{$order->user_id}}</td>
                        </tr>
                        <tr>
                            <td class="pull-right"><strong>Name:</strong></td>
                            <td>{{$order->name}}</td>
                        </tr>
                        <tr>
                            <td class="pull-right"><strong>Phone:</strong></td>
                            <td>{{$shipping->ship_phone}}</td>
                        </tr>
                        <tr>
                            <td class="pull-right"><strong>Invoice No:</strong></td>
                            <td>{{$order->id}}</td>
                        </tr>
                        <tr>
                            <td class="pull-right"><strong>Date:</strong></td>
                            <td><?=date("F j, Y")?></td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
        <div class="row">
            <div class="span8">
                <h2>Invoice</h2>
            </div>
        </div>
        <div class="row">
            <div class="span8 invoice-back invoice-body">
                <table class="table table-bordered">
                    <thead>
                        <tr>
                            <th>Product</th>
                            <th>Size</th>
                            <th>Quantity</th>
                            <th>Unit Price(Rs.)</th>
                            <th>Amount(Rs.)</th>
                        </tr>
                    </thead>
                    <tbody>
                        <span style="display:none"><?=$total_price= 0; ?></span>
                        @foreach($details as $detail)
                            <tr>
                                <td>{{$detail->product_name}}</td>
                                <td>{{$detail->size}}</td>
                                <td>{{$detail->quantity}}</td>
                                <td>{{$detail->singleprice}}</td>
                                <td>{{$detail->totalprice}}<span style="display:none"><?=$temp_total= $detail->totalprice?></span></td>
                            </tr>
                            @php
                                $total_price = $total_price + $temp_total;
                            @endphp
                        @endforeach
                        
                        <tr>
                            <td colspan="2">&nbsp;</td>
                            <td><strong>Total</strong></td>
                            <td colspan="2"><strong>{{$total_price}}</strong></td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>

        <div class="invoice-row invoice-back invoice-thank" style="padding-top:20px">
            <div class="span3">
                <p>__________________________</p>
                <h5 style="text-align:center;">Customer Signature</h5>
            </div>
            <div class="span3">&nbsp;</div>
            <div class="span3">
                <p>__________________________</p>
                <h5 style="text-align:center;">Authorised Signature</h5>
            </div>
        </div>
        <div class="invoice-row">
            <div class="span3">
                <strong>Phone:</strong><br><a href="tel:+91-124-111111">+977-123-4567890</a>
            </div>
            <div class="span3">
                <strong>Email:</strong><br><a href="officialonnepa@gmail.com">officialonnepa@gmail.com</a>
            </div>
            <div class="span3">
                <strong>Website:</strong><br><a href="http://onnepa.glocution.com">http://onnepa.glocution.com</a>
            </div>
        </div>


    </div>
</div>
<!-- end invioice print -->
@endsection