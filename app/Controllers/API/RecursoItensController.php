<?php namespace App\Controllers\API;

use Exception;
use CodeIgniter\RESTful\ResourceController;

class RecursoItensController extends ResourceController{
    
    private $recursoItensModel;
    public $descricaoController = "Recurso Itens";
    
    public function __construct()
    {
        $this->recursoItensModel = new \App\Models\RecursoItensModel();
    }
    
    public function list()
    {
        
        return $this->response->setJSON($this->recursoItensModel->findAll());
       
    }
    
    public function create()
    {

        $newRecursoItens = $this->request->getJSON();

        $response = [
            'response'  => 'error',
            'msg'       => 'Error ao criar '.$this->descricaoController,
        ];

        if(isset($newRecursoItens->desc_recurso_itens)){

            $recursoItens = new \App\Entities\RecursoItens();
            $recursoItens->desc_recurso_itens = $newRecursoItens->desc_recurso_itens;
            $recursoItens->status_recurso_itens  = $newRecursoItens->status_recurso_itens;
           
           if($this->recursoItensModel->save($recursoItens)){
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
            
            if($this->recursoItensModel->delete($id)){
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
            $response = $this->recursoItensModel->find($id);
        }

        return $this->response->setJSON($response);
        
    }
    
    public function update($id = null){

        $response = [
            'response'  => 'error',
            'msg'       => 'Error ao atualizar '.$this->descricaoController,
        ];

        $newRecursoItens = $this->request->getJSON();
        $recursoItens = $this->recursoItensModel->find($newRecursoItens->id_recurso_itens);
      
        if(isset($recursoItens->id_recurso_itens)){
            if(isset($newRecursoItens->desc_recurso_itens)){ $recursoItens->desc_recurso_itens = $newRecursoItens->desc_recurso_itens; }
            if(isset($newRecursoItens->status_recurso_itens)){ $recursoItens->status_recurso_itens = $newRecursoItens->status_recurso_itens; }
                
            try{
                if($this->recursoItensModel->save($recursoItens)){
                    $response = [
                        'response'  => 'success',
                        'msg'       => $this->descricaoController.' atualizado com sucesso',
                    ];
                }else{
                    $response = [
                        'response'  => 'error',
                        'msg'       => 'Erro ao cadastrar '.$this->descricaoController,
                        'errors'    => $this->recursoItensModel->errors()
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