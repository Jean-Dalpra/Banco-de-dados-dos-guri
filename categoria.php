<?php
include_once 'connect.php';
 
?>
 
 
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>banquinho dos gurizinhos</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.7/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-LN+7fdVzj6u52u30Kp6M/trliBMCMKTyK833zpbD+pXdCLuTusPj697FH4R/5mcr" crossorigin="anonymous">
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.7/dist/js/bootstrap.bundle.min.js" integrity="sha384-ndDqU0Gzau9qJ1lfW4pNLlhNTkCfHzAVBReH9diLvGRem5+R9g2FzA8ZGN954O5Q" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="style.css">
</head>
<body>
<div class="container-fluid">
    <div class="row">
        <header class="col-12">
            <nav class="row">
                <div class="col-12">
                <ul class="row">
                 <ul class="row">
              <?php
              $sql = "SELECT * FROM categorias";
              $result = mysqli_query($conn, $sql);
              while($row = mysqli_fetch_assoc($result)){
                echo '<a href="categoria.php?id='.$row['ID'].'" class="col-2">'.$row['Nome'].'</a>';
              }
              ?>
                                               
                </ul>
                </div>
            </nav>
        </header>
        <main class="col-12">
            <div class="row">
                <div class="col-3">
                    <h1 class="text-center" style="text-decoration:underline; padding: 10px; border-radius:10px; background-color: #8b48cf; margin-top: 42px; margin-left: 550px; width: 260px;">
                        <?php
                        $id = intval($_GET['id']);
                         $sql = "SELECT * FROM categorias WHERE ID = $id";
                         $result = mysqli_query($conn, $sql);
                         while($row = mysqli_fetch_assoc($result)){
                            echo $row['Nome'];
                         }
                         ?>
                    </h1>
                </div>
            </div>
            <div class="row">
               <ul class="col-12">
                <div class="row">
                    <?php
                    $sql = "SELECT * FROM produtos WHERE CategoriaID = $id ";
                    $result = mysqli_query($conn, $sql);
                    while($row = mysqli_fetch_assoc($result)){
                       echo '<li class="col-4" style="padding: 10px; border: 6px solid #150129; border-radius:10px; margin-top: 19px; list-style-type: none; width: 430px; margin-left: 20px; background-color: #8b48cf;">
                        <div class="row">
                            <div class="col-12">
                                <h1>'.$row['Titulo'].'</h1>
                            </div>
                        </div>
                        <div class="row">
                            <div class="co-12">
                                <img style="height: 100px; width: 100px;" src="https://logos-world.net/wp-content/uploads/2020/08/Bitcoin-Logo.png" alt="">
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-12">
                                <p>'.$row['Descricao'].'</p>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-6">
                                <span>'.$row['Preco'].'</span>
                            </div>
                            <div class="col-6">
                            <a href="produto.php?id='.$row['ID'].'" class="btn btn-success">Comprar</a>
                            </div>
                        </div>
                    </li>';
                    }
                    ?>
                   
                </div>
               </ul>            
            </div>
        </main>
    </div>
</div>
</body>
</html>