<?php
header("Content-Type: application/json");
require 'db.php';


// Get method and input
$method = $_SERVER['REQUEST_METHOD'];
$input = json_decode(file_get_contents("php://input"), true);
$id = $_GET['id'] ?? null;
$category = $_GET['category'] ?? null;
$stock = $_GET['stock'] ?? null;
$sort = $_GET['sort'] ?? null;
$search=$_GET['search'] ?? null;
$page = $_GET['page'] ?? null ;
$pageSize =$_GET['pagesize'] ?? null;

switch ($method) {
    case 'GET':
        if ($id) {
            $stmt = $pdo->prepare("SELECT * FROM products WHERE id = ?");
            $stmt->execute([$id]);
            $product = $stmt->fetch(PDO::FETCH_ASSOC);
            echo json_encode($product ?: ['message' => 'Product not found']);
        } 
        
        else if ($category) {
           // $stmt = $pdo->query("SELECT * FROM products"); //ORDER BY id DESC ASC
          //  echo json_encode($stmt->fetchAll(PDO::FETCH_ASSOC));
           $stmt = $pdo->prepare("SELECT * FROM products WHERE category = ? AND stock <=$stock");
           $stmt->execute([$category]);
           $category = $stmt->fetchAll(PDO::FETCH_ASSOC);

           
           //echo json_encode($stmt->fetchAll(PDO::FETCH_ASSOC));

           echo json_encode($category ?: ['message' => 'category not found'] );
        }
        else if($stock) {
           $stmt = $pdo->prepare("SELECT * FROM products WHERE stock <= ?");
           $stmt->execute([$stock]);
           $stock = $stmt->fetchAll(PDO::FETCH_ASSOC);
           //echo json_encode($stmt->fetchAll(PDO::FETCH_ASSOC));

           echo json_encode($stock ?: ['message' => 'stock not available'] );

          }

        else if ($search)  {

                 $stmt = $pdo->prepare("SELECT * FROM products Where Name || category LIKE '%$search%'");
                 $stmt->execute([$search]);
                 $search = $stmt->fetchAll(PDO::FETCH_ASSOC);
                 echo json_encode($search ?: ['message' => 'Data not found'] );

                //$name="SELECT Name FROM tutorials_tbl where Email='$_SESSION[login_user]'";
                 
             }
          elseif($sort) {

            $orderBy = '';
                if ($sort === 'price_asc') {
                    $orderBy = ' ORDER BY price ASC';
                } elseif ($sort === 'price_desc') {
                    $orderBy = ' ORDER BY price DESC';
                }

                $query = "SELECT * FROM products" . $orderBy;
                $stmt = $pdo->query($query);
                echo json_encode($stmt->fetchAll(PDO::FETCH_ASSOC));
          }
         else{
            $stmt = $pdo->query("SELECT * FROM products");
            echo json_encode($stmt->fetchAll(PDO::FETCH_ASSOC));
        }


        break;

    case 'POST':
        if (!$input) die(json_encode(['error' => 'Invalid input']));
        $stmt = $pdo->prepare("INSERT INTO products (name, description, price, stock, category) VALUES (?, ?, ?, ?, ?)");
        $stmt->execute([$input['name'], $input['description'], $input['price'], $input['stock'], $input['category']]);
        echo json_encode(['message' => 'Product created']);
        break;

    case 'PUT':
        if (!$id || !$input) die(json_encode(['error' => 'Invalid input']));
        $stmt = $pdo->prepare("UPDATE products SET name=?, description=?, price=?, stock=?, category=? WHERE id=?");
        $stmt->execute([$input['name'], $input['description'], $input['price'], $input['stock'], $input['category'], $id]);
        echo json_encode(['message' => 'Product updated']);
        break;

    case 'DELETE':
        if (!$id) die(json_encode(['error' => 'Missing ID']));
        $stmt = $pdo->prepare("DELETE FROM products WHERE id=?");
        $stmt->execute([$id]);
       echo json_encode(['message' => 'Product deleted']);
      //  echo json_encode($stmt->fetchAll(PDO::FETCH_ASSOC));
      //  echo json_encode($stmt ?: ['message' => 'ID not found'] );

        break;

    default:
        http_response_code(405);
        echo json_encode(['error' => 'Method not allowed']);
        break;
}
?>
