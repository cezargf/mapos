<?php

class Migration_change_column_quantidade_table_itens_de_vendas extends CI_Migration
{
    public function up()
    {
        $this->db->query("ALTER TABLE `mapos`.`itens_de_vendas` CHANGE COLUMN `quantidade` `quantidade` DOUBLE NOT NULL;");
    }

    public function down()
    {
        $this->db->query("ALTER TABLE `mapos`.`itens_de_vendas` CHANGE COLUMN `quantidade` `quantidade` INT(11) NULL;");
    }
}
