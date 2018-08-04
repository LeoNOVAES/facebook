<?php
class homeController extends controller {

    public function __construct() {
        parent::__construct();
        $u = new Usuarios();
        $u->verificarLogin();
    }

    public function index() {
        $u = new Usuarios();
        $p = new Posts();
        $r = new Relacionamentos();
        $g = new Grupos();


        $dados = array(
        	'usuario_nome' => ''
        );
        $dados['usuario_nome'] = $u->getNome($_SESSION['lgsocial']);

        if(isset($_POST['post']) && !empty($_POST['post'])) {
            $postmsg = addslashes($_POST['post']);
            $foto = array();

            if(isset($_FILES['foto']) && !empty($_FILES['foto']['tmp_name'])) {
                $foto = $_FILES['foto'];
            }
            $p->addPost($postmsg, $foto);



        }

        if(isset($_POST['grupo']) && !empty($_POST['grupo'])){
          $name_grupo = addslashes($_POST['grupo']);
          $id_grupo = $g->criarGrupo($name_grupo);
          header("Location: ".BASE."grupos/abrir/".$id_grupo);

        }

        $dados['grupos'] = $g->getGrupos();
        $dados['sugestoes'] = $u->getSugestoes(3);$dados['sugestoes'] = $u->getSugestoes(3);
        $dados['requisicoes'] = $r->getRequisicoes();
        $dados['totalamigos'] = $r->getTotalAmigos($_SESSION['lgsocial']);
        $dados['feed'] = $p->getFeed();


        $this->loadTemplate('home', $dados);
    }

}
