<!-- Sidebar wrapper start -->
<nav class="sidebar-wrapper">
    <!-- Sidebar menu starts -->
    <div class="sidebar-menu">
        <div class="sidebarMenuScroll">
            <ul>
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
                        <span class="badge green">15</span>
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

            </ul>
        </div>
    </div>
    <!-- Sidebar menu ends -->

</nav>
<!-- Sidebar wrapper end -->
