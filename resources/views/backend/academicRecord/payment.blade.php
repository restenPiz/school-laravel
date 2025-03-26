@extends('layouts.app')

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
                <div class="relative w-60" style="margin-left:1rem">
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
            <!-- Cabeçalho da Tabela -->
            <div
                class="flex flex-wrap items-center uppercase text-sm font-semibold bg-gray-300 text-gray-700 rounded-tl rounded-tr">
                <div class="w-2/12 px-4 py-3">Course</div>
                <div class="w-2/12 px-4 py-3">Student Name</div>
                <div class="w-2/12 px-4 py-3">Payment Method</div>
                <div class="w-2/12 px-4 py-3">Amount Paid</div>
                <div class="w-2/12 px-4 py-3">Month Paid</div>
                <div class="w-2/12 px-4 py-3">Year</div>
                <div class="w-2/12 px-4 py-3"></div>
            </div>

            @foreach ($payments as $payment)
                <div class="flex flex-wrap items-center text-gray-700 border-t-2 border-gray-300">
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
@endsection
