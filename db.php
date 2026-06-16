<?php
if (realpath($_SERVER['SCRIPT_FILENAME'] ?? '') === __FILE__) {
    http_response_code(403);
    exit('Acesso negado.');
}  // Não permite acesso direto localhost/db.php e tudo mais

class DB { // OBJ SINGLETON CONEXÃO DA BD
    private static $pdo = null;

    public static function pdo()
    {
        // Se a conexão já foi criada anteriormente, reutiliza ela.
        if (self::$pdo) return self::$pdo;

        // Diretório do banco
        $dbDir = __DIR__ . DIRECTORY_SEPARATOR . 'data';

        // Cria a pasta caso não exista
        if (!is_dir($dbDir)) mkdir($dbDir, 0755, true);

        // Caminho completo do arquivo db.sqlite
        $dbFile = $dbDir . DIRECTORY_SEPARATOR . 'db.sqlite';

        // DSN utlizado para o PDO
        $dsn = 'sqlite:' . $dbFile;

        // Cria a conexão
        $pdo = new PDO($dsn);

        // Configura pra lançar exceptions se tiver algum erro
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        // Salva a conexão
        self::$pdo = $pdo;

        // Usa a função init
        self::init();

        // Retorna a função
        return self::$pdo;
    }

    // Função pra popular a base de dados
    private static function init()
    {
        $db = self::$pdo;

        // Ativa suporte a foreign_keys no SQLite
        $db->exec('PRAGMA foreign_keys = ON;');

        // Tabela usuários
        $db->exec("CREATE TABLE IF NOT EXISTS users (
            id INTEGER PRIMARY KEY AUTOINCREMENT,
            name TEXT,
            username TEXT,
            email TEXT UNIQUE,
            password TEXT,
            specialty TEXT,
            created_at DATETIME DEFAULT CURRENT_TIMESTAMP
        );");

        // Tabela workspaces
        $db->exec("CREATE TABLE IF NOT EXISTS workspaces (
            id INTEGER PRIMARY KEY AUTOINCREMENT,
            user_id INTEGER,
            title TEXT,
            description TEXT,
            status TEXT DEFAULT 'active',
            notes TEXT,
            created_at DATETIME DEFAULT CURRENT_TIMESTAMP,
            FOREIGN KEY(user_id) REFERENCES users(id) ON DELETE CASCADE
        );");

        // Tabela cards
        $db->exec("CREATE TABLE IF NOT EXISTS cards (
            id INTEGER PRIMARY KEY AUTOINCREMENT,
            workspace_id INTEGER,
            user_id INTEGER,
            title TEXT,
            description TEXT,
            preset TEXT,
            status TEXT DEFAULT 'todo',
            urgency TEXT DEFAULT 'Medium',
            created_at DATETIME DEFAULT CURRENT_TIMESTAMP,
            FOREIGN KEY(workspace_id) REFERENCES workspaces(id) ON DELETE CASCADE,
            FOREIGN KEY(user_id) REFERENCES users(id) ON DELETE SET NULL
        );");

        // Migrações da tabela user, verifica quais colunas existem e adiciona as ausentes

        // Array existentes
        $existing = [];

        foreach ($db->query("PRAGMA table_info('users')") as $r) {
            $existing[$r['name']] = true;
        }

        // Adiciona a coluna username
        if (!isset($existing['username'])) {
            $db->exec("ALTER TABLE users ADD COLUMN username TEXT;");
            // Index ÚNICO
            $db->exec("CREATE UNIQUE INDEX IF NOT EXISTS idx_users_username ON users(username);");
        }
        // Adiciona a coluna de especialidade
        if (!isset($existing['specialty'])) {
            $db->exec("ALTER TABLE users ADD COLUMN specialty TEXT;");
        }
        // Adiciona data de criação e preenche registros antigos.
        if (!isset($existing['created_at'])) {
            $db->exec("ALTER TABLE users ADD COLUMN created_at DATETIME DEFAULT CURRENT_TIMESTAMP;");
            $db->exec("UPDATE users SET created_at = datetime('now') WHERE created_at IS NULL OR created_at = '';");
        }

        $existing = [];
        foreach ($db->query("PRAGMA table_info('workspaces')") as $r) {
            $existing[$r['name']] = true;
        }
        if (!isset($existing['status'])) {
            $db->exec("ALTER TABLE workspaces ADD COLUMN status TEXT DEFAULT 'active';");
        }
        if (!isset($existing['notes'])) {
            $db->exec("ALTER TABLE workspaces ADD COLUMN notes TEXT;");
        }
        if (!isset($existing['created_at'])) {
            $db->exec("ALTER TABLE workspaces ADD COLUMN created_at DATETIME DEFAULT CURRENT_TIMESTAMP;");
            $db->exec("UPDATE workspaces SET created_at = datetime('now') WHERE created_at IS NULL OR created_at = '';");
        }

        $existing = [];
        foreach ($db->query("PRAGMA table_info('cards')") as $r) {
            $existing[$r['name']] = true;
        }
        if (!isset($existing['status'])) {
            $db->exec("ALTER TABLE cards ADD COLUMN status TEXT DEFAULT 'todo';");
        }
        if (!isset($existing['urgency'])) {
            $db->exec("ALTER TABLE cards ADD COLUMN urgency TEXT DEFAULT 'Medium';");
        }
        if (!isset($existing['created_at'])) {
            $db->exec("ALTER TABLE cards ADD COLUMN created_at DATETIME DEFAULT CURRENT_TIMESTAMP;");
            $db->exec("UPDATE cards SET created_at = datetime('now') WHERE created_at IS NULL OR created_at = '';");
        }

        // PRA QUE MIGRATE AQUI? -> PRETENDO MUDAR O SISTEMA EM BREVE, ISSO FACILITA AS COISAS
    }
}
