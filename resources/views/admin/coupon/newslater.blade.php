@extends('admin.admin_layouts')

@section('admin_content')

    <!-- ########## START: MAIN PANEL ########## -->
    <div class="sl-mainpanel">
      <!-- <nav class="breadcrumb sl-breadcrumb">
        <a class="breadcrumb-item" href="">Onnepa</a>
        <a class="breadcrumb-item" href="">Category</a>
        <span class="breadcrumb-item active">Category List</span>
      </nav> -->

      <div class="sl-pagebody">
        <div class="sl-page-title">
          <h5>Subscriber Table</h5>
        </div><!-- sl-page-title -->

        <div class="card pd-20 pd-sm-40">
          <h6 class="card-body-title">Subscriber List
            <form action="{{ route('email.subscriber') }}" method="GET" id="email_subscriber">
              <input type="hidden" name="email_id" id="email_ids">
              <a href="#" class="btn btn-sm btn-warning" style="float:right;" id="email_all_btn">Mail All</a>
              <a href="#" class="btn btn-sm btn-info" style="float:right;" id="selected_email_btn">Mail Selected</a>
            </form>
          </h6>
          <div class="table-wrapper">
            <table id="datatable1" class="table display responsive nowrap">
              <thead>
                <tr>
                  <th class="wd-15p">SN</th>
                  <th class="wd-15p">Email</th>
                  <th class="wd-15p">Subscribing Time</th>
                  <th class="wd-20p">Action</th>
                </tr>
              </thead>
              <tbody>
                @foreach($sub as $key=>$row)
                    <tr>
                        <td><input type="checkbox" class="sub_check" name="email[]" value="{{$row->email}}"> {{ $key+1 }}</td>
                        <td>{{ $row->email }}</td>
                        <td>{{ \Carbon\Carbon::parse($row->created_at)->diffForhumans() }}</td>
                        <td>
                            <a href="{{ URL::to('delete/newslater/'.$row->id) }}" class="btn btn-sm btn-danger" id="delete">Delete</a>
                        </td>
                    </tr>
                @endforeach
              </tbody>
            </table>
          </div><!-- table-wrapper -->
          
        </div><!-- card -->

      </div><!-- sl-pagebody -->
      
    </div><!-- sl-mainpanel -->
    <!-- ########## END: MAIN PANEL ########## -->


@endsection
@section('js')
<script type="text/javascript">
  $(document).ready(function(){
    $('#selected_email_btn').click(function(){
      var val = [];
      $('.sub_check:checked').each(function(i){
        val[i] = $(this).val();
        $("#email_ids").attr('value',val);
        $("#email_subscriber").submit();
      });
    });
    $('#email_all_btn').click(function(){
      var val = [];
      $('.sub_check').each(function(i){
        val[i] = $(this).val();
        $("#email_ids").attr('value',val);
        $("#email_subscriber").submit();
      });
    });
  });
</script>
@endsection