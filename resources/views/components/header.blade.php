<div class="w-full bg-indigo-500">
    <div class="container mx-auto py-4 text-white flex items-center justify-between text-md">
        <div class="flex">
            <div class="px-4">
                <a href='{{ route("home") }}'>Main</a>
            </div>
            <div class="px-4">
                <a href="{{ route("items.index") }}">Books</a>
            </div>
            <div class="px-4">
                <a href='{{ route("info.about") }}'>About</a>
            </div>
            {{-- @auth
            <div class="px-4">
                <a href="{{ route("user.dashboard") }}">Dash</a>
            </div>
            @endauth --}}
        </div>
        <div class="flex items-center">
            @guest
                <div class="px-4">
                    <a href='/login'>Login</a>
                </div>
                <div class="px-4">
                    <a href='/register'>Register</a>
                </div>
            @endguest
            @auth
                <div class="px-4">
                    <a href="/user/dashboard">{{ auth()->user()->email }}</a>
                    {{ auth()->user()->role ? ' ('.auth()->user()->role.')' : '' }}
                </div>
                @if(!auth()->user()->role)
                    <div class="px-4">
                        <div class="bg-white rounded-full p-2 relative">
                            <img src="https://img.icons8.com/ios-glyphs/256/card-wallet.png"
                                style="width: 24px; height: 24px; border-radius: 50%"
                        />
                            <div class="absolute w-6 h-6 bg-red-500 text-white flex justify-center items-center rounded-full"
                                style="bottom: -6px; right: -6px">
                                {{ auth()->user()->basket_items_count }}
                            </div>
                        </div>
                    </div>
                @endif
                <div class="px-4">
                    <a href='/logout'>Logout</a>
                </div>
            @endauth
        </div>
    </div>
</div>