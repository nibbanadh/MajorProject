@extends('layouts.app')
@section('content')
    <div class="contact_form">
        <div class="container">
            <div class="row">
                <div class="col-9 card">
                    <table class="table table-response">
                        <thead>
                            <tr>
                                <th scope="col">Payment Type</th>
                                <th scope="col">Return</th>
                                <th scope="col">Amount</th>
                                <th scope="col">Date</th>
                                <th scope="col">Status</th>
                                <th scope="col">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($order as $row)
                                <tr>
                                    <td scope="col">{{ $row->payment_type }}</td>
                                    <td scope="col">
                                        @if($row->return_order == 0)
                                            <span class="badge badge-warning">NO Request</span>
                                        @elseif($row->return_order == 1)
                                            <span class="badge badge-info">Pending</span>
                                        @elseif($row->return_order == 2)
                                            <span class="badge badge-warning">Success</span>
                                        @endif
                                    </td>
                                    <td scope="col">Rs. {{ $row->total }}</td>
                                    <td scope="col">{{ $row->date }}</td>
                                    <td scope="col">
                                        @if($row->status == 0)
                                            <span class="badge badge-warning">Pending</span>
                                        @elseif($row->status == 1)
                                            <span class="badge badge-info">Payment Accepted</span>
                                        @elseif($row->status == 2)
                                            <span class="badge badge-warning">In Process</span>
                                        @elseif($row->status == 3)
                                            <span class="badge badge-success">Delivered</span>
                                        @else
                                            <span class="badge badge-danger">Cancelled</span>
                                        @endif
                                    </td>
                                    <td scope="col">
                                        @if($row->return_order == 0)
                                            <button type="button" data-toggle="modal" data-id="{{$row->id}}" data-target="#returnModal{{ $row->id }}" class="btn btn-sm btn-danger returnModal">Return</button>
                                        @elseif($row->return_order == 1)
                                            <span class="badge badge-info">Pending</span>
                                        @elseif($row->return_order == 2)
                                            <span class="badge badge-warning">Success</span>
                                        @endif
                                        
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>    
                    </table>
                </div>
                <div class="col-3">
                    <div class="card">
                        @if(!empty(Auth::user()->avatar))
                            <img id="avatar" src="{{ asset(Auth::user()->avatar) }}" class="card-img-top" style="height:90px; width:90px; margin-left: 34%;border-radius:50%;">
                        @else
                        <img id="avatar" src="{{ asset('public/frontend/images/avatar_profile.png') }}" class="card-img-top" style="height:90px; width:90px; margin-left: 34%;border-radius:50%;">
                        @endif
                        <div class="card-body">
                            <h5 class="card-title text-center">{{ Auth::user()->name }}</h5>
                        </div>
                        <ul class="list-group list-group-flush">
                            <li class="list-group-item"> <a href="{{ route('password.change') }}">Change Password</a></li>
                            <li class="list-group-item"><a href="{{ route('edit.user') }}">Edit Profile</a></li>
                        </ul>

                        <div class="card-body">
                            <a href="{{ route('user.logout') }}" class="btn btn-danger btn-sm btn-block">Logout</a>
                        </div>


                    </div>
                </div>
            </div>
        </div>
    </div>
    

@endsection

@section('js')
    <script src="{{ asset('public/frontend/js/custom.js')}}"></script>
    <script  type="text/javascript">
        $(document).ready(function() {
            $('.returnModal').on("click", function () {
                var order_id = $(this).data('id');
                $('.return_modal').attr('id', 'returnModal'+order_id);
                $("#returnModalBody #order_id").val( order_id );
            });
        });
    </script>
@endsection

    <!-- Modal -->
    <div class="modal fade return_modal" id="returnModal" tabindex="-1" role="dialog" aria-labelledby="returnModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
        <div class="modal-header">
            <h5 class="modal-title" id="returnModalLabel">Return Reason</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
            </button>
        </div>
        <div class="modal-body" id="returnModalBody">
            <form method="post" action="{{ url('request/return') }}">
                @csrf
                <input type="hidden" id="order_id" name="order_id" >
                <div class="form-group">
                    <label for="reasonArea">Reason for Return</label>
                    <textarea class="form-control" name="return_reason" id="reasonArea" rows="3"></textarea>
                </div>
                <button type="submit" class="btn btn-primary">Return</button>
            </form>
        </div>
        </div>
    </div>
    </div>