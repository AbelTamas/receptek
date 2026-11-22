<?php
require_once 'config.php';

/**
 * Évszak meghatározása hónap alapján (1..12).
 */
function detectSeasonByMonth(int $month): string
{
    return match (true) {
        in_array($month, [3, 4, 5], true) => 'tavasz',
        in_array($month, [6, 7, 8], true) => 'nyar',
        in_array($month, [9, 10, 11], true) => 'osz',
        default => 'tel',
    };
}

/**
 * Évszakok metaadatai (magyar név, címke, hangulat).
 */
function getSeasonMeta(string $season): array
{
    $seasons = [
        'tavasz' => [
            'key' => 'tavasz',
            'label' => 'Tavasz',
            'badge' => 'Zsenge tavaszi válogatás',
            'subtitle' => 'Medvehagyma, retek, spárga, eper és könnyedebb fogások a 4 forrásból.',
        ],
        'nyar' => [
            'key' => 'nyar',
            'label' => 'Nyár',
            'badge' => 'Napfényes nyári válogatás',
            'subtitle' => 'Cukkini, paradicsom, paprika, lecsó, hideg levesek és frissítő ételek.',
        ],
        'osz' => [
            'key' => 'osz',
            'label' => 'Ősz',
            'badge' => 'Melankolikus-finom őszi válogatás',
            'subtitle' => 'Sütőtök, káposzta, gomba, alma, szilva és melegítő egytálételek.',
        ],
        'tel' => [
            'key' => 'tel',
            'label' => 'Tél',
            'badge' => 'Bekuckózós téli válogatás',
            'subtitle' => 'Tartalmas levesek, sültek, káposztás és fűszeres fogások a hideg napokra.',
        ],
    ];

    return $seasons[$season] ?? $seasons['osz'];
}

/**
 * 4 forrás × 5 recept évszakonként.
 */
