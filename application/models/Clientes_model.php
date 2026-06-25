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

    public function getOsByCliente($id)
    {
        $this->db->where('clientes_id', $id);
        $this->db->order_by('idOs', 'desc');
        $this->db->limit(10);

        return $this->db->get('os')->result();
    }

    /**
     * Retorna todas as OS vinculados ao cliente
     *
     * @param  int  $id
     * @return array
     */
    public function getAllOsByClient($id)
    {
        $this->db->where('clientes_id', $id);

        return $this->db->get('os')->result();
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
     * Retorna todas as Vendas vinculados ao cliente
     *
     * @param  int  $id
     * @return array
     */
    public function getAllVendasByClient($id)
    {
        $this->db->where('clientes_id', $id);

        return $this->db->get('vendas')->result();
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

    /**
     * Verifica se o e-mail já existe na tabela de clientes
     *
     * @param  string  $email
     * @param  int     $id (opcional, para excluir o próprio cliente na edição)
     * @return bool
     */
    public function emailExists($email, $id = null)
    {
        $this->db->where('email', $email);
        
        if ($id !== null) {
            $this->db->where('idClientes !=', $id);
        }
        
        $query = $this->db->get('clientes');
        
        return $query->num_rows() > 0;
    }

    public function addVinculo($data)
    {
        $this->db->insert('vinculos_usuarios_clientes', $data);
        return $this->db->affected_rows() > 0;
    }

    public function removeVinculo($usuario_id, $cliente_id)
    {
        $this->db->where('usuarios_clientes_id', $usuario_id);
        $this->db->where('clientes_id', $cliente_id);
        $this->db->delete('vinculos_usuarios_clientes');
        return $this->db->affected_rows() > 0;
    }

    public function getUsuariosVinculados($cliente_id)
    {
        $this->db->select('uc.*, v.tipo, v.idVinculo');
        $this->db->from('usuarios_clientes uc');
        $this->db->join('vinculos_usuarios_clientes v', 'v.usuarios_clientes_id = uc.idUsuariosClientes');
        $this->db->where('v.clientes_id', $cliente_id);
        return $this->db->get()->result();
    }

    public function getClientesVinculados($usuario_id)
    {
        $this->db->select('c.*, v.tipo');
        $this->db->from('clientes c');
        $this->db->join('vinculos_usuarios_clientes v', 'v.clientes_id = c.idClientes');
        $this->db->where('v.usuarios_clientes_id', $usuario_id);
        return $this->db->get()->result();
    }

    public function checkVinculoExists($usuario_id, $cliente_id)
    {
        $this->db->where('usuarios_clientes_id', $usuario_id);
        $this->db->where('clientes_id', $cliente_id);
        return $this->db->get('vinculos_usuarios_clientes')->num_rows() > 0;
    }

    public function countPendencias($id)
    {
        $pendencias = [];

        $this->db->where('clientes_id', $id);
        $pendencias['os'] = $this->db->count_all_results('os');

        $this->db->where('clientes_id', $id);
        $pendencias['vendas'] = $this->db->count_all_results('vendas');

        $this->db->where('clientes_id', $id);
        $this->db->where('baixado', 0);
        $pendencias['lancamentos'] = $this->db->count_all_results('lancamentos');

        $this->db->where('clientes_id', $id);
        $this->db->where('status !=', 'paid');
        $pendencias['cobrancas'] = $this->db->count_all_results('cobrancas');

        return $pendencias;
    }

    public function baixarPendencias($id)
    {
        $this->db->set('baixado', 1);
        $this->db->set('data_pagamento', date('Y-m-d'));
        $this->db->where('clientes_id', $id);
        $this->db->where('baixado', 0);
        $this->db->update('lancamentos');

        $this->db->set('status', 'paid');
        $this->db->where('clientes_id', $id);
        $this->db->where('status !=', 'paid');
        $this->db->update('cobrancas');

        return true;
    }

    public function getClientesWithPendencias()
    {
        $this->db->select('c.*, 
            (SELECT COUNT(*) FROM os o WHERE o.clientes_id = c.idClientes) AS os_pendentes,
            (SELECT COUNT(*) FROM vendas v WHERE v.clientes_id = c.idClientes) AS vendas_pendentes,
            (SELECT COUNT(*) FROM lancamentos l WHERE l.clientes_id = c.idClientes AND l.baixado = 0) AS lancamentos_pendentes,
            (SELECT COUNT(*) FROM cobrancas cb WHERE cb.clientes_id = c.idClientes AND cb.status != "paid") AS cobrancas_pendentes
        ');
        $this->db->from('clientes c');
        return $this->db->get()->result();
    }

    public function autocompleteCliente($term)
    {
        $this->db->select('idClientes, nomeCliente, documento, email, telefone, rua, numero');
        $this->db->from('clientes');
        $this->db->group_start();
        $this->db->like('nomeCliente', $term);
        $this->db->or_like('documento', $term);
        $this->db->or_like('email', $term);
        $this->db->or_like('telefone', $term);
        $this->db->or_like('endereco_geocodificado', $term);
        $this->db->or_like('rua', $term);
        $this->db->group_end();
        return $this->db->get()->result();
    }

    private function _applyFilters($pesquisa, $estado, $cidade, $tipo, $pessoa_fisica)
    {
        if ($pesquisa) {
            $this->db->group_start();
            $this->db->like('nomeCliente', $pesquisa);
            $this->db->or_like('documento', $pesquisa);
            $this->db->or_like('email', $pesquisa);
            $this->db->or_like('telefone', $pesquisa);
            $this->db->or_like('endereco_geocodificado', $pesquisa);
            $this->db->or_like('rua', $pesquisa);
            $this->db->or_like('numero', $pesquisa);
            $this->db->group_end();
        }

        if ($estado !== null && $estado !== '') {
            $estadoArray = is_array($estado) ? $estado : explode(',', (string)$estado);
            $estadoArray = array_filter(array_map('trim', $estadoArray), function($v) { return $v !== ''; });
            
            if (!empty($estadoArray)) {
                if (count($estadoArray) === 1) {
                    $this->db->where('estado', reset($estadoArray));
                } else {
                    $this->db->where_in('estado', $estadoArray);
                }
            }
        }

        if ($cidade !== null && $cidade !== '') {
            $cidadeArray = is_array($cidade) ? $cidade : explode(',', (string)$cidade);
            $normalizedCidade = [];
            foreach ($cidadeArray as $c) {
                if (is_string($c) && strpos($c, ',') !== false) {
                    $normalizedCidade = array_merge($normalizedCidade, explode(',', $c));
                } else {
                    $normalizedCidade[] = $c;
                }
            }
            $normalizedCidade = array_filter(array_unique(array_map('trim', $normalizedCidade)), function($v) { return $v !== ''; });
            
            if (!empty($normalizedCidade)) {
                if (count($normalizedCidade) === 1) {
                    $this->db->where('cidade', reset($normalizedCidade));
                } else {
                    $this->db->where_in('cidade', $normalizedCidade);
                }
            }
        }

        if ($tipo !== null && $tipo !== '') {
            $this->db->where('fornecedor', $tipo);
        }

        if ($pessoa_fisica !== null && $pessoa_fisica !== '') {
            $this->db->where('pessoa_fisica', $pessoa_fisica);
        }
    }

    public function countWithFilters($pesquisa, $estado, $cidade, $tipo, $pessoa_fisica = null)
    {
        $this->_applyFilters($pesquisa, $estado, $cidade, $tipo, $pessoa_fisica);
        return $this->db->count_all_results('clientes');
    }

    public function getWithFilters($pesquisa, $estado, $cidade, $tipo, $sort, $order, $perpage, $start, $pessoa_fisica = null)
    {
        $this->db->select('*');
        $this->db->from('clientes');
        $this->_applyFilters($pesquisa, $estado, $cidade, $tipo, $pessoa_fisica);
        $this->db->order_by($sort, $order);
        $this->db->limit($perpage, $start);
        return $this->db->get()->result();
    }

    public function getGeographicData($pesquisa, $estado, $cidade, $tipo, $pessoa_fisica = null)
    {
        $this->db->select('idClientes, nomeCliente, cidade, estado, rua, numero, latitude, longitude, fornecedor, pessoa_fisica');
        $this->db->from('clientes');
        $this->db->where('latitude IS NOT NULL');
        $this->db->where('longitude IS NOT NULL');
        $this->_applyFilters($pesquisa, $estado, $cidade, $tipo, $pessoa_fisica);
        return $this->db->get()->result();
    }
}
