-- phpMyAdmin SQL Dump
-- version 4.9.0.1
-- https://www.phpmyadmin.net/
--
-- Počítač: 127.0.0.1
-- Vytvořeno: Stř 02. lis 2022, 12:37
-- Verze serveru: 10.4.6-MariaDB
-- Verze PHP: 7.3.8

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT = @@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS = @@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION = @@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Databáze: `nekonews`
--
DROP DATABASE IF EXISTS nekonews;
CREATE DATABASE nekonews;

-- --------------------------------------------------------

--
-- Struktura tabulky `article`
--

CREATE TABLE `article` (
                           `id` int(10) UNSIGNED NOT NULL,
                           `author_id` int(11) NOT NULL,
                           `title` varchar(150) COLLATE utf8_czech_ci NOT NULL,
                           `perex` text COLLATE utf8_czech_ci NOT NULL,
                           `text` text COLLATE utf8_czech_ci NOT NULL,
                           `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
                           `image` varchar(500) COLLATE utf8_czech_ci DEFAULT NULL,
                           `published` tinyint(1) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_czech_ci;

--
-- Vypisuji data pro tabulku `article`
--

INSERT INTO `article` (`id`, `author_id`, `title`, `perex`, `text`, `created_at`, `image`, `published`) VALUES
                                                                                                            (1, 1, 'Let\'s Encrypt zablokoval nebezpečnou validaci pomocí self-signed certifikátu', 'Let\'s encrypt má první větší bezpečnostní problém. Za určitých okolností bylo možné získat certifikát i pro cizí doménové jméno. Jak zareagovali a jakým způsobem hodlají situaci řešit?', '<h2>Jak funguje tls-sni-01</h2>\r\n<p>Validačn&iacute; metoda <code>tls-sni-01</code> je vyn&aacute;lezem tvůrců projektu autority Let\'s Encrypt. Spoč&iacute;v&aacute; ve vystaven&iacute; <em>self-signed</em> certifik&aacute;tu na neexistuj&iacute;c&iacute; dom&eacute;nov&eacute; jm&eacute;no (např&iacute;klad <code>773c7d.13445a.acme.invalid</code>), kter&eacute; obsahuje ověřovac&iacute; k&oacute;d. Certifikačn&iacute; autorita při ověřov&aacute;n&iacute; nav&aacute;že s dan&yacute;m dom&eacute;nov&yacute;m jm&eacute;nem TLS spojen&iacute; a do hlavičky SNI vlož&iacute; toto speci&aacute;ln&iacute; jm&eacute;no. K &uacute;spě&scaron;n&eacute;mu ověřen&iacute; dojde, pokud server odpov&iacute; certifik&aacute;tem vystaven&yacute;m na dan&eacute; speci&aacute;ln&iacute; jm&eacute;no.</p>\r\n<p>Validačn&iacute; metodu <code>tls-sni-01</code> použ&iacute;v&aacute; předev&scaron;&iacute;m ofici&aacute;ln&iacute; klient <a href=\"https://certbot.eff.org/\">Certbot</a>. Je v&yacute;hodn&aacute; pro automatizaci, protože vyžaduje minim&aacute;ln&iacute; konfiguračn&iacute; z&aacute;sahy do webserveru. Nen&iacute; ale jedin&aacute;, Let\'s Encrypt podporuje tak&eacute; validaci <code>http-01</code> spoč&iacute;vaj&iacute;c&iacute; ve vystaven&iacute; souboru s určit&yacute;m obsahem na určit&eacute; cestě a <code>dns-01</code>, kde k ověřen&iacute; doch&aacute;z&iacute; um&iacute;stněn&iacute;m TXT z&aacute;znamu na dom&eacute;ně <code>_acme-challenge.</code>.</p>\r\n<h2>Zranitelnost sd&iacute;len&yacute;ch hostingů</h2>\r\n<p>Podle zji&scaron;těn&iacute; Franse Ros&eacute;na existuj&iacute; provozovatel&eacute; sd&iacute;len&yacute;ch webhostingů, pro kter&eacute; ověřen&iacute; metodou <code>tls-sni-01</code> umožňuje z&iacute;skat ciz&iacute; certifik&aacute;t:</p>\r\n<ul>\r\n<li>webhostingy různ&yacute;ch z&aacute;kazn&iacute;ků sd&iacute;l&iacute; stejnou IP adresu</li>\r\n<li>uživatelům je povoleno nahr&aacute;t vlastn&iacute; TLS certifik&aacute;t bez kontroly, zda je vyd&aacute;n na dom&eacute;nov&eacute; jm&eacute;no držen&eacute; dan&yacute;m uživatelem</li>\r\n</ul>\r\n<p>Kombinace těchto dvou okolnost&iacute; pak umožňuje z&iacute;skat TLS certifik&aacute;t na libovoln&eacute; dom&eacute;nov&eacute; jm&eacute;no hostovan&eacute; na stejn&eacute; IP adrese. Mějme např&iacute;klad dvojici webov&yacute;ch prezentac&iacute;, jednu na dom&eacute;ně <code>legit.example</code>, druhou na dom&eacute;ně <code>badguy.example</code>. Prvn&iacute; patř&iacute; oběti, druh&aacute; &uacute;točn&iacute;kovi, obě sd&iacute;l&iacute; IP adresu. &Uacute;točn&iacute;k jednodu&scaron;e pož&aacute;d&aacute; autoritu o certifik&aacute;t na jm&eacute;no <code>legit.example</code> a na v&yacute;zvu autority vyrob&iacute; <em>self-signed</em> certifik&aacute;t na autoritou požadovan&eacute; jm&eacute;no, kter&yacute; nahraje jako certifik&aacute;t pro j&iacute;m ovl&aacute;dan&yacute; hosting <code>badguy.example</code>. Autorita se připoj&iacute; na IP adresu oběti, kter&aacute; je shodn&aacute; s IP adresou &uacute;točn&iacute;ka a pož&aacute;d&aacute; o speci&aacute;ln&iacute; certifik&aacute;t. Webserver ochotně vybere certifik&aacute;t poskytnut&yacute; &uacute;točn&iacute;kem, byť patř&iacute; zcela jin&eacute;mu z&aacute;kazn&iacute;kovi.</p>\r\n<p>Zranitelnost tedy postihuje <strong>v&yacute;lučně sd&iacute;len&eacute; hostingy</strong>, pro kter&eacute; jsou splněny v&yacute;&scaron;e uveden&eacute; podm&iacute;nky. Přitom už nez&aacute;lež&iacute; na ž&aacute;dn&yacute;ch dal&scaron;&iacute;ch okolnostech. Zranitelnost stejn&yacute;m způsobem funguje i pro inovovanou variantu ověřen&iacute; <code>tls-sni-02</code>, kter&aacute; je souč&aacute;st&iacute; nov&eacute;ho standardu protokolu ACME.</p>\r\n<h2>Reakce Let\'s Encrypt</h2>\r\n<p>V kr&aacute;tk&eacute; době po zji&scaron;těn&iacute; incidentu byla validace metodou <code>tls-sni-01</code> vypnuta. I přesto, že nejde o nejobl&iacute;beněj&scaron;&iacute; metodu validace (tou je <code>http-01</code>), m&aacute; sv&eacute; uživatele a velk&aacute; č&aacute;st z nich nemůže zcela automaticky přej&iacute;t na jin&yacute; druh validace. V pl&aacute;nu proto je validaci opět zprovoznit v momentě, kdy bude probl&eacute;m nějak&yacute;m způsobem vyře&scaron;en nebo obejit.</p>\r\n<p>Lid&eacute; z ISRG, organizace stoj&iacute;c&iacute; za projektem Let\'s Encrypt, se domn&iacute;vaj&iacute;, že probl&eacute;m je možn&eacute; zm&iacute;rnit implementac&iacute; silněj&scaron;&iacute;ch kontrol na straně provozovatale webhostingu, tak aby si z&aacute;kazn&iacute;k nemohl nahr&aacute;t libovoln&yacute; certifik&aacute;t. Postižen&iacute; provozovatel&eacute; jsou v kontaktu s ISRG a takov&eacute; opravy by měly b&yacute;t brzy dostupn&eacute;.</p>\r\n<p>Během n&aacute;sleduj&iacute;c&iacute;ch 48 hodin chce ISRG vytvořit seznam postižen&yacute;ch webhostingů. Jakmile bude hotov&yacute;, měla by b&yacute;t validace <code>tls-sni-01</code> znovu zprovozněna, s t&iacute;m, že pro IP adresy na seznamu bude zablokov&aacute;na.</p>\r\n<p>Dal&scaron;&iacute;m krokem je pak vyvol&aacute;n&iacute; diskuze o budoucnosti validačn&iacute; metody v r&aacute;mci komunity kolem Let\'s Encrypt a protokolu ACME. Je možn&eacute;, že po zv&aacute;žen&iacute; v&scaron;ech pro a proti bude takov&aacute;to validace prohl&aacute;&scaron;ena za zastaralou a jej&iacute; použ&iacute;v&aacute;n&iacute; bude postupně utlumov&aacute;no.</p>', '2018-01-11 11:08:38', 'image638bc75b0292f2.92593780.jpg', 1),
                                                                                                            (2, 2, 'Procesory Intel mají vážnou hardwarovou chybu, záplata výrazně snižuje výkon', 'V procesorech Intel se nachází závažná bezpečnostní chyba, kterou nelze zcela opravit jinak než na úrovni hardwaru. Patche pro operační systém snižují výkon CPU až o desítky procent a problém se netýká jen Linuxu, ale i Windows.', '<p>AMD st&aacute;le tvrd&iacute;, že jej&iacute; CPU nejsou postižena (tedy přesněji řečeno, že nejde ani o z&aacute;sadn&iacute;, ani o obecn&yacute; probl&eacute;m, viz <a href=\"http://www.amd.com/en/corporate/speculative-execution\">vyj&aacute;dřen&iacute; společnosti</a>). Linus Torvalds mezit&iacute;m do j&aacute;dra <a href=\"https://www.phoronix.com/scan.php?page=news_item&amp;px=Linux-Tip-Git-Disable-x86-PTI\">začlenil patch</a>, kter&yacute; vyp&iacute;n&aacute; ochranu proti t&eacute;to chybě, tedy Page Table Isolation, pro CPU AMD. Google v&scaron;ak naopak tvrd&iacute;, že postižena jsou i CPU ARM a AMD, nicm&eacute;ně bl&iacute;že nic neupřesňuje (může j&iacute;t tedy jen o určit&eacute; architektury). Na <a href=\"https://spectreattack.com/\">webu Meltdown and Spectre</a> se hovoř&iacute; o tom, že Meltdown postihuje prakticky v&scaron;echna CPU od roku 1995 (kromě Intel Itanium a Atomů z doby před 2013). U Spectre je již ověřeno, že postihuje i CPU ARM a AMD.</p>\r\n<p>Bliž&scaron;&iacute; detailn&iacute; informace shrnuj&iacute; dokumenty odkazovan&eacute; v <a href=\"https://spectreattack.com/\">doln&iacute; č&aacute;sti webu Meltdown and Spectre</a> Google uv&aacute;d&iacute; sv&aacute; zji&scaron;těn&iacute; na <a href=\"https://googleprojectzero.blogspot.cz/2018/01/reading-privileged-memory-with-side.html\">webu t&yacute;mu Zero</a>, resp. <a href=\"https://security.googleblog.com/2018/01/todays-cpu-vulnerability-what-you-need.html\">sv&eacute;m bezpečnostn&iacute;m blogu</a>.</p>\r\n<p>&Uacute;vodem nutno podotknout, že toto nen&iacute; <a href=\"https://www.root.cz/clanky/minix-je-zrejme-nejrozsirenejsim-systemem-je-ukryty-v-procesorech-intel/\">dal&scaron;&iacute; čl&aacute;nek o Intel Management Engine</a>. Jde o zcela jin&yacute; probl&eacute;m, pro kter&yacute; je v j&aacute;dru 4.15 k dispozici sada opravn&yacute;ch patchů, kter&eacute; byly/jsou/budou backportov&aacute;ny i do řad 4.14 (aktu&aacute;ln&iacute; stabiln&iacute;) a 4.9 (aktu&aacute;ln&iacute; LTS). Podobnou věc implementuj&iacute; i Windows 10, v Microsoftu se na tom už <a href=\"https://twitter.com/aionescu/status/930412525111296000\">několik t&yacute;dnů pracuje</a>.</p>\r\n<h2>&Scaron;patn&aacute; implementace u Intelu</h2>\r\n<p>Procesory Intel totiž obsahuj&iacute; chybu implementace TLB (Translation Lookaside Buffer, souč&aacute;st CPU s nemal&yacute;m dopadem na v&yacute;kon), kter&aacute; potenci&aacute;lně umožňuje &uacute;točn&iacute;kovi dostat se k datům, ke kter&yacute;m nem&aacute; dan&yacute; uživatel syst&eacute;mu opr&aacute;vněn&iacute;. Řečeno jinak: &bdquo;&uacute;točn&iacute;k&ldquo; se může z jedn&eacute; virtu&aacute;ln&iacute; ma&scaron;iny dostat k datům v paměti jin&eacute; virtu&aacute;ln&iacute; ma&scaron;iny. Probl&eacute;m se t&yacute;k&aacute; v podstatě v&scaron;ech CPU z posledn&iacute;ch generac&iacute; u Intelu, což mimo jin&eacute; znamen&aacute;, že z něj plyne i teoretick&aacute; napadnutelnost v&scaron;ech cloudov&yacute;ch služeb využ&iacute;vaj&iacute;c&iacute;ch CPU Intel (např&iacute;klad Amazon EC2, Google Compute Engine, Microsoft Azure) či jak&yacute;chkoli jin&yacute;ch strojů.</p>\r\n<p>Ře&scaron;en&iacute; v softwarov&eacute; podobě existuje, je na Linuxu implementov&aacute;no jako <a href=\"https://en.wikipedia.org/wiki/Kernel_page-table_isolation\">Page Table Isolation</a>, ale představuje tak velkou z&aacute;těž z hlediska přeru&scaron;en&iacute; a syst&eacute;mov&yacute;ch vol&aacute;n&iacute;, že při re&aacute;ln&eacute;m použit&iacute; doch&aacute;z&iacute; k propadu v&yacute;konu CPU o jednotky až des&iacute;tky procent. Ře&scaron;en&iacute; totiž spoč&iacute;v&aacute; v tom, že pokud program chce po j&aacute;dru syst&eacute;mu data z jeho paměti, mus&iacute; nyn&iacute; (patřičně opatchovan&yacute;) kernel nejprve smazat TLB cache.</p>\r\n<h2>Jak moc velk&yacute; probl&eacute;m to je?</h2>\r\n<p>Detailn&iacute; popis chyby nen&iacute; z pochopiteln&yacute;ch důvodů zat&iacute;m k dispozici, ale můžeme usuzovat z několika indici&iacute;. Tou prvn&iacute; je ticho po pě&scaron;ině, kter&eacute; se Intel snažil držet, podobně jako u Management Engine. To obvykle nen&iacute; dobr&eacute; znamen&iacute;. T&iacute;m druh&yacute;m je, že změny do linuxov&eacute;ho j&aacute;dra připutovaly v rychl&eacute;m sledu a dokonce jsou backportov&aacute;ny do star&scaron;&iacute;ch verz&iacute;, včetně LTS.</p>\r\n<p>&Uacute;pravy existuj&iacute; i za cenu velk&eacute; ztr&aacute;ty v&yacute;konu, takže je jasn&eacute;, že bezpečnost (resp. z&aacute;važnost probl&eacute;mu) zde m&aacute; o hodně vy&scaron;&scaron;&iacute; prioritu. A v neposledn&iacute; řadě s ohledem na to, že od loňsk&eacute;ho podzimu na věci pracuje i Microsoft pro Windows 10 s NT kernelem, lze to vn&iacute;mat jako potvrzen&iacute; hardwarov&eacute; chyby.</p>\r\n<p>Objevilo se v&iacute;ce informac&iacute; o m&iacute;ře propadu v&yacute;konu po aplikaci patchů. <a href=\"https://www.techpowerup.com/240174/intel-secretly-firefighting-a-major-cpu-bug-affecting-datacenters\">Obecně se uv&aacute;d&iacute;</a> propad na &uacute;rovni 30 až 35 %, <a href=\"https://www.phoronix.com/scan.php?page=article&amp;item=linux-415-x86pti&amp;num=1\">Phoronix provedl vlastn&iacute; rozs&aacute;hlej&scaron;&iacute; měřen&iacute;</a>. Z nich vyplynulo, že kupř&iacute;kladu hry či komprese videa nejsou prakticky vůbec penalizov&aacute;ny. Nicm&eacute;ně dopady v I/O operac&iacute;ch, kompilačn&iacute;ch testech či datab&aacute;zov&yacute;ch (PostreSQL) jsou hodně velk&eacute;.</p>\r\n<h2>AMD se to net&yacute;k&aacute;</h2>\r\n<p>Důležit&eacute; pro budouc&iacute; v&yacute;voj je to, že cel&yacute; probl&eacute;m nen&iacute; d&aacute;n n&aacute;vrhem x86 architektury jako takov&eacute; (či nějak&eacute; pozděj&scaron;&iacute; instrukčn&iacute; sady x86 procesorů), ale konkr&eacute;tn&iacute; implementac&iacute; konkr&eacute;tn&iacute; funkcionality tak, jak ji Intel ve sv&yacute;ch CPU realizoval. Konkurenčn&iacute; AMD je tedy z obliga, jej&iacute;ch CPU se probl&eacute;m net&yacute;k&aacute;, a plat&iacute; to jak pro serverov&eacute; Opterony, tak obecně pro procesory architektur Ryzen, Threadripper a EPYC.</p>\r\n<p>Pikantn&iacute; ale je, že patche na tuto chybu maj&iacute; velk&yacute; v&yacute;konnostn&iacute; dopad i na stroj&iacute;ch s AMD CPU. Za v&scaron;e totiž může aktivace <code>X86_BUG_CPU_INSECURE</code>, kter&aacute; vede k použit&iacute; k&oacute;du, kter&yacute; neust&aacute;le maže TLB. Toto označen&iacute; je nyn&iacute; aktivn&iacute; pro v&scaron;echny x86 CPU jako bezpečnostn&iacute; opatřen&iacute;. AMD již <a href=\"https://lkml.org/lkml/2017/12/27/2\">ře&scaron;&iacute; jeho odstraněn&iacute; pro sv&aacute; CPU</a>.</p>\r\n<h2>Souvislosti a důsledky budou zaj&iacute;mav&eacute;</h2>\r\n<p>Dovolte mi nyn&iacute; volněji dosadit celou věc do souvislost&iacute;. M&aacute;me zde tedy nyn&iacute; procesory Intel, u kter&yacute;ch se pro několik posledn&iacute;ch generac&iacute; v&iacute; o dvou velk&yacute;ch probl&eacute;mech. Těmi generacemi mysl&iacute;m cokoli od Sandy Bridge v&yacute;&scaron;e (o Core 2 se už nem&aacute; smysl př&iacute;li&scaron; bavit). V různ&yacute;ch verz&iacute;ch x86 CPU architektur Intelu se nach&aacute;z&iacute; různ&eacute; verze Intel Management Engine, tedy vlastn&iacute; mal&yacute; běž&iacute;c&iacute; &bdquo;poč&iacute;tač&ldquo;, aktu&aacute;lně použ&iacute;vaj&iacute;c&iacute; x86 CPU s OS Minix &ndash; to samo o sobě je potenci&aacute;lně velk&yacute; probl&eacute;m, nicm&eacute;ně probrali jsme ho před časem <a href=\"https://www.root.cz/clanky/minix-je-zrejme-nejrozsirenejsim-systemem-je-ukryty-v-procesorech-intel/\">v samostatn&eacute;m čl&aacute;nku</a>.</p>\r\n<p>Intel si zkr&aacute;tka loni svoji reputaci vůbec nevylep&scaron;il a nepřisp&iacute;v&aacute; tomu ani neust&aacute;l&eacute; odkl&aacute;d&aacute;n&iacute; nov&yacute;ch v&yacute;robn&iacute;ch procesů (indikuj&iacute;c&iacute; neschopnost přiv&eacute;st 10nm v&yacute;robu x86 CPU k světu &ndash; a dokl&aacute;daj&iacute; to i nejnověj&scaron;&iacute; neofici&aacute;ln&iacute; data). A nyn&iacute; přich&aacute;z&iacute; dal&scaron;&iacute; r&aacute;na: v&scaron;echny x86 procesory Intel jsou prokazatelně nebezpečn&eacute; a nen&iacute; možn&eacute; s t&iacute;m nic udělat bez velk&eacute; v&yacute;konnostn&iacute; penalizace.</p>\r\n<p>A pr&aacute;vě ta penalizace je věc, kter&aacute; Intelu dle m&eacute;ho ub&iacute;r&aacute; obchody (vysvětl&iacute;m za chv&iacute;li). Penalizaci na &uacute;rovni des&iacute;tek procent si Intel mohl dovolit v době, kdy neměl konkurenci, tj. kdy AMD měla na trhu mizern&eacute; procesory typu Bulldozer/Piledriver (AMD FX 8 a 9). Nyn&iacute; je situace zcela jin&aacute;, AMD m&aacute; na trhu vynikaj&iacute;c&iacute; procesory od desktopů (Ryzen), přes hi-end desktopy (Threadripper) až po servery (EPYC). Intel prakticky nen&iacute; schopen j&iacute; konkurovat, maxim&aacute;lně dok&aacute;že oproti 16j&aacute;drov&eacute;hu Threadripperu s cenovkou 25 tis&iacute;c Kč postavit o tro&scaron;ku v&yacute;konněj&scaron;&iacute; 18j&aacute;drov&eacute; Core i9&ndash;7980XE s cenovkou 48 tis&iacute;c Kč.</p>\r\n<p>Souslov&iacute; &bdquo;o tro&scaron;ku v&yacute;konněj&scaron;&iacute;&ldquo; si ale můžeme dnes &scaron;krtnout, protože z&aacute;platy na hardwarovou chybu v procesorech Intel ub&iacute;raj&iacute; v&yacute;razně v&yacute;kon jak na Linuxu, tak na Windows a nen&iacute; v moci Intelu s t&iacute;m cokoli udělat (av&scaron;ak nutno zdůraznit, že se to t&yacute;k&aacute; sp&iacute;&scaron;e určit&yacute;ch typů aplikac&iacute;). Pokud tuto argumentaci přeženu, tak by na z&aacute;kladě zn&aacute;m&yacute;ch skutečnost&iacute; mělo b&yacute;t možn&eacute; tvrdit, že AMD m&aacute; moment&aacute;lně na desktopov&eacute;m trhu prokazatelně rychlej&scaron;&iacute; procesor (Threadripper 1950X) za zhruba polovičn&iacute; cenu oproti konkurenčn&iacute;mu model Core i9&ndash;7980XE. A podobn&eacute; lze tvrdit i o serverov&yacute;ch procesorech, kde jsou cenov&eacute; rozd&iacute;ly mnohdy je&scaron;tě zaj&iacute;mavěj&scaron;&iacute;.</p>\r\n<p>Pokud byl rok 2017 z hlediska trhu x86 CPU prvn&iacute; po letech stagnace opravdu zaj&iacute;mav&yacute;m rokem, tak to byl teprve slaboučk&yacute; odvar toho, co n&aacute;s ček&aacute; letos. Už několik let tvrd&iacute;m, že Intel usnul na vavř&iacute;nech, stačilo mu oproti skom&iacute;raj&iacute;c&iacute; AMD pouze udržovat status quo a inovovat jen m&iacute;rně. Nyn&iacute; to za svůj př&iacute;stup schyt&aacute; a může si za to vlastně s&aacute;m.</p>\r\n<p>Dlužno připomenout, že tento probl&eacute;m s implementac&iacute; TLB cache nen&iacute; prvn&iacute;. V roce 2008 <a href=\"https://www.anandtech.com/show/2477/2\">měly prvn&iacute; AMD Phenomy t&eacute;ž chybu v t&eacute;to č&aacute;sti CPU</a> a z&aacute;plata vedla t&eacute;ž k propadům v&yacute;konu. Z hlediska architektury x86 CPU tomu tam asi bude u TLB vždy.</p>', '2018-01-11 10:51:06', 'image638bc78fddbd10.62492483.jpg', 1),
                                                                                                            (10, 3, 'fsdafdasf', 'asdfasd', '<p>asdf</p>', '2022-12-03 21:53:45', 'image638bc6d237dd04.06866717.jpg', 1),
                                                                                                            (11, 5, 'Test', 'Test', '<p>test</p>', '2022-12-06 12:16:01', 'image638f3281c068b8.71604851.jpg', 1);

-- --------------------------------------------------------

--
-- Struktura tabulky `article_category`
--

CREATE TABLE `article_category` (
                                    `article_id` int(10) UNSIGNED NOT NULL,
                                    `category_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_czech_ci;

--
-- Vypisuji data pro tabulku `article_category`
--

INSERT INTO `article_category` (`article_id`, `category_id`) VALUES
                                                                 (1, 1),
                                                                 (2, 1),
                                                                 (2, 2),
                                                                 (10, 1),
                                                                 (11, 2);

-- --------------------------------------------------------

--
-- Struktura tabulky `author`
--

CREATE TABLE `author` (
                          `id` int(11) NOT NULL,
                          `name` varchar(20) COLLATE utf8_czech_ci NOT NULL,
                          `surname` varchar(50) COLLATE utf8_czech_ci DEFAULT NULL,
                          `profile_photo` varchar(500) COLLATE utf8_czech_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_czech_ci;

--
-- Vypisuji data pro tabulku `author`
--

INSERT INTO `author` (`id`, `name`, `surname`, `profile_photo`) VALUES
                                                                    (1, 'Karel', 'Vágner', 'https://res.cloudinary.com/crunchbase-production/image/upload/c_lpad,h_256,w_256,f_auto,q_auto:eco,dpr_1/waqyknpic66mf2sbjies'),
                                                                    (2, 'Eliška', 'Mladá', 'https://styles.redditmedia.com/t5_be2vz/styles/profileIcon_vgn9gt18cfs41.png?width=256&height=256&crop=256:256,smart&s=4c0e54416b29d5cab3730920392e0d7692efdee1'),
                                                                    (3, 'Vanilka', 'Roztomilá', 'https://styles.redditmedia.com/t5_2mf7u8/styles/communityIcon_dr0uatkon2a61.png?width=256&s=0b0b787d87beb54eda7a3f259006d889c056fcf7'),
                                                                    (5, 'Test', 'Test2', 'https://t4.ftcdn.net/jpg/00/64/67/63/360_F_64676383_LdbmhiNM6Ypzb3FM4PPuFP9rHe7ri8Ju.jpg');

-- --------------------------------------------------------

--
-- Struktura tabulky `category`
--

CREATE TABLE `category` (
                            `id` int(11) NOT NULL,
                            `name` varchar(50) COLLATE utf8_czech_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_czech_ci;

--
-- Vypisuji data pro tabulku `category`
--

INSERT INTO `category` (`id`, `name`) VALUES
                                          (1, 'Bezpečnost'),
                                          (2, 'Hardware'),
                                          (9, 'Hry'),
                                          (11, 'Test');

-- --------------------------------------------------------

--
-- Struktura tabulky `users`
--

CREATE TABLE `users` (
                         `id` int(11) NOT NULL,
                         `mail` varchar(50) COLLATE utf8_czech_ci NOT NULL,
                         `password` varchar(1000) COLLATE utf8_czech_ci NOT NULL,
                         `name` varchar(50) COLLATE utf8_czech_ci DEFAULT NULL,
                         `surname` varchar(50) COLLATE utf8_czech_ci DEFAULT NULL,
                         `role` varchar(20) COLLATE utf8_czech_ci NOT NULL,
                         `active` tinyint(1) NOT NULL,
                         `author_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_czech_ci;

--
-- Vypisuji data pro tabulku `users`
--

INSERT INTO `users` (`id`, `mail`, `password`, `name`, `surname`, `role`, `active`, `author_id`) VALUES
                                                                                                     (3, 'admin@nekonews.com', '$2y$10$Vq7mv4fNL4kEjIJtHIsz4eeNRcMWVI2wjHr/Y9vgW3avnHi1WTs6K', 'Admin', 'Admin', 'admin', 1, NULL),
                                                                                                     (4, 'jenda@gmail.com', '$2y$10$Ch0K2Yd4yyZ3e8nF/Y7UAeVV86dxmy1hlqlZarhyDGndBfUGojynC', 'Jenda', 'Adnej', 'editor', 1, NULL),
                                                                                                     (5, 'karel@vomacka.cz', '$2y$10$m8aMZ/S.EeOYpbkzcVz8iOMpm4JyRd.JqLlx2QaFHPGKhN74FgAbS', 'Karel', 'Vomačka', 'admin', 1, NULL),
                                                                                                     (6, 'vomacka.karel@nekonews.com', '$2y$10$ohf4P9aAEVbeXYnEWmON.eS2MMA5xLfK9eASzvq0ZWM.N3e20YpkC', 'Karel', 'Vomáčka', 'user', 1, NULL),
                                                                                                     (7, 'mlada.eliska@nekonews.com', '$2y$10$SImuLOtGUJG6Tx/jPldK9etp9XmxL8ju1gI2tORjsDQ5Q213h.vwC', 'Eliška', 'Mladá', 'user', 1, NULL);

--
-- Klíče pro exportované tabulky
--

--
-- Klíče pro tabulku `article`
--
ALTER TABLE `article`
    ADD PRIMARY KEY (`id`),
    ADD KEY `author_id` (`author_id`);

--
-- Klíče pro tabulku `article_category`
--
ALTER TABLE `article_category`
    ADD PRIMARY KEY (`article_id`,`category_id`),
    ADD KEY `category_id` (`category_id`);

--
-- Klíče pro tabulku `author`
--
ALTER TABLE `author`
    ADD PRIMARY KEY (`id`);

--
-- Klíče pro tabulku `category`
--
ALTER TABLE `category`
    ADD PRIMARY KEY (`id`);

--
-- Klíče pro tabulku `users`
--
ALTER TABLE `users`
    ADD PRIMARY KEY (`id`),
    ADD UNIQUE KEY `mail` (`mail`),
    ADD UNIQUE KEY `author_id` (`author_id`);

--
-- AUTO_INCREMENT pro tabulky
--

--
-- AUTO_INCREMENT pro tabulku `article`
--
ALTER TABLE `article`
    MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT pro tabulku `author`
--
ALTER TABLE `author`
    MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT pro tabulku `category`
--
ALTER TABLE `category`
    MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT pro tabulku `users`
--
ALTER TABLE `users`
    MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- Omezení pro exportované tabulky
--

--
-- Omezení pro tabulku `article`
--
ALTER TABLE `article`
    ADD CONSTRAINT `article_ibfk_1` FOREIGN KEY (`author_id`) REFERENCES `author` (`id`);

--
-- Omezení pro tabulku `article_category`
--
ALTER TABLE `article_category`
    ADD CONSTRAINT `article_category_ibfk_1` FOREIGN KEY (`article_id`) REFERENCES `article` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
    ADD CONSTRAINT `article_category_ibfk_2` FOREIGN KEY (`category_id`) REFERENCES `category` (`id`) ON UPDATE CASCADE;

--
-- Omezení pro tabulku `users`
--
ALTER TABLE `users`
    ADD CONSTRAINT `fk_users_author` FOREIGN KEY (`author_id`) REFERENCES `author` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
