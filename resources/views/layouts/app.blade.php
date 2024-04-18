<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>@yield('titulo_site')</title>
    <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

    <script src="{{asset('js/app.js')}}"></script>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=Nunito" rel="stylesheet">
    <link rel="stylesheet" href="{{asset('css/app.css')}}">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">

    <!-- Scripts -->
    {{-- @vite(['resources/sass/app.scss', 'resources/js/app.js']) --}}
</head>
<body class="hold-transition sidebar-mini layout-fixed">
    <div id="app" class="wrapper">

        @include('layouts.menu-lateral')


          <!-- Content Wrapper. Contains page content -->
        <div class="content-wrapper bg-dark text-white">
            <!-- Content Header (Page header) -->
          <section class="content-header">
            <div class="container-fluid">
              <div class="row mb-2">
                <div class="col-sm-6">
                    @yield('title')
                </div>
                <div class="col-sm-6">
                  <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item">
                        <a href="{{route('home')}}">
                            Dashboard
                        </a>
                    </li>
                    @yield('breadcrumb')
                  </ol>
                </div>
              </div>
            </div><!-- /.container-fluid -->
          </section>


          @if ($errors->any())
            <div class="alert alert-danger">
              <ul>
                @foreach ($errors->all() as $error)
                    <li>{{$error}}</li>
                @endforeach
              </ul>
            </div>

          @endif

          @if(session('success'))
            <script>
                $(document).ready(function(){
                    $('#modal_success').modal('show');
                    setTimeout(function(){
                        $('#modal_success').modal('hide');
                        setTimeout(function(){
                            // Remover a session 'success'
                            {!! session()->forget('success') !!}
                        }, 1000);
                    }, 1000);
                });
            </script>
        @endif

<!-- Modal -->
<div class="modal fade" id="modal_success" tabindex="-1" aria-labelledby="Cadastrado com sucesso" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Sucesso!</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                {{ session('success') }}
            </div>
        </div>
    </div>
</div>

            <!-- Main content -->

          <section class="content">

              <div class="container-fluid">
                  <main class="py-4">
                      @yield('content')
                  </main>
              </div>
          </section>
            <!-- /.content -->
        </div>
        <!-- /.content-wrapper -->

        <footer class="main-footer">
            <div class="float-right d-none d-sm-block">
            <b>Sistema administrativo</b>
            </div>
            <strong>Copyright &copy; 2024 | Todos os direitos reservados.
        </footer>

    </div>
</body>
</html>
