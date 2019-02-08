<?php

$MERCHANT_KEY = "aEyHpot7";
$SALT = "bWTFfdulfa";
// Merchant Key and Salt as provided by Payu.

$PAYU_BASE_URL = "https://sandboxsecure.payu.in";   // For Sandbox Mode
//$PAYU_BASE_URL = "https://secure.payu.in";      // For Production Mode

$action = '';

$posted = array();
if(!empty($_POST)) {
    //print_r($_POST);
  foreach($_POST as $key => $value) {    
    $posted[$key] = $value; 
  
  }
}

$formError = 0;

if(empty($posted['txnid'])) {
  // Generate random transaction id
  $txnid = substr(hash('sha256', mt_rand() . microtime()), 0, 20);
} else {
  $txnid = $posted['txnid'];
}
$hash = '';
// Hash Sequence
$hashSequence = "key|txnid|amount|productinfo|firstname|email|udf1|udf2|udf3|udf4|udf5|udf6|udf7|udf8|udf9|udf10";
if(empty($posted['hash']) && sizeof($posted) > 0) {
  if(
          empty($posted['key'])
          || empty($posted['txnid'])
          || empty($posted['amount'])
          || empty($posted['firstname'])
          || empty($posted['email'])
          || empty($posted['phone'])
          || empty($posted['productinfo'])
          || empty($posted['surl'])
          || empty($posted['furl'])
      || empty($posted['service_provider'])
  ) {
    $formError = 1;
  } else {
    //$posted['productinfo'] = json_encode(json_decode('[{"name":"tutionfee","description":"","value":"500","isRequired":"false"},{"name":"developmentfee","description":"monthly tution fee","value":"1500","isRequired":"false"}]'));
  $hashVarsSeq = explode('|', $hashSequence);
    $hash_string = '';  
  foreach($hashVarsSeq as $hash_var) {
      $hash_string .= isset($posted[$hash_var]) ? $posted[$hash_var] : '';
      $hash_string .= '|';
    }

    $hash_string .= $SALT;


    $hash = strtolower(hash('sha512', $hash_string));
    $action = $PAYU_BASE_URL . '/_payment';
  }
} elseif(!empty($posted['hash'])) {
  $hash = $posted['hash'];
  $action = $PAYU_BASE_URL . '/_payment';
}
?>

