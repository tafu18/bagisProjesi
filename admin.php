<?php 
ob_start();
session_start();
if($_SESSION['name'] == null) header("Location:login.php");
require_once 'header.php';  require_once 'db.php';

$query_donations = $db->prepare("SELECT * FROM `donations` WHERE `status` != 2  ORDER BY id DESC");
$query_donations->execute();
$donations = $query_donations->fetchAll(PDO::FETCH_ASSOC);

$query_demands = $db->prepare("SELECT * FROM `demands` WHERE `status` != 2 ORDER BY id DESC");
$query_demands->execute();
$demands = $query_demands->fetchAll(PDO::FETCH_ASSOC);




?>
<section class="rotate"></section>
<section class="rotate-reverse"></section>
<section class="mt-15 mb-5">
    <div class="container">
        <div class="justify-content-right form-row">
            <form method="get">
                <button type="submit" name="close" class="btn btn-special col-12" >Çıkış Yap</button>
            </form>
        </div>
        <h2 class="text-center color-text mb-5"><b>Genel Bilgi Düzenleme Tabloları</b></h2>
        <div class="row">
            <div style="background-color: #253949; color: white!important; height:auto; flex-wrap: wrap;" class="col shadow rounded-lg">
                <table id="donationTable" class="table table-striped">
                    <thead>
                        <tr> 
                            <label for="donation_input">Bağış Türüne Göre Filtreleme</label>
                            <input type="text" class="form-control" id="donation_input" onkeyup="filter_donation()" placeholder="Bağış Türü">
                        </tr>
                        <tr>
                            <th class="text-center" colspan="5" scope="col">Bağışlar Tablosu</th>
                        </tr>
                        <tr>
                            <th scope="col">#</th>
                            <th scope="col">Bağış Numarası</th>
                            <th scope="col">Bağış Türü</th>
                            <th scope="col">Bağış Adedi</th>
                            <th scope="col">Bağış Durumu</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php $counter_donation = 1; foreach($donations as $donation){?>
                        <tr>
                            <th scope="row"><?php echo $counter_donation?></th>
                            <td><?php echo $donation['donation_uniq_id']?></td>
                            <td><?php echo $donation['donation']?></td>
                            <td><?php if($donation['qty_counter'] == 0) echo '---'; else echo $donation['qty_counter']?></td>
                            <td class="text-center"><?php if($donation['status'] == 0) echo '<span style="width:100px" class="text-center badge badge-fail badge-pill">Beklemede</span>'; elseif($donation['status'] == 1) echo '<span style="width:100px" class="text-center badge-current badge-pill">Sıraya Alındı</span>'; elseif($donation['status'] == 2) echo '<span style="width:100px" class="text-center badge-complete badge-pill">Tamamlandı</span>';?></td>
                        </tr>
                        <?php $counter_donation++; }?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</section>


<section class="mt-15 mb-5">
    <div class="container">
        <h2 class="text-center color-text mb-5"><b>Genel Bilgi Düzenleme Tabloları</b></h2>
        <div class="row">
            <div style="background-color: #EFF2B7; color: black!important; height:auto; flex-wrap: wrap;" class="col shadow rounded-lg">
                <table id="demandTable" class="table table-striped">
                    <thead>
                        <tr> 
                            <label for="demand_input">Talep Türüne Göre Filtreleme</label>
                            <input type="text" class="form-control" id="demand_input" onkeyup="filter_demand()" placeholder="Talep Türü">
                        </tr>
                        <tr>
                            <th class="text-center" colspan="5" scope="col">Talepler Tablosu</th>
                        </tr>
                        <tr>
                            <th scope="col">#</th>
                            <th scope="col">Talep Numarası</th>
                            <th scope="col">Talep Türü</th>
                            <th scope="col">Cinsiyet Ve Beden</th>
                            <th scope="col">Talep Durumu</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php $counter_demand = 1; foreach($demands as $demand){?>
                        <tr>
                            <th scope="row"><?php echo $counter_demand?></th>
                            <td><?php echo $demand['demand_uniq_id']?></td>
                            <td><?php echo $demand['demand']?></td>
                            <td><?php if($demand['gender'] == null) echo '---' . ' - '; else echo $demand['gender']  . ' - '; if($demand['demand'] == 'Ayakkabı Yardımı') echo $demand['shoes_size']; elseif($demand['demand'] == 'Elbise Yardımı' ) echo $demand['size']; else echo '---'; ?></td>
                            <td class="text-center"><?php if($demand['status'] == 0) echo '<span style="width:100px" class="text-center badge badge-fail badge-pill">Beklemede</span>'; elseif($demand['status'] == 1) echo '<span style="width:100px" class="text-center badge-current badge-pill">Sıraya Alındı</span>'; elseif($demand['status'] == 2) echo '<span style="width:100px" class="text-center badge-complete badge-pill">Tamamlandı</span>';?></td>
                        </tr>
                        <?php $counter_demand++; }?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</section>

<section class="mb-5">
    <div class="container">
        <h2 class="text-center color-text mb-5">Bağış Talep Eşleştirmesi</h2>
        <div class="row">
            <form action="" method="POST">
                <div class="form-row">
                    <div class="form-group col-md-6">
                        <label for="donation_id">Bağış Numarası</label>
                        <input type="text" class="form-control" name="donation_id" id="donation_id" placeholder="Bağış Numarası" required disabled>
                    </div>
                    <div class="form-group col-md-6">
                        <label for="demand_id">Talep Numarası</label>
                        <input type="text" class="form-control" name="demand_id" id="demand_id" placeholder="Talep Numarası" required disabled>
                    </div>
                </div>
                <div class="form-row">
                    <div class="form-group col-md-12">
                        <label for="img_src">Resim Linki</label>
                        <input type="text" class="form-control" name="img_src" id="img_src" placeholder="Resim Linki" required disabled>
                    </div>
                </div>
                <div class="form-row">
                    <button type="submit" class="btn btn-special col-md-12 mb-3" disabled>Gönder</button>
                </div>
                <div class="form-row">
                    <button type="button" onclick="window.location.href='last_donation.php'" class="btn btn-special col-12" >Geçmiş Bağışlar ve Talepler</button>
                    <button type="button" onclick="window.location.href='control.php'" class="btn btn-special col-12" >Kontrol Tablosu</button>
                </div>
            </form>
        </div>
    </div>
