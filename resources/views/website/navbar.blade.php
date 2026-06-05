<nav class="navbar navbar-expand-lg navbar-light bg-white sticky-top shadow-sm py-3">
  <div class="container">
    <a class="navbar-brand fw-bold fs-4" href="#">
      <img src="{{ asset('assets/images/core/logo.png') }}" 
           alt="Logo" 
           height="30" 
           class="d-inline-block align-text-top me-2">
    </a>
    <button class="navbar-toggler border-0 " 
            type="button" 
            data-bs-toggle="collapse" 
            data-bs-target="#navbarNavLanding">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse justify-content-between" id="navbarNavLanding">
      
      <ul class="navbar-nav ms-auto mb-2 mb-lg-0 fw-medium">
        <li class="nav-item">
          <a class="nav-link active text-success"
             href="#hero">
            Beranda
          </a>
        </li>
        <li class="nav-item dropdown">
          <a class="nav-link dropdown-toggle text-success" 
             href="#" 
             role="button" 
             data-bs-toggle="dropdown">
            Tentang
          </a>
          <ul class="dropdown-menu">
            <li><a class="dropdown-item text-success" href="#tentang">Profil</a></li>
            <li><a class="dropdown-item text-success" href="#visi">Visi & Misi</a></li>
          </ul>
        </li>
        <li class="nav-item">
          <a class="nav-link text-success" href="#program">
            Program
          </a>
        </li>
        <li class="nav-item">
          <a class="nav-link text-success" href="#gallery">
            Gallery
          </a>
        </li>
        <li class="nav-item dropdown">
          <a class="nav-link dropdown-toggle text-success" 
             href="#" 
             role="button" 
             data-bs-toggle="dropdown">
            Media
          </a>
          <ul class="dropdown-menu">
            <li><a class="dropdown-item text-success" href="#berita">Berita</a></li>
            <li><a class="dropdown-item text-success" href="#informasi">Informasi</a></li>
          </ul>
        </li>
        <li class="nav-item">
          <a class="nav-link text-success" href="#infaq">
            Infaq
          </a>
        </li>

      </ul>

    </div>
  </div>
</nav>

<style>
  .navbar-light .navbar-toggler-icon {
    background-image: url("data:image/svg+xml,%3csvg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 30 30'%3e%3cpath stroke='rgba(25, 135, 84, 1)' stroke-linecap='round' stroke-miterlimit='10' stroke-width='2' d='M4 7h22M4 15h22M4 23h22'/%3e%3c/svg%3e");
  }
  .navbar-toggler {
    color: #198754;
    border-color: #198754;
  }
  
  .nav-link {
    position: relative;
    text-decoration: none;
    display: inline-block;
  }

  .nav-link::before {
    content: "";
    position: absolute;
    left: 0;
    bottom: -4px;

    width: 100%;
    height: 2px;
    background-color: #198754;

    transform: scaleX(0);
    transform-origin: center;
    transition: transform 0.4s cubic-bezier(0.68, -0.55, 0.27, 1.55);
  }

  .nav-link:hover::before {
    transform: scaleX(1);
  }
  
  .nav-link.active::before {
    transform: scaleX(1);
  }

  .dropdown-toggle::after {
    margin-left: 6px;
    vertical-align: middle;
  }

  .nav-link:hover,
  .nav-link:focus {
    text-decoration: none;
  }

  <nav class="navbar navbar-expand-lg navbar-light bg-white sticky-top shadow-sm py-3">
  <div class="container">
    <a class="navbar-brand fw-bold fs-4" href="#">
      <img src="{{ asset('assets/images/core/logo.png') }}" 
           alt="Logo" 
           height="30" 
           class="d-inline-block align-text-top me-2">
    </a>
    <button class="navbar-toggler border-0 " 
            type="button" 
            data-bs-toggle="collapse" 
            data-bs-target="#navbarNavLanding">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse justify-content-between" id="navbarNavLanding">
      
      <ul class="navbar-nav ms-auto mb-2 mb-lg-0 fw-medium">
        <li class="nav-item">
          <a class="nav-link active text-success"
             href="#hero">
            Beranda
          </a>
        </li>
        <li class="nav-item dropdown">
          <a class="nav-link dropdown-toggle text-success" 
             href="#" 
             role="button" 
             data-bs-toggle="dropdown">
            Tentang
          </a>
          <ul class="dropdown-menu">
            <li><a class="dropdown-item text-success" href="#tentang">Profil</a></li>
            <li><a class="dropdown-item text-success" href="#visi">Visi & Misi</a></li>
          </ul>
        </li>
        <li class="nav-item">
          <a class="nav-link text-success" href="#program">
            Program
          </a>
        </li>
        <li class="nav-item">
          <a class="nav-link text-success" href="#gallery">
            Gallery
          </a>
        </li>
        <li class="nav-item dropdown">
          <a class="nav-link dropdown-toggle text-success" 
             href="#" 
             role="button" 
             data-bs-toggle="dropdown">
            Media
          </a>
          <ul class="dropdown-menu">
            <li><a class="dropdown-item text-success" href="#berita">Berita</a></li>
            <li><a class="dropdown-item text-success" href="#informasi">Informasi</a></li>
          </ul>
        </li>
        <li class="nav-item">
          <a class="nav-link text-success" href="#infaq">
            Infaq
          </a>
        </li>

      </ul>

    </div>
  </div>
</nav>

<style>
  .navbar-light .navbar-toggler-icon {
    background-image: url("data:image/svg+xml,%3csvg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 30 30'%3e%3cpath stroke='rgba(25, 135, 84, 1)' stroke-linecap='round' stroke-miterlimit='10' stroke-width='2' d='M4 7h22M4 15h22M4 23h22'/%3e%3c/svg%3e");
  }
  .navbar-toggler {
    color: #198754;
    border-color: #198754;
  }
  
  .nav-link {
    position: relative;
    text-decoration: none;
    display: inline-block;
  }

  .nav-link::before {
    content: "";
    position: absolute;
    left: 0;
    bottom: -6px;

    width: 100%;
    height: 2px;
    background-color: #198754;

    transform: scaleX(0);
    transform-origin: center;
    transition: transform 0.4s cubic-bezier(0.68, -0.55, 0.27, 1.55);
  }

  .nav-link:hover::before {
    transform: scaleX(1);
  }
  
  .nav-link.active::before {
    transform: scaleX(1);
  }

  .dropdown-toggle::after {
    margin-left: 6px;
    vertical-align: middle;
  }

  .nav-link:hover,
  .nav-link:focus {
    text-decoration: none;
  }

  @media (min-width: 992px) {
    .nav-item.dropdown {
      position: relative;
    }

    .nav-item.dropdown .dropdown-menu {
      display: none;
      position: absolute;
      
      top: 100%;
      left: 0;

      margin-top: 6px;
      
      transform: none
      inset: unset
    }

    .nav-item.dropdown:hover .dropdown-menu {
      display: block;
    }
  }
</style>