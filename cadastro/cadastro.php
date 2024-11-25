<?php 
    include_once "../estilo/header.html";
    require_once "../conn.php";
?>

<title>Cadastro de Imóvel</title>
<head>
</head>

<body>
    <!-- Navbar -->
    <?php include_once "../componentes/navbar_cadastro.php"; ?>

    <!-- Formulário de Cadastro de Imóvel -->
    <div class="container mt-5 mb-5">
        <div class="d-flex justify-content-center">
            <h2>Cadastro de Imóvel</h2>
        </div>

        <br>

        <h4>Informações do imóvel</h4>
        
        <form action="cadastrar_imovel.php" method="POST" enctype="multipart/form-data"> <!-- Adicionando o enctype -->
            <div class="mb-3">
                <label for="titulo" class="form-label">Título</label>
                <input type="text" class="form-control" id="titulo" name="titulo" required>
            </div>
            <div class="mb-3">
                <label for="cidade" class="form-label">Cidade</label>
                <input type="text" class="form-control" id="cidade" name="cidade" required>
            </div>
            <div class="mb-3">
                <label for="bairro" class="form-label">Bairro</label>
                <input type="text" class="form-control" id="bairro" name="bairro" required>
            </div>
            <div class="mb-3">
                <label for="rua" class="form-label">Rua</label>
                <input type="text" class="form-control" id="rua" name="rua" required>
            </div>
            <div class="mb-3">
                <label for="preco" class="form-label">Preço</label>
                <input type="number" class="form-control" id="preco" name="preco" required>
            </div>
            <div class="mb-3">
                <label for="descricao" class="form-label">Descrição</label>
                <textarea class="form-control" id="descricao" name="descricao" rows="3" required></textarea>
            </div>

            <h4>Informações do Proprietário</h4>
            <div class="mb-3">
                <label for="nome" class="form-label">Nome do Contato</label>
                <input type="text" class="form-control" id="nome" name="nome" required>
            </div>
            <div class="mb-3">
                <label for="telefone" class="form-label">Telefone</label>
                <input type="text" class="form-control" id="telefone" name="telefone" oninput="formatarTelefone(this)" required>
            </div>
            <div class="mb-3">
                <label for="email" class="form-label">Email</label>
                <input type="email" class="form-control" id="email" name="email" required>
            </div>

            <div class="mb-3">
                <label for="img_main">Imagem Principal:</label>
                <input class="form-control" type="file" name="img_main" id="img_main" accept="image/*" required>
            </div>

            <button type="submit" class="btn btn-primary mt-1">Cadastrar Imóvel</button>
        </form>
    </div>

    <!-- Modal de Sucesso -->
    <?php include_once "../componentes/modal_cadastro.php"; ?>
</body>
