<?php
include_once ($_SERVER["DOCUMENT_ROOT"] . "/php/coneccion.php");

$validProduct = false;
$term = $_GET["term"];

$countriesQ = "
        SELECT 
            dir.nomPais
        FROM
            cat_empresas AS emp
                INNER JOIN
            direct AS dir ON emp.pais = dir.codPais
        WHERE
            emp.companyid != '0';
    ";

$countriesR = mysqli_query(conexion(""), $countriesQ);
$response = Array();
$responseError = Array();

while ($countriesRow = mysqli_fetch_array($countriesR)) {
    $country = $countriesRow[0];

    $productQ = "
        SELECT 
            mastersku, prodname, upc
        FROM
        tra_tin_det AS tin
            INNER JOIN
        tra_tin_enc AS tinenc ON tin.codtominv = tinenc.codtominv
            INNER JOIN
        cat_prod AS prod ON tin.codprod = prod.codprod
        WHERE
            (mastersku LIKE '%".$term."%'
                || prodname LIKE '%".$term."%'
                || upc LIKE '%".$term."%')  and tinenc.ajuste=0
        ORDER BY prodname , mastersku , upc
        LIMIT 15;
    ";

    $productR = mysqli_query(conexion($country), $productQ);

    if($productR->num_rows > 0){

        $validProduct = true;
        while($product = mysqli_fetch_array($productR)){
            $mastersku = $product["mastersku"];
            $descsis = $product["prodname"];
            $upc = $product["upc"];

            $response[] = [
                "name" => $descsis,
                "sku" => $mastersku,
                "upc" => $upc,
            ];
        }
    }
}
// echo $productQ;

echo json_encode($response);

if(!$validProduct){
    $response = [
        "status" => "error",
        "message" => "no products found in any database"
    ];

    echo json_encode($response);
}
