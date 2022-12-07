<?php include 'header.php';
include 'db.php';

$query_donations = $db->prepare("SELECT * FROM `donation_and_demeand_match`");
$query_donations->execute();
$donations = $query_donations->fetchAll(PDO::FETCH_ASSOC);
?>
<html ng-app="donationApp" ng-controller="donationCtrl">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta2/css/all.min.css">
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/css/bootstrap.min.css" integrity="sha384-TX8t27EcRE3e/ihU7zmQxVncDAy5uIKz4rEkgIXeMed4M0jlfIDPvg6uqKI2xXr2" crossorigin="anonymous">
<script src="https://code.jquery.com/jquery-3.6.0.slim.min.js" integrity="sha256-u7e5khyithlIdTpu22PHhENmPcRdFiHRjhAuHcs05RI=" crossorigin="anonymous"></script>

<div class="container mt-15">
<?php
    $limit = 12;
    $query = "SELECT count(*) FROM donation_and_demeand_match";
    @$current_page = $_GET['page'];
    $s = $db->query($query);
    $total_results = $s->fetchColumn();
    $total_pages = ceil($total_results/$limit);

    if (!isset($_GET['page'])) {
        $page = 1;
    } else{
        $page = $_GET['page'];
    }
    $starting_limit = ($page-1)*$limit;
    $show  = "SELECT * FROM donation_and_demeand_match ORDER BY id DESC LIMIT $starting_limit, $limit";

    $r = $db->prepare($show);
    $r->execute();
?>
    <h2 class="text-center color-text mb-5">Gerçekleştirilen Bağışlar</h2>
    <div class="container-fluid">
        <div class="px-lg-5">
            <div class="row">
                <!-- Gallery item -->
                <?php while($res = $r->fetch(PDO::FETCH_ASSOC)):?>
                <div class="col-xl-3 col-lg-4 col-md-6 mb-4 gallery-width">
                    <div class="bg-white rounded shadow-sm"><a id="donation_img" target="_blank" href="<?php echo $res['img_src']?>"><img src="<?php echo $res['img_src']?>" width="120px!important" height="120px!important" alt="" class="img-fluid card-img-top"></a>
                    <div class="p-4">
                        <h5 class="text-center dotdotdot"> <a href="#" class="text-dark"><?php echo $res['donation_name']?></a></h5>
                        <p class="small text-muted mb-0 text-center" style="font-size: 70%!important;"><?php echo 'Bağış Numarası' . ' -> ' . 'Talep Numarası'?></p>
                        <p class="small text-muted mb-0 text-center"><?php echo $res['donation_id'] .' -> ' . $res['demand_id']?></p>
                        <div class="d-flex align-items-center justify-content-center-2 rounded-pill bg-light px-3 py-2 mt-4">
                        <div style="color: #fff; background-color: black" class="badge px-3 rounded-pill font-weight-normal"><?php echo substr($res['date_matching'], 0, 10);?></div>
                        </div>
                    </div>
                    </div>
                </div>
                <?php endwhile;?>
                <!-- End -->
            </div>
        </div>
    </div>
    <nav style="margin-bottom: 4rem;" aria-label="Page navigation example">
        <ul class="pagination justify-content-center">
            <?php
            if($current_page > 1) {?>
                <li class="page-item"><a class="page-link" href="<?php echo "?page=1"; ?>"><?php  echo "<<<" ?></a></li>
                <li class="page-item"><a class="page-link" href="<?php echo "?page=".$current_page - 1; ?>"><?php  echo "<" ?></a></li>
            <?php }?>
            <?php for ($page=1; $page <= $total_pages ; $page++){
                if($current_page == $page) { ?>
                    <li class="page-item"><a class="page-link current_page" href="<?php echo "?page=$page"; ?>"><?php  echo $page; ?></a></li>
            <?php }elseif(($current_page != $page)){?>
            <li class="page-item"><a class="page-link" href="<?php echo "?page=$page"; ?>"><?php  echo $page; ?></a></li>
            <?php }} 
            if($current_page < $total_pages) {?>
                <li class="page-item"><a class="page-link" href="<?php echo "?page=".$current_page + 1; ?>"><?php  echo ">" ?></a></li>
                <li class="page-item"><a class="page-link" href="<?php echo "?page=".$total_pages; ?>"><?php  echo ">>>" ?></a></li>
            <?php }?>   
        </ul>
    </nav>
</div>

<?php include 'footer.html';?>







<!-- 

   $scope.donation_types = [ 
        {donation_code: "1",    donation_name: "Yemek Kartı Yardımı (Üniversite için)",  donation_img: "images/neu-footer-logo.png", donation_color: #253949},
        {donation_code: "2",    donation_name: "Elbise Yardımı",                         donation_img: "images/kiyafet.png" , donation_color: #45A074},
        {donation_code: "3",    donation_name: "Ayakkabı Yardımı",                       donation_img: "images/ayakkabi.png" , donation_color: #287AB8},
        {donation_code: "4",    donation_name: "Mont Yardımı",                           donation_img: "images/mont.jpg" , donation_color: #2F4F4F},
        {donation_code: "5",    donation_name: "Soba Yakıtı Yardımı",                    donation_img: "images/komur.png" , donation_color: #3C3F46},
        {donation_code: "6",    donation_name: "Eğitim Masrafı Yardımı",                 donation_img: "images/egitim.png" , donation_color: #FFCC00},
        {donation_code: "7",    donation_name: "Kitap Yardımı",                          donation_img: "images/kitap.png" , donation_color: #6CEEEC},
        {donation_code: "8",    donation_name: "Fatura Yardımı",                         donation_img: "images/fatura.png" , donation_color: #8B0000},
        {donation_code: "9",    donation_name: "Yemek Yardımı",                          donation_img: "images/yemek.png" , donation_color: #333333},
        {donation_code: "10",   donation_name: "Diğer Yardımlar",                        donation_img: "images/diger.png" , donation_color: #BB78BC},
    ];

Yemek kartı -> #253949
Elbise Yardımı -> #45A074
Ayakkabı Yardımı -> #287AB8
Mont Yardımı -> #2F4F4F
Soba Yakıtı Yardımı -> #3C3F46
Eğitim Masrafı Yardımı -> #FFCC00
Kitap Yardımı -> #6CEEEC
Fatura Yardımı -> #8B0000
Yemek Yardımı -> #333333
Diğer Yardımlar -> #BB78BC






 -->