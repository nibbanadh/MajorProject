@extends('admin.admin_layouts')

@section('admin_content')

    <!-- ########## START: MAIN PANEL ########## -->
    <div class="sl-mainpanel">

      <div class="sl-pagebody">
        <div class="sl-page-title">
          <h5>Blog Category Table</h5>
        </div><!-- sl-page-title -->

        <div class="card pd-20 pd-sm-40">
          <h6 class="card-body-title">Blog Category Update</h6>
          <div class="table-wrapper">
            @if($errors->any())
                <div class="alert alert-danger">
                    <ul>
                        @foreach($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif
            <form method="post" action="{{ url('update/blogcategory/'.$blogcatedit->id) }}">
                @csrf
                <div class="modal-body pd-20">
                    
                    <div class="form-group">
                        <label for="exampleInputEmail1">Category Name Eng</label>
                        <input type="text" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" value="{{ $blogcatedit->category_name_en}}" name="category_name_en" required>
                    </div>

                    <div class="form-group">
                        <label for="exampleInputEmail2">Category Name Nep</label>
                        <input type="text" class="form-control" id="exampleInputEmail2" aria-describedby="emailHelp" value="{{ $blogcatedit->category_name_nep}}" name="category_name_nep" required>
                    </div>
                        
                </div><!-- modal-body -->
                <div class="modal-footer">
                    <button type="submit" class="btn btn-info pd-x-20">Update</button>
                    <a href="{{ route('add.blog.categorylist') }}"><button type="button" class="btn btn-secondary pd-x-20">Cancel</button></a>
                </div>
            </form>
          </div><!-- table-wrapper -->
          
        </div><!-- card -->

      </div><!-- sl-pagebody -->
      
    </div><!-- sl-mainpanel -->
    <!-- ########## END: MAIN PANEL ########## -->

@endsection