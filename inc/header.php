<?php 
if(session_status() == PHP_SESSION_NONE){
	session_start();
}
include "namespace.php";
include "data.php";
if(!isset($PAGE)){
	$PAGE = 1;
}

$in_cart = array();

if(isset($_SESSION["user"])){
	if($_SESSION['user']->cart != null){
		$in_cart = explode(",", $_SESSION["user"]->cart);
	}
}


$return_cart = array_unique($in_cart);
?>
<!DOCTYPE html>
<html lang="fr">
<head>
	<meta charset="utf-8">
	<meta name="description" content="Venez créer la gaming room qui vous ressemble.">
	<meta property="og:image" content="/img/logo.png">
	<link rel="stylesheet" type="text/css" href="/css//bootstrap.css">
	<link rel="stylesheet" type="text/css" href="/css/custom.css">
	<link rel="icon" type="image/png" href="/img/logo.png">
	<link rel="stylesheet" href="/owlcarousel/assets/owl.carousel.min.css">
	<link rel="stylesheet" href="/owlcarousel/assets/owl.theme.default.min.css">
	<script src="https://kit.fontawesome.com/27283c1466.js" crossorigin="anonymous"></script>
	<title><?= $TITLE ?></title>
</head>
<body>
<div class="fixed-top">
	<nav class="navbar navbar-expand-lg bg-dark">
            <!-- <a class="navbar-brand d-none d-lg-block" href="/"><img src="/img/logo.png" width="60"></a> -->
        <div class="container-fluid brand"><img src="/img/brand.png" id="back_menu"  class="img-responsive clickable" height="100"></div>
            <div id="icons-lg" class="d-none d-lg-block">
                <a href="" class="offcanvas_icon">
                    <img src="/img/icon-en.svg" class="icon-flag">
                </a>
                <?php if(isset($_SESSION["user"])){ ?>
                <a href="/favorits.php" class="offcanvas_icon">
                    <img src="/img/icon-hearth.svg" class="icon">
                </a>
                <a href="/account.php" class="offcanvas_icon">
                    <img src="/img/icon-account.svg" class="icon">
                </a>
                <a href="#" class="offcanvas_icon" data-bs-toggle="modal" data-bs-target="#CartModal">
                    <img src="/img/icon-cart.svg" class="icon">
                </a>
                <a href="/logout.php" class="offcanvas_icon">
                    <img src="/img/icon-logout.svg" class="icon">
                </a>
                    <?php if($_SESSION["user"]->rank == 1){ ?>
                        <a href="/admin" class="offcanvas_icon">
                            <i class="fa-solid fa-user-gear fa-2xl icon"></i>
                        </a>
                    <?php } ?>
                <?php }else{ ?>
                <a href="/login.php" class="offcanvas_icon">
                    <img src="/img/icon-login.svg" class="icon">
                </a>
                <?php } ?>
            </div>
	</nav>
            <div class="container-fluid d-none d-lg-block" id="submenu">
          <div class="container">
              <div class="row">

                  <div class="col-md-2 text-center menu_list_section"><a href="" class="submenu_link">Your Room 3D</a></div>
                  <div class="col-md-2 text-center menu_list_section"><a href="" class="submenu_link">Univers</a></div>
                  <div class="col-md-2 text-center menu_list_section"><a href="" class="submenu_link">Portraits</a></div>
                  <div class="col-md-2 text-center menu_list_section"><a href="" class="submenu_link">Ephemeral Collection</a></div>
                  <div class="col-md-2 text-center menu_list_section"><a href="" class="submenu_link">Accesories</a></div>
                  <div class="col-md-2 text-center menu_list_section_end"><a href="" class="submenu_link">Offers</a></div>

              </div>
          </div>
        </div>

    <div class="container-fluid" id="hidden_menu" hidden>
        <div class="container text-center">
            <div class="row">
            <div class="col-md-2 menu_list_section">
                <ul class="menu_list">
                    <li><a href="/editor">Your Rooms</a></li>
                </ul>
            </div>
            <div class="col-md-2 menu_list_section">
                <ul class="menu_list">
                    <li><a href="">Fantasy</a></li>
                    <li><a href="">Cyberpunk</a></li>
                    <li><a href="">Japan</a></li>
                    <li><a href="">...</a></li>
                </ul>
            </div>
            <div class="col-md-2 menu_list_section">
                <ul class="menu_list">
                    <li><a href="">Fantasy</a></li>
                    <li><a href="">Cyberpunk</a></li>
                    <li><a href="">Japan</a></li>
                    <li><a href="">...</a></li>
                </ul>
            </div>
            <div class="col-md-2 menu_list_section">
                <ul class="menu_list">
                    <li><a href="">Christmas</a></li>
                </ul>
            </div>
            <div class="col-md-2 menu_list_section">
                <ul class="menu_list">
                    <li><a href="">Tee-Shirts</a></li>
                    <li><a href="">Figures</a></li>
                    <li><a href="">...</a></li>
                </ul>
            </div>
            <div class="col-md-2 menu_list_section_end">
                <ul class="menu_list">
                    <li><a href="">Bundle 1</a></li>
                    <li><a href="">Bundle 2</a></li>
                    <li><a href="">...</a></li>
                </ul>
            </div>
            </div>
        </div>
    </div>

       <!-- <div class="owl-carousel owl-theme" id="header_carousel">
            <div class="item"><img src="/img/carousel/1.png"></div>
            <div class="item"><img src="/img/carousel/2.png"></div>
            <div class="item"><img src="/img/carousel/3.png"></div>
            <div class="item"><img src="/img/carousel/4.png"></div>
            <div class="item"><img src="/img/carousel/5.png"></div>
        </div> -->

        <div class="container-fluid" id="carousel">

            <div class="container" id="carousel-container">
                <button type="button" class="carousel-button" id="prev"><i class="fa-solid fa-chevron-left"></i></button>

                <img src="/img/carousel/1.png" data-pos="1" class="img-carousel carousel-erase">
                <img src="/img/carousel/2.png" data-pos="2" class="img-carousel carousel-small">
                <img src="/img/carousel/3.png" data-pos="3" class="img-carousel">
                <img src="/img/carousel/4.png" data-pos="4" class="img-carousel carousel-small">
                <img src="/img/carousel/5.png" data-pos="5" class="img-carousel carousel-erase">

                <button type="button" class="carousel-button" id="next"><i class="fa-solid fa-chevron-right"></i></button>
            </div>

        </div>


        <div class="container">
            <img src="/img/matrix.svg" class="pyramid clickable" id="button_carousel">
        </div>

    <div class="d-lg-none">
        <button class="menu" onclick="this.classList.toggle('opened');this.setAttribute('aria-expanded', this.classList.contains('opened'))" data-bs-toggle="offcanvas" data-bs-target="#offcanvasScrolling" aria-label="Main Menu">
            <svg width="100" height="100" viewBox="0 0 100 100">
                <path class="line line1" d="M 20,29.000046 H 80.000231 C 80.000231,29.000046 94.498839,28.817352 94.532987,66.711331 94.543142,77.980673 90.966081,81.670246 85.259173,81.668997 79.552261,81.667751 75.000211,74.999942 75.000211,74.999942 L 25.000021,25.000058" />
                <path class="line line2" d="M 20,50 H 80" />
                <path class="line line3" d="M 20,70.999954 H 80.000231 C 80.000231,70.999954 94.498839,71.182648 94.532987,33.288669 94.543142,22.019327 90.966081,18.329754 85.259173,18.331003 79.552261,18.332249 75.000211,25.000058 75.000211,25.000058 L 25.000021,74.999942" />
            </svg>
        </button>
    </div>


    <div class="offcanvas offcanvas-start offcanvas_submenu d-lg-none" data-bs-scroll="true" data-bs-backdrop="false" tabindex="-1" id="offcanvasScrolling" aria-labelledby="offcanvasScrollingLabel">
        <div class="offcanvas-header">
            <h5 class="offcanvas-title" id="offcanvasScrollingLabel">Menu</h5>
        </div>
        <div class="offcanvas-body">
            <ul class="offcanvas_items">
                <li class="offcanvas_item"><a href="" class="offcanvas_link">Your Rooms 3D</a></li>
                <li class="offcanvas_item"><a href="" class="offcanvas_link">Univers</a></li>
                <li class="offcanvas_item"><a href="" class="offcanvas_link">Portraits</a></li>
                <li class="offcanvas_item"><a href="" class="offcanvas_link">Ephemeral Collection</a></li>
                <li class="offcanvas_item"><a href="" class="offcanvas_link">Accessories</a></li>
                <li class="offcanvas_item"><a href="" class="offcanvas_link">Offers</a></li>
                <li class="offcanvas_item_icon">
                    <a href="" class="offcanvas_icon">
                        <img src="/img/icon-en.svg" class="icon-flag">
                    </a>
                    <?php if(isset($_SESSION["user"])){ ?>
                        <a href="/favorits.php" class="offcanvas_icon">
                            <img src="/img/icon-hearth.svg" class="icon">
                        </a>
                        <a href="/account.php" class="offcanvas_icon">
                            <img src="/img/icon-account.svg" class="icon">
                        </a>
                        <a href="#" class="offcanvas_icon" data-bs-toggle="modal" data-bs-target="#CartModal">
                            <img src="/img/icon-cart.svg" class="icon">
                        </a>
                        <a href="/logout.php" class="offcanvas_icon">
                            <img src="/img/icon-logout.svg" class="icon">
                        </a>
                        <?php if($_SESSION["user"]->rank == 1){ ?>
                            <a href="/admin" class="offcanvas_icon">
                                <i class="fa-solid fa-user-gear fa-2xl icon"></i>
                            </a>
                        <?php } ?>
                    <?php }else{ ?>
                        <a href="/login.php" class="offcanvas_icon">
                            <img src="/img/icon-login.svg" class="icon">
                        </a>
                    <?php } ?>
                </li>
            </ul>
        </div>
    </div>
