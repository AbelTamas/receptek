<?php
require_once 'config.php';

/**
 * Keresési URL-ek generálása több gasztrooldalhoz a megadott kulcsszó alapján.
 */
function buildRecipeSearchLinks(string $query, array $selectedSources): array
{
    // Vesszők és elválasztó írásjelek cseréje szóközre, többszörös szóközök összevonása
    $normalized = preg_replace('/[,;]+/u', ' ', $query);
    $cleanQuery = trim(preg_replace('/\s+/u', ' ', (string) $normalized));

    if ($cleanQuery === '') {
        return [];
    }

    // Teljes keresőkifejezés URL-kódolva
    $rawEncoded = rawurlencode($cleanQuery);

    // Első kulcsszó a NoSalty korlátja miatt (ha több szót adtak meg)
    $words = explode(' ', $cleanQuery);
    $firstWord = $words[0];
    $firstWordEncoded = rawurlencode($firstWord);
    $hasMultipleWords = count($words) > 1;

    $allSources = [
        'sobros' => [
            'name' => 'SóBors',
            'badge' => 'SB',
            'color' => '#9b6b9e',
            'description' => 'Keresés a SóBors receptjei között',
            'note' => null,
            'url' => "https://sobors.hu/?search={$rawEncoded}",
        ],
        'nosalty' => [
            'name' => 'NoSalty',
            'badge' => 'NS',
            'color' => '#5ca47a',
            'description' => 'Receptkeresés a NoSalty oldalán',
            'note' => $hasMultipleWords
                ? "A NoSalty egyszerre egy szót szeret, így most az elsőre ugrunk: „{$firstWord}”."
                : null,
            'url' => "https://www.nosalty.hu/kereses/recept/{$firstWordEncoded}",
        ],
        'streetkitchen' => [
            'name' => 'Street Kitchen',
            'badge' => 'SK',
            'color' => '#5b8fb9',
            'description' => 'Receptek a Street Kitchen oldalán',
            'note' => null,
            'url' => "https://streetkitchen.hu/kereses?contentType=recipe&query={$rawEncoded}",
        ],
        'mindmegette' => [
            'name' => 'Mindmegette',
            'badge' => 'MM',
            'color' => '#d9824a',
            'description' => 'Receptkeresés a Mindmegette oldalán',
            'note' => null,
            'url' => "https://www.mindmegette.hu/kereses?global_filter={$rawEncoded}&content_types%5B%5D=recipe",
        ],
    ];

    $results = [];
    foreach ($selectedSources as $sourceKey) {
        if (isset($allSources[$sourceKey])) {
            $item = $allSources[$sourceKey];
            $item['clean_query'] = $cleanQuery;
            $results[] = $item;
        }
    }

    return $results;
}

$searchTerm = isset($_GET['q']) ? trim((string) $_GET['q']) : '';
$availableKeys = ['sobros', 'nosalty', 'streetkitchen', 'mindmegette'];

if (isset($_GET['q']) || isset($_GET['sources'])) {
    $selectedSources = isset($_GET['sources']) && is_array($_GET['sources'])
        ? array_values(array_intersect($_GET['sources'], $availableKeys))
        : [];
} else {
    $selectedSources = $availableKeys;
}

$searchResults = ($searchTerm !== '') ? buildRecipeSearchLinks($searchTerm, $selectedSources) : [];

