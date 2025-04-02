@extends('layouts.app')
@section('content')
    <div class="roles">
        <div class="flex items-center justify-between mb-6">
            <div>
                <h2 class="text-2xl font-bold text-gray-600">{{$student->user->name}} - Notes</h2>
            </div>
            <div class="flex flex-wrap items-center">
                <button style="margin-right:0.5rem" onclick="printSelectedSections(['notes'])" class="bg-blue-800 text-white text-sm py-2 px-4 flex items-center rounded-lg hover:bg-gray-700 transition duration-300">
                    <svg class="w-4 h-4 fill-current" aria-hidden="true" focusable="false" data-prefix="fas" data-icon="print" role="img" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512">
                        <path fill="currentColor" d="M464 128h-16V64a64 64 0 0 0-64-64H128a64 64 0 0 0-64 64v64H48a48 48 0 0 0-48 48v160a48 48 0 0 0 48 48h16v96a32 32 0 0 0 32 32h320a32 32 0 0 0 32-32v-96h16a48 48 0 0 0 48-48V176a48 48 0 0 0-48-48zM128 64h256v64H128zm256 384H128v-80h256zm64-128H64V192h384zm-48-64a16 16 0 1 1-16-16 16 16 0 0 1 16 16z"></path>
                    </svg>
                    <span class="ml-2 text-xs font-semibold">Print</span>
                </button>

                <a href="{{ route('home') }}" class="bg-gray-800 text-white text-sm py-2 px-4 flex items-center rounded-lg hover:bg-gray-700 transition duration-300">
                    <svg class="w-4 h-4 fill-current" aria-hidden="true" focusable="false" data-prefix="fas" data-icon="long-arrow-alt-left" role="img" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 448 512"><path fill="currentColor" d="M134.059 296H436c6.627 0 12-5.373 12-12v-56c0-6.627-5.373-12-12-12H134.059v-46.059c0-21.382-25.851-32.09-40.971-16.971L7.029 239.029c-9.373 9.373-9.373 24.569 0 33.941l86.059 86.059c15.119 15.119 40.971 4.411 40.971-16.971V296z"></path></svg>
                    <span class="ml-2 text-xs font-semibold">Back</span>
                </a>
            </div>
        </div>
        <div style="margin-top: 1rem;">
            @if (empty($studentNotesBySubject))
                <p class="text-gray-600">No notes available.</p>
            @else
                <div class="mt-8 bg-white rounded border-b-4 border-gray-300" id="notes">
                    <div class="flex flex-wrap items-center uppercase text-sm font-semibold bg-gray-300 text-gray-700 rounded-tl rounded-tr">
                        <div class="w-2/12 px-4 py-3">Subject</div>
                        <div class="w-2/12 px-4 py-3">First Avaliation</div>
                        <div class="w-2/12 px-4 py-3">Second Avaliation</div>
                        <div class="w-2/12 px-4 py-3">Third Avaliation</div>
                        <div class="w-2/12 px-4 py-3">Work</div>
                        
                        <div class="w-2/12 px-4 py-3"></div>
                    </div>

                    @foreach ($studentNotesBySubject as $subjectId => $notes)
                        @php
                            $validNotes = array_filter([$notes['first'], $notes['second'], $notes['third'], $notes['work'], $notes['exam']]);
                            $average = !empty($validNotes) ? array_sum($validNotes) / count($validNotes) : 0;

                            $status = $average < 10 ? 'Excluído' : 'Aprovado';
                        @endphp
                        <div class="flex flex-wrap items-center text-gray-700 border border-b-4 border-l-4 border-r-4 border-gray-300">
                            <div class="w-2/12 px-4 py-3 text-sm font-semibold text-gray-600">{{ $notes['subject_name'] }}</div>
                            <div class="w-2/12 px-4 py-3 text-sm font-semibold text-gray-600">{{ $notes['first'] ?? '—' }}</div>
                            <div class="w-2/12 px-4 py-3 text-sm font-semibold text-gray-600">{{ $notes['second'] ?? '—' }}</div>
                            <div class="w-2/12 px-4 py-3 text-sm font-semibold text-gray-600">{{ $notes['third'] ?? '—' }}</div>
                            <div class="w-2/12 px-4 py-3 text-sm font-semibold text-gray-600">{{ $notes['work'] ?? '—' }}</div>
                           <div class="w-2/12 px-4 py-3 text-sm font-semibold text-gray-600">
                                {{ $status }} - 
                                <span class="bg-gray-200 text-sm px-2 border rounded-full">
                                     ({{ number_format($average, 2) }})
                                </span>
                            </div>
                        </div>
                    @endforeach
                </div>
            @endif
        </div>
    </div>

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
@endsection
