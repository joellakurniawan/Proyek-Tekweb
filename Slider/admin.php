<?php
    include "connect.php";
    session_start();
    if(isset($_SESSION["username"])){
        $username = $_SESSION["username"];
    }
    else{
        header('Location:main.php');
    }
    if(isset($_POST['show_customer'])){
        $query = mysqli_query($con, "SELECT * FROM customers");
        while($row=mysqli_fetch_array($query)){
            echo '
            <tr>
            <td class="'.$row['id_customer'].'">'.$row['username_customer'].'</td>
            <td>'.$row['password_customer'].'</td>
            <td>'.$row['email_customer'].'</td>
            <td>'.$row['nohp_customer'].'</td>
            <td>'.$row['fullname_customer'].'</td>
            <td>'.$row['saldo'].'</td>
            <td>
            <a class="add addCustomer" title="Add" data-toggle="tooltip"><i class="material-icons">&#xE03B;</i></a>
            <a class="update updateCustomer" title="Update" data-toggle="tooltip"><i class="material-icons">&#xE03B;</i></a>
            <a class="edit" title="Edit" data-toggle="tooltip"><i class="material-icons">&#xE254;</i></a>
            <a class="delete" title="Delete" data-toggle="tooltip"><i class="material-icons">&#xE872;</i></a>
            </td>
            </tr>
            ';
        }
        exit();
    }
    if(isset($_POST['add_customer'])){
        $username = $_POST['username'];
        $password = $_POST['password'];
        $email = $_POST['email'];
        $nohp = $_POST['nohp'];
        $fullname = $_POST['fullname'];
        $saldo = $_POST['saldo'];
        $query = mysqli_query($con, "INSERT INTO customers VALUES (NULL,'$username','$password','$email','$nohp','$fullname', $saldo)");
        exit();
    }
    if(isset($_POST['update_customer'])){
        $id = $_POST['id'];
        $username = $_POST['username'];
        $password = $_POST['password'];
        $email = $_POST['email'];
        $nohp = $_POST['nohp'];
        $fullname = $_POST['fullname'];
        $saldo = $_POST['saldo'];
        $query = mysqli_query($con, "UPDATE customers SET username_customer='$username', password_customer='$password', email_customer='$email', nohp_customer='$nohp', fullname_customer='$fullname', saldo=$saldo WHERE id_customer=$id");
        exit();
    }
    if(isset($_POST['show_airline'])){
        $query = mysqli_query($con, "SELECT * FROM airlines");
        while($row=mysqli_fetch_array($query)){
            echo '
            <tr>
            <td class="'.$row['id_airlines'].'">'.$row['nama_airlines'].'</td>
            <td>'.$row['kode_airlines'].'</td>
            <td><img src="assets/logo airlines/'.$row['foto_airlines'].'.jpg" width=20%;></td>
            <td>
            <a class="add addAirline" title="Add" data-toggle="tooltip"><i class="material-icons">&#xE03B;</i></a>
            <a class="delete" title="Delete" data-toggle="tooltip"><i class="material-icons">&#xE872;</i></a>
            </td>
            </tr>
            ';
        }
        exit();
    }
    if(isset($_POST['add_airline'])){
        $nama = $_POST['nama'];
        $kode = $_POST['kode'];
        $foto = $_POST['foto'];
        $query = mysqli_query($con, "INSERT INTO airlines VALUES (NULL,'$nama','$kode','$foto')");
        exit();
    }
    if(isset($_POST['update_airline'])){
        $id = $_POST['id'];
        $nama = $_POST['nama'];
        $kode = $_POST['kode'];
        $foto = $_POST['foto'];
        $query = mysqli_query($con, "UPDATE airlines SET nama_airlines='$nama', kode_airlines='$kode', foto_airlines='$foto' WHERE id_airlines=$id");
        exit();
    }
    if(isset($_POST['pilih_airline'])){
        $query = mysqli_query($con, "SELECT * FROM airlines");
        echo "<select class='form-control'>";
        while ($row=mysqli_fetch_array($query)) {
            echo '
            <option>'.$row['id_airlines'].'</option>
            ';
        }
        echo "</select>";
        exit();
    }
    if(isset($_POST['pilih_kode_pesawat'])){
        $query = mysqli_query($con, "SELECT * FROM pesawat");
        echo "<select class='form-control pilih_kode_pesawat'>";
        while ($row=mysqli_fetch_array($query)) {
            echo '
            <option>'.$row['kode_pesawat'].'</option>
            ';
        }
        echo "</select>";
        exit();
    }
    if(isset($_POST['show_pesawat'])){
        $query = mysqli_query($con, "SELECT * FROM pesawat");
        while($row=mysqli_fetch_array($query)){
            echo '
            <tr>
            <td class="'.$row['id_pesawat'].'">'.$row['kapasitas_pesawat'].'</td>
            <td>'.$row['id_airlines'].'</td>
            <td>'.$row['kode_pesawat'].'</td>
            <td>
            <a class="add addPesawat" title="Add" data-toggle="tooltip"><i class="material-icons">&#xE03B;</i></a>
            <a class="update updatePesawat" title="Update" data-toggle="tooltip"><i class="material-icons">&#xE03B;</i></a>
            <a class="edit" title="Edit" data-toggle="tooltip"><i class="material-icons">&#xE254;</i></a>
            <a class="delete" title="Delete" data-toggle="tooltip"><i class="material-icons">&#xE872;</i></a>
            </td>
            </tr>
            ';
        }
        exit();
    }
    if(isset($_POST['add_pesawat'])){
        $kapasitas = $_POST['kapasitas'];
        $idairlines = $_POST['idairlines'];
        $kodepesawat = $_POST['kodepesawat'];
        // echo $kapasitas.$idairlines.$kodepesawat;
        $query = mysqli_query($con, "INSERT INTO pesawat VALUES (NULL,'$kapasitas','$idairlines','$kodepesawat')");
        exit();
    }
    if(isset($_POST['update_pesawat'])){
        $id = $_POST['id'];
        $kapasitas = $_POST['kapasitas'];
        $idairlines = $_POST['idairlines'];
        $kodepesawat = $_POST['kodepesawat'];
        $query = mysqli_query($con, "UPDATE pesawat SET kapasitas_pesawat=$kapasitas, id_airlines=$idairlines, kode_pesawat='$kodepesawat' WHERE id_pesawat=$id");
        exit();
    }
    if(isset($_POST['show_airport'])){
        $query = mysqli_query($con, "SELECT * FROM airport");
        while($row=mysqli_fetch_array($query)){
            echo '
            <tr>
            <td class="'.$row['id_airport'].'">'.$row['nama_airport'].'</td>
            <td>'.$row['kode_airport'].'</td>
            <td>'.$row['kota'].'</td>
            <td>'.$row['negara'].'</td>
            <td>
            <a class="add addAirport" title="Add" data-toggle="tooltip"><i class="material-icons">&#xE03B;</i></a>
            <a class="update updateAirport" title="Update" data-toggle="tooltip"><i class="material-icons">&#xE03B;</i></a>
            <a class="edit" title="Edit" data-toggle="tooltip"><i class="material-icons">&#xE254;</i></a>
            <a class="delete" title="Delete" data-toggle="tooltip"><i class="material-icons">&#xE872;</i></a>
            </td>
            </tr>
            ';
        }
        exit();
    }
    if(isset($_POST['add_airport'])){
        $nama = $_POST['nama'];
        $kode = $_POST['kode'];
        $kota = $_POST['kota'];
        $negara = $_POST['negara'];
        $query = mysqli_query($con, "INSERT INTO airport VALUES (NULL,'$nama','$kode','$kota','$negara')");
        exit();
    }
    if(isset($_POST['update_airport'])){
        $id = $_POST['id'];
        $nama = $_POST['nama'];
        $kode = $_POST['kode'];
        $kota = $_POST['kota'];
        $negara = $_POST['negara'];
        $query = mysqli_query($con, "UPDATE airport SET nama_airport='$nama', kode_airport='$kode', kota='$kota', negara='$negara' WHERE id_airport=$id");
        exit();
    }
    if(isset($_POST['show_debit'])){
        $query = mysqli_query($con, "SELECT * FROM bank_debit");
        while($row=mysqli_fetch_array($query)){
            echo '
            <tr>
            <td class="'.$row['id_kartudebit'].'">'.$row['nomor_kartu'].'</td>
            <td>'.$row['nama_pemilik'].'</td>
            <td>'.$row['nama_bank'].'</td>
            <td>'.$row['tanggal_valid'].'</td>
            <td>'.$row['saldo'].'</td>
            <td>
            <a class="add addDebit" title="Add" data-toggle="tooltip"><i class="material-icons">&#xE03B;</i></a>
            <a class="update updateDebit" title="Update" data-toggle="tooltip"><i class="material-icons">&#xE03B;</i></a>
            <a class="edit" title="Edit" data-toggle="tooltip"><i class="material-icons">&#xE254;</i></a>
            <a class="delete" title="Delete" data-toggle="tooltip"><i class="material-icons">&#xE872;</i></a>
            </td>
            </tr>
            ';
        }
        exit();
    }
    if(isset($_POST['add_debit'])){
        $nomor = $_POST['nomor'];
        $nama = $_POST['nama'];
        $namabank = $_POST['namabank'];
        $tgl = $_POST['tgl'];
        $saldo = $_POST['saldo'];
        $query = mysqli_query($con, "INSERT INTO bank_debit VALUES (NULL,'$nomor','$nama','$namabank','$tgl','$saldo')");
        exit();
    }
    if(isset($_POST['update_debit'])){
        $id = $_POST['id'];
        $nomor = $_POST['nomor'];
        $nama = $_POST['nama'];
        $namabank = $_POST['namabank'];
        $tgl = $_POST['tgl'];
        $saldo = $_POST['saldo'];
        $query = mysqli_query($con, "UPDATE bank_debit SET nomor_kartu='$nomor', nama_pemilik='$nama', nama_bank='$namabank', tanggal_valid='$tgl', saldo='$saldo' WHERE id_kartudebit=$id");
        exit();
    }
    if(isset($_POST['show_kredit'])){
        $query = mysqli_query($con, "SELECT * FROM bank_kredit");
        while($row=mysqli_fetch_array($query)){
            echo '
            <tr>
            <td class="'.$row['id_kartukredit'].'">'.$row['nomor_kartu'].'</td>
            <td>'.$row['nama_pemilik'].'</td>
            <td>'.$row['nama_bank'].'</td>
            <td>'.$row['tanggal_valid'].'</td>
            <td>'.$row['tiga_digit'].'</td>
            <td>'.$row['tagihan'].'</td>
            <td>
            <a class="add addKredit" title="Add" data-toggle="tooltip"><i class="material-icons">&#xE03B;</i></a>
            <a class="update updateKredit" title="Update" data-toggle="tooltip"><i class="material-icons">&#xE03B;</i></a>
            <a class="edit" title="Edit" data-toggle="tooltip"><i class="material-icons">&#xE254;</i></a>
            <a class="delete" title="Delete" data-toggle="tooltip"><i class="material-icons">&#xE872;</i></a>
            </td>
            </tr>
            ';
        }
        exit();
    }
    if(isset($_POST['add_kredit'])){
        $nomor = $_POST['nomor'];
        $nama = $_POST['nama'];
        $namabank = $_POST['namabank'];
        $tgl = $_POST['tgl'];
        $tiga_digit = $_POST['tiga_digit'];
        $tagihan = $_POST['tagihan'];
        $query = mysqli_query($con, "INSERT INTO bank_kredit VALUES (NULL,'$nomor','$nama','$namabank','$tgl','$tiga_digit','$tagihan')");
        exit();
    }
    if(isset($_POST['update_kredit'])){
        $id = $_POST['id'];
        $nomor = $_POST['nomor'];
        $nama = $_POST['nama'];
        $namabank = $_POST['namabank'];
        $tgl = $_POST['tgl'];
        $tiga_digit = $_POST['tiga_digit'];
        $tagihan = $_POST['tagihan'];
        $query = mysqli_query($con, "UPDATE bank_kredit SET nomor_kartu='$nomor', nama_pemilik='$nama', nama_bank='$namabank', tanggal_valid='$tgl', tiga_digit='$tiga_digit', tagihan='$tagihan' WHERE id_kartukredit=$id");
        echo $id.$nomor.$nama.$namabank.$tgl.$tiga_digit.$tagihan;
        exit();
    }
    if(isset($_POST['show_jadwal'])){
        $query = mysqli_query($con, "SELECT * FROM jadwal_penerbangan");
        while($row=mysqli_fetch_array($query)){
            echo '
            <tr>
            <td class="'.$row['id_jdpenerbangan'].'">'.$row['tanggal_penerbangan'].'</td>
            <td>'.$row['jam_berangkat'].'</td>
            <td>'.$row['jam_tiba'].'</td>
            <td>'.$row['durasi'].'</td>
            <td>'.$row['lokasi_awal'].'</td>
            <td>'.$row['lokasi_tujuan'].'</td>
            <td>'.$row['id_pesawat'].'</td>
            <td>'.$row['harga'].'</td>
            <td>
            <a class="add addJadwal" title="Add" data-toggle="tooltip"><i class="material-icons">&#xE03B;</i></a>
            <a class="update updateJadwal" title="Update" data-toggle="tooltip"><i class="material-icons">&#xE03B;</i></a>
            <a class="edit" title="Edit" data-toggle="tooltip"><i class="material-icons">&#xE254;</i></a>
            <a class="delete" title="Delete" data-toggle="tooltip"><i class="material-icons">&#xE872;</i></a>
            </td>
            </tr>
            ';
        }
        exit();
    }
    if(isset($_POST['add_jadwal'])){
        $tgl = $_POST['tgl'];
        $jambrangkat = $_POST['jambrangkat'];
        $jamtiba = $_POST['jamtiba'];
        $durasi = $_POST['durasi'];
        $lokasiawal = $_POST['lokasiawal'];
        $lokasitujuan = $_POST['lokasitujuan'];
        $idpesawat = $_POST['idpesawat'];
        $harga = $_POST['harga'];
        // echo $tgl." ".$jambrangkat." ".$jamtiba." ".$durasi." ".$lokasiawal." ".$lokasitujuan." ".$idpesawat." ".$harga;
        $query = mysqli_query($con, "INSERT INTO jadwal_penerbangan VALUES (NULL,'$tgl','$jambrangkat','$jamtiba','$durasi','$lokasiawal','$lokasitujuan','$idpesawat','$harga')");
        exit();
    }
    if(isset($_POST['update_jadwal'])){
        $id = $_POST['id'];
        $tgl = $_POST['tgl'];
        $jambrangkat = $_POST['jambrangkat'];
        $jamtiba = $_POST['jamtiba'];
        $durasi = $_POST['durasi'];
        $lokasiawal = $_POST['lokasiawal'];
        $lokasitujuan = $_POST['lokasitujuan'];
        $idpesawat = $_POST['idpesawat'];
        $harga = $_POST['harga'];
        $query = mysqli_query($con, "UPDATE jadwal_penerbangan SET tanggal_penerbangan='$tgl', jam_berangkat='$jambrangkat', jam_tiba='$jamtiba', durasi='$durasi', lokasi_awal='$lokasiawal', lokasi_tujuan='$lokasitujuan', id_pesawat='$idpesawat', harga='$harga' WHERE id_jdpenerbangan=$id");
        exit();
    }
    if(isset($_POST['delete_table'])){
        $id = $_POST['id'];
        $table = $_POST['table'];
        $idtable = "id_".$table;
        if($table == 'customer' || $table == 'airline'){
            $table = $table."s";
            if($table == 'airlines'){
                $idtable = $idtable."s";
            }
        }
        if($table == 'jadwal'){
        	$table = 'jadwal_penerbangan';
        	$idtable = 'id_jdpenerbangan';
        }
        if($table == 'debit' || $table == 'kredit'){
        	$idtable = "id_kartu".$table;
        	$table = "bank_".$table;
        }
        $query = mysqli_query($con, "DELETE FROM $table WHERE $idtable=$id");
        exit();
    }
