<?php
include 'db.php';
if (isset($_POST['delete_portfolio'])) {
  $id_portfolio = intval($_POST['id_portfolio']); // ID portfolio yang akan dihapus

  // Ambil nama file dari database
  $query_get_file = "SELECT portofolio_url FROM portofolio_umkm WHERE id_portofolio = $id_portfolio";
  $result_get_file = mysqli_query($db, $query_get_file);
  $file_data = mysqli_fetch_assoc($result_get_file);

  if ($file_data) {
      $file_path = 'uploads/' . $file_data['portofolio_url'];

      // Hapus file dari direktori
      if (file_exists($file_path)) {
          unlink($file_path);
      }

      // Hapus data dari database
      $query_delete = "DELETE FROM portofolio_umkm WHERE id_portofolio = $id_portfolio";
      $delete_result = mysqli_query($db, $query_delete);

      if ($delete_result) {
          echo json_encode(['status' => 'success']);
      } else {
          echo json_encode(['status' => 'error', 'message' => 'Gagal menghapus data dari database.']);
      }
  } else {
      echo json_encode(['status' => 'error', 'message' => 'Data tidak ditemukan.']);
  }

  exit;
}?>
