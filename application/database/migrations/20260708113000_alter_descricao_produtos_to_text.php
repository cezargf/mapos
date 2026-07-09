<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Migration_alter_descricao_produtos_to_text extends CI_Migration
{
    public function up()
    {
        if (! $this->db->table_exists('produtos') || ! $this->db->field_exists('descricao', 'produtos')) {
            return;
        }

        $this->dbforge->modify_column('produtos', [
            'descricao' => [
                'type' => 'TEXT',
                'null' => false,
            ],
        ]);
    }

    public function down()
    {
        if (! $this->db->table_exists('produtos') || ! $this->db->field_exists('descricao', 'produtos')) {
            return;
        }

        $this->dbforge->modify_column('produtos', [
            'descricao' => [
                'type' => 'VARCHAR',
                'constraint' => '255',
                'null' => false,
            ],
        ]);
    }
}
