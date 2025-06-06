{{-- @extends('layouts.app')

@section('content')
    <div class="create">

        <div class="flex items-center justify-between mb-6">
            <div>
                <h2 class="text-gray-700 uppercase font-bold">Attendance Report</h2>
            </div>
            <div class="flex flex-wrap items-center">
                <a href="{{ route('home') }}" class="bg-gray-700 text-white text-sm uppercase py-2 px-4 flex items-center rounded">
                    <svg class="w-3 h-3 fill-current" aria-hidden="true" focusable="false" data-prefix="fas" data-icon="long-arrow-alt-left" class="svg-inline--fa fa-long-arrow-alt-left fa-w-14" role="img" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 448 512"><path fill="currentColor" d="M134.059 296H436c6.627 0 12-5.373 12-12v-56c0-6.627-5.373-12-12-12H134.059v-46.059c0-21.382-25.851-32.09-40.971-16.971L7.029 239.029c-9.373 9.373-9.373 24.569 0 33.941l86.059 86.059c15.119 15.119 40.971 4.411 40.971-16.971V296z"></path></svg>
                    <span class="ml-2 text-xs font-semibold">Back</span>
                </a>
            </div>
        </div>
        <!-- Log on to codeastro.com for more projects -->
        <div class="w-full mt-8 bg-white rounded">
            <form action="{{ route('attendance.index') }}" method="GET" class="md:flex md:items-center md:justify-between px-6 py-6 pb-0">

                <input name="type" class="mr-2 leading-tight" type="radio" value="class" checked>
                <div class="md:flex md:items-center mb-6 text-gray-700 uppercase font-bold">
                    <div>
                        <label class="block text-gray-500 font-bold md:text-right mb-1 md:mb-0 pr-4">
                            Month
                        </label>
                    </div>
                    <div class="block text-gray-600 font-bold">
                        <div class="relative">
                            <select name="month" class="block font-bold appearance-none w-full bg-gray-200 border border-gray-200 text-gray-600 py-3 px-4 pr-8 rounded leading-tight focus:outline-none focus:bg-white focus:border-gray-500">
                                <option value="">--Select Month--</option>
                                @foreach ($months as $month => $values)
                                    <option value="{{ $month }}">{{ $month }}</option>
                                @endforeach
                            </select>
                            <div class="pointer-events-none absolute inset-y-0 right-0 flex items-center px-2 text-gray-700">
                                <svg class="fill-current h-4 w-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20"><path d="M9.293 12.95l.707.707L15.657 8l-1.414-1.414L10 10.828 5.757 6.586 4.343 8z"/></svg>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="md:flex md:items-center mb-6 text-gray-700 uppercase font-bold">
                    <button class="shadow bg-blue-500 hover:bg-blue-400 focus:shadow-outline focus:outline-none text-white font-bold py-2 px-4 rounded" type="submit">Generate</button>
                </div>
            </form>
            <!-- Log on to codeastro.com for more projects -->
        </div>
        <div class="w-full px-6 py-6">
            @foreach ($attendances as $classid => $datevalues)
                <h2 class="bg-gray-600 text-white font-semibold uppercase px-4 py-3">
                    class {{ $classid }}
                </h2>
                <div class="flex flex-col bg-gray-200 mb-6">
                    @foreach ($datevalues as $key => $attendancevals)
                        <div class="text-left text-gray-800 py-2 px-4 font-semibold">
                            <b><span >{{ $key }}</span></b>
                            <div class="flex flex-col justify-between bg-gray-100">
                                @foreach ($attendancevals as $vals => $attendance)
                                    <div class="flex flex-row justify-between w-64">
                                        <div class="text-sm text-left text-gray-600 py-2 px-4 font-semibold">{{ $attendance->student->user->name ?? 'N/A' }}</div>
                                        <div class="text-sm text-left text-gray-600 py-2 px-4 font-semibold">
                                            @if ($attendance->attendence_status)
                                                <span class="text-xs text-white bg-green-500 px-2 py-1 rounded-custom">P</span>
                                            @else
                                                <span class="text-xs text-white bg-red-500 px-2 py-1 rounded-custom">A</span>
                                            @endif
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    @endforeach
                </div>
            @endforeach
        </div>
        <!-- Log on to codeastro.com for more projects -->
    </div>
@endsection --}}


