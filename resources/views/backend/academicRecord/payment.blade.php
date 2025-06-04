{{-- @extends('layouts.app')

@section('content')
    <div class="roles">
        <div class="flex items-center justify-between mb-8">
            <h2 class="text-gray-700 uppercase font-bold">Payment Record Report</h2>
        </div>

        <!-- Formulário -->
        <div class="w-full mt-8  rounded ">
            <form action="{{ route('payments.filter') }}" method="GET" class="flex flex-wrap items-center gap-4">
                @csrf
                <!-- Select de Curso -->
                <div class="relative w-80" style=" width: 18rem;">
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
                <div class="relative w-80" style="margin-left:1rem; width: 18rem;">
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

                <!-- Select de Método de Pagamento -->
                <div class="relative w-60" style="margin-left:1rem">
                    <select name="payment_method"
                        class="block appearance-none w-full bg-gray-200 border border-gray-300 text-gray-700 py-3 px-4 pr-8 rounded leading-tight focus:outline-none focus:bg-white focus:border-gray-500">
                        <option value="">-- Payment Method --</option>
                        <option value="mpesa">Mpesa</option>
                        <option value="emola">Emola</option>
                        <option value="bank">Bank</option>
                        <option value="cash">Cash</option>
                    </select>
                    <div class="absolute inset-y-0 right-0 flex items-center px-2 text-gray-700">
                        <svg class="fill-current h-4 w-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20">
                            <path d="M9.293 12.95l.707.707L15.657 8l-1.414-1.414L10 10.828 5.757 6.586 4.343 8z" />
                        </svg>
                    </div>
                </div>

                <!-- Select de Ano -->
                <div class="relative w-60" style="margin-left:1rem; width: 13rem;">
                    <select name="year"
                        class="block appearance-none w-full bg-gray-200 border border-gray-300 text-gray-700 py-3 px-4 pr-8 rounded leading-tight focus:outline-none focus:bg-white focus:border-gray-500">
                        <option value="">-- Select Year --</option>
                        @for ($year = 2020; $year <= date('Y'); $year++)
                            <option value="{{ $year }}">{{ $year }}</option>
                        @endfor
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
        <div class="mt-8 bg-white rounded border-b-4 border-gray-300">
            <div class="flex flex-wrap items-center uppercase text-sm font-semibold bg-gray-300 text-gray-700 rounded-tl rounded-tr">
                <div class="w-2/12 px-4 py-3">Course</div>
                <div class="w-2/12 px-4 py-3">Student Name</div>
                <div class="w-2/12 px-4 py-3">Payment Method</div>
                <div class="w-2/12 px-4 py-3">Amount Paid</div>
                <div class="w-2/12 px-4 py-3">Month Paid</div>
                <div class="w-2/12 px-4 py-3">Year</div>
                <div class="w-2/12 px-4 py-3"></div>
            </div>

            @foreach ($payments as $payment)
                <div class="flex flex-wrap items-center text-gray-700 border-t-2 border-l-4 border-r-4 border-gray-300">
                    <!-- Valor a pagar -->
                    <div class="w-2/12 px-4 py-3 text-sm font-semibold text-gray-600">
                        {{ $payment->fee->class->class_name }}
                    </div>
                    <div class="w-2/12 px-4 py-3 text-sm font-semibold text-gray-600">
                        {{ $payment->student->user->name }}
                    </div>
                    <div class="w-2/12 px-4 py-3 text-sm font-semibold text-gray-600">
                        @if ($payment->payment_method == 'mpesa')
                        <span style="color:white" class="bg-red-600 text-sm px-2 border rounded-full">
                            {{ $payment->payment_method }}
                        </span>
                        @elseif($payment->payment_method == 'emola')
                        <span style="color:white" class="bg-orange-600 text-sm px-2 border rounded-full">
                            {{ $payment->payment_method }}
                        </span>
                        @elseif($payment->payment_method == 'bank')
                        <span style="color:white" class="bg-blue-600 text-sm px-2 border rounded-full">
                            {{ $payment->payment_method }}
                        </span>
                        @elseif($payment->payment_method == 'cash')
                        <span style="color:white" class="bg-gray-600 text-sm px-2 border rounded-full">
                            {{ $payment->payment_method }}
                        </span>
                        @endif
                    </div>
                    <div class="w-2/12 px-4 py-3 text-sm font-semibold text-gray-600">
                        {{ number_format($payment->amount, 2) }} MZN
                    </div>
                    <div class="w-2/12 px-4 py-3 text-sm font-semibold text-gray-600">
                        {{ date('F', strtotime($payment->fee->due_date)) }}
                    </div>
                    <div class="w-2/12 px-4 py-3 text-sm font-semibold text-gray-600">
                        {{ date('Y', strtotime($payment->fee->due_date)) }}
                    </div>
                </div>
            @endforeach
        </div>

                <div style="margin-top:1rem" class="bg-white p-4 rounded-lg text-gray-800 font-semibold">
                <div class="flex justify-between">
                    <span class="text-lg">Total Amount Paid:</span>
                    <span class="text-lg">{{ number_format($payments->sum('amount'), 2) }} MZN</span>
                </div>
            </div>
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
        document.addEventListener("DOMContentLoaded", function() {
            let form = document.querySelector("form");
            let tableContainer = document.querySelector(".mt-8.bg-white.rounded.border-b-4");

            form.addEventListener("submit", function(event) {
                event.preventDefault(); // Impede o recarregamento da página

                let formData = new FormData(form);
                let queryParams = new URLSearchParams(formData).toString();

                fetch(`/payments/filter?${queryParams}`)
                    .then(response => response.json())
                    .then(data => {
                        let payments = data.payments;
                        let tableContent = `
                            <div class="flex flex-wrap items-center uppercase text-sm font-semibold bg-gray-300 text-gray-700 rounded-tl rounded-tr">
                                <div class="w-2/12 px-4 py-3">Course</div>
                                <div class="w-2/12 px-4 py-3">Student Name</div>
                                <div class="w-2/12 px-4 py-3">Payment Method</div>
                                <div class="w-2/12 px-4 py-3">Amount</div>
                                <div class="w-2/12 px-4 py-3">Month Paid</div>
                                <div class="w-2/12 px-4 py-3">Year</div>
                            </div>`;

                        payments.forEach(payment => {
                            tableContent += `
                                <div class="flex flex-wrap items-center text-gray-700 border-t-2 border-gray-300">
                                    <div class="w-2/12 px-4 py-3 text-sm font-semibold text-gray-600">
                                        ${payment.fee.class.class_name}
                                    </div>
                                    <div class="w-2/12 px-4 py-3 text-sm font-semibold text-gray-600">
                                        ${payment.student.user.name}
                                    </div>
                                    <div class="w-2/12 px-4 py-3 text-sm font-semibold text-gray-600">
                                        <span style="color:white" class="bg-${getPaymentColor(payment.payment_method)} text-sm px-2 border rounded-full">
                                            ${payment.payment_method}
                                        </span>
                                    </div>
                                    <div class="w-2/12 px-4 py-3 text-sm font-semibold text-gray-600">
                                        ${Number(payment.amount).toFixed(2)} MZN
                                    </div>
                                    <div class="w-2/12 px-4 py-3 text-sm font-semibold text-gray-600">
                                        ${new Date(payment.fee.due_date).toLocaleString('en-us', { month: 'long' })}
                                    </div>
                                    <div class="w-2/12 px-4 py-3 text-sm font-semibold text-gray-600">
                                        ${new Date(payment.fee.due_date).getFullYear()}
                                    </div>
                                </div>`;
                        });

                        tableContainer.innerHTML = tableContent;
                    })
                    .catch(error => console.error("Erro ao carregar os pagamentos:", error));
            });

            function getPaymentColor(method) {
                switch (method) {
                    case "mpesa": return "red-600";
                    case "emola": return "orange-600";
                    case "bank": return "blue-600";
                    case "cash": return "gray-600";
                    default: return "gray-500";
                }
            }
        });

    </script>
@endsection --}}
@extends('layouts.app')

