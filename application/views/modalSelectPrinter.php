<style>
	.bi-plus-lg:hover {
		text-decoration: underline;
	}
</style>

<!-- Modal Select Printer -->
<div class="modal fade" id="modalselect" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
	<div class="modal-dialog modal-dialog-centered" role="document">
		<div class="modal-content">
			<div class="text-end me-1">
				<button type="button" class="btn-close text-dark" data-bs-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span>
				</button>
				<div class="text-center">
					<h5 class="modal-title font-weight-normal" id="exampleModalLabel">Select Printer Replacement</h5>
				</div>
			</div>
			<div class="modal-body">

				<form method="POST" action="<?= site_url() ?>printerreplacement/insertWithDamage">
					<?php foreach ($printerselect as $sp) : ?>
						<div class="card mb-3">
							<div class="d-flex align-items-center p-3 border-radius-md">
								<span class="avatar text-bg-info avatar-lg fs-5">
									<i class="bi bi-printer"></i>
								</span>
								<div class="ms-3">
									<h6 class="mb-0 fs-sm">Printer SN <?= $sp->printer_sn ?></h6>
									<span class="text-muted fs-sm">Type <?= $sp->type_printer ?></span>
								</div>
								<button type="submit" class="btn text-muted fs-3 ms-auto my-auto" type="button">
									<i class="bi bi-plus-lg"></i>
								</button>
							</div>
						</div>
						<input type="hidden" value="<?= $sp->id_replacement ?>" name="idreplacement">
						<input type="hidden" value="<?= $sp->id_printer ?>" name="idprinter">
						<input type="hidden" value="<?= $sp->id_agen ?>" name="idagen">
					<?php endforeach; ?>
				</form>

				<hr class="dark horizontal">

				<form method="POST" action="<?= site_url() ?>printerreplacement/insertNew">
					<div class="card mb-3">
						<div class="d-flex align-items-center p-3 border-radius-md">
							<span class="avatar text-bg-info avatar-lg fs-5">
								<i class="bi bi-printer-fill"></i>
							</span>
							<div class="ms-3">
								<h6 class="mb-0 fs-sm">ADD New Printer?</h6>
							</div>
							<button type="submit" class="btn text-muted fs-3 ms-auto my-auto" type="button">
								<i class="bi bi-plus-lg"></i>
							</button>
						</div>
					</div>
				</form>

			</div>
		</div>
	</div>
</div>