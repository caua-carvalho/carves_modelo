<?php
require_once "../conn.php";

if (isset($_GET['id'])) {
    $id = $_GET['id'];

    $sql = "DELETE FROM imoveis WHERE id_imovel = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $id);

    if ($stmt->execute()) {
        header("Location: ../index.php?sucess=1"); // Redireciona após exclusão
    } else {
        echo "Erro ao excluir o imóvel.";
    }

    $stmt->close();
} else {
    echo "ID do imóvel não fornecido.";
}

$conn->close();
?>