function getSeasonalRecommendations(string $season): array
{
    $data = [
        'tavasz' => [
            'sobros' => [
                ['title' => 'Medvehagymás krémleves pirított magvakkal', 'meatless' => true, 'tag' => 'Tavasz', 'query' => 'medvehagyma leves'],
                ['title' => 'Zöldspárgás tészta citrommal és sajttal', 'meatless' => true, 'tag' => 'Tavasz', 'query' => 'zöldspárga tészta'],
                ['title' => 'Tavaszi zöldséges csirkeragu', 'meatless' => false, 'tag' => 'Tavasz', 'query' => 'tavaszi csirke zöldség'],
                ['title' => 'Retkes-tojásos tavaszi saláta', 'meatless' => true, 'tag' => 'Tavasz', 'query' => 'retek tojás saláta'],
                ['title' => 'Epres túrótorta sütés nélkül', 'meatless' => true, 'tag' => 'Édes', 'query' => 'epres túrótorta'],
            ],
            'nosalty' => [
                ['title' => 'Medvehagymás pogácsa', 'meatless' => true, 'tag' => 'Tavasz', 'query' => 'medvehagyma'],
                ['title' => 'Rakott zöldbab újburgonyával', 'meatless' => true, 'tag' => 'Tavasz', 'query' => 'zöldbab'],
                ['title' => 'Tavaszi zöldségleves csipetkével', 'meatless' => true, 'tag' => 'Tavasz', 'query' => 'zöldségleves'],
                ['title' => 'Fokhagymás-petrezselymes csirkemell', 'meatless' => false, 'tag' => 'Tavasz', 'query' => 'csirkemell'],
                ['title' => 'Epres piskóta', 'meatless' => true, 'tag' => 'Édes', 'query' => 'eper'],
            ],
            'streetkitchen' => [
                ['title' => 'A legkrémesebb medvehagymaleves', 'meatless' => true, 'tag' => 'Tavasz', 'query' => 'medvehagyma leves'],
                ['title' => 'Spárgás-ricottás galuska', 'meatless' => true, 'tag' => 'Tavasz', 'query' => 'spárga galuska'],
                ['title' => 'Tavaszi zöldséges rizottó', 'meatless' => true, 'tag' => 'Tavasz', 'query' => 'zöldséges rizottó'],
                ['title' => 'Fűszeres tavaszi csirkecomb', 'meatless' => false, 'tag' => 'Tavasz', 'query' => 'csirkecomb'],
                ['title' => 'Epres-mascarponés pohárkrém', 'meatless' => true, 'tag' => 'Édes', 'query' => 'epres pohárkrém'],
            ],
            'mindmegette' => [
                ['title' => 'Medvehagymás-sajtos stangli', 'meatless' => true, 'tag' => 'Tavasz', 'query' => 'medvehagymás stangli'],
                ['title' => 'Újburgonyás-petrezselymes főzelék', 'meatless' => true, 'tag' => 'Tavasz', 'query' => 'újburgonya főzelék'],
                ['title' => 'Tavaszi zöldséges pite', 'meatless' => true, 'tag' => 'Tavasz', 'query' => 'zöldséges pite'],
                ['title' => 'Tepsis tavaszi csirke zöldségekkel', 'meatless' => false, 'tag' => 'Tavasz', 'query' => 'tepsis csirke zöldség'],
                ['title' => 'Gyors epres kevert süti', 'meatless' => true, 'tag' => 'Édes', 'query' => 'epres kevert süti'],
            ],
        ],
        'nyar' => [
            'sobros' => [
                ['title' => 'Lecsó cukkinivel és friss paradicsommal', 'meatless' => true, 'tag' => 'Nyár', 'query' => 'lecsó cukkini'],
                ['title' => 'Hideg uborkakrémleves kaporral', 'meatless' => true, 'tag' => 'Nyár', 'query' => 'uborkakrémleves'],
                ['title' => 'Grillezett cukkinis-fetás tésztasaláta', 'meatless' => true, 'tag' => 'Nyár', 'query' => 'cukkini feta tészta'],
                ['title' => 'Nyári zöldséges csirke nyárs', 'meatless' => false, 'tag' => 'Nyár', 'query' => 'csirke nyárs'],
                ['title' => 'Barackos-joghurtos pite', 'meatless' => true, 'tag' => 'Édes', 'query' => 'barackos pite'],
            ],
            'nosalty' => [
                ['title' => 'Töltött paprika', 'meatless' => false, 'tag' => 'Nyár', 'query' => 'paprika'],
                ['title' => 'Cukkinis tócsni', 'meatless' => true, 'tag' => 'Nyár', 'query' => 'cukkini'],
                ['title' => 'Meggyes rétes', 'meatless' => true, 'tag' => 'Nyár', 'query' => 'meggy'],
                ['title' => 'Paradicsomleves betűtésztával', 'meatless' => true, 'tag' => 'Nyár', 'query' => 'paradicsom'],
                ['title' => 'Görögdinnyés saláta', 'meatless' => true, 'tag' => 'Friss', 'query' => 'dinnye'],
            ],
            'streetkitchen' => [
                ['title' => 'A legjobb nyári lecsó', 'meatless' => true, 'tag' => 'Nyár', 'query' => 'lecsó'],
                ['title' => 'Cukkinis-citromos spagetti', 'meatless' => true, 'tag' => 'Nyár', 'query' => 'cukkini spagetti'],
                ['title' => 'Gazpacho hideg paradicsomleves', 'meatless' => true, 'tag' => 'Nyár', 'query' => 'gazpacho'],
                ['title' => 'Nyári grillezett sertéskaraj', 'meatless' => false, 'tag' => 'Nyár', 'query' => 'grillezett karaj'],
                ['title' => 'Őszibarackos crumble', 'meatless' => true, 'tag' => 'Édes', 'query' => 'barack crumble'],
            ],
            'mindmegette' => [
                ['title' => 'Rántott cukkini kapros mártással', 'meatless' => true, 'tag' => 'Nyár', 'query' => 'rántott cukkini'],
                ['title' => 'Tökfőzelék friss kaporral', 'meatless' => true, 'tag' => 'Nyár', 'query' => 'tökfőzelék'],
                ['title' => 'Paradicsomos-mozzarellás tésztasaláta', 'meatless' => true, 'tag' => 'Nyár', 'query' => 'paradicsomos tésztasaláta'],
                ['title' => 'Nyári rakott cukkini', 'meatless' => false, 'tag' => 'Nyár', 'query' => 'rakott cukkini'],
                ['title' => 'Meggyes-mákos sütemény', 'meatless' => true, 'tag' => 'Édes', 'query' => 'meggyes mákos süti'],
            ],
        ],
        'osz' => [
            'sobros' => [
                ['title' => 'Sütőtökkrémleves pirított tökmaggal', 'meatless' => true, 'tag' => 'Ősz', 'query' => 'sütőtökkrémleves'],
                ['title' => 'Gerslis-gombás őszi egytálétel', 'meatless' => true, 'tag' => 'Ősz', 'query' => 'gersli gomba'],
                ['title' => 'Almás-fahéjas zabkása vagy süti', 'meatless' => true, 'tag' => 'Ősz', 'query' => 'almás fahéjas süti'],
                ['title' => 'Sütőtökös-zsályás csirkemell', 'meatless' => false, 'tag' => 'Ősz', 'query' => 'sütőtökös csirke'],
                ['title' => 'Szilvás-mákos őszi lepény', 'meatless' => true, 'tag' => 'Édes', 'query' => 'szilvás lepény'],
            ],
            'nosalty' => [
                ['title' => 'Sült sütőtök', 'meatless' => true, 'tag' => 'Ősz', 'query' => 'sütőtök'],
                ['title' => 'Gombapaprikás nokedlivel', 'meatless' => true, 'tag' => 'Ősz', 'query' => 'gomba'],
                ['title' => 'Almás pite', 'meatless' => true, 'tag' => 'Ősz', 'query' => 'alma'],
                ['title' => 'Székelykáposzta', 'meatless' => false, 'tag' => 'Ősz', 'query' => 'káposzta'],
                ['title' => 'Szilvás gombóc', 'meatless' => true, 'tag' => 'Édes', 'query' => 'szilva'],
            ],
            'streetkitchen' => [
                ['title' => 'Krémleves sült sütőtökből', 'meatless' => true, 'tag' => 'Ősz', 'query' => 'sütőtök leves'],
                ['title' => 'Gombás-gesztenyés őszi tészta', 'meatless' => true, 'tag' => 'Ősz', 'query' => 'gombás tészta'],
                ['title' => 'Őszi zöldséges-lencsés ragu', 'meatless' => true, 'tag' => 'Ősz', 'query' => 'lencse ragu'],
                ['title' => 'Sütőtökös-kolbászos tészta', 'meatless' => false, 'tag' => 'Ősz', 'query' => 'sütőtök tészta'],
                ['title' => 'Karamellás-almás pite', 'meatless' => true, 'tag' => 'Édes', 'query' => 'almás pite'],
            ],
            'mindmegette' => [
                ['title' => 'Sütőtökös gnocchi zsályás vajjal', 'meatless' => true, 'tag' => 'Ősz', 'query' => 'sütőtökös gnocchi'],
                ['title' => 'Tepsis őszi zöldségek', 'meatless' => true, 'tag' => 'Ősz', 'query' => 'tepsis zöldség'],
                ['title' => 'Párolt káposzta almával', 'meatless' => true, 'tag' => 'Ősz', 'query' => 'párolt káposzta alma'],
                ['title' => 'Őszi gombás-tejszínes pulyka', 'meatless' => false, 'tag' => 'Ősz', 'query' => 'gombás pulyka'],
                ['title' => 'Fahéjas-szilvás kevert süti', 'meatless' => true, 'tag' => 'Édes', 'query' => 'szilvás süti'],
            ],
        ],
        'tel' => [
            'sobros' => [
                ['title' => 'Fokhagymás krémleves ropogós kockákkal', 'meatless' => true, 'tag' => 'Tél', 'query' => 'fokhagymakrémleves'],
                ['title' => 'Lencsés-zöldséges téli egytál', 'meatless' => true, 'tag' => 'Tél', 'query' => 'lencse egytál'],
                ['title' => 'Mézeskalács-fűszeres téli sütemény', 'meatless' => true, 'tag' => 'Tél', 'query' => 'mézeskalács süti'],
                ['title' => 'Téli fűszeres sült hús zöldségekkel', 'meatless' => false, 'tag' => 'Tél', 'query' => 'sült hús zöldség'],
                ['title' => 'Narancsos-csokis téli desszert', 'meatless' => true, 'tag' => 'Édes', 'query' => 'narancsos csokis'],
            ],
            'nosalty' => [
                ['title' => 'Lencseleves', 'meatless' => true, 'tag' => 'Tél', 'query' => 'lencse'],
                ['title' => 'Töltött káposzta', 'meatless' => false, 'tag' => 'Tél', 'query' => 'káposzta'],
                ['title' => 'Krumplifőzelék', 'meatless' => true, 'tag' => 'Tél', 'query' => 'krumpli'],
                ['title' => 'Mézeskalács', 'meatless' => true, 'tag' => 'Tél', 'query' => 'mézeskalács'],
                ['title' => 'Forró csoki', 'meatless' => true, 'tag' => 'Édes', 'query' => 'csoki'],
            ],
            'streetkitchen' => [
                ['title' => 'Tartalmas téli lencseleves', 'meatless' => true, 'tag' => 'Tél', 'query' => 'lencseleves'],
                ['title' => 'Sajtos-brokkolis csőben sült tészta', 'meatless' => true, 'tag' => 'Tél', 'query' => 'brokkolis tészta'],
                ['title' => 'Téli zöldséges-babos ragu', 'meatless' => true, 'tag' => 'Tél', 'query' => 'babos ragu'],
                ['title' => 'Szaftos téli sült oldalas', 'meatless' => false, 'tag' => 'Tél', 'query' => 'sült oldalas'],
                ['title' => 'Narancsos-mandulás téli süti', 'meatless' => true, 'tag' => 'Édes', 'query' => 'narancsos süti'],
            ],
            'mindmegette' => [
                ['title' => 'Korhelyleves (húsmentes vagy füstölt nélküli)', 'meatless' => true, 'tag' => 'Tél', 'query' => 'korhelyleves'],
                ['title' => 'Rakott kelkáposzta', 'meatless' => false, 'tag' => 'Tél', 'query' => 'rakott kel'],
                ['title' => 'Sajtos-burgonyás téli rakottas', 'meatless' => true, 'tag' => 'Tél', 'query' => 'sajtos rakott burgonya'],
                ['title' => 'Téli babgulyás', 'meatless' => false, 'tag' => 'Tél', 'query' => 'babgulyás'],
                ['title' => 'Kakaós-narancsos piskóta', 'meatless' => true, 'tag' => 'Édes', 'query' => 'narancsos piskóta'],
            ],
        ],
    ];

    $seasonData = $data[$season] ?? $data['osz'];

    // Biztosítjuk, hogy forrásonként pontosan 5 elem legyen, és meglegyen a cél URL
    foreach ($seasonData as $sourceKey => &$items) {
        $items = array_slice($items, 0, 5);
        foreach ($items as &$item) {
            $item['url'] = buildSourceSearchUrl($sourceKey, $item['query']);
        }
        unset($item);
    }
    unset($items);

    return $seasonData;
}

