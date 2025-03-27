{{-- @extends('layouts.app')

@section('content')
    <div class="roles">

        <div class="flex items-center justify-between mb-6">
            <div>
                <h2 class="text-gray-700 uppercase font-bold">Edit Teacher</h2>
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
            <form action="{{ route('teacher.update',$teacher->id) }}" method="POST" class="w-full max-w-xl px-6 py-12" enctype="multipart/form-data">
                @csrf
                @method('PUT')

                <div class="md:flex md:items-center mb-6">
                    <div class="md:w-1/3"></div>
                    <div class="md:w-2/3">
                        <img class="w-20 h-20 sm:w-32 sm:h-32 rounded" src="{{ asset('images/profile/' .$teacher->user->profile_picture) }}" alt="avatar">
                    </div>
                </div>
                <div class="md:flex md:items-center mb-6">
                    <div class="md:w-1/3">
                        <label class="block text-gray-500 font-bold md:text-right mb-1 md:mb-0 pr-4">
                            Name
                        </label>
                    </div>
                    <div class="md:w-2/3">
                        <input name="name" class="bg-gray-200 appearance-none border-2 border-gray-200 rounded w-full py-2 px-4 text-gray-700 leading-tight focus:outline-none focus:bg-white focus:border-blue-500" type="text" value="{{ $teacher->user->name }}">
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
                        <input name="email" class="bg-gray-200 appearance-none border-2 border-gray-200 rounded w-full py-2 px-4 text-gray-700 leading-tight focus:outline-none focus:bg-white focus:border-blue-500" type="email" value="{{ $teacher->user->email }}">
                        @error('email')
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
                        <input name="phone" class="bg-gray-200 appearance-none border-2 border-gray-200 rounded w-full py-2 px-4 text-gray-700 leading-tight focus:outline-none focus:bg-white focus:border-blue-500" type="text" value="{{ $teacher->phone }}">
                        @error('phone')
                            <p class="text-red-500 text-xs italic">{{ $message }}</p>
                        @enderror
                    </div>
                </div>
                <div class="md:flex md:items-center mb-6">
                    <div class="md:w-1/3">
                        <label class="block text-gray-500 font-bold md:text-right mb-1 md:mb-0 pr-4">
                            Gender
                        </label>
                    </div>
                    <div class="md:w-2/3">
                        <div class="flex flex-row items-center">
                            <label class="block text-gray-500 font-bold">
                                <input name="gender" class="mr-2 leading-tight" type="radio" value="male" {{ ($teacher->gender == 'male') ? 'checked' : '' }}>
                                <span class="text-sm">Male</span>
                            </label>
                            <label class="ml-4 block text-gray-500 font-bold">
                                <input name="gender" class="mr-2 leading-tight" type="radio" value="female" {{ ($teacher->gender == 'female') ? 'checked' : '' }}>
                                <span class="text-sm">Female</span>
                            </label>
                            <label class="ml-4 block text-gray-500 font-bold">
                                <input name="gender" class="mr-2 leading-tight" type="radio" value="other" {{ ($teacher->gender == 'other') ? 'checked' : '' }}>
                                <span class="text-sm">Other</span>
                            </label>
                        </div>
                        @error('gender')
                            <p class="text-red-500 text-xs italic">{{ $message }}</p>
                        @enderror
                    </div>
                </div>
                <!-- Log on to codeastro.com for more projects -->
                <div class="md:flex md:items-center mb-6">
                    <div class="md:w-1/3">
                        <label class="block text-gray-500 font-bold md:text-right mb-1 md:mb-0 pr-4">
                            Date of Birth
                        </label>
                    </div>
                    <div class="md:w-2/3">
                        <input name="dateofbirth" id="datepicker-te" autocomplete="off" class="bg-gray-200 appearance-none border-2 border-gray-200 rounded w-full py-2 px-4 text-gray-700 leading-tight focus:outline-none focus:bg-white focus:border-blue-500" type="text" value="{{ $teacher->dateofbirth }}">
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
                        <input name="current_address" class="bg-gray-200 appearance-none border-2 border-gray-200 rounded w-full py-2 px-4 text-gray-700 leading-tight focus:outline-none focus:bg-white focus:border-blue-500" type="text" value="{{ $teacher->current_address }}">
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
                        <input name="permanent_address" class="bg-gray-200 appearance-none border-2 border-gray-200 rounded w-full py-2 px-4 text-gray-700 leading-tight focus:outline-none focus:bg-white focus:border-blue-500" type="text" value="{{ $teacher->permanent_address }}">
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
                            Update Teacher
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
        $( "#datepicker-te" ).datepicker({ dateFormat: 'yy-mm-dd' });
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
            <h2 class="text-gray-700 uppercase font-bold">Edit Teacher</h2>
            <a href="{{ route('teacher.index') }}" class="bg-gray-700 text-white text-sm uppercase py-2 px-4 flex items-center rounded">
                <svg class="w-3 h-3 fill-current" aria-hidden="true" focusable="false" data-prefix="fas" data-icon="long-arrow-alt-left" class="svg-inline--fa fa-long-arrow-alt-left fa-w-14" role="img" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 448 512"><path fill="currentColor" d="M134.059 296H436c6.627 0 12-5.373 12-12v-56c0-6.627-5.373-12-12-12H134.059v-46.059c0-21.382-25.851-32.09-40.971-16.971L7.029 239.029c-9.373 9.373-9.373 24.569 0 33.941l86.059 86.059c15.119 15.119 40.971 4.411 40.971-16.971V296z"></path></svg>
                <span class="ml-2 text-xs font-semibold">Back</span>
            </a>
        </div>
        <div class="bg-white shadow-md rounded-lg p-6 max-w-8xl mx-auto">
            <form id="editTeacherForm" action="{{ route('teacher.update', $teacher->id) }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')

                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                    <div>
                        <label class="block text-gray-500 font-bold mb-1">Name</label>
                        <input name="name" class="input-field" type="text" value="{{ $teacher->user->name }}">
                        @error('name')<p class="text-red-500 text-xs italic">{{ $message }}</p>@enderror
                    </div>
                    <div>
                        <label class="block text-gray-500 font-bold mb-1">Email</label>
                        <input name="email" class="input-field" type="email" value="{{ $teacher->user->email }}">
                        @error('email')<p class="text-red-500 text-xs italic">{{ $message }}</p>@enderror
                    </div>
                    <div>
                    <label class="block text-gray-700 font-semibold">Password</label>
                    <input type="password" name="password" class="input-field">
                    @error('password') <p class="error-text">{{ $message }}</p> @enderror
                </div>
                    <div>
                        <label class="block text-gray-500 font-bold mb-1">Phone</label>
                        <input name="phone" class="input-field" type="text" value="{{ $teacher->phone }}">
                        @error('phone')<p class="text-red-500 text-xs italic">{{ $message }}</p>@enderror
                    </div>
                    <div>
                        <label class="block text-gray-500 font-bold mb-1">Gender</label>
                        <div class="flex gap-4">
                            <label><input name="gender" type="radio" value="male" {{ ($teacher->gender == 'male') ? 'checked' : '' }}> Male</label>
                            <label><input name="gender" type="radio" value="female" {{ ($teacher->gender == 'female') ? 'checked' : '' }}> Female</label>
                            <label><input name="gender" type="radio" value="other" {{ ($teacher->gender == 'other') ? 'checked' : '' }}> Other</label>
                        </div>
                        @error('gender')<p class="text-red-500 text-xs italic">{{ $message }}</p>@enderror
                    </div>
                    <div>
                        <label class="block text-gray-500 font-bold mb-1">Date of Birth</label>
                        <input name="dateofbirth" id="datepicker-te" class="input-field" type="text" value="{{ $teacher->dateofbirth }}">
                        @error('dateofbirth')<p class="text-red-500 text-xs italic">{{ $message }}</p>@enderror
                    </div>
                    <div>
                        <label class="block text-gray-500 font-bold mb-1">Current Address</label>
                        <input name="current_address" class="input-field" type="text" value="{{ $teacher->current_address }}">
                        @error('current_address')<p class="text-red-500 text-xs italic">{{ $message }}</p>@enderror
                    </div>
                    <div>
                        <label class="block text-gray-500 font-bold mb-1">Permanent Address</label>
                        <input name="permanent_address" class="input-field" type="text" value="{{ $teacher->permanent_address }}">
                        @error('permanent_address')<p class="text-red-500 text-xs italic">{{ $message }}</p>@enderror
                    </div>
                </div>
                <div>
                    <div>
                        <label class="block text-gray-500 font-bold mb-1">Profile Picture</label>
                        <input name="profile_picture" class="input-field" type="file">
                    </div>
                </div>
                <div class="mt-4 text-center">
                    <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded hover:bg-blue-600">
                        Update Teacher
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

@push('scripts')
<script>
    $(function() { $("#datepicker-te").datepicker({ dateFormat: 'yy-mm-dd' }); });
</script>
@endpush
