<?php
require '../../vendor/autoload.php';
session_start();

//upload images

$uploaddir = 'Pimages/';
$uploadfile = $uploaddir . basename($_FILES['imageP']['name']);
echo '<pre>';
move_uploaded_file($_FILES['imageP']['tmp_name'], $uploadfile);


$nom = $_POST['Nom'];
$price = $_POST['Price'];
$desc = $_POST['Description'];
$sdesc = $_POST['SDescription'];


$data = [
    'name' => $nom,
    'type' => 'simple',
    'regular_price' => $price,
    'description' => $desc,
    'short_description' => $sdesc,
    'categories' => [
        [
            'id' => 9
        ],
        [
            'id' => 14
        ]
    ],
    'images' => [
        [
            'src' => 'http://localhost:8070/soufianeShopAPI/models/products/' . $uploadfile
        ],
    ]
];

use Automattic\WooCommerce\Client;

//$ck = 'ck_6617d47f39d13dd8e6b21dc61534da672d96735c';
//$cs = 'cs_298c82de74daaed8cde720686f2f8324990fbe2f';

$woocommerce = new Client(
    'http://localhost:8070/shop/',
    $_SESSION['CK'],
    $_SESSION['CS'],
    [
        'wp_api' => true,
        'version' => 'wc/v3',
        'query_string_auth' => true,
    ]
);


$woocommerce->post('products', $data);
?>
<script>
    window.location.replace('/soufianeShopAPI/views/products/index.php');
</script>