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

        public function loadById($id){
            $sql = new Sql();
            $result = $sql->select("SELECT * FROM tb_usuarios WHERE IdUsuario = :ID", array(
                ":ID"=>$id
            ));

            if(count($result) > 0){
                $row = $result[0];

                $this->setIdUsuario($row['IdUsuario']);
                $this->setDesLogin($row['DesLogin']);
                $this->setDesSenha($row['DesSenha']);
                $this->setDtCadastro(new DateTime($row['DtCadastro']));
            }
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