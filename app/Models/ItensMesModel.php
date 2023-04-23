<?php 

namespace App\Models;

use CodeIgniter\Model;

class ItensMesModel extends Model{
    protected $table = 'tbfin_itens_mes';
    protected $primaryKey = 'id_itens_mes';
    protected $useAutoIncrement = true;
    protected $allowedFields = ['desc_itens_mes', 'vlr_itens_mes', 'data_venc_itens_mes', 'data_pag_itens_mes', 'id_tipo_item_mes', 'id_recurso_itens', 'id_cartao', 'status_pag_itens_mes'];
    protected $validationRules = [];
    protected $returnType    = 'App\Entities\ItensMes';
    protected $useTimestamps = true;
}
