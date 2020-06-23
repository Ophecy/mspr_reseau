	<div class="modal-dialog modal-lg modal-dialog-centered" role="document">
		<div class="modal-content">
			<a class="btn btn-primary" href="#" data-toggle="modal" data-target="#otamodal">Activer double authentification</a>
		</div>
	</div>
	<div class="modal-dialog modal-lg modal-dialog-centered" role="document">
		<div class="modal-content">
			<a class="btn btn-primary" href="#" onclick="logout()">Se déconnecter</a>
		</div>
	</div>

	<!-- Modal -->
	<div class="modal fade" id="otamodal" tabindex="-1" role="dialog" aria-labelledby="otamodalTitle" aria-hidden="true">
		<div class="modal-dialog modal-dialog-centered" role="document">
			<div class="modal-content">
				<div class="modal-header">
					<h5 class="modal-title" id="exampleModalLongTitle">Double authentification</h5>
					<button type="button" class="close" data-dismiss="modal" aria-label="Close">
						<span aria-hidden="true">&times;</span>
					</button>
				</div>
				<div class="modal-body">


					<div class="card" style="width: 465px;">
						<div id="qrcode"></div>
						<div class="card-body">
							<h5 class="card-title">Scannez le code</h5>
							<p class="card-text">Ou entrez <code><?= $_SESSION['password'] ?></code> dans votre application d'authentification</p>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>



	<script src="./js/qrcode.js"></script>
	<script type="text/javascript">
		let appname = "MSPR Reseau";
		let secret = "<?= $_SESSION['password'] ?>";
		let username = "<?= $_SESSION['user'] ?>";
		var qrcode = new QRCode(document.getElementById("qrcode"), {
			text: `otpauth://totp/${appname}:${username}?secret=${secret}&algorithm=SHA1&digits=6&period=30`,
			width: window.innerWidth / 5,
			height: window.innerWidth / 5,
			colorDark: "#21252b",
			colorLight: "#ffffff",
			correctLevel: QRCode.CorrectLevel.H
		});
	</script>