<?php
ini_set("display_errors",1);
error_reporting(E_ALL);
use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;

$app->get('/products', function (Request $raquest, Response $response, array $args) {
   $conn = $GLOBALS[ 'dbconn'];
   $sql = "select * from products";
   $result = $conn->query ($sql);
//    $nun = $result->num_rows;
    $data = array();
    while ($row = $result->fetch_assoc()){
        array_push($data, $row);
    
    }
   $json = json_encode($data);
   
   $response->getBody()->write($json);
   return $response->withHeader('Content-Type', 'application/json');
});

$app->get('/products/{product_code}', function (Request $raquest, Response $response, array $args) {
    
    $pCode = $args['product_code'];
    $conn = $GLOBALS[ 'dbconn'];
    $stmt = $conn->prepare("SELECT * FROM products WHERE productCode = ?");
    $stmt->bind_param("s", $pCode);
    $stmt->execute();
    
    
    $result = $stmt->get_result();
 //    $nun = $result->num_rows;
     $data = array();
     while ($row = $result->fetch_assoc()){
         array_push($data, $row);
     
     }
    $json = json_encode($data);
    
    $response->getBody()->write($json);
    return $response->withHeader('Content-Type', 'application/json');
 });
?>