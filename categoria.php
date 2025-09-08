<?php
include_once 'connect.php';
$id = intval($_GET['id']);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>   <?php
        $sql = "SELECT Nome FROM categorias WHERE ID = $id";
        $result = mysqli_query($conn, $sql);
        if($row = mysqli_fetch_assoc($result)){
            echo htmlspecialchars($row['Nome']) . "s";
        }
        ?></title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.7/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="style.css">
    <style>
@import url('https://fonts.googleapis.com/css2?family=Asimovian&family=Galada&display=swap');
</style>
    <link rel="shortcut icon" href="./images/Design sem nome (1).gif" alt="">
</head>
<body>
<div class="container-fluid">
    <div class="row">
         <header class="col-12">
            <nav class="row" style="margin-left: 3vw; ">
                <div class="col-12">
                <ul class="row">
                    <img src="./images/Design sem nome (1).gif"  alt="" style="height: 40px; width: 65px; margin-top: 12px;">
                    <h1 onclick="window.location.href='index.php'" style="cursor: pointer; margin-top: 7px; margin-left: -10px; font-family: 'Asimovian', sans-serif; color: white; width: 100px;">NEXUS</h1>
              <?php
              $sql = "SELECT * FROM categorias";
              $result = mysqli_query($conn, $sql);
              while($row = mysqli_fetch_assoc($result)){
                echo '<a style="color: #dcdedf; text-decoration: none; width: 120px; font-size: 25px; margin-top: 1px; margin-left: 60px; text-align: center;"
    href="categoria.php?id='.$row['ID'].'"
    class="col-1 categus"
    onmouseover="this.style.color=\'#fff\'"
    onmouseout="this.style.color=\'#dcdedf\'"
>'.$row['Nome'].'</a>';
              }
              ?>
                </ul>
                </div>
            </nav>
        </header>
        <main class="col-12">
            <div class="row">
                <div class="col-12">
                    <h1 class="text-center" style="font-size: 60px; padding: 10px; border-radius:10px; text-decoration: none; margin-top: 30px; margin-left: auto; margin-right: auto; width: 320px; color: #fff;">
                        <?php
                        $sql = "SELECT Nome FROM categorias WHERE ID = $id";
                        $result = mysqli_query($conn, $sql);
                        if($row = mysqli_fetch_assoc($result)){
                            echo htmlspecialchars($row['Nome']);
                        }
                        ?>
                    </h1>
                </div>
            </div>
            <div class="row">
               <ul class="col-12" style="padding-left:0;">
                <div class="row">
                    <?php
                    $sql = "SELECT * FROM produtos WHERE CategoriaID = $id";
                    $result = mysqli_query($conn, $sql);
                    while($row = mysqli_fetch_assoc($result)){
                        $preco_atual = floatval($row['Preco']);
                        $fator = rand(120, 170) / 100;
                        $preco_original = round($preco_atual * $fator, 2);
                        $desconto_percent = round(100 - ($preco_atual / $preco_original * 100));
                        $desconto = "-{$desconto_percent}%";
                        echo '
                        <li class="col-4 produto-li" data-href="produto.php?id='.$row['ID'].'"
                            style=" box-shadow:0 2px 8px 0 rgba(0,0,0,0.18);border-radius:8px;margin-top:19px;list-style-type:none;width:430px; margin-left:22px; background:linear-gradient(135deg,#2d0a3a 0%,#8b48cf 60%,#633ba8ff 100%);color:#f6f6ff;font-weight:500;padding-bottom:10px;cursor:pointer;">
                            <img style="margin-left: -12px;height:350px;width:430px;object-fit:cover;border-radius:6px 6px 0 0;" src="'.$row['Imagem'].'" alt="">
                            <div style="padding:12px 10px 0 10px;">
                                <p style="color:#f6f6ff;font-size:15px;min-height:48px;">'.$row['Descricao'].'</p>
                                <div style="display:flex;align-items:flex-end;margin-top:10px;">
                                    <span style="background:#642d6bff;color:#d95cffff;font-weight:bold;font-size:18px;padding:3px 10px 3px 8px;border-radius:3px 0 0 3px;letter-spacing:1px;display:flex;align-items:center;height:38px;margin-right:6px;">'.$desconto.'</span>
                                    <span style="background:#232c3d;display:flex;flex-direction:column;justify-content:flex-end;border-radius:0 3px 3px 0;padding:0 8px 0 6px;min-width:70px;margin-left:-6px;">
                                        <span style="color:#b0b8c9;font-size:11px;text-decoration:line-through;margin-bottom:-2px;text-align:left;">R$ '.number_format($preco_original,2,',','').'</span>
                                        <span style="color:#f6f6ff;font-size:16px;font-weight:bold;text-align:left;">R$ '.number_format($preco_atual,2,',','').'</span>
                                    </span>
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
<script>
document.querySelectorAll('.produto-li').forEach(function(li) {
    li.addEventListener('click', function() {
        window.location = li.getAttribute('data-href');
    });
});
</script>
</body>
</html>