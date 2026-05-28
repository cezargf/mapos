-- Atualização da tabela emitente.
-- Versão: 4.53.2 para 4.54.0
-- Data: 19 de março de 2026

-- =====================================================================
-- ALTERAÇÕES NA TABELA EMITENTE
-- =====================================================================

-- Aumentar tamanho do campo rua (logradouro) para suportar endereços mais longos
ALTER TABLE `emitente` MODIFY COLUMN `rua` VARCHAR(255) NULL;

-- Aumentar tamanho do campo bairro
ALTER TABLE `emitente` MODIFY COLUMN `bairro` VARCHAR(100) NULL;

-- Aumentar tamanho do campo cidade
ALTER TABLE `emitente` MODIFY COLUMN `cidade` VARCHAR(100) NULL;

-- Ajustar tamanho do campo numero (reduzir, pois números não precisam de 15 caracteres)
ALTER TABLE `emitente` MODIFY COLUMN `numero` VARCHAR(10) NULL;

-- Ajustar tamanho do campo cep (padrão brasileiro é 8 dígitos + formatação)
ALTER TABLE `emitente` MODIFY COLUMN `cep` VARCHAR(10) NULL;

-- Aumentar tamanho do campo telefone para suportar números internacionais
ALTER TABLE `emitente` MODIFY COLUMN `telefone` VARCHAR(25) NULL;

-- Ajustar tamanho do campo cnpj para formato padrão brasileiro
ALTER TABLE `emitente` MODIFY COLUMN `cnpj` VARCHAR(18) NULL;

-- Ajustar tamanho do campo ie (inscrição estadual)
ALTER TABLE `emitente` MODIFY COLUMN `ie` VARCHAR(20) NULL;

-- Adicionar campo IM (Inscrição Municipal) na tabela emitente
ALTER TABLE `emitente` ADD COLUMN `im` VARCHAR(20) NULL AFTER `ie`;

-- Adicionar campo complemento para endereço
ALTER TABLE `emitente` ADD COLUMN `complemento` VARCHAR(255) NULL AFTER `numero`;

-- Adicionar campo cnae para classificação econômica (Código Nacional de Atividade Econômica)
ALTER TABLE `emitente` ADD COLUMN `cnae` VARCHAR(10) NULL AFTER `im`;

-- Adicionar campo atividade_principal para descrição da atividade principal da empresa
ALTER TABLE `emitente` ADD COLUMN `atividade_principal` TEXT NULL AFTER `cnae`;

-- Adicionar campo situação para status da empresa (Ativa, Inativa, Suspensa, etc.)
ALTER TABLE `emitente` ADD COLUMN `situacao` VARCHAR(50) NULL AFTER `atividade_principal`;

-- Adicionar campo data_situacao para registrar a data da última mudança de situação
ALTER TABLE `emitente` ADD COLUMN `data_situacao` DATE NULL AFTER `situacao`;

-- Adicionar campo data_abertura para registrar a data de abertura da empresa (útil para histórico e validação de dados)
ALTER TABLE `emitente` ADD COLUMN `data_abertura` DATE NULL AFTER `data_situacao`;

-- Adicionar campo natureza_juridica para classificação da natureza jurídica da empresa (Ex: MEI, LTDA, EIRELI, etc.)
ALTER TABLE `emitente` ADD COLUMN `natureza_juridica` VARCHAR(100) NULL AFTER `data_abertura`;

-- Adicionar campo porte para classificação do porte da empresa (Ex: Microempresa, Pequena, Média, Grande)
ALTER TABLE `emitente` ADD COLUMN `porte` VARCHAR(50) NULL AFTER `natureza_juridica`;

-- Adicionar campo capital_social para registrar o capital social da empresa
ALTER TABLE `emitente` ADD COLUMN `capital_social` DECIMAL(15,2) NULL AFTER `porte`;

-- Adicionar campo qsa para registrar os sócios e administradores da empresa (pode ser um JSON ou texto estruturado)
ALTER TABLE `emitente` ADD COLUMN `qsa` TEXT NULL AFTER `capital_social`;

-- Campo email já está adequado com VARCHAR(255)
-- Campo uf permanece VARCHAR(20) para siglas de estado