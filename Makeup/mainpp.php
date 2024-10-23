
<?php
include 'connection.php';
$produc = isset($_POST['filter']) ? $_POST['filter'] : '';

switch ($produc) {
    case 'recent':
        $stmt = $conn->prepare("SELECT * FROM `products` ORDER BY `ID` DESC LIMIT 4");
        break;
    case 'highest_price':
        $stmt = $conn->prepare("SELECT * FROM `products` ORDER BY CAST(REPLACE(`Price`, '$', '') AS DECIMAL(10, 2)) DESC LIMIT 4");

        break;
    case 'lowest_price':
        $stmt = $conn->prepare("SELECT * FROM `products` ORDER BY CAST(REPLACE(`Price`, '$', '') AS DECIMAL(10, 2)) ASC LIMIT 4");

        break;
    default:
        $stmt = $conn->prepare("SELECT * FROM `products` ORDER BY `ID` DESC LIMIT 4");
        break;
}
$stmt->execute();
$result = $stmt->get_result();

$products = [];
while ($row = $result->fetch_assoc()) {
    $products[] = $row;
}

$stmt->close();
$conn->close();
foreach ($products as $info) {
    echo '<div class="product-card">';
    echo '<div class="product-image">';
    echo '<img src="' . htmlspecialchars($info['Image']) . '" alt="Lipstick">';
    echo '</div>';
    echo '<div class="product-info">';
    echo '<h2>' . htmlspecialchars($info['Name']) . '</h2>';
    echo '<p>' . htmlspecialchars($info['Description']) . '</p>';
    echo '<a class="product-button" onclick="openModal(\'' . htmlspecialchars($info['Name']) . '\', \'' . htmlspecialchars($info['Description']) . '\', \'' . htmlspecialchars($info['Price']) . '\', \'' . htmlspecialchars($info['Image']) . '\')">View Details</a>';
    echo '</div>';
    echo '</div>';
}
echo '</div>';

echo '<div id="product-modal" class="modal">';
echo '<div class="modal-content">';
echo '<span class="close" onclick="closeModal()">&times;</span>';
echo '<img src="" alt="Product Image" id="modal-img">';
echo '<div class="product-inf">';
echo '<h2 id="modal-title">Product Title</h2>';
echo '<p id="modal-description">Product Description</p>';
echo '<p class="price" id="modal-price">$0</p>';
echo '<div class="quantity-selector">';
echo '<button onclick="changeQuantity(-1)" class="quantity-button">-</button>';
echo '<span id="quantity" class="quantity">1</span>';
echo '<button onclick="changeQuantity(1)" class="quantity-button">+</button>';
echo '</div>';
echo '<button class="add-to-cart" onclick="addToCart()">Add to Cart</button>';
echo '</div>';
echo '</div>';
