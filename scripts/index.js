const graphLabels = ['SPOLU', 'ANO', 'PirStan', 'SPD', 'KSČM', 'ČSSD', 'Přísaha', 'TSS', 'Zeleni', 'VOLNÝ blok']
const backgroundColor = [
    'rgb(17,17,73)',
    'rgb(0,242,242)',
    'rgba(0, 0, 0)',
    'rgb(14,112,183)',
    'rgb(225,27,34)',
    'rgb(218,53,17)',
    'rgb(0,50,255)',
    'rgb(48,39,134)',
    'rgb(96,181,75)',
    'rgb(117,75,42)'
]
const options = {
    scales: {
        y: {
            beginAtZero: true
        }
    }
}

const dateOptions = {
    year: 'numeric',
    month: 'numeric',
    day: 'numeric',
    hour: 'numeric',
    minute: 'numeric',
    second: 'numeric'
};

let nextReload = 59

var ctxCr
var crChart

var ctxKVK
var chartKVK

var ctxOkresKV
var chartOkresKV

var ctxOkresSok
var chartOkresSok

var ctxOkresCheb
var chartOkresCheb

var ctxVary
var chartVary

var ctxSokolov
var chartSokolov

var ctxCheb
var chartCheb

var ctxOstrov
var chartOstrov

var ctxZlutice
var chartZlutice


