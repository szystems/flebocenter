<!-- Sidebar wrapper start -->
<nav class="sidebar-wrapper">
    <!-- Sidebar menu starts -->
    <div class="sidebar-menu">
        <div class="sidebarMenuScroll">
            <ul>
                @if (Auth::user()->role_as == 0)
                <li class="active">
                    <a href="{{ url('show-user/'.Auth::user()->id) }}">
                        <span class="avatar">
                            @if (Auth::user()->fotografia != null)
                                <img src="{{ asset('assets/imgs/users/'.Auth::user()->fotografia) }}" alt="Doctores" class="img-thumbnail rounded-4 border-success m-2 img-fluid" style="height: 40px;"/>
                            @else
                                <img src="{{ asset('assets/imgs/users/doctoricon.png') }}" alt="Doctores" class="img-thumbnail rounded-4 border-success m-2 img-fluid" style="height: 40px;"/>
                            @endif
                            <span class="status online"></span>
                        </span>
                        @php
                            $usuario = Auth::user()->name;
                            $nombre = explode(' ', trim($usuario));
                        @endphp
                        <span class="menu-text">Dr(a). <u><strong> {{ ucwords($nombre[0]) }}</strong></u></span>
                        @php
                            $hoy = Carbon\Carbon::now('America/Guatemala');
                            $hoy = $hoy->format('Y-m-d');
                            $cita_count = \App\Models\Cita::where('fecha_cita',$hoy)->where('estado','Confirmada')->where('doctor_id',Auth::user()->id)->count();


                        @endphp
                        <span class="badge red">Hoy {{ $cita_count }}</span>
                    </a>
                </li>
                @endif

                <li class="{{ Request::is('dashboard') ? 'active-page-link':''  }}">
                    <a href="{{ url('/dashboard') }}">
                        <i class="bi bi-house"></i>
                        <span class="menu-text">Panel de Control</span>
                    </a>
                </li>
                <li>
                    <a href="{{ url('/') }}">
                        <i class="bi bi-globe"></i>
                        <span class="menu-text">Sitio Web</span>
                    </a>
                </li>
                <li class="{{ Request::is('citas','show-cita/*','add-cita','edit-cita/*') ? 'active-page-link':''  }}">
                    <a href="{{ url('citas') }}">
                        <i class="bi bi-calendar2-week"></i>
                        <span class="menu-text">Citas</span>
                        @php
                            $hoy = Carbon\Carbon::now('America/Guatemala');
                            $hoy = $hoy->format('Y-m-d');
                            $cita_count = \App\Models\Cita::where('fecha_cita',$hoy)->where('estado','Confirmada')->count();


                        @endphp
                        <span class="badge green">Hoy {{ $cita_count }}</span>
                    </a>
                </li>
                <li class="{{ Request::is('pacientes','show-paciente/*','add-paciente','edit-paciente/*') ? 'active-page-link':''  }}">
                    <a href="{{ url('pacientes') }}">
                        <i class="bi bi-person"></i>
                        <span class="menu-text">Pacientes</span>
                        {{-- <span class="badge green">15</span> --}}
                    </a>
                </li>
                <li class="{{ Request::is('users','show-user/*','add-user','edit-user/*') ? 'active-page-link':''  }}">
                    <a href="{{ url('users') }}">
                        <i class="bi bi-shield-plus"></i>
                        <span class="menu-text">Doctores</span>
                        {{-- <span class="badge green">15</span> --}}
                    </a>
                </li>
                {{-- <li class="sidebar-dropdown {{ Request::is('users','show-user/*','add-user','edit-user/*') ? 'show active':''  }}">
                    <a href="#">
                        <i class="bi bi-shield-plus"></i>
                        <span class="menu-text">Doctores</span>
                    </a>
                    <div class="sidebar-submenu">
                        <ul>
                            <li class="{{ Request::is('users','show-user/*','add-user','edit-user/*') ? 'active-page-link':''  }}">
                                <a href="{{ url('users') }}">Doctores</a>
                            </li>
                            <li>
                                <a href="#">Especialidades</a>
                            </li>
                        </ul>
                    </div>
                </li> --}}
                <li class="{{ Request::is('asistentes','show-asistente/*','add-asistente','edit-asistente/*') ? 'active-page-link':''  }}">
                    <a href="{{ url('asistentes') }}">
                        <i class="bi bi-person-workspace"></i>
                        <span class="menu-text">Asistentes</span>
                    </a>
                </li>
                <li class="{{ Request::is('clinicas','show-clinica/*','add-clinica','edit-clinica/*') ? 'active-page-link':''  }}">
                    <a href="{{ url('clinicas') }}">
                        <i class="bi bi-hospital"></i>
                        <span class="menu-text">Clínicas</span>
                    </a>
                </li>
                <li class="{{ Request::is('inventario') ? 'active-page-link':''  }}">
                    <a href="{{ url('') }}">
                        <i class="bi bi-inboxes"></i>
                        <span class="menu-text">Inventario</span>
                    </a>
                </li>
                <li class="sidebar-dropdown">
                    <a href="#">
                        <i class="bi bi-boxes"></i>
                        <span class="menu-text">Almacén</span>
                        {{-- <span class="badge red">15</span> --}}
                    </a>
                    <div class="sidebar-submenu">
                        <ul>
                            <li class="{{ Request::is('articulos','show-articulo/*','add-articulo','edit-articulo/*') ? 'active-page-link':''  }}">
                                <a href="{{ url('') }}"><i class="bi bi-boxes"></i> Articulos</a>
                            </li>
                        </ul>
                        <ul>
                            <li class="{{ Request::is('categorias','show-categoria/*','add-categoria','edit-categoria/*') ? 'active-page-link':''  }}">
                                <a href="{{ url('') }}"><i class="bi bi-diagram-3"></i> Categorías</a>
                            </li>
                        </ul>
                    </div>
                </li>
                <li class="sidebar-dropdown">
                    <a href="#">
                        <i class="bi bi-cart4"></i>
                        <span class="menu-text">Compras</span>
                        {{-- <span class="badge red">15</span> --}}
                    </a>
                    <div class="sidebar-submenu">
                        <ul>
                            <li class="{{ Request::is('ingresos','show-ingreso/*','add-ingreso','edit-ingreso/*') ? 'active-page-link':''  }}">
                                <a href="{{ url('') }}"><i class="bi bi-cart-plus"></i> Ingresos</a>
                            </li>
                        </ul>
                        <ul>
                            <li class="{{ Request::is('proveedores','show-proveedor/*','add-proveedor','edit-proveedor/*') ? 'active-page-link':''  }}">
                                <a href="{{ url('') }}"><i class="bi bi-person-video2"></i> Proveedores</a>
                            </li>
                        </ul>
                    </div>
                </li>
                <li class="sidebar-dropdown">
                    <a href="#">
                        <i class="bi bi-cash-stack"></i>
                        <span class="menu-text">Ventas</span>
                        {{-- <span class="badge red">15</span> --}}
                    </a>
                    <div class="sidebar-submenu">
                        <ul>
                            <li class="{{ Request::is('ventas','show-venta/*','add-venta','edit-venta/*') ? 'active-page-link':''  }}">
                                <a href="{{ url('') }}"><i class="bi bi-cash-stack"></i> Ventas</a>
                            </li>
                        </ul>
                        {{-- <ul>
                            <li class="{{ Request::is('cotizaciones','show-cotizacion/*','add-cotizacion','edit-cotizacion/*') ? 'active-page-link':''  }}">
                                <a href="{{ url('') }}"><i class="bi bi-person-video2"></i> Cotizaciones</a>
                            </li>
                        </ul> --}}
                    </div>
                </li>
                <li class="{{ Request::is('config') ? 'active-page-link':''  }}">
                    <a href="{{ url('config') }}">
                        <i class="bi bi-gear"></i>
                        <span class="menu-text">Configuración</span>
                    </a>
                </li>
            </ul>
        </div>
    </div>
    <!-- Sidebar menu ends -->

</nav>
<!-- Sidebar wrapper end -->
