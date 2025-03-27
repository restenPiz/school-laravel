@extends('layouts.app')

@section('content')
    <div class="roles">

        <div class="">
            <h1 class="text-2xl font-bold text-gray-800 text-center">Fees of student "{{ Auth::user()->name }}"</h1><br>
            <div class="flex flex-wrap gap-4">
                <select name="year" id="yearFilter" onchange="filterFees()" class="block font-bold appearance-none w-1/3 bg-gray-200 border border-gray-200 text-gray-600 py-3 px-4 pr-8 rounded leading-tight focus:outline-none focus:bg-white focus:border-gray-500">
                    <option value="">Select the year</option>
                    @foreach (range(2010, date('Y')) as $year)
                        <option value="{{ $year }}">{{ $year }}</option>
                    @endforeach
                </select>

                <button style="margin-left:45rem" onclick="printSelectedSections(['fee'])" class="bg-blue-800 text-white text-sm py-2 px-4 flex items-center rounded-lg hover:bg-gray-700 transition duration-300">
                    <svg class="w-4 h-4 fill-current" aria-hidden="true" focusable="false" data-prefix="fas" data-icon="print" role="img" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512">
                        <path fill="currentColor" d="M464 128h-16V64a64 64 0 0 0-64-64H128a64 64 0 0 0-64 64v64H48a48 48 0 0 0-48 48v160a48 48 0 0 0 48 48h16v96a32 32 0 0 0 32 32h320a32 32 0 0 0 32-32v-96h16a48 48 0 0 0 48-48V176a48 48 0 0 0-48-48zM128 64h256v64H128zm256 384H128v-80h256zm64-128H64V192h384zm-48-64a16 16 0 1 1-16-16 16 16 0 0 1 16 16z"></path>
                    </svg>
                    <span class="ml-2 text-xs font-semibold">Print</span>
                </button>
            </div>

               
            <div class="mt-8 bg-white rounded border-b-4 border-gray-300" id="fee">
                <!-- Cabeçalho da Tabela -->
                <div
                    class="flex flex-wrap items-center uppercase text-sm font-semibold bg-gray-300 text-gray-700 rounded-tl rounded-tr">
                    <div class="w-2/12 px-4 py-3">Amount Due</div>
                    <div class="w-2/12 px-4 py-3">Amount Paid</div>
                    <div class="w-2/12 px-4 py-3">Penalty Fee</div>
                    <div class="w-2/12 px-4 py-3">Month</div>
                    <div class="w-2/12 px-4 py-3">Status</div>
                    <div class="w-2/12 px-4 py-3"></div>
                </div>

                @foreach ($fees as $fee)
                    <div class="flex flex-wrap items-center text-gray-700 border border-b-4 border-l-4 border-r-4 border-gray-300">
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
                            @if($fee->status !== 'Pago')
                                <a onclick="openPaymentModal({{ $fee->id }})"
                                 class="bg-blue-800" href="#" type="button" data-bs-toggle="modal" data-bs-target="#paymentModal{{$fee->id}}"
                                    style="color: white; border-radius: 0.3rem; padding: 6px 12px; display: flex; align-items: center; gap: 5px;">
                                    <svg class="h-5 w-5 fill-current" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 576 512">
                                        <path fill="currentColor"
                                            d="M527.9 112H48c-26.5 0-48 21.5-48 48v192c0 26.5 21.5 48 48 48h479.9c26.5 0 48-21.5 48-48V160c0-26.5-21.5-48-48-48zM288 352c-17.7 0-32-14.3-32-32 0-17.7 14.3-32 32-32s32 14.3 32 32c0 17.7-14.3 32-32 32zm208-96c0 8.8-7.2 16-16 16H96c-8.8 0-16-7.2-16-16V192c0-8.8 7.2-16 16-16h384c8.8 0 16 7.2 16 16v64z"/>
                                    </svg>
                                    Pagar
                                </a>
                            @else
                                 <a style="border-radius: 0.3rem" href="#" 
                                    class="ml-1 bg-green-600 block p-2 text-white text-sm"
                                    onclick="openPaymentDetailsModal({{ $fee->id }})">
                                    <svg class="h-5 w-5 fill-current text-white" aria-hidden="true" focusable="false" data-prefix="far" data-icon="eye" class="svg-inline--fa fa-eye fa-w-18" role="img" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 576 512">
                                        <path fill="currentColor" d="M288 144a110.94 110.94 0 0 0-31.24 5 a55.4 55.4 0 0 1 7.24 27 56 56 0 0 1-56 56 55.4 55.4 0 0 1-27-7.24A111.71 111.71 0 1 0 288 144zm284.52 97.4C518.29 135.59 410.93 64 288 64S57.68 135.64 3.48 241.41a32.35 32.35 0 0 0 0 29.19C57.71 376.41 165.07 448 288 448s230.32-71.64 284.52-177.41a32.35 32.35 0 0 0 0-29.19zM288 400c-98.65 0-189.09-55-237.93-144C98.91 167 189.34 112 288 112s189.09 55 237.93 144C477.1 345 386.66 400 288 400z"></path>
                                    </svg>
                                </a>

                                {{--?Payment method modal--}}
                                <div id="paymentDetailsModal{{$fee->id}}" data-bs-keyboard="false"
                                    data-bs-backdrop="static" tabindex="-1" aria-labelledby="staticBackdropLabel"
                                    aria-hidden="true" class="modal-bg hidden fixed top-0 left-0 right-0 bottom-0 w-full h-full overflow-auto z-50 flex items-center justify-center">
                                    <div class="bg-white relative p-10 max-w-lg w-full mx-4 sm:mx-auto my-10 sm:my-32 rounded-lg">
                                        <div class="absolute top-0 right-0 m-3 text-red-600 cursor-pointer">
                                            <button onclick="closeModal('paymentDetailsModal{{$fee->id}}')">
                                                <svg class="w-6 h-6 stroke-current" aria-hidden="true" focusable="false" data-prefix="far" data-icon="times-circle" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512">
                                                    <path fill="currentColor" d="M256 8C119 8 8 119 8 256s111 248 248 248 248-111 248-248S393 8 256 8zm0 448c-110.5 0-200-89.5-200-200S145.5 56 256 56s200 89.5 200 200-89.5 200-200 200zm101.8-262.2L295.6 256l62.2 62.2c4.7 4.7 4.7 12.3 0 17l-22.6 22.6c-4.7 4.7-12.3 4.7-17 0L256 295.6l-62.2 62.2c-4.7 4.7-12.3 4.7-17 0l-22.6-22.6c-4.7-4.7-4.7-12.3 0-17l62.2-62.2-62.2-62.2c-4.7-4.7-4.7-12.3 0-17l22.6-22.6c4.7-4.7 12.3-4.7 17 0l62.2 62.2 62.2-62.2c4.7-4.7 12.3-4.7 17 0l22.6 22.6c4.7 4.7 4.7 12.3 0 17z"></path>
                                                </svg>
                                            </button>
                                        </div>

                                        <h2 class="text-xl font-semibold text-gray-800 mb-6 text-center">Detalhes do Pagamento</h2>
                                        <table class="table-auto w-full text-left">
                                            <tbody>
                                                <tr>
                                                    <th class="text-gray-500 font-bold">Estudante:</th>
                                                    <td>{{ $fee->student->user->name }}</td>
                                                </tr>
                                                <tr>
                                                    <th class="text-gray-500 font-bold">Valor Pago:</th>
                                                    <td>{{ number_format($fee->amount_paid, 2) }} MZN</td>
                                                </tr>
                                                <tr>
                                                    <th class="text-gray-500 font-bold">Data do Pagamento:</th>
                                                    <td>{{ $fee->updated_at->format('d/m/Y') }}</td>
                                                </tr>
                                                <tr>
                                                    <th class="text-gray-500 font-bold">Mes a Pagar:</th>
                                                    <td>{{ date('F', strtotime($fee->due_date)) }}</td>
                                                </tr>
                                                <tr>
                                                    <th class="text-gray-500 font-bold">Hora do Pagamento:</th>
                                                    <td>{{ $fee->updated_at->format('H:i') }}</td>
                                                </tr>
                                                <tr>
                                                    <th class="text-gray-500 font-bold">Método de Pagamento:</th>
                                                    <td>{{ $fee->payment->payment_method ?? 'Não especificado' }}</td>
                                                </tr>
                                                <tr>
                                                    <th class="text-gray-500 font-bold">Referência:</th>
                                                    <td>{{ $fee->payment->transaction_reference ?? 'N/A' }}</td>
                                                </tr>
                                            </tbody>
                                        </table>

                                        <div class="flex justify-end mt-6">
                                            <button onclick="closeModal('paymentDetailsModal{{$fee->id}}')" style="margin-right: 0.5rem" type="button" data-bs-dismiss="modal" class="bg-gray-500 text-white px-4 py-2 rounded">Fechar</button>
                                            <button onclick="printModal('paymentDetailsModal{{$fee->id}}')" class="bg-blue-800 text-white text-sm py-2 px-4 flex items-center rounded-lg hover:bg-gray-700 transition duration-300">
                                                <svg class="w-4 h-4 fill-current" aria-hidden="true" focusable="false" data-prefix="fas" data-icon="print" role="img" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512">
                                                    <path fill="currentColor" d="M464 128h-16V64a64 64 0 0 0-64-64H128a64 64 0 0 0-64 64v64H48a48 48 0 0 0-48 48v160a48 48 0 0 0 48 48h16v96a32 32 0 0 0 32 32h320a32 32 0 0 0 32-32v-96h16a48 48 0 0 0 48-48V176a48 48 0 0 0-48-48zM128 64h256v64H128zm256 384H128v-80h256zm64-128H64V192h384zm-48-64a16 16 0 1 1-16-16 16 16 0 0 1 16 16z"></path>
                                                </svg>
                                                <span class="ml-2 text-xs font-semibold">Print</span>
                                            </button>
                                        </div>
                                    </div>
                                </div>

                            @endif
                        </div>
                            <!-- Modal de Pagamento -->
                        {{--?Start with the model payment--}}
                        <div id="paymentModal{{$fee->id}}" data-bs-keyboard="false"
                                    data-bs-backdrop="static" tabindex="-1" aria-labelledby="staticBackdropLabel"
                                    aria-hidden="true" class="modal-bg hidden fixed top-0 left-0 right-0 bottom-0 w-full h-full overflow-auto z-50 flex items-center justify-center">
                            <div class="bg-white relative p-10 max-w-lg w-full mx-4 sm:mx-auto my-10 sm:my-32 shadow-lg rounded-lg">
                                <div onclick="closeModal('paymentModal{{$fee->id}}')" class="absolute top-0 right-0 m-3 text-red-600 cursor-pointer">
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
                                            <option value="mpesa" selected>Mpesa</option>
                                        </select>
                                    </div>
                                    <div class="mt-6">
                                        <label class="block text-gray-500 font-bold mb-1">Amount</label>
                                        <input type="text" id="amount" name="amount" class="bg-gray-200 appearance-none border-2 border-gray-200 rounded w-full py-2 px-4 text-gray-700 leading-tight focus:outline-none focus:bg-white focus:border-blue-500">
                                    </div>
                                    {{-- <div class="mt-6">
                                        <label class="block text-gray-500 font-bold mb-1">Transaction Reference</label>
                                        <input name="transaction_reference" class="bg-gray-200 appearance-none border-2 border-gray-200 rounded w-full py-2 px-4 text-gray-700 leading-tight focus:outline-none focus:bg-white focus:border-blue-500" type="text">
                                    </div> --}}

                                    <div class="flex justify-end" style="margin-top: 1rem">
                                        <button type="button" onclick="closeModal('paymentModal{{$fee->id}}')" class="bg-gray-500 text-white px-4 py-2 rounded mr-2">Cancelar</button>
                                        <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded">Confirmar Pagamento</button>
                                    </div>
                                </form>
                            </div>
                        </div>

                    </div>
                @endforeach
            </div>
            {{-- *Start with the accountant section --}}
            <div style="margin-top:1rem" class="bg-white p-4 rounded-lg text-gray-800 font-semibold">
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
        function openPaymentDetailsModal(feeId) {
            let modal = document.getElementById(`paymentDetailsModal${feeId}`);
            if (modal) {
                modal.classList.remove("hidden");
            } else {
                console.error(`Modal com ID paymentDetailsModal${feeId} não encontrado.`);
            }
        }

        function closeModal(modalId) {
            document.getElementById(modalId).classList.add("hidden");
        }

        function openPaymentModal(feeId) {
            let modal = document.getElementById(`paymentModal${feeId}`);
            if (modal) {
                modal.classList.remove("hidden");
            } else {
                console.error(`Modal com ID paymentDetailsModal${feeId} não encontrado.`);
            }
        }
    </script>
    
    <script>
        function printSelectedSections(sectionIds) {
            var printContent = '';
            
            // Pega o conteúdo de cada elemento e adiciona na variável printContent
            sectionIds.forEach(function(id) {
                var element = document.getElementById(id);
                if (element) {
                    printContent += element.outerHTML; // Inclui o HTML completo do elemento
                }
            });

            if (printContent) {
                var originalContent = document.body.innerHTML; // Salva o conteúdo original da página

                document.body.innerHTML = printContent; // Substitui o conteúdo do body pelo que será impresso
                window.print(); // Abre a janela de impressão
                document.body.innerHTML = originalContent; // Restaura o conteúdo original após a impressão
            } else {
                alert("Nenhum conteúdo encontrado para imprimir!");
            }
        }
    </script>

    <script>
        function printModal(modalId) {
            var modalContent = document.getElementById(modalId);
            if (!modalContent) {
                alert("Erro: Modal não encontrado.");
                return;
            }

            var printWindow = window.open('', '_blank');
            var printContent = '<html><head><title>Impressão</title>';

            // Importa os estilos da página
            var styles = document.querySelectorAll('link[rel="stylesheet"], style');
            styles.forEach(style => {
                printContent += style.outerHTML;
            });

            printContent += '</head><body>';

            // Copia apenas o conteúdo da div do modal
            var modalBody = modalContent.querySelector('.bg-white'); 
            if (modalBody) {
                printContent += modalBody.outerHTML;
            } else {
                alert("Erro: Não foi possível encontrar o conteúdo do modal.");
                return;
            }

            printContent += '</body></html>';

            // Abre uma nova aba e imprime
            printWindow.document.open();
            printWindow.document.write(printContent);
            printWindow.document.close();

            // Aguarda o carregamento e imprime
            printWindow.onload = function() {
                printWindow.print();
                printWindow.close();
            };
        }
        </script>

@endsection
