@extends('app')

@section('page_title', 'Страничка редактировани товара || OnlineLibrary')

@section('content')
    <div class="w-full">
        <div class="container mx-auto py-8">
            <div class="w-full flex flex-col content">
                <form method="POST">
                <section class="w-1/2 flex flex-row">
                    <input class="p-2 border-b outline-none w-3/4 mr-4 focus:border-b-black" type="text" name="title" value="{{ $item->title }}"/>
                    <input class="p-2 border-b outline-none w-1/4" type="text" name="price" value="{{ $item->price }}"/>
                </section>
                <section class="w-1/2 flex flex-row">
                    <input class="p-2 border-b outline-none w-3/4 mr-4 focus:border-b-black" type="text" name="photo_url" value="{{ $item->photo_url }}"/>
                    <select class="p-2 border-b outline-none w-1/4" name="status">
                        <option value="1" @if($item->status == 1) selected @endif>Активно</option>
                        <option value="0" @if($item->status == 0) selected @endif>Не активно</option>
                    </select>
                </section>
                <section class="w-1/2">
                    <textarea class="p-2 border-b w-full outline-none" name="description">{{ $item->description }}</textarea>
                </section>
                <section class="w-1/2">
                    <input class="py-2 px-4" type="submit" value="Сохранить"/>
                    @csrf
                </section>
                </form>
            </div>
            <div class="w-full flex flex-col content pt-8">
                @foreach($item->tags as $tag)
                    <form method="POST" action="{{ route('items.detach_tag', ['id' => $item->id ]) }}">
                        {{ $tag->title }}
                        <input type="hidden" name="tag_id" value="{{ $tag->id }}" />
                        <input class="py-2 px-4" type="submit" value="Удалить"/>
                        @csrf
                    </section>
                    </form>
                @endforeach
            </div>
            <div class="w-full flex flex-col content pt-8">
                <form method="POST" action="{{ route('items.attach_tag', ['id' => $item->id ]) }}">
                <section class="w-1/2 flex flex-row">
                    <select name="tag_id" class="py-2 px-4 outline-none border-b">
                        @foreach($tags as $tag )
                            <option value="{{ $tag->id }}">{{ $tag->title }}</option>
                        @endforeach
                    </select>
                    <input class="py-2 px-4" type="submit" value="Сохранить"/>
                    @csrf
                </section>
                </form>
            </div>
        </div>
        {{-- <div class="w-full flex flex-col content pt-8">
                <form method="POST" action="{{ route('items.success') }}">
                    <input class="py-2 px-4" type="submit" value="Finish"/>
                </form>
        </div> --}}
    </div>
@endsection

@push('styles')
    <style>
        .content{ background: white }
    </style>
@endpush