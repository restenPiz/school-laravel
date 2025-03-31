@extends('layouts.app')

@section('content')
<link rel="stylesheet" href="">
    <link href="https://cdn.jsdelivr.net/npm/flowbite@3.1.2/dist/flowbite.min.css" rel="stylesheet" />
    </link>
    <div class="roles">

        {{--?Start with the main content--}}
        <div class="max-w-8xl mx-auto">
            <div class="flex items-center justify-between mb-6">
                <div class="{{--w-full sm:w-1/2 mr-2 mb-6--}}">
                    <h3 class="text-gray-700 uppercase font-bold mb-2">Subject List 
                    </h3>
                    <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-3 gap-4 mb-2">
                        @foreach ($teacher->subjects as $class)
                            <div class="flex flex-col h-full bg-white p-6 rounded-lg shadow-lg border border-gray-200 dark:bg-gray-800 dark:border-gray-700">
                                <div class="text-gray-800 uppercase font-semibold px-4 py-4 mb-2">{{ $class->name }}</div>
                                <a href="{{ route('files',$class->id) }}" 
                                    class="text-center bg-green-600 inline-block mb-4 text-xs text-white uppercase font-semibold px-4 py-2 border border-gray-200 rounded">Manage Files</a>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div> 
        {{--?End with the main content--}}

    </div>
@endsection