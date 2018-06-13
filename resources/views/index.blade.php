@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
    @if ( empty(Auth::user()) )
        <post-stream></post-stream>
    @else
        <post-stream
            user-id="{{ Auth::id() }}"
            api-token="{!! Auth::user()->api_token !!}">
        </post-stream>
    @endif
    </div>
</div>
@endsection
