    <?php 

    session_start();
    if (!isset($_SESSION['user'])) {
        header('Location: index.php');
        exit;
    }

    $mensagem = "";
    $urlDir = "veiculos/";
    $uploadPath = __DIR__ . "/images/veiculos/";

    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $imagemPrincipal = "";
        if (isset($_FILES['imagem']) && $_FILES['imagem']['error'] === 0) {
            $ext = pathinfo($_FILES['imagem']['name'], PATHINFO_EXTENSION);
            $nomeImagem = uniqid() . '.' . $ext;
            $caminhoFisico = $uploadPath . $nomeImagem;
            move_uploaded_file($_FILES['imagem']['tmp_name'], $caminhoFisico);
            $imagemPrincipal = $urlDir . $nomeImagem;
        }

        $outrasImagens = [];
        if (!empty($_FILES['imagens']['name'][0])) {
            foreach ($_FILES['imagens']['tmp_name'] as $key => $tmpName) {
                if ($_FILES['imagens']['error'][$key] === 0) {
                    $ext = pathinfo($_FILES['imagens']['name'][$key], PATHINFO_EXTENSION);
                    $nomeExtra = uniqid() . '.' . $ext;
                    $caminhoFisicoExtra = $uploadPath . $nomeExtra;
                    move_uploaded_file($tmpName, $caminhoFisicoExtra);
                    $outrasImagens[] = $urlDir . $nomeExtra;
                }
            }
        }

        $categoria = $_POST['categoria'] ?? 'automoveis';
        $jsonPath = $categoria . '.json';
        $veiculos = [];
        if (file_exists($jsonPath)) {
            $json = file_get_contents($jsonPath);
            $veiculos = json_decode($json, true);
        }

        $maxId = 0;
        foreach ($veiculos as $v) {
            if ($v['id'] > $maxId) {
                $maxId = $v['id'];
            }
        }
        $novoId = $maxId + 1;

        $novoVeiculo = [
            "id" => $novoId,
            "modelo" => $_POST['modelo'],
            "km" => $_POST['km'],
            "marca" => $_POST['marca'],
            "ano" => (int) $_POST['ano'],
            "preco" => (float) $_POST['preco'],
            "imagem" => $imagemPrincipal,
            "cor" => $_POST['cor'],
            "portas" => $_POST['portas'],
            "combustivel" => $_POST['combustivel'],
            "cambio" => $_POST['cambio'],
            "imagens" => $outrasImagens,
            "info" => array_map('trim', explode(',', $_POST['info']))
        ];

        $veiculos[] = $novoVeiculo;

        file_put_contents($jsonPath, json_encode($veiculos, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES));

        $mensagem = "Veículo adicionado com sucesso!";
    }
    ?>
    <!DOCTYPE html>
    <html lang="pt-br">
    <head>
        <meta charset="UTF-8">
        <title>Dashboard</title>
        <link rel="stylesheet" href="dashboard.css">
        <link rel="shortcut icon" href="images/logos/logomg.png" type="image/x-icon">
    </head>
    <body>
        <h2>Bem-vindo, <?php echo $_SESSION['user']; ?>!</h2>
        <a href="logout.php">Sair</a>

        <h3>Adicionar novo veículo</h3>
        <?php if ($mensagem) echo "<p style='color:green;'>$mensagem</p>"; ?>
        <main class="container">
            <form method="POST" enctype="multipart/form-data">
                <label>Modelo:</label><br><input name="modelo" required><br>
                <label>KM:</label><br><input name="km" required><br>
                <label>Marca:</label><br><input name="marca" required><br>
                <label>Ano:</label><br><input name="ano" type="number" required><br>
                <label>Preço:</label><br><input name="preco" type="number" required><br>
                <label>Cor:</label><br><input name="cor" required><br>
                <label>Portas:</label><br><input name="portas" required><br>
                <label>Combustível:</label><br><input name="combustivel" required><br>
                <label>Câmbio:</label><br><input name="cambio" required><br><br>

                <label>Imagem principal:</label><br>
                <input type="file" name="imagem" accept="image/*" required><br><br>

                <label>Outras imagens (várias):</label><br>
                <input type="file" name="imagens[]" accept="image/*" multiple><br><br>

                <label>Informações (separadas por vírgula):</label><br>
                <input name="info" placeholder="Ex: Airbag, Ar-condicionado"><br><br>
                <label>Categoria:</label><br>
                <select name="categoria" required>
                    <option value="automoveis">Automóveis</option>
                    <option value="caminhoes">Caminhões</option>
                    <option value="motos">Motos</option>
                </select><br><br>

                <button type="submit">Adicionar</button>
            </form>
        </main>

        <h3>Estoque de Veículos</h3>

        <?php
        $categorias = ['automoveis', 'caminhoes', 'motos'];

        foreach ($categorias as $categoria) {
            $jsonPath = $categoria . '.json';

            if (file_exists($jsonPath)) {
                $veiculos = json_decode(file_get_contents($jsonPath), true);
                if (!empty($veiculos)) {
                    echo "<h4 class='titulo-{$categoria}'>" . ucfirst($categoria) . "</h4>";
                    echo "<table border='1' cellpadding='8'>";
                    echo "<tr>
                        <th>ID</th>
                        <th>Imagem</th>
                        <th>Modelo</th>
                        <th>Marca</th>
                        <th>Ano</th>
                        <th>Preço</th>
                        <th>Ações</th>
                    </tr>";
                    foreach ($veiculos as $v) {
                        echo "<tr>
                            <td>{$v['id']}</td>
                            <td><img src='images/{$v['imagem']}' width='100'></td>
                            <td>{$v['modelo']}</td>
                            <td>{$v['marca']}</td>
                            <td>{$v['ano']}</td>
                            <td>R$ " . number_format($v['preco'], 2, ',', '.') . "</td>
                            <td>
                            <a href='apagar.php?id={$v['id']}&categoria={$categoria}'>Apagar</a>
                            </td>
                        </tr>";
                    }
                    echo "</table>";
                } else {
                    echo "<p class='sem-veiculos titulo-{$categoria}'>Nenhum veículo cadastrado em <strong>" . ucfirst($categoria) . "</strong>.</p>";
                }
            }
        }
        ?>

    </body>
    </html>