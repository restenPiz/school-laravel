@extends('layouts.app')

@section('content')
    <link rel="stylesheet" href="">
    <link href="https://cdn.jsdelivr.net/npm/flowbite@3.1.2/dist/flowbite.min.css" rel="stylesheet" />
    </link>
    <div class="roles">

        {{-- Start with the main content --}}
        <div class="max-w-8xl mx-auto">
            <div class="flex justify-between items-center mb-4">
                <h2 class="text-2xl font-semibold">Arquivos da Turma</h2>
                <a href="{{route('teacherFile',['id'=>$class->id])}}" class="bg-blue-500 text-white px-4 py-2 rounded hover:bg-blue-600">Adicionar</a>
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
                                <a style="background-color:green" href="" class="inline-flex items-center px-3 py-2 text-sm font-medium text-center rounded-lg hover:bg-blue-800 " title="Edit">
                                    <svg class="h-3 w-3 fill-current text-gray-100" aria-hidden="true" focusable="false" data-prefix="fas" data-icon="pen-square" class="svg-inline--fa fa-pen-square fa-w-14" role="img" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 448 512">
                                        <path fill="currentColor" d="M400 480H48c-26.5 0-48-21.5-48-48V80c0-26.5 21.5-48 48-48h352c26.5 0 48 21.5 48 48v352c0 26.5-21.5 48-48 48zM238.1 177.9L102.4 313.6l-6.3 57.1c-.8 7.6 5.6 14.1 13.3 13.3l57.1-6.3L302.2 242c2.3-2.3 2.3-6.1 0-8.5L246.7 178c-2.5-2.4-6.3-2.4-8.6-.1zM345 165.1L314.9 135c-9.4-9.4-24.6-9.4-33.9 0l-23.1 23.1c-2.3 2.3-2.3 6.1 0 8.5l55.5 55.5c2.3 2.3 6.1 2.3 8.5 0L345 199c9.3-9.3 9.3-24.5 0-33.9z"></path>
                                    </svg>
                                </a>
                                <a href="" class="inline-flex items-center px-3 py-2 text-sm font-medium text-center text-white bg-red-700 rounded-lg hover:bg-blue-800 " title="Delete">
                                    <svg class="h-3 w-3 fill-current text-gray-100" aria-hidden="true" focusable="false" data-prefix="fas" data-icon="trash" class="svg-inline--fa fa-trash fa-w-14" role="img" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 448 512">
                                        <path fill="currentColor" d="M432 32H312l-9.4-18.7A24 24 0 0 0 281.1 0H166.8a23.72 23.72 0 0 0-21.4 13.3L136 32H16A16 16 0 0 0 0 48v32a16 16 0 0 0 16 16h416a16 16 0 0 0 16-16V48a16 16 0 0 0-16-16zM53.2 467a48 48 0 0 0 47.9 45h245.8a48 48 0 0 0 47.9-45L416 128H32z"></path>
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
