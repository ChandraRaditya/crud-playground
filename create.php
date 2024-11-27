<?php
include("db.php");

if (isset($_GET["op"])) {
    $method = $_GET["op"];
} else {
    $method = "";
}

$nama = "";
$nim = "";
$prodi = "";


if ($method == "insert") {
}

if ($method == "update") {
    $stmt = $mysqli->prepare($mahasiswaById);
    $stmt->bind_param("s", $_GET["nim"]);
    $stmt->execute();
    $result = $stmt->get_result();
    $data = $result->fetch_assoc();
    if ($result->num_rows == 0) {
        echo "data tidak ada";
        $mysqli->close();
        return;
    }

    $nama = $data["nama"];
    $nim  = $data["nim"];
    $prodi = $data["prodi_id"];

    echo $nama;
}

if (isset($_POST["simpan"])) {

    $nama = $_POST["nama"];
    $nim = $_POST["nim"];
    $prodi = $_POST["prodi"];

    if ($nama && $nim && $prodi !== "") {
        if ($method === "update") {
            $stmtUpdate = $mysqli->prepare($mahasiswaUpdate);
            $stmtUpdate->bind_param("ssis", $nim, $nama, $prodi, $_GET["nim"]);
            if ($stmtUpdate->execute()) {
                echo "
            <script>
                alert(\"sudah terupdate\")
                window.location.href = \"index.php\"
            </script>";
            } else {
                echo "gagal update";
            }
        }

        if ($method === "insert") {
            $stmtInsert = $mysqli->prepare($mahasiswaInsert);
            $stmtInsert->bind_param("ssi", $nama, $nim, $prodi);
            if ($stmtInsert->execute()) {
                echo "
            <script>
                alert(\"sudah tersimpan\")
                window.location.href = \"index.php\"
            </script>";
            } else {
                echo "gagal update";
            }
        }
    } else {
        echo "
            <script>
                alert(\"harap isi dengan lengkap\")
            </script>";
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="create.css">
</head>

<body>
    <div class="create">
        <div class="create-container">
            <p class="create-title"><?php echo $method == "insert" ? "Insert Data" : "Update Data"; ?></p>
            <form method="post">
                <div class="container-input">
                    <label for="nim">Nim</label>
                    <input type="text" name="nim" id="nim" value="<?php echo $nim ?>" />
                </div>
                <div class="container-input">
                    <label for="nama">Name</label>
                    <input type="text" name="nama" id="nama" value="<?php echo $nama ?>" />
                </div>
                <div class="container-input">
                    <label for="prodi">Prodi</label>
                    <select name="prodi" id="prodi">
                        <option value="">--Please choose an option--</option>
                        <?php
                        $stmtProdi = $mysqli->prepare($prodiOption);
                        $stmtProdi->execute();
                        $result = $stmtProdi->get_result();
                        while ($data = $result->fetch_assoc()) {
                            $isSelected = $data["id"] == $prodi ? "selected" : "";

                        ?>
                            <option value="<?php echo $data["id"] ?>" <?php echo $isSelected ?>><?php echo $data["nama"] ?></option>
                        <?php }
                        ?>
                    </select>
                </div>
                <button name="simpan" type="submit"><?php echo $method == "insert" ? "Simpan" : "Update"; ?></button>
            </form>
        </div>
    </div>
</body>

</html>