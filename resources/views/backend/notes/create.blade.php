@extends('layouts.app')

@section('content')
<link rel="stylesheet" href="">
    <link href="https://cdn.jsdelivr.net/npm/flowbite@3.1.2/dist/flowbite.min.css" rel="stylesheet" />
</link>
    <div class="roles">
        <div class="flex items-center justify-between mb-6">
            <div>
                <h2 class="text-gray-700 uppercase font-bold">Add Notes of {{$student->user->name}}</h2>
            </div>
            <div class="flex flex-wrap items-center">
                <a href="{{ route('student.notes') }}" class="bg-gray-700 text-white text-sm uppercase py-2 px-4 flex items-center rounded">
                    <svg class="w-3 h-3 fill-current" aria-hidden="true" focusable="false" data-prefix="fas" data-icon="long-arrow-alt-left" class="svg-inline--fa fa-long-arrow-alt-left fa-w-14" role="img" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 448 512"><path fill="currentColor" d="M134.059 296H436c6.627 0 12-5.373 12-12v-56c0-6.627-5.373-12-12-12H134.059v-46.059c0-21.382-25.851-32.09-40.971-16.971L7.029 239.029c-9.373 9.373-9.373 24.569 0 33.941l86.059 86.059c15.119 15.119 40.971 4.411 40.971-16.971V296z"></path></svg>
                    <span class="ml-2 text-xs font-semibold">Back</span>
                </a>
            </div>
        </div>

        <!-- Layout Flexível para Formulário e Tabela -->
        <div class="flex flex-col md:flex-row gap-8">
            <!-- Formulário -->
            <div class="w-full md:w-1/2 bg-white rounded p-6">
    @if($student->status == 'excluido')
        <div class="alert alert-danger">
            O aluno foi excluído devido à média inferior a 10. Não é possível lançar mais notas.
        </div>
    @else
        <form action="{{ route('notes.store') }}" method="POST" enctype="multipart/form-data">
            @csrf

            <div class="mb-4">
                <label class="block text-gray-600 font-medium">Subject</label>
                <select name="subject_id" class="w-full bg-gray-200 border rounded py-2 px-3">
                    <option value="">--Select Subject--</option>
                    @foreach($student->class->subjects as $subject)
                        <option value="{{ $subject->id }}">{{ $subject->name }}</option>
                    @endforeach
                </select>
                @error('subject_id')
                    <p class="text-red-500 text-xs italic">{{ $message }}</p>
                @enderror
            </div>

            <!-- Primeira Nota -->
            <div class="form-group">
                <label class="block text-gray-600 font-medium" for="first">Primeira Nota</label>
                <input type="number" name="first" id="first" class="mt-1 block w-full px-4 py-2 bg-gray-100 border border-gray-300 rounded-md focus:ring-2 focus:ring-blue-500" value="{{ old('first') }}">
            </div>

            <!-- Segunda Nota -->
            <div class="form-group">
                <label class="block text-gray-600 font-medium" for="second">Segunda Nota</label>
                <input type="number" name="second" id="second" class="mt-1 block w-full px-4 py-2 bg-gray-100 border border-gray-300 rounded-md focus:ring-2 focus:ring-blue-500" value="{{ old('second') }}">
            </div>

            <!-- Terceira Nota -->
            <div class="form-group">
                <label class="block text-gray-600 font-medium" for="third">Terceira Nota</label>
                <input type="number" name="third" id="third" class="mt-1 block w-full px-4 py-2 bg-gray-100 border border-gray-300 rounded-md focus:ring-2 focus:ring-blue-500" value="{{ old('third') }}">
            </div>

            <!-- Nota do Trabalho -->
            <div class="form-group">
                <label class="block text-gray-600 font-medium" for="work">Nota do Trabalho</label>
                <input type="number" name="work" id="work" class="mt-1 block w-full px-4 py-2 bg-gray-100 border border-gray-300 rounded-md focus:ring-2 focus:ring-blue-500" value="{{ old('work') }}">
            </div>

            <!-- Nota do Exame (Será exibido apenas se o aluno for aprovado) -->
            <div id="exam-input" class="form-group" style="display: none;">
                <label class="block text-gray-600 font-medium" for="exam">Nota de Exame</label>
                <input type="number" name="exam" id="exam" class="mt-1 block w-full px-4 py-2 bg-gray-100 border border-gray-300 rounded-md focus:ring-2 focus:ring-blue-500" value="{{ old('exam') }}">
            </div>

            <input type="hidden" name="student_id" value="{{ $student->id }}">

            <button style="margin-top:1rem" type="submit" class="bg-blue-600 text-white px-6 py-3 rounded-md hover:bg-blue-500 focus:ring-2 focus:ring-blue-400 transition-colors">
                Registrar Notas
            </buttonn>
        </form>
    @endif
