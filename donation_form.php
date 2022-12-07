<?php 
ob_start();
require_once 'header.php'
?>

<div ng-app="donationApp" ng-controller="donationCtrl" class="mt-15">
    <div class="container mt-15 mb-5">
        <form action="" method="POST">
            <div class="form-row">
                <div class="form-group col-md-6">
                    <label for="name">Ad</label>
                    <input type="text" class="form-control" name="firstname" id="firstname" placeholder="Adınız" required>
                </div>
                <div class="form-group col-md-6">
                    <label for="lastname">Soyad</label>
                    <input type="text" class="form-control" name="lastname" id="lastname" placeholder="Soyadınız" required>
                </div>
            </div>
            <div class="form-row">
                <div class="form-group col-md-6">
                    <label for="phone">Telefon Numarası</label>
                    <input type="text" class="form-control" name="phone" id="phone" placeholder="5XXXXXXXXX" required>
                </div>
                <div class="form-group col-md-6">
                    <label for="email">Mail Adresi</label>
                    <input type="mail" class="form-control" name="email" id="email" placeholder="Mail Adresiniz" required>
                </div>
            </div>
            <div class="form-row">
                <div class="form-group col-md-6">
                    <label for="qty">Adet Sayısı</label>
                    <input type="text" class="form-control" name="qty" id="qty" placeholder="Adet Sayısı" required>
                </div>
                <div class="form-group col-md-6">
                    <label for="type">Bağış Şekli</label>
                    <select class="form-select form-control" ng-init="type = type || 'none'" ng-model="type" name="type" aria-label=".form-select-lg example" required>
                        <option ng-selected="true" ng-disabled="true" value="">Bağış Şekli Seçin</option>
                        <option value="0" ng-disabled="true" >Nakit (Geçici Olarak Devre Dışı)</option>
                        <option value="1">Ürün</option>
                    </select>
                </div>
                <div ng-show="type == 1" style="margin-left: 8px;" class="detail">
                    <span>Bağışlarınızı Tayfun Taşdemir Adına NEÜ Seydişehir Ahmet Cengiz Mühendislik Fakültesine Getirebilirsiniz. Eğer Bağışı Getirme İmkanınız Yoksa Bizimle İletişime Geçiniz.(Sayfanın En Üst Kısmında Telefon Numarası Mevcuttur.)</span>
                </div><br>
            </div>
            <div class="form-group">
                <label for="address">Adres</label>
                <input type="text" class="form-control" name="address" id="address" placeholder="Adresiniz" required>
            </div>
            <div class="form-group">
                <label for="diger">Diğer İstekler</label>
                <input type="text" class="form-control" name="another" id="another" placeholder="Diğer İstekler">
            </div>
            

            <div ng-show="type == 0" class="form-row">
                <div class="form-group col-md-6">
                    <label for="cardno">Kart Numarası</label>
                    <input type="text" class="form-control" name="cardno" id="cardno" placeholder="Kart Numarası">
                </div>
                <div class="form-group col-md-6">
                    <label for="skty">Son Kullanma Tarihi - Yıl</label>
                    <input type="number" class="form-control" name="skty" id="skty" placeholder="23">
                </div>
            </div>
            <div ng-show="type == 0" class="form-row">
                <div class="form-group col-md-6">
                    <label for="skta">Son Kullanma Tarihi - Ay</label>
                    <input type="number" class="form-control" name="skta" id="skta" placeholder="05">
                </div>
                <div class="form-group col-md-6">
                    <label for="cvv">Mail Adresi</label>
                    <input type="number" class="form-control" name="cvv" id="cvv" placeholder="CVV">
                </div>
            </div>
           <!--  <button type="submit" class="btn btn-primary">Gönder</button> -->

            <button type="submit" class="btn btn-special" >Gönder</button>



        </form>

    </div>
</div>

<?php 
require_once 'db.php';
$donation_type = $_GET['donation_type'];

$query_demands = $db->prepare("SELECT * FROM `demands` WHERE `status` = 0 AND `demand` = '$donation_type' ORDER BY id ASC");
$query_demands->execute();
$demands = $query_demands->fetchAll(PDO::FETCH_ASSOC);

if ($_SERVER["REQUEST_METHOD"] == "POST"){
    $name = $_POST['firstname'] . ' ' .  $_POST['lastname'];
    $phone = $_POST['phone'];
    $email = $_POST['email'];
    $qty = $_POST['qty'];
    $donation_form = $_POST['type'];
    $address = $_POST['address'];
    $another = $_POST['another'];
    $donation = $donation_type;
    //$date_added = date('Y-m-d H:i:s' ,strtotime('now'));
    $token = hexdec(uniqid());
    $tok = substr($token, 6, -1);
    /* $added_admin_name = $_SESSION['name']; */

    $sql = $db->prepare("INSERT INTO `donations`(`name`,`donation_uniq_id`, `donation`, `email`, `phone`, `qty`, `qty_counter`, `qty_control`, `donation_form`, `address`, `another`) VALUES ('$name', '$tok', '$donation', '$email', '$phone', '$qty', '$qty', '$qty', '$donation_form', '$address', '$another')");

    $ekle = $sql->execute();
    if ($ekle){
        echo '<div class="succes" ><span class="text-center badge badge-complete badge-pill">Bağış Gerçekleştirildi</span></div>';
    }
    else
        echo "Kayıt eklenemedi";

    $query_donations = $db->prepare("SELECT * FROM `donations` WHERE `donation_uniq_id`" . "=" . $tok);
    $query_donations->execute();
    $donation_q = $query_donations->fetch(PDO::FETCH_ASSOC);

    $control = true;
    if($demands != null){
        foreach($demands as $demand){
            if($donation_q['qty_control'] > 0){
        
                $demand_id = $demand['demand_uniq_id'];
                $img_src = $tok . '_' . $demand_id . ".jpg";

                $sql_control = $db->prepare("INSERT INTO `donation_and_demand_control` (`donation_id`, `demand_id`, `img_src`) VALUES ('$tok', '$demand_id', '$img_src')");
                $sql_control_add = $sql_control->execute();

                if($sql_control_add) $donation_q['qty_control'] = $donation_q['qty_control'] - 1;

                $set_donation_qty_control = $db->prepare("UPDATE `donations` SET `qty_control` =" . $donation_q['qty_control'] . " WHERE donation_uniq_id = $tok");
                $set_exe_don = $set_donation_qty_control->execute();

                $set_donation_status = $db->prepare("UPDATE `demands` SET `status` = 1 WHERE demand_uniq_id = $demand_id");
                $set_exe_status = $set_donation_status->execute();

                if($donation_q['qty_control'] == 0){

                    $set_donation_status_2 = $db->prepare("UPDATE `donations` SET `status` = 1 WHERE donation_uniq_id = $tok");
                    $set_exe_status = $set_donation_status_2->execute();

                }                    
            }
        }

    }
    
}
?>

<script>
    if ( window.history.replaceState ) {
        window.history.replaceState( null, null, window.location.href );
    }//Tarayıcının input geçmişini siler.

</script>

<?php require_once 'footer.html';?>
