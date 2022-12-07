<?php 
    include 'header.php'; 
    include 'db.php';

    $query = $db->prepare("SELECT * FROM `donations` ORDER BY id DESC");
	$query->execute();
	$donations = $query->fetchAll(PDO::FETCH_ASSOC);
?>
<section class="rotate"></section>
<section class="rotate-reverse"></section>
<section class="mt-15 mb-5">
    <div class="container">
        <h2 class="text-center color-text mb-5">Bağışlar Tablosu</h2>
        <div class="row">
            <div class="col mb-4 donation-table shadow rounded-lg">
                <table id="myTable" class="display table table-striped">
                    <thead>
                        <tr> 
                            <label for="myInput"><b>Bağış Numarasına Göre Filtreleme</b></label>
                            <input type="text" class="form-control" id="myInput" onkeyup="filter()" placeholder="Bağış Numarası">
                        </tr>
                        <tr>
                            <th class="text-center" scope="col">#</th>
                            <th class="text-center" scope="col">Bağış Numarası</th>
                            <th class="text-center" scope="col">Bağış Türü</th>
                            <th class="text-center" scope="col">Bağış Adedi</th>
                            <th class="text-center" scope="col">Bağış Durumu</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php $counter_donation = 1; foreach($donations as $donation){?>
                        <tr id="myUL" class="table-tr">
                            <th class="text-center" scope="row"><?php echo $counter_donation.')';?></th>
                            <td name="li" class="text-center"><a href="<?php echo 'donation_details.php?donation_id=' . $donation['donation_uniq_id']?>" target="_Blank"><?php echo $donation['donation_uniq_id']?></a></td>
                            <td class="text-center"><?php echo $donation['donation']?></td>
                            <td class="text-center"><?php if($donation['status'] == 2) echo $donation['qty'] . ' Adet Yapıldı'; else echo $donation['qty_control'] . ' Adet Kaldı'?></td>
                            <td class="text-center"><?php if($donation['status'] == 0) echo '<span style="width:100px" class="text-center badge badge-fail badge-pill">Beklemede</span>'; elseif($donation['status'] == 1) echo '<span style="width:100px" class="text-center badge-current badge-pill">Sıraya Alındı</span>'; elseif($donation['status'] == 2) echo '<span style="width:100px" class="text-center badge-complete badge-pill">Tamamlandı</span>';?></td>
                        </tr>
                        <?php $counter_donation++; }?>
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