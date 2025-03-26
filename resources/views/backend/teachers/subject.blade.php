@extends('layouts.app')

@section('content')
    <div class="roles">
        <div class="w-full sm:w-2/2 ml-2 mb-6">
            <h3 class="text-gray-700 uppercase font-bold mb-2">Subject List</h3>
            <div class="flex items-center bg-gray-300 text-gray-700 rounded-tl rounded-tr">
                <div class="w-1/3 text-left py-2 px-4 font-semibold">Code</div>
                <div class="w-1/3 text-left py-2 px-4 font-semibold">Subject</div>
                <div class="w-1/3 text-right py-2 px-4 font-semibold">Teacher</div>
            </div>
            @foreach ($teacher->subjects as $subject)
                <div class="flex items-center justify-between border border-gray-200">
                    <div class="w-1/3 text-left text-gray-600 py-2 px-4 font-medium">{{ $subject->subject_code }}</div>
                    <div class="w-1/3 text-left text-gray-600 py-2 px-4 font-medium">{{ $subject->name }}</div>
                    <div class="w-1/3 text-right text-gray-600 py-2 px-4 font-medium">{{ $subject->teacher->user->name }}</div>
                </div>
            @endforeach
        </div>
    </div>
@endsection