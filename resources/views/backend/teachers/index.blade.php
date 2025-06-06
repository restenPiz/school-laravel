{{-- @extends('layouts.app')

@section('content')
    <div class="roles-permissions">
        <div class="flex items-center justify-between mb-6">
            <div>
                <h2 class="text-gray-700 uppercase font-bold">Teacher</h2>
            </div>
            <div class="flex flex-wrap items-center">
                <a href="{{ route('teacher.create') }}" class="bg-green-500 text-white text-sm uppercase py-2 px-4 flex items-center rounded hover:bg-green-600 transition-colors">
                    <svg class="w-3 h-3 fill-current" aria-hidden="true" focusable="false" data-prefix="fas" data-icon="plus" class="svg-inline--fa fa-plus fa-w-14" role="img" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 448 512"><path fill="currentColor" d="M416 208H272V64c0-17.67-14.33-32-32-32h-32c-17.67 0-32 14.33-32 32v144H32c-17.67 0-32 14.33-32 32v32c0 17.67 14.33 32 32 32h144v144c0 17.67 14.33 32 32 32h32c17.67 0 32-14.33 32-32V304h144c17.67 0-32 14.33-32 32v-32c0-17.67-14.33-32-32-32z"></path></svg>
                    <span class="ml-2 text-xs font-semibold">Add New Teacher</span>
                </a>
            </div>
        </div>

        <!-- Filter Section -->
        <div class="bg-white rounded-lg border border-gray-200 mb-6 p-4">
            <div class="flex items-center justify-between mb-4">
                <h3 class="text-lg font-semibold text-gray-700">Filters</h3>
                <button id="toggleFilters" class="text-blue-600 hover:text-blue-800 text-sm font-medium">
                    <span id="filterToggleText">Hide Filters</span>
                    <svg id="filterToggleIcon" class="w-4 h-4 inline-block ml-1 transform transition-transform" fill="currentColor" viewBox="0 0 20 20">
                        <path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd"></path>
                    </svg>
                </button>
            </div>

            <form method="GET" action="{{ route('teacher.index') }}" id="filterForm">
                <div id="filterContent" class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-4">
                    <!-- Search by Name -->
                    <div>
                        <label for="search_name" class="block text-sm font-medium text-gray-700 mb-1">Search Name</label>
                        <input type="text"
                               id="search_name"
                               name="search_name"
                               value="{{ request('search_name') }}"
                               placeholder="Enter teacher name..."
                               class="mt-1 block w-full px-4 py-2 bg-gray-100 border border-gray-300 rounded-md focus:ring-2 focus:ring-blue-500">
                    </div>

                    <!-- Search by Email -->
                    <div>
                        <label for="search_email" class="block text-sm font-medium text-gray-700 mb-1">Search Email</label>
                        <input type="email"
                               id="search_email"
                               name="search_email"
                               value="{{ request('search_email') }}"
                               placeholder="Enter email..."
                               class="mt-1 block w-full px-4 py-2 bg-gray-100 border border-gray-300 rounded-md focus:ring-2 focus:ring-blue-500">
                    </div>

                    <!-- Filter by Subject -->
                    <div>
                        <label for="subject_filter" class="block text-sm font-medium text-gray-700 mb-1">Subject</label>
                        <select id="subject_filter"
                                name="subject_filter"
                                class="mt-1 block w-full px-4 py-2 bg-gray-100 border border-gray-300 rounded-md focus:ring-2 focus:ring-blue-500">
                            <option value="">All Subjects</option>
                            @if(isset($subjects))
                                @foreach($subjects as $subject)
                                    <option value="{{ $subject->id }}" {{ request('subject_filter') == $subject->id ? 'selected' : '' }}>
                                        {{ $subject->subject_code }} - {{ $subject->name }}
                                    </option>
                                @endforeach
                            @endif
                        </select>
                    </div>

                    <!-- Sort by -->
                    <div>
                        <label for="sort_by" class="block text-sm font-medium text-gray-700 mb-1">Sort By</label>
                        <select id="sort_by"
                                name="sort_by"
                                class="mt-1 block w-full px-4 py-2 bg-gray-100 border border-gray-300 rounded-md focus:ring-2 focus:ring-blue-500">
                            <option value="name_asc" {{ request('sort_by') == 'name_asc' ? 'selected' : '' }}>Name (A-Z)</option>
                            <option value="name_desc" {{ request('sort_by') == 'name_desc' ? 'selected' : '' }}>Name (Z-A)</option>
                            <option value="email_asc" {{ request('sort_by') == 'email_asc' ? 'selected' : '' }}>Email (A-Z)</option>
                            <option value="email_desc" {{ request('sort_by') == 'email_desc' ? 'selected' : '' }}>Email (Z-A)</option>
                            <option value="created_desc" {{ request('sort_by') == 'created_desc' ? 'selected' : '' }}>Newest First</option>
                            <option value="created_asc" {{ request('sort_by') == 'created_asc' ? 'selected' : '' }}>Oldest First</option>
                        </select>
                    </div>
                </div>

                <!-- Filter Actions -->
                <div class="flex items-center justify-between mt-4 pt-4 border-t border-gray-200">
                    <div class="flex space-x-2">
                        <button type="submit"
                                class="bg-blue-600 text-white px-4 py-2 rounded-md text-sm font-medium hover:bg-blue-700 transition-colors">
                            Apply Filters
                        </button>
                        <button type="button"
                                id="clearFilters"
                                class="bg-gray-300 text-gray-700 px-4 py-2 rounded-md text-sm font-medium hover:bg-gray-400 transition-colors">
                            Clear All
                        </button>
                    </div>

                    @if(request()->hasAny(['search_name', 'search_email', 'subject_filter', 'sort_by']))
                        <div class="text-sm text-gray-600">
                            <span class="bg-blue-100 text-blue-800 px-2 py-1 rounded-full">
                                Filters Active
                            </span>
                        </div>
                    @endif
                </div>
            </form>
        </div>

        <!-- Results Summary -->
        <div class="flex items-center justify-between mb-4">
            <div class="text-sm text-gray-600">
                Showing {{ $teachers->count() }} of {{ $teachers->total() }} teachers
                @if(request()->hasAny(['search_name', 'search_email', 'subject_filter']))
                    (filtered)
                @endif
            </div>

            <!-- Quick Actions -->
            <div class="flex space-x-2">
                <button onclick="exportTeachers()" class="text-green-600 hover:text-green-800 text-sm font-medium">
                    Export CSV
                </button>
                <button onclick="printTable()" class="text-blue-600 hover:text-blue-800 text-sm font-medium">
                    Print
                </button>
            </div>
        </div>

        <!-- Table Section -->
        <div class="mt-8 bg-white rounded border-b-4 border-gray-300" id="teachersTable">
            <div class="flex flex-wrap items-center uppercase text-sm font-semibold bg-gray-300 text-gray-700 rounded-tl rounded-tr">
                <div class="w-2/12 px-4 py-3">Name</div>
                <div class="w-3/12 px-4 py-3">Email</div>
                <div class="w-3/12 px-4 py-3">Subject Code</div>
                <div class="w-2/12 px-4 py-3">Phone</div>
                <div class="w-2/12 px-4 py-3 text-right">Actions</div>
            </div>

            @forelse ($teachers as $teacher)
                <div class="flex flex-wrap items-center text-gray-700 border-t-2 border-l-4 border-r-4 border-gray-300 hover:bg-gray-50 transition-colors">
                    <div class="w-2/12 px-4 py-3 text-sm font-semibold text-gray-600 tracking-tight">{{ $teacher->user->name }}</div>
                    <div class="w-3/12 px-4 py-3 text-sm font-semibold text-gray-600 tracking-tight">{{ $teacher->user->email }}</div>
                    <div class="w-3/12 px-4 py-3 text-sm font-semibold text-gray-600 tracking-tight">
                        @foreach ($teacher->subjects as $subject)
                            <span class="bg-gray-200 text-sm mr-1 mb-1 px-2 border rounded-full hover:bg-gray-300 transition-colors">{{ $subject->subject_code }}</span>
                        @endforeach
                    </div>
                    <div class="w-2/12 px-4 py-3 text-sm font-semibold text-gray-600 tracking-tight">{{ $teacher->phone }}</div>
                    <div class="w-2/12 flex items-center justify-end px-3">
                        <a href="{{ route('teacher.edit',$teacher->id) }}" class="hover:scale-110 transition-transform">
                            <svg class="h-6 w-6 fill-current text-green-600" aria-hidden="true" focusable="false" data-prefix="fas" data-icon="pen-square" class="svg-inline--fa fa-pen-square fa-w-14" role="img" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 448 512"><path fill="currentColor" d="M400 480H48c-26.5 0-48-21.5-48-48V80c0-26.5 21.5-48 48-48h352c26.5 0 48 21.5 48 48v352c0 26.5-21.5 48-48 48zM238.1 177.9L102.4 313.6l-6.3 57.1c-.8 7.6 5.6 14.1 13.3 13.3l57.1-6.3L302.2 242c2.3-2.3 2.3-6.1 0-8.5L246.7 178c-2.5-2.4-6.3-2.4-8.6-.1zM345 165.1L314.9 135c-9.4-9.4-24.6-9.4-33.9 0l-23.1 23.1c-2.3 2.3-2.3 6.1 0 8.5l55.5 55.5c2.3 2.3 6.1 2.3 8.5 0L345 199c9.3-9.3 9.3-24.5 0-33.9z"></path></svg>
                        </a>
                        <a href="{{ route('teacher.destroy', $teacher->id) }}" data-url="{{ route('teacher.destroy', $teacher->id) }}" class="deletebtn ml-1 bg-red-600 block p-1 border border-red-600 rounded-sm hover:bg-red-700 transition-colors">
                            <svg class="h-3 w-3 fill-current text-gray-100" aria-hidden="true" focusable="false" data-prefix="fas" data-icon="trash" class="svg-inline--fa fa-trash fa-w-14" role="img" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 448 512"><path fill="currentColor" d="M432 32H312l-9.4-18.7A24 24 0 0 0 281.1 0H166.8a23.72 23.72 0 0 0-21.4 13.3L136 32H16A16 16 0 0 0 0 48v32a16 16 0 0 0 16 16h416a16 16 0 0 0 16-16V48a16 16 0 0 0-16-16zM53.2 467a48 48 0 0 0 47.9 45h245.8a48 48 0 0 0 47.9-45L416 128H32z"></path></svg>
                        </a>
                    </div>
                </div>
            @empty
                <div class="text-center py-8 text-gray-500">
                    <svg class="mx-auto h-12 w-12 text-gray-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 13V6a2 2 0 00-2-2H6a2 2 0 00-2 2v7m16 0v5a2 2 0 01-2 2H6a2 2 0 01-2-2v-5m16 0h-2M4 13h2m0 0V9a2 2 0 012-2h2m0 0V6a1 1 0 011-1h6a1 1 0 011 1v1m0 0v2a2 2 0 002 2h2m0 0v1"></path>
                    </svg>
                    <h3 class="mt-2 text-sm font-medium text-gray-900">No teachers found</h3>
                    <p class="mt-1 text-sm text-gray-500">
                        @if(request()->hasAny(['search_name', 'search_email', 'subject_filter']))
                            Try adjusting your search criteria or clearing the filters.
                        @else
                            Get started by adding a new teacher.
                        @endif
                    </p>
                </div>
            @endforelse
        </div>

        <!-- Pagination -->
        <div class="mt-8">
            {{ $teachers->appends(request()->query())->links() }}
        </div>

        @include('backend.modals.delete',['name' => 'teacher'])
    </div>
@endsection

@push('scripts')
<script>
    $(function() {
        // Delete functionality
        $(".deletebtn").on("click", function(event) {
            event.preventDefault();
            $("#deletemodal").toggleClass("hidden");
            var url = $(this).attr('data-url');
            $(".remove-record").attr("action", url);
        });

        $("#deletemodelclose").on("click", function(event) {
            event.preventDefault();
            $("#deletemodal").toggleClass("hidden");
        });

        // Filter toggle functionality
        $("#toggleFilters").on("click", function() {
            const content = $("#filterContent");
            const icon = $("#filterToggleIcon");
            const text = $("#filterToggleText");

            content.slideToggle();
            icon.toggleClass("rotate-180");

            if (content.is(":visible")) {
                text.text("Hide Filters");
            } else {
                text.text("Show Filters");
            }
        });

        // Clear filters functionality
        $("#clearFilters").on("click", function() {
            $("#search_name").val("");
            $("#search_email").val("");
            $("#subject_filter").val("");
            $("#sort_by").val("name_asc");
            $("#filterForm").submit();
        });

        // Auto-submit on select change
        $("#subject_filter, #sort_by").on("change", function() {
            $("#filterForm").submit();
        });

        // Search input debounce
        let searchTimeout;
        $("#search_name, #search_email").on("input", function() {
            clearTimeout(searchTimeout);
            searchTimeout = setTimeout(function() {
                $("#filterForm").submit();
            }, 500);
        });
    });

    // Export functionality
    function exportTeachers() {
        // Create a form to submit with current filters
        const form = document.createElement('form');
        form.method = 'GET';
        form.action = '{{ route("teacher.index") }}'; // You'll need to create this route

        // Add current filter parameters
        const params = new URLSearchParams(window.location.search);
        params.forEach((value, key) => {
            const input = document.createElement('input');
            input.type = 'hidden';
            input.name = key;
            input.value = value;
            form.appendChild(input);
        });

        document.body.appendChild(form);
        form.submit();
        document.body.removeChild(form);
    }

    // Print functionality
    function printTable() {
        const printContent = document.getElementById('teachersTable').outerHTML;
        const printWindow = window.open('', '_blank');
        printWindow.document.write(`
            <html>
                <head>
                    <title>Teachers List</title>
                    <style>
                        body { font-family: Arial, sans-serif; }
                        table { width: 100%; border-collapse: collapse; }
                        th, td { border: 1px solid #ddd; padding: 8px; text-align: left; }
                        th { background-color: #f2f2f2; }
                    </style>
                </head>
                <body>
                    <h1>Teachers List</h1>
                    ${printContent}
                </body>
            </html>
        `);
        printWindow.document.close();
        printWindow.print();
    }
</script>
@endpush --}}

