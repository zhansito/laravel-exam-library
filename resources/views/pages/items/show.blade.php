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
            <div class="flex w-full py-8">
                <div class="flex justify-center items-center w-1/3">
                    <img src="{{ $item->photo_url }}" style="height: 480px"/>
                </div>
                <div class="flex flex-col justify-center items-start w-2/3">
                    <div class="p-4">{{ $item->description }}</div>
                    <div class="p-4 flex flex-wrap">
                        @if(count($item->tags)>0)
                        {{ $item->tags}}
                        {{-- @foreach{{ $item->tags as $tag }}</div>
                        <div class="py-2 px-4 rounded-md bg-gray-100">
                            {{ $tag->title }}
                        </div>
                        @endforeach
                        --}}
                        @endif 
                    </div>
                    <div class="p-4">price: {{ $item->price }}</div>
                    <div class="p-4">views: {{ $item->views->count() }}</div>
                    <div class="p-4">
                        @if($item->is_liked)
                        <form method="POST" action="{{ route('items.dislike', ['id' => $item->id]) }}">
                            @csrf
                            <button class="py-2 px-4 rounded-md bg-gray-100 hover:bg-indigo-300 cursor-pointer">Move from favourites</button>
                        </form>
                        @else
                        <form method="POST" action="{{ route('items.like', ['id' => $item->id]) }}">
                            @csrf
                            <button class="py-2 px-4 rounded-md bg-gray-100 hover:bg-indigo-300 cursor-pointer" type="submit">Add to favourites</button>
                        </form>
                        @endif
                    </div>
                    <div class="p-4 flex items-center">
                        <form method="POST" action="{{ route('items.add_to_shelf', ['id' => $item->id]) }}">
                            @csrf
                            <input class="border-b py-2 px-4" name="amount" type="number" min="1" max="99" value="{{ $item->in_basket }}"/>
                            <button type="submit" class="py-2 px-5 rounded-md bg-green-300">Add to shelf</button>
                        </form>
                        <form method="POST" action="{{ route('items.remove_from_shelf', ['id' => $item->id]) }}">
                            @csrf
                            <button type="submit" class="py-2 px-4 rounded-md bg-red-300 ml-4">Move from the shelf</button>
                        </form>
                    </div> 
                </div>
            </div>
        </section>
        
        <section class="fle mt-16">
            <div class="w-1/2 flex justify-center">
                <div class="p-4 border-t w-full">
                    <h3 class="text-xl pb-4 font-semibold">Reviews</h3>
                    @if(count($item->reviews) > 0)
                    <div>
                        @foreach($item->reviews as $review)
                        <div>
                            <div class="py-2 pl-4 flex items-end justify-between">
                                <div class="flex items-center">
                                    <div class="font-semibold text-lg">{{ $review->author->name }}</div>
                                    <div class="pl-6 flex">
                                        @for($i=0; $i<$review->rating; $i++)
                                        <img src="https://img.icons8.com/ios-filled/256/filled-star.png" style="height: 16px; width: 16px"/>
                                        @endfor
                                    </div>
                                </div>
                                <div class="text-gray-700 pl-4 pt-2 text-right text-xs">{{ $review->created_at }}</div>
                            </div>
                            <div class="bg-gray-100 rounded-md p-4">{{ $review->body }}</div>
                        </div>
                        @endforeach
                    </div>
                    @else
                    <div><i>No reviews, yet</i></div>
                    @endif
                </div>
            </div>
            <div class="w-1/2 flex justify-center">
                <div class="p-4 bg-gray-100 rounded-md">
                    <h3 class="text-xl pb-4 font-semibold">Share review, please</h3>
                    <form method="POST" action="{{ route('items.review_store', ['id' => $item->id]) }}">
                        @csrf
                        <div class="">
                            <select name="rating" class="py-2 px-4 outline-none border rounded-md" style="width: 450px">
                                <option value="1">1</option>
                                <option value="5">5</option>
                                <option value="10">10</option>
                            </select>
                        </div>
                        
                        <div class="pt-6">
                            <textarea name="body" class="py-2 px-4 outline-none border rounded-md" style="min-height: 125px; width: 450px"></textarea>
                        </div>
                        
                        <div class="pt-6">
                            <input type="submit" class="py-2 px-6 outline-none bg-indigo-300 hover:bg-indigo-500 hover:text-white cursor-pointer rounded-md"/>
                        </div>
                    </form>
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