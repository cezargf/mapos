<?php

class Migration_change_column_quantidade_estoque_produtos extends CI_Migration
{
    public function up()
    {
        $this->db->query("ALTER TABLE `mapos`.`produtos` CHANGE COLUMN `estoque` `estoque` DOUBLE NOT NULL ;");
        $this->db->query("ALTER TABLE `mapos`.`produtos_os` CHANGE COLUMN `quantidade` `quantidade` DOUBLE NOT NULL;");
    }

    public function down()
    {
        $this->db->query("ALTER TABLE `mapos`.`produtos` CHANGE COLUMN `estoque` `estoque` INT NOT NULL;");
        $this->db->query("ALTER TABLE `mapos`.`produtos_os` CHANGE COLUMN `quantidade` `quantidade` INT NOT NULL;");
    }
}
