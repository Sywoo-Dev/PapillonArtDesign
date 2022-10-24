<?php 
$PAGE = 0;
include 'inc/header.php';
?>



<!-- <header class="masthead">

	<div class="container h-100">
		<div class="row h-100 align-items-center">
			<div class="col-12 text-center">
				<h1 class="fw-light">Vertically Centered Masthead Content</h1>
				<p class="lead">A great starter layout for a landing page</p>
			</div>
		</div>
	</div>


</header> -->

<div class="container content" id="main_container">

	<img src="https://via.placeholder.com/1920x1080/000000" class="img-reduced img-responsive">

    <img src="/img/creations.svg" class="pyramid" style="padding-top: 30px">

    <div class="row row-cols-1 row-cols-md-3 g-4" style="padding-bottom: 20px; padding-top: 20px;">

        <?php for($i = 0; $i < 6; $i++){ ?>
        <div class="col">
            <div class="card rounded-card">
                <img src="/img/gaming_zone.png" class="card-img-top" alt="...">
                <div class="card-body">
                    <p class="card-text">It's an short text exemple like the doc</p>
                    <div class="row">
                        <div class="col-md-3 col-sm-3">
                            <img src="/img/logo.png" class="img-responsive img-round">
                        </div>
                        <div class="col-md-9">
                            <h3 class="text-bottom card-username">Pseudo</h3>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <?php } ?>

    </div>


</div>





<?php include 'inc/footer.php'; ?>

