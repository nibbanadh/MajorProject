@extends('admin.admin_layouts')


@section('admin_content')

<!-- ########## START: MAIN PANEL ########## -->
<div class="sl-mainpanel">
    <nav class="breadcrumb sl-breadcrumb">
        <a class="breadcrumb-item" href="index.html">OnNepa</a>
        <span class="breadcrumb-item active">Admin Section</span>
    </nav>

    <div class="sl-pagebody">
        <div class="card pd-20 pd-sm-40">
            <h6 class="card-body-title">New Admin</h6>

            <p class="mg-b-20 mg-sm-b-30">New Product Add Form</p>

            <form method="post" action="{{route('store.admin')}}">
                @csrf


                <div class="form-layout">
                    <div class="row mg-b-25">
                        <div class="col-lg-4">
                            <div class="form-group">
                                <label class="form-control-label">Name: <span class="tx-danger">*</span></label>
                                <input class="form-control" type="text" name="name" placeholder="User Name" required>
                            </div>
                        </div><!-- col-4 -->
                        <div class="col-lg-4">
                            <div class="form-group">
                                <label class="form-control-label">Phone: <span class="tx-danger">*</span></label>
                                <input class="form-control" type="text" name="phone" placeholder="Phone" required>
                            </div>
                        </div><!-- col-4 -->
                        <div class="col-lg-4">
                            <div class="form-group">
                                <label class="form-control-label">Email: <span class="tx-danger">*</span></label>
                                <input class="form-control" type="text" name="email"
                                    placeholder="Email" required>
                            </div>
                        </div><!-- col-4 -->
                        <div class="col-lg-4">
                            <div class="form-group">
                                <label class="form-control-label">Password:</label>
                                <input class="form-control" type="password" name="password"
                                    placeholder="Password" required>
                            </div>
                        </div><!-- col-4 -->
                    </div><!-- row -->


                    <hr>
                    <br><br>

                    <div class="row">
                        <div class="col-lg-4">
                            <label class="ckbox">
                                <input type="checkbox" name="category" value="1">
                                <span>Category</span>
                            </label>
                        </div><!-- col-4 -->


                        <div class="col-lg-4">

                            <label class="ckbox">
                                <input type="checkbox" name="coupon" value="1">
                                <span>Coupon</span>
                            </label>
                        </div><!-- col-4 -->


                        <div class="col-lg-4">

                            <label class="ckbox">
                                <input type="checkbox" name="product" value="1">
                                <span>Product</span>
                            </label>
                        </div><!-- col-4 -->

                        <div class="col-lg-4">

                            <label class="ckbox">
                                <input type="checkbox" name="blog" value="1">
                                <span>Blog</span>
                            </label>

                        </div><!-- col-4 -->

                        <div class="col-lg-4">
                            <label class="ckbox">
                                <input type="checkbox" name="order" value="1">
                                <span>Order</span>
                            </label>

                        </div><!-- col-4 -->

                        <div class="col-lg-4">
                            <label class="ckbox">
                                <input type="checkbox" name="other" value="1">
                                <span>Other</span></span>
                            </label>

                        </div><!-- col-4 -->

                        <div class="col-lg-4">
                            <label class="ckbox">
                                <input type="checkbox" name="report" value="1">
                                <span>Report</span>
                            </label>

                        </div><!-- col-4 -->

                        <div class="col-lg-4">
                            <label class="ckbox">
                                <input type="checkbox" name="role" value="1">
                                <span>Role</span>
                            </label>

                        </div><!-- col-4 -->

                        <div class="col-lg-4">
                            <label class="ckbox">
                                <input type="checkbox" name="return" value="1">
                                <span>Return</span>
                            </label>

                        </div><!-- col-4 -->

                        <div class="col-lg-4">
                            <label class="ckbox">
                                <input type="checkbox" name="contact" value="1">
                                <span>Contact</span></span>
                            </label>

                        </div><!-- col-4 -->

                        <div class="col-lg-4">
                            <label class="ckbox">
                                <input type="checkbox" name="comment" value="1">
                                <span>Comment</span>
                            </label>

                        </div><!-- col-4 -->

                        <div class="col-lg-4">
                            <label class="ckbox">
                                <input type="checkbox" name="setting" value="1">
                                <span>Setting</span>
                            </label>

                        </div><!-- col-4 -->

                        <div class="col-lg-4">
                            <label class="ckbox">
                                <input type="checkbox" name="stock" value="1">
                                <span>Stock</span>
                            </label>

                        </div><!-- col-4 -->

                        <div class="col-lg-4">
                            <label class="ckbox">
                                <input type="checkbox" name="vendor" value="1">
                                <span>Vendor</span>
                            </label>

                        </div><!-- col-4 -->

                        <br><br>


                    </div>
                    <!--end row-->

                    <br><br>
                    <div class="form-layout-footer">
                        <button class="btn btn-info mg-r-5" type="submit">Submit</button>
                    </div><!-- form-layout-footer -->
                </div><!-- form-layout -->
        </div><!-- card -->
        </form>
    </div><!-- row -->

</div><!-- sl-mainpanel -->
<!-- ########## END: MAIN PANEL ########## -->


@endsection