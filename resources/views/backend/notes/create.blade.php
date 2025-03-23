@extends('layouts.app')

@section('content')
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
                <form action="{{ route('notes.store') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="mb-4">
                        <label class="block text-gray-500 font-bold mb-2">Subject</label>
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

                    <div class="mb-4">
                        <label class="block text-gray-500 font-bold mb-2">Type of Avaliation</label>
                        <select name="type" class="w-full bg-gray-200 border rounded py-2 px-3">
                            <option value="">--Select the Type of Avaliation--</option>
                            <option value="first">First Avaliation</option>
                            <option value="second">Second Avaliation</option>
                            <option value="third">Third Avaliation</option>
                        </select>
                        @error('type')
                            <p class="text-red-500 text-xs italic">{{ $message }}</p>
                        @enderror
                    </div>

                    <div class="mb-4">
                        <label class="block text-gray-500 font-bold mb-2">Note</label>
                        <input name="note" type="number" class="w-full bg-gray-200 border rounded py-2 px-3">
                        @error('note')
                            <p class="text-red-500 text-xs italic">{{ $message }}</p>
                        @enderror
                    </div>

                    <input type="hidden" name="student_id" value="{{ $student->id }}">

                    <div>
                        <button class="bg-blue-500 text-white font-bold py-2 px-4 rounded w-full">
                            Submit
                        </button>
                    </div>
                </form>
            </div>

            <!-- Tabela de Notas -->
            <div class="w-full md:w-1/2 bg-white rounded p-6">
                <h3 class="text-gray-700 uppercase font-bold mb-4">Student Notes</h3>
                
                @if ($student->notes->isEmpty())
                    <p class="text-gray-600">No notes available.</p>
                @else
                    <div class="mt-8 bg-white rounded border-b-4 border-gray-300">
                        <div class="flex flex-wrap items-center uppercase text-sm font-semibold bg-gray-600 text-white rounded-tl rounded-tr">
                            <div class="w-4/12 px-4 py-3">Subject</div>
                            <div class="w-3/12 px-4 py-3">Type</div>
                            <div class="w-2/12 px-4 py-3">Note</div>
                            <div class="w-2/12 px-4 py-3"></div>
                        </div>
                        @foreach($student->notes as $note)
                            <div class="flex flex-wrap items-center text-gray-700 border-t-2 border-gray-300">
                                <div class="w-4/12 px-4 py-3 text-sm font-semibold text-gray-600">{{ $note->subject->name }}</div>
                                <div class="w-3/12 px-4 py-3 text-sm font-semibold text-gray-600">{{ ucfirst($note->type) }}</div>
                                <div class="w-2/12 px-4 py-3 text-sm font-semibold text-gray-600">{{ $note->note }}</div>
                                <div class="w-2/12 flex items-center justify-end px-3">
                                    <a href="" class="ml-1" title="Edit">
                                        <svg class="h-6 w-6 fill-current text-green-600" aria-hidden="true" focusable="false" data-prefix="fas" data-icon="pen-square" class="svg-inline--fa fa-pen-square fa-w-14" role="img" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 448 512"><path fill="currentColor" d="M400 480H48c-26.5 0-48-21.5-48-48V80c0-26.5 21.5-48 48-48h352c26.5 0 48 21.5 48 48v352c0 26.5-21.5 48-48 48zM238.1 177.9L102.4 313.6l-6.3 57.1c-.8 7.6 5.6 14.1 13.3 13.3l57.1-6.3L302.2 242c2.3-2.3 2.3-6.1 0-8.5L246.7 178c-2.5-2.4-6.3-2.4-8.6-.1zM345 165.1L314.9 135c-9.4-9.4-24.6-9.4-33.9 0l-23.1 23.1c-2.3 2.3-2.3 6.1 0 8.5l55.5 55.5c2.3 2.3 6.1 2.3 8.5 0L345 199c9.3-9.3 9.3-24.5 0-33.9z"></path></svg>
                                    </a>
                                    <a href="{{route('notes.delete',['id'=>$note->id])}}" data-url="{!! URL::route('notes.delete', $note->id) !!}"class="deletestudent ml-1 bg-red-600 block p-1 border border-red-600 rounded-sm" title="Delete">
                                        <svg class="h-3 w-3 fill-current text-gray-100" aria-hidden="true" focusable="false" data-prefix="fas" data-icon="trash" class="svg-inline--fa fa-trash fa-w-14" role="img" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 448 512"><path fill="currentColor" d="M432 32H312l-9.4-18.7A24 24 0 0 0 281.1 0H166.8a23.72 23.72 0 0 0-21.4 13.3L136 32H16A16 16 0 0 0 0 48v32a16 16 0 0 0 16 16h416a16 16 0 0 0 16-16V48a16 16 0 0 0-16-16zM53.2 467a48 48 0 0 0 47.9 45h245.8a48 48 0 0 0 47.9-45L416 128H32z"></path></svg>
                                    </a>
                                </div>
                            </div>
                        @endforeach
                    </div>
                @endif
            </div>
        </div>
        
        @include('backend.modals.delete',['name' => 'note'])
    </div>
    <script>
        $(function() {
            $( ".deletestudent" ).on( "click", function(event) {
                event.preventDefault();
                $( "#deletemodal" ).toggleClass( "hidden" );
                var url = $(this).attr('data-url');
                $(".remove-record").attr("action", url);
            })        
            
            $( "#deletemodelclose" ).on( "click", function(event) {
                event.preventDefault();
                $( "#deletemodal" ).toggleClass( "hidden" );
            })
        })
    </script>
@endsection
