@extends('layouts.app')

@section('content')
    <div class="max-w-4xl mx-auto p-6 bg-white shadow-lg rounded-lg">

        <div class="flex items-center justify-between mb-6">
            <h2 class="text-2xl font-semibold text-gray-700">Edit Subject</h2>
            <a href="{{ route('subject.index') }}" class="bg-gray-700 text-white text-sm uppercase py-2 px-4 flex items-center rounded-md hover:bg-gray-600 transition-colors">
                <svg class="w-4 h-4 fill-current" aria-hidden="true" focusable="false" data-prefix="fas" data-icon="long-arrow-alt-left" role="img" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 448 512">
                    <path fill="currentColor" d="M134.059 296H436c6.627 0 12-5.373 12-12v-56c0-6.627-5.373-12-12-12H134.059v-46.059c0-21.382-25.851-32.09-40.971-16.971L7.029 239.029c-9.373 9.373-9.373 24.569 0 33.941l86.059 86.059c15.119 15.119 40.971 4.411 40.971-16.971V296z"></path>
                </svg>
                <span class="ml-2 text-xs font-semibold">Back</span>
            </a>
        </div>

        <div class="p-6">
            <form action="{{ route('subject.update', $subject->id) }}" method="POST">
                @csrf
                @method('PUT')

                <div class="space-y-6">
                    <!-- Subject Name -->
                    <div>
                        <label for="name" class="block text-gray-600 font-medium">Subject Name</label>
                        <input name="name" type="text" value="{{ $subject->name }}" class="mt-1 block w-full px-4 py-2 bg-gray-100 border border-gray-300 rounded-md focus:ring-2 focus:ring-blue-500" id="name">
                        @error('name')
                            <p class="text-red-500 text-xs italic">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Subject Code -->
                    <div style="margin-top:0.7rem">
                        <label for="subject_code" class="block text-gray-600 font-medium">Subject Code</label>
                        <input name="subject_code" type="number" value="{{ $subject->subject_code }}" class="mt-1 block w-full px-4 py-2 bg-gray-100 border border-gray-300 rounded-md focus:ring-2 focus:ring-blue-500" id="subject_code">
                        @error('subject_code')
                            <p class="text-red-500 text-xs italic">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Subject Description -->
                    <div style="margin-top:0.7rem">
                        <label for="description" class="block text-gray-600 font-medium">Subject Description</label>
                        <input name="description" type="text" value="{{ $subject->description }}" class="mt-1 block w-full px-4 py-2 bg-gray-100 border border-gray-300 rounded-md focus:ring-2 focus:ring-blue-500" id="description">
                        @error('description')
                            <p class="text-red-500 text-xs italic">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Assign Teacher -->
                    <div style="margin-top:0.7rem">
                        <label for="teacher_id" class="block text-gray-600 font-medium">Assign Teacher</label>
                        <select name="teacher_id" id="teacher_id" class="mt-1 block w-full px-4 py-2 bg-gray-100 border border-gray-300 rounded-md focus:ring-2 focus:ring-blue-500">
                            <option value="">-- Select Teacher --</option>
                            @foreach ($teachers as $teacher)
                                <option value="{{ $teacher->id }}"
                                    {{ ($teacher->id === $subject->teacher_id) ? 'selected' : '' }}>
                                    {{ $teacher->user->name }}
                                </option>
                            @endforeach
                        </select>
                        @error('teacher_id')
                            <p class="text-red-500 text-xs italic">{{ $message }}</p>
                        @enderror
                    </div><br>

                    <!-- Submit Button -->
                    <div class="flex justify-end">
                        <button type="submit" class="bg-blue-600 text-white px-6 py-3 rounded-md hover:bg-blue-500 focus:ring-2 focus:ring-blue-400 transition-colors">
                            Update Subject
                        </button>
                    </div>
                </div>
            </form>
        </div>

    </div>
@endsection
