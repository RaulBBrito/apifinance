<?php namespace App\Controllers\API;

use Exception;
use CodeIgniter\RESTful\ResourceController;

class TipoItemMesController extends ResourceController{
    
    private $tipoItemMesModel;
    public $descricaoController = "Tipo Item Mês";
    
    public function __construct()
    {
        $this->tipoItemMesModel = new \App\Models\TipoItemMesModel();
    }
    
    public function list()
    {
        return $this->response->setJSON($this->tipoItemMesModel->findAll());
    }
    
    public function create()
    {

        $newTipoItemMes = $this->request->getJSON();

        $response = [
            'response'  => 'error',
            'msg'       => 'Error ao criar '.$this->descricaoController,
        ];

        if(isset($newTipoItemMes->desc_tipo_item_mes)){

            $tipoItemMes = new \App\Entities\TipoItemMes();
            $tipoItemMes->desc_tipo_item_mes = $newTipoItemMes->desc_tipo_item_mes;
           
           if($this->tipoItemMesModel->save($tipoItemMes)){
            $response = [
                'response'  => 'success',
                'msg'       => $this->descricaoController.' criado com sucesso',
            ];
           }
        }

        return $this->response->setJSON($response);
        
    }
    
    public function delete($id = null){

        $response = [];
        
        if(is_null($id)){
            $response = [
                'response'  => 'error',
                'msg'       => $this->descricaoController.' não encontrado',
            ];
        }else{
            
            if($this->tipoItemMesModel->delete($id)){
                $response = [
                    'response'  => 'success',
                    'msg'       => $this->descricaoController.' deletado com sucesso',
                ];
            }
        }

        return $this->response->setJSON($response);
        
    }
    
    public function buscar($id = null){
        
        $response = [];
        
        if(is_null($id)){
            $response = [
                'response'  => 'error',
                'msg'       => $this->descricaoController.' não encontrado',
            ];
            
        }else{
            $response = $this->tipoItemMesModel->find($id);
        }

        return $this->response->setJSON($response);
        
    }
    
      public function update($id = null){

        $response = [
            'response'  => 'error',
            'msg'       => 'Error ao atualizar '.$this->descricaoController,
        ];

        $newTipoItemMes = $this->request->getJSON();
        $tipoItemMes = $this->tipoItemMesModel->find($newTipoItemMes->id_tipo_item_mes);
      
        if(isset($tipoItemMes->id_tipo_item_mes)){
                
            if(isset($newTipoItemMes->desc_tipo_item_mes)){ $tipoItemMes->desc_tipo_item_mes = $newTipoItemMes->desc_tipo_item_mes; }
            if(isset($newTipoItemMes->status_tipo_item_mes)){ $tipoItemMes->status_tipo_item_mes = $newTipoItemMes->status_tipo_item_mes; }
                
            try{
                if($this->tipoItemMesModel->save($tipoItemMes)){
                    $response = [
                        'response'  => 'success',
                        'msg'       => $this->descricaoController.' atualizado com sucesso',
                    ];
                }else{
                    $response = [
                        'response'  => 'error',
                        'msg'       => 'Erro ao cadastrar '.$this->descricaoController,
                        'errors'    => $this->tipoItemMesModel->errors()
                    ];
                }

            }catch(Exception $e){
                $response = [
                    'response'  => 'error',
                    'msg'       => 'Erro ao cadastrar '.$this->descricaoController,
                    'errors'    => [
                        'exception' => $e->getMessage()
                    ]
                ];
            }

        }

        return $this->response->setJSON($response);
    }
    
    
    
}