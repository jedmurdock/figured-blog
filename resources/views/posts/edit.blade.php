@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
    @if ( empty($post) )
        <post-edit
            api-token="{!! Auth::user()->api_token !!}"></post-edit>
    @else
        <post-edit
            id="{{ $post->id }}"
            title="{{ $post->title }}"
            body="{{ $post->body }}"
            slug="{{ $post->slug }}"
            visible-at="{{ $post->visible_at }}"
            api-token="{!! Auth::user()->api_token !!}"></post-edit>
    @endif
    </div>
</div>
@endsection
