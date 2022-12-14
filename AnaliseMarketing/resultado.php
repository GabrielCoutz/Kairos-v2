<!DOCTYPE html>
<html lang="pt-BR">

<head>
    <meta name="theme-color" content="#4466ff">
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="Kairos | Resultados">
    <link rel="shortcut icon" href="../assets/img/favicon.ico" type="image/x-icon">
    <link rel="stylesheet preload" as="style" href="../assets/css/style.min.css">
    <title>Seus resultados</title>
    <?php
    error_reporting(E_ERROR | E_PARSE);
    session_start();
    require_once('../assets/php/globals.php');

    $email = $_SESSION['email'];

    $query = "SELECT * FROM analise_swot WHERE email_usuario=?";
    $exec = $conec->prepare($query);
    $exec->bind_param("s", $email);
    $exec->execute();
    $select_swot = $exec->get_result()->fetch_assoc();

    $query = "SELECT * FROM analise_4ps WHERE email_usuario=?";
    $exec = $conec->prepare($query);
    $exec->bind_param("s", $email);
    $exec->execute();
    $select_4ps = $exec->get_result()->fetch_assoc();

    $query = "SELECT nome FROM usuario WHERE email=?";
    $exec = $conec->prepare($query);
    $exec->bind_param("s", $email);
    $exec->execute();
    $select_nome = $exec->get_result()->fetch_assoc()['nome'];

    switch (true) {
        case !isset($_SESSION['email']) && !strpos($protocol . $_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI'], hash("sha512", 'erro=true')):
            header("Refresh:0; url=resultado" . '?' . hash("sha512", 'erro=true'));
            exit;
            break;

        case !$select_swot && !$select_4ps && !strpos($protocol . $_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI'], hash("sha512", 'analise=false')) && !strpos($protocol . $_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI'], hash("sha512", 'sucesso=false')) && !strpos($protocol . $_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI'], hash("sha512", 'erro=true')):
            header("Refresh:0; url=resultado" . '?' . hash("sha512", 'analise=false'));
            exit;
            break;
    }
    ?>
</head>

<body class="body-perfil resultado">
    <div class="fundo-barra-lateral">
        <div class="barra-lateral">
            <nav aria-label="Navega????o Lateral">
                <ul class="nav-lateral">
                    <li><svg width="24" height="24" viewBox="0 0 24 24" fill="#ffffff" xmlns="http://www.w3.org/2000/svg">
                            <path d="M17 15H19V17H17V15Z" fill="#ffffff" />
                            <path d="M19 11H17V13H19V11Z" fill="#ffffff" />
                            <path fill-rule="evenodd" clip-rule="evenodd" d="M13 7H23V21H1V3H13V7ZM8 5H11V7H8V5ZM11 19V17H8V19H11ZM11 15V13H8V15H11ZM11 11V9H8V11H11ZM21 19V9H13V11H15V13H13V15H15V17H13V19H21ZM3 19V17H6V19H3ZM3 15H6V13H3V15ZM6 11V9H3V11H6ZM3 7H6V5H3V7Z" fill="#ffffff" />
                        </svg><a href="../Perfil/PerfilEmpresa/empresa">Perfil da Empresa</a></li>
                    <li class='nav-lateral-ativo'><svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <path d="M12.552 8C11.9997 8 11.552 8.44772 11.552 9C11.552 9.55228 11.9997 10 12.552 10H16.552C17.1043 10 17.552 9.55228 17.552 9C17.552 8.44772 17.1043 8 16.552 8H12.552Z" fill="#ffffff" fill-opacity="0.5" />
                            <path d="M12.552 17C11.9997 17 11.552 17.4477 11.552 18C11.552 18.5523 11.9997 19 12.552 19H16.552C17.1043 19 17.552 18.5523 17.552 18C17.552 17.4477 17.1043 17 16.552 17H12.552Z" fill="#ffffff" fill-opacity="0.5" />
                            <path d="M12.552 5C11.9997 5 11.552 5.44772 11.552 6C11.552 6.55228 11.9997 7 12.552 7H20.552C21.1043 7 21.552 6.55228 21.552 6C21.552 5.44772 21.1043 5 20.552 5H12.552Z" fill="#ffffff" fill-opacity="0.8" />
                            <path d="M12.552 14C11.9997 14 11.552 14.4477 11.552 15C11.552 15.5523 11.9997 16 12.552 16H20.552C21.1043 16 21.552 15.5523 21.552 15C21.552 14.4477 21.1043 14 20.552 14H12.552Z" fill="#ffffff" fill-opacity="0.8" />
                            <path d="M3.448 4.00208C2.89571 4.00208 2.448 4.44979 2.448 5.00208V10.0021C2.448 10.5544 2.89571 11.0021 3.448 11.0021H8.448C9.00028 11.0021 9.448 10.5544 9.448 10.0021V5.00208C9.448 4.44979 9.00028 4.00208 8.448 4.00208H3.448Z" fill="#ffffff" />
                            <path d="M3.448 12.9979C2.89571 12.9979 2.448 13.4456 2.448 13.9979V18.9979C2.448 19.5502 2.89571 19.9979 3.448 19.9979H8.448C9.00028 19.9979 9.448 19.5502 9.448 18.9979V13.9979C9.448 13.4456 9.00028 12.9979 8.448 12.9979H3.448Z" fill="#ffffff" />
                        </svg><a href="resultado">An??lise de Marketing</a></li>
                    <li><i aria-hidden="true" class="gg-credit-card"></i>
                        <a href="../Assinaturas/assinaturas">Minha assinatura</a>
                    </li>
                    <li><i aria-hidden="true" class="gg-user"></i>
                        <a href="../Perfil/usuario">Perfil</a>
                    </li>
                    <a href="../index" class="btn secundario menu-btn">Sair</a>
                </ul>
                <div class="hamburguer">
                    <span class="bar"></span>
                    <span class="bar"></span>
                    <span class="bar"></span>
                </div>
            </nav>
        </div>
    </div>
    <div class="principal">
        <header>
            <a href="../index" class="btn secundario">Sair</a>
        </header>
        <div class="perfil">
            <div class="bloco-metodologia none">
                <div class="SWOT">
                    <div class="swot-caixa">
                        <h1 class="titulo-metodo">For??as</h1>
                        <span>
                            <ul>
                                <?= $select_swot['forcas']; ?>
                            </ul>
                        </span>
                    </div>
                    <div class="swot-caixa">
                        <h1 class="titulo-metodo">Fraquezas</h1>
                        <span>
                            <ul>
                                <?= $select_swot['fraquezas']; ?>
                            </ul>
                        </span>
                    </div>
                    <div class="swot-caixa">
                        <h1 class="titulo-metodo">Oportunidades</h1>
                        <span>
                            <ul>
                                <?= $select_swot['oportunidades']; ?>
                            </ul>
                        </span>
                    </div>
                    <div class="swot-caixa">
                        <h1 class="titulo-metodo">Amea??as</h1>
                        <span>
                            <ul>
                                <?= $select_swot['ameacas']; ?>
                            </ul>
                        </span>
                    </div>
                </div>
                <div class="orientacoes-swot">
                    <h1>Agora sim <?= ucfirst(strtok($select_nome, " ")); ?>, vamos come??ar?</h1>
                    <span>
                        <p>Utilize estes resultados a fim de basear estrat??gias ben??ficas para a administra????o em sua
                            empresa.</p>
                        <p>Imaginamos que voc?? est?? pensando "Como fa??o isso?", certo?</p>
                        <p>Sem stress! Precisa fazer as rela????es de cada item da matriz. Separamos algumas perguntas
                            para ajud??-lo nessa:</p>
                    </span>
                    <ul>
                        <li>
                            <h1>For??as + Oportunidades</h1>Quais pontos fortes podem ser potencializados para maximizar
                            as oportunidades?
                        </li>
                        <li>
                            <h1>For??as + Amea??as</h1>Quais pontos fortes podem ser estudados para minimizar o impacto
                            das amea??as?
                        </li>
                        <li>
                            <h1>Fraquezas + Oportunidades</h1>Quais pontos fracos podem ser corrigidos para aproveitar
                            as oportunidades?
                        </li>
                        <li>
                            <h1>Fraquezas + Amea??as</h1>Quais pontos fracos podem ser resolvidos para minimizar o efeito
                            das amea??as?
                        </li>
                    </ul>
                </div>
            </div>
            <div class="bloco-metodologia none">
                <div class="compostoMK">
                    <div class="composto-caixa">
                        <h1 class="titulo-metodo">Produto</h1>
                        <span>
                            <ul>
                                <?= $select_4ps['produto']; ?>
                            </ul>
                        </span>
                    </div>
                    <div class="composto-caixa">
                        <h1 class="titulo-metodo">Pre??o</h1>
                        <span>
                            <ul>
                                <?= $select_4ps['preco']; ?>
                            </ul>
                        </span>
                    </div>
                    <div class="composto-caixa">
                        <h1 class="titulo-metodo">Pra??a</h1>
                        <span>
                            <ul>
                                <?= $select_4ps['praca']; ?>
                            </ul>
                        </span>
                    </div>
                    <div class="composto-caixa">
                        <h1 class="titulo-metodo">Promo????o</h1>
                        <span>
                            <ul>
                                <?= $select_4ps['promocao']; ?>
                            </ul>
                        </span>
                    </div>
                </div>
                <div class="orientacoes-composto">
                    <h1>Sua estrat??gia pode ser mais que competitiva, pode ser imbat??vel.</h1>
                    <span>
                        <p>?? o alinhamento desses itens que ir?? compor toda a estrat??gia de marketing da sua empresa.
                        </p>
                        <p>Pense neles como pe??as de um quebra-cabe??a que ir??o se encaixar para formar o todo.</p>
                        <p>Portanto, voc?? comunicar?? aos seus consumidores o posicionamento da sua marca e ir?? promover
                            o desejo de compra no seu p??blico-alvo.</p>
                        <p>
                            Com todos estes itens, foque em como mostrar ?? seus clientes o motivo, de maneira clara e
                            objetiva, de:<br>
                        </p>
                    </span>
                    <ul>
                        <li>
                            <h1>Produto</h1>Todos benef??cios que podem obter.
                        </li>
                        <li>
                            <h1>Pre??o</h1>Pagar pelo valor agregado no que voc?? oferece.
                        </li>
                    </ul>
                    <h1>E v?? al??m.</h1>
                    <span>
                        <p>Explore o seu mercado:</p>
                    </span>
                    <ul>
                        <li>
                            <h1>Pra??a</h1> Investique os melhores canais de distribui????o e log??stica.
                        </li>
                        <li>
                            <h1>Promo????o</h1> Valor da marca e do ofertado em rela????o ao mercado.
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</body>
<script src="https://cdnjs.cloudflare.com/ajax/libs/crypto-js/4.1.1/crypto-js.min.js" integrity="sha512-E8QSvWZ0eCLGk4km3hxSsNmGWbLtSCSUcewDQPQWZF6pEU8GlT8a5fF32wOl1i8ftdMhssTrF/OhyGWwonTcXA==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>

<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.1/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.mask/1.14.15/jquery.mask.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/js-cookie@2/src/js.cookie.min.js"></script>

<script src="../assets/js/scriptPopUp.js"></script>
<script src="../assets/js/globals.js"></script>
<script src="../assets/js/formulario.js"></script>
<script src="../assets/js/popup.js"></script>

<script src="assets/js/script.js"></script>

</html>