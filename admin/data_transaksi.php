<?php
  include 'include.php';
  $status = 'Berjalan';
  $statusCar = 'Tersedia';

  $sql = query('SELECT `dc`.`id_cs`, 
                       `dc`.`id_car`, 
                       `dc`.`name`, 
                       `dc`.`identity`, 
                       `dc`.`address`, 
                       `dc`.`phone`, 
                       `dc`.`checkin`, 
                       `dc`.`status_cs`, 
                       `md`.`car_name`, 
                       `md`.`car_name`, 
                       `md`.`rental_price`, 
                       `md`.`id_mobil`
                FROM `data_customer` AS `dc` LEFT JOIN `mobil_data` AS `md` 
                ON `dc`.`id_car` = `md`.`id_mobil` where `dc`.`status_cs`="' . $status . '" ');

  $selectCar = query('SELECT `id_mobil`, `car_name` FROM `mobil_data` where `status`="' . $statusCar . '" ');

  if (isset($_POST['add_customer'])) {
    AddCustomer();
    header('LOCATION:data_transaksi.php');
    exit;
  }

  if (isset($_POST['delete'])) {
    DeleteDataCustomer($_POST['csID']);
    header('Refresh:0');
  }

  if (isset($_POST['update'])) {
    UpdateDataCustomer();
    header('Refresh:0');
  }

  if (isset($_POST['done'])) {
    DoneTransaction($_POST['idE']);
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
            <h3 class="text-primary"><b>LIST CUSTOMER</b></h3>
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
                    <th scope="col">Nama Pelanggan</th>
                    <th scope="col">Alamat</th>
                    <th scope="col">Mobil Yang Dipinjam</th>
                    <th scope="col">Tanggal Pinjam</th>
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
                          <th><?php echo $data['name']; ?></th>
                          <th><?php echo $data['address']; ?></th>
                          <th><?php echo $data['car_name']; ?></th>
                          <th><?php echo $data['checkin']; ?></th>
                          <th class="badge badge-danger mt-1"><?php echo $data['status_cs']; ?></th>
                          <th>
                            <a href="" class="openEditDialog" data-toggle="modal" data-target="#modal2" data-id="<?php echo $debug; ?>"><i class="far fa-edit fa-lg"></i></a>
                            |
                            <a href="" class="DeleteModal" data-toggle="modal" data-target="#DeleteModal" data-id="<?php echo $debug; ?>"><i class="fas fa-check-circle fa-lg"></i></a>
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
  <div class="modal fade" id="modal1" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel"><b>Tambah Data</b></h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
          <form action="" method="POST" enctype="multipart/form-data">

            <div class="row p-2">
              <div class="col-md-6">
                <div class="form-group">
                  <label for="nameCS" class="text-primary">Nama :</label><br>
                  <input type="text" name="nameCS" id="nameCS" class="form-control">
                </div>
              </div>

              <div class="col-md-6">
                <div class="form-group">
                  <label for="identity" class="text-primary">Identitas :</label><br>
                  <input type="file" name="identity" id="identity" class="form-control">
                </div>
              </div>
            </div>

            <div class="row p-2">
              <div class="col-md-6">
                <div class="form-group">
                  <label for="address" class="text-primary">Alamat :</label><br>
                  <input type="text" name="address" id="address" class="form-control">
                </div>
              </div>

              <div class="col-md-6">
                <div class="form-group">
                  <label for="phone" class="text-primary">No Telp :</label><br>
                  <input type="number" name="phone" id="phone" class="form-control">
                </div>
              </div>
            </div>

            <div class="row p-2">
              <div class="col-md-6">
                <div class="form-group">
                  <label for="car_cs" class="text-primary">Mobil Yang Dipinjam :</label><br>
                  <select name="car_cs" class="form-control">
                    <option disabled selected> Pilih </option>
                    <?php
                    foreach ($selectCar as $data) {
                    ?>
                      <option value="<?php echo $data['id_mobil']; ?>" class="form-control"> <?php echo $data['car_name']; ?> </option>
                    <?php
                    }
                    ?>
                  </select>
                </div>
              </div>

              <div class="col-md-6">
                <div class="form-group">
                  <label for="checkin" class="text-primary">Tanggal Diambil :</label><br>
                  <input type="date" name="checkin" id="checkin" class="form-control">
                </div>
              </div>
            </div>
            <div class="modal-footer">
              <button type="submit" name="add_customer" class="btn btn-primary">Tambah Data</button>
            </div>
          </form>
        </div>
      </div>
    </div>
  </div>
  <!-- Edit data -->
  <div class="modal fade" id="modal2" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel"><b>Edit Data</b></h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
          <form action="" method="POST" enctype="multipart/form-data">

            <div class="row p-2">
              <div class="col-md-6">
                <div class="form-group">
                  <input type="hidden" id="csID" name="csID">
                  <input type="hidden" id="car_id" name="car_id">
                  <label for="csEdit" class="text-primary">Nama :</label><br>
                  <input type="text" name="csEdit" id="csEdit" class="form-control" required>
                </div>
              </div>

              <div class="col-md-6">
                <div class="form-group">
                  <label for="identityEdit1" class="text-primary">Identitas :</label><br>
                  <input type="hidden" name="identityEdit1" id="identityEdit1">
                  <div class="input-group mb-3">
                    <input type="text" class="form-control filename" id="identityEdit" placeholder="isi foto..." readonly>
                    <div class="input-group-append">
                      <label class="btn btn-secondary">
                        browse <input type="file" name="identityEdit" class="form-control costumfile" hidden>
                      </label>
                    </div>
                  </div>
                </div>
              </div>
            </div>


            <div class="row p-2">
              <div class="col-md-6">
                <div class="form-group">
                  <label for="addressEdit" class="text-primary">Alamat :</label><br>
                  <input type="text" name="addressEdit" id="addressEdit" class="form-control" required>
                </div>
              </div>

              <div class="col-md-6">
                <div class="form-group">
                  <label for="phoneEdit" class="text-primary">No Telp :</label><br>
                  <input type="number" name="phoneEdit" id="phoneEdit" class="form-control" required>
                </div>
              </div>
            </div>

            <div class="row p-2">
              <div class="col-md-6">
                <div class="form-group">
                  <label for="carEdit" class="text-primary">Mobil Yang Dipinjam :</label><br>
                  <input type="text" class="form-control" name="carEdit" id="carEdit" readonly>
                </div>
              </div>

              <div class="col-md-6">
                <div class="form-group">
                  <label for="checkinEdit" class="text-primary">Tanggal Diambil :</label><br>
                  <input type="date" name="checkinEdit" id="checkinEdit" class="form-control" required>
                </div>
              </div>
            </div>
            <div class="modal-footer">
              <button type="submit" name="update" id="update" class="btn btn-primary" onclick="return confirm('Update Data nya nih?')">Edit Data</button>
              <button type="submit" name="delete" id="delete" class="btn btn-danger" onclick="return confirm('Beneran nih?')">Hapus Data</button>
            </div>
          </form>
        </div>
      </div>
    </div>
  </div>
  <!-- Modal -->
  <div class="modal fade" id="DeleteModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">ALERT</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
          <form method="post">
            <h4>Beneran Mau Selesaikan Task ini??</h4>
            <input type="hidden" id="car_idSubmit" name="car_idSubmit">
            <input type="hidden" id="idE" name="idE">
            <input type="hidden" name="checkEn" id="checkEn">
            <input type="hidden" name="price" id="price">
        </div>
        <div class="modal-footer">
          <button type="submit" class="btn btn-primary" name="done">Yes</button>
        </div>
        </form>
      </div>
    </div>
  </div>

</body>

<script>
  $(document).ready(function() {
    $("#tableSearch").on("keyup", function() {
      var value = $(this).val().toLowerCase();
      $("#myTable tr").filter(function() {
        $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1)
      });
    });

    var values, test;
    $(".openEditDialog").click(function() {
      values = $(this).data("id");
      values = values.split(",");
      test = values[3];
      console.log(values);
      $("#csID").val(values[0]);
      $("#car_id").val(values[1]);
      $("#csEdit").val(values[2]);
      $("#identityEdit").val(values[3]);
      $("#identityEdit1").val(values[3]);
      $("#addressEdit").val(values[4]);
      $("#phoneEdit").val(values[5]);
      $("#checkinEdit").val(values[6]);
      $("#carEdit").val(values[8]);

      $('.costumfile').on('change', function(event) {
        test = event.target.files[0].name;
        $('.filename').val(test);
      });

      $(".filename").click(function() {
        window.open("<?php $_SERVER['HTTP_HOST']; ?>/PKL/Rental-Mobil/admin/images/" + values[3]);
        
      });
    });

    $(".DeleteModal").click(function() {
      values = $(this).data("id");
      values = values.split(",");
      console.log(values);
      $("#idE").val(values[0]);
      $("#checkEn").val(values[6]);
      $("#car_idSubmit").val(values[1]);
      $("#price").val(values[9]);
    });
  });
</script>