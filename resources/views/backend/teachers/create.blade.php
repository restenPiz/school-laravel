@extends('layouts.app')

@section('content')
    <div class="max-w-8xl mx-auto p-6 bg-white shadow-lg rounded-lg">

        <div class="flex items-center justify-between mb-6">
            <h2 class="text-3xl font-semibold text-gray-700">Add New Teacher</h2>
            <a href="{{ route('teacher.index') }}" class="bg-gray-700 text-white text-sm uppercase py-2 px-4 flex items-center rounded-md hover:bg-gray-600 transition-colors">
                <svg class="w-4 h-4 fill-current" aria-hidden="true" focusable="false" data-prefix="fas" data-icon="long-arrow-alt-left" role="img" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 448 512">
                    <path fill="currentColor" d="M134.059 296H436c6.627 0 12-5.373 12-12v-56c0-6.627-5.373-12-12-12H134.059v-46.059c0-21.382-25.851-32.09-40.971-16.971L7.029 239.029c-9.373 9.373-9.373 24.569 0 33.941l86.059 86.059c15.119 15.119 40.971 4.411 40.971-16.971V296z"></path>
                </svg>
                <span class="ml-2 text-xs font-semibold">Back</span>
            </a>
        </div>

        <div class="bg-white rounded-lg shadow-md p-6">
            <form action="{{ route('teacher.store') }}" method="POST" class="space-y-6" enctype="multipart/form-data">
                @csrf

                <!-- Name and Email side by side -->
                <div class="grid grid-cols-2 gap-6">
                    <div class="flex flex-col">
                        <label for="name" class="text-gray-600 font-semibold">Name</label>
                        <input name="name" type="text" value="{{ old('name') }}" class="w-full p-3 border-2 border-gray-300 rounded-md focus:ring-2 focus:ring-blue-500" id="name">
                        @error('name')
                            <p class="text-red-500 text-xs italic">{{ $message }}</p>
                        @enderror
                    </div>
                    <div class="flex flex-col">
                        <label for="email" class="text-gray-600 font-semibold">Email</label>
                        <input name="email" type="email" value="{{ old('email') }}" class="w-full p-3 border-2 border-gray-300 rounded-md focus:ring-2 focus:ring-blue-500" id="email">
                        @error('email')
                            <p class="text-red-500 text-xs italic">{{ $message }}</p>
                        @enderror
                    </div>
                </div>

                <!-- Password and Phone side by side -->
                <div class="grid grid-cols-2 gap-6">
                    <div class="flex flex-col">
                        <label for="password" class="text-gray-600 font-semibold">Password</label>
                        <input name="password" type="password" class="w-full p-3 border-2 border-gray-300 rounded-md focus:ring-2 focus:ring-blue-500" id="password">
                        @error('password')
                            <p class="text-red-500 text-xs italic">{{ $message }}</p>
                        @enderror
                    </div>
                    <div class="flex flex-col">
                        <label for="phone" class="text-gray-600 font-semibold">Phone</label>
                        <input name="phone" type="text" value="{{ old('phone') }}" class="w-full p-3 border-2 border-gray-300 rounded-md focus:ring-2 focus:ring-blue-500" id="phone">
                        @error('phone')
                            <p class="text-red-500 text-xs italic">{{ $message }}</p>
                        @enderror
                    </div>
                </div>

                <!-- Gender -->
                <div class="flex justify-between items-center">
                    <label class="text-gray-600 font-semibold">Gender</label>
                    <div class="flex items-center space-x-6">
                        <label class="flex items-center">
                            <input name="gender" type="radio" value="male" class="mr-2">
                            Male
                        </label>
                        <label class="flex items-center">
                            <input name="gender" type="radio" value="female" class="mr-2">
                            Female
                        </label>
                        <label class="flex items-center">
                            <input name="gender" type="radio" value="other" class="mr-2">
                            Other
                        </label>
                    </div>
                </div>
                @error('gender')
                    <p class="text-red-500 text-xs italic">{{ $message }}</p>
                @enderror

                <!-- Date of Birth and Addresses side by side -->
                <div class="grid grid-cols-2 gap-6">
                    <div class="flex flex-col">
                        <label for="dateofbirth" class="text-gray-600 font-semibold">Date of Birth</label>
                        <input name="dateofbirth" id="datepicker-tc" type="text" value="{{ old('dateofbirth') }}" class="w-full p-3 border-2 border-gray-300 rounded-md focus:ring-2 focus:ring-blue-500" autocomplete="off">
                        @error('dateofbirth')
                            <p class="text-red-500 text-xs italic">{{ $message }}</p>
                        @enderror
                    </div>
                    <div class="flex flex-col">
                        <label for="current_address" class="text-gray-600 font-semibold">Current Address</label>
                        <input name="current_address" type="text" value="{{ old('current_address') }}" class="w-full p-3 border-2 border-gray-300 rounded-md focus:ring-2 focus:ring-blue-500" id="current_address">
                        @error('current_address')
                            <p class="text-red-500 text-xs italic">{{ $message }}</p>
                        @enderror
                    </div>
                </div>

                <!-- Permanent Address and Profile Picture side by side -->
                <div class="grid grid-cols-2 gap-6">
                    <div class="flex flex-col">
                        <label for="permanent_address" class="text-gray-600 font-semibold">Permanent Address</label>
                        <input name="permanent_address" type="text" value="{{ old('permanent_address') }}" class="w-full p-3 border-2 border-gray-300 rounded-md focus:ring-2 focus:ring-blue-500" id="permanent_address">
                        @error('permanent_address')
                            <p class="text-red-500 text-xs italic">{{ $message }}</p>
                        @enderror
                    </div>
                    <div class="flex flex-col">
                        <label for="profile_picture" class="text-gray-600 font-semibold">Profile Picture</label>
                        <input name="profile_picture" type="file" class="w-full p-3 border-2 border-gray-300 rounded-md focus:ring-2 focus:ring-blue-500" id="profile_picture">
                    </div>
                </div>

                <!-- Submit Button -->
                <div class="flex justify-end mt-6">
                    <button type="submit" class="bg-blue-600 text-white px-6 py-3 rounded-md hover:bg-blue-500 focus:ring-2 focus:ring-blue-400 transition-colors">
                        Submit
                    </button>
                </div>
            </form>
        </div>
    </div>

@endsection

@push('scripts')
<script>
    $(function() {       
        $( "#datepicker-tc" ).datepicker({ dateFormat: 'yy-mm-dd' });
    })
</script>
@endpush
