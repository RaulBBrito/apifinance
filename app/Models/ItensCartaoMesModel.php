<?php 

namespace App\Models;

use CodeIgniter\Model;

class ItensCartaoMesModel extends Model{
    protected $table = 'tbfin_itens_cartao_mes';
    protected $primaryKey = 'id_itens_cartao_mes';
    protected $useAutoIncrement = true;
    protected $allowedFields = ['id_cartao', 'vlr_t_itens_mes', 'dt_venc_itens_cartao_mes', 'status_pag_itens_cartao_mes'];
    protected $validationRules = [];
    protected $returnType    = 'App\Entities\ItensCartaoMes';
    protected $useTimestamps = true;
}
