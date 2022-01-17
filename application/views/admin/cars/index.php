<!DOCTYPE html>
<html lang="pt-br">

<head>
	<?php include_once 'application/views/admin/utils/start.php' ?>
</head>

<body data-background-color="bg3">
	<div class="wrapper">
		<?php include_once 'application/views/admin/utils/header.php' ?>
		<div class="main-panel">
			<div class="content">
				<div class="container-fluid">
					<div class="page-header god-header">
						<h4 class="page-title">Carros</h4>
						<ul class="breadcrumbs">
							<li class="nav-home">
								<a href="<?= site_url('admin') ?>">
									home
								</a>
							</li>
							<li class="separator">
								<i class="flaticon-right-arrow"></i>
							</li>
							<li class="nav-item">
								Carros
							</li>
						</ul>
					</div>
					<div class="row">
						<div class="col-md-12">
							<div class="card">
								<div class="card-header">
									<?php if ($this->session->flashdata('error')) : ?>
										<div class="mb-4 alert alert-danger d-flex align-items-center justify-content-between" role="alert">
											<?= $this->session->flashdata('errors') ?>
											<i class="close" data-feather="x"></i>
										</div>
									<?php endif ?>
									<?php if ($this->session->flashdata('success')) : ?>
										<div class="mb-4 alert alert-success d-flex align-items-center justify-content-between" role="alert">
											<?= $this->session->flashdata('success') ?>
											<i class="close" data-feather="x"></i>
										</div>
									<?php endif ?>
									<div class="d-flex align-items-center justify-content-end">
										<a href="<?= base_url('admin/cars/create') ?>">
											<button class="btn btn-black">
												<i class="la la-plus"></i>
											</button>
										</a>
									</div>
								</div>
								<div class="card-body">
									<div class="table-responsive">
										<table class="display table table-striped table-hover datatable">
											<thead>
												<tr>
													<th>Modelo</th>
													<th>Cor</th>
													<th>Marca</th>
													<th>Ações</th>
												</tr>
											</thead>
											<tbody>
												<?php foreach ($cars as $car) : ?>
													<tr>
														<td><?= $car->model ?></td>
														<td><?= $car->color ?></td>
														<td><?= $car->brand->name ?></td>
														<td>
															<a href="<?= base_url('admin/cars/update/' . $car->id) ?>">
																<button class="btn btn-link">Editar</button>
															</a>
																<a href="<?= base_url('admin/cars/delete/' . $car->id) ?>">
																<button class="btn btn-link">Excluir</button>
															</a>
														</td>
													</tr>
												<?php endforeach ?>
											</tbody>
										</table>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>

	<?php include_once 'application/views/admin/utils/end.php' ?>
	
	<script>
		const settings = {
			baseURL: '<?= base_url() ?>'
		}

		window.addEventListener('load', function () {})
	</script>
</body>

</html>