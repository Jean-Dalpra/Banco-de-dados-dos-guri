<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

include_once 'connect.php';

if (!isset($conn) || !($conn instanceof mysqli)) {
    die("Erro: conexão com o banco de dados não encontrada.");
}

if (!isset($_GET['id'])) {
    echo "<h2 style='color:#fff;text-align:center;margin-top:40px;'>Produto não encontrado</h2>";
    exit;
}

$id = intval($_GET['id']);

$sql = "SELECT ID, Titulo, Descricao, Imagem, Preco, CategoriaID FROM produtos WHERE ID = ?";
$stmt = mysqli_prepare($conn, $sql);
if (!$stmt) {
    die("Erro na preparação da query: " . mysqli_error($conn));
}
mysqli_stmt_bind_param($stmt, "i", $id);
mysqli_stmt_execute($stmt);
$result = mysqli_stmt_get_result($stmt);
$produto = mysqli_fetch_assoc($result);
mysqli_stmt_close($stmt);

if (!$produto) {
    echo "<h2 style='color:#fff;text-align:center;margin-top:40px;'>Produto não encontrado</h2>";
    exit;
}

$imagem = !empty($produto['Imagem']) ? preg_replace('#^(\./|\.\./)+#', '', $produto['Imagem']) : 'assets/placeholder.png';

$preco = isset($produto['Preco']) ? (float)$produto['Preco'] : 0.0;
$titulo = htmlspecialchars($produto['Titulo'] ?? 'Produto', ENT_QUOTES, 'UTF-8');
$descricao = nl2br(htmlspecialchars($produto['Descricao'] ?? '', ENT_QUOTES, 'UTF-8'));
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo $titulo; ?></title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.7/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="style.css">
        <link rel="shortcut icon" href="./images/Design sem nome (1).gif" alt="">
</head>
<body style="background: radial-gradient(circle at 50% 50%, #1e0438 0%, #260a42 20%, #38145c 40%, #421d66 60%, #412063 80%, #6e3369 100%); color: #fff;">
<div class="container" style="margin-top: 32px;">
    <div class="row" style="background: rgba(30,4,56,0.97); border-radius: 14px; box-shadow: 0 2px 16px 0 rgba(0,0,0,0.18); padding: 32px;">
        <div class="col-md-6" style="display: flex; flex-direction: column; align-items: center;">
            <img src="<?php echo htmlspecialchars($imagem, ENT_QUOTES, 'UTF-8'); ?>" alt="<?php echo $titulo; ?>"
                 style="width: 100%; max-width: 480px; height: 420px; object-fit: cover; border-radius: 10px; box-shadow: 0 2px 8px 0 rgba(0,0,0,0.18); margin-bottom: 18px;">
            <form method="post" action="index.php" style="width:100%;">
                <input type="hidden" name="produto_id" value="<?php echo (int)$produto['ID']; ?>">
                <button type="submit"
                    style="width:100%; background: linear-gradient(90deg,#8b48cf 0%,#633ba8ff 100%); color:#fff; font-size: 1.5rem; font-weight: bold; border:none; border-radius: 8px; padding: 16px 0; margin-top: 8px; box-shadow: 0 2px 8px 0 rgba(0,0,0,0.10); transition: filter 0.2s;"
                    onmouseover="this.style.filter='brightness(1.12)'" onmouseout="this.style.filter='none'">
                    <?php echo 'Comprar por R$ ' . number_format($preco, 2, ',', '.'); ?>
                </button>
            </form>
        </div>
             <div class="col-md-6" style="display: flex; flex-direction: column; justify-content: flex-start;">
            <h1 style="font-size: 3.2rem; font-weight: 700; color: #fff; margin-bottom: 18px;">
                <?php echo $titulo; ?>
            </h1>
            <p style="font-size: 1.5rem; color: #e7e7f7; margin-bottom: 24px;">
                <?php echo $descricao; ?>
            </p>
            <div style="margin-bottom: 12px;">
                <span style="color: #b0b8c9;">Categoria:</span>
                <?php
                $cat_id = intval($produto['CategoriaID'] ?? 0);
                if ($cat_id) {
                    $cat_sql = "SELECT Nome FROM categorias WHERE ID = ?";
                    $cat_stmt = mysqli_prepare($conn, $cat_sql);
                    if ($cat_stmt) {
                        mysqli_stmt_bind_param($cat_stmt, "i", $cat_id);
                        mysqli_stmt_execute($cat_stmt);
                        $cat_res = mysqli_stmt_get_result($cat_stmt);
                        if ($cat = mysqli_fetch_assoc($cat_res)) {
                            echo '<span style="color:#d95cffff; font-weight:600;">' . htmlspecialchars($cat['Nome'], ENT_QUOTES, 'UTF-8') . '</span>';
                        }
                        mysqli_stmt_close($cat_stmt);
                    }
                }
                ?>
            </div>
            <div>
                <span style="color: #b0b8c9;">Preço:</span>
                <span style="color: #fff; font-size: 1.3rem; font-weight: bold;">
                    R$ <?php echo number_format($preco, 2, ',', '.'); ?>
                </span>
            </div>
        </div>
    </div>
</div>
</body>
</html>
