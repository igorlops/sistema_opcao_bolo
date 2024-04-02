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
                        <a href="{{route('saidas.index')}}?tipo=cliente" class="nav-link">
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
<aside class="sidebar-dark-primary">
    <!-- Brand Logo -->
    <a href="{{route('home')}}" class="brand-link">
      <span class="brand-text font-weight-light">Opção do Bolo</span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">
      <!-- Sidebar user (optional) -->
      <div class="mt-3 pb-3 mb-3 d-flex">
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
        <ul class="nav nav-pills nav-sidebar flex-row" data-widget="treeview" role="menu" data-accordion="false">
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

</ul>
</nav>
<!-- /.sidebar-menu -->
</div>
<!-- /.sidebar -->
</aside>
@endif