<?php require_once 'app/views/templates/headerPublic.php'?>
<main role="main" class="container">
		<div class="page-header" id="banner">
				<div class="row">
						<div class="col-lg-12">
								<h1>Login</h1>
						</div>
				</div>
		</div>

		<?php if (isset($_SESSION['lockoutMessage'])): ?>
		<div class="alert alert-danger" role="alert">
				<?= $_SESSION['lockoutMessage'] ?>
		</div>
		<?php unset($_SESSION['lockoutMessage']); endif; ?>

		<div class="row">
				<div class="col-sm-auto">
						<form action="/login/verify" method="post">
								<fieldset>
										<div class="form-group">
												<label for="username">Username:</label>
												<input required type="text" class="form-control" name="username">
										</div>
										<div class="form-group">
												<label for="password">Password:</label>
												<input required type="password" class="form-control" name="password">
										</div>
										<br>
										<button type="submit" class="btn btn-primary">Login</button>
								</fieldset>
						</form>
				</div>
		</div>
</main>

<?php require_once 'app/views/templates/footer.php' ?>