</div>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        // Pega o status do aluno direto da variável do servidor
        var studentStatus = '{{ $status }}';
        var examInput = document.getElementById('exam-input'); // O campo de nota de exame
        
        // Se o status for "aprovado", mostra o campo de exame
        if (studentStatus == 'aprovado') {
            examInput.style.display = 'block'; // Exibe o campo de exame
        } else {
            examInput.style.display = 'none'; // Caso contrário, esconde o campo
        }
    });
</script>



            <!-- Tabela de Notas -->
            <div class="w-full md:w-1/2 bg-white rounded p-6">
                <h3 class="text-gray-700 uppercase font-bold mb-4">Student Notes</h3>
                
                @if ($student->notes->isEmpty())
                    <div class="mt-8 bg-white rounded border-b-4 border-gray-300">
                        <div class="flex flex-wrap items-center uppercase text-sm font-semibold bg-gray-300 text-gray-700 rounded-tl rounded-tr">
                            <div class="w-4/12 px-4 py-3">Subject</div>
                            <div class="w-3/12 px-4 py-3">Type</div>
                            <div class="w-2/12 px-4 py-3">Note</div>
                            <div class="w-2/12 px-4 py-3"></div>
                        </div>
                        <div class="flex flex-wrap items-center text-gray-700 border-t-2 border-gray-300" style="text-align: center">
                            <div class="w-4/12 px-4 py-3 text-sm font-semibold text-gray-600" style="text-align: center">
                                <p class="text-gray-600">No notes available.</p>
                            </div>
                        </div>
                    </div>
                @else
                    <div class="mt-8 bg-white rounded border-b-4 border-gray-300">
                        <div class="flex flex-wrap items-center uppercase text-sm font-semibold bg-gray-300 text-gray-700 rounded-tl rounded-tr">
                            <div class="w-4/12 px-4 py-3">Subject</div>
                            <div class="w-3/12 px-4 py-3">Type</div>
                            <div class="w-2/12 px-4 py-3">Note</div>
                            <div class="w-2/12 px-4 py-3"></div>
                        </div>
                         @foreach($student->notes as $note)
                            @foreach (['first', 'second', 'third', 'work', 'exam'] as $type)
                                @if($note->$type !== null) <!-- Verifica se a nota existe -->
                                    <div class="flex flex-wrap items-center text-gray-700 border-t-2 border-gray-300">
                                        <div class="w-4/12 px-4 py-3 text-sm font-semibold text-gray-600">
                                            {{ $note->subject->name }}
                                        </div>
                                        <div class="w-3/12 px-4 py-3 text-sm font-semibold text-gray-600">
                                            {{ ucfirst($type) }}
                                        </div>
                                        <div class="w-2/12 px-4 py-3 text-sm font-semibold text-gray-600">
                                            {{ $note->$type }}
                                        </div>
                                        <div class="w-2/12 flex items-center justify-end px-3">
                                            <a onclick="openEditModal({{ $note->id }})" href="#" class="ml-1" type="button" data-bs-toggle="modal" data-bs-target="#editModal{{$note->id}}">
                                                <svg class="h-6 w-6 fill-current text-green-600" aria-hidden="true" focusable="false" data-prefix="fas" data-icon="pen-square" class="svg-inline--fa fa-pen-square fa-w-14" role="img" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 448 512"><path fill="currentColor" d="M400 480H48c-26.5 0-48-21.5-48-48V80c0-26.5 21.5-48 48-48h352c26.5 0 48 21.5 48 48v352c0 26.5-21.5 48-48 48zM238.1 177.9L102.4 313.6l-6.3 57.1c-.8 7.6 5.6 14.1 13.3 13.3l57.1-6.3L302.2 242c2.3-2.3 2.3-6.1 0-8.5L246.7 178c-2.5-2.4-6.3-2.4-8.6-.1zM345 165.1L314.9 135c-9.4-9.4-24.6-9.4-33.9 0l-23.1 23.1c-2.3 2.3-2.3 6.1 0 8.5l55.5 55.5c2.3 2.3 6.1 2.3 8.5 0L345 199c9.3-9.3 9.3-24.5 0-33.9z"></path></svg>
                                            </a>
                                            <a href="{{route('notes.delete',['id'=>$note->id])}}" class="deletestudent ml-1 bg-red-600 block p-1 border border-red-600 rounded-sm" title="Delete">
                                                <svg class="h-3 w-3 fill-current text-gray-100" aria-hidden="true" focusable="false" data-prefix="fas" data-icon="trash" class="svg-inline--fa fa-trash fa-w-14" role="img" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 448 512"><path fill="currentColor" d="M432 32H312l-9.4-18.7A24 24 0 0 0 281.1 0H166.8a23.72 23.72 0 0 0-21.4 13.3L136 32H16A16 16 0 0 0 0 48v32a16 16 0 0 0 16 16h416a16 16 0 0 0 16-16V48a16 16 0 0 0-16-16zM53.2 467a48 48 0 0 0 47.9 45h245.8a48 48 0 0 0 47.9-45L416 128H32z"></path></svg>
                                            </a>
                                        </div>
                                        
                                    </div>
                                @endif
                                @endforeach

                                    
                            {{--?Start with modal edit--}}
                                <div id="editModal{{$note->id}}" data-bs-keyboard="false"
                                    data-bs-backdrop="static" tabindex="-1" aria-labelledby="staticBackdropLabel"
                                    aria-hidden="true" class="modal-bg hidden fixed top-0 left-0 right-0 bottom-0 w-full h-full overflow-auto z-50 flex items-center justify-center">
                                    <div class="bg-white relative p-10 max-w-lg w-full mx-4 sm:mx-auto my-10 sm:my-32 shadow-lg rounded-lg">
                                        <div class="absolute top-0 right-0 m-3 text-red-600 cursor-pointer">
                                            <button onclick="closeModal('editModal{{$note->id}}')" >
                                                <svg class="w-6 h-6 stroke-current" aria-hidden="true" focusable="false" data-prefix="far" data-icon="times-circle" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512">
                                                    <path fill="currentColor" d="M256 8C119 8 8 119 8 256s111 248 248 248 248-111 248-248S393 8 256 8zm0 448c-110.5 0-200-89.5-200-200S145.5 56 256 56s200 89.5 200 200-89.5 200-200 200zm101.8-262.2L295.6 256l62.2 62.2c4.7 4.7 4.7 12.3 0 17l-22.6 22.6c-4.7 4.7-12.3 4.7-17 0L256 295.6l-62.2 62.2c-4.7 4.7-12.3 4.7-17 0l-22.6-22.6c-4.7-4.7-4.7-12.3 0-17l62.2-62.2-62.2-62.2c-4.7-4.7-4.7-12.3 0-17l22.6-22.6c4.7-4.7 12.3-4.7 17 0l62.2 62.2 62.2-62.2c4.7-4.7 12.3-4.7 17 0l22.6 22.6c4.7 4.7 4.7 12.3 0 17z"></path>
                                                </svg>
                                            </button>
                                        </div>

                                        <h2 class="text-xl font-semibold text-gray-800 mb-6 text-center">Formulario de Edicao de Dados</h2>
                                        
                                        {{--?Start the update form--}}
                                        <div class="w-full md:w-2/2 bg-white rounded p-6">
                                            <form action="{{ route('notes.update',[
                                                'id'=>$note->id
                                            ]) }}" method="POST">
                                                @csrf
                                                <div class="mb-4">
                                                    <label class="block text-gray-500 font-bold mb-2">Subject</label>
                                                    <select name="subject_id" class="w-full bg-gray-200 border rounded py-2 px-3">
                                                        <option value="{{$note->subject_id}}">{{$note->subject->name}}</option>
                                                        @foreach($student->class->subjects as $subject)
                                                            <option value="{{ $subject->id }}">{{ $subject->name }}</option>
                                                        @endforeach
                                                    </select>
                                                    @error('subject_id')
                                                        <p class="text-red-500 text-xs italic">{{ $message }}</p>
                                                    @enderror
                                                </div>

                                                {{--?Start writing some inputs (First, Second, Third, Work)--}}
                                                <div class="mb-4">
                                                    <label class="block text-gray-500 font-bold mb-2">First Test</label>
                                                    <input value="{{$note->first}}" name="first" type="number" class="w-full bg-gray-200 border rounded py-2 px-3">
                                                    @error('note')
                                                        <p class="text-red-500 text-xs italic">{{ $message }}</p>
                                                    @enderror
                                                </div>
                                                <div class="mb-4">
                                                    <label class="block text-gray-500 font-bold mb-2">Second Test</label>
                                                    <input value="{{$note->second}}" name="second" type="number" class="w-full bg-gray-200 border rounded py-2 px-3">
                                                    @error('note')
                                                        <p class="text-red-500 text-xs italic">{{ $message }}</p>
                                                    @enderror
                                                </div>
                                                <div class="mb-4">
                                                    <label class="block text-gray-500 font-bold mb-2">Third Test</label>
                                                    <input value="{{$note->third}}" name="first" type="number" class="w-full bg-gray-200 border rounded py-2 px-3">
                                                    @error('note')
                                                        <p class="text-red-500 text-xs italic">{{ $message }}</p>
                                                    @enderror
                                                </div>
                                                <div class="mb-4">
                                                    <label class="block text-gray-500 font-bold mb-2">Work</label>
                                                    <input value="{{$note->work}}" name="work" type="number" class="w-full bg-gray-200 border rounded py-2 px-3">
                                                    @error('note')
                                                        <p class="text-red-500 text-xs italic">{{ $message }}</p>
                                                    @enderror
                                                </div>
                                                <div class="mb-4" id="exam-input">
                                                    <label class="block text-gray-500 font-bold mb-2">Exam</label>
                                                    <input value="{{$note->exam}}" name="exam" type="number" class="w-full bg-gray-200 border rounded py-2 px-3">
                                                    @error('note')
                                                        <p class="text-red-500 text-xs italic">{{ $message }}</p>
                                                    @enderror
                                                </div>

                                                <input type="hidden" name="student_id" value="{{ $student->id }}">
                                                <div class="flex justify-end mt-6">
                                                    <button onclick="closeModal('editModal{{$note->id}}')" type="button" data-bs-dismiss="modal" class="bg-gray-500 text-white px-4 py-2 rounded">Fechar</button>
                                                    <button style="margin-left:0.5rem" type="submit" class="bg-blue-500 text-white px-4 py-2 rounded">Update</button>
                                                </div>
                                            </form>
                                        </div>
                                        {{--?End of form--}}
                                    </div>
                                </div>

                            {{--?End with the modal--}}
                        @endforeach
                    </div>
                    <div class="w-full md:w-1/2 bg-white rounded p-6">
                        <h3 class="text-gray-700 uppercase font-bold mb-4">Notas do Aluno</h3>

                            @if($media !== null)
                                @if ($status=='aprovado')
                                <p style="color:green"><strong>Média: </strong>{{ $media }}</p>
                                    <p style="color:green"><strong>Status: </strong>{{ ucfirst($status) }}</p>
                                @else
                                    <p style="color:red"><strong>Média: </strong>{{ $media }}</p>
                                    <p style="color:red"><strong>Status: </strong>{{ ucfirst($status) }}</p>
                                @endif
                            @else
                                <p><strong>Notas insuficientes para calcular a média.</strong></p>
                            @endif
                    </div>
                @endif
            </div>
        </div>
        
    </div>

    <script>
        function openEditModal(noteId) {
            let modal = document.getElementById(`editModal${noteId}`);
            if (modal) {
                modal.classList.remove("hidden");
            } else {
                console.error(`Modal com ID paymentDetailsModal${noteId} não encontrado.`);
            }
        }

        function closeModal(modalId) {
            document.getElementById(modalId).classList.add("hidden");
        }
    </script>
    {{-- <script>
    if ({{ $student->status == 'excluido' ? 'true' : 'false' }}) {
        document.getElementById("exam").disabled = true;
    }
</script> --}}
@endsection
