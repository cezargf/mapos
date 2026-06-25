-- Atualização consolidada das tabelas clientes, produtos e servicos.
-- Versão: 4.54.0 para 4.55.0
-- Data: 28 de maio de 2026

-- =====================================================================
-- NOVAS TABELAS DE USUARIOS/CLIENTES
-- =====================================================================

CREATE TABLE IF NOT EXISTS `usuarios_clientes` (
  `idUsuariosClientes` INT(11) UNSIGNED NOT NULL AUTO_INCREMENT,
  `nome` VARCHAR(255) NOT NULL,
  `email` VARCHAR(100) NOT NULL,
  `senha` VARCHAR(200) NOT NULL,
  `situacao` TINYINT(1) NOT NULL DEFAULT 1,
  `dataCadastro` DATETIME NOT NULL,
  PRIMARY KEY (`idUsuariosClientes`),
  KEY `idx_usuarios_clientes_email` (`email`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

CREATE TABLE IF NOT EXISTS `vinculos_usuarios_clientes` (
  `idVinculo` INT(11) UNSIGNED NOT NULL AUTO_INCREMENT,
  `usuarios_clientes_id` INT(11) UNSIGNED NOT NULL,
  `clientes_id` INT(11) NOT NULL,
  `tipo` VARCHAR(20) NOT NULL DEFAULT 'admin',
  PRIMARY KEY (`idVinculo`),
  KEY `idx_vinculos_usuarios_clientes_usuario` (`usuarios_clientes_id`),
  KEY `idx_vinculos_usuarios_clientes_cliente` (`clientes_id`),
  CONSTRAINT `fk_vinculo_usuario_cliente` FOREIGN KEY (`usuarios_clientes_id`) REFERENCES `usuarios_clientes` (`idUsuariosClientes`) ON DELETE CASCADE ON UPDATE NO ACTION,
  CONSTRAINT `fk_vinculo_cliente_usuario` FOREIGN KEY (`clientes_id`) REFERENCES `clientes` (`idClientes`) ON DELETE CASCADE ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- Garante constraints caso a tabela ja exista sem FKs
SET @stmt = (
  SELECT IF(
    (SELECT COUNT(*) FROM information_schema.TABLE_CONSTRAINTS
      WHERE CONSTRAINT_SCHEMA = DATABASE()
        AND TABLE_NAME = 'vinculos_usuarios_clientes'
        AND CONSTRAINT_NAME = 'fk_vinculo_usuario_cliente') = 0,
    'ALTER TABLE `vinculos_usuarios_clientes` ADD CONSTRAINT `fk_vinculo_usuario_cliente` FOREIGN KEY (`usuarios_clientes_id`) REFERENCES `usuarios_clientes` (`idUsuariosClientes`) ON DELETE CASCADE ON UPDATE NO ACTION',
    'SELECT 1'
  )
);
PREPARE s FROM @stmt;
EXECUTE s;
DEALLOCATE PREPARE s;

SET @stmt = (
  SELECT IF(
    (SELECT COUNT(*) FROM information_schema.TABLE_CONSTRAINTS
      WHERE CONSTRAINT_SCHEMA = DATABASE()
        AND TABLE_NAME = 'vinculos_usuarios_clientes'
        AND CONSTRAINT_NAME = 'fk_vinculo_cliente_usuario') = 0,
    'ALTER TABLE `vinculos_usuarios_clientes` ADD CONSTRAINT `fk_vinculo_cliente_usuario` FOREIGN KEY (`clientes_id`) REFERENCES `clientes` (`idClientes`) ON DELETE CASCADE ON UPDATE NO ACTION',
    'SELECT 1'
  )
);
PREPARE s FROM @stmt;
EXECUTE s;
DEALLOCATE PREPARE s;

-- =====================================================================
-- ALTERAÇÕES NA TABELA CLIENTES
-- =====================================================================

-- Aumentar tamanho do campo email para validar emails corporativos longos
ALTER TABLE `clientes` MODIFY COLUMN `email` VARCHAR(255) NOT NULL;

-- Aumentar tamanho do campo rua (logradouro) para suportar endereços mais longos
ALTER TABLE `clientes` MODIFY COLUMN `rua` VARCHAR(255) NULL;

-- Aumentar tamanho do campo bairro (padrão com emitente)
ALTER TABLE `clientes` MODIFY COLUMN `bairro` VARCHAR(100) NULL;

-- Aumentar tamanho do campo cidade (padrão com emitente)
ALTER TABLE `clientes` MODIFY COLUMN `cidade` VARCHAR(100) NULL;

-- Ajustar tamanho do campo cep (padrão com emitente)
ALTER TABLE `clientes` MODIFY COLUMN `cep` VARCHAR(10) NULL;

-- Aumentar tamanho do campo telefone (padrão com emitente)
ALTER TABLE `clientes` MODIFY COLUMN `telefone` VARCHAR(25) NOT NULL;

-- Aumentar tamanho do campo celular (opcional, mas padrão)
ALTER TABLE `clientes` MODIFY COLUMN `celular` VARCHAR(25) NULL;

-- Ajustar tamanho do campo numero
ALTER TABLE `clientes` MODIFY COLUMN `numero` VARCHAR(10) NULL;

-- Aumentar tamanho do campo complemento
ALTER TABLE `clientes` MODIFY COLUMN `complemento` VARCHAR(100) NULL;

-- Aumentar tamanho do campo contato
ALTER TABLE `clientes` MODIFY COLUMN `contato` VARCHAR(100) NULL;

-- Inserir campos para dados pessoais de clientes pessoa física (nascimento e tratamento)
ALTER TABLE `clientes` ADD COLUMN IF NOT EXISTS `nascimento` DATE NULL AFTER `sexo`;
ALTER TABLE `clientes` ADD COLUMN IF NOT EXISTS `tratamento` VARCHAR(50) NULL DEFAULT 'Sr.(a)' AFTER `nascimento`;

-- Adicionar campos de dados empresariais na tabela clientes.
ALTER TABLE `clientes` ADD COLUMN IF NOT EXISTS `ie` VARCHAR(20) NULL AFTER `documento`;
ALTER TABLE `clientes` ADD COLUMN IF NOT EXISTS `im` VARCHAR(20) NULL AFTER `ie`;
ALTER TABLE `clientes` ADD COLUMN IF NOT EXISTS `codigo_ibge` VARCHAR(10) NULL AFTER `cep`;
ALTER TABLE `clientes` ADD COLUMN IF NOT EXISTS `tipo` VARCHAR(32) NULL AFTER `complemento`;
ALTER TABLE `clientes` ADD COLUMN IF NOT EXISTS `porte` VARCHAR(50) NULL AFTER `tipo`;
ALTER TABLE `clientes` ADD COLUMN IF NOT EXISTS `cnae` VARCHAR(7) NULL AFTER `porte`;
ALTER TABLE `clientes` ADD COLUMN IF NOT EXISTS `fantasia` VARCHAR(255) NULL AFTER `cnae`;
ALTER TABLE `clientes` ADD COLUMN IF NOT EXISTS `atividade_principal` VARCHAR(255) NULL AFTER `fantasia`;
ALTER TABLE `clientes` ADD COLUMN IF NOT EXISTS `atividades_secundarias` TEXT NULL AFTER `atividade_principal`;
ALTER TABLE `clientes` ADD COLUMN IF NOT EXISTS `natureza_juridica` VARCHAR(255) NULL AFTER `atividades_secundarias`;
ALTER TABLE `clientes` ADD COLUMN IF NOT EXISTS `situacao` VARCHAR(50) NULL AFTER `natureza_juridica`;
ALTER TABLE `clientes` ADD COLUMN IF NOT EXISTS `data_situacao` DATE NULL AFTER `situacao`;
ALTER TABLE `clientes` ADD COLUMN IF NOT EXISTS `motivo_situacao` VARCHAR(255) NULL AFTER `data_situacao`;
ALTER TABLE `clientes` ADD COLUMN IF NOT EXISTS `situacao_especial` VARCHAR(100) NULL AFTER `motivo_situacao`;
ALTER TABLE `clientes` ADD COLUMN IF NOT EXISTS `data_situacao_especial` DATE NULL AFTER `situacao_especial`;
ALTER TABLE `clientes` ADD COLUMN IF NOT EXISTS `capital_social` VARCHAR(50) NULL AFTER `data_situacao_especial`;
ALTER TABLE `clientes` ADD COLUMN IF NOT EXISTS `qsa` TEXT NULL AFTER `capital_social`;
ALTER TABLE `clientes` ADD COLUMN IF NOT EXISTS `latitude` DECIMAL(10,8) NULL AFTER `qsa`;
ALTER TABLE `clientes` ADD COLUMN IF NOT EXISTS `longitude` DECIMAL(11,8) NULL AFTER `latitude`;
ALTER TABLE `clientes` ADD COLUMN IF NOT EXISTS `endereco_geocodificado` TEXT NULL AFTER `longitude`;
ALTER TABLE `clientes` ADD COLUMN IF NOT EXISTS `data_enriquecimento` DATETIME NULL AFTER `dataCadastro`;
ALTER TABLE `clientes` ADD COLUMN IF NOT EXISTS `prospectado` TINYINT(1) NOT NULL DEFAULT 0 AFTER `data_enriquecimento`;
ALTER TABLE `clientes` ADD COLUMN IF NOT EXISTS `origem_prospeccao` VARCHAR(50) NULL AFTER `prospectado`;

-- =====================================================================
-- Criar tabela para contatos de clientes
-- =====================================================================

CREATE TABLE IF NOT EXISTS `contatos` (
  `idContatos` INT(11) UNSIGNED NOT NULL AUTO_INCREMENT,
  `cliente_id` INT(11) NOT NULL,
  `nome` VARCHAR(255) NOT NULL,
  `telefone` TEXT DEFAULT NULL,
  `celular` TEXT DEFAULT NULL,
  `email` TEXT DEFAULT NULL,
  `cargo` VARCHAR(100) DEFAULT NULL,
  `observacoes` TEXT,
  `dataCadastro` DATETIME DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`idContatos`),
  KEY `cliente_id` (`cliente_id`),
  CONSTRAINT `fk_contatos` FOREIGN KEY (`cliente_id`) REFERENCES `clientes` (`idClientes`) ON DELETE CASCADE ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- Garante constraint FK de contatos se a tabela ja existir sem relacao
SET @stmt = (
  SELECT IF(
    (SELECT COUNT(*) FROM information_schema.TABLE_CONSTRAINTS
      WHERE CONSTRAINT_SCHEMA = DATABASE()
        AND TABLE_NAME = 'contatos'
        AND CONSTRAINT_NAME = 'fk_contatos') = 0,
    'ALTER TABLE `contatos` ADD CONSTRAINT `fk_contatos` FOREIGN KEY (`cliente_id`) REFERENCES `clientes` (`idClientes`) ON DELETE CASCADE ON UPDATE NO ACTION',
    'SELECT 1'
  )
);
PREPARE s FROM @stmt;
EXECUTE s;
DEALLOCATE PREPARE s;
