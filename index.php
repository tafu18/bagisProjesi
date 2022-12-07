
<?php 
    session_start();
    require_once 'header.php'; 
    include 'db.php';
    include 'slider.html';

    $query_donations = $db->prepare("SELECT SUM(`qty`) AS `sum` , donation FROM `donations` GROUP BY `donation` ORDER BY `sum` DESC");
    $query_donations->execute();
    $donations = $query_donations->fetchAll(PDO::FETCH_ASSOC);
?>
<html style="background: #eff2f5;" ng-app="donationApp" ng-controller="donationCtrl">    
<div class="">
    <div style="margin-bottom: 0!important;" class="jumbotron jumbotron-fluid">
        <div class="text-center d-block d-sm-none">
            <a href="#deneme"><button class="btn btn-special">Bağış Yap</button></a>
            <a href="#deneme"><button class="btn btn-special">Yardım Talep Et</button></a>
        </div>
        <div class="container">
            <h1 class="display-4">Bağışlar</h1>
            <p class="lead">Sizlerin Yapmış Olduğu Bağış Miktarları.</p>
        </div>
    </div>
    <div style="background-color: #253949!important;" class="nav justify-content-center-2 tabs color-theme row">
        <?php foreach($donations as $donation){ ?>
            <div class="donation-total-table shadow rounded-lg align-items-center display-flex flex-column p-3 grocer-list">
                <div class="display-flex flex-column justify-content-around align-items-center">
                    <img
                        width = 90
                        height = 100
                        class="mx-auto mx-md-0 align-items-center"
                        src="<?php 
                                if($donation['donation'] == 'Elbise Yardımı') echo 'images/kiyafet.png';
                                elseif($donation['donation'] == 'Yemek Kartı Yardımı (Üniversite için)') echo 'images/neu-footer-logo.png';
                                elseif($donation['donation'] == 'Ayakkabı Yardımı') echo 'images/ayakkabi.png';
                                elseif($donation['donation'] == 'Yakacak Yardımı') echo 'images/komur.png';
                                elseif($donation['donation'] == 'Eğitim Masrafı Yardımı') echo 'images/egitim.png';
                                elseif($donation['donation'] == 'Kitap Yardımı') echo 'images/kitap.png';
                                elseif($donation['donation'] == 'Fatura Yardımı') echo 'images/fatura.png';
                                elseif($donation['donation'] == 'İaşe Yardımı') echo 'images/yemek.png';
                                elseif($donation['donation'] == 'Diğer Yardımlar') echo 'images/diger.png';
                            ?>"
                        alt=""
                    />
                    <div style="color: #526b84; margin: auto;"class="source-info media-body pt-3 text-center align-items-center h-100">
                        <h5 class="mb-2 deneme"><?php echo $donation['sum'] . ' Adet'; ?></h5>
                        <div class="deneme"><?php echo $donation['donation'] ?></div>
                    </div>
                </div>
            </div>
        <?php }?>
    </div>

    <h3 class="text-center my-5">Yardımda Bulunmak Ya Da Yardım Talep Etmek İçin Aşağıdan Bağış Türünü Seçiniz.</h3>
    <div id="deneme" class="list-filter">	
        <ul class="nav justify-content-center-2 tabs color-theme">
            <li class="nav-item mx-2 my-2" role="presentation" ng-click="toggleDonation();">
                <div>
                    <a class="nav-link text-center rounded-lg border-transparent" href="" ng-class="getClass2()">
                        <img src="images/main-slider/worker.svg" alt="" width = "70" height = "80"><br>
                        Yardım Etmek İstiyorum
                    </a>
                </div>
            </li>
            <li class="nav-item mx-2 my-2" role="presentation" ng-click="toggle();">
                <div>
                    <a class="nav-link text-center rounded-lg border-transparent" href="" ng-class="getClass()">
                        <img src="images/main-slider/employer.svg" alt="" width = "70" height = "80"><br>
                        Yardım Talep Etmek İstiyorum
                    </a>
                </div>
                
            </li>
        </ul>
    </div>
    <hr class="mb-5"> 
    <div class="container d-flex flex-wrap" style="height: auto; margin: auto;">
        <h3 ng-show="isSelectDonation" class="text-center col-12">Yardım Etmek İstediğiniz Kategoriyi Seçiniz</h3>
        <h3 ng-show="isSelect" class="text-center col-12">Talep Etmek İstediğiniz Yardımın Kategorisini Seçiniz</h3>
        <div ng-show="isSelectDonation" class="width-donation donation-card shadow rounded-lg align-items-center display-flex flex-column p-3 grocer-list" ng-repeat="type in donation_types">
            <a href = "donation_form.php?donation_type={{type.donation_name}}">
                <div class="display-flex flex-column justify-content-around align-items-center">
                    <img
                        width = 90
                        height = 100
                        class="mx-auto mx-md-0 align-items-center"
                        src="{{type.donation_img}}"
                        alt=""
                    />
                    <div style="color: #526b84; margin: auto;"class="source-info media-body pt-3 text-center align-items-center h-100">
                        <h5 class="mb-2">{{type.donation_name}}</h5>
                        <div>{{type.donation_name}}</div>
                    </div>
                </div>
            </a>
        </div>
        <div ng-show="isSelect" class="width-donation donation-card shadow rounded-lg align-items-center display-flex flex-column p-3 grocer-list" ng-repeat="type in donation_types">
            <a href = "demand_form.php?demand_type={{type.donation_name}}">
                <div class="display-flex flex-column justify-content-around align-items-center">
                    <img
                        width = 90
                        height = 100
                        class="mx-auto mx-md-0 align-items-center"
                        src="{{type.donation_img}}"
                        alt=""
                    />
                    <div style="color: #526b84; margin: auto;"class="source-info media-body pt-3 text-center align-items-center h-100">
                        <h5 class="mb-2">{{type.donation_name}}</h5>
                        <div>{{type.donation_name}}</div>
                    </div>
                </div>
            </a>
        </div>
    </div>
    <div style="background: #eff2f5;" class="py-lg-5">
        <h3 class="mb-3 pt-3 text-center font-weight-bold">
            Yardım Sistemi Nasıl Çalışır?
        </h3>
        <table class="info-table">
            <tr>
                <td>  
                    <div class="card rounded border-0 shadow-lg mb-5">
                        <div class="card-body p-4">
                            <h5 class="card-title">
                                <i
                                    class="fas fa-file mr-2 mr-lg-3 color-text fa-lg fa-fw"
                                ></i>
                            </h5>
                            <p class="card-text">
                                İlk önce yapmak istediğiniz işlemi seçiniz (Yardım etmek 
                                ya da yardım talep etmek).
                            </p>
                        </div>
                    </div>
                </td>
            </tr>
            <tr>
                <td>
                    <div class="card rounded border-0 shadow-lg mb-5">
                        <div class="card-body p-4">
                            <h5 class="card-title">
                                <i
                                    class="fas fa-address-card mr-2 mr-lg-3 color-text fa-lg fa-fw"
                                ></i>
                            </h5>
                            <p class="card-text">
                                Sonra gelen ekrandan yapacağınız ya da talep edeceğiniz yardım
                                türünü seçiniz.
                            </p>
                        </div>
                    </div>
                </td>
            </tr>
            <tr>
                <td>
                    <div class="card rounded border-0 shadow-lg mb-5">
                        <div class="card-body p-4">
                            <h5 class="card-title">
                                <i
                                    class="fas fa-th-list mr-2 mr-lg-3 color-text fa-lg fa-fw"
                                ></i>
                            </h5>
                            <p class="card-text">
                                Ardından gelen formda bizlerin sizinle iletişimini daha kolay
                                sağlayabilmemiz için eksiksiz ve doğru bir şekilde doldurunuz. 
                            </p>
                        </div>
                    </div>
                </td>
            </tr>
            <tr>
                <td>
                    <div class="card rounded border-0 shadow-lg mb-5">
                        <div class="card-body p-4">
                            <h5 class="card-title">
                                <i
                                    class="fas fa-at mr-2 mr-lg-3 color-text fa-lg fa-fw"
                                ></i>
                            </h5>
                            <p class="card-text">
                                Formu doldurduktan sonra mail ile bilgilendirileceksiniz.
                            </p>
                        </div>
                    </div>
                </td>
            </tr>
            <tr>
                <td>
                    <div class="card rounded border-0 shadow-lg" style="margin-bottom: 4rem!important;">
                    <div class="card-body p-4">
                        <h5 class="card-title">
                            <i
                                class="fas fa-shopping-cart mr-2 mr-lg-3 color-text fa-lg fa-fw"
                            ></i>
                        </h5>
                        <p class="card-text">
                            En son olarak yardım talep edenlerle yardım isteyenleri sistem otomatik olarak eşleştirip
                            ihtiyaç sahibine yardımı ulaştırıyoruz.
                        </p>
                    </div>
                    </div>
                </td>
            </tr>
        </table>
    </div>
</div>






<?php 
    include 'footer.html'; 
?>

