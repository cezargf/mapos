<?php

class Migration_update_fields_clientes_table extends CI_Migration
{
    public function up()
    {
        if (!$this->db->table_exists('usuarios_clientes')) {
            $this->dbforge->add_field([
                'idUsuariosClientes' => ['type' => 'INT', 'constraint' => 11, 'unsigned' => true, 'auto_increment' => true],
                'nome' => ['type' => 'VARCHAR', 'constraint' => '255', 'null' => false],
                'email' => ['type' => 'VARCHAR', 'constraint' => '100', 'null' => false],
                'senha' => ['type' => 'VARCHAR', 'constraint' => '200', 'null' => false],
                'situacao' => ['type' => 'TINYINT', 'constraint' => 1, 'default' => 1, 'null' => false],
                'dataCadastro' => ['type' => 'DATETIME', 'null' => false],
            ]);
            $this->dbforge->add_key('idUsuariosClientes', true);
            $this->dbforge->add_key('email', false);
            $this->dbforge->create_table('usuarios_clientes', true);
        }
        if (!$this->db->table_exists('vinculos_usuarios_clientes')) {
            $this->dbforge->add_field([
                'idVinculo' => ['type' => 'INT', 'constraint' => 11, 'unsigned' => true, 'auto_increment' => true],
                'usuarios_clientes_id' => ['type' => 'INT', 'constraint' => 11, 'unsigned' => true, 'null' => false],
                'clientes_id' => ['type' => 'INT', 'constraint' => 11, 'null' => false],
                'tipo' => ['type' => 'VARCHAR', 'constraint' => '20', 'default' => 'admin', 'null' => false],
            ]);
            $this->dbforge->add_key('idVinculo', true);
            $this->dbforge->create_table('vinculos_usuarios_clientes', true);
            $this->db->query("ALTER TABLE `vinculos_usuarios_clientes` ADD CONSTRAINT `fk_vinculo_usuario_cliente` FOREIGN KEY (`usuarios_clientes_id`) REFERENCES `usuarios_clientes` (`idUsuariosClientes`) ON DELETE CASCADE ON UPDATE NO ACTION");
            $this->db->query("ALTER TABLE `vinculos_usuarios_clientes` ADD CONSTRAINT `fk_vinculo_cliente_usuario` FOREIGN KEY (`clientes_id`) REFERENCES `clientes` (`idClientes`) ON DELETE CASCADE ON UPDATE NO ACTION");
        }

        if (!$this->db->table_exists('contatos')) {
            $this->dbforge->add_field([
                'idContatos' => ['type' => 'INT', 'constraint' => 11, 'unsigned' => true, 'auto_increment' => true],
                'cliente_id' => ['type' => 'INT', 'constraint' => 11, 'null' => false],
                'nome' => ['type' => 'VARCHAR', 'constraint' => '255', 'null' => false],
                'telefone' => ['type' => 'TEXT', 'null' => true],
                'celular' => ['type' => 'TEXT', 'null' => true],
                'email' => ['type' => 'TEXT', 'null' => true],
                'cargo' => ['type' => 'VARCHAR', 'constraint' => '100', 'null' => true],
                'observacoes' => ['type' => 'TEXT', 'null' => true],
                'dataCadastro' => ['type' => 'DATETIME DEFAULT CURRENT_TIMESTAMP', 'null' => false],
            ]);
            $this->dbforge->add_key('idContatos', true);
            $this->dbforge->create_table('contatos', true);
            $this->db->query("ALTER TABLE `contatos` ADD CONSTRAINT `fk_contatos` FOREIGN KEY (`cliente_id`) REFERENCES `clientes` (`idClientes`) ON DELETE CASCADE ON UPDATE NO ACTION");
        }
        if ($this->db->table_exists('clientes')) {
            $this->dbforge->modify_column('clientes', [
                'email' => ['type' => 'VARCHAR', 'constraint' => '255', 'null' => false],
                'rua' => ['type' => 'VARCHAR', 'constraint' => '255', 'null' => true],
                'bairro' => ['type' => 'VARCHAR', 'constraint' => '100', 'null' => true],
                'cidade' => ['type' => 'VARCHAR', 'constraint' => '100', 'null' => true],
                'cep' => ['type' => 'VARCHAR', 'constraint' => '10', 'null' => true],
                'telefone' => ['type' => 'VARCHAR', 'constraint' => '25', 'null' => false],
                'celular' => ['type' => 'VARCHAR', 'constraint' => '25', 'null' => true],
                'numero' => ['type' => 'VARCHAR', 'constraint' => '10', 'null' => true],
                'complemento' => ['type' => 'VARCHAR', 'constraint' => '100', 'null' => true],
                'contato' => ['type' => 'VARCHAR', 'constraint' => '100', 'null' => true],
            ]);
            $columns_to_add_clientes = [
                'ie' => ['type' => 'VARCHAR', 'constraint' => '20', 'null' => true, 'after' => 'documento'],
                'im' => ['type' => 'VARCHAR', 'constraint' => '20', 'null' => true, 'after' => 'ie'],
                'codigo_ibge' => ['type' => 'VARCHAR', 'constraint' => '10', 'null' => true, 'after' => 'cep'],
                'tipo' => ['type' => 'VARCHAR', 'constraint' => '32', 'null' => true],
                'porte' => ['type' => 'VARCHAR', 'constraint' => '50', 'null' => true],
                'cnae' => ['type' => 'VARCHAR', 'constraint' => '7', 'null' => true],
                'fantasia' => ['type' => 'VARCHAR', 'constraint' => '255', 'null' => true],
                'atividade_principal' => ['type' => 'VARCHAR', 'constraint' => '255', 'null' => true],
                'atividades_secundarias' => ['type' => 'TEXT', 'null' => true],
                'natureza_juridica' => ['type' => 'VARCHAR', 'constraint' => '255', 'null' => true],
                'situacao' => ['type' => 'VARCHAR', 'constraint' => '50', 'null' => true],
                'data_situacao' => ['type' => 'DATE', 'null' => true],
                'motivo_situacao' => ['type' => 'VARCHAR', 'constraint' => '255', 'null' => true],
                'situacao_especial' => ['type' => 'VARCHAR', 'constraint' => '100', 'null' => true],
                'data_situacao_especial' => ['type' => 'DATE', 'null' => true],
                'capital_social' => ['type' => 'VARCHAR', 'constraint' => '50', 'null' => true],
                'qsa' => ['type' => 'TEXT', 'null' => true],
                'nascimento' => ['type' => 'DATE', 'null' => true, 'after' => 'sexo'],
                'tratamento' => ['type' => 'VARCHAR', 'constraint' => '50', 'null' => true, 'default' => 'Sr.(a)', 'after' => 'nascimento'],
                'latitude' => ['type' => 'DECIMAL', 'constraint' => '10,8', 'null' => true],
                'longitude' => ['type' => 'DECIMAL', 'constraint' => '11,8', 'null' => true],
                'endereco_geocodificado' => ['type' => 'TEXT', 'null' => true, 'after' => 'longitude'],
                'data_enriquecimento' => ['type' => 'DATETIME', 'null' => true, 'after' => 'dataCadastro'],
                'prospectado' => ['type' => 'TINYINT', 'constraint' => 1, 'default' => 0, 'after' => 'data_enriquecimento'],
                'origem_prospeccao' => ['type' => 'VARCHAR', 'constraint' => '50', 'null' => true, 'after' => 'prospectado'],
            ];
            foreach ($columns_to_add_clientes as $column => $config) {
                if (!$this->db->field_exists($column, 'clientes')) $this->dbforge->add_column('clientes', [$column => $config]);
            }
        }
    }

