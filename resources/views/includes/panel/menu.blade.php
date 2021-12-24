<h6 class="navbar-heading text-muted">Gestion de datos</h6>
<ul class="navbar-nav">
    <li class="nav-item">
        <a class="nav-link" href="{{ route('home') }}">
            <i class="ni ni-tv-2 text-primary"></i> Dashboard
        </a>
    </li>
    <li class="nav-item">
        <a class="nav-link" href="{{ route('specialties.index') }}">
            <i class="ni ni-planet text-blue"></i> Especialidades
        </a>
    </li>
    <li class="nav-item">
        <a class="nav-link" href="{{ route('doctors.index') }}">
            <i class="ni ni-pin-3 text-orange"></i> Medicos
        </a>
    </li>
    <li class="nav-item">
        <a class="nav-link" href="./examples/profile.html">
            <i class="ni ni-single-02 text-yellow"></i> Pacientes
        </a>
    </li>

</ul>

<hr class="my-3">

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
    <li class="nav-item">
        <a class="nav-link" href="#" onclick="event.preventDefault(); document.getElementById('formLogout').submit();">
            <i class="ni ni-ui-04"></i> Cerrar Sesion
        </a>
        <form action="{{ route('logout') }}" method="POST" style="display: none" id="formLogout">
            @csrf
        </form>
    </li>
</ul>
