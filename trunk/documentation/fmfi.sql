-- phpMyAdmin SQL Dump
-- version 3.5.1
-- http://www.phpmyadmin.net
--
-- Hostiteľ: localhost
-- Vygenerované: Po 04.Feb 2013, 01:37
-- Verzia serveru: 5.5.24-log
-- Verzia PHP: 5.4.3

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Databáza: `fmfi`
--

-- --------------------------------------------------------

--
-- Štruktúra tabuľky pre tabuľku `degrees`
--

CREATE TABLE IF NOT EXISTS `degrees` (
  `degree_id` int(11) NOT NULL AUTO_INCREMENT,
  `degree_name` varchar(255) DEFAULT NULL,
  `degree_grade` int(11) DEFAULT NULL,
  PRIMARY KEY (`degree_id`),
  UNIQUE KEY `degree_name_UNIQUE` (`degree_name`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=2 ;

--
-- Sťahujem dáta pre tabuľku `degrees`
--

INSERT INTO `degrees` (`degree_id`, `degree_name`, `degree_grade`) VALUES
(1, 'Žiaden', 0);

-- --------------------------------------------------------

--
-- Štruktúra tabuľky pre tabuľku `deleted_users`
--

CREATE TABLE IF NOT EXISTS `deleted_users` (
  `deleted_user_id` int(11) NOT NULL AUTO_INCREMENT,
  `deleted_user_user_clean_id` int(11) DEFAULT NULL,
  `deleted_user_name` varchar(255) DEFAULT NULL,
  `deleted_user_surname` varchar(255) DEFAULT NULL,
  `deleted_user_email` varchar(255) DEFAULT NULL,
  `deleted_user_birth_day` date DEFAULT NULL,
  PRIMARY KEY (`deleted_user_id`),
  KEY `fk_deleted_users_user_clean_id` (`deleted_user_user_clean_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Štruktúra tabuľky pre tabuľku `email_types`
--

CREATE TABLE IF NOT EXISTS `email_types` (
  `email_type_id` int(11) NOT NULL AUTO_INCREMENT,
  `email_type_name` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`email_type_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Štruktúra tabuľky pre tabuľku `events`
--

CREATE TABLE IF NOT EXISTS `events` (
  `event_id` int(11) NOT NULL AUTO_INCREMENT,
  `event_author_id` int(11) DEFAULT NULL,
  `event_event_category_id` int(11) DEFAULT NULL,
  `event_priority` int(11) DEFAULT NULL,
  `event_name` varchar(255) DEFAULT NULL,
  `event_about` text,
  `event_created` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `event_from` datetime DEFAULT NULL,
  `event_to` datetime DEFAULT NULL,
  PRIMARY KEY (`event_id`),
  KEY `fk_events_author_id` (`event_author_id`),
  KEY `fk_events_event_categor_id` (`event_event_category_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Štruktúra tabuľky pre tabuľku `event_categories`
--

CREATE TABLE IF NOT EXISTS `event_categories` (
  `event_category_id` int(11) NOT NULL AUTO_INCREMENT,
  `event_category_name` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`event_category_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=2 ;

--
-- Sťahujem dáta pre tabuľku `event_categories`
--

INSERT INTO `event_categories` (`event_category_id`, `event_category_name`) VALUES
(1, 'Ostatné');

-- --------------------------------------------------------

--
-- Štruktúra tabuľky pre tabuľku `fin_category_transactions`
--

CREATE TABLE IF NOT EXISTS `fin_category_transactions` (
  `fin_category_transaction_id` int(11) NOT NULL AUTO_INCREMENT,
  `fin_category_transaction_cat_from_id` int(11) DEFAULT NULL,
  `fin_category_transaction_cat_to_id` int(11) DEFAULT NULL,
  `fin_category_transaction_cash` float DEFAULT NULL,
  PRIMARY KEY (`fin_category_transaction_id`),
  KEY `fk_category_transactions_cat_from_id` (`fin_category_transaction_cat_from_id`),
  KEY `fk_category_transactions_cat_to_id` (`fin_category_transaction_cat_to_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Štruktúra tabuľky pre tabuľku `fin_redistributes`
--

CREATE TABLE IF NOT EXISTS `fin_redistributes` (
  `fin_redistribute_id` int(11) NOT NULL AUTO_INCREMENT,
  `fin_redistribute_payment_id` int(11) DEFAULT NULL,
  `fin_redistribute_project_category_id` int(11) DEFAULT NULL,
  `fin_redistribute_ratio` int(11) DEFAULT NULL,
  PRIMARY KEY (`fin_redistribute_id`),
  KEY `fk_fin_redistributes_project_category_id` (`fin_redistribute_project_category_id`),
  KEY `fk_fin_redistribute_payment_id` (`fin_redistribute_payment_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Štruktúra tabuľky pre tabuľku `pages`
--

CREATE TABLE IF NOT EXISTS `pages` (
  `page_rules` text NOT NULL,
  `page_about` text NOT NULL,
  `page_contact` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Sťahujem dáta pre tabuľku `pages`
--

INSERT INTO `pages` (`page_rules`, `page_about`, `page_contact`) VALUES
('[h2] [color=#880D0F]STANOVY OBČIANSKÉHO ZDRUŽENIA alumni FMFI[/color][/h2]\r\n[br]\r\n[b]PODĽA ZÁKONA č. 83/1990 Zb. O ZDRUŽOVANÍ OBČANOV V ZNENÍ NESKORŠÍCH PREDPISOV[/b][br]\r\n[br]\r\n[b]Úvodné ustanovenie[/b][br]\r\n[br]\r\n[b]a)[/b] Názov združenia: alumni FMFI[br]\r\n &nbsp;&nbsp;&nbsp;&nbsp;&nbsp; Charakteristika: združenie študentov, zamestnancov, absolventov a priateľov FMFI UK[br]\r\n[br]\r\n[b]b)[/b] Sídlo združenia: FMFI UK, Mlynská dolina F1, 842 48 Bratislava[br]\r\n[br]\r\n[b]c) Ciele a úlohy združenia[/b][br]\r\n[br]\r\nČlenovia občianskeho združenia alumni FMFI (daľej o.z.) si uvedomujú význam rozvoja vedy a vzdelania pre rozvoj vzdelanostnej úrovne regiónu a jeho dosah na celkový hospodársky, ekonomický, kultúrny a spoločenský rozvoj. Hlavným cieľom o.z. je podpora všestranného rozvoja Fakulty matematiky, fyziky a informatiky Univerzity Komenského v Bratislave (ďalej FMFI UK) a to najmä v nasledujúcich oblastiach:[br]\r\n[br]\r\n[ul]\r\n    [li]podpora vzdelávania,[/li]\r\n    [li]podpora a rozvoj telesnej kultúry, podpora športu detí a mládeže (študentov fakulty, detí zamestnancov, absolventov a členov združenia, ...),[/li]\r\n    [li]zachovanie kultúrnych hodnôt,[/li]\r\n    [li]poskytovanie sociálnej pomoci a podpora zdravotne postihnutých občanov,[/li]\r\n    [li]podpora študentských aktivít,[/li]\r\n    [li]organizácia odborných, kultúrnych a spoločenských podujatí,[/li]\r\n    [li]podpora mobility študentov, učiteľov a zamestnancov,[/li]\r\n    [li]vydavateľská a konzultačná činnosť,[/li]\r\n    [li]vytváranie podmienok pre trvalú existenciu intelektuálneho akademického prostredia na pracoviskách FMFI UK,[/li]\r\n    [li]príprava ďalších projektov,[/li][br]\r\n    [li]podpora vedy a výskumu a ich prepojenie s praxou,[/li]\r\n    [li]spolupráca s vysokými školami a odbornými inštitúciami v Slovenskej republike a v zahraničí,[/li]\r\n    [li]spolupráce so základnými a strednými školami,[/li][/ul]\r\n[br]\r\nObčianske združenie chce dosiahnuť svoje ciele prostredníctvom aktivít smerujúcich k úzkej spolupráci FMFI UK s orgánmi regionálnej a miestnej správy a samosprávy, k spolupráci s podnikateľskými a finančnými subjektami a masmédiami, ako aj prostredníctvom získavania finančných prostriedkov a darov.[br]\r\n[br]\r\n[b]d) Členstvo v združení[/b][br]\r\n\r\nČlenstvo v združení môže byť:[br]\r\n[br]\r\n    [ul][li][u]Čestné[/u] – môže potvrdiť členská schôdza na návrh výkonnej rady alebo štatutára združenia tomu, kto sa významným spôsobom zaslúžil o rozvoj združenia alebo FMFI UK.[/li]\r\n    [li][u]Prispievateľské[/u] – fyzická alebo právnická osoba, ktorá riadne zaplatila členský príspevok vo výške minimálne 5€. Členstvo vzniká prijatím členského príspevku a zaniká k 31.12. v kalendárnom roku, keď člen nezaplatil členský príspevok.[/li]\r\n    [li][u]Činné[/u] – osoba aktívne sa podieľajúca na aktivitách občianskeho združenia. Členstvo v združení vzniká prijatím člena výkonnou radou na základe písomnej žiadosti uchádzača o členstvo.[/li][/ul]\r\n[br]\r\n[u]Práva členov:[/u][br]\r\n[br]\r\n    [ul][li]podieľať sa na činnosti združenia,[/li]\r\n    [li]voliť a byť volený do orgánov združenia,[/li]\r\n    [li]obracať sa na orgány združenia s námetmi a sťažnosťami a žiadať o stanovisko,[/li]\r\n    [li]byť informovaný o činnosti a o rozhodnutiach orgánov združenia.[/li][/ul]\r\n[br]\r\n[u]Povinnosti členov[/u][br]\r\n[br]\r\n    [ul][li]dodržiavať stanovy združenia,[/li]\r\n    [li]pomáhať pri plnení cieľov združenia a aktívne sa podieľať na jeho práci,[/li]\r\n    [li]podľa svojho svedomia, rozsahu svojich možností a schopností pomáhať orgánom združenia,[/li]\r\n    [li]platiť členské príspevky,[/li]\r\n    [li]ochraňovať a zveľaďovať majetok združenia.[/li]\r\n[/ul]\r\n[u]Zánik členstva[/u][br]\r\n[br]\r\n    [ul][li]vystúpením – členstvo zaniká dňom doručenia písomného oznámenia člena o vystúpení zo združenia,[/li]\r\n    [li]úmrtím fyzickej osoby, resp. zánikom právnickej osoby,[/li]\r\n    [li]zánikom združenia,[/li]\r\n    [li]vyškrtnutím z dôvodu nečinnosti člena (týka sa činných členov),[/li]\r\n    [li]k 31.12. v kalendárnom roku keď nebol zaplatený členský príspevok,[/li]\r\n    [li]vylúčením, ak člen opätovne a napriek výstrahe porušuje členské povinnosti, alebo z iných dôležitých dôvodov. O podmienečnom vylúčení rozhoduje výkonná rada. Proti rozhodnutiu o vylúčení má právo podať člen odvolanie na členskú schôdzu, ktorá potvrdzuje rozhodnutie nadpolovičnou väčšinou.[/li][/ul]\r\n[br]\r\n[b]e) Organizačná štruktúra združenia[/b][br]\r\n[br]\r\n    [ol][li]najvyšší orgán - [u]členská schôdza[/u] - delegáti členskej základne,[/li]\r\n    [li]výkonný orgán - [u]výkonná rada[/u] – 3 členná spomedzi činných členov o.z. – 2 členov menuje a odvoláva dekan FMFI UK, 1 člena volí a odvoláva členská schôdza,[/li]\r\n    [li]štatutárny orgán – [u]predseda výkonnej rady[/u] – volia si ho spomedzi seba členovia výkonnej rady,[/li]\r\n    [li]kontrolný orgán - [u]revízna komisia[/u] - 3 členná spomedzi činných, prispievateľských členov - navrhuje a schvaľuje členská schôdza.[/li][/ol]\r\n[br]\r\nFunkčné obdobie orgánov združenia je štandardne 4 roky. Zvolený (menovaný) člen výkonnej rady a revíznej komisie zastáva svoju funkciu pokiaľ nie je zvolený (menovaný) nový člen. V prípade ukončenie výkonu funkcie (z dôvodu napr. odstúpenia, úmrtia, zrušenia členstva,...) nového dočasného vykonávateľa funkcie do najbližšej členskej schôdze menuje dekan FMFI UK. Funkcie vo výkonnej rade a revíznej komisií sú navzájom nezlučiteľné. Prípravný výbor sa vznikom o.z. automaticky stáva výkonnou radou (okrem dekana) a má povinnosť do pol roka od vzniku o.z. zvolať prvú členskú schôdzu.[br]\r\n[br]\r\n[b]f) Spôsob ustanovenia orgánov a ich právomoci[/b][br]\r\n1) [u]Členská schôdza[/u] o.z. je tvorená z delegátov členskej základne[br]\r\n[br]\r\n    [ul][li]delegátom členskej základne je každý člen o.z., ktorý sa účastní členskej schôdze,[/li]\r\n    [li]pravidelná výročná členská schôdza je zvolávaná výkonnou radou raz ročne,[/li]\r\n    [li]mimoriadnu členskú schôdzu môže navrhnúť každý člen o.z. na základe písomnej žiadosti výkonnej rade podpísanej 20 členmi o.z. ,[/li]\r\n    [li]členská schôdza volí tretieho člena výkonnej rady nadpolovičnou väčšinou prítomných členov,[/li]\r\n    [li]volí a odvoláva členov revíznej komisie,[/li]\r\n    [li]rozhoduje o zániku združenia zlúčením s iným občianskym združením alebo dobrovoľným rozpustením,[/li]\r\n    [li]schvaľuje plán činnosti a výročnú správu,[/li]\r\n    [li]schvaľuje rozpočet a správu o hospodárení,[/li]\r\n    [li]potvrdzuje prijatie nových členov a vylúčenie členov.[/li]\r\n[/ul]\r\n2) [u]Výkonná rada[/u]\r\n\r\n    [ul][li]je za svoju činnosť zodpovedná členskej schôdzi,[/li]\r\n    [li]riadi činnosť združenia,[/li]\r\n    [li]schvaľuje stanovy, ich zmeny a doplnky,[/li]\r\n    [li]zvoláva a obsahovo pripravuje rokovanie najvyššieho orgánu a pripravuje základné materiály na tieto rokovania,[/li]\r\n    [li]zvoláva výročnú členskú schôdzu – minimálne raz ročne, kde predkladá výročnú správu o činnosti o.z.,[/li]\r\n    [li]je povinná zvolať mimoriadnu členskú schôdzu, najneskôr do 30 dní od obdržania písomnej žiadosti o jej konanie. Má však možnosť posunúť termín mimoriadnej členskej schôdze tak, aby časový odstup od poslednej členskej schôdze bol aspoň tri mesiace,[/li]\r\n    [li]schvaľuje prijatie nových činných členov.[/li][/ul]\r\n[br]\r\n3) [u]Štatutárnym orgánom[/u] združenia je predseda výkonnej rady.[br][br]\r\n4) [u]Revízna komisia[/u][br]\r\n[ul]\r\n    [li]je kontrolným orgánom, ktorý za svoju činnosť zodpovedá členskej základni,[/li]\r\n    [li]predkladá výročnú správu o kontrole činnosti o.z. minimálne raz ročne na výročnej členskej schôdzi,[/li]\r\n    [li]kontroluje hospodárenie združenia, upozorňuje orgány združenia na nedostatky a navrhuje opatrenia na ich odstránenie,[/li]\r\n    [li]kontroluje aj dodržiavanie stanov a vnútorných predpisov,[/li]\r\n    [li]spomedzi seba volia členovia revíznej komisie predsedu revíznej komisie,[/li]\r\n[/ul]\r\n[br]\r\n[b]g) Zásady hospodárenia[/b][br]\r\n[br]\r\n[ul][li]hospodárenie sa uskutočňuje podľa schváleného rozpočtu,[/li]\r\n    [li]združenie hospodári s hnuteľným a nehnuteľným majetkom (ak ho má),[/li]\r\n    [li]zdrojmi majetku sú: členské príspevky, dary od fyzických osôb, dary, dotácie a granty od právnických osôb,[/li]\r\n    [li]výnosy z majetku a vlastnej činnosti môžu byt použité len na podporu cieľa združenia,[/li]\r\n    [li]V záujme vytvárania vlastných zdrojov môže združenie vykonávať v doplnkovom rozsahu vo vzťahu k záujmovej činnosti podnikateľskú činnosť, súvisiacu so zabezpečovaním cieľov a poslania združenia, a v súlade so všeobecne záväznými predpismi a stanovami.[/li]\r\n[/ul]\r\n[br]\r\n[b]h) Zánik združenia[/b][br]\r\nO zániku združenia zlúčením s iným občianskym združením alebo dobrovoľným rozpustením rozhoduje členská schôdza, ktorá menuje likvidátora. Likvidátor najskôr vyrovná všetky záväzky a pohľadávky a s likvidačným zostatkom naloží podľa rozhodnutia výkonnej rady. Zánik združenia treba oznámiť do 15 dní po ukončení likvidácie Ministerstvu vnútra Slovenskej republiky. Pri likvidácii združenia sa primerane postupuje podľa §70 – 75 Obchodného zákonníka.', 'O nás', 'Kontakt');

-- --------------------------------------------------------

--
-- Štruktúra tabuľky pre tabuľku `payments`
--

CREATE TABLE IF NOT EXISTS `payments` (
  `payment_id` int(11) NOT NULL AUTO_INCREMENT,
  `payment_vs` int(11) DEFAULT NULL,
  `payment_total_sum` float DEFAULT NULL,
  `payment_paid_sum` float DEFAULT '0',
  `payment_user_id` int(11) DEFAULT NULL,
  `payment_paid_time` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `payment_type` tinyint(1) NOT NULL,
  `payment_accepted` tinyint(1) NOT NULL DEFAULT '0',
  PRIMARY KEY (`payment_id`),
  KEY `fk_payments_user_id` (`payment_user_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Štruktúra tabuľky pre tabuľku `posts`
--

CREATE TABLE IF NOT EXISTS `posts` (
  `post_id` int(11) NOT NULL AUTO_INCREMENT,
  `post_priority` int(11) NOT NULL,
  `post_title` varchar(255) DEFAULT NULL,
  `post_content` text,
  `post_date` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `post_author_id` int(11) DEFAULT NULL,
  `post_published` tinyint(1) DEFAULT '0',
  PRIMARY KEY (`post_id`),
  KEY `fk_posts_author_id` (`post_author_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Štruktúra tabuľky pre tabuľku `post_modifies`
--

CREATE TABLE IF NOT EXISTS `post_modifies` (
  `post_modifie_id` int(11) NOT NULL AUTO_INCREMENT,
  `post_modifie_post_id` int(11) DEFAULT NULL,
  `post_modifie_author_id` int(11) DEFAULT NULL,
  `post_modifie_date` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`post_modifie_id`),
  KEY `fk_post_modifies_post_id` (`post_modifie_post_id`),
  KEY `fk_post_modifies_author_id` (`post_modifie_author_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Štruktúra tabuľky pre tabuľku `projects`
--

CREATE TABLE IF NOT EXISTS `projects` (
  `project_id` int(11) NOT NULL AUTO_INCREMENT,
  `project_project_category_id` int(11) DEFAULT NULL,
  `project_priority` int(11) DEFAULT NULL,
  `project_name` varchar(255) DEFAULT NULL,
  `project_about` text,
  `project_booked_cash` float DEFAULT NULL,
  `project_date_created` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `project_active` tinyint(1) DEFAULT NULL,
  `project_date_from` date DEFAULT NULL,
  `project_date_to` date DEFAULT NULL,
  PRIMARY KEY (`project_id`),
  KEY `fk_projects_project_category_id` (`project_project_category_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Štruktúra tabuľky pre tabuľku `project_categories`
--

CREATE TABLE IF NOT EXISTS `project_categories` (
  `project_category_id` int(11) NOT NULL AUTO_INCREMENT,
  `project_category_name` varchar(255) DEFAULT NULL,
  `project_category_cash` float DEFAULT NULL,
  PRIMARY KEY (`project_category_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=2 ;

--
-- Sťahujem dáta pre tabuľku `project_categories`
--

INSERT INTO `project_categories` (`project_category_id`, `project_category_name`, `project_category_cash`) VALUES
(1, 'Ostatné', 0);

-- --------------------------------------------------------

--
-- Štruktúra tabuľky pre tabuľku `project_items`
--

CREATE TABLE IF NOT EXISTS `project_items` (
  `project_item_id` int(11) NOT NULL AUTO_INCREMENT,
  `project_item_project_id` int(11) DEFAULT NULL,
  `project_item_user_id` int(11) DEFAULT NULL,
  `project_item_name` varchar(255) DEFAULT NULL,
  `project_item_price` float DEFAULT NULL,
  `project_item_date` date DEFAULT NULL,
  PRIMARY KEY (`project_item_id`),
  KEY `fk_project_item_project_id` (`project_item_project_id`),
  KEY `fk_project_item_user_id` (`project_item_user_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Štruktúra tabuľky pre tabuľku `study_programs`
--

CREATE TABLE IF NOT EXISTS `study_programs` (
  `study_program_id` int(11) NOT NULL AUTO_INCREMENT,
  `study_program_name` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`study_program_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=2 ;

--
-- Sťahujem dáta pre tabuľku `study_programs`
--

INSERT INTO `study_programs` (`study_program_id`, `study_program_name`) VALUES
(1, 'Žiaden');

-- --------------------------------------------------------

--
-- Štruktúra tabuľky pre tabuľku `users`
--

CREATE TABLE IF NOT EXISTS `users` (
  `user_id` int(11) NOT NULL AUTO_INCREMENT,
  `user_date` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `user_postcode` int(11) DEFAULT NULL,
  `user_study_program_id` int(11) DEFAULT NULL,
  `user_degree_id` int(11) DEFAULT NULL,
  `user_place_of_birth` varchar(255) DEFAULT NULL,
  `user_degree_year` int(11) DEFAULT NULL,
  `user_role` int(11) DEFAULT NULL,
  `user_username` varchar(255) DEFAULT NULL,
  `user_name` varchar(255) DEFAULT NULL,
  `user_surname` varchar(255) DEFAULT NULL,
  `user_password` varchar(255) DEFAULT NULL,
  `user_email` varchar(255) DEFAULT NULL,
  `user_phone` varchar(11) DEFAULT NULL,
  `user_exempted` tinyint(4) DEFAULT '0',
  `user_activated` datetime DEFAULT NULL,
  PRIMARY KEY (`user_id`),
  KEY `fk_users_study_program_id` (`user_study_program_id`),
  KEY `fk_users_degree_id` (`user_degree_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=2 ;

--
-- Sťahujem dáta pre tabuľku `users`
--

INSERT INTO `users` (`user_id`, `user_date`, `user_postcode`, `user_study_program_id`, `user_degree_id`, `user_place_of_birth`, `user_degree_year`, `user_role`, `user_username`, `user_name`, `user_surname`, `user_password`, `user_email`, `user_phone`, `user_exempted`, `user_activated`) VALUES
(1, NULL, NULL, NULL, NULL, NULL, NULL, 1, 'root', 'Admin', 'Admin', 'dd94709528bb1c83d08f3088d4043f4742891f4f', 'admin@admin.sk', NULL, 1, NULL);

-- --------------------------------------------------------

--
-- Štruktúra tabuľky pre tabuľku `user_cleans`
--

CREATE TABLE IF NOT EXISTS `user_cleans` (
  `user_clean_id` int(11) NOT NULL AUTO_INCREMENT,
  `user_clean_date` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`user_clean_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Štruktúra tabuľky pre tabuľku `user_email_evidence`
--

CREATE TABLE IF NOT EXISTS `user_email_evidence` (
  `user_email_evidence_id` int(11) NOT NULL AUTO_INCREMENT,
  `user_email_evidence_email_type_id` int(11) DEFAULT NULL,
  `user_email_evidence_user_id` int(11) DEFAULT NULL,
  `user_email_evidence_date` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`user_email_evidence_id`),
  KEY `fk_user_email_evidence_email_type_id` (`user_email_evidence_email_type_id`),
  KEY `fk_user_email_evidence_user_id` (`user_email_evidence_user_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

--
-- Obmedzenie pre exportované tabuľky
--

--
-- Obmedzenie pre tabuľku `deleted_users`
--
ALTER TABLE `deleted_users`
  ADD CONSTRAINT `deleted_users_ibfk_1` FOREIGN KEY (`deleted_user_user_clean_id`) REFERENCES `user_cleans` (`user_clean_id`) ON DELETE SET NULL ON UPDATE NO ACTION;

--
-- Obmedzenie pre tabuľku `events`
--
ALTER TABLE `events`
  ADD CONSTRAINT `events_ibfk_1` FOREIGN KEY (`event_author_id`) REFERENCES `users` (`user_id`) ON DELETE SET NULL ON UPDATE NO ACTION,
  ADD CONSTRAINT `events_ibfk_2` FOREIGN KEY (`event_event_category_id`) REFERENCES `event_categories` (`event_category_id`) ON DELETE SET NULL ON UPDATE NO ACTION;

--
-- Obmedzenie pre tabuľku `fin_category_transactions`
--
ALTER TABLE `fin_category_transactions`
  ADD CONSTRAINT `fin_category_transactions_ibfk_1` FOREIGN KEY (`fin_category_transaction_cat_from_id`) REFERENCES `project_categories` (`project_category_id`) ON DELETE SET NULL ON UPDATE NO ACTION,
  ADD CONSTRAINT `fin_category_transactions_ibfk_2` FOREIGN KEY (`fin_category_transaction_cat_to_id`) REFERENCES `project_categories` (`project_category_id`) ON DELETE SET NULL ON UPDATE NO ACTION;

--
-- Obmedzenie pre tabuľku `fin_redistributes`
--
ALTER TABLE `fin_redistributes`
  ADD CONSTRAINT `fin_redistributes_ibfk_2` FOREIGN KEY (`fin_redistribute_project_category_id`) REFERENCES `project_categories` (`project_category_id`) ON DELETE SET NULL ON UPDATE NO ACTION,
  ADD CONSTRAINT `fin_redistributes_ibfk_7` FOREIGN KEY (`fin_redistribute_payment_id`) REFERENCES `payments` (`payment_id`) ON DELETE CASCADE ON UPDATE NO ACTION;

--
-- Obmedzenie pre tabuľku `payments`
--
ALTER TABLE `payments`
  ADD CONSTRAINT `payments_ibfk_4` FOREIGN KEY (`payment_user_id`) REFERENCES `users` (`user_id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Obmedzenie pre tabuľku `posts`
--
ALTER TABLE `posts`
  ADD CONSTRAINT `posts_ibfk_1` FOREIGN KEY (`post_author_id`) REFERENCES `users` (`user_id`) ON DELETE SET NULL ON UPDATE NO ACTION;

--
-- Obmedzenie pre tabuľku `post_modifies`
--
ALTER TABLE `post_modifies`
  ADD CONSTRAINT `post_modifies_ibfk_1` FOREIGN KEY (`post_modifie_author_id`) REFERENCES `users` (`user_id`) ON DELETE SET NULL ON UPDATE NO ACTION,
  ADD CONSTRAINT `post_modifies_ibfk_2` FOREIGN KEY (`post_modifie_post_id`) REFERENCES `posts` (`post_id`) ON DELETE SET NULL ON UPDATE NO ACTION;

--
-- Obmedzenie pre tabuľku `projects`
--
ALTER TABLE `projects`
  ADD CONSTRAINT `projects_ibfk_1` FOREIGN KEY (`project_project_category_id`) REFERENCES `project_categories` (`project_category_id`) ON DELETE SET NULL ON UPDATE NO ACTION;

--
-- Obmedzenie pre tabuľku `project_items`
--
ALTER TABLE `project_items`
  ADD CONSTRAINT `project_items_ibfk_1` FOREIGN KEY (`project_item_project_id`) REFERENCES `projects` (`project_id`) ON DELETE SET NULL ON UPDATE NO ACTION,
  ADD CONSTRAINT `project_items_ibfk_2` FOREIGN KEY (`project_item_user_id`) REFERENCES `users` (`user_id`) ON DELETE SET NULL ON UPDATE NO ACTION;

--
-- Obmedzenie pre tabuľku `users`
--
ALTER TABLE `users`
  ADD CONSTRAINT `users_ibfk_7` FOREIGN KEY (`user_study_program_id`) REFERENCES `study_programs` (`study_program_id`) ON DELETE SET NULL ON UPDATE NO ACTION,
  ADD CONSTRAINT `users_ibfk_8` FOREIGN KEY (`user_degree_id`) REFERENCES `degrees` (`degree_id`) ON DELETE SET NULL ON UPDATE NO ACTION;

--
-- Obmedzenie pre tabuľku `user_email_evidence`
--
ALTER TABLE `user_email_evidence`
  ADD CONSTRAINT `user_email_evidence_ibfk_1` FOREIGN KEY (`user_email_evidence_email_type_id`) REFERENCES `email_types` (`email_type_id`) ON DELETE SET NULL ON UPDATE NO ACTION,
  ADD CONSTRAINT `user_email_evidence_ibfk_2` FOREIGN KEY (`user_email_evidence_user_id`) REFERENCES `users` (`user_id`) ON DELETE SET NULL ON UPDATE NO ACTION;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
