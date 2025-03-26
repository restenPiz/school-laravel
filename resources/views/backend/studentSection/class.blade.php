 @extends('layouts.app')

 @section('content')
     <div class="roles">

         <div class="mt-8 bg-white rounded-lg shadow-lg p-6">
             <div class="w-full sm:w-2/2 mr-2 mb-6">
                 <div class="flex items-center bg-gray-300 text-gray-700">
                     <div class="w-1/3 text-left text-white py-2 px-4 font-semibold">Code</div>
                     <div class="w-1/3 text-left text-white py-2 px-4 font-semibold">Subject</div>
                     <div class="w-1/3 text-right text-white py-2 px-4 font-semibold">Teacher</div>
                 </div>
                 @foreach ($student->class->subjects as $subject)
                     <div class="flex items-center justify-between border border-gray-200 -mb-px">
                         <div class="w-1/3 text-left text-gray-600 py-2 px-4 font-medium">{{ $subject->subject_code }}</div>
                         <div class="w-1/3 text-left text-gray-600 py-2 px-4 font-medium">{{ $subject->name }}</div>
                         <div class="w-1/3 text-right text-gray-600 py-2 px-4 font-medium">
                             {{ $subject->teacher->user->name }}</div>
                     </div>
                 @endforeach


             </div>
         </div>
     </div>
 @endsection
