<?php
    class Usuario{
        private $IdUsuario;
        private $DesLogin;
        private $DesSenha;
        private $DtCadastro;

        // Usuario

        public function getIdUsuario(){
            return $this->IdUsuario;
        }

        public function setIdUsuario($usuario){
            $this->IdUsuario = $usuario;
        }

        // Login

        public function getDesLogin(){
            return $this->DesLogin;
        }

        public function setDesLogin($login){
            $this->DesLogin = $login;
        }

        // Senha

        public function getDesSenha(){
            return $this->DesSenha;
        }

        public function setDesSenha($senha){
            $this->DesSenha = $senha;
        }

        // Cadastro

        public function getDtCadastro(){
            return $this->DtCadastro;
        }

        public function setDtCadastro($cadastro){
            $this->DtCadastro = $cadastro;
        }

        // Carrega o usuário pelo id

        public function loadById($id){
            $sql = new Sql();
            $result = $sql->select("SELECT * FROM tb_usuarios WHERE IdUsuario = :ID", array(
                ":ID"=>$id
            ));

            if(count($result) > 0){
                $this->setData($result[0]);
            }
        }

        // Lista todos os usuários
        
        public static function getList(){
            $sql = new Sql();
            return $sql->select("SELECT * FROM tb_usuarios ORDER BY DesLogin");
            
        }

        public static function search($login){
            $sql = new Sql();
            return $sql->select("SELECT * FROM tb_usuarios WHERE DesLogin LIKE :SEARCH ORDER BY Deslogin", array(
                ':SEARCH'=>"%" . $login . "%"
            ));
        }

        // Carrega um usuário utilizando login e senha

        public function login($login, $password){
            $sql = new Sql();
            $result = $sql->select("SELECT * FROM tb_usuarios WHERE DesLogin = :LOGIN AND DesSenha = :PASSWORD", array(
                ":LOGIN"=>$login,
                ":PASSWORD"=>$password
            ));

            if(count($result) > 0){
                $this->setData($result[0]);
            }else{
                throw new Exception("Login e/ou senha inválidos");  
            }
        }

        // Método para pegar os dados

        public function setData($data){
            $this->setIdUsuario($data['IdUsuario']);
            $this->setDesLogin($data['DesLogin']);
            $this->setDesSenha($data['DesSenha']);
            $this->setDtCadastro(new DateTime($data['DtCadastro']));
        }

        // Insere um aluno no banco de dados

        public function insert(){
            $sql = new Sql();
            $results = $sql->select("CALL sp_usuarios_insert(:LOGIN, :PASSWORD)", array(
                ':LOGIN'=>$this->getDeslogin(),
                ':PASSWORD'=>$this->getDesSenha()
            ));

            if(count($results) > 0){
                $this->setData($results[0]);
            }else{
                throw new Exception("Não foi possível adicionar o usuário");
            }
        }

        // construtor para passar login e senha do usuário
 
        public function __construct($login= "", $password = ""){
            $this->setDeslogin($login);
            $this->setDesSenha($password);
        }

        public function __toString(){
           return json_encode(array(
                "IdUsuario"=>$this->getIdUsuario(),
                "DesLogin"=>$this->getDeslogin(),
                "DesSenha"=>$this->getDesSenha(),
                "DtCadastro"=>$this->getDtCadastro()->format("d/m/Y H:i:s")
           )); 
        }
    }
?>