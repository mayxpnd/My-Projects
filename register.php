<?php
include('config.php');
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = $_POST['name'];
    $email = $_POST['email'];
    $phone = $_POST['phone'];
    $serialNumbers = implode(',', $_POST['serial_numbers']);
    $model = $_POST['model'];
    $purchaseDate = $_POST['purchase_date'];
    $uploadedImages = []; // <-- ตั้งตัวแปรให้ถูกชื่อ
    $upload_dir = 'uploads/';
    if (!empty($_FILES['images']['name'][0])) {
        foreach ($_FILES['images']['tmp_name'] as $key => $tmp_name) {
            $file_name = basename($_FILES['images']['name'][$key]);
            $file_path = $upload_dir . $file_name;
            // ตรวจสอบและย้ายไฟล์
            if (move_uploaded_file($tmp_name, $file_path)) {
                $uploadedImages[] = $file_path;
            }
        }
    }
    // Escape ค่าก่อน query เพื่อป้องกัน SQL Injection (ควรใช้ prepared statement ในระยะยาว)
    $escaped_name = mysqli_real_escape_string($conn, $name);
    $escaped_email = mysqli_real_escape_string($conn, $email);
    $escaped_phone = mysqli_real_escape_string($conn, $phone);
    $escaped_serial = mysqli_real_escape_string($conn, $serialNumbers);
    $escaped_model = mysqli_real_escape_string($conn, $model);
    $escaped_date = mysqli_real_escape_string($conn, $purchaseDate);
    $escaped_images = mysqli_real_escape_string($conn, implode(',', $uploadedImages));
    $sql = "INSERT INTO warranty_registration
            (name, email, phone, serial_numbers, model, purchase_date, images)
            VALUES
            ('$escaped_name', '$escaped_email', '$escaped_phone', '$escaped_serial',
             '$escaped_model', '$escaped_date', '$escaped_images')";
    if (mysqli_query($conn, $sql)) {
        echo "<script>alert('ลงทะเบียนรับประกันสินค้าสำเร็จ');
              window.location='warranty_card.php?id=" . mysqli_insert_id($conn) . "';</script>";
    } else {
        echo "<script>alert('เกิดข้อผิดพลาดในการลงทะเบียน');</script>";
    }
}
?>




<!DOCTYPE html>
<html lang="th">




<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ลงทะเบียนรับประกันสินค้า</title>
    <link href="https://fonts.googleapis.com/css2?family=Mitr:wght@300;400;600&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Kanit:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Prompt:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <!-- jQuery -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <!-- Bootstrap 5 (ต้องใช้เวอร์ชันนี้ให้ตรงกับ bootstrap-select) -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <!--<script src="https://cdn.jsdelivr.net/npm/bootstrap-select@1.14.0-beta3/dist/js/bootstrap-select.min.js"></script>-->
    <!-- FontAwesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Bootstrap Select CSS
    <link rel="stylesheet"
        href="https://cdn.jsdelivr.net/npm/bootstrap-select@1.14.0-beta3/dist/css/bootstrap-select.min.css">-->
    <link rel="stylesheet" href="../pages/register2.css">
</head>




