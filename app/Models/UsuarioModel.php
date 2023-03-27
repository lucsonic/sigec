<?php

namespace App\Models;

use CodeIgniter\Model;

class UsuarioModel extends Model
{
    public function getUsuarios()
    {
        $db = \Config\Database::connect();
        $builder = $db->table('usuarios');

        $builder->select("id, nome, status AS sts, email, 
        CASE WHEN status = 1 THEN 'Ativo' ELSE 'Inativo' 
        END AS situacao, usuario, idPermissao");
        $builder->where('id <> 1');
        $builder->join('permissoes', 'usuarios.id = permissoes.idUsuario');
        $query = $builder->get();

        if (empty($query->getResultArray())) {
            return false;
        }

        return $query->getResultArray();
    }

    public function findUsuario($id)
    {
        $db = \Config\Database::connect();
        $builder = $db->table('usuarios');

        $builder->select('*');
        $builder->where('id = ' . $id);
        $query = $builder->get();

        if (empty($query->getResultArray())) {
            return false;
        }

        return $query->getResultArray();
    }

    public function permissoesUsuario($id)
    {
        $db = \Config\Database::connect();
        $builder = $db->table('permissoes');

        $builder->select('*');
        $builder->where('idUsuario = ' . $id);
        $query = $builder->get();

        if (empty($query->getResultArray())) {
            return false;
        }

        return $query->getResultArray();
    }

    public function atualizaUsuario($data)
    {
        $db = \Config\Database::connect();
        $builder = $db->table('usuarios');

        $builder->where('id', $data['id']);
        $builder->set($data);
        $builder->update($data);
    }

    public function atualizaPermissoes($data)
    {
        $db = \Config\Database::connect();
        $builder = $db->table('permissoes');

        $builder->where('idPermissao', $data['idPermissao']);
        $builder->set($data);
        $builder->update($data);
    }

    public function salvaUsuario($data)
    {
        $db = \Config\Database::connect();
        $builder = $db->table('usuarios');

        return $builder->insert($data);
    }

    public function salvaPermissoes($data)
    {
        $db = \Config\Database::connect();
        $builder = $db->table('permissoes');

        return $builder->insert($data);
    }

    public function findIdUltimoCadastrado()
    {
        $db = \Config\Database::connect();
        $builder = $db->table('usuarios');

        $builder->select('MAX(id) AS idUsuario');
        $query = $builder->get();

        if (empty($query->getResultArray())) {
            return false;
        }

        return $query->getResultArray();
    }
}
