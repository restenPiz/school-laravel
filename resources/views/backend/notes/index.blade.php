@extends('layouts.app')

@section('content')
    <div class="roles">
        {{--?Start with the content of main page--}}
        <div class="flex items-center justify-between mb-8">
            <h2 class="text-gray-700 uppercase font-bold">Search for Students Notes</h2>
        </div>

        <!-- Formulário -->
        <div class="w-full mt-8 bg-white rounded p-2">
            <form action="{{route('filterNote')}}" method="GET" class="flex flex-wrap items-center gap-4">
                @csrf
                <!-- Select de Curso -->
                <div class="relative w-80" style=" width: 29rem;">
                    <select id="class-select" name="class_id"
                        class="block appearance-none w-full bg-gray-200 border border-gray-300 text-gray-700 py-3 px-4 pr-8 rounded leading-tight focus:outline-none focus:bg-white focus:border-gray-500">
                        <option value="">-- Select the Course --</option>
                        @foreach ($classes as $class)
                            <option value="{{ $class->id }}">{{ $class->class_name }}</option>
                        @endforeach
                    </select>
                    <div class="absolute inset-y-0 right-0 flex items-center px-2 text-gray-700">
                        <svg class="fill-current h-4 w-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20">
                            <path d="M9.293 12.95l.707.707L15.657 8l-1.414-1.414L10 10.828 5.757 6.586 4.343 8z" />
                        </svg>
                    </div>
                </div>

                <!-- Select de Estudante -->
                <div class="relative w-80" style="margin-left:1rem; width: 33rem;">
                    <select id="student-select" name="student_id"
                        class="block appearance-none w-full bg-gray-200 border border-gray-300 text-gray-700 py-3 px-4 pr-8 rounded leading-tight focus:outline-none focus:bg-white focus:border-gray-500"
                        disabled>
                        <option value="">-- Select Student --</option>
                    </select>
                    <div class="absolute inset-y-0 right-0 flex items-center px-2 text-gray-700">
                        <svg class="fill-current h-4 w-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20">
                            <path d="M9.293 12.95l.707.707L15.657 8l-1.414-1.414L10 10.828 5.757 6.586 4.343 8z" />
                        </svg>
                    </div>
                </div>

                <!-- Botão de Gerar -->
                <div style="margin-left:1rem">
                    <button id="search-btn" type="button" style="width:12rem;height:2.9rem"
                        class="shadow bg-blue-500 hover:bg-blue-400 focus:shadow-outline focus:outline-none text-white font-bold py-2 px-6 rounded">
                        Generate
                    </button>
                </div>
            </form>
        </div>

        {{--? Start with table of students--}}
        <div class="">
            <div class="mt-8 bg-white rounded border-b-4 border-gray-300" id="feesTable">
                <!-- Cabeçalho da Tabela -->
                <div class="flex flex-wrap items-center uppercase text-sm font-semibold bg-gray-600 text-white rounded-tl rounded-tr">
                    <div class="w-2/12 px-4 py-3">Student Name</div>
                    <div class="w-3/12 px-4 py-3">Student Class</div>
                    <div class="w-3/12 px-4 py-3">Parent Name</div>
                    <div class="w-2/12 px-4 py-3">Date of Birth</div>
                    <div class="w-2/12 px-4 py-3"></div>
                </div>

                @foreach ($students as $student)
                    <div class="flex flex-wrap items-center text-gray-700 border-t-2 border-gray-300" id="feesTable">
                        <!-- Valor a pagar -->
                        <div class="w-2/12 px-4 py-3 text-sm font-semibold text-gray-600">
                            {{$student->user->name}}
                        </div>
                        <div class="w-3/12 px-4 py-3 text-sm font-semibold text-gray-600">
                            {{$student->class->class_name}}
                        </div>
                        <div class="w-3/12 px-4 py-3 text-sm font-semibold text-gray-600">
                            {{$student->parent->user->name}}
                        </div>
                        <div class="w-2/12 px-4 py-3 text-sm font-semibold text-gray-600">
                            {{date('d-F-Y',strtotime($student->dateofbirth))}}
                        </div>
                        <div class="w-2/12 px-4 py-3 text-sm font-semibold">
                            <a href="{{route('notes.create',['id'=>$student->id])}}" class=" h-7 w-6 ml-1 bg-blue-600 block p-1 border border-blue-600 rounded-sm" title="Assign Subject">
                                <svg class="h-3 w-3 fill-current text-gray-100" aria-hidden="true" focusable="false" data-prefix="fas" data-icon="align-right" class="svg-inline--fa fa-align-right fa-w-14" role="img" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 448 512"><path fill="currentColor" d="M160 84V44c0-8.837 7.163-16 16-16h256c8.837 0 16 7.163 16 16v40c0 8.837-7.163 16-16 16H176c-8.837 0-16-7.163-16-16zM16 228h416c8.837 0 16-7.163 16-16v-40c0-8.837-7.163-16-16-16H16c-8.837 0-16 7.163-16 16v40c0 8.837 7.163 16 16 16zm0 256h416c8.837 0 16-7.163 16-16v-40c0-8.837-7.163-16-16-16H16c-8.837 0-16 7.163-16 16v40c0 8.837 7.163 16 16 16zm160-128h256c8.837 0 16-7.163 16-16v-40c0-8.837-7.163-16-16-16H176c-8.837 0-16 7.163-16 16v40c0 8.837 7.163 16 16 16z"></path></svg>
                            </a>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
        {{--?End of page--}}
    </div>
    <script>
        document.addEventListener("DOMContentLoaded", function() {
            let classSelect = document.getElementById("class-select");
            let studentSelect = document.getElementById("student-select");

            classSelect.addEventListener("change", function() {
                let classId = this.value;

                if (classId) {
                    fetch(
                        `/get-students-by-class/${classId}`) // Endpoint que retorna estudantes de uma classe
                        .then(response => response.json())
                        .then(data => {
                            studentSelect.innerHTML =
                            '<option value="">--Select Student--</option>'; // Limpa antes de adicionar
                            data.students.forEach(student => {
                                studentSelect.innerHTML +=
                                    `<option value="${student.id}">${student.name}</option>`;
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
    

    <script>
        document.addEventListener("DOMContentLoaded", function () {
        let classSelect = document.getElementById("class-select");
        let studentSelect = document.getElementById("student-select");
        let searchBtn = document.getElementById("search-btn");
        let tableBody = document.getElementById("feesTable");

        // Evento para buscar os estudantes ao selecionar a turma
        classSelect.addEventListener("change", function () {
            let classId = this.value;

            if (classId) {
                fetch(`/get-students-by-class/${classId}`)
                    .then(response => response.json())
                    .then(data => {
                        studentSelect.innerHTML = '<option value="">--Select Student--</option>';
                        data.students.forEach(student => {
                            studentSelect.innerHTML += `<option value="${student.id}">${student.name}</option>`;
                        });
                        studentSelect.disabled = false;
                    })
                    .catch(error => console.error("Erro ao carregar estudantes:", error));
            } else {
                studentSelect.innerHTML = '<option value="">--Select Student--</option>';
                studentSelect.disabled = true;
            }
        });

        // Evento para buscar e exibir os resultados
        searchBtn.addEventListener("click", function () {
            let classId = classSelect.value;
            let studentId = studentSelect.value;

            fetch(`/filter-note?class_id=${classId}&student_id=${studentId}`)
                .then(response => response.json())
                .then(data => {
                    tableBody.innerHTML = `
                        <div class="flex flex-wrap items-center uppercase text-sm font-semibold bg-gray-600 text-white rounded-tl rounded-tr">
                            <div class="w-2/12 px-4 py-3">Student Name</div>
                            <div class="w-3/12 px-4 py-3">Student Class</div>
                            <div class="w-3/12 px-4 py-3">Parent Name</div>
                            <div class="w-2/12 px-4 py-3">Date of Birth</div>
                            <div class="w-2/12 px-4 py-3"></div>
                        </div>`;// Limpa a tabela antes de adicionar novos resultados

                    if (data.students.length > 0) {
                        data.students.forEach(student => {
                            tableBody.innerHTML += `
                                <div class="flex flex-wrap items-center text-gray-700 border-t-2 border-gray-300">
                                    <div class="w-2/12 px-4 py-3 text-sm font-semibold text-gray-600">${student.user.name}</div>
                                    <div class="w-3/12 px-4 py-3 text-sm font-semibold text-gray-600">${student.class.class_name}</div>
                                    <div class="w-3/12 px-4 py-3 text-sm font-semibold text-gray-600">${student.parent.user.name}</div>
                                    <div class="w-2/12 px-4 py-3 text-sm font-semibold text-gray-600">${new Date(student.dateofbirth).toLocaleDateString()}</div>
                                    <div class="w-2/12 px-4 py-3 text-sm font-semibold">
                                        <a href="" class=" h-7 w-6 ml-1 bg-blue-600 block p-1 border border-blue-600 rounded-sm" title="Assign Subject">
                                            <svg class="h-3 w-3 fill-current text-gray-100" aria-hidden="true" focusable="false" data-prefix="fas" data-icon="align-right" class="svg-inline--fa fa-align-right fa-w-14" role="img" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 448 512"><path fill="currentColor" d="M160 84V44c0-8.837 7.163-16 16-16h256c8.837 0 16 7.163 16 16v40c0 8.837-7.163 16-16 16H176c-8.837 0-16-7.163-16-16zM16 228h416c8.837 0 16-7.163 16-16v-40c0-8.837-7.163-16-16-16H16c-8.837 0-16 7.163-16 16v40c0 8.837 7.163 16 16 16zm0 256h416c8.837 0 16-7.163 16-16v-40c0-8.837-7.163-16-16-16H16c-8.837 0-16 7.163-16 16v40c0 8.837 7.163 16 16 16zm160-128h256c8.837 0 16-7.163 16-16v-40c0-8.837-7.163-16-16-16H176c-8.837 0-16 7.163-16 16v40c0 8.837 7.163 16 16 16z"></path></svg>
                                        </a>
                                    </div>
                                </div>`;
                        });
                    } else {
                        tableBody.innerHTML = `<tr><td colspan="4" class="text-center">No students found</td></tr>`;
                    }
                })
                .catch(error => console.error("Erro ao buscar notas:", error));
        });
    });
    </script>

@endsection