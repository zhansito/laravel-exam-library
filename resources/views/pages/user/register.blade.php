@extends('app')

@section('page_title', 'Список всех пользователей || OnlineLibrary')

@section('content')
    <div class="w-full">
        <div class="container mx-auto py-16">
            <div class="flex justify-center items-center">
                <div class="w-1/4 flex flex-col">
                    <div class="p-8 bg-gray-100 rounded-lg ">
                        <div class="text-2xl pb-6 font-semibold">Hello user</div>
                        <form method="POST">
                            @csrf
                            <div class="flex flex-col pb-6">
                                <label class="pb-2">Login</label>
                                <input name="email" required type="email" class="py-2 px-4 rounded-md outline-none" placeholder="email@email.com" value="{{ old('email') }}" />
                            </div>
                            <div class="flex flex-col pb-6">
                                <label class="pb-2">Password</label>
                                <input name="password" required type="password" class="py-2 px-4 rounded-md outline-none" placeholder="password"/>
                            </div>
                            <div class="flex flex-col pb-6">
                                <label class="pb-2">Password</label>
                                <input name="password_confirmation" required type="password" class="py-2 px-4 rounded-md outline-none" placeholder="password"/>
                            </div>
                            <div class="flex flex-col pb-6">
                                <label class="pb-2">First Name</label>
                                <input name="first_name" required type="text" class="py-2 px-4 rounded-md outline-none" placeholder="name"/>
                            </div>
                            <div class="flex flex-col pb-6">
                                <label class="pb-2">Last Name</label>
                                <input name="last_name" required type="text" class="py-2 px-4 rounded-md outline-none" placeholder="last name"/>
                            </div>
                            <div class="flex flex-col pb-6">
                                <label class="pb-2">Birthdate</label>
                                <input name="birthdate" required type="date" class="py-2 px-4 rounded-md outline-none" placeholder="date"/>
                            </div>
                            <div class="flex flex-row pb-6 justify-center">
                                <input type="submit" class="py-2 px-8 rounded-md outline-none bg-indigo-300 text-white cursor-pointer hover:bg-indigo-500" value="Register"/>
                            </div>
                        </form>
                    </div>
                    @if($errors->any())
                        <div class="bg-red-300 p-8 mt-8 rounded-md">
                            @foreach($errors->all() as $message)
                                <div>{{ $message }}</div>
                            @endforeach
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
@endsection