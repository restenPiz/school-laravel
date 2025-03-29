@extends('layouts.app')

@section('content')
    <link rel="stylesheet" href="">
    <link href="https://cdn.jsdelivr.net/npm/flowbite@3.1.2/dist/flowbite.min.css" rel="stylesheet" />
    </link>
    <div class="roles">

        <div class="flex items-center justify-between mb-6">
            <div>
                <h2 class="text-gray-700 uppercase font-bold">Edit Parent</h2>
            </div>
            <div class="flex flex-wrap items-center">
                <a href="{{ route('parents.index') }}"
                    class="bg-gray-700 text-white text-sm uppercase py-2 px-4 flex items-center rounded">
                    <svg class="w-3 h-3 fill-current" aria-hidden="true" focusable="false" data-prefix="fas"
                        data-icon="long-arrow-alt-left" class="svg-inline--fa fa-long-arrow-alt-left fa-w-14" role="img"
                        xmlns="http://www.w3.org/2000/svg" viewBox="0 0 448 512">
                        <path fill="currentColor"
                            d="M134.059 296H436c6.627 0 12-5.373 12-12v-56c0-6.627-5.373-12-12-12H134.059v-46.059c0-21.382-25.851-32.09-40.971-16.971L7.029 239.029c-9.373 9.373-9.373 24.569 0 33.941l86.059 86.059c15.119 15.119 40.971 4.411 40.971-16.971V296z">
                        </path>
                    </svg>
                    <span class="ml-2 text-xs font-semibold">Back</span>
                </a>
            </div>
        </div>
        <!-- Log on to codeastro.com for more projects -->
        <div class="bg-white shadow-md rounded-lg p-6 max-w-8xl mx-auto">
            <form action="{{ route('parents.update', $parent->id) }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')

                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                    <div>
                        <label class="block text-gray-600 font-medium">Name</label>
                        <input name="name"
                            class="mt-1 block w-full px-4 py-2 bg-gray-100 border border-gray-300 rounded-md focus:ring-2 focus:ring-blue-500"
                            type="text" value="{{ $parent->user->name }}">
                        @error('name')
                            <p class="text-red-500 text-xs italic">{{ $message }}</p>
                        @enderror
                    </div>
                    <div>
                        <label class="block text-gray-600 font-medium">Email</label>
                        <input name="email"
                            class="mt-1 block w-full px-4 py-2 bg-gray-100 border border-gray-300 rounded-md focus:ring-2 focus:ring-blue-500"
                            type="email" value="{{ $parent->user->email }}">
                        @error('email')
                            <p class="text-red-500 text-xs italic">{{ $message }}</p>
                        @enderror
                    </div>
                </div>
                <div style="margin-top:1rem" class="grid grid-cols-1 md:grid-cols-2 gap-4">
                    <div>
                        <label class="block text-gray-700 font-semibold">Password</label>
                        <input type="password" name="password"
                            class="mt-1 block w-full px-4 py-2 bg-gray-100 border border-gray-300 rounded-md focus:ring-2 focus:ring-blue-500">
                        @error('password')
                            <p class="error-text">{{ $message }}</p>
                        @enderror
                    </div>
                    <div>
                        <label class="block text-gray-600 font-medium">Phone</label>
                        <input name="phone"
                            class="mt-1 block w-full px-4 py-2 bg-gray-100 border border-gray-300 rounded-md focus:ring-2 focus:ring-blue-500"
                            type="text" value="{{ $parent->phone }}">
                        @error('phone')
                            <p class="text-red-500 text-xs italic">{{ $message }}</p>
                        @enderror
                    </div>
                </div>
                <div style="margin-top:1rem" class="grid grid-cols-1 md:grid-cols-2 gap-4">
                    <div>
                        <label class="block text-gray-600 font-medium">Current Address</label>
                        <input name="current_address"
                            class="mt-1 block w-full px-4 py-2 bg-gray-100 border border-gray-300 rounded-md focus:ring-2 focus:ring-blue-500"
                            type="text" value="{{ $parent->current_address }}">
                        @error('current_address')
                            <p class="text-red-500 text-xs italic">{{ $message }}</p>
                        @enderror
                    </div>
                    <div>
                        <label class="block text-gray-600 font-medium">Gender</label>
                        <div class="flex gap-4">
                            <label><input name="gender" type="radio" value="male"
                                    {{ $parent->gender == 'male' ? 'checked' : '' }}> Male</label>
                            <label><input name="gender" type="radio" value="female"
                                    {{ $parent->gender == 'female' ? 'checked' : '' }}> Female</label>
                            <label><input name="gender" type="radio" value="other"
                                    {{ $parent->gender == 'other' ? 'checked' : '' }}> Other</label>
                        </div>
                        @error('gender')
                            <p class="text-red-500 text-xs italic">{{ $message }}</p>
                        @enderror
                    </div>
                </div>
                <div style="margin-top:1rem" class="grid grid-cols-1 md:grid-cols-2 gap-4">
                    <div>
                        <label class="block text-gray-600 font-medium">Permanent Address</label>
                        <input name="permanent_address"
                            class="mt-1 block w-full px-4 py-2 bg-gray-100 border border-gray-300 rounded-md focus:ring-2 focus:ring-blue-500"
                            type="text" value="{{ $parent->permanent_address }}">
                        @error('permanent_address')
                            <p class="text-red-500 text-xs italic">{{ $message }}</p>
                        @enderror
                    </div>
                    <div>
                        <label class="block text-gray-600 font-medium">Profile Picture</label>
                        <input name="profile_picture"
                            class="mt-1 block w-full px-4 py-2 bg-gray-100 border border-gray-300 rounded-md focus:ring-2 focus:ring-blue-500"
                            type="file">
                    </div>
                </div>
                <div style="margin-top:1rem" class="flex justify-end">
                    <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded hover:bg-blue-600">
                        Update Teacher
                    </button>
                </div>

            </form>
        </div>
        <!-- Log on to codeastro.com for more projects -->
    </div>
@endsection
