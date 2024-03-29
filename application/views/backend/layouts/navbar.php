<!-- Layout container -->
<div class="layout-page">
  <!-- Navbar -->
  <!-- Logo -->
  <nav class="layout-navbar container-xxl navbar navbar-expand-xl navbar-detached align-items-center bg-navbar-theme" id="layout-navbar">
    <div class="layout-menu-toggle navbar-nav align-items-xl-center me-3 me-xl-0 d-xl-none">
      <a class="nav-item nav-link px-0 me-xl-4" href="javascript:void(0)">
        <i class="bx bx-menu bx-sm"></i>
      </a>
    </div>

    <div class="navbar-nav-right d-flex align-items-center" id="navbar-collapse">


      <ul class="navbar-nav flex-row align-items-center ms-auto">

        <!-- User -->
        <li class="nav-item navbar-dropdown dropdown-user dropdown">
          <a class="nav-link dropdown-toggle hide-arrow" href="javascript:void(0);" data-bs-toggle="dropdown">
            <div class="avatar avatar-online">
              <img src="<?= (empty($profile->file) == 'default-profile' ? base_url('assets/img/avatars/1.png') : base_url('assets/foto/' . $profile->file)); ?>" alt class="w-px-40 h-20 rounded-circle" />
            </div>
          </a>
          <ul class="dropdown-menu dropdown-menu-end">
            <li>
              <a class="dropdown-item">
                <div class="d-flex">
                  <div class="flex-shrink-0 me-3">
                    <div class="avatar avatar-online">
                      <img src="<?= (empty($profile->file) == 'default-profile' ? base_url('assets/img/avatars/1.png') : base_url('assets/foto/' . $profile->file)); ?>" alt class="w-px-40 h-20 rounded-circle" />
                    </div>
                  </div>
                  <div class="flex-grow-1">
                    <span class="fw-semibold d-block"><?php if ($profile->tipe == 99) {
                                                        echo $profile->nama;
                                                      }
                                                      if ($profile->tipe == 88) {
                                                        echo $profile->nama;
                                                      }
                                                      ?></span>
                    <small class="text-muted"><?php if ($profile->tipe == 99) {
                                                echo 'Admin';
                                              }
                                              if ($profile->tipe == 88) {
                                                echo 'Guru';
                                              }
                                              ?></small>
                  </div>
                </div>
              </a>
            </li>
            <li>
              <div class="dropdown-divider"></div>
            </li>
            <li>
              <a class="dropdown-item" href="<?= site_url('profile'); ?>">
                <i class="bx bx-user me-2"></i>
                <span class="align-middle">My Profile</span>
              </a>
            </li>
            <li>
              <a class="dropdown-item" href="<?= site_url('editPass'); ?>">
                <i class="bx bx-lock me-2"></i>
                <span class="align-middle">Ubah Password</span>
              </a>
            </li>
            <li>
              <div class="dropdown-divider"></div>
            </li>
            <li>
              <a class="dropdown-item" href="<?= site_url('logout'); ?>">
                <i class="bx bx-power-off me-2"></i>
                <span class="align-middle">Log Out</span>
              </a>
            </li>
          </ul>
        </li>
        <!--/ User -->
      </ul>
    </div>
  </nav>

  <!-- / Navbar -->