<?php 

namespace App\Models;

use CodeIgniter\Model;

class UserModel extends Model{
    protected $table = 'tbfin_user';
    protected $primaryKey = 'id_user';
    protected $allowedFields = ['id_user','nome_user', 'email_user', 'senha_user', 'data_cad_user'];
    protected $validationRules = [
        'senha_user'=>'required|min_length[3]'
        ];

    protected $returnType    = 'App\Entities\User';
    protected $useTimestamps = true;
}