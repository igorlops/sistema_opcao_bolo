<div class="menu-desktop">
@if (auth()->user()->type_user == "1")
<aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <a href="{{route('home')}}" class="brand-link">
      <span class="brand-text font-weight-light">Opção do Bolo</span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">
      <!-- Sidebar user (optional) -->
      <div class="user-panel mt-3 pb-3 mb-3 d-flex">
        <div class="image">
        </div>
        <div class="info d-flex justify-content-between w-100">
            <a href="#">{{auth()->user()->name}}</a>
            <a
                href="{{route('logout')}}"
                onclick="event.preventDefault();
                            document.getElementById('logout-form').submit();"
                            class="btn btn-danger btn-sm">
                            Sair
                            <i class="bi bi-box-arrow-right nav-icon"></i>
            </a>
            <form action="{{route('logout')}}" method="post" style="display: none;" id="logout-form">
                @csrf
            </form>
        </div>
      </div>


      <!-- Sidebar Menu -->
      <nav class="mt-2">
        <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
            <li class="nav-item menu-open">
                <a href="{{route('home')}}" class="nav-link">
                    <i class="bi bi-speedometer2 nav-icon"></i>
                    <p>
                        Dashboard
                    </p>
                </a>
            </li>
            <li class="nav-item menu-open">
                <a href="#" class="nav-link">
                    <i class="bi bi-box-arrow-up nav-icon"></i>
                    <p>
                        Entrada
                        <i class="right bi bi-caret-left-fill"></i>
                    </p>
                </a>
                <ul class="nav nav-treeview">
                    <li class="nav-item">
                        <a href="{{route('entradas.create')}}" class="nav-link">
                            <i class="bi bi-plus-square nav-icon"></i>
                            <p>Nova Entrada</p>
                        </a>
                    </li>
                    <li class="nav-item">

                        <a href="{{route('entradas.index')}}" class="nav-link">
                            <i class="bi bi-card-list nav-icon"></i>
                            <p>Lista de entradas</p>
                        </a>
                    </li>
                </ul>
            </li>


            <li class="nav-item menu-open">
                <a href="#" class="nav-link">
                    <i class="bi bi-box-arrow-down nav-icon"></i>
                    <p>
                        Saídas
                        <i class="right bi bi-caret-left-fill"></i>
                    </p>
                </a>
                <ul class="nav nav-treeview">
                    <li class="nav-item">
                        <a href="{{route('saidas.create')}}" class="nav-link">
                            <i class="bi bi-plus-square nav-icon"></i>
                            <p>Novo saída</p>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="{{route('saidas.index')}}" class="nav-link">
                            <i class="bi bi-card-list nav-icon"></i>
                            <p>Lista de saídas</p>
                        </a>
                    </li>
                </ul>
            </li>


            <li class="nav-item menu-open">
                <a href="#" class="nav-link">
                    <i class="bi bi-graph-down nav-icon"></i>
                    <p>
                        Financeiro
                        <i class="right bi bi-caret-left-fill"></i>
                    </p>
                </a>
                <ul class="nav nav-treeview">
                    <li class="nav-item">
                        <a href="{{route('relatorios.index')}}" class="nav-link">
                            <i class="bi bi-bar-chart-fill nav-icon"></i>
                            <p>Relatório financeiro</p>
                        </a>
                    </li>
                </ul>
            </li>
            <li class="nav-item menu-open">
                <a href="#" class="nav-link">
                    <i class="bi bi-door-open nav-icon"></i>
                    <p>
                        Fechamento de caixa
                        <i class="right bi bi-caret-left-fill"></i>
                    </p>
                </a>
                <ul class="nav nav-treeview">
                    <li class="nav-item">
                        <a href="{{route('fechamentos.index')}}" class="nav-link">
                            <i class="bi bi-box-arrow-in-left nav-icon"></i>
                            <p>Fechamentos</p>
                        </a>
                    </li>
                </ul>
            </li>

            <li class="nav-item menu-open">
                <a href="#" class="nav-link">
                    <i class="bi bi-boxes"></i>
                    <p>
                        Controle de estoque
                        <i class="right bi bi-caret-left-fill"></i>
                    </p>
                </a>
                <ul class="nav nav-treeview">
                    <li class="nav-item">
                        <a href="{{route('estoques.create')}}" class="nav-link">
                            <i class="bi bi-box-arrow-in-left nav-icon"></i>
                            Cadastro estoque
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="{{route('estoques.index')}}" class="nav-link">
                            <i class="bi bi-ui-checks"></i>
                            Relatório de estoque
                        </a>
                    </li>
                </ul>
            </li>
            <li class="nav-item menu-open">
                <a href="#" class="nav-link">
                    <i class="bi bi-folder-plus nav-icon"></i>
                    <p>
                        Cadastros
                        <i class="right bi bi-caret-left-fill"></i>
                    </p>
                </a>
                <ul class="nav nav-treeview">
                    <li class="nav-item">
                        <a href="{{route('produtos.index')}}" class="nav-link">
                            <i class="bi bi-boxes nav-icon"></i>
                            <p>Produtos</p>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="{{route('users.index')}}" class="nav-link">
                            <i class="bi bi-person-plus nav-icon"></i>
                            <p>Usuarios</p>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="{{route('tipo-pagamentos.index')}}" class="nav-link">
                            <i class="bi bi-credit-card-fill nav-icon"></i>
                            <p>Tipos de pagamentos</p>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="{{route('tipo-saidas.index')}}" class="nav-link">
                            <i class="bi bi-arrow-up-right-square-fill nav-icon"></i>
                            <p>Tipos de saídas</p>
                        </a>
                    </li>
                </ul>
            </li>
        </ul>
    </nav>
    <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
