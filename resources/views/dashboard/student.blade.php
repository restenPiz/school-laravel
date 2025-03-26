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
