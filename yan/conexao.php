<?php
// conexao.php
$host = 'localhost';
$db   = 'produtos';
$user = 'postgres';
$pass = '123456';
$port = '5432';

try {
    // Cria a conexão PDO e define no escopo global
    $pdo = new PDO(
        "pgsql:host=$host;port=$port;dbname=$db",
        $user,
        $pass,
        [PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION]
    );

    // Opcional: mensagem de teste
    // echo "Conexão estabelecida com sucesso!";

} catch (PDOException $e) {
    die("Erro ao conectar ao banco de dados: " . $e->getMessage());
}
?>