/**
 * Állandó húsmentes ajánló (4 forrás, válogatott húsmentes ötletekkel).
 */
function getPermanentMeatlessRecommendations(): array
{
    $meatless = [
        'sobros' => [
            ['title' => 'Tofus-zöldséges wok tészta', 'query' => 'tofus wok tészta'],
            ['title' => 'Csicseriborsós-spenótos curry', 'query' => 'csicseriborsó spenót curry'],
            ['title' => 'Sajtos-zöldséges quesadilla', 'query' => 'sajtos quesadilla'],
            ['title' => 'Gombás-rizses egytálétel', 'query' => 'gombás rizses'],
        ],
        'nosalty' => [
            ['title' => 'Tofu', 'query' => 'tofu'],
            ['title' => 'Cukkini', 'query' => 'cukkini'],
            ['title' => 'Lencse', 'query' => 'lencse'],
            ['title' => 'Gomba', 'query' => 'gomba'],
        ],
        'streetkitchen' => [
            ['title' => 'Krémes gombás rizottó', 'query' => 'gombás rizottó'],
            ['title' => 'Spenótos-fetás pite', 'query' => 'spenótos fetás pite'],
            ['title' => 'Vöröslencsés dahl', 'query' => 'vöröslencse dahl'],
            ['title' => 'Ropogós tofus tál zöldségekkel', 'query' => 'tofus tál'],
        ],
        'mindmegette' => [
            ['title' => 'Brokkolis-sajtos tészta', 'query' => 'brokkolis sajtos tészta'],
            ['title' => 'Tökfőzelék vagy zöldségfőzelék', 'query' => 'zöldségfőzelék'],
            ['title' => 'Gombás-sajtos rakott tészta', 'query' => 'gombás rakott tészta'],
            ['title' => 'Palacsinta vagy túrós gombóc', 'query' => 'palacsinta'],
        ],
    ];

    foreach ($meatless as $sourceKey => &$items) {
        foreach ($items as &$item) {
            $item['url'] = buildSourceSearchUrl($sourceKey, $item['query']);
        }
        unset($item);
    }
    unset($items);

    return $meatless;
}

