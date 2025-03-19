@extends('layouts.app')

@section('content')
    <div class="roles">

        <div class="flex items-center justify-between mb-6">
            <div>
                {{-- <h2 class="text-2xl font-bold text-gray-800">Student Details</h2> --}}
            </div>
            <div class="flex flex-wrap items-center">
                <a href="{{ route('student.index') }}" class="bg-gray-800 text-white text-sm py-2 px-4 flex items-center rounded-lg hover:bg-gray-700 transition duration-300">
                    <svg class="w-4 h-4 fill-current" aria-hidden="true" focusable="false" data-prefix="fas" data-icon="long-arrow-alt-left" role="img" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 448 512"><path fill="currentColor" d="M134.059 296H436c6.627 0 12-5.373 12-12v-56c0-6.627-5.373-12-12-12H134.059v-46.059c0-21.382-25.851-32.09-40.971-16.971L7.029 239.029c-9.373 9.373-9.373 24.569 0 33.941l86.059 86.059c15.119 15.119 40.971 4.411 40.971-16.971V296z"></path></svg>
                    <span class="ml-2 text-xs font-semibold">Back</span>
                </a>
            </div>
        </div>

        <div class="w-full max-w-8xl mx-auto bg-white shadow-xl rounded-xl p-8 mt-8">
            <h2 class="text-2xl font-semibold text-gray-800 border-b pb-4 mb-6 text-center">Student & Parent Information</h2>

            <div class="flex flex-wrap md:flex-nowrap items-center relative">
                <!-- Coluna Esquerda: Informações do Estudante -->
                <div class="w-full md:w-1/2 pr-6">
                    <h3 class="text-xl font-semibold text-gray-700 mb-4">Personal Details</h3>
                    <div class="space-y-3 text-lg">
                        <p class="text-gray-600"><strong>Name:</strong> {{ $student->user->name }}</p>
                        <p class="text-gray-600"><strong>Email:</strong> {{ $student->user->email }}</p>
                        <p class="text-gray-600"><strong>Class:</strong> {{ $student->class->class_name }}</p>
                        <p class="text-gray-600"><strong>Roll Number:</strong> {{ $student->roll_number }}</p>
                        <p class="text-gray-600"><strong>Phone:</strong> {{ $student->phone }}</p>
                        <p class="text-gray-600"><strong>Gender:</strong> {{ $student->gender }}</p>
                        <p class="text-gray-600"><strong>Date of Birth:</strong> {{ $student->dateofbirth }}</p>
                        <p class="text-gray-600"><strong>Current Address:</strong> {{ $student->current_address }}</p>
                        <p class="text-gray-600"><strong>Permanent Address:</strong> {{ $student->permanent_address }}</p>
                    </div>
                </div>

                <!-- Imagem do Estudante Centralizada -->
                <div class="w-full md:w-auto flex justify-center items-center relative">
                    <div class="w-40 h-40 rounded-full border-4 border-gray-300 bg-white p-1 shadow-md absolute top-1/2 transform -translate-y-1/2">
                        <img class="w-full h-full rounded-full" 
                            src="{{ asset('images/profile/' .$student->user->profile_picture) }}" 
                            alt="Student Avatar">
                    </div>
                </div>

                <!-- Coluna Direita: Informações do Parente -->
                <div class="w-full md:w-1/2 pl-6" style="text-align: right">
                    <h3 class="text-xl font-semibold text-gray-700 mb-4">Parent/Guardian Details</h3>
                    <div class="space-y-3 text-lg">
                        <p class="text-gray-600"><strong>Name:</strong> {{ $student->parent->user->name }}</p>
                        <p class="text-gray-600"><strong>Email:</strong> {{ $student->parent->user->email }}</p>
                        <p class="text-gray-600"><strong>Phone:</strong> {{ $student->parent->phone }}</p>
                        <p class="text-gray-600"><strong>Address:</strong> {{ $student->parent->current_address }}</p>
                    </div>
                </div>
            </div>
        </div>

        <div class="mt-8 bg-white rounded-lg shadow-lg p-6">
            <div class="w-full sm:w-2/2 mr-2 mb-6">
                <div class="bg-gray-600 text-white rounded-t-lg p-4">
                    <div class="flex justify-between items-center font-bold">
                        <div class="w-1/3 ">Code</div>
                        <div class="w-1/3 text-center">Subject</div>
                        <div class="w-1/3 text-right">Teacher</div>
                    </div>
                </div>
                <div class="bg-gray-100 rounded-b-lg">
                    @foreach ($class->subjects as $subject)
                        <div class="flex justify-between items-center border-b border-gray-200 p-4">
                            <div class="w-1/3 text-gray-800">{{ $subject->subject_code }}</div>
                            <div class="w-1/3 text-center text-gray-800">{{ $subject->name }}</div>
                            <div class="w-1/3 text-right text-gray-800">{{ $subject->teacher->user->name }}</div>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>

        <div class="mt-8 bg-white rounded-lg shadow-lg p-6">
            <h2 class="text-2xl font-semibold text-gray-800 text-center pb-4 mb-6">Fees of student "{{$student->user->name}}"</h2>
            <div class="mt-8 bg-white rounded border-b-4 border-gray-300">
                <!-- Cabeçalho da Tabela -->
                <div class="flex flex-wrap items-center uppercase text-sm font-semibold bg-gray-600 text-white rounded-tl rounded-tr">
                    <div class="w-2/12 px-4 py-3">Amount Due</div>
                    <div class="w-2/12 px-4 py-3">Amount Paid</div>
                    <div class="w-2/12 px-4 py-3">Penalty Fee</div>
                    <div class="w-2/12 px-4 py-3">Month</div>
                    <div class="w-2/12 px-4 py-3">Status</div>
                    <div class="w-2/12 px-4 py-3"></div>
                </div>

                @foreach ($fees as $fee)
                    <div class="flex flex-wrap items-center text-gray-700 border-t-2 border-gray-300">
                        <!-- Valor a pagar -->
                        <div class="w-2/12 px-4 py-3 text-sm font-semibold text-gray-600">
                            {{ number_format($fee->amount_due, 2) }} MZN
                        </div>
                        <div class="w-2/12 px-4 py-3 text-sm font-semibold text-gray-600">
                            {{ number_format($fee->amount_paid, 2) }} MZN
                        </div>
                        <div class="w-2/12 px-4 py-3 text-sm font-semibold text-gray-600">
                            {{ number_format($fee->penalty_fee, 2) }} MZN
                        </div>
                        <div class="w-2/12 px-4 py-3 text-sm font-semibold text-gray-600">
                            {{ date('F-Y', strtotime($fee->due_date)) }}
                        </div>
                        <div class="w-2/12 px-4 py-3 text-sm font-semibold">
                            @if($fee->status === 'Pago')
                                <span class="bg-green-200 text-sm px-2 border rounded-full">Pago</span>
                            @else
                                <span class="bg-red-200 text-sm px-2 border rounded-full">Pendente</span>
                            @endif
                        </div>
                        <div class="w-2/12 px-4 py-3 flex items-center justify-end">
                            @if($fee->status !== 'Pago')
                                <button onclick="openModal('{{ $fee->id }}', '{{ $fee->student_id }}', '{{ number_format($fee->amount_due, 2) }}')" style="background-color: rgb(79, 79, 177); color: white; border-radius: 0.2rem; padding: 6px 12px; display: flex; align-items: center; gap: 5px;">
                                    <svg class="h-5 w-5 fill-current" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 576 512">
                                        <path fill="currentColor"
                                            d="M527.9 112H48c-26.5 0-48 21.5-48 48v192c0 26.5 21.5 48 48 48h479.9c26.5 0 48-21.5 48-48V160c0-26.5-21.5-48-48-48zM288 352c-17.7 0-32-14.3-32-32 0-17.7 14.3-32 32-32s32 14.3 32 32c0 17.7-14.3 32-32 32zm208-96c0 8.8-7.2 16-16 16H96c-8.8 0-16-7.2-16-16V192c0-8.8 7.2-16 16-16h384c8.8 0 16 7.2 16 16v64z"/>
                                    </svg>
                                    Pagar
                                </button>
                            @else
                                <span class="text-gray-500"></span>
                            @endif
                        </div>
                    </div>

                    {{--?Start with the model payment--}}
                    <div id="paymentModal" class="modal-bg hidden fixed top-0 left-0 right-0 bottom-0 w-full h-full overflow-auto z-50 flex items-center justify-center">
                        <div class="bg-white relative p-10 max-w-lg w-full mx-4 sm:mx-auto my-10 sm:my-32 shadow-lg rounded-lg">
                            <div onclick="closeModal()" class="absolute top-0 right-0 m-3 text-red-600 cursor-pointer">
                                <svg class="w-6 h-6 stroke-current" aria-hidden="true" focusable="false" data-prefix="far" data-icon="times-circle" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512">
                                    <path fill="currentColor" d="M256 8C119 8 8 119 8 256s111 248 248 248 248-111 248-248S393 8 256 8zm0 448c-110.5 0-200-89.5-200-200S145.5 56 256 56s200 89.5 200 200-89.5 200-200 200zm101.8-262.2L295.6 256l62.2 62.2c4.7 4.7 4.7 12.3 0 17l-22.6 22.6c-4.7 4.7-12.3 4.7-17 0L256 295.6l-62.2 62.2c-4.7 4.7-12.3 4.7-17 0l-22.6-22.6c-4.7-4.7-4.7-12.3 0-17l62.2-62.2-62.2-62.2c-4.7-4.7-4.7-12.3 0-17l22.6-22.6c4.7-4.7 12.3-4.7 17 0l62.2 62.2 62.2-62.2c4.7-4.7 12.3-4.7 17 0l22.6 22.6c4.7 4.7 4.7 12.3 0 17z"></path>
                                </svg>
                            </div>

                            <h2 class="text-xl font-semibold text-gray-800 mb-6 text-center">Payment</h2>
                            <form action="{{route('payments.store')}}" method="POST">
                                @csrf
                                <div class="mt-6">
                                    <input type="hidden" name="student_id" value="{{ $fee->student_id }}">
                                    <input type="hidden" name="fee_id" value="{{ $fee->id }}">
                                    <label class="block text-gray-500 font-bold mb-1">
                                        Payment Method
                                    </label>
                                    <select name="payment_method" class="block font-bold appearance-none w-full bg-gray-200 border border-gray-200 text-gray-600 py-3 px-4 pr-8 rounded leading-tight focus:outline-none focus:bg-white focus:border-gray-500">
                                        <option value="">Selecione o Tipo de Pagamento</option>
                                        <option value="mpesa">Mpesa</option>
                                        <option value="emola">Emola</option>
                                        <option value="bank">Bank</option>
                                        <option value="cash">Cash</option>
                                    </select>
                                </div>
                                <div class="mt-6">
                                    <label class="block text-gray-500 font-bold mb-1">Amount</label>
                                    <input name="amount" class="bg-gray-200 appearance-none border-2 border-gray-200 rounded w-full py-2 px-4 text-gray-700 leading-tight focus:outline-none focus:bg-white focus:border-blue-500" type="text">
                                </div>
                                <div class="mt-6">
                                    <label class="block text-gray-500 font-bold mb-1">Transaction Reference</label>
                                    <input name="transaction_reference" class="bg-gray-200 appearance-none border-2 border-gray-200 rounded w-full py-2 px-4 text-gray-700 leading-tight focus:outline-none focus:bg-white focus:border-blue-500" type="text">
                                </div>

                                <div class="flex justify-end" style="margin-top: 1rem">
                                    <button type="button" onclick="closeModal()" class="bg-gray-500 text-white px-4 py-2 rounded mr-2">Cancelar</button>
                                    <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded">Confirmar Pagamento</button>
                                </div>
                            </form>
                        </div>
                    </div>

                @endforeach 
            </div>
            {{--*Start with the accountant section--}}
            <div style="margin-top:1rem" class="bg-gray-100 p-4 rounded-lg text-gray-800 font-semibold">
                <div class="flex justify-between">
                    <span class="text-lg">Total Amount Due:</span>
                    <span class="text-lg">{{ number_format($fees->sum('amount_due'), 2) }} MZN</span>
                </div>
            </div>
            {{--*End of the accountant section--}}
        </div>


        </div>
    </div>
    <script>
        function openModal(feeId, studentId, amount) {
            document.getElementById('paymentModal').classList.remove('hidden');
            document.getElementById('fee_id').value = feeId;
            document.getElementById('student_id').value = studentId;
            document.getElementById('amount').value = amount + ' MZN';
        }

        function closeModal() {
            document.getElementById('paymentModal').classList.add('hidden');
        }
    </script>
@endsection
