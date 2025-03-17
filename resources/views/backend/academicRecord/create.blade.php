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

                <div class="mb-4">
                    <label class="block text-gray-600 font-bold">Estudante</label>
                    <select name="student_id" required class="w-full p-3 border rounded">
                        <option value="">-- Selecione o Estudante --</option>
                        @foreach ($students as $student)
                            <option value="{{ $student->id }}">{{ $student->user->name }}</option>
                        @endforeach
                    </select>
                </div>

                <!-- Selecionar a Classe -->
                <div class="mb-4">
                    <label class="block text-gray-600 font-bold">Classe</label>
                    <select name="class_id" required class="w-full p-3 border rounded">
                        <option value="">-- Selecione a Classe --</option>
                        @foreach ($classes as $class)
                            <option value="{{ $class->id }}">{{ $class->class_name }}</option>
                        @endforeach
                    </select>
                </div>

                <!-- Tipo de Pagamento -->
                <div class="mb-4">
                    <label class="block text-gray-600 font-bold">Tipo de Pagamento</label>
                    <select name="payment_type" required class="w-full p-3 border rounded">
                        <option value="monthly">Mensal</option>
                        <option value="quartely">Trimestral</option>
                        <option value="yearly">Anual</option>
                    </select>
                </div>

                <!-- Data de Vencimento -->
                <div class="mb-4">
                    <label class="block text-gray-600 font-bold">Data de Vencimento</label>
                    <input type="date" name="due_date" required class="w-full p-3 border rounded">
                </div>

                <!-- Valor da Propina -->
                <div class="mb-4">
                    <label class="block text-gray-600 font-bold">Valor da Propina</label>
                    <input type="number" name="amount_due" required step="0.01" class="w-full p-3 border rounded" placeholder="Exemplo: 5000">
                </div>

                <!-- Botão de Envio -->
                <div class="mt-6">
                    <button type="submit" class="w-full bg-blue-600 text-white font-bold py-3 rounded hover:bg-blue-700">
                        Registrar Propina
                    </button>
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