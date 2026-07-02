<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Migration_update_fields_produtos_table extends CI_Migration
{
    public function up()
    {
        $this->dbforge->modify_column('produtos', [
            'descricao' => [
                'type' => 'VARCHAR',
                'constraint' => '255',
                'null' => false,
            ],
        ]);

        // Reconciliamos cada coluna individualmente para bases que já tenham parte
        // desses campos por migrations anteriores, garantindo também a posição final.
        $this->syncProdutoColumn('codDeFabrica', 'VARCHAR(255) NULL', 'codDeBarra');
        $this->syncProdutoColumn('nome', 'VARCHAR(255) NOT NULL', 'codDeFabrica');
        $this->syncProdutoColumn('modelo', 'VARCHAR(100) NULL', 'descricao');
        $this->syncProdutoColumn('fabricante', 'VARCHAR(100) NULL', 'modelo');
        $this->syncProdutoColumn('url_pagina', 'VARCHAR(255) NULL', 'entrada');
        $this->syncProdutoColumn('url_especificacoes', 'VARCHAR(255) NULL', 'url_pagina');
        $this->syncProdutoColumn('url_manual', 'VARCHAR(255) NULL', 'url_especificacoes');
        $this->syncProdutoColumn('ncm', 'VARCHAR(20) NULL', 'url_manual');
        $this->syncProdutoColumn('cest', 'VARCHAR(20) NULL', 'ncm');
        $this->syncProdutoColumn('origem', 'VARCHAR(1) NULL', 'cest');
        $this->syncProdutoColumn('cst_csosn', 'VARCHAR(10) NULL', 'origem');
        $this->syncProdutoColumn('ibs_cbs', 'VARCHAR(50) NULL', 'cst_csosn');
        $this->syncProdutoColumn('aliquota_icms', 'DECIMAL(10,2) NULL DEFAULT 0.00', 'ibs_cbs');

        // Cria tabela produtos_imagens com chave estrangeira
        $this->dbforge->add_field([
            'idImagens' => ['type' => 'INT', 'constraint' => 11, 'unsigned' => true, 'auto_increment' => true],
            'url' => ['type' => 'VARCHAR', 'constraint' => '255', 'null' => false],
            'thumb' => ['type' => 'VARCHAR', 'constraint' => '255', 'null' => false],
            'path' => ['type' => 'VARCHAR', 'constraint' => '255', 'null' => false],
            'principal' => ['type' => 'TINYINT', 'constraint' => '1', 'null' => false, 'default' => 0],
            'produtos_id' => ['type' => 'INT', 'constraint' => 11, 'unsigned' => true, 'null' => false],
        ]);
        $this->dbforge->add_key('idImagens', true);
        $this->dbforge->create_table('produtos_imagens');

        // Adiciona constraint de chave estrangeira
        $this->db->query("ALTER TABLE `produtos_imagens` ADD CONSTRAINT `fk_produtos_imagens_produtos1` FOREIGN KEY (`produtos_id`) REFERENCES `produtos` (`idProdutos`) ON DELETE CASCADE ON UPDATE NO ACTION");
    }

    private function syncProdutoColumn($column, $definition, $after)
    {
        $action = $this->db->field_exists($column, 'produtos') ? 'MODIFY' : 'ADD';

        $this->db->query(sprintf(
            'ALTER TABLE `produtos` %s `%s` %s AFTER `%s`',
            $action,
            $column,
            $definition,
            $after
        ));
    }

    public function down()
    {
        // Remove tabela produtos_imagens (remove also principal field)
        if ($this->db->table_exists('produtos_imagens')) {
            $this->dbforge->drop_table('produtos_imagens');
        }

        // Remove colunas adicionadas da tabela produtos
        if ($this->db->field_exists('codDeFabrica', 'produtos')) {
            $this->dbforge->drop_column('produtos', 'codDeFabrica');
        }
        if ($this->db->field_exists('nome', 'produtos')) {
            $this->dbforge->drop_column('produtos', 'nome');
        }
        if ($this->db->field_exists('modelo', 'produtos')) {
            $this->dbforge->drop_column('produtos', 'modelo');
        }
        if ($this->db->field_exists('fabricante', 'produtos')) {
            $this->dbforge->drop_column('produtos', 'fabricante');
        }
        if ($this->db->field_exists('url_pagina', 'produtos')) {
            $this->dbforge->drop_column('produtos', 'url_pagina');
        }
        if ($this->db->field_exists('url_especificacoes', 'produtos')) {
            $this->dbforge->drop_column('produtos', 'url_especificacoes');
        }
        if ($this->db->field_exists('url_manual', 'produtos')) {
            $this->dbforge->drop_column('produtos', 'url_manual');
        }
        if ($this->db->field_exists('ncm', 'produtos')) {
            $this->dbforge->drop_column('produtos', 'ncm');
        }
        if ($this->db->field_exists('cest', 'produtos')) {
            $this->dbforge->drop_column('produtos', 'cest');
        }
        if ($this->db->field_exists('origem', 'produtos')) {
            $this->dbforge->drop_column('produtos', 'origem');
        }
        if ($this->db->field_exists('cst_csosn', 'produtos')) {
            $this->dbforge->drop_column('produtos', 'cst_csosn');
        }
        if ($this->db->field_exists('ibs_cbs', 'produtos')) {
            $this->dbforge->drop_column('produtos', 'ibs_cbs');
        }
        if ($this->db->field_exists('aliquota_icms', 'produtos')) {
            $this->dbforge->drop_column('produtos', 'aliquota_icms');
        }

        // Reverte a modificação da coluna descricao para seu tamanho original
        $this->dbforge->modify_column('produtos', [
            'descricao' => ['type' => 'VARCHAR', 'constraint' => '80', 'null' => false],
        ]);
    }
}
