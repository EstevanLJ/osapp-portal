<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no"><!-- End Required meta tags -->
    <title>{{ config('app.name', 'Laravel') }}</title>
    
    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    {{-- @include('layouts.template.seo') --}}

    <!-- FAVICONS -->
    <link rel="apple-touch-icon" sizes="192x192" href="/ic_launcher.png">
    <link rel="shortcut icon" href="/ic_launcher.png">
    <meta name="theme-color" content="#3063A0"><!-- End FAVICONS -->
    <!-- GOOGLE FONT -->
    <link href="https://fonts.googleapis.com/css?family=Fira+Sans:400,500,600" rel="stylesheet"><!-- End GOOGLE FONT -->
    <!-- BEGIN PLUGINS STYLES -->
    <link rel="stylesheet" href="/template/vendor/open-iconic/css/open-iconic-bootstrap.min.css">
    <link rel="stylesheet" href="/template/vendor/fontawesome/css/all.css">
    <link rel="stylesheet" href="/template/vendor/datatables/extensions/responsive/responsive.bootstrap4.min.css">
    <link rel="stylesheet" href="/template/vendor/flatpickr/flatpickr.min.css"><!-- END PLUGINS STYLES -->
    <!-- BEGIN THEME STYLES -->
    <link rel="stylesheet" href="/template/stylesheets/theme.min.css" data-skin="default">
    {{-- <link rel="stylesheet" href="/template/stylesheets/theme-dark.min.css" data-skin="dark"> --}}
    <link rel="stylesheet" href="/template/stylesheets/custom.css"><!-- Disable unused skin immediately -->
    {{-- <script>
      var skin = localStorage.getItem('skin') || 'default';
      var unusedLink = document.querySelector('link[data-skin]:not([data-skin="' + skin + '"])');
      unusedLink.setAttribute('rel', '');
      unusedLink.setAttribute('disabled', true);
    </script> --}}
    <!-- END THEME STYLES -->
  </head>
  <body>
    <!-- .app -->
    <div class="app has-fullwidth">
      <!--[if lt IE 10]>
      <div class="page-message" role="alert">You are using an <strong>outdated</strong> browser. Please <a class="alert-link" href="http://browsehappy.com/">upgrade your browser</a> to improve your experience and security.</div>
      <![endif]-->

      @include('layouts.template.header')

      {{-- @include('layouts.template.aside') --}}

      @include('layouts.template.main')


    </div><!-- /.app -->
    <!-- BEGIN BASE JS -->
    <script src="/template/vendor/jquery/jquery.min.js"></script>
    <script src="/template/vendor/bootstrap/js/popper.min.js"></script>
    <script src="/template/vendor/bootstrap/js/bootstrap.min.js"></script> <!-- END BASE JS -->
    
    <!-- BEGIN PLUGINS JS -->
    <script src="/template/vendor/pace/pace.min.js"></script>
    <script src="/template/vendor/stacked-menu/stacked-menu.min.js"></script>
    <script src="/template/vendor/perfect-scrollbar/perfect-scrollbar.min.js"></script>
    <script src="/template/vendor/flatpickr/flatpickr.min.js"></script>
    {{-- <script src="/template/vendor/easy-pie-chart/jquery.easypiechart.min.js"></script> --}}
    {{-- <script src="/template/vendor/chart.js/Chart.min.js"></script>  --}}
    <script src="/template/vendor/datatables/jquery.dataTables.min.js"></script>
    <script src="/template/vendor/datatables/extensions/responsive/dataTables.responsive.min.js"></script>
    <script src="/template/vendor/datatables/extensions/responsive/responsive.bootstrap4.min.js"></script>
    <!-- END PLUGINS JS -->

    <!-- BEGIN THEME JS -->
    <script src="/template/javascript/theme.min.js"></script> <!-- END THEME JS -->

    <script>
      let datatable_language = {
        "sEmptyTable": "Nenhum registro encontrado",
        "sInfo": "Mostrando de _START_ até _END_ de _TOTAL_ registros",
        "sInfoEmpty": "Mostrando 0 até 0 de 0 registros",
        "sInfoFiltered": "(Filtrados de _MAX_ registros)",
        "sInfoPostFix": "",
        "sInfoThousands": ".",
        "sLengthMenu": "_MENU_ resultados por página",
        "sLoadingRecords": "Carregando...",
        "sProcessing": "Processando...",
        "sZeroRecords": "Nenhum registro encontrado",
        "sSearch": "Buscar:",
        "oPaginate": {
            "sNext": "Próximo",
            "sPrevious": "Anterior",
            "sFirst": "Primeiro",
            "sLast": "Último"
        },
        "oAria": {
            "sSortAscending": ": Ordenar colunas de forma ascendente",
            "sSortDescending": ": Ordenar colunas de forma descendente"
        }
      };
    </script>
    
    @stack('js')

  </body>
</html>