@extends('layouts.app')

@section('content')
   <link rel="stylesheet" href="">
    <link href="https://cdn.jsdelivr.net/npm/flowbite@3.1.2/dist/flowbite.min.css" rel="stylesheet" />
    </link>
    <div class="roles">

        {{--*Start with the main content--}}
        <div class="max-w-2xl mx-auto mt-10 bg-white p-6 rounded-lg shadow-md">
            <div class="flex items-center justify-between mb-6">
                <div>
                    <h2 class="text-gray-700 uppercase font-bold">Edit File</h2>
                </div>
                <div class="flex flex-wrap items-center">
                    <a href="{{route('files',['id'=>$file->class->id])}}"
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
            <form action="{{route('updateFiles',['id'=>$file->id])}}" method="POST" enctype="multipart/form-data" class="space-y-4">
                @csrf
                <div>
                    <label for="title" class="block font-medium text-gray-700">Título</label>
                    <input value="{{$file->title}}" type="text" id="title" name="title" required class="w-full p-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500">
                </div>
                
                <div>
                    <label for="description" class="block font-medium text-gray-700">Descrição</label>
                    <textarea rows="6"  id="description" name="description" class="w-full p-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500">{{$file->description}}</textarea>
                </div>

                <div class="flex items-center justify-center w-full">
                    <label for="dropzone-file" class="flex flex-col items-center justify-center w-full h-64 border-2 border-gray-300 border-dashed rounded-lg cursor-pointer bg-gray-200 dark:hover:bg-gray-800 dark:bg-gray-700 hover:bg-gray-100 dark:border-gray-600 dark:hover:border-gray-500 dark:hover:bg-gray-600">
                        <div class="flex flex-col items-center justify-center pt-5 pb-6">
                            <svg class="w-8 h-8 mb-4 text-gray-500 dark:text-gray-400" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 20 16">
                                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 13h3a3 3 0 0 0 0-6h-.025A5.56 5.56 0 0 0 16 6.5 5.5 5.5 0 0 0 5.207 5.021C5.137 5.017 5.071 5 5 5a4 4 0 0 0 0 8h2.167M10 15V6m0 0L8 8m2-2 2 2"/>
                            </svg>
                            <p class="mb-2 text-sm text-gray-500 dark:text-gray-400"><span class="font-semibold">Click to upload</span> or drag and drop</p>
                            <p class="text-xs text-gray-500 dark:text-gray-400">SVG, PNG, JPG or GIF (MAX. 800x400px)</p>
                        </div>
                        <input value="{{$file->file_path}}" id="dropzone-file" type="file" class="hidden" type="file" id="file" name="file" required />
                    </label>
                </div> 
                
                <input type="hidden" name="class_id" value="{{$file->class_id}}">
                <input type="hidden" name="teacher_id" value="{{$file->teacher_id}}">
                
                <div>
                    <button type="submit" class="w-full bg-blue-600 text-white p-2 rounded-md hover:bg-blue-700">Adicionar Ficheiro</button>
                </div>
            </form>
        </div>

        {{--*End of the main content--}}

    </div>
@endsection