<html lang="en">
<?php include('partials/head.php') ; ?>
<body>
    <!--================Header Area =================-->
    <?php include('partials/header.php') ; ?>
    <!--================Header Area =================-->
    <!--================Banner Area =================-->
    <?php if ($banner == 'true') {
        include('partials/banner.php') ;
    } ?>
    <!--================Banner Area =================-->
    <!--================ Accomodation Area  =================-->
    <?php echo $content; ?>
    <!--================ Accomodation Area  =================-->
    <!--================ start footer Area  =================-->	
    <?php include('partials/footer.php'); ?>
    <!--================ End footer Area  =================-->
    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <?php include ('partials/script.php'); ?>
</body>
</html>