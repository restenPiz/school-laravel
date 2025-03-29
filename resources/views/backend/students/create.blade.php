@extends('layouts.app')

@section('content')
    <link rel="stylesheet" href="">
    <link href="https://cdn.jsdelivr.net/npm/flowbite@3.1.2/dist/flowbite.min.css" rel="stylesheet" />
    </link>
    <div class="roles">

        <div class="flex items-center justify-between mb-6">
            <div>
                <h2 class="text-gray-700 uppercase font-bold">Add New Student</h2>
            </div>
            <div class="flex flex-wrap items-center">
                <a href="{{ route('student.index') }}"
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

        <form action="{{ route('student.store') }}" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="bg-white shadow-md rounded-lg p-6 max-w-8xl mx-auto">
                <div>
                    <h2 class="text-gray-700 uppercase font-bold">Personal Information</h2>
                </div>
                <div class="grid grid-cols-1 md:grid-cols-2 gap-4" style="margin-top:1rem;">
                    <div>
                        <label class="block text-gray-600 font-medium">
                            Name
                        </label>
                        <input name="name"
                            class="mt-1 block w-full px-4 py-2 bg-gray-100 border border-gray-300 rounded-md focus:ring-2 focus:ring-blue-500"
                            type="text" value="{{ old('name') }}">
                        @error('name')
                            <p class="text-red-500 text-xs italic">{{ $message }}</p>
                        @enderror
                    </div>
                    <div>
                        <label class="block text-gray-600 font-medium">
                            Email
                        </label>
                        <input name="email"
                            class="mt-1 block w-full px-4 py-2 bg-gray-100 border border-gray-300 rounded-md focus:ring-2 focus:ring-blue-500"
                            type="email" value="{{ old('email') }}">
                        @error('email')
                            <p class="text-red-500 text-xs italic">{{ $message }}</p>
                        @enderror
                    </div>
                </div>
                <div style="margin-top:1rem" class="grid grid-cols-1 md:grid-cols-2 gap-4">
                    <div>
                        <label class="block text-gray-600 font-medium">
                            Password
                        </label>
                        <input name="password"
                            class="mt-1 block w-full px-4 py-2 bg-gray-100 border border-gray-300 rounded-md focus:ring-2 focus:ring-blue-500"
                            type="password">
                        @error('password')
                            <p class="text-red-500 text-xs italic">{{ $message }}</p>
                        @enderror
                    </div>
                    <div>
                        <label class="block text-gray-600 font-medium">
                            Roll Number
                        </label>
                        <input name="roll_number"
                            class="mt-1 block w-full px-4 py-2 bg-gray-100 border border-gray-300 rounded-md focus:ring-2 focus:ring-blue-500"
                            type="number" value="{{ old('roll_number') }}">
                        @error('roll_number')
                            <p class="text-red-500 text-xs italic">{{ $message }}</p>
                        @enderror
                    </div>
                </div>
                <label class="block text-gray-600 font-medium">
                    Picture :
                </label>
                <input name="profile_picture"
                    class="mt-1 block w-full px-4 py-2 bg-gray-100 border border-gray-300 rounded-md focus:ring-2 focus:ring-blue-500"
                    type="file">
            {{-- </div>
        </div>

    <div style="margin-top:1rem" class="bg-white shadow-md rounded-lg p-6 max-w-8xl mx-auto">
        <div>
                <h2 class="text-gray-700 uppercase font-bold">Another Personal Information</h2>
            </div> --}}
        <div class="grid grid-cols-1 md:grid-cols-2 gap-4" style="margin-top:1rem;">
            <div>
                <label class="block text-gray-600 font-medium">
                    Phone
                </label>
                <input name="phone"
                    class="mt-1 block w-full px-4 py-2 bg-gray-100 border border-gray-300 rounded-md focus:ring-2 focus:ring-blue-500"
                    type="text" value="{{ old('phone') }}">
                @error('phone')
                    <p class="text-red-500 text-xs italic">{{ $message }}</p>
                @enderror
            </div>
            <div>
                <label class="block text-gray-600 font-medium">
                    Date of Birth
                </label>
                <input name="dateofbirth" id="datepicker-sc" autocomplete="off"
                    class="mt-1 block w-full px-4 py-2 bg-gray-100 border border-gray-300 rounded-md focus:ring-2 focus:ring-blue-500"
                    type="date" value="{{ old('dateofbirth') }}">
                @error('dateofbirth')
                    <p class="text-red-500 text-xs italic">{{ $message }}</p>
                @enderror
            </div>
        </div>
        <div style="margin-top:1rem" class="grid grid-cols-1 md:grid-cols-2 gap-4">
            <div>
                <label class="block text-gray-600 font-medium">
                    Current Address
                </label>
                <input name="current_address"
                    class="mt-1 block w-full px-4 py-2 bg-gray-100 border border-gray-300 rounded-md focus:ring-2 focus:ring-blue-500"
                    type="text" value="{{ old('current_address') }}">
                @error('current_address')
                    <p class="text-red-500 text-xs italic">{{ $message }}</p>
                @enderror
            </div>
            <div>
                <label class="block text-gray-600 font-medium">
                    Permanent Address
                </label>
                <input name="permanent_address"
                    class="mt-1 block w-full px-4 py-2 bg-gray-100 border border-gray-300 rounded-md focus:ring-2 focus:ring-blue-500"
                    type="text" value="{{ old('permanent_address') }}">
                @error('permanent_address')
                    <p class="text-red-500 text-xs italic">{{ $message }}</p>
                @enderror
            </div>
        </div>
        <div style="margin-top:1rem" class="grid grid-cols-1 md:grid-cols-2 gap-4">
            <div>
                <label class="block text-gray-600 font-medium">
                    Gender
                </label>
                <div class="flex flex-row items-center">
                    <label class="block text-gray-500 font-bold">
                        <input name="gender" class="bg-gray-600 text-sm font-medium text-gray-900 dark:text-gray-300" type="radio" value="male">
                        <span class="text-sm">Male</span>
                    </label>
                    <label class="ml-4 block text-gray-500 font-bold">
                        <input name="gender" class="bg-gray-600 text-sm font-medium text-gray-900 dark:text-gray-300" type="radio" value="female">
                        <span class="text-sm">Female</span>
                    </label>
                    <label class="ml-4 block text-gray-500 font-bold">
                        <input name="gender" class="bg-gray-600 text-sm font-medium text-gray-900 dark:text-gray-300" type="radio" value="other">
                        <span class="text-sm">Other</span>
                    </label>
                </div>
                @error('gender')
                    <p class="text-red-500 text-xs italic">{{ $message }}</p>
                @enderror
            </div>
        </div>
    </div>

    {{-- ?third Section --}}
    <div style="margin-top:1rem" class="bg-white shadow-md rounded-lg p-6 max-w-8xl mx-auto">
        <div>
                <h2 class="text-gray-700 uppercase font-bold">School Information</h2>
            </div>
        <div class="grid grid-cols-1 md:grid-cols-2 gap-4" style="margin-top:1rem;">
            <div>
                <label class="block text-gray-600 font-medium">
                    Assign Class
                </label>
                <div class="relative">
                    <select name="class_id"
                        class="block appearance-none w-full bg-gray-200 border border-gray-200 text-gray-700 py-3 px-4 pr-8 rounded leading-tight focus:outline-none focus:bg-white focus:border-gray-500"
                        id="grid-state">
                        <option value="">--Select Class--</option>
                        @foreach ($classes as $class)
                            <option value="{{ $class->id }}">{{ $class->class_name }}</option>
                        @endforeach
                    </select>
                    <div class="pointer-events-none absolute inset-y-0 right-0 flex items-center px-2 text-gray-700">
                        <svg class="fill-current h-4 w-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20">
                            <path d="M9.293 12.95l.707.707L15.657 8l-1.414-1.414L10 10.828 5.757 6.586 4.343 8z" />
                        </svg>
                    </div>
                </div>
            </div>
            <div>
                <label class="block text-gray-600 font-medium">
                    Student's Parent
                </label>
                <div class="relative">
                    <select name="parent_id"
                        class="block appearance-none w-full bg-gray-200 border border-gray-200 text-gray-700 py-3 px-4 pr-8 rounded leading-tight focus:outline-none focus:bg-white focus:border-gray-500"
                        id="grid-state">
                        <option value="">--Select Parent--</option>
                        @foreach ($parents as $parent)
                            <option value="{{ $parent->id }}">{{ $parent->user->name }}</option>
                        @endforeach
                    </select>
                    <div class="pointer-events-none absolute inset-y-0 right-0 flex items-center px-2 text-gray-700">
                        <svg class="fill-current h-4 w-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20">
                            <path d="M9.293 12.95l.707.707L15.657 8l-1.414-1.414L10 10.828 5.757 6.586 4.343 8z" />
                        </svg>
                    </div>
                </div>
            </div>
        </div>
        <div style="margin-top:1rem" class="grid grid-cols-1 md:grid-cols-2 gap-4">
            <div>
                <label class="block text-gray-600 font-medium">
                    Payment Type
                </label>
                <select name="payment_type"
                    class="block font-bold appearance-none w-full bg-gray-200 border border-gray-200 text-gray-600 py-3 px-4 pr-8 rounded leading-tight focus:outline-none focus:bg-white focus:border-gray-500">
                    <option value="">Selecione o Tipo de Pagamento</option>
                    <option value="monthly">Mensal</option>
                    <option value="quartely">Trimestral</option>
                    <option value="yearly">Anual</option>
                </select>
            </div>
        </div>
        <div class="flex justify-end">
            <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded hover:bg-blue-600">
                Submit
            </button>
        </div>
    </div>

    </form>

    <!-- Log on to codeastro.com for more projects -->
    </div>
@endsection

@push('scripts')
    <script>
        $(function() {
            $("#datepicker-sc").datepicker({
                dateFormat: 'yy-mm-dd'
            });
        })
    </script>
@endpush
