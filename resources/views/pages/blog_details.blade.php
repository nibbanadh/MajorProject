@extends('layouts.app')

@section('content')

@include('layouts.menubar')

    <link rel="stylesheet" type="text/css" href="{{ asset('public/frontend/styles/blog_single_styles.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('public/frontend/styles/blog_single_responsive.css') }}">

   

    <div class="single_post">
		<div class="container">
			<div class="row">
				<div class="col-lg-8 offset-lg-2">
                    <div class="col-lg-2 offset-lg-2">
                        <img src="{{ asset($post->post_image) }}" alt="post image">
                    </div>
                    
					<div class="single_post_title">
                        @if(Session()->get('lang') == 'nepali')
                            {{ $post->post_title_nep }}
                        @else
                            {{ $post->post_title_en }}
                        @endif
                    </div>
                    <p><i class="far fa-clock"></i>
                        {{ date('F j, Y', strtotime($post->created_at)) }}
                        
                    </p>
					<div class="single_post_text">
						<p>
                            @if(Session()->get('lang') == 'nepali')
                                {!! $post->details_nep !!}
                            @else
                                {!! $post->details_en !!}
                            @endif
                        </p>
					</div>
				</div>
			</div>
		</div>
	</div>
@endsection
@section('js')
    <script src="{{ asset('public/frontend/js/blog_single_custom.js')}}"></script>
@endsection