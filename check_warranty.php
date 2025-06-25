<?php include('config.php'); ?>
<!DOCTYPE html>
<html lang="th">

<head>
  <meta charset="UTF-8">
  <title>ตรวจสอบสถานะการรับประกัน</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
  <link href="https://fonts.googleapis.com/css2?family=Kanit:wght@300;400;600&display=swap" rel="stylesheet">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
  <link rel="stylesheet" href="register.css">

</head>

<body class="bg-light">
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
      <a href="https://www.youtube.com/@dprompsolarcell5223" target="_blank"><i class="fa-brands fa-youtube"></i></a>
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
        <li><img src="../pages/Img/2.png"><a href="https://dprompsolarcell.com/online/pages/p0005">คู่มือการใช้งาน</a>
        </li>
        <li><img src="../pages/Img/3.png"><a href="https://dprompsolarcell.com/online/pages/p0026">แคตตาล็อก</a>
        </li>
        <li><img src="../pages/Img/4.png"><a href="https://dprompsolarcell.com/online/pages/p0021">รับประกันสินค้า</a>
        </li>
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
            <li class="menu-item current-menu-item"><a href="https://" class="nav-top-link">รับประกันสินค้า</a>
            </li>
          </ul>
        </div>
      </div>
    </div>
  </div>



  <!-- Check Warranty -->
  <div class="container py-5">
    <div class="mb-5">
      <!-- หัวข้อหลัก -->
      <div class="bg-warning text-white py-3 px-4 d-inline-block rounded-0">
        <h2 class="fw-bold m-0">ตรวจสอบสถานะการรับประกันสินค้า</h2>
      </div>

      <!-- หัวข้อย่อย -->
      <div class="mt-4 d-flex align-items-center">
        <div class="border-start border-5 border-warning ps-3">
          <h5 class="text-dark m-0">เลือก Model Product และระบุเลข Serial Number Product</h5>
        </div>
      </div>
    </div>


    <div class="row justify-content-center">
      <div class="col-lg-10">
        <div class="card shadow-lg border-0 p-4 rounded-4">
          <form action="warranty_card.php" method="get" class="row g-3 align-items-center">

            <div class="col-md-5">
              <label for="model_input" class="form-label fw-semibold">Model Product</label>
              <input class="form-control" list="modelOptions" id="model_input" name="model"
                placeholder="ค้นหา Model Product..." required>
              <datalist id="modelOptions">
                <?php
                $result = mysqli_query($conn, "SELECT DISTINCT model FROM products");
                while ($row = mysqli_fetch_assoc($result)) {
                  echo "<option value='" . htmlspecialchars($row['model'], ENT_QUOTES) . "'>";
                }
                ?>
              </datalist>
            </div>



            <div class="col-md-5">
              <label for="serial" class="form-label fw-semibold">Serial Number</label>
              <input type="text" name="serial" id="serial" class="form-control" placeholder="กรอก Serial Number Product"
                required>
            </div>

            <div class="col-md-2 d-grid mt-4 pt-2">
              <button type="submit" class="btn btn-dark btn-lg rounded-3">ตรวจสอบ</button>
            </div>

          </form>
        </div>
      </div>
    </div>
  </div>



  <!-- Footer -->
  <footer class="footer">
    <div class="container-5 text-center">
      <img src="../pages/Img/dpromp logo web.png" alt="Logo" class="footer-logo">
      <p>ดีพร้อมพ์โซล่าร์เซลล์</p>
      <p>424/4 หมู่ 4 ตำบลชุมเห็ด อำเภอเมือง จังหวัดบุรีรัมย์ 31000</p>
      <p>เปิดทำการวันจันทร์ - เสาร์ เวลา 08.00 - 16.30 น.</p>
      <div class="footer-contact">
        <i class="fa-solid fa-phone"></i> 064 - 202 - 4009 &nbsp;&nbsp;
        <i class="fa-solid fa-envelope"></i> <a href="https://www.dprompsolarcell.com">dprompsolarcell.com</a>
      </div>
    </div>
  </footer>

</body>

</html>