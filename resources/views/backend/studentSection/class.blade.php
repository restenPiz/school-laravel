 @extends('layouts.app')

 @section('content')
     <div class="roles">

         <div class="mt-8 p-6">
             <div class="w-full sm:w-2/2 mr-2 mb-6">
                 <div class="flex items-center bg-gray-300 text-gray-700">
                     <div class="w-1/3 text-left py-2 px-4 font-semibold">Code</div>
                     <div class="w-1/3 text-left py-2 px-4 font-semibold">Subject</div>
                     <div class="w-1/3 text-right py-2 px-4 font-semibold">Teacher</div>
                 </div>
                 @foreach ($student->class->subjects as $subject)
                     <div class="bg-white flex items-center justify-between border border-b-4 border-l-4 border-r-4 border-gray-300 -mb-px">
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
