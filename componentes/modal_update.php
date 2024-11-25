<!-- Modal de Sucesso -->
<div class="modal fade" id="successModal" tabindex="-1" aria-labelledby="successModalLabel" aria-hidden="true" data-bs-backdrop="static" data-bs-keyboard="false">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="successModalLabel">Sucesso!</h5>
                </div>
                <div class="modal-body">
                    As informações do imovel foram alteradas com sucesso!
                </div>
                <div class="modal-footer">
                    <a href="index.php">
                        <button type="button" class="btn btn-primary">OK</button>
                    </a>
                </div>
            </div>
        </div>

    <!-- Script PHP para exibir o modal após o cadastro bem-sucedido -->
    <?php if (isset($_GET['success']) && $_GET['success'] == 1): ?>
    <script>
        var successModal = new bootstrap.Modal(document.getElementById('successModal'));
        successModal.show();
    </script>
    <?php endif; ?>