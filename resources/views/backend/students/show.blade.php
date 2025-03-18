@extends('layouts.app')

@section('content')
    <div class="roles">

        <div class="flex items-center justify-between mb-6">
            <div>
                <h2 class="text-2xl font-bold text-gray-800">Student Details</h2>
            </div>
            <div class="flex flex-wrap items-center">
                <a href="{{ route('student.index') }}" class="bg-gray-800 text-white text-sm py-2 px-4 flex items-center rounded-lg hover:bg-gray-700 transition duration-300">
                    <svg class="w-4 h-4 fill-current" aria-hidden="true" focusable="false" data-prefix="fas" data-icon="long-arrow-alt-left" role="img" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 448 512"><path fill="currentColor" d="M134.059 296H436c6.627 0 12-5.373 12-12v-56c0-6.627-5.373-12-12-12H134.059v-46.059c0-21.382-25.851-32.09-40.971-16.971L7.029 239.029c-9.373 9.373-9.373 24.569 0 33.941l86.059 86.059c15.119 15.119 40.971 4.411 40.971-16.971V296z"></path></svg>
                    <span class="ml-2 text-xs font-semibold">Back</span>
                </a>
            </div>
        </div>

        <div class="mt-8 bg-white rounded-lg shadow-lg p-6">
            <div class="flex flex-wrap sm:flex-no-wrap justify-between">

                <div class="w-full sm:w-1/2 mr-2 mb-6">

                    <!-- Profile Picture -->
                    <div class="flex items-center justify-center mb-6">
                        <img class="w-32 h-32 rounded-full border-4 border-gray-200" src="{{ asset('images/profile/' .$student->user->profile_picture) }}" alt="Student Avatar">
                    </div>

                    <!-- Student Information -->
                    <div class="space-y-4">
                        @foreach ([
                            ['label' => 'Name', 'value' => $student->user->name],
                            ['label' => 'Email', 'value' => $student->user->email],
                            ['label' => 'Roll', 'value' => $student->roll_number],
                            ['label' => 'Phone', 'value' => $student->phone],
                            ['label' => 'Gender', 'value' => $student->gender],
                            ['label' => 'Date of Birth', 'value' => $student->dateofbirth],
                            ['label' => 'Current Address', 'value' => $student->current_address],
                            ['label' => 'Permanent Address', 'value' => $student->permanent_address],
                        ] as $info)
                            <div class="flex justify-between items-center">
                                <div class="text-gray-500 font-semibold w-1/3">{{ $info['label'] }}:</div>
                                <div class="text-gray-700 font-medium w-2/3">{{ $info['value'] }}</div>
                            </div>
                        @endforeach
                    </div>

                    <!-- Parent Information -->
                    <div class="mt-8 space-y-4">
                        <h3 class="text-lg font-bold text-gray-800 mb-4">Parent's Details</h3>
                        @foreach ([
                            ['label' => 'Parent\'s Name', 'value' => $student->parent->user->name],
                            ['label' => 'Parent\'s Email', 'value' => $student->parent->user->email],
                            ['label' => 'Parent\'s Phone', 'value' => $student->parent->phone],
                            ['label' => 'Parent\'s Address', 'value' => $student->parent->current_address],
                        ] as $info)
                            <div class="flex justify-between items-center">
                                <div class="text-gray-500 font-semibold w-1/3">{{ $info['label'] }}:</div>
                                <div class="text-gray-700 font-medium w-2/3">{{ $info['value'] }}</div>
                            </div>
                        @endforeach
                    </div>

                </div>

                <div class="w-full sm:w-1/2 mr-2 mb-6">
                    <!-- Subject Table -->
                    <div class="bg-gray-600 text-white rounded-t-lg p-4">
                        <div class="grid grid-cols-3 gap-4 font-semibold">
                            <div>Code</div>
                            <div>Subject</div>
                            <div class="text-right">Teacher</div>
                        </div>
                    </div>
                    <div class="bg-gray-100 rounded-b-lg">
                        @foreach ($class->subjects as $subject)
                            <div class="flex justify-between items-center border-b border-gray-200 p-4">
                                <div class="w-1/3 text-gray-800">{{ $subject->subject_code }}</div>
                                <div class="w-1/3 text-gray-800">{{ $subject->name }}</div>
                                <div class="w-1/3 text-right text-gray-800">{{ $subject->teacher->user->name }}</div>
                            </div>
                        @endforeach
                    </div>
                </div>

            </div>
        </div>

        <div class="mt-8 bg-white rounded-lg shadow-lg p-6">
            <h1>Fees of Student <b>{{$student->user->name}}</b></h1>
            <div class="mt-8 bg-white rounded border-b-4 border-gray-300">
                <!-- Cabeçtudeno da Tabela -->
                <div class="flex flex-wrap items-center uppercase text-sm font-semibold bg-gray-600 text-white rounded-tl rounded-tr">
                    <div class="w-2/12 px-4 py-3">Amount Due</div>
                    <div class="w-2/12 px-4 py-3">Penalty Fee</div>
                    <div class="w-2/12 px-4 py-3">Year</div>
                    <div class="w-2/12 px-4 py-3">Month</div>
                    <div class="w-2/12 px-4 py-3">Status</div>
                </div>

                @foreach ($fees as $fee)
                    <div class="flex flex-wrap items-center text-gray-700 border-t-2 border-gray-300">
                        <!-- Nome do Estudante -->
                        <div class="w-2/12 px-4 py-3 text-sm font-semibold text-gray-600">
                            {{ $fee->amount_due }}
                        </div>

                        <div class="w-2/12 px-4 py-3 text-sm font-semibold text-gray-600">
                            {{ $fee->penalty_fee }}
                        </div>

                        <!-- Ano da Propina -->
                        <div class="w-2/12 px-4 py-3 text-sm font-semibold text-gray-600">
                            {{ date('Y', strtotime($fee->due_date)) }}
                        </div>

                        <!-- Mês da Propina -->
                        <div class="w-2/12 px-4 py-3 text-sm font-semibold text-gray-600">
                            {{ date('F', strtotime($fee->due_date)) }}
                        </div>

                        <!-- Status do Pagamento -->
                        <div class="w-2/12 px-4 py-3 text-sm font-semibold">
                            @if($fee->status === 'Pago')
                                <span class="bg-green-200 text-sm px-2 border rounded-full">Pago</span>
                            @else
                                <span class="bg-red-200 text-sm px-2 border rounded-full">Pendente</span>
                            @endif
                        </div>
                    </div>
                @endforeach
            </div>

        </div>
    </div>
@endsection
