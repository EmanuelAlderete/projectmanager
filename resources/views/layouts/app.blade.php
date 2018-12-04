<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link rel="apple-touch-icon" sizes="76x76" href="../assets/img/apple-icon.png">
    <link rel="icon" type="image/png" href="../assets/img/favicon.png">
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
    <meta content='width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0, shrink-to-fit=no' name='viewport'/>
    <title>Gerenciador de Projetos</title>

    <!-- JSFiles -->
    <script src="{{ asset('js/app.js') }}"></script>
    <script src="{{ asset('js/scripts.js') }}"></script>
    <!--     Fonts and icons     -->
    <link rel="stylesheet" type="text/css" href="https://fonts.googleapis.com/css?family=Roboto:300,400,500,700|Roboto+Slab:400,700|Material+Icons"/>
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.3.1/css/all.css" integrity="sha384-mzrmE5qonljUremFsqc01SB46JvROS7bZs3IO2EmfFsd15uHvIt+Y8vEf7N7fWAU" crossorigin="anonymous">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/latest/css/font-awesome.min.css">
    <!--     Select2     -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.6-rc.0/css/select2.min.css" rel="stylesheet" />
    <!--     AIR Datepicker     -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/air-datepicker/2.2.3/css/datepicker.min.css">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/air-datepicker/2.2.3/js/datepicker.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/air-datepicker/2.2.3/js/i18n/datepicker.pt-BR.min.js"></script>

    {{-- BootstrapTAG --}}
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-tagsinput/0.8.0/bootstrap-tagsinput-typeahead.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-tagsinput/0.8.0/bootstrap-tagsinput.css">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-tagsinput/0.8.0/bootstrap-tagsinput.min.js"></script>

    <!-- CSS Files -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet" />
    <link rel="stylesheet" href="{{ asset('css/styles.css') }}">

    <style>
       /* TAG INPUT */

        div.bootstrap-tagsinput {
            background: no-repeat center bottom, center calc(100% - 1px);
            background-size: 0 100%, 100% 100%;
            border: 0;
            border-bottom: 1px solid #d2d2d2;
            height: 36px;
            transition: background 0s ease-out;
            padding-left: 0;
            padding-right: 0;
            border-radius: 0;
            font-size: 14px;
            width: 100%;
        }

        .bootstrap-tagsinput {
            box-shadow: none;
        }

        .label-info {
            background-color: #9128AC;
            padding: 0.25em 0.4em;
            font-size: 75%;
            font-weight: 500;
            line-height: 1;
            text-align: center;
            white-space: nowrap;
            vertical-align: baseline;
        }
    </style>
@yield('styles')
</head>

<body class="">
    <div class="wrapper ">
        <div class="sidebar" data-color="purple" data-background-color="white" data-image="../assets/img/sidebar-1.jpg">
            <!--
        Tip 1: You can change the color of the sidebar using: data-color="purple | azure | green | orange | danger"

        Tip 2: you can also add an image using data-image tag
    -->
            <div class="logo">
                <a href="/home" class="simple-text logo-normal">
        <i class="fas fa-lightbulb"></i> Ideias.com
        </a>
            </div>
            <div class="sidebar-wrapper">
                <ul class="nav">

                    @can('access-menu')
                    <li class="nav-item active  ">
                        <a class="nav-link" href="/home">
                  <i class="material-icons">dashboard</i>
                  <p>Dashboard</p>
                </a>
                    </li>
                    @can('access-menu-root') @can('super-admin')
                    <li class="nav-item ">
                        <a class="nav-link" href="/users">
              <i class="material-icons">person</i>
              <p>Usuários</p>
            </a>
                    </li>
                    <li class="nav-item ">
                            <a class="nav-link" href="/teacher-requests">
                  <i class="material-icons">done</i>
                  <p>Solicitações</p>
                </a>
                        </li>
                    <li class="nav-item ">
                        <a class="nav-link" href="/permissions">
              <i class="material-icons"><i class="fa fa-lock" aria-hidden="true"></i></i>
              <p>Permissões</p>
            </a>
                    </li>
                    <li class="nav-item ">
                        <a class="nav-link" href="/roles">
              <i class="material-icons"><i class="fa fa-suitcase" aria-hidden="true"></i></i>
              <p>Cargos</p>
            </a>
                    </li>
                    @endcan
                    <li class="nav-item ">
                        <a class="nav-link" href="/tags">
              <i class="material-icons">bookmark</i>
              <p>Tags</p>
            </a>
                    </li>
                    <li class="nav-item ">
                        <a class="nav-link" href="/type-projects">
              <i class="material-icons">settings</i>
              <p>Tipos de Projetos</p>
            </a>
                    </li>
                    <li class="nav-item ">
                        <a class="nav-link" href="/departments">
              <i class="material-icons"><i class="fas fa-atom"></i></i>
              <p>Áreas de Conhecimento</p>
            </a>
                    </li>
                    <li class="nav-item ">
                        <a class="nav-link" href="/degrees">
              <i class="material-icons"><i class="fas fa-award"></i></i>
              <p>Graduações</p>
            </a>
                    </li>
                    <li class="nav-item ">
                        <a class="nav-link" href="/courses">
              <i class="material-icons"><i class="fas fa-user-graduate"></i></i>
              <p>Cursos</p>
            </a>
                    </li>
                    <li class="nav-item ">
                        <a class="nav-link" href="/institutions">
              <i class="material-icons"><i class="fas fa-school"></i></i>
              <p>Instituições</p>
            </a>
                    </li>
                    <li class="nav-item ">
                        <a class="nav-link" href="/ideas-admin">
              <i class="material-icons"><i class="fas fa-lightbulb"></i></i>
              <p>Ideias</p>
            </a>
                    </li>
                    @endcan @endcan
                    <li class="nav-item">
                        <a class="nav-link" href="/logout" onclick="event.preventDefault();
            document.getElementById('logout-form').submit();">
                <i class="material-icons"><i class="fa fa-sign-out" aria-hidden="true"></i></i>
                <p>Sair</p>
            </a>
                        <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                            @csrf
                        </form>
                    </li>
                </ul>
            </div>
        </div>
        <div class="main-panel">
            <!-- Navbar -->
            <nav class="navbar navbar-expand-lg navbar-transparent navbar-absolute fixed-top ">
                <div class="container-fluid">
                    <div class="navbar-wrapper">
                        <a class="navbar-brand" href="#">{{ $title }}</a>
                    </div>
                    <button class="navbar-toggler" type="button" data-toggle="collapse" aria-controls="navigation-index" aria-expanded="false"
                        aria-label="Toggle navigation">
            <span class="sr-only">Toggle navigation</span>
            <span class="navbar-toggler-icon icon-bar"></span>
            <span class="navbar-toggler-icon icon-bar"></span>
            <span class="navbar-toggler-icon icon-bar"></span>
            </button>
                    <div class="collapse navbar-collapse justify-content-end">
                        <ul class="navbar-nav">
                            <li class="nav-item">
                            </li>
                        </ul>
                    </div>
                </div>
            </nav>
            <!-- End Navbar -->
            <div class="content" id="app">
                @yield('content')
            </div>
        </div>
    </div>

    <script>
        $(document).ready(function() {
      // Javascript method's body can be found in assets/js/demos.js
      md.initDashboardPageCharts();

    });
    </script>

    @yield('scripts')
</body>

</html>
