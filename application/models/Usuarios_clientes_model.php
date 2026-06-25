<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Usuarios_clientes_model extends CI_Model
{
    public function __construct()
    {
        parent::__construct();
    }

    public function get($table, $fields, $where = '', $perpage = 0, $start = 0, $one = false, $array = 'array')
    {
        $this->db->select($fields);
        $this->db->from($table);
        $this->db->limit($perpage, $start);
        if ($where) {
            $this->db->where($where);
        }

        $query = $this->db->get();
        $result = !$one ? $query->result($array) : $query->row(0, $array);

        return $result;
    }

    public function getById($id)
    {
        $this->db->where('idUsuariosClientes', $id);
        $this->db->limit(1);
        return $this->db->get('usuarios_clientes')->row();
    }

    public function getByEmail($email)
    {
        $this->db->where('email', $email);
        $this->db->limit(1);
        return $this->db->get('usuarios_clientes')->row();
    }

    public function add($data)
    {
        $this->db->insert('usuarios_clientes', $data);
        if ($this->db->affected_rows() > 0) {
            return $this->db->insert_id();
        }
        return false;
    }

    public function edit($table, $data, $fieldID, $ID)
    {
        $this->db->where($fieldID, $ID);
        $this->db->update($table, $data);

        if ($this->db->affected_rows() >= 0) {
            return true;
        }
        return false;
    }

    public function delete($table, $fieldID, $ID)
    {
        $this->db->where($fieldID, $ID);
        $this->db->delete($table);
        if ($this->db->affected_rows() > 0) {
            return true;
        }
        return false;
    }

    public function count($table)
    {
        return $this->db->count_all($table);
    }

    public function checkCredentials($email)
    {
        $this->db->where('email', $email);
        $this->db->where('situacao', 1);
        $this->db->limit(1);
        return $this->db->get('usuarios_clientes')->row();
    }
}
