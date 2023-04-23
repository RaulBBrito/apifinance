<?php 

namespace App\Models;

use CodeIgniter\Model;

class RecursoItensModel extends Model{
    /*protected $table = 'tbfin_recurso_itens';
    protected $primaryKey = 'id_recurso_itens';
    protected $useAutoIncrement = true;
    protected $allowedFields = ['desc_recurso_itens', 'status_recurso_itens'];
    protected $validationRules = [];*/

    protected $table         = 'tbfin_recurso_itens';
    protected $primaryKey = 'id_recurso_itens';
    protected $allowedFields = ['desc_recurso_itens', 'status_recurso_itens'];
    protected $returnType    = 'App\Entities\RecursoItens';
    protected $useTimestamps = true;
}
