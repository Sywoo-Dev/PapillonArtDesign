<?php
if(session_status() == PHP_SESSION_NONE){
    session_start();
}
if(isset($_SESSION["user"])){
    header("Location: /account.php");
    exit();
}
$PAGE = 1;
include 'inc/header.php';
?>
<div class="container content" style="padding-top: 200px;" id="main_container">

		<h1 class="text-center display-2">Connexion</h1>

	<?php if(isset($_SESSION['form_errors'])){ ?>

		<div class="alert alert-danger alert-dismissible fade show" role="alert">
			<ul>
				<?php foreach ($_SESSION['form_errors'] as $error) { ?>
					<li><?= $error ?></li>
				<?php } ?>
			</ul>
			<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
		</div>

	 <?php unset($_SESSION['form_errors']); } ?>
	<form accept-charset="UTF-8" action="/forms/process_login.php" method="post">
		<div class="form-group top_space">
			<label>Email</label>
			<input type="email" class="form-control" name="email" placeholder="exemple@exemple.fr">
		</div>
		<div class="form-group top_space">
			<label>Password</label>
			<input type="password" class="form-control" name="password" placeholder="Password" required>
		</div>
		<div class="form-group top_space">
			<button type="submit" class="btn btn-lg btn-block btn-secondary" style="width: 100%;">Connexion</button>
		</div>

		<p>You haven't account ? <a href="/register.php">Register</a> !</p>
	</div>
</form>

<?php include 'inc/footer.php'; ?>

