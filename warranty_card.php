<?php
include('config.php');

if (isset($_GET['serial']) && isset($_GET['model'])) {
    $serial = mysqli_real_escape_string($conn, $_GET['serial']);
    $model = mysqli_real_escape_string($conn, $_GET['model']);

    $sql = "SELECT * FROM warranty_registration 
            WHERE serial_numbers LIKE '%$serial%' 
            AND model = '$model'";
} elseif (isset($_GET['id'])) {
    $id = $_GET['id'];
    $sql = "SELECT * FROM warranty_registration WHERE id = '$id'";
} else {
    echo "<script>alert('ไม่พบข้อมูลที่ต้องการ'); window.location='check_warranty.php';</script>";
    exit;
}

$result = mysqli_query($conn, $sql);
$row = mysqli_fetch_assoc($result);

if (!$row) {
    echo "<script>alert('ไม่พบข้อมูล Serial หรือ Model นี้ในระบบ'); window.location='check_warranty.php';</script>";
    exit;
}

// ... แสดงผลข้อมูลตามปกติ ...
?>



<!DOCTYPE html>
<html lang="th">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ใบรับประกันสินค้า</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Kanit:wght@300;400;600&display=swap" rel="stylesheet">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.13/js/select2.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.5.0/font/bootstrap-icons.css" rel="stylesheet">
    <link rel="stylesheet" href="warranty.css">

</head>

