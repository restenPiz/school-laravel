@extends('layouts.app')
@section('content')
    <div class="min-h-screen bg-gradient-to-br from-gray-50 to-gray-100 p-6">
        <div class="max-w-7xl mx-auto">
            <!-- Header Section -->
            <div class="bg-white rounded-xl shadow-sm border border-gray-200 p-6 mb-6">
                <div class="flex flex-col sm:flex-row items-start sm:items-center justify-between gap-4">
                    <div class="flex items-center space-x-4">
                        <div class="w-12 h-12 bg-gradient-to-br from-blue-500 to-blue-600 rounded-xl flex items-center justify-center">
                            <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path>
                            </svg>
                        </div>
                        <div>
                            <h1 class="text-2xl font-bold text-gray-900">{{$student->user->name}}</h1>
                            <p class="text-sm text-gray-500">Academic Performance Report</p>
                        </div>
                    </div>

                    <div class="flex flex-wrap items-center gap-3">
                        <button onclick="printSelectedSections(['notes'])" class="inline-flex items-center px-4 py-2 bg-blue-600 hover:bg-blue-700 text-white text-sm font-medium rounded-lg transition-colors duration-200 shadow-sm">
                            <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 17h2a2 2 0 002-2v-4a2 2 0 00-2-2H5a2 2 0 00-2 2v4a2 2 0 002 2h2m2 4h6a2 2 0 002-2v-4a2 2 0 00-2-2H9a2 2 0 00-2 2v4a2 2 0 002 2zm8-12V5a2 2 0 00-2-2H9a2 2 0 00-2 2v4h10z"></path>
                            </svg>
                            Print Report
                        </button>

                        <a href="{{ route('home') }}" class="inline-flex items-center px-4 py-2 bg-gray-600 hover:bg-gray-700 text-white text-sm font-medium rounded-lg transition-colors duration-200 shadow-sm">
                            <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path>
                            </svg>
                            Back to Home
                        </a>
                    </div>
                </div>
            </div>

            <!-- Notes Section -->
            <div class="bg-white rounded-xl shadow-sm border border-gray-200 overflow-hidden" id="notes">
                @if (empty($studentNotesBySubject))
                    <div class="text-center py-16">
                        <div class="w-16 h-16 bg-gray-100 rounded-full flex items-center justify-center mx-auto mb-4">
                            <svg class="w-8 h-8 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path>
                            </svg>
                        </div>
                        <h3 class="text-lg font-medium text-gray-900 mb-2">No Notes Available</h3>
                        <p class="text-gray-500">There are currently no academic records for this student.</p>
                    </div>
                @else
                    <!-- Desktop Table View -->
                    <div class="hidden lg:block">
                        <div class="bg-gradient-to-r from-gray-50 to-gray-100 px-6 py-4 border-b border-gray-200">
                            <div class="grid grid-cols-12 gap-4 text-xs font-semibold text-gray-600 uppercase tracking-wider">
                                <div class="col-span-3">Subject</div>
                                <div class="col-span-2 text-center">1st Evaluation</div>
                                <div class="col-span-2 text-center">2nd Evaluation</div>
                                <div class="col-span-2 text-center">3rd Evaluation</div>
                                <div class="col-span-1 text-center">Work</div>
                                <div class="col-span-2 text-center">Status</div>
                            </div>
                        </div>

                        <div class="divide-y divide-gray-200">
                            @foreach ($studentNotesBySubject as $subjectId => $notes)
                                @php
                                    $validNotes = array_filter([$notes['first'], $notes['second'], $notes['third'], $notes['work'], $notes['exam']]);
                                    $average = !empty($validNotes) ? array_sum($validNotes) / count($validNotes) : 0;
                                    $status = $average < 10 ? 'Failed' : 'Passed';
                                    $statusColor = $average < 10 ? 'bg-red-100 text-red-800' : 'bg-green-100 text-green-800';
                                @endphp
                                <div class="px-6 py-4 hover:bg-gray-50 transition-colors duration-150">
                                    <div class="grid grid-cols-12 gap-4 items-center">
                                        <div class="col-span-3">
                                            <div class="font-medium text-gray-900">{{ $notes['subject_name'] }}</div>
                                        </div>
                                        <div class="col-span-2 text-center">
                                            <span class="inline-flex items-center justify-center w-10 h-10 rounded-full {{ $notes['first'] ? ($notes['first'] >= 10 ? 'bg-green-100 text-green-800' : 'bg-red-100 text-red-800') : 'bg-gray-100 text-gray-500' }} text-sm font-medium">
                                                {{ $notes['first'] ?? '—' }}
                                            </span>
                                        </div>
                                        <div class="col-span-2 text-center">
                                            <span class="inline-flex items-center justify-center w-10 h-10 rounded-full {{ $notes['second'] ? ($notes['second'] >= 10 ? 'bg-green-100 text-green-800' : 'bg-red-100 text-red-800') : 'bg-gray-100 text-gray-500' }} text-sm font-medium">
                                                {{ $notes['second'] ?? '—' }}
                                            </span>
                                        </div>
                                        <div class="col-span-2 text-center">
                                            <span class="inline-flex items-center justify-center w-10 h-10 rounded-full {{ $notes['third'] ? ($notes['third'] >= 10 ? 'bg-green-100 text-green-800' : 'bg-red-100 text-red-800') : 'bg-gray-100 text-gray-500' }} text-sm font-medium">
                                                {{ $notes['third'] ?? '—' }}
                                            </span>
                                        </div>
                                        <div class="col-span-1 text-center">
                                            <span class="inline-flex items-center justify-center w-10 h-10 rounded-full {{ $notes['work'] ? ($notes['work'] >= 10 ? 'bg-green-100 text-green-800' : 'bg-red-100 text-red-800') : 'bg-gray-100 text-gray-500' }} text-sm font-medium">
                                                {{ $notes['work'] ?? '—' }}
                                            </span>
                                        </div>
                                        <div class="col-span-2 text-center">
                                            <div class="flex flex-col items-center space-y-1">
                                                <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium {{ $statusColor }}">
                                                    {{ $status }}
                                                </span>
                                                <span class="text-sm font-semibold text-gray-700">
                                                    {{ number_format($average, 1) }}
                                                </span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>

                    <!-- Mobile Card View -->
                    <div class="lg:hidden space-y-4 p-4">
                        @foreach ($studentNotesBySubject as $subjectId => $notes)
                            @php
                                $validNotes = array_filter([$notes['first'], $notes['second'], $notes['third'], $notes['work'], $notes['exam']]);
                                $average = !empty($validNotes) ? array_sum($validNotes) / count($validNotes) : 0;
                                $status = $average < 10 ? 'Failed' : 'Passed';
                                $statusColor = $average < 10 ? 'bg-red-100 text-red-800' : 'bg-green-100 text-green-800';
                            @endphp
                            <div class="bg-white border border-gray-200 rounded-lg p-4 shadow-sm">
                                <div class="flex items-center justify-between mb-3">
                                    <h3 class="font-semibold text-gray-900">{{ $notes['subject_name'] }}</h3>
                                    <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium {{ $statusColor }}">
                                        {{ $status }} ({{ number_format($average, 1) }})
                                    </span>
                                </div>

                                <div class="grid grid-cols-4 gap-3">
                                    <div class="text-center">
                                        <div class="text-xs text-gray-500 mb-1">1st</div>
                                        <span class="inline-flex items-center justify-center w-8 h-8 rounded-full {{ $notes['first'] ? ($notes['first'] >= 10 ? 'bg-green-100 text-green-800' : 'bg-red-100 text-red-800') : 'bg-gray-100 text-gray-500' }} text-sm font-medium">
                                            {{ $notes['first'] ?? '—' }}
                                        </span>
                                    </div>
                                    <div class="text-center">
                                        <div class="text-xs text-gray-500 mb-1">2nd</div>
                                        <span class="inline-flex items-center justify-center w-8 h-8 rounded-full {{ $notes['second'] ? ($notes['second'] >= 10 ? 'bg-green-100 text-green-800' : 'bg-red-100 text-red-800') : 'bg-gray-100 text-gray-500' }} text-sm font-medium">
                                            {{ $notes['second'] ?? '—' }}
                                        </span>
                                    </div>
                                    <div class="text-center">
                                        <div class="text-xs text-gray-500 mb-1">3rd</div>
                                        <span class="inline-flex items-center justify-center w-8 h-8 rounded-full {{ $notes['third'] ? ($notes['third'] >= 10 ? 'bg-green-100 text-green-800' : 'bg-red-100 text-red-800') : 'bg-gray-100 text-gray-500' }} text-sm font-medium">
                                            {{ $notes['third'] ?? '—' }}
                                        </span>
                                    </div>
                                    <div class="text-center">
                                        <div class="text-xs text-gray-500 mb-1">Work</div>
                                        <span class="inline-flex items-center justify-center w-8 h-8 rounded-full {{ $notes['work'] ? ($notes['work'] >= 10 ? 'bg-green-100 text-green-800' : 'bg-red-100 text-red-800') : 'bg-gray-100 text-gray-500' }} text-sm font-medium">
                                            {{ $notes['work'] ?? '—' }}
                                        </span>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                @endif
            </div>

            <!-- Summary Statistics (if notes exist) -->
            @if (!empty($studentNotesBySubject))
                @php
                    $totalSubjects = count($studentNotesBySubject);
                    $passedSubjects = 0;
                    $totalAverage = 0;

                    foreach ($studentNotesBySubject as $notes) {
                        $validNotes = array_filter([$notes['first'], $notes['second'], $notes['third'], $notes['work'], $notes['exam']]);
                        $average = !empty($validNotes) ? array_sum($validNotes) / count($validNotes) : 0;
                        $totalAverage += $average;
                        if ($average >= 10) $passedSubjects++;
                    }

                    $overallAverage = $totalSubjects > 0 ? $totalAverage / $totalSubjects : 0;
                @endphp
                <div class="mt-6 grid grid-cols-1 md:grid-cols-3 gap-4">
                    <div class="bg-white rounded-xl shadow-sm border border-gray-200 p-6">
                        <div class="flex items-center">
                            <div class="w-12 h-12 bg-blue-100 rounded-lg flex items-center justify-center">
                                <svg class="w-6 h-6 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z"></path>
                                </svg>
                            </div>
                            <div class="ml-4">
                                <p class="text-sm font-medium text-gray-600">Overall Average</p>
                                <p class="text-2xl font-bold text-gray-900">{{ number_format($overallAverage, 1) }}</p>
                            </div>
                        </div>
                    </div>

                    <div class="bg-white rounded-xl shadow-sm border border-gray-200 p-6">
                        <div class="flex items-center">
                            <div class="w-12 h-12 bg-green-100 rounded-lg flex items-center justify-center">
                                <svg class="w-6 h-6 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                </svg>
                            </div>
                            <div class="ml-4">
                                <p class="text-sm font-medium text-gray-600">Passed Subjects</p>
                                <p class="text-2xl font-bold text-gray-900">{{ $passedSubjects }}/{{ $totalSubjects }}</p>
                            </div>
                        </div>
                    </div>

                    <div class="bg-white rounded-xl shadow-sm border border-gray-200 p-6">
                        <div class="flex items-center">
                            <div class="w-12 h-12 bg-purple-100 rounded-lg flex items-center justify-center">
                                <svg class="w-6 h-6 text-purple-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 7h8m0 0v8m0-8l-8 8-4-4-6 6"></path>
                                </svg>
                            </div>
                            <div class="ml-4">
                                <p class="text-sm font-medium text-gray-600">Success Rate</p>
                                <p class="text-2xl font-bold text-gray-900">{{ $totalSubjects > 0 ? number_format(($passedSubjects / $totalSubjects) * 100, 1) : 0 }}%</p>
                            </div>
                        </div>
                    </div>
                </div>
            @endif
        </div>
    </div>

    <script>
        function printSelectedSections(sectionIds) {
            var printContent = '';
            var studentName = '{{$student->user->name}}';

            // Create a print-friendly header
            var printHeader = `
                <div style="text-align: center; margin-bottom: 30px; border-bottom: 2px solid #333; padding-bottom: 20px;">
                    <h1 style="margin: 0; color: #333; font-size: 24px;">${studentName} - Academic Report</h1>
                    <p style="margin: 5px 0 0 0; color: #666; font-size: 14px;">Generated on ${new Date().toLocaleDateString()}</p>
                </div>
            `;

            // Get content from specified sections
            sectionIds.forEach(function(id) {
                var element = document.getElementById(id);
                if (element) {
                    printContent += element.outerHTML;
                }
            });

            if (printContent) {
                var printWindow = window.open('', '_blank');
                printWindow.document.write(`
                    <html>
                        <head>
                            <title>${studentName} - Academic Report</title>
                            <style>
                                body { font-family: Arial, sans-serif; margin: 20px; }
                                table { width: 100%; border-collapse: collapse; margin-top: 20px; }
                                th, td { border: 1px solid #ddd; padding: 8px; text-align: left; }
                                th { background-color: #f5f5f5; }
                                .status-passed { color: #059669; font-weight: bold; }
                                .status-failed { color: #dc2626; font-weight: bold; }
                                @media print {
                                    body { margin: 0; }
                                    .no-print { display: none; }
                                }
                            </style>
                        </head>
                        <body>
                            ${printHeader}
                            ${printContent}
                        </body>
                    </html>
                `);
                printWindow.document.close();
                printWindow.print();
            } else {
                alert("No content found to print!");
            }
        }
    </script>
@endsection
