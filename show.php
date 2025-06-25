<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "warranty";

$conn = new mysqli($servername, $username, $password, $dbname);
if ($conn->connect_error) {
    die(json_encode(["error" => "Connection failed: " . $conn->connect_error]));
}

// ใช้ JOIN เพื่อดึง model_name โดยตรง
$sql = "SELECT id, model_name FROM products";
$result = $conn->query($sql);
$models = [];

while ($row = $result->fetch_assoc()) {
    $models[] = $row;
}

$result = $conn->query($sql);

if (!$result) {
    die("Error in query: " . $conn->error);
}
?>

<!DOCTYPE html>
<html lang="th">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>ข้อมูลลูกค้า</title>
    <style>
        * {
            box-sizing: border-box;
            margin: 0;
            padding: 0;
            font-family: Arial, sans-serif;
        }

        body {
            background-color: #f4f4f4;
            padding: 20px;
        }

        .container {
            max-width: 1200px;
            margin: auto;
            background: white;
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            overflow-x: auto;
        }

        h2 {
            text-align: center;
            margin-bottom: 20px;
            color: #333;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            min-width: 800px;
        }

        th, td {
            border: 1px solid #ddd;
            padding: 12px;
            text-align: left;
            white-space: nowrap;
        }

        th {
            background-color: #4CAF50;
            color: white;
        }

        tr:nth-child(even) {
            background-color: #f9f9f9;
        }

        tr:hover {
            background-color: #f1f1f1;
        }

        .image-grid {
            display: flex;
            gap: 5px;
        }

        .image-grid img {
            width: 50px;
            height: 50px;
            object-fit: cover;
            border-radius: 8px;
            border: 1px solid #ddd;
        }
    </style>
</head>
<body>
    <div class="container">
        <h2>📋 รายการลูกค้า</h2>
        <table>
            <thead>
                <tr>
                    <th>ชื่อ</th>
                    <th>Email</th>
                    <th>โทรศัพท์</th>
                    <th>Serial</th>
                    <th>Model</th>
                    <th>รูปภาพ</th>
                    <th>วันที่ลงทะเบียน</th>
                </tr>
            </thead>
            <tbody>
                <?php while ($row = $result->fetch_assoc()): ?>
                <tr>
                    <td><?= htmlspecialchars($row["name"]) ?></td>
                    <td><?= htmlspecialchars($row["email"]) ?></td>
                    <td><?= htmlspecialchars($row["phone"]) ?></td>
                    <td><?= htmlspecialchars($row["serialnumber"]) ?></td>
                    <td><strong><?= htmlspecialchars($row["model"] ?? "ไม่พบข้อมูล") ?></strong></td>
                    <td>
                        <div class="image-grid">
                            <?php
                            $images = json_decode($row["image_paths"]);
                            if ($images &&  is_array($images)) {
                                foreach ($images as $image) {
                                    $imagePath = "uploads/" . $image; 
                                    if (file_exists($imagePath)) {
                                        echo "<img src='$imagePath' alt='Image'>";
                                    } else {
                                        echo "<p>ไม่พบภาพ</p>";
                                    }
                                }
                            } else {
                                echo "<p>ไม่มีรูปภาพ</p>";
                            }
                            ?>
                        </div>
                    </td>
                    <td><?= date("d/m/Y H:i", strtotime($row["created_at"])) ?></td>
                </tr>
                <?php endwhile; ?>
            </tbody>
        </table>
    </div>
</body>
</html>

<?php
$conn->close();
?>
