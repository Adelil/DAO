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
            
            $this->setData($results[0]);
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

            $this->setData($results[0]);

        }else{

            throw new Exception("login e ou senha invalidos");

        }


    }
//=========DATA============================
    public function setData($data){

            $this->setIdusuario($data['idusuario']);
            $this->setDeslogin($data['deslogin']);
            $this->setDessenha($data['dessenha']);
            $this->setDtcadastro(new DateTime($data['dtcadastro']));

    }
//=========GRAVA NOVO USUARIO==============
    public function insert(){

        $sql = new Sql();

        $results = $sql->select("CALL sp_usuarios_insert(:LOGIN, :PASSWORD)", array(
        ':LOGIN'=>$this->getDeslogin(),
        ':PASSWORD'=>$this->getDessenha()
        ));

        if(count($results) > 0 ){

            $this->setData($results[0]);

        }else{
            echo "<br/><h1>Deu RUIM!!!</h1><br/>";
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