window.addEventListener('load', () => {
    $.ajax({
        url: "../src/source.json",
        success: (json) => {
            let cr = json['cr']
            let kraj = json['kraj'];
            let okresKV = json['okresKV'];
            let okresCheb = json['okresCheb'];
            let okresSok = json['okresSok'];
            let vary = json['vary'];
            let cheb = json['cheb'];
            let ostrov = json['ostrov'];
            let zlutice = json['zlutice'];
            let sokolov = json['sokolov'];
            let lidiSpoluJson = json['lidiSpolu'];
            let lidiPistanJson = json['lidiPistan'];
            let lidiAnoJson = json['lidiAno'];
            let lidiSpdJson = json['lidiSpd'];

            let lidiSpolu = []
            for (let i in lidiSpoluJson) {
                lidiSpolu.push(lidiSpoluJson[i])
            }

            let lidiPistan = []
            for (let i in lidiPistanJson) {
                lidiPistan.push(lidiPistanJson[i])
            }

            let lidiAno = []
            for (let i in lidiAnoJson) {
                lidiAno.push(lidiAnoJson[i])
            }

            let lidiSpd = []
            for (let i in lidiSpdJson) {
                lidiSpd.push(lidiSpdJson[i])
            }


            // Graf ČR
            // Sečteno
            document.querySelector(".crSectenoProgress").textContent = cr['ucast']['zpracovano_prc'] + " %"
            document.querySelector(".crSectenoProgress").setAttribute('value', cr['ucast']['zpracovano'])
            document.querySelector(".crSectenoProgress").setAttribute('max', cr['ucast']['okrsky'])
            document.querySelector("#crSectenoAktualne").textContent = 'Zpracováno ' + cr['ucast']['zpracovano'] + ' okresků (' + cr['ucast']['zpracovano_prc'] + ' %)'
            document.querySelector("#crSectenoOkrskuCelkem").textContent = cr['ucast']['okrsky'] + ' okrsků'

            // Účast
            document.querySelector(".crUcastProgress").textContent = cr['ucast']['ucast'] + " %"
            document.querySelector(".crUcastProgress").setAttribute('value', cr['ucast']['ucast'])
            document.querySelector("#crUcastPrc").textContent = cr['ucast']['ucast'] + ' %'

            ctxCr = document.getElementById('chartCr').getContext('2d');
            crChart = new Chart(ctxCr, {
                type: 'bar',
                data: {
                    labels: graphLabels,
                    datasets: [{
                        data: [cr['spolu']['prc'], cr['ano']['prc'], cr['pistan']['prc'], cr['spd']['prc'], cr['kscm']['prc'], cr['cssd']['prc'], cr['prisaha']['prc'], cr['tss']['prc'], cr['zeleni']['prc'], cr['volny']['prc']],
                        backgroundColor: backgroundColor
                    }]
                },
                options: {
                    scales: {
                        y: {
                            beginAtZero: true
                        }
                    }
                }
            })

            // Graf KVK
            // Kraj

            // Sečteno
            document.querySelector(".krajSectenoProgress").textContent = kraj['ucast']['zpracovano_prc'] + " %"
            document.querySelector(".krajSectenoProgress").setAttribute('value', kraj['ucast']['zpracovano'])
            document.querySelector(".krajSectenoProgress").setAttribute('max', kraj['ucast']['okrsky'])
            document.querySelector("#krajSectenoAktualne").textContent = 'Zpracováno ' + kraj['ucast']['zpracovano'] + ' okresků (' + kraj['ucast']['zpracovano_prc'] + ' %)'
            document.querySelector("#krajSectenoOkrskuCelkem").textContent = kraj['ucast']['okrsky'] + ' okrsků'

            //Účast
            document.querySelector(".krajUcastProgress").textContent = kraj['ucast']['ucast'] + " %"
            document.querySelector(".krajUcastProgress").setAttribute('value', kraj['ucast']['ucast'])
            document.querySelector("#krajUcastPrc").textContent = kraj['ucast']['ucast'] + ' %'

            ctxKVK = document.getElementById('chartKVK').getContext('2d');
            chartKVK = new Chart(ctxKVK, {
                type: 'bar',
                data: {
                    labels: graphLabels,
                    datasets: [{
                        data: [kraj['spolu']['prc'], kraj['ano']['prc'], kraj['pistan']['prc'], kraj['spd']['prc'], kraj['kscm']['prc'], kraj['cssd']['prc'], kraj['prisaha']['prc'], kraj['tss']['prc'], kraj['zeleni']['prc'], kraj['volny']['prc']],
                        backgroundColor: backgroundColor
                    }]
                },
                options: {
                    scales: {
                        y: {
                            beginAtZero: true
                        }
                    }
                }
            })


            // Graf okres KV
            // Okres KV

            // Sečteno
            document.querySelector(".okresKvSectenoProgress").textContent = okresKV['ucast']['zpracovano_prc'] + " %"
            document.querySelector(".okresKvSectenoProgress").setAttribute('value', okresKV['ucast']['zpracovano'])
            document.querySelector(".okresKvSectenoProgress").setAttribute('max', okresKV['ucast']['okrsky'])
            document.querySelector("#okresKvSectenoAktualne").textContent = 'Zpracováno ' + okresKV['ucast']['zpracovano'] + ' okresků (' + okresKV['ucast']['zpracovano_prc'] + ' %)'
            document.querySelector("#okresKvSectenoOkrskuCelkem").textContent = okresKV['ucast']['okrsky'] + ' okrsků'

            //Účast
            document.querySelector(".okresKvUcastProgress").textContent = okresKV['ucast']['ucast'] + " %"
            document.querySelector(".okresKvUcastProgress").setAttribute('value', okresKV['ucast']['ucast'])
            document.querySelector("#okresKvUcastPrc").textContent = okresKV['ucast']['ucast'] + ' %'

            ctxOkresKV = document.getElementById('chartOkresKV').getContext('2d');
            chartOkresKV = new Chart(ctxOkresKV, {
                type: 'bar',
                data: {
                    labels: graphLabels,
                    datasets: [{
                        data: [okresKV['spolu']['prc'], okresKV['ano']['prc'], okresKV['pistan']['prc'], okresKV['spd']['prc'], okresKV['kscm']['prc'], okresKV['cssd']['prc'], okresKV['prisaha']['prc'], okresKV['tss']['prc'], okresKV['zeleni']['prc'], okresKV['volny']['prc']],
                        backgroundColor: backgroundColor
                    }]
                },
                options: {
                    scales: {
                        y: {
                            beginAtZero: true
                        }
                    }
                }
            })


            // Graf okres Sok

            // Sečteno
            document.querySelector(".okresSokSectenoProgress").textContent = okresSok['ucast']['zpracovano_prc'] + " %"
            document.querySelector(".okresSokSectenoProgress").setAttribute('value', okresSok['ucast']['zpracovano'])
            document.querySelector(".okresSokSectenoProgress").setAttribute('max', okresSok['ucast']['okrsky'])
            document.querySelector("#okresSokSectenoAktualne").textContent = 'Zpracováno ' + okresSok['ucast']['zpracovano'] + ' okresků (' + okresSok['ucast']['zpracovano_prc'] + ' %)'
            document.querySelector("#okresSokSectenoOkrskuCelkem").textContent = okresSok['ucast']['okrsky'] + ' okrsků'

            //Účast
            document.querySelector(".okresSokUcastProgress").textContent = okresSok['ucast']['ucast'] + " %"
            document.querySelector(".okresSokUcastProgress").setAttribute('value', okresSok['ucast']['ucast'])
            document.querySelector("#okresSokUcastPrc").textContent = okresSok['ucast']['ucast'] + ' %'

            ctxOkresSok = document.getElementById('chartOkresSok').getContext('2d');
            chartOkresSok = new Chart(ctxOkresSok, {
                type: 'bar',
                data: {
                    labels: graphLabels,
                    datasets: [{
                        data: [okresSok['spolu']['prc'], okresSok['ano']['prc'], okresSok['pistan']['prc'], okresSok['spd']['prc'], okresSok['kscm']['prc'], okresSok['cssd']['prc'], okresSok['prisaha']['prc'], okresSok['tss']['prc'], okresSok['zeleni']['prc'], okresSok['volny']['prc']],
                        backgroundColor: backgroundColor
                    }]
                },
                options: {
                    scales: {
                        y: {
                            beginAtZero: true
                        }
                    }
                }
            })


            // Graf okres Cheb

            // Okres Cheb

            // Sečteno
            document.querySelector(".okresChebSectenoProgress").textContent = okresCheb['ucast']['zpracovano_prc'] + " %"
            document.querySelector(".okresChebSectenoProgress").setAttribute('value', okresCheb['ucast']['zpracovano'])
            document.querySelector(".okresChebSectenoProgress").setAttribute('max', okresCheb['ucast']['okrsky'])
            document.querySelector("#okresChebSectenoAktualne").textContent = 'Zpracováno ' + okresCheb['ucast']['zpracovano'] + ' okresků (' + okresCheb['ucast']['zpracovano_prc'] + ' %)'
            document.querySelector("#okresChebSectenoOkrskuCelkem").textContent = okresCheb['ucast']['okrsky'] + ' okrsků'

            //Účast
            document.querySelector(".okresChebUcastProgress").textContent = okresCheb['ucast']['ucast'] + " %"
            document.querySelector(".okresChebUcastProgress").setAttribute('value', okresCheb['ucast']['ucast'])
            document.querySelector("#okresChebUcastPrc").textContent = okresCheb['ucast']['ucast'] + ' %'

            ctxOkresCheb = document.getElementById('chartOkresCheb').getContext('2d');
            chartOkresCheb = new Chart(ctxOkresCheb, {
                type: 'bar',
                data: {
                    labels: graphLabels,
                    datasets: [{
                        data: [okresCheb['spolu']['prc'], okresCheb['ano']['prc'], okresCheb['pistan']['prc'], okresCheb['spd']['prc'], okresCheb['kscm']['prc'], okresCheb['cssd']['prc'], okresCheb['prisaha']['prc'], okresCheb['tss']['prc'], okresCheb['zeleni']['prc'], okresCheb['volny']['prc']],
                        backgroundColor: backgroundColor
                    }]
                },
                options: options
            })

            // Graf město Karlovy Vary

            // Vary

            // Sečteno
            document.querySelector(".varySectenoProgress").textContent = vary['ucast']['zpracovano_prc'] + " %"
            document.querySelector(".varySectenoProgress").setAttribute('value', vary['ucast']['zpracovano'])
            document.querySelector(".varySectenoProgress").setAttribute('max', vary['ucast']['okrsky'])
            document.querySelector("#varySectenoAktualne").textContent = 'Zpracováno ' + vary['ucast']['zpracovano'] + ' okresků (' + vary['ucast']['zpracovano_prc'] + ' %)'
            document.querySelector("#varySectenoOkrskuCelkem").textContent = vary['ucast']['okrsky'] + ' okrsků'

            //Účast
            document.querySelector(".varyUcastProgress").textContent = vary['ucast']['ucast'] + " %"
            document.querySelector(".varyUcastProgress").setAttribute('value', vary['ucast']['ucast'])
            document.querySelector("#varyUcastPrc").textContent = vary['ucast']['ucast'] + ' %'

            ctxVary = document.getElementById('chartVary').getContext('2d');
            chartVary = new Chart(ctxVary, {
                type: 'bar',
                data: {
                    labels: graphLabels,
                    datasets: [{
                        data: [vary['strany']['spolu']['prc'], vary['strany']['ano']['prc'], vary['strany']['pistan']['prc'], vary['strany']['spd']['prc'], vary['strany']['kscm']['prc'], vary['strany']['cssd']['prc'], vary['strany']['prisaha']['prc'], vary['strany']['tss']['prc'], vary['strany']['zeleni']['prc'], vary['strany']['volny']['prc']],
                        backgroundColor: backgroundColor
                    }]
                },
                options: options
            })

            // Graf město Sokolov

            // Sečteno
            document.querySelector(".sokolovSectenoProgress").textContent = sokolov['ucast']['zpracovano_prc'] + " %"
            document.querySelector(".sokolovSectenoProgress").setAttribute('value', sokolov['ucast']['zpracovano'])
            document.querySelector(".sokolovSectenoProgress").setAttribute('max', sokolov['ucast']['okrsky'])
            document.querySelector("#sokolovSectenoAktualne").textContent = 'Zpracováno ' + sokolov['ucast']['zpracovano'] + ' okresků (' + sokolov['ucast']['zpracovano_prc'] + ' %)'
            document.querySelector("#sokolovSectenoOkrskuCelkem").textContent = sokolov['ucast']['okrsky'] + ' okrsků'

            //Účast
            document.querySelector(".sokolovUcastProgress").textContent = sokolov['ucast']['ucast'] + " %"
            document.querySelector(".sokolovUcastProgress").setAttribute('value', sokolov['ucast']['ucast'])
            document.querySelector("#sokolovUcastPrc").textContent = sokolov['ucast']['ucast'] + ' %'

            ctxSokolov = document.getElementById('chartSokolov').getContext('2d');
            chartSokolov = new Chart(ctxSokolov, {
                type: 'bar',
                data: {
                    labels: graphLabels,
                    datasets: [{
                        data: [sokolov['strany']['spolu']['prc'], sokolov['strany']['ano']['prc'], sokolov['strany']['pistan']['prc'], sokolov['strany']['spd']['prc'], sokolov['strany']['kscm']['prc'], sokolov['strany']['cssd']['prc'], sokolov['strany']['prisaha']['prc'], sokolov['strany']['tss']['prc'], sokolov['strany']['zeleni']['prc'], sokolov['strany']['volny']['prc']],
                        backgroundColor: backgroundColor
                    }]
                },
                options: options
            })

            // Graf město Cheb

            // Sečteno
            document.querySelector(".chebSectenoProgress").textContent = cheb['ucast']['zpracovano_prc'] + " %"
            document.querySelector(".chebSectenoProgress").setAttribute('value', cheb['ucast']['zpracovano'])
            document.querySelector(".chebSectenoProgress").setAttribute('max', cheb['ucast']['okrsky'])
            document.querySelector("#chebSectenoAktualne").textContent = 'Zpracováno ' + cheb['ucast']['zpracovano'] + ' okresků (' + cheb['ucast']['zpracovano_prc'] + ' %)'
            document.querySelector("#chebSectenoOkrskuCelkem").textContent = cheb['ucast']['okrsky'] + ' okrsků'

            //Účast
            document.querySelector(".chebUcastProgress").textContent = cheb['ucast']['ucast'] + " %"
            document.querySelector(".chebUcastProgress").setAttribute('value', cheb['ucast']['ucast'])
            document.querySelector("#chebUcastPrc").textContent = cheb['ucast']['ucast'] + ' %'


            ctxCheb = document.getElementById('chartCheb').getContext('2d');
            chartCheb = new Chart(ctxCheb, {
                type: 'bar',
                data: {
                    labels: graphLabels,
                    datasets: [{
                        data: [cheb['strany']['spolu']['prc'], cheb['strany']['ano']['prc'], cheb['strany']['pistan']['prc'], cheb['strany']['spd']['prc'], cheb['strany']['kscm']['prc'], cheb['strany']['cssd']['prc'], cheb['strany']['prisaha']['prc'], cheb['strany']['tss']['prc'], cheb['strany']['zeleni']['prc'], cheb['strany']['volny']['prc']],
                        backgroundColor: backgroundColor
                    }]
                },
                options: options
            })


            // Graf město Ostrov

            // Ostrov

            // Sečteno
            document.querySelector(".ostrovSectenoProgress").textContent = ostrov['ucast']['zpracovano_prc'] + " %"
            document.querySelector(".ostrovSectenoProgress").setAttribute('value', ostrov['ucast']['zpracovano'])
            document.querySelector(".ostrovSectenoProgress").setAttribute('max', ostrov['ucast']['okrsky'])
            document.querySelector("#ostrovSectenoAktualne").textContent = 'Zpracováno ' + ostrov['ucast']['zpracovano'] + ' okresků (' + ostrov['ucast']['zpracovano_prc'] + ' %)'
            document.querySelector("#ostrovSectenoOkrskuCelkem").textContent = ostrov['ucast']['okrsky'] + ' okrsků'

            //Účast
            document.querySelector(".ostrovUcastProgress").textContent = ostrov['ucast']['ucast'] + " %"
            document.querySelector(".ostrovUcastProgress").setAttribute('value', ostrov['ucast']['ucast'])
            document.querySelector("#ostrovUcastPrc").textContent = ostrov['ucast']['ucast'] + ' %'

            ctxOstrov = document.getElementById('chartOstrov').getContext('2d');
            chartOstrov = new Chart(ctxOstrov, {
                type: 'bar',
                data: {
                    labels: graphLabels,
                    datasets: [{
                        data: [ostrov['strany']['spolu']['prc'], ostrov['strany']['ano']['prc'], ostrov['strany']['pistan']['prc'], ostrov['strany']['spd']['prc'], ostrov['strany']['kscm']['prc'], ostrov['strany']['cssd']['prc'], ostrov['strany']['prisaha']['prc'], ostrov['strany']['tss']['prc'], ostrov['strany']['zeleni']['prc'], ostrov['strany']['volny']['prc']],
                        backgroundColor: backgroundColor
                    }]
                },
                options: options
            })


            // Graf město Žlutice

            // Sečteno
            document.querySelector(".zluticeSectenoProgress").textContent = zlutice['ucast']['zpracovano_prc'] + " %"
            document.querySelector(".zluticeSectenoProgress").setAttribute('value', zlutice['ucast']['zpracovano'])
            document.querySelector(".zluticeSectenoProgress").setAttribute('max', zlutice['ucast']['okrsky'])
            document.querySelector("#zluticeSectenoAktualne").textContent = 'Zpracováno ' + zlutice['ucast']['zpracovano'] + ' okresků (' + zlutice['ucast']['zpracovano_prc'] + ' %)'
            document.querySelector("#zluticeSectenoOkrskuCelkem").textContent = zlutice['ucast']['okrsky'] + ' okrsků'

            //Účast
            document.querySelector(".zluticeUcastProgress").textContent = zlutice['ucast']['ucast'] + " %"
            document.querySelector(".zluticeUcastProgress").setAttribute('value', zlutice['ucast']['ucast'])
            document.querySelector("#zluticeUcastPrc").textContent = zlutice['ucast']['ucast'] + ' %'

            ctxZlutice = document.getElementById('chartZlutice').getContext('2d');
            chartZlutice = new Chart(ctxZlutice, {
                type: 'bar',
                data: {
                    labels: graphLabels,
                    datasets: [{
                        data: [zlutice['strany']['spolu']['prc'], zlutice['strany']['ano']['prc'], zlutice['strany']['pistan']['prc'], zlutice['strany']['spd']['prc'], zlutice['strany']['kscm']['prc'], zlutice['strany']['cssd']['prc'], zlutice['strany']['prisaha']['prc'], zlutice['strany']['tss']['prc'], zlutice['strany']['zeleni']['prc'], zlutice['strany']['volny']['prc']],
                        backgroundColor: backgroundColor
                    }]
                },
                options: options
            })

            const spoluTbody = document.querySelector('#spoluLidiTbody')
            for (let i = 0; i < lidiSpolu.length; i++) {
                const kandidat = lidiSpolu[i];
                tr = tbodyPeople(kandidat)
                spoluTbody.appendChild(tr)
            }

            const anoTbody = document.querySelector('#anoLidiTbody')
            for (let i = 0; i < lidiAno.length; i++) {
                const kandidat = lidiAno[i];
                tr = tbodyPeople(kandidat)
                anoTbody.appendChild(tr)
            }


            const pistanTbody = document.querySelector('#pistanLidiTbody')
            for (let i = 0; i < lidiPistan.length; i++) {
                const kandidat = lidiPistan[i];
                tr = tbodyPeople(kandidat)
                pistanTbody.appendChild(tr)
            }

            const spdTbody = document.querySelector('#spdLidiTbody')
            for (let i = 0; i < lidiSpd.length; i++) {
                const kandidat = lidiSpd[i];
                tr = tbodyPeople(kandidat)
                spdTbody.appendChild(tr)
            }

            // updates            

            let updateCr = new Date(cr['ucast']['update'])
            let crDates = document.querySelectorAll('.updateCr')
            for (let i = 0; i < crDates.length; i++) {
                const e = crDates[i];
                e.innerHTML = 'Poslední aktualizace: ' + updateCr.toLocaleDateString('cs-CZ', dateOptions)
            }

            let updateKv = new Date(okresKV['ucast']['update'])
            let kvDates = document.querySelectorAll('.updateKv')
            for (let i = 0; i < kvDates.length; i++) {
                const e = kvDates[i];
                e.innerHTML = 'Poslední aktualizace: ' + updateKv.toLocaleDateString('cs-CZ', dateOptions)
            }

            let updateSok = new Date(okresSok['ucast']['update'])
            let sokDates = document.querySelectorAll('.updateSok')
            for (let i = 0; i < sokDates.length; i++) {
                const e = sokDates[i];
                e.innerHTML = 'Poslední aktualizace: ' + updateSok.toLocaleDateString('cs-CZ', dateOptions)
            }

            let updateCheb = new Date(okresCheb['ucast']['update'])
            let chebDates = document.querySelectorAll('.updateCh')
            for (let i = 0; i < chebDates.length; i++) {
                const e = chebDates[i];
                e.innerHTML = 'Poslední aktualizace: ' + updateCheb.toLocaleDateString('cs-CZ', dateOptions)
            }
        }
    })
})

