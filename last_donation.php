<?php 
ob_start();
session_start();
if($_SESSION['name'] == null) header("Location:login.php");
require_once 'header.php';  require_once 'db.php';

$query_donations = $db->prepare("SELECT * FROM `donations` WHERE `status` = 2 ORDER BY id DESC");
$query_donations->execute();
$donations = $query_donations->fetchAll(PDO::FETCH_ASSOC);

$query_demands = $db->prepare("SELECT * FROM `demands` WHERE `status` = 2 ORDER BY id DESC");
$query_demands->execute();
$demands = $query_demands->fetchAll(PDO::FETCH_ASSOC);




?>
<section class="rotate"></section>
<section class="rotate-reverse  "></section>
<section class="mt-15 mb-5">
    <div class="container">
        <div class="justify-content-right form-row">
            <form method="get">
                <button type="submit" name="close" class="btn btn-special col-12" >Çıkış Yap</button>
            </form>
        </div>
        <h2 class="text-center color-text mb-5">Tamamlanmış Talepler Ve Bağışlar</h2>
        <div class="row">
            <div style="background-color: #253949; color: white!important; height:auto; flex-wrap: wrap;" class="col shadow rounded-lg">
                <table class="table table-striped">
                    <thead>
                        <tr>
                            <th class="text-center" colspan="5" scope="col">Bağışlar Tablosu</th>
                        </tr>
                        <tr>
                            <th scope="col">#</th>
                            <th scope="col">Bağış Numarası</th>
                            <th scope="col">Bağış Adedi</th>
                            <th scope="col">Bağış Türü</th>
                            <th scope="col">Bağış Durumu</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php $counter_donation = 1; foreach($donations as $donation){?>
                        <tr>
                            <th scope="row"><?php echo $counter_donation?></th>
                            <td><?php echo $donation['donation_uniq_id']?></td>
                            <td><?php if($donation['qty'] == 0) echo '---'; else echo $donation['qty']?></td>
                            <td><?php echo $donation['donation']?></td>
                            <td><span style="width:100px" class="text-center badge-complete badge-pill">Tamamlandı</span></td>
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
        <div class="row">
            <div style="background-color: #EFF2B7; color: black!important; height:auto; flex-wrap: wrap;" class="col shadow rounded-lg">
                <table class="table table-striped">
                    <thead>
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
                            <td><span style="width:100px" class="text-center badge-complete badge-pill">Tamamlandı</span></td>
                        </tr>
                        <?php $counter_demand++; }?>
                    </tbody>
                </table>
            </div>
        </div>
        <div class="mt-5 form-row">
            <button type="button" onclick="window.location.href='admin.php'" class="btn btn-special col-12" >Admin Panel</button>
            <button type="button" onclick="window.location.href='control.php'" class="btn btn-special col-12" >Kontrol Tablosu</button>
        </div>
    </div>
</section>

<?php 
if ($_SERVER["REQUEST_METHOD"] == "GET"){
    if(isset($_GET['close'])){
        session_destroy();
        header("Location: index.php");
    }
}

include 'footer.html';?>