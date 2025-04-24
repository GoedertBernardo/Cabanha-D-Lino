<?php
// Lê o JSON e transforma em array PHP
$dadosJson = file_get_contents('motos.json');
$veiculos = json_decode($dadosJson, true);
?>
<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <link rel="stylesheet" href="style.css">
    <title>MG Multimarcas</title>
    <link rel="shortcut icon" href="images/logos/logomg.png" type="image/x-icon">
</head>
<script src="script.js"></script>

<body>
    <header>
        <section class="top-header">
            <div class="interface">
                <div class="logotipo">
                    <a href="#">
                        <img src="images/logos/logomg.png" alt="Cabanha D'Lino">
                    </a>

                </div>
                <div class="btn-social">
                    <a href="https://www.instagram.com/cabanhadlino/"><button><i
                                class="bi bi-instagram"></i></button></a>
                    <a href="https://w.app/cabanhadlino"><button><i class="bi bi-whatsapp"></i></button></a>
                    <a href=""><button><i class="bi bi-facebook"></i></button></a>
                </div>
            </div>
        </section>

        <section class="botton-header">
            <div class="interface">

                <nav>
                    <ul>
                        <li><a href="index.php">INÍCIO</a></li>
                        <li class="drop-hover"><a href="#">ESTOQUE <i class="bi bi-caret-down-fill"></i></a>
                            <div class="drop">
                                <a href="motos.php">MOTOS</a>
                                <a href="automoveis.php">AUTOMÓVEIS</a>
                                <a href="caminhoes.php">CAMINHÕES</a>
                            </div>
                        </li>
                        <li><a href="sobre.html">SOBRE</a></li>
                    </ul>
                </nav>

            </div>

        </section>
        <section class="carros">
            <div class="interface">
                <div class="grid-carros">

                    <?php foreach ($veiculos as $veiculo): ?>
                        <div class="card-carro">
                            <?php if (isset($veiculo['destaque']) && $veiculo['destaque']): ?>
                                <div class="etiqueta">Baixo KM</div>
                            <?php endif; ?>

                            <img src="images/<?php echo $veiculo['imagem']; ?>" alt="<?php echo $veiculo['modelo']; ?>">
                            <h3><?php echo strtoupper($veiculo['modelo']); ?></h3>
                            <p><i class="bi bi-calendar3"></i> <?php echo $veiculo['ano']; ?></p>
                            <p><i class="bi bi-speedometer2"></i> <?php echo number_format($veiculo['km'], 0, ',', '.'); ?>
                                km</p>
                            <span class="preco">R$ <?php echo number_format($veiculo['preco'], 2, ',', '.'); ?></span>
                            <a href="detalhes.php?id=<?php echo $veiculo['id']; ?>&categoria=motos" class="btn-comprar">Ver detalhes</a>
                        </div>
                    <?php endforeach; ?>


                </div>
            </div>
        </section>
    </header>
</body>
<footer class="rodape">
    <div class="interface">
        <div class="rodape-conteudo">
            <div class="coluna logo-box">
                <div class="logo-bg">
                    <img src="images/logos/logomg.png" alt="MG Multimarcas" class="logo-rodape" />
                </div>
                <p>Conectando você ao seu próximo veículo com confiança e qualidade.</p>
            </div>

            <div class="coluna">
                <h4>Links Rápidos</h4>
                <ul>
                    <li><a href="index.html">Início</a></li>
                    <li><a href="automoveis.html">Estoque</a></li>
                    <li><a href="sobre.html">Sobre</a></li>
                </ul>
            </div>

            <div class="coluna">
                <h4>Contato</h4>
                <p><i class="bi bi-telephone-fill"></i> (48) 98874-8855</p>
                <p><i class="bi bi-envelope-fill"></i> mgmultimarcas@floripa.com.br</p>
                <p><i class="bi bi-geo-alt-fill"></i> Florianópolis - SC</p>
            </div>
        </div>

        <div class="rodape-copy">
            <p>&copy; 2025 MG Multimarcas. Todos os direitos reservados.</p>
        </div>
    </div>
</footer>

</html>