<?php
include 'db.php';

// Mendapatkan ID event dari URL
$eventId = $_GET['id'];

// Mendapatkan detail event dari database
$stmt = $conn->prepare("SELECT * FROM events WHERE id = ?");
$stmt->bind_param("i", $eventId);
$stmt->execute();
$result = $stmt->get_result();
$event = $result->fetch_assoc();
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Detail Event</title>

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">

    <!-- Custom CSS -->
    <link rel="stylesheet" href="css/detail.css">
    <style>
        .action-box {
            background-color: #f9f9f9;
            border-radius: 12px;
            padding: 20px;
        }

        .action-box button {
            border-radius: 8px;
        }

        .modal-content {
            border-radius: 15px;
        }

        .modal-header {
            border-bottom: none;
            background-color: #FFF9EB;
        }

        .modal-footer {
            border-top: none;
        }

        .btn-danger {
            background-color: #ff4d4d;
        }
    </style>
</head>

<body>
    <!-- Navbar -->
    <nav class="navbar navbar-expand-lg">
      <div class="container">
        <a class="navbar-brand logo" href="/eventku/dashboardEO/eo_dashboard.php">Eventku</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
          <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNav">
          <ul class="navbar-nav ms-auto">
            <li class="nav-item"><a class="nav-link" href="/eventku/dashboardEO/eo_dashboard.php">Home</a></li>
            <li class="nav-item"><a class="nav-link" href="/eventku/kelolaevent/dashboard.php">Kelola Event</a></li>
            <li class="nav-item"><a class="nav-link" href="/eventku/FAQ/FAQEO.php">FAQ & Support</a></li>
            <li class="nav-item">
              <div class="user-box d-flex align-items-center">
                <i class="fa-solid fa-user user-icon"></i>
                <span>EO</span>
              </div>
            </li>
          </ul>
        </div>
      </div>
    </nav>

    <!-- Content -->
    <div class="container mt-4">
        <h1 class="kelola-title mb-4">Detail Event</h1>
        <div class="row">
            <div class="col-md-4">
                <img src="<?= htmlspecialchars($event['image']) ?>" alt="Gambar Event" class="img-fluid rounded event-image">
            </div>
            <div class="col-md-5">
                <div class="event-details-card">
                    <span class="category-label"><?= htmlspecialchars($event['kategori']) ?></span>
                    <h2 class="event-title"><?= htmlspecialchars($event['title']) ?></h2>
                    <hr class="divider">
                    <div class="event-info">
                        <div class="event-details-row">
                            <p><i class="far fa-calendar"></i> <?= htmlspecialchars($event['date']) ?></p>
                            <p class="event-time"><?= htmlspecialchars($event['time_start']) ?> - <?= htmlspecialchars($event['time_end']) ?></p>
                        </div>
                        <p><i class="fas fa-map-marker-alt"></i> <?= htmlspecialchars($event['location']) ?></p>
                    </div>
                    <hr class="divider">
                    <div class="event-details">
                        <div class="detail-item">
                            <span class="detail-label">Harga Sewa</span>
                            <span class="detail-value">Rp <?= htmlspecialchars($event['price']) ?></span>
                        </div>
                        <div class="detail-item">
                            <span class="detail-label">Jumlah Booth</span>
                            <span class="detail-value"><?= htmlspecialchars($event['booth_count']) ?></span>
                        </div>
                    </div>
                    <hr class="divider">
                    <p class="event-description"><?= htmlspecialchars($event['description']) ?></p>
                    <button class="btn btn-primary" id="viewSubmissionButton">Lihat Daftar Pengajuan UMKM</button>
                </div>
            </div>
            <div class="col-md-3 justify-content-center">
                <div class="action-box shadow p-3 d-flex flex-column align-items-center gap-3" id="event-card-<?= $eventId ?>">
                    <a href="edit_event.php?id=<?= $eventId ?>" class="btn btn-warning edit-button w-100 text-center">Edit</a>
                    <button type="button" class="btn btn-danger delete-button w-100" data-id="<?= $eventId ?>">Hapus</button>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal -->
    <div class="modal fade" id="deleteModal" tabindex="-1" aria-labelledby="deleteModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="deleteModalLabel">Hapus Event</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body text-center">
                <i class="fas fa-exclamation-circle text-danger" style="font-size: 50px;"></i>
                <p class="mt-3">Anda yakin ingin menghapus event ini?</p>
            </div>
            <div class="modal-footer justify-content-between">
                <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">Batal</button>
                <button type="button" class="btn btn-danger" id="confirmDeleteButton">Hapus</button>
            </div>
        </div>
    </div>
</div>

    <!-- Bootstrap JS -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
<script>
document.addEventListener("DOMContentLoaded", function () {
    const deleteButtons = document.querySelectorAll(".delete-button");
    const deleteModal = new bootstrap.Modal(document.getElementById("deleteModal"));
    const confirmDeleteButton = document.getElementById("confirmDeleteButton");
    let eventIdToDelete = null;

    deleteButtons.forEach(button => {
        button.addEventListener("click", function () {
            eventIdToDelete = this.getAttribute("data-id");
            deleteModal.show();
        });
    });

    confirmDeleteButton.addEventListener("click", function () {
        if (eventIdToDelete) {
            fetch("delete_event.php", {
                method: "POST",
                headers: { "Content-Type": "application/x-www-form-urlencoded" },
                body: `id=${eventIdToDelete}`
            })
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    // Redirect ke dashboard.php jika berhasil
                    window.location.href = "dashboard.php";
                }
            })
            .finally(() => {
                deleteModal.hide();
                eventIdToDelete = null;
            });
        }
    });
});
</script>

</body>

</html>