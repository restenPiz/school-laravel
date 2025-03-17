@extends('layouts.app')

@section('content')
    <div class="roles">

        <div class="flex items-center justify-between mb-6">
            <div>
                <h2 class="text-2xl font-bold text-gray-800">Student Details</h2>
            </div>
            <div class="flex flex-wrap items-center">
                <a href="{{ route('student.index') }}" class="bg-gray-800 text-white text-sm py-2 px-4 flex items-center rounded-lg hover:bg-gray-700 transition duration-300">
                    <svg class="w-4 h-4 fill-current" aria-hidden="true" focusable="false" data-prefix="fas" data-icon="long-arrow-alt-left" role="img" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 448 512"><path fill="currentColor" d="M134.059 296H436c6.627 0 12-5.373 12-12v-56c0-6.627-5.373-12-12-12H134.059v-46.059c0-21.382-25.851-32.09-40.971-16.971L7.029 239.029c-9.373 9.373-9.373 24.569 0 33.941l86.059 86.059c15.119 15.119 40.971 4.411 40.971-16.971V296z"></path></svg>
                    <span class="ml-2 text-xs font-semibold">Back</span>
                </a>
            </div>
        </div>

        <div class="mt-8 bg-white rounded-lg shadow-lg p-6">
            <div class="flex flex-wrap sm:flex-no-wrap justify-between">

                <div class="w-full sm:w-1/2 mr-2 mb-6">

                    <!-- Profile Picture -->
                    <div class="flex items-center justify-center mb-6">
                        <img class="w-32 h-32 rounded-full border-4 border-gray-200" src="{{ asset('images/profile/' .$student->user->profile_picture) }}" alt="Student Avatar">
                    </div>

                    <!-- Student Information -->
                    <div class="space-y-4">
                        @foreach ([
                            ['label' => 'Name', 'value' => $student->user->name],
                            ['label' => 'Email', 'value' => $student->user->email],
                            ['label' => 'Roll', 'value' => $student->roll_number],
                            ['label' => 'Phone', 'value' => $student->phone],
                            ['label' => 'Gender', 'value' => $student->gender],
                            ['label' => 'Date of Birth', 'value' => $student->dateofbirth],
                            ['label' => 'Current Address', 'value' => $student->current_address],
                            ['label' => 'Permanent Address', 'value' => $student->permanent_address],
                        ] as $info)
                            <div class="flex justify-between items-center">
                                <div class="text-gray-500 font-semibold w-1/3">{{ $info['label'] }}:</div>
                                <div class="text-gray-700 font-medium w-2/3">{{ $info['value'] }}</div>
                            </div>
                        @endforeach
                    </div>

                    <!-- Parent Information -->
                    <div class="mt-8 space-y-4">
                        <h3 class="text-lg font-bold text-gray-800 mb-4">Parent's Details</h3>
                        @foreach ([
                            ['label' => 'Parent\'s Name', 'value' => $student->parent->user->name],
                            ['label' => 'Parent\'s Email', 'value' => $student->parent->user->email],
                            ['label' => 'Parent\'s Phone', 'value' => $student->parent->phone],
                            ['label' => 'Parent\'s Address', 'value' => $student->parent->current_address],
                        ] as $info)
                            <div class="flex justify-between items-center">
                                <div class="text-gray-500 font-semibold w-1/3">{{ $info['label'] }}:</div>
                                <div class="text-gray-700 font-medium w-2/3">{{ $info['value'] }}</div>
                            </div>
                        @endforeach
                    </div>

                </div>

                <div class="w-full sm:w-1/2 mr-2 mb-6">
                    <!-- Subject Table -->
                    <div class="bg-gray-600 text-white rounded-t-lg p-4">
                        <div class="grid grid-cols-3 gap-4 font-semibold">
                            <div>Code</div>
                            <div>Subject</div>
                            <div class="text-right">Teacher</div>
                        </div>
                    </div>
                    <div class="bg-gray-100 rounded-b-lg">
                        @foreach ($class->subjects as $subject)
                            <div class="flex justify-between items-center border-b border-gray-200 p-4">
                                <div class="w-1/3 text-gray-800">{{ $subject->subject_code }}</div>
                                <div class="w-1/3 text-gray-800">{{ $subject->name }}</div>
                                <div class="w-1/3 text-right text-gray-800">{{ $subject->teacher->user->name }}</div>
                            </div>
                        @endforeach
                    </div>
                </div>

            </div>
        </div>
    </div>
@endsection
