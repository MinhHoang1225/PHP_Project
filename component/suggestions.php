<?php
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['query'])) {
  $query = trim($_POST['query']);

  $host = 'localhost';  
  $user = 'root';       
  $password = '';      
  $dbname = 'php_project'; 

  $conn = new mysqli($host, $user, $password, $dbname);
  if ($conn->connect_error) {
    die("Kết nối thất bại: " . $conn->connect_error);
  }
  $stmt = $conn->prepare("SELECT product_id, name, img, old_price, price FROM products WHERE name LIKE CONCAT('%', ?, '%') LIMIT 15");
  if ($stmt === false) {
    die("Lỗi SQL: " . $conn->error);
  }

  $stmt->bind_param("s", $query);
  $stmt->execute();
  $result = $stmt->get_result();

  $searchResults = [];
  while ($row = $result->fetch_assoc()) {
    $searchResults[] = $row;
  }

  if (!empty($searchResults)) {
    foreach ($searchResults as $item) {
      echo '<a href="../view/accessores.php?id=' . $item['product_id'] . '" class="search_inf row">';
      echo '<div class="result_img col-2">';
      echo '<img src="../assets/img/' . (file_exists('../assets/img/' . $item['img']) ? $item['img'] : 'default.png') . '" alt="' . htmlspecialchars($item['name']) . '" style="width: 50px; height: auto; margin-right: 10px;">';
      echo '</div>';
      echo '<div class="search_name col-6"><span>' . htmlspecialchars($item['name']) . '</span></div>';
      echo '<div class="search_price col-3">';
      echo '<span class="original-price" style="text-decoration: line-through; color: gray;">' . number_format($item['old_price']) . ' đ</span>';
      echo '<br>';
      echo '<span class="sale-price" style="color: red;">' . number_format($item['price']) . ' đ</span>';
      echo '</div></a>';
    }
  } else {
    echo '<div class="result-item">Không tìm thấy sản phẩm nào.</div>';
  }

  $conn->close();
  exit;
}
?>
