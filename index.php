<?php
include_once 'connect.php';
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>NEXUS</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.7/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="style.css">
    <link rel="shortcut icon" href="./images/Design sem nome (1).gif" alt="">
    <style>
@import url('https://fonts.googleapis.com/css2?family=Asimovian&family=Galada&display=swap');
</style>
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

          
            <?php
            $sql = "SELECT ID, Imagem, Titulo FROM produtos ORDER BY RAND()";
            $result = mysqli_query($conn, $sql);
            $imagens = [];
            while($row = mysqli_fetch_assoc($result)){
                $imagens[] = [
                    'id' => $row['ID'],
                    'src' => $row['Imagem'],
                    'nome' => $row['Titulo']
                ];
            }
            ?>
            <div id="carrossel-jogos" style="margin: 20px;position: relative; width: 45vw; max-width: 1300px; height: 520px; overflow: hidden; border-radius: 18px; box-shadow: 0 2px 8px 0 rgba(0,0,0,0.18); background: #2d0a3a; display: flex; align-items: center;">
                <?php foreach($imagens as $i => $img): ?> 
                    <a href="produto.php?id=<?php echo $img['id']; ?>"
                       class="carrossel-slide"
                       style="
                            position: absolute;
                            top: 0; left: 0;
                            width: 100%; height: 100%;
                            opacity: <?php echo $i === 0 ? '1' : '0'; ?>;
                            transition: opacity 0.7s cubic-bezier(.4,0,.2,1);
                            z-index: <?php echo $i === 0 ? '2' : '1'; ?>;
                            display: flex; align-items: flex-end; justify-content: center;
                            cursor: pointer;
                       "
                       data-index="<?php echo $i; ?>">
                        <img src="<?php echo $img['src']; ?>" alt="<?php echo htmlspecialchars($img['nome']); ?>"
                             style="width: 100%; height: 100%; object-fit: cover; border-radius: 18px;">
                        <span style="position: absolute; bottom: 0; left: 0; right: 0; background: rgba(45,10,58,0.7); color: #fff; font-size: 2vw; min-font-size: 18px; padding: 12px 0 12px 32px; border-radius: 0 0 18px 18px; font-weight: 600; letter-spacing: 1px;">
                            <?php echo htmlspecialchars($img['nome']); ?>
                        </span>
                    </a>
                <?php endforeach; ?>
               <button id="carrossel-prev" style="position: absolute; top: 50%; left: 18px; transform: translateY(-50%); background: rgba(40,0,60,0.6); border: none; color: #fff; font-size: 32px; border-radius: 50%; width: 48px; height: 48px; cursor: pointer; z-index: 10; outline: none; display: flex; align-items: center; justify-content: center; padding: 0;">&#8592;</button>
