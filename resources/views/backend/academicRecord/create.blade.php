@extends('layouts.app')

@section('content')
    <div class="roles">

        <div class="flex items-center justify-between mb-6">
            <div>
                <h2 class="text-gray-700 uppercase font-bold">Add New Academic Record</h2>
            </div>
            <div class="flex flex-wrap items-center">
                <a href="{{ route('academicRecord.index') }}" class="bg-gray-700 text-white text-sm uppercase py-2 px-4 flex items-center rounded">
                    <svg class="w-3 h-3 fill-current" aria-hidden="true" focusable="false" data-prefix="fas" data-icon="long-arrow-alt-left" class="svg-inline--fa fa-long-arrow-alt-left fa-w-14" role="img" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 448 512"><path fill="currentColor" d="M134.059 296H436c6.627 0 12-5.373 12-12v-56c0-6.627-5.373-12-12-12H134.059v-46.059c0-21.382-25.851-32.09-40.971-16.971L7.029 239.029c-9.373 9.373-9.373 24.569 0 33.941l86.059 86.059c15.119 15.119 40.971 4.411 40.971-16.971V296z"></path></svg>
                    <span class="ml-2 text-xs font-semibold">Back</span>
                </a>
            </div>
        </div>
        <!-- Log on to codeastro.com for more projects -->
        <div class="table w-full mt-8 bg-white rounded">
            <form action="{{ route('academicRecord.store') }}" method="POST" class="w-full max-w-xl px-6 py-12" enctype="multipart/form-data">
                @csrf

                <!-- Tipo de Pagamento -->
                <div class="md:flex md:items-center mb-6">
                    <div class="md:w-1/3">
                        <label class="block text-gray-500 font-bold md:text-right mb-1 md:mb-0 pr-4">
                            Payment Type
                        </label>
                    </div>
                    <div class="md:w-2/3">
                        <select name="payment_type" class="block font-bold appearance-none w-full bg-gray-200 border border-gray-200 text-gray-600 py-3 px-4 pr-8 rounded leading-tight focus:outline-none focus:bg-white focus:border-gray-500">
                            <option value="">--Select Payment Type--</option>
                            <option value="monthly">Monthly</option>
                            <option value="quartely">Quarterly</option>
                            <option value="yearly">Yearly</option>
                        </select>
                    </div>
                </div>

                <!-- Ano -->
                <div class="md:flex md:items-center mb-6">
                    <div class="md:w-1/3">
                        <label class="block text-gray-500 font-bold md:text-right mb-1 md:mb-0 pr-4">
                            Year
                        </label>
                    </div>
                    <div class="md:w-2/3">
                        <select name="year" class="block font-bold appearance-none w-full bg-gray-200 border border-gray-200 text-gray-600 py-3 px-4 pr-8 rounded leading-tight focus:outline-none focus:bg-white focus:border-gray-500">
                            <option value="">-- Select Year --</option>
                            @for ($year = 2020; $year <= date('Y'); $year++)
                                <option value="{{ $year }}">{{ $year }}</option>
                            @endfor
                        </select>
                    </div>
                </div>

                <!-- Data de Vencimento -->
                <div class="md:flex md:items-center mb-6">
                    <div class="md:w-1/3">
                        <label class="block text-gray-500 font-bold md:text-right mb-1 md:mb-0 pr-4">
                            Due Date
                        </label>
                    </div>
                    <div class="md:w-2/3">
                        <input type="date" name="due_date" class="block font-bold appearance-none w-full bg-gray-200 border border-gray-200 text-gray-600 py-3 px-4 pr-8 rounded leading-tight focus:outline-none focus:bg-white focus:border-gray-500" />
                    </div>
                </div>

                <!-- Seleção de Classe -->
                <div class="md:flex md:items-center mb-6">
                    <div class="md:w-1/3">
                        <label class="block text-gray-500 font-bold md:text-right mb-1 md:mb-0 pr-4">
                            Classes
                        </label>
                    </div>
                    <div class="md:w-2/3">
                        <select id="class-select" name="grade" class="block font-bold appearance-none w-full bg-gray-200 border border-gray-200 text-gray-600 py-3 px-4 pr-8 rounded leading-tight focus:outline-none focus:bg-white focus:border-gray-500">
                            <option value="">--Select Their Class--</option>
                            @foreach ($classes as $class)
                                <option value="{{ $class->id }}">{{ $class->class_name }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>

                <!-- Seleção de Estudante (Começa desabilitado) -->
                <div class="md:flex md:items-center mb-6">
                    <div class="md:w-1/3">
                        <label class="block text-gray-500 font-bold md:text-right mb-1 md:mb-0 pr-4">
                            Student
                        </label>
                    </div>
                    <div class="md:w-2/3">
                        <select id="student-select" name="student_id" class="block font-bold appearance-none w-full bg-gray-200 border border-gray-200 text-gray-600 py-3 px-4 pr-8 rounded leading-tight focus:outline-none focus:bg-white focus:border-gray-500" disabled>
                            <option value="">--Select Student--</option>
                        </select>
                    </div>
                </div>

                <!-- Botão de Envio -->
                <div class="md:flex md:items-center">
                    <div class="md:w-1/3"></div>
                    <div class="md:w-2/3">
                        <button class="shadow bg-blue-500 hover:bg-blue-400 focus:shadow-outline focus:outline-none text-white font-bold py-2 px-4 rounded" type="submit">
                            Submit
                        </button>
                    </div>
                </div>
            </form>
   
        </div>
        <!-- Log on to codeastro.com for more projects -->
    </div>
    <script>
        document.addEventListener("DOMContentLoaded", function() {
            let classSelect = document.getElementById("class-select");
            let studentSelect = document.getElementById("student-select");

            classSelect.addEventListener("change", function() {
                let classId = this.value;

                if (classId) {
                    fetch(`/get-students-by-class/${classId}`) // Endpoint que retorna estudantes de uma classe
                        .then(response => response.json())
                        .then(data => {
                            studentSelect.innerHTML = '<option value="">--Select Student--</option>'; // Limpa antes de adicionar
                            data.students.forEach(student => {
                                studentSelect.innerHTML += `<option value="${student.id}">${student.name}</option>`;
                            });
                            studentSelect.disabled = false; // Habilita o campo
                        })
                        .catch(error => console.error("Erro ao carregar estudantes:", error));
                } else {
                    studentSelect.innerHTML = '<option value="">--Select Student--</option>';
                    studentSelect.disabled = true; // Desabilita novamente
                }
            });
        });
    </script>
@endsection