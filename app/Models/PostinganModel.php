<?php

namespace App\Models;

use CodeIgniter\Model;

class PostinganModel extends Model
{
    protected $table            = 'postingan';
    protected $primaryKey       = 'id_post';
    protected $useAutoIncrement = true;
    protected $returnType       = 'array';
    protected $useSoftDeletes   = false;
    protected $protectFields    = true;
    protected $allowedFields    = ['id_user', 'caption', 'pict_post'];

    // Dates
    protected $useTimestamps = true;
    protected $dateFormat    = 'datetime';
    protected $createdField  = 'created_at';
    protected $updatedField  = 'updated_at';
    protected $deletedField  = 'deleted_at';

    // Validation
    protected $validationRules      = [];
    protected $validationMessages   = [];
    protected $skipValidation       = false;
    protected $cleanValidationRules = true;

    // Callbacks
    protected $allowCallbacks = true;
    protected $beforeInsert   = [];
    protected $afterInsert    = [];
    protected $beforeUpdate   = [];
    protected $afterUpdate    = [];
    protected $beforeFind     = [];
    protected $afterFind      = [];
    protected $beforeDelete   = [];
    protected $afterDelete    = [];

    public function savePostingan($data)
    {
        $this->insert($data);
    }

    public function getPostingan()
    {
        return $this->findAll();
    }

    public function getPostinganById($id_post)
    {
        return $this->where('id_post', $id_post)->findAll();
    }
}
