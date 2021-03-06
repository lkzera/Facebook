<?php

    class Usuario {

        private $id_usuario;
        private $login;
        private $nome;
        private $email;
        private $senha;
        private $descricao;
        private $dataAniversario;
        private $dataInclusao;
        private $imagem;

        public function __construct($id_usuario, $login, $nome, $email, $senha, $descricao, $dataAniversario, $dataInclusao, $imagem)
        {
                $this->id_usuario = $id_usuario;
                $this->login = $login;
                $this->nome = $nome;
                $this->email = $email;
                $this->senha = $senha;
                $this->descricao = $descricao;
                $this->dataAniversario = $dataAniversario;
                $this->dataInclusao = $dataInclusao;
                $this->imagem = $imagem;
        }

        /**
         * Get the value of id_usuario
         */ 
        public function getId_usuario()
        {
                return $this->id_usuario;
        }

        /**
         * Set the value of id_usuario
         *
         * @return  self
         */ 
        public function setId_usuario($id_usuario)
        {
                $this->id_usuario = $id_usuario;

                return $this;
        }

        /**
         * Get the value of login
         */ 
        public function getLogin()
        {
                return $this->login;
        }

        /**
         * Set the value of login
         *
         * @return  self
         */ 
        public function setLogin($login)
        {
                $this->login = $login;

                return $this;
        }

        /**
         * Get the value of nome
         */ 
        public function getNome()
        {
                return $this->nome;
        }

        /**
         * Set the value of nome
         *
         * @return  self
         */ 
        public function setNome($nome)
        {
                $this->nome = $nome;

                return $this;
        }

        /**
         * Get the value of email
         */ 
        public function getEmail()
        {
                return $this->email;
        }

        /**
         * Set the value of email
         *
         * @return  self
         */ 
        public function setEmail($email)
        {
                $this->email = $email;

                return $this;
        }

        /**
         * Get the value of senha
         */ 
        public function getSenha()
        {
                return $this->senha;
        }

        /**
         * Set the value of senha
         *
         * @return  self
         */ 
        public function setSenha($senha)
        {
                $this->senha = $senha;

                return $this;
        }

        /**
         * Get the value of descricao
         */ 
        public function getDescricao()
        {
                return $this->descricao;
        }

        /**
         * Set the value of descricao
         *
         * @return  self
         */ 
        public function setDescricao($descricao)
        {
                $this->descricao = $descricao;

                return $this;
        }

        /**
         * Get the value of dataAniversario
         */ 
        public function getDataAniversario()
        {
                return $this->dataAniversario;
        }

        /**
         * Set the value of dataAniversario
         *
         * @return  self
         */ 
        public function setDataAniversario($dataAniversario)
        {
                $this->dataAniversario = $dataAniversario;

                return $this;
        }

        /**
         * Get the value of dataInclusao
         */ 
        public function getDataInclusao()
        {
                return $this->dataInclusao;
        }

        /**
         * Set the value of dataInclusao
         *
         * @return  self
         */ 
        public function setDataInclusao($dataInclusao)
        {
                $this->dataInclusao = $dataInclusao;

                return $this;
        }

        /**
         * Get the value of imagem
         */ 
        public function getImagem()
        {
                return $this->imagem;
        }

        /**
         * Set the value of imagem
         *
         * @return  self
         */ 
        public function setImagem($imagem)
        {
                $this->imagem = $imagem;

                return $this;
        }
    }
