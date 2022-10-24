<?
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
<div class="container" id="main_container" style="padding-bottom: 100px; padding-top: 200px;">


	<h1 class="text-center display-2">Inscription</h1>
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
		<form accept-charset="UTF-8" action="/forms/process_register.php" method="post">

			<div class="top_space row">
				<div class="col-md-2">
					<div class="form-group">
						<label class="form-label">Gender</label>
						<select class="form-select" name="gender">
							<option value="H">Man</option>
							<option value="F">Woman</option>
						</select>
					</div>
				</div>
				<div class="col-md-5">
					<div class="form-group">
						<label>Name</label>
						<input type="text" class="form-control" name="name" placeholder="Name">
					</div>	
				</div>
				<div class="col-md-5">
					<div class="form-group">
						<label>Subname</label>
						<input type="text" class="form-control" name="subname" placeholder="Subname">
					</div>
				</div>
			</div>

            <div class="form-group top_space">
                <label>Username</label>
                <input type="text" class="form-control" name="username" placeholder="Username">
            </div>

			<div class="form-group top_space">
				<label>Email</label>
				<input type="email" class="form-control" name="email" placeholder="exemple@exemple.fr">
			</div>
			<div class="form-group top_space">
				<label>Password</label>
				<input type="password" class="form-control" name="password" placeholder="Password" required>
			</div>
			<div class="form-group top_space">
				<label>Password confirm</label>
				<input type="password" class="form-control" name="password_confirm" placeholder="Confirm" required>
			</div>
			<div class="form-group top_space">
				<button type="submit" class="btn btn-lg btn-block btn-secondary" style="width: 100%;">Register</button>
			</div>

			<p>Already have an account ? <a href="/login.php">login</a> !</p>
		</div>
	</form>

	<?php include 'inc/footer.php'; ?>

