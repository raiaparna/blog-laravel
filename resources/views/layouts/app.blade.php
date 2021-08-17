<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Blog') }}</title>

    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}" defer></script>

    <!-- Styles -->
    <link href="{{ mix('css/app.css') }}" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('/css/trix.css') }}">
</head>
<body class="bg-gray-100 h-screen antialiased leading-none font-sans">
    <div id="app">
      <header x-data="{ mobileMenuOpen : false }">
        <div class="container 2xl:w-4/5 mx-auto flex justify-between items-center px-6">
          <div>
            <a href="{{ url('/') }}" class="block text-2xl sm:text-4xl font-semibold text-gray-100 no-underline">
                {{ config('app.name', 'Blog') }}
            </a>
          </div>
          <button @click="mobileMenuOpen = !mobileMenuOpen" class="inline-block sm:hidden w-8 h-8 bg-gray-100 text-gray-600 p-1 rounded">
            <svg fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M3 5a1 1 0 011-1h12a1 1 0 110 2H4a1 1 0 01-1-1zM3 10a1 1 0 011-1h12a1 1 0 110 2H4a1 1 0 01-1-1zM3 15a1 1 0 011-1h12a1 1 0 110 2H4a1 1 0 01-1-1z" clip-rule="evenodd"></path></svg>
          </button>
          <nav class="absolute sm:relative top-12 left-0 sm:top-0 z-20 sm:flex flex-col sm:flex-row sm:space-x-6 font-semibold w-full sm:w-auto bg-gray-100 sm:bg-transparent text-gray-800 sm:text-white shadow-md sm:shadow-none px-6 py-3 sm:p-0 divide-y divide-dotted divide-gray-300 sm:divide-y-0 border-2 border-yellow-400 sm:border-0 rounded-b-lg"
          :class="{ 'flex' : mobileMenuOpen , 'hidden' : !mobileMenuOpen}"  @click.away="mobileMenuOpen = false"
          >
          <a class="block py-2 no-underline hover:underline" href="/">Home</a>
          <a class="block py-2 no-underline hover:underline" href="/posts">Posts</a>
          @guest
              <a class="block py-2 no-underline hover:underline" href="{{ route('login') }}">{{ __('Login') }}</a>
              @if (Route::has('register'))
                  <a class="block py-2 no-underline hover:underline" href="{{ route('register') }}">{{ __('Register') }}</a>
              @endif
          @else
              <a class="block py-2 sm:px-1 no-underline hover:underline text-yellow-500 sm:bg-yellow-500 sm:rounded sm:text-white" href="/profile/{{ Auth::user()->username }}">{{ Auth::user()->name }}</a>

              @if(Auth::user()->is_admin ==1)
                  <a class="block py-2 sm:px-1 no-underline hover:underline text-blue-700 sm:bg-blue-700 sm:rounded sm:text-white" href="/admin">Admin</a>
              @endif

              <a href="{{ route('logout') }}"
                 class="block py-2 no-underline hover:underline"
                 onclick="event.preventDefault();
                      document.getElementById('logout-form').submit();">{{ __('Logout') }}</a>
              <form id="logout-form" action="{{ route('logout') }}" method="POST" class="hidden">
                  {{ csrf_field() }}
              </form>
          @endguest
        </nav>
      </div>
    </header>


        {{-- <header class="bg-yellow-400 py-1 shadow md:shadow-lg">
            <div class="container mx-auto flex justify-between items-center px-6">
                <div>
                    <a href="{{ url('/') }}" class="text-2xl sm:text-4xl font-semibold text-gray-100 no-underline">
                        {{ config('app.name', 'Blog') }}
                    </a>
                </div>
                <nav class="space-x-4 text-white text-sm sm:text-base">
                    <a class="no-underline hover:underline" href="/">Home</a>
                    <a class="no-underline hover:underline" href="/posts">Posts</a>
                    @guest
                        <a class="no-underline hover:underline" href="{{ route('login') }}">{{ __('Login') }}</a>
                        @if (Route::has('register'))
                            <a class="no-underline hover:underline" href="{{ route('register') }}">{{ __('Register') }}</a>
                        @endif
                    @else
                        <span>{{ Auth::user()->name }}</span>

                        <a href="{{ route('logout') }}"
                           class="no-underline hover:underline"
                           onclick="event.preventDefault();
                                document.getElementById('logout-form').submit();">{{ __('Logout') }}</a>
                        <form id="logout-form" action="{{ route('logout') }}" method="POST" class="hidden">
                            {{ csrf_field() }}
                        </form>
                    @endguest
                </nav>
            </div>
        </header> --}}

        <div>
            @yield('content')
        </div>

        <div>
            @include('layouts.footer')
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/gh/alpinejs/alpine@v2.x.x/dist/alpine.min.js" defer></script>
    <script src="{{ asset('js/trix.js') }}"></script>
    <script src="{{ asset('js/attachments.js') }}"></script>
</body>
</html>
