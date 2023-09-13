<?php
include "./garduweb/config/database.php"; //nama file koneksi database Anda
$conn = mysqli_connect(DB_HOST, DB_USER, DB_PASS, DB_NAME);
if (mysqli_connect_errno()) {
    echo "Failed to connect to MySQL: " . mysqli_connect_error();
}
$query    = mysqli_query($conn, "SELECT * FROM tb_post"); //disesuaikan dengan table penyimpanan data post yang Anda buat.

$baseurl = "https://alganiastore.com/item/";

header('Content-type: application/xml');
echo "<?xml version='1.0' encoding='UTF-8'?>" . "\n";
echo "<urlset xmlns='http://www.sitemaps.org/schemas/sitemap/0.9'>" . "\n";
echo " ";
while ($data    = mysqli_fetch_array($query)) {
    echo "<url>";
    echo "<loc>" . $baseurl . $data['slug'] . "</loc>";
    echo "<lastmod>" . $data['tanggal'] . "</lastmod>";
    echo "<priority>1.00</priority>";
    echo "</url>";
}
echo "</urlset>";
