<ul class="nav align-items-center d-md-none">
    <li class="nav-item dropdown">
        <a class="nav-link nav-link-icon" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
            <i class="ni ni-bell-55"></i>
        </a>
        <div class="dropdown-menu dropdown-menu-arrow dropdown-menu-right" aria-labelledby="navbar-default_dropdown_1">
            <a class="dropdown-item" href="#">Acciones</a>

        </div>
    </li>
    <li class="nav-item dropdown">
        <a class="nav-link" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
            <div class="media align-items-center">
              <span class="avatar avatar-sm rounded-circle">
                    @if(auth()->user()->photo)
                      <img alt="Image placeholder" src="{{ asset('storage/photosProfile/'.auth()->user()->photo) }}">
                  @else
                      <img alt="Image placeholder" src="{{ asset('assets/img/theme/profile.png') }}">

                  @endif
              </span>
            </div>
        </a>
        @include('includes.panel.dropdown.menu')
    </li>
</ul>
