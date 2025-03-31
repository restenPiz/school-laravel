@extends('layouts.app')

@section('content')
<div class="container mx-auto px-4 py-8">
    <!-- Header Section -->
    <div class="flex items-center justify-between mb-6">
        <h2 class="text-gray-700 uppercase font-bold">Assign Subject</h2>
        <div class="flex items-center">
            <a href="{{ route('classes.index') }}" class="bg-gray-700 text-white text-xs uppercase py-2 px-4 flex items-center rounded">
                <svg class="w-3 h-3 fill-current" aria-hidden="true" focusable="false" data-prefix="fas" data-icon="long-arrow-alt-left" class="svg-inline--fa fa-long-arrow-alt-left fa-w-14" role="img" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 448 512">
                    <path fill="currentColor" d="M134.059 296H436c6.627 0 12-5.373 12-12v-56c0-6.627-5.373-12-12-12H134.059v-46.059c0-21.382-25.851-32.09-40.971-16.971L7.029 239.029c-9.373 9.373-9.373 24.569 0 33.941l86.059 86.059c15.119 15.119 40.971 4.411 40.971-16.971V296z"></path>
                </svg>
                <span class="ml-2 text-xs font-semibold">Back</span>
            </a>
        </div>
    </div>

    <!-- Form Section -->
    <div class="bg-white p-6 rounded-lg shadow-lg">
        <form action="{{ route('store.class.assign.subject', $classid) }}" method="POST" class="space-y-6">
            @csrf
            <div class="md:flex md:space-x-4 mb-6">
                <div class="md:w-1/3">
                    <label class="block text-gray-500 font-bold md:text-right mb-1 md:mb-0">Assign Subject</label>
                </div>
                <div style="margin-left:1rem" class="md:w-2/3">
                    @foreach ($subjects as $subject)
                        <div class="flex items-center mb-2">
                            <input name="selectedsubjects[]" type="checkbox" class="mr-2" value="{{ $subject->id }}"
                                   @foreach ($assigned->subjects as $item)
                                       {{ $item->id === $subject->id ? 'checked' : '' }}
                                   @endforeach
                            >
                            <span class="text-sm">{{ $subject->name }}</span>
                        </div>
                    @endforeach
                </div>
            </div>
            <div class="md:flex md:items-center">
                <div class="md:w-1/3"></div>
                <div class="md:w-2/3">
                    <button type="submit" class="bg-blue-500 hover:bg-blue-400 text-white font-bold py-2 px-4 rounded focus:outline-none focus:ring-2 focus:ring-blue-500">
                        Assign Subject
                    </button>
                </div>
            </div>
        </form>
    </div>

    <!-- Teachers and Subjects Section -->
    <div class="{{--mt-12--}} bg-white p-6 {{--rounded-lg shadow-lg --}}grid grid-cols-1 md:grid-cols-2 gap-4">
        <!-- Teachers Table -->
        <div class="p-4">
            <h3 class="text-lg font-semibold text-gray-700 mb-4">Teachers</h3>
            <div class="overflow-x-auto border-b-4 border-gray-300">
                <div class="bg-gray-300 text-gray-700 rounded-tl rounded-tr">
                    <div class="flex p-2 font-semibold">
                        <div class="w-2/4 text-left py-2 px-4">Name</div>
                        <div class="w-2/4 text-left py-2 px-4">Email</div>
                        <div class="w-2/4 text-left py-2 px-4">Phone</div>
                    </div>
                </div>
                @foreach ($assigned->teacher as $teacher)
                    <div class="flex items-center justify-between border-b border-gray-300 p-2 border-t-2 border-l-4 border-r-4">
                        <div class="w-2/4 text-left text-gray-600 py-2 px-4">{{ $teacher->user->name }}</div>
                        <div class="w-2/4 text-left text-gray-600 py-2 px-4">{{ $teacher->user->email }}</div>
                        <div class="w-2/4 text-left text-gray-600 py-2 px-4">{{ $teacher->phone }}</div>
                    </div>
                @endforeach
            </div>
        </div>

        <!-- Subjects Table -->
        <div class="p-4">
            <h3 class="text-lg font-semibold text-gray-700 mb-4">Subjects</h3>
            <div class="overflow-x-auto border-b-4 border-gray-300">
                <div class="bg-gray-300 text-gray-700 rounded-tl rounded-tr ">
                    <div class="flex p-2 font-semibold">
                        <div class="w-2/4 text-left py-2 px-4">Subject Name</div>
                        <div class="w-2/4 text-left py-2 px-4">Subject Code</div>
                        <div class="w-2/4 text-left py-2 px-4">Teacher Assigned</div>
                    </div>
                </div>
                @foreach ($assigned->subjects as $subject)
                    <div class="flex items-center justify-between border-b border-gray-300 p-2 border-t-2 border-l-4 border-r-4">
                        <div class="w-2/4 text-left text-gray-600 py-2 px-4">{{ $subject->name }}</div>
                        <div class="w-2/4 text-left text-gray-600 py-2 px-4">{{ $subject->subject_code }}</div>
                        <div class="w-2/4 text-left text-gray-600 py-2 px-4">{{ $subject->teacher->user->name }}</div>
                    </div>
                @endforeach
            </div>
        </div>
    </div>

    <!-- Students Table -->
    <div class="{{--mt-12 bg-white--}} p-6 {{--rounded-lg shadow-lg --}}grid grid-cols-1 md:grid-cols-2 gap-4">
        <h3 class="text-lg font-semibold text-gray-700 mb-4">Students</h3>
        <div class="overflow-x-auto">
            <div class="bg-gray-300 text-gray-700 rounded-tl rounded-tr">
                <div class="flex p-2 font-semibold">
                    <div class="w-1/4 text-left py-2 px-4">Name</div>
                    <div class="w-2/12 text-left py-2 px-4">Email</div>
                    <div class="w-2/12 text-right py-2 px-4">Phone</div>
                    <div class="w-2/12 text-right py-2 px-4">Parent</div>
                    <div class="w-1/12 py-2 px-4"></div>
                </div>
            </div>
            @foreach ($assigned->students as $student)
                <div class="flex items-center justify-between border-b border-gray-300 p-2 border-t-2 border-l-4 border-r-4">
                    <div class="w-1/4 text-left text-gray-600 py-2 px-4">{{ $student->user->name }}</div>
                    <div class="w-2/12 text-left text-gray-600 py-2 px-4">{{ $student->user->email }}</div>
                    <div class="w-2/12 text-right text-gray-600 py-2 px-4">{{ $student->phone }}</div>
                    <div class="w-2/12 text-right text-gray-600 py-2 px-4">{{ $student->parent->user->name }}</div>
                    <div class="w-1/7 text-right py-2 px-4">
                        <a href="{{ route('student.show', $student->id) }}" class="ml-1 bg-blue-600 block p-1 border border-blue-600 rounded-sm">
                            <svg class="h-3 w-3 fill-current text-gray-100" aria-hidden="true" focusable="false" data-prefix="far" data-icon="eye" class="svg-inline--fa fa-eye fa-w-18" role="img" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 576 512">
                                <path fill="currentColor" d="M288 144a110.94 110.94 0 0 0-31.24 5 55.4 55.4 0 0 1 7.24 27 56 56 0 0 1-56 56 55.4 55.4 0 0 1-27-7.24A111.71 111.71 0 1 0 288 144zm284.52 97.4C518.29 135.59 410.93 64 288 64S57.68 135.64 3.48 241.41a32.35 32.35 0 0 0 0 29.19C57.71 376.41 165.07 448 288 448s230.32-71.64 284.52-177.41a32.35 32.35 0 0 0 0-29.19zM288 400c-98.65 0-189.09-55-237.93-144C98.91 167 189.34 112 288 112s189.09 55 237.93 144C477.1 345 386.66 400 288 400z"></path>
                            </svg>
                        </a>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
</div>
@endsection
