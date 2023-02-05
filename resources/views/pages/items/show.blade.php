@extends('app')

@section('page_title', 'Show items || OnlineLibrary')

@section('content')
    <div class="w-full">
        <div class="container mx-auto py-8 content">
            <section class="flex flex-col">
                <div class="text-2xl font-semibold py-8">{{ $item->title }}</div>
                <div class="text-md">
                    <a href="{{ route('home') }}">Main</a>
                    >
                    <a >{{ $item->title }}</a>
                </div>
                <div class="flex w-full">
                    <div class="flex justify-center items-center w-1/3">
                        <img src="{{ $item->photo_url }}" style="height: 480px"/>
                    </div>
                    <div class="flex flex-col justify-center items-start w-2/3">
                        <div class="p-4">{{ $item->description }}</div>
                        <div class="p-4">{{ $item->tags }}</div>
                        <div class="p-4">{{ $item->price }}</div>
                    </div>
                </div>
            </section>
        </div>
    </div>
@endsection

@push('styles')
    <style>
        .content{ background: white }
    </style>
@endpush