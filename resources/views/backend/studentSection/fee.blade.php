@extends('layouts.app')

@section('content')
<div class="min-h-screen bg-gray-50 py-8">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <!-- Header Section -->
        <div class="bg-white rounded-lg shadow-sm border border-gray-200 p-6 mb-6">
            <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between">
                <div class="mb-4 sm:mb-0">
                    <h1 class="text-3xl font-bold text-gray-900">Student Fees</h1>
                    <p class="text-gray-600 mt-1">
                        <span class="font-medium">{{ Auth::user()->name }}</span> •
                        Academic Fee Management
                    </p>
                </div>

                <!-- Action Buttons -->
                <div class="flex flex-col sm:flex-row gap-3">
                    <button onclick="printSelectedSections(['fee-section'])"
                            class="inline-flex items-center px-4 py-2 bg-blue-600 text-white text-sm font-medium rounded-lg hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-offset-2 transition-all duration-200">
                        <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 17h2a2 2 0 002-2v-4a2 2 0 00-2-2H5a2 2 0 00-2 2v4a2 2 0 002 2h2m2 4h6a2 2 0 002-2v-4a2 2 0 00-2-2H9a2 2 0 00-2 2v4a2 2 0 002 2zm8-12V5a2 2 0 00-2-2H9a2 2 0 00-2 2v4h10z"></path>
                        </svg>
                        Print Statement
                    </button>
                </div>
            </div>
        </div>

        <!-- Filter Section -->
        <div class="bg-white rounded-lg shadow-sm border border-gray-200 p-6 mb-6">
            <div class="flex flex-col sm:flex-row sm:items-center gap-4">
                <div class="flex-1">
                    <label for="yearFilter" class="block text-sm font-medium text-gray-700 mb-2">
                        Filter by Academic Year
                    </label>
                    <select name="year" id="yearFilter" onchange="filterFees()"
                            class="block w-full sm:w-64 px-3 py-2 border border-gray-300 rounded-lg shadow-sm focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500 bg-white text-gray-900">
                        <option value="">All Years</option>
                        @foreach (range(2010, date('Y')) as $year)
                            <option value="{{ $year }}">{{ $year }}</option>
                        @endforeach
                    </select>
                </div>

                <!-- Quick Stats -->
                <div class="flex flex-wrap gap-4 sm:gap-6">
                    <div class="text-center">
                        <div class="text-sm text-gray-500">Total Fees</div>
                        <div class="text-lg font-semibold text-gray-900">{{ $fees->count() }}</div>
                    </div>
                    <div class="text-center">
                        <div class="text-sm text-gray-500">Paid</div>
                        <div class="text-lg font-semibold text-green-600">{{ $fees->where('status', 'Pago')->count() }}</div>
                    </div>
                    <div class="text-center">
                        <div class="text-sm text-gray-500">Pending</div>
                        <div class="text-lg font-semibold text-red-600">{{ $fees->where('status', '!=', 'Pago')->count() }}</div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Fees Table Section -->
        <div class="bg-white rounded-lg shadow-sm border border-gray-200 overflow-hidden" id="fee-section">
            <!-- Mobile Card View (Hidden on Desktop) -->
            <div class="lg:hidden">
                @foreach ($fees as $fee)
                    <div class="border-b border-gray-200 p-4 hover:bg-gray-50 transition-colors duration-150">
                        <div class="flex items-center justify-between mb-3">
                            <div class="text-lg font-semibold text-gray-900">
                                {{ date('F Y', strtotime($fee->due_date)) }}
                            </div>
                            <div class="flex items-center">
                                @if ($fee->status === 'Pago')
                                    <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-green-100 text-green-800">
                                        <svg class="w-3 h-3 mr-1" fill="currentColor" viewBox="0 0 20 20">
                                            <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd"></path>
                                        </svg>
                                        Paid
                                    </span>
                                @else
                                    <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-red-100 text-red-800">
                                        <svg class="w-3 h-3 mr-1" fill="currentColor" viewBox="0 0 20 20">
                                            <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zM8.707 7.293a1 1 0 00-1.414 1.414L8.586 10l-1.293 1.293a1 1 0 101.414 1.414L10 11.414l1.293 1.293a1 1 0 001.414-1.414L11.414 10l1.293-1.293a1 1 0 00-1.414-1.414L10 8.586 8.707 7.293z" clip-rule="evenodd"></path>
                                        </svg>
                                        Pending
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="grid grid-cols-2 gap-4 text-sm">
                            <div>
                                <div class="text-gray-500">Amount Due</div>
                                <div class="font-medium text-gray-900">{{ number_format($fee->amount_due, 2) }} MZN</div>
                            </div>
                            <div>
                                <div class="text-gray-500">Amount Paid</div>
                                <div class="font-medium text-gray-900">{{ number_format($fee->amount_paid, 2) }} MZN</div>
                            </div>
                            @if($fee->penalty_fee > 0)
                            <div class="col-span-2">
                                <div class="text-gray-500">Penalty Fee</div>
                                <div class="font-medium text-red-600">{{ number_format($fee->penalty_fee, 2) }} MZN</div>
                            </div>
                            @endif
                        </div>
                    </div>
                @endforeach
            </div>

            <!-- Desktop Table View (Hidden on Mobile) -->
            <div class="hidden lg:block">
                <table class="min-w-full divide-y divide-gray-200">
                    <thead class="bg-gray-50">
                        <tr>
                            <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                Period
                            </th>
                            <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                Amount Due
                            </th>
                            <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                Amount Paid
                            </th>
                            <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                Penalty Fee
                            </th>
                            <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                Status
                            </th>
                        </tr>
                    </thead>
                    <tbody class="bg-white divide-y divide-gray-200">
                        @foreach ($fees as $fee)
                            <tr class="hover:bg-gray-50 transition-colors duration-150">
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <div class="text-sm font-medium text-gray-900">
                                        {{ date('F Y', strtotime($fee->due_date)) }}
                                    </div>
                                    <div class="text-sm text-gray-500">
                                        {{ date('M d, Y', strtotime($fee->due_date)) }}
                                    </div>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <div class="text-sm font-medium text-gray-900">
                                        {{ number_format($fee->amount_due, 2) }} MZN
                                    </div>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <div class="text-sm font-medium text-gray-900">
                                        {{ number_format($fee->amount_paid, 2) }} MZN
                                    </div>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    @if($fee->penalty_fee > 0)
                                        <div class="text-sm font-medium text-red-600">
                                            {{ number_format($fee->penalty_fee, 2) }} MZN
                                        </div>
                                    @else
                                        <div class="text-sm text-gray-400">—</div>
                                    @endif
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    @if ($fee->status === 'Pago')
                                        <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-green-100 text-green-800">
                                            <svg class="w-3 h-3 mr-1" fill="currentColor" viewBox="0 0 20 20">
                                                <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd"></path>
                                            </svg>
                                            Paid
                                        </span>
                                    @else
                                        <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-red-100 text-red-800">
                                            <svg class="w-3 h-3 mr-1" fill="currentColor" viewBox="0 0 20 20">
                                                <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zM8.707 7.293a1 1 0 00-1.414 1.414L8.586 10l-1.293 1.293a1 1 0 101.414 1.414L10 11.414l1.293 1.293a1 1 0 001.414-1.414L11.414 10l1.293-1.293a1 1 0 00-1.414-1.414L10 8.586 8.707 7.293z" clip-rule="evenodd"></path>
                                            </svg>
                                            Pending
                                        </span>
                                    @endif
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>

            <!-- Empty State -->
            @if($fees->isEmpty())
                <div class="text-center py-12">
                    <svg class="mx-auto h-12 w-12 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path>
                    </svg>
                    <h3 class="mt-2 text-sm font-medium text-gray-900">No fees found</h3>
                    <p class="mt-1 text-sm text-gray-500">No fee records match your current filter.</p>
                </div>
            @endif
        </div>

        <!-- Summary Section -->
        <div class="mt-6 grid grid-cols-1 md:grid-cols-3 gap-6">
            <!-- Total Summary -->
            <div class="bg-white rounded-lg shadow-sm border border-gray-200 p-6">
                <div class="flex items-center">
                    <div class="flex-shrink-0">
                        <div class="w-8 h-8 bg-blue-100 rounded-full flex items-center justify-center">
                            <svg class="w-4 h-4 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1"></path>
                            </svg>
                        </div>
                    </div>
                    <div class="ml-4">
                        <div class="text-sm font-medium text-gray-500">Total Amount Due</div>
                        <div class="text-2xl font-bold text-gray-900">{{ number_format($fees->sum('amount_due'), 2) }} MZN</div>
                    </div>
                </div>
            </div>

            <!-- Paid Summary -->
            <div class="bg-white rounded-lg shadow-sm border border-gray-200 p-6">
                <div class="flex items-center">
                    <div class="flex-shrink-0">
                        <div class="w-8 h-8 bg-green-100 rounded-full flex items-center justify-center">
                            <svg class="w-4 h-4 text-green-600" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd"></path>
                            </svg>
                        </div>
                    </div>
                    <div class="ml-4">
                        <div class="text-sm font-medium text-gray-500">Total Paid</div>
                        <div class="text-2xl font-bold text-green-600">{{ number_format($fees->sum('amount_paid'), 2) }} MZN</div>
                    </div>
                </div>
            </div>

            <!-- Penalties Summary -->
            <div class="bg-white rounded-lg shadow-sm border border-gray-200 p-6">
                <div class="flex items-center">
                    <div class="flex-shrink-0">
                        <div class="w-8 h-8 bg-red-100 rounded-full flex items-center justify-center">
                            <svg class="w-4 h-4 text-red-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-2.5L13.732 4c-.77-.833-1.866-.833-2.464 0L3.34 16.5c-.77.833.192 2.5 1.732 2.5z"></path>
                            </svg>
                        </div>
                    </div>
                    <div class="ml-4">
                        <div class="text-sm font-medium text-gray-500">Total Penalties</div>
                        <div class="text-2xl font-bold text-red-600">{{ number_format($fees->sum('penalty_fee'), 2) }} MZN</div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Enhanced JavaScript -->
