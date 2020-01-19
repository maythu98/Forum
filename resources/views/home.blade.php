@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">

        <div class="col-12">
        
            @if (Auth::guest())
                <router-view :user="0"></router-view>
            @else
                <router-view :user="{{ Auth::id() }}"></router-view>
            @endif
            
        </div>
    </div>
</div>
@endsection
