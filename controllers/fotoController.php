<?php
  class FotoController extends controller{

    public function __construct() {
        parent::__construct();
        $u = new Usuarios();
        $u->verificarLogin();
    }

    public function Index(){



      $this->loadTemplate('foto');


    }







  }



?>
