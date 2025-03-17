@extends('layouts.app')

@section('content')
    <div class="create">

        <div class="flex items-center justify-between mb-6">
            <div>
                <h2 class="text-gray-700 uppercase font-bold">Academic Record Report</h2>
            </div>
            <div class="flex flex-wrap items-center">
                <a href="{{ route('academicRecord.create') }}" class="bg-green-500 text-white text-sm uppercase py-2 px-4 flex items-center rounded">
                    <svg class="w-3 h-3 fill-current" aria-hidden="true" focusable="false" data-prefix="fas" data-icon="plus" class="svg-inline--fa fa-plus fa-w-14" role="img" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 448 512"><path fill="currentColor" d="M416 208H272V64c0-17.67-14.33-32-32-32h-32c-17.67 0-32 14.33-32 32v144H32c-17.67 0-32 14.33-32 32v32c0 17.67 14.33 32 32 32h144v144c0 17.67 14.33 32 32 32h32c17.67 0 32-14.33 32-32V304h144c17.67 0 32-14.33 32-32v-32c0-17.67-14.33-32-32-32z"></path></svg>
                    <span class="ml-2 text-xs font-semibold">Create a Report</span>
                </a>
            </div>
        </div>
        <!-- Log on to codeastro.com for more projects -->
        <div class="w-full mt-8 bg-white rounded">
            <form action="{{ route('generateRecords') }}" method="GET" class="md:flex md:items-center md:justify-between px-6 py-6 pb-0">
                <div class="md:flex md:items-center mb-6 text-gray-700 uppercase font-bold w-full ">
                    <div class="block text-gray-600 font-bold">
                        <div class="relative">
                            <select style="width: 12rem" name="year" class="block font-bold appearance-none w-full bg-gray-200 border border-gray-200 text-gray-600 py-3 px-4 pr-8 rounded leading-tight focus:outline-none focus:bg-white focus:border-gray-500">
                                <option value="">-- Select Year --</option>
                                @for ($year = 2020; $year <= date('Y'); $year++)
                                    <option value="{{ $year }}">{{ $year }}</option>
                                @endfor
                            </select>
                            <div class="pointer-events-none absolute inset-y-0 right-0 flex items-center px-2 text-gray-700">
                                <svg class="fill-current h-4 w-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20"><path d="M9.293 12.95l.707.707L15.657 8l-1.414-1.414L10 10.828 5.757 6.586 4.343 8z"/></svg>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="md:flex md:items-center mb-6 text-gray-700 uppercase font-bold w-full">
                    <div class="block text-gray-600 font-bold">
                        <div class="relative">
                            <select style="width: 12rem" name="month" class="block font-bold appearance-none w-full bg-gray-200 border border-gray-200 text-gray-600 py-3 px-4 pr-8 rounded leading-tight focus:outline-none focus:bg-white focus:border-gray-500">
                                <option value="">-- Select Month --</option>
                                @foreach (range(2, 12) as $month)
                                    <option value="{{ str_pad($month, 2, '0', STR_PAD_LEFT) }}">
                                        {{ date('F', mktime(0, 0, 0, $month, 1)) }}
                                    </option>
                                @endforeach
                            </select>
                            <div class="pointer-events-none absolute inset-y-0 right-0 flex items-center px-2 text-gray-700">
                                <svg class="fill-current h-4 w-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20"><path d="M9.293 12.95l.707.707L15.657 8l-1.414-1.414L10 10.828 5.757 6.586 4.343 8z"/></svg>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="md:flex md:items-center mb-6 text-gray-700 uppercase font-bold w-full">
                    <div class="block text-gray-600 font-bold">
                        <div class="relative">
                            <select style="width: 15rem" id="class-select" name="class" class="block font-bold appearance-none w-full bg-gray-200 border border-gray-200 text-gray-600 py-3 px-4 pr-8 rounded leading-tight focus:outline-none focus:bg-white focus:border-gray-500">
                                <option value="">-- Select the Course --</option>
                                @foreach ($classes as $class)
                                    <option value="{{$class->id}}">{{$class->class_name}}</option>
                                @endforeach
                            </select>
                            <div class="pointer-events-none absolute inset-y-0 right-0 flex items-center px-2 text-gray-700">
                                <svg class="fill-current h-4 w-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20"><path d="M9.293 12.95l.707.707L15.657 8l-1.414-1.414L10 10.828 5.757 6.586 4.343 8z"/></svg>
                            </div>
                        </div>
                    </div>
                </div>
                <div class=" md:items-center mb-6 w-full px-6 py-6">
                    <div class="relative">
                        <select style="width: 25rem" id="student-select" name="student" class="block font-bold appearance-none w-full bg-gray-200 border border-gray-200 text-gray-600 py-3 px-4 pr-8 rounded leading-tight focus:outline-none focus:bg-white focus:border-gray-500" disabled>
                            <option value="">--Select Student--</option>
                        </select>
                        <div class="pointer-events-none absolute inset-y-0 right-0 flex items-center px-2 text-gray-700">
                            <svg class="fill-current h-4 w-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20"><path d="M9.293 12.95l.707.707L15.657 8l-1.414-1.414L10 10.828 5.757 6.586 4.343 8z"/></svg>
                        </div>
                    </div>
                </div> 
                
                <div class=" md:items-center mb-6 text-gray-700 uppercase font-bold">
                    <button class="shadow bg-blue-500 hover:bg-blue-400 focus:shadow-outline focus:outline-none text-white font-bold py-2 px-4 rounded" type="submit">Generate</button>
                </div> 
            </form>
        </div>

       @if(session('records'))
            <div class="mt-8 bg-white rounded border-b-4 border-gray-300">
                <div class="flex flex-wrap items-center uppercase text-sm font-semibold bg-gray-600 text-white rounded-tl rounded-tr">
                    <div class="w-3/12 px-4 py-3">Student Name</div>
                    <div class="w-2/12 px-4 py-3">Class</div>
                    <div class="w-2/12 px-4 py-3">Payment Type</div>
                    <div class="w-2/12 px-4 py-3">Amount</div>
                    <div class="w-2/12 px-4 py-3">Status</div>
                </div>

                @foreach(session('records') as $record)
                    <div class="flex flex-wrap items-center text-gray-700 border-t-2 border-l-4 border-r-4 border-gray-300">
                        <div class="w-3/12 px-4 py-3 text-sm font-semibold text-gray-600 tracking-tight">{{ $record->student->user->name }}</div>
                        <div class="w-2/12 px-4 py-3 text-sm font-semibold text-gray-600 tracking-tight">{{ $record->class->class_name }}</div>
                        <div class="w-2/12 px-4 py-3 text-sm font-semibold text-gray-600 tracking-tight">{{ ucfirst($record->payment_type) }}</div>
                        <div class="w-2/12 px-4 py-3 text-sm font-semibold text-gray-600 tracking-tight">{{ number_format($record->amount, 2) }}</div>
                        <div class="w-2/12 px-4 py-3 text-sm font-semibold">
                            @php
                                $paid = session('payments')[$record->student_id][\Carbon\Carbon::parse($record->due_date)->format('m')] ?? null;
                            @endphp
                            @if($paid)
                                <span class="bg-green-200 text-xs px-2 rounded-full">Pago</span>
                            @else
                                <span class="bg-red-200 text-xs px-2 rounded-full">Pendente</span>
                            @endif
                        </div>
                    </div>
                @endforeach
            </div>
        @else
            <p class="text-gray-600 font-bold mt-4">No records found</p>
        @endif


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