@extends('layouts.app')

@section('content')
    <div class="min-h-screen bg-gradient-to-br from-blue-50 to-indigo-100 py-6">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">

            <!-- Header Section -->
            <div class="flex flex-col sm:flex-row items-start sm:items-center justify-between mb-8">
                <div class="mb-4 sm:mb-0">
                    <h1 class="text-3xl font-bold text-gray-900 mb-2">Attendance Report</h1>
                    <p class="text-gray-600">Monitor and track student attendance across all classes</p>
                </div>
                <div class="flex items-center space-x-3">
                    <a href="{{ route('home') }}"
                       class="inline-flex items-center px-4 py-2 bg-white border border-gray-300 rounded-lg shadow-sm text-sm font-medium text-gray-700 hover:bg-gray-50 hover:border-gray-400 transition-all duration-200">
                        <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"/>
                        </svg>
                        Back to Dashboard
                    </a>
                </div>
            </div>

            <!-- Filter Section -->
            <div class="bg-white rounded-xl shadow-lg mb-8 overflow-hidden">
                <div class="bg-gradient-to-r from-blue-600 to-indigo-600 px-6 py-4">
                    <h3 class="text-lg font-semibold text-white flex items-center">
                        <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 4a1 1 0 011-1h16a1 1 0 011 1v2.586a1 1 0 01-.293.707l-6.414 6.414a1 1 0 00-.293.707V17l-4 4v-6.586a1 1 0 00-.293-.707L3.293 7.293A1 1 0 013 6.586V4z"/>
                        </svg>
                        Filter Options
                    </h3>
                </div>

                <form action="{{ route('attendance.index') }}" method="GET" class="p-6">
                    <div class="grid grid-cols-1 md:grid-cols-3 gap-6 items-end">

                        <!-- Report Type -->
                        <div class="space-y-2">
                            <label class="block text-sm font-medium text-gray-700">Report Type</label>
                            <div class="flex items-center space-x-4">
                                <label class="inline-flex items-center">
                                    <input name="type" type="radio" value="class" checked
                                           class="form-radio h-4 w-4 text-blue-600 border-gray-300 focus:ring-blue-500">
                                    <span class="ml-2 text-sm text-gray-700">By Class</span>
                                </label>
                                <label class="inline-flex items-center">
                                    <input name="type" type="radio" value="student"
                                           class="form-radio h-4 w-4 text-blue-600 border-gray-300 focus:ring-blue-500">
                                    <span class="ml-2 text-sm text-gray-700">By Student</span>
                                </label>
                            </div>
                        </div>

                        <!-- Month Selection -->
                        <div class="space-y-2">
                            <label class="block text-sm font-medium text-gray-700">Select Month</label>
                            <div class="relative">
                                <select name="month"
                                        class="block w-full pl-3 pr-10 py-3 text-base border border-gray-300 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500 rounded-lg bg-white">
                                    <option value="">-- Select Month --</option>
                                    @foreach ($months as $month => $values)
                                        <option value="{{ $month }}" {{ request('month') == $month ? 'selected' : '' }}>
                                            {{ $month }}
                                        </option>
                                    @endforeach
                                </select>
                                <div class="absolute inset-y-0 right-0 flex items-center px-2 pointer-events-none">
                                    <svg class="w-5 h-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"/>
                                    </svg>
                                </div>
                            </div>
                        </div>

                        <!-- Generate Button -->
                        <div>
                            <button type="submit"
                                    class="w-full inline-flex items-center justify-center px-6 py-3 border border-transparent text-base font-medium rounded-lg text-white bg-gradient-to-r from-blue-600 to-indigo-600 hover:from-blue-700 hover:to-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500 transition-all duration-200 shadow-lg hover:shadow-xl">
                                <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z"/>
                                </svg>
                                Generate Report
                            </button>
                        </div>
                    </div>
                </form>
            </div>

            <!-- Results Section -->
            @if(count($attendances) > 0)
                <div class="space-y-6">
                    @foreach ($attendances as $classid => $datevalues)
                        <div class="bg-white rounded-xl shadow-lg overflow-hidden">

                            <!-- Class Header -->
                            <div class="bg-gradient-to-r from-gray-700 to-gray-800 px-6 py-4">
                                <div class="flex items-center justify-between">
                                    <h2 class="text-xl font-bold text-white flex items-center">
                                        <svg class="w-6 h-6 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.746 0 3.332.477 4.5 1.253v13C19.832 18.477 18.246 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"/>
                                        </svg>
                                        Class {{ $classid }}
                                    </h2>
                                    <div class="flex items-center space-x-2">
                                        @php
                                            $totalStudents = 0;
                                            $totalPresent = 0;
                                            foreach($datevalues as $attendancevals) {
                                                foreach($attendancevals as $attendance) {
                                                    $totalStudents++;
                                                    if($attendance->attendence_status) $totalPresent++;
                                                }
                                            }
                                            $attendanceRate = $totalStudents > 0 ? round(($totalPresent / $totalStudents) * 100, 1) : 0;
                                        @endphp
                                        <span class="text-sm text-gray-200">Overall Rate:</span>
                                        <span class="inline-flex items-center px-3 py-1 rounded-full text-sm font-medium
                                            {{ $attendanceRate >= 80 ? 'bg-green-100 text-green-800' : ($attendanceRate >= 60 ? 'bg-yellow-100 text-yellow-800' : 'bg-red-100 text-red-800') }}">
                                            {{ $attendanceRate }}%
                                        </span>
                                    </div>
                                </div>
                            </div>

                            <!-- Attendance Data -->
                            <div class="divide-y divide-gray-200">
                                @foreach ($datevalues as $key => $attendancevals)
                                    <div class="p-6">
                                        <div class="flex items-center justify-between mb-4">
                                            <h3 class="text-lg font-semibold text-gray-900 flex items-center">
                                                <svg class="w-5 h-5 mr-2 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                                                </svg>
                                                {{ $key }}
                                            </h3>
                                            @php
                                                $dayPresent = collect($attendancevals)->where('attendence_status', true)->count();
                                                $dayTotal = count($attendancevals);
                                                $dayRate = $dayTotal > 0 ? round(($dayPresent / $dayTotal) * 100, 1) : 0;
                                            @endphp
                                            <span class="text-sm text-gray-600">
                                                {{ $dayPresent }}/{{ $dayTotal }} Present ({{ $dayRate }}%)
                                            </span>
                                        </div>

                                        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-3">
                                            @foreach ($attendancevals as $vals => $attendance)
                                                <div class="flex items-center justify-between p-3 bg-gray-50 rounded-lg hover:bg-gray-100 transition-colors duration-200">
                                                    <div class="flex items-center space-x-3">
                                                        <div class="flex-shrink-0">
                                                            <div class="w-8 h-8 bg-gradient-to-br from-blue-400 to-blue-600 rounded-full flex items-center justify-center">
                                                                <span class="text-xs font-bold text-white">
                                                                    {{ strtoupper(substr($attendance->student->user->name ?? 'N', 0, 1)) }}
                                                                </span>
                                                            </div>
                                                        </div>
                                                        <div class="min-w-0 flex-1">
                                                            <p class="text-sm font-medium text-gray-900 truncate">
                                                                {{ $attendance->student->user->name ?? 'N/A' }}
                                                            </p>
                                                        </div>
                                                    </div>
                                                    <div class="flex-shrink-0">
                                                        @if ($attendance->attendence_status)
                                                            <span class="inline-flex items-center px-2.5 py-1.5 rounded-full text-xs font-medium bg-green-100 text-green-800 border border-green-200">
                                                                <svg class="w-3 h-3 mr-1" fill="currentColor" viewBox="0 0 20 20">
                                                                    <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd"/>
                                                                </svg>
                                                                Present
                                                            </span>
                                                        @else
                                                            <span class="inline-flex items-center px-2.5 py-1.5 rounded-full text-xs font-medium bg-red-100 text-red-800 border border-red-200">
                                                                <svg class="w-3 h-3 mr-1" fill="currentColor" viewBox="0 0 20 20">
                                                                    <path fill-rule="evenodd" d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z" clip-rule="evenodd"/>
                                                                </svg>
                                                                Absent
                                                            </span>
                                                        @endif
                                                    </div>
                                                </div>
                                            @endforeach
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    @endforeach
                </div>
            @else
                <!-- Empty State -->
                <div class="bg-white rounded-xl shadow-lg p-12 text-center">
                    <svg class="mx-auto h-12 w-12 text-gray-400 mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/>
                    </svg>
                    <h3 class="text-lg font-medium text-gray-900 mb-2">No Attendance Data Found</h3>
                    <p class="text-gray-600 mb-6">Select a month and generate a report to view attendance data.</p>
                    <button onclick="document.querySelector('select[name=month]').focus()"
                            class="inline-flex items-center px-4 py-2 border border-transparent text-sm font-medium rounded-lg text-blue-600 bg-blue-100 hover:bg-blue-200 transition-colors duration-200">
                        Select Month to Get Started
                    </button>
                </div>
            @endif

            <!-- Export Options -->
            @if(count($attendances) > 0)
                <div class="bg-white rounded-xl shadow-lg p-6 mt-6">
                    <h3 class="text-lg font-semibold text-gray-900 mb-4 flex items-center">
                        <svg class="w-5 h-5 mr-2 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 10v6m0 0l-3-3m3 3l3-3m2 8H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/>
                        </svg>
                        Export Options
                    </h3>
                    <div class="flex flex-wrap gap-3">
                        <button class="inline-flex items-center px-4 py-2 border border-gray-300 rounded-lg text-sm font-medium text-gray-700 bg-white hover:bg-gray-50 transition-colors duration-200">
                            <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 21h10a2 2 0 002-2V9.414a1 1 0 00-.293-.707l-5.414-5.414A1 1 0 0012.586 3H7a2 2 0 00-2 2v14a2 2 0 002 2z"/>
                            </svg>
                            Export to PDF
                        </button>
                        <button class="inline-flex items-center px-4 py-2 border border-gray-300 rounded-lg text-sm font-medium text-gray-700 bg-white hover:bg-gray-50 transition-colors duration-200">
                            <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 17v-2m3 2v-4m3 4v-6m2 10H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/>
                            </svg>
                            Export to Excel
                        </button>
                        <button onclick="window.print()" class="inline-flex items-center px-4 py-2 border border-gray-300 rounded-lg text-sm font-medium text-gray-700 bg-white hover:bg-gray-50 transition-colors duration-200">
                            <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 17h2a2 2 0 002-2v-4a2 2 0 00-2-2H5a2 2 0 00-2 2v4a2 2 0 002 2h2m2 4h6a2 2 0 002-2v-4a2 2 0 00-2-2H9a2 2 0 00-2 2v4a2 2 0 002 2zm8-12V5a2 2 0 00-2-2H9a2 2 0 00-2 2v4h10z"/>
                            </svg>
                            Print Report
                        </button>
                    </div>
                </div>
            @endif
        </div>
    </div>

    <!-- Print Styles -->
    <style>
        @media print {
            .no-print { display: none !important; }
            body { font-size: 12px; }
            .bg-gradient-to-br { background: white !important; }
            .shadow-lg { box-shadow: none !important; }
        }
    </style>
@endsection
