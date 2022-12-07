<?php 
require_once 'header.php';
$demand_type = $_GET['demand_type'];
?>

<div ng-app="donationApp" ng-controller="demandsCtrl" class="mt-15">
    <div class="container mt-15 mb-5">  
                <div style="margin-left: 8px;" class="detail">
                <span><img style="margin-right: 15px;" width="32px" height="32px" src="images/icons/exclamation5.ico" alt="" >Senelik Olarak 3 Tane Talep Hakkınız Bulunmaktadır. Lütfen Bunu Göz Önüne Alarak Talepte Bulununuz!</span>
                </div><br>
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
            <div ng-show="<?php if($demand_type == 'Elbise Yardımı') echo 'true'; ?>" class="form-row">
                <div class="form-group col-6">
                    <label for="gender">Cinsiyet</label>
                    <select class="form-select form-control" name="gender" aria-label=".form-select-lg example" required>
                        <option disabled selected value="0">Cinsiyetinizi Seçin</option>
                        <option value="Kadın">Kadın</option>
                        <option value="Erkek">Erkek</option>
                    </select>
                </div>
                <div class="form-group col-6">
                    <label for="size">Beden</label>
                    <select class="form-select form-control" name="size" aria-label=".form-select-lg example" required>
                        <option disabled selected value="0">Beden Seçin</option>
                        <option ng-repeat="size in sizes" value="{{size}}">{{size}}</option>
                    </select>
                </div>
            </div>
            <div ng-show="<?php if($demand_type == 'Ayakkabı Yardımı') echo 'true'; ?>" class="form-row">
                <div class="form-group col-6">
                    <label for="gender">Cinsiyet</label>
                    <select class="form-select form-control" name="gender" aria-label=".form-select-lg example" required>
                        <option disabled selected value="0">Cinsiyetinizi Seçin</option>
                        <option value="Kadın">Kadın</option>
                        <option value="Erkek">Erkek</option>
                    </select>
                </div>
                <div class="form-group col-6">
                    <label for="shoes_size">Ayakkabı Numara</label>
                    <select class="form-select form-control" name="shoes_size" aria-label=".form-select-lg example" required>
                        <option disabled selected value="0">Numara Seçin</option>
                        <option ng-repeat="shoes_size in shoes_sizes" value="{{shoes_size}}">{{shoes_size}}</option>
                    </select>
                </div>
            </div>
            <div class="form-group">
                <label for="address">Adres</label>
                <input type="text" class="form-control" name="address" id="address" placeholder="Adresiniz" required>
            </div>
            <div class="form-group">
                <label for="diger">Diğer İstekler</label>
                <input type="text" class="form-control" name="another" id="another" placeholder="Diğer İstekler">
            </div>
            <button type="submit" class="btn btn-special">Gönder</button>
        </form>

    </div>
</div>

<?php 
require_once 'db.php';
$demand_type = $_GET['demand_type'];

$query_donations = $db->prepare("SELECT * FROM `donations` WHERE `status` = 0 AND `donation` = '$demand_type' AND `qty_control` > 0 ORDER BY id ASC");
$query_donations->execute();
$donations = $query_donations->fetch(PDO::FETCH_ASSOC);

$firstDayThisDay = date("Y-m-d H:i:s" ,strtotime('1/1 this year'));
$firstDayNextDay = date("Y-m-d H:i:s" ,strtotime('1/1 next year'));

