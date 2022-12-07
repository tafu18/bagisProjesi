<?php 
ob_start();
session_start();
?>
<!DOCTYPE html>
<html lang="tr">

<!-- stella-orre/  30 Nov 2019 03:42:43 GMT -->
<head>
<meta charset="utf-8">
<title>Admin | Admin Panel Giriş</title>
<!-- Stylesheets -->
<link href="css/bootstrap.css" rel="stylesheet">
<link href="css/style.css" rel="stylesheet">
<link href="css/responsive.css" rel="stylesheet">

<link rel="shortcut icon" href="images/favicon.png" type="image/x-icon">
<link rel="icon" href="images/favicon.png" type="image/x-icon">

<!-- Responsive -->
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0">
<!--[if lt IE 9]><script src="https://cdnjs.cloudflare.com/ajax/libs/html5shiv/3.7.3/html5shiv.js"></script><![endif]-->
<!--[if lt IE 9]><script src="js/respond.js"></script><![endif]-->


</head>

<body>

<div class="page-wrapper">
    <!-- Preloader -->
    <div class="preloader"></div>

    <header class="main-header header-style-one">
        <!--Header Top-->
        <div class="header-top">
            <div class="auto-container clearfix">
                <div class="top-left clearfix">
                    <div class="text"><span class="icon flaticon-call-answer"></span> İhtiyacın mı var? Bize ulaşabilirsin: <a href="tel:538-597-23-18" class="number">538 597 2318</a></div>
					
                </div>
                <div class="top-right clearfix">
                    <!-- Info List -->
					<ul class="info-list">
                        <li><a href="https://www.seydisehir.bel.tr/">Seydişehir Belediyesi</a></li>
                        <li><a href="http://www.seydisehir.gov.tr/">Seydişehir Kaymakamlığı</a></li>
						<li class="quote"><a href="https://www.erbakan.edu.tr/seydisehirahmetcengizmuhendislik">NEÜ SACMF</a></li>
                    </ul>
                </div>
            </div>
        </div>
        <!-- End Header Top -->

        <!-- Header Upper -->
        <div class="header-upper">
            <div class="inner-container">
                <div class="auto-container clearfix">
                    <!--Info-->
                    <div class="logo-outer display-felx">
                        <div class="logo mr-3"><a href="https://www.erbakan.edu.tr/seydisehirahmetcengizmuhendislik" target="_blank"><img src="images/favicon.png" alt="" title=""></a></div>
                        <div class="logo m-auto"><a href="http://www.seydisehir.gov.tr/" target="_blank"><img src="images/kaymakamlik_logo.png" alt="" title=""></a></div>
                        <div class="logo m-auto"><a href="https://www.seydisehir.bel.tr/" target="_blank"><img src="images/belediye_logo.png" alt="" title=""></a></div>
                    </div>

                    <!--Nav Box-->
                    <div class="nav-outer clearfix">
                        <!--Mobile Navigation Toggler For Mobile--><div class="mobile-nav-toggler"><span class="icon flaticon-menu-1"></span></div>
                        <nav class="main-menu navbar-expand-md navbar-light">
                            <div class="navbar-header">
                                <!-- Togg le Button -->      
                                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                                    <span class="icon flaticon-menu-1"></span>
                                </button>
                            </div>
                            
                            <div class="collapse navbar-collapse clearfix" id="navbarSupportedContent">
                                <ul class="navigation clearfix">
                                    <li class="dropdown"><a href="index.php">Anasayfa</a></li>
									<li class="dropdown"><a href="donations.php">Bağışlar</a>
<!--                                    <ul>
                                            <li><a href="index.php">Home</a></li>
											<li><a href="index.php">Home</a></li>
											<li><a href="index.php">Home</a></li>
                                        </ul> -->
                                    </li>
                                    <li class="dropdown"><a href="demands.php">Talepler</a></li>
                                    <li><a href="gallery.php?page=1">Gerçekleşen Bağışlar</a></li>
                                    <!-- <li><a href="volunteer.php">Gönüllü Ekibimiz</a></li> -->
                                    <!-- <li class="current dropdown"><a href="login.php">Yönetici Girişi</a></li> -->
                                </ul>
                            </div>
                        </nav>
                        <!-- Main Menu End-->
                    </div>
                </div>
            </div>
        </div>
        <!--End Header Upper-->
                <!-- Mobile Menu  -->
        <div class="mobile-menu">
            <div class="menu-backdrop"></div>
            <div class="close-btn"><span class="icon flaticon-cancel"></span></div>
            
            <nav class="menu-box">
                <div class="nav-logo justify-content-center"><a href="index.php"><img src="images/favicon.png" alt="" title=""></a></div>
                <ul class="navigation clearfix"><!--Keep This Empty / Menu will come through Javascript--></ul>
				<!--Social Links-->
				<div class="social-links">
					<ul class="clearfix">
						<li><a href="index.php"><span class="fab fa-twitter"></span></a></li>
						<li><a href="index.php"><span class="fab fa-facebook-square"></span></a></li>
						<li><a href="index.php"><span class="fab fa-pinterest-p"></span></a></li>
						<li><a href="index.php"><span class="fab fa-instagram"></span></a></li>
						<li><a href="index.php"><span class="fab fa-youtube"></span></a></li>
					</ul>
                </div>
            </nav>
        </div><!-- End Mobile Menu -->

    </header>
    <!-- End Main Header -->

    
    <!-- End Main Header -->
	<section class="main-slider mt-15 mb-15">
		<div class="container">
			<div style="justify-content: center;"  class="row">
				<div class="col-12">
					<div class="sec-title light centered">
						<h2 style="color: black;">Giriş</h2>
						<div class="text">Giriş Paneli</div>
					</div>
					<form class="needs-validation" action="" method="POST">
						<div style="justify-content: center;" class="form-row">
							<div class="col-md-4 mb-3">
								<div class="input-group">
									<div class="input-group-prepend">
										<span class="input-group-text">123</span>
									</div>
									<input type="text" class="form-control" name="student_no" placeholder="Öğrenci Numaranız..." required>
								</div>
							</div>
							<div class="col-md-4 mb-3">
								<div class="input-group">
									<div class="input-group-prepend">
										<span class="input-group-text">***</span>
									</div>
									<input type="password" class="form-control" name="password"  placeholder="Şifreniz..." required>
								</div>
							</div>
						</div>
						</div>
						<button class="btn btn-primary col-8" type="submit">Giriş Yap</button>
					</form>
				</div>  
			</div>
		</div>
	</section>
<?php
	
	require_once 'db.php';
	
	if($_POST){
		$student = $_POST['student_no'];
		$password = $_POST['password'];

		
		$query = $db->prepare("SELECT * FROM admin_control WHERE student_no = " . $student);
		$query->execute();
		$admin = $query->fetch(PDO::FETCH_ASSOC);

        //$_SESSION['name'] = $_POST[''];
        

		if($password == $admin['password']){
            $_SESSION['name'] = $admin['name'];
			//echo "Giriş Başarılı.";
			header('Location: admin.php');
			
		}
		else{
            
			echo '<script language="javascript">';
			echo 'alert("Şifre Hatalı\nLütfen Tekrar Deneyiniz.")';
			echo '</script>';
		}
	}
	require_once 'footer.html';


?>
