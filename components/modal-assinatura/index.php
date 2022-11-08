<!-- Modal -->
<div class="modal fade" id="assinaturaDigitalModal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="assinaturaDigitalModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-sm">
        <div class="modal-content">
            <div class="modal-body">
                <button type="button" class="btn btn-danger btn-close btn-sm float-right" data-dismiss="modal" aria-label="Close">X</button>
                <form class="form-signin text-center" method="POST" action="./assinar.php">
                    <img class="mb-4" src="https://cdn-icons-png.flaticon.com/512/2091/2091750.png" alt="" width="90" height="72">
                    <h1 class="h3 mb-3 font-weight-normal">Assinatura Digital</h1>
                    <label for="codigo" class="sr-only">Matrícula/código</label>
                    <input type="text" id="codigo" class="form-control m-1" placeholder="Matrícula/código" name="cd_usuario" required autofocus>
                    <label for="inputPassword" class="sr-only">Senha</label>
                    <input type="password" id="inputPassword" class="form-control m-1" placeholder="Senha" name="senha" required>

                    <input type="text" name="assinar" value="true" hidden>
                    <input type="text" name="id" id="id" hidden>
                    
                    <button class="btn btn-lg btn-success btn-block m-1" type="submit">Assinar</button>
                    <button type="button" class="btn btn-secondary btn-block m-1" data-dismiss="modal">cancelar</button>
                </form>
            </div>
        </div>
    </div>
</div>