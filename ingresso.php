<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ivete & Helquia</title>
    <link rel="stylesheet" href="./css/estilo.css">
</head>
<body>
    
    <header class="cabecalho">
        <div class="icon">
            <h1><a href="./">ivete & helquia</a></h1>
        </div>
        <div class="menus">
            <ul>
                <li class="menu-item"><a href="./">Inicio</a></li>
            </ul>
        </div>
    </header>
    <?php 
        require_once("base_dados/conexao.php");
        require_once("Utils/utils.php");
        $id = $_GET["id"];
        $evento = getEventoPorId($conn, $id);
        $ingresso = getEventoPrecario($conn, $id);
    ?>

    <h1 class="titulo">Detalhes do Evento</h1>
    <main class="evento">
        <div class="evento-info">
            <img src="foto/<?= $evento["foto"] ?>" alt="Imagem do Evento">
            <h2><?= $evento["nome"] ?></h2>
            <p><?= $evento["descricao"] ?></p>
            <p>Data do Evento: <?= $evento["data_evento"] ?></p>
            <p>Local do Evento: <?= $evento["local"] ?></p>
            <hr>
            <?php while($i = mysqli_fetch_assoc($ingresso)): ?>
                <input type="number" id="<?= $i["tipo"] ?>" value="<?= $i["preco"] ?>" style="display:none;">
                <input type="number" id="<?= $i["tipo"] ?>_Id" value="<?= $i["id"] ?>" style="display:none;">
                <p class="precario">Preço: <?= $i["preco"] ?> Kz <?= $i["tipo"] ?> <span>Disponivel: <?= $i["disponivel"] ?></span></p>
            <?php endwhile; ?>
        </div>
        <div class="evento-form">
            <h2>Compre aqui seu Ingresso</h2>
            <label for="nome">Nome do Cliente</label>
            <input type="text" id="nome" name="nome" required>
            
            <label for="qtd">Quantidade de Ingressos:</label>
            <input type="number" id="qtd" name="qtd" required>

            <label for="qtd">Tipo de Ingressos:</label>
            <select name="tipo" id="tipo">
                <option value="Normal">Ingresso Normal</option>
                <option value="VIP">Ingresso VIP</option>
            </select>
            
            <button type="submit" id="showNotification">Comprar</button>
        </div>
    </main>

    <div class="notificacao-overlay">
        <form action="comprar.php" method="post">
            <div class="notificacao">
                <div class="head">
                    <?= $evento["nome"] ?>
                </div>
                <input type="number" name="id" id="id_ingresso" style="display:none;">
                <div class="corpo">
                    <hr>
                    <label id="inome"></label>
                    <input type="hidden" id="nameVal" name="inome">
                    <label id="iqtd"></label>
                    <input type="hidden" id="qtdVal" name="iqtd">
                    <label id="itipo" name="itipo"></label>
                    <label id="ipreco"></label>
                    <label id="itotal"></label>
                    <hr>
                </div>
                <div class="footer">
                    <button id="compra" type="submit">Efetuar Compra</button>
                    <button id="cancelar">Cancelar</button>
                </div>
            </div>
        </form>
    </div>
    
    <script src="js/script.js"></script>
</body>
</html>