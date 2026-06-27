<?php

class Migration_add_nome_fantasia_to_emitente_table extends CI_Migration
{
    public function up()
    {
        if (!$this->db->table_exists('emitente')) {
            return;
        }

        if (!$this->db->field_exists('nome_fantasia', 'emitente')) {
            $this->dbforge->add_column('emitente', [
                'nome_fantasia' => [
                    'type' => 'VARCHAR',
                    'constraint' => '255',
                    'null' => true,
                    'after' => 'nome',
                ],
            ]);
        }
    }

    public function down()
    {
        if ($this->db->table_exists('emitente') && $this->db->field_exists('nome_fantasia', 'emitente')) {
            $this->dbforge->drop_column('emitente', 'nome_fantasia');
        }
    }
}