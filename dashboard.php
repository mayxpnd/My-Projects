<div class="container-fluid">
    
    <!-- สรุปข้อมูล -->
    <div class="row">
        <div class="col-md-4">
            <div class="card summary-card">
                <div class="card-body">
                    <h5><i class="bi bi-hdd-network"></i> อุปกรณ์ทั้งหมด</h5>
                    <h2 id="totalDevices">0</h2>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="card summary-card">
                <div class="card-body">
                    <h5><i class="bi bi-bell"></i> แจ้งเตือนทั้งหมด</h5>
                    <h2 id="totalAlerts">0</h2>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="card summary-card">
                <div class="card-body">
                    <h5><i class="bi bi-person-circle"></i> ผู้ใช้ออนไลน์</h5>
                    <h2 id="onlineUsers">0</h2>
                </div>
            </div>
        </div>
    </div>

    <!-- ผู้ใช้ออนไลน์ -->
    <div class="row mt-4">
        <div class="col-md-6">
            <div class="table-container">
                <table class="table table-borderless">
                    <thead>
                        <tr>
                            <th>DEVICE CODE/DEVICE NAME</th>
                            <th>STATUS</th>
                            <th>ACTIONS</th>
                        </tr>
                    </thead>
                    <tbody id="deviceTableBody">
                        <tr>
                            <td colspan="4" class="text-center text-muted">⏳ กำลังโหลดข้อมูล...</td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>

        <div class="col-md-6">
            <div class="card online-card">
                <div class="card-header">
                    <h5><i class="bi bi-people"></i> ผู้ใช้ออนไลน์</h5>
                </div>
                <div class="card-body">
                    
                </div>
            </div>
        </div>
    </div>
</div>

