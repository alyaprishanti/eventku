<?php
// Include database connection
include 'db.php';

// Fetch events from database
$events = $conn->query("SELECT * FROM events");
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Eventku</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" />
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" />
    <!-- Custom CSS -->
    <link rel="stylesheet" href="css/styles.css" />
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
    <div class="container mt-5">
      <div class="d-flex justify-content-between align-items-center mb-4">
        <h1 class="kelola-title">Kelola Event</h1>
        <button class="btn tambah-event-btn" onclick="window.location.href='tambahevent.php'">Tambah Event</button>
      </div>

      <h2 class="mb-4">Daftar Event</h2>

      <div class="row gy-4" id="eventContainer">
        <?php while ($event = $events->fetch_assoc()): ?>
        <div class="col-md-4">
          <div class="card event-card p-3 text-center">
            <img src="<?= htmlspecialchars($event['image']) ?>" alt="Event Image" class="img-fluid" />
            <h3><?= htmlspecialchars($event['title']) ?></h3>
            <p class="text-muted"><?= htmlspecialchars($event['date']) ?></p>
            <p><?= htmlspecialchars($event['description']) ?></p>
            <button class="btn detail-btn" onclick="viewEventDetail(<?= $event['id'] ?>)">Lihat Detail</button>
          </div>
        </div>
        <?php endwhile; ?>
      </div>
    </div>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        // Function to view event detail
        function viewEventDetail(eventId) {
            // Redirect to detail page with event ID as parameter
            window.location.href = 'event_detail.php?id=' + eventId;
        }
    </script>
</body>
</html>