$sampleSearches = [
    ['query' => 'káposzta gersli tofu', 'label' => 'Káposzta, gersli, tofu (bátor hűtő)'],
    ['query' => 'csirke cukkini rizs', 'label' => 'Csirke, cukkini, rizs'],
    ['query' => 'tojás sajt paradicsom', 'label' => 'Tojás, sajt, paradicsom (mentőakció)'],
    ['query' => 'palacsinta', 'label' => 'Palacsinta (mert néha jár)'],
];
?>
<!DOCTYPE html>
<html lang="hu">
<head>
    <meta charset="UTF-8">
    <title>Recept kereső - HűtőMágnes</title>
    <link rel="stylesheet" href="style.css">
    <style>
        :root {
            --wc-ink: #2f2a28;
            --wc-muted: #6c625e;
            --wc-card: rgba(255, 252, 247, 0.92);
            --wc-border: rgba(166, 138, 115, 0.28);
            --wc-accent: #e07a5f;
            --wc-accent-hover: #c96449;
        }

        body {
            color: var(--wc-ink);
            background-color: #fbf7f0;
            background-image:
                linear-gradient(180deg, rgba(253, 250, 244, 0.52) 0%, rgba(247, 241, 229, 0.62) 100%),
                url('img/7011098.jpg');
            background-size: cover, cover;
            background-position: center, center;
            background-repeat: no-repeat, no-repeat;
            background-attachment: fixed, fixed;
            min-height: 100vh;
        }

        .wc-hero {
            position: relative;
            padding: 24px 28px;
            border-radius: 22px;
            background: var(--wc-card);
            border: 1px solid var(--wc-border);
            box-shadow: 0 12px 30px rgba(92, 70, 52, 0.1);
            backdrop-filter: blur(6px);
            margin-bottom: 22px;
        }

        .wc-hero h1 {
            margin: 0 0 8px 0;
            font-size: 1.9rem;
            color: var(--wc-ink);
        }

        .wc-hero p {
            margin: 0;
            color: var(--wc-muted);
            font-size: 1rem;
            line-height: 1.5;
        }

        .search-box {
            position: relative;
            background: var(--wc-card);
            border: 1px solid var(--wc-border);
            border-radius: 22px;
            padding: 24px;
            box-shadow: 0 12px 28px rgba(92, 70, 52, 0.09);
            backdrop-filter: blur(6px);
        }

        .search-form-row {
            display: flex;
            gap: 12px;
            margin-bottom: 14px;
        }

        .search-form-row input[type="text"] {
            flex: 1;
            padding: 13px 16px;
            border: 1.5px solid rgba(155, 126, 102, 0.35);
            border-radius: 14px;
            font-size: 1rem;
            color: var(--wc-ink);
            background: #ffffff;
            transition: border-color 0.2s ease, box-shadow 0.2s ease;
        }

        .search-form-row input[type="text"]:focus {
            outline: none;
            border-color: var(--wc-accent);
            box-shadow: 0 0 0 4px rgba(224, 122, 95, 0.16);
        }

        .search-form-row button[type="submit"] {
            width: auto;
            padding: 13px 26px;
            border: none;
            border-radius: 14px;
            background: linear-gradient(135deg, #e07a5f 0%, #d4664b 100%);
            color: #fff;
            font-size: 1rem;
            font-weight: 700;
            cursor: pointer;
            white-space: nowrap;
            box-shadow: 0 6px 16px rgba(224, 122, 95, 0.28);
            transition: transform 0.15s ease, box-shadow 0.2s ease, background 0.2s ease;
        }

        .search-form-row button[type="submit"]:hover {
            transform: translateY(-1px);
            background: linear-gradient(135deg, var(--wc-accent-hover) 0%, #b9553b 100%);
            box-shadow: 0 8px 20px rgba(224, 122, 95, 0.34);
        }

        .samples-row {
            display: flex;
            flex-wrap: wrap;
            align-items: center;
            gap: 8px;
            margin-bottom: 20px;
        }

        .samples-label {
            font-size: 0.86rem;
            color: var(--wc-muted);
            font-weight: 600;
            margin-right: 2px;
            white-space: nowrap;
        }

        .sample-chip {
            display: inline-flex;
            align-items: center;
            width: auto;
            white-space: nowrap;
            border: 1px dashed rgba(138, 108, 86, 0.45);
            background: rgba(255, 248, 234, 0.92);
            color: #4f433d;
            font-size: 0.85rem;
            padding: 6px 12px;
            border-radius: 999px;
            cursor: pointer;
            transition: all 0.16s ease;
        }

        .sample-chip:hover {
            background: rgba(244, 213, 141, 0.55);
            border-style: solid;
            transform: translateY(-1px);
        }

        .sources-header {
            display: flex;
            flex-wrap: wrap;
            justify-content: space-between;
            align-items: center;
            gap: 10px;
            margin-bottom: 10px;
        }

        .sources-actions {
            display: flex;
            gap: 8px;
        }

        .mini-btn {
            display: inline-flex;
            align-items: center;
            width: auto;
            white-space: nowrap;
            background: rgba(245, 238, 226, 0.95);
            border: 1px solid rgba(155, 126, 102, 0.32);
            color: #554943;
            font-size: 0.8rem;
            font-weight: 600;
            padding: 5px 12px;
            border-radius: 999px;
            cursor: pointer;
            transition: background 0.15s ease;
        }

        .mini-btn:hover {
            background: rgba(244, 213, 141, 0.5);
        }

        .sources-group {
            display: flex;
            flex-wrap: wrap;
            gap: 10px;
        }

        .source-checkbox {
            display: inline-flex;
            align-items: center;
            gap: 8px;
            background: rgba(255, 255, 255, 0.9);
            padding: 9px 15px;
            border-radius: 999px;
            border: 1px solid rgba(155, 126, 102, 0.28);
            cursor: pointer;
            font-weight: 600;
            font-size: 0.92rem;
            white-space: nowrap;
            transition: all 0.16s ease;
        }

        .source-checkbox:hover {
            background: rgba(244, 213, 141, 0.35);
            border-color: rgba(224, 122, 95, 0.45);
        }

        .source-checkbox input[type="checkbox"] {
            accent-color: var(--wc-accent);
            width: 16px;
            height: 16px;
            cursor: pointer;
        }

        .result-container {
            margin-top: 24px;
            background: var(--wc-card);
            border: 1px solid var(--wc-border);
            border-radius: 22px;
            padding: 24px;
            box-shadow: 0 12px 28px rgba(92, 70, 52, 0.09);
            backdrop-filter: blur(6px);
        }

        .result-header-row {
            display: flex;
            flex-wrap: wrap;
            justify-content: space-between;
            align-items: baseline;
            gap: 8px 14px;
            margin-bottom: 14px;
        }

        .result-header-row h2 {
            margin: 0;
            font-size: 1.3rem;
            color: var(--wc-ink);
        }

        .clean-query-pill {
            font-size: 0.85rem;
            color: #4f6d5a;
            background: rgba(168, 208, 190, 0.35);
            padding: 5px 12px;
            border-radius: 999px;
            font-weight: 600;
        }

        .result-item {
            display: flex;
            justify-content: space-between;
            align-items: center;
            gap: 16px;
            padding: 16px 18px;
            border: 1px solid rgba(166, 138, 115, 0.22);
            border-radius: 18px;
            margin-top: 12px;
            background: rgba(255, 255, 255, 0.94);
            transition: transform 0.16s ease, box-shadow 0.2s ease, border-color 0.2s ease;
        }

        .result-item:hover {
            transform: translateY(-2px);
            box-shadow: 0 10px 22px rgba(92, 70, 52, 0.09);
            border-color: rgba(224, 122, 95, 0.45);
        }

        .result-left {
            display: flex;
            align-items: center;
            gap: 14px;
        }

        .source-badge {
            width: 46px;
            height: 46px;
            border-radius: 15px;
            color: #fff;
            font-weight: 800;
            font-size: 0.95rem;
            display: flex;
            align-items: center;
            justify-content: center;
            flex-shrink: 0;
            box-shadow: 0 6px 14px rgba(0, 0, 0, 0.1);
        }

        .result-left h3 {
            margin: 0 0 3px 0;
            font-size: 1.08rem;
            color: var(--wc-ink);
        }

        .result-left p {
            margin: 0;
            font-size: 0.92rem;
            color: var(--wc-muted);
        }

        .result-note {
            margin-top: 6px !important;
            font-size: 0.84rem !important;
            color: #4a7c5e !important;
            font-weight: 600;
        }

        .result-link-btn {
            display: inline-block;
            padding: 10px 18px;
            background: #3d405b;
            color: #fff;
            text-decoration: none;
            border-radius: 13px;
            font-weight: 600;
            font-size: 0.92rem;
            white-space: nowrap;
            transition: background 0.18s ease, transform 0.15s ease;
        }

        .result-link-btn:hover {
            background: var(--wc-accent);
            transform: translateY(-1px);
        }

        .hint-msg {
            color: #b84a39;
            background: rgba(224, 122, 95, 0.12);
            border: 1px solid rgba(224, 122, 95, 0.3);
            padding: 10px 14px;
            border-radius: 12px;
            font-weight: 600;
            margin-top: 14px;
            font-size: 0.92rem;
        }

        @media (max-width: 640px) {
            .search-form-row {
                flex-direction: column;
            }
            .search-form-row button[type="submit"] {
                width: 100%;
            }
            .result-item {
                flex-direction: column;
                align-items: flex-start;
            }
            .result-link-btn {
                width: 100%;
                text-align: center;
                box-sizing: border-box;
            }
        }
    </style>
</head>
<body>
    <?php include 'nav.php'; ?>

    <main class="main-content">
        <div class="container">
            <section class="wc-hero">
                <h1>Mit rejt ma a hűtő?</h1>
                <p>Írd be, ami otthon van (még ha kicsit szürreális párosítás is), válaszd ki a kedvenc gasztrooldalaidat, és ugrunk is a találatokra!</p>
            </section>

            <div class="search-box">
                <form id="recipeSearchForm" method="GET" action="kereso.php">
                    <div class="search-form-row">
                        <input
                            id="searchQueryInput"
                            type="text"
                            name="q"
                            placeholder="Pl.: káposzta gersli tofu"
                            value="<?php echo htmlspecialchars($searchTerm, ENT_QUOTES, 'UTF-8'); ?>"
                            required
                        >
                        <button type="submit">Keresés</button>
                    </div>

                    <div class="samples-row">
                        <span class="samples-label">Gyors ötletek:</span>
                        <?php foreach ($sampleSearches as $sample): ?>
                            <button
                                type="button"
                                class="sample-chip"
                                data-query="<?php echo htmlspecialchars($sample['query'], ENT_QUOTES, 'UTF-8'); ?>"
                            >
                                <?php echo htmlspecialchars($sample['label'], ENT_QUOTES, 'UTF-8'); ?>
                            </button>
                        <?php endforeach; ?>
                    </div>

                    <div>
                        <div class="sources-header">
                            <strong>Keresési források:</strong>
                            <div class="sources-actions">
                                <button type="button" class="mini-btn" id="selectAllSources">Mindet kérem</button>
                                <button type="button" class="mini-btn" id="clearAllSources">Egyiket se</button>
                            </div>
                        </div>

                        <div class="sources-group">
                            <label class="source-checkbox">
                                <input type="checkbox" name="sources[]" value="sobros" <?php echo in_array('sobros', $selectedSources, true) ? 'checked' : ''; ?>>
                                SóBors
                            </label>
                            <label class="source-checkbox">
                                <input type="checkbox" name="sources[]" value="nosalty" <?php echo in_array('nosalty', $selectedSources, true) ? 'checked' : ''; ?>>
                                NoSalty
                            </label>
                            <label class="source-checkbox">
                                <input type="checkbox" name="sources[]" value="streetkitchen" <?php echo in_array('streetkitchen', $selectedSources, true) ? 'checked' : ''; ?>>
                                Street Kitchen
                            </label>
                            <label class="source-checkbox">
                                <input type="checkbox" name="sources[]" value="mindmegette" <?php echo in_array('mindmegette', $selectedSources, true) ? 'checked' : ''; ?>>
                                Mindmegette
                            </label>
                        </div>
                    </div>
                </form>

                <?php if ($searchTerm !== '' && empty($selectedSources)): ?>
                    <p class="hint-msg">Így nehéz lesz receptet találni — pipálj be legalább egy oldalt!</p>
                <?php endif; ?>
            </div>

            <?php if ($searchTerm !== '' && !empty($searchResults)): ?>
                <div class="result-container">
                    <div class="result-header-row">
                        <h2>Találati linkek ehhez: „<?php echo htmlspecialchars($searchTerm, ENT_QUOTES, 'UTF-8'); ?>”</h2>
                        <span class="clean-query-pill">
                            Küldött kulcsszó: <?php echo htmlspecialchars($searchResults[0]['clean_query'], ENT_QUOTES, 'UTF-8'); ?>
                        </span>
                    </div>

                    <?php foreach ($searchResults as $item): ?>
                        <div class="result-item">
                            <div class="result-left">
                                <span class="source-badge" style="background-color: <?php echo htmlspecialchars($item['color'], ENT_QUOTES, 'UTF-8'); ?>;">
                                    <?php echo htmlspecialchars($item['badge'], ENT_QUOTES, 'UTF-8'); ?>
                                </span>
                                <div>
                                    <h3><?php echo htmlspecialchars($item['name'], ENT_QUOTES, 'UTF-8'); ?></h3>
                                    <p><?php echo htmlspecialchars($item['description'], ENT_QUOTES, 'UTF-8'); ?></p>
                                    <?php if (!empty($item['note'])): ?>
                                        <p class="result-note"><?php echo htmlspecialchars($item['note'], ENT_QUOTES, 'UTF-8'); ?></p>
                                    <?php endif; ?>
                                </div>
                            </div>
                            <a
                                href="<?php echo htmlspecialchars($item['url'], ENT_QUOTES, 'UTF-8'); ?>"
                                target="_blank"
                                rel="noopener noreferrer"
                                class="result-link-btn"
                            >
                                Megnyitás ↗
                            </a>
                        </div>
                    <?php endforeach; ?>
                </div>
            <?php endif; ?>
        </div>
    </main>

    <script>
        (function () {
            const form = document.getElementById('recipeSearchForm');
            const input = document.getElementById('searchQueryInput');
            const chips = document.querySelectorAll('.sample-chip');
            const checkboxes = document.querySelectorAll('.sources-group input[type="checkbox"]');
            const selectAllBtn = document.getElementById('selectAllSources');
            const clearAllBtn = document.getElementById('clearAllSources');

            chips.forEach((chip) => {
                chip.addEventListener('click', () => {
                    if (!input || !form) return;
                    input.value = chip.getAttribute('data-query') || '';
                    form.submit();
                });
            });

            if (selectAllBtn) {
                selectAllBtn.addEventListener('click', () => {
                    checkboxes.forEach((cb) => { cb.checked = true; });
                });
            }

            if (clearAllBtn) {
                clearAllBtn.addEventListener('click', () => {
                    checkboxes.forEach((cb) => { cb.checked = false; });
                });
            }
        })();
    </script>
</body>
</html>