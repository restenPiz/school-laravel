<div class="w-full max-w-5xl mx-auto bg-white shadow-lg rounded-lg p-6 mt-8">
    <h2 class="text-xl font-semibold text-gray-800 border-b pb-2 mb-4">Student & Parent Information</h2>

    <div class="flex flex-wrap md:flex-nowrap items-start">
        <!-- Coluna Esquerda: Informações do Estudante -->
        <div class="w-full md:w-1/2 pr-4 border-r">
            {{-- <div class="flex items-center justify-center mb-6">
                <img class="w-32 h-32 rounded-full border-4 border-gray-200" 
                     src="{{ asset('images/profile/' .$student->user->profile_picture) }}" 
                     alt="Student Avatar">
            </div> --}}

            <h3 class="text-lg font-semibold text-gray-700 mb-3">Personal Details</h3>
            <div class="space-y-2">
                <p class="text-gray-600"><strong>Name:</strong> {{ $student->user->name }}</p>
                <p class="text-gray-600"><strong>Email:</strong> {{ $student->user->email }}</p>
                <p class="text-gray-600"><strong>Class:</strong> {{ $student->class->class_name }}</p>
                <p class="text-gray-600"><strong>Roll Number:</strong> {{ $student->roll_number }}</p>
                <p class="text-gray-600"><strong>Phone:</strong> {{ $student->phone }}</p>
                <p class="text-gray-600"><strong>Gender:</strong> {{ $student->gender }}</p>
                <p class="text-gray-600"><strong>Date of Birth:</strong> {{ $student->dateofbirth }}</p>
                {{-- <p class="text-gray-600"><strong>Current Address:</strong> {{ $student->current_address }}</p>
                <p class="text-gray-600"><strong>Permanent Address:</strong> {{ $student->permanent_address }}</p> --}}
            </div>
        </div>

        <!-- Coluna Direita: Informações do Parente -->
        <div class="w-full md:w-1/2 pl-4">
            <h3 class="text-lg font-semibold text-gray-700 mb-3">Parent/Guardian Details</h3>
            <div class="space-y-2">
                <p class="text-gray-600"><strong>Name:</strong> {{ $student->parent->user->name }}</p>
                <p class="text-gray-600"><strong>Email:</strong> {{ $student->parent->user->email }}</p>
                <p class="text-gray-600"><strong>Phone:</strong> {{ $student->parent->phone }}</p>
                <p class="text-gray-600"><strong>Address:</strong> {{ $student->parent->current_address }}</p>
            </div>

            <h3 class="text-lg font-semibold text-gray-700 mt-6 mb-3">Address</h3>
            <div class="space-y-2">
                <p class="text-gray-600"><strong>Current Address:</strong> {{ $student->current_address }}</p>
                <p class="text-gray-600"><strong>Permanent Address:</strong> {{ $student->permanent_address }}</p>
            </div>
        </div>
    </div>
</div>
