<?php
$role = $this->session->userdata('role');
?>
<aside id="sidebar" class="sidebar">

  <ul class="sidebar-nav" id="sidebar-nav">
    <li class="nav-item">
      <a class="nav-link <?= $this->uri->segment(1) === 'dashboard' ? '' : 'collapsed' ?>" href="<?= base_url('dashboard') ?>">
        <i class="bi bi-grid"></i>
        <span>Dashboard</span>
      </a>
    </li>
    <?php if ($role == 'admin') : ?>
      <li class="nav-item">
      <a class="nav-link <?= $this->uri->segment(1) === 'kelas' ? '' : 'collapsed' ?>" href="<?= base_url('kelas') ?>">
        <i class="bi bi-grid"></i>
        <span>Kelas</span>
      </a>
    </li>
      <li class="nav-item">
        <a class="nav-link <?= $this->uri->segment(1) === 'admin' || $this->uri->segment(1) === 'siswa' || $this->uri->segment(1) === 'gurubk' || $this->uri->segment(1) === 'osis' || $this->uri->segment(1) === 'prestasi' || $this->uri->segment(1) === 'walikelas' || $this->uri->segment(1) === 'namapelanggaran' ? '' : 'collapsed'  ?>" data-bs-target="#components-nav" data-bs-toggle="collapse" href="#">
          <i class="bi bi-menu-button-wide"></i><span>Data</span><i class="bi bi-chevron-down ms-auto"></i>
        </a>
        <ul id="components-nav" class="nav-content <?= $this->uri->segment(1) === 'admin' || $this->uri->segment(1) === 'siswa' || $this->uri->segment(1) === 'gurubk' || $this->uri->segment(1) === 'osis' || $this->uri->segment(1) === 'prestasi' || $this->uri->segment(1) === 'walikelas' || $this->uri->segment(1) === 'namapelanggaran' ? '' : 'collapsed' ?> " data-bs-parent="#sidebar-nav">
          <li>
            <a href="<?= base_url('admin') ?>" class="<?= $this->uri->segment(1) === 'admin' ? 'active' : '' ?>">
              <i class="bi bi-circle"></i><span>Admin/Kesiswaan</span>
            </a>
          </li>
          <li>
            <a href="<?= base_url('siswa') ?>" class="<?= $this->uri->segment(1) === 'siswa' ? 'active' : '' ?>">
              <i class="bi bi-circle"></i><span>Siswa</span>
            </a>
          </li>
          <li>
            <a href="<?= base_url('gurubk') ?>" class="<?= $this->uri->segment(1) === 'gurubk' ? 'active' : '' ?>">
              <i class="bi bi-circle"></i><span>Guru BK</span>
            </a>
          </li>
          <li>
            <a href="<?= base_url('osis') ?>" class="<?= $this->uri->segment(1) === 'osis' ? 'active' : '' ?>">
              <i class="bi bi-circle"></i><span>Petugas</span>
            </a>
          </li>
          <li>
            <a href="<?= base_url('walikelas') ?>" class="<?= $this->uri->segment(1) === 'walikelas' ? 'active' : '' ?>">
              <i class="bi bi-circle"></i><span>Walikelas</span>
            </a>
          </li>
          <li>
            <a href="<?= base_url('prestasi') ?>" class="<?= $this->uri->segment(1) === 'prestasi' ? 'active' : '' ?>">
              <i class="bi bi-circle"></i><span>Prestasi</span>
            </a>
          </li>
          <li>
            <a href="<?= base_url('namapelanggaran') ?>" class="<?= $this->uri->segment(1) === 'namapelanggaran' ? 'active' : '' ?>">
              <i class="bi bi-circle"></i><span>Nama Pelanggaran</span>
            </a>
          </li>
          <li>
            <a href="<?= base_url('pelanggaran') ?>" class="<?= $this->uri->segment(1) === 'pelanggaran' ? 'active' : '' ?>">
              <i class="bi bi-circle"></i><span>Pelanggaran</span>
            </a>
          </li>
        </ul>
      </li><!-- End Components Nav -->
    <?php endif ?>
    <?php if ($role == 'walikelas') : ?>
      <li class="nav-item">
        <a class="nav-link <?= $this->uri->segment(1) === 'prestasi' ? '' : 'collapsed' ?>" href="<?= base_url('prestasi') ?>">
          <i class="bi bi-trophy"></i>
          <span>Prestasi Siswa</span>
        </a>
      </li>
      <li class="nav-item">
        <a class="nav-link <?= $this->uri->segment(1) === 'notifikasi' ? '' : 'collapsed' ?>" href="<?= base_url('notifikasi') ?>">
          <i class="bi bi-bell"></i>
          <span>Notifikasi</span>
        </a>
      </li>
      <li class="nav-item">
        <a class="nav-link <?= $this->uri->segment(1) === 'pelanggaran' ? '' : 'collapsed' ?>" href="<?= base_url('pelanggaran') ?>">
          <i class="bi bi-book"></i>
          <span>Pelanggaran</span>
        </a>
      </li>
    <?php endif ?>
    <?php if ($role == 'siswa') : ?>
      <li class="nav-item">
        <a class="nav-link <?= $this->uri->segment(1) === 'prestasi' ? '' : 'collapsed' ?>" href="<?= base_url('prestasi') ?>">
          <i class="bi bi-trophy"></i>
          <span>Prestasi Saya</span>
        </a>
      </li>
      <li class="nav-item">
        <a class="nav-link <?= $this->uri->segment(1) === 'pelanggaran' ? '' : 'collapsed' ?>" href="<?= base_url('pelanggaran') ?>">
          <i class="bi bi-book"></i>
          <span>Pelanggaran</span>
        </a>
      </li>
      <li class="nav-item">
        <a class="nav-link <?= $this->uri->segment(1) === 'notifikasi' ? '' : 'collapsed' ?>" href="<?= base_url('notifikasi') ?>">
          <i class="bi bi-bell"></i>
          <span>Notifikasi</span>
        </a>
      </li>
    <?php endif ?>
    <?php if ($role == 'osis') : ?>
      <li class="nav-item">
        <a class="nav-link <?= $this->uri->segment(1) === 'pelanggaran' ? '' : 'collapsed' ?>" href="<?= base_url('pelanggaran') ?>">
          <i class="bi bi-book"></i>
          <span>Pelanggaran</span>
        </a>
      </li>
    <?php endif ?>
    <?php if ($role == 'gurubk') : ?>
      <li class="nav-item">
        <a class="nav-link <?= $this->uri->segment(1) === 'notifikasi' ? '' : 'collapsed' ?>" href="<?= base_url('notifikasi') ?>">
          <i class="bi bi-bell"></i>
          <span>Notifikasi</span>
        </a>
      </li>
      <li class="nav-item">
        <a class="nav-link <?= $this->uri->segment(1) === 'pelanggaran' ? '' : 'collapsed' ?>" href="<?= base_url('pelanggaran') ?>">
          <i class="bi bi-book"></i>
          <span>Pelanggaran</span>
        </a>
      </li>
      <li class="nav-item">
        <a class="nav-link <?= $this->uri->segment(1) === 'namapelanggaran' ? '' : 'collapsed' ?>" href="<?= base_url('namapelanggaran') ?>">
          <i class="bi bi-book"></i>
          <span>Nama Pelanggaran</span>
        </a>
      </li>
    <?php endif ?>
  </ul>

</aside>