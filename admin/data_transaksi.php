<?php
include 'include.php';

$status = "Berjalan";
$statusCar = "Tersedia";

$sql = query("SELECT * FROM data_customer AS dc LEFT JOIN mobil_data AS md ON dc.id_car = md.id where dc.status_cs='$status' ");
$selectCar = query("SELECT * FROM mobil_data where status='$statusCar' ");

if (isset($_POST['add_data'])) {
    AddDataCustomer();
    header('LOCATION:data_transaksi.php');
    exit;
}

if (isset($_POST['delete'])) {
    DeleteDataCustomer($_POST['id']);
    header("Refresh:0");
}

if (isset($_POST['update'])) {
    UpdateDataCustomer();
    header("Refresh:0");
}

if (isset($_POST['done'])) {
    DoneTransaction($_POST['idE']);
    header("Refresh:0");
}
?>

<?php include "template/header.php"; ?>

<body id="page-top">
    <div id="wrapper">

        <?php include "template/sidebar.php"; ?>

        <div id="content-wrapper" class="d-flex flex-column">
            <div id="content">
                <?php include "template/navbar.php"; ?>

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

                                <?php $i = 1; ?>
                                <?php foreach ($sql as $data) : ?>
                                    <?php $debug = implode(",", $data); ?>
                                    <tbody id="myTable">
                                        <tr>
                                            <th><?php echo $i; ?></th>
                                            <th><?php echo $data['name']; ?></th>
                                            <th><?php echo $data['address']; ?></th>
                                            <th><?php echo $data['car_name']; ?></th>
                                            <th><?php echo $data['checkin']; ?></th>
                                            <th class="badge badge-danger mt-1"><?php echo $data['status_cs']; ?></th>

                                            <th>
                                                <form method="post">
                                                    <a href="" class="openEditDialog" data-toggle="modal" data-target="#modal2" data-id="<?php echo $debug; ?>"><i class="far fa-edit fa-lg"></i></a>
                                                    |
                                                    <button type="submit" class="badge badge-success getID" name="done" id="done" data-id="<?php echo $debug ?>" onclick="return confirm('Beneran nih?')"><i class="fas fa-check-circle fa-lg"></i></button>
                                                    <input type="hidden" id="car_id" name="car_id">
                                                    <input type="hidden" id="idE" name="idE">
                                                    <input type="hidden" name="checkEn" id="checkEn">
                                                    <input type="hidden" name="price" id="price">
                                                </form>
                                            </th>
                                        </tr>
                                        <?php $i++; ?>
                                    </tbody>
                                <?php endforeach; ?>
                            </table>

                        </div>
                    </div>
                </div>

            </div>

            <?php include "template/footer.php"; ?>

        </div>
    </div>

    <!-- Add Data -->
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
                                    <label for="namecs" class="text-primary">Nama :</label><br>
                                    <input type="text" name="namecs" id="namecs" class="form-control" required>
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="identity" class="text-primary">Identitas :</label><br>
                                    <input type="file" name="identity" id="identity" class="form-control" required>
                                </div>
                            </div>
                        </div>

                        <div class="row p-2">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="address" class="text-primary">Alamat :</label><br>
                                    <input type="text" name="address" id="address" class="form-control" required>
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="phone" class="text-primary">No Telp :</label><br>
                                    <input type="number" name="phone" id="phone" class="form-control" required>
                                </div>
                            </div>
                        </div>

                        <div class="row p-2">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="id_car" class="text-primary">Mobil Yang Dipinjam :</label><br>
                                    <select name="id_car" required class="form-control">
                                        <option disabled selected> Pilih </option>
                                        <?php foreach ($selectCar as $data) : ?>
                                            <option value="<?php echo $data['id']; ?>" class="form-control"> <?php echo $data['car_name']; ?> </option>
                                        <?php endforeach; ?>
                                    </select>
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="checkin" class="text-primary">Tanggal Diambil :</label><br>
                                    <input type="date" name="checkin" id="checkin" class="form-control" required>
                                </div>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="submit" name="add_data" class="btn btn-primary">Tambah Data</button>
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
                                <input type="hidden" id="car_id" name="car_id">
                                <div class="form-group">
                                    <input type="hidden" id="id" name="id">
                                    <label for="csEdit" class="text-primary">Nama :</label><br>
                                    <input type="text" name="csEdit" id="csEdit" class="form-control" required>
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="identityEdit" class="text-primary">Identitas :</label><br>
                                    <input type="hidden" name="identityEdit" value="<?php echo $sql[0]['identity'] ?>">
                                    <div class="input-group mb-3">
                                        <a href="http://localhost/car/admin/images/<?php echo $sql[0]['identity']; ?>"><input type="text" class="form-control" id="identityEdit" value="<?php echo $sql[0]['identity'] ?>" readonly></a>
                                        <div class="input-group-append">
                                            <label class="btn btn-primary">
                                                browse <input type="file" name="identity" class="form-control" hidden>
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
                            <button type="submit" name="update" id="update" class="btn btn-primary">Edit Data</button>
                            <button type="submit" name="delete" id="delete" class="btn btn-danger" onclick="return confirm('Beneran nih?')">Hapus Data</button>
                        </div>
                    </form>
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
            $("#id").val(values[0]);
            $("#car_id").val(values[1]);
            $("#csEdit").val(values[2]);
            $("#identityEdit").val(values[3]);
            $("#addressEdit").val(values[4]);
            $("#phoneEdit").val(values[5]);
            $("#checkinEdit").val(values[6]);
            $("#carEdit").val(values[12]);
        });

        $(".getID").click(function() {
            values = $(this).data("id");
            values = values.split(",");
            $("#idE").val(values[0]);
            $("#checkEn").val(values[6]);
            $("#car_id").val(values[1]);
            $("#price").val(values[14]);
        });
    });
</script>