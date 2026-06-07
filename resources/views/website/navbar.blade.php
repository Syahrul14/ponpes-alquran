<nav class="navbar navbar-expand-lg navbar-custom sticky-top py-3">

  <div class="container">

    <!-- LOGO -->
    <a class="navbar-brand fw-bold" href="#">
      <img src="{{ asset('assets/images/core/logo.png') }}"
           alt="Logo"
           height="30"
           class="d-inline-block align-text-top me-2">
    </a>

    <!-- TOGGLER -->
    <button class="navbar-toggler border-0"
            type="button"
            data-bs-toggle="collapse"
            data-bs-target="#navbarNavLanding">
      <span class="navbar-toggler-icon"></span>
    </button>

    <!-- MENU -->
    <div class="collapse navbar-collapse justify-content-between" id="navbarNavLanding">

      <ul class="navbar-nav ms-auto mb-2 mb-lg-0 fw-medium">

        <li class="nav-item">
          <a class="nav-link text-success {{ request()->is('/') ? 'active' : '' }}" href="/">Beranda</a>
        </li>

        <li class="nav-item dropdown">
          <a class="nav-link dropdown-toggle text-success {{ request()->is('tentang/*') ? 'active' : '' }}" href="#" data-bs-toggle="dropdown">
            Profil
          </a>
          <ul class="dropdown-menu">
            <li><a class="dropdown-item text-success" href="/tentang/sejarah">Sejarah</a></li>
            <li><a class="dropdown-item text-success" href="/tentang/visi-misi">Visi & Misi</a></li>
          </ul>
        </li>
        <li class="nav-item">
          <a class="nav-link text-success" href="#program">Program</a>
        </li>
        <li class="nav-item">
          <a class="nav-link text-success" href="#prestasi">Prestasi</a>
        </li>
        <li class="nav-item">
          <a class="nav-link text-success" href="#fasilitas">Fasilitas</a>
        </li>
        <li class="nav-item dropdown">
          <a class="nav-link dropdown-toggle text-success" href="#" data-bs-toggle="dropdown">
            Informasi
          </a>
          <ul class="dropdown-menu">
            <li><a class="dropdown-item text-success" href="#berita">Berita</a></li>
            <li><a class="dropdown-item text-success" href="#informasi">Informasi</a></li>
          </ul>
        </li>

        <li class="nav-item">
          <a class="nav-link text-success" href="#infaq">Hubungi Kami</a>
        </li>

      </ul>

    </div>
  </div>
</nav>

<style>

  .navbar-custom {
    background: transparent !important;
    position: fixed;
    top: 0;
    width: 100%;
    z-index: 9999;
    transition: 0.3s ease;
  }

  .navbar-custom .nav-link,
  .navbar-custom .navbar-brand {
    color: #fff !important;
  }

  .navbar-custom.scrolled {
    background: #fff !important;
    box-shadow: 0 2px 10px rgba(0,0,0,0.08);
  }

  .navbar-custom.scrolled .nav-link,
  .navbar-custom.scrolled .navbar-brand {
    color: #198754 !important;
  }

  .navbar-custom .navbar-toggler-icon {
    background-image: url("data:image/svg+xml,%3csvg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 30 30'%3e%3cpath stroke='white' stroke-width='2' d='M4 7h22M4 15h22M4 23h22'/%3e%3c/svg%3e");
  }

  .navbar-custom.scrolled .navbar-toggler-icon {
    background-image: url("data:image/svg+xml,%3csvg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 30 30'%3e%3cpath stroke='rgba(25,135,84,1)' stroke-width='2' d='M4 7h22M4 15h22M4 23h22'/%3e%3c/svg%3e");
  }

  .nav-link {
    position: relative;
    display: inline-block;
    text-decoration: none;
  }

  .nav-link::before {
    content: "";
    position: absolute;
    left: 0;
    bottom: -6px;
    width: 100%;
    height: 2px;
    background: currentColor;
    transform: scaleX(0);
    transform-origin: center;
    transition: 0.3s ease;
  }

  .nav-link:hover::before,
  .nav-link.active::before {
    transform: scaleX(1);
  }

  @media (min-width: 992px) {
    .nav-item.dropdown:hover .dropdown-menu {
      display: block;
      margin-top: 0;
    }
  }


</style>

<script>
  const navbar = document.querySelector(".navbar-custom");

  function handleScroll() {
    const isScrolled = window.scrollY > 50;
    const isMenuOpen = document.querySelector("#navbarNavLanding").classList.contains("show");

    if (isScrolled || isMenuOpen) {
      navbar.classList.add("scrolled");
    } else {
      navbar.classList.remove("scrolled");
    }
  }

  window.addEventListener("scroll", handleScroll);

  document.querySelector("#navbarNavLanding")
    .addEventListener("shown.bs.collapse", handleScroll);

  document.querySelector("#navbarNavLanding")
    .addEventListener("hidden.bs.collapse", handleScroll);
</script>
