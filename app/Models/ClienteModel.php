<?php

namespace App\Models;

use CodeIgniter\Model;

class ClienteModel extends Model
{
    public function getClientes()
    {
        $db = \Config\Database::connect();
        $builder = $db->table('clientes');

        $builder->select("CASE WHEN tipopessoa = 'Física' THEN nome
                            WHEN tipopessoa = 'Jurídica' THEN nomefantasia
                            ELSE razaosocial END AS nome_cliente, datacadastro, sexo,
                            idcliente, tipopessoa, endereco, bairro, cidade, uf, rg, telefones, cep, cnpj, cpf,
                            orgaorg, indicacao, email, razaosocial, ativo, nomecontato, datanascimento");
        $builder->orderBy('1 ASC');
        $query = $builder->get();

        if (empty($query->getResultArray())) {
            return false;
        }

        return $query->getResultArray();
    }

    public function visualizaCliente($id)
    {
        $db = \Config\Database::connect();
        $builder = $db->table('clientes');

        $builder->select("CASE WHEN tipopessoa = 'Física' THEN nome
                            WHEN tipopessoa = 'Jurídica' THEN nomefantasia
                            ELSE razaosocial END AS nome_cliente, datacadastro, sexo,
                            idcliente, tipopessoa, endereco, bairro, cidade, uf, rg, telefones, cep, cnpj, cpf,
                            orgaorg, indicacao, email, razaosocial, ativo, nomecontato, datanascimento");
        $builder->where('idcliente = ' . $id);
        $query = $builder->get();

        if (empty($query->getResultArray())) {
            return false;
        }

        return $query->getResultArray();
    }

    public function findCliente($id)
    {
        $db = \Config\Database::connect();
        $builder = $db->table('clientes');

        $builder->select('*');
        $builder->where('idcliente = ' . $id);
        $query = $builder->get();

        if (empty($query->getResultArray())) {
            return false;
        }

        return $query->getResultArray();
    }

    public function atualizaCliente($data)
    {
        $db = \Config\Database::connect();
        $builder = $db->table('clientes');

        $builder->where('idcliente', $data['idcliente']);
        $builder->set($data);
        $builder->update($data);
    }

    public function salvaCliente($data)
    {
        $db = \Config\Database::connect();
        $builder = $db->table('clientes');

        return $builder->insert($data);
    }
}
