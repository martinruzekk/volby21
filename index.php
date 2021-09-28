<!DOCTYPE html>
<html lang="cs">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Volby 2021</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bulma@0.9.3/css/bulma.min.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Open+Sans:ital,wght@0,300;0,400;0,500;0,600;0,700;0,800;1,300;1,400;1,500;1,600;1,700;1,800&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="styles/style.css">
</head>

<body>
    <div class="container">
        <h1 class="is-size-1 has-text-centered">VOLBY 2021</h1>
        <h4 class="is-size-4 has-text-centered m-0 p-0">Volby v Karlovarském kraji</h4>
        <h5 class="has-text-centered">Do začátku voleb zbývá: <span id="countdownDays"></span>:<span id="countdownHours"></span>:<span id="countdownMinutes"></span>:<span id="countdownSeconds"></span></h5>
        <p class="has-text-weight-light has-text-right" id="nextReload"></p>
        <div class="box">
            <h3 class="is-size-3">Výsledky v celé republice</h3>
            <p class="has-text-weight-light updateCr"></p>
            <div>
                <h4 class="is-size-4">Sečteno</h4>
                <progress class="progress is-link is-medium crSectenoProgress" value="" max=""></progress>
                <div class="strech">
                    <p>0 okrsků</p>
                    <p id="crSectenoAktualne"></p>
                    <p id="crSectenoOkrskuCelkem"></p>
                </div>
            </div>

            <div class="mt-5">
                <h4 class="is-size-4 mt-5">Účast</h4>
                <progress class="progress is-link is-medium crUcastProgress" value="<?php echo $cr['ucast']['ucast'] ?>" max="100"><?php echo $cr['ucast']['ucast'] ?> %</progress>
                <div class="strech">
                    <p>0 %</p>
                    <p id="crUcastPrc"></p>
                    <p>100 %</p>
                </div>
            </div>

            <div class="mt-5">
                <h4 class="is-size-4 mt-5">Výsledky</h4>
                <canvas id="chartCr"></canvas>
            </div>
        </div>

        <div class="box">
            <h3 class="is-size-3">Výsledky Karlovarském kraji</h3>
            <p class="has-text-weight-light updateCr"></p>
            <div>
                <h4 class="is-size-4">Sečteno</h4>
                <progress class="progress is-link is-medium krajSectenoProgress" value="" max=""></progress>
                <div class="strech">
                    <p>0 okrsků</p>
                    <p id="krajSectenoAktualne"></p>
                    <p id="krajSectenoOkrskuCelkem"></p>
                </div>
            </div>

            <div class="mt-5">
                <h4 class="is-size-4 mt-5">Účast</h4>
                <progress class="progress is-link is-medium krajUcastProgress" value="" max="100"></progress>
                <div class="strech">
                    <p>0 %</p>
                    <p id="krajUcastPrc"></p>
                    <p>100 %</p>
                </div>
            </div>

            <div class="mt-5">
                <h4 class="is-size-4 mt-5">Výsledky</h4>
                <canvas id="chartKVK"></canvas>

            </div>
        </div>

        <div class="box">
            <h3 class="is-size-3">Okres Karlovy Vary</h3>
            <p class="has-text-weight-light updateKv"></p>
            <div>
                <h4 class="is-size-4">Sečteno</h4>
                <progress class="progress is-link is-medium okresKvSectenoProgress" value="" max=""></progress>
                <div class="strech">
                    <p>0 okrsků</p>
                    <p id="okresKvSectenoAktualne"></p>
                    <p id="okresKvSectenoOkrskuCelkem"></p>
                </div>
            </div>

            <div class="mt-5">
                <h4 class="is-size-4 mt-5">Účast</h4>
                <progress class="progress is-link is-medium okresKvUcastProgress" value="" max="100"></progress>
                <div class="strech">
                    <p>0 %</p>
                    <p id="okresKvUcastPrc"></p>
                    <p>100 %</p>
                </div>
            </div>

            <div class="mt-5">
                <h4 class="is-size-4 mt-5">Výsledky</h4>
                <canvas id="chartOkresKV"></canvas>
            </div>
        </div>

        <div class="box">
            <h3 class="is-size-3">Okres Sokolov</h3>
            <p class="has-text-weight-light updateSok"></p>
            <div>
                <h4 class="is-size-4">Sečteno</h4>
                <progress class="progress is-link is-medium okresSokSectenoProgress" value="" max=""></progress>
                <div class="strech">
                    <p>0 okrsků</p>
                    <p id="okresSokSectenoAktualne"></p>
                    <p id="okresSokSectenoOkrskuCelkem"></p>
                </div>
            </div>

            <div class="mt-5">
                <h4 class="is-size-4 mt-5">Účast</h4>
                <progress class="progress is-link is-medium okresSokUcastProgress" value="<?php echo $okresSok['ucast']['ucast'] ?>" max="100"><?php echo $okresSok['ucast']['ucast'] ?> %</progress>
                <div class="strech">
                    <p>0 %</p>
                    <p id="okresSokUcastPrc"></p>
                    <p>100 %</p>
                </div>
            </div>

            <div class="mt-5">
                <h4 class="is-size-4 mt-5">Výsledky</h4>
                <canvas id="chartOkresSok"></canvas>
            </div>
        </div>

        <div class="box">
            <h3 class="is-size-3">Okres Cheb</h3>
            <p class="has-text-weight-light updateCh"></p>
            <div>
                <h4 class="is-size-4">Sečteno</h4>
                <progress class="progress is-link is-medium okresChebSectenoProgress" value="" max=""></progress>
                <div class="strech">
                    <p>0 okrsků</p>
                    <p id="okresChebSectenoAktualne"></p>
                    <p id="okresChebSectenoOkrskuCelkem"></p>
                </div>
            </div>

            <div class="mt-5">
                <h4 class="is-size-4 mt-5">Účast</h4>
                <progress class="progress is-link is-medium okresChebUcastProgress" value="" max="100"></progress>
                <div class="strech">
                    <p>0 %</p>
                    <p id="okresChebUcastPrc"></p>
                    <p>100 %</p>
                </div>
            </div>

            <div class="mt-5">
                <h4 class="is-size-4 mt-5">Výsledky</h4>
                <canvas id="chartOkresCheb"></canvas>
            </div>
        </div>

        <div class="box">
            <h3 class="is-size-3">Město Karlovy Vary</h3>
            <p class="has-text-weight-light updateKv"></p>
            <div>
                <h4 class="is-size-4">Sečteno</h4>
                <progress class="progress is-link is-medium varySectenoProgress" value="" max=""></progress>
                <div class="strech">
                    <p>0 okrsků</p>
                    <p id="varySectenoAktualne"></p>
                    <p id="varySectenoOkrskuCelkem"></p>
                </div>
            </div>

            <div class="mt-5">
                <h4 class="is-size-4 mt-5">Účast</h4>
                <progress class="progress is-link is-medium varyUcastProgress" value="" max="100"></progress>
                <div class="strech">
                    <p>0 %</p>
                    <p id="varyUcastPrc"></p>
                    <p>100 %</p>
                </div>
            </div>

            <div class="mt-5">
                <h4 class="is-size-4 mt-5">Výsledky</h4>
                <canvas id="chartVary"></canvas>
            </div>
        </div>

        <div class="box">
            <h3 class="is-size-3">Město Sokolov</h3>
            <p class="has-text-weight-light updateSok"></p>
            <div>
                <h4 class="is-size-4">Sečteno</h4>
                <progress class="progress is-link is-medium sokolovSectenoProgress" value="" max=""></progress>
                <div class="strech">
                    <p>0 okrsků</p>
                    <p id="sokolovSectenoAktualne"></p>
                    <p id="sokolovSectenoOkrskuCelkem"></p>
                </div>
            </div>

            <div class="mt-5">
                <h4 class="is-size-4 mt-5">Účast</h4>
                <progress class="progress is-link is-medium sokolovUcastProgress" value="" max="100"></progress>
                <div class="strech">
                    <p>0 %</p>
                    <p id="sokolovUcastPrc"></p>
                    <p>100 %</p>
                </div>
            </div>

            <div class="mt-5">
                <h4 class="is-size-4 mt-5">Výsledky</h4>
                <canvas id="chartSokolov"></canvas>
            </div>
        </div>

        <div class="box">
            <h3 class="is-size-3">Město Cheb</h3>
            <p class="has-text-weight-light updateCh"></p>
            <div>
                <h4 class="is-size-4">Sečteno</h4>
                <progress class="progress is-link is-medium chebSectenoProgress" value="" max=""></progress>
                <div class="strech">
                    <p>0 okrsků</p>
                    <p id="chebSectenoAktualne"></p>
                    <p id="chebSectenoOkrskuCelkem"></p>
                </div>
            </div>

            <div class="mt-5">
                <h4 class="is-size-4 mt-5">Účast</h4>
                <progress class="progress is-link is-medium chebUcastProgress" value="" max="100"></progress>
                <div class="strech">
                    <p>0 %</p>
                    <p id="chebUcastPrc"></p>
                    <p>100 %</p>
                </div>
            </div>

            <div class="mt-5">
                <h4 class="is-size-4 mt-5">Výsledky</h4>
                <canvas id="chartCheb"></canvas>
            </div>
        </div>

        <div class="box">
            <h3 class="is-size-3">Město Ostrov</h3>
            <p class="has-text-weight-light updateKv"></p>
            <div>
                <h4 class="is-size-4">Sečteno</h4>
                <progress class="progress is-link is-medium ostrovSectenoProgress" value="" max=""></progress>
                <div class="strech">
                    <p>0 okrsků</p>
                    <p id="ostrovSectenoAktualne"></p>
                    <p id="ostrovSectenoOkrskuCelkem"></p>
                </div>
            </div>

            <div class="mt-5">
                <h4 class="is-size-4 mt-5">Účast</h4>
                <progress class="progress is-link is-medium ostrovUcastProgress" value="<?php echo $ostrov['ucast']['ucast'] ?>" max="100"><?php echo $ostrov['ucast']['ucast'] ?> %</progress>
                <div class="strech">
                    <p>0 %</p>
                    <p id="ostrovUcastPrc"></p>
                    <p>100 %</p>
                </div>
            </div>

            <div class="mt-5">
                <h4 class="is-size-4 mt-5">Výsledky</h4>
                <canvas id="chartOstrov"></canvas>
            </div>
        </div>

        <div class="box">
            <h3 class="is-size-3">Město Žlutice</h3>
            <p class="has-text-weight-light updateKv"></p>
            <div>
                <h4 class="is-size-4">Sečteno</h4>
                <progress class="progress is-link is-medium zluticeSectenoProgress" value="" max=""></progress>
                <div class="strech">
                    <p>0 okrsků</p>
                    <p id="zluticeSectenoAktualne"></p>
                    <p id="zluticeSectenoOkrskuCelkem"></p>
                </div>
            </div>

            <div class="mt-5">
                <h4 class="is-size-4 mt-5">Účast</h4>
                <progress class="progress is-link is-medium zluticeUcastProgress" value="" max="100"></progress>
                <div class="strech">
                    <p>0 %</p>
                    <p id="zluticeUcastPrc"></p>
                    <p>100 %</p>
                </div>
            </div>

            <div class="mt-5">
                <h4 class="is-size-4 mt-5">Výsledky</h4>
                <canvas id="chartZlutice"></canvas>
            </div>
        </div>

        <div class="box">
            <h3 class="is-size-3">Kandidáti SPOLU</h3>
            <p class="has-text-weight-light updateCr"></p>
            <div class="table-container">
                <table class="table table is-striped">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Jméno</th>
                            <th>Počet hlasů</th>
                            <th>Procento hlasů</th>
                            <th>Mandát</th>
                            <th>Skrutinium</th>
                            <th>Pořadí mandátu</th>
                            <th>Pořádí náhradníka</th>
                        </tr>
                    </thead>
                    <tbody id="spoluLidiTbody">

                    </tbody>
                </table>
            </div>
        </div>

        <div class="box">
            <h3 class="is-size-3">Kandidáti ANO</h3>
            <p class="has-text-weight-light updateCr"></p>
            <div class="table-container">
                <table class="table table is-striped">
                    <thead>
                        <tr>
                            <th>Č.</th>
                            <th>Jméno</th>
                            <th>Počet hlasů</th>
                            <th>Procento hlasů</th>
                            <th>Mandát</th>
                            <th>Skrutinium</th>
                            <th>Pořadí mandátu</th>
                            <th>Pořádí náhradníka</th>
                        </tr>
                    </thead>
                    <tbody id="anoLidiTbody">

                    </tbody>
                </table>
            </div>
        </div>

        <div class="box">
            <h3 class="is-size-3">Kandidáti PirStan</h3>
            <p class="has-text-weight-light updateCr"></p>
            <div class="table-container">
                <table class="table table is-striped">
                    <thead>
                        <tr>
                            <th>Č.</th>
                            <th>Jméno</th>
                            <th>Počet hlasů</th>
                            <th>Procento hlasů</th>
                            <th>Mandát</th>
                            <th>Skrutinium</th>
                            <th>Pořadí mandátu</th>
                            <th>Pořádí náhradníka</th>
                        </tr>
                    </thead>
                    <tbody id="pistanLidiTbody">

                    </tbody>
                </table>
            </div>
        </div>

        <div class="box">
            <h3 class="is-size-3">Kandidáti SPD</h3>
            <p class="has-text-weight-light updateCr"></p>
            <div class="table-container">
                <table class="table table is-striped">
                    <thead>
                        <tr>
                            <th>Č.</th>
                            <th>Jméno</th>
                            <th>Počet hlasů</th>
                            <th>Procento hlasů</th>
                            <th>Mandát</th>
                            <th>Skrutinium</th>
                            <th>Pořadí mandátu</th>
                            <th>Pořádí náhradníka</th>
                        </tr>
                    </thead>
                    <tbody id="spdLidiTbody">
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/chart.js@3.5.1/dist/chart.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script src="https://kit.fontawesome.com/868ac28d90.js" crossorigin="anonymous"></script>
    <script src="./scripts/index.js"></script>
</body>

</html>