<!-- Container principal -->
<div class="w-full mt-8 px-4">
    <div class="flex flex-wrap justify-between gap-4">
        <!-- Card Students -->
        <div class="w-full sm:w-1/3 bg-gray-200 text-center border border-gray-300 px-8 py-6 rounded shadow-md">
            <h3 class="text-gray-700 uppercase font-bold flex items-center justify-center gap-4">
                <svg class="h-7 w-5 fill-current" aria-hidden="true" focusable="false" data-prefix="fas"
                    data-icon="user-graduate" class="svg-inline--fa fa-user-graduate fa-w-14" role="img"
                    xmlns="http://www.w3.org/2000/svg" viewBox="0 0 448 512">
                    <path fill="currentColor"
                        d="M319.4 320.6L224 416l-95.4-95.4C57.1 323.7 0 382.2 0 454.4v9.6c0 26.5 21.5 48 48 48h352c26.5 0 48-21.5 48-48v-9.6c0-72.2-57.1-130.7-128.6-133.8zM13.6 79.8l6.4 1.5v58.4c-7 4.2-12 11.5-12 20.3 0 8.4 4.6 15.4 11.1 19.7L3.5 242c-1.7 6.9 2.1 14 7.6 14h41.8c5.5 0 9.3-7.1 7.6-14l-15.6-62.3C51.4 175.4 56 168.4 56 160c0-8.8-5-16.1-12-20.3V87.1l66 15.9c-8.6 17.2-14 36.4-14 57 0 70.7 57.3 128 128 128s128-57.3 128-128c0-20.6-5.3-39.8-14-57l96.3-23.2c18.2-4.4 18.2-27.1 0-31.5l-190.4-46c-13-3.1-26.7-3.1-39.7 0L13.6 48.2c-18.1 4.4-18.1 27.2 0 31.6z">
                    </path>
                </svg>
                <span class="text-4xl">{{ count($students) }}</span>
                <span class="leading-tight">Students</span>
            </h3>
        </div>

        <!-- Card Teachers -->
        <div class="w-full sm:w-1/3 bg-gray-200 text-center border border-gray-300 px-8 py-6 rounded shadow-md">
            <h3 class="text-gray-700 uppercase font-bold flex items-center justify-center gap-4">
                <svg class="h-7 w-6 fill-current" aria-hidden="true" focusable="false" data-prefix="fas"
                    data-icon="user-edit" class="svg-inline--fa fa-user-edit fa-w-20" role="img"
                    xmlns="http://www.w3.org/2000/svg" viewBox="0 0 640 512">
                    <path fill="currentColor"
                        d="M224 256c70.7 0 128-57.3 128-128S294.7 0 224 0 96 57.3 96 128s57.3 128 128 128zm89.6 32h-16.7c-22.2 10.2-46.9 16-72.9 16s-50.6-5.8-72.9-16h-16.7C60.2 288 0 348.2 0 422.4V464c0 26.5 21.5 48 48 48h274.9c-2.4-6.8-3.4-14-2.6-21.3l6.8-60.9 1.2-11.1 7.9-7.9 77.3-77.3c-24.5-27.7-60-45.5-99.9-45.5zm45.3 145.3l-6.8 61c-1.1 10.2 7.5 18.8 17.6 17.6l60.9-6.8 137.9-137.9-71.7-71.7-137.9 137.8zM633 268.9L595.1 231c-9.3-9.3-24.5-9.3-33.8 0l-37.8 37.8-4.1 4.1 71.8 71.7 41.8-41.8c9.3-9.4 9.3-24.5 0-33.9z">
                    </path>
                </svg>
                <span class="text-4xl">{{ count($teachers) }}</span>
                <span class="leading-tight">Teachers</span>
            </h3>
        </div>

        <!-- Card Parents -->
        <div class="w-full sm:w-1/3 bg-gray-200 text-center border border-gray-300 px-8 py-6 rounded shadow-md">
            <h3 class="text-gray-700 uppercase font-bold flex items-center justify-center gap-4">
                <svg class="h-7 w-5 fill-current" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 448 512">
                    <path
                        d="M224 0c70.7 0 128 57.3 128 128s-57.3 128-128 128s-128-57.3-128-128S153.3 0 224 0zM209.1 359.2l-18.6-31c-6.4-10.7 1.3-24.2 13.7-24.2H224h19.7c12.4 0 20.1 13.6 13.7 24.2l-18.6 31 33.4 123.9 39.5-161.2c77.2 12 136.3 78.8 136.3 159.4c0 17-13.8 30.7-30.7 30.7H265.1 182.9 30.7C13.8 512 0 498.2 0 481.3c0-80.6 59.1-147.4 136.3-159.4l39.5 161.2 33.4-123.9z" />
                </svg>
                <span class="text-4xl">{{ count($parents) }}</span>
                <span class="leading-tight">Parents</span>
            </h3>
        </div>
    </div>

    <!-- Gráfico e Card de Pagamentos lado a lado -->
    <div class="mt-8 flex flex-wrap gap-4">
        <!-- Gráfico -->
        <div style="width: 49.5rem;height:35rem" class=" lg:w-2/3 bg-gray-200 p-6 rounded {{-- shadow-md --}}"
            style="height: 65vh">
            <canvas id="dashboardChart"></canvas>
        </div>
        <!-- Card de Pagamentos -->
        <div style="height: 10rem;margin-left:0.5rem;background-color:#1a1879"
            class="w-full sm:w-1/3 bg-gradient-to-r  from-blue-500 to-blue-700 text-white text-center border border-blue-600 px-8 py-6 rounded-lg shadow-lg">
            <h3 class="uppercase font-bold flex items-center justify-center gap-4">
                <svg style="color: white" class="h-10 w-10 fill-current" aria-hidden="true"
                    xmlns="http://www.w3.org/2000/svg" viewBox="0 0 576 512">
                    <path fill="currentColor"
                        d="M528 32H48C21.5 32 0 53.5 0 80v352c0 26.5 21.5 48 48 48h480c26.5 0 48-21.5 48-48V80c0-26.5-21.5-48-48-48zM528 432H48c-8.8 0-16-7.2-16-16v-48h512v48c0 8.8-7.2 16-16 16zM544 320H32V128h512v192zm-400-96h288c8.8 0 16-7.2 16-16s-7.2-16-16-16H144c-8.8 0-16 7.2-16 16s7.2 16 16 16z" />
                </svg>
                <div class="text-left" style="margin-left:0.5rem">
                    <p class="text-xl font-semibold" style="color: white">Total Payments</p>
                    <p class="text-3xl font-bold mt-1" style="color: white">MZN
                        {{ number_format($payments->sum('amount'), 2, ',', '.') }}</p>
                </div>{{-- #EFB036 --}}
            </h3>

            <div class="w-full mt-8 bg-gray-200 p-6 rounded" style="margin-top:5rem;">
                <h3 class="text-gray-700 uppercase font-bold text-center mb-4">Classes vs Subjects</h3>
                <canvas id="classSubjectPieChart"></canvas>
            </div>
        </div>
    </div>
</div>

<!-- Importando Chart.js -->
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
    document.addEventListener("DOMContentLoaded", function() {
        var ctx = document.getElementById("dashboardChart").getContext("2d");

        new Chart(ctx, {
            type: "bar",
            data: {
                labels: ["Students", "Teachers", "Parents"],
                datasets: [{
                    label: "Total",
                    data: [{{ count($students) }}, {{ count($teachers) }},
                        {{ count($parents) }}],
                    backgroundColor: ["#4CAF50", "#FF9800", "#2196F3"]
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false
            }
        });

        var pieCtx = document.getElementById("classSubjectPieChart").getContext("2d");
        new Chart(pieCtx, {
            type: "pie",
            data: {
                labels: ["Classes", "Subjects"],
                datasets: [{
                    data: [{{ count($classes) }}, {{ count($subjects) }}],
                    backgroundColor: ["#FF6384", "#2196F3"]//#FF9800 //#36A2EB
                }]
            }
        });
    });
</script>
