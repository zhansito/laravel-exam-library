@extends('app')

@section('page_title', 'Create || OnlineLibrary')

@section('content')
    <div class="w-full">
        <div class="container mx-auto py-8">
            <div class="w-full flex flex-col content">
                <form method="POST">
                <section class="w-1/2 flex flex-row">
                    <input class="p-2 border-b outline-none w-3/4 mr-4 focus:border-b-black" type="text" name="title" placeholder="title"/>
                    <input class="p-2 border-b outline-none w-1/4" type="text" name="price" placeholder="price"/>
                </section>
                <section class="w-1/2">
                    <textarea class="p-2 border-b w-full outline-none" name="description" placeholder="description"></textarea>
                </section>
                <section class="w-1/2">
                    <input class="py-2 px-4" type="submit" value="Save"/>
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