<!DOCTYPE html>
<html lang="en">

  <head>
 <script>
    var hash = '<?php echo $hash ?>';
    function submitPayuForm() {
      if(hash == '') {
        return;
      }
      var payuForm = document.forms.payuForm;
      payuForm.submit();
    }
  </script>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Donate!</title>

    <link href="vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
    <link href="vendor/fontawesome-free/css/all.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Varela+Round" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">


    <link href="css/home.css" rel="stylesheet">

  </head>

  <body id="page-top" onload="submitPayuForm()">

    <nav class="navbar navbar-expand-lg navbar-light fixed-top" id="mainNav">
      <div class="container">
        <a class="navbar-brand js-scroll-trigger" href="#page-top"> Home </a>
        <button class="navbar-toggler navbar-toggler-right" type="button" data-toggle="collapse" data-target="#navbarResponsive" aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation">
          Menu
          <i class="fas fa-bars"></i>
        </button>
        <div class="collapse navbar-collapse" id="navbarResponsive">
          <ul class="navbar-nav ml-auto">
            <li class="nav-item">
              <a class="nav-link js-scroll-trigger" href="#about">About</a>
            </li>
            <li class="nav-item">
              <a class="nav-link js-scroll-trigger" href="#projects">Projects</a>
            </li>
            <li class="nav-item">
              <a class="nav-link js-scroll-trigger" href="#signup">Contact</a>
            </li>
          </ul>
        </div>
      </div>
    </nav>

    
    <header class="masthead">
      <div class="container d-flex h-100 align-items-center">
        <div class="mx-auto text-center">
          <h1 class="mx-auto my-0 text-uppercase"> Every effort counts! </h1>
          <h2 class="text-white-50 mx-auto mt-2 mb-5"> Your donation can further our vision of ensuring better lives for hundreds. </h2>
          <a href="#form" class="btn btn-primary js-scroll-trigger"> Donate here </a>
        </div>
      </div>
    </header>

   

    <!-- Projects Section -->
    <section id="projects" class="projects-section bg-light">
      <div class="container">

        <!-- Featured Project Row -->
        <div class="row align-items-center no-gutters mb-4 mb-lg-5">
          <div class="col-xl-8 col-lg-7">
            <img class="img-fluid mb-3 mb-lg-0" src="img/demo-image-02.jpg" alt="">
          </div>
          <div class="col-xl-4 col-lg-5">
            <div class="featured-text text-center text-lg-left">
              <h4> </h4>
              <p class="text-black-50 mb-0">“Numbers don’t count. Even if we can change one life, it means a great deal to us.”</p>
            </div>
          </div>
        </div>

        <!-- Project One Row -->
        <div class="row justify-content-center no-gutters mb-5 mb-lg-0">
          <div class="col-lg-6">
            <img class="img-fluid" src="img/demo-image-01.jpg" alt="">
          </div>
          <div class="col-lg-6">
            <div class="bg-black text-center h-100 project">
              <div class="d-flex h-100">
                <div class="project-text w-100 my-auto text-center text-lg-left">
                  <h4 class="text-white">Hunger</h4>
                  <p class="mb-0 text-white-50">To enable people to take responsibility for the situation of the deprived Indian child and so motivate them to seek resolution through individual and collective action thereby enabling children to realise their full potential</p>
                  <hr class="d-none d-lg-block mb-0 ml-0">
                </div>
              </div>
            </div>
          </div>
        </div>
        <!-- Project One Row ends -->

        <!-- Project Two Row -->
        <div class="row justify-content-center no-gutters">
          <div class="col-lg-6">
            <img class="img-fluid" src="img/bg-masthead.jpg" alt="">
          </div>
          <div class="col-lg-6 order-lg-first">
            <div class="bg-black text-center h-100 project">
              <div class="d-flex h-100">
                <div class="project-text w-100 my-auto text-center text-lg-right">
                  <h4 class="text-white">Education</h4>
                  <p class="mb-0 text-white-50">To enable people to take responsibility for the situation of the deprived Indian child and so motivate them to seek resolution through individual and collective action thereby enabling children to realise their full potential</p>
                  <hr class="d-none d-lg-block mb-0 mr-0">
                </div>
              </div>
            </div>
          </div>
        </div>

      </div>
    </section>
    <!-- project two row ends -->

  
  <!-- form -->

 <form action="<?php echo $action; ?>" method="post" name=payuForm id="form">
          <div class="row">
            <div class="col-lg-12 col-centered">
              <div class="form-group row">
                <label for="firstname" class="col-lg-2 col-form-label">Name</label>
            <div class="col-lg-10">
              <input type="hidden" name="key" value="<?php echo $MERCHANT_KEY ?>" />
              <input type="hidden" name="hash" value="<?php echo $hash ?>"/>
              <input type="hidden" name="txnid" value="<?php echo $txnid ?>" />
              <input class="form-control" id="firstname" name="firstname" value="<?php echo (empty($posted['firstname'])) ? '' : $posted['firstname']; ?>" />
            </div>
          </div>
              </div>
              </div>
  <div class="row">
    <div class="col-lg-12 col-centered">
      <div class="form-group row">
        <label for="email" class="col-lg-2 col-form-label">Email</label>
    <div class="col-lg-10">
      <input class="form-control" name="email" id="email" value="<?php echo (empty($posted['email'])) ? '' : $posted['email']; ?>" />
    </div>
  </div>
      </div>
      </div>
      <div class="row">
        <div class="col-lg-12 col-centered">
          <div class="form-group row">
            <label for="amount" class="col-lg-2 col-form-label">Amount</label>
        <div class="col-lg-10">
          <input class="form-control" id="amount" name="amount" value="<?php echo (empty($posted['amount'])) ? '' : $posted['amount'] ?>" />
        </div>
      </div>
          </div>
          </div>
          <div class="row">
            <div class="col-lg-12 col-centered">
              <div class="form-group row">
                <label for="phone" class="col-lg-2 col-form-label">Phone</label>
            <div class="col-lg-10">
              <input name="phone" class="form-control" id="phone" value="<?php echo (empty($posted['phone'])) ? '' : $posted['phone']; ?>" />
              <input type="hidden" name="productinfo" value="donation">
              <input type="hidden" name="surl" value="192.168.64.2/html/success.php">
              <input type="hidden" name="furl" value="192.168.64.2/html/failure.php">
              <input type="hidden" name="service_provider" value="payu_paisa" size="64" />
            </div>
          </div>
              </div>
              </div>
          <div class="row">
            <div class="col-lg-12" id="submitbutton">
              <p style="text-align:center;"><?php if(!$hash) { ?><button type="submit" name="submit" class="btn btn-outline-dark btn-md" value="Submit">Pay Now</button></p>
                <?php } ?>
                <!--div class='pm-button'><a href='https://www.payumoney.com/paybypayumoney/#/FDBA48781986B98DE49C2885A6B80B9B'><img src='https://www.payumoney.com/media/images/payby_payumoney/new_buttons/11.png' /></a></div-->
              </div>
              </div>
            </div>
          </div>
      </form>
      </section>



      <!-- form ends -->
 





    <!-- Signup Section -->
    <section id="signup" class="signup-section">
      <div class="container">
        <div class="row">
          <div class="col-md-10 col-lg-8 mx-auto text-center">

            <i class="far fa-paper-plane fa-2x mb-2 text-white"></i>
            <h2 class="text-white mb-5">Subscribe to receive updates on our projects!</h2>

            <form class="form-inline d-flex">
              <input type="email" class="form-control flex-fill mr-0 mr-sm-2 mb-3 mb-sm-0" id="inputEmail" placeholder="Enter email address...">
              <button type="submit" class="btn btn-primary mx-auto">Subscribe</button>
            </form>

          </div>
        </div>
      </div>
    </section>
    <!-- signup section ends -->

    <!-- Contact Section -->
    <section class="contact-section bg-black">
      <div class="container">

        <div class="row">

          <div class="col-md-4 mb-3 mb-md-0">
            <div class="card py-4 h-100">
              <div class="card-body text-center">
                <i class="fas fa-map-marked-alt text-primary mb-2"></i>
                <h4 class="text-uppercase m-0">Address</h4>
                <hr class="my-4">
                <div class="small text-black-50"> 123, Juhu </div>
              </div>
            </div>
          </div>

          <div class="col-md-4 mb-3 mb-md-0">
            <div class="card py-4 h-100">
              <div class="card-body text-center">
                <i class="fas fa-envelope text-primary mb-2"></i>
                <h4 class="text-uppercase m-0">Email</h4>
                <hr class="my-4">
                <div class="small text-black-50">
                  <a href="#"> qwe@rty.com</a>
                </div>
              </div>
            </div>
          </div>

          <div class="col-md-4 mb-3 mb-md-0">
            <div class="card py-4 h-100">
              <div class="card-body text-center">
                <i class="fas fa-mobile-alt text-primary mb-2"></i>
                <h4 class="text-uppercase m-0">Phone</h4>
                <hr class="my-4">
                <div class="small text-black-50">+91 999 </div>
              </div>
            </div>
          </div>
        </div>

        <div class="social d-flex justify-content-center">
          <a href="#" class="mx-2">
            <i class="fab fa-twitter"></i>
          </a>
          <a href="#" class="mx-2">
            <i class="fab fa-facebook-f"></i>
          </a>
          <a href="#" class="mx-2">
            <i class="fab fa-github"></i>
          </a>
        </div>

      </div>
    </section>

 


    <script src="vendor/jquery/jquery.min.js"></script>
    <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>


    <script src="vendor/jquery-easing/jquery.easing.min.js"></script>

    <script src="js/grayscale.min.js"></script>

  </body>

</html>
