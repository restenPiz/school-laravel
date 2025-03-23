@extends('layouts.app')

@section('content')
    <div class="roles">
        {{--?Start with the content of main page--}}
        <div class="flex items-center justify-between mb-8">
            <h2 class="text-gray-700 uppercase font-bold">Search for Students Notes</h2>
        </div>

        <!-- Formulário -->
        <div class="w-full mt-8 bg-white rounded p-4">
            <form action="{{ route('payments.filter') }}" method="GET" class="flex flex-wrap items-center gap-4">
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
                    <button style="width: 11rem" type="submit" name="submit"
                        class="shadow bg-blue-500 hover:bg-blue-400 focus:shadow-outline focus:outline-none text-white font-bold py-2 px-6 rounded">
                        Generate
                    </button>
                </div>
            </form>
        </div>

        {{--? Start with table of students--}}
        <div class="">
            {{-- <div>
                <select name="year" id="yearFilter" onchange="filterFees()" class="block font-bold appearance-none w-1/3 bg-gray-200 border border-gray-200 text-gray-600 py-3 px-4 pr-8 rounded leading-tight focus:outline-none focus:bg-white focus:border-gray-500">
                    <option value="">Select the year</option>
                    @foreach (range(2010, date('Y')) as $year)
                        <option value="{{ $year }}">{{ $year }}</option>
                    @endforeach
                </select>
            </div> --}}
            <div class="mt-8 bg-white rounded border-b-4 border-gray-300" id="feesTable">
                <!-- Cabeçalho da Tabela -->
                <div class="flex flex-wrap items-center uppercase text-sm font-semibold bg-gray-600 text-white rounded-tl rounded-tr">
                    <div class="w-2/12 px-4 py-3">Amount Due</div>
                    <div class="w-2/12 px-4 py-3">Amount Paid</div>
                    <div class="w-2/12 px-4 py-3">Penalty Fee</div>
                    <div class="w-2/12 px-4 py-3"></div>
                </div>

                @foreach ($students as $student)
                    <div class="flex flex-wrap items-center text-gray-700 border-t-2 border-gray-300">
                        <!-- Valor a pagar -->
                        <div class="w-2/12 px-4 py-3 text-sm font-semibold text-gray-600">
                            {{$student->user->name}}
                        </div>
                        <div class="w-2/12 px-4 py-3 text-sm font-semibold text-gray-600">
                            {{$student->user->name}}
                        </div>
                        <div class="w-2/12 px-4 py-3 text-sm font-semibold text-gray-600">
                            {{$student->user->name}}
                        </div>
                        <div class="w-2/12 px-4 py-3 text-sm font-semibold">

                        </div>
                    </div>
                @endforeach
            </div>
        </div>
        {{--?End of page--}}
    </div>
@endsection