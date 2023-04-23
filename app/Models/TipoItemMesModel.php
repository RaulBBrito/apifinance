<?php 

namespace App\Models;

use CodeIgniter\Model;

class TipoItemMesModel extends Model{
    protected $table = 'tbfin_tipo_item_mes';
    protected $primaryKey = 'id_tipo_item_mes';
    protected $useAutoIncrement = true;
    protected $allowedFields = ['desc_tipo_item_mes', 'status_tipo_item_mes'];
    protected $validationRules = [];
    protected $returnType    = 'App\Entities\TipoItemMes';
    protected $useTimestamps = true;
}
