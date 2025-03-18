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
                <!-- Cabeçalho da Tabela -->
                <div class="flex flex-wrap items-center uppercase text-sm font-semibold bg-gray-600 text-white rounded-tl rounded-tr">
                    <div class="w-2/12 px-4 py-3">Amount Due</div>
                    <div class="w-2/12 px-4 py-3">Penalty Fee</div>
                    <div class="w-1/12 px-4 py-3">Year</div>
                    <div class="w-1/12 px-4 py-3">Month</div>
                    <div class="w-2/12 px-4 py-3">Status</div>
                    <div class="w-3/12 px-4 py-3"></div>
                </div>

                @foreach ($fees as $fee)
                    <div class="flex flex-wrap items-center text-gray-700 border-t-2 border-gray-300">
                        <!-- Valor a pagar -->
                        <div class="w-2/12 px-4 py-3 text-sm font-semibold text-gray-600">
                            {{ number_format($fee->amount_due, 2) }} MZN
                        </div>

                        <!-- Multa -->
                        <div class="w-2/12 px-4 py-3 text-sm font-semibold text-gray-600">
                            {{ number_format($fee->penalty_fee, 2) }} MZN
                        </div>

                        <!-- Ano -->
                        <div class="w-1/12 px-4 py-3 text-sm font-semibold text-gray-600">
                            {{ date('Y', strtotime($fee->due_date)) }}
                        </div>

                        <!-- Mês -->
                        <div class="w-1/12 px-4 py-3 text-sm font-semibold text-gray-600">
                            {{ date('F', strtotime($fee->due_date)) }}
                        </div>

                        <!-- Status -->
                        <div class="w-2/12 px-4 py-3 text-sm font-semibold">
                            @if($fee->status === 'Pago')
                                <span class="bg-green-200 text-sm px-2 border rounded-full">Pago</span>
                            @else
                                <span class="bg-red-200 text-sm px-2 border rounded-full">Pendente</span>
                            @endif
                        </div>

                        <!-- Botão de pagamento -->
                        <div class="w-3/12 px-4 py-3 flex items-center justify-end">
                            @if($fee->status !== 'Pago')
                                <div class="relative">
                                    <a href="" style="background-color: rgb(24, 24, 189);color:white; border-radius:0.2rem; ">
                                        <svg class="h-5 w-5 fill-current" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 576 512">
                                            <path fill="currentColor" d="M527.9 112H48c-26.5 0-48 21.5-48 48v192c0 26.5 21.5 48 48 48h479.9c26.5 0 48-21.5 48-48V160c0-26.5-21.5-48-48-48zM288 352c-17.7 0-32-14.3-32-32 0-17.7 14.3-32 32-32s32 14.3 32 32c0 17.7-14.3 32-32 32zm208-96c0 8.8-7.2 16-16 16H96c-8.8 0-16-7.2-16-16V192c0-8.8 7.2-16 16-16h384c8.8 0 16 7.2 16 16v64z"/>
                                        </svg>
                                    </a>
                                </div>
                            @else
                                <span class="text-gray-500">-</span>
                            @endif

                            <!-- Botão de edição -->
                            <a href="">
                                <svg class="h-6 w-6 fill-current text-green-600 hover:text-green-800 transition duration-300" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 448 512">
                                    <path fill="currentColor" d="M400 480H48c-26.5 0-48-21.5-48-48V80c0-26.5 21.5-48 48-48h352c26.5 0 48 21.5 48 48v352c0 26.5-21.5 48-48 48zM238.1 177.9L102.4 313.6l-6.3 57.1c-.8 7.6 5.6 14.1 13.3 13.3l57.1-6.3L302.2 242c2.3-2.3 2.3-6.1 0-8.5L246.7 178c-2.5-2.4-6.3-2.4-8.6-.1zM345 165.1L314.9 135c-9.4-9.4-24.6-9.4-33.9 0l-23.1 23.1c-2.3 2.3-2.3 6.1 0 8.5l55.5 55.5c2.3 2.3 6.1 2.3 8.5 0L345 199c9.3-9.3 9.3-24.5 0-33.9z"/>
                                </svg>
                            </a>

                            <!-- Botão de exclusão -->
                            <a class="deletebtn ml-1 bg-red-600 block p-1 border border-red-600 rounded-sm hover:bg-red-800 transition duration-300">
                                <svg class="h-3 w-3 fill-current text-gray-100" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 448 512">
                                    <path fill="currentColor" d="M432 32H312l-9.4-18.7A24 24 0 0 0 281.1 0H166.8a23.72 23.72 0 0 0-21.4 13.3L136 32H16A16 16 0 0 0 0 48v32a16 16 0 0 0 16 16h416a16 16 0 0 0 16-16V48a16 16 0 0 0-16-16zM53.2 467a48 48 0 0 0 47.9 45h245.8a48 48 0 0 0 47.9-45L416 128H32z"/>
                                </svg>
                            </a>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>


        </div>
    </div>
@endsection
