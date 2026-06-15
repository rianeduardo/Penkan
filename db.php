<?php
if (realpath($_SERVER['SCRIPT_FILENAME'] ?? '') === __FILE__) {
    http_response_code(403);
    exit('Acesso negado.');
}

class DB {
    private static $pdo = null;

    public static function pdo()
    {
        if (self::$pdo) return self::$pdo;

        $dbDir = __DIR__ . DIRECTORY_SEPARATOR . 'data';
        if (!is_dir($dbDir)) mkdir($dbDir, 0755, true);
        $dbFile = $dbDir . DIRECTORY_SEPARATOR . 'db.sqlite';
        $dsn = 'sqlite:' . $dbFile;

        $pdo = new PDO($dsn);
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        self::$pdo = $pdo;

        self::init();
        return self::$pdo;
    }

    private static function init()
    {
        $db = self::$pdo;
        $db->exec('PRAGMA foreign_keys = ON;');

        $db->exec("CREATE TABLE IF NOT EXISTS users (
            id INTEGER PRIMARY KEY AUTOINCREMENT,
            name TEXT,
            username TEXT,
            email TEXT UNIQUE,
            password TEXT,
            specialty TEXT,
            created_at DATETIME DEFAULT CURRENT_TIMESTAMP
        );");

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

        // Migrate: add missing columns if DB existed before
        $existing = [];
        foreach ($db->query("PRAGMA table_info('users')") as $r) {
            $existing[$r['name']] = true;
        }
        if (!isset($existing['username'])) {
            $db->exec("ALTER TABLE users ADD COLUMN username TEXT;");
            // unique index for username
            $db->exec("CREATE UNIQUE INDEX IF NOT EXISTS idx_users_username ON users(username);");
        }
        if (!isset($existing['specialty'])) {
            $db->exec("ALTER TABLE users ADD COLUMN specialty TEXT;");
        }
        if (!isset($existing['created_at'])) {
            $db->exec("ALTER TABLE users ADD COLUMN created_at DATETIME DEFAULT CURRENT_TIMESTAMP;");
            // populate existing rows
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
    }
}
