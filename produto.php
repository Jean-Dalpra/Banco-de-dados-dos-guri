<?php
include_once 'connect.php';

if (isset($_GET['id'])) {
    $id = intval($_GET['id']);

    $sql = "SELECT * FROM produtos WHERE id = $id";
    $result = mysqli_query($conn, $sql);

        while($produto = mysqli_fetch_assoc($result)){
        echo "<h1>" . $produto['Titulo'] . "</h1>
         <p>Descrição: " . $produto['Descricao'] . "</p>
         <p>Preço: R$ " . $produto['Preco'] . "</p>
         <button>Finalizar Compra</button>";
        }
    }else{
        echo "Produto não encontrado";
    }  