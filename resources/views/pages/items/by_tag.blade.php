@extends('app')

@section('page_title', 'OnlineLibrary')

@section('content')
    <div class="w-full">    
        <div class="container mx-auto">    
            <section class="flex justify-center py-8">    
                <h1>Welcome to our library</h1>
            </section>
            <section class="py-8 flex justify-center">
                @foreach($tags as $tag)
                    <div class="py-2 px-4 rounded-md bg-blue-700 text-white mx-2">
                        <a href="{{ route('items.by_tag', ['id'=>$tag->id]) }}">
                            {{ $tag->title }}
                        </a>
                    </div>
                @endforeach
            </section>
            <section class="flex flex-wrap w-full justify-center items-center py-8">
                @foreach($items as $item)
                    <div class="bg-gray-100 flex flex-col justify-end mx-4 mb-4" style="height: 240px; width: 180px; background-image: url('{{ $item->photo_url }}'); background-size: cover; background-position: center">
                        <div class="p-2 bg-gray-700 text-white font-semibold">
                            <a href="{{ route('items.show', ['id'=>$item->id]) }}" class="hover:text-blue-300">{{ $item->title }}</a>
                        </div>
                        <div class="p-2 bg-gray-700 text-white">{{ $item->price }}</div>
                    </div>
                @endforeach
            </section>
        </div>
    </div>
@endsection