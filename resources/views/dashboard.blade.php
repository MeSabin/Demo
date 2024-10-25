<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Dashboard</title>
    @vite('resources/css/app.css')
</head>

<body>
    <div>
        <aside class="bg-gray-200 w-64 min-h-screen">
            <div class="flex items-center gap-8 px-4 pt-4 mb-10">
                <div>
                    <img src="{{ asset('images/ecommerce.png') }}" alt="Image not found" class="w-16">
                </div>
                <div>
                    <p class="font-bold text-lg">E-commerce</p>
                </div>
            </div>
            <nav>
                <ul>
                    <li>
                        <a href="" class="text-gray-500 font-semibold text-base pl-8">Product Category</a>
                    </li>
                    <li class="mt-4">
                        <a href="" class="text-gray-500 font-semibold text-base pl-8">Products</a>
                    </li>
                </ul>
            </nav>
        </aside>
        <div class="">
            <header class="fixed left-[256px] top-0 right-0 bg-gray-200 py-5 px-2 flex i justify-between items-center">
                <div class="ml-10 flex gap-8">
                    <div>
                        <p class="">User Dashboard</p>
                    </div>
                    <div>
                        <p class="text-green-700 text-lg font-semibold ">Verified</p>
                        @if (session('loginSuccess'))
                            <p class="text-green-700">{{ session('loginSuccess') }}</p>
                        @endif
                    </div>
                </div>
                <div class="mr-6 cursor-pointer" id="profile">
                    <img src="{{ asset('images/profile.png') }}" alt="Image not found" class="w-10">
                </div>
                <div class="hidden absolute top-16 right-6  border bg-white border-gray-500 text-sm shadow-lg rounded-md p-4"
                    id="profile_modal">
                    <p class="text-blue-500">Your Email: {{ Auth::user()->email }}</p>
                    <p class="text-blue-500">Your Name: {{ Auth::user()->name }}</p>
                    <a href="{{ route('Logout') }}" class="text-blue-500">Logout</a>

                </div>
            </header>
        </div>
    </div>

    <script>
        window.addEventListener('load', function() {
            let profile = document.querySelector('#profile');
            let profileModal = document.querySelector('#profile_modal');

            profile.onclick = function() {
                console.log('Cliked');
                if (profileModal.style.display == 'block') {
                    profileModal.style.display = 'none';
                } else {
                    profileModal.style.display = 'block';
                }
            }
        });
    </script>
</body>

</html>