<button id="carrossel-next" style="position: absolute; top: 50%; right: 18px; transform: translateY(-50%); background: rgba(40,0,60,0.6); border: none; color: #fff; font-size: 32px; border-radius: 50%; width: 48px; height: 48px; cursor: pointer; z-index: 10; outline: none; display: flex; align-items: center; justify-content: center; padding: 0;">&#8594;</button>
            </div>
            <script>
            const slides = document.querySelectorAll('.carrossel-slide');
            let current = 0;
            let timer = null;

            function showSlide(idx) {
                slides.forEach((slide, i) => {
                    slide.style.opacity = (i === idx) ? '1' : '0';
                    slide.style.zIndex = (i === idx) ? '2' : '1';
                });
                current = idx;
            }

            function nextSlide() {
                let idx = (current + 1) % slides.length;
                showSlide(idx);
            }

            function prevSlide() {
                let idx = (current - 1 + slides.length) % slides.length;
                showSlide(idx);
            }

            document.getElementById('carrossel-next').onclick = function() {
                nextSlide();
                resetTimer();
            };
            document.getElementById('carrossel-prev').onclick = function() {
                prevSlide();
                resetTimer();
            };

            function resetTimer() {
                if(timer) clearInterval(timer);
                timer = setInterval(nextSlide, 3500);
            }

            resetTimer();
            </script>
          
    <h1 style="
    font-family: 'Asimovian', sans-serif;
    font-size: 160px;
    margin-left: 750px;
    margin-bottom: 400px;
    margin-top: -400px;
    background: linear-gradient(45deg, #6c00c5ff, #78007cff, #63007cff);
    -webkit-background-clip: text;
    -webkit-text-fill-color: transparent;
    text-shadow:
        -2px 2px rgba(169, 98, 227, 0.5),
        -4px 4px rgba(122, 66, 168, 0.5),
        -6px 6px rgba(49, 0, 88, 0.5);
    position: relative;
    z-index: 1;">
    NEXUS
</h1>

<h1 style="color: #919191ff; letter-spacing: 10px; margin-bottom: 200px; margin-top: -380px; margin-left: 855px; font-family: 'Asimovian', sans-serif; font-size: 40px;  background: linear-gradient(45deg, #6c00c5ff, #78007cff, #63007cff);
    -webkit-background-clip: text;
    -webkit-text-fill-color: transparent;
    text-shadow:
        -1px 1px rgba(169, 98, 227, 0.5),
        -2px 2px rgba(122, 66, 168, 0.5),
        -3px 3px rgba(49, 0, 88, 0.5); position: relative; z-index: 1;">
  Game Store
</h1>

<img src="./images/Design sem nome (1).gif" 
     style="z-index: 0; position: absolute; height: 460px; width: 460px; margin-left: 870px; margin-top: -560px;" 
     alt="">

            <div class="row">
               <ul class="col-12">
                <div class="row">
                    <?php
                    $sql = "SELECT * FROM produtos";
                    $result = mysqli_query($conn, $sql);
while($row = mysqli_fetch_assoc($result)){
    $preco_atual = floatval($row['Preco']);
    $fator = rand(120, 170) / 100;
    $preco_original = round($preco_atual * $fator, 2);
    $desconto_percent = round(100 - ($preco_atual / $preco_original * 100));
    $desconto = "-{$desconto_percent}%";

    echo '<li class="col-4 produto-li" 
        data-href="produto.php?id='.$row['ID'].'"
        style="
        box-shadow: 0 2px 8px 0 rgba(0,0,0,0.18);
        border-radius: 8px;
        margin-top: 19px;
        list-style-type: none;
        width: 430px;
        margin-left: 16px;
        background: linear-gradient(135deg, #2d0a3a 0%, #8b48cf 60%, #633ba8ff 100%);
        color: #f6f6ff;
        font-weight: 500;
        padding-bottom: 10px;
        cursor: pointer;
    ">
    <div class="row">
        <div class="co-12">
            <img style="height: 350px; width: 430px; margin-left: -12px; border-radius:2px;" src="'.$row['Imagem'].'" alt="">
        </div>
    </div>
    <div class="row" style="margin-top:10px; font-size: 17px;">
        <div class="col-12">
            <p style="color: #f6f6ff;">'.$row['Descricao'].'</p>
        </div>
    </div>
    <div class="row" style="margin-top: 10px;">
        <div class="col-12" style="display: flex; align-items: flex-end;">
            <span style="
                background: #642d6bff;
                color: #d95cffff;
                font-weight: bold;
                font-size: 22px;
                padding: 4px 14px 4px 10px;
                border-radius: 3px 0 0 3px;
                letter-spacing: 1px;
                display: flex;
                align-items: center;
                height: 48px;
                margin-right: 8px;
            ">'.$desconto.'</span>
            <span style="
                background: #232c3d;
                display: flex;
                flex-direction: column;
                justify-content: flex-end;
                border-radius: 0 3px 3px 0;
                padding: 0 12px 0 8px;
                min-width: 90px;
                margin-left: -8px;
            ">
                <span style="
                    color: #b0b8c9;
                    font-size: 12.5px;
                    text-decoration: line-through;
                    margin-bottom: -2px;
                    text-align: left;
                ">R$ '.number_format($preco_original, 2, ',', '').'</span>
                <span style="
                    color: #f6f6ff;
                    font-size: 21px;
                    font-weight: bold;
                    text-align: left;
                ">R$ '.number_format($preco_atual, 2, ',', '').'</span>
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