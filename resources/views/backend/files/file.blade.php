@extends('layouts.app')

@section('content')
   <link rel="stylesheet" href="">
    <link href="https://cdn.jsdelivr.net/npm/flowbite@3.1.2/dist/flowbite.min.css" rel="stylesheet" />
    </link>
    <div class="roles">

        {{--?Start with the main content--}}
        <div class="max-w-8xl mx-auto ">
            <div class="flex justify-between items-center mb-4">
                <h2 class="text-2xl font-semibold">Arquivos da Turma</h2>
                <a href="{{route('teacherFile',['id'=>$class->id])}}" class="bg-blue-500 text-white px-4 py-2 rounded hover:bg-blue-600">Adicionar</a>
            </div>
        
            <div class="grid grid-cols-3 gap-3 mb-2">
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
                            <a href="{{ asset('storage/' . $file->file_path) }}" target="_blank" class="inline-flex items-center px-3 py-2 text-sm font-medium text-center text-white bg-blue-700 rounded-lg hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">
                                Ver Mais
                                <svg class="rtl:rotate-180 w-3.5 h-3.5 ms-2" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 10">
                                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M1 5h12m0 0L9 1m4 4L9 9"/>
                                </svg>
                            </a>
                        </div>
                    </div>
                @endforeach
            </div>


        </div>
        {{--?End of with the main content--}}

    </div>
@endsection