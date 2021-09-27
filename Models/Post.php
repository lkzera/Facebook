<?php
     class Post {
        
        private $id_postagem;
        private $data_postagem;
        private $texto;
        private $id_usuario;

        public function __construct($id_postagem, $data_postagem, $texto, $id_usuario){
            $this->id_postagem = $id_postagem;
            $this->data_postagem = $data_postagem;
            $this->texto = $texto;
            $this->id_usuario = $id_usuario;
        }

        /**
         * Get the value of id_postagem
         */ 
        public function getId_postagem()
        {
                return $this->id_postagem;
        }

        /**
         * Set the value of id_postagem
         *
         * @return  self
         */ 
        public function setId_postagem($id_postagem)
        {
                $this->id_postagem = $id_postagem;

                return $this;
        }

        /**
         * Get the value of data_postagem
         */ 
        public function getData_postagem()
        {
                return $this->data_postagem;
        }

        /**
         * Set the value of data_postagem
         *
         * @return  self
         */ 
        public function setData_postagem($data_postagem)
        {
                $this->data_postagem = $data_postagem;

                return $this;
        }

        /**
         * Get the value of texto
         */ 
        public function getTexto()
        {
                return $this->texto;
        }

        /**
         * Set the value of texto
         *
         * @return  self
         */ 
        public function setTexto($texto)
        {
                $this->texto = $texto;

                return $this;
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
    }
?>