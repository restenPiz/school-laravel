 @extends('layouts.app')

 @section('content')
     <div class="roles">

         <div class="mt-8 bg-white rounded-lg shadow-lg p-6">
            <div class="w-full px-0 md:px-6 py-4">
                <div>
                    <h2 class="text-gray-700 uppercase font-bold">My Attendance Record</h2><br>
                </div>
                <div class="flex items-center bg-gray-300 text-gray-700">
                    <div class="w-1/4 text-left py-2 px-4 font-semibold">Date</div>
                    <div class="w-1/4 text-left py-2 px-4 font-semibold">Class</div>
                    <div class="w-1/4 text-left py-2 px-4 font-semibold">Teacher</div>
                    <div class="w-1/4 text-right py-2 px-4 font-semibold">Attendance</div>
                </div>
                @foreach ($student->attendances as $attendance)
                    <div class="flex items-center justify-between border border-gray-200 -mb-px">
                        <div class="w-1/4 text-left text-gray-600 py-2 px-4 font-medium">{{ $attendance->attendence_date }}</div>
                        <div class="w-1/4 text-left text-gray-600 py-2 px-4 font-medium">{{ $attendance->class->class_name }}</div>
                        <div class="w-1/4 text-left text-gray-600 py-2 px-4 font-medium">{{ $attendance->teacher->user->name }}</div>
                        <div class="w-1/4 text-right text-gray-600 py-2 px-4 font-medium">
                            @if($attendance->attendence_status)
                                <span class="text-xs text-white bg-green-500 px-2 py-1 rounded-custom">P</span>
                            @else
                                <span class="text-xs text-white bg-red-500 px-2 py-1 rounded-custom">A</span>
                            @endif
                        </div>
                    </div>
                @endforeach
            </div>
         </div>
     </div>
 @endsection
