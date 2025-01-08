<?php

class Clientes_model extends CI_Model
{
    public function __construct()
    {
        parent::__construct();
    }

    public function get($table, $fields, $where = '', $perpage = 0, $start = 0, $one = false, $array = 'array')
    {
        $this->db->select($fields);
        $this->db->from($table);
        $this->db->order_by('idClientes', 'desc');
        $this->db->limit($perpage, $start);
        if ($where) {
            $this->db->like('nomeCliente', $where);
            $this->db->or_like('documento', $where);
            $this->db->or_like('email', $where);
            $this->db->or_like('telefone', $where);
        }

        $query = $this->db->get();

        $result = ! $one ? $query->result() : $query->row();

        return $result;
    }

    public function getById($id)
    {
        $this->db->where('idClientes', $id);
        $this->db->limit(1);

        return $this->db->get('clientes')->row();
    }

    public function add($table, $data)
    {
        $this->db->insert($table, $data);
        if ($this->db->affected_rows() == '1') {
            return $this->db->insert_id($table);
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
        if ($this->db->affected_rows() == '1') {
            return true;
        }

        return false;
    }

    public function count($table)
    {
        return $this->db->count_all($table);
    }

    /**
     * Retorna todas as OS vinculados ao cliente
     * @param  int  $id
     * @return array
     * 
     * Obs.: Este método deve ser removido e substituído pelo método getAllOsByClient()
     */
    public function getOsByCliente($id)
    {
        $this->db->where('clientes_id', $id);
        $this->db->order_by('idOs', 'desc');
        $this->db->limit(10);

        return $this->db->get('os')->result();
    }

    public function getAllEquipamentosByClient($id)
    {
        $this->db->select('equipamentos.*, marcas.marca as marca');
        $this->db->from('equipamentos');
        $this->db->join('marcas', 'marcas.idMarcas = equipamentos.marcas_id');
        $this->db->where('clientes_id', $id);

        return $this->db->get()->result();
    }

    public function getAllCobrancasByClient($id)
    {
        $this->db->where('clientes_id', $id);

        return $this->db->get('cobrancas')->result();
    }

    /**
     * Retorna todas as OS vinculados ao cliente
     *
     * @param  int  $id
     * @param  string  $order default null
     * @param  int  $limit default null
     * @return array
     */
    public function getAllOsByClient($id, $order = null, $limit = null)
    {
        $this->db->where('clientes_id', $id);
        if ($order) {
            $this->db->order_by('idOs', 'desc');
        }
        if ($limit) {
            $this->db->limit(10);
        }

        return $this->db->get('os')->result();
    }

    /**
     * Retorna todas as Vendas vinculados ao cliente
     *
     * @param  int  $id
     * @return array
     */
    public function getAllVendasByClient($id)
    {
        // Pesquisar itens de venda e somá-los para atribuir aos resultados das vendas
        $this->db->select('vendas.*, usuarios.nome as vendedor, SUM(itens_de_vendas.subTotal) as totalVenda');
        $this->db->from('itens_de_vendas');
        $this->db->join('vendas', 'vendas.idVendas = itens_de_vendas.vendas_id');
        $this->db->join('usuarios', 'usuarios.idUsuarios = vendas.usuarios_id');
        $this->db->where('vendas.clientes_id', $id);
        $this->db->order_by('vendas.idVendas', 'asc');
        $this->db->group_by('vendas.idVendas');

        return $this->db->get()->result();
    }

    /**
     * Remover todas as OS por cliente
     *
     * @param  array  $os
     * @return bool
     */
    public function removeClientOs($os)
    {
        try {
            foreach ($os as $o) {
                $this->db->where('os_id', $o->idOs);
                $this->db->delete('servicos_os');

                $this->db->where('os_id', $o->idOs);
                $this->db->delete('produtos_os');

                $this->db->where('idOs', $o->idOs);
                $this->db->delete('os');
            }
        } catch (Exception $e) {
            return false;
        }

        return true;
    }

    /**
     * Remover todas as Vendas por cliente
     *
     * @param  array  $vendas
     * @return bool
     */
    public function removeClientVendas($vendas)
    {
        try {
            foreach ($vendas as $v) {
                $this->db->where('vendas_id', $v->idVendas);
                $this->db->delete('itens_de_vendas');

                $this->db->where('idVendas', $v->idVendas);
                $this->db->delete('vendas');
            }
        } catch (Exception $e) {
            return false;
        }

        return true;
    }
}
