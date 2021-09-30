<?php

namespace volby21\data;

require '../vendor/autoload.php';

use Dotenv\Dotenv;


$dotenv = Dotenv::createImmutable(dirname(__DIR__));
$dotenv->load();

if (isset($_GET['key'])) {
    if ($_GET['key'] == $_ENV['KEY']) {
        //TODO security

        $urlCelkem = 'https://volby.cz/pls/ps2021/vysledky';
        $urlOkresKV = 'https://volby.cz/pls/ps2021/vysledky_okres?nuts=CZ0412';
        $urlOkresCheb = 'https://volby.cz/pls/ps2021/vysledky_okres?nuts=CZ0411';
        $urlOkresSok = 'https://volby.cz/pls/ps2021/vysledky_okres?nuts=CZ0413';
        $urlKandidati = 'https://volby.cz/opendata/ps2021/xml/psrk.xml';
        $urlPreferencniHlasy = 'https://volby.cz/pls/ps2021/vysledky_kandid';

        $xmlCelkem = json_encode(simplexml_load_file($urlCelkem), JSON_PRETTY_PRINT);
        $xmlOkresKV = json_encode(simplexml_load_file($urlOkresKV));
        $xmlOkresCheb = json_encode(simplexml_load_file($urlOkresCheb));
        $xmlOkresSok = json_encode(simplexml_load_file($urlOkresSok));
        $xmlKandidati = json_encode(simplexml_load_file($urlKandidati));
        $xmlPreferencniHlasy = json_encode(simplexml_load_file($urlPreferencniHlasy));



        $celkem = json_decode($xmlCelkem, true);
        $kv = json_decode($xmlOkresKV, true);
        $cheb = json_decode($xmlOkresCheb, true);
        $sok = json_decode($xmlOkresSok, true);
        $kandidati = json_decode($xmlKandidati, true);
        $hlasy = json_decode($xmlPreferencniHlasy, true);

        $lastUpdateCelkem = $celkem['@attributes']['DATUM_CAS_GENEROVANI'];

        $source = 'source.json';

        $ucastCr = [
            'okrsky' => (int)$celkem['CR']['UCAST']['@attributes']['OKRSKY_CELKEM'],
            'zpracovano' => (int)$celkem['CR']['UCAST']['@attributes']['OKRSKY_ZPRAC'],
            'zpracovano_prc' => (int)$celkem['CR']['UCAST']['@attributes']['OKRSKY_ZPRAC_PROC'],
            'ucast' => (int)$celkem['CR']['UCAST']['@attributes']['UCAST_PROC'],
            'update' => $celkem['@attributes']['DATUM_CAS_GENEROVANI']
        ];
        $spoluCr = [
            'hlasy' => (int)$celkem['CR']['STRANA'][12]['HODNOTY_STRANA']['@attributes']['HLASY'],
            'prc' => (int)$celkem['CR']['STRANA'][12]['HODNOTY_STRANA']['@attributes']['PROC_HLASU'],
            'nazev' => $celkem['CR']['STRANA'][12]['@attributes']['NAZ_STR']
        ];
        $pistanCr = [
            'hlasy' => (int)$celkem['CR']['STRANA'][16]['HODNOTY_STRANA']['@attributes']['HLASY'],
            'prc' => (int)$celkem['CR']['STRANA'][16]['HODNOTY_STRANA']['@attributes']['PROC_HLASU'],
            'nazev' => (int)$celkem['CR']['STRANA'][16]['@attributes']['NAZ_STRANA']
        ];
        $anoCr = [
            'hlasy' => (int)$celkem['CR']['STRANA'][19]['HODNOTY_STRANA']['@attributes']['HLASY'],
            'prc' => (int)$celkem['CR']['STRANA'][19]['HODNOTY_STRANA']['@attributes']['PROC_HLASU'],
            'nazev' => $celkem['CR']['STRANA'][19]['@attributes']['NAZ_STR']
        ];
        $spdCr = [
            'hlasy' => (int)$celkem['CR']['STRANA'][3]['HODNOTY_STRANA']['@attributes']['HLASY'],
            'prc' => (int)$celkem['CR']['STRANA'][3]['HODNOTY_STRANA']['@attributes']['PROC_HLASU'],
            'nazev' => $celkem['CR']['STRANA'][3]['@attributes']['NAZ_STR']
        ];
        $kscmCr = [
            'hlasy' => (int)$celkem['CR']['STRANA'][15]['HODNOTY_STRANA']['@attributes']['HLASY'],
            'prc' => (int)$celkem['CR']['STRANA'][15]['HODNOTY_STRANA']['@attributes']['PROC_HLASU'],
            'nazev' => $celkem['CR']['STRANA'][15]['@attributes']['NAZ_STR']
        ];
        $cssdCr = [
            'hlasy' => (int)$celkem['CR']['STRANA'][4]['HODNOTY_STRANA']['@attributes']['HLASY'],
            'prc' => (int)$celkem['CR']['STRANA'][4]['HODNOTY_STRANA']['@attributes']['PROC_HLASU'],
            'nazev' => $celkem['CR']['STRANA'][4]['@attributes']['NAZ_STR']
        ];
        $prisahaCr = [
            'hlasy' => (int)$celkem['CR']['STRANA'][11]['HODNOTY_STRANA']['@attributes']['HLASY'],
            'prc' => (int)$celkem['CR']['STRANA'][11]['HODNOTY_STRANA']['@attributes']['PROC_HLASU'],
            'nazev' => $celkem['CR']['STRANA'][11]['@attributes']['NAZ_STR']
        ];
        $zeleniCr = [
            'hlasy' => (int)$celkem['CR']['STRANA'][0]['HODNOTY_STRANA']['@attributes']['HLASY'],
            'prc' => (int)$celkem['CR']['STRANA'][0]['HODNOTY_STRANA']['@attributes']['PROC_HLASU'],
            'nazev' => $celkem['CR']['STRANA'][0]['@attributes']['NAZ_STR']
        ];
        $tssCr = [
            'hlasy' => (int)$celkem['CR']['STRANA'][7]['HODNOTY_STRANA']['@attributes']['HLASY'],
            'prc' => (int)$celkem['CR']['STRANA'][7]['HODNOTY_STRANA']['@attributes']['PROC_HLASU'],
            'nazev' => $celkem['CR']['STRANA'][7]['@attributes']['NAZ_STR']
        ];
        $volnyCr = [
            'hlasy' => (int)$celkem['CR']['STRANA'][2]['HODNOTY_STRANA']['@attributes']['HLASY'],
            'prc' => (int)$celkem['CR']['STRANA'][2]['HODNOTY_STRANA']['@attributes']['PROC_HLASU'],
            'nazev' => $celkem['CR']['STRANA'][2]['@attributes']['NAZ_STR']
        ];

        // Strany v KVK

        $ucastKVK = [
            'okrsky' => (int)$celkem['KRAJ'][4]['UCAST']['@attributes']['OKRSKY_CELKEM'],
            'zpracovano' => (int)$celkem['KRAJ'][4]['UCAST']['@attributes']['OKRSKY_ZPRAC'],
            'zpracovano_prc' => (int)$celkem['KRAJ'][4]['UCAST']['@attributes']['OKRSKY_ZPRAC_PROC'],
            'ucast' => (int)$celkem['KRAJ'][4]['UCAST']['@attributes']['UCAST_PROC']
        ];
        $spoluKVK = [
            'hlasy' => (int)$celkem['KRAJ'][4]['STRANA'][10]['HODNOTY_STRANA']['@attributes']['HLASY'],
            'prc' => (int)$celkem['KRAJ'][4]['STRANA'][10]['HODNOTY_STRANA']['@attributes']['PROC_HLASU'],
            'nazev' => $celkem['KRAJ'][4]['STRANA'][10]['@attributes']['NAZ_STR']
        ];
        $pistanKVK = [
            'hlasy' => (int)$celkem['KRAJ'][4]['STRANA'][13]['HODNOTY_STRANA']['@attributes']['HLASY'],
            'prc' => (int)$celkem['KRAJ'][4]['STRANA'][13]['HODNOTY_STRANA']['@attributes']['PROC_HLASU'],
            'nazev' => $celkem['KRAJ'][4]['STRANA'][13]['@attributes']['NAZ_STR']
        ];
        $anoKVK = [
            'hlasy' => (int)$celkem['KRAJ'][4]['STRANA'][15]['HODNOTY_STRANA']['@attributes']['HLASY'],
            'prc' => (int)$celkem['KRAJ'][4]['STRANA'][15]['HODNOTY_STRANA']['@attributes']['PROC_HLASU'],
            'nazev' => $celkem['KRAJ'][4]['STRANA'][15]['@attributes']['NAZ_STR']
        ];
        $spdKVK = [
            'hlasy' => (int)$celkem['KRAJ'][4]['STRANA'][3]['HODNOTY_STRANA']['@attributes']['HLASY'],
            'prc' => (int)$celkem['KRAJ'][4]['STRANA'][3]['HODNOTY_STRANA']['@attributes']['PROC_HLASU'],
            'nazev' => $celkem['KRAJ'][4]['STRANA'][3]['@attributes']['NAZ_STR']
        ];
        $kscmKVK = [
            'hlasy' => (int)$celkem['KRAJ'][4]['STRANA'][14]['HODNOTY_STRANA']['@attributes']['HLASY'],
            'prc' => (int)$celkem['KRAJ'][4]['STRANA'][14]['HODNOTY_STRANA']['@attributes']['PROC_HLASU'],
            'nazev' => $celkem['KRAJ'][4]['STRANA'][14]['@attributes']['NAZ_STR']
        ];
        $cssdKVK = [
            'hlasy' => (int)$celkem['KRAJ'][4]['STRANA'][4]['HODNOTY_STRANA']['@attributes']['HLASY'],
            'prc' => (int)$celkem['KRAJ'][4]['STRANA'][4]['HODNOTY_STRANA']['@attributes']['PROC_HLASU'],
            'nazev' => $celkem['KRAJ'][4]['STRANA'][4]['@attributes']['NAZ_STR']
        ];
        $prisahaKVK = [
            'hlasy' => (int)$celkem['KRAJ'][4]['STRANA'][9]['HODNOTY_STRANA']['@attributes']['HLASY'],
            'prc' => (int)$celkem['KRAJ'][4]['STRANA'][9]['HODNOTY_STRANA']['@attributes']['PROC_HLASU'],
            'nazev' => $celkem['KRAJ'][4]['STRANA'][9]['@attributes']['NAZ_STR']
        ];
        $zeleniKVK = [
            'hlasy' => (int)$celkem['KRAJ'][4]['STRANA'][0]['HODNOTY_STRANA']['@attributes']['HLASY'],
            'prc' => (int)$celkem['KRAJ'][4]['STRANA'][0]['HODNOTY_STRANA']['@attributes']['PROC_HLASU'],
            'nazev' => $celkem['KRAJ'][4]['STRANA'][0]['@attributes']['NAZ_STR']
        ];
        $tssKVK = [
            'hlasy' => (int)$celkem['KRAJ'][4]['STRANA'][6]['HODNOTY_STRANA']['@attributes']['HLASY'],
            'prc' => (int)$celkem['KRAJ'][4]['STRANA'][6]['HODNOTY_STRANA']['@attributes']['PROC_HLASU'],
            'nazev' => $celkem['KRAJ'][4]['STRANA'][6]['@attributes']['NAZ_STR']
        ];
        $volnyKVK = [
            'hlasy' => (int)$celkem['KRAJ'][4]['STRANA'][2]['HODNOTY_STRANA']['@attributes']['HLASY'],
            'prc' => (int)$celkem['KRAJ'][4]['STRANA'][2]['HODNOTY_STRANA']['@attributes']['PROC_HLASU'],
            'nazev' => $celkem['KRAJ'][4]['STRANA'][2]['@attributes']['NAZ_STR']
        ];

        // Okres KV

        $ucastKV = [
            'okrsky' => (int)$kv['OKRES']['UCAST']['@attributes']['OKRSKY_CELKEM'],
            'zpracovano' => (int)$kv['OKRES']['UCAST']['@attributes']['OKRSKY_ZPRAC'],
            'zpracovano_prc' => (int)$kv['OKRES']['UCAST']['@attributes']['OKRSKY_ZPRAC_PROC'],
            'ucast' => (int)$kv['OKRES']['UCAST']['@attributes']['UCAST_PROC'],
            'update' => $kv['@attributes']['DATUM_CAS_GENEROVANI']
        ];
        $spoluKV = [
            'hlasy' => (int)$kv['OKRES']['HLASY_STRANA'][10]['HODNOTY_STRANA']['@attributes']['HLASY'],
            'prc' => (int)$kv['OKRES']['HLASY_STRANA'][10]['HODNOTY_STRANA']['@attributes']['PROC_HLASU'],
            'nazev' => $celkem['KRAJ'][4]['STRANA'][10]['@attributes']['NAZ_STR']
        ];
        $pistanKV = [
            'hlasy' => (int)$kv['OKRES']['HLASY_STRANA'][13]['HODNOTY_STRANA']['@attributes']['HLASY'],
            'prc' => (int)$kv['OKRES']['HLASY_STRANA'][13]['HODNOTY_STRANA']['@attributes']['PROC_HLASU'],
            'nazev' => $celkem['KRAJ'][4]['STRANA'][13]['@attributes']['NAZ_STR']
        ];
        $anoKV = [
            'hlasy' => (int)$kv['OKRES']['HLASY_STRANA'][15]['HODNOTY_STRANA']['@attributes']['HLASY'],
            'prc' => (int)$kv['OKRES']['HLASY_STRANA'][15]['HODNOTY_STRANA']['@attributes']['PROC_HLASU'],
            'nazev' => $celkem['KRAJ'][4]['STRANA'][15]['@attributes']['NAZ_STR']
        ];
        $spdKV = [
            'hlasy' => (int)$kv['OKRES']['HLASY_STRANA'][3]['HODNOTY_STRANA']['@attributes']['HLASY'],
            'prc' => (int)$kv['OKRES']['HLASY_STRANA'][3]['HODNOTY_STRANA']['@attributes']['PROC_HLASU'],
            'nazev' => $celkem['KRAJ'][4]['STRANA'][3]['@attributes']['NAZ_STR']
        ];
        $kscmKV = [
            'hlasy' => (int)$kv['OKRES']['HLASY_STRANA'][14]['HODNOTY_STRANA']['@attributes']['HLASY'],
            'prc' => (int)$kv['OKRES']['HLASY_STRANA'][14]['HODNOTY_STRANA']['@attributes']['PROC_HLASU'],
            'nazev' => $celkem['KRAJ'][4]['STRANA'][14]['@attributes']['NAZ_STR']
        ];
        $cssdKV = [
            'hlasy' => (int)$kv['OKRES']['HLASY_STRANA'][4]['HODNOTY_STRANA']['@attributes']['HLASY'],
            'prc' => (int)$kv['OKRES']['HLASY_STRANA'][4]['HODNOTY_STRANA']['@attributes']['PROC_HLASU'],
            'nazev' => $celkem['KRAJ'][4]['STRANA'][4]['@attributes']['NAZ_STR']
        ];
        $prisahaKV = [
            'hlasy' => (int)$kv['OKRES']['HLASY_STRANA'][9]['HODNOTY_STRANA']['@attributes']['HLASY'],
            'prc' => (int)$kv['OKRES']['HLASY_STRANA'][9]['HODNOTY_STRANA']['@attributes']['PROC_HLASU'],
            'nazev' => $celkem['KRAJ'][4]['STRANA'][9]['@attributes']['NAZ_STR']
        ];
        $zeleniKV = [
            'hlasy' => (int)$kv['OKRES']['HLASY_STRANA'][0]['HODNOTY_STRANA']['@attributes']['HLASY'],
            'prc' => (int)$kv['OKRES']['HLASY_STRANA'][0]['HODNOTY_STRANA']['@attributes']['PROC_HLASU'],
            'nazev' => $celkem['KRAJ'][4]['STRANA'][0]['@attributes']['NAZ_STR']
        ];
        $tssKV = [
            'hlasy' => (int)$kv['OKRES']['HLASY_STRANA'][6]['HODNOTY_STRANA']['@attributes']['HLASY'],
            'prc' => (int)$kv['OKRES']['HLASY_STRANA'][6]['HODNOTY_STRANA']['@attributes']['PROC_HLASU'],
            'nazev' => $celkem['KRAJ'][4]['STRANA'][6]['@attributes']['NAZ_STR']
        ];
        $volnyKV = [
            'hlasy' => (int)$kv['OKRES']['HLASY_STRANA'][2]['HODNOTY_STRANA']['@attributes']['HLASY'],
            'prc' => (int)$kv['OKRES']['HLASY_STRANA'][2]['HODNOTY_STRANA']['@attributes']['PROC_HLASU'],
            'nazev' => $celkem['KRAJ'][4]['STRANA'][2]['@attributes']['NAZ_STR']
        ];

        // Okres Cheb

        $ucastCheb = [
            'okrsky' => (int)$cheb['OKRES']['UCAST']['@attributes']['OKRSKY_CELKEM'],
            'zpracovano' => (int)$cheb['OKRES']['UCAST']['@attributes']['OKRSKY_ZPRAC'],
            'zpracovano_prc' => (int)$cheb['OKRES']['UCAST']['@attributes']['OKRSKY_ZPRAC_PROC'],
            'ucast' => (int)$cheb['OKRES']['UCAST']['@attributes']['UCAST_PROC'],
            'update' => $cheb['@attributes']['DATUM_CAS_GENEROVANI']
        ];
        $spoluCheb = [
            'hlasy' => (int)$cheb['OKRES']['HLASY_STRANA'][10]['HODNOTY_STRANA']['@attributes']['HLASY'],
            'prc' => (int)$cheb['OKRES']['HLASY_STRANA'][10]['HODNOTY_STRANA']['@attributes']['PROC_HLASU'],
            'nazev' => $celkem['KRAJ'][4]['STRANA'][10]['@attributes']['NAZ_STR']
        ];
        $pistanCheb = [
            'hlasy' => (int)$cheb['OKRES']['HLASY_STRANA'][13]['HODNOTY_STRANA']['@attributes']['HLASY'],
            'prc' => (int)$cheb['OKRES']['HLASY_STRANA'][13]['HODNOTY_STRANA']['@attributes']['PROC_HLASU'],
            'nazev' => $celkem['KRAJ'][4]['STRANA'][13]['@attributes']['NAZ_STR']
        ];
        $anoCheb = [
            'hlasy' => (int)$cheb['OKRES']['HLASY_STRANA'][15]['HODNOTY_STRANA']['@attributes']['HLASY'],
            'prc' => (int)$cheb['OKRES']['HLASY_STRANA'][15]['HODNOTY_STRANA']['@attributes']['PROC_HLASU'],
            'nazev' => $celkem['KRAJ'][4]['STRANA'][15]['@attributes']['NAZ_STR']
        ];
        $spdCheb = [
            'hlasy' => (int)$cheb['OKRES']['HLASY_STRANA'][3]['HODNOTY_STRANA']['@attributes']['HLASY'],
            'prc' => (int)$cheb['OKRES']['HLASY_STRANA'][3]['HODNOTY_STRANA']['@attributes']['PROC_HLASU'],
            'nazev' => $celkem['KRAJ'][4]['STRANA'][3]['@attributes']['NAZ_STR']
        ];
        $kscmCheb = [
            'hlasy' => (int)$cheb['OKRES']['HLASY_STRANA'][14]['HODNOTY_STRANA']['@attributes']['HLASY'],
            'prc' => (int)$cheb['OKRES']['HLASY_STRANA'][14]['HODNOTY_STRANA']['@attributes']['PROC_HLASU'],
            'nazev' => $celkem['KRAJ'][4]['STRANA'][14]['@attributes']['NAZ_STR']
        ];
        $cssdCheb = [
            'hlasy' => (int)$cheb['OKRES']['HLASY_STRANA'][4]['HODNOTY_STRANA']['@attributes']['HLASY'],
            'prc' => (int)$cheb['OKRES']['HLASY_STRANA'][4]['HODNOTY_STRANA']['@attributes']['PROC_HLASU'],
            'nazev' => $celkem['KRAJ'][4]['STRANA'][4]['@attributes']['NAZ_STR']
        ];
        $prisahaCheb = [
            'hlasy' => (int)$cheb['OKRES']['HLASY_STRANA'][9]['HODNOTY_STRANA']['@attributes']['HLASY'],
            'prc' => (int)$cheb['OKRES']['HLASY_STRANA'][9]['HODNOTY_STRANA']['@attributes']['PROC_HLASU'],
            'nazev' => $celkem['KRAJ'][4]['STRANA'][9]['@attributes']['NAZ_STR']
        ];
        $zeleniCheb = [
            'hlasy' => (int)$cheb['OKRES']['HLASY_STRANA'][0]['HODNOTY_STRANA']['@attributes']['HLASY'],
            'prc' => (int)$cheb['OKRES']['HLASY_STRANA'][0]['HODNOTY_STRANA']['@attributes']['PROC_HLASU'],
            'nazev' => $celkem['KRAJ'][4]['STRANA'][0]['@attributes']['NAZ_STR']
        ];
        $tssCheb = [
            'hlasy' => (int)$cheb['OKRES']['HLASY_STRANA'][6]['HODNOTY_STRANA']['@attributes']['HLASY'],
            'prc' => (int)$cheb['OKRES']['HLASY_STRANA'][6]['HODNOTY_STRANA']['@attributes']['PROC_HLASU'],
            'nazev' => $celkem['KRAJ'][4]['STRANA'][6]['@attributes']['NAZ_STR']
        ];
        $volnyCheb = [
            'hlasy' => (int)$cheb['OKRES']['HLASY_STRANA'][2]['HODNOTY_STRANA']['@attributes']['HLASY'],
            'prc' => (int)$cheb['OKRES']['HLASY_STRANA'][2]['HODNOTY_STRANA']['@attributes']['PROC_HLASU'],
            'nazev' => $celkem['KRAJ'][4]['STRANA'][2]['@attributes']['NAZ_STR']
        ];

        // Okres Sok

        $ucastSok = [
            'okrsky' => (int)$sok['OKRES']['UCAST']['@attributes']['OKRSKY_CELKEM'],
            'zpracovano' => (int)$sok['OKRES']['UCAST']['@attributes']['OKRSKY_ZPRAC'],
            'zpracovano_prc' => (int)$sok['OKRES']['UCAST']['@attributes']['OKRSKY_ZPRAC_PROC'],
            'ucast' => (int)$sok['OKRES']['UCAST']['@attributes']['UCAST_PROC'],
            'update' => $sok['@attributes']['DATUM_CAS_GENEROVANI']
        ];
        $spoluSok = [
            'hlasy' => (int)$sok['OKRES']['HLASY_STRANA'][10]['HODNOTY_STRANA']['@attributes']['HLASY'],
            'prc' => (int)$sok['OKRES']['HLASY_STRANA'][10]['HODNOTY_STRANA']['@attributes']['PROC_HLASU'],
            'nazev' => $celkem['KRAJ'][4]['STRANA'][10]['@attributes']['NAZ_STR']
        ];
        $pistanSok = [
            'hlasy' => (int)$sok['OKRES']['HLASY_STRANA'][13]['HODNOTY_STRANA']['@attributes']['HLASY'],
            'prc' => (int)$sok['OKRES']['HLASY_STRANA'][13]['HODNOTY_STRANA']['@attributes']['PROC_HLASU'],
            'nazev' => $celkem['KRAJ'][4]['STRANA'][13]['@attributes']['NAZ_STR']
        ];
        $anoSok = [
            'hlasy' => (int)$sok['OKRES']['HLASY_STRANA'][15]['HODNOTY_STRANA']['@attributes']['HLASY'],
            'prc' => (int)$sok['OKRES']['HLASY_STRANA'][15]['HODNOTY_STRANA']['@attributes']['PROC_HLASU'],
            'nazev' => $celkem['KRAJ'][4]['STRANA'][15]['@attributes']['NAZ_STR']
        ];
        $spdSok = [
            'hlasy' => (int)$sok['OKRES']['HLASY_STRANA'][3]['HODNOTY_STRANA']['@attributes']['HLASY'],
            'prc' => (int)$sok['OKRES']['HLASY_STRANA'][3]['HODNOTY_STRANA']['@attributes']['PROC_HLASU'],
            'nazev' => $celkem['KRAJ'][4]['STRANA'][3]['@attributes']['NAZ_STR']
        ];
        $kscmSok = [
            'hlasy' => (int)$sok['OKRES']['HLASY_STRANA'][14]['HODNOTY_STRANA']['@attributes']['HLASY'],
            'prc' => (int)$sok['OKRES']['HLASY_STRANA'][14]['HODNOTY_STRANA']['@attributes']['PROC_HLASU'],
            'nazev' => $celkem['KRAJ'][4]['STRANA'][14]['@attributes']['NAZ_STR']
        ];
        $cssdSok = [
            'hlasy' => (int)$sok['OKRES']['HLASY_STRANA'][4]['HODNOTY_STRANA']['@attributes']['HLASY'],
            'prc' => (int)$sok['OKRES']['HLASY_STRANA'][4]['HODNOTY_STRANA']['@attributes']['PROC_HLASU'],
            'nazev' => $celkem['KRAJ'][4]['STRANA'][4]['@attributes']['NAZ_STR']
        ];
        $prisahaSok = [
            'hlasy' => (int)$sok['OKRES']['HLASY_STRANA'][9]['HODNOTY_STRANA']['@attributes']['HLASY'],
            'prc' => (int)$sok['OKRES']['HLASY_STRANA'][9]['HODNOTY_STRANA']['@attributes']['PROC_HLASU'],
            'nazev' => $celkem['KRAJ'][4]['STRANA'][9]['@attributes']['NAZ_STR']
        ];
        $zeleniSok = [
            'hlasy' => (int)$sok['OKRES']['HLASY_STRANA'][0]['HODNOTY_STRANA']['@attributes']['HLASY'],
            'prc' => (int)$sok['OKRES']['HLASY_STRANA'][0]['HODNOTY_STRANA']['@attributes']['PROC_HLASU'],
            'nazev' => $celkem['KRAJ'][4]['STRANA'][0]['@attributes']['NAZ_STR']
        ];
        $tssSok = [
            'hlasy' => (int)$sok['OKRES']['HLASY_STRANA'][6]['HODNOTY_STRANA']['@attributes']['HLASY'],
            'prc' => (int)$sok['OKRES']['HLASY_STRANA'][6]['HODNOTY_STRANA']['@attributes']['PROC_HLASU'],
            'nazev' => $celkem['KRAJ'][4]['STRANA'][6]['@attributes']['NAZ_STR']
        ];
        $volnySok = [
            'hlasy' => (int)$sok['OKRES']['HLASY_STRANA'][2]['HODNOTY_STRANA']['@attributes']['HLASY'],
            'prc' => (int)$sok['OKRES']['HLASY_STRANA'][2]['HODNOTY_STRANA']['@attributes']['PROC_HLASU'],
            'nazev' => $celkem['KRAJ'][4]['STRANA'][2]['@attributes']['NAZ_STR']
        ];

        // Obce

        $vary = [
            'nazev' => $kv['OBEC'][17]['@attributes']['NAZ_OBEC'],
            'ucast' => [
                'okrsky' => (int)$kv['OBEC'][17]['UCAST']['@attributes']['OKRSKY_CELKEM'],
                'zpracovano' => (int)$kv['OBEC'][17]['UCAST']['@attributes']['OKRSKY_ZPRAC'],
                'zpracovano_prc' => (int)$kv['OBEC'][17]['UCAST']['@attributes']['OKRSKY_ZPRAC_PROC'],
                'ucast' => (int)$kv['OBEC'][17]['UCAST']['@attributes']['UCAST_PROC']
            ],
            // TODO strany
            'strany' => [
                'spolu' => [
                    'hlasy' => (int)$kv['OBEC'][17]['HLASY_STRANA'][10]['HODNOTY_STRANA']['@attributes']['HLASY'],
                    'prc' => (int)$kv['OBEC'][17]['HLASY_STRANA'][10]['HODNOTY_STRANA']['@attributes']['PROC_HLASU'],
                    'nazev' => $celkem['KRAJ'][4]['STRANA'][10]['@attributes']['NAZ_STR']
                ],
                'pistan' => [
                    'hlasy' => (int)$kv['OBEC'][17]['HLASY_STRANA'][13]['HODNOTY_STRANA']['@attributes']['HLASY'],
                    'prc' => (int)$kv['OBEC'][17]['HLASY_STRANA'][13]['HODNOTY_STRANA']['@attributes']['PROC_HLASU'],
                    'nazev' => $celkem['KRAJ'][4]['STRANA'][13]['@attributes']['NAZ_STR']
                ],
                'ano' => [
                    'hlasy' => (int)$kv['OBEC'][17]['HLASY_STRANA'][15]['HODNOTY_STRANA']['@attributes']['HLASY'],
                    'prc' => (int)$kv['OBEC'][17]['HLASY_STRANA'][15]['HODNOTY_STRANA']['@attributes']['PROC_HLASU'],
                    'nazev' => $celkem['KRAJ'][4]['STRANA'][15]['@attributes']['NAZ_STR']
                ],
                'spd' => [
                    'hlasy' => (int)$kv['OBEC'][17]['HLASY_STRANA'][3]['HODNOTY_STRANA']['@attributes']['HLASY'],
                    'prc' => (int)$kv['OBEC'][17]['HLASY_STRANA'][3]['HODNOTY_STRANA']['@attributes']['PROC_HLASU'],
                    'nazev' => $celkem['KRAJ'][4]['STRANA'][3]['@attributes']['NAZ_STR']
                ],
                'kscm' => [
                    'hlasy' => (int)$kv['OBEC'][17]['HLASY_STRANA'][14]['HODNOTY_STRANA']['@attributes']['HLASY'],
                    'prc' => (int)$kv['OBEC'][17]['HLASY_STRANA'][14]['HODNOTY_STRANA']['@attributes']['PROC_HLASU'],
                    'nazev' => $celkem['KRAJ'][4]['STRANA'][14]['@attributes']['NAZ_STR']
                ],
                'cssd' => [
                    'hlasy' => (int)$kv['OBEC'][17]['HLASY_STRANA'][4]['HODNOTY_STRANA']['@attributes']['HLASY'],
                    'prc' => (int)$kv['OBEC'][17]['HLASY_STRANA'][4]['HODNOTY_STRANA']['@attributes']['PROC_HLASU'],
                    'nazev' => $celkem['KRAJ'][4]['STRANA'][4]['@attributes']['NAZ_STR']
                ],
                'prisaha' => [
                    'hlasy' => (int)$kv['OBEC'][17]['HLASY_STRANA'][9]['HODNOTY_STRANA']['@attributes']['HLASY'],
                    'prc' => (int)$kv['OBEC'][17]['HLASY_STRANA'][9]['HODNOTY_STRANA']['@attributes']['PROC_HLASU'],
                    'nazev' => $celkem['KRAJ'][4]['STRANA'][9]['@attributes']['NAZ_STR']
                ],
                'zeleni' => [
                    'hlasy' => (int)$kv['OBEC'][17]['HLASY_STRANA'][0]['HODNOTY_STRANA']['@attributes']['HLASY'],
                    'prc' => (int)$kv['OBEC'][17]['HLASY_STRANA'][0]['HODNOTY_STRANA']['@attributes']['PROC_HLASU'],
                    'nazev' => $celkem['KRAJ'][4]['STRANA'][0]['@attributes']['NAZ_STR']
                ],
                'tss' => [
                    'hlasy' => (int)$kv['OBEC'][17]['HLASY_STRANA'][6]['HODNOTY_STRANA']['@attributes']['HLASY'],
                    'prc' => (int)$kv['OBEC'][17]['HLASY_STRANA'][6]['HODNOTY_STRANA']['@attributes']['PROC_HLASU'],
                    'nazev' => $celkem['KRAJ'][4]['STRANA'][6]['@attributes']['NAZ_STR']
                ],
                'volny' => [
                    'hlasy' => (int)$kv['OBEC'][17]['HLASY_STRANA'][2]['HODNOTY_STRANA']['@attributes']['HLASY'],
                    'prc' => (int)$kv['OBEC'][17]['HLASY_STRANA'][2]['HODNOTY_STRANA']['@attributes']['PROC_HLASU'],
                    'nazev' => $celkem['KRAJ'][4]['STRANA'][2]['@attributes']['NAZ_STR']
                ]
            ]
        ];
        $sokolov = [
            'nazev' => $sok['OBEC'][6]['@attributes']['NAZ_OBEC'],
            'ucast' => [
                'okrsky' => (int)$sok['OBEC'][6]['UCAST']['@attributes']['OKRSKY_CELKEM'],
                'zpracovano' => (int)$sok['OBEC'][6]['UCAST']['@attributes']['OKRSKY_ZPRAC'],
                'zpracovano_prc' => (int)['OBEC'][6]['UCAST']['@attributes']['OKRSKY_ZPRAC_PROC'],
                'ucast' => (int)['OBEC'][6]['UCAST']['@attributes']['UCAST_PROC']
            ],
            // TODO strany
            'strany' => [
                'spolu' => [
                    'hlasy' => (int)$sok['OBEC'][6]['HLASY_STRANA'][10]['HODNOTY_STRANA']['@attributes']['HLASY'],
                    'prc' => (int)$sok['OBEC'][6]['HLASY_STRANA'][10]['HODNOTY_STRANA']['@attributes']['PROC_HLASU'],
                    'nazev' => $celkem['KRAJ'][4]['STRANA'][10]['@attributes']['NAZ_STR']
                ],
                'pistan' => [
                    'hlasy' => (int)$sok['OBEC'][6]['HLASY_STRANA'][13]['HODNOTY_STRANA']['@attributes']['HLASY'],
                    'prc' => (int)$sok['OBEC'][6]['HLASY_STRANA'][13]['HODNOTY_STRANA']['@attributes']['PROC_HLASU'],
                    'nazev' => $celkem['KRAJ'][4]['STRANA'][13]['@attributes']['NAZ_STR']
                ],
                'ano' => [
                    'hlasy' => (int)$sok['OBEC'][6]['HLASY_STRANA'][15]['HODNOTY_STRANA']['@attributes']['HLASY'],
                    'prc' => (int)$sok['OBEC'][6]['HLASY_STRANA'][15]['HODNOTY_STRANA']['@attributes']['PROC_HLASU'],
                    'nazev' => $celkem['KRAJ'][4]['STRANA'][15]['@attributes']['NAZ_STR']
                ],
                'spd' => [
                    'hlasy' => (int)$sok['OBEC'][6]['HLASY_STRANA'][3]['HODNOTY_STRANA']['@attributes']['HLASY'],
                    'prc' => (int)$sok['OBEC'][6]['HLASY_STRANA'][3]['HODNOTY_STRANA']['@attributes']['PROC_HLASU'],
                    'nazev' => $celkem['KRAJ'][4]['STRANA'][3]['@attributes']['NAZ_STR']
                ],
                'kscm' => [
                    'hlasy' => (int)$sok['OBEC'][6]['HLASY_STRANA'][14]['HODNOTY_STRANA']['@attributes']['HLASY'],
                    'prc' => (int)$sok['OBEC'][6]['HLASY_STRANA'][14]['HODNOTY_STRANA']['@attributes']['PROC_HLASU'],
                    'nazev' => $celkem['KRAJ'][4]['STRANA'][14]['@attributes']['NAZ_STR']
                ],
                'cssd' => [
                    'hlasy' => (int)$sok['OBEC'][6]['HLASY_STRANA'][4]['HODNOTY_STRANA']['@attributes']['HLASY'],
                    'prc' => (int)$sok['OBEC'][6]['HLASY_STRANA'][4]['HODNOTY_STRANA']['@attributes']['PROC_HLASU'],
                    'nazev' => $celkem['KRAJ'][4]['STRANA'][4]['@attributes']['NAZ_STR']
                ],
                'prisaha' => [
                    'hlasy' => (int)$sok['OBEC'][6]['HLASY_STRANA'][9]['HODNOTY_STRANA']['@attributes']['HLASY'],
                    'prc' => (int)$sok['OBEC'][6]['HLASY_STRANA'][9]['HODNOTY_STRANA']['@attributes']['PROC_HLASU'],
                    'nazev' => $celkem['KRAJ'][4]['STRANA'][9]['@attributes']['NAZ_STR']
                ],
                'zeleni' => [
                    'hlasy' => (int)$sok['OBEC'][6]['HLASY_STRANA'][0]['HODNOTY_STRANA']['@attributes']['HLASY'],
                    'prc' => (int)$sok['OBEC'][6]['HLASY_STRANA'][0]['HODNOTY_STRANA']['@attributes']['PROC_HLASU'],
                    'nazev' => $celkem['KRAJ'][4]['STRANA'][0]['@attributes']['NAZ_STR']
                ],
                'tss' => [
                    'hlasy' => (int)$sok['OBEC'][6]['HLASY_STRANA'][6]['HODNOTY_STRANA']['@attributes']['HLASY'],
                    'prc' => (int)$sok['OBEC'][6]['HLASY_STRANA'][6]['HODNOTY_STRANA']['@attributes']['PROC_HLASU'],
                    'nazev' => $celkem['KRAJ'][4]['STRANA'][6]['@attributes']['NAZ_STR']
                ],
                'volny' => [
                    'hlasy' => (int)$sok['OBEC'][6]['HLASY_STRANA'][2]['HODNOTY_STRANA']['@attributes']['HLASY'],
                    'prc' => (int)$sok['OBEC'][6]['HLASY_STRANA'][2]['HODNOTY_STRANA']['@attributes']['PROC_HLASU'],
                    'nazev' => $celkem['KRAJ'][4]['STRANA'][2]['@attributes']['NAZ_STR']
                ]
            ]
        ];
        $chebM = [
            'nazev' => $cheb['OBEC'][16]['@attributes']['NAZ_OBEC'],
            'ucast' => [
                'okrsky' => (int)$cheb['OBEC'][16]['UCAST']['@attributes']['OKRSKY_CELKEM'],
                'zpracovano' => (int)$cheb['OBEC'][16]['UCAST']['@attributes']['OKRSKY_ZPRAC'],
                'zpracovano_prc' => (int)['OBEC'][16]['UCAST']['@attributes']['OKRSKY_ZPRAC_PROC'],
                'ucast' => (int)['OBEC'][16]['UCAST']['@attributes']['UCAST_PROC']
            ],
            // TODO strany
            'strany' => [
                'spolu' => [
                    'hlasy' => (int)$cheb['OBEC'][16]['HLASY_STRANA'][10]['HODNOTY_STRANA']['@attributes']['HLASY'],
                    'prc' => (int)$cheb['OBEC'][16]['HLASY_STRANA'][10]['HODNOTY_STRANA']['@attributes']['PROC_HLASU'],
                    'nazev' => $celkem['KRAJ'][4]['STRANA'][10]['@attributes']['NAZ_STR']
                ],
                'pistan' => [
                    'hlasy' => (int)$cheb['OBEC'][16]['HLASY_STRANA'][13]['HODNOTY_STRANA']['@attributes']['HLASY'],
                    'prc' => (int)$cheb['OBEC'][16]['HLASY_STRANA'][13]['HODNOTY_STRANA']['@attributes']['PROC_HLASU'],
                    'nazev' => $celkem['KRAJ'][4]['STRANA'][13]['@attributes']['NAZ_STR']
                ],
                'ano' => [
                    'hlasy' => (int)$cheb['OBEC'][16]['HLASY_STRANA'][15]['HODNOTY_STRANA']['@attributes']['HLASY'],
                    'prc' => (int)$cheb['OBEC'][16]['HLASY_STRANA'][15]['HODNOTY_STRANA']['@attributes']['PROC_HLASU'],
                    'nazev' => $celkem['KRAJ'][4]['STRANA'][15]['@attributes']['NAZ_STR']
                ],
                'spd' => [
                    'hlasy' => (int)$cheb['OBEC'][16]['HLASY_STRANA'][3]['HODNOTY_STRANA']['@attributes']['HLASY'],
                    'prc' => (int)$cheb['OBEC'][16]['HLASY_STRANA'][3]['HODNOTY_STRANA']['@attributes']['PROC_HLASU'],
                    'nazev' => $celkem['KRAJ'][4]['STRANA'][3]['@attributes']['NAZ_STR']
                ],
                'kscm' => [
                    'hlasy' => (int)$cheb['OBEC'][16]['HLASY_STRANA'][14]['HODNOTY_STRANA']['@attributes']['HLASY'],
                    'prc' => (int)$cheb['OBEC'][16]['HLASY_STRANA'][14]['HODNOTY_STRANA']['@attributes']['PROC_HLASU'],
                    'nazev' => $celkem['KRAJ'][4]['STRANA'][14]['@attributes']['NAZ_STR']
                ],
                'cssd' => [
                    'hlasy' => (int)$cheb['OBEC'][16]['HLASY_STRANA'][4]['HODNOTY_STRANA']['@attributes']['HLASY'],
                    'prc' => (int)$cheb['OBEC'][16]['HLASY_STRANA'][4]['HODNOTY_STRANA']['@attributes']['PROC_HLASU'],
                    'nazev' => $celkem['KRAJ'][4]['STRANA'][4]['@attributes']['NAZ_STR']
                ],
                'prisaha' => [
                    'hlasy' => (int)$cheb['OBEC'][16]['HLASY_STRANA'][9]['HODNOTY_STRANA']['@attributes']['HLASY'],
                    'prc' => (int)$cheb['OBEC'][16]['HLASY_STRANA'][9]['HODNOTY_STRANA']['@attributes']['PROC_HLASU'],
                    'nazev' => $celkem['KRAJ'][4]['STRANA'][9]['@attributes']['NAZ_STR']
                ],
                'zeleni' => [
                    'hlasy' => (int)$cheb['OBEC'][16]['HLASY_STRANA'][0]['HODNOTY_STRANA']['@attributes']['HLASY'],
                    'prc' => (int)$cheb['OBEC'][16]['HLASY_STRANA'][0]['HODNOTY_STRANA']['@attributes']['PROC_HLASU'],
                    'nazev' => $celkem['KRAJ'][4]['STRANA'][0]['@attributes']['NAZ_STR']
                ],
                'tss' => [
                    'hlasy' => (int)$cheb['OBEC'][16]['HLASY_STRANA'][6]['HODNOTY_STRANA']['@attributes']['HLASY'],
                    'prc' => (int)$cheb['OBEC'][16]['HLASY_STRANA'][6]['HODNOTY_STRANA']['@attributes']['PROC_HLASU'],
                    'nazev' => $celkem['KRAJ'][4]['STRANA'][6]['@attributes']['NAZ_STR']
                ],
                'volny' => [
                    'hlasy' => (int)$cheb['OBEC'][16]['HLASY_STRANA'][2]['HODNOTY_STRANA']['@attributes']['HLASY'],
                    'prc' => (int)$cheb['OBEC'][16]['HLASY_STRANA'][2]['HODNOTY_STRANA']['@attributes']['PROC_HLASU'],
                    'nazev' => $celkem['KRAJ'][4]['STRANA'][2]['@attributes']['NAZ_STR']
                ]
            ]
        ];
        $zlutice = [
            'nazev' => $kv['OBEC'][49]['@attributes']['NAZ_OBEC'],
            'ucast' => [
                'okrsky' => (int)$kv['OBEC'][49]['UCAST']['@attributes']['OKRSKY_CELKEM'],
                'zpracovano' => (int)$kv['OBEC'][49]['UCAST']['@attributes']['OKRSKY_ZPRAC'],
                'zpracovano_prc' => (int)['OBEC'][49]['UCAST']['@attributes']['OKRSKY_ZPRAC_PROC'],
                'ucast' => (int)['OBEC'][49]['UCAST']['@attributes']['UCAST_PROC']
            ],
            // TODO strany
            'strany' => [
                'spolu' => [
                    'hlasy' => (int)$kv['OBEC'][17]['HLASY_STRANA'][10]['HODNOTY_STRANA']['@attributes']['HLASY'],
                    'prc' => (int)$kv['OBEC'][17]['HLASY_STRANA'][10]['HODNOTY_STRANA']['@attributes']['PROC_HLASU'],
                    'nazev' => $celkem['KRAJ'][4]['STRANA'][10]['@attributes']['NAZ_STR']
                ],
                'pistan' => [
                    'hlasy' => (int)$kv['OBEC'][17]['HLASY_STRANA'][13]['HODNOTY_STRANA']['@attributes']['HLASY'],
                    'prc' => (int)$kv['OBEC'][17]['HLASY_STRANA'][13]['HODNOTY_STRANA']['@attributes']['PROC_HLASU'],
                    'nazev' => $celkem['KRAJ'][4]['STRANA'][13]['@attributes']['NAZ_STR']
                ],
                'ano' => [
                    'hlasy' => (int)$kv['OBEC'][17]['HLASY_STRANA'][15]['HODNOTY_STRANA']['@attributes']['HLASY'],
                    'prc' => (int)$kv['OBEC'][17]['HLASY_STRANA'][15]['HODNOTY_STRANA']['@attributes']['PROC_HLASU'],
                    'nazev' => $celkem['KRAJ'][4]['STRANA'][15]['@attributes']['NAZ_STR']
                ],
                'spd' => [
                    'hlasy' => (int)$kv['OBEC'][17]['HLASY_STRANA'][3]['HODNOTY_STRANA']['@attributes']['HLASY'],
                    'prc' => (int)$kv['OBEC'][17]['HLASY_STRANA'][3]['HODNOTY_STRANA']['@attributes']['PROC_HLASU'],
                    'nazev' => $celkem['KRAJ'][4]['STRANA'][3]['@attributes']['NAZ_STR']
                ],
                'kscm' => [
                    'hlasy' => (int)$kv['OBEC'][17]['HLASY_STRANA'][14]['HODNOTY_STRANA']['@attributes']['HLASY'],
                    'prc' => (int)$kv['OBEC'][17]['HLASY_STRANA'][14]['HODNOTY_STRANA']['@attributes']['PROC_HLASU'],
                    'nazev' => $celkem['KRAJ'][4]['STRANA'][14]['@attributes']['NAZ_STR']
                ],
                'cssd' => [
                    'hlasy' => (int)$kv['OBEC'][17]['HLASY_STRANA'][4]['HODNOTY_STRANA']['@attributes']['HLASY'],
                    'prc' => (int)$kv['OBEC'][17]['HLASY_STRANA'][4]['HODNOTY_STRANA']['@attributes']['PROC_HLASU'],
                    'nazev' => $celkem['KRAJ'][4]['STRANA'][4]['@attributes']['NAZ_STR']
                ],
                'prisaha' => [
                    'hlasy' => (int)$kv['OBEC'][17]['HLASY_STRANA'][9]['HODNOTY_STRANA']['@attributes']['HLASY'],
                    'prc' => (int)$kv['OBEC'][17]['HLASY_STRANA'][9]['HODNOTY_STRANA']['@attributes']['PROC_HLASU'],
                    'nazev' => $celkem['KRAJ'][4]['STRANA'][9]['@attributes']['NAZ_STR']
                ],
                'zeleni' => [
                    'hlasy' => (int)$kv['OBEC'][17]['HLASY_STRANA'][0]['HODNOTY_STRANA']['@attributes']['HLASY'],
                    'prc' => (int)$kv['OBEC'][17]['HLASY_STRANA'][0]['HODNOTY_STRANA']['@attributes']['PROC_HLASU'],
                    'nazev' => $celkem['KRAJ'][4]['STRANA'][0]['@attributes']['NAZ_STR']
                ],
                'tss' => [
                    'hlasy' => (int)$kv['OBEC'][17]['HLASY_STRANA'][6]['HODNOTY_STRANA']['@attributes']['HLASY'],
                    'prc' => (int)$kv['OBEC'][17]['HLASY_STRANA'][6]['HODNOTY_STRANA']['@attributes']['PROC_HLASU'],
                    'nazev' => $celkem['KRAJ'][4]['STRANA'][6]['@attributes']['NAZ_STR']
                ],
                'volny' => [
                    'hlasy' => (int)$kv['OBEC'][17]['HLASY_STRANA'][2]['HODNOTY_STRANA']['@attributes']['HLASY'],
                    'prc' => (int)$kv['OBEC'][17]['HLASY_STRANA'][2]['HODNOTY_STRANA']['@attributes']['PROC_HLASU'],
                    'nazev' => $celkem['KRAJ'][4]['STRANA'][2]['@attributes']['NAZ_STR']
                ]
            ]
        ];
        $ostrov = [
            'nazev' => $kv['OBEC'][32]['@attributes']['NAZ_OBEC'],
            'ucast' => [
                'okrsky' => (int)$kv['OBEC'][32]['UCAST']['@attributes']['OKRSKY_CELKEM'],
                'zpracovano' => (int)$kv['OBEC'][32]['UCAST']['@attributes']['OKRSKY_ZPRAC'],
                'zpracovano_prc' => (int)['OBEC'][32]['UCAST']['@attributes']['OKRSKY_ZPRAC_PROC'],
                'ucast' => (int)['OBEC'][32]['UCAST']['@attributes']['UCAST_PROC']
            ],
            // TODO strany
            'strany' => [
                'spolu' => [
                    'hlasy' => (int)$kv['OBEC'][32]['HLASY_STRANA'][10]['HODNOTY_STRANA']['@attributes']['HLASY'],
                    'prc' => (int)$kv['OBEC'][32]['HLASY_STRANA'][10]['HODNOTY_STRANA']['@attributes']['PROC_HLASU'],
                    'nazev' => $celkem['KRAJ'][4]['STRANA'][10]['@attributes']['NAZ_STR']
                ],
                'pistan' => [
                    'hlasy' => (int)$kv['OBEC'][32]['HLASY_STRANA'][13]['HODNOTY_STRANA']['@attributes']['HLASY'],
                    'prc' => (int)$kv['OBEC'][32]['HLASY_STRANA'][13]['HODNOTY_STRANA']['@attributes']['PROC_HLASU'],
                    'nazev' => $celkem['KRAJ'][4]['STRANA'][13]['@attributes']['NAZ_STR']
                ],
                'ano' => [
                    'hlasy' => (int)$kv['OBEC'][32]['HLASY_STRANA'][15]['HODNOTY_STRANA']['@attributes']['HLASY'],
                    'prc' => (int)$kv['OBEC'][32]['HLASY_STRANA'][15]['HODNOTY_STRANA']['@attributes']['PROC_HLASU'],
                    'nazev' => $celkem['KRAJ'][4]['STRANA'][15]['@attributes']['NAZ_STR']
                ],
                'spd' => [
                    'hlasy' => (int)$kv['OBEC'][32]['HLASY_STRANA'][3]['HODNOTY_STRANA']['@attributes']['HLASY'],
                    'prc' => (int)$kv['OBEC'][32]['HLASY_STRANA'][3]['HODNOTY_STRANA']['@attributes']['PROC_HLASU'],
                    'nazev' => $celkem['KRAJ'][4]['STRANA'][3]['@attributes']['NAZ_STR']
                ],
                'kscm' => [
                    'hlasy' => (int)$kv['OBEC'][32]['HLASY_STRANA'][14]['HODNOTY_STRANA']['@attributes']['HLASY'],
                    'prc' => (int)$kv['OBEC'][32]['HLASY_STRANA'][14]['HODNOTY_STRANA']['@attributes']['PROC_HLASU'],
                    'nazev' => $celkem['KRAJ'][4]['STRANA'][14]['@attributes']['NAZ_STR']
                ],
                'cssd' => [
                    'hlasy' => (int)$kv['OBEC'][32]['HLASY_STRANA'][4]['HODNOTY_STRANA']['@attributes']['HLASY'],
                    'prc' => (int)$kv['OBEC'][32]['HLASY_STRANA'][4]['HODNOTY_STRANA']['@attributes']['PROC_HLASU'],
                    'nazev' => $celkem['KRAJ'][4]['STRANA'][4]['@attributes']['NAZ_STR']
                ],
                'prisaha' => [
                    'hlasy' => (int)$kv['OBEC'][32]['HLASY_STRANA'][9]['HODNOTY_STRANA']['@attributes']['HLASY'],
                    'prc' => (int)$kv['OBEC'][32]['HLASY_STRANA'][9]['HODNOTY_STRANA']['@attributes']['PROC_HLASU'],
                    'nazev' => $celkem['KRAJ'][4]['STRANA'][9]['@attributes']['NAZ_STR']
                ],
                'zeleni' => [
                    'hlasy' => (int)$kv['OBEC'][32]['HLASY_STRANA'][0]['HODNOTY_STRANA']['@attributes']['HLASY'],
                    'prc' => (int)$kv['OBEC'][32]['HLASY_STRANA'][0]['HODNOTY_STRANA']['@attributes']['PROC_HLASU'],
                    'nazev' => $celkem['KRAJ'][4]['STRANA'][0]['@attributes']['NAZ_STR']
                ],
                'tss' => [
                    'hlasy' => (int)$kv['OBEC'][32]['HLASY_STRANA'][6]['HODNOTY_STRANA']['@attributes']['HLASY'],
                    'prc' => (int)$kv['OBEC'][32]['HLASY_STRANA'][6]['HODNOTY_STRANA']['@attributes']['PROC_HLASU'],
                    'nazev' => $celkem['KRAJ'][4]['STRANA'][6]['@attributes']['NAZ_STR']
                ],
                'volny' => [
                    'hlasy' => (int)$kv['OBEC'][32]['HLASY_STRANA'][2]['HODNOTY_STRANA']['@attributes']['HLASY'],
                    'prc' => (int)$kv['OBEC'][32]['HLASY_STRANA'][2]['HODNOTY_STRANA']['@attributes']['PROC_HLASU'],
                    'nazev' => $celkem['KRAJ'][4]['STRANA'][2]['@attributes']['NAZ_STR']
                ]
            ]
        ];

        // Preferenční hlasy
        foreach ($kandidati['PS_REGKAND_ROW'] as $kandidat) {
            if ($kandidat['VOLKRAJ'] == 5) {
                if ($kandidat['KSTRANA'] == 13) {
                    $lidiSpolu[$kandidat['PORCISLO']] = [
                        'titul' => $kandidat['TITULPRED'],
                        'jmeno' => $kandidat['JMENO'],
                        'prijmeni' => $kandidat['PRIJMENI'],
                        'poradoveCislo' => $kandidat['PORCISLO'],
                        'pocetHlasu' => $kandidat['POCHLASU'],
                        'procentoHlasu' => $kandidat['POCPROC'],
                        'mandat' => $kandidat['MANDAT'],
                        'skrutinium' => $kandidat['SKRUTINIUM'],
                        'poradiMandatu' => $kandidat['PORADIMAND'],
                        'poradiNahradnika' => $kandidat['PORADINAHR']
                    ];
                } else if ($kandidat['KSTRANA'] == 17) {
                    $lidiPistan[$kandidat['PORCISLO']] = [
                        'titul' => $kandidat['TITULPRED'],
                        'jmeno' => $kandidat['JMENO'],
                        'prijmeni' => $kandidat['PRIJMENI'],
                        'poradoveCislo' => $kandidat['PORCISLO'],
                        'pocetHlasu' => $kandidat['POCHLASU'],
                        'procentoHlasu' => $kandidat['POCPROC'],
                        'mandat' => $kandidat['MANDAT'],
                        'skrutinium' => $kandidat['SKRUTINIUM'],
                        'poradiMandatu' => $kandidat['PORADIMAND'],
                        'poradiNahradnika' => $kandidat['PORADINAHR']
                    ];
                } else if ($kandidat['KSTRANA'] == 20) {
                    $lidiAno[$kandidat['PORCISLO']] = [
                        'titul' => $kandidat['TITULPRED'],
                        'jmeno' => $kandidat['JMENO'],
                        'prijmeni' => $kandidat['PRIJMENI'],
                        'poradoveCislo' => $kandidat['PORCISLO'],
                        'pocetHlasu' => $kandidat['POCHLASU'],
                        'procentoHlasu' => $kandidat['POCPROC'],
                        'mandat' => $kandidat['MANDAT'],
                        'skrutinium' => $kandidat['SKRUTINIUM'],
                        'poradiMandatu' => $kandidat['PORADIMAND'],
                        'poradiNahradnika' => $kandidat['PORADINAHR']
                    ];
                } else if ($kandidat['KSTRANA'] == 4) {
                    $lidiSpd[$kandidat['PORCISLO']] = [
                        'titul' => $kandidat['TITULPRED'],
                        'jmeno' => $kandidat['JMENO'],
                        'prijmeni' => $kandidat['PRIJMENI'],
                        'poradoveCislo' => $kandidat['PORCISLO'],
                        'pocetHlasu' => $kandidat['POCHLASU'],
                        'procentoHlasu' => $kandidat['POCPROC'],
                        'mandat' => $kandidat['MANDAT'],
                        'skrutinium' => $kandidat['SKRUTINIUM'],
                        'poradiMandatu' => $kandidat['PORADIMAND'],
                        'poradiNahradnika' => $kandidat['PORADINAHR']
                    ];
                }
            }
        }

        //TODO procento hlasů
        if ($hlasy['KRAJ'][4]['KANDIDATI']['KANDIDAT'] != null) {
            foreach ($hlasy['KRAJ'][4]['KANDIDATI']['KANDIDAT'] as $kandidat2) {
                $kandidat = $kandidat2['@attributes'];
                if ($kandidat['KSTRANA'] == 13) {
                    $lidiSpolu[$kandidat['PORCISLO']]['pocetHlasu'] = $kandidat['HLASY'];
                } else if ($kandidat['KSTRANA'] == 17) {
                    $lidiPistan[$kandidat['PORCISLO']]['pocetHlasu'] = $kandidat['HLASY'];
                } elseif ($kandidat['KSTRANA'] == 20) {
                    $lidiAno[$kandidat['PORCISLO']]['pocetHlasu'] = $kandidat['HLASY'];
                } elseif ($kandidat['KSTRANA'] == 4) {
                    $lidiSpd[$kandidat['PORCISLO']]['pocetHlasu'] = $kandidat['HLASY'];
                }
            }
        }


        $save = [
            'cr' => [
                'ucast' => $ucastCr,
                'spolu' => $spoluCr,
                'pistan' => $pistanCr,
                'ano' => $anoCr,
                'spd' => $spdCr,
                'kscm' => $kscmCr,
                'cssd' => $cssdCr,
                'prisaha' => $prisahaCr,
                'tss' => $tssCr,
                'zeleni' => $zeleniCr,
                'volny' => $volnyCr
            ],
            'kraj' => [
                'ucast' => $ucastKVK,
                'spolu' => $spoluKVK,
                'pistan' => $pistanKVK,
                'ano' => $anoKVK,
                'spd' => $spdKVK,
                'kscm' => $kscmKVK,
                'cssd' => $cssdKVK,
                'prisaha' => $prisahaKVK,
                'tss' => $tssKVK,
                'zeleni' => $zeleniKVK,
                'volny' => $volnyKVK
            ],
            'okresKV' => [
                'ucast' => $ucastKV,
                'spolu' => $spoluKV,
                'pistan' => $pistanKV,
                'ano' => $anoKV,
                'spd' => $spdKV,
                'kscm' => $kscmKV,
                'cssd' => $cssdKV,
                'prisaha' => $prisahaKV,
                'tss' => $tssKV,
                'zeleni' => $zeleniKV,
                'volny' => $volnyKV
            ],
            'okresCheb' => [
                'ucast' => $ucastCheb,
                'spolu' => $spoluCheb,
                'pistan' => $pistanCheb,
                'ano' => $anoCheb,
                'spd' => $spdCheb,
                'kscm' => $kscmCheb,
                'cssd' => $cssdCheb,
                'prisaha' => $prisahaCheb,
                'tss' => $tssCheb,
                'zeleni' => $zeleniCheb,
                'volny' => $volnyCheb
            ],
            'okresSok' => [
                'ucast' => $ucastSok,
                'spolu' => $spoluSok,
                'pistan' => $pistanSok,
                'ano' => $anoSok,
                'spd' => $spdSok,
                'kscm' => $kscmSok,
                'cssd' => $cssdSok,
                'prisaha' => $prisahaSok,
                'tss' => $tssSok,
                'zeleni' => $zeleniSok,
                'volny' => $volnySok
            ],
            'vary' => $vary,
            'cheb' => $chebM,
            'sokolov' => $sokolov,
            'zlutice' => $zlutice,
            'ostrov' => $ostrov,
            'lidiSpolu' => $lidiSpolu,
            'lidiPistan' => $lidiPistan,
            'lidiAno' => $lidiAno,
            'lidiSpd' => $lidiSpd
        ];

        $finalJSON = json_encode($save, JSON_PRETTY_PRINT);
        $jsonFile = fopen(__DIR__ . '/source.json', 'w');
        fwrite($jsonFile, $finalJSON);
        fclose($jsonFile);
    } else {
        echo 'bad key';
    }
} else {
    echo 'no key';
}
