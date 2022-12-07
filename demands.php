<?php 
    include 'header.php'; 
    include 'db.php';

    $query = $db->prepare("SELECT * FROM `demands` ORDER BY id DESC");
	$query->execute();
	$demands = $query->fetchAll(PDO::FETCH_ASSOC);
?>

<section class="rotate"></section>
<section class="rotate-reverse  "></section>

<section class="mt-15 mb-5">
    <div class="container">
        <h2 class="text-center color-text mb-5">Talepler Tablosu</h2>
        <div class="row">
            <div class="col mb-4 demand-table shadow rounded-lg">
                <table id="myTable" class="table table-striped">
                    <thead>
                        <tr> 
                            <label for="myInput"><b>Talep Numarasına Göre Filtreleme</b></label>
                            <input type="text" class="form-control" id="myInput" onkeyup="filter()" placeholder="Talep Numarası">
                        </tr>
                        <tr>
                            <th class="text-center" scope="col">#</th>
                            <th class="text-center" scope="col">Talep Numarası</th>
                            <th class="text-center" scope="col">Talep Türü</th>
                            <th class="text-center" scope="col">Cinsiyet Ve Beden</th>
                            <th class="text-center" scope="col">Talep Durumu</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php $counter_demand = 1; foreach($demands as $demand){?>
                        <tr>
                            <th class="text-center" scope="row"><?php echo $counter_demand.') ';?></th>
                            <td class="text-center"><a class="demand_a" href="<?php echo 'demand_details.php?demand_id=' . $demand['demand_uniq_id']?>" target="_Blank"><b><?php echo $demand['demand_uniq_id']?></b></a></td>
                            <td class="text-center"><?php echo $demand['demand']?></td>
                            <td class="text-center"><?php if($demand['gender'] == null) echo '---' . ' - '; else echo $demand['gender']  . ' - '; if($demand['demand'] == 'Ayakkabı Yardımı') echo $demand['shoes_size']; elseif($demand['demand'] == 'Elbise Yardımı' ) echo $demand['size']; else echo '---'; ?></td>
                            <td class="text-center"><?php if($demand['status'] == 0) echo '<span style="width:100px" class="text-center badge badge-fail badge-pill">Beklemede</span>'; elseif($demand['status'] == 1) echo '<span style="width:100px" class="text-center badge-current badge-pill">Sıraya Alındı</span>'; elseif($demand['status'] == 2) echo '<span style="width:100px" class="text-center badge-complete badge-pill">Tamamlandı</span>';?></td>
                        </tr>
                        <?php $counter_demand++; }?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</section>
<script>
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