<body>

    <!-- แถบด้านบน -->
    <div class="top-bar d-flex justify-content-between align-items-center px-3">
        <div class="company-name text-start text-md-start text-center">
            ดีพร้อมพ์โซล่าร์เซลล์
        </div>
        <div class="open-hours d-none d-md-block text-center flex-grow-1">
            เปิดทำการวันจันทร์ - เสาร์ เวลา 08.00 - 16.30 น.
        </div>
        <div class="social-icons text-end">
            <a href="https://www.facebook.com/profile.php?id=100064319395117&locale=th_TH" target="_blank"><i
                    class="fa-brands fa-facebook"></i></a>
            <a href="https://www.dprompsolarcell.com"><i class="fa-solid fa-envelope"></i></a>
            <a href="tel:0642024009"><i class="fa-solid fa-phone"></i></a>
            <a href="https://www.youtube.com/@dprompsolarcell5223" target="_blank"><i
                    class="fa-brands fa-youtube"></i></a>
        </div>
    </div>

    <div class="main-content">
        <!-- Navbar -->
        <nav class="navbar">
            <div class="container-1 d-flex align-items-center justify-content-between">
                <!-- โลโก้ -->
                <a class="navbar-brand" href="#">
                    <img src="../pages/Img/dpromp logo web.png" alt="Logo" class="logo">
                </a>
            </div>

            <!-- Hamburger Menu -->
            <div class="hamburger js-hamburger">
                <span></span>
                <span></span>
                <span></span>
            </div>
        </nav>

        <!-- เมนูที่แสดงเมื่อกด Hamburger -->
        <div class="mobile-menu">
            <button class="close-menu">&times;</button>
            <ul class="menu-list">
                <li><img src="../pages/Img/1.png"><a href="https://www.dprompsolarcell.com/">สินค้า</a></li>
                <li><img src="../pages/Img/2.png"><a
                        href="https://dprompsolarcell.com/online/pages/p0005">คู่มือการใช้งาน</a></li>
                <li><img src="../pages/Img/3.png"><a href="https://dprompsolarcell.com/online/pages/p0026">แคตตาล็อก</a>
                </li>
                <li><img src="../pages/Img/4.png"><a
                        href="https://dprompsolarcell.com/online/pages/p0021">รับประกันสินค้า</a></li>
            </ul>
        </div>



        <!-- Wide-nav -->
        <div class="header-bottom wide-nav flex-has-center " id="wide-nav">
            <div class="flex-row container-3">
                <div class="flex-col flex-center">
                    <ul
                        class="nav header-nav header-bottom-nav nav-center nav-line-bottom nav-size-medium nav-uppercase nav-prompts-overlay">
                        <li id="menu-item-7083"
                            class="menu-item menu-item-type-post_type menu-item-object-page menu-item-has-children has-dropdown">
                            <a href="https://" class="nav-top-link" aria-expanded="false" aria-haspopup="menu">
                                สินค้า
                                <i class="icon-angle-down"></i>
                            </a>
                            <ul class="sub-menu nav-dropdown nav-dropdown-bold">
                                <li class="item"><a href="https://">ปั๊มบาดาลโซล่าร์เซลล์</a></li>
                                <li class="item"><a href="https://">ปั๊มหอยโข่งโซล่าร์เซลล์</a></li>
                                <li class="item"><a href="https://">ปั๊มน้ำพุโซล่าร์เซลล์</a></li>
                                <li class="item"><a href="https://">ปั๊มซัมเมอร์สโซล่าร์เซลล์</a></li>
                                <li class="item"><a href="https://">ปั๊มเพลาลอยโซล่าร์เซลล์</a></li>
                            </ul>
                        </li>
                        <li id="menu-item-8838"
                            class="menu-item menu-item-type-post_type menu-item-object-page menu-item-has-children has-dropdown">
                            <a href="https://" class="nav-top-link" aria-expanded="false" aria-haspopup="menu">
                                คู่มือการใช้งาน
                                <i class="icon-angle-down"></i>
                            </a>
                            <ul class="sub-menu nav-dropdown nav-dropdown-bold">
                                <li class="item"><a href="https://">คู่มือแก้ไขปัญหาเบื้องต้น</a>
                                </li>
                                <li class="item"><a href="https://">คลิปการต่อใช้งาน</a>
                                </li>
                            </ul>
                        </li>
                        <li class="menu-item"><a href="https://" class="nav-top-link">แคตตาล็อก</a></li>
                        <li class="menu-item current-menu-item"><a href="https://"
                                class="nav-top-link">รับประกันสินค้า</a>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </div>

    <!-- ใบรับประกันสินค้า start -->
    <div class="container my-5">
        <div class="row g-4 align-items-stretch">

            <!-- MainImage -->
            <div class="col-md-6 d-flex">
                <div class="card border-0 shadow rounded-4 p-3 w-100 h-100">
                    <?php
                    $images = explode(',', $row['images']);
                    if (!empty($images[0])) {
                        echo "

            <div class='main-image-wrapper mb-3'>
              <img id='mainImage' src='" . htmlspecialchars($images[0]) . "' class='img-fluid rounded-3 shadow-sm'  alt='Product Image'>
            </div>";

                    }
                    ?>

                    <!-- Thumbnail -->
                    <div class="thumbnail-scroll d-flex overflow-auto gap-2 px-1" style="scroll-behavior: smooth;">
                        <?php
                        foreach ($images as $index => $image) {
                            $activeClass = $index === 0 ? 'border-warning border-2' : '';
                            echo "
      <img src='" . htmlspecialchars($image) . "' 
           class='thumbnail img-thumbnail $activeClass rounded shadow-sm' 
           alt='Thumbnail " . ($index + 1) . "'>";
                        }
                        ?>
                    </div>


                </div>
            </div>

            <!-- รายละเอียดใบรับประกัน -->
            <div class="col-md-6 warranty-col d-flex flex-column">
                <div class="card warranty-card shadow-lg border-0 rounded-4 p-4 w-100 h-auto h-md-100">
                    <h4 class="mb-4 text-dark warranty-info">ข้อมูลใบรับประกัน</h4>
                    <ul class="list-unstyled lh-lg warranty-info">
                        <li><strong>ชื่อ :</strong> <?php echo htmlspecialchars($row['name']); ?></li>
                        <li><strong>อีเมล :</strong> <?php echo htmlspecialchars($row['email']); ?></li>
                        <li><strong>เบอร์โทร :</strong> <?php echo htmlspecialchars($row['phone']); ?></li>
                        <li><strong>Serial Numbers :</strong> <?php echo htmlspecialchars($row['serial_numbers']); ?>
                        </li>
                        <li><strong>Model :</strong> <?php echo htmlspecialchars($row['model']); ?></li>
                        <li><strong>วันที่ซื้อ :</strong> <?php echo htmlspecialchars($row['purchase_date']); ?></li>
                    </ul>
                    <div class="text-end mt-4 warranty-info">
                        <a href="index.html" class="btn btn-dark px-4 py-2 rounded-pill shadow-sm">
                            กลับหน้าหลัก
                        </a>
                    </div>
                </div>
            </div>


        </div>
    </div>

    <script>
        document.addEventListener("DOMContentLoaded", function () {
            const hamburger = document.querySelector(".js-hamburger");
            const mobileMenu = document.querySelector(".mobile-menu");
            const closeMenu = document.querySelector(".close-menu");
            hamburger.addEventListener("click", function () {
                mobileMenu.classList.toggle("active");
            });
            closeMenu.addEventListener("click", function () {
                mobileMenu.classList.remove("active");
            });
        });
    </script>


    <script>
        const thumbnails = document.querySelectorAll('.thumbnail');
        const mainImage = document.getElementById('mainImage');

        thumbnails.forEach((thumb, index) => {
            thumb.addEventListener('click', () => {
                mainImage.src = thumb.src;
                thumbnails.forEach(t => t.classList.remove('border-warning', 'border-2', 'active'));
                thumb.classList.add('border-warning', 'border-2', 'active');
            });
        });
    </script>

    <script>
        const thumbnailScroll = document.querySelector('.thumbnail-scroll');

        thumbnailScroll.addEventListener('wheel', function (e) {
            e.preventDefault();
            this.scrollLeft += e.deltaY;
        }, { passive: false });
    </script>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>