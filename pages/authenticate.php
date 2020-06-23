<?php
if (session_status() != PHP_SESSION_ACTIVE) session_start();
if (!isset($_SESSION['page'])) die();
if ($_SESSION['page'] !== 'authenticate') die();
?>
<!-- Modal login -->
<div class="modal-dialog" role="document">
	<div class="modal-content">
		<div class="modal-header">
			<h5 class="modal-title" id="loginModalLabel">Connexion</h5>
			<button type="button" class="close" data-dismiss="modal" aria-label="Close">
				<span aria-hidden="true">&times;</span>
			</button>
		</div>
		<div class="modal-body">
			<form action="post" onsubmit="return false" id="loginModal">
				<!-- username -->
				<div class="form-group">
					<label for="user-log">Nom d'utilisateur</label>
					<input type="text" class="form-control" id="user-log" placeholder="Nom d'utilisateur">
				</div>
				<!-- password -->
				<div class="form-group">
					<label for="user-pwd">Mot de passe</label>
					<input type="password" class="form-control" id="pwd-log" placeholder="Mot de passe">
				</div>
				<!-- username -->
				<div class="form-group">
					<label for="user-log">Google authentificator</label>
					<input type="text" class="form-control" id="ota-log" placeholder="Code à 6 chiffres">
				</div>
			</form>
		</div>
		<!-- buttons -->
		<div class="modal-footer">
			<button type="button" class="btn btn-primary start" onclick="login()" id="loginBtn">Connexion</button>
		</div>
	</div>
</div>