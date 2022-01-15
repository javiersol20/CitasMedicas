<div class="dropdown-menu dropdown-menu-arrow dropdown-menu-right">
    <div class=" dropdown-header noti-title">
        <h6 class="text-overflow m-0">Bienvenido!</h6>
    </div>

    <div class="dropdown-divider"></div>
    <a href="#" class="dropdown-item" onclick="event.preventDefault(); document.getElementById('formLogout').submit()">
        <i class="ni ni-user-run"></i>
        <span>Salir</span>
    </a>
    <form action="{{ route('logout') }}" method="POST" style="display: none" id="formLogoutNav">
        @csrf
    </form>
</div>
