-- Tabela para armazenar cache usando o database driver do CacheerPHP
-- Execute este SQL se estiver usando CACHE_DRIVER=database

CREATE TABLE IF NOT EXISTS `cache` (
    `id` INT AUTO_INCREMENT PRIMARY KEY,
    `key` VARCHAR(255) UNIQUE NOT NULL COMMENT 'Chave do cache',
    `value` LONGTEXT NOT NULL COMMENT 'Valor armazenado em serialização',
    `namespace` VARCHAR(100) COMMENT 'Namespace opcional para organizar caches',
    `expires_at` TIMESTAMP NULL DEFAULT NULL COMMENT 'Data/hora de expiração',
    `created_at` TIMESTAMP DEFAULT CURRENT_TIMESTAMP COMMENT 'Data de criação',
    `updated_at` TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP COMMENT 'Data de última atualização',
    INDEX `idx_key` (`key`),
    INDEX `idx_namespace` (`namespace`),
    INDEX `idx_expires_at` (`expires_at`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci COMMENT='Tabela de cache para CacheerPHP';
