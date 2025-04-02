<div class="w-full max-w-8xl mx-auto bg-white rounded-xl p-8 mt-8">
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

{{-- Student Notes --}}
<div style="margin-top: 1rem;">
    @if (empty($studentNotesBySubject))
        <p class="text-gray-600">No notes available.</p>
    @else
        <div class="mt-8 bg-white rounded border-b-4 border-gray-300">
            <div class="flex flex-wrap items-center uppercase text-sm font-semibold bg-gray-300 text-gray-700 rounded-tl rounded-tr">
                <div class="w-2/12 px-4 py-3">Subject</div>
                <div class="w-2/12 px-4 py-3">First Avaliation</div>
                <div class="w-2/12 px-4 py-3">Second Avaliation</div>
                <div class="w-2/12 px-4 py-3">Third Avaliation</div>
                <div class="w-2/12 px-4 py-3">Work</div>
                <div class="w-2/12 px-4 py-3">Status</div>
            </div>

            @foreach ($studentNotesBySubject as $subjectId => $notes)
                <div class="flex flex-wrap items-center text-gray-700 border border-b-4 border-l-4 border-r-4 border-gray-300">
                    <div class="w-2/12 px-4 py-3 text-sm font-semibold text-gray-600">{{ $notes['subject_name'] }}</div>
                    <div class="w-2/12 px-4 py-3 text-sm font-semibold text-gray-600">{{ $notes['first'] ?? '—' }}</div>
                    <div class="w-2/12 px-4 py-3 text-sm font-semibold text-gray-600">{{ $notes['second'] ?? '—' }}</div>
                    <div class="w-2/12 px-4 py-3 text-sm font-semibold text-gray-600">{{ $notes['third'] ?? '—' }}</div>
                    <div class="w-2/12 px-4 py-3 text-sm font-semibold text-gray-600">{{ $notes['work'] ?? '—' }}</div>
                    <div class="w-2/12 px-4 py-3 text-sm font-semibold text-gray-600">{{ $notes['status'] }}</div>
                </div>
            @endforeach
        </div>
    @endif
</div>
