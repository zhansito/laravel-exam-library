@extends('app')

@section('page_title', 'Dashboard || OnlineLibrary')

@section('content')
    <div class="w-full">
        <div class="container mx-auto py-4 flex">
            <div class="w-1/2">
                <h1 class="text-2x1 font-semibold p-4">Favourite books</h1>
                <section class="flex flex-wrap w-full justify-start items-center">
                    @foreach(auth()->user()->favourite_items as $item)
                        <div class="bg-gray-100 flex flex-col justify-end m-2" style="height: 240px; width: 180px; background-image:  url('{{ $item->photo_url }}'); background-size: cover; background-position: center">
                            <div class="p-2 bg-gray-700 text-white font-semibold">
                                <a href="{{ route('items.show', ['id'=>$item->id]) }}" class="hover:text-blue-300">{{ $item->title }}</a>
                            </div>
                            <div class="p-2 bg-gray-700 text-white">{{ $item->price }}</div>
                        </div>
                    @endforeach
                </section>
            </div>
            <div class="w-1/2">
                <h1 class="text-2xl font-semibod p-4">Book on shelf</h1>
                <section class="flex flex-wrap w-full justify-start items-center">
                    @foreach(auth()->user()->items as $item)
                        <div class="bg-gray-100 flex flex-col justify-end m-2" style="height: 240px; width: 180px; background-image: url('{{ $item->photo_url }}'); background-position: center">
                            <div class="p-2 bg-gray-700 text-white font-semibold">
                                <a href="{{ route('items.show', ['id'=>$item->id]) }}" class="hover: text-blue-300">{{ $item->title }}</a>
                            </div>
                            <div class="p-2 bg-gray-700 text-white">{{ $item->price }}</div>
                        </div>
                    @endforeach
                </section>
            </div>
        </div>
    </div>
@endsection

                {{-- <div class="py-2"><a href="{{ route('items.create') }}">+ add book</a></div> --}}
                {{-- @if(auth()->user()->favourite_items->count() > 0) --}}
                {{-- @foreach($items as $item)
                <div class="py-2"><a href="{{ route('items.edit', ['id'=>$item->id ]) }}">{{ $item->title }}</a></div>
                @endforeach --}}
            {{-- </div>
            <div class="w-1/2">
                <div class="py-2"><a href="{{ route('tags.create') }}">+ add category</a></div>
                @foreach($tags as $tag)
                <div class="py-2"><a href="{{ route('tags.edit', ['id'=>$tag->id ]) }}">{{ $tag->title }}</a></div>
                @endforeach
            </div>
        </div>
    </div>
@endsection --}}