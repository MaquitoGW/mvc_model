-- CacheerPHP 6.x: schema para MySQL/MariaDB com CACHE_DRIVER=database.
-- Execute este SQL uma vez antes de usar o driver.
-- A antiga tabela `cache` não é alterada; os dados 6.x começam vazios.
-- Para SQLite/PostgreSQL, use DatabaseStoreSchema::migrate($pdo, 'cacheer_store').

CREATE TABLE IF NOT EXISTS cacheer_store (
    cache_key VARCHAR(255) NOT NULL PRIMARY KEY,
    scope VARCHAR(255) NOT NULL,
    key_value TEXT NOT NULL,
    value LONGTEXT NOT NULL,
    created_at BIGINT NOT NULL,
    expires_at BIGINT NULL,
    INDEX idx_cacheer_store_expires (expires_at),
    INDEX idx_cacheer_store_scope (scope)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

CREATE TABLE IF NOT EXISTS cacheer_store_tags (
    tag VARCHAR(255) NOT NULL,
    cache_key VARCHAR(255) NOT NULL,
    INDEX idx_cacheer_store_tags_tag (tag)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

CREATE TABLE IF NOT EXISTS cacheer_store_locks (
    lock_name VARCHAR(255) NOT NULL PRIMARY KEY,
    owner VARCHAR(255) NOT NULL,
    expires_at BIGINT NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;
