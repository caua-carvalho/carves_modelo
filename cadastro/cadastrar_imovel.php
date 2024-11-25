<?php
require_once "../conn.php";

// Verificar se o formulário foi enviado
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Pega os dados do formulário
    $cidade = trim($_POST['cidade']);
    $bairro = trim($_POST['bairro']);
    $rua = trim($_POST['rua']);
    $preco = trim($_POST['preco']);
    $descricao = trim($_POST['descricao']);
    $nome = trim($_POST['nome']);
    $telefone = trim($_POST['telefone']);
    $telefone = preg_replace('/\D/', '', $telefone);
    $email = trim($_POST['email']);

    // Validar campos obrigatórios
    if (empty($cidade) || empty($bairro) || empty($rua) || empty($preco) || empty($descricao) || empty($nome) || empty($telefone) || empty($email)) {
        echo "Todos os campos são obrigatórios!";
        exit;
    }

    // Verificar se uma imagem foi enviada
    if (isset($_FILES['img_main']) && $_FILES['img_main']['error'] === 0) {
        $arquivo = $_FILES['img_main'];

        // Verificar tipo de arquivo
        $tipo_imagem = mime_content_type($arquivo['tmp_name']);
        if (strpos($tipo_imagem, 'image') !== false) {
            // Pasta de upload
            $diretorio = "../uploads/";

            // Verificar se a pasta existe, se não, cria
            if (!is_dir($diretorio)) {
                mkdir($diretorio, 0777, true);
            }

            // Gerar um nome único e seguro para o arquivo
            $nome_arquivo = bin2hex(random_bytes(8)) . "-" . basename($arquivo['name']);
            $caminho_arquivo = $diretorio . $nome_arquivo;

            // Mover o arquivo para o diretório de uploads
            if (move_uploaded_file($arquivo['tmp_name'], $caminho_arquivo)) {
                // Inserir dados no banco de dados de forma segura
                $sql = "INSERT INTO imoveis (cidade, bairro, rua, preco, descricao, nome, telefone, email, img_main) 
                        VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?)";
                $stmt = $conn->prepare($sql);
                if ($stmt === false) {
                    echo "Erro ao preparar a consulta: " . $conn->error;
                    exit;
                }

                // Bind parâmetros
                $stmt->bind_param("sssississ", $cidade, $bairro, $rua, $preco, $descricao, $nome, $telefone, $email, $caminho_arquivo);

                // Executar a query
                if ($stmt->execute()) {
                    header("Location: ./cadastro.php");
                } else {
                    echo "Erro ao cadastrar o imóvel: " . $stmt->error;
                }
                $stmt->close();
            } else {
                echo "Erro ao mover o arquivo para o diretório de uploads.";
            }
        } else {
            echo "O arquivo enviado não é uma imagem válida.";
        }
    } else {
        echo "Imagem não foi enviada ou houve erro no envio. Erro: " . $_FILES['img_main']['error'];
    }
}

$conn->close();
?>
