@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
        @guest
        <router-link to="/">Create post</router-link>
        @else

        <button type="button" class="btn btn-primary" data-backdrop="static" data-keyboard="false" data-toggle="modal" data-target="#createPostModal">
        Create Post
        </button>
        @endguest


            <create-post></create-post>
        </div>
    </div>
</div>
@endsection
