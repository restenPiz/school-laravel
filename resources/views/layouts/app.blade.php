<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <!-- Adiciona Bootstrap 5 -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>

    
</head>
<!-- Log on to codeastro.com for more projects -->
<body class="bg-gray-100 font-sans antialiased">
    <div id="app">

        @include('layouts.navbar')
        
        <div class="main flex flex-wrap justify-end mt-16">
            
            @include('layouts.sidebar')

            <div class="content w-full sm:w-5/6">
                <div class="container mx-auto p-4 sm:p-6">

                    @yield('content')
                    
                </div>
            </div>
        </div>
    </div>

    <script src="{{ asset('js/app.js') }}"></script>

    
    @include('sweetalert::alert')

    <script>
        $(function() {
            $( "#opennavdropdown" ).on( "click", function() {
                $( "#navdropdown" ).toggleClass( "hidden" );
            })
        })
    </script>

    @stack('scripts')

    <!-- DataTables CSS -->
    <link rel="stylesheet" href="https://cdn.datatables.net/1.11.5/css/jquery.dataTables.min.css">

    <!-- jQuery (necessário para o DataTables) -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

    <!-- DataTables JS -->
    <script src="https://cdn.datatables.net/1.11.5/js/jquery.dataTables.min.js"></script>

    <script>
        $(document).ready(function() {
            // Inicializando o DataTable
            $('table').DataTable({
                // Aqui você pode adicionar configurações adicionais do DataTable, se necessário
                responsive: true
            });

            // Configuração do botão de exclusão
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
    </script>


</body>
</html>