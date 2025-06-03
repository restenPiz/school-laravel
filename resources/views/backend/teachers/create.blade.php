@extends('layouts.app')

@section('content')
    <link rel="stylesheet" href="">
    <link href="https://cdn.jsdelivr.net/npm/flowbite@3.1.2/dist/flowbite.min.css" rel="stylesheet" />
    </link>
    <div class="roles">

        <div class="bg-white shadow-md rounded-lg p-6 max-w-8xl mx-auto">
            <div class="flex items-center justify-between mb-6">
                <h2 class="text-gray-700 uppercase font-bold">Add New Teacher</h2>
                <a href="{{ route('teacher.index') }}"
                    class="bg-gray-700 text-white text-sm uppercase py-2 px-4 flex items-center rounded">
                    <svg class="w-3 h-3 fill-current" aria-hidden="true" xmlns="http://www.w3.org/2000/svg"
                        viewBox="0 0 448 512">
                        <path fill="currentColor"
                            d="M134.059 296H436c6.627 0 12-5.373 12-12v-56c0-6.627-5.373-12-12-12H134.059v-46.059c0-21.382-25.851-32.09-40.971-16.971L7.029 239.029c-9.373 9.373-9.373 24.569 0 33.941l86.059 86.059c15.119 15.119 40.971 4.411 40.971-16.971V296z">
                        </path>
                    </svg>
                    <span class="ml-2 text-xs font-semibold">Back</span>
                </a>
            </div>
            <form action="{{ route('teacher.store') }}" method="POST" enctype="multipart/form-data" class="space-y-6">
                @csrf

                <!-- Primeira linha -->
                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                    <div>
                        <label class="block text-gray-600 font-medium">Name</label>
                        <input placeholder="Write your name" type="text" name="name" value="{{ old('name') }}"
                            class="mt-1 block w-full px-4 py-2 bg-gray-100 border border-gray-300 rounded-md focus:ring-2 focus:ring-blue-500">
                        @error('name')
                            <p class="error-text">{{ $message }}</p>
                        @enderror
                    </div>
                    <div>
                        <label class="block text-gray-600 font-medium">Email</label>
                        <input placeholder="mauropeniel7@gmail.com" type="email" name="email"
                            value="{{ old('email') }}"
                            class="mt-1 block w-full px-4 py-2 bg-gray-100 border border-gray-300 rounded-md focus:ring-2 focus:ring-blue-500">
                        @error('email')
                            <p class="error-text">{{ $message }}</p>
                        @enderror
                    </div>
                </div>

                <!-- Segunda linha -->
                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                    <div>
                        <label class="block text-gray-600 font-medium">Password</label>
                        <input type="password" name="password"
                            class="mt-1 block w-full px-4 py-2 bg-gray-100 border border-gray-300 rounded-md focus:ring-2 focus:ring-blue-500">
                        @error('password')
                            <p class="error-text">{{ $message }}</p>
                        @enderror
                    </div>
                    <div>
                        <label class="block text-gray-600 font-medium">Phone</label>
                        <input type="text" name="phone" value="{{ old('phone') }}"
                            class="mt-1 block w-full px-4 py-2 bg-gray-100 border border-gray-300 rounded-md focus:ring-2 focus:ring-blue-500">
                        @error('phone')
                            <p class="error-text">{{ $message }}</p>
                        @enderror
                    </div>
                </div>

                <!-- Terceira linha -->
                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                    <div>
                        <label class="block text-gray-600 font-medium">Date of Birth</label>
                        <input type="date" name="dateofbirth" value="{{ old('dateofbirth') }}"
                            class="mt-1 block w-full px-4 py-2 bg-gray-100 border border-gray-300 rounded-md focus:ring-2 focus:ring-blue-500">
                        @error('dateofbirth')
                            <p class="error-text">{{ $message }}</p>
                        @enderror
                    </div>
                    <div>
                        <label class="block text-gray-600 font-medium">Gender</label>
                        <div class="flex gap-4">
                            <label class="flex items-center">
                                <input class="bg-gray-600 text-sm font-medium text-gray-900 dark:text-gray-300"
                                    type="radio" name="gender" value="male" class="mr-2"> Male
                            </label>
                            <label class="flex items-center">
                                <input class="bg-gray-600 text-sm font-medium text-gray-900 dark:text-gray-300"
                                    type="radio" name="gender" value="female" class="mr-2"> Female
                            </label>
                            <label class="flex items-center">
                                <input class="bg-gray-600 text-sm font-medium text-gray-900 dark:text-gray-300"
                                    type="radio" name="gender" value="other" class="mr-2"> Other
                            </label>
                        </div>
                        @error('gender')
                            <p class="error-text">{{ $message }}</p>
                        @enderror
                    </div>
                </div>

                <!-- Quarta linha -->
                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                    <div>
                        <label class="block text-gray-600 font-medium">Current Address</label>
                        <input placeholder="ex: Beira" type="text" name="current_address"
                            value="{{ old('current_address') }}"
                            class="mt-1 block w-full px-4 py-2 bg-gray-100 border border-gray-300 rounded-md focus:ring-2 focus:ring-blue-500">
                        @error('current_address')
                            <p class="error-text">{{ $message }}</p>
                        @enderror
                    </div>
                    <div>
                        <label class="block text-gray-600 font-medium">Permanent Address</label>
                        <input placeholder="ex: Chimoio" type="text" name="permanent_address"
                            value="{{ old('permanent_address') }}"
                            class="mt-1 block w-full px-4 py-2 bg-gray-100 border border-gray-300 rounded-md focus:ring-2 focus:ring-blue-500">
                        @error('permanent_address')
                            <p class="error-text">{{ $message }}</p>
                        @enderror
                    </div>
                </div>

                <!-- Quinta linha -->
                <div>
                    <label class="block text-gray-600 font-medium">Profile Picture</label>
                    <input type="file" name="profile_picture"
                        class="mt-1 block w-full px-4 py-2 bg-gray-100 border border-gray-300 rounded-md focus:ring-2 focus:ring-blue-500">
                </div>

                <div class="flex justify-end">
                    <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded hover:bg-blue-600">
                        Submit
                    </button>
                </div>
            </form>
        </div>
    </div>

    <script>
        < script src = "https://cdn.jsdelivr.net/npm/flowbite@3.1.2/dist/flowbite.min.js" >
    </script>
    </script>
@endsection
