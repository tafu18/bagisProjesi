<!DOCTYPE html>
<html lang="tr">
<?php 

$uri = $_SERVER['REQUEST_URI'];

$explode_uri = explode('/',$uri);

$counter = count($explode_uri);

$page = $explode_uri[$counter-1];

$active_page = explode('.', $explode_uri[$counter-1]);

if($active_page[0] == 'control')               $title = 'Admin | Kontrol Paneli';
elseif($active_page[0] == 'admin')             $title = 'Admin | Admin Paneli';
elseif($active_page[0] == 'demand_details')    $title = 'Talep | Talep Detayı';
elseif($active_page[0] == 'demand_form')       $title = 'Talep | Talep Formu';
elseif($active_page[0] == 'demands')           $title = 'Talep | Talepler';
elseif($active_page[0] == 'donation_details')  $title = 'Bağış | Bağış Detayı';
elseif($active_page[0] == 'donation_form')     $title = 'Bağış | Bağış Formu';
elseif($active_page[0] == 'donations')         $title = 'Bağış | Bağışlar';
elseif($active_page[0] == 'gallery')           $title = 'Bağışlar | Bağış Galerisi';
elseif($active_page[0] == 'index')             $title = 'Ana Sayfa | Sosyal Sorumluluk Projesi';
elseif($active_page[0] == 'last_donation')     $title = 'Bağışlar ve Talepler | Geçmiş Bağışlar ve Talepler';
elseif($active_page[0] == 'login')             $title = 'Admin | Admin Panel Giriş';
elseif($active_page[0] == 'demand_details')    $title = 'Talep | Talep Detayı';
else                                           $title = 'Sosyal Sorumluluk Projesi';




?>

<head>
<meta charset="utf-8">
<title><?php echo $title;?></title>
<!-- Stylesheets -->
<link href="css/bootstrap.css" rel="stylesheet">
<link href="css/style.css" rel="stylesheet">
<link href="css/responsive.css" rel="stylesheet">

<link rel="shortcut icon" href="images/favicon.png" type="image/x-icon">
<link rel="icon" href="images/favicon.png" type="image/x-icon">

<!-- Responsive -->
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0">



</head>

<body>

<div class="page-wrapper">

    <div class="preloader"></div>

    <header class="main-header header-style-one">
        <div class="header-top">
            <div class="auto-container clearfix">
                <div class="top-left clearfix">
                    <div class="text"><span class="icon flaticon-call-answer">&nbsp;İhtiyacın mı var? Bize ulaşabilirsin: <a href="tel:538-597-23-18" class="number"> 538 597 2318</a></span></div>
                </div>
                <div class="top-right clearfix">
					<ul class="info-list">
                        <li><a href="https://www.seydisehir.bel.tr/">Seydişehir Belediyesi</a></li>
                        <li><a href="http://www.seydisehir.gov.tr/">Seydişehir Kaymakamlığı</a></li>
						<li class="quote"><a href="https://www.erbakan.edu.tr/seydisehirahmetcengizmuhendislik">NEÜ SACMF</a></li>
                    </ul>
                </div>
            </div>
        </div>
        <div class="header-upper">
            <div class="inner-container">
                <div class="auto-container clearfix">
                    <div class="logo-outer display-felx">
                        <div class="logo mr-3"><a href="https://www.erbakan.edu.tr/seydisehirahmetcengizmuhendislik" target="_blank"><img src="images/neu-footer-logo.png" alt="" title=""></a></div>
                        <div class="logo m-auto"><a href="http://www.seydisehir.gov.tr/" target="_blank"><img src="images/kaymakamlik_logo.png" alt="" title=""></a></div>
                        <div class="logo m-auto"><a href="https://www.seydisehir.bel.tr/" target="_blank"><img src="images/belediye_logo.png" alt="" title=""></a></div>
                    </div>

                    <div class="nav-outer clearfix">
                        <div class="mobile-nav-toggler"><span class="icon flaticon-menu-1"></span></div>
                        <nav class="main-menu navbar-expand-md navbar-light">
                            <div class="navbar-header">   
                                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                                    <span class="icon flaticon-menu-1"></span>
                                </button>
                            </div>
                            
                            <div class="collapse navbar-collapse clearfix" id="navbarSupportedContent">
                                <ul class="navigation clearfix">
                                    <li class="dropdown"><a href="index.php">Anasayfa</a></li>
									<li class="dropdown"><a href="donations.php">Bağışlar</a></li>
                                    <li class="dropdown"><a href="demands.php">Talepler</a></li>
                                    <li><a href="gallery.php?page=1">Gerçekleşen Bağışlar</a></li>
                                </ul>
                            </div>
                        </nav>
                    </div>
                </div>
            </div>
        </div>

        <div class="mobile-menu">
            <div class="menu-backdrop"></div>
            <div class="close-btn"><span class="icon flaticon-cancel"></span></div>
            
            <nav class="menu-box">
                <div class="nav-logo justify-content-center"><a href="index.php"><img src="images/neu-footer-logo.png" alt="" title=""></a></div>
                <ul class="navigation clearfix"></ul>
				<div class="social-links">
					<ul class="clearfix">
						<li><a href="https://twitter.com/neu_acengizmf"><span class="fab fa-twitter"></span></a></li>
						<li><a href="https://www.facebook.com/groups/2008198646125525"><span class="fab fa-facebook-square"></span></a></li>
						<li><a href="https://www.instagram.com/neu_acengizmf/"><span class="fab fa-instagram"></span></a></li>
						<li><a href="index.php"><span class="fab fa-youtube"></span></a></li>
					</ul>
                </div>
            </nav>
        </div>

    </header>
    