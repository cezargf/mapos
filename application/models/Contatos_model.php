<?php

class Contatos_model extends CI_Model
{
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Obtém todos os contatos de um cliente específico
     *
     * @param int $cliente_id
     * @return array
     */
    public function getByCliente($cliente_id)
    {
        $this->db->where('cliente_id', $cliente_id);
        $this->db->order_by('nome', 'asc');
        $query = $this->db->get('contatos_clientes');

        $result = ! $query ? [] : $query->result();

        return $result;
    }

    /**
     * Obtém um contato por ID
     *
     * @param int $id
     * @return object
     */
    public function getById($id)
    {
        $this->db->where('idContatos', $id);
        return $this->db->get('contatos_clientes')->row();
    }

    /**
     * Adiciona um novo contato
     *
     * @param array $data
     * @return int|bool
     */
    public function add($data)
    {
        $this->db->insert('contatos_clientes', $data);
        if ($this->db->affected_rows() == 1) {
            return $this->db->insert_id();
        }
        return false;
    }

    /**
     * Edita um contato existente
     *
     * @param int $id
     * @param array $data
     * @return bool
     */
    public function edit($id, $data)
    {
        $this->db->where('idContatos', $id);
        $this->db->update('contatos_clientes', $data);
        return $this->db->affected_rows() >= 0;
    }

    /**
     * Deleta um contato
     *
     * @param int $id
     * @return bool
     */
    public function delete($id)
    {
        $this->db->where('idContatos', $id);
        $this->db->delete('contatos_clientes');
        return $this->db->affected_rows() == 1;
    }

    /**
     * Conta o número de contatos de um cliente
     *
     * @param int $cliente_id
     * @return int
     */
    public function countByCliente($cliente_id)
    {
        $this->db->where('cliente_id', $cliente_id);
        return $this->db->count_all_results('contatos_clientes');
    }

    /**
     * Verifica se o email já existe para um cliente (excluindo o próprio contato)
     *
     * @param string $email
     * @param int $cliente_id
     * @param int $idContato (opcional, para excluir na edição)
     * @return bool
     */
    public function emailExists($email, $cliente_id, $idContato = null)
    {
        $this->db->where('cliente_id', $cliente_id);
        if ($idContato !== null) {
            $this->db->where('idContatos !=', $idContato);
        }
        $this->db->group_start();
        $this->db->where('email', $email);
        $this->db->or_like('email', '"' . $email . '"');
        $this->db->group_end();
        $query = $this->db->get('contatos_clientes');
        return $query->num_rows() > 0;
    }
}