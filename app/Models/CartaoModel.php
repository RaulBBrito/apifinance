<?php 

namespace App\Models;

use CodeIgniter\Model;

class CartaoModel extends Model{
    protected $table = 'tbfin_cartao';
    protected $primaryKey = 'id_cartao';
    protected $useAutoIncrement = true;
    protected $allowedFields = ['desc_cartao', 'num_final_cartao', 'data_venc_cartao', 'data_corte_cartao', 'bandeira_cartao', 'vlr_limite_cartao'];
    protected $validationRules = [];
    protected $returnType    = 'App\Entities\Cartao';
    protected $useTimestamps = true;

}