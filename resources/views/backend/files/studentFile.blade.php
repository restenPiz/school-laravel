@extends('layouts.app')

@section('content')
    <link rel="stylesheet" href="">
    <link href="https://cdn.jsdelivr.net/npm/flowbite@3.1.2/dist/flowbite.min.css" rel="stylesheet" />
    </link>
    <div class="roles">

        {{-- Start with the main content --}}
        <div class="max-w-8xl mx-auto">
            <div class="flex items-center justify-between mb-6">
                <div>
                   <h2 class="text-2xl font-semibold">Arquivos da Disciplina - {{$class->name}}</h2>
                </div>
                <div class="flex flex-wrap items-center">
                    <a href="{{route('studentClasses',Auth::user()->id)}}" class="bg-gray-700 text-white text-sm uppercase py-2 px-4 flex items-center rounded">
                        <svg class="w-3 h-3 fill-current" aria-hidden="true" focusable="false" data-prefix="fas"
                            data-icon="long-arrow-alt-left" class="svg-inline--fa fa-long-arrow-alt-left fa-w-14" role="img"
                            xmlns="http://www.w3.org/2000/svg" viewBox="0 0 448 512">
                            <path fill="currentColor"
                                d="M134.059 296H436c6.627 0 12-5.373 12-12v-56c0-6.627-5.373-12-12-12H134.059v-46.059c0-21.382-25.851-32.09-40.971-16.971L7.029 239.029c-9.373 9.373-9.373 24.569 0 33.941l86.059 86.059c15.119 15.119 40.971 4.411 40.971-16.971V296z">
                            </path>
                        </svg><span class="ml-2 text-xs font-semibold">back</span>
                    </a>
                </div>
            </div>
        
            {{-- Use grid responsivo --}}
            <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-3 gap-4 mb-2">
                @foreach ($class->files as $file)
                    <div class="flex flex-col h-full bg-white p-6 rounded-lg shadow-lg border border-gray-200 dark:bg-gray-800 dark:border-gray-700">
                        <a href="#" class="flex-shrink-0">
                            @if(in_array(pathinfo($file->file_path, PATHINFO_EXTENSION), ['jpg', 'jpeg', 'png', 'gif', 'bmp']))
                                <img class="rounded-t-lg" src="{{ asset('storage/' . $file->file_path) }}" alt="Image" />
                            @elseif(in_array(pathinfo($file->file_path, PATHINFO_EXTENSION), ['docx']))
                                <img class="rounded-t-lg" src="../images/docx.png" alt="PDF" />
                            @else
                                <img class="rounded-t-lg" src="../images/pdf.png" alt="PDF" />
                            @endif
                        </a>
                        <div class="flex-1 p-5">
                            <a href="#">
                                <h5 class="mb-2 text-2xl font-bold tracking-tight text-gray-900 dark:text-white">{{ $file->title }}</h5>
                            </a>
                            <p class="mb-3 font-normal text-gray-700 dark:text-gray-400" style="text-align: justify;">{{ $file->description }}</p>
                            <div class="flex space-x-2 flex-wrap justify-start">
                                {{-- Action buttons for file --}}
                                <a href="{{ asset('storage/' . $file->file_path) }}" target="_blank" class="inline-flex items-center px-3 py-2 text-sm font-medium text-center text-white bg-blue-700 rounded-lg hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">
                                    <svg class="rtl:rotate-90 w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 10">
                                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M1 5h12m0 0L9 1m4 4L9 9"/>
                                    </svg>
                                </a>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
        {{-- End of main content --}}

    </div>
@endsection
