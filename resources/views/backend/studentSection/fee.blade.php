@extends('layouts.app')

@section('content')
    <div class="roles">

        <div class="">
            <h1 class="text-2xl font-bold text-gray-800 text-left">Fees of student "{{ Auth::user()->name }}"</h1><br>
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
                    {{-- <div class="w-2/12 px-4 py-3"></div> --}}
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