@extends('layouts.app')

@section('content')
    <div class="roles-permissions">
        <div class="flex items-center justify-between mb-6">
            <div>
                <h2 class="text-gray-700 uppercase font-bold">Teachers</h2>
            </div>
            <div class="flex flex-wrap items-center">
                <a href="{{ route('teacher.create') }}" class="bg-green-500 text-white text-sm uppercase py-2 px-4 flex items-center rounded hover:bg-green-600 transition-colors">
                    <svg class="w-3 h-3 fill-current" aria-hidden="true" focusable="false" data-prefix="fas" data-icon="plus" class="svg-inline--fa fa-plus fa-w-14" role="img" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 448 512"><path fill="currentColor" d="M416 208H272V64c0-17.67-14.33-32-32-32h-32c-17.67 0-32 14.33-32 32v144H32c-17.67 0-32 14.33-32 32v32c0 17.67 14.33 32 32 32h144v144c0 17.67 14.33 32 32 32h32c17.67 0-32-14.33-32-32V304h144c17.67 0 32-14.33 32-32v-32c0-17.67-14.33-32-32-32z"></path></svg>
                    <span class="ml-2 text-xs font-semibold">Add New Teacher</span>
                </a>
            </div>
        </div>

        <!-- Filter Section -->
        <div class="bg-white rounded border-b-4 border-gray-300 mb-6">
            <div class="px-4 py-4">
                <form method="GET" action="{{ route('teacher.index') }}" class="flex flex-wrap gap-4 items-end">
                    <!-- Search by Name -->
                    <div class="flex-1 min-w-48">
                        <label for="search_name" class="block text-xs font-medium text-gray-700 mb-1">Search Name</label>
                        <input type="text"
                               id="search_name"
                               name="search_name"
                               value="{{ request('search_name') }}"
                               placeholder="Enter teacher name..."
                               class="w-full px-3 py-2 text-sm border border-gray-300 rounded focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent">
                    </div>

                    <!-- Filter by Email -->
                    <div class="flex-1 min-w-48">
                        <label for="search_email" class="block text-xs font-medium text-gray-700 mb-1">Email</label>
                        <input type="email"
                               id="search_email"
                               name="search_email"
                               value="{{ request('search_email') }}"
                               placeholder="Enter email..."
                               class="w-full px-3 py-2 text-sm border border-gray-300 rounded focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent">
                    </div>

                    <!-- Filter by Subject -->
                    <div class="flex-1 min-w-48">
                        <label for="subject_filter" class="block text-xs font-medium text-gray-700 mb-1">Subject</label>
                        <select id="subject_filter"
                                name="subject_filter"
                                class="w-full px-3 py-2 text-sm border border-gray-300 rounded focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent">
                            <option value="">All Subjects</option>
                            @if(isset($subjects))
                                @foreach($subjects as $subject)
                                    <option value="{{ $subject->id }}" {{ request('subject_filter') == $subject->id ? 'selected' : '' }}>
                                        {{ $subject->subject_code }} - {{ $subject->name }}
                                    </option>
                                @endforeach
                            @endif
                        </select>
                    </div>

                    <!-- Action Buttons -->
                    <div class="flex gap-2">
                        <button type="submit" class="bg-blue-500 hover:bg-blue-600 text-white px-4 py-2 text-sm rounded transition-colors">
                            <svg class="w-4 h-4 inline mr-1" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd" d="M8 4a4 4 0 100 8 4 4 0 000-8zM2 8a6 6 0 1110.89 3.476l4.817 4.817a1 1 0 01-1.414 1.414l-4.816-4.816A6 6 0 012 8z" clip-rule="evenodd"></path>
                            </svg>
                            Filter
                        </button>
                        <a href="{{ route('teacher.index') }}" class="bg-gray-500 hover:bg-gray-600 text-white px-4 py-2 text-sm rounded transition-colors">
                            <svg class="w-4 h-4 inline mr-1" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd" d="M4 2a1 1 0 011 1v2.101a7.002 7.002 0 0011.601 2.566 1 1 0 11-1.885.666A5.002 5.002 0 005.999 7H9a1 1 0 010 2H4a1 1 0 01-1-1V3a1 1 0 011-1zm.008 9.057a1 1 0 011.276.61A5.002 5.002 0 0014.001 13H11a1 1 0 110-2h5a1 1 0 011 1v5a1 1 0 11-2 0v-2.101a7.002 7.002 0 01-11.601-2.566 1 1 0 01.61-1.276z" clip-rule="evenodd"></path>
                            </svg>
                            Clear
                        </a>
                    </div>
                </form>
            </div>
        </div>

        <!-- Results Info -->
        @if(request()->hasAny(['search_name', 'search_email', 'subject_filter']))
            <div class="mb-4">
                <div class="bg-blue-50 border border-blue-200 rounded px-4 py-3">
                    <div class="flex items-center justify-between">
                        <div class="text-sm text-blue-700">
                            <span class="font-semibold">{{ $teachers->total() }}</span> teacher(s) found
                            @if(request('search_name'))
                                for "<strong>{{ request('search_name') }}</strong>"
                            @endif
                            @if(request('search_email'))
                                with email "<strong>{{ request('search_email') }}</strong>"
                            @endif
                            @if(request('subject_filter'))
                                in selected subject
                            @endif
                        </div>
                        <!-- Quick Actions -->
                        <div class="flex space-x-2">
                            <button onclick="exportTeachers()" class="text-green-600 hover:text-green-800 text-sm font-medium">
                                Export CSV
                            </button>
                            <button onclick="printTable()" class="text-blue-600 hover:text-blue-800 text-sm font-medium">
                                Print
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        @else
            <!-- Quick Actions when no filters -->
            <div class="flex items-center justify-between mb-4">
                <div class="text-sm text-gray-600">
                    Showing {{ $teachers->count() }} of {{ $teachers->total() }} teachers
                </div>
                <div class="flex space-x-2">
                    <button onclick="exportTeachers()" class="text-green-600 hover:text-green-800 text-sm font-medium">
                        Export CSV
                    </button>
                    <button onclick="printTable()" class="text-blue-600 hover:text-blue-800 text-sm font-medium">
                        Print
                    </button>
                </div>
            </div>
        @endif

        <!-- Table Section -->
        <div class="mt-8 bg-white rounded border-b-4 border-gray-300" id="teachersTable">
            <div class="flex flex-wrap items-center uppercase text-sm font-semibold bg-gray-300 text-gray-700 rounded-tl rounded-tr">
                <div class="w-2/12 px-4 py-3">Name</div>
                <div class="w-3/12 px-4 py-3">Email</div>
                <div class="w-3/12 px-4 py-3">Subject Codes</div>
                <div class="w-2/12 px-4 py-3">Phone</div>
                <div class="w-2/12 px-4 py-3 text-right">Actions</div>
            </div>

            @forelse ($teachers as $teacher)
                <div class="flex flex-wrap items-center text-gray-700 border-t-2 border-l-4 border-r-4 border-gray-300 hover:bg-gray-50 transition-colors">
                    <div class="w-2/12 px-4 py-3 text-sm font-semibold text-gray-600 tracking-tight">{{ $teacher->user->name }}</div>
                    <div class="w-3/12 px-4 py-3 text-sm font-semibold text-gray-600 tracking-tight">{{ $teacher->user->email }}</div>
                    <div class="w-3/12 px-4 py-3 text-sm font-semibold text-gray-600 tracking-tight">
                        @foreach ($teacher->subjects as $subject)
                            <span class="bg-gray-200 text-xs font-normal px-2 py-px border rounded-full inline-flex my-px mr-1">{{ $subject->subject_code }}</span>
                        @endforeach
                    </div>
                    <div class="w-2/12 px-4 py-3 text-sm font-semibold text-gray-600 tracking-tight">{{ $teacher->phone }}</div>
                    <div class="w-2/12 flex items-center justify-end px-3">
                        <a href="{{ route('teacher.edit',$teacher->id) }}" class="hover:scale-110 transition-transform">
                            <svg class="h-6 w-6 fill-current text-green-600" aria-hidden="true" focusable="false" data-prefix="fas" data-icon="pen-square" class="svg-inline--fa fa-pen-square fa-w-14" role="img" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 448 512"><path fill="currentColor" d="M400 480H48c-26.5 0-48-21.5-48-48V80c0-26.5 21.5-48 48-48h352c26.5 0 48 21.5 48 48v352c0 26.5-21.5 48-48 48zM238.1 177.9L102.4 313.6l-6.3 57.1c-.8 7.6 5.6 14.1 13.3 13.3l57.1-6.3L302.2 242c2.3-2.3 2.3-6.1 0-8.5L246.7 178c-2.5-2.4-6.3-2.4-8.6-.1zM345 165.1L314.9 135c-9.4-9.4-24.6-9.4-33.9 0l-23.1 23.1c-2.3 2.3-2.3 6.1 0 8.5l55.5 55.5c2.3 2.3 6.1 2.3 8.5 0L345 199c9.3-9.3 9.3-24.5 0-33.9z"></path></svg>
                        </a>
                        <a href="{{ route('teacher.destroy', $teacher->id) }}" data-url="{{ route('teacher.destroy', $teacher->id) }}" class="deletebtn ml-1 bg-red-600 block p-1 border border-red-600 rounded-sm hover:bg-red-700 transition-colors">
                            <svg class="h-3 w-3 fill-current text-gray-100" aria-hidden="true" focusable="false" data-prefix="fas" data-icon="trash" class="svg-inline--fa fa-trash fa-w-14" role="img" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 448 512"><path fill="currentColor" d="M432 32H312l-9.4-18.7A24 24 0 0 0 281.1 0H166.8a23.72 23.72 0 0 0-21.4 13.3L136 32H16A16 16 0 0 0 0 48v32a16 16 0 0 0 16 16h416a16 16 0 0 0 16-16V48a16 16 0 0 0-16-16zM53.2 467a48 48 0 0 0 47.9 45h245.8a48 48 0 0 0 47.9-45L416 128H32z"></path></svg>
                        </a>
                    </div>
                </div>
            @empty
                <div class="text-center py-8 text-gray-500">
                    <svg class="mx-auto h-12 w-12 text-gray-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path>
                    </svg>
                    <h3 class="mt-2 text-sm font-medium text-gray-900">No teachers found</h3>
                    <p class="mt-1 text-sm text-gray-500">
                        @if(request()->hasAny(['search_name', 'search_email', 'subject_filter']))
                            Try adjusting your search criteria or clearing the filters.
                        @else
                            Get started by adding a new teacher.
                        @endif
                    </p>
                </div>
            @endforelse
        </div>

        <!-- Pagination -->
        @if($teachers->hasPages())
            <div class="mt-8">
                {{ $teachers->appends(request()->query())->links() }}
            </div>
        @endif

        @include('backend.modals.delete',['name' => 'teacher'])
    </div>
