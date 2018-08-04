<div class="postitem">
  <a href="<?php echo BASE; ?>foto"><div  class="foto" onclick="displayComem">
    <?php if($tipo == 'foto'):   ?>
    <img src="<?php echo BASE; ?>/assets/images/posts/<?php echo $url; ?>" border="0" width="100%" />
    <?php endif; ?>
  </div>
</a>

<div class="postitem_texto">
  <?php echo $texto;?>
</div>

<div class="postitem_info">
  <strong>Post de: </strong><?php echo $nome; ?>
  <?php echo $data_criacao; ?>
</div>

<div class="postitem_botoes">
    <button class="btn btn-dafault" onclick="curtir(this)" data-id="<?php echo $id; ?>"  data-likes="<?php echo $likes; ?>" data-liked="<?php echo $liked; ?>">
      (<?php echo $likes; ?>)<?php echo($liked == '0')? 'Curtir':'Descurtir';?></button>
    <button class="btn btn-dafault" onclick="displayComentario(this)">Comentar</button>

    <div class="postitem_comentario"></br>

      <input type="text" class="postitem_texto form-control"/>
        <button class="btn btn-default" data-id ="<?php echo $id; ?>" onclick="comentar(this)">Enviar</button>
    </div>
    </div>
    <div class="comem">
      <?php echo "teste"; ?>
    </div>





</div>
