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
                            <i class="fas fa-share-square"></i>
            </a>
            <form action="{{route('logout')}}" method="post" style="display: none;" id="logout-form">
                @csrf
            </form>
        </div>
      </div>


      <!-- Sidebar Menu -->
      <nav class="mt-2">
        <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
            @if (auth()->user()->type_user == "1")
            <li class="nav-item menu-open">
                <a href="{{route('home')}}" class="nav-link">
                    <i class="nav-icon fas fa-tachometer-alt"></i>
                    <p>
                        Dashboard
                    </p>
                </a>
            </li>
            <li class="nav-item menu-open">
                <a href="#" class="nav-link">
                    <i class="nav-icon fas fa-arrow-circle-down"></i>
                    <p>
                        Entrada
                        <i class="right fas fa-angle-left"></i>
                    </p>
                </a>
                <ul class="nav nav-treeview">
                    <li class="nav-item">
                        <a href="{{route('entradas.create')}}" class="nav-link">
                            <i class="fas fa-dollar-sign nav-icon"></i>
                            <p>Nova Entrada</p>
                        </a>
                    </li>
                    <li class="nav-item">

                        <a href="{{route('entradas.index')}}" class="nav-link">
                            <i class="fas fa-list-alt nav-icon"></i>
                            <p>Lista de entradas</p>
                        </a>
                    </li>
                </ul>
            </li>


            <li class="nav-item menu-open">
                <a href="#" class="nav-link">
                    <i class="nav-icon fas fa-arrow-circle-up"></i>
                    <p>
                        Saídas
                        <i class="right fas fa-angle-left"></i>
                    </p>
                </a>
                <ul class="nav nav-treeview">
                    <li class="nav-item">
                        <a href="{{route('saidas.create')}}" class="nav-link">
                            <i class="fas fa-file nav-icon"></i>
                            <p>Novo saída</p>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="{{route('saidas.index')}}?tipo=cliente" class="nav-link">
                            <i class="fas fa-list-alt nav-icon"></i>
                            <p>Lista de saídas</p>
                        </a>
                    </li>
                </ul>
            </li>


            <li class="nav-item menu-open">
                <a href="#" class="nav-link">
                    <i class="nav-icon fas fa-money-check-alt"></i>
                    <p>
                        Financeiro
                        <i class="right fas fa-angle-left"></i>
                    </p>
                </a>
                <ul class="nav nav-treeview">
                    <li class="nav-item">
                        <a href="{{route('relatorios.index')}}" class="nav-link">
                            <i class="fas fa-chart-pie nav-icon"></i>
                            <p>Relatório financeiro</p>
                        </a>
                    </li>
                </ul>
            </li>

            <li class="nav-item menu-open">
                <a href="#" class="nav-link">
                    <i class="nav-icon fas fa-box"></i>
                    <p>
                        Cadastros
                        <i class="right fas fa-angle-left"></i>
                    </p>
                </a>
                <ul class="nav nav-treeview">
                    <li class="nav-item">
                        <a href="{{route('produtos.index')}}" class="nav-link">
                            <i class="fas fa-boxes dollar-sign nav-icon"></i>
                            <p>Produtos</p>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="{{route('users.index')}}" class="nav-link">
                            <i class="fas fa-users dollar-sign nav-icon"></i>
                            <p>Usuarios</p>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="{{route('tipo-pagamentos.index')}}" class="nav-link">
                            <i class="fas fa-card nav-icon"></i>
                            <p>Tipos de pagamentos</p>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="{{route('tipo-saidas.index')}}" class="nav-link">
                            <i class="fas fa-card nav-icon"></i>
                            <p>Tipos de saídas</p>
                        </a>
                    </li>
                </ul>
            </li>


            {{-- Usuário não admin --}}

            @else
            <li class="nav-item menu-open">
                <a href="#" class="nav-link">
                    <i class="nav-icon fas fa-arrow-circle-up"></i>
                    <p>
                        Cadastro de vendas
                        <i class="right fas fa-angle-left"></i>
                    </p>
                </a>
                <ul class="nav nav-treeview">
                    <li class="nav-item">
                        <a href="{{route('entradas.create')}}" class="nav-link">
                            <i class="fas fa-file nav-icon"></i>
                            <p>Nova venda</p>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="{{route('entradas.index')}}" class="nav-link">
                            <i class="fas fa-file nav-icon"></i>
                            <p>Vendas realizadas</p>
                        </a>
                    </li>
                </ul>

            </li>


            <li class="nav-item menu-open">
                <a href="#" class="nav-link">
                    <i class="nav-icon fas fa-money-check-alt"></i>
                    <p>
                        Saídas
                        <i class="right fas fa-angle-left"></i>
                    </p>
                </a>
                <ul class="nav nav-treeview">
                    <li class="nav-item">
                        <a href="{{route('saidas.create')}}" class="nav-link">
                            <i class="fas fa-dollar-sign nav-icon"></i>
                            <p>Novo lançamento</p>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="{{route('saidas.index')}}" class="nav-link">
                            <i class="fas fa-dollar-sign nav-icon"></i>
                            <p>Saídas realizadas</p>
                        </a>
                    </li>
                </ul>
            </li>

            <li class="nav-item menu-open">
                <a href="#" class="nav-link">
                    <i class="nav-icon fas fa-box"></i>
                    <p>
                        Fechamento de caixa
                        <i class="right fas fa-angle-left"></i>
                    </p>
                </a>
                <ul class="nav nav-treeview">
                    <li class="nav-item">
                        <a href="{{route('fechamentos.create')}}" class="nav-link">
                            <i class="fas fa-boxes dollar-sign nav-icon"></i>
                            <p>Fechar caixa</p>
                        </a>
                    </li>
                </ul>
            </li>
            @endif
        </ul>
      </nav>
      <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
  </aside>