function tbodyPeople(kandidat) {
    let tr = document.createElement('TR')
    let cislo = document.createElement('TD')
    cislo.innerHTML = kandidat['poradoveCislo']
    let jmeno = document.createElement('TD')
    if (kandidat['titul'] != null) {
        jmeno.innerHTML = kandidat['titul'] + ' ' + kandidat['jmeno'] + ' ' + kandidat['prijmeni']

    } else {
        jmeno.innerHTML = kandidat['jmeno'] + ' ' + kandidat['prijmeni']
    }
    let hlasy = document.createElement('TD')
    hlasy.innerHTML = kandidat['pocetHlasu']
    let procentoHlasu = document.createElement('TD')
    procentoHlasu.innerHTML = kandidat['procentoHlasu']
    let mandat = document.createElement('TD')
    if (kandidat['mandat'] == "N") {
        mandat.innerHTML = '<i class="fas fa-times-circle"></i>'
    } else {
        mandat.innerHTML = '<i class="fas fa-check-circle"></i>'
    }
    let skrutinium = document.createElement('TD')
    skrutinium.innerHTML = kandidat['skrutinium']
    let poradiMandatu = document.createElement('TD')
    poradiMandatu.innerHTML = kandidat['poradiMandatu']
    let poradiNahradnika = document.createElement('TD')
    poradiNahradnika.innerHTML = kandidat['poradiNahradnika']

    tr.appendChild(cislo)
    tr.appendChild(jmeno)
    tr.appendChild(hlasy)
    tr.appendChild(procentoHlasu)
    tr.appendChild(mandat)
    tr.appendChild(skrutinium)
    tr.appendChild(poradiMandatu)
    tr.appendChild(poradiNahradnika)

    return tr
}

