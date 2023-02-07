@extends('app')

@section('page_title', 'OnlineLibrary')

@push('styles')
    <style>
        .items-collection{}
        .items-collection div{}
        .items-collection div:last-child{ margin-right: 0}
    </style>
@endpush

@section('content')
    <div class="w-full">
        <div class="container mx-auto">
            <section class="flex justify-center py-8 font-serif">
                <h1>Welcome to online library</h1>
            </section>
            <section class="flex justify-center">
                <div style="height: 100%">
                    <img src="https://img.freepik.com/premium-vector/digital-library-online-education-internet-blank-space-phone-mobile-website-background-social-distance-concept-decor-by-book-lecture-pencil-eraser-blackboard-mobile-3d-illustration_255625-28.jpg?w=996" style="height: 100%"/>
                </div>
            </section>
            <div>
                <h1>Collection</h1>
            </div>

            <section class="flex w-full justify-between items-center py-16">
                @foreach($popular_items as $item)
                    <div class="bg-gray-100 flex flex-col justify-end" style="height: 240px; width: 180px; background-image: url('{{ $item->photo_url }}'); background-size: cover; background-position: center">
                        <div class="p-2 bg-gray-700 text-white font-semibold">
                            <a href="{{ route('items.show', ['id'=>$item->id]) }}" class="hover:text-blue-300">{{ $item->title }}</a>
                        </div>
                        <div class="p-2 bg-gray-700 text-white">{{ $item->price }}</div>
                    </div>
                @endforeach
            </section>

            {{-- <section class=" flex w-full justify-between items-center py-16 border-double border-4 border-sky-700">
                @foreach($items as $item)
                    <div class="bg-gray-100 flex flex-col justify-end" style="height: 240px; width: 180px; background-image: url('{{ $item->photo_url }}'); background-size: cover; background-position: center">
                        <div class="p-2 bg-gray-700 text-white font-semibold">
                            <a href="{{ route('items.show', ['id'=>$item->id]) }}" class="hover:text-blue-300">{{ $item->title }}</a>
                        </div>
                        <div class="p-2 bg-gray-700 text-white">{{ $item->price }}</div>
                    </div>
                @endforeach
            </section> --}}


            @auth
                <section class="flex flex-col w-full py-10">
                    <h3 class="pb-6 text-lg">Товары в вашей корзине:</h3>
                    <div class="flex w-full justify-start items-center items-collection">
                        @foreach(auth()->user()->basket_items as $item)
                            <div class="bg-gray-100 flex flex-col justify-end  mr-16" style="height: 240px; width: 180px; background-image: url('{{ $item->photo_url }}'); background-size: cover; background-position: center">
                                <div class="p-2 bg-gray-700 text-white font-semibold">
                                    <a href="{{ route('items.show', ['id'=>$item->id]) }}" class="hover:text-blue-300">{{ $item->title }}</a>
                                </div>
                                <div class="p-2 bg-gray-700 text-white">{{ $item->price }}</div>
                                {{-- <div class="p-2 bg-gray-700 text-white">{{ $item->views_count }}</div> --}}
                            </div>
                        @endforeach
                    </div>
                </section>

                <section class="flex flex-col w-full py-10">
                    <h3 class="pb-6 text-lg">Избранные товары:</h3>
                    <div class="flex w-full justify-start items-center items-collection">
                        @foreach(auth()->user()->favourite_items as $item)
                            <div class="bg-gray-100 flex flex-col justify-end mr-16" style="height: 240px; width: 180px; background-image: url('{{ $item->photo_url }}'); background-size: cover; background-position: center">
                                <div class="p-2 bg-gray-700 text-white font-semibold">
                                    <a href="{{ route('items.show', ['id'=>$item->id]) }}" class="hover:text-blue-300">{{ $item->title }}</a>
                                </div>
                                <div class="p-2 bg-gray-700 text-white">{{ $item->price }}</div>
                            </div>
                        @endforeach
                    </div>
                </section>
            @endauth
        </div>
    </div>    
@endsection