</section>



<?php 
require_once 'db.php';
if ($_SERVER["REQUEST_METHOD"] == "GET"){
    if(isset($_GET['close'])){
        session_destroy();
        header("Location: index.php");
    }
}

if ($_SERVER["REQUEST_METHOD"] == "POST"){
    $donation_id = $_POST['donation_id'];
    $demand_id = $_POST['demand_id'];
    $img_src = 'images/donations_img/' . $_POST['img_src'] . 'jpg';

    $query_donation = $db->prepare("SELECT * FROM `donations` WHERE donation_uniq_id = $donation_id");
    $query_donation->execute();
    $donation = $query_donation->fetch(PDO::FETCH_ASSOC);

    $donation_type = $donation['donation'];

    $query_donation = $db->prepare("SELECT * FROM `donations` WHERE donation_uniq_id = $donation_id");
    $query_donation->execute();
    $donation = $query_donation->fetch(PDO::FETCH_ASSOC);
    
    if($donation['qty_counter'] > 1) {
        $donation_qty_counter = $donation['qty_counter'] - 1;
        $set_donation_qty_counter = $db->prepare("UPDATE `donations` SET `qty_counter` = $donation_qty_counter WHERE donation_uniq_id = $donation_id");
        $set_exe_don = $set_donation_qty_counter->execute();

        $sql = $db->prepare("INSERT INTO `donation_and_demeand_match`(`donation_id`, `demand_id`, `donation_name`, `img_src`) VALUES ('$donation_id', '$demand_id', '$donation_type', '$img_src')");
        $ekle = $sql->execute();
    
        $sql_delete = $db->prepare("DELETE FROM `donation_and_demand_control` WHERE `donation_id` = $donation_id");
        $delete = $sql_delete->execute();

        $set_demand = $db->prepare("UPDATE `demands` SET `status` = 2 WHERE demand_uniq_id = $demand_id");
        $set_exe_dem = $set_demand->execute();
        echo '<div class="succes" ><span class="text-center badge badge-complete badge-pill">Bağış Gerçekleştirildi</span></div>';
    }
    elseif ($donation['qty_counter'] == 1) {
        $donation_qty_counter = $donation['qty_counter'] - 1;
        $set_donation_qty_counter = $db->prepare("UPDATE `donations` SET `qty_counter` = $donation_qty_counter WHERE donation_uniq_id = $donation_id");
        $set_exe_don = $set_donation_qty_counter->execute();

        $set_donation = $db->prepare("UPDATE `donations` SET `status` =  2 WHERE donation_uniq_id = $donation_id");
        $set_exe_don = $set_donation->execute();

        $sql = $db->prepare("INSERT INTO `donation_and_demeand_match`(`donation_id`, `demand_id`, `donation_name`, `img_src`) VALUES ('$donation_id', '$demand_id', '$donation_type', '$img_src')");
        $ekle = $sql->execute();
    
        $sql_delete = $db->prepare("DELETE FROM `donation_and_demand_control` WHERE `donation_id` = $donation_id");
        $delete = $sql_delete->execute();

        $set_demand = $db->prepare("UPDATE `demands` SET `status` = 2 WHERE demand_uniq_id = $demand_id");
        $set_exe_dem = $set_demand->execute();
        echo '<div class="succes" ><span class="text-center badge badge-complete badge-pill">Bağış Gerçekleştirildi</span></div>';
    }
    elseif($donation['qty'] <= 0) echo '<div class="warning"><span class="text-center badge badge-fail badge-pill">Bağış Hatası</span></div>';

    header("Location:admin.php");

}

?>


<?php include 'footer.html';?>

<script>
    if ( window.history.replaceState ) {
        window.history.replaceState( null, null, window.location.href );
    }//Tarayıcının input geçmişini siler.

    function filter_donation() {

        var input, filter, table, tr, td, i, txtValue;
        input = document.getElementById("donation_input");
        filter = input.value.toUpperCase();
        table = document.getElementById("donationTable");
        tr = table.getElementsByTagName("tr");

        for (i = 0; i < tr.length; i++) {
            td = tr[i].getElementsByTagName("td")[1];
            if (td) {
                txtValue = td.textContent || td.innerText;
                if (txtValue.toUpperCase().indexOf(filter) > -1) {
                    tr[i].style.display = "";
                } else {
                    tr[i].style.display = "none";
                }
            }
        }
    }

    function filter_demand() {

        var input, filter, table, tr, td, i, txtValue;
        input = document.getElementById("demand_input");
        filter = input.value.toUpperCase();
        table = document.getElementById("demandTable");
        tr = table.getElementsByTagName("tr");

        for (i = 0; i < tr.length; i++) {
            td = tr[i].getElementsByTagName("td")[1];
            if (td) {
                txtValue = td.textContent || td.innerText;
                if (txtValue.toUpperCase().indexOf(filter) > -1) {
                    tr[i].style.display = "";
                } else {
                    tr[i].style.display = "none";
                }
            }
        }
    }
</script>


