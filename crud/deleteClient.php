<?php

    if(!empty($_GET['id']))
    {
        include_once('connection.php');

        $id = $_GET['id'];

        $sqlSelect = "SELECT *  FROM clientes WHERE id=$id";

        $result = $connection->query($sqlSelect);

        if($result->num_rows > 0)
        {
            $sqlDelete = "DELETE FROM clientes WHERE id=$id";
            $resultDelete = $connection->query($sqlDelete);
        }
    }
    header('Location: listagem.php');
   
?>