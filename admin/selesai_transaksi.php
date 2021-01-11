<?php
  include 'include.php';

  $status = 'Selesai';
  $statusCar = 'Tersedia';

  $sql = query('SELECT `dc`.`name`, `dc`.`identity`, `dc`.`address`, `dc`.`phone`, `dc`.`checkin`, `dc`.`checkout`, `dc`.`totalPrice`, `dc`.`status_cs`, `md`.`car_name`, `md`.`license_number`, `md`.`rental_price`
              FROM `data_customer` AS `dc` LEFT JOIN `mobil_data` AS `md` 
              ON `dc`.`id_car` = `md`.`id_mobil` where `dc`.`status_cs`="' . $status . '" ');
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
                    <th scope="col">Mobil Yang Dipinjam</th>
                    <th scope="col">Status</th>
                    <th scope="col">Option</th>
                  </tr>
                </thead>

                <?php
                  $i = 1;
                  foreach ($sql as $data) {
                    $debug = implode(",", $data);
                  ?>
                    <tbody id="myTable">
                      <tr>
                        <th><?php echo $i; ?></th>
                        <td>
                          <a href="" class="openEditDialog" data-toggle="modal" data-target="#modal2" data-id="<?php echo $debug; ?>"><?php echo $data['name']; ?></a>
                        </td>
                        <td>
                          <a href="" class="getID" data-toggle="modal" data-target="#modal1" data-id="<?php echo $debug; ?>"><?php echo $data['car_name']; ?></a>
                        </td>
                        <th class="badge badge-success mt-1"><?php echo $data['status_cs']; ?></th>
                        <th>
                          <form method="post">
                            <button type="submit" class="badge badge-success"><i class="fas fa-print fa-lg"></i></button>
                          </form>
                        </th>
                      </tr>

                    </tbody>
                  <?php
                    $i++;
                  }
                ?>
              </table>

            </div>
          </div>
        </div>

      </div>

      <?php include 'template/footer.php'; ?>

    </div>
  </div>

  <!-- Data Mobil -->
  <div class="modal fade" id="modal1" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel"><b>Data Peminjam</b></h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
          <div class="row p-2">
            <div class="col-md-6">
              <div class="form-group">
                <label for="namecar" class="text-primary">Nama Mobil :</label><br>
                <input type="text" id="namecar" class="form-control" readonly>
              </div>
            </div>

            <div class="col-md-6">
              <div class="form-group">
                <label for="platnomor" class="text-primary">Plat Nomor :</label><br>
                <input type="text" id="platnomor" class="form-control" readonly>
              </div>
            </div>
          </div>

          <div class="row p-2">
            <div class="col-md-6">
              <div class="form-group">
                <label for="harga" class="text-primary">Harga /Hari :</label><br>
                <input type="text" id="harga" class="form-control" readonly>
              </div>
            </div>

            <div class="col-md-6">
              <div class="form-group">
                <label for="total" class="text-primary">Total Harga :</label><br>
                <input type="text" name="total" id="total" class="form-control" readonly>
              </div>
            </div>
          </div>

          <div class="row p-2">
            <div class="col-md-6">
              <div class="form-group">
                <label for="checkin" class="text-primary">Tanggal Pengambilan :</label><br>
                <input type="text" id="checkin" class="form-control" readonly>
              </div>
            </div>

            <div class="col-md-6">
              <div class="form-group">
                <label for="checkout" class="text-primary">Tanggal Pengembalian :</label><br>
                <input type="text" id="checkout" class="form-control" readonly>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>

  <!-- Lihat Data -->
  <div class="modal fade" id="modal2" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel"><b>Lihat Data</b></h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
          <div class="row p-2">
            <div class="col-md-6">
              <input type="hidden" id="car_id" name="car_id">
              <div class="form-group">
                <input type="hidden" id="id" name="id">
                <label for="csEdit" class="text-primary">Nama :</label><br>
                <input type="text" name="csEdit" id="csEdit" class="form-control" readonly>
              </div>
            </div>

            <div class="col-md-6">
              <div class="form-group">
                <label for="identityEdit" class="text-primary">Identitas :</label><br>
                <input type="hidden" name="identityEdit1" id="identityEdit1">
                <div class="input-group mb-3">
                  <input type="text" class="form-control" id="identityEdit" readonly></a>
                </div>
              </div>
            </div>
          </div>

          <div class="row p-2">
            <div class="col-md-6">
              <div class="form-group">
                <label for="addressEdit" class="text-primary">Alamat :</label><br>
                <input type="text" name="addressEdit" id="addressEdit" class="form-control" readonly>
              </div>
            </div>

            <div class="col-md-6">
              <div class="form-group">
                <label for="phoneEdit" class="text-primary">No Telp :</label><br>
                <input type="number" name="phoneEdit" id="phoneEdit" class="form-control" readonly>
              </div>
            </div>
          </div>
        </div>
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
  });

  $(document).ready(function() {
    var values;
    $(".openEditDialog").click(function() {
      values = $(this).data("id");
      values = values.split(",");
      console.log(values);
      $("#csEdit").val(values[0]);
      $("#identityEdit").val(values[1]);
      $("#identityEdit1").val(values[1]);
      $("#addressEdit").val(values[2]);
      $("#phoneEdit").val(values[3]);
    });

    $(".getID").click(function() {
      values = $(this).data("id");
      values = values.split(",");
      console.log(values);
      $("#checkin").val(values[4]);
      $("#checkout").val(values[5]);
      $("#total").val(values[6]);
      $("#namecar").val(values[8]);
      $("#platnomor").val(values[9]);
      $("#harga").val(values[10]);
    });
  });
</script>