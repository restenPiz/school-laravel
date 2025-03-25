@extends('layouts.frontend')

@section('content')

<div class="flex justify-center items-center min-h-screen bg-gray-300">
    <div class="w-full max-w-lg mx-auto">
        <!-- Ícone e Texto Fora do Card de Login -->
        <div class="flex flex-col items-center mb-8">
            <!-- Ícone grande -->
            <svg class="h-24 w-24 mb-4 fill-current text-gray-700" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 640 512">
                <path d="M320 0c-17.7 0-32 14.3-32 32v192h64V32c0-17.7-14.3-32-32-32zm-79.5 192.5c-6.7-7.2-17.5-7.7-24.7-1L0 272v160c0 35.3 28.7 64 64 64h256V260.8L240.5 192.5zM320 512h256c35.3 0 64-28.7 64-64V272L424.2 191.5c-7.2-6.7-18-6.2-24.7 1L320 260.8V512zM608 64H32c-17.7 0-32 14.3-32 32v32c0 17.7 14.3 32 32 32h576c17.7 0 32-14.3 32-32V96c0-17.7-14.3-32-32-32z"/>
            </svg>
            <!-- Texto abaixo do ícone -->
            <span class="font-semibold text-xl sm:text-2xl tracking-tight text-gray-700">EducaAqui</span>
        </div>

        <!-- Formulário de Login -->
        <form method="POST" action="{{ route('login') }}" class="bg-gray-100 shadow rounded px-8 pt-6 pb-8 mb-4">
            @csrf
            <div class="mb-4">
                <label class="block text-gray-700 text-sm font-bold mb-2" for="emailaddress">
                    Email Address
                </label>
                <input class="shadow appearance-none border @error('password') border-red-500 @enderror rounded w-full py-2 px-3 text-gray-700 mb-3 leading-tight focus:outline-none focus:shadow-outline" type="email" name="email" id="emailaddress" placeholder="email@example.com">
                @error('email')
                    <p class="text-red-500 text-xs italic">{{ $message }}</p>
                @enderror
            </div>
            <div class="mb-4">
                <label class="block text-gray-700 text-sm font-bold mb-2" for="password">
                    Password
                </label>
                <input class="shadow appearance-none border @error('password') border-red-500 @enderror rounded w-full py-2 px-3 text-gray-700 mb-3 leading-tight focus:outline-none focus:shadow-outline" type="password" name="password" id="password" placeholder="*********">
                @error('password')
                    <p class="text-red-500 text-xs italic">{{ $message }}</p>
                @enderror
            </div>
            <div class="mb-6">
                <label class="block text-gray-500 font-bold">
                    <input class="mr-2 leading-tight" type="checkbox" name="remember" {{ old('remember') ? 'checked' : '' }}>
                    <span class="text-sm">
                        Remember Me
                    </span>
                </label>
            </div>
            <div class="flex items-center justify-between">
                <button style="background-color:#1a1879;" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline" type="submit">
                    Log In
                </button>
            </div>
        </form>
    </div>
</div>

@endsection
