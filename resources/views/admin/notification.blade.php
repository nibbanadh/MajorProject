@php 
    $notifications = DB::table('notifications')->orderBy('created_at','desc')->get();
@endphp

@foreach($notifications as $row)
    @php 
        $user_details = DB::table('users')->where('id',$row->notifiable_id)->first();
        $data_arr = json_decode($row->data,true);
        
    @endphp
    @if($row->read_at != null)
        <a href="{{ URL::to('admin/view/order/'.$data_arr['order_id']) }}" class="media-list-link read" >
        <div class="media pd-x-20 pd-y-15">
            <img src="{{ asset('public/frontend/images/avatar_profile.png') }}" class="wd-40 rounded-circle" alt="">
            <div class="media-body">
            <p class="tx-13 mg-b-0 tx-gray-700"><strong class="tx-medium tx-gray-800">{{$user_details->name}}</strong> has new order of Rs {{ $data_arr['total_amt'] }}.</p>
            <span class="tx-12">{{ $data_arr['date'] }}</span>
            </div>
        </div><!-- media -->
        </a>
    @else
        <a href="{{ URL::to('admin/view/order/'.$data_arr['order_id']) }}" onclick="markAsRead('{{ $row->id }}','{{ $row->notifiable_id }}')" class="media-list-link read" >
        <div class="media pd-x-20 pd-y-15" style="background-color:#d1d7e0;">
            <img src="{{ asset('public/frontend/images/avatar_profile.png') }}" class="wd-40 rounded-circle" alt="">
            <div class="media-body">
            <p class="tx-13 mg-b-0 tx-gray-700"><strong class="tx-medium tx-gray-800">{{$user_details->name}}</strong> has new order of Rs {{ $data_arr['total_amt'] }}.</p>
            <span class="tx-12">{{ $data_arr['date'] }}</span>
            </div>
        </div><!-- media -->
        </a>
        
    @endif
@endforeach