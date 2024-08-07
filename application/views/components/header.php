<!DOCTYPE html>
<html lang="en">

<head>
	<meta charset="utf-8" />
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
	<link rel="apple-touch-icon" sizes="76x76" href="../assets/img/apple-icon.png">
	<link rel="icon" type="image/png" href="../assets/img/favicon.png">
	<title>
		<?= $title ?>
	</title>

	<!--     Fonts and icons     -->
	<link rel="stylesheet" type="text/css" href="https://fonts.googleapis.com/css?family=Roboto:300,400,500,700,900|Roboto+Slab:400,700" />

	<!-- Nucleo Icons -->
	<link href="<?= base_url() ?>public/css/nucleo-icons.css" rel="stylesheet" />
	<link href="<?= base_url() ?>public/css/nucleo-svg.css" rel="stylesheet" />

	<!-- Font Awesome Icons -->
	<script src="https://kit.fontawesome.com/42d5adcbca.js" crossorigin="anonymous"></script>
	<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">

	<!-- Material Icons -->
	<link href="https://fonts.googleapis.com/icon?family=Material+Icons+Round" rel="stylesheet">

	<!-- CSS Files -->
	<link id="pagestyle" href="public/css/material-dashboard.css?v=3.1.0" rel="stylesheet" />
	<link id="pagestyle" href="<?= base_url() ?>public/css_vpro/material-dashboard.min.css" rel="stylesheet" />
</head>

<body class="g-sidenav-show  bg-gray-200">
	<aside class="sidenav navbar navbar-vertical navbar-expand-xs border-0 fixed-start   bg-gradient-dark" id="sidenav-main">
		<div class="sidenav-header">
			<i class="fas fa-times p-3 cursor-pointer text-white opacity-5 position-absolute end-0 top-0 d-none d-xl-none" aria-hidden="true" id="iconSidenav"></i>
			<a class="navbar-brand m-0" href=" https://demos.creative-tim.com/material-dashboard/pages/dashboard " target="_blank">
				<span class="ms-1 fw-light text-white">Printer Management Stock</span>
			</a>
		</div>
		<hr class="horizontal light mt-0 mb-1">
		<div class="d-flex align-items-center py-3 ms-4">
			<img src="<?= base_url() ?>/public/img/foto_fachri.jpg" class="rounded-circle mr-2 me-2" alt="Profile Image" width="34">
			<h5 class="mb-0 text-white fw-light fs-6">Admin</h5>
		</div>
		<hr class="horizontal light mt-0 mb-2">
		<div class="collapse navbar-collapse  w-auto " id="sidenav-collapse-main">
			<ul class="navbar-nav">
				<li class="nav-item">
					<a class="nav-link text-white <?= ($this->uri->segment(1) == '') ? 'active bg-info' : ''; ?>" href="<?= site_url() ?>">
						<div class="text-white text-center me-2 d-flex align-items-center justify-content-center">
							<i class="material-icons opacity-10">dashboard</i>
						</div>
						<span class="nav-link-text ms-1">Dashboard</span>
					</a>
				</li>

				<li class="nav-item">
					<a class="nav-link text-white <?= ($this->uri->segment(1) == 'printer') ? 'active bg-info' : ''; ?>" href="<?= site_url('printer') ?>">
						<div class="text-white text-center me-2 d-flex align-items-center justify-content-center">
							<i class="material-icons">format_list_bulleted</i>
						</div>
						<span class="nav-link-text ms-1">Printer List</span>
					</a>
				</li>

			</ul>
		</div>
	</aside>


	<main class="main-content position-relative max-height-vh-100 h-100 border-radius-lg ">
		<!-- Navbar -->
		<nav class="navbar navbar-main navbar-expand-lg px-0 mx-4 shadow-none border-radius-xl" id="navbarBlur" data-scroll="true">
			<div class="container-fluid py-1 px-3">
				<nav aria-label="breadcrumb">
					<p>cek</p>
				</nav>
				<div class="collapse navbar-collapse mt-sm-0 mt-2 me-md-0 me-sm-4" id="navbar">
					<div class="ms-md-auto pe-md-3 d-flex align-items-center">
						<a href="" class="me-4">
							<i class="material-icons">dashboard</i>
						</a>
						<a href="" class="me-4">
							<i class="material-icons">notifications</i>
						</a>
						<a href="">
							<i class="material-icons">person</i>
						</a>
					</div>
				</div>
			</div>
		</nav>
		<!-- End Navbar -->

		<div class="container-fluid py-4">