<body>




    <!-- แถบที่ 1 -->
    <div class="top-bar">
        <div class="top-bar-column">
            <p>ดีพร้อมพ์โซล่าร์เซลล์</p>
            <p>เปิดทำการวันจันทร์ - เสาร์ เวลา 08.00 - 16.30 น.</p>
            <div class="top-bar-icons">
                <a href="https://www.facebook.com/profile.php?id=100064319395117&locale=th_TH" target="_blank">
                    <i class="fa-brands fa-facebook"></i></a>
                <a href="https://www.dprompsolarcell.com" target="_blank">
                    <i class="fa-solid fa-envelope"></i></a>
                <a href="tel:0642024009" target="_blank">
                    <i class="fa-solid fa-phone"></i></a>
                <a href="https://www.youtube.com/@dprompsolarcell5223" target="_blank">
                    <i class="fa-brands fa-youtube"></i></a>
            </div>
        </div>
    </div>


    <!-- แถบที่ 2 -->
    <nav>
        <div class="nav-item-col" id="navItem">




            <!-- สินค้า -->
            <div class="menu-item-products">
                <button class="nav-btn" id="btn-products" onclick="toggleDropdown('dropdown-products')">สินค้า</button>
                <div class="dropdown" id="dropdown-products">
                    <ul class="nav-item dropdown-col">
                        <li class="dropdown-item has-submenu">
                            <a href="#" class="dropdown-link">ปั๊มน้ำโซล่าร์เซลล์</a>
                            <ul class="dropdown-item-submenu">
                                <li class="has-submenu-sub">
                                    <a href="#" class="dropdown-sub">ปั๊มบาดาลโซล่าร์เซลล์</a>
                                    <ul class="dropdown-item-submenu-sub">
                                        <li><a href="#">DC Blushless</a></li>
                                        <li><a href="#">AC/DC Hybrid</a></li>
                                        <li><a href="#">AC/DC Auto Select Mode</a></li>
                                        <li><a href="#">High Volte (HV)</a></li>
                                    </ul>
                                </li>
                                <li><a href="#" class="dropdown-sub">ปั๊มซัมเมอร์สไฟฟ้า</a></li>
                                <li class="has-submenu-sub">
                                    <a href="#" class="dropdown-sub">ปั๊มหอยโข่ง SCPM</a>
                                    <ul class="dropdown-item-submenu-sub">
                                        <li><a href="#">DC Blushless</a></li>
                                        <li><a href="#">AC/DC Auto Select Mode</a></li>
                                        <li><a href="#">High Volte (HV)</a></li>
                                    </ul>
                                </li>
                                <li><a href="#" class="dropdown-sub">ปั๊มน้ำพุ SA</a></li>
                                <li><a href="#" class="dropdown-sub">ปั๊มเพลาลอย SWP</a></li>
                                <li><a href="#" class="dropdown-sub">ปั๊มสระว่ายน้ำ SSP</a></li>
                                <li><a href="#" class="dropdown-sub">App type</a></li>
                            </ul>
                        </li>
                        <li class="dropdown-item has-submenu">
                            <a href="#" class="dropdown-link">แผงโซล่าร์เซลล์</a>
                            <ul class="dropdown-item-submenu">
                                <li><a href="#" class="dropdown-sub">Poly</a></li>
                                <li><a href="#" class="dropdown-sub">Mono Halfcell</a></li>
                            </ul>
                        </li>
                        <li class="dropdown-item has-submenu">
                            <a href="#" class="dropdown-link">Controller</a>
                        </li>
                        <li class="dropdown-item has-submenu">
                            <a href="#" class="dropdown-link">Inverter</a>
                            <ul class="dropdown-item-submenu">
                                <li><a href="#" class="dropdown-sub">On-Grid</a></li>
                                <li><a href="#" class="dropdown-sub">Off-Grid</a></li>
                                <li><a href="#" class="dropdown-sub">ชุดนอนนา</a></li>
                            </ul>
                        </li>
                        <li class="dropdown-item has-submenu">
                            <a href="#" class="dropdown-link">แอร์โซล่าร์เซลล์</a>
                        </li>
                    </ul>
                </div>
            </div>


            <!-- คู่มือการใช้งาน -->
            <div class="menu-item-manual">
                <button class="nav-btn" id="btn-manual"
                    onclick="toggleDropdown('dropdown-manual')">คู่มือการใช้งาน</button>
                <div class="dropdown" id="dropdown-manual">
                    <ul class="nav-item dropdown-col">
                        <li class="dropdown-item has-submenu">
                            <a href="#" class="dropdown-link">คู่มือแก้ไขปัญหาเบื้องต้น</a>
                        </li>
                        <li class="dropdown-item has-submenu">
                            <a href="#" class="dropdown-link">คลิปการต่อใช้งาน</a>
                        </li>
                        <li class="dropdown-item has-submenu">
                            <a href="#" class="dropdown-link">คลิปแนะนำสินค้า</a>
                        </li>
                    </ul>
                </div>
            </div>


            <!-- แคตตาล็อก -->
            <div class="menu-item-catalog">
                <button class="nav-btn" id="btn-catalog" onclick="toggleDropdown('dropdown-catalog')">แคตตาล็อก</button>
                <div class="dropdown" id="dropdown-catalog">
                    <ul class="nav-item dropdown-col">
                        <li class="dropdown-item has-submenu">
                            <a href="#" class="dropdown-link">ดาวน์โหลดแคตตาล็อก</a>
                        </li>
                    </ul>
                </div>
            </div>


            <!-- รับประกันสินค้า -->
            <div class="menu-item-warranty">
                <button class="nav-btn" id="btn-warranty"
                    onclick="toggleDropdown('dropdown-warranty')">เงื่อนไขการรับประกัน</button>
                <div class="dropdown" id="dropdown-warranty">
                    <ul class="nav-item dropdown-col">
                        <li class="dropdown-item has-submenu">
                            <a href="#" class="dropdown-link">สินค้า Handuro</a>
                        </li>
                        <li class="dropdown-item has-submenu">
                            <a href="#" class="dropdown-link">สินค้า Dpromp</a>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </nav>




    <!-- แถบที่ 2 เมนู -->
    <nav>
        <div class="hamburger js-hamburger">
            <span></span>
            <span></span>
            <span></span>
        </div>


        <!-- เมนูที่แสดงเมื่อกด Hamburger -->
        <div class="mobile-menu">
            <button class="close-menu">&times;</button>
            <ul class="menu-list">
                <li><img src="../pages/Img/1.png"><a href="https://www.dprompsolarcell.com/">สินค้า</a>
                </li>
                <li><img src="../pages/Img/2.png"><a
                        href="https://dprompsolarcell.com/online/pages/p0005">คู่มือการใช้งาน</a>
                </li>
                <li><img src="../pages/Img/3.png"><a href="https://dprompsolarcell.com/online/pages/p0026">แคตตาล็อก</a>
                </li>
                <li><img src="../pages/Img/4.png"><a
                        href="https://dprompsolarcell.com/online/pages/p0021">รับประกันสินค้า</a>
                </li>
            </ul>
        </div>
    </nav>




    <!-- รับประกัน start -->
    <div class="container-5">
        <form method="POST" action="register.php" enctype="multipart/form-data">
            <div class="row no-gutters">




                <!-- Card 1 -->
                <div class="col-md-6" id="card-1">
                    <img src="../pages/Img/ดีพร้อมพ์.png" alt="DPROMPSOLAR" class="card-img">
                    <div class="left-side">


                        <h5 class="card-title">Warranty Registration</h5>
                        <p class="card-text"></p>


                        <div class="multi-step-container">


                            <div class="step-circle active" data-step="1">
                                <svg class="circle-svg" viewBox="0 0 32 32">
                                    <circle class="circle" cx="16" cy="16" r="14"></circle>
                                </svg>
                                <div class="step-content">
                                    <span class="step-number">1</span>
                                    <span class="step-check">✔</span>
                                </div>
                                <label class="label active">ข้อมูลผู้ใช้งาน</label>
                            </div>


                            <div class="step-circle" data-step="2">
                                <svg class="circle-svg" viewBox="0 0 32 32">
                                    <circle class="circle" cx="16" cy="16" r="14"></circle>
                                </svg>
                                <div class="step-content">
                                    <span class="step-number">2</span>
                                    <span class="step-check">✔</span>
                                </div>
                                <label class="label">กรอกเลขซีเรียลสินค้า</label>
                            </div>


                            <div class="step-circle" data-step="3">
                                <svg class="circle-svg" viewBox="0 0 32 32">
                                    <circle class="circle" cx="16" cy="16" r="14"></circle>
                                </svg>
                                <div class="step-content">
                                    <span class="step-number">3</span>
                                    <span class="step-check">✔</span>
                                </div>
                                <label class="label">อัปโหลดรูปภาพ</label>
                            </div>


                            <div class="step-circle" data-step="4">
                                <svg class="circle-svg" viewBox="0 0 32 32">
                                    <circle class="circle" cx="16" cy="16" r="14"></circle>
                                </svg>
                                <div class="step-content">
                                    <span class="step-number">4</span>
                                    <span class="step-check">✔</span>
                                </div>
                                <label class="label">วันที่ซื้อสินค้า</label>
                            </div>


                            <div class="step-circle" data-step="5">
                                <svg class="circle-svg" viewBox="0 0 32 32">
                                    <circle class="circle" cx="16" cy="16" r="14"></circle>
                                </svg>
                                <div class="step-content">
                                    <span class="step-number">5</span>
                                    <span class="step-check">✔</span>
                                </div>
                                <label class="label">ยืนยันและส่งข้อมูล</label>
                            </div>


                        </div>
                    </div>
                </div>




                <!-- Card 2 -->
                <div class="col-md-6 p-0" id="card-2">
                    <div class="right-side">
                        <div id="slidePages" class="carousel slide" data-bs-ride="false">
                            <div class="carousel-inner">




                                <!-- Slide 1 
                                <div class="carousel-item active">
                                    <div class="d-flex">
                                        <div class="col-md-6">
                                            <h3>ข้อมูลผู้ใช้งาน</h3>


                                            <label for="firstname" class="form-label">
                                                กรอกชื่อ - นามสกุล
                                                เบอร์โทรศัพท์และที่อยู่อีเมลสำหรับติดต่อ ของลูกค้า
                                            </label>


                                            <div class="form-user">
                                                <div class="floating-label">
                                                    <input type="text" class="form-control" id="firstname"
                                                        name="firstname" placeholder="" required data-required="true">
                                                    <label for="firstname">
                                                        ชื่อ
                                                    </label>
                                                </div>


                                                <div class="floating-label">
                                                    <input type="text" class="form-control" id="lastname"
                                                        name="lastname" placeholder="" required data-required="true">
                                                    <label for="lastname">
                                                        นามสกุล
                                                    </label>
                                                </div>
                                            </div>


                                            <div class="form-contact">
                                                <div class="floating-label">
                                                    <input type="text" class="form-control" id="phone" name="phone"
                                                        placeholder="" required data-required="true">
                                                    <label for="phone">
                                                        เบอร์โทรศัพท์
                                                    </label>
                                                </div>
                                                <div class="floating-label">
                                                    <input type="email" class="form-control" id="email" name="email"
                                                        placeholder="" required data-required="true">
                                                    <label for="email">
                                                        อีเมล
                                                    </label>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>-->


                                <!-- Slide 2 -->
                                <div class="carousel-item">
                                    <div class="d-flex">


                                        <div class="col-md-6">
                                            <h3>Serial Number</h3>
                                            <label for="serial_numbers" class="form-label">
                                                กรอก Serial Number สินค้าและเลือก Model</label>
                                            </label>


                                            <div class="form-products-group">

                                                <!-- Serial Number -->
                                                <div class="form-serial">
                                                    <div class="floating-label">
                                                        <input type="text" id="serial_number" name="serial_number" required>
                                                        <label for="serial_number">Serial Number</label>
                                                    </div>
                                                </div>

                                                <!-- Model -->
                                                <div class="form-model">
                                                    <div class="floating-label">
                                                        <select id="model" name="model" placeholder="" required data-required="true">
                                                            <option value="" disabled selected hidden></option>
                                                            <?php
                                                            $conn = mysqli_connect("localhost", "root", "", "warranty_system");
                                                            if (!$conn) {
                                                                die("เชื่อมต่อฐานข้อมูลไม่สำเร็จ: " . mysqli_connect_error());
                                                            }
                                                            $result = mysqli_query($conn, "SELECT DISTINCT model FROM products ORDER BY model ASC");
                                                            while ($row = mysqli_fetch_assoc($result)) {
                                                                $model = htmlspecialchars($row['model'], ENT_QUOTES);
                                                                echo "<option value=\"$model\">$model</option>";
                                                            }
                                                            mysqli_close($conn);
                                                            ?>
                                                        </select>
                                                        <label for="model">Model</label>
                                                    </div>
                                                </div>

                                            </div>

                                        </div>


                                    </div>
                                </div>
                            </div>



                            <!-- Slide 3 -->
                            <div class="carousel-item">
                                <div class="d-flex">


                                    <div class="col-md-6 datepicker">
                                        <h3>ลงทะเบียนรับประกันสินค้า</h3>
                                        <label for="purchase_date"
                                            class="form-label">ระบุวันที่ซื้อสินค้าและอัปโหลดรูปภาพของสินค้า
                                            กรุณาตรวจสอบข้อมูลที่กรอกให้ถูกต้องก่อนส่ง</label>


                                        <div class="form-purchase">
                                            <input type="date" class="form-control" id="purchase_date"
                                                name="purchase_date" required data-required="true">
                                            <input type="file" class="form-control" name="images[]" multiple
                                                accept="image/*">
                                        </div>
                                    </div>
                                </div>
                            </div>


                            <!-- Slide 4 -->
                            <div class="carousel-item" style="display: none;" id="reg-success">
                                <div class="d-flex">
                                    <div class="col-md-6">
                                        <h3>ลงทะเบียนเสร็จสิ้น!</h3>
                                        <p>ลูกค้าลงทะเบียนการรับประกันสินค้าเสร็จสมบูรณ์
                                            ขอบคุณที่เลือกซื้อสินค้าของเรา</p>
                                    </div>
                                </div>
                            </div>
                        </div>


                        <div class="buttons">
                            <button id="nextStep" type="button" class="btn btn-primary">
                                Next
                            </button>
                        </div>


                        <button id="prevBtn" type="button" disabled class="btn btn-secondary" style="display: none;">
                            ย้อนกลับ
                        </button>


                        <button id="submitBtn" type="submit" class="btn btn-submit" style="display: none;">
                            ดูใบรับประกันสินค้า
                        </button>


                        <button type="button" class="btn btn-success" style="display: none;" onclick="document.getElementById('reg-success').style.display='block';">
                            ลงทะเบียนเสร็จสิ้น
                        </button>


                        <button type="button" class="btn btn-secondary" style="display: none;" onclick="window.location.href='../pages/'">
                            กลับหน้าหลัก
                        </button>


                    </div>
                </div>
            </div>
    </div>
    </div>
    </form>
    </div>
    <!-- รับประกัน end -->








    <!-- HidenMenu -->
    <script>
        document.addEventListener("DOMContentLoaded", function() {
            const hamburger = document.querySelector(".js-hamburger");
            const mobileMenu = document.querySelector(".mobile-menu");
            const closeMenu = document.querySelector(".close-menu");
            hamburger.addEventListener("click", function() {
                mobileMenu.classList.toggle("active");
            });
            closeMenu.addEventListener("click", function() {
                mobileMenu.classList.remove("active");
            });
        });
    </script>




    <!-- jQuery -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>


    <!-- Bootstrap Bundle -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>


    <!-- Bootstrap Select
    <script src="https://cdn.jsdelivr.net/npm/bootstrap-select@1.14.0-beta3/dist/js/bootstrap-select.min.js"></script>-->




    <script>
        document.addEventListener("DOMContentLoaded", function() {
            if ($('.selectpicker').length > 0) {
                $('.selectpicker').selectpicker('refresh');
            }
        });
    </script>






    <!-- NavMenu -->
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const navItem = document.getElementById("navItem");
            const dropdownProducts = document.getElementById("dropdown-products");
            const dropdownManual = document.getElementById("dropdown-manual");
            const dropdownCatalog = document.getElementById("dropdown-catalog");
            const dropdownWarranty = document.getElementById("dropdown-warranty");


            // toggle dropdown หลัก โดยส่ง id เฉพาะ
            window.toggleDropdown = function(id) {
                const dropdown = document.getElementById(id);
                const allDropdowns = document.querySelectorAll(".dropdown");


                allDropdowns.forEach(d => {
                    if (d !== dropdown) d.classList.remove("show");
                });


                dropdown.classList.toggle("show");
            };


            // ชี้เมาส์เข้า-ออกเมนูหลัก (ใช้เฉพาะ dropdownProducts)
            const menuProducts = document.querySelector(".menu-item-products");
            const menuManual = document.querySelector(".menu-item-manual");
            const menuCatalog = document.querySelector(".menu-item-catalog");
            const menuWarranty = document.querySelector(".menu-item-warranty");


            menuProducts.addEventListener("mouseenter", () => dropdownProducts.classList.add("show"));
            menuProducts.addEventListener("mouseleave", () => dropdownProducts.classList.remove("show"));


            menuManual.addEventListener("mouseenter", () => dropdownManual.classList.add("show"));
            menuManual.addEventListener("mouseleave", () => dropdownManual.classList.remove("show"));


            menuCatalog.addEventListener("mouseenter", () => dropdownCatalog.classList.add("show"));
            menuCatalog.addEventListener("mouseleave", () => dropdownCatalog.classList.remove("show"));


            menuWarranty.addEventListener("mouseenter", () => dropdownWarranty.classList.add("show"));
            menuWarranty.addEventListener("mouseleave", () => dropdownWarranty.classList.remove("show"));


            // เมนูย่อยระดับ 2
            document.querySelectorAll(".has-submenu-sub").forEach(item => {
                const subLink = item.querySelector(".dropdown-sub");
                const subMenu = item.querySelector(".dropdown-item-submenu-sub");


                if (subLink && subMenu) {
                    // toggle ด้วยคลิก
                    subLink.addEventListener("click", (e) => {
                        e.preventDefault();
                        e.stopPropagation();
                        const isShown = subMenu.classList.contains("show");


                        // ปิดทุกเมนูย่อยก่อน
                        document.querySelectorAll(".dropdown-item-submenu-sub").forEach(el => el.classList.remove("show"));


                        if (!isShown) subMenu.classList.add("show");
                    });


                    // แสดง/ซ่อน submenu เมื่อ hover
                    item.addEventListener("mouseenter", () => subMenu.classList.add("show"));
                    item.addEventListener("mouseleave", () => subMenu.classList.remove("show"));
                }
            });


            // คลิกนอกเมนู -> ปิดเมนูทั้งหมด
            document.addEventListener("click", function(e) {
                if (!navItem.contains(e.target)) {
                    dropdownProducts.classList.remove("show");
                    dropdownManual.classList.remove("show");
                    dropdownCatalog.classList.remove("show");
                    dropdownWarranty.classList.remove("show");
                    document.querySelectorAll(".dropdown-item-submenu").forEach(el => el.classList.remove("show"));
                    document.querySelectorAll(".dropdown-item-submenu-sub").forEach(el => el.classList.remove("show"));
                }
            });
        });
    </script>




    <!-- slidePages -->
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const carousel = document.querySelector('#slidePages');
            const items = carousel.querySelectorAll('.carousel-item');
            const submitBtn = document.querySelector('.btn-submit');
            const regSuccess = document.querySelector('#reg-success');
            const nextStep = document.querySelector('#nextStep');
            const prevBtn = document.querySelector('#prevBtn');
            const steps = document.querySelectorAll(".step-circle");
            const panels = document.querySelectorAll(".step-panel");

            let currentIndex = 0;
            let current = 0;

            function showSlide(index) {
                items.forEach((item, i) => {
                    item.classList.toggle('active', i === index);
                });

                submitBtn.style.display = index === items.length - 1 ? 'inline-block' : 'none';
                regSuccess.style.display = index === items.length - 1 ? 'block' : 'none';
                nextStep.style.display = index === items.length - 1 ? 'none' : 'inline-block';
                prevBtn.style.display = index > 0 ? 'inline-block' : 'none';
                prevBtn.disabled = index === 0;
            }

            function updateUI() {
                steps.forEach((step, index) => {
                    const label = step.querySelector('.label');
                    const check = step.querySelector('.step-check');
                    const number = step.querySelector('.step-number');

                    step.classList.remove("active", "completed");
                    label?.classList.remove("active");
                    check?.classList.remove("show");

                    if (index < current) {
                        step.classList.add("completed");
                        check?.classList.add("show");
                    } else if (index === current) {
                        step.classList.add("active");
                        label?.classList.add("active");
                    }
                });

                panels.forEach((panel, index) => {
                    panel.classList.toggle("active", index === current);
                });

                nextStep.textContent = current === steps.length - 1 ? "เสร็จสิ้น" : "ถัดไป";
            }

            function validateCurrentSlide() {
                const currentSlide = items[currentIndex];
                const inputs = currentSlide.querySelectorAll('input, select, textarea');
                let isValid = true;

                inputs.forEach(input => {
                    const isRequired = input.hasAttribute('required') || input.hasAttribute('data-required');
                    const isVisible = input.offsetParent !== null;

                    if (isRequired && !input.checkValidity() && isVisible) {
                        input.classList.add('is-invalid');
                        isValid = false;
                    } else {
                        input.classList.remove('is-invalid');
                    }
                });

                // โฟกัสช่องแรกที่ไม่ถูกต้อง
                if (!isValid) {
                    const firstInvalid = currentSlide.querySelector('.is-invalid');
                    if (firstInvalid) firstInvalid.focus();
                }

                return isValid;
            }

            // เริ่มต้น
            showSlide(currentIndex);
            updateUI();

            nextStep.addEventListener("click", () => {
                if (!validateCurrentSlide()) return;

                if (currentIndex < items.length - 1) {
                    currentIndex++;
                    current++;
                    showSlide(currentIndex);
                    updateUI();
                } else {
                    alert("Form submitted!");
                }
            });

            prevBtn.addEventListener("click", () => {
                if (currentIndex > 0) {
                    currentIndex--;
                    current--;
                    showSlide(currentIndex);
                    updateUI();
                }
            });

            // Enter key => ถัดไป
            items.forEach((item) => {
                const inputs = item.querySelectorAll('input, select, textarea');
                inputs.forEach(input => {
                    input.addEventListener('keypress', function(e) {
                        if (e.key === 'Enter') {
                            e.preventDefault();
                            if (currentIndex < items.length - 1) {
                                currentIndex++;
                                current++;
                                showSlide(currentIndex);
                                updateUI();
                            }
                        }
                    });

                    // ลบกรอบแดงเมื่อกรอกถูกต้อง
                    input.addEventListener('input', function() {
                        if (input.checkValidity()) {
                            input.classList.remove('is-invalid');
                        }
                    });

                    input.addEventListener('change', function() {
                        if (input.checkValidity()) {
                            input.classList.remove('is-invalid');
                        }
                    });
                });
            });
        });
    </script>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const fields = document.querySelectorAll('.floating-label input, .floating-label select');

            fields.forEach(field => {
                const parent = field.closest('.floating-label');

                const updateState = () => {
                    if (field.value.trim() !== '') {
                        parent.classList.add('has-value');
                    } else {
                        parent.classList.remove('has-value');
                    }
                };

                field.addEventListener('focus', () => {
                    parent.classList.add('is-focused');
                });

                field.addEventListener('blur', () => {
                    parent.classList.remove('is-focused');
                    updateState();
                });

                field.addEventListener('input', updateState);
                field.addEventListener('change', updateState);

                updateState(); // call once on load
            });
        });
    </script>









</body>


</html>