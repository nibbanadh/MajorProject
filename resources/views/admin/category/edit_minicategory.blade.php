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
          <h5>Sub Category Table</h5>
        </div><!-- sl-page-title -->

        <div class="card pd-20 pd-sm-40">
          <h6 class="card-body-title">Sub Category Update</h6>
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
            <form method="post" action="{{ url('update/minicategory/'.$minicat->id) }}">
            @csrf
                <div class="modal-body pd-20">
                    <div class="form-group">
                        <label for="exampleInputEmail1">Select Catalog</label>
                        <select class="form-control" name="category_id">
                            @foreach($catalog as $row)
                                <option value="{{ $row->id }}"
                                <?php if($row->id == $minicat->category_id ){ echo "selected"; } ?> >{{ $row->category_name }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="exampleInputEmail1">Select Category</label>
                        <select class="form-control" name="subcategory_id">
                            
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="exampleInputEmail1">Sub Category Name</label>
                        <input type="text" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" value="{{ $minicat->minicategory_name }}" name="minicategory_name" required>
                    </div>
                        
                </div><!-- modal-body -->
                <div class="modal-footer">
                    <button type="submit" class="btn btn-info pd-x-20">Update</button>
                    <a href="{{ route('sub.categories') }}"><button type="button" class="btn btn-secondary pd-x-20">Cancel</button></a>
                </div>
            </form>
          </div><!-- table-wrapper -->
          
        </div><!-- card -->

      </div><!-- sl-pagebody -->
      
    </div><!-- sl-mainpanel -->
    <!-- ########## END: MAIN PANEL ########## -->

@endsection
@section('js')
  <script type="text/javascript">
    $(document).ready(function(){

      // for default category id
      var categories_id = <?php echo $minicat->category_id ?>;
      var subcat_id = <?php echo $minicat->subcategory_id ?>;
      
      if(categories_id)
      {
        $.ajax({
          url: "{{ url('/get/subcategory/') }}/"+categories_id,
          type:"GET",
          dataType:"json",
          success:function(data) {
            $('select[name="subcategory_id"]').empty();
            $.each(data, function(key, value){
              $('select[name="subcategory_id"]').append('<option value="'+ value.id + '">' + value.subcategory_name + '</option>');
            });
            $('select[name="subcategory_id"]').val(subcat_id);
          }
        })
      }

      $('select[name="category_id"]').on('change',function(){
        var category_id = $(this).val();
        if (category_id) {
          
          $.ajax({
            url: "{{ url('/get/subcategory/') }}/"+category_id,
            type:"GET",
            dataType:"json",
            success:function(data) { 
            var d =$('select[name="subcategory_id"]').empty();
            $.each(data, function(key, value){
            
            $('select[name="subcategory_id"]').append('<option value="'+ value.id + '">' + value.subcategory_name + '</option>');

            });
            },
          });

        }else{
          alert('danger');
        }

      });
    });
  </script>
@endsection