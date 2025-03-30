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
                    <h2 class="text-gray-700 uppercase font-bold">Add New Student</h2>
                </div>
                <div class="flex flex-wrap items-center">
                    <a href="{{ route('files',['id'=>$class->id]) }}"
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
            <form action="/files/store" method="POST" enctype="multipart/form-data" class="space-y-4">
                <div>
                    <label for="title" class="block font-medium text-gray-700">Título</label>
                    <input type="text" id="title" name="title" required class="w-full p-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500">
                </div>
                
                <div>
                    <label for="description" class="block font-medium text-gray-700">Descrição</label>
                    <textarea id="description" name="description" class="w-full p-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500"></textarea>
                </div>
                
                <div>
                    <label for="file" class="block font-medium text-gray-700">Ficheiro</label>
                    <input type="file" id="file" name="file" required class="w-full p-2 border border-gray-300 rounded-md">
                </div>
                
                <div>
                    <label for="visibility" class="block font-medium text-gray-700">Visibilidade</label>
                    <select id="visibility" name="visibility" class="w-full p-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500">
                        <option value="restricted">Restrito</option>
                        <option value="public">Público</option>
                    </select>
                </div>
                
                <div>
                    <button type="submit" class="w-full bg-blue-600 text-white p-2 rounded-md hover:bg-blue-700">Adicionar Ficheiro</button>
                </div>
            </form>
        </div>

        {{--*End of the main content--}}

    </div>
@endsection