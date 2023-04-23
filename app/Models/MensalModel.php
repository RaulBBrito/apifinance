<?php 

namespace App\Models;

use CodeIgniter\Model;

class MensalModel extends Model{
    protected $table = 'tbfin_mensal';
    protected $primaryKey = 'id_mensal';
    protected $useAutoIncrement = true;
    protected $allowedFields = ['data_mes_ano_mensal', 'vlrt_renda_mensal', 'vlrt_despesa_mensal', 'vlrt_cartao_mensal', 'vlr_saldo_conta_mensal', 'id_user'];
    protected $validationRules = [];
    protected $returnType    = 'App\Entities\Mensal';
    protected $useTimestamps = true;
}
