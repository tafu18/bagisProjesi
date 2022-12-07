<?php
    ob_start();
    session_start();
    if($_SESSION['name'] == null) header("Location:login.php");
    include 'header.php'; 
    include 'db.php';

    $query = $db->prepare("SELECT COUNT(*) as count FROM `donation_and_demand_control`");
	$query->execute();
	$control_counter = $query->fetch(PDO::FETCH_ASSOC);

    $query = $db->prepare("SELECT * FROM `donation_and_demand_control`");
	$query->execute();
	$controls = $query->fetchAll(PDO::FETCH_ASSOC);

    $counter = $control_counter['count'];
?>
<html ng-app="donationApp" ng-controller="deneme">
<section class="rotate"></section>
<section class="rotate-reverse"></section>
<section class="mt-15 mb-5">
    <div class="container">
        <h2 class="text-center color-text mb-5">Kontrol Tablosu</h2>
        <div class="row">
            <div class="col control-table shadow rounded-lg">
            
                <table id="myTable" class="display table table-striped">
                    <thead>
                        <tr> 
                            <label for="myInput">Bağış Numarasına Göre Filtreleme</label>
                            <input type="text" class="form-control" id="myInput" onkeyup="filter()" placeholder="Bağış Numarası">
                        </tr>
                        <tr>
                            <th style="color: black;" class="text-left" scope="col">#</th>
                            <th style="color: black;" class="text-left" scope="col">Bağış Numarası</th>
                            <th style="color: black;" class="text-left" scope="col">Talep Numarası</th>
                            <th style="color: black;" class="text-left" scope="col">Kontrol</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php $counterControl = 1; foreach($controls as $control){?>
                            
                        <tr id="myUL" class="table-tr">
                        <form action="" method="POST">
                                <th style="color: black;" class="text-left" scope="row"><?php echo $counterControl; ?> </th>
                                <td style="color: black;" class="text-left"><input style="background-color: transparent; width: 80px;" type="text" name="<?php echo 'donationid'. $counterControl ?>" value="<?php echo $control['donation_id']?>" readonly></td>
                                <td style="color: black;" class="text-left"><input style="background-color: transparent; width: 80px;" type="text" value="<?php echo $control['demand_id']?>" name="<?php echo 'demandid'. $counterControl ?>" readonly></td>
                                <td class="text-left"><button type="submit" name="<?php echo 'button'. $counterControl ?>" class="btn btn-special" style="margin-bottom: 0px!important;">Onayla</button></td>
                                </form>
                        </tr>
                        
                        <?php $counterControl++; } ?>
                    </tbody>
                </table>
                
            </div>
        </div>
        <div class="mt-5 form-row">
            <button type="button" onclick="window.location.href='admin.php'" class="btn btn-special col-12" >Admin Panel</button>
            <button type="button" onclick="window.location.href='last_donation.php'" class="btn btn-special col-12" >Geçmiş Bağışlar ve Talepler</button>
        </div>
    </div>
</section>







<?php

if ($_SERVER["REQUEST_METHOD"] == "POST"){

    
    for ($i=1; $i <= $counter ; $i++) { 
        if(isset($_POST['button'.$i])){
            $donation_id = $_POST['donationid'.$i];
            $demand_id = $_POST['demandid'.$i];


            $donation_query = $db->prepare("SELECT * FROM `donations` WHERE `donation_uniq_id` = $donation_id");
            $donation_query->execute();
            $donation = $donation_query->fetch(PDO::FETCH_ASSOC);
            $donation_type = $donation['donation'];


            $img_src = 'images/donations_img/' . $donation_id . '_' . $demand_id . '.jpg';
            $sql = $db->prepare("INSERT INTO `donation_and_demeand_match`(`donation_id`, `demand_id`, `donation_name`, `img_src`) VALUES ('$donation_id', '$demand_id', '$donation_type', '$img_src')");
            $ekle = $sql->execute();
            if($ekle) {

                $sql_delete = $db->prepare("DELETE FROM `donation_and_demand_control` WHERE `demand_id` = $demand_id");
                $delete = $sql_delete->execute();

                $set_demand = $db->prepare("UPDATE `demands` SET `status` = 2 WHERE demand_uniq_id = $demand_id");
                $set_exe_dem = $set_demand->execute();

                if($donation['qty_counter'] == 1){
                    $set_donation = $db->prepare("UPDATE `donations` SET `status` =  2 WHERE donation_uniq_id = $donation_id");
                    $set_exe_don = $set_donation->execute();
                }
                header("Location:control.php");
            }
        }

    }
}

?>
<script>
    
    if ( window.history.replaceState ) {
        window.history.replaceState( null, null, window.location.href );
    }//Tarayıcının input geçmişini siler.

function filter() {

  var input, filter, table, tr, td, i, txtValue;
  input = document.getElementById("myInput");
  filter = input.value.toUpperCase();
  table = document.getElementById("myTable");
  tr = table.getElementsByTagName("tr");

  for (i = 0; i < tr.length; i++) {
    td = tr[i].getElementsByTagName("td")[0];
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
<?php include 'footer.html';?>