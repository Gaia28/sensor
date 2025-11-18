<?php
$db_file = __DIR__ . '/users.sqlite';

try {
    // 1. Conecta ou cria o banco de dados
    $db = new PDO('sqlite:' . $db_file);
    $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    // 2. Cria a tabela de usuários
    $db->exec("
        CREATE TABLE IF NOT EXISTS users (
            id INTEGER PRIMARY KEY,
            username TEXT NOT NULL UNIQUE,
            password TEXT NOT NULL
        );
    ");

    // 3. Insere um usuário inicial (SENHA: admin)
    // CUIDADO: Em produção, NUNCA armazene senhas como texto simples (use password_hash)
    $username = 'admin';
    $password_hash = password_hash('admin', PASSWORD_DEFAULT); // Hash seguro

    $stmt = $db->prepare("SELECT COUNT(*) FROM users WHERE username = ?");
    $stmt->execute([$username]);
    if ($stmt->fetchColumn() == 0) {
        $stmt = $db->prepare("INSERT INTO users (username, password) VALUES (?, ?)");
        $stmt->execute([$username, $password_hash]);
        echo "Tabela 'users' criada com sucesso. Usuário 'admin' (senha: admin) adicionado.<br>";
    } else {
        echo "Tabela 'users' já existe. Usuário 'admin' já adicionado.<br>";
    }

} catch (PDOException $e) {
    echo "Erro ao inicializar o banco de dados: " . $e->getMessage();
}
?>