/**
 * Forrásonkénti keresési URL előállítása (a NoSalty-nál az első szóra).
 */
function buildSourceSearchUrl(string $sourceKey, string $query): string
{
    $normalized = trim(preg_replace('/\s+/u', ' ', str_replace([',', ';'], ' ', $query)));
    $encoded = rawurlencode($normalized);
    $words = explode(' ', $normalized);
    $firstWordEncoded = rawurlencode($words[0]);

    return match ($sourceKey) {
        'sobros' => "https://sobors.hu/?search={$encoded}",
        'nosalty' => "https://www.nosalty.hu/kereses/recept/{$firstWordEncoded}",
        'streetkitchen' => "https://streetkitchen.hu/kereses?contentType=recipe&query={$encoded}",
        'mindmegette' => "https://www.mindmegette.hu/kereses?global_filter={$encoded}&content_types%5B%5D=recipe",
        default => 'kereso.php',
    };
}

$sourceMeta = [
    'sobros' => ['name' => 'SóBors', 'badge' => 'SB', 'color' => '#9b6b9e'],
    'nosalty' => ['name' => 'NoSalty', 'badge' => 'NS', 'color' => '#5ca47a'],
    'streetkitchen' => ['name' => 'Street Kitchen', 'badge' => 'SK', 'color' => '#5b8fb9'],
    'mindmegette' => ['name' => 'Mindmegette', 'badge' => 'MM', 'color' => '#d9824a'],
];