// Countdown

const countDownDate = new Date("Oct 8, 2021 14:00:00").getTime()
let countdownFunc = setInterval(() => {
    var now = new Date().getTime();
    var timeleft = countDownDate - now;

    var days = Math.floor(timeleft / (1000 * 60 * 60 * 24));
    var hours = Math.floor((timeleft % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60));
    var minutes = Math.floor((timeleft % (1000 * 60 * 60)) / (1000 * 60));
    var seconds = Math.floor((timeleft % (1000 * 60)) / 1000);

    document.querySelector('#countdownDays').innerHTML = days
    document.querySelector('#countdownHours').innerHTML = hours
    document.querySelector('#countdownMinutes').innerHTML = minutes
    document.querySelector('#countdownSeconds').innerHTML = seconds

    document.querySelector('#nextReload').innerHTML = 'Další pokus o refresh dat za ' + nextReload + " s"
    if (nextReload > 0) {
        nextReload -= 1
    } else {
        nextReload = 60
    }
}, 1000)

let getData = function () {
    $.ajax({
        url: "../src/source.json",
        success: (json) => {
            let cr = json['cr']
            let kraj = json['kraj'];
            let okresKV = json['okresKV'];
            let okresCheb = json['okresCheb'];
            let okresSok = json['okresSok'];
            let vary = json['vary'];
            let cheb = json['cheb'];
            let ostrov = json['ostrov'];
            let zlutice = json['zlutice'];
            let sokolov = json['sokolov'];
            let lidiSpoluJson = json['lidiSpolu'];
            let lidiPistanJson = json['lidiPistan'];
            let lidiAnoJson = json['lidiAno'];
            let lidiSpdJson = json['lidiSpd'];

            let lidiSpolu = []
            for (let i in lidiSpoluJson) {
                lidiSpolu.push(lidiSpoluJson[i])
            }

            let lidiPistan = []
            for (let i in lidiPistanJson) {
                lidiPistan.push(lidiPistanJson[i])
            }

            let lidiAno = []
            for (let i in lidiAnoJson) {
                lidiAno.push(lidiAnoJson[i])
            }

            let lidiSpd = []
            for (let i in lidiSpdJson) {
                lidiSpd.push(lidiSpdJson[i])
            }

            // ČR

            // Sečteno
            document.querySelector(".crSectenoProgress").textContent = cr['ucast']['zpracovano_prc'] + " %"
            document.querySelector(".crSectenoProgress").setAttribute('value', cr['ucast']['zpracovano'])
            document.querySelector(".crSectenoProgress").setAttribute('max', cr['ucast']['okrsky'])
            document.querySelector("#crSectenoAktualne").textContent = 'Zpracováno ' + cr['ucast']['zpracovano'] + ' okresků (' + cr['ucast']['zpracovano_prc'] + ' %)'
            document.querySelector("#crSectenoOkrskuCelkem").textContent = cr['ucast']['okrsky'] + ' okrsků'

            // Účast
            document.querySelector(".crUcastProgress").textContent = cr['ucast']['ucast'] + " %"
            document.querySelector(".crUcastProgress").setAttribute('value', cr['ucast']['ucast'])
            document.querySelector("#crUcastPrc").textContent = cr['ucast']['ucast'] + ' %'


            crChart.data = {
                labels: graphLabels,
                datasets: [{
                    data: [cr['spolu']['prc'], cr['ano']['prc'], cr['pistan']['prc'], cr['spd']['prc'], cr['kscm']['prc'], cr['cssd']['prc'], cr['prisaha']['prc'], cr['tss']['prc'], cr['zeleni']['prc'], cr['volny']['prc']],

                    backgroundColor: backgroundColor
                }]
            }
            crChart.update()


            // Kraj

            // Sečteno
            document.querySelector(".krajSectenoProgress").textContent = kraj['ucast']['zpracovano_prc'] + " %"
            document.querySelector(".krajSectenoProgress").setAttribute('value', kraj['ucast']['zpracovano'])
            document.querySelector(".krajSectenoProgress").setAttribute('max', kraj['ucast']['okrsky'])
            document.querySelector("#krajSectenoAktualne").textContent = 'Zpracováno ' + kraj['ucast']['zpracovano'] + ' okresků (' + kraj['ucast']['zpracovano_prc'] + ' %)'
            document.querySelector("#krajSectenoOkrskuCelkem").textContent = kraj['ucast']['okrsky'] + ' okrsků'

            //Účast
            document.querySelector(".krajUcastProgress").textContent = kraj['ucast']['ucast'] + " %"
            document.querySelector(".krajUcastProgress").setAttribute('value', kraj['ucast']['ucast'])
            document.querySelector("#krajUcastPrc").textContent = kraj['ucast']['ucast'] + ' %'

            // Update grafu
            chartKVK.data = {
                labels: graphLabels,
                datasets: [{
                    data: [kraj['spolu']['prc'], kraj['ano']['prc'], kraj['pistan']['prc'], kraj['spd']['prc'], kraj['kscm']['prc'], kraj['cssd']['prc'], kraj['prisaha']['prc'], kraj['tss']['prc'], kraj['zeleni']['prc'], kraj['volny']['prc']],

                    backgroundColor: backgroundColor
                }]
            }
            chartKVK.update()


            // Okres KV

            // Sečteno
            document.querySelector(".okresKvSectenoProgress").textContent = okresKV['ucast']['zpracovano_prc'] + " %"
            document.querySelector(".okresKvSectenoProgress").setAttribute('value', okresKV['ucast']['zpracovano'])
            document.querySelector(".okresKvSectenoProgress").setAttribute('max', okresKV['ucast']['okrsky'])
            document.querySelector("#okresKvSectenoAktualne").textContent = 'Zpracováno ' + okresKV['ucast']['zpracovano'] + ' okresků (' + okresKV['ucast']['zpracovano_prc'] + ' %)'
            document.querySelector("#okresKvSectenoOkrskuCelkem").textContent = okresKV['ucast']['okrsky'] + ' okrsků'

            //Účast
            document.querySelector(".okresKvUcastProgress").textContent = okresKV['ucast']['ucast'] + " %"
            document.querySelector(".okresKvUcastProgress").setAttribute('value', okresKV['ucast']['ucast'])
            document.querySelector("#okresKvUcastPrc").textContent = okresKV['ucast']['ucast'] + ' %'

            // Update grafu
            chartOkresKV.data = {
                labels: graphLabels,
                datasets: [{
                    data: [okresKV['spolu']['prc'], okresKV['ano']['prc'], okresKV['pistan']['prc'], okresKV['spd']['prc'], okresKV['kscm']['prc'], okresKV['cssd']['prc'], okresKV['prisaha']['prc'], okresKV['tss']['prc'], okresKV['zeleni']['prc'], okresKV['volny']['prc']],

                    backgroundColor: backgroundColor
                }]
            }
            chartOkresKV.update()


            // Okres Sok

            // Sečteno
            document.querySelector(".okresSokSectenoProgress").textContent = okresSok['ucast']['zpracovano_prc'] + " %"
            document.querySelector(".okresSokSectenoProgress").setAttribute('value', okresSok['ucast']['zpracovano'])
            document.querySelector(".okresSokSectenoProgress").setAttribute('max', okresSok['ucast']['okrsky'])
            document.querySelector("#okresSokSectenoAktualne").textContent = 'Zpracováno ' + okresSok['ucast']['zpracovano'] + ' okresků (' + okresSok['ucast']['zpracovano_prc'] + ' %)'
            document.querySelector("#okresSokSectenoOkrskuCelkem").textContent = okresSok['ucast']['okrsky'] + ' okrsků'

            //Účast
            document.querySelector(".okresSokUcastProgress").textContent = okresSok['ucast']['ucast'] + " %"
            document.querySelector(".okresSokUcastProgress").setAttribute('value', okresSok['ucast']['ucast'])
            document.querySelector("#okresSokUcastPrc").textContent = okresSok['ucast']['ucast'] + ' %'

            // Update grafu

            chartOkresSok.data = {
                labels: graphLabels,
                datasets: [{
                    data: [okresSok['spolu']['prc'], okresSok['ano']['prc'], okresSok['pistan']['prc'], okresSok['spd']['prc'], okresSok['kscm']['prc'], okresSok['cssd']['prc'], okresSok['prisaha']['prc'], okresSok['tss']['prc'], okresSok['zeleni']['prc'], okresSok['volny']['prc']],

                    backgroundColor: backgroundColor
                }]
            }
            chartOkresSok.update()


            // Okres Cheb

            // Sečteno
            document.querySelector(".okresChebSectenoProgress").textContent = okresCheb['ucast']['zpracovano_prc'] + " %"
            document.querySelector(".okresChebSectenoProgress").setAttribute('value', okresCheb['ucast']['zpracovano'])
            document.querySelector(".okresChebSectenoProgress").setAttribute('max', okresCheb['ucast']['okrsky'])
            document.querySelector("#okresChebSectenoAktualne").textContent = 'Zpracováno ' + okresCheb['ucast']['zpracovano'] + ' okresků (' + okresCheb['ucast']['zpracovano_prc'] + ' %)'
            document.querySelector("#okresChebSectenoOkrskuCelkem").textContent = okresCheb['ucast']['okrsky'] + ' okrsků'

            //Účast
            document.querySelector(".okresChebUcastProgress").textContent = okresCheb['ucast']['ucast'] + " %"
            document.querySelector(".okresChebUcastProgress").setAttribute('value', okresCheb['ucast']['ucast'])
            document.querySelector("#okresChebUcastPrc").textContent = okresCheb['ucast']['ucast'] + ' %'

            // Update grafu

            chartOkresCheb.data = {
                labels: graphLabels,
                datasets: [{
                    data: [okresCheb['spolu']['prc'], okresCheb['ano']['prc'], okresCheb['pistan']['prc'], okresCheb['spd']['prc'], okresCheb['kscm']['prc'], okresCheb['cssd']['prc'], okresCheb['prisaha']['prc'], okresCheb['tss']['prc'], okresCheb['zeleni']['prc'], okresCheb['volny']['prc']],

                    backgroundColor: backgroundColor
                }]
            }
            chartOkresCheb.update()


            // Vary

            // Sečteno
            document.querySelector(".varySectenoProgress").textContent = vary['ucast']['zpracovano_prc'] + " %"
            document.querySelector(".varySectenoProgress").setAttribute('value', vary['ucast']['zpracovano'])
            document.querySelector(".varySectenoProgress").setAttribute('max', vary['ucast']['okrsky'])
            document.querySelector("#varySectenoAktualne").textContent = 'Zpracováno ' + vary['ucast']['zpracovano'] + ' okresků (' + vary['ucast']['zpracovano_prc'] + ' %)'
            document.querySelector("#varySectenoOkrskuCelkem").textContent = vary['ucast']['okrsky'] + ' okrsků'

            //Účast
            document.querySelector(".varyUcastProgress").textContent = vary['ucast']['ucast'] + " %"
            document.querySelector(".varyUcastProgress").setAttribute('value', vary['ucast']['ucast'])
            document.querySelector("#varyUcastPrc").textContent = vary['ucast']['ucast'] + ' %'

            // Update grafu

            chartVary.data = {
                labels: graphLabels,
                datasets: [{
                    data: [vary['strany']['spolu']['prc'], vary['strany']['ano']['prc'], vary['strany']['pistan']['prc'], vary['strany']['spd']['prc'], vary['strany']['kscm']['prc'], vary['strany']['cssd']['prc'], vary['strany']['prisaha']['prc'], vary['strany']['tss']['prc'], vary['strany']['zeleni']['prc'], vary['strany']['volny']['prc']],

                    backgroundColor: backgroundColor
                }]
            }
            chartVary.update()


            // Sokolov

            // Sečteno
            document.querySelector(".sokolovSectenoProgress").textContent = sokolov['ucast']['zpracovano_prc'] + " %"
            document.querySelector(".sokolovSectenoProgress").setAttribute('value', sokolov['ucast']['zpracovano'])
            document.querySelector(".sokolovSectenoProgress").setAttribute('max', sokolov['ucast']['okrsky'])
            document.querySelector("#sokolovSectenoAktualne").textContent = 'Zpracováno ' + sokolov['ucast']['zpracovano'] + ' okresků (' + sokolov['ucast']['zpracovano_prc'] + ' %)'
            document.querySelector("#sokolovSectenoOkrskuCelkem").textContent = sokolov['ucast']['okrsky'] + ' okrsků'

            //Účast
            document.querySelector(".sokolovUcastProgress").textContent = sokolov['ucast']['ucast'] + " %"
            document.querySelector(".sokolovUcastProgress").setAttribute('value', sokolov['ucast']['ucast'])
            document.querySelector("#sokolovUcastPrc").textContent = sokolov['ucast']['ucast'] + ' %'

            // Update grafu

            chartSokolov.data = {
                labels: graphLabels,
                datasets: [{
                    data: [sokolov['strany']['spolu']['prc'], sokolov['strany']['ano']['prc'], sokolov['strany']['pistan']['prc'], sokolov['strany']['spd']['prc'], sokolov['strany']['kscm']['prc'], sokolov['strany']['cssd']['prc'], sokolov['strany']['prisaha']['prc'], sokolov['strany']['tss']['prc'], sokolov['strany']['zeleni']['prc'], sokolov['strany']['volny']['prc']],

                    backgroundColor: backgroundColor
                }]
            }
            chartSokolov.update()


            // Cheb

            // Sečteno
            document.querySelector(".chebSectenoProgress").textContent = cheb['ucast']['zpracovano_prc'] + " %"
            document.querySelector(".chebSectenoProgress").setAttribute('value', cheb['ucast']['zpracovano'])
            document.querySelector(".chebSectenoProgress").setAttribute('max', cheb['ucast']['okrsky'])
            document.querySelector("#chebSectenoAktualne").textContent = 'Zpracováno ' + cheb['ucast']['zpracovano'] + ' okresků (' + cheb['ucast']['zpracovano_prc'] + ' %)'
            document.querySelector("#chebSectenoOkrskuCelkem").textContent = cheb['ucast']['okrsky'] + ' okrsků'

            //Účast
            document.querySelector(".chebUcastProgress").textContent = cheb['ucast']['ucast'] + " %"
            document.querySelector(".chebUcastProgress").setAttribute('value', cheb['ucast']['ucast'])
            document.querySelector("#chebUcastPrc").textContent = cheb['ucast']['ucast'] + ' %'

            // Update grafu

            chartCheb.data = {
                labels: graphLabels,
                datasets: [{
                    data: [cheb['strany']['spolu']['prc'], cheb['strany']['ano']['prc'], cheb['strany']['pistan']['prc'], cheb['strany']['spd']['prc'], cheb['strany']['kscm']['prc'], cheb['strany']['cssd']['prc'], cheb['strany']['prisaha']['prc'], cheb['strany']['tss']['prc'], cheb['strany']['zeleni']['prc'], cheb['strany']['volny']['prc']],

                    backgroundColor: backgroundColor
                }]
            }
            chartCheb.update()


            // Ostrov

            // Sečteno
            document.querySelector(".ostrovSectenoProgress").textContent = ostrov['ucast']['zpracovano_prc'] + " %"
            document.querySelector(".ostrovSectenoProgress").setAttribute('value', ostrov['ucast']['zpracovano'])
            document.querySelector(".ostrovSectenoProgress").setAttribute('max', ostrov['ucast']['okrsky'])
            document.querySelector("#ostrovSectenoAktualne").textContent = 'Zpracováno ' + ostrov['ucast']['zpracovano'] + ' okresků (' + ostrov['ucast']['zpracovano_prc'] + ' %)'
            document.querySelector("#ostrovSectenoOkrskuCelkem").textContent = ostrov['ucast']['okrsky'] + ' okrsků'

            //Účast
            document.querySelector(".ostrovUcastProgress").textContent = ostrov['ucast']['ucast'] + " %"
            document.querySelector(".ostrovUcastProgress").setAttribute('value', ostrov['ucast']['ucast'])
            document.querySelector("#ostrovUcastPrc").textContent = ostrov['ucast']['ucast'] + ' %'

            // Update grafu

            chartOstrov.data = {
                labels: graphLabels,
                datasets: [{
                    data: [ostrov['strany']['spolu']['prc'], ostrov['strany']['ano']['prc'], ostrov['strany']['pistan']['prc'], ostrov['strany']['spd']['prc'], ostrov['strany']['kscm']['prc'], ostrov['strany']['cssd']['prc'], ostrov['strany']['prisaha']['prc'], ostrov['strany']['tss']['prc'], ostrov['strany']['zeleni']['prc'], ostrov['strany']['volny']['prc']],

                    backgroundColor: backgroundColor
                }]
            }
            chartOstrov.update()


            // Žlutice

            // Sečteno
            document.querySelector(".zluticeSectenoProgress").textContent = zlutice['ucast']['zpracovano_prc'] + " %"
            document.querySelector(".zluticeSectenoProgress").setAttribute('value', zlutice['ucast']['zpracovano'])
            document.querySelector(".zluticeSectenoProgress").setAttribute('max', zlutice['ucast']['okrsky'])
            document.querySelector("#zluticeSectenoAktualne").textContent = 'Zpracováno ' + zlutice['ucast']['zpracovano'] + ' okresků (' + zlutice['ucast']['zpracovano_prc'] + ' %)'
            document.querySelector("#zluticeSectenoOkrskuCelkem").textContent = zlutice['ucast']['okrsky'] + ' okrsků'

            //Účast
            document.querySelector(".zluticeUcastProgress").textContent = zlutice['ucast']['ucast'] + " %"
            document.querySelector(".zluticeUcastProgress").setAttribute('value', zlutice['ucast']['ucast'])
            document.querySelector("#zluticeUcastPrc").textContent = zlutice['ucast']['ucast'] + ' %'

            // Update grafu

            chartZlutice.data = {
                labels: graphLabels,
                datasets: [{
                    data: [zlutice['strany']['spolu']['prc'], zlutice['strany']['ano']['prc'], zlutice['strany']['pistan']['prc'], zlutice['strany']['spd']['prc'], zlutice['strany']['kscm']['prc'], zlutice['strany']['cssd']['prc'], zlutice['strany']['prisaha']['prc'], zlutice['strany']['tss']['prc'], zlutice['strany']['zeleni']['prc'], zlutice['strany']['volny']['prc']],

                    backgroundColor: backgroundColor
                }]
            }
            chartZlutice.update()

            // Kandidátky

            const spoluTbody = document.querySelector('#spoluLidiTbody')
            spoluTbody.innerHTML = ''
            for (let i = 0; i < lidiSpolu.length; i++) {
                const kandidat = lidiSpolu[i];
                tr = tbodyPeople(kandidat)
                spoluTbody.appendChild(tr)
            }

            const anoTbody = document.querySelector('#anoLidiTbody')
            anoTbody.innerHTML = ''
            for (let i = 0; i < lidiAno.length; i++) {
                const kandidat = lidiAno[i];
                tr = tbodyPeople(kandidat)
                anoTbody.appendChild(tr)
            }


            const pistanTbody = document.querySelector('#pistanLidiTbody')
            pistanTbody.innerHTML = ''
            for (let i = 0; i < lidiPistan.length; i++) {
                const kandidat = lidiPistan[i];
                tr = tbodyPeople(kandidat)
                pistanTbody.appendChild(tr)
            }

            const spdTbody = document.querySelector('#spdLidiTbody')
            spdTbody.innerHTML = ''
            for (let i = 0; i < lidiSpd.length; i++) {
                const kandidat = lidiSpd[i];
                tr = tbodyPeople(kandidat)
                spdTbody.appendChild(tr)
            }

            // updates            

            let updateCr = new Date(cr['ucast']['update'])
            let crDates = document.querySelectorAll('.updateCr')
            for (let i = 0; i < crDates.length; i++) {
                const e = crDates[i];
                e.innerHTML = 'Poslední aktualizace: ' + updateCr.toLocaleDateString('cs-CZ', dateOptions)
            }

            let updateKv = new Date(okresKV['ucast']['update'])
            let kvDates = document.querySelectorAll('.updateKv')
            for (let i = 0; i < kvDates.length; i++) {
                const e = kvDates[i];
                e.innerHTML = 'Poslední aktualizace: ' + updateKv.toLocaleDateString('cs-CZ', dateOptions)
            }

            let updateSok = new Date(okresSok['ucast']['update'])
            let sokDates = document.querySelectorAll('.updateSok')
            for (let i = 0; i < sokDates.length; i++) {
                const e = sokDates[i];
                e.innerHTML = 'Poslední aktualizace: ' + updateSok.toLocaleDateString('cs-CZ', dateOptions)
            }

            let updateCheb = new Date(okresCheb['ucast']['update'])
            let chebDates = document.querySelectorAll('.updateCh')
            for (let i = 0; i < chebDates.length; i++) {
                const e = chebDates[i];
                e.innerHTML = 'Poslední aktualizace: ' + updateCheb.toLocaleDateString('cs-CZ', dateOptions)
            }
        }
    })
}

const interval = 1000 * 60 * 1;
setInterval(getData, interval)