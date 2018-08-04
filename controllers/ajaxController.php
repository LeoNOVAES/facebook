<?php
class ajaxController extends controller {

    public function __construct() {
        parent::__construct();
        $u = new Usuarios();
        $u->verificarLogin();
    }

    public function index() {}

    public function add_friend() {

        if(isset($_POST['id']) && !empty($_POST['id'])) {
            $id = addslashes($_POST['id']);

            $r = new Relacionamentos();
            $r->addFriend($_SESSION['lgsocial'], $id);
        }

    }

    public function aceitar_friend() {

        if(isset($_POST['id']) && !empty($_POST['id'])) {
            $id = addslashes($_POST['id']);

            $r = new Relacionamentos();
            $r->aceitarFriend($_SESSION['lgsocial'], $id);
        }

    }

    public function curtir(){
        if(isset($_POST['id']) && !empty($_POST['id'])){
            $id = $_POST['id'];
            $id_usuario = $_SESSION['lgsocial'];


            $p = new Posts();

            if($p->isLiked($id,$id_usuario)){
              $p->removeLike($id);
            }else{
              $p->addLike($id);
            }

    }
  }

  public function comentar(){
    if(isset($_POST['id']) && !empty($_POST['id'])){
        $id = $_POST['id'];
        $texto = $_POST['texto'];
        $id_usuario = $_SESSION['lgsocial'];
        $p = new Posts();

        if(!empty($_POST['texto'])){
            $p->addComentario($id,$texto);

        }


  }


}
}
