<aside class="main-sidebar sidebar-dark-primary elevation-4">

    <a href="{{ route('index') }}" class="brand-link">
        <img src="{{ asset('img/lobo1.jpg') }}" alt="AdminLTE Logo" class="brand-image img-circle elevation-3" style="opacity: .8">
        <span class="brand-text font-weight-light">CFOWOLF</span>
    </a>

    <div class="sidebar">

        <div class="user-panel mt-3 pb-3 mb-3 d-flex">
            <div class="image">
                <img src="{{ asset('layouts/AdminLTE/dist/img/user2-160x160.jpg') }}" class="img-circle elevation-2" alt="User Image">
            </div>
            <div class="info">
                <a href="#" class="d-block">
                    {{ auth()->user()->personal->getName() }}
                </a>
            </div>
        </div>

        <div class="form-inline">
            <div class="input-group" data-widget="sidebar-search">
                <input class="form-control form-control-sidebar" type="search" placeholder="Search" aria-label="Search">
                <div class="input-group-append">
                    <button class="btn btn-sidebar">
                        <i class="fas fa-search fa-fw"></i>
                    </button>
                </div>
            </div>
        </div>

        {{-- <nav class="mt-2">
            <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
                @if (isset($modulo) && !empty($modulo))
                    @foreach($modulo as $item)
                        <li class="nav-item ">
                            <a href="#" class="nav-link ">
                                <i class="nav-icon {{ $item->icons }}"></i>
                                <p>
                                    {{ $item->nombre_modulo }} 
                                    <i class="right fas fa-angle-left"></i>
                                </p>
                            </a>
                            <ul class="nav nav-treeview"> 
                                @foreach($item->menus as $subitem)
                                <li class="nav-item"> 
                                        <a href="{{route ($subitem->route) }}" class="nav-link active">
                                        <i class="far fa-circle nav-icon"></i>
                                        <p> {{ $subitem->nombre_menu }}</p>
                                    </a>
                                </li>
                                @endforeach
                            </ul>
                        </li>
                    @endforeach
                @endif
            </ul>


        </nav> --}}

        <nav class="mt-2">
            <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
                @php
                   $domain = request()->root().'/';
                   $activeM = "";
                   $menuOpen = "";
                @endphp

                @forelse ($menu as $item)
                    @if (!empty($item))
                        
                        @foreach($item->submenus as $subitem)
                        @if (!empty($subitem))
                            
                            @php
                                $ruta = route($subitem->route);
                                $path = str_replace($domain, '', $ruta); //.'/*';
                                $sub_path = str_replace($domain, '', $ruta).'/*';
                                $is_route = request()->is($path) ;
                                $is_sub_route = request()->is($sub_path) ;
                                $active = '';

                                if($is_route || $is_sub_route) {
                                    $active = '';
                                    $activeM = 'active';
                                    $menuOpen = 'menu-open';
                                }
                            @endphp
                       
                        @endif
                        @endforeach
                   
                    <li class="nav-item {{$menuOpen}}">
                        <a href="#" class="nav-link {{$activeM}}">
                            <i class="nav-icon {{ $item->icons }}"></i>
                            <p>
                                {{ $item->nombre_menu }} 
                                <i class="right fas fa-angle-left"></i>
                            </p>
                        </a>
                        <ul class="nav nav-treeview">

                            {{-- dd($item->submenus, $item, $menu)--}}
                            @foreach($item->submenus as $subitem)
                            @if (!empty($subitem))
                                @php
                                    $ruta = route($subitem->route);
                                    $path = str_replace($domain, '', $ruta); //.'/*';
                                    $sub_path = str_replace($domain, '', $ruta).'/*';
                                    $is_route = request()->is($path) ;
                                    $is_sub_route = request()->is($sub_path) ;
                                    $active = '';

                                    if($is_route || $is_sub_route) {
                                        $active = 'active';
                                        $activeM = "";
                                        $menuOpen = "";
                                    }
                                @endphp
                                <li class="nav-item">
                                    <a href="{{route ($subitem->route) }}" class="nav-link {{$active}}">
                                        <i class="far fa-circle nav-icon"></i>
                                        <p> {{ $subitem->nombre }}</p>
                                    </a>
                                </li>
                            @endif
                            @endforeach
                        </ul>
                    </li>
                    @endif
                @empty
                    
                @endforelse
            </ul>


        </nav>

    </div>

</aside>