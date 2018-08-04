<?php
class Posts extends model {

	public function addPost($msg, $foto, $id_grupo = '0') {
		$usuario = $_SESSION['lgsocial'];
		$tipo = 'texto';
		$url = '';
		if(count($foto) > 0) {
			$tipos = array('image/jpeg', 'image/jpg', 'image/png');
			if(in_array($foto['type'], $tipos)) {
				$tipo = 'foto';

				$url = md5(time().rand(0,999));
				switch($foto['type']) {
					case 'image/jpeg':
					case 'image/jpg':
						$url .= '.jpg';
						break;
					case 'image/png':
						$url .= '.png';
						break;
				}

				move_uploaded_file($foto['tmp_name'], 'assets/images/posts/'.$url);
			}
		}

		$sql = "INSERT INTO posts SET id_usuario = '$usuario', data_criacao = NOW(), tipo = '$tipo', texto = '$msg', url = '$url', id_grupo = '$id_grupo'";
		$this->db->query($sql);

	}

	public function getFeed() {
			$array = array();
      $r = new Relacionamentos();
      $ids = $r->getIdsFriends($_SESSION['lgsocial']);
      $ids[] = $_SESSION['lgsocial'];
      $sql = "
      SELECT *,
				(SELECT usuarios.nome FROM usuarios WHERE usuarios.id = posts.id_usuario) AS
				 nome,

				(SELECT COUNT(*) FROM posts_likes WHERE posts_likes.id_post = posts.id)AS
				likes,
				(SELECT COUNT(*) FROM posts_likes WHERE posts_likes.id_post = posts.id AND posts_likes.id_usuario = '".$_SESSION['lgsocial']."'  )AS
				liked
			 FROM posts
			 WHERE id_usuario IN (".implode(',',$ids).")
			  ORDER BY data_criacao DESC";
      $sql = $this->db->query($sql);
      if($sql->rowCount() > 0){
          $array = $sql->fetchAll();
					foreach($array as $post){
						$id[] = $post[0];
					}
				}
				$p = new Posts();
				$p->getComentarios($id);


			return $array;

	}


		public function isLiked($id,$id_usuario){
				$sql = "SELECT * FROM posts_likes WHERE id_post = '$id' AND id_usuario = '$id_usuario'";
				$sql = $this->db->query($sql);

				if($sql->rowCount() > 0){
					return true;
				}else{
					return false;
				}
		}


		public function addLike($id){
				$id_usuario = $_SESSION['lgsocial'];
				$this->db->query("INSERT INTO posts_likes SET id_post = '$id', id_usuario = '$id_usuario'" );

		}

		public function removeLike($id){
				$id_usuario = $_SESSION['lgsocial'];
				$this->db->query("DELETE FROM posts_likes WHERE id_post = '$id' AND id_usuario = '$id_usuario'");
		}

		public function addComentario($id,$texto){
				$id_usuario = $_SESSION['lgsocial'];
				$sql = "INSERT INTO posts_comentarios SET id_post = '$id', id_usuario = '$id_usuario',data_criacao = NOW(),texto = '$texto'";
				$this->db->query($sql);
		}

		public function getComentarios($id){
			global $t;
			$array = array();
			$idd  = $id[0];
			$sql = "SELECT * FROM posts_comentarios WHERE id_post = '$idd'";
			$sql = $this->db->query($sql);
			if($sql->rowCount() > 0 ){
				$array = $sql->fetchAll();
				foreach($array as $co){
				}

			}return $array;

		}


}
