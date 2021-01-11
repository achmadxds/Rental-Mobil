<?php
include 'include.php';
$status = 'Tersedia';
$sql = query('SELECT `id_mobil`, 
                     `car_name`, 
                     `license_number`, 
                     `rental_price`, 
                     `type_car`, 
                     `status` 
              FROM `mobil_data` ');


if (isset($_POST['add_data'])) {
  AddDataCar();
  header('LOCATION:list_mobil.php');
  exit;
}

if (isset($_POST['save'])) {
  UpdateDataCar();
  header('Refresh:0');
}

if (isset($_POST['delete'])) {
  DeleteDataCar($_POST['id_mobil']);
  header('Refresh:0');
}
?>

<?php include 'template/header.php'; ?>

<body id="page-top">
  <div id="wrapper">
    <?php include 'template/sidebar.php'; ?>
    <div id="content-wrapper" class="d-flex flex-column">
      <div id="content">
        <?php include 'template/navbar.php'; ?>
        <div class="container">
          <div class="float-left">
            <h3 class="text-primary"><b>LIST MOBIL</b></h3>
          </div>
          <div class="float-right pr-3">
            <form method="POST">
              <a href="" class="btn btn-success" data-toggle="modal" data-target="#modal1">Add Data</a>
            </form>
          </div>
        </div>
        <!-- Table Data -->
        <div class="container pt-5 mt-3">
          <div class="card">
            <div class="card-body">
              <div class="form-inline d-flex float-left md-form form-sm pt-2 pb-3">
                <a class="btn btn-info">Date : <?php echo date("F j, Y"); ?></a>
              </div>
              <form class="form-inline d-flex float-right md-form form-sm pt-1" method="post">
                <div class="form-group">
                  <input class="form-control mb-4" id="tableSearch" type="text" placeholder="search...">
                </div>
              </form>

              <table class="table mt-5 text-center">
                <thead>
                  <tr>
                    <th scope="col">#</th>
                    <th scope="col">Nama Mobil</th>
                    <th scope="col">Plat Nomor</th>
                    <th scope="col">Harga Rental / Hari</th>
                    <th scope="col">Tipe Mobil</th>
                    <th scope="col">Status</th>
                    <th scope="col">Option</th>
                  </tr>
                </thead>

                <tbody id="myTable">
                  <?php
                    $i = 1;
                    foreach ($sql as $data) {
                      $debug = implode(",", $data);
                      ?>
                        <tr>
                          <th><?php echo $i; ?></th>
                          <th><?php echo $data['car_name']; ?></th>
                          <th><?php echo $data['license_number']; ?></th>
                          <th><?php echo $data['rental_price']; ?></th>
                          <th><?php echo $data['type_car']; ?></th>
                          <?php
                          if ($data['status'] == "Tersedia")
                            $color = 'success';
                          else
                            $color = 'danger'; ?>
                          <th class="badge badge-<?= $color ?> mt-1"><?php echo $data['status']; ?></th>
                          <th>
                            <a href="" class="openEditDialog" data-toggle="modal" data-target="#modal2" data-id="<?php echo $debug ?>"><i class="far fa-edit fa-lg"></i></a>
                          </th>
                        </tr>
                      <?php
                      $i++;
                    }
                  ?>
                </tbody>
              </table>

            </div>
          </div>
        </div>
      </div>
      <?php include 'template/footer.php'; ?>
    </div>
  </div>

  <!-- Modal Add Data -->
  <div class="modal fade" id="modal1" tabindex="-1" role="dialog" aria-labelledby="basicModal" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title">Tambah Data Mobil</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <form method="POST" action="">
          <div class="modal-body">
            <div class="form-group">
              <label for="car_name" class="text-primary">Nama Mobil:</label><br>
              <input type="text" name="car_name" id="car_name" class="form-control" required>
            </div>
            <div class="form-group">
              <label for="license_number" class="text-primary">Plat Nomor:</label><br>
              <input type="text" name="license_number" id="license_number" class="form-control" required>
            </div>
            <div class="form-group">
              <label for="rental_price" class="text-primary">Harga Rental:</label><br>
              <input type="number" name="rental_price" id="rental_price" class="form-control" required>
            </div>
            <div class="form-group">
              <label for="car_type" class="text-primary">Tipe Mobil:</label><br>
              <input type="text" name="car_type" id="car_type" class="form-control" required>
            </div>
          </div>
          <div class="modal-footer">
            <button type="submit" name="add_data" class="btn btn-primary">Tambah Data</button>
          </div>
        </form>
      </div>
    </div>
    </form>
  </div>

  <!-- Modal Edit Data -->
  <div class="modal fade" id="modal2" tabindex="-1" role="dialog" aria-labelledby="basicModal" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title">Edit Data Mobil</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <form method="POST" action="">
          <div class="modal-body">
            <div class="form-group">
              <input type="hidden" name="id_mobil" id="id_mobil">
              <label for="edit_name" class="text-primary">Nama Mobil:</label><br>
              <input type="text" name="edit_name" id="edit_name" class="form-control" required>
            </div>
            <div class="form-group">
              <label for="edit_plate" class="text-primary">Plat Nomor:</label><br>
              <input type="text" name="edit_plate" id="edit_plate" class="form-control" required>
            </div>
            <div class="form-group">
              <label for="edit_price" class="text-primary">Harga Rental:</label><br>
              <input type="number" name="edit_price" id="edit_price" class="form-control" required>
            </div>
            <div class="form-group">
              <label for="edit_type" class="text-primary">Tipe Mobil:</label><br>
              <input type="text" name="edit_type" id="edit_type" class="form-control" required>
              <input type="hidden" name="statusCar" id="statusCar">
            </div>
          </div>
          <div class="modal-footer">
            <button type="submit" name="save" class="btn btn-primary" onclick="return confirm('Mau simpan data?')">Edit Data</button>
            <button type="submit" name="delete" class="btn btn-danger" onclick="return confirm('Beneran nih?')">Hapus Data</button>
          </div>
        </form>
      </div>
    </div>
    </form>
  </div>
</body>

<script>
  $(document).ready(function() {
    var values;
    $(".openEditDialog").click(function() {
      values = $(this).data("id");
      values = values.split(",");
      console.log(values);
      $("#id_mobil").val(values[0]);
      $("#edit_name").val(values[1]);
      $("#edit_plate").val(values[2]);
      $("#edit_price").val(values[3]);
      $("#statusCar").val(values[5]);
      $("#edit_type").val(values[4]);
    });
  });

  $(document).ready(function() {
    $("#tableSearch").on("keyup", function() {
      var value = $(this).val().toLowerCase();
      $("#myTable tr").filter(function() {
        $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1)
      });
    });
  });
</script>