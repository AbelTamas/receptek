CREATE DATABASE IF NOT EXISTS `hutomagnes`
  CHARACTER SET utf8mb4
  COLLATE utf8mb4_hungarian_ci;

USE `hutomagnes`;

DROP TABLE IF EXISTS `receptek`;

CREATE TABLE `receptek` (
  `id` INT UNSIGNED NOT NULL AUTO_INCREMENT,
  `cim` VARCHAR(180) NOT NULL,
  `szerzo` VARCHAR(150) NOT NULL,
  `evszak` ENUM('tavasz', 'nyar', 'osz', 'tel') NOT NULL,
  `husmentes` TINYINT(1) NOT NULL DEFAULT 0,
  `leiras` TEXT NOT NULL,
  `hozzavalok` TEXT NOT NULL,
  `elkeszites` TEXT NOT NULL,
  PRIMARY KEY (`id`),
  INDEX `idx_evszak` (`evszak`),
  INDEX `idx_husmentes` (`husmentes`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_hungarian_ci;

INSERT INTO `receptek` (`cim`, `szerzo`, `evszak`, `husmentes`, `leiras`, `hozzavalok`, `elkeszites`) VALUES
(
  'Gombapástétom',
  'Wichmann Anna',
  'tavasz',
  1,
  'Egészen hihetetlen, hogy nem csak ízében, de állagában is megtévesztésig hasonlít a libamájpástétomra. Ez amellett, hogy vegán még tizedébe is kerül a valósnak, ami elég jó a bolygónak és a nekünk is.',
  'szárított erdei gomba vagy friss erdei gomba, zöld lencse, babérlevél, dió, olaj, barna csiperkegomba, fokhagyma, kakukkfű, rozmaring, zsálya, citrom, cukor, konyak, só, bors',
  'Ha szárított erdei gombát használunk, akkor tegyük egy tálba és öntsünk rá 4 dl forrásban lévő vizet, majd ebben hagyjuk kihűlni. Ha nyerset, akkor a csiperkegombával együtt készítsük el a recept későbbi lépésében. A lencsét öblítsük át és bő vízben, a babérlevéllel, sóval és borssal fűszerezett vízben 25 perc alatt főzzük puhára. A diót pirítsuk meg egy serpenyőben, majd egy deszkán hagyjuk kihűlni. A serpenyőben hevítsük fel az olajat és nagy lángon pirítsuk meg a gombát. Ha már aranybarna adjuk hozzá a kiázott, lecsepegtett erdei gombát is. Fűszerezzük fokhagymával, kakukkfűvel, rozmaringgal, zsályával, citrommal, cukorral sóval, borssal és takarék lángon, lefedve pároljuk 15 percig. Ha elfőtte a levét, az erdei gomba áztatólevével pótoljuk. Ha letelt az idő és szépen megpuhult a gomba felöntjük a konyakkal és erősebbre véve a lángot, 3-4 percig rotyogtatjuk. A lencsét leszűrjük, kiemeljük a babérleveleket és egy turmixgépbe tesszük a dióval és a gombás raguval. Pulzálva addig pürésítjük, amíg egy selymes krémet kapunk. Krékerrel vagy pirítóssal tálaljuk. 1 hétig hűtőben tartható.'
),
(
  'Mentás zöldborsófőzelék fűszeres joghurttal',
  'Lila Füge – Könnyű 2019 magazin',
  'tavasz',
  1,
  'Közeleg a tavasz, friss, zöld alapanyagokkal, amelyek csupa jó hatással vannak ránk. Válogassunk olyan hozzávalókat az ételeinkhez, amelyek a tél után kiürült készleteinket feltöltik, és amelyektől újra energikusak leszünk.',
  'vöröshagyma, vaj, étolaj, fokhagyma, zöldborsó, alaplé, őrölt csili, menta, görög joghurt, őrölt római kömény, friss gyömbér, só, bors',
  'A vajat és az olajat felhevítjük egy fazékban, és a vöröshagymát üvegesre pároljuk alacsony lángon. Hozzáadjuk a zúzott fokhagymát, és pár pillanat alatt lepirítjuk, ügyelve, hogy még véletlenül se égjen meg, különben keserű lesz. Ha már illatozik a hagymamix, beleöntjük a borsót (ha fagyasztott, kiengedve), átforgatjuk, és felöntjük az alaplével vagy vízzel. Sózzuk, borsozzuk, hozzácsippentjük a csilit, és fedő alatt 8–10 perc alatt puhára, de még roppanósra főzzük. Ezután botmixerrel a felét pépesítjük, így önmagával sűrítjük a főzeléket. Felaprítjuk a mentát, és rászórjuk. Ha kell még, sózzuk, ízesítjük, és készen is van. A joghurtot kikeverjük a római köménnyel, a friss gyömbérrel, és tálaláskor a főzelék tetejére halmozunk 1 evőkanállal.'
),
(
  'Rizssaláta fűszeres-pirított lazackockákkal',
  'Havas Dóra',
  'tavasz',
  0,
  'Salátának nevezzük, de valójában ez egy tartalmas étel egészséges, teljes értékű hozzávalókból. Nagyszerű vacsora egy szaladós nap végén, és természetesen a maradékot másnap elvihetjük magunkkal ebédre – melegítést sem igényel.',
  'sütőtök, olívaolaj, só, bors, basmati rizs, alma, gránátalma, szárított vörösáfonya, pisztácia, almaecet, méz, extra szűz olívaolaj, kakukkfű, lazacfilé, szójaszósz, narancslé, fokhagyma, gyömbér, csilipehely',
  'A lazacot falatnyi darabokra vágjuk, félretesszük. A többi hozzávalóból pácot készítünk és beleforgatjuk a lazacot. Fél órára vagy egy éjszakára a hűtőbe tesszük. Fogyasztás előtt 10 perccel kivesszük a hűtőből, hogy szobahőmérsékletű legyen. Egy serpenyőben kevés olajat hevítünk és oldalanként 1-1 perc alatt piríosra sütjük. A salátaöntet hozzávalóit egy kis tálba tesszük és krémesre keverjük. A sütőtököt kis falatnyi kockákra vágjuk és sózzuk, borsozzuk. Egy nagyobb serpenyőben kevés olajat hevítük és rázogatva lepirítjuk benne a tököt. A rizst lobogó sós vízben kifőzzük, majd lecsepegtetjük és hagyjuk langyosra hűlni, majd az öntet 1/3 részét langyosan hozzáösszeforgatjuk. A tök mellé tesszük a keverőtálba, összeforgatjuk és hozzáadjuk a falatnyi darabokra vágott almát, és a durvára aprított pisztáciát is. A gránátalmát és a lazacot csak tálaláskor helyezzük a rizssaláta tetejére.'
),
(
  'Sonkás-medvehagymás bukta',
  'Bóta Évi',
  'tavasz',
  0,
  'A medvehagymaszezonnal beköszönt a nagy kirándulások időszaka is. Kirándulásra, piknikre vagy klasszikus vendégvárónak is kiváló péksütemény.',
  'liszt, só, cukor, vaj, szárított élesztő, víz, füstölt főtt sonka, medvehagyma, tojás, köménymag',
  'Kimérjük a lisztet egy keverőtálba, hozzáadjuk a sót, a cukrot és az olvasztott vajat. Az élesztőt elkeverjük 2,5 dl langyos vízben, amit folyamatos gyúrás mellett adunk a liszthez. A tésztát addig dagasztjuk, amíg magától elválik a tál falától. Konyharuhával letakarva meleg helyen kb. 1,5 óra alatt a duplájára kelesztjük. Miután megkelt a tészta, lisztezett felületen kinyújtjuk, és egy pohárral nagyobb köröket szaggatunk belőle. Ezeket megtöltjük a sonkával és a medvehagymával, majd félbehajtjuk, és a széleit lenyomkodjuk. A bukták tetejét megkenjük tojással, megszórjuk köménymaggal, és sütőpapírral bélelt tepsin 180 fokon 15 perc alatt megsütjük.'
),
(
  'Sültpaszternák- és répaleves pirított magvakkal',
  'Bóta Évi',
  'tavasz',
  1,
  'A sűrű zöldséglevesek rajongójaként bátran ajánlom ezt az édes, tavaszi előételt. Egészséges és nem igényel nagy rákészülést.',
  'sárgarépa, paszternák, olívaolaj, méz, fokhagyma, hagyma, őrölt kömény, zöldségalaplé, saláta-magkeverék, só, bors',
  'A sárgarépát és a paszternákot nagyobb darabokra, a hagymát negyedekre vágjuk, és egy tepsire tesszük. A fokhagymagerezdeket héjastul adjuk hozzá, hogy ne égjenek meg, és édesre süljenek. Az egészet meglocsoljuk az olívaolajjal és a mézzel, majd a fűszerekkel ízesítjük. Jól összekeverjük. 200 fokra előmelegített sütőben 20 perc alatt megsütjük. A sült zöldségeket turmixgépbe tesszük, hozzáadjuk a héjukból kinyomott fokhagymagerezdeket, felöntjük zöldségalaplével, majd pürésítjük. A tetejére száraz serpenyőben pirított magvakat szórunk.'
),
(
  'Teriyaki húsgombóc rizstésztával',
  'Havas Dóra',
  'tavasz',
  0,
  'Illatos, édes-savanyú és egy picit csípős ázsiai fogás, amely egyszerűen elkészíthető és nincs benne sok különleges hozzávaló.',
  'darált hús, mogyoróhagyma, fokhagyma, gyömbér, dijoni mustár, sűrített paradicsom, olaj, szezámmag, méz, cukor, világos szójaszósz, rizsecet, szezámolaj, piros csili, rizstészta, újhagyma, koriander, só, bors',
  'A darált húst egy keverőtálba tesszük és ráreszeljük a hagymát, fokhagymát és a gyömbér felét. Rákanalazzuk a mustárt, paradicsomot, sót, borsot és alaposan összegyúrjuk majd 25 golyót formázunk belőle. Az olajat felhevítjük egy nagy serpenyőben és több adagban arany barnára sütjük a húsgolyókat. Végül az üres serpenyőbe szórunk 1 evőkanál szezámmagot és pirítani kezdjük. Amikor már kezd pirulni mézet nyomunk rá és visszatesszük a húsgolyókat, amiket átforgatunk benne. A mártáshoz a cukrot karamellizáljuk egy nagy serpenyőben, felöntjük 2 dl vízzel, belereszeljük a hagymát, fokhagymát és gyömbér másik felét, ráöntjük a szójaszószt, rizsecetet, szezámolajat és csilivel, borssal fűszerezve összeforraljuk. A rizstésztát forrásban lévő vízzel leöntjük, 20 perc áztatás után leszűrjük és átöblítjük. A tésztát a teriyaki mártással, húsgombóccal, felaprított újhagymával és korianderrel tálaljuk.'
),
(
  'Zöldséges csirkeragu szezámos tekerccsel',
  'Havas Dóra',
  'tavasz',
  0,
  'Levéstésztából készült kis tekercsek és illatos csirkeragu találkozása egy látványos, tartalmas fogásban.',
  'leveles tészta, krémsajt, parmezán, fekete szezámmag, olaj, csirkemellfilé, póréhagyma, fokhagyma, sárgarépa, szárzeller, édesburgonya, zöldborsó, koktélparadicsom, keményítő, alaplé, babérlevél, füstölt pirospaprika, cayenne bors, petrezselyem, só, bors',
  'A sütőt 180 fokra előmelegítjük. A tekercshez a leveles tésztát kiterítjük, vékonyan megkenjük a krémsajttal, sózzuk, elosztjuk rajta a parmezán sajtot és a fekete szezámmagot, majd szorosan feltekerjük és a mélyhűtőbe tesszük. Az olajat felhevítjük egy nagy öntöttvas edényben és a csíkokra vágott csirkemellfilét magas lángon barnára pirítjuk. Hozzáadjuk a pórét, fokhagymát, répát, szárzellert, édesburgonyát, majd a borsót és koktélparadicsomot. A keményítőt kikeverjük az alaplével és felöntjük vele a zöldséges alapot, fűszerezzük, forraljuk fel. Kivesszük a tésztát, fél centis szeleteket vágunk, a forró ragu tetején elrendezzük, szezámmaggal meghintjük és 180 fokon 30 perc alatt készre sütjük.'
),
(
  'Bazsalikomos cukkinifőzelék sült sonkával',
  'Havas Dóra',
  'nyar',
  0,
  'Könnyű, telt ízű étel a melegebb hónapokra, friss bazsalikommal és ropogósra pirított feketeerdei sonkával.',
  'cukkini, póréhagyma, olaj, vaj, keményítő, alaplé, tejföl, bazsalikom, olívaolaj, feketeerdei sonka, só, bors',
  'A cukkinit legyaluljuk, a póréhagymát felaprítjuk. Egy nagy lábasban felhevítünk 1 evőkanál olajat és a vajat. A póréhagymát egy kis sóval pár perc alatt megpároljuk, majd a cukkinit is beletesszük, és kb. 10 percig pároljuk. A keményítőt kikeverjük az alaplével és a tejföllel, majd a cukkinire öntjük. Fűszerezzük a bazsalikom leveleivel, sóval és borssal. Lefedve 20 percig főzzük. Közben a maradék olajon megpirítjuk a sonkaszeletek mindkét oldalát, majd a főzelékkel és tejföllel tálaljuk.'
),
(
  'Görög rakott tészta',
  'Kárai Dávid',
  'nyar',
  0,
  'Aki az olasz lasagnét szereti, az ezt a görög rakott tésztát egyenesen imádni fogja! Tészta, paradicsomos húsragu és vastag sajtos besamel rétegekből áll.',
  'vöröshagyma, olívaolaj, fahéjrúd, darált marhahús, oregánó, kakukkfű, fokhagyma, vörösbor, sűrített paradicsom, mentalevél, feta sajt, száraz tészta, reszelt sajt, vaj, liszt, tej, szerecsendió, só, bors',
  'A vöröshagymát apóra szeleteljük, majd a felhevített olívaolajon megpirítjuk. Hozzáadjuk a fahéjrudat, majd a darált marhahúst és aranybarnára pirítjuk. Sózzuk, borsozzuk, hozzáadjuk a kakukkfüvet, oregánót és fokhagymát, felöntjük vörösborral, majd sűrített paradicsommal 5–10 perc alatt összefőzzük. 180 fokra előmelegítjük a sütőt, elkészítjük a besamel mártást vajból, lisztből, tejből, sóval és szerecsendióval. A tésztát kissé keményebbre kifőzzük. Rétegezzük a tésztát, sajtot, húsragut, majd a besamelt és a maradék sajtot, és 40–45 perc alatt aranybarnára sütjük.'
),
(
  'Hűsítő pezsgős limonádé ananásszal',
  'Havas Dóra',
  'nyar',
  1,
  'Nyári estékre való frissítő, limonádé alapú pezsgős ital ananásszal, mentával és jéggel.',
  'száraz pezsgő, szóda, citrom, ananászpüré, menta, jég, cukor',
  'Az ananászt a citromlével, és ha szükséges, kevés cukorral, simára turmixoljuk. Egy nagy talpas pohárba egy marék jeget teszünk. Erre tesszük az ananászpürét, majd hozzáadjuk a pezsgőt és a szódát. Összekeverjük és mentalevelekkel díszítjük. Azonnal fogyasztjuk.'
),
(
  'Melanzane alla parmigiana',
  'Péter Anna',
  'nyar',
  1,
  'Klasszikus, rétegezett padlizsános fogás paradicsomszósszal, mozzarellával és reszelt parmezánnal.',
  'vöröshagyma, fokhagyma, olívaolaj, paradicsompüré vagy friss paradicsom, padlizsán, mozzarella, parmezán, só, fekete bors',
  'A hagymákat az olívaolajon megdinszteljük, felöntjük a paradicsomszósszal, sózzuk, borsozzuk, és sűrű szószt főzünk belőle. A padlizsánokat hosszában kb. másfél cm-es szeletekre vágjuk, és bő, forró olajban aranybarnára sütjük mindkét oldalukat. Egy tűzálló tálba rétegezzük a padlizsánt, mozzarellát és paradicsomszószt, a tetejét meghintjük parmezánnal, majd 180 fokon 30 percig sütjük.'
),
(
  'Olasz rakott padlizsán',
  'Havas Dóra',
  'nyar',
  1,
  'Könnyű, mégis laktató húsmentes rakott padlizsán paradicsomszósszal, mozzarellával és parmezánnal.',
  'fokhagyma, olaj, darabolt paradicsomkonzerv, bazsalikom, padlizsán, parmezán sajt, mozzarella sajt, só, bors',
  'A szószhoz a fokhagymát finomra aprítjuk, olajon puhára pároljuk, ráöntjük a paradicsomot, sózzuk, borsozzuk és 20 perc alatt készre főzzük. A padlizsánokat ½ cm-es szeletekre vágjuk, olívaolajjal megkenjük és grillsütőben vagy sütőben puhára sütjük. Olajjal kikent tepsiben rétegezzük a paradicsomszószt, padlizsánt, mozzarellát és parmezánt, a tetejére paradicsom és sajt kerül, majd 200 fokon 25–30 perc alatt készre sütjük.'
),
(
  'Patisszontempura mézes-citromos öntettel',
  'Vogel Diana',
  'nyar',
  1,
  'Ropogós bundában sült patisszonrudacskák friss, mézes-citromos öntettel és sópehellyel.',
  'patisszon, sima liszt, tojásfehérje, jéghideg víz, jégkocka, étolaj, sópehely, méz, citrom',
  'A mézes-citromos öntethez a citromlevet elkeverjük a mézzel, és félretesszük. A patisszont meghámozzuk, kibelezzük és ujjnyi darabokra vágjuk. A lisztet elkeverjük a hideg vízzel, kissé felvert tojásfehérjével és jégkockákkal, majd a patisszont megforgatjuk benne. Forró olajban kis adagokban világosra, ropogósra sütjük, majd azonnal meglocsolva az öntettel és sópehellyel tálaljuk.'
),
(
  'Colcannon (ír tört krumpli)',
  'Nagy Sanya',
  'osz',
  1,
  'Zöldségekkel, káposztával, sajttal és fűszerekkel gazdagított ír tört krumpli, amely főételként és köretként is megállja a helyét.',
  'krumpli, vaj, újhagyma, lila hagyma, fokhagyma, káposzta, szerecsendió, Worcestershire szósz, angol mustár, cheddar sajt, tejföl, petrezselyem, só, bors',
  'A krumplit héjában puhára főzzük, meghámozzuk és darabosra törjük. Serpenyőben felolvasztott vajon sütni kezdjük a felkarikázott hagymát, újhagymát, aprított fokhagymát és szeletelt káposztát, fűszerezzük, ráöntjük a Worcestershire szószt és puhára pároljuk. Összekeverjük a krumplival, hozzáadjuk a mustárt, sajtot, tejfölt, további vajat és petrezselymet, majd jól elkeverjük.'
),
(
  'Hideg marhasült',
  'Vogel Diana',
  'osz',
  0,
  'Fűszeres száraz páccal készült, vékonyra szeletelhető hideg marhasült szendvicsekhez, salátákhoz vagy uzsonnára.',
  'marhafartő, só, zöld bors, koriandermag, gyömbér, köménymag, fokhagymapor, szegfűszeg, olaj',
  'A marhafartövet a fűszerekből összekevert száraz páccal bevonjuk, és fóliába csomagolva 10–12 órán át pihentetjük. Serpenyőben felforrósított olajon minden oldalát 1–2 perc alatt átsütjük, majd tűzálló tálba téve 185 fokon 40 perc alatt készre sütjük. Lehűtjük, pihentetjük, majd vékony szeletekre vágva tálaljuk.'
),
(
  'Indiai vajas lencse',
  'Havas Dóra',
  'osz',
  1,
  'Gazdag, fűszeres, főzelék állagú indiai lencseétel tejszínnel, vajjal és friss korianderrel.',
  'lencse, víz, babérlevél, só, hagyma, étolaj, vaj, csili, gyömbér, fokhagyma, sűrített paradicsom, passata, római kömény, szegfűszeg, zöld kardamom, fahéjrúd, szerecsendió, tejszín, koriander',
  'A beáztatott lencsét babérlevéllel, hagymával és sóval puhára főzzük, majd leszűrjük. A vajas mártáshoz olaj és vaj keverékén megpároljuk a hagymát, hozzáadjuk a csilit, gyömbért, fokhagymát, mozsárban tört fűszereket és sűrített paradicsomot, majd felöntjük a passatával és vízzel, 20 percig főzzük. Hozzáadjuk a lencsét, további 20 percig rotyogtatjuk, végül tejszínnel és vajjal selymesítjük.'
),
(
  'Kecskesajtos-sülthagymás pite',
  'Havas Dóra',
  'osz',
  1,
  'Ropogós, vajas tésztán alapuló pite savanykás kecskesajttal, karamellizált hagymával és kevés mézzel megcsepegtetve.',
  'kecskesajt, tejszín, tojás, kakukkfű, olívaolaj, hagyma, liszt, vaj, cukor, méz, só',
  'A tészta alapanyagait összegyúrjuk, fóliába csomagolva 1 órára hűtőbe tesszük, majd kinyújtva piteformába terítjük. A vékonyra szeletelt hagymákat olajon 20 perc alatt aranybarnára karamellizáljuk, elkeverjük a többi töltelék-hozzávalóval és a kakukkfűvel, megtöltjük a formát, és 180 fokon 30 percig sütjük.'
),
(
  'Mandulás körteleves ropogós quinoával',
  'Kárai Dávid',
  'osz',
  1,
  'Fűszeres szirupban főtt körtével és mandulaitallal készülő leves, ropogós pirított quinoával és mandulával.',
  'körte, víz, só, szegfűszeg, csillagánizs, fahéjrúd, zöld kardamom, citrom, nádcukor, keményítő, vaníliás mandulaital, quinoa, mandula',
  'A felkockázott körtét a fűszeres, citromhéjas, cukros vízben megfőzzük. A quinoát és a mandulát száraz serpenyőben megpirítjuk. A körte felét kivesszük, a többit a főzővízzel leturmixoljuk, majd a keményítős mandulaitallal besűrítjük, és a félretett körtével és pirított feltéttel tálaljuk.'
),
(
  'Mézzel sült, fűszeres sütőtöksaláta',
  'Lila Füge',
  'osz',
  1,
  'Laktató őszi saláta mézzel és fűszerekkel sült Hokkaido tökkel, görög joghurttal, pomelóval, lilahagymával és fűszeres tökmaggal.',
  'Hokkaido tök, olívaolaj, méz, fahéj, római kömény, koriandermag, cayenne bors, füstölt fűszerpaprika, tökmag, görög joghurt, pomeló, lilahagyma, petrezselyem, só, bors',
  'A gerezdekre vágott tököt olajjal, mézzel és fűszerekkel összeforgatva 200 fokon 25–30 perc alatt puhára sütjük. A tökmagot olajon megpirítjuk, fűszerrel és mézzel összekeverjük. Tányérra kenjük a joghurtot, ráfektetjük a sült tököt és a gerezdekre szedett pomelót, majd megszórjuk lilahagymával, petrezselyemmel és a sült tökmaggal.'
),
(
  'Vöröslencse, sütőtök leves pirított hajdinával',
  'Havas Dóra',
  'osz',
  1,
  'Vegán, kókuszalapú főzőkrémmel készült sűrű, fűszeres vöröslencse- és sütőtökleves ropogós pirított hajdinával.',
  'hagyma, fokhagyma, étolaj, babérlevél, őrölt római kömény, gyömbér, kurkuma, vöröslencse, sütőtök, húsleves vagy alaplé vagy víz, kókuszos főzőkrém, petrezselyem vagy koriander, pörkölt hajdina, tengeri só, füstölt paprika, só',
  'A hajdinát olajon ropogósra pirítjuk, sózzuk, fűszerezzük és félretesszük. Lábasban olajon megpároljuk a hagymát, fokhagymát, fűszereket és gyömbért, hozzáadjuk a vöröslencsét és a sütőtököt, felöntjük folyadékkal és kb. 20 perc alatt puhára főzzük. Kókuszkrémmel krémesítjük, további 2 percig főzzük, majd ropogós hajdinával és zöldfűszerrel tálaljuk.'
),
(
  'Almás-húsos hasé',
  'Lila Füge',
  'tel',
  0,
  'Leveles tésztába csomagolt, almás, mustáros, fűszeres darált húsos töltelék, amely uzsonnára vagy hétvégi fogásként is kiváló.',
  'olívaolaj, póréhagyma, darált sertéshús, alma, mustár, fahéj, római kömény, leveles tészta, darált dió, tojás, só, bors',
  'Olívaolajon karamellizáljuk a vékonyra szeletelt póréhagymát, hozzáadjuk a darált sertéshúst és lepirítjuk. Beleforgatjuk a kockázott almát, mustárt, fahéjat és római köményt, 4–5 percig pároljuk. A leveles tésztából téglalapokat vágunk, beirdaljuk az oldalát, darált diót szórunk a közepére, rátesszük a tölteléket, behajtogatjuk, tojással megkenjük, és 180 fokon 15–20 perc alatt aranybarnára sütjük.'
),
(
  'Édesburgonyás vegán fasírt',
  'Havas Dóra',
  'tel',
  1,
  'Reszelt édesburgonyából és fűszerekből készülő vegán fasírtgolyók vagy tócsnik, krémes tahini szósszal.',
  'édesburgonya, újhagyma, fokhagyma, kukoricaliszt, gyömbér, mustármag, őrölt koriandermag, chili pehely, chia mag, víz, olívaolaj, tahini, citromlé, dijoni mustár, almaszirup, bors, só',
  'A chia magot vízbe áztatjuk. A lereszelt édesburgonyát összekeverjük az újhagymával, fokhagymával, fűszerekkel, kukoricaliszttel és a beáztatott chia maggal, 20 percig hűtőben pihentetjük, golyókat formázunk belőle, és kontakt grillben készre sütjük. A tahini szósz hozzávalóit aprítógépben simára dolgozzuk.'
),
(
  'Francia almás kosárka',
  'Havas Dóra',
  'tel',
  1,
  'Muffinformában sült, fűszeres almás töltelékkel rétegezett, cukorral hintett téli sütemény.',
  'száraz élesztő, porcukor, kenyérliszt, só, vaj, piros alma, barnacukor, őrölt fahéj, őrölt kardamom',
  'A felfuttatott élesztőt összedolgozzuk a lisztes-vajas-cukros-sós keverékkel, téglalapra nyújtjuk, hajtogatjuk, feltekerjük és hűtjük. Az almát vajon, cukorral, fahéjjal és kardamommal puhára pároljuk. A tésztát kinyújtjuk, megkenjük az almás töltelékkel, háromba hajtjuk, 12 négyzetre vágjuk, muffinformába nyomkodjuk, 40 percig kelesztjük, majd 180 fokon 35–40 perc alatt megsütjük.'
),
(
  'Joghurtos karalábéfőzelék bulguros húsgolyóval',
  'Havas Dóra',
  'tel',
  0,
  'Savanykás, joghurtos karalábéfőzelék közel-keleti fűszerezésű, bulguros húsgolyókkal.',
  'darált hús, bulgur, hagyma, petrezselyem, biocitrom, tojás, étolaj, karalábé, vaj, barna nádcukor, zöldségalaplé vagy víz, joghurt, kukoricaliszt, citromlé, só, bors',
  'A húsgolyóhoz összegyúrjuk a darált húst a bulgurral, hagymával, petrezselyemmel, citromhéjjal, tojással és fűszerekkel, hűtőben pihentetjük, majd kisütjük. A szeletelt karalábét vajon és cukron átforgatjuk, sózzuk, alaplével puhára főzzük. Egy részét leturmixoljuk, a kukoricaliszttel és citromlével elkevert joghurttal sűrítjük, majd a maradék karalábéval összemelegítjük.'
),
(
  'Meggyes-csokoládés rétes',
  'Havas Dóra',
  'tel',
  1,
  'Ropogós réteslapba tekert meggybefőttes, aszalt meggyes, étcsokoládés és mandulás téli rétes.',
  'vaj, réteslap, zsemlemorzsa, meggybefőtt, aszalt meggy, étcsokoládé, mandula, barna nádcukor',
  'A vajat serpenyőben enyhén megbarnítjuk. A réteslapokat megkenjük az olvasztott vajjal, megszórjuk zsemlemorzsával, meggybefőttel, aszalt meggyel, aprított étcsokoládéval, mandulával és barnacukorral, feltekerjük, a tetejét is megvajazzuk, és 180 fokon 40 perc alatt ropogósra sütjük.'
),
(
  'Sörös-sajtos burgonyakrémleves',
  'Havas Dóra',
  'tel',
  0,
  'Sűrű, sajtos és sörös burgonyakrémleves pirított baconnel és sajtos kenyérkockákkal.',
  'burgonya, érett sajt, sör, húsleves vagy alaplé vagy víz, Worcestershire-szósz, szárított kakukkfű, bacon, kenyér, reszelt sajt, só, bors',
  'A felkockázott burgonyát a sörrel, alaplével és fűszerekkel puhára főzzük, majd krémesre turmixoljuk. Serpenyőben ropogósra sütjük a bacont, a zsíron lepirítjuk a kenyérkockákat, rásütjük a reszelt sajtot, és tálaláskor a leves tetejére szórjuk.'
),
(
  'Ünnepi sütőtökkrémleves',
  'Kárai Dávid',
  'tel',
  1,
  'Kétféle tökből és kókuszvízzel készülő, fűszeres sütőtökkrémleves fűszeres pirított tökkockákkal, gesztenyével és paprikamagolajjal.',
  'sonkatök, méz, olaj, vöröshagyma, sárgarépa, gyömbér, kókuszvíz, víz, görögjoghurt, Hokkaido tök, cayenne bors, fahéj, szegfűbors, pirospaprika, tökmag, főtt gesztenye, paprikamagolaj, só, bors',
  'A félbevágott sonkatököt sóval és mézzel meglocsolva 180 fokon 25–30 perc alatt megsütjük. Közben olajon megpirítjuk a hagymát, sárgarépát és gyömbért, felöntjük kókuszvízzel és vízzel, puhára főzzük, majd a sült tökkel együtt leturmixoljuk. Fűszeres pirított Hokkaido tökkockákkal, tökmaggal, gesztenyével és paprikamagolajjal tálaljuk.'
);