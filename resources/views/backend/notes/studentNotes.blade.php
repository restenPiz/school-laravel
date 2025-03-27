@extends('layouts.app')
@section('content')
    <div class="roles">
        <div class="">
            <h3 class="text-gray-700 uppercase font-bold mb-4">Student Notes - {{ $student->user->name }}</h3>

            @if ($student->notes->isEmpty())
                <p class="text-gray-600">No notes available.</p>
            @else
                <div class="mt-8 bg-white rounded border-b-4 border-gray-300">
                    <div class="flex flex-wrap items-center uppercase text-sm font-semibold bg-gray-300 text-gray-700 rounded-tl rounded-tr">
                        <div class="w-2/12 px-4 py-3">Subject</div>
                        <div class="w-2/12 px-4 py-3">First Avaliation</div>
                        <div class="w-2/12 px-4 py-3">Second Avaliation</div>
                        <div class="w-2/12 px-4 py-3">Third Avaliation</div>
                        <div class="w-2/12 px-4 py-3">Exam Note</div>
                         <div class="w-2/12 px-4 py-3">Status</div> <!-- Nova coluna para a nota do exame -->
                    </div>

                    @php
                        // Agrupar notas por disciplina e por tipo de avaliação
                        $studentNotesBySubject = [];

                        foreach ($student->notes as $note) {
                            $studentNotesBySubject[$note->subject->name][$note->type] = $note->note;
                        }
                    @endphp

                    @foreach ($studentNotesBySubject as $subjectName => $notes)
                        @php
                            $first = $notes['first'] ?? null;
                            $second = $notes['second'] ?? null;
                            $third = $notes['third'] ?? null;
                            $status = 'Pendente';
                            $examNote = null;

                            if ($first !== null && $second !== null && $third !== null) {
                                $average = ($first + $second + $third) / 3;
                                
                                if ($average < 10) {
                                    $status = 'Excluído';
                                } else {
                                    $status = 'Aprovado';
                                    $examNote = rand(10, 20); // Simula a nota do exame (pode substituir pela real)
                                }
                            }
                        @endphp

                        <div class="bg-white flex flex-wrap items-center text-gray-700 border border-b-4 border-l-4 border-r-4 border-gray-300">
                            <div class="w-2/12 px-4 py-3 text-sm font-semibold text-gray-600">{{ $subjectName }}</div>
                            <div class="w-2/12 px-4 py-3 text-sm font-semibold text-gray-600">{{ $first ?? '—' }}</div>
                            <div class="w-2/12 px-4 py-3 text-sm font-semibold text-gray-600">{{ $second ?? '—' }}</div>
                            <div class="w-2/12 px-4 py-3 text-sm font-semibold text-gray-600">{{ $third ?? '—' }}</div>
                            <div class="w-2/12 px-4 py-3 text-sm font-semibold text-gray-600">
                                {{ $examNote !== null ? $examNote : '—' }}
                            </div>
                            @if($status=='Pendente')
                            <div class="w-2/12 px-4 py-3 text-sm font-semibold text-gray-600">
                                <span class="bg-yellow-200 text-sm px-2 border rounded-full">{{ $status }}</span>
                            </div>
                            @elseif($status=='Excluído')
                            <div class="w-2/12 px-4 py-3 text-sm font-semibold text-gray-600">
                                <span class="bg-red-200 text-sm px-2 border rounded-full">{{ $status }}</span>
                            </div>
                            @else
                            <div class="w-2/12 px-4 py-3 text-sm font-semibold text-gray-600">
                                <span class="bg-green-200 text-sm px-2 border rounded-full">{{ $status }}</span>
                            </div>
                            @endif
                        </div>
                    @endforeach
                </div>
            @endif
        </div>
    </div>
@endsection
