<select class="form-select" id="anunciador" name="email">
    <option value="">escolher email...</option>
    <?php
    $sql = "SELECT email FROM imoveis WHERE 1=1";

    $result = $conn->query($sql);
    
    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            echo "<option value='" . $row['email'] . "'>" . $row['email'] . "</option>";
        }
    } else {
        echo "<option value=''>Nenhuma email cadastrada...</option>";
    }
    ?>
</select>