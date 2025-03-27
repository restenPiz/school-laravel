{{-- @extends('layouts.app')

@section('content')
    <div class="roles">

        <div class="flex items-center justify-between mb-6">
            <div>
                <h2 class="text-gray-700 uppercase font-bold">Add New Teacher</h2>
            </div>
            <div class="flex flex-wrap items-center">
                <a href="{{ route('teacher.index') }}" class="bg-gray-700 text-white text-sm uppercase py-2 px-4 flex items-center rounded">
                    <svg class="w-3 h-3 fill-current" aria-hidden="true" focusable="false" data-prefix="fas" data-icon="long-arrow-alt-left" class="svg-inline--fa fa-long-arrow-alt-left fa-w-14" role="img" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 448 512"><path fill="currentColor" d="M134.059 296H436c6.627 0 12-5.373 12-12v-56c0-6.627-5.373-12-12-12H134.059v-46.059c0-21.382-25.851-32.09-40.971-16.971L7.029 239.029c-9.373 9.373-9.373 24.569 0 33.941l86.059 86.059c15.119 15.119 40.971 4.411 40.971-16.971V296z"></path></svg>
                    <span class="ml-2 text-xs font-semibold">Back</span>
                </a>
            </div>
        </div>
        <!-- Log on to codeastro.com for more projects -->
        <div class="table w-full mt-8 bg-white rounded">
            <form action="{{ route('teacher.store') }}" method="POST" class="w-full max-w-xl px-6 py-12" enctype="multipart/form-data">
                @csrf
                <div class="md:flex md:items-center mb-6">
                    <div class="md:w-1/3">
                        <label class="block text-gray-500 font-bold md:text-right mb-1 md:mb-0 pr-4">
                            Name
                        </label>
                    </div>
                    <div class="md:w-2/3">
                        <input name="name" class="bg-gray-200 appearance-none border-2 border-gray-200 rounded w-full py-2 px-4 text-gray-700 leading-tight focus:outline-none focus:bg-white focus:border-blue-500" type="text" value="{{ old('name') }}">
                        @error('name')
                            <p class="text-red-500 text-xs italic">{{ $message }}</p>
                        @enderror
                    </div>
                </div>
                <div class="md:flex md:items-center mb-6">
                    <div class="md:w-1/3">
                        <label class="block text-gray-500 font-bold md:text-right mb-1 md:mb-0 pr-4">
                            Email
                        </label>
                    </div>
                    <div class="md:w-2/3">
                        <input name="email" class="bg-gray-200 appearance-none border-2 border-gray-200 rounded w-full py-2 px-4 text-gray-700 leading-tight focus:outline-none focus:bg-white focus:border-blue-500" type="email" value="{{ old('email') }}">
                        @error('email')
                            <p class="text-red-500 text-xs italic">{{ $message }}</p>
                        @enderror
                    </div>
                </div>
                <div class="md:flex md:items-center mb-6">
                    <div class="md:w-1/3">
                        <label class="block text-gray-500 font-bold md:text-right mb-1 md:mb-0 pr-4">
                            Password
                        </label>
                    </div>
                    <div class="md:w-2/3">
                        <input name="password" class="bg-gray-200 appearance-none border-2 border-gray-200 rounded w-full py-2 px-4 text-gray-700 leading-tight focus:outline-none focus:bg-white focus:border-blue-500" type="password">
                        @error('password')
                            <p class="text-red-500 text-xs italic">{{ $message }}</p>
                        @enderror
                    </div>
                </div>
                <div class="md:flex md:items-center mb-6">
                    <div class="md:w-1/3">
                        <label class="block text-gray-500 font-bold md:text-right mb-1 md:mb-0 pr-4">
                            Phone
                        </label>
                    </div>
                    <div class="md:w-2/3">
                        <input name="phone" class="bg-gray-200 appearance-none border-2 border-gray-200 rounded w-full py-2 px-4 text-gray-700 leading-tight focus:outline-none focus:bg-white focus:border-blue-500" type="text" value="{{ old('phone') }}">
                        @error('phone')
                            <p class="text-red-500 text-xs italic">{{ $message }}</p>
                        @enderror
                    </div>
                </div>
                <!-- Log on to codeastro.com for more projects -->
                <div class="md:flex md:items-center mb-6">
                    <div class="md:w-1/3">
                        <label class="block text-gray-500 font-bold md:text-right mb-1 md:mb-0 pr-4">
                            Gender
                        </label>
                    </div>
                    <div class="md:w-2/3">
                        <div class="flex flex-row items-center">
                            <label class="block text-gray-500 font-bold">
                                <input name="gender" class="mr-2 leading-tight" type="radio" value="male">
                                <span class="text-sm">Male</span>
                            </label>
                            <label class="ml-4 block text-gray-500 font-bold">
                                <input name="gender" class="mr-2 leading-tight" type="radio" value="female">
                                <span class="text-sm">Female</span>
                            </label>
                            <label class="ml-4 block text-gray-500 font-bold">
                                <input name="gender" class="mr-2 leading-tight" type="radio" value="other">
                                <span class="text-sm">Other</span>
                            </label>
                        </div>
                        @error('gender')
                            <p class="text-red-500 text-xs italic">{{ $message }}</p>
                        @enderror
                    </div>
                </div>
                <div class="md:flex md:items-center mb-6">
                    <div class="md:w-1/3">
                        <label class="block text-gray-500 font-bold md:text-right mb-1 md:mb-0 pr-4">
                            Date of Birth
                        </label>
                    </div>
                    <div class="md:w-2/3">
                        <input name="dateofbirth" id="datepicker-tc" autocomplete="off" class="bg-gray-200 appearance-none border-2 border-gray-200 rounded w-full py-2 px-4 text-gray-700 leading-tight focus:outline-none focus:bg-white focus:border-blue-500" type="date" value="{{ old('dateofbirth') }}">
                        @error('dateofbirth')
                            <p class="text-red-500 text-xs italic">{{ $message }}</p>
                        @enderror
                    </div>
                </div>
                <div class="md:flex md:items-center mb-6">
                    <div class="md:w-1/3">
                        <label class="block text-gray-500 font-bold md:text-right mb-1 md:mb-0 pr-4">
                            Current Address
                        </label>
                    </div>
                    <div class="md:w-2/3">
                        <input name="current_address" class="bg-gray-200 appearance-none border-2 border-gray-200 rounded w-full py-2 px-4 text-gray-700 leading-tight focus:outline-none focus:bg-white focus:border-blue-500" type="text" value="{{ old('current_address') }}">
                        @error('current_address')
                            <p class="text-red-500 text-xs italic">{{ $message }}</p>
                        @enderror
                    </div>
                </div>
                <div class="md:flex md:items-center mb-6">
                    <div class="md:w-1/3">
                        <label class="block text-gray-500 font-bold md:text-right mb-1 md:mb-0 pr-4">
                            Permanent Address
                        </label>
                    </div>
                    <div class="md:w-2/3">
                        <input name="permanent_address" class="bg-gray-200 appearance-none border-2 border-gray-200 rounded w-full py-2 px-4 text-gray-700 leading-tight focus:outline-none focus:bg-white focus:border-blue-500" type="text" value="{{ old('permanent_address') }}">
                        @error('permanent_address')
                            <p class="text-red-500 text-xs italic">{{ $message }}</p>
                        @enderror
                    </div>
                </div>
                <div class="md:flex md:items-center mb-6">
                    <div class="md:w-1/3">
                        <label class="block text-gray-500 font-bold md:text-right mb-1 md:mb-0 pr-4">
                            Picture :
                        </label>
                    </div>
                    <div class="md:w-2/3">
                        <input name="profile_picture" class="bg-gray-200 appearance-none border-2 border-gray-200 rounded w-full py-2 px-4 text-gray-700 leading-tight focus:outline-none focus:bg-white focus:border-blue-500" type="file">
                    </div>
                </div>

                <div class="md:flex md:items-center">
                    <div class="md:w-1/3"></div>
                    <div class="md:w-2/3">
                        <button class="shadow bg-blue-500 hover:bg-blue-400 focus:shadow-outline focus:outline-none text-white font-bold py-2 px-4 rounded" type="submit">
                            Submit
                        </button>
                    </div>
                </div>
            </form>        
        </div>
        <!-- Log on to codeastro.com for more projects -->
    </div>
@endsection

@push('scripts')
<script>
    $(function() {       
        $( "#datepicker-tc" ).datepicker({ dateFormat: 'yy-mm-dd' });
    })
</script>
@endpush --}}