if ($_SERVER["REQUEST_METHOD"] == "POST"){
    $name = strtoupper($_POST['firstname'] . ' ' .  $_POST['lastname']);
    $phone = $_POST['phone'];
    $email = $_POST['email'];
    $address = $_POST['address'];
    @$gender = $_POST['gender'];
    @$size = $_POST['size'];
    @$shoes_size = $_POST['shoes_size'];
    $another = $_POST['another'];
    $demand = $demand_type;
    //$date_added = date('Y-m-d H:i:s' ,strtotime('now'));
    $token = hexdec(uniqid());
    $tok = substr($token, 6, -1);
    /* $added_admin_name = $_SESSION['name']; */

    $demand_control_counter = $db->prepare("SELECT count(*) as `counter` FROM `demands` WHERE `phone` = '$phone' AND `name` = '$name' AND `date_added` > '$firstDayThisDay' AND `date_added` < '$firstDayNextDay'");
    $demand_control_counter->execute();
    $demand_cc = $demand_control_counter->fetch(PDO::FETCH_ASSOC);

    if($demand_cc['counter'] < 3){
        $sql = $db->prepare("INSERT INTO `demands`(`name`,`demand_uniq_id`, `demand`, `email`, `phone`, `address`, `gender`, `size`, `shoes_size`, `another`) VALUES ('$name', '$tok', '$demand', '$email', '$phone', '$address', '$gender', '$size', '$shoes_size',  '$another')");
        $ekle = $sql->execute();
        if ($ekle)
            echo '<div class="succes" ><span class="text-center badge badge-complete badge-pill">Yardım Talebi Gerçekleştirildi</span></div>';
    }else 
        echo '<div class="warning" ><span class="text-center badge badge-fail badge-pill">Senelik 3 Tane Talep Hakkınız Dolmuştur</span></div>';





    if($donations != null){
        $donation_id = $donations['donation_uniq_id'];
        $img_src = $donation_id . "_" . $tok . ".jpg";

        $sql_control = $db->prepare("INSERT INTO `donation_and_demand_control` (`donation_id`, `demand_id`, `img_src`) VALUES ('$donation_id', '$tok', '$img_src')");
        $sql_control_add = $sql_control->execute();

        if($sql_control_add) $donations['qty_control'] = $donations['qty_control'] - 1;

        $set_donation_qty_control = $db->prepare("UPDATE `donations` SET `qty_control` =" . $donations['qty_control'] . " WHERE donation_uniq_id = $donation_id");
        $set_exe_don = $set_donation_qty_control->execute();

        $set_donation_status = $db->prepare("UPDATE `demands` SET `status` = 1 WHERE demand_uniq_id = $tok");
        $set_exe_don_status = $set_donation_status->execute();

        if($donations['qty_control'] == 0 ){

            $set_donation_qty_control_0 = $db->prepare("UPDATE `donations` SET `status` = 1 WHERE donation_uniq_id = $donation_id");
            $set_exe_don_0 = $set_donation_qty_control_0->execute();
            
        }
    }

/* $firstDayThisDay = date("Y-m-d H:i:s" ,strtotime('1/1 this year'));
$firstDayNextDay = date("Y-m-d H:i:s" ,strtotime('1/1 next year'));
SELECT count(*) FROM `demands` WHERE `phone` = $phone AND `name` = $name; AND `date_added` > '$firstDayThisDay' AND `date_added` < '$firstDayNextDay' */


    
    

























    
/*     
        foreach($donations as $dona){$tok_don = $dona['donation_uniq_id'];}

        $query_donations = $db->prepare("SELECT * FROM `donations` WHERE `donation_uniq_id`" . "=" . $tok_don);
        $query_donations->execute();
        $donation_q = $query_donations->fetch(PDO::FETCH_ASSOC);
    
        $control = true;
        if($donations != null){
            while($control){
                foreach($donations as $donation){
                        if($donation_q['qty_counter'] > 0){
                            $query_donations = $db->prepare("SELECT * FROM `donations` WHERE `donation_uniq_id`" . "=" . $tok);
                            $query_donations->execute();
                            $donation_q = $query_donations->fetch(PDO::FETCH_ASSOC);
                        
                            if($donation_q['qty_control'] > 0 ){
                                $donation_id = $donation['donation_uniq_id'];
                                $img_src = $tok . '_' . $demand_id;
                                $sql_control = $db->prepare("INSERT INTO `donation_and_demand_control` (`donation_id`, `demand_id`, `img_src`) VALUES ('$donation_id', '$tok', '$img_src')");
                                $sql_control_add = $sql_control->execute();

                                $donation_q['qty_control'] = $donation_q['qty_control'] - 1;
                                $set_donation_qty_control = $db->prepare("UPDATE `donations` SET `qty_control` =" . $donation_q['qty_control'] . " WHERE donation_uniq_id = $tok");
                                $set_exe_don = $set_donation_qty_control->execute();
                            }
                        }
                }
                $control = false;
            }
        }
 */


}





?>
<script>
        if ( window.history.replaceState ) {
        window.history.replaceState( null, null, window.location.href );
    }//Tarayıcının input geçmişini siler.

</script>
<?php require_once 'footer.html' ?>
