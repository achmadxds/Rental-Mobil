<?php
$connect = new mysqli("localhost", "root", "", "car_rent");

if (mysqli_connect_errno()) {
    echo "koneksi database gagal : " . mysqli_connect_error();
}

function query($query)
{
    global $connect;
    $result = mysqli_query($connect, $query);
    $rows = [];
    while ($row = mysqli_fetch_assoc($result)) {
        $rows[] = $row;
    }
    return $rows;
}

function Rp($money)
{
    $Rupiah = "Rp " . number_format($money, ',', '.');
    return $Rupiah;
}

// Mobil

function AddDataCar()
{
    global $connect;

    $car = $_POST['car_name'];
    $plate = $_POST['plate_number'];
    $price = $_POST['rental_price'];
    $type = $_POST['car_type'];
    $status = "Tersedia";

    $query = "INSERT INTO mobil_data values (default ,'$car', '$plate', '$price', '$type', '$status', default, default)";
    mysqli_query($connect, $query);

    return mysqli_affected_rows($connect);
}

function UpdateDataCar()
{
    global $connect;

    $id = $_POST['id'];
    $car_name = $_POST['edit_name'];
    $number_plate = $_POST['edit_plate'];
    $rental_price = $_POST['edit_price'];
    $car_type = $_POST['edit_type'];
    $status = $_POST['statusCar'];

    $query = "UPDATE mobil_data SET car_name='$car_name', plate_number='$number_plate',
        rental_price='$rental_price', type_car='$car_type', status='$status' WHERE id='$id' ";
    mysqli_query($connect, $query);

    return mysqli_affected_rows($connect);
}

function UpdateBanner($id)
{
    global $connect;

    $desc = $_POST['descBanner'];
    $lastImg = $_POST['carImgEdit'];

    if ($_FILES['carImg']['error'] === 4)
        $img = $lastImg;
    else
        $img = UploadImg('carImg');

    $query = "UPDATE mobil_data SET description='$desc', car_img='$img' where id='$id' ";
    mysqli_query($connect, $query);

    return mysqli_affected_rows($connect);
}

function DeleteDataCar($id)
{
    global $connect;
    mysqli_query($connect, "DELETE FROM mobil_data where id='$id' ");
    return mysqli_affected_rows($connect);
}

// COSTUMER

function AddDataCustomer()
{
    global $connect;

    $name = $_POST['namecs'];
    $address = $_POST['address'];
    $phone = $_POST['phone'];
    $checkin = $_POST['checkin'];
    $status = "Berjalan";
    
    $id_car = $_POST['id_car'];
    $identity = UploadImg('identity');

    if ($identity == false)
        return false;

    $query = "INSERT INTO data_customer values (default, '$id_car','$name', '$identity', '$address', '$phone', '$checkin', default, default, default, '$status')";

    if(mysqli_query($connect, $query))
        UpdateCar($id_car, "Terpakai");

    return mysqli_affected_rows($connect);
}

function UpdateCar($id, $string)
{
    global $connect;

    $statusCar = "UPDATE mobil_data SET status='$string' where id='$id' ";
    mysqli_query($connect, $statusCar);

    return mysqli_affected_rows($connect);
}

function UpdateDataCustomer()
{
    global $connect;

    $id = $_POST['id'];
    $name = $_POST['csEdit'];
    $address = $_POST['addressEdit'];
    $phone = $_POST['phoneEdit'];
    $lastID = $_POST['identityEdit'];
    $checkin = $_POST['checkinEdit'];
    $status = "Berjalan";

    if ($_FILES['identity']['error'] === 4)
        $ID = $lastID;
    else
        $ID = UploadImg('identity');
        
    $query = "UPDATE data_customer SET name='$name', identity='$ID', address='$address', phone='$phone', 
    checkin='$checkin', status_cs='$status' WHERE id_cs='$id' ";

    mysqli_query($connect, $query);

    return mysqli_affected_rows($connect);
}

function UploadImg($name)
{
    $namaFile = $_FILES[$name]['name'];
    $tmpName = $_FILES[$name]['tmp_name'];

    $fileExtension = explode('.', $namaFile);
    $fileExtension = strtolower(end($fileExtension));

    move_uploaded_file($tmpName, 'images/' . $namaFile);
    return $namaFile;
}

function DeleteDataCustomer($id)
{
    global $connect;

    $car_id = $_POST['car_id'];
    $query = "DELETE FROM data_customer where id_cs='$id' ";
    
    if(mysqli_query($connect, $query)){
        UpdateCar($car_id, "Tersedia");
    }

    var_dump($car_id);

    return mysqli_affected_rows($connect);
}

function DoneTransaction($id)
{
    global $connect;

    $string = "Selesai";
    $car_id = $_POST['car_id'];
    $price = $_POST['price'];
    $co = date('Y/m/d');
    $ci = $_POST['checkEn'];
    $date = DateDiff($ci, $co);

    $prices = $date * $price;

    $query = "UPDATE data_customer SET status_cs='$string', checkout='$co', days='$date', totalPrice='$prices' where id_cs='$id'";

    if(mysqli_query($connect, $query)){
        UpdateCar($car_id, "Tersedia");
    }

    return mysqli_affected_rows($connect);
}

function DateDiff($date1, $date2)
{
    $days = (strtotime($date2) - strtotime($date1))/60/60/24;
    return $days;
}