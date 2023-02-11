<?php
header("Content-Type: application/json; charset=UTF-8");
include "../koneksi.php";

  if(isset($_GET['query'])){
    $keyword = $_GET['query'];
    $query = mysqli_query($conn,"SELECT * FROM ruangan WHERE kamar LIKE '%".$keyword."%' ORDER BY id_ruangan LIMIT 10");
 
    while ($data = mysqli_fetch_array($query)) {
        $output['suggestions'][] = [
            'value' => $data['kamar'],
            'kamar'  => $data['kamar']
        ];
    }
 
    if (! empty($output)) {
        echo json_encode($output);
    }
  }
?>