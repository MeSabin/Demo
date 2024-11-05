<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Dashboard</title>
    @vite('resources/css/app.css')
</head>
<style>
    .active {
        background-color: rgb(75 85 99);
        color: white;
    }
</style>

<body>
    <div class=" min-h-screen">
        {{-- <div class=" "> --}}
        <aside class="bg-gray-200 fixed top-0 min-h-screen w-64">
            <div class="flex items-center gap-8 px-4 pt-4 mb-10">
                <div>
                    <img src="{{ asset('images/ecommerce.png') }}" alt="Image not found" class="w-16 h-16">
                </div>
                <div>
                    <p class="font-bold text-lg">E-commerce</p>
                </div>
            </div>
            <nav>
                <ul class="px-2 rounded">
                    <li>
                        <a href="{{ route('dashboard') }}"
                            class="{{ Route::is('dashboard') ? 'active' : '' }} py-2 pl-8 hover:bg-gray-600 hover:text-white hover:duration-200 rounded font-semibold text-base block">Dashboard</a>
                    </li>
                    <li>
                        <a href="{{ route('product-category.index') }}"
                            class=" font-semibold text-base pl-8 mt-4 {{ Route::is('product-category*') ? 'active' : '' }} py-2 rounded block hover:bg-gray-600 hover:text-white hover:duration-200 ">Product
                            Category</a>
                    </li>
                    <li>
                        <a href="{{ route('products.index') }}"
                            class="font-semibold text-base pl-8 mt-4 py-2 rounded {{ Route::is('products*') ? 'active' : '' }} block hover:bg-gray-600 hover:text-white hover:duration-300">Products</a>
                    </li>
                    <li>
                        <a href="{{ route('roles.index') }}"
                            class="font-semibold text-base pl-8 mt-4 py-2 rounded {{ Route::is('roles*') ? 'active' : '' }} block hover:bg-gray-600 hover:text-white hover:duration-300">Manage
                            Roles</a>
                    </li>
                </ul>
            </nav>
        </aside>
        {{-- </div> --}}
        <header
            class="fixed border left-[256px] top-0 right-0 bg-gray-200 py-5 px-2 flex justify-between items-center z-50">
            <div class="ml-10 flex gap-8">
                <div class="font-bold text-lg text-gray-500">
                    @yield('pageName')
                </div>
            </div>
            <div class="mr-6 cursor-pointer flex items-center gap-3 text-gray-600" id="profile">
                <img src="{{ asset('images/profile.png') }}" alt="Image not found" class="w-10 h-10">
                <p class="font-bold text-sm">Hi, {{ Auth::user()->name }}</p>
            </div>
            <div class="hidden absolute top-16 right-36  border bg-white border-gray-500 text-sm shadow-lg rounded-md p-4"
                id="profile_modal">
                <p class="text-gray-600 font-bold">Email: {{ Auth::user()->email }}</p>
                <p class="text-gray-600 font-bold">Name: {{ Auth::user()->name }}</p>
                <a href="{{ route('Logout') }}"
                    class="text-gray-600 font-bold hover:text-blue-500 duration-200 ">Logout</a>

            </div>
        </header>



        <div class="ml-[256px] mt-10 min-h-screen flex justify-center items-center">
            @yield('content')
        </div>

    </div>
    <script src="{{ asset('js/profileModal.js') }}"></script>
</body>

</html>