<script>
    // Filter functionality
    function filterFees() {
        const yearFilter = document.getElementById('yearFilter').value;
        const feeRows = document.querySelectorAll('[data-year]');

        feeRows.forEach(row => {
            if (!yearFilter || row.dataset.year === yearFilter) {
                row.style.display = '';
            } else {
                row.style.display = 'none';
            }
        });

        // Update summary if needed
        updateSummary();
    }

    // Enhanced print functionality
    function printSelectedSections(sectionIds) {
        const printContent = sectionIds.map(id => {
            const element = document.getElementById(id);
            return element ? element.outerHTML : '';
        }).join('');

        if (!printContent) {
            alert("No content found to print!");
            return;
        }

        const printWindow = window.open('', '_blank');
        const printDocument = `
            <!DOCTYPE html>
            <html>
            <head>
                <title>Student Fee Statement - {{ Auth::user()->name }}</title>
                <style>
                    body { font-family: Arial, sans-serif; margin: 20px; }
                    .no-print { display: none !important; }
                    table { width: 100%; border-collapse: collapse; margin-top: 20px; }
                    th, td { padding: 12px; text-align: left; border-bottom: 1px solid #ddd; }
                    th { background-color: #f5f5f5; font-weight: bold; }
                    .header { text-align: center; margin-bottom: 30px; }
                    .summary { margin-top: 30px; font-weight: bold; }
                    @media print {
                        body { margin: 0; }
                        .no-print { display: none !important; }
                    }
                </style>
            </head>
            <body>
                <div class="header">
                    <h1>Student Fee Statement</h1>
                    <p>Student: {{ Auth::user()->name }}</p>
                    <p>Generated on: ${new Date().toLocaleDateString()}</p>
                </div>
                ${printContent}
            </body>
            </html>
        `;

        printWindow.document.write(printDocument);
        printWindow.document.close();

        printWindow.onload = function() {
            printWindow.print();
            printWindow.close();
        };
    }

    // Initialize tooltips and interactions
    document.addEventListener('DOMContentLoaded', function() {
        // Add loading states for buttons
        const buttons = document.querySelectorAll('button');
        buttons.forEach(button => {
            button.addEventListener('click', function() {
                const original = this.innerHTML;
                this.innerHTML = '<svg class="animate-spin -ml-1 mr-3 h-4 w-4 text-white" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"><circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle><path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path></svg>Loading...';

                setTimeout(() => {
                    this.innerHTML = original;
                }, 1000);
            });
        });
    });

    // Add smooth animations
    function updateSummary() {
        // This function can be expanded to update summary cards based on filtered data
        console.log('Summary updated based on current filter');
    }
</script>

@endsection
