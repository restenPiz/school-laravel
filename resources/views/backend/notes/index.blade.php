@extends('layouts.app')

@section('content')
<div class="min-h-screen bg-gradient-to-br from-blue-50 to-indigo-100 p-6">
    <div class="max-w-7xl mx-auto">
        <!-- Header Section -->
        <div class="mb-8">
            <div class="flex items-center space-x-3 mb-2">
                <div class="p-2 bg-blue-600 rounded-lg">
                    <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.746 0 3.332.477 4.5 1.253v13C19.832 18.477 18.246 18 16.5 18c-1.746 0-3.332.477-4.5 1.253z"></path>
                    </svg>
                </div>
                <h1 class="text-3xl font-bold text-gray-800">Student Notes Search</h1>
            </div>
            <p class="text-gray-600">Find and manage student academic records efficiently</p>
        </div>

        <!-- Search Form Card -->
        <div class="bg-white rounded-2xl shadow-xl p-8 mb-8 border border-gray-100">
            <form action="{{route('filterNote')}}" method="GET" class="space-y-6">
                @csrf
                <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
                    <!-- Course Selection -->
                    <div class="space-y-2">
                        <label for="class-select" class="block text-sm font-semibold text-gray-700 mb-2">
                            Select Course
                        </label>
                        <div class="relative">
                            <select id="class-select" name="class_id"
                                class="w-full px-4 py-3 bg-gray-50 border-2 border-gray-200 rounded-xl text-gray-700 focus:outline-none focus:ring-4 focus:ring-blue-100 focus:border-blue-500 transition-all duration-200 appearance-none">
                                <option value="">Choose a course...</option>
                                @foreach ($classes as $class)
                                    <option value="{{ $class->id }}">{{ $class->class_name }}</option>
                                @endforeach
                            </select>
                            <div class="absolute inset-y-0 right-0 flex items-center px-3 text-gray-400 pointer-events-none">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path>
                                </svg>
                            </div>
                        </div>
                    </div>

                    <!-- Student Selection -->
                    <div class="space-y-2">
                        <label for="student-select" class="block text-sm font-semibold text-gray-700 mb-2">
                            Select Student
                        </label>
                        <div class="relative">
                            <select id="student-select" name="student_id"
                                class="w-full px-4 py-3 bg-gray-50 border-2 border-gray-200 rounded-xl text-gray-700 focus:outline-none focus:ring-4 focus:ring-blue-100 focus:border-blue-500 transition-all duration-200 appearance-none disabled:opacity-50 disabled:cursor-not-allowed"
                                disabled>
                                <option value="">Choose a student...</option>
                            </select>
                            <div class="absolute inset-y-0 right-0 flex items-center px-3 text-gray-400 pointer-events-none">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path>
                                </svg>
                            </div>
                        </div>
                    </div>

                    <!-- Search Button -->
                    <div class="flex items-end">
                        <button id="search-btn" type="button"
                            class="w-full px-6 py-3 bg-gradient-to-r from-blue-600 to-blue-700 hover:from-blue-700 hover:to-blue-800 text-white font-semibold rounded-xl shadow-lg hover:shadow-xl transform hover:-translate-y-0.5 transition-all duration-200 focus:outline-none focus:ring-4 focus:ring-blue-200 disabled:opacity-50 disabled:cursor-not-allowed disabled:transform-none">
                            <div class="flex items-center justify-center space-x-2">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path>
                                </svg>
                                <span>Search Students</span>
                            </div>
                        </button>
                    </div>
                </div>
            </form>
        </div>

        <!-- Loading Indicator -->
        <div id="loading-indicator" class="hidden bg-white rounded-2xl shadow-xl p-8 mb-8">
            <div class="flex items-center justify-center space-x-3">
                <div class="animate-spin rounded-full h-8 w-8 border-4 border-blue-600 border-t-transparent"></div>
                <span class="text-gray-600 font-medium">Searching students...</span>
            </div>
        </div>

        <!-- Results Section -->
        <div class="bg-white rounded-2xl shadow-xl overflow-hidden border border-gray-100" id="results-container">
            <!-- Table Header -->
            <div class="bg-gradient-to-r from-blue-800 to-gray-900 text-white px-6 py-4">
                <h2 class="text-xl font-semibold flex items-center space-x-2">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"></path>
                    </svg>
                    <span>Student Records</span>
                </h2>
            </div>

            <!-- Table Content -->
            <div id="table-content">
                <!-- Desktop Table -->
                <div class="hidden md:block">
                    <div class="grid grid-cols-12 gap-4 items-center bg-gray-50 px-6 py-4 font-semibold text-gray-700 text-sm uppercase tracking-wide border-b">
                        <div class="col-span-3">Student Name</div>
                        <div class="col-span-2">Class</div>
                        <div class="col-span-3">Parent Name</div>
                        <div class="col-span-2">Date of Birth</div>
                        <div class="col-span-2">Actions</div>
                    </div>

                    <div id="table-body">
                        @foreach ($students as $student)
                            <div class="grid grid-cols-12 gap-4 items-center px-6 py-4 hover:bg-gray-50 transition-colors duration-150 border-b border-gray-100">
                                <div class="col-span-3">
                                    <div class="flex items-center space-x-3">
                                        <div class="w-10 h-10 bg-gradient-to-br from-blue-400 to-blue-600 rounded-full flex items-center justify-center text-white font-semibold text-sm">
                                            {{ substr($student->user->name, 0, 1) }}
                                        </div>
                                        <div>
                                            <p class="font-semibold text-gray-800">{{ $student->user->name }}</p>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-span-2">
                                    <span class="inline-flex items-center px-3 py-1 rounded-full text-xs font-medium bg-green-100 text-green-800">
                                        {{ $student->class->class_name }}
                                    </span>
                                </div>
                                <div class="col-span-3">
                                    <p class="text-gray-700 font-medium">{{ $student->parent->user->name }}</p>
                                </div>
                                <div class="col-span-2">
                                    <p class="text-gray-600">{{ date('M d, Y', strtotime($student->dateofbirth)) }}</p>
                                </div>
                                <div class="col-span-2">
                                    <a href="{{ route('notes.create', ['id' => $student->id]) }}"
                                       class="inline-flex items-center px-4 py-2 bg-blue-600 hover:bg-blue-700 text-white text-sm font-medium rounded-lg transition-colors duration-200 shadow-md hover:shadow-lg"
                                       title="Assign Subject">
                                        <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"></path>
                                        </svg>
                                        Assign
                                    </a>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>

                <!-- Mobile Cards -->
                <div class="md:hidden" id="mobile-cards">
                    @foreach ($students as $student)
                        <div class="p-6 border-b border-gray-100 hover:bg-gray-50 transition-colors duration-150">
                            <div class="flex items-start space-x-4">
                                <div class="w-12 h-12 bg-gradient-to-br from-blue-400 to-blue-600 rounded-full flex items-center justify-center text-white font-semibold">
                                    {{ substr($student->user->name, 0, 1) }}
                                </div>
                                <div class="flex-1 min-w-0">
                                    <h3 class="font-semibold text-gray-800 mb-1">{{ $student->user->name }}</h3>
                                    <div class="space-y-2 text-sm text-gray-600">
                                        <div class="flex items-center space-x-2">
                                            <span class="font-medium">Class:</span>
                                            <span class="inline-flex items-center px-2 py-1 rounded-full text-xs font-medium bg-green-100 text-green-800">
                                                {{ $student->class->class_name }}
                                            </span>
                                        </div>
                                        <div><span class="font-medium">Parent:</span> {{ $student->parent->user->name }}</div>
                                        <div><span class="font-medium">DOB:</span> {{ date('M d, Y', strtotime($student->dateofbirth)) }}</div>
                                    </div>
                                    <div class="mt-4">
                                        <a href="{{ route('notes.create', ['id' => $student->id]) }}"
                                           class="inline-flex items-center px-4 py-2 bg-blue-600 hover:bg-blue-700 text-white text-sm font-medium rounded-lg transition-colors duration-200"
                                           title="Assign Subject">
                                            <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"></path>
                                            </svg>
                                            Assign Subject
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>

                <!-- Empty State -->
                <div id="empty-state" class="hidden p-12 text-center">
                    <div class="mx-auto w-24 h-24 bg-gray-100 rounded-full flex items-center justify-center mb-4">
                        <svg class="w-12 h-12 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"></path>
                        </svg>
                    </div>
                    <h3 class="text-lg font-semibold text-gray-700 mb-2">No students found</h3>
                    <p class="text-gray-500">Try adjusting your search criteria</p>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