@extends('layouts.app')

@section('content')
<link rel="stylesheet" href="">
    <link href="https://cdn.jsdelivr.net/npm/flowbite@3.1.2/dist/flowbite.min.css" rel="stylesheet" />
</link>
<div class="roles">
    <div class="flex items-center justify-between mb-6">
        <h2 class="text-gray-700 uppercase font-bold">Add New Teacher</h2>
        <a href="{{ route('teacher.index') }}" class="bg-gray-700 text-white text-sm uppercase py-2 px-4 flex items-center rounded">
            <svg class="w-3 h-3 fill-current" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 448 512">
                <path fill="currentColor" d="M134.059 296H436c6.627 0 12-5.373 12-12v-56c0-6.627-5.373-12-12-12H134.059v-46.059c0-21.382-25.851-32.09-40.971-16.971L7.029 239.029c-9.373 9.373-9.373 24.569 0 33.941l86.059 86.059c15.119 15.119 40.971 4.411 40.971-16.971V296z"></path>
            </svg>
            <span class="ml-2 text-xs font-semibold">Back</span>
        </a>
    </div>

    <div class="bg-white shadow-md rounded-lg p-6 max-w-8xl mx-auto">
        <form action="{{ route('teacher.store') }}" method="POST" enctype="multipart/form-data" class="space-y-6">
            @csrf

            <!-- Primeira linha -->
            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                <div>
                    <label class="block text-gray-700 font-semibold">Name</label>
                    <input placeholder="Write your name" type="text" name="name" value="{{ old('name') }}" class="input-field">
                    @error('name') <p class="error-text">{{ $message }}</p> @enderror
                </div>
                <div>
                    <label class="block text-gray-700 font-semibold">Email</label>
                    <input placeholder="mauropeniel7@gmail.com" type="email" name="email" value="{{ old('email') }}" class="input-field">
                    @error('email') <p class="error-text">{{ $message }}</p> @enderror
                </div>
            </div>

            <!-- Segunda linha -->
            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                <div>
                    <label class="block text-gray-700 font-semibold">Password</label>
                    <input type="password" name="password" class="input-field">
                    @error('password') <p class="error-text">{{ $message }}</p> @enderror
                </div>
                <div>
                    <label class="block text-gray-700 font-semibold">Phone</label>
                    <input type="text" name="phone" value="{{ old('phone') }}" class="input-field">
                    @error('phone') <p class="error-text">{{ $message }}</p> @enderror
                </div>
            </div>

            <!-- Terceira linha -->
            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                <div>
                    <label class="block text-gray-700 font-semibold">Date of Birth</label>
                    <input type="date" name="dateofbirth" value="{{ old('dateofbirth') }}" class="input-field">
                    @error('dateofbirth') <p class="error-text">{{ $message }}</p> @enderror
                </div>
                <div>
                    <label class="block text-gray-700 font-semibold">Gender</label>
                    <div class="flex gap-4">
                        <label class="flex items-center">
                            <input class="bg-gray-600 text-sm font-medium text-gray-900 dark:text-gray-300" type="radio" name="gender" value="male" class="mr-2"> Male
                        </label>
                        <label class="flex items-center">
                            <input class="bg-gray-600 text-sm font-medium text-gray-900 dark:text-gray-300" type="radio" name="gender" value="female" class="mr-2"> Female
                        </label>
                        <label class="flex items-center">
                            <input class="bg-gray-600 text-sm font-medium text-gray-900 dark:text-gray-300" type="radio" name="gender" value="other" class="mr-2"> Other
                        </label>
                    </div>
                    @error('gender') <p class="error-text">{{ $message }}</p> @enderror
                </div>
            </div>

            <!-- Quarta linha -->
            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                <div>
                    <label class="block text-gray-700 font-semibold">Current Address</label>
                    <input placeholder="ex: Beira" type="text" name="current_address" value="{{ old('current_address') }}" class="input-field">
                    @error('current_address') <p class="error-text">{{ $message }}</p> @enderror
                </div>
                <div>
                    <label class="block text-gray-700 font-semibold">Permanent Address</label>
                    <input placeholder="ex: Chimoio" type="text" name="permanent_address" value="{{ old('permanent_address') }}" class="input-field">
                    @error('permanent_address') <p class="error-text">{{ $message }}</p> @enderror
                </div>
            </div>

            <!-- Quinta linha -->
            <div>
                <label class="block text-gray-700 font-semibold">Profile Picture</label>
                <input type="file" name="profile_picture" class="w-full border border-gray-300 rounded p-2">
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
    <script src="https://cdn.jsdelivr.net/npm/flowbite@3.1.2/dist/flowbite.min.js"></script>
</script>
<!-- Estilos para inputs -->
<style>
    .input-field {
        width: 100%;
        padding: 10px;
        border: 1px solid #ccc;
        border-radius: 6px;
        focus: outline-none ring-2 ring-blue-500;
    }
    .error-text {
        color: red;
        font-size: 12px;
        margin-top: 2px;
    }
</style>

@endsection
