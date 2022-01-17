<div class="main-header">
  <div class="logo-header" data-background-color="black">
    <!-- Tip 1: You can change the background color of the logo header using: data-background-color="black | dark | blue | purple | light-blue | green | orange | red" -->
    <!-- <a href="<?= base_url('admin/home') ?>" class="logo">
      <img src="any.png" alt="Logo da Agência Ponto" title="Logo da Agência Ponto" class="navbar-brand">
    </a> -->
    <button class="navbar-toggler sidenav-toggler ml-auto" type="button" data-toggle="collapse" data-target="collapse"
      aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon">
        <i class="la la-bars"></i>
      </span>
    </button>
    <button class="topbar-toggler more"><i class="la la-ellipsis-v"></i></button>
  </div>

  <nav class="navbar navbar-header navbar-expand-lg" data-background-color="black">
    <!-- Tip 1: You can change the background color of the navbar header using: data-background-color="black | dark | blue | purple | light-blue | green | orange | red" -->
    <div class="container-fluid">
      <!-- <div class="navbar-minimize">
        <button class="btn btn-minimize btn-rounded">
          <i class="la la-navicon"></i>
        </button>
      </div> -->
      <ul class="navbar-nav topbar-nav ml-md-auto align-items-center">
        <li class="nav-item dropdown hidden-caret">
          <span class="d-flex dropdown-toggle color-white cursor-pointer" data-toggle="dropdown" href="" aria-expanded="false">
            <i data-feather="settings"></i>
          </span>
          <ul class="dropdown-menu dropdown-user animated fadeIn">
            <li>
              <div class="user-box">
                <div class="u-text">
                  <h4><?= $this->session->userdata('admin')['name'] ?></h4>
                </div>
              </div>
            </li>
            <li>
              <div class="dropdown-divider"></div>
              <a class="dropdown-item" href="<?= base_url('admin/login/logout') ?>">Sair</a>
            </li>
          </ul>
        </li>
      </ul>
    </div>
  </nav>
</div>

<div class="sidebar">
  <div class="sidebar-wrapper scrollbar-inner">
    <div class="sidebar-content">
      <ul class="nav">
      <li class="nav-section"><h4 class="text-section">Carros</h4></li>
        <li class="nav-item <?= isset($names) && $names['link'] == 'brands' ? 'active' : '' ?>">
          <a href="<?= site_url('admin/brands') ?>">
            <i data-feather="box"></i>
            <p>Marcas</p>
          </a>
        </li>
        <li class="nav-item <?= isset($names) && $names['link'] == 'cars' ? 'active' : '' ?>">
          <a href="<?= site_url('admin/cars') ?>">
            <i data-feather="disc"></i>
            <p>Carros</p>
          </a>
        </li>

        <li class="nav-section">
          <h4 class="text-section">Sair do sistema</h4>
        </li>
        <li class="nav-item">
          <a href="<?= site_url('admin/login/logout') ?>">
            <i data-feather="log-out" class="rotate-180"></i>
            <p>Sair</p>
          </a>
        </li>
      </ul>
    </div>
  </div>
</div>