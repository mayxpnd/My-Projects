$(document).ready(function () {
    const wrapper = $(".wrapper");
    const selectBtn = $(".select-btn");
    const modelList = $(".model");
    const searchInput = $(".search input");

    console.log("jQuery is ready!");

    // เปิด/ปิด dropdown เมื่อกดปุ่ม
    selectBtn.on("click", function () {
        wrapper.toggleClass("active");
    });

    // โหลดข้อมูล Model
    function displayModels(searchValue = "") {
        $.ajax({
            url: "model.php",
            type: "POST",
            data: { value: searchValue },
            dataType: "json",
            success: function (data) {
                console.log("📌 ข้อมูล Model ที่ได้จาก PHP:", data);
                let optionsHtml = "";
                if (data.length > 0) {
                    data.forEach(function (product) {
                        optionsHtml += `<li data-id="${product.model_id}">${product.model_name}</li>`;
                    });
                } else {
                    optionsHtml = `<li class="no-results">ไม่พบข้อมูล</li>`;
                }
                modelList.html(optionsHtml);
            },
            error: function (jqXHR, textStatus, errorThrown) {
                console.error("❌ Error: ", textStatus, errorThrown);
                console.log("📌 Response Text:", jqXHR.responseText);
            },
        });
    }

    // โหลดข้อมูล Model ตอนเริ่มต้น
    displayModels();

    // ค้นหา Model ขณะพิมพ์
    let searchTimeout;
    searchInput.on("input", function () {
        let searchValue = $(this).val();
        
        // Clear timeout if any
        clearTimeout(searchTimeout);

        // Set timeout to delay search
        searchTimeout = setTimeout(function () {
            displayModels(searchValue);
        }, 500); // Delay 500ms before sending the request
    });

    // เลือก Model
    $(document).on("click", ".model li", function () {
        let selectedText = $(this).text();
        let selectedId = $(this).data("id");

        $(".select-btn span").text(selectedText);
        $("#model_id").val(selectedId);
        wrapper.removeClass("active");
    });

    $(document).on("click", function (e) {
        if (!wrapper.is(e.target) && wrapper.has(e.target).length === 0) {
            wrapper.removeClass("active"); // ปิด dropdown
        }
    });
    
    // อัปโหลดฟอร์ม
    $(document).on("submit", "#uploadForm", function (e) {
        e.preventDefault();

        var formData = new FormData(this);

        let modelId = $("#model_id").val();
        if (!modelId) {
            alert("กรุณาเลือก Model ให้ถูกต้อง");
            return;
        }

        console.log("📌 model_id ก่อนส่ง: ", $("#model_id").val());
        formData.append("model_id", modelId);

        // ปิดปุ่มส่งข้อมูลในระหว่างที่กำลังส่ง
        $("button[type='submit']").prop("disabled", true);
        $("#response").html("กำลังอัปโหลด...");

        $.ajax({
            url: "upload.php",
            type: "POST",
            data: formData,
            processData: false,
            contentType: false,
            dataType: "json",
            success: function (response) {
                console.log("✅ Response จาก upload.php: ", response);
                $("#response").html("Response: " + JSON.stringify(response));
            },
            error: function (jqXHR, textStatus, errorThrown) {
                console.error("❌ Error: " + textStatus + ", " + errorThrown);
                $("#response").html("เกิดข้อผิดพลาดในการอัปโหลด");
            },
            complete: function () {
                // เปิดปุ่มส่งข้อมูลหลังจากการส่งเสร็จสิ้น
                $("button[type='submit']").prop("disabled", false);
            }
        });
    });
});