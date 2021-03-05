<!doctype html>
<html lang="en">

<head>
	<!-- Required meta tags -->
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

	<!-- Bootstrap CSS -->
	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">

	<title>Hello, world!</title>
</head>

<body>
	<div class="container px-4 p-2">
		<div class="row">
			<div class="col-sm">
				<form action="<?= base_url(); ?>c_api/getApi" method="post">
					<label class="form-label"> <b>Cek Resi</b> </label>
					<div class="input-group mb-3">
						<input type="text" class="form-control" placeholder="input resi anda..." name="tx_resi" id="exampleInputPassword1" required>
						<button type="submit" class="btn btn-primary">Cari</button>
					</div>
					<div class="input-group">
						<div class="m-2 form-check">
							<input class="form-check-input" type="radio" name="rd_tx" value="jne" id="flexRadioDefault1">
							<label class="form-check-label" for="flexRadioDefault1">
								JNE
							</label>
						</div>
						<div class="m-2 form-check">
							<input class="form-check-input" type="radio" name="rd_tx" value="tiki" id="flexRadioDefault2">
							<label class="form-check-label" for="flexRadioDefault2">
								TIKI
							</label>
						</div>
						<div class="m-2 form-check">
							<input class="form-check-input" type="radio" name="rd_tx" value="pos" id="flexRadioDefault2">
							<label class="form-check-label" for="flexRadioDefault2">
								POS
							</label>
						</div>
						<div class="m-2 form-check">
							<input class="form-check-input" type="radio" name="rd_tx" value="sicepat" id="flexRadioDefault2">
							<label class="form-check-label" for="flexRadioDefault2">
								SICEPAT
							</label>
						</div>
						<div class="m-2 form-check">
							<input class="form-check-input" type="radio" name="rd_tx" value="anteraja" id="flexRadioDefault2">
							<label class="form-check-label" for="flexRadioDefault2">
								AnterAja
							</label>
						</div>
						<div class="m-2 form-check">
							<input class="form-check-input" type="radio" name="rd_tx" value="ninja" id="flexRadioDefault2">
							<label class="form-check-label" for="flexRadioDefault2">
								Ninja
							</label>
						</div>
						<div class="m-2 form-check">
							<input class="form-check-input" type="radio" name="rd_tx" value="jnt" id="flexRadioDefault2">
							<label class="form-check-label" for="flexRadioDefault2">
								JNT
							</label>
						</div>
					</div>
				</form>
				<?php
				$data_arr = $this->session->all_data;
				$history = $this->session->history;
				$detail = $this->session->detail;
				$summary = $this->session->summary;
				$totalWaktu = 0;
				if ($data_arr != "kosong") {
					// print_r($data_arr);
				?>
					<br>
					<p class="fw-bolder"><?= $history[0]['desc'] ?>,<?= $history[0]['date'] ?></p>
					<hr>
					<div class="row">
						<div class="col-sm">
							<p class="fw-bolder">Nomor Resi</p><br>
							<p class="font-weight-light"><?= $summary['awb']; ?></p>
						</div>
						<div class="col-sm">
							<p class="fw-bolder">Tanggal Pengiriman</p>
							<p class="font-weight-light"><?= $summary['date']; ?></p>
						</div>
						<div class="col-sm">
							<p class="fw-bolder">Pengiriman</p>
							<p class="font-weight-light"><?= $detail['shipper']; ?></p>
						</div>
						<div class="col-sm">
							<p class="fw-bolder">Penerima</p><br>
							<p class="font-weight-light"><?= $detail['receiver']; ?></p>
						</div>
					</div>
					<hr>
					<p class="fw-bolder">Detail Pengiriman</p>
					<div class="row">
						<div class="col-sm">
							<p class="fw-bolder">Tanggal</p>
							<?php
							$panjang = count($history) - 1;
							for ($i = 0; $i < count($history); $i++) {
							?>
								<p class="font-weight-light"><?= $history[$i]['date']; ?></p>
							<?php
							}

							?>
						</div>
						<div class="col-sm">
							<p class="fw-bolder">Deskripsi</p>
							<?php
							for ($i = 0; $i < count($history); $i++) {
							?>
								<p class="font-weight-light"><?= $history[$i]['desc']; ?></p>
							<?php
							}
							?>
						</div>
					</div>
				<?php
				}else {
					echo 'Data Kosong';
				}
				?>
			</div>

			<div class="m-2 col-sm">
				<?php
				if ($data_arr != "kosong") {
				?>
					<div class="row">
						<div class="col-sm">
							<p class="fw-bolder">Respon Toko</p>
							<?php
							$sebelum = $panjang - 1;
							$totalWaktu = strtotime($history[$panjang]['date']) - strtotime($history[$sebelum]['date']);
							$jam   = floor($totalWaktu / (60 * 60));
							if ($jam <= 4) { ?>
								<p class="font-weight-light"><?= $jam; ?> Jam</p>
								<div class="alert alert-success" role="alert">
									Sangat Baik
								</div>
							<?php }
							if ($jam > 4 && $jam <= 8) { ?>
								<p class="font-weight-light"><?= $jam; ?> Jam</p>
								<div class="alert alert-warning" role="alert">
									Baik
								</div>
							<?php }
							if ($jam > 8) { ?>
								<p class="font-weight-light"><?= $jam; ?> Jam</p>
								<div class="alert alert-danger" role="alert">
									Cukup
								</div>
							<?php } ?>
						</div>
					</div>
				<?php
				}
				?>
			</div>
		</div>
	</div>

	<!-- Optional JavaScript -->
	<!-- jQuery first, then Popper.js, then Bootstrap JS -->
	<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
	<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
</body>

</html>
