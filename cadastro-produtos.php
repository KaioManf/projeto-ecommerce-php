<div class="container">

  <div class="row">
    <div class="col-md-6 col-lg-6">
      <h4 class="mb-3">Cadastro de Produtos</h4>
      <form action="application/inserir-produto.php" method="POST" enctype="multipart/form-data">
        <div class="row g-3">
          <div class="col-sm-3">
            <label for="txtID" class="form-label">ID</label>
            <input type="text" class="form-control" id="txtID" name="txtID" readonly value="Novo">
          </div>
          <div class="col-sm-9">
            <label for="txtNome" class="form-label">Nome</label>
            <input type="text" class="form-control" id="txtNome" name="txtNome">
          </div>
          <div class="col-sm-3">
            <label for="txtQtdEstoque" class="form-label">Qtd. Estoque</label>
            <input type="text" class="form-control" id="txtQtdEstoque" name="txtQtdEstoque">
          </div>
          <div class="col-sm-9">
            <label for="txtPreco" class="form-label">Preço R$</label>
            <input type="text" class="form-control" id="txtPreco" name="txtPreco">
          </div>
          <div class="col-12">
            <label for="fileFotoProduto" class="form-label">Foto do Produto</label>
            <input type="file" class="form-control" id="fileFotoProduto" name="fileFotoProduto">
          </div>
        </div>
        <hr class="my-4">
        <div class="row">
          <div class="col-sm-6">
            <button class="w-100 btn btn-primary btn-lg" type="submit">Salvar</button>
          </div>
          <div class="col-sm-6">
            <button class="w-100 btn btn-secondary btn-lg" type="reset">Cancelar</button>
          </div>
        </div>
      </form>
    </div>

    <div class="col-md-6 col-lg-6">
      <h4>Imagem do Produto</h4>
      <img id="imgProduto" height='300' src="">
    </div>
  </div>

  <div class="row mt-5">
    <div class="col">
      <table class="table table-striped">
        <thead>
          <tr>
            <th>ID</th>
            <th>Nome</th>
            <th>Qtd. Estoque</th>
            <th>R$ Venda</th>
            <th>Imagem</th>
            <th>Ações</th>
          </tr>
        </thead>
        <tbody>
          <?php
            require_once 'application/class/BancoDeDados.php';
            $bd = new BancoDeDados;
            $bd->conectar();
            
            $sql = "SELECT * FROM produtos";
            
            $dados = $bd->buscarRegistros($sql);
            
            foreach($dados as $linha){
              echo "<tr>
                      <td>{$linha['id_produto']}</td>
                      <td>{$linha['nome']}</td>
                      <td>{$linha['qtd_estoque']}</td>
                      <td>{$linha['preco_venda']}</td>
                      <td><a href='application/uploads/{$linha['imagem']}' target='_blank' class='btn btn-outline-secondary'><i class='bi bi-image-fill'></i> Visualizar</a></td>
                      <td>
                        <button onclick=\"atualizar( 
                        {$linha['id_produto']}, 
                        '{$linha['nome']}', 
                        {$linha['qtd_estoque']}, 
                        {$linha['preco_venda']}, 
                        '{$linha['imagem']}'
                        )\" class='btn btn-sm btn-outline-primary'><i class='bi bi-pencil-fill'></i> Editar</button>
                        <button onclick='excluir({$linha['id_produto']})' class='btn btn-sm btn-outline-danger'><i class='bi bi-trash3-fill'></i> Excluir</button>
                      </td>
                  </tr>";
            }
          ?>
        </tbody>
        <tfoot>
          <tr>
            <td><b>Total:</b></td>
            <td colspan="5">
              <?php
              echo count($dados);
              ?>
            </td>
          </tr>
        </tfoot>
      </table>
    </div>
  </div>
</div>

<script>
  function excluir(id){
    var resposta = confirm('Tem certeza que deseja excluir este produto?');
    if(resposta){
      window.location = 'application/excluir-produto.php?id=' + id;
    }
  }
  
  function atualizar(id, nome, qtd, preco, img){
    document.querySelector('#txtID').value = id;
    document.querySelector('#txtNome').value = nome;
    document.querySelector('#txtQtdEstoque').value = qtd;
    document.querySelector('#txtPreco').value = preco;
    document.querySelector('#imgProduto').src = 'application/uploads/' + img;
  }
</script>