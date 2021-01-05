<?php
    include 'include.php';
    $sql = query("SELECT * FROM mobil_data");

    if(isset($_POST['editBanner'])){
        UpdateBanner($_POST['car_aidi']);
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
                    <div class="text-center">
                        <h3 class="text-primary"><b>BANNER MOBIL</b></h3>
                    </div>
                </div>

                <!-- Table Data -->
                <div class="container mt-3">
                    <div class="card">
                        <div class="card-body">
                            <?php foreach ($sql as $data) : ?>
                                <?php $debug = implode(",", $data) ?>
                                <input type="text" name="editBanner" id="editBanner" class="text-center btn btn-secondary openEditDialog" data-toggle="modal" data-target="#modal1" data-id="<?php echo $debug ?>" value="<?php echo $data['car_name']; ?>" readonly>
                            <?php endforeach; ?>
                        </div>
                    </div>
                </div>

            </div>

            <?php include "template/footer.php"; ?>

        </div>
    </div>

    <!-- Modal Add Data -->
    <div class="modal fade" id="modal1" tabindex="-1" role="dialog" aria-labelledby="basicModal" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Edit Banner</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form method="POST" action="" enctype="multipart/form-data">
                        <div class="form-group">
                            <input type="hidden" name="car_aidi" id="car_aidi">
                            <label for="descBanner" class="text-primary">Deskripsi:</label><br>
                            <textarea name="descBanner" id="descBanner" cols="45" rows="10" placeholder="isi deskrisi..."></textarea>
                        </div>
                        <div class="form-group">
                            <label for="carImgEdit" class="text-primary">Foto Mobil :</label><br>
                            <input type="hidden" name="carImgEdit" value="<?php echo $sql[0]['car_img']; ?>">
                            <div class="input-group mb-3">
                                <input type="text" class="form-control" id="carImg" placeholder="isi foto..." readonly>
                                <div class="input-group-append">
                                    <label class="btn btn-secondary">
                                        browse <input type="file" name="carImg" class="form-control" hidden>
                                    </label>
                                </div>
                            </div>
                        </div>
                </div>
                <div class="modal-footer">
                    <button type="submit" name="editBanner" class="btn btn-primary" onclick="return confirm('Mau simpan data?')">Edit Data</button>
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
            $("#car_aidi").val(values[0]);
            $("#descBanner").val(values[6]);
            $("#carImg").val(values[7]);
        });
    });
</script>