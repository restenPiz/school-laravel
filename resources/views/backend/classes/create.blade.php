@extends('layouts.app')

@section('content')
    <link rel="stylesheet" href="">
    <link href="https://cdn.jsdelivr.net/npm/flowbite@3.1.2/dist/flowbite.min.css" rel="stylesheet" />
    </link>
    <div class="roles">
        <div class="flex items-center justify-between mb-6">
            <div>
                <h2 class="text-gray-700 uppercase font-bold">Add New Class</h2>
            </div>
            <div class="flex flex-wrap items-center">
                <a href="{{ route('classes.index') }}"
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
            <form action="{{ route('classes.store') }}" method="POST" >
                @csrf
                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                    <div>
                        <label class="block text-gray-600 font-medium">
                            Class Name
                        </label>
                        <input name="class_name" placeholder="Write the class name"
                            class="mt-1 block w-full px-4 py-2 bg-gray-100 border border-gray-300 rounded-md focus:ring-2 focus:ring-blue-500"
                            type="text" value="{{ old('class_name') }}">
                        @error('class_name')
                            <p class="error-text">{{ $message }}</p>
                        @enderror
                    </div>
                    <div>
                        <label class="block text-gray-600 font-medium">
                            Class Numeric
                        </label>
                        <input name="class_numeric" placeholder="Class Number"
                            class="mt-1 block w-full px-4 py-2 bg-gray-100 border border-gray-300 rounded-md focus:ring-2 focus:ring-blue-500"
                            type="number" value="{{ old('class_numeric') }}">
                        @error('class_numeric')
                            <p class="error-text">{{ $message }}</p>
                        @enderror
                    </div>
                </div> 
                <div style="margin-top:1rem" class="grid grid-cols-1 md:grid-cols-2 gap-4">
                    <div>
                        <label class="block text-gray-600 font-medium">
                            Assign Teacher
                        </label>
                        <div class="relative">
                            <select name="teacher_id"
                                class="block appearance-none w-full bg-gray-200 border border-gray-200 text-gray-700 py-3 px-4 pr-8 rounded leading-tight focus:outline-none focus:bg-white focus:border-gray-500"
                                id="grid-state">
                                <option value="">--Select Teacher--</option>
                                @foreach ($teachers as $teacher)
                                    <option value="{{ $teacher->id }}">{{ $teacher->user->name }}</option>
                                @endforeach
                            </select>
                            <div
                                class="pointer-events-none absolute inset-y-0 right-0 flex items-center px-2 text-gray-700">
                                <svg class="fill-current h-4 w-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20">
                                    <path d="M9.293 12.95l.707.707L15.657 8l-1.414-1.414L10 10.828 5.757 6.586 4.343 8z" />
                                </svg>
                            </div>
                        </div>
                        @error('teacher_id')
                            <p class="error-text">{{ $message }}</p>
                        @enderror
                    </div>
                    <div>
                        <label class="block text-gray-600 font-medium">
                            Class Description
                        </label>
                        <input name="class_description" placeholder="Description"
                            class="mt-1 block w-full px-4 py-2 bg-gray-100 border border-gray-300 rounded-md focus:ring-2 focus:ring-blue-500"
                            type="text" value="{{ old('class_description') }}">
                        @error('class_description')
                            <p class="error-text">{{ $message }}</p>
                        @enderror
                    </div>
                </div>
                <div style="margin-top:1rem" class="grid grid-cols-1 md:grid-cols-2 gap-4">
                    <div>
                        <label class="block text-gray-600 font-medium">
                            Registration Fee
                        </label>
                        <input name="registration_fee" placeholder="Ex: 500.00MZN"
                            class="mt-1 block w-full px-4 py-2 bg-gray-100 border border-gray-300 rounded-md focus:ring-2 focus:ring-blue-500"
                            type="text" value="{{ old('class_description') }}">
                        @error('registration_fee')
                            <p class="error-text">{{ $message }}</p>
                        @enderror
                    </div>
                    <div>
                        <label class="block text-gray-600 font-medium">
                            Monthly Fee
                        </label>
                        <input name="monthly_fee" placeholder="Ex: 5595.00MZN"
                            class="mt-1 block w-full px-4 py-2 bg-gray-100 border border-gray-300 rounded-md focus:ring-2 focus:ring-blue-500"
                            type="text" value="{{ old('class_description') }}">
                        @error('monthly_fee')
                            <p class="error-text">{{ $message }}</p>
                        @enderror
                    </div>
                </div>

                <div style="margin-top:1rem" class="flex justify-end">
                    <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded hover:bg-blue-600">
                        Submit
                    </button>
                </div>
            </form>
        </div>
        <!-- Log on to codeastro.com for more projects -->
    </div>
    <script>
        < script src = "https://cdn.jsdelivr.net/npm/flowbite@3.1.2/dist/flowbite.min.js" >
    </script>
@endsection
