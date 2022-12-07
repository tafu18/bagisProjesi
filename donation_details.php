<?php 
include 'header.php';
include 'db.php';

$donation_id = $_GET['donation_id'];

$query_donation = $db->prepare("SELECT * FROM `donations` WHERE `donation_uniq_id` = $donation_id");
$query_donation->execute();
$donation = $query_donation->fetch(PDO::FETCH_ASSOC);


$name = $donation['name'];
$explode_name = explode(" ", $name);

$query_control = $db->prepare("SELECT * FROM `donation_and_demand_control` WHERE `donation_id` = $donation_id");
$query_control->execute();
$donation_control = $query_control->fetchAll(PDO::FETCH_ASSOC);

$query_match = $db->prepare("SELECT * FROM `donation_and_demeand_match` WHERE `donation_id` = $donation_id");
$query_match->execute();
$donation_match = $query_match->fetchAll(PDO::FETCH_ASSOC);


?>
<section class="mt-10">
    <div class="container">
        <div class="row">
            
            <div class="container" style="margin-top: 2rem; margin-bottom: 2rem;">
                <h1 class="display-4"><?php echo $donation_id?></h1>
                <p class="lead">Numaralı Bağışın Detayları</p>
            </div>
        </div>
        <div class="justify-content-center-2 row">
            <ul style="width: 75%; margin-bottom: 4rem;" class="list-group">

                <li class="list-group-item d-flex justify-content-between align-items-center">
                    Bağışçının Adı Soyadı:
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

                <li class="list-group-item d-flex justify-content-between align-items-center">
                    Bağış Miktarı:
                    <span class="badge badge-primary badge-detail"><?php echo $donation['qty'] . ' Adet' ?></span>
                </li>
                <?php
                    $counter = 0;
                    foreach($donation_control as $d_c){
                        $count_d_c = count($d_c);
                ?>
                <li class="list-group-item d-flex justify-content-between align-items-center">
                    <?php echo $counter+1 . '. '?>Eşleşen Talep Numarası
                    <span class="badge badge-primary badge-detail">
                        <?php 
                            echo $d_c['demand_id'];
                            $counter++;
                        ?>
                    </span>
                </li>
                <?php }?>
                <?php
                    $counter = 0;
                    foreach($donation_control as $d_c){
                        $count_d_c = count($d_c);
                ?>
                <li class="list-group-item d-flex justify-content-between align-items-center">
                    <?php echo $counter+1 . '. '?>Eşleşme Tarihi
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
                    foreach($donation_match  as $d_m){
                        $count_d_m = count($d_m);
                ?>
                <li class="list-group-item d-flex justify-content-between align-items-center">
                    <?php echo $counter+1 . '. '?>Gerçekleştrilen Bağış Tarihi
                    <span class="badge badge-primary badge-detail">
                        <?php 
                            echo $d_m['date_matching'];
                            $counter++;
                        ?>
                    </span>
                </li>
                <?php }?> 

                <li class="list-group-item d-flex justify-content-between align-items-center">
                    Bağışın Durumu:
                    <?php   if($donation['status'] == 0) echo '<span style="width:100px" class="text-center badge badge-fail badge-pill">Beklemede</span>'; 
                            elseif($donation['status'] == 1) echo '<span style="width:100px" class="text-center badge-current badge-pill">Sıraya Alındı</span>'; 
                            elseif($donation['status'] == 2) echo '<span style="width:100px" class="text-center badge-complete badge-pill">Tamamlandı</span>';?>
                </li>

                <li class="list-group-item d-flex justify-content-between align-items-center">
                    Bağışın Verildiği Tarih:
                    <span class="badge badge-primary badge-detail"><?php echo $donation['date_added']?></span>
                </li>
            </ul>
        </div>

        
    </div>
</section>
        



<?php 
include 'footer.html';
?>