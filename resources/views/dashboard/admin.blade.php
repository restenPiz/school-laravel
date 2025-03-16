<!-- Container principal -->
<div class="w-full mt-8 px-4">
    <div class="flex flex-wrap justify-between gap-4">
        <!-- Card Students -->
        <div class="w-full sm:w-1/3 bg-gray-200 text-center border border-gray-300 px-8 py-6 rounded shadow-md">
            <h3 class="text-gray-700 uppercase font-bold flex items-center justify-center gap-4">
                <svg class="fill-current w-10 h-10" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 448 512">
                    <path d="M319.4 320.6L224 416l-95.4-95.4C57.1 323.7 0 382.2 0 454.4v9.6c0 26.5 21.5 48 48 48h352c26.5 0 48-21.5 48-48v-9.6c0-72.2-57.1-130.7-128.6-133.8z"/>
                </svg>
                <span class="text-4xl">{{ count($students) }}</span>
                <span class="leading-tight">Students</span>
            </h3>
        </div>

        <!-- Card Teachers -->
        <div class="w-full sm:w-1/3 bg-gray-200 text-center border border-gray-300 px-8 py-6 rounded shadow-md">
            <h3 class="text-gray-700 uppercase font-bold flex items-center justify-center gap-4">
                <svg class="fill-current w-10 h-10" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 448 512">
                    <path d="M224 256c70.7 0 128-57.3 128-128S294.7 0 224 0S96 57.3 96 128s57.3 128 128 128z"/>
                </svg>
                <span class="text-4xl">{{ count($teachers) }}</span>
                <span class="leading-tight">Teachers</span>
            </h3>
        </div>

        <!-- Card Parents -->
        <div class="w-full sm:w-1/3 bg-gray-200 text-center border border-gray-300 px-8 py-6 rounded shadow-md">
            <h3 class="text-gray-700 uppercase font-bold flex items-center justify-center gap-4">
                <svg class="fill-current w-10 h-10" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 448 512">
                    <path d="M224 0c70.7 0 128 57.3 128 128s-57.3 128-128 128s-128-57.3-128-128z"/>
                </svg>
                <span class="text-4xl">{{ count($parents) }}</span>
                <span class="leading-tight">Parents</span>
            </h3>
        </div>
    </div>

    <!-- Gráfico abaixo dos cards -->
    <div class="mt-8 bg-white p-6 rounded shadow-md">
        <canvas id="dashboardChart"></canvas>
    </div>
</div>

<!-- Importando Chart.js -->
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
document.addEventListener("DOMContentLoaded", function () {
    var ctx = document.getElementById("dashboardChart").getContext("2d");

    var chart = new Chart(ctx, {
        type: "bar",
        data: {
            labels: ["Students", "Teachers", "Parents"],
            datasets: [{
                label: "Total",
                data: [{{ count($students) }}, {{ count($teachers) }}, {{ count($parents) }}],
                backgroundColor: ["#4CAF50", "#FF9800", "#2196F3"]
            }]
        },
        options: {
            responsive: true,
            maintainAspectRatio: false
        }
    });
});
</script>