?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <link rel="icon" href="assets/logo_company.png" />

    <title>Admin</title>

    <!-- Bootstrap CSS CDN -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.0/css/bootstrap.min.css" integrity="sha384-9gVQ4dYFwwWSjIDZnLEWnxCjeSWFphJiwGPXr1jddIhOegiu1FwO5qRGvFXOdJZ4" crossorigin="anonymous">

    <!-- JQUERY -->
    <script src="https://code.jquery.com/jquery-3.4.1.js" integrity="sha256-WpOohJOqMqqyKL9FccASB9O0KwACQJpFTUBLTYOVvVU=" crossorigin="anonymous"></script>

    <link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">
    <script src="https://code.jquery.com/jquery-1.12.4.js"></script>
    <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
    <link rel="stylesheet" href="//cdnjs.cloudflare.com/ajax/libs/timepicker/1.3.5/jquery.timepicker.min.css">  

    <!-- Font Awesome JS -->
    <script defer src="https://use.fontawesome.com/releases/v5.0.13/js/solid.js" integrity="sha384-tzzSw1/Vo+0N5UhStP3bvwWPq+uvzCMfrN1fEFe+xBmv1C/AtVX5K0uZtmcHitFZ" crossorigin="anonymous"></script>
    <script defer src="https://use.fontawesome.com/releases/v5.0.13/js/fontawesome.js" integrity="sha384-6OIrr52G08NpOFSZdxxz1xdNSndlD4vdcf/q2myIUVO0VsqaGHJsB0RaBE01VTOY" crossorigin="anonymous"></script>
    <script src="https://unpkg.com/gijgo@1.9.13/js/gijgo.min.js" type="text/javascript"></script>
    <link href="https://unpkg.com/gijgo@1.9.13/css/gijgo.min.css" rel="stylesheet" type="text/css" />
    <script>
        $(document).ready(function() {
            username = '<?php echo $username; ?>';
            $(".welcome").append(username+" !");
            $(".isi").hide();
            showCustomer();
            showAirline();
            showPesawat();
            showAirport();
            showDebit();
            showKredit();
            showJadwal();
            $(".brand_logo").click(function(){
                showdata("");
                $(".isi").hide();
            });
            $("a").on("click", function() {
                $("a").closest("li").removeClass("active");
                if($(this).parent().attr("class") == 'dropdown'){
                    $('.components').on('shown.bs.tab', 'a', function (e) {
                        if (e.relatedTarget) {
                            $(e.relatedTarget).removeClass('active');
                        }
                    });
                }
                else{
                    if($(this).html() == "Debit" || $(this).html() == "Kredit"){}
                    else{
                        $(".collapse").removeClass("show");
                        $(".toogle").attr("aria-expanded","false"); 
                    }
                    $(this).closest("li").addClass("active");
                    showdata($(this).attr("name"));
                    if($(this).html()=="Customer"){
                        $(".Customer").show(); 
                        $(".Airline").hide();
                        $(".Pesawat").hide();
                        $(".Airport").hide();
                        $(".Debit").hide();
                        $(".Kredit").hide();
                        $(".JadwalPenerbangan").hide();
                        $(".Kursi").hide();
                        $(".Pesanan").hide();
                    }
                    else if($(this).html()=="Airline"){
                        $(".Customer").hide();
                        $(".Airline").show();
                        $(".Pesawat").hide();
                        $(".Airport").hide();
                        $(".Debit").hide();
                        $(".Kredit").hide();
                        $(".JadwalPenerbangan").hide();
                        $(".Kursi").hide();
                        $(".Pesanan").hide();    
                    }
                    else if($(this).html()=="Pesawat"){
                        $(".Customer").hide();
                        $(".Airline").hide();
                        $(".Pesawat").show();
                        $(".Airport").hide();
                        $(".Debit").hide();
                        $(".Kredit").hide();
                        $(".JadwalPenerbangan").hide();
                        $(".Kursi").hide();
                        $(".Pesanan").hide();    
                    }
                    else if($(this).html()=="Airport"){
                        $(".Customer").hide();
                        $(".Airline").hide();
                        $(".Pesawat").hide();
                        $(".Airport").show();
                        $(".Debit").hide();
                        $(".Kredit").hide();
                        $(".JadwalPenerbangan").hide();
                        $(".Kursi").hide();
                        $(".Pesanan").hide();    
                    }
                    else if($(this).html()=="Debit"){
                        $(".Customer").hide();
                        $(".Airline").hide();
                        $(".Pesawat").hide();
                        $(".Airport").hide();
                        $(".Debit").show();
                        $(".Kredit").hide();
                        $(".JadwalPenerbangan").hide();
                        $(".Kursi").hide();
                        $(".Pesanan").hide();    
                    }
                    else if($(this).html()=="Kredit"){
                        $(".Customer").hide();
                        $(".Airline").hide();
                        $(".Pesawat").hide();
                        $(".Airport").hide();
                        $(".Debit").hide();
                        $(".Kredit").show();
                        $(".JadwalPenerbangan").hide();
                        $(".Kursi").hide();
                        $(".Pesanan").hide();    
                    }
                    else if($(this).html()=="Jadwal Penerbangan"){
                        $(".Customer").hide();
                        $(".Airline").hide();
                        $(".Pesawat").hide();
                        $(".Airport").hide();
                        $(".Debit").hide();
                        $(".Kredit").hide();
                        $(".JadwalPenerbangan").show();
                        $(".Kursi").hide();
                        $(".Pesanan").hide();    
                    }
                    // else if($(this).html()=="Kursi"){
                    //     $(".Customer").hide();
                    //     $(".Airline").hide();
                    //     $(".Pesawat").hide();
                    //     $(".Airport").hide();
                    //     $(".Debit").hide();
                    //     $(".Kredit").hide();
                    //     $(".JadwalPenerbangan").hide();
                    //     $(".Kursi").show();
                    //     $(".Pesanan").hide();    
                    // }
                    // else if($(this).html()=="Pesanan"){
                    //     $(".Customer").hide();
                    //     $(".Airline").hide();
                    //     $(".Pesawat").hide();
                    //     $(".Airport").hide();
                    //     $(".Debit").hide();
                    //     $(".Kredit").hide();
                    //     $(".JadwalPenerbangan").hide();
                    //     $(".Kursi").hide();
                    //     $(".Pesanan").show();    
                    // }
                }
            });
            $(".add-Customer").click(function(){
                $(this).attr("disabled", "disabled");
                var index = $(".tableCustomer .customer tr:last-child").index();
                var row = '<tr>' +
                '<td><input type="text" class="form-control" name="username" id="username"></td>' +
                '<td><input type="text" class="form-control" name="password" id="password"></td>' +
                '<td><input type="text" class="form-control" name="email" id="email"></td>' +
                '<td><input type="text" class="form-control" name="nohp" id="nohp"></td>' +
                '<td><input type="text" class="form-control" name="fullname" id="fullname"></td>' +
                '<td><input type="number" class="form-control" name="saldo" id="saldo" min="0"></td>' +
                '<td>' + $(".tableCustomer td:last-child").html() + '</td>' +
                '</tr>';
                $(".tableCustomer").append(row);     
                $(".tableCustomer .customer tr").eq(index + 1).find(".addCustomer, .edit").toggle();
            });
            $(document).on("click", ".addCustomer", function(){
                var empty = false;
                var input = $(this).parents("tr").find('input[type="text"]');
                input.each(function(){
                    if(!$(this).val()){
                        $(this).addClass("error");
                        empty = true;
                    } else{
                        $(this).removeClass("error");
                    }
                });
                $(this).parents("tr").find(".error").first().focus();
                var arr = [];
                var counter = 0;
                if(!empty){
                    input.each(function(){
                        arr[counter] = $(this).val();
                        counter++;
                        $(this).parent("td").html($(this).val());
                    });
                    saldo = $("#saldo").val();
                    $(this).parents("tr").find(".addCustomer, .edit").toggle();
                    $(".add-Customer").removeAttr("disabled");
                    $.ajax({
                        url : "admin.php",
                        type : "POST",
                        async : false,
                        cache : false,
                        data : {
                            add_customer : 1,
                            username : arr[0],
                            password : arr[1],
                            email : arr[2],
                            nohp : arr[3],
                            fullname : arr[4],
                            saldo : saldo
                        },
                        success: function(result){
                            // showCustomer();
                        }
                    });
                    showCustomer();
                }       
            });
            $(document).on("click", ".updateCustomer", function(){
                id = $(this).closest('tr').children('td:first').attr('class');
                var empty = false;
                var input = $(this).parents("tr").find('input[type="text"]');
                input.each(function(){
                    if(!$(this).val()){
                        $(this).addClass("error");
                        empty = true;
                    } else{
                        $(this).removeClass("error");
                    }
                });
                $(this).parents("tr").find(".error").first().focus();
                var arr = [];
                var counter = 0;
                if(!empty){
                    input.each(function(){
                        arr[counter] = $(this).val();
                        counter++;
                        $(this).parent("td").html($(this).val());
                    });
                    $(this).parents("tr").find(".updateCustomer, .edit").toggle();
                    $(".add-Customer").removeAttr("disabled");
                    $.ajax({
                        url : "admin.php",
                        type : "POST",
                        async : false,
                        cache : false,
                        data : {
                            update_customer : 1,
                            id : id,
                            username : arr[0],
                            password : arr[1],
                            email : arr[2],
                            nohp : arr[3],
                            fullname : arr[4],
                            saldo : arr[5]
                        },
                        success: function(result){
                        }
                    });
                    //showCustomer();
                }       
            });
            $(".add-Airline").click(function(){
                window.location.replace("addAirline.php");
                // $(this).attr("disabled", "disabled");
                // var index = $(".tableAirline .airline tr:last-child").index();
                // var row = '<tr>' +
                // '<td><input type="text" class="form-control" name="nama" id="nama"></td>' +
                // '<td><input type="text" class="form-control" name="kode" id="kode"></td>' +
                // '<td><form action="upload.php" method="post" enctype="multipart/form-data"><input type="file" name="fileToUpload" id="fileToUpload"><input type="submit" value="Upload Image" name="submit" width=auto></form></td>' +
                // '<td>' + $(".tableAirline td:last-child").html() + '</td>' +
                // '</tr>';
                // $(".tableAirline").append(row);     
                // $(".tableAirline .airline tr").eq(index + 1).find(".addAirline, .edit").toggle();
            });
            $(document).on("click", ".addAirline", function(){
                var empty = false;
                var input = $(this).parents("tr").find('input[type="text"]');
                input.each(function(){
                    if(!$(this).val()){
                        $(this).addClass("error");
                        empty = true;
                    } else{
                        $(this).removeClass("error");
                    }
                });
                $(this).parents("tr").find(".error").first().focus();
                var arr = [];
                var counter = 0;
                if(!empty){
                    input.each(function(){
                        arr[counter] = $(this).val();
                        counter++;
                        $(this).parent("td").html($(this).val());
                    });
                    $(this).parents("tr").find(".addAirline, .edit").toggle();
                    $(".add-Airline").removeAttr("disabled");
                    $.ajax({
                        url : "admin.php",
                        type : "POST",
                        async : false,
                        cache : false,
                        data : {
                            add_airline : 1,
                            nama : arr[0],
                            kode : arr[1],
                            foto : arr[2]
                        },
                        success: function(result){
                            // showCustomer();
                        }
                    });
                    showAirline();
                }       
            });

            $(".add-Pesawat").click(function(){
                var tempAirline = "";
                $.ajax({
                    url : "admin.php",
                    type : "POST",
                    async : false,
                    cache : false,
                    data : {
                        pilih_airline : 1
                    },
                    success: function(result){
                        tempAirline = result;
                    }
                });
                var tempKodePesawat = "";
                $.ajax({
                    url : "admin.php",
                    type : "POST",
                    async : false,
                    cache : false,
                    data : {
                        pilih_kode_pesawat : 1
                    },
                    success: function(result){
                        tempKodePesawat = result;
                    }
                });
                $(this).attr("disabled", "disabled");
                var index = $(".tablePesawat .pesawat tr:last-child").index();
                var row = '<tr>' +
                '<td><input type="number" class="form-control" name="kapasitas" id="kapasitas" min="1"></td>' +
                '<td>'+tempAirline+'</td>' +
                '<td>'+tempKodePesawat+'</td>' +
                '<td>' + $(".tablePesawat td:last-child").html() + '</td>' +
                '</tr>';
                $(".tablePesawat").append(row);     
                $(".tablePesawat .pesawat tr").eq(index + 1).find(".addPesawat, .edit").toggle();
            });
            $(document).on("click", ".addPesawat", function(){
                var empty = false;
                var input = $(this).parents("tr").find('input[type="text"]');
                input.each(function(){
                    if(!$(this).val()){
                        $(this).addClass("error");
                        empty = true;
                    } else{
                        $(this).removeClass("error");
                    }
                });
                $(this).parents("tr").find(".error").first().focus();
                var arr = [];
                var counter = 0;
                var kap = $('#kapasitas').val();
                if(!empty){
                    // input.each(function(){
                    //     arr[counter] = $(this).val();
                    //     counter++;
                    //     $(this).parent("td").html($(this).val());
                    // });
                    $('select').each(function(){
                        arr[counter] = $(this).children("option:selected").val();
                        $(this).parent("td").html(arr[counter]);
                        counter++;
                    });
                    $(this).parents("tr").find(".addPesawat, .edit").toggle();
                    $(".add-Pesawat").removeAttr("disabled");
                    $.ajax({
                        url : "admin.php",
                        type : "POST",
                        async : false,
                        cache : false,
                        data : {
                            add_pesawat : 1,
                            kapasitas : kap,
                            idairlines : arr[0],
                            kodepesawat : arr[1]
                        },
                        success: function(result){
                            // alert(result);
                            // showCustomer();
                        }
                    });
                    showPesawat();
                }       
            });
            $(document).on("click", ".updatePesawat", function(){
                id = $(this).closest('tr').children('td:first').attr('class');
                var empty = false;
                var input = $(this).parents("tr").find('input[type="text"]');
                input.each(function(){
                    if(!$(this).val()){
                        $(this).addClass("error");
                        empty = true;
                    } else{
                        $(this).removeClass("error");
                    }
                });
                $(this).parents("tr").find(".error").first().focus();
                var arr = [];
                var counter = 0;
                if(!empty){
                    input.each(function(){
                        arr[counter] = $(this).val();
                        counter++;
                        $(this).parent("td").html($(this).val());
                    });
                    $(this).parents("tr").find(".updatePesawat, .edit").toggle();
                    $(".add-Pesawat").removeAttr("disabled");
                    $.ajax({
                        url : "admin.php",
                        type : "POST",
                        async : false,
                        cache : false,
                        data : {
                            update_pesawat : 1,
                            id : id,
                            kapasitas : arr[0],
                            idairlines : arr[1],
                            kodepesawat : arr[2]
                        },
                        success: function(result){
                        }
                    });
                    //showCustomer();
                }       
            });
            $(".add-Airport").click(function(){
                $(this).attr("disabled", "disabled");
                var index = $(".tableAirport .airport tr:last-child").index();
                var row = '<tr>' +
                '<td><input type="text" class="form-control" name="nama" id="nama"></td>' +
                '<td><input type="text" class="form-control" name="kode" id="kode"></td>' +
                '<td><input type="text" class="form-control" name="kota" id="kota"></td>' +
                '<td><input type="text" class="form-control" name="negara" id="negara"></td>' +
                '<td>' + $(".tableAirport td:last-child").html() + '</td>' +
                '</tr>';
                $(".tableAirport").append(row);     
                $(".tableAirport .airport tr").eq(index + 1).find(".addAirport, .edit").toggle();
            });
            $(document).on("click", ".addAirport", function(){
                var empty = false;
                var input = $(this).parents("tr").find('input[type="text"]');
                input.each(function(){
                    if(!$(this).val()){
                        $(this).addClass("error");
                        empty = true;
                    } else{
                        $(this).removeClass("error");
                    }
                });
                $(this).parents("tr").find(".error").first().focus();
                var arr = [];
                var counter = 0;
                if(!empty){
                    input.each(function(){
                        arr[counter] = $(this).val();
                        counter++;
                        $(this).parent("td").html($(this).val());
                    });
                    $(this).parents("tr").find(".addAirport, .edit").toggle();
                    $(".add-Airport").removeAttr("disabled");
                    $.ajax({
                        url : "admin.php",
                        type : "POST",
                        async : false,
                        cache : false,
                        data : {
                            add_airport : 1,
                            nama : arr[0],
                            kode : arr[1],
                            kota : arr[2],
                            negara : arr[3]
                        },
                        success: function(result){
                            // showCustomer();
                        }
                    });
                    showAirport();
                }       
            });
            $(document).on("click", ".updateAirport", function(){
                id = $(this).closest('tr').children('td:first').attr('class');
                var empty = false;
                var input = $(this).parents("tr").find('input[type="text"]');
                input.each(function(){
                    if(!$(this).val()){
                        $(this).addClass("error");
                        empty = true;
                    } else{
                        $(this).removeClass("error");
                    }
                });
                $(this).parents("tr").find(".error").first().focus();
                var arr = [];
                var counter = 0;
                if(!empty){
                    input.each(function(){
                        arr[counter] = $(this).val();
                        counter++;
                        $(this).parent("td").html($(this).val());
                    });
                    $(this).parents("tr").find(".updateAirport, .edit").toggle();
                    $(".add-Airport").removeAttr("disabled");
                    $.ajax({
                        url : "admin.php",
                        type : "POST",
                        async : false,
                        cache : false,
                        data : {
                            update_airport : 1,
                            id : id,
                            nama : arr[0],
                            kode : arr[1],
                            kota : arr[2],
                            negara : arr[3]
                        },
                        success: function(result){
                        }
                    });
                    //showCustomer();
                }       
            });
            $(".add-Debit").click(function(){
                $(this).attr("disabled", "disabled");
                var index = $(".tableDebit .debit tr:last-child").index();
                var row = '<tr>' +
                '<td><input type="text" class="form-control" name="nomor" id="nomor"></td>' +
                '<td><input type="text" class="form-control" name="nama" id="nama"></td>' +
                '<td><input type="text" class="form-control" name="namabank" id="namabank"></td>' +
                '<td class="tgl"><input class="datepicker tgl" width="76"></td>' +
                '<td><input type="number" class="form-control" name="saldo" id="saldo" min="0"></td>' +
                '<td>' + $(".tableDebit td:last-child").html() + '</td>' +
                '</tr>';
                $(".tableDebit").append(row);     
                $(".tableDebit .debit tr").eq(index + 1).find(".addDebit, .edit").toggle();
                tdpicker();
            });
            $(document).on("click", ".addDebit", function(){
                var empty = false;
                var input = $(this).parents("tr").find('input[type="text"]');
                input.each(function(){
                    if(!$(this).val()){
                        $(this).addClass("error");
                        empty = true;
                    } else{
                        $(this).removeClass("error");
                    }
                });
                $(this).parents("tr").find(".error").first().focus();
                var arr = [];
                var counter = 0;
                if(!empty){
                    input.each(function(){
                        arr[counter] = $(this).val();
                        counter++;
                        $(this).parent("td").html($(this).val());
                    });
                    hari = $('input.tgl').val();
                    var saldo = $('#saldo').val();
                    $(this).parents("tr").find(".addDebit, .edit").toggle();
                    $(".add-Debit").removeAttr("disabled");
                    $.ajax({
                        url : "admin.php",
                        type : "POST",
                        async : false,
                        cache : false,
                        data : {
                            add_debit : 1,
                            nomor : arr[0],
                            nama : arr[1],
                            namabank : arr[2],
                            tgl : hari,
                            saldo : saldo
                        },
                        success: function(result){
                            // showCustomer();
                        }
                    });
                    showDebit();
                }       
            });
            $(document).on("click", ".updateDebit", function(){
                id = $(this).closest('tr').children('td:first').attr('class');
                var empty = false;
                var input = $(this).parents("tr").find('input[type="text"]');
                input.each(function(){
                    if(!$(this).val()){
                        $(this).addClass("error");
                        empty = true;
                    } else{
                        $(this).removeClass("error");
                    }
                });
                $(this).parents("tr").find(".error").first().focus();
                var arr = [];
                var counter = 0;
                if(!empty){
                    input.each(function(){
                        arr[counter] = $(this).val();
                        counter++;
                        $(this).parent("td").html($(this).val());
                    });
                    $(this).parents("tr").find(".updateDebit, .edit").toggle();
                    $(".add-Debit").removeAttr("disabled");
                    $.ajax({
                        url : "admin.php",
                        type : "POST",
                        async : false,
                        cache : false,
                        data : {
                            update_debit : 1,
                            id : id,
                            nomor : arr[0],
                            nama : arr[1],
                            namabank : arr[2],
                            tgl : arr[3],
                            saldo : arr[4]
                        },
                        success: function(result){
                        }
                    });
                    //showCustomer();
                }       
            });
            $(".add-Kredit").click(function(){
                $(this).attr("disabled", "disabled");
                var index = $(".tableKredit .kredit tr:last-child").index();
                var row = '<tr>' +
                '<td><input type="text" class="form-control" name="nomor" id="nomor"></td>' +
                '<td><input type="text" class="form-control" name="nama" id="nama"></td>' +
                '<td><input type="text" class="form-control" name="namabank" id="namabank"></td>' +
                '<td class="tgl"><input class="datepicker tgl" width="76"></td>' +
                '<td><input type="number" class="form-control" name="tiga_digit" id="tiga_digit"></td>' +
                '<td><input type="number" class="form-control" name="tagihan" id="tagihan"></td>' +
                '<td>' + $(".tableKredit td:last-child").html() + '</td>' +
                '</tr>';
                $(".tableKredit").append(row);     
                $(".tableKredit .kredit tr").eq(index + 1).find(".addKredit, .edit").toggle();
                tdpicker();
            });
            $(document).on("click", ".addKredit", function(){
                var empty = false;
                var input = $(this).parents("tr").find('input[type="text"]');
                input.each(function(){
                    if(!$(this).val()){
                        $(this).addClass("error");
                        empty = true;
                    } else{
                        $(this).removeClass("error");
                    }
                });
                $(this).parents("tr").find(".error").first().focus();
                var arr = [];
                var counter = 0;
                if(!empty){
                    input.each(function(){
                        arr[counter] = $(this).val();
                        counter++;
                        $(this).parent("td").html($(this).val());
                    });
                    hari = $('input.tgl').val();
                    var tiga_digit = $('#tiga_digit').val();
                    var tagihan = $('#tagihan').val();
                    $(this).parents("tr").find(".addKredit, .edit").toggle();
                    $(".add-Kredit").removeAttr("disabled");
                    $.ajax({
                        url : "admin.php",
                        type : "POST",
                        async : false,
                        cache : false,
                        data : {
                            add_kredit : 1,
                            nomor : arr[0],
                            nama : arr[1],
                            namabank : arr[2],
                            tgl : hari,
                            tiga_digit : tiga_digit,
                            tagihan : tagihan
                        },
                        success: function(result){
                            // showCustomer();
                        }
                    });
                    showKredit();
                }       
            });
            $(document).on("click", ".updateKredit", function(){
                id = $(this).closest('tr').children('td:first').attr('class');
                var empty = false;
                var input = $(this).parents("tr").find('input[type="text"]');
                input.each(function(){
                    if(!$(this).val()){
                        $(this).addClass("error");
                        empty = true;
                    } else{
                        $(this).removeClass("error");
                    }
                });
                $(this).parents("tr").find(".error").first().focus();
                var arr = [];
                var counter = 0;
                if(!empty){
                    input.each(function(){
                        arr[counter] = $(this).val();
                        counter++;
                        $(this).parent("td").html($(this).val());
                    });
                    $(this).parents("tr").find(".updateKredit, .edit").toggle();
                    $(".add-Kredit").removeAttr("disabled");
                    $.ajax({
                        url : "admin.php",
                        type : "POST",
                        async : false,
                        cache : false,
                        data : {
                            update_kredit : 1,
                            id : id,
                            nomor : arr[0],
                            nama : arr[1],
                            namabank : arr[2],
                            tgl : arr[3],
                            tiga_digit : arr[4],
                            tagihan : arr[5]
                        },
                        success: function(result){
                        }
                    });
                    //showCustomer();
                }       
            });
            $(".add-Jadwal").click(function(){
                $(this).attr("disabled", "disabled");
                var index = $(".tableJadwal .jadwal tr:last-child").index();
                var row = '<tr>' +
                '<td class="tgl"><input class="datepicker tgl" width="76"></td>' +
                '<td class="jambrangkat"><input class="timepicker jambrangkat" width="76"></td>' +
                '<td class="jamtiba"><input class="timepicker jamtiba" width="76"></td>' +
                '<td><input type="text" class="form-control" name="durasi" id="durasi"></td>' +
                '<td><input type="text" class="form-control" name="lokasiawal" id="lokasiawal"></td>' +
                '<td><input type="text" class="form-control" name="lokasitujuan" id="lokasitujuan"></td>' +
                '<td><input type="text" class="form-control" name="idpesawat" id="idpesawat"></td>' +
                '<td><input type="number" class="form-control" name="harga" id="harga" min="1"></td>' +
                '<td>' + $(".tableJadwal td:last-child").html() + '</td>' +
                '</tr>';
                $(".tableJadwal").append(row);     
                $(".tableJadwal .jadwal tr").eq(index + 1).find(".addJadwal, .edit").toggle();
                tdpicker();
            });
            $(document).on("click", ".addJadwal", function(){
                var empty = false;
                var input = $(this).parents("tr").find('input[type="text"]');
                input.each(function(){
                    if(!$(this).val()){
                        $(this).addClass("error");
                        empty = true;
                    } else{
                        $(this).removeClass("error");
                    }
                });
                $(this).parents("tr").find(".error").first().focus();
                var arr = [];
                var counter = 0;
                if(!empty){
                	hari = $('input.tgl').val();
                	waktub = $('input.jambrangkat').val();
    				waktut = $('input.jamtiba').val();
                    input.each(function(){
                        arr[counter] = $(this).val();
                        counter++;
                        $(this).parent("td").html($(this).val());
                    });
                    var harga = $('#harga').val();
                    $(this).parents("tr").find(".addJadwal, .edit").toggle();
                    $(".add-Jadwal").removeAttr("disabled");
                    $.ajax({
                        url : "admin.php",
                        type : "POST",
                        async : false,
                        cache : false,
                        data : {
                            add_jadwal : 1,
                            tgl : hari,
                            jambrangkat : waktub,
                            jamtiba : waktut,
                            durasi : arr[0],
                            lokasiawal : arr[1],
                            lokasitujuan : arr[2],
                            idpesawat : arr[3],
                            harga : harga
                        },
                        success: function(result){
                        	// alert(result);
                            // showCustomer();
                        }
                    });
                    showJadwal();
                }       
            });
            $(document).on("click", ".updateJadwal", function(){
                id = $(this).closest('tr').children('td:first').attr('class');
                var empty = false;
                var input = $(this).parents("tr").find('input[type="text"]');
                input.each(function(){
                    if(!$(this).val()){
                        $(this).addClass("error");
                        empty = true;
                    } else{
                        $(this).removeClass("error");
                    }
                });
                $(this).parents("tr").find(".error").first().focus();
                var arr = [];
                var counter = 0;
                if(!empty){
                    input.each(function(){
                        arr[counter] = $(this).val();
                        counter++;
                        $(this).parent("td").html($(this).val());
                    });
                    $(this).parents("tr").find(".updateJadwal, .edit").toggle();
                    $(".add-Jadwal").removeAttr("disabled");
                    $.ajax({
                        url : "admin.php",
                        type : "POST",
                        async : false,
                        cache : false,
                        data : {
                            update_jadwal : 1,
                            id : id,
                            tgl : arr[0],
                            jambrangkat : arr[1],
                            jamtiba : arr[2],
                            durasi : arr[3],
                            lokasiawal : arr[4],
                            lokasitujuan : arr[5],
                            idpesawat : arr[6],
                            harga : arr[7]
                        },
                        success: function(result){
                        }
                    });
                    //showCustomer();
                }       
            });
            $(document).on("click", ".delete", function(){
                id = $(this).closest('tr').children('td:first').attr('class');
                table = $(this).parents("table").attr("id");
                $(this).parents("tr").remove();
                btn = ".add-"+table;
                $(btn).removeAttr("disabled");
                table = table.toLowerCase();
                $.ajax({
                    url : "admin.php",
                    type : "POST",
                    async : false,
                    cache : false,
                    data : {
                        delete_table : 1,
                        table : table,
                        id : id
                    },
                    success: function(result){
                    }
                });
            });
            $(document).on("click", ".edit", function(){
                $(this).parents("tr").find("td:not(:last-child)").each(function(){
                    $(this).html('<input type="text" class="form-control" value="' + $(this).text() + '">');
                });
                table = $(this).parents("table").attr("id");
                $(this).parents("tr").find(".update"+table+", .edit").toggle();
                btn = ".add-"+table;
                $(btn).attr("disabled", "disabled");
            });
        });
        function showdata(a){
            $(".judul").html(a);
        };
        function showCustomer(){
            $.ajax({
                url : "admin.php",
                type : "POST",
                async : false,
                cache : false,
                data : {
                    show_customer : 1
                },
                success: function(result){
                    $(".customer").html(result);
                }
            });
        };
        function showAirline(){
            $.ajax({
                url : "admin.php",
                type : "POST",
                async : false,
                cache : false,
                data : {
                    show_airline : 1
                },
                success: function(result){
                    $(".airline").html(result);
                }
            });
        };
        function showPesawat(){
            $.ajax({
                url : "admin.php",
                type : "POST",
                async : false,
                cache : false,
                data : {
                    show_pesawat : 1
                },
                success: function(result){
                    $(".pesawat").html(result);
                }
            });
        };
        function showAirport(){
            $.ajax({
                url : "admin.php",
                type : "POST",
                async : false,
                cache : false,
                data : {
                    show_airport : 1
                },
                success: function(result){
                    $(".airport").html(result);
                }
            });
        };
        function showJadwal(){
            $.ajax({
                url : "admin.php",
                type : "POST",
                async : false,
                cache : false,
                data : {
                    show_jadwal : 1
                },
                success: function(result){
                    $(".jadwal").html(result);
                }
            });
        };
        function showDebit(){
            $.ajax({
                url : "admin.php",
                type : "POST",
                async : false,
                cache : false,
                data : {
                    show_debit : 1
                },
                success: function(result){
                    $(".debit").html(result);
                }
            });
        };
        function showKredit(){
            $.ajax({
                url : "admin.php",
                type : "POST",
                async : false,
                cache : false,
                data : {
                    show_kredit : 1
                },
                success: function(result){
                    $(".kredit").html(result);
                }
            });
        };
        function tdpicker(){
            $('.datepicker').datepicker({
                uiLibrary: 'bootstrap4', showRightIcon: false,format: 'yyyy-mm-dd'
            });
            $('input.jambrangkat').timepicker({
                format: 'HH.MM'
            });
            $('input.jamtiba').timepicker({
                format: 'HH.MM'
            });
        }
    </script>
    <style>
        @import "https://fonts.googleapis.com/css?family=Poppins:300,400,500,600,700";
        body {
            font-family: 'Poppins', sans-serif;
            background: #E9ECEF;
        }

        p {
            font-family: 'Poppins', sans-serif;
            font-size: 1.1em;
            font-weight: 300;
            line-height: 1.7em;
            color: #999;
        }

        a, a:hover, a:focus {
            color: inherit;
            text-decoration: none;
            transition: all 0.3s;
        }

        .jumbotron {
            margin-left : 250px;
        }

        #sidebar {
            /* don't forget to add all the previously mentioned styles here too */
            transition: all 0.3s;
            width: 250px;
            position: fixed;
            top: 0;
            left: 0;
            height: 100vh;
            /*z-index: 999;*/
            background: #375cfc;
            color: #fff;
        }

        #sidebar .sidebar-header {
            padding: 10px ;
            text-align: center;
            background: #375cfc;
        }

        #sidebar ul.components {
            padding: 20px 0;
            border-bottom: 1px solid #47748b;
        }
        #sidebar button {           
            margin-left: 10px;
            text-align: center;
            width: 90%;
        }

        #sidebar ul p {
            color: #fff;
            padding: 10px;
        }

        #sidebar ul li a {
            padding: 10px;
            font-size: 1.1em;
            display: block;
        }
        #sidebar ul li a:hover {
            color: #7386D5;
            background: #fff;
        }

        #sidebar ul li.active > a, a[aria-expanded="true"] {
            color: #7386D5;
            background: white;
        }
        ul ul a {
            font-size: 0.9em !important;
            padding-left: 30px !important;
            background: #5172ff;
        }
        .wrapper {
            display: flex;
            width: 100%;
        }
        a[data-toggle="collapse"] {
            position: relative;
        }

        .dropdown-toggle::after {
            display: block;
            position: absolute;
            top: 50%;
            right: 20px;
            transform: translateY(-50%);
        }
        .btn {
          -webkit-transition: 0.2s;
          -moz-transition: 0.2s;
          -o-transition: 0.2s;
          -ms-transition: 0.2s;
          transition: 0.2s;
          -webkit-border-radius: 3px;
          border-radius: 3px;
        }
        .btn:hover {
          -webkit-border-radius: 10px;
          border-radius: 10px;
        }
        .btn > .fa,
        .btn > .im {
          margin: 0 5px;
        }
        .btn-primary {
          background: #68d8d8;
          border-color: #66D7D7;
        }
        .btn-primary:hover {
          background: #68d8d8;
          border-color: #66D7D7;
        }
        table {
            text-align: center;
        }
        .table-title .add-new {
            height: 30px;
            font-weight: bold;
            font-size: 12px;
            text-shadow: none;
            min-width: 100px;
            border-radius: 50px;
            line-height: 13px;
        }
        table.table td a {
            cursor: pointer;
            display: inline-block;
            margin: 0 5px;
            min-width: 24px;
        }
        table.table td a.add {
            color: #27C46B;
        }
        table.table td a.edit {
            color: #FFC107;
        }
        table.table td a.delete {
            color: #E34724;
        }
        table.table td .update {
            display: none;
        }
        table.table td .add {
            display: none;
        }
        table.table td a.add i {
            font-size: 24px;
            margin-right: -1px;
            position: relative;
            top: 3px;
        }
        table.table .form-control {
            height: 32px;
            line-height: 32px;
            box-shadow: none;
            border-radius: 2px;
        }
        table.table .form-control.error {
            border-color: #f50000;
        }
    </style>