    public function down()
    {
        $columns_to_drop_clientes = ['ie', 'im', 'codigo_ibge', 'tipo', 'porte', 'cnae', 'fantasia', 'atividade_principal', 'atividades_secundarias', 'natureza_juridica', 'situacao', 'data_situacao', 'motivo_situacao', 'situacao_especial', 'data_situacao_especial', 'capital_social', 'qsa', 'nascimento', 'tratamento', 'latitude', 'longitude', 'endereco_geocodificado', 'data_enriquecimento', 'prospectado', 'origem_prospeccao'];
        foreach ($columns_to_drop_clientes as $column) {
            if ($this->db->field_exists($column, 'clientes')) $this->dbforge->drop_column('clientes', $column);
        }
        if ($this->db->table_exists('clientes')) {
            $this->dbforge->modify_column('clientes', [
                'email' => ['type' => 'VARCHAR', 'constraint' => '100', 'null' => false], 'rua' => ['type' => 'VARCHAR', 'constraint' => '70', 'null' => true], 'bairro' => ['type' => 'VARCHAR', 'constraint' => '45', 'null' => true], 'cidade' => ['type' => 'VARCHAR', 'constraint' => '45', 'null' => true], 'cep' => ['type' => 'VARCHAR', 'constraint' => '20', 'null' => true], 'telefone' => ['type' => 'VARCHAR', 'constraint' => '20', 'null' => false], 'celular' => ['type' => 'VARCHAR', 'constraint' => '20', 'null' => true], 'numero' => ['type' => 'VARCHAR', 'constraint' => '15', 'null' => true], 'complemento' => ['type' => 'VARCHAR', 'constraint' => '45', 'null' => true], 'contato' => ['type' => 'VARCHAR', 'constraint' => '45', 'null' => true],
            ]);
        }
        $this->dbforge->drop_table('contatos', true);

        $this->dbforge->drop_table('vinculos_usuarios_clientes', true);
        $this->dbforge->drop_table('usuarios_clientes', true);
    }
}
