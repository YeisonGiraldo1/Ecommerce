<!-- navigation.blade.php -->
<!-- <nav class="bg-white text-gray-800 p-4">
    <div class="container mx-auto flex justify-between items-center">
        <a href="{{ route('dashboard') }}" class="text-lg font-bold">Your Logo</a>
        
        <div class="flex space-x-4">
            @auth
                <a href="{{ route('profile.edit') }}">Profile</a>
                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <button type="submit">Logout</button>
                </form>
            @else
                <a href="{{ route('login') }}">Login</a>
                @if (Route::has('register'))
                    <a href="{{ route('register') }}">Register</a>
                @endif
            @endauth
        </div>
    </div>
</nav> -->


<!--Nav-->
<!-- navigation.blade.php -->
<nav id="header" class="w-full z-30 top-0 py-1">
    <div class="w-full container mx-auto flex flex-wrap items-center justify-between mt-0 px-6 py-3">

        <label for="menu-toggle" class="cursor-pointer md:hidden block">
            <svg class="fill-current text-gray-900" xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 20 20">
                <title>menu</title>
                <path d="M0 3h20v2H0V3zm0 6h20v2H0V9zm0 6h20v2H0v-2z"></path>
            </svg>
        </label>
        <input class="hidden" type="checkbox" id="menu-toggle" />

        <div class="hidden md:flex md:items-center md:w-auto w-full order-3 md:order-1 relative" id="menu">
            <nav>
                <ul class="md:flex items-center justify-between text-base text-gray-700 pt-4 md:pt-0">
                    <li><a class="inline-block no-underline hover:text-black hover:underline py-2 px-4" href="/">Home</a></li>
                    <li><a class="inline-block no-underline hover:text-black hover:underline py-2 px-4" href="{{route('contact')}}">Contacto</a></li>
                </ul>
            </nav>
        </div>

        <div class="order-1 md:order-2">
            <a class="flex items-center tracking-wide no-underline hover:no-underline font-bold text-gray-800 text-xl " href="#">
                <svg class="fill-current text-gray-800 mr-2" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24">
                    <path d="M5,22h14c1.103,0,2-0.897,2-2V9c0-0.553-0.447-1-1-1h-3V7c0-2.757-2.243-5-5-5S7,4.243,7,7v1H4C3.447,8,3,8.447,3,9v11 C3,21.103,3.897,22,5,22z M9,7c0-1.654,1.346-3,3-3s3,1.346,3,3v1H9V7z M5,10h2v2h2v-2h6v2h2v-2h2l0.002,10H5V10z" />
                </svg>
                ECOMMERCE
            </a>
        </div>

        <div class="order-2 md:order-3 flex items-center relative z-30" id="nav-content">
            @auth
                <a class="inline-block no-underline hover:text-black mr-5 mb-4" href="{{route('cart.index')}}">
                    <div class="t-0 absolute left-3">
                        <p class="flex h-2 w-2 items-center justify-center rounded-full bg-red-500 p-3 text-xs text-white">{{ session('totalproducts', 0) }}</p>
                    </div>
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="file: mt-4 h-6 w-6">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M2.25 3h1.386c.51 0 .955.343 1.087.835l.383 1.437M7.5 14.25a3 3 0 00-3 3h15.75m-12.75-3h11.218c1.121-2.3 2.1-4.684 2.924-7.138a60.114 60.114 0 00-16.536-1.84M7.5 14.25L5.106 5.272M6 20.25a.75.75 0 11-1.5 0 .75.75 0 011.5 0zm12.75 0a.75.75 0 11-1.5 0 .75.75 0 011.5 0z" />
                    </svg>
                </a>
                     
                <div class="relative group">
                    <label for="user-menu" class="cursor-pointer flex items-center tracking-wide no-underline hover:no-underline font-bold text-gray-800 text-xl group-hover:text-black">

                        <p style="font-size: small;">{{ Auth::user()->name }} </p>
                        <svg class="fill-current text-gray-800 mr-2" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24">
                            <circle fill="none" cx="12" cy="7" r="3" />
                            <path d="M12 2C9.243 2 7 4.243 7 7s2.243 5 5 5 5-2.243 5-5S14.757 2 12 2zM12 10c-1.654 0-3-1.346-3-3s1.346-3 3-3 3 1.346 3 3S13.654 10 12 10zM21 21v-1c0-3.859-3.141-7-7-7h-4c-3.86 0-7 3.141-7 7v1h2v-1c0-2.757 2.243-5 5-5h4c2.757 0 5 2.243 5 5v1H21z" />
                        </svg>
                    </label>

                    <input class="hidden" type="checkbox" id="user-menu" />
                    <ul class="absolute hidden text-gray-700 pt-1 group-hover:block right-0 mt-2 bg-white border rounded-md">
                        <li><a class="inline-block no-underline py-2 px-4 w-full" href="{{ route('profile.edit') }}">Perfil</a></li>
                        <li><a class="inline-block no-underline py-2 px-4 w-full" href="{{ route('addresses.index') }}">Mis Direcciones</a></li>
                        <li>
                            <form method="POST" action="{{ route('logout') }}">
                                @csrf
                                <button type="submit" class="inline-block no-underline hover:text-black hover:underline py-2 px-4 w-full">
                                    Cerrar sesión
                                </button>
                            </form>
                        </li>
                    </ul>
                </div>
            @else
                <a class="inline-block no-underline hover:text-black" href="{{ route('login') }}">
                    Iniciar
                </a>
                @if (Route::has('register'))
                    <a class="pl-3 inline-block no-underline hover:text-black" href="{{ route('register') }}">
                        Registrarse
                    </a>
                @endif
            @endauth
        </div>
    </div>
</nav>

<script>
    // Agrega un script para manejar el clic en el icono de usuario
    document.getElementById('nav-content').addEventListener('click', function (e) {
        if (e.target.id === 'menu-toggle' || e.target.id === 'user-menu') {
            document.getElementById('menu').classList.toggle('hidden');
        }
    });
</script>



<!-- <a class="inline-block no-underline hover:text-black" href="{{ route('profile.edit') }}">
                <svg class="fill-current hover:text-black" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24">
                        <path d="M21,7H7.462L5.91,3.586C5.748,3.229,5.392,3,5,3H2v2h2.356L9.09,15.414C9.252,15.771,9.608,16,10,16h8 c0.4,0,0.762-0.238,0.919-0.606l3-7c0.133-0.309,0.101-0.663-0.084-0.944C21.649,7.169,21.336,7,21,7z M17.341,14h-6.697L8.371,9 h11.112L17.341,14z" />
                        <circle cx="10.5" cy="18.5" r="1.5" />
                        <circle cx="17.5" cy="18.5" r="1.5" />
                    </svg>
                     </a> -->