@section('content')
    <div class="roles">
        <div class="flex items-center justify-between mb-8">
            <h2 class="text-gray-700 uppercase font-bold">Payment Record Report</h2>
        </div>

        <!-- Enhanced Filter Section -->
        <div class="bg-white rounded border-b-4 border-gray-300 mb-6">
            {{-- <div class="px-4 py-3 bg-gray-100 rounded-t">
                <h3 class="text-sm font-semibold text-gray-700 uppercase">Filter Payment Records</h3>
            </div> --}}
            <div class="px-4 py-4">
                <form action="{{ route('payments.filter') }}" method="GET" class="flex flex-wrap gap-4 items-end">
                    @csrf

                    <!-- Course Selection -->
                    <div class="flex-1 min-w-64">
                        <label for="class_id" class="block text-xs font-medium text-gray-700 mb-1">Course</label>
                        <div class="relative">
                            <select id="class-select" name="class_id"
                                class="w-full px-3 py-2 text-sm border border-gray-300 rounded focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent">
                                <option value="">-- Select Course --</option>
                                @foreach ($classes as $class)
                                    <option value="{{ $class->id }}" {{ request('class_id') == $class->id ? 'selected' : '' }}>
                                        {{ $class->class_name }}
                                    </option>
                                @endforeach
                            </select>
                            <div class="absolute inset-y-0 right-0 flex items-center px-2 text-gray-700 pointer-events-none">
                                <svg class="fill-current h-4 w-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20">
                                    <path d="M9.293 12.95l.707.707L15.657 8l-1.414-1.414L10 10.828 5.757 6.586 4.343 8z" />
                                </svg>
                            </div>
                        </div>
                    </div>

                    <!-- Student Selection -->
                    <div class="flex-1 min-w-64">
                        <label for="student_id" class="block text-xs font-medium text-gray-700 mb-1">Student</label>
                        <div class="relative">
                            <select id="student-select" name="student_id"
                                class="w-full px-3 py-2 text-sm border border-gray-300 rounded focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent"
                                {{ !request('class_id') ? 'disabled' : '' }}>
                                <option value="">-- Select Student --</option>
                                @if(request('student_id') && isset($selectedStudent))
                                    <option value="{{ request('student_id') }}" selected>{{ $selectedStudent->user->name }}</option>
                                @endif
                            </select>
                            <div class="absolute inset-y-0 right-0 flex items-center px-2 text-gray-700 pointer-events-none">
                                <svg class="fill-current h-4 w-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20">
                                    <path d="M9.293 12.95l.707.707L15.657 8l-1.414-1.414L10 10.828 5.757 6.586 4.343 8z" />
                                </svg>
                            </div>
                        </div>
                    </div>

                    <!-- Payment Method -->
                    <div class="flex-1 min-w-48">
                        <label for="payment_method" class="block text-xs font-medium text-gray-700 mb-1">Payment Method</label>
                        <div class="relative">
                            <select name="payment_method"
                                class="w-full px-3 py-2 text-sm border border-gray-300 rounded focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent">
                                <option value="">-- Payment Method --</option>
                                <option value="mpesa" {{ request('payment_method') == 'mpesa' ? 'selected' : '' }}>Mpesa</option>
                                <option value="emola" {{ request('payment_method') == 'emola' ? 'selected' : '' }}>Emola</option>
                                <option value="bank" {{ request('payment_method') == 'bank' ? 'selected' : '' }}>Bank</option>
                                <option value="cash" {{ request('payment_method') == 'cash' ? 'selected' : '' }}>Cash</option>
                            </select>
                            <div class="absolute inset-y-0 right-0 flex items-center px-2 text-gray-700 pointer-events-none">
                                <svg class="fill-current h-4 w-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20">
                                    <path d="M9.293 12.95l.707.707L15.657 8l-1.414-1.414L10 10.828 5.757 6.586 4.343 8z" />
                                </svg>
                            </div>
                        </div>
                    </div>

                    <!-- Year Selection -->
                    <div class="flex-1 min-w-40">
                        <label for="year" class="block text-xs font-medium text-gray-700 mb-1">Year</label>
                        <div class="relative">
                            <select name="year"
                                class="w-full px-3 py-2 text-sm border border-gray-300 rounded focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent">
                                <option value="">-- Select Year --</option>
                                @for ($year = 2020; $year <= date('Y'); $year++)
                                    <option value="{{ $year }}" {{ request('year') == $year ? 'selected' : '' }}>{{ $year }}</option>
                                @endfor
                            </select>
                            <div class="absolute inset-y-0 right-0 flex items-center px-2 text-gray-700 pointer-events-none">
                                <svg class="fill-current h-4 w-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20">
                                    <path d="M9.293 12.95l.707.707L15.657 8l-1.414-1.414L10 10.828 5.757 6.586 4.343 8z" />
                                </svg>
                            </div>
                        </div>
                    </div>

                    <!-- Month Selection (New Addition) -->
                    <div class="flex-1 min-w-40">
                        <label for="month" class="block text-xs font-medium text-gray-700 mb-1">Month</label>
                        <div class="relative">
                            <select name="month"
                                class="w-full px-3 py-2 text-sm border border-gray-300 rounded focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent">
                                <option value="">-- Select Month --</option>
                                @for ($month = 1; $month <= 12; $month++)
                                    <option value="{{ $month }}" {{ request('month') == $month ? 'selected' : '' }}>
                                        {{ date('F', mktime(0, 0, 0, $month, 1)) }}
                                    </option>
                                @endfor
                            </select>
                            <div class="absolute inset-y-0 right-0 flex items-center px-2 text-gray-700 pointer-events-none">
                                <svg class="fill-current h-4 w-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20">
                                    <path d="M9.293 12.95l.707.707L15.657 8l-1.414-1.414L10 10.828 5.757 6.586 4.343 8z" />
                                </svg>
                            </div>
                        </div>
                    </div>

                    <!-- Action Buttons -->
                    <div class="flex gap-2">
                        <button type="submit" name="submit"
                            class="bg-blue-500 hover:bg-blue-600 text-white px-4 py-2 text-sm rounded transition-colors">
                            <svg class="w-4 h-4 inline mr-1" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd" d="M8 4a4 4 0 100 8 4 4 0 000-8zM2 8a6 6 0 1110.89 3.476l4.817 4.817a1 1 0 01-1.414 1.414l-4.816-4.816A6 6 0 012 8z" clip-rule="evenodd"></path>
                            </svg>
                            Generate
                        </button>
                        <a href="{{ route('payments.filter') }}" class="bg-gray-500 hover:bg-gray-600 text-white px-4 py-2 text-sm rounded transition-colors">
                            <svg class="w-4 h-4 inline mr-1" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd" d="M4 2a1 1 0 011 1v2.101a7.002 7.002 0 0111.601 2.566 1 1 0 11-1.885.666A5.002 5.002 0 005.999 7H9a1 1 0 010 2H4a1 1 0 01-1-1V3a1 1 0 011-1zm.008 9.057a1 1 0 011.276.61A5.002 5.002 0 0014.001 13H11a1 1 0 110-2h5a1 1 0 011 1v5a1 1 0 11-2 0v-2.101a7.002 7.002 0 01-11.601-2.566 1 1 0 01.61-1.276z" clip-rule="evenodd"></path>
                            </svg>
                            Clear
                        </a>
                        <!-- Export Button (Optional) -->
                        <button type="button" onclick="exportToCSV()" class="bg-green-500 hover:bg-green-600 text-white px-4 py-2 text-sm rounded transition-colors">
                            <svg class="w-4 h-4 inline mr-1" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd" d="M3 17a1 1 0 011-1h12a1 1 0 110 2H4a1 1 0 01-1-1zm3.293-7.707a1 1 0 011.414 0L9 10.586V3a1 1 0 112 0v7.586l1.293-1.293a1 1 0 111.414 1.414l-3 3a1 1 0 01-1.414 0l-3-3a1 1 0 010-1.414z" clip-rule="evenodd"></path>
                            </svg>
                            Export
                        </button>
                    </div>
                </form>
            </div>
        </div>

        <!-- Results Info -->
        @if(request()->hasAny(['class_id', 'student_id', 'payment_method', 'year', 'month']))
            <div class="mb-4">
                <div class="bg-blue-50 border border-blue-200 rounded px-4 py-3">
                    <div class="flex items-center justify-between">
                        <div class="text-sm text-blue-700">
                            <span class="font-semibold">{{ count($payments) }}</span> payment record(s) found
                            @if(request('class_id'))
                                for "<strong>{{ $classes->find(request('class_id'))->class_name ?? 'Unknown Course' }}</strong>"
                            @endif
                            @if(request('student_id'))
                                - Student: "<strong>{{ $selectedStudent->user->name ?? 'Unknown' }}</strong>"
                            @endif
                            @if(request('payment_method'))
                                - Method: "<strong>{{ ucfirst(request('payment_method')) }}</strong>"
                            @endif
                            @if(request('year'))
                                - Year: "<strong>{{ request('year') }}</strong>"
                            @endif
                            @if(request('month'))
                                - Month: "<strong>{{ date('F', mktime(0, 0, 0, request('month'), 1)) }}</strong>"
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        @endif

        <!-- Payment Records Table -->
        <div class="mt-8 bg-white rounded border-b-4 border-gray-300">
            <div class="flex flex-wrap items-center uppercase text-sm font-semibold bg-gray-300 text-gray-700 rounded-tl rounded-tr">
                <div class="w-2/12 px-4 py-3">Course</div>
                <div class="w-2/12 px-4 py-3">Student Name</div>
                <div class="w-2/12 px-4 py-3">Payment Method</div>
                <div class="w-2/12 px-4 py-3">Amount Paid</div>
                <div class="w-2/12 px-4 py-3">Month Paid</div>
                <div class="w-2/12 px-4 py-3">Year</div>
            </div>

            @forelse ($payments as $payment)
                <div class="flex flex-wrap items-center text-gray-700 border-t-2 border-l-4 border-r-4 border-gray-300">
                    <div class="w-2/12 px-4 py-3 text-sm font-semibold text-gray-600">
                        {{ $payment->fee->class->class_name }}
                    </div>
                    <div class="w-2/12 px-4 py-3 text-sm font-semibold text-gray-600">
                        {{ $payment->student->user->name }}
                    </div>
                    <div class="w-2/12 px-4 py-3 text-sm font-semibold text-gray-600">
                        @if ($payment->payment_method == 'mpesa')
                            <span class="bg-red-600 text-white text-xs px-2 py-1 rounded-full">
                                {{ ucfirst($payment->payment_method) }}
                            </span>
                        @elseif($payment->payment_method == 'emola')
                            <span class="bg-orange-600 text-white text-xs px-2 py-1 rounded-full">
                                {{ ucfirst($payment->payment_method) }}
                            </span>
                        @elseif($payment->payment_method == 'bank')
                            <span class="bg-blue-600 text-white text-xs px-2 py-1 rounded-full">
                                {{ ucfirst($payment->payment_method) }}
                            </span>
                        @elseif($payment->payment_method == 'cash')
                            <span class="bg-gray-600 text-white text-xs px-2 py-1 rounded-full">
                                {{ ucfirst($payment->payment_method) }}
                            </span>
                        @endif
                    </div>
                    <div class="w-2/12 px-4 py-3 text-sm font-semibold text-gray-600">
                        {{ number_format($payment->amount, 2) }} MZN
                    </div>
                    <div class="w-2/12 px-4 py-3 text-sm font-semibold text-gray-600">
                        {{ date('F', strtotime($payment->fee->due_date)) }}
                    </div>
                    <div class="w-2/12 px-4 py-3 text-sm font-semibold text-gray-600">
                        {{ date('Y', strtotime($payment->fee->due_date)) }}
                    </div>
                </div>
            @empty
                <div class="text-center py-8 text-gray-500 border-t-2 border-l-4 border-r-4 border-gray-300">
                    <svg class="mx-auto h-12 w-12 text-gray-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path>
                    </svg>
                    <h3 class="mt-2 text-sm font-medium text-gray-900">No payment records found</h3>
                    <p class="mt-1 text-sm text-gray-500">Try adjusting your search filters to find payment records.</p>
                </div>
            @endforelse
        </div>

        <!-- Summary Section -->
        @if(count($payments) > 0)
            <div class="mt-4 bg-white p-4 rounded-lg border-l-4 border-green-500">
                <div class="flex justify-between items-center">
                    <div>
                        <span class="text-lg font-semibold text-gray-700">Total Amount Paid:</span>
                        <span class="text-sm text-gray-500 ml-2">({{ count($payments) }} records)</span>
                    </div>
                    <span class="text-xl font-bold text-green-600">{{ number_format(collect($payments)->sum('amount'), 2) }} MZN</span>
                </div>
            </div>
        @endif
    </div>

    <script>
        document.addEventListener("DOMContentLoaded", function() {
            let classSelect = document.getElementById("class-select");
            let studentSelect = document.getElementById("student-select");

            // Load students when class changes
            classSelect.addEventListener("change", function() {
                let classId = this.value;

                if (classId) {
                    studentSelect.disabled = true;
                    studentSelect.innerHTML = '<option value="">Loading...</option>';

                    fetch(`/get-students-by-class/${classId}`)
                        .then(response => response.json())
                        .then(data => {
                            studentSelect.innerHTML = '<option value="">-- Select Student --</option>';
                            data.students.forEach(student => {
                                studentSelect.innerHTML += `<option value="${student.id}">${student.name}</option>`;
                            });
                            studentSelect.disabled = false;
                        })
                        .catch(error => {
                            console.error("Error loading students:", error);
                            studentSelect.innerHTML = '<option value="">Error loading students</option>';
                        });
                } else {
                    studentSelect.innerHTML = '<option value="">-- Select Student --</option>';
                    studentSelect.disabled = true;
                }
            });

            // Preserve form values on page load
            if (document.getElementById("class-select").value) {
                document.getElementById("class-select").dispatchEvent(new Event('change'));
            }
        });

        // Export to CSV function
        function exportToCSV() {
            const table = document.querySelector('.mt-8.bg-white.rounded.border-b-4');
            const rows = table.querySelectorAll('.flex.flex-wrap.items-center');
            let csv = 'Course,Student Name,Payment Method,Amount Paid,Month Paid,Year\n';

            rows.forEach((row, index) => {
                if (index === 0) return; // Skip header
                const cells = row.querySelectorAll('.px-4.py-3');
                if (cells.length > 0) {
                    const rowData = Array.from(cells).slice(0, 6).map(cell => {
                        let text = cell.textContent.trim();
                        return `"${text.replace(/"/g, '""')}"`;
                    }).join(',');
                    csv += rowData + '\n';
                }
            });

            const blob = new Blob([csv], { type: 'text/csv' });
            const url = window.URL.createObjectURL(blob);
            const a = document.createElement('a');
            a.href = url;
            a.download = 'payment_records.csv';
            a.click();
            window.URL.revokeObjectURL(url);
        }
    </script>
@endsection
