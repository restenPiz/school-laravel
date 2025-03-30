@extends('layouts.app')

@section('content')
   <link rel="stylesheet" href="">
    <link href="https://cdn.jsdelivr.net/npm/flowbite@3.1.2/dist/flowbite.min.css" rel="stylesheet" />
    </link>
    <div class="roles">

        {{--?Start with the main content--}}
        <div class="max-w-4xl mx-auto bg-white p-6 rounded-lg shadow-lg">
            <div class="flex justify-between items-center mb-4">
                <h2 class="text-2xl font-semibold">Arquivos da Turma</h2>
                <a href="{{route('teacherFile',['id'=>$class->id])}}" class="bg-blue-500 text-white px-4 py-2 rounded hover:bg-blue-600">Adicionar</a>
            </div>
        
            <div class="overflow-x-auto">
                <table class="w-full border-collapse border border-gray-300">
                    <thead>
                        <tr class="bg-gray-200">
                            <th class="border p-2 text-left">Título</th>
                            <th class="border p-2 text-left">Descrição</th>
                            <th class="border p-2 text-left">Professor</th>
                            <th class="border p-2 text-center">Ação</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($class->files as $file)
                            <tr class="hover:bg-gray-100">
                                <td class="border p-2">{{ $file->title }}</td>
                                <td class="border p-2">{{ $file->description }}</td>
                                <td class="border p-2">{{ $file->teacher->user->name }}</td>
                                <td class="border p-2 text-center">
                                    <a href="{{ asset('storage/' . $file->file_path) }}" target="_blank" class="bg-blue-500 text-white px-4 py-2 rounded hover:bg-blue-600">
                                        Baixar
                                    </a>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
        {{--?End of with the main content--}}

    </div>
@endsection