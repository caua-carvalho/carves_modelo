<?php
require_once "../conn.php";
include_once "../estilo/header.html";

$id = $_GET['id'];

// Consultando o imóvel pelo ID
$sql = "SELECT cidade, bairro, rua, preco, descricao, nome, telefone, email, img_main FROM imoveis WHERE id_imovel = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $id);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows > 0) {    
    $imovel = $result->fetch_assoc();
} else {
    echo "Imóvel não encontrado.";
    exit;
}
$stmt->close();

// Função para salvar a imagem e retornar o caminho
function salvarImagem($file, $destino) {
    if ($file['error'] === UPLOAD_ERR_OK) {
        $ext = pathinfo($file['name'], PATHINFO_EXTENSION);
        $nomeArquivo = uniqid() . '.' . $ext;
        $caminhoCompleto = $destino . $nomeArquivo;
        move_uploaded_file($file['tmp_name'], $caminhoCompleto);
        return $caminhoCompleto;
    }
    return null;
}

// Diretório para armazenar as imagens
$destino = "../uploads/";

// Verificando o envio do formulário de atualização
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $cidade = $_POST['cidade'];
    $bairro = $_POST['bairro'];
    $rua = $_POST['rua'];
    $preco = $_POST['preco'];
    $descricao = $_POST['descricao'];
    $nome = $_POST['nome'];
    $telefone = $_POST['telefone'];
    $email = $_POST['email'];
    
    // Verificar se uma nova imagem foi enviada
    $imagemNova = isset($_FILES['img_main']) ? salvarImagem($_FILES['img_main'], $destino) : $imovel['img_main'];
    
    // Atualizando os dados do imóvel
    $sql = "UPDATE imoveis SET cidade=?, bairro=?, rua=?, preco=?, descricao=?, nome=?, telefone=?, email=?, img_main=? WHERE id_imovel=?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("sssdsssssi", $cidade, $bairro, $rua, $preco, $descricao, $nome, $telefone, $email, $imagemNova, $id);

    if ($stmt->execute()) {
        header("Location: ../index.php?success=1");
        exit();
    } else {
        echo "Erro ao atualizar o imóvel.";
    }

    $stmt->close();
    $conn->close();
}
?>

<!-- Formulário HTML para atualização -->
<body>
<?php include_once "../componentes/navbar_update.php"; ?>
<div class="container my-5">
    <form action="" method="POST" enctype="multipart/form-data">
        <input type="hidden" name="id" value="<?php echo $id; ?>">

        <!-- Campo de Imagem Principal -->
        <div class="col-md-6">
            <label for="img_main" class="form-label mt-3">Alterar imagem:</label>
            <input type="file" name="img_main" id="img_main" class="form-control" onchange="previewImagem(event)">
            <img id="imagem-preview" src="<?php echo $imovel['img_main']; ?>" alt="Casa à venda" class="img-fluid rounded">
        </div>

        <!-- Detalhes do Imóvel -->
        <div class="row">
            <div class="col-md-6">
                <label for="endereco" class="form-label">Endereço</label>
                <div class="d-flex">
                    <input type="text" class="form-control" id="cidade" name="cidade" value="<?php echo $imovel['cidade']; ?>">
                    <input type="text" class="form-control" id="bairro" name="bairro" value="<?php echo $imovel['bairro']; ?>">
                    <input type="text" class="form-control" id="rua" name="rua" value="<?php echo $imovel['rua']; ?>">
                </div>
            </div>
            <div class="col-md-6">
                <label for="preco" class="form-label">Preço</label>
                <input type="number" class="form-control" id="preco" name="preco" value="<?php echo $imovel['preco']; ?>">
            </div>
            <div class="col-md-6">
                <label for="descricao" class="form-label">Descrição</label>
                <textarea class="form-control" id="descricao" name="descricao" rows="4"><?php echo $imovel['descricao']; ?></textarea>
            </div>
        </div>

        <!-- Informações de Contato -->
        <div class="mb-3">
            <label for="nome" class="form-label">Nome do Contato</label>
            <input type="text" class="form-control" id="nome" name="nome" value="<?php echo $imovel['nome']; ?>">
        </div>
        <div class="mb-3">
            <label for="telefone" class="form-label">Telefone</label>
            <input type="text" class="form-control" id="telefone" name="telefone" value="<?php echo $imovel['telefone']; ?>">
        </div>
        <div class="mb-3">
            <label for="email" class="form-label">Email</label>
            <input type="email" class="form-control" id="email" name="email" value="<?php echo $imovel['email']; ?>">
        </div>
        
        <!-- Botão de envio -->
        <button type="submit" class="btn btn-success mt-3">Salvar Modificações</button>
    </form>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
<?php include_once "../componentes/modal_update.php"; ?>
</body>
</html>
