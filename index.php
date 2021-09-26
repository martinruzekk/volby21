<?php

$jsonFile = file_get_contents('src/source.json');
$json = json_decode($jsonFile, true);

$cr = $json['cr'];
$kraj = $json['kraj'];
$okresKV = $json['okresKV'];
$okresCheb = $json['okresCheb'];
$okresSok = $json['okresSok'];
$vary = $json['vary'];
$cheb = $json['cheb'];
$ostrov = $json['ostrov'];
$zlutice = $json['zlutice'];
$sokolov = $json['sokolov'];
$lidiSpolu = $json['lidiSpolu'];
$lidiPistan = $json['lidiPistan'];
$lidiAno = $json['lidiAno'];
$lidiSpd = $json['lidiSpd'];
?>

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
    <!--//TODO Coutdown do voleb-->
    <div class="container">
        <h1 class="is-size-1 has-text-centered">VOLBY 2021</h1>
        <h4 class="is-size-4 has-text-centered m-0 p-0">Volby v Karlovarském kraji</h4>

        <div class="box">
            <h3 class="is-size-3">Výsledky v celé republice</h3>
            <div>
                <h4 class="is-size-4">Sečteno</h4>
                <progress class="progress is-link is-medium" value="<?php echo $cr['ucast']['zpracovano'] ?>" max="<?php echo $cr['ucast']['okrsky'] ?>">60%</progress>
                <div class="strech">
                    <p>0 okrsků</p>
                    <p><?php echo 'Zpracováno ' . $cr['ucast']['zpracovano'] . ' okrsků (' . $cr['ucast']['zpracovano_prc'] . '%)' ?></p>
                    <p><?php echo $cr['ucast']['okrsky'] ?> okrsků</p>
                </div>
            </div>

            <div class="mt-5">
                <h4 class="is-size-4 mt-5">Účast</h4>
                <progress class="progress is-link is-medium" value="<?php echo $cr['ucast']['ucast'] ?>" max="100"><?php echo $cr['ucast']['ucast'] ?> %</progress>
                <div class="strech">
                    <p>0 %</p>
                    <p><?php echo $cr['ucast']['ucast'] ?> %</p>
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
            <div>
                <h4 class="is-size-4">Sečteno</h4>
                <progress class="progress is-link is-medium" value="<?php echo $kraj['ucast']['zpracovano'] ?>" max="<?php echo $kraj['ucast']['okrsky'] ?>"><?php echo $kraj['ucast']['zpracovano_prc'] ?></progress>
                <div class="strech">
                    <p>0 okrsků</p>
                    <p><?php echo 'Zpracováno ' . $kraj['ucast']['zpracovano'] . ' okrsků (' . $kraj['ucast']['zpracovano_prc'] . '%)' ?></p>
                    <p><?php echo $kraj['ucast']['okrsky'] ?> okrsků</p>
                </div>
            </div>

            <div class="mt-5">
                <h4 class="is-size-4 mt-5">Účast</h4>
                <progress class="progress is-link is-medium" value="<?php echo $kraj['ucast']['ucast'] ?>" max="100"><?php echo $kraj['ucast']['ucast'] ?> %</progress>
                <div class="strech">
                    <p>0 %</p>
                    <p><?php echo $kraj['ucast']['ucast'] ?> %</p>
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
            <div>
                <h4 class="is-size-4">Sečteno</h4>
                <progress class="progress is-link is-medium" value="<?php echo $okresKV['ucast']['zpracovano'] ?>" max="<?php echo $okresKV['ucast']['okrsky'] ?>"><?php echo $okresKV['ucast']['zpracovano_prc'] ?></progress>
                <div class="strech">
                    <p>0 okrsků</p>
                    <p><?php echo 'Zpracováno ' . $okresKV['ucast']['zpracovano'] . ' okrsků (' . $okresKV['ucast']['zpracovano_prc'] . '%)' ?></p>
                    <p><?php echo $okresKV['ucast']['okrsky'] ?> okrsků</p>
                </div>
            </div>

            <div class="mt-5">
                <h4 class="is-size-4 mt-5">Účast</h4>
                <progress class="progress is-link is-medium" value="<?php echo $okresKV['ucast']['ucast'] ?>" max="100"><?php echo $okresKV['ucast']['ucast'] ?> %</progress>
                <div class="strech">
                    <p>0 %</p>
                    <p><?php echo $okresKV['ucast']['ucast'] ?> %</p>
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
            <div>
                <h4 class="is-size-4">Sečteno</h4>
                <progress class="progress is-link is-medium" value="<?php echo $okresSok['ucast']['zpracovano'] ?>" max="<?php echo $okresSok['ucast']['okrsky'] ?>"><?php echo $okresSok['ucast']['zpracovano_prc'] ?></progress>
                <div class="strech">
                    <p>0 okrsků</p>
                    <p><?php echo 'Zpracováno ' . $okresSok['ucast']['zpracovano'] . ' okrsků (' . $okresSok['ucast']['zpracovano_prc'] . '%)' ?></p>
                    <p><?php echo $okresSok['ucast']['okrsky'] ?> okrsků</p>
                </div>
            </div>

            <div class="mt-5">
                <h4 class="is-size-4 mt-5">Účast</h4>
                <progress class="progress is-link is-medium" value="<?php echo $okresSok['ucast']['ucast'] ?>" max="100"><?php echo $okresSok['ucast']['ucast'] ?> %</progress>
                <div class="strech">
                    <p>0 %</p>
                    <p><?php echo $okresSok['ucast']['ucast'] ?> %</p>
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
            <div>
                <h4 class="is-size-4">Sečteno</h4>
                <progress class="progress is-link is-medium" value="<?php echo $okresCheb['ucast']['zpracovano'] ?>" max="<?php echo $okresCheb['ucast']['okrsky'] ?>"><?php echo $okresCheb['ucast']['zpracovano_prc'] ?></progress>
                <div class="strech">
                    <p>0 okrsků</p>
                    <p><?php echo 'Zpracováno ' . $okresCheb['ucast']['zpracovano'] . ' okrsků (' . $okresCheb['ucast']['zpracovano_prc'] . '%)' ?></p>
                    <p><?php echo $okresCheb['ucast']['okrsky'] ?> okrsků</p>
                </div>
            </div>

            <div class="mt-5">
                <h4 class="is-size-4 mt-5">Účast</h4>
                <progress class="progress is-link is-medium" value="<?php echo $okresCheb['ucast']['ucast'] ?>" max="100"><?php echo $okresCheb['ucast']['ucast'] ?> %</progress>
                <div class="strech">
                    <p>0 %</p>
                    <p><?php echo $okresCheb['ucast']['ucast'] ?> %</p>
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
            <div>
                <h4 class="is-size-4">Sečteno</h4>
                <progress class="progress is-link is-medium" value="<?php echo $vary['ucast']['zpracovano'] ?>" max="<?php echo $vary['ucast']['okrsky'] ?>"><?php echo $vary['ucast']['zpracovano_prc'] ?></progress>
                <div class="strech">
                    <p>0 okrsků</p>
                    <p><?php echo 'Zpracováno ' . $vary['ucast']['zpracovano'] . ' okrsků (' . $vary['ucast']['zpracovano_prc'] . '%)' ?></p>
                    <p><?php echo $vary['ucast']['okrsky'] ?> okrsků</p>
                </div>
            </div>

            <div class="mt-5">
                <h4 class="is-size-4 mt-5">Účast</h4>
                <progress class="progress is-link is-medium" value="<?php echo $vary['ucast']['ucast'] ?>" max="100"><?php echo $vary['ucast']['ucast'] ?> %</progress>
                <div class="strech">
                    <p>0 %</p>
                    <p><?php echo $vary['ucast']['ucast'] ?> %</p>
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
            <div>
                <h4 class="is-size-4">Sečteno</h4>
                <progress class="progress is-link is-medium" value="<?php echo $sokolov['ucast']['zpracovano'] ?>" max="<?php echo $sokolov['ucast']['okrsky'] ?>"><?php echo $sokolov['ucast']['zpracovano_prc'] ?></progress>
                <div class="strech">
                    <p>0 okrsků</p>
                    <p><?php echo 'Zpracováno ' . $sokolov['ucast']['zpracovano'] . ' okrsků (' . $sokolov['ucast']['zpracovano_prc'] . '%)' ?></p>
                    <p><?php echo $sokolov['ucast']['okrsky'] ?> okrsků</p>
                </div>
            </div>

            <div class="mt-5">
                <h4 class="is-size-4 mt-5">Účast</h4>
                <progress class="progress is-link is-medium" value="<?php echo $sokolov['ucast']['ucast'] ?>" max="100"><?php echo $sokolov['ucast']['ucast'] ?> %</progress>
                <div class="strech">
                    <p>0 %</p>
                    <p><?php echo $sokolov['ucast']['ucast'] ?> %</p>
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
            <div>
                <h4 class="is-size-4">Sečteno</h4>
                <progress class="progress is-link is-medium" value="<?php echo $cheb['ucast']['zpracovano'] ?>" max="<?php echo $cheb['ucast']['okrsky'] ?>"><?php echo $cheb['ucast']['zpracovano_prc'] ?></progress>
                <div class="strech">
                    <p>0 okrsků</p>
                    <p><?php echo 'Zpracováno ' . $cheb['ucast']['zpracovano'] . ' okrsků (' . $cheb['ucast']['zpracovano_prc'] . '%)' ?></p>
                    <p><?php echo $cheb['ucast']['okrsky'] ?> okrsků</p>
                </div>
            </div>

            <div class="mt-5">
                <h4 class="is-size-4 mt-5">Účast</h4>
                <progress class="progress is-link is-medium" value="<?php echo $cheb['ucast']['ucast'] ?>" max="100"><?php echo $cheb['ucast']['ucast'] ?> %</progress>
                <div class="strech">
                    <p>0 %</p>
                    <p><?php echo $cheb['ucast']['ucast'] ?> %</p>
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
            <div>
                <h4 class="is-size-4">Sečteno</h4>
                <progress class="progress is-link is-medium" value="<?php echo $ostrov['ucast']['zpracovano'] ?>" max="<?php echo $ostrov['ucast']['okrsky'] ?>"><?php echo $ostrov['ucast']['zpracovano_prc'] ?></progress>
                <div class="strech">
                    <p>0 okrsků</p>
                    <p><?php echo 'Zpracováno ' . $ostrov['ucast']['zpracovano'] . ' okrsků (' . $ostrov['ucast']['zpracovano_prc'] . '%)' ?></p>
                    <p><?php echo $ostrov['ucast']['okrsky'] ?> okrsků</p>
                </div>
            </div>

            <div class="mt-5">
                <h4 class="is-size-4 mt-5">Účast</h4>
                <progress class="progress is-link is-medium" value="<?php echo $ostrov['ucast']['ucast'] ?>" max="100"><?php echo $ostrov['ucast']['ucast'] ?> %</progress>
                <div class="strech">
                    <p>0 %</p>
                    <p><?php echo $ostrov['ucast']['ucast'] ?> %</p>
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
            <div>
                <h4 class="is-size-4">Sečteno</h4>
                <progress class="progress is-link is-medium" value="<?php echo $zlutice['ucast']['zpracovano'] ?>" max="<?php echo $zlutice['ucast']['okrsky'] ?>"><?php echo $zlutice['ucast']['zpracovano_prc'] ?></progress>
                <div class="strech">
                    <p>0 okrsků</p>
                    <p><?php echo 'Zpracováno ' . $zlutice['ucast']['zpracovano'] . ' okrsků (' . $zlutice['ucast']['zpracovano_prc'] . '%)' ?></p>
                    <p><?php echo $zlutice['ucast']['okrsky'] ?> okrsků</p>
                </div>
            </div>

            <div class="mt-5">
                <h4 class="is-size-4 mt-5">Účast</h4>
                <progress class="progress is-link is-medium" value="<?php echo $zlutice['ucast']['ucast'] ?>" max="100"><?php echo $zlutice['ucast']['ucast'] ?> %</progress>
                <div class="strech">
                    <p>0 %</p>
                    <p><?php echo $zlutice['ucast']['ucast'] ?> %</p>
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
                    <tbody>
                        <?php

                        foreach ($lidiSpolu as $kandidat) {
                            echo '<tr>';
                            echo '<td>';
                            echo $kandidat['poradoveCislo'];
                            echo '</td>';
                            echo '<td>';
                            echo $kandidat['titul'] . ' ' . $kandidat['jmeno'] . ' ' . $kandidat['prijmeni'];
                            echo '</td>';
                            echo '<td>';
                            echo $kandidat['pocetHlasu'];
                            echo '</td>';
                            echo '<td>';
                            echo $kandidat['procentoHlasu'];
                            echo '</td>';
                            echo '<td class="has-text-centered">';
                            if ($kandidat['mandat'] == "N") {
                                echo '<i class="fas fa-times-circle"></i>';
                            } else {
                                echo '<i class="fas fa-check-circle"></i>';
                            }
                            echo '</td>';
                            echo '<td>';
                            echo $kandidat['skrutinium'];
                            echo '</td>';
                            echo '<td>';
                            echo $kandidat['poradiMandatu'];
                            echo '</td>';
                            echo '<td>';
                            echo $kandidat['poradiNahradnika'];
                            echo '</td>';
                            echo '</tr>';
                        }

                        ?>
                    </tbody>
                </table>
            </div>
        </div>

        <div class="box">
            <h3 class="is-size-3">Kandidáti ANO</h3>
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
                    <tbody>
                        <?php

                        foreach ($lidiAno as $kandidat) {
                            echo '<tr>';
                            echo '<td>';
                            echo $kandidat['poradoveCislo'];
                            echo '</td>';
                            echo '<td>';
                            echo $kandidat['titul'] . ' ' . $kandidat['jmeno'] . ' ' . $kandidat['prijmeni'];
                            echo '</td>';
                            echo '<td>';
                            echo $kandidat['pocetHlasu'];
                            echo '</td>';
                            echo '<td>';
                            echo $kandidat['procentoHlasu'];
                            echo '</td>';
                            echo '<td class="has-text-centered">';
                            if ($kandidat['mandat'] == "N") {
                                echo '<i class="fas fa-times-circle"></i>';
                            } else {
                                echo '<i class="fas fa-check-circle"></i>';
                            }
                            echo '</td>';
                            echo '<td>';
                            echo $kandidat['skrutinium'];
                            echo '</td>';
                            echo '<td>';
                            echo $kandidat['poradiMandatu'];
                            echo '</td>';
                            echo '<td>';
                            echo $kandidat['poradiNahradnika'];
                            echo '</td>';
                            echo '</tr>';
                        }

                        ?>
                    </tbody>
                </table>
            </div>
        </div>

        <div class="box">
            <h3 class="is-size-3">Kandidáti PirStan</h3>
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
                    <tbody>
                        <?php

                        foreach ($lidiPistan as $kandidat) {
                            echo '<tr>';
                            echo '<td>';
                            echo $kandidat['poradoveCislo'];
                            echo '</td>';
                            echo '<td>';
                            echo $kandidat['titul'] . ' ' . $kandidat['jmeno'] . ' ' . $kandidat['prijmeni'];
                            echo '</td>';
                            echo '<td>';
                            echo $kandidat['pocetHlasu'];
                            echo '</td>';
                            echo '<td>';
                            echo $kandidat['procentoHlasu'];
                            echo '</td>';
                            echo '<td class="has-text-centered">';
                            if ($kandidat['mandat'] == "N") {
                                echo '<i class="fas fa-times-circle"></i>';
                            } else {
                                echo '<i class="fas fa-check-circle"></i>';
                            }
                            echo '</td>';
                            echo '<td>';
                            echo $kandidat['skrutinium'];
                            echo '</td>';
                            echo '<td>';
                            echo $kandidat['poradiMandatu'];
                            echo '</td>';
                            echo '<td>';
                            echo $kandidat['poradiNahradnika'];
                            echo '</td>';
                            echo '</tr>';
                        }

                        ?>
                    </tbody>
                </table>
            </div>
        </div>

        <div class="box">
            <h3 class="is-size-3">Kandidáti SPD</h3>
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
                    <tbody>
                        <?php

                        foreach ($lidiSpd as $kandidat) {
                            echo '<tr>';
                            echo '<td>';
                            echo $kandidat['poradoveCislo'];
                            echo '</td>';
                            echo '<td>';
                            echo $kandidat['titul'] . ' ' . $kandidat['jmeno'] . ' ' . $kandidat['prijmeni'];
                            echo '</td>';
                            echo '<td>';
                            echo $kandidat['pocetHlasu'];
                            echo '</td>';
                            echo '<td>';
                            echo $kandidat['procentoHlasu'];
                            echo '</td>';
                            echo '<td class="has-text-centered">';
                            if ($kandidat['mandat'] == "N") {
                                echo '<i class="fas fa-times-circle"></i>';
                            } else {
                                echo '<i class="fas fa-check-circle"></i>';
                            }
                            echo '</td>';
                            echo '<td>';
                            echo $kandidat['skrutinium'];
                            echo '</td>';
                            echo '<td>';
                            echo $kandidat['poradiMandatu'];
                            echo '</td>';
                            echo '<td>';
                            echo $kandidat['poradiNahradnika'];
                            echo '</td>';
                            echo '</tr>';
                        }

                        ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/chart.js@3.5.1/dist/chart.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script src="https://kit.fontawesome.com/868ac28d90.js" crossorigin="anonymous"></script>
    <script src="./scripts/index.js"></script>

    <script>
        var ctxCr = document.getElementById('chartCr').getContext('2d');
        var crChart = new Chart(ctxCr, {
            type: 'bar',
            data: {
                labels: ['SPOLU', 'ANO', 'PirStan', 'SDP', 'KSČM', 'ČSSD', 'Přísaha', 'TSS', 'Zeleni', 'VOLNÝ blok'],
                datasets: [{
                    data: [<?php echo $cr['spolu']['prc'] ?>, <?php echo $cr['ano']['prc'] ?>, <?php echo $cr['pistan']['prc'] ?>, <?php echo $cr['spd']['prc'] ?>, <?php echo $cr['kscm']['prc'] ?>, <?php echo $cr['cssd']['prc'] ?>, <?php echo $cr['prisaha']['prc'] ?>, <?php echo $cr['tss']['prc'] ?>, <?php echo $cr['zeleni']['prc'] ?>, <?php echo $cr['volny']['prc'] ?>],

                    backgroundColor: [
                        'rgb(17,17,73)',
                        'rgb(0,242,242)',
                        'rgba(0, 0, 0)',
                        'rgb(13,113,178)',
                        'rgb(225,27,34)',
                        'rgb(218,53,17)',
                        'rgb(0,50,255)',
                        'rgb(48,39,134)',
                        'rgb(96,181,75)',
                        'rgb(117,75,42)'
                    ]
                }]
            },
            options: {
                scales: {
                    y: {
                        beginAtZero: true
                    }
                }
            }
        });

        var ctxKVK = document.getElementById('chartKVK').getContext('2d');
        var chartKVK = new Chart(ctxKVK, {
            type: 'bar',
            data: {
                labels: ['SPOLU', 'ANO', 'PirStan', 'SDP', 'KSČM', 'ČSSD', 'Přísaha', 'TSS', 'Zeleni', 'VOLNÝ blok'],
                datasets: [{
                    data: [<?php echo $cr['spolu']['prc'] ?>, <?php echo $cr['ano']['prc'] ?>, <?php echo $cr['pistan']['prc'] ?>, <?php echo $cr['spd']['prc'] ?>, <?php echo $cr['kscm']['prc'] ?>, <?php echo $cr['cssd']['prc'] ?>, <?php echo $cr['prisaha']['prc'] ?>, <?php echo $cr['tss']['prc'] ?>, <?php echo $cr['zeleni']['prc'] ?>, <?php echo $cr['volny']['prc'] ?>],

                    backgroundColor: [
                        'rgb(17,17,73)',
                        'rgb(0,242,242)',
                        'rgba(0, 0, 0)',
                        'rgb(13,113,178)',
                        'rgb(225,27,34)',
                        'rgb(218,53,17)',
                        'rgb(0,50,255)',
                        'rgb(48,39,134)',
                        'rgb(96,181,75)',
                        'rgb(117,75,42)'
                    ]
                }]
            },
            options: {
                scales: {
                    y: {
                        beginAtZero: true
                    }
                }
            }
        });

        var ctxOkresKV = document.getElementById('chartOkresKV').getContext('2d');
        var chartOkresKV = new Chart(ctxOkresKV, {
            type: 'bar',
            data: {
                labels: ['SPOLU', 'ANO', 'PirStan', 'SDP', 'KSČM', 'ČSSD', 'Přísaha', 'TSS', 'Zeleni', 'VOLNÝ blok'],
                datasets: [{
                    data: [<?php echo $cr['spolu']['prc'] ?>, <?php echo $cr['ano']['prc'] ?>, <?php echo $cr['pistan']['prc'] ?>, <?php echo $cr['spd']['prc'] ?>, <?php echo $cr['kscm']['prc'] ?>, <?php echo $cr['cssd']['prc'] ?>, <?php echo $cr['prisaha']['prc'] ?>, <?php echo $cr['tss']['prc'] ?>, <?php echo $cr['zeleni']['prc'] ?>, <?php echo $cr['volny']['prc'] ?>],

                    backgroundColor: [
                        'rgb(17,17,73)',
                        'rgb(0,242,242)',
                        'rgba(0, 0, 0)',
                        'rgb(13,113,178)',
                        'rgb(225,27,34)',
                        'rgb(218,53,17)',
                        'rgb(0,50,255)',
                        'rgb(48,39,134)',
                        'rgb(96,181,75)',
                        'rgb(117,75,42)'
                    ]
                }]
            },
            options: {
                scales: {
                    y: {
                        beginAtZero: true
                    }
                }
            }
        });

        var ctxOkresSok = document.getElementById('chartOkresSok').getContext('2d');
        var chartOkresSok = new Chart(ctxOkresSok, {
            type: 'bar',
            data: {
                labels: ['SPOLU', 'ANO', 'PirStan', 'SDP', 'KSČM', 'ČSSD', 'Přísaha', 'TSS', 'Zeleni', 'VOLNÝ blok'],
                datasets: [{
                    data: [<?php echo $cr['spolu']['prc'] ?>, <?php echo $cr['ano']['prc'] ?>, <?php echo $cr['pistan']['prc'] ?>, <?php echo $cr['spd']['prc'] ?>, <?php echo $cr['kscm']['prc'] ?>, <?php echo $cr['cssd']['prc'] ?>, <?php echo $cr['prisaha']['prc'] ?>, <?php echo $cr['tss']['prc'] ?>, <?php echo $cr['zeleni']['prc'] ?>, <?php echo $cr['volny']['prc'] ?>],

                    backgroundColor: [
                        'rgb(17,17,73)',
                        'rgb(0,242,242)',
                        'rgba(0, 0, 0)',
                        'rgb(13,113,178)',
                        'rgb(225,27,34)',
                        'rgb(218,53,17)',
                        'rgb(0,50,255)',
                        'rgb(48,39,134)',
                        'rgb(96,181,75)',
                        'rgb(117,75,42)'
                    ]
                }]
            },
            options: {
                scales: {
                    y: {
                        beginAtZero: true
                    }
                }
            }
        });

        var ctxOkresCheb = document.getElementById('chartOkresCheb').getContext('2d');
        var chartOkresCheb = new Chart(ctxOkresCheb, {
            type: 'bar',
            data: {
                labels: ['SPOLU', 'ANO', 'PirStan', 'SDP', 'KSČM', 'ČSSD', 'Přísaha', 'TSS', 'Zeleni', 'VOLNÝ blok'],
                datasets: [{
                    data: [<?php echo $cr['spolu']['prc'] ?>, <?php echo $cr['ano']['prc'] ?>, <?php echo $cr['pistan']['prc'] ?>, <?php echo $cr['spd']['prc'] ?>, <?php echo $cr['kscm']['prc'] ?>, <?php echo $cr['cssd']['prc'] ?>, <?php echo $cr['prisaha']['prc'] ?>, <?php echo $cr['tss']['prc'] ?>, <?php echo $cr['zeleni']['prc'] ?>, <?php echo $cr['volny']['prc'] ?>],

                    backgroundColor: [
                        'rgb(17,17,73)',
                        'rgb(0,242,242)',
                        'rgba(0, 0, 0)',
                        'rgb(13,113,178)',
                        'rgb(225,27,34)',
                        'rgb(218,53,17)',
                        'rgb(0,50,255)',
                        'rgb(48,39,134)',
                        'rgb(96,181,75)',
                        'rgb(117,75,42)'
                    ]
                }]
            },
            options: {
                scales: {
                    y: {
                        beginAtZero: true
                    }
                }
            }
        });

        var ctxVary = document.getElementById('chartVary').getContext('2d');
        var chartVary = new Chart(ctxVary, {
            type: 'bar',
            data: {
                labels: ['SPOLU', 'ANO', 'PirStan', 'SDP', 'KSČM', 'ČSSD', 'Přísaha', 'TSS', 'Zeleni', 'VOLNÝ blok'],
                datasets: [{
                    data: [<?php echo $cr['spolu']['prc'] ?>, <?php echo $cr['ano']['prc'] ?>, <?php echo $cr['pistan']['prc'] ?>, <?php echo $cr['spd']['prc'] ?>, <?php echo $cr['kscm']['prc'] ?>, <?php echo $cr['cssd']['prc'] ?>, <?php echo $cr['prisaha']['prc'] ?>, <?php echo $cr['tss']['prc'] ?>, <?php echo $cr['zeleni']['prc'] ?>, <?php echo $cr['volny']['prc'] ?>],

                    backgroundColor: [
                        'rgb(17,17,73)',
                        'rgb(0,242,242)',
                        'rgba(0, 0, 0)',
                        'rgb(13,113,178)',
                        'rgb(225,27,34)',
                        'rgb(218,53,17)',
                        'rgb(0,50,255)',
                        'rgb(48,39,134)',
                        'rgb(96,181,75)',
                        'rgb(117,75,42)'
                    ]
                }]
            },
            options: {
                scales: {
                    y: {
                        beginAtZero: true
                    }
                }
            }
        });

        var ctxSokolov = document.getElementById('chartSokolov').getContext('2d');
        var chartSokolov = new Chart(ctxSokolov, {
            type: 'bar',
            data: {
                labels: ['SPOLU', 'ANO', 'PirStan', 'SDP', 'KSČM', 'ČSSD', 'Přísaha', 'TSS', 'Zeleni', 'VOLNÝ blok'],
                datasets: [{
                    data: [<?php echo $cr['spolu']['prc'] ?>, <?php echo $cr['ano']['prc'] ?>, <?php echo $cr['pistan']['prc'] ?>, <?php echo $cr['spd']['prc'] ?>, <?php echo $cr['kscm']['prc'] ?>, <?php echo $cr['cssd']['prc'] ?>, <?php echo $cr['prisaha']['prc'] ?>, <?php echo $cr['tss']['prc'] ?>, <?php echo $cr['zeleni']['prc'] ?>, <?php echo $cr['volny']['prc'] ?>],

                    backgroundColor: [
                        'rgb(17,17,73)',
                        'rgb(0,242,242)',
                        'rgba(0, 0, 0)',
                        'rgb(13,113,178)',
                        'rgb(225,27,34)',
                        'rgb(218,53,17)',
                        'rgb(0,50,255)',
                        'rgb(48,39,134)',
                        'rgb(96,181,75)',
                        'rgb(117,75,42)'
                    ]
                }]
            },
            options: {
                scales: {
                    y: {
                        beginAtZero: true
                    }
                }
            }
        });

        var ctxCheb = document.getElementById('chartCheb').getContext('2d');
        var chartCheb = new Chart(ctxCheb, {
            type: 'bar',
            data: {
                labels: ['SPOLU', 'ANO', 'PirStan', 'SDP', 'KSČM', 'ČSSD', 'Přísaha', 'TSS', 'Zeleni', 'VOLNÝ blok'],
                datasets: [{
                    data: [<?php echo $cr['spolu']['prc'] ?>, <?php echo $cr['ano']['prc'] ?>, <?php echo $cr['pistan']['prc'] ?>, <?php echo $cr['spd']['prc'] ?>, <?php echo $cr['kscm']['prc'] ?>, <?php echo $cr['cssd']['prc'] ?>, <?php echo $cr['prisaha']['prc'] ?>, <?php echo $cr['tss']['prc'] ?>, <?php echo $cr['zeleni']['prc'] ?>, <?php echo $cr['volny']['prc'] ?>],

                    backgroundColor: [
                        'rgb(17,17,73)',
                        'rgb(0,242,242)',
                        'rgba(0, 0, 0)',
                        'rgb(13,113,178)',
                        'rgb(225,27,34)',
                        'rgb(218,53,17)',
                        'rgb(0,50,255)',
                        'rgb(48,39,134)',
                        'rgb(96,181,75)',
                        'rgb(117,75,42)'
                    ]
                }]
            },
            options: {
                scales: {
                    y: {
                        beginAtZero: true
                    }
                }
            }
        });

        var ctxOstrov = document.getElementById('chartOstrov').getContext('2d');
        var chartOstrov = new Chart(ctxOstrov, {
            type: 'bar',
            data: {
                labels: ['SPOLU', 'ANO', 'PirStan', 'SDP', 'KSČM', 'ČSSD', 'Přísaha', 'TSS', 'Zeleni', 'VOLNÝ blok'],
                datasets: [{
                    data: [<?php echo $cr['spolu']['prc'] ?>, <?php echo $cr['ano']['prc'] ?>, <?php echo $cr['pistan']['prc'] ?>, <?php echo $cr['spd']['prc'] ?>, <?php echo $cr['kscm']['prc'] ?>, <?php echo $cr['cssd']['prc'] ?>, <?php echo $cr['prisaha']['prc'] ?>, <?php echo $cr['tss']['prc'] ?>, <?php echo $cr['zeleni']['prc'] ?>, <?php echo $cr['volny']['prc'] ?>],

                    backgroundColor: [
                        'rgb(17,17,73)',
                        'rgb(0,242,242)',
                        'rgba(0, 0, 0)',
                        'rgb(13,113,178)',
                        'rgb(225,27,34)',
                        'rgb(218,53,17)',
                        'rgb(0,50,255)',
                        'rgb(48,39,134)',
                        'rgb(96,181,75)',
                        'rgb(117,75,42)'
                    ]
                }]
            },
            options: {
                scales: {
                    y: {
                        beginAtZero: true
                    }
                }
            }
        });

        var ctxZlutice = document.getElementById('chartZlutice').getContext('2d');
        var chartZlutice = new Chart(ctxZlutice, {
            type: 'bar',
            data: {
                labels: ['SPOLU', 'ANO', 'PirStan', 'SDP', 'KSČM', 'ČSSD', 'Přísaha', 'TSS', 'Zeleni', 'VOLNÝ blok'],
                datasets: [{
                    data: [<?php echo $cr['spolu']['prc'] ?>, <?php echo $cr['ano']['prc'] ?>, <?php echo $cr['pistan']['prc'] ?>, <?php echo $cr['spd']['prc'] ?>, <?php echo $cr['kscm']['prc'] ?>, <?php echo $cr['cssd']['prc'] ?>, <?php echo $cr['prisaha']['prc'] ?>, <?php echo $cr['tss']['prc'] ?>, <?php echo $cr['zeleni']['prc'] ?>, <?php echo $cr['volny']['prc'] ?>],

                    backgroundColor: [
                        'rgb(17,17,73)',
                        'rgb(0,242,242)',
                        'rgba(0, 0, 0)',
                        'rgb(13,113,178)',
                        'rgb(225,27,34)',
                        'rgb(218,53,17)',
                        'rgb(0,50,255)',
                        'rgb(48,39,134)',
                        'rgb(96,181,75)',
                        'rgb(117,75,42)'
                    ]
                }]
            },
            options: {
                scales: {
                    y: {
                        beginAtZero: true
                    }
                }
            }
        });
    </script>
</body>

</html>