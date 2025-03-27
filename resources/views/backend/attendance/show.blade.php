@extends('layouts.app')

@section('content')
    <div class="create">

        <div class="flex items-center justify-between mb-6">
            <div><!-- Log on to codeastro.com for more projects -->
                <h2 class="text-gray-700 uppercase font-bold">Attendance - <span class="text-gray-700 uppercase font-bold">{{ $attendances[0]->student->user->name ?? '' }}</span></h2>
            </div>
            <div class="flex flex-wrap items-center">
                <a href="{{ route('home') }}" class="bg-gray-700 text-white text-sm uppercase py-2 px-4 flex items-center rounded">
                    <svg class="w-3 h-3 fill-current" aria-hidden="true" focusable="false" data-prefix="fas" data-icon="long-arrow-alt-left" class="svg-inline--fa fa-long-arrow-alt-left fa-w-14" role="img" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 448 512"><path fill="currentColor" d="M134.059 296H436c6.627 0 12-5.373 12-12v-56c0-6.627-5.373-12-12-12H134.059v-46.059c0-21.382-25.851-32.09-40.971-16.971L7.029 239.029c-9.373 9.373-9.373 24.569 0 33.941l86.059 86.059c15.119 15.119 40.971 4.411 40.971-16.971V296z"></path></svg>
                    <span class="ml-2 text-xs font-semibold">Back</span>
                </a>
            </div>
        </div>

        <div class="">

            <div class="mt-8 bg-white rounded border-b-4 border-gray-300">
                <div class="flex items-center justify-between bg-gray-300 text-gray-700 rounded-tl rounded-tr">
                    <div class="w-3/12 text-left py-2 px-4 font-semibold">Date</div>
                    <div class="w-3/12 text-left py-2 px-4 font-semibold">Teacher</div>
                    <div class="w-3/12 text-left py-2 px-4 font-semibold">Class</div>
                    <div class="w-3/12 text-right py-2 px-4 font-semibold">Attendence</div>
                </div>
                @foreach ($attendances as $attendance)
                    <div class="bg-white flex items-center justify-between border border-b-4 border-l-4 border-r-4 border-gray-300">
                        <div class="w-3/12 text-sm text-left text-gray-600 py-2 px-4 font-semibold">{{ $attendance->attendence_date }}</div>
                        <div class="w-3/12 text-sm text-left text-gray-600 py-2 px-4 font-semibold">{{ $attendance->teacher->user->name }}</div>
                        <div class="w-3/12 text-sm text-left text-gray-600 py-2 px-4 font-semibold">{{ $attendance->class->class_name }}</div>
                        <div class="w-3/12 text-xs text-right text-gray-600 py-2 px-4 font-semibold">
                            @if ($attendance->attendence_status)
                                <span class="bg-green-600 text-white px-2 py-1 rounded-custom">P</span>
                            @else
                                <span class="bg-red-600 text-white px-2 py-1 rounded-custom">A</span>
                            @endif
                        </div>
                    </div>
                @endforeach
            </div>        
        </div>

        {{--?Start with the fees table--}}
        <div class=""><br>
            <div class="flex items-center justify-between mb-6">
                <div><!-- Log on to codeastro.com for more projects -->
                    <h2 class="text-gray-700 uppercase font-bold">Fees - <span class="text-gray-700 uppercase font-bold">{{ $attendances[0]->student->user->name ?? '' }}</span></h2>
                </div>
            </div>
            <select name="year" id="yearFilter" onchange="filterFees()" class="block font-bold appearance-none w-1/3 bg-gray-200 border border-gray-200 text-gray-600 py-3 px-4 pr-8 rounded leading-tight focus:outline-none focus:bg-white focus:border-gray-500">
                <option value="">Select the year</option>
                @foreach (range(2010, date('Y')) as $year)
                    <option value="{{ $year }}">{{ $year }}</option>
                @endforeach
            </select>
               
            <div class="mt-8 bg-white rounded border-b-4 border-gray-300">
                <!-- Cabeçalho da Tabela -->
                <div
                    class="flex flex-wrap items-center uppercase text-sm font-semibold bg-gray-300 text-gray-700 rounded-tl rounded-tr">
                    <div class="w-2/12 px-4 py-3">Amount Due</div>
                    <div class="w-2/12 px-4 py-3">Amount Paid</div>
                    <div class="w-2/12 px-4 py-3">Penalty Fee</div>
                    <div class="w-2/12 px-4 py-3">Month</div>
                    <div class="w-2/12 px-4 py-3">Status</div>
                    <div class="w-2/12 px-4 py-3"></div>
                </div>

                @foreach ($fees as $fee)
                    <div class="bg-white flex flex-wrap items-center text-gray-700 border border-b-4 border-l-4 border-r-4 border-gray-300">
                        <!-- Valor a pagar -->
                        <div class="w-2/12 px-4 py-3 text-sm font-semibold text-gray-600">
                            {{ number_format($fee->amount_due, 2) }} MZN
                        </div>
                        <div class="w-2/12 px-4 py-3 text-sm font-semibold text-gray-600">
                            {{ number_format($fee->amount_paid, 2) }} MZN
                        </div>
                        <div class="w-2/12 px-4 py-3 text-sm font-semibold text-gray-600">
                            {{ number_format($fee->penalty_fee, 2) }} MZN
                        </div>
                        <div class="w-2/12 px-4 py-3 text-sm font-semibold text-gray-600">
                            {{ date('F-Y', strtotime($fee->due_date)) }}
                        </div>
                        <div class="w-2/12 px-4 py-3 text-sm font-semibold">
                            @if ($fee->status === 'Pago')
                                <span class="bg-green-200 text-sm px-2 border rounded-full">Pago</span>
                            @else
                                <span class="bg-red-200 text-sm px-2 border rounded-full">Pendente</span>
                            @endif
                        </div>
                        <div class="w-2/12 px-4 py-3 flex items-center justify-end">
                                <span class="text-gray-500">-</span>
                        </div>
                    </div>
                @endforeach
            </div>
            {{-- *Start with the accountant section --}}
            <div style="margin-top:1rem" class="bg-white p-4 rounded-lg text-gray-800 font-semibold">
                <div class="flex justify-between">
                    <span class="text-lg">Total Amount Due:</span>
                    <span class="text-lg">{{ number_format($fees->sum('amount_due'), 2) }} MZN</span>
                </div>
            </div>
            {{-- *End of the accountant section --}}
        </div>
        {{--?End of the fee table--}}

    </div>
@endsection