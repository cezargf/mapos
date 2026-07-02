<?php

class Produtos_model extends CI_Model
{
    public function __construct()
    {
        parent::__construct();
    }

    public function get($table, $fields, $where = '', $perpage = 0, $start = 0, $one = false, $array = 'array', $sort = 'idProdutos', $order = 'desc')
    {
        $this->db->select($fields . ', produtos_imagens.thumb');
        $this->db->from($table);
        $this->db->join('produtos_imagens', 'produtos_imagens.produtos_id = produtos.idProdutos AND produtos_imagens.principal = 1', 'left');
        $this->db->order_by($sort, $order);
        $this->db->limit($perpage, $start);
        
        if ($where) {
            $this->db->group_start();
            $this->db->like('codDeBarra', $where);
            $this->db->or_like('codDeFabrica', $where);
            $this->db->or_like('nome', $where);
            $this->db->or_like('descricao', $where);
            $this->db->group_end();
        }

        $query = $this->db->get();

        $result = ! $one ? $query->result() : $query->row();

        return $result;
    }

    public function getById($id)
    {
        $this->db->where('idProdutos', $id);
        $this->db->limit(1);

        return $this->db->get('produtos')->row();
    }

    public function getByCodDeBarra($codDeBarra)
    {
        $this->db->where('codDeBarra', $codDeBarra);
        $this->db->limit(1);
        return $this->db->get('produtos')->row();
    }

    public function add($table, $data, $returnId = false)
    {
        $this->db->insert($table, $data);
        if ($this->db->affected_rows() > 0) {
            if ($returnId) {
                return $this->db->insert_id();
            }

            return true;
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

    public function updateEstoque($idProduto, $estoque, $operacao = '+')
    {
        $this->db->set('estoque', 'estoque ' . $operacao . ' ' . $estoque, false);
        $this->db->where('idProdutos', $idProduto);
        $this->db->update('produtos');

        return true;
    }

    public function addImages($images)
    {
        $this->db->insert_batch('produtos_imagens', $images);
    }

    public function getImages($idProduto)
    {
        $this->db->where('produtos_id', $idProduto);
        return $this->db->get('produtos_imagens')->result();
    }

    public function getImageById($idImage)
    {
        $this->db->where('idImagens', $idImage);
        return $this->db->get('produtos_imagens')->row();
    }

    public function deleteImage($idImage)
    {
        $this->db->where('idImagens', $idImage);
        return $this->db->delete('produtos_imagens');
    }

    public function setMainImage($idImage, $idProduto)
    {
        // Desmarcar todas as imagens do produto como principal
        $this->db->where('produtos_id', $idProduto);
        $this->db->update('produtos_imagens', ['principal' => 0]);

        // Marcar a imagem selecionada como principal
        $this->db->where('idImagens', $idImage);
        return $this->db->update('produtos_imagens', ['principal' => 1]);
    }
}
