@extends('admin.admin_layouts')

@section('admin_content')

<!-- ########## START: MAIN PANEL ########## -->
<div class="sl-mainpanel">
    <!-- <nav class="breadcrumb sl-breadcrumb">
        <a class="breadcrumb-item" href="">Onnepa</a>
        <a class="breadcrumb-item" href="{{ route('categories') }}">Category</a>
        <span class="breadcrumb-item active">Category Update</span>
      </nav> -->

    <div class="sl-pagebody">
        <div class="sl-page-title">
            <h5>Search Report</h5>
        </div><!-- sl-page-title -->
        <div class="row">
            <div class="col-lg-4">
                <div class="card pd-20 pd-sm-40">
                    <div class="table-wrapper">
                        <form method="post" action="{{ route('search.by.date') }}">
                            @csrf
                            <div class="modal-body pd-20">

                                <div class="form-group">
                                    <label for="exampleInputlogo">Search By Date</label>
                                    <input type="date" class="form-control" aria-describedby="SearchByDate" value="" name="date">
                                </div>
                                <div class="form-group">
                                    <label for="exampleInputlogo">Order Status</label>
                                    <select name="status" id="" class="form-control">
                                        <option value="0">Pending</option>
                                        <option value="1">Payment Accepted</option>
                                        <option value="2">Progress</option>
                                        <option value="3">Delivered</option>
                                        <option value="4">Cancelled</option>
                                        <option value="5">Returned</option>
                                    </select>
                                </div>
                            </div><!-- modal-body -->
                            <div class="modal-footer">
                                <button type="submit" class="btn btn-info pd-x-20">Generate</button>
                            </div>
                        </form>
                    </div><!-- table-wrapper -->
                </div><!-- card -->
            </div>
            <div class="col-lg-4">
                <div class="card pd-20 pd-sm-40">
                    <div class="table-wrapper">
                        <form method="post" action="{{ route('search.by.month') }}">
                            @csrf
                            <div class="modal-body pd-20">

                                <div class="form-group">
                                    <label for="exampleInputlogo">Search By Month</label>
                                    <select name="month" id="" class="form-control">
                                        <option value="january">January</option>
                                        <option value="february">February</option>
                                        <option value="march">March</option>
                                        <option value="april">April</option>
                                        <option value="may">May</option>
                                        <option value="june">June</option>
                                        <option value="july">July</option>
                                        <option value="august">August</option>
                                        <option value="september">September</option>
                                        <option value="october">October</option>
                                        <option value="november">November</option>
                                        <option value="december">December</option>
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label for="exampleInputlogo">Order Status</label>
                                    <select name="status" id="" class="form-control">
                                        <option value="0">Pending</option>
                                        <option value="1">Payment Accepted</option>
                                        <option value="2">Progress</option>
                                        <option value="3">Delivered</option>
                                        <option value="4">Cancelled</option>
                                        <option value="5">Returned</option>
                                    </select>
                                </div>

                            </div><!-- modal-body -->
                            <div class="modal-footer">
                                <button type="submit" class="btn btn-info pd-x-20">Generate</button>
                            </div>
                        </form>
                    </div><!-- table-wrapper -->
                </div><!-- card -->
            </div>
            <div class="col-lg-4">
                <div class="card pd-20 pd-sm-40">
                    <div class="table-wrapper">
                        <form method="post" action="{{ route('search.by.year') }}">
                            @csrf
                            <div class="modal-body pd-20">

                                <div class="form-group">
                                    <label for="exampleInputlogo">Search By Year</label>
                                    <select name="year" id="" class="form-control">
                                        <?php
                                            for ($i=date('Y'); $i >=2020 ; $i--) {
                                        ?>
                                        <option value="{{$i}}">{{$i}}</option>
                                        <?php
                                            }
                                        ?>
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label for="exampleInputlogo">Order Status</label>
                                    <select name="status" id="" class="form-control">
                                        <option value="0">Pending</option>
                                        <option value="1">Payment Accepted</option>
                                        <option value="2">Progress</option>
                                        <option value="3">Delivered</option>
                                        <option value="4">Cancelled</option>
                                        <option value="5">Returned</option>
                                    </select>
                                </div>

                            </div><!-- modal-body -->
                            <div class="modal-footer">
                                <button type="submit" class="btn btn-info pd-x-20">Generate</button>
                            </div>
                        </form>
                    </div><!-- table-wrapper -->
                </div><!-- card -->
            </div>
        </div>

    </div><!-- sl-pagebody -->

</div><!-- sl-mainpanel -->
<!-- ########## END: MAIN PANEL ########## -->

@endsection