<!--Quadro de opções-->
<div class="card" style="margin-top:10%; margin-left:20%; margin-right:20%; height:300px;">
  <div class="card-body">
    <h2 align="center"><?php echo $admin ? "Escolha uma das opção" : "Selecione a opção abaixo" ?></h2>
    <?php if ($admin) : ?>
      <div style="margin-top:6%;">
        <a href="index.php?page=achados" style="text-decoration:none;"><button type="button" class="btn btn-primary btn-lg btn-block">Cadastro de objeto perdido</button></a>
      </div>
    <?php endif ?>
    <div style="margin-top:3%;">
      <a href="index.php?page=perdidos" style="text-decoration:none;"><button type="button" class="btn btn-secondary btn-lg btn-block">Achados e perdidos</button></a>
    </div>
  </div>
</div>
<!--fim de quadro de opções-->