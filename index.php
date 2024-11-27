<?php
include("db.php");

$method = "";

if (isset($_GET["op"])) {
    $method = $_GET["op"];
}

if ($method == "delete") {
    $stmt = $mysqli->prepare($mahasiswaDelete);
    $stmt->bind_param("s", $_GET["nim"]);
    $stmt->execute();
    $stmt->close();
}

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="index.css">
</head>

<body>
    <div class="home">
        <div class="home-container">
            <h1 class="title">Table Data Mahasiswa</h1>
            <table>
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Nim</th>
                        <th>Nama</th>
                        <th>Prodi</th>
                        <th>Fakultas</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $stmt = $mysqli->prepare($mahasiswaAll);
                    $stmt->execute();
                    $result = $stmt->get_result();
                    $urut = 1;
                    while ($data = $result->fetch_assoc()) {
                    ?>
                        <tr>
                            <td><?php echo $urut++; ?></td>
                            <td><?php echo $data["nim"]; ?></td>
                            <td><?php echo $data["nama"]; ?></td>
                            <td><?php echo $data["prodi"]; ?></td>
                            <td><?php echo $data["fakultas"]; ?></td>
                            <td class="action-container">
                                <a href="create.php?op=update&nim=<?php echo $data["nim"] ?>">
                                    <button class="update-button button-action">Update</button>
                                </a>
                                <a href="index.php?op=delete&nim=<?php echo $data["nim"] ?>">
                                    <button class="delete-button button-action">Delete</button>
                                </a>
                            </td>
                        </tr>
                    <?php
                    }
                    $stmt->close();
                    ?>
                </tbody>
            </table>
            <a href="create.php?op=insert">
                <button class="update-button button-action">Insert</button>
            </a>
        </div>
    </div>
</body>


</html>