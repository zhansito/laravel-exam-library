@extends('app')

@section('page_title', 'Edit book || OnlineStore')

@section('content')
    <div class="w-full">
        <div class="container mx-auto py-8">
            <div class="w-full flex flex-col content">
                <form method="POST">
                <section class="w-1/2 flex flex-row">
                    <input class="p-2 border-b outline-none w-3/4 mr-4 focus:border-b-black" type="text" name="title" value="{{ $tag->title }}"/>
                </section>
                <section class="w-1/2">
                    <input class="py-2 px-4" type="submit" value="Сохранить"/>
                    @csrf
                </section>
                </form>
            </div>
        </div>
    </div>
@endsection

@push('styles')
    <style>
        .content{ background: white }
    </style>
@endpush