document.addEventListener("DOMContentLoaded", function() {
    const classSelect = document.getElementById("class-select");
    const studentSelect = document.getElementById("student-select");
    const searchBtn = document.getElementById("search-btn");
    const loadingIndicator = document.getElementById("loading-indicator");
    const tableBody = document.getElementById("table-body");
    const mobileCards = document.getElementById("mobile-cards");
    const emptyState = document.getElementById("empty-state");

    // Enable/disable search button based on selections
    function updateSearchButton() {
        const hasClass = classSelect.value !== "";
        searchBtn.disabled = !hasClass;
    }

    // Load students by class
    classSelect.addEventListener("change", function() {
        const classId = this.value;

        if (classId) {
            studentSelect.innerHTML = '<option value="">Loading students...</option>';
            studentSelect.disabled = true;

            fetch(`/get-students-by-class/${classId}`)
                .then(response => response.json())
                .then(data => {
                    studentSelect.innerHTML = '<option value="">All students</option>';
                    data.students.forEach(student => {
                        studentSelect.innerHTML += `<option value="${student.id}">${student.name}</option>`;
                    });
                    studentSelect.disabled = false;
                })
                .catch(error => {
                    console.error("Error loading students:", error);
                    studentSelect.innerHTML = '<option value="">Error loading students</option>';
                });
        } else {
            studentSelect.innerHTML = '<option value="">Choose a student...</option>';
            studentSelect.disabled = true;
        }

        updateSearchButton();
    });

    // Search functionality
    searchBtn.addEventListener("click", function() {
        const classId = classSelect.value;
        const studentId = studentSelect.value;

        if (!classId) return;

        // Show loading
        loadingIndicator.classList.remove("hidden");
        emptyState.classList.add("hidden");

        fetch(`/filter-note?class_id=${classId}&student_id=${studentId}`)
            .then(response => response.json())
            .then(data => {
                loadingIndicator.classList.add("hidden");

                if (data.students && data.students.length > 0) {
                    updateStudentDisplay(data.students);
                } else {
                    showEmptyState();
                }
            })
            .catch(error => {
                console.error("Error searching students:", error);
                loadingIndicator.classList.add("hidden");
                showEmptyState();
            });
    });

    function updateStudentDisplay(students) {
        // Update desktop table
        tableBody.innerHTML = "";
        students.forEach(student => {
            const studentRow = createStudentRow(student);
            tableBody.appendChild(studentRow);
        });

        // Update mobile cards
        mobileCards.innerHTML = "";
        students.forEach(student => {
            const studentCard = createStudentCard(student);
            mobileCards.appendChild(studentCard);
        });
    }

    function createStudentRow(student) {
        const row = document.createElement("div");
        row.className = "grid grid-cols-12 gap-4 items-center px-6 py-4 hover:bg-gray-50 transition-colors duration-150 border-b border-gray-100";

        const initials = student.user.name.charAt(0).toUpperCase();
        const formattedDate = new Date(student.dateofbirth).toLocaleDateString('en-US', {
            year: 'numeric',
            month: 'short',
            day: 'numeric'
        });

        row.innerHTML = `
            <div class="col-span-3">
                <div class="flex items-center space-x-3">
                    <div class="w-10 h-10 bg-gradient-to-br from-blue-400 to-blue-600 rounded-full flex items-center justify-center text-white font-semibold text-sm">
                        ${initials}
                    </div>
                    <div>
                        <p class="font-semibold text-gray-800">${student.user.name}</p>
                    </div>
                </div>
            </div>
            <div class="col-span-2">
                <span class="inline-flex items-center px-3 py-1 rounded-full text-xs font-medium bg-green-100 text-green-800">
                    ${student.class.class_name}
                </span>
            </div>
            <div class="col-span-3">
                <p class="text-gray-700 font-medium">${student.parent.user.name}</p>
            </div>
            <div class="col-span-2">
                <p class="text-gray-600">${formattedDate}</p>
            </div>
            <div class="col-span-2">
                <a href="/notes/create/${student.id}"
                   class="inline-flex items-center px-4 py-2 bg-blue-600 hover:bg-blue-700 text-white text-sm font-medium rounded-lg transition-colors duration-200 shadow-md hover:shadow-lg"
                   title="Assign Subject">
                    <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"></path>
                    </svg>
                    Assign
                </a>
            </div>
        `;

        return row;
    }

    function createStudentCard(student) {
        const card = document.createElement("div");
        card.className = "p-6 border-b border-gray-100 hover:bg-gray-50 transition-colors duration-150";

        const initials = student.user.name.charAt(0).toUpperCase();
        const formattedDate = new Date(student.dateofbirth).toLocaleDateString('en-US', {
            year: 'numeric',
            month: 'short',
            day: 'numeric'
        });

        card.innerHTML = `
            <div class="flex items-start space-x-4">
                <div class="w-12 h-12 bg-gradient-to-br from-blue-400 to-blue-600 rounded-full flex items-center justify-center text-white font-semibold">
                    ${initials}
                </div>
                <div class="flex-1 min-w-0">
                    <h3 class="font-semibold text-gray-800 mb-1">${student.user.name}</h3>
                    <div class="space-y-2 text-sm text-gray-600">
                        <div class="flex items-center space-x-2">
                            <span class="font-medium">Class:</span>
                            <span class="inline-flex items-center px-2 py-1 rounded-full text-xs font-medium bg-green-100 text-green-800">
                                ${student.class.class_name}
                            </span>
                        </div>
                        <div><span class="font-medium">Parent:</span> ${student.parent.user.name}</div>
                        <div><span class="font-medium">DOB:</span> ${formattedDate}</div>
                    </div>
                    <div class="mt-4">
                        <a href="/notes/create/${student.id}"
                           class="inline-flex items-center px-4 py-2 bg-blue-600 hover:bg-blue-700 text-white text-sm font-medium rounded-lg transition-colors duration-200"
                           title="Assign Subject">
                            <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"></path>
                            </svg>
                            Assign Subject
                        </a>
                    </div>
                </div>
            </div>
        `;

        return card;
    }

    function showEmptyState() {
        tableBody.innerHTML = "";
        mobileCards.innerHTML = "";
        emptyState.classList.remove("hidden");
    }

    // Initialize
    updateSearchButton();
});
</script>
@endsection