</aside>


{{-- Usuário não admin --}}

@else
<aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <a href="{{route('home')}}" class="brand-link">
      <span class="brand-text font-weight-light">Opção do Bolo</span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">
      <!-- Sidebar user (optional) -->
      <div class="user-panel mt-3 pb-3 mb-3 d-flex">
        <div class="image">
        </div>
        <div class="info d-flex justify-content-between w-100">
            <a href="#">{{auth()->user()->name}}</a>
            <a
                href="{{route('logout')}}"
                onclick="event.preventDefault();
                            document.getElementById('logout-form').submit();"
                            class="btn btn-danger btn-sm">
                            Sair
                            <i class="bi bi-box-arrow-right nav-icon"></i>
            </a>
            <form action="{{route('logout')}}" method="post" style="display: none;" id="logout-form">
                @csrf
            </form>
        </div>
      </div>


      <!-- Sidebar Menu -->
      <nav class="mt-2">
        <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
            <li class="nav-item menu-open">
                <a href="#" class="nav-link">
                    <i class="bi bi-box-arrow-up nav-icon"></i>
                    <p>
                        Cadastro de vendas
                        <i class="right bi bi-caret-left-fill"></i>
                    </p>
                </a>
                <ul class="nav nav-treeview">
                    <li class="nav-item">
                        <a href="{{route('entradas.create')}}" class="nav-link">
                            <i class="bi bi-plus-square nav-icon"></i>
                            <p>Nova venda</p>
                        </a>
                    </li>
                </ul>

            </li>


            <li class="nav-item menu-open">
                <a href="#" class="nav-link">
                    <i class="bi bi-box-arrow-down nav-icon"></i>
                    <p>
                        Saídas
                        <i class="right bi bi-caret-left-fill"></i>
                    </p>
                </a>
                <ul class="nav nav-treeview">
                    <li class="nav-item">
                        <a href="{{route('saidas.create')}}" class="nav-link">
                            <i class="bi bi-plus-square nav-icon"></i>
                            <p>Novo lançamento</p>
                        </a>
                    </li>
                </ul>
            </li>

            <li class="nav-item menu-open">
                <a href="#" class="nav-link">
                    <i class="bi bi-door-open nav-icon"></i>
                    <p>
                        Fechamento de caixa
                        <i class="right bi bi-caret-left-fill"></i>
                    </p>
                </a>
                <ul class="nav nav-treeview">
                    <li class="nav-item">
                        <a href="{{route('fechamentos.create')}}" class="nav-link">
                            <i class="bi bi-box-arrow-in-left nav-icon"></i>
                            <p>Fechar caixa</p>
                        </a>
                    </li>
                </ul>
            </li>


            <li class="nav-item menu-open">
                <a href="#" class="nav-link">
                    <i class="bi bi-boxes"></i>
                    <p>
                        Controle de estoque
                        <i class="right bi bi-caret-left-fill"></i>
                    </p>
                </a>
                <ul class="nav nav-treeview">
                    <li class="nav-item">
                        <a href="{{route('estoques.create')}}" class="nav-link">
                            <i class="bi bi-box-arrow-in-left nav-icon"></i>
                            Cadastro estoque
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="{{route('estoques.index')}}" class="nav-link">
                            <i class="bi bi-ui-checks"></i>
                            Relatório de estoque
                        </a>
                    </li>
                </ul>
            </li>

</ul>
</nav>
<!-- /.sidebar-menu -->
</div>
<!-- /.sidebar -->
</aside>
@endif
</div>




{{-- MENU MOBILE --}}

