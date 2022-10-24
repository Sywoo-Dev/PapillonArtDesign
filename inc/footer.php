<footer class="bg-dark text-center">
  <!-- Grid container -->
  <div class="container-fluid p-4">
    
    <!-- Section: Links -->
    <section class="">
      <!--Grid row-->
      <div class="row">
        <!--Grid column-->
        <div class="col-md-2">
          <h5 class="text-uppercase">Support</h5>

          <ul class="list-unstyled mb-0">
            <li>
              <a href="#!" class="footer-link">The Company</a>
            </li>
            <li>
              <a href="#!" class="footer-link">The Team</a>
            </li>
            <li>
              <a href="#!" class="footer-link">Contact</a>
            </li>
            <li>
              <a href="#!" class="footer-link">Our Partners</a>
            </li>
          </ul>
        </div>
        <!--Grid column-->

        <!--Grid column-->
        <div class="col-md-2">
          <h5 class="text-uppercase">Orders</h5>

          <ul class="list-unstyled mb-0">
            <li>
              <a href="#!" class="footer-link">Delivry</a>
            </li>
            <li>
              <a href="#!" class="footer-link">Return and Refund</a>
            </li>
            <li>
              <a href="#!" class="footer-link">FAQs</a>
            </li>
            <li>
              <a href="#!" class="footer-link">Secure Payement</a>
            </li>
          </ul>
        </div>
        <!--Grid column-->

        <div class="col-md-4" id="img-footer">
          <img src="/img/logo.png" class="img-responsive">
        </div>

        <!--Grid column-->
        <div class="col-md-2">
          <h5 class="text-uppercase">Legislation</h5>

          <ul class="list-unstyled mb-0">
            <li>
              <a href="#!" class="footer-link">GTC</a>
            </li>
            <li>
              <a href="#!" class="footer-link">TOS</a>
            </li>
            <li>
              <a href="#!" class="footer-link">Copyrights</a>
            </li>
          </ul>
        </div>
        <!--Grid column-->

        <!--Grid column-->
        <div class="col-md-2">
          <h5 class="text-uppercase">Technical</h5>

          <ul class="list-unstyled mb-0">
            <li>
              <a href="#!" class="footer-link">Assembly Video</a>
            </li>
            <li>
              <a href="#!" class="footer-link">Modeling Software</a>
            </li>
          </ul>
        </div>
        <!--Grid column-->
      </div>
      <!--Grid row-->
    </section>
    <!-- Section: Links -->

<!-- Section: Social media -->
    <section class="mb-4">
      <!-- Facebook -->
      <a class="btn btn-outline-light footer-link btn-floating m-1" href="#!" role="button"
        ><i class="fab fa-facebook-f"></i
      ></a>

      <!-- Twitter -->
      <a class="btn btn-outline-light footer-link btn-floating m-1" href="#!" role="button"
        ><i class="fab fa-twitter"></i
      ></a>

     

      <!-- Instagram -->
      <a class="btn btn-outline-light footer-link btn-floating m-1" href="#!" role="button"
        ><i class="fab fa-instagram"></i
      ></a>

      <!-- TikTok -->
      <a class="btn btn-outline-light footer-link btn-floating m-1" href="#!" role="button"
        ><i class="fab fa-tiktok"></i
      ></a>
    
          <!-- Twitch -->
      <a class="btn btn-outline-light footer-link btn-floating m-1" href="#!" role="button"
        ><i class="fab fa-twitch"></i
      ></a>

          <!-- Snapchat -->
      <a class="btn btn-outline-light footer-link btn-floating m-1" href="#!" role="button"
        ><i class="fab fa-snapchat"></i
      ></a>
    
    </section>
    <!-- Section: Social media -->

  </div>
  <!-- Grid container -->

  <!-- Copyright -->
  <div class="text-center text-white p-3" style="background-color: rgba(0, 0, 0, 0.2);">
    © 2022 - <?= date("Y"); ?> Copyright: <?= $TITLE ?>
  </div>
  <!-- Copyright -->
</footer>
</body>
<script type="text/javascript" src="/js/jquery.js"></script>
<script type="text/javascript" src="/js/bootstrap.js"></script>
<script type="text/javascript" src="/owlcarousel/owl.carousel.min.js"></script>
<script type="text/javascript">
    $('.owl-carousel').owlCarousel({
    loop:true,
    margin: 50,
    dots: false,
    responsive:{
        0:{
            items:1
        },
        600:{
            items:3
        },
        1000:{
            items:5
        }
    }
})
  </script>
<script>

    <?php if($PAGE != 0){ ?>
        $("#carousel").hide();
    <?php } ?>

    $(".submenu_link").hover(function (){
        $("#hidden_menu").show();
        $("#hidden_menu").animate( { "hidden": "false", top:"500"} , 15000 );
    });

    $("#hidden_menu").mouseleave(function (){
        $("#hidden_menu").hide();
    });

    $("nav").hover(function (){
        $("#hidden_menu").hide();
    });

    $("#button_carousel").click(function (){
            var actual_height = parseInt($("#main_container").css("padding-top"));
            var new_pading = actual_height;
            var carousel_height = $("#carousel").height();

            if($("#carousel").is(":visible")){
                new_pading -= carousel_height;
            }else{
                new_pading += carousel_height;
            }

            $('#main_container').delay(100)
            .queue(function (next) {
                $(this).css("padding-top", new_pading);
                next();
            });

        $("#carousel").animate({
            height: 'toggle'
        });
    });

    var total_image = 5;

    $("#prev").click(function(){
        $("#carousel-container img").each(function( index ){
            var data = $(this).data("pos");
            if(data == total_image){
                data = 0;
            }
            data++;
            $(this).attr("src", "/img/carousel/" + data + ".png");
            $(this).data("pos", data);

        });
    });

    $("#next").click(function (){
        $("#carousel-container img").each(function( index ){
            var data = $(this).data("pos");
            if(data == 1){
                data = total_image+1;
            }
            data--;
            $(this).attr("src", "/img/carousel/" + data + ".png");
            $(this).data("pos", data);

        });
    });

    $("#back_menu").click(function (){
        window.location.href = "/";
    });

</script>
</html>