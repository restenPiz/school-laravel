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
                <div class="w-2/12 px-4 py-3">Student Name</div>
                <div class="w-2/12 px-4 py-3">Payment Type</div>
                <div class="w-2/12 px-4 py-3">Due Date</div>
                <div class="w-2/12 px-4 py-3">Amount</div>
                <div class="w-2/12 px-4 py-3">Status</div>
                <div class="w-2/12 px-4 py-3 text-right"></div>
            </div>
                @foreach(session('records') as $record)
                    <div class="flex flex-wrap items-center text-gray-700 border-t-2 border-l-4 border-r-4 border-gray-300">
                        <div class="w-2/12 px-4 py-3 text-sm font-semibold text-gray-600 tracking-tight">{{ $record->student->user->name }}</div>
                        <div class="w-2/12 px-4 py-3 text-sm font-semibold text-gray-600 tracking-tight">{{ $record->payment_type }}</div>
                        <div class="w-2/12 px-4 py-3 text-sm font-semibold text-gray-600 tracking-tight">{{ date('d-m-y', strtotime($record->due_date)) }}</div>
                        <div class="w-2/12 px-4 py-3 text-sm font-semibold text-gray-600 tracking-tight">{{ $record->amount }}</div>
                        <div class="w-2/12 px-4 py-3 text-sm font-semibold text-gray-600 tracking-tight">
                            <span class="bg-yellow-200 text-sm mr-1 mb-1 px-2 border rounded-full">{{ $record->status }}</span>
                        </div>
                        <div class="w-2/12 flex items-center justify-end px-3">
                            <a href="">
                                <svg class="h-6 w-6 fill-current text-green-600" aria-hidden="true" focusable="false" data-prefix="fas" data-icon="pen-square" class="svg-inline--fa fa-pen-square fa-w-14" role="img" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 448 512"><path fill="currentColor" d="M400 480H48c-26.5 0-48-21.5-48-48V80c0-26.5 21.5-48 48-48h352c26.5 0 48 21.5 48 48v352c0 26.5-21.5 48-48 48zM238.1 177.9L102.4 313.6l-6.3 57.1c-.8 7.6 5.6 14.1 13.3 13.3l57.1-6.3L302.2 242c2.3-2.3 2.3-6.1 0-8.5L246.7 178c-2.5-2.4-6.3-2.4-8.6-.1zM345 165.1L314.9 135c-9.4-9.4-24.6-9.4-33.9 0l-23.1 23.1c-2.3 2.3-2.3 6.1 0 8.5l55.5 55.5c2.3 2.3 6.1 2.3 8.5 0L345 199c9.3-9.3 9.3-24.5 0-33.9z"></path></svg>
                            </a>
                            <a href="" class="deletebtn ml-1 bg-red-600 block p-1 border border-red-600 rounded-sm">
                                <svg class="h-3 w-3 fill-current text-gray-100" aria-hidden="true" focusable="false" data-prefix="fas" data-icon="trash" class="svg-inline--fa fa-trash fa-w-14" role="img" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 448 512"><path fill="currentColor" d="M432 32H312l-9.4-18.7A24 24 0 0 0 281.1 0H166.8a23.72 23.72 0 0 0-21.4 13.3L136 32H16A16 16 0 0 0 0 48v32a16 16 0 0 0 16 16h416a16 16 0 0 0 16-16V48a16 16 0 0 0-16-16zM53.2 467a48 48 0 0 0 47.9 45h245.8a48 48 0 0 0 47.9-45L416 128H32z"></path></svg>
                            </a>
                        </div>
                    </div>
                @endforeach
        </div>
        @else
            <p class="text-gray-600 font-bold">No records found</p>
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