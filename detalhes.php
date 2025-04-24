<?php
// detalhes.php
$id = $_GET['id'];
$categoria = $_GET['categoria'];
if ($categoria == 'carros') { 
    $data = file_get_contents("automoveis.json");
} elseif ($categoria == 'motos') {
    $data = file_get_contents("motos.json");
} elseif ($categoria == 'caminhoes') {
    $data = file_get_contents("caminhoes.json");
} else {
    // Se a categoria não for válida, você pode definir um valor padrão ou retornar um erro
    $data = null; // ou um valor padrão, ou uma mensagem de erro
}





$carros = json_decode($data, true);

// encontra o carro com o id correspondente
foreach ($carros as $carro) {
    if ($carro['id'] == $id) {
        $veiculo = $carro;
        break;
    }
}
?>
<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <link rel="stylesheet" href="style.css">
    <script src="script.js" defer></script>
    <title>MG Multimarcas</title>
    <link rel="shortcut icon" href="images/logos/logomg.png" type="image/x-icon">
</head>

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
                    <a href="https://wa.me/5548988748855"><button><i class="bi bi-whatsapp"></i></button></a>
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
    </header>
    <section>
    <h2 class="titulo-slider"><?php printf("%s %s", $carro["marca"], $carro["modelo"]); ?></h2>
        <div class="container-slider">
            <button id="prev-button"><i class="bi bi-arrow-left-circle-fill"></i></button>
            <div class="container-image">
                <?php foreach ($carro['imagens'] as $index => $imagem): ?>
                    <img src="images/<?php echo $imagem; ?>" alt="Imagem <?php echo $index + 1; ?>"
                        class="slider <?php echo $index === 0 ? 'on' : ''; ?>">
                <?php endforeach; ?>
            </div>
            <button id="next-button"><i class="bi bi-arrow-right-circle-fill"></i></button>
        </div>
        <div class="detalhes">
            <div class="preco-detalhes">R$ <?php echo number_format($carro['preco'], 2, ',', '.'); ?></div>
            <div class="caracteristicas">
                <div class="item"><i class="bi bi-calendar"></i><span><?= $carro["ano"] ?></span></div>
                <div class="item"><i class="bi bi-speedometer2"></i><span> <?php echo number_format($carro['km'], 0, ',', '.'); ?>
                km</span></div>
                <div class="item"><button class="brand-info"><svg width="32" height="32" viewBox="0 0 32 32" fill="none"
                            xmlns="http://www.w3.org/2000/svg">
                            <circle cx="16" cy="16" r="16" style="fill: var(--main-primary-color);"></circle>
                            <path
                                d="M9.69105 10.3636V22H12.0774V14.3977H12.174L15.1854 21.9432H16.8104L19.8217 14.4261H19.9183V22H22.3047V10.3636H19.2706L16.0661 18.1818H15.9297L12.7251 10.3636H9.69105Z"
                                fill="white"></path>
                        </svg></button><span><?= $carro["marca"] ?></span></div>
                <div class="item"> <button class="brand-info"><svg width="22" height="32" viewBox="0 0 22 32"
                            fill="none" xmlns="http://www.w3.org/2000/svg">
                            <path
                                d="M1.71289 6.3667V16.1694H11.2947M11.2947 16.1694V6.3667M11.2947 16.1694V24.9667M11.2947 16.1694H20.3129M20.3129 16.1694V6.3667M20.3129 16.1694V24.9667"
                                style="stroke: var(--main-primary-color);" stroke-width="3.1" stroke-linecap="round"
                                stroke-linejoin="round"></path>
                            <circle cx="1.71211" cy="1.71675" r="1.55" style="fill: var(--main-primary-color);">
                            </circle>
                            <circle cx="11.3313" cy="1.71675" r="1.55" style="fill: var(--main-primary-color);">
                            </circle>
                            <circle cx="11.3078" cy="29.6168" r="1.55" style="fill: var(--main-primary-color);">
                            </circle>
                            <circle cx="20.3117" cy="1.71675" r="1.55" style="fill: var(--main-primary-color);">
                            </circle>
                            <circle cx="20.3117" cy="29.6168" r="1.55" style="fill: var(--main-primary-color);">
                            </circle>
                        </svg></button><span><?= $carro["cambio"] ?></span></div>
                <div class="item"><i class="bi bi-fuel-pump"></i><span><?= $carro["combustivel"] ?></span></div>
                <div class="item"> <button class="brand-info">
                        <svg width="32" height="32" viewBox="0 0 32 32" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <path
                                d="M31.9579 15.099L28.8283 6.75453C28.2098 5.10415 27.1069 3.71483 25.6401 2.73626C24.2632 1.81825 22.6603 1.33325 21.006 1.33325H2.6667C1.19594 1.33325 0 2.5292 0 3.99995V28.0001C0 29.4708 1.19594 30.6668 2.6667 30.6668H18.1062C18.4376 30.6668 18.7188 30.4233 18.7664 30.0945C19.3732 25.8601 23.0568 22.6667 27.3335 22.6667C27.7235 22.6667 28.1043 22.7019 28.4813 22.7521C28.7769 22.7938 29.0718 22.6238 29.1864 22.3439L31.9507 15.586C32.0139 15.4303 32.0164 15.2565 31.9579 15.099ZM18.0001 25.3334H3.33333C2.96483 25.3334 2.66664 25.0352 2.66664 24.6667C2.66664 24.2982 2.96483 24 3.33333 24H18.0001C18.3686 24 18.6668 24.2982 18.6668 24.6667C18.6668 25.0352 18.3686 25.3334 18.0001 25.3334ZM4.00002 16V5.33328H21.006C21.8686 5.33328 22.7039 5.5859 23.4214 6.0644C24.1857 6.57416 24.7606 7.29816 25.0828 8.15879L27.7612 15.3014L27.5236 15.9987L4.00002 16ZM27.3335 20H23.3334C22.9649 20 22.6667 19.7019 22.6667 19.3334C22.6667 18.9649 22.9649 18.6667 23.3334 18.6667H27.3335C27.702 18.6667 28.0002 18.9649 28.0002 19.3334C28.0002 19.7019 27.702 20 27.3335 20Z"
                                style="fill: var(--main-primary-color);"></path>
                            <path
                                d="M9.1387 6.86196C8.87827 6.60152 8.45639 6.60152 8.19601 6.86196L5.52931 9.52866C5.26887 9.7891 5.26887 10.211 5.52931 10.4713C5.6595 10.6015 5.83013 10.6667 6.00069 10.6667C6.17125 10.6667 6.34182 10.6015 6.47207 10.4713L9.13877 7.80465C9.39914 7.54427 9.39914 7.12239 9.1387 6.86196Z"
                                style="fill: var(--main-primary-color);"></path>
                            <path
                                d="M10.8614 7.52858L6.86134 11.5286C6.60091 11.789 6.60091 12.2109 6.86134 12.4713C6.99153 12.6015 7.16216 12.6666 7.33272 12.6666C7.50329 12.6666 7.67385 12.6015 7.8041 12.4713L11.8041 8.47127C12.0646 8.21084 12.0646 7.78896 11.8041 7.52858C11.5436 7.26814 11.1217 7.26814 10.8614 7.52858Z"
                                style="fill: var(--main-primary-color);"></path>
                        </svg>
                    </button><span><?= $carro["portas"] ?></span></div>
                <div class="item"><i class="bi bi-car-front"></i><span><?= $carro["modelo"] ?></span></div>
                <div class="item"><i class="bi bi-paint-bucket"></i><span><?= $carro["cor"] ?></span></div>
            </div>
        </div>

        <button class="button-whatsapp" onclick="window.open('https://wa.me/5548988748855')">
            <i class="bi bi-whatsapp"></i> whatsapp
        </button>

        <div class="info-slider">
            <h2>Informações sobre o veículo</h2>
            <p>
                <?= implode("<br>", $carro["info"]) ?>
            </p>
        </div>
    </section>

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