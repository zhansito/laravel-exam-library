@extends('app')

@section('page_title', 'Profile || OnlineLibrary')

@section('content')
    <div class="w-full">
        <div class="container mx-auto py-4">
            {{ $user }}
        </div>
    </div>
@endsection