</div>


	<!-- Modal -->
	<div class="modal fade modal-xl" id="CartModal" tabindex="-1" aria-labelledby="CartModalLabel" aria-hidden="true">
		<div class="modal-dialog">
			<div class="modal-content">
				<div class="modal-header">
					<h5 class="modal-title" id="CartModalLabel">My Cart</h5>
					<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
				</div>
				<div class="modal-body overflow-auto">
                    <?php
                    if(empty($return_cart)){
                        echo "<h3>Your Cart is empty</h3>";
                    }
                    $total = 0;
                    foreach($return_cart as $c_id){
                        $req = $pdo->prepare("SELECT * FROM products WHERE id = ?");
                        $req->bindParam(1, $c_id);
                        $req->execute();

                        $product = $req->fetch();
                        ?>
                        <!-- Element -->
                        <div class="row">

                            <div class="col-md-7">
                                <div class="row cart-article-container">

                                    <div class="col-md-4 cart-img-container">
                                        <img src="<?= $product->icon ?>" class="img-responsive cart-img">
                                    </div>

                                    <div class="col-md-6">
                                        <h3 class="cart-title"><?= $product->name ?></h3>
                                        <p>Price <b><?= $product->price ?>€</b></p>
                                        <p>Size: <?= $product->size ?></p>
                                        <div class="cart-qte-container">
                                            <a class="btn btn-outline-success btn-sm" href="/forms/remove_cart.php?id=<?= $product->id ?>&redirect=<?= $_SERVER['REQUEST_URI'] ?>">-</a>
                                            <span class="badge bg-secondary"><?= array_count_values($in_cart)[$c_id] ?></span>
                                            <a class="btn btn-outline-success btn-sm" href="/forms/add_cart.php?id=<?= $product->id ?>&redirect=<?= $_SERVER['REQUEST_URI'] ?>">+</a>
                                        </div>

                                        <span class="badge rounded-pill bg-success">In Stock</span>

                                    </div>

                                    <div class="col-md-2">
                                        <p>Total: <b><?= $product->price * array_count_values($in_cart)[$c_id] ?>€</b></p>
                                        <?php $total += ($product->price * array_count_values($in_cart)[$c_id]); ?>
                                        <a href="/forms/delete_cart.php?id=<?= $product->id ?>&redirect=<?= $_SERVER['REQUEST_URI'] ?>" class="btn cart-btn-delete"><i class="fa-solid fa-trash fa-xl"></i></a>
                                    </div>


                                </div>
                            </div>
                            <div class="col-md-1"></div>
                            <div class="col-md-4">
                                <div class="cart-order-container">
                                    <h3 class="cart-title">Order Details</h3>
                                    <p class="cart-info">Delivry: 35€</p>
                                    <p class="cart-info">Items total: <?= $total ?>€</p>
                                    <p class="cart-danger">Out of stock: 2 items</p>
                                    <p class="cart-info">Sub Total: <?= $total + 35 ?>€ VAT</p>

                                    <a href="#" class="btn cart-btn text-uppercase">Checkout</a>
                                </div>
                            </div>

                        </div>

                        <!-- End Element -->
                    <?php } ?>
				</div>
			</div>
		</div>
	</div>