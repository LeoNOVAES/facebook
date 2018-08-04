<h1><?php  echo $info['titulo']; ?></h1>
<?php

  if($isMembro == true):
    ?>
    <h3> Voce e membro da sociedade do Anel</h3>

  <?php  else: ?>

    <h3>Voce Nao e membro</h3>
    <button href="<?php echo BASE; ?>grupos/abrir/<?php echo $id_grupo; ?>"  class="btn btn-default">Solicite Sua entrada</button>

  <?php endif; ?>
