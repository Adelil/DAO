<?php

class Usuario{
    private $idusuario;
    private $deslogin;
    private $dessenha;
    private $dtcadastro;
//========USUARIO====================
    public function getIdusuario(){

        return $this->idusuario;

    }
    public function setIdusuario($value){

        $this->idusuario = $value;

    }
//=======DESLOGIN===================
    public function getDeslogin(){

        return $this->deslogin;

    }
    public function setDeslogin($value){

        $this->deslogin = $value;

    }
//=======DESSENHA==================
    public function getDessenha(){
        
        return $this->dessenha;
        
    }
    public function setDessenha($value){
        
        $this->dessenha = $value;
        
    }
//=======DTCADASTRO==============
    public function getDtcadastro(){
        
        return $this->dtcadastro;
        
    }
    public function setDtcadastro($value){
        
        $this->dtcadastro = $value;
        
    }
//======LOAD_BY_ID=================    
    public function loadById($id){
        
        $sql = new Sql();
        
        $results = $sql->select("SELECT * FROM tb_usuarios WHERE idusuario = :ID",array(":ID"=>$id));
        
        if(count($results) > 0){
            $row = $results[0];
            
            $this->setIdusuario($row['idusuario']);
            $this->setDeslogin($row['deslogin']);
            $this->setDessenha($row['dessenha']);
            $this->setDtcadastro(new DateTime($row['dtcadastro']));
        }
        
    }
//=========GET LISTA=======================
    public static function getList(){

        $sql = new Sql();

        return $sql->select("SELECT * FROM tb_usuarios ORDER BY deslogin;");

    }

//=========PROCURA USUARIO=================
    public static function search($login){

        $sql = new Sql();

        return $sql->select("SELECT * FROM tb_usuarios WHERE deslogin LIKE :SEARCH ORDER BY deslogin", array(
        ':SEARCH'=>"%".$login."%"
        ));

    }
//=========ESTA FUNÇÃO CARREGA OS DADOS ALTENTICADOS
    public function login($login, $password){


        $sql = new Sql();

        $results = $sql->select("SELECT * FROM tb_usuarios WHERE deslogin = :LOGIN AND dessenha = :PASSWORD",array(
            ":LOGIN"=>$login,
            ":PASSWORD"=>$password
        ));

        if(count($results) > 0){
            $row = $results[0];

            $this->setIdusuario($row['idusuario']);
            $this->setDeslogin($row['deslogin']);
            $this->setDessenha($row['dessenha']);
            $this->setDtcadastro(new DateTime($row['dtcadastro']));
        }else{

            throw new Exception("login e ou senha invalidos");

        }


    }
//=========CONVERTER PARA STRING===========
    public function __toString(){
        
        return json_encode(array(
        "idusuario"=>$this->getIdusuario(),
        "deslogin"=>$this->getDeslogin(),
        "dessenha"=>$this->getDessenha(),
        "dtcadastro"=>$this->getDtcadastro()->format("d/m/Y H:i:s")    
        ));
        
    }


}



?>
