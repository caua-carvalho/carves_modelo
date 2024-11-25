<select class="form-select" id="anunciador" name="cidade">
    <option value="">escolher cidade...</option>
    <?php
    $sql = "SELECT nome FROM imoveis WHERE 1=1";

    $result = $conn->query($sql);
    
    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            echo "<option value='" . $row['nome'] . "'>" . $row['nome'] . "</option>";
        }
    } else {
        echo "<option value=''>Nenhuma cidade cadastrada...</option>";
    }
    ?>
</select>