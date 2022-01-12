<h6 class="navbar-heading text-muted">
    {{ auth()->user()->role == "admin" ? "Gestionar datos" : "Menu"}}
</h6>
<ul class="navbar-nav">

   @include('includes.panel.rolMenu.'.auth()->user()->role)
        <li class="nav-item">
            <a class="nav-link" href="#" onclick="event.preventDefault(); document.getElementById('formLogout').submit();">
                <i class="ni ni-ui-04"></i> Cerrar Sesion
            </a>
            <form action="{{ route('logout') }}" method="POST" style="display: none" id="formLogout">
                @csrf
            </form>
        </li>
</ul>

<hr class="my-3">

@if(auth()->user()->role == "admin")

<h6 class="navbar-heading text-muted">Reportes</h6>

<ul class="navbar-nav mb-md-3">
    <li class="nav-item">
        <a class="nav-link" href="https://demos.creative-tim.com/argon-dashboard/docs/getting-started/overview.html">
            <i class="ni ni-spaceship"></i> Frecuencia de citas
        </a>
    </li>

    <li class="nav-item">
        <a class="nav-link" href="https://demos.creative-tim.com/argon-dashboard/docs/getting-started/overview.html">
            <i class="ni ni-spaceship"></i> Medicos mas activos
        </a>
    </li>

</ul>

@endif