@endsection

@push('scripts')
<script>
    $(function() {
        // Delete functionality
        $(".deletebtn").on("click", function(event) {
            event.preventDefault();
            $("#deletemodal").toggleClass("hidden");
            var url = $(this).attr('data-url');
            $(".remove-record").attr("action", url);
        });

        $("#deletemodelclose").on("click", function(event) {
            event.preventDefault();
            $("#deletemodal").toggleClass("hidden");
        });
    });

    // Export functionality
    function exportTeachers() {
        // Create a form to submit with current filters
        const form = document.createElement('form');
        form.method = 'GET';
        form.action = '{{ route("teacher.index") }}';

        // Add current filter parameters
        const params = new URLSearchParams(window.location.search);
        params.forEach((value, key) => {
            const input = document.createElement('input');
            input.type = 'hidden';
            input.name = key;
            input.value = value;
            form.appendChild(input);
        });

        // Add export parameter
        const exportInput = document.createElement('input');
        exportInput.type = 'hidden';
        exportInput.name = 'export';
        exportInput.value = 'csv';
        form.appendChild(exportInput);

        document.body.appendChild(form);
        form.submit();
        document.body.removeChild(form);
    }

    // Print functionality
    function printTable() {
        const printContent = document.getElementById('teachersTable').outerHTML;
        const printWindow = window.open('', '_blank');
        printWindow.document.write(`
            <html>
                <head>
                    <title>Teachers List</title>
                    <style>
                        body { font-family: Arial, sans-serif; }
                        .flex { display: flex; }
                        .w-2\/12 { width: 16.666667%; }
                        .w-3\/12 { width: 25%; }
                        .px-4 { padding-left: 1rem; padding-right: 1rem; }
                        .py-3 { padding-top: 0.75rem; padding-bottom: 0.75rem; }
                        .border-t-2 { border-top: 2px solid #d1d5db; }
                        .bg-gray-300 { background-color: #d1d5db; }
                        .text-sm { font-size: 0.875rem; }
                        .font-semibold { font-weight: 600; }
                        .uppercase { text-transform: uppercase; }
                        .rounded-full { border-radius: 9999px; }
                        .bg-gray-200 { background-color: #e5e7eb; }
                        .text-xs { font-size: 0.75rem; }
                        .px-2 { padding-left: 0.5rem; padding-right: 0.5rem; }
                        .py-px { padding-top: 1px; padding-bottom: 1px; }
                        .mr-1 { margin-right: 0.25rem; }
                        .my-px { margin-top: 1px; margin-bottom: 1px; }
                        .border { border: 1px solid #d1d5db; }
                        .text-right { text-align: right; }
                    </style>
                </head>
                <body>
                    <h1>Teachers List</h1>
                    ${printContent}
                </body>
            </html>
        `);
        printWindow.document.close();
        printWindow.print();
    }
</script>
@endpush