<div class="menu-mobile pb-5">
    @if (auth()->user()->type_user == "1")
    <nav class="navbar navbar-dark bg-dark fixed-top py-5">
        <div class="container-fluid">
            <a class="navbar-brand" href="{{route('home')}}">
                <span class="brand-text font-weight-light">Opção do Bolo</span>
            </a>
            <button class="navbar-toggler" type="button" data-bs-toggle="offcanvas" data-bs-target="#navbarUserAdmin" aria-controls="navbarUserAdmin" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="offcanvas offcanvas-end text-bg-dark" tabindex="-1" id="navbarUserAdmin" aria-labelledby="navbarUserAdminLabel">
                <div class="offcanvas-header">
                    <h5 class="offcanvas-title" id="navbarUserAdminLabel">Opção do Bolo</h5>
                    <button type="button" class="btn-close btn-close-white" data-bs-dismiss="offcanvas" aria-label="Close"></button>
                </div>
                <div class="offcanvas-body">
                    <div class="info d-flex justify-content-between w-100">
                        <a href="#">{{auth()->user()->name}}</a>
                        <a
                            href="{{route('logout')}}"
                            onclick="event.preventDefault();
                                        document.getElementById('logout-form').submit();"
                                        class="btn btn-danger btn-sm">
                                        Sair
                                        <i class="bi bi-box-arrow-right nav-icon"></i>
                        </a>
                        <form action="{{route('logout')}}" method="post" style="display: none;" id="logout-form">
                            @csrf
                        </form>
                    </div>
                    <a href="#" class="nav-link">

                    </a>
                    <ul class="navbar-nav justify-content-end flex-grow-1 pe-3">
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                                <i class="bi bi-box-arrow-up nav-icon"></i>
                                Entrada
                            </a>
                            <ul class="dropdown-menu dropdown-menu-dark">
                                <li>
                                    <a href="{{route('entradas.create')}}" class="dropdown-item">
                                        <i class="bi bi-plus-square nav-icon"></i>
                                        Nova Entrada
                                    </a>
                                </li>
                                <li>
                                    <a href="{{route('entradas.index')}}" class="dropdown-item">
                                        <i class="bi bi-card-list nav-icon"></i>
                                        Lista de entradas
                                    </a>
                                </li>
                            </ul>
                        </li>
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                                <i class="bi bi-box-arrow-down nav-icon"></i>
                                Saídas
                            </a>
                            <ul class="dropdown-menu dropdown-menu-dark">
                                <li>
                                    <a href="{{route('saidas.create')}}" class="dropdown-item">
                                        <i class="bi bi-plus-square nav-icon"></i>
                                        Novo saída
                                    </a>
                                </li>
                                <li>
                                    <a href="{{route('saidas.index')}}" class="dropdown-item">
                                        <i class="bi bi-card-list nav-icon"></i>
                                        Lista de saídas
                                    </a>
                                </li>
                            </ul>
                        </li>
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                                <i class="bi bi-graph-down nav-icon"></i>
                                Financeiro
                            </a>
                            <ul class="dropdown-menu dropdown-menu-dark">
                                <li>
                                    <a href="{{route('relatorios.index')}}" class="dropdown-item">
                                        <i class="bi bi-bar-chart-fill nav-icon"></i>
                                        Relatório financeiro
                                    </a>
                                </li>
                            </ul>
                        </li>
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                                <i class="bi bi-door-open nav-icon"></i>
                                Fechamento de caixa
                            </a>
                            <ul class="dropdown-menu dropdown-menu-dark">
                                <li>
                                    <a href="{{route('fechamentos.index')}}" class="dropdown-item">
                                        <i class="bi bi-box-arrow-in-left nav-icon"></i>
                                        Fechamentos
                                    </a>
                                </li>
                            </ul>
                        </li>

                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                                <i class="bi bi-boxes"></i>
                                Controle de estoque
                            </a>
                            <ul class="dropdown-menu dropdown-menu-dark">
                                <li>
                                    <a href="{{route('estoques.create')}}" class="dropdown-item">
                                        <i class="bi bi-box-arrow-in-left nav-icon"></i>
                                        Cadastro estoque
                                    </a>
                                </li>
                                <li>
                                    <a href="{{route('estoques.index')}}" class="dropdown-item">
                                        <i class="bi bi-ui-checks"></i>
                                        Relatório de estoque
                                    </a>
                                </li>
                            </ul>
                        </li>

                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                                <i class="bi bi-folder-plus nav-icon"></i>
                                Cadastros
                            </a>
                            <ul class="dropdown-menu dropdown-menu-dark">
                                <li class="nav-item">
                                    <a href="{{route('produtos.index')}}" class="dropdown-item">
                                        <i class="bi bi-boxes nav-icon"></i>
                                        Produtos
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a href="{{route('users.index')}}" class="dropdown-item">
                                        <i class="bi bi-person-plus nav-icon"></i>
                                        Usuarios
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a href="{{route('tipo-pagamentos.index')}}" class="dropdown-item">
                                        <i class="bi bi-credit-card-fill nav-icon"></i>
                                        Tipos de pagamentos
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a href="{{route('tipo-saidas.index')}}" class="dropdown-item">
                                        <i class="bi bi-arrow-up-right-square-fill nav-icon"></i>
                                        Tipos de saídas
                                    </a>
                                </li>
                            </ul>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </nav>


   <!-- Usuário não admin -->

    @else
    <nav class="navbar navbar-dark bg-dark fixed-top">
        <div class="container-fluid">
            <a class="navbar-brand" href="{{route('home')}}">
                <span class="brand-text font-weight-light">Opção do Bolo</span>
            </a>
            <button class="navbar-toggler" type="button" data-bs-toggle="offcanvas" data-bs-target="#navbarUserAdmin" aria-controls="navbarUserAdmin" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="offcanvas offcanvas-end text-bg-dark" tabindex="-1" id="navbarUserAdmin" aria-labelledby="navbarUserAdminLabel">
                <div class="offcanvas-header">
                    <h5 class="offcanvas-title" id="navbarUserAdminLabel">Opção do Bolo</h5>
                    <button type="button" class="btn-close btn-close-white" data-bs-dismiss="offcanvas" aria-label="Close"></button>
                </div>
                <div class="offcanvas-body">
                    <div class="info d-flex justify-content-between w-100">
                        <a href="#" class="nav-link">{{auth()->user()->name}}</a>
                        <a
                            href="{{route('logout')}}"
                            onclick="event.preventDefault();
                                        document.getElementById('logout-form').submit();"
                                        class="btn btn-danger btn-sm">
                                        Sair
                                        <i class="bi bi-box-arrow-right nav-icon"></i>
                        </a>
                        <form action="{{route('logout')}}" method="post" style="display: none;" id="logout-form">
                            @csrf
                        </form>
                    </div>
                    <hr>
                    <ul class="navbar-nav justify-content-end flex-grow-1 pe-3">
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                                <i class="bi bi-box-arrow-up nav-icon"></i>
                                Entrada
                            </a>
                            <ul class="dropdown-menu dropdown-menu-dark">
                                <li>
                                    <a href="{{route('entradas.index')}}" class="dropdown-item">
                                        <i class="bi bi-card-list nav-icon"></i>
                                        Lista de entradas
                                    </a>
                                </li>
                                <li>
                                    <a href="{{route('entradas.create')}}" class="dropdown-item">
                                        <i class="bi bi-plus-square nav-icon"></i>
                                        Nova Entrada
                                    </a>
                                </li>
                            </ul>
                        </li>
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                                <i class="bi bi-box-arrow-down nav-icon"></i>
                                Saídas
                            </a>
                            <ul class="dropdown-menu dropdown-menu-dark">
                                <li>
                                    <a href="{{route('saidas.create')}}" class="dropdown-item">
                                        <i class="bi bi-plus-square nav-icon"></i>
                                        Novo saída
                                    </a>
                                </li>
                                <li>
                                    <a href="{{route('saidas.index')}}" class="dropdown-item">
                                        <i class="bi bi-card-list nav-icon"></i>
                                        Lista de saídas
                                    </a>
                                </li>
                            </ul>
                        </li>

                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                                <i class="bi bi-boxes"></i>
                                Controle de estoque
                            </a>
                            <ul class="dropdown-menu dropdown-menu-dark">
                                <li>
                                    <a href="{{route('estoques.create')}}" class="dropdown-item">
                                        <i class="bi bi-box-arrow-in-left nav-icon"></i>
                                        Cadastro estoque
                                    </a>
                                </li>
                                <li>
                                    <a href="{{route('estoques.index')}}" class="dropdown-item">
                                        <i class="bi bi-ui-checks"></i>
                                        Relatório de estoque
                                    </a>
                                </li>
                            </ul>
                        </li>
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                                <i class="bi bi-door-open nav-icon"></i>
                                Fechamento de caixa
                            </a>
                            <ul class="dropdown-menu dropdown-menu-dark">
                                <li>
                                    <a href="{{route('fechamentos.create')}}" class="dropdown-item">
                                        <i class="bi bi-box-arrow-in-left nav-icon"></i>
                                        Fechar caixa
                                    </a>
                                </li>
                            </ul>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </nav>
    @endif
    </div>
