@extends('layouts.app')

@section('content')
    <div class="roles">

        <div class="mt-8 bg-white rounded-lg shadow-lg p-6">
            <h1 class="text-2xl font-bold text-gray-800">Fees of student "{{ Auth::user()->name }}"</h1>
            <div class="mt-8 bg-white rounded border-b-4 border-gray-300">
                <!-- Cabeçalho da Tabela -->
                <div
                    class="flex flex-wrap items-center uppercase text-sm font-semibold bg-gray-600 text-white rounded-tl rounded-tr">
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
                            @if ($fee->status === 'Pago')
                                <span class="bg-green-200 text-sm px-2 border rounded-full">Pago</span>
                            @else
                                <span class="bg-red-200 text-sm px-2 border rounded-full">Pendente</span>
                            @endif
                        </div>
                        <div class="w-2/12 px-4 py-3 flex items-center justify-end">
                            @if ($fee->status !== 'Pago')
                                <button onclick="openModal()" style="background-color: rgb(80, 80, 152); color: white; border-radius: 0.2rem; padding: 6px 12px; display: flex; align-items: center; gap: 5px;">
                                    <svg class="h-5 w-5 fill-current" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 576 512">
                                        <path fill="currentColor"
                                            d="M527.9 112H48c-26.5 0-48 21.5-48 48v192c0 26.5 21.5 48 48 48h479.9c26.5 0 48-21.5 48-48V160c0-26.5-21.5-48-48-48zM288 352c-17.7 0-32-14.3-32-32 0-17.7 14.3-32 32-32s32 14.3 32 32c0 17.7-14.3 32-32 32zm208-96c0 8.8-7.2 16-16 16H96c-8.8 0-16-7.2-16-16V192c0-8.8 7.2-16 16-16h384c8.8 0 16 7.2 16 16v64z"/>
                                    </svg>
                                    Pagar
                                </button>
                            @else
                                <span class="text-gray-500">-</span>
                            @endif
                        </div>
                            <!-- Modal de Pagamento -->
                        <!-- Modal de Pagamento (Tamanho Aumentado) -->
                        <div id="paymentModal" class="modal-bg hidden fixed top-0 left-0 right-0 bottom-0 w-full h-full overflow-auto z-50 flex items-center justify-center">
                            <div class="bg-white relative p-10 max-w-lg w-full mx-4 sm:mx-auto my-10 sm:my-32 shadow-lg rounded-lg">
                                <div onclick="closeModal()" class="absolute top-0 right-0 m-3 text-red-600 cursor-pointer">
                                    <svg class="w-6 h-6 stroke-current" aria-hidden="true" focusable="false" data-prefix="far" data-icon="times-circle" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512">
                                        <path fill="currentColor" d="M256 8C119 8 8 119 8 256s111 248 248 248 248-111 248-248S393 8 256 8zm0 448c-110.5 0-200-89.5-200-200S145.5 56 256 56s200 89.5 200 200-89.5 200-200 200zm101.8-262.2L295.6 256l62.2 62.2c4.7 4.7 4.7 12.3 0 17l-22.6 22.6c-4.7 4.7-12.3 4.7-17 0L256 295.6l-62.2 62.2c-4.7 4.7-12.3 4.7-17 0l-22.6-22.6c-4.7-4.7-4.7-12.3 0-17l62.2-62.2-62.2-62.2c-4.7-4.7-4.7-12.3 0-17l22.6-22.6c4.7-4.7 12.3-4.7 17 0l62.2 62.2 62.2-62.2c4.7-4.7 12.3-4.7 17 0l22.6 22.6c4.7 4.7 4.7 12.3 0 17z"></path>
                                    </svg>
                                </div>

                                <h2 class="text-xl font-semibold text-gray-800 mb-6 text-center">Escolha a forma de pagamento</h2>

                                <div class="flex justify-center gap-6">
                                    <!-- Botão Mpesa -->
                                    <a class="bg-green-600 text-white p-3 rounded-lg flex items-center gap-3 w-full justify-center">
                                        <img src="{{ asset('images/mpesalogo.svg') }}" alt="Mpesa" class="w-15 h-12">
                                    </a>
                                </div>

                                <div class="mt-6">
                                    <label class="block text-gray-500 font-bold mb-1">Valor</label>
                                    <input name="amount" class="bg-gray-200 appearance-none border-2 border-gray-200 rounded w-full py-2 px-4 text-gray-700 leading-tight focus:outline-none focus:bg-white focus:border-blue-500" type="text">
                                </div>

                                <div class="mt-6 text-right">
                                    <button onclick="closeModal()" class="text-gray-600 hover:text-red-600">Fechar</button>
                                </div>
                            </div>
                        </div>

                    </div>
                @endforeach
            </div>
            {{-- *Start with the accountant section --}}
            <div style="margin-top:1rem" class="bg-gray-100 p-4 rounded-lg text-gray-800 font-semibold">
                <div class="flex justify-between">
                    <span class="text-lg">Total Amount Due:</span>
                    <span class="text-lg">{{ number_format($fees->sum('amount_due'), 2) }} MZN</span>
                </div>
            </div>
            {{-- *End of the accountant section --}}
        </div>
    </div>

    <!-- Script para abrir/fechar o modal -->
    <script>
        function openModal() {
            document.getElementById("paymentModal").classList.remove("hidden");
        }
        function closeModal() {
            document.getElementById("paymentModal").classList.add("hidden");
        }
    </script>
@endsection