</head>

<body>
    <!-- Popper.JS -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.0/umd/popper.min.js" integrity="sha384-cs/chFZiN24E4KMATLdqdvsezGxaGsi4hLGOzlXwp5UZB1LY//20VyM2taTB4QvJ" crossorigin="anonymous"></script>
    <!-- Bootstrap JS -->
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.0/js/bootstrap.min.js" integrity="sha384-uefMccjFJAIv6A+rW+L4AHf99KvxDjWSu1z9VI8SKNVmz4sk7buKt/6v9KI65qnm" crossorigin="anonymous"></script>
    <div class="wrapper">
    <!-- Sidebar -->
        <nav id="sidebar">
            <div class="sidebar-header">
                <img src="assets/logo_company.png" class="brand_logo" alt="Logo">
            </div>

            <ul class="list-unstyled components">
                <li>
                    <a href="#" name="Customer">Customer</a>
                </li>
                <li>
                    <a href="#" name="Airline">Airline</a>
                </li>
                <li>
                    <a href="#" name="Pesawat">Pesawat</a>
                </li>
                <li>
                    <a href="#" name="Airport">Airport</a>
                </li>
                <li class="dropdown">
                    <a href="#pageSubmenu" data-toggle="collapse" aria-expanded="false" class="dropdown-toggle toogle">Bank</a>
                    <ul class="collapse list-unstyled" id="pageSubmenu">
                        <li>
                            <a href="#" name="Bank Debit">Debit</a>
                        </li>
                        <li>
                            <a href="#" name="Bank Kredit">Kredit</a>
                        </li>
                    </ul>
                </li>
                <li>
                    <a href="#" name="Jadwal Penerbangan">Jadwal Penerbangan</a>
                </li>
                <!-- <li>
                    <a href="#" name="Kursi">Kursi</a>
                </li>
                <li>
                    <a href="#" name="Pesanan">Pesanan</a>
                </li> -->
            </ul>
            <form action="logout.php" method="post">
                <button type="submit" class="btn btn-primary logOut">Log Out</button>
            </form>
        </nav>
    </div>
    <div class="jumbotron jumbotron-fluid">
      <div class="container">
        <h1 class="welcome">Welcome, </h1> 
        <p class="judul"></p> 
        <div class="container Customer isi">
            <div class="table-wrapper">
                <div class="table-title">
                    <div class="row">
                        <div class="col-sm-4">
                            <button type="button" class="btn btn-info add-new add-Customer"><i class="fa fa-plus"></i> Add New</button>
                        </div>
                    </div>
                </div><br>
                <table class="table table-bordered tableCustomer" id="Customer">
                    <thead>
                        <tr>
                            <th>Username</th>
                            <th>Password</th>
                            <th>Email</th>
                            <th>No HP</th>
                            <th>Nama Lengkap</th>
                            <th>Saldo</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody class="customer"> 
                    </tbody>
                </table>
            </div>
        </div>
        <div class="container Airline isi">
            <div class="table-wrapper">
                <div class="table-title">
                    <div class="row">
                        <div class="col-sm-4">
                            <button type="button" class="btn btn-info add-new add-Airline"><i class="fa fa-plus"></i> Add New</button>
                        </div>
                    </div>
                </div><br>
                <table class="table table-bordered tableAirline" id="Airline">
                    <thead>
                        <tr>
                            <th>Nama</th>
                            <th>Kode</th>
                            <th>Foto</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody class="airline"> 
                    </tbody>
                </table>
            </div>
        </div>
        <div class="container Pesawat isi">
            <div class="table-wrapper">
                <div class="table-title">
                    <div class="row">
                        <div class="col-sm-4">
                            <button type="button" class="btn btn-info add-new add-Pesawat"><i class="fa fa-plus"></i> Add New</button>
                        </div>
                    </div>
                </div><br>
                <table class="table table-bordered tablePesawat" id="Pesawat">
                    <thead>
                        <tr>
                            <th>Kapasitas</th>
                            <th>ID Airline</th>
                            <th>Kode Pesawat</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody class="pesawat"> 
                    </tbody>
                </table>
            </div>
        </div>
        <div class="container Airport isi">
            <div class="table-wrapper">
                <div class="table-title">
                    <div class="row">
                        <div class="col-sm-4">
                            <button type="button" class="btn btn-info add-new add-Airport"><i class="fa fa-plus"></i> Add New</button>
                        </div>
                    </div>
                </div><br>
                <table class="table table-bordered tableAirport" id="Airport">
                    <thead>
                        <tr>
                            <th>Nama Airport</th>
                            <th>Kode Airport</th>
                            <th>Kota</th>
                            <th>Negara</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody class="airport"> 
                    </tbody>
                </table>
            </div>
        </div>
        <div class="container Debit isi">
            <div class="table-wrapper">
                <div class="table-title">
                    <div class="row">
                        <div class="col-sm-4">
                            <button type="button" class="btn btn-info add-new add-Debit"><i class="fa fa-plus"></i> Add New</button>
                        </div>
                    </div>
                </div><br>
                <table class="table table-bordered tableDebit" id="Debit">
                    <thead>
                        <tr>
                            <th>Nomor Kartu</th>
                            <th>Nama Pemilik</th>
                            <th>Nama Bank</th>
                            <th>Tanggal Valid</th>
                            <th>Saldo</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody class="debit"> 
                    </tbody>
                </table>
            </div>
        </div>
        <div class="container Kredit isi">
            <div class="table-wrapper">
                <div class="table-title">
                    <div class="row">
                        <div class="col-sm-4">
                            <button type="button" class="btn btn-info add-new add-Kredit"><i class="fa fa-plus"></i> Add New</button>
                        </div>
                    </div>
                </div><br>
                <table class="table table-bordered tableKredit" id="Kredit">
                    <thead>
                        <tr>
                            <th>Nomor Kartu</th>
                            <th>Nama Pemilik</th>
                            <th>Nama Bank</th>
                            <th>Tanggal Valid</th>
                            <th>Tiga Digit</th>
                            <th>Tagihan</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody class="kredit"> 
                    </tbody>
                </table>
            </div>
        </div>
        <div class="container JadwalPenerbangan isi">
            <div class="table-wrapper">
                <div class="table-title">
                    <div class="row">
                        <div class="col-sm-4">
                            <button type="button" class="btn btn-info add-new add-Jadwal"><i class="fa fa-plus"></i> Add New</button>
                        </div>
                    </div>
                </div><br>
                <table class="table table-bordered tableJadwal" id="Jadwal">
                    <thead>
                        <tr>
                            <th>Tanggal Penerbangan</th>
                            <th>Jam Berangkat</th>
                            <th>Jam Tiba</th>
                            <th>Durasi</th>
                            <th>Lokasi Awal</th>
                            <th>Lokasi Tujuan</th>
                            <th>ID Pesawat</th>
                            <th>Harga</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody class="jadwal"> 
                    </tbody>
                </table>
            </div>
        </div>
        <!-- <div class="container Kursi isi">
            <p>ini bagian kursi</p>
        </div>
        <div class="container Pesanan isi">
            <p>ini bagian pesanan</p>
        </div> -->
      </div>
    </div>
</body>
</html>