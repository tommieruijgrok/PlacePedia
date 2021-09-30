<?php
include "../include/config.php";
if (isset($_GET["query"])) {

    $data = array();


    if ($_GET["query"] != '') {
        $condition = preg_replace('/[^A-Za-z0-9\- ]/', '', $_GET["query"]);
        $condition = trim($condition);
        $condition = str_replace(" ", "%", $condition);

        $sample_data = array(
            ':post_title' => '%' . $condition . '%',
            ':post_description' => '%' . $condition . '%'
        );

        $query = "SELECT * FROM NederlandseGemeenten WHERE gemeenteNaam LIKE :post_title ORDER BY id DESC";

        $statement = $connect->prepare($query);

        $statement->execute($sample_data);

        $result = $statement->fetchAll();

        $replace_array_1 = explode("%", $condition);

        foreach ($replace_array_1 as $row_data) {
            $replace_array_2[] = '<span style="background-color:#' . rand(100000, 999999) . '; color:#fff">' . $row_data . '</span>';
        }

        foreach ($result as $row) {
            $data[] = array(
                'post_title' => str_ireplace($replace_array_1, $replace_array_2, $row["post_title"]),
                'post_description' => str_ireplace($replace_array_1, $replace_array_2, $row["post_description"])
            );
        }
    } else {
        $query = "SELECT * FROM NederlandseGemeenten ORDER BY id DESC";

        $result = $connect->query($query);

        foreach ($result as $row) {
            $data[] = array(
                'post_title' => $row["post_title"],
                'post_description' => $row["post_description"]
            );
        }

    }


    echo json_encode($data);
}
?>
