<?php
require_once("./perdidos.inc.php");
// var_dump($perdidos);

$locais_filtro = [];
?>
<div class="col-sm-12 table-responsive">


  <?php if ($admin) : ?>
    <form method="POST">
      <div class="form-row">
        <div class="form-group col-md-2">
          <label for="devolvido_filtro">Devolvido ao dono</label>
          <select id="devolvido_filtro" class="form-control" name="devolvido">
            <option selected value="0">Não</option>
            <option value="1">Sim</option>
          </select>
        </div>
      </div>

      <div class="form-row">
        <div class="form-group col-md-1">
          <p>Data encontrado:</p>
        </div>
        <div class="form-group col-md-2">
          <label for="data_inicial_encontrado">Data inicial</label>
          <input type="text" class="form-control datas" id="data_inicial_encontrado" name="data_inicial_encontrado">
        </div>
        <div class="form-group col-md-2">
          <label for="data_final_encontrado">Data final</label>
          <input type="text" class="form-control datas" id="data_final_encontrado" name="data_final_encontrado">
        </div>

        <div class="form-group col-md-1">
          <p>Data devolvido:</p>
        </div>
        <div class="form-group col-md-2">
          <label for="data_inicial_devolvido">Data inicial</label>
          <input type="text" class="form-control datas" id="data_inicial_devolvido" name="data_inicial_devolvido">
        </div>
        <div class="form-group col-md-2">
          <label for="data_final_devolvido">Data final</label>
          <input type="text" class="form-control datas" id="data_final_devolvido" name="data_final_devolvido">
        </div>
      </div>

      <button type="submit" class="btn btn-success mb-5">Filtrar</button>
      <input type="submit" value="Limpar filtro" name="limpar" class="btn btn-warning mb-5" />
    </form>

    <hr>
  <?php endif ?>

  <table class="table table-sm table-striped table-hover" id="tabela">
    <thead class="thead-dark">
      <tr>
        <!-- <th scope="col">#</th> -->
        <th scope="col">Objeto</th>
        <th scope="col">Encontrado em</th>
        <th scope="col">Local</th>
        <?php if ($admin) : ?>
          <th scope="col">Entregado para</th>
          <th scope="col">Entregado em</th>
          <th scope="col">Ações</th>
        <?php endif ?>
      </tr>
    </thead>
    <tbody>
      <?php foreach ($perdidos as $key => $perdido) : ?>
        <?php if ($admin && $perdido["devolvido"] && $perdido["entregado_para"]) : ?>
          <tr>
            <!-- <th scope="row"><?php echo $perdido["id"] ?></th> -->
            <td><?php echo $perdido["nome_achado"] ?></td>
            <td><?php echo  strftime('%d-%m-%Y', strtotime($perdido["data_achado"])) ?></td>
            <td><?php echo $perdido["local"] ?></td>
            <?php if ($admin) : ?>
              <td><?php echo $perdido["entregado_para"] ?></td>
              <td><?php echo  isset($perdido["data_entrega"]) ? strftime('%d-%m-%Y às %H:%M', strtotime($perdido["data_entrega"])) : "" ?></td>
              <td>
                <button type="button" class="btn btn-outline-warning btn-sm" onclick="retornar(<?php echo $perdido['id'] ?>)">Receber de volta</button>
                <a type="button" class="btn btn-outline-info btn-sm" href="editar.php?id=<?php echo $perdido['id'] ?>">Editar</a>
                <button type="button" class="btn btn-outline-danger btn-sm" onclick="excluir(<?php echo $perdido['id'] ?>)">Excluir</button>
              </td>
            <?php endif ?>
          </tr>
        <?php endif ?>

        <?php if (!$perdido["devolvido"] && !$perdido["entregado_para"]) : ?>
          <tr>
            <!-- <th scope="row"><?php echo $perdido["id"] ?></th> -->
            <td><?php echo $perdido["nome_achado"] ?></td>
            <td><?php echo  strftime('%d-%m-%Y', strtotime($perdido["data_achado"])) ?></td>
            <td><?php echo $perdido["local"] ?></td>
            <?php if ($admin) : ?>
              <td><?php echo $perdido["entregado_para"] ?></td>
              <td><?php echo  isset($perdido["data_entrega"]) ? strftime('%d-%m-%Y às %H:%M', strtotime($perdido["data_entrega"])) : "" ?></td>
              <td>
                <button type="button" class="btn btn-outline-success btn-sm" data-toggle="modal" data-target="#assinaturaDigitalModal" onclick="setaIdModal(<?php echo $perdido['id'] ?>)">Entregar ao dono</button>
                <button type="button" class="btn btn-outline-secondary btn-sm" onclick="entregar(<?php echo $perdido['id'] ?>)">Doar/Despachar</button>
                <a type="button" class="btn btn-outline-info btn-sm" href="editar.php?id=<?php echo $perdido['id'] ?>">Editar</a>
                <button type="button" class="btn btn-outline-danger btn-sm" onclick="excluir(<?php echo $perdido['id'] ?>)">Excluir</button>
              </td>
            <?php endif ?>
          </tr>
        <?php endif ?>

      <?php endforeach ?>
    </tbody>
  </table>
</div>

<?php
require_once("components/modal-assinatura/index.php");
?>
<br><br>


<script>
  function setaIdModal(id) {
    document.getElementById('id').value = id;
  }

  function excluir(id) {
    var resposta = confirm("Deseja excluir o objeto " + id + "?");

    if (resposta == true) {
      window.location.href = "index.php?page=perdidos&id=" + id + "&delete=true";
    }
  }

  function entregar(id) {
    var entregue_para = prompt("Qual o nome e matrícula/código da pessoa que esta recebendo");
    if (entregue_para != null && entregue_para != "") {
      window.location.href = "index.php?page=perdidos&id=" + id + "&entregar=true&dono=" + entregue_para;
    }
  }

  function retornar(id) {
    var resposta = confirm("Deseja receber este objeto ?");

    if (resposta == true) {
      window.location.href = "index.php?page=perdidos&id=" + id + "&retornar=true";
    }
  }
</script>