<header class="relative px-5 lg:px-0 w-screen left-1/2 -translate-x-1/2 lg:left-0 lg:translate-x-0 lg:w-auto py-5 lg:py-12" x-data="{ open: false, searchOpen: false }">
<div class="flex items-center justify-between container">
    <a class="brand" href="{{ home_url('/') }}">
      <img src="{{ Vite::asset('resources/images/Logo.png') }}" alt="Logo" class="h-8">
    </a>

    @if (has_nav_menu('primary_navigation'))
      <nav class="nav-primary hidden lg:flex items-center space-x-8" aria-label="{{ wp_get_nav_menu_name('primary_navigation') }}">
        {!! wp_nav_menu([
          'theme_location' => 'primary_navigation',
          'menu_class' => 'flex space-x-8 font-semibold text-black',
          'echo' => false,
        ]) !!}
        <div x-data="{ open: false }" class="relative">
          <button @click="open = !open" class="ml-4 cursor-pointer align-middle">
            <svg width="19" height="20" viewBox="0 0 19 20" fill="none" xmlns="http://www.w3.org/2000/svg">
              <path d="M11.6562 0.65625C7.6947 0.65625 4.46875 3.8822 4.46875 7.84375C4.46875 9.56482 5.07239 11.1427 6.08594 12.3809L0.358398 18.1084L1.3916 19.1416L7.11914 13.4141C8.3573 14.4276 9.93518 15.0312 11.6562 15.0312C15.6178 15.0312 18.8438 11.8053 18.8438 7.84375C18.8438 3.8822 15.6178 0.65625 11.6562 0.65625ZM11.6562 2.09375C14.8401 2.09375 17.4062 4.65991 17.4062 7.84375C17.4062 11.0276 14.8401 13.5938 11.6562 13.5938C8.47241 13.5938 5.90625 11.0276 5.90625 7.84375C5.90625 4.65991 8.47241 2.09375 11.6562 2.09375Z" fill="black"/>
            </svg>
          </button>

          <div x-show="open" @click.outside="open = false" class="absolute right-0 mt-2 bg-white shadow-md rounded p-4 z-50 w-72">
            <form role="search" method="get" action="{{ home_url('/') }}" class="flex items-center gap-2">
              <input type="search" name="s" class="w-full border border-gray-300 px-3 py-2 rounded focus:outline-none focus:ring-2 focus:ring-blue-500" placeholder="Search..." />
              <button type="submit" class="text-white bg-black px-4 py-2 rounded hover:bg-gray-800">Go</button>
            </form>
          </div>
        </div>
      </nav>
    @endif

    <div class="lg:hidden flex items-center gap-4">
      <button @click="searchOpen = !searchOpen">
        <svg width="19" height="20" viewBox="0 0 19 20" fill="none" xmlns="http://www.w3.org/2000/svg">
          <path d="M11.6562 0.65625C7.6947 0.65625 4.46875 3.8822 4.46875 7.84375C4.46875 9.56482 5.07239 11.1427 6.08594 12.3809L0.358398 18.1084L1.3916 19.1416L7.11914 13.4141C8.3573 14.4276 9.93518 15.0312 11.6562 15.0312C15.6178 15.0312 18.8438 11.8053 18.8438 7.84375C18.8438 3.8822 15.6178 0.65625 11.6562 0.65625ZM11.6562 2.09375C14.8401 2.09375 17.4062 4.65991 17.4062 7.84375C17.4062 11.0276 14.8401 13.5938 11.6562 13.5938C8.47241 13.5938 5.90625 11.0276 5.90625 7.84375C5.90625 4.65991 8.47241 2.09375 11.6562 2.09375Z" fill="black"/>
        </svg>
      </button>

      <button @click="open = !open">
        <svg class="w-6 h-6" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
          <path d="M4 6h16M4 12h16M4 18h16"></path>
        </svg>
      </button>
    </div>
  </div>

  <div x-show="open" x-transition class="lg:hidden fixed top-0 left-0 right-0 bottom-0 h-full bg-white z-50 p-12 overflow-auto">
    <div class="flex justify-end">
      <button @click="open = false" aria-label="Close menu" class="text-3xl font-bold leading-none text-gray-800 hover:text-black">
        &times;
      </button>
    </div>

    {!! wp_nav_menu([
      'theme_location' => 'primary_navigation',
      'menu_class' => 'flex flex-col gap-6 font-semibold text-lg text-black',
      'echo' => false,
    ]) !!}
  </div>

  <div x-show="searchOpen" @click.outside="searchOpen = false" x-transition class="lg:hidden container mt-4">
    <form role="search" method="get" action="{{ home_url('/') }}" class="flex items-center gap-2">
      <input type="search" name="s" class="w-full border border-gray-300 px-3 py-2 rounded focus:outline-none focus:ring-2 focus:ring-blue-500" placeholder="Search..." />
      <button type="submit" class="text-white bg-black px-4 py-2 rounded hover:bg-gray-800">Go</button>
    </form>
  </div>
</header>
