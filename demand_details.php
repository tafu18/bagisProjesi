<?php 
include 'header.php';
include 'db.php';

$demand_id = $_GET['demand_id'];

$query_demand = $db->prepare("SELECT * FROM `demands` WHERE `demand_uniq_id` = $demand_id");
$query_demand->execute();
$demand = $query_demand->fetch(PDO::FETCH_ASSOC);


$name = $demand['name'];
$explode_name = explode(" ", $name);
/* 
foreach($explode_name as $e){
	$lenght = strlen($e);
	$replace = substr_replace($e, '*****' , 1, $lenght);
	echo $replace . ' ';
} */


$query_control = $db->prepare("SELECT * FROM `donation_and_demand_control` WHERE `demand_id` = $demand_id");
$query_control->execute();
$demand_control = $query_control->fetchAll(PDO::FETCH_ASSOC);

$query_match = $db->prepare("SELECT * FROM `donation_and_demeand_match` WHERE `demand_id` = $demand_id");
$query_match->execute();
$demand_match = $query_match->fetchAll(PDO::FETCH_ASSOC);


?>
<section class="mt-10">
    <div class="container">
        <div class="row">
            
            <div class="container" style="margin-top: 2rem; margin-bottom: 3rem;">
                <h1 class="display-4"><?php echo $demand_id?></h1>
                <p class="lead">Numaralı Talebin Detayları</p>
            </div>
        </div>
        <div class="justify-content-center-2 row">
            <ul style="width: 75%; margin-bottom: 4rem;" class="list-group">

                <li class="list-group-item d-flex justify-content-between align-items-center">
                    Talep Edenin Adı Soyadı:
                    <span class="badge badge-primary badge-detail">
                        
                        <?php 
                            foreach($explode_name as $e){
                                $lenght = strlen($e);
                                $replace = substr_replace($e, '*****' , 1, $lenght);
                                echo $replace . ' ';
                            }
                        ?>
                    
                    </span>
                </li>
                <?php
                    $counter = 0;
                    foreach($demand_control as $d_c){
                        $count_d_c = count($d_c);
                ?>
                <li class="list-group-item d-flex justify-content-between align-items-center">
                    Eşleşen Bağış Numarası
                    <span class="badge badge-primary badge-detail">
                        <?php 
                            echo $d_c['donation_id'];
                            $counter++;
                        ?>
                    </span>
                </li>
                <?php }?>
                <?php
                    $counter = 0;
                    foreach($demand_control as $d_c){
                        $count_d_c = count($d_c);
                ?>
                <li class="list-group-item d-flex justify-content-between align-items-center">
                    Talebin Eşleşme Tarihi
                    <span class="badge badge-primary badge-detail">
                        <?php 
                            echo $d_c['date_control'];
                            $counter++;
                        ?>
                    </span>
                </li>
                <?php }?>     

                <?php
                    $counter = 0;
                    foreach($demand_match  as $d_m){
                        $count_d_m = count($d_m);
                ?>
                <li class="list-group-item d-flex justify-content-between align-items-center">
                    Talebin Gerçekleştirilme Tarihi
                    <span class="badge badge-primary badge-detail">
                        <?php 
                            echo $d_m['date_matching'];
                            $counter++;
                        ?>
                    </span>
                </li>
                <?php }?> 

                <li class="list-group-item d-flex justify-content-between align-items-center">
                    Talebin Durumu:
                    <?php   if($demand['status'] == 0) echo '<span style="width:100px" class="text-center badge badge-fail badge-pill">Beklemede</span>'; 
                            elseif($demand['status'] == 1) echo '<span style="width:100px" class="text-center badge-current badge-pill">Sıraya Alındı</span>'; 
                            elseif($demand['status'] == 2) echo '<span style="width:100px" class="text-center badge-complete badge-pill">Tamamlandı</span>';?>
                </li>

                <li class="list-group-item d-flex justify-content-between align-items-center">
                    Talebin Verildiği Tarih:
                    <span class="badge badge-primary badge-detail"><?php echo $demand['date_added']?></span>
                </li>
            </ul>
        </div>

        
    </div>
</section>

<?php 
include 'footer.html';
?>