$currentMonth = (int) date('n');
$autoSeason = detectSeasonByMonth($currentMonth);

$requestedSeason = isset($_GET['evszak']) ? strtolower(trim((string) $_GET['evszak'])) : '';
$activeSeason = in_array($requestedSeason, ['tavasz', 'nyar', 'osz', 'tel'], true)
    ? $requestedSeason
    : $autoSeason;

$requestedSource = isset($_GET['forras']) ? strtolower(trim((string) $_GET['forras'])) : 'all';
$validSourceFilters = array_merge(['all'], array_keys($sourceMeta));
$activeSource = in_array($requestedSource, $validSourceFilters, true) ? $requestedSource : 'all';

$seasonInfo = getSeasonMeta($activeSeason);
$seasonalRecipes = getSeasonalRecommendations($activeSeason);
$permanentMeatless = getPermanentMeatlessRecommendations();

$visibleSources = ($activeSource === 'all')
    ? array_keys($sourceMeta)
    : [$activeSource];
?>
<!DOCTYPE html>
<html lang="hu">
<head>
    <meta charset="UTF-8">
    <title>Ajánlott receptek - HűtőMágnes</title>
    <link rel="stylesheet" href="style.css">
    <style>
        :root {
            --wc-ink: #2f2a28;
            --wc-muted: #6c625e;
            --wc-card: rgba(255, 252, 247, 0.92);
            --wc-border: rgba(166, 138, 115, 0.28);
            --wc-accent: #e07a5f;
            --wc-accent-hover: #c96449;
            --wc-green: #4a7c5e;
            --wc-green-bg: rgba(168, 208, 190, 0.35);
        }

        body {
            color: var(--wc-ink);
            background-color: #fbf7f0;
            background-image:
                linear-gradient(180deg, rgba(253, 250, 244, 0.54) 0%, rgba(247, 241, 229, 0.64) 100%),
                url('img/3033095.jpg');
            background-size: cover, cover;
            background-position: center, center;
            background-repeat: no-repeat, no-repeat;
            background-attachment: fixed, fixed;
            min-height: 100vh;
        }

        .wc-panel {
            background: var(--wc-card);
            border: 1px solid var(--wc-border);
            border-radius: 22px;
            padding: 24px;
            box-shadow: 0 12px 28px rgba(92, 70, 52, 0.09);
            backdrop-filter: blur(6px);
            margin-bottom: 22px;
        }

        .wc-hero h1 {
            margin: 0 0 8px 0;
            font-size: 1.9rem;
            color: var(--wc-ink);
        }

        .wc-hero p {
            margin: 0 0 16px 0;
            color: var(--wc-muted);
            font-size: 1rem;
            line-height: 1.5;
        }

        .controls-bar {
            display: flex;
            flex-wrap: wrap;
            justify-content: space-between;
            align-items: center;
            gap: 12px;
            padding-top: 14px;
            border-top: 1px dashed rgba(166, 138, 115, 0.3);
        }

        .pill-group {
            display: flex;
            flex-wrap: wrap;
            align-items: center;
            gap: 8px;
        }

        .pill-label {
            font-size: 0.86rem;
            font-weight: 700;
            color: var(--wc-muted);
            margin-right: 4px;
            white-space: nowrap;
        }

        .filter-pill {
            display: inline-flex;
            align-items: center;
            width: auto;
            white-space: nowrap;
            text-decoration: none;
            font-size: 0.86rem;
            font-weight: 600;
            padding: 6px 13px;
            border-radius: 999px;
            color: #4f433d;
            background: rgba(255, 255, 255, 0.88);
            border: 1px solid rgba(155, 126, 102, 0.3);
            transition: all 0.16s ease;
        }

        .filter-pill:hover {
            background: rgba(244, 213, 141, 0.45);
            transform: translateY(-1px);
        }

        .filter-pill.is-active {
            background: linear-gradient(135deg, #e07a5f 0%, #d4664b 100%);
            color: #fff;
            border-color: transparent;
            box-shadow: 0 4px 12px rgba(224, 122, 95, 0.28);
        }

        .section-head {
            display: flex;
            flex-wrap: wrap;
            justify-content: space-between;
            align-items: baseline;
            gap: 8px 14px;
            margin-bottom: 16px;
        }

        .section-head h2 {
            margin: 0;
            font-size: 1.35rem;
            color: var(--wc-ink);
        }

        .season-chip {
            font-size: 0.85rem;
            font-weight: 700;
            color: #7c4d3a;
            background: rgba(244, 213, 141, 0.55);
            padding: 5px 12px;
            border-radius: 999px;
        }

        .meatless-chip {
            font-size: 0.85rem;
            font-weight: 700;
            color: var(--wc-green);
            background: var(--wc-green-bg);
            padding: 5px 12px;
            border-radius: 999px;
        }

        .sources-grid {
            display: grid;
            grid-template-columns: repeat(2, minmax(0, 1fr));
            gap: 16px;
        }

        .sources-grid.single-col {
            grid-template-columns: minmax(0, 1fr);
        }

        .source-card {
            background: rgba(255, 255, 255, 0.94);
            border: 1px solid rgba(166, 138, 115, 0.24);
            border-radius: 18px;
            padding: 18px;
            box-shadow: 0 8px 20px rgba(92, 70, 52, 0.06);
        }

        .source-card-header {
            display: flex;
            align-items: center;
            justify-content: space-between;
            gap: 10px;
            padding-bottom: 12px;
            margin-bottom: 12px;
            border-bottom: 1px solid rgba(166, 138, 115, 0.16);
        }

        .source-title-wrap {
            display: flex;
            align-items: center;
            gap: 11px;
        }

        .source-badge {
            width: 38px;
            height: 38px;
            border-radius: 12px;
            color: #fff;
            font-weight: 800;
            font-size: 0.86rem;
            display: flex;
            align-items: center;
            justify-content: center;
            flex-shrink: 0;
        }

        .source-card-header h3 {
            margin: 0;
            font-size: 1.08rem;
            color: var(--wc-ink);
        }

        .count-pill {
            font-size: 0.78rem;
            font-weight: 700;
            color: var(--wc-muted);
            background: rgba(245, 238, 226, 0.9);
            padding: 4px 10px;
            border-radius: 999px;
            white-space: nowrap;
        }

        .recipe-list {
            list-style: none;
            margin: 0;
            padding: 0;
            display: flex;
            flex-direction: column;
            gap: 9px;
        }

        .recipe-row {
            display: flex;
            justify-content: space-between;
            align-items: center;
            gap: 10px;
            padding: 9px 12px;
            border-radius: 12px;
            background: rgba(253, 250, 244, 0.9);
            border: 1px solid rgba(166, 138, 115, 0.14);
            transition: background 0.15s ease, transform 0.15s ease;
        }

        .recipe-row:hover {
            background: rgba(244, 213, 141, 0.24);
            transform: translateX(2px);
        }

        .recipe-meta {
            display: flex;
            flex-wrap: wrap;
            align-items: center;
            gap: 6px;
            min-width: 0;
        }

        .recipe-name {
            font-size: 0.93rem;
            font-weight: 600;
            color: var(--wc-ink);
        }

        .mini-tag {
            font-size: 0.74rem;
            font-weight: 700;
            padding: 2px 8px;
            border-radius: 999px;
            white-space: nowrap;
        }

        .mini-tag.veggie {
            color: var(--wc-green);
            background: var(--wc-green-bg);
        }

        .mini-tag.season-tag {
            color: #7c4d3a;
            background: rgba(244, 213, 141, 0.45);
        }

        .open-link {
            display: inline-flex;
            align-items: center;
            width: auto;
            white-space: nowrap;
            text-decoration: none;
            font-size: 0.82rem;
            font-weight: 700;
            padding: 6px 11px;
            border-radius: 10px;
            background: #3d405b;
            color: #fff;
            transition: background 0.16s ease;
        }

        .open-link:hover {
            background: var(--wc-accent);
        }

        @media (max-width: 860px) {
            .sources-grid {
                grid-template-columns: minmax(0, 1fr);
            }
        }

        @media (max-width: 640px) {
            .recipe-row {
                flex-direction: column;
                align-items: flex-start;
            }
            .open-link {
                width: 100%;
                justify-content: center;
                box-sizing: border-box;
            }
        }
    </style>
</head>
<body>
    <?php include 'nav.php'; ?>

    <main class="main-content">
        <div class="container">
            <section class="wc-panel wc-hero">
                <h1>Ajánlott receptek</h1>
                <p><?php echo htmlspecialchars($seasonInfo['subtitle'], ENT_QUOTES, 'UTF-8'); ?></p>

                <div class="controls-bar">
                    <div class="pill-group">
                        <span class="pill-label">Évszak:</span>
                        <?php foreach (['tavasz' => 'Tavasz', 'nyar' => 'Nyár', 'osz' => 'Ősz', 'tel' => 'Tél'] as $sKey => $sLabel): ?>
                            <?php
                            $href = 'ajanlott_receptek.php?evszak=' . urlencode($sKey)
                                . ($activeSource !== 'all' ? '&forras=' . urlencode($activeSource) : '');
                            ?>
                            <a
                                href="<?php echo htmlspecialchars($href, ENT_QUOTES, 'UTF-8'); ?>"
                                class="filter-pill <?php echo $activeSeason === $sKey ? 'is-active' : ''; ?>"
                            >
                                <?php echo htmlspecialchars($sLabel, ENT_QUOTES, 'UTF-8'); ?>
                                <?php if ($sKey === $autoSeason): ?> (most)<?php endif; ?>
                            </a>
                        <?php endforeach; ?>
                    </div>

                    <div class="pill-group">
                        <span class="pill-label">Forrás:</span>
                        <?php
                        $allHref = 'ajanlott_receptek.php?evszak=' . urlencode($activeSeason);
                        ?>
                        <a
                            href="<?php echo htmlspecialchars($allHref, ENT_QUOTES, 'UTF-8'); ?>"
                            class="filter-pill <?php echo $activeSource === 'all' ? 'is-active' : ''; ?>"
                        >
                            Mind a 4 oldal
                        </a>
                        <?php foreach ($sourceMeta as $srcKey => $srcInfo): ?>
                            <?php
                            $srcHref = 'ajanlott_receptek.php?evszak=' . urlencode($activeSeason)
                                . '&forras=' . urlencode($srcKey);
                            ?>
                            <a
                                href="<?php echo htmlspecialchars($srcHref, ENT_QUOTES, 'UTF-8'); ?>"
                                class="filter-pill <?php echo $activeSource === $srcKey ? 'is-active' : ''; ?>"
                            >
                                <?php echo htmlspecialchars($srcInfo['name'], ENT_QUOTES, 'UTF-8'); ?>
                            </a>
                        <?php endforeach; ?>
                    </div>
                </div>
            </section>

            <section class="wc-panel">
                <div class="section-head">
                    <h2>Szezonális válogatás — <?php echo htmlspecialchars($seasonInfo['label'], ENT_QUOTES, 'UTF-8'); ?></h2>
                    <span class="season-chip"><?php echo htmlspecialchars($seasonInfo['badge'], ENT_QUOTES, 'UTF-8'); ?> • Oldalanként 5 recept</span>
                </div>

                <div class="sources-grid <?php echo count($visibleSources) === 1 ? 'single-col' : ''; ?>">
                    <?php foreach ($visibleSources as $srcKey): ?>
                        <?php
                        $meta = $sourceMeta[$srcKey];
                        $items = $seasonalRecipes[$srcKey] ?? [];
                        ?>
                        <article class="source-card">
                            <div class="source-card-header">
                                <div class="source-title-wrap">
                                    <span class="source-badge" style="background-color: <?php echo htmlspecialchars($meta['color'], ENT_QUOTES, 'UTF-8'); ?>;">
                                        <?php echo htmlspecialchars($meta['badge'], ENT_QUOTES, 'UTF-8'); ?>
                                    </span>
                                    <h3><?php echo htmlspecialchars($meta['name'], ENT_QUOTES, 'UTF-8'); ?></h3>
                                </div>
                                <span class="count-pill"><?php echo count($items); ?> recept</span>
                            </div>

                            <ul class="recipe-list">
                                <?php foreach ($items as $recipe): ?>
                                    <li class="recipe-row">
                                        <div class="recipe-meta">
                                            <span class="recipe-name"><?php echo htmlspecialchars($recipe['title'], ENT_QUOTES, 'UTF-8'); ?></span>
                                            <?php if (!empty($recipe['meatless'])): ?>
                                                <span class="mini-tag veggie">Húsmentes</span>
                                            <?php endif; ?>
                                        </div>
                                        <a
                                            href="<?php echo htmlspecialchars($recipe['url'], ENT_QUOTES, 'UTF-8'); ?>"
                                            target="_blank"
                                            rel="noopener noreferrer"
                                            class="open-link"
                                        >
                                            Megnyitás ↗
                                        </a>
                                    </li>
                                <?php endforeach; ?>
                            </ul>
                        </article>
                    <?php endforeach; ?>
                </div>
            </section>

            <section class="wc-panel">
                <div class="section-head">
                    <h2>Állandó húsmentes ajánló</h2>
                    <span class="meatless-chip">Mindig elérhető vegetáriánus &amp; húsmentes ötletek</span>
                </div>

                <div class="sources-grid <?php echo count($visibleSources) === 1 ? 'single-col' : ''; ?>">
                    <?php foreach ($visibleSources as $srcKey): ?>
                        <?php
                        $meta = $sourceMeta[$srcKey];
                        $veggieItems = $permanentMeatless[$srcKey] ?? [];
                        ?>
                        <article class="source-card">
                            <div class="source-card-header">
                                <div class="source-title-wrap">
                                    <span class="source-badge" style="background-color: <?php echo htmlspecialchars($meta['color'], ENT_QUOTES, 'UTF-8'); ?>;">
                                        <?php echo htmlspecialchars($meta['badge'], ENT_QUOTES, 'UTF-8'); ?>
                                    </span>
                                    <h3><?php echo htmlspecialchars($meta['name'], ENT_QUOTES, 'UTF-8'); ?></h3>
                                </div>
                                <span class="count-pill">Húsmentes</span>
                            </div>

                            <ul class="recipe-list">
                                <?php foreach ($veggieItems as $recipe): ?>
                                    <li class="recipe-row">
                                        <div class="recipe-meta">
                                            <span class="recipe-name"><?php echo htmlspecialchars($recipe['title'], ENT_QUOTES, 'UTF-8'); ?></span>
                                            <span class="mini-tag veggie">Húsmentes</span>
                                        </div>
                                        <a
                                            href="<?php echo htmlspecialchars($recipe['url'], ENT_QUOTES, 'UTF-8'); ?>"
                                            target="_blank"
                                            rel="noopener noreferrer"
                                            class="open-link"
                                        >
                                            Megnyitás ↗
                                        </a>
                                    </li>
                                <?php endforeach; ?>
                            </ul>
                        </article>
                    <?php endforeach; ?>
                </div>
            </section>
        </div>
    </main>
</body>
</html>