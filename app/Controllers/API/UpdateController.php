<?php namespace App\Controllers\API;

class UpdateController extends BaseController{
    
    private $builder;
    
    public function __construct()
    {
        $db      = \Config\Database::connect();
        $this->builder = $db->table('tbfin_user');
    }
    
    public function update(){
        
        $newUser = $this->request->getJSON();
        return $this->response->setJSON($newUser);
        /*$this->builder->where('id_user', $newUser['id_user']);
        return $this->builder->update($newUser);*/
    }
}
