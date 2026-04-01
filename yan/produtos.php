<?php
// Inclui a conexão PDO
require "conexao.php"; // conexao.php deve definir $pdo
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Página de Produtos</title>
    <style>
        * { margin: 0; padding: 0; box-sizing: border-box; }
        body { font-family: Arial, sans-serif; background-color: #f4f4f4; padding-top: 60px; }
        .navbar { background-color: #333; color: white; padding: 10px 0; display: flex; justify-content: space-between; align-items: center; position: fixed; top: 0; width: 100%; z-index: 1000; }
        .navbar .logo { margin-left: 20px; font-size: 24px; font-weight: bold; }
        .navbar nav { margin-right: 20px; }
        .navbar nav a { color: white; text-decoration: none; margin: 0 15px; font-size: 16px; transition: color 0.3s; }
        .navbar nav a:hover { color: #4CAF50; }
        .content { padding: 30px; margin-top: 10px; }
        .contentgrid { padding: 30px; margin-top: 5px; }
        .welcome-message { background-color: #fff; padding: 20px; border-radius: 8px; box-shadow: 0 2px 10px rgba(0,0,0,0.1); margin-bottom: 30px; }
        .welcome-message h2 { font-size: 24px; color: #333; }
        table { border-collapse: collapse; width: 100%; background-color: #fff; }
        th, td { padding: 10px; text-align: left; border: 1px solid #ddd; }
        th { background-color: #CCCCCC; }
    </style>
</head>
<body>

    <!-- Menu -->
    <?php include "menu.php"; ?>   

    <div class="content">
        <div class="welcome-message">
            <h2>Produtos</h2>
        </div>
    </div>

    <div class="contentgrid">
        <table>
            <tr>
                <th><input type="checkbox" name="todos"></th>
                <th>ID Produto</th>
                <th>Nome</th>
                <th>Preço</th>
                <th>Status</th>
            </tr>

            <?php
            try {
                // Consulta usando PDO e schema público
                $stmt = $pdo->query("SELECT * FROM public.produto ORDER BY idproduto");

                while ($linha = $stmt->fetch(PDO::FETCH_ASSOC)) {
                    echo "<tr>";
                    echo "<td><input type='checkbox' name='todos'></td>";
                    echo "<td>" . htmlspecialchars($linha['idproduto']) . "</td>";
                    echo "<td>" . htmlspecialchars($linha['produtonome']) . "</td>";
                    echo "<td>R$ " . number_format($linha['produtopreco'], 2, ',', '.') . "</td>";
                    echo "<td>" . ($linha['produtostatus'] ? "Ativo" : "Desativado") . "</td>";
                    echo "</tr>";
                }

            } catch (PDOException $e) {
                echo "<tr><td colspan='5'>Erro ao carregar produtos: " . $e->getMessage() . "</td></tr>";
            }
            ?>
        </table>
    </div>

</body>
</html>