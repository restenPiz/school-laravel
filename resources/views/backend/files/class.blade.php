@extends('layouts.app')

@section('content')
    <div class="roles">

        {{--?Start with the main content--}}
        <div class="w-full block mt-8">
            <div class="flex flex-wrap sm:flex-no-wrap justify-between">
                <div class="w-full sm:w-1/2 mr-2 mb-6">
                    <h3 class="text-gray-700 uppercase font-bold mb-2">Class List</h3>
                    <div class="flex flex-wrap items-center">
                        @foreach ($teacher->classes as $class)
                            <div class="w-full sm:w-1/2 text-center border border-gray-400 rounded">
                                <div class="text-gray-800 uppercase font-semibold px-4 py-4 mb-2">{{ $class->class_name }}</div>
                                <a href="{{ route('files',$class->id) }}" 
                                    class="bg-green-600 inline-block mb-4 text-xs text-white uppercase font-semibold px-4 py-2 border border-gray-200 rounded">Manage Files</a>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div> 
        {{--?End with the main content--}}

    </div>
@endsection