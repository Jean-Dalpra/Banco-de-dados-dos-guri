<?php
include_once 'connect.php';
 
?>
 
 
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>AAA</title>
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
              <a href="Indie.php" class="catego col-1" style="color:white; text-decoration:none; text-align:center; font-size:25px; margin-top: 10px; margin-left: 80px;"><li class="col-1 text-center">Indie</li></a>
                            <a href="AAA.php" class="catego col-1" style="color:white; text-decoration:none; text-align:center; font-size:25px; margin-top: 10px; margin-left: 80px;"><li class="col-1 text-center">AAA</li></a>
                                          <a href="FPS.php" class="catego col-1" style="color:white; text-decoration:none; text-align:center; font-size:25px; margin-top: 10px; margin-left: 80px;"><li class="col-1 text-center">FPS</li></a>
                                                        <a href="Puzzle.php" class="catego col-1" style="color:white; text-decoration:none; text-align:center; font-size:25px; margin-top: 10px; margin-left: 80px;"><li class="col-1 text-center">Puzzle</li></a>
                                                                      <a href="Soulslike.php" class="catego col-1" style="color:white; text-decoration:none; text-align:center; font-size:25px; margin-top: 10px; margin-left: 80px;"><li class="col-1 text-center">Soulslike</li></a>
                                                                                    <a href="Roguelike.php" class="catego col-1" style="color:white; text-decoration:none; text-align:center; font-size:25px; margin-top: 10px; margin-left: 80px;"><li class="col-1 text-center">Roguelike</li></a>
                                               
                </ul>
                </div>
            </nav>
        </header>
        <main class="col-12">
            <div class="row">
                <div class="col-3">
                    <h1 class="text-center" style="text-decoration:underline; padding: 10px; border-radius:10px; background-color: #8b48cf; margin-top: 42px; margin-left: 550px; width: 260px;">AAA</h1>
                </div>
            </div>
            <div class="row">
               <ul class="col-12">
                <div class="row">
                    <?php
                    $sql = "SELECT * FROM produtos";
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
                            <div class="col-12">
                                <span>'.$row['Preco'].'</span>
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