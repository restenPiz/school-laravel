@extends('layouts.app')

@section('content')
<link href="https://cdn.jsdelivr.net/npm/flowbite@3.1.2/dist/flowbite.min.css" rel="stylesheet" />
<link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" rel="stylesheet" />

<div class="min-h-screen bg-gradient-to-br from-blue-50 via-white to-indigo-50 py-8">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">

        <!-- Header Section -->
        <div class="mb-8">
            <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between">
                <div class="mb-4 sm:mb-0">
                    <h1 class="text-3xl font-bold text-gray-900 mb-2">
                        <i class="fas fa-book-open text-blue-600 mr-3"></i>
                        My Subjects
                    </h1>
                    <p class="text-gray-600">
                        Access your course materials and manage your files
                    </p>
                </div>

                <!-- Stats/Info Card -->
                <div class="bg-white rounded-lg shadow-sm border border-gray-200 p-4 min-w-fit">
                    <div class="flex items-center space-x-3">
                        <div class="bg-blue-100 rounded-full p-2">
                            <i class="fas fa-graduation-cap text-blue-600"></i>
                        </div>
                        <div>
                            <p class="text-sm text-gray-500">Total Subjects</p>
                            <p class="text-xl font-semibold text-gray-900">{{ count($student->class->subjects) }}</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Subjects Grid -->
        @if(count($student->class->subjects) > 0)
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-6">
                @foreach ($student->class->subjects as $subject)
                    <div class="group bg-white rounded-xl shadow-sm hover:shadow-lg transition-all duration-300 border border-gray-200 hover:border-blue-300 overflow-hidden">

                        <!-- Subject Header -->
                        <div class="bg-gradient-to-r from-blue-600 to-indigo-600 px-6 py-4">
                            <div class="flex items-center justify-between">
                                <h3 class="text-white font-semibold text-lg truncate">
                                    {{ $subject->name }}
                                </h3>
                                <div class="bg-white/20 rounded-full p-2">
                                    <i class="fas fa-book text-white text-sm"></i>
                                </div>
                            </div>
                        </div>

                        <!-- Subject Body -->
                        <div class="p-6">

                            <!-- Subject Info -->
                            <div class="mb-4">
                                <div class="flex items-center text-sm text-gray-600 mb-2">
                                    <i class="fas fa-tag mr-2"></i>
                                    <span>Subject Code: {{ $subject->code ?? 'N/A' }}</span>
                                </div>
                                <div class="flex items-center text-sm text-gray-600">
                                    <i class="fas fa-folder mr-2"></i>
                                    <span>Files Available</span>
                                </div>
                            </div>

                            <!-- Action Button -->
                            <a href="{{ route('studentFiles', $subject->id) }}"
                               class="w-full inline-flex items-center justify-center px-4 py-3 bg-green-600 hover:bg-green-700 text-white font-medium rounded-lg transition-colors duration-200 group-hover:scale-105 transform">
                                <i class="fas fa-folder-open mr-2"></i>
                                Manage Files
                                <i class="fas fa-arrow-right ml-2 group-hover:translate-x-1 transition-transform duration-200"></i>
                            </a>
                        </div>

                        <!-- Hover Effect Indicator -->
                        <div class="absolute top-0 left-0 w-full h-1 bg-gradient-to-r from-blue-500 to-indigo-500 transform scale-x-0 group-hover:scale-x-100 transition-transform duration-300"></div>
                    </div>
                @endforeach
            </div>
        @else
            <!-- Empty State -->
            <div class="text-center py-16">
                <div class="bg-gray-100 rounded-full w-24 h-24 flex items-center justify-center mx-auto mb-6">
                    <i class="fas fa-book-open text-gray-400 text-3xl"></i>
                </div>
                <h3 class="text-xl font-medium text-gray-900 mb-2">No Subjects Available</h3>
                <p class="text-gray-600 mb-6">You don't have any subjects assigned to your class yet.</p>
                <button class="bg-blue-600 hover:bg-blue-700 text-white px-6 py-3 rounded-lg font-medium transition-colors duration-200">
                    <i class="fas fa-plus mr-2"></i>
                    Contact Administrator
                </button>
            </div>
        @endif

    </div>
</div>

<!-- Add some custom CSS for enhanced animations -->
<style>
    .group:hover .group-hover\:scale-105 {
        transform: scale(1.02);
    }

    .group:hover .group-hover\:translate-x-1 {
        transform: translateX(0.25rem);
    }

    /* Custom scrollbar for better UX */
    ::-webkit-scrollbar {
        width: 8px;
    }

    ::-webkit-scrollbar-track {
        background: #f1f5f9;
    }

    ::-webkit-scrollbar-thumb {
        background: #cbd5e1;
        border-radius: 4px;
    }

    ::-webkit-scrollbar-thumb:hover {
        background: #94a3b8;
    }
</style>

@endsection
