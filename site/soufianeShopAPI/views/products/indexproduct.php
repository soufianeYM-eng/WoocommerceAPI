<?php include "../gabarit-top.php";
include '../../vendor/autoload.php';

use Automattic\WooCommerce\Client;

if (!isset($_SESSION['CK']) || !isset($_SESSION['CS'])) { ?>
    <script>
        window.location.replace('/soufianeShopAPI/views/login.php');
    </script>
<?php
}


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
//$data = file_get_contents('http://localhost:8070/soufianeShopAPI/models/products/allproducts.php');
$id = $_POST["ID"];
echo $id;
if ($id == null) {
?>
    <script>
        window.location.replace('/soufianeShopAPI/views/products/index.php');
    </script>
<?php
}
$data = json_encode($woocommerce->get("products/" . $id));
$data = json_decode($data, true);
?>
<div>
    <br><br>
    <center>
        <h3>Les produits Woocommerce</h3>
    </center>
    <br><br>
</div>
<div class="container-fluid">
    <br />
    <a href="/soufianeShopAPI/views/products/create.php"><button class="btn btn-success mb-3">Ajouter Produit</button></a>
    <div class="table-responsive">
        <table class="table table-hover">
            <thead>
                <tr>
                    <th>Id</th>
                    <th>Nom</th>
                    <th>Slug</th>
                    <th>Date de création</th>
                    <th>Status</th>
                    <th>Prix</th>
                    <th>Image</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td><?= $data['id']; ?></td>
                    <td><?= $data['name']; ?></td>
                    <td><?= $data['slug']; ?></td>
                    <td><?= $data['date_created']; ?></td>
                    <?php if ($data['status'] == 'publish') : ?>
                        <td style="color:green;"><?= $data['status']; ?></td>
                    <?php endif; ?>
                    <td><?= $data['price']; ?></td>
                    <td>
                        <?php foreach ($data['images'] as $data) {
                            foreach ($data as $key => $value) {
                                if ($key = 'src' and strpos($value, 'jpg') != false) { ?>
                                    <img src="<?= $value ?>" style="
    height: 346px;
" />
                        <?php
                                }
                            }
                        }
                        ?>
                    </td>
                </tr>
            </tbody>
        </table>
    </div>
</div>

<?php include "../gabarit-bottom.php" ?>