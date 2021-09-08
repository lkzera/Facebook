<?php

    interface IMysqlRepository{
        public function findAll();
        public function findId($id);
        public function find($object);
        public function insert($object);
        public function remove($id);
        public function update($object);
    }

?>