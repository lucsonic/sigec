<?php

namespace App\Models;

use CodeIgniter\Model;

class ProdutoModel extends Model
{
    public function getProdutos()
    {
        $db = \Config\Database::connect();
        $builder = $db->table('produtos p');

        $builder->select('p.*, g.descricao as dsc_grupo, m.descricao as dsc_marca, f.nomefantasia');
        $builder->join('grupos g', 'p.idgrupo = g.idgrupo');
        $builder->join('marcas m', 'p.idmarca = m.idmarca');
        $builder->join('fornecedores f', 'p.idfornecedor = f.idfornecedor');
        $builder->orderBy('p.dsc_produto');
        $query = $builder->get();

        if (empty($query->getResultArray())) {
            return false;
        }

        return $query->getResultArray();
    }

    public function findProduto($id)
    {
        $db = \Config\Database::connect();
        $builder = $db->table('produtos p');

        $builder->select('p.*, g.descricao as dsc_grupo, m.descricao as dsc_marca, f.nomefantasia');
        $builder->join('grupos g', 'p.idgrupo = g.idgrupo');
        $builder->join('marcas m', 'p.idmarca = m.idmarca');
        $builder->join('fornecedores f', 'p.idfornecedor = f.idfornecedor');
        $builder->where('p.idproduto = ' . $id);
        $query = $builder->get();

        if (empty($query->getResultArray())) {
            return false;
        }

        return $query->getResultArray();
    }

    public function findProdutoGrupo($id)
    {
        $db = \Config\Database::connect();
        $builder = $db->table('produtos');

        $builder->select('*');
        $builder->where('idgrupo = ' . $id);
        $query = $builder->get();

        if (empty($query->getResultArray())) {
            return false;
        }

        return $query->getResultArray();
    }

    public function findProdutoMarca($id)
    {
        $db = \Config\Database::connect();
        $builder = $db->table('produtos');

        $builder->select('*');
        $builder->where('idmarca = ' . $id);
        $query = $builder->get();

        if (empty($query->getResultArray())) {
            return false;
        }

        return $query->getResultArray();
    }

    public function atualizaProduto($data)
    {
        $db = \Config\Database::connect();
        $builder = $db->table('produtos');

        $builder->where('idproduto', $data['idproduto']);
        $builder->set($data);
        $builder->update($data);
    }

    public function salvaProduto($data)
    {
        $db = \Config\Database::connect();
        $builder = $db->table('produtos');

        return $builder->insert($data);
    }
}
