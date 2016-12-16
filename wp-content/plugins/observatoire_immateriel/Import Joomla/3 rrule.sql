-- phpMyAdmin SQL Dump
-- version 2.11.8.1deb5+lenny9
-- http://www.phpmyadmin.net
--
-- Serveur: hostingmysql114
-- Généré le : Jeu 13 Août 2015 à 15:56
-- Version du serveur: 5.0.96
-- Version de PHP: 5.2.6-1+lenny16

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";

--
-- Base de données: `602803_obsimma3214`
--

-- --------------------------------------------------------

--
-- Structure de la table `jnew_fieldsattach`
--

CREATE TABLE IF NOT EXISTS `jnew_fieldsattach` (
  `id` int(11) NOT NULL auto_increment,
  `title` varchar(200) NOT NULL,
  `extras` text NOT NULL,
  `showtitle` tinyint(1) NOT NULL,
  `positionarticle` tinyint(1) default '0',
  `type` varchar(20) NOT NULL,
  `groupid` int(11) default NULL,
  `articlesid` varchar(255) default NULL,
  `language` varchar(20) NOT NULL,
  `visible` tinyint(1) NOT NULL,
  `ordering` int(11) NOT NULL,
  `published` tinyint(1) NOT NULL,
  `required` tinyint(1) default NULL,
  `searchable` tinyint(1) default NULL,
  `params` text NOT NULL,
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=9 ;

--
-- Contenu de la table `jnew_fieldsattach`
--

INSERT INTO `jnew_fieldsattach` (`id`, `title`, `extras`, `showtitle`, `positionarticle`, `type`, `groupid`, `articlesid`, `language`, `visible`, `ordering`, `published`, `required`, `searchable`, `params`) VALUES
(6, 'Document partagé :', '', 1, 1, 'file', 3, NULL, '*', 1, 0, 1, 0, 0, '{"field_checkbox_name":"","field_checkbox_value":"","field_textarea":"","field_defaultvaluetextarea":"","galleryimage2":"1","galleryimage3":"1","gallerydescription":"1","field_selectable":"","field_selectable2":"","field_width":"","field_height":"","field_filter":"","field_size":"","field_maxlenght":"","field_defaultvalue":"","field_radiobutton_name":"","field_radiobutton_value":"","TMP":""}'),
(3, 'Typologie :', 'Étude|étude\r\nLivre|livre\r\nThèse|thèse\r\nRapport|rapport\r\nPrésentation|présentation\r\nDiscours|discours\r\nConférence|conférence\r\nAppel d''offre|appel d''offre\r\nProposition de recherche|proposition de recherche\r\nAutre|autre\r\n |value0|true', 0, 1, 'select', 3, NULL, '*', 1, 0, 1, 0, 1, '{"field_checkbox_name":"","field_checkbox_value":"","field_textarea":"","field_defaultvaluetextarea":"","galleryimage2":"1","galleryimage3":"1","gallerydescription":"1","field_selectable":"","field_selectable2":"","field_width":"","field_height":"","field_filter":"","field_size":"","field_maxlenght":"","field_defaultvalue":"","field_radiobutton_name":"","field_radiobutton_value":"","TMP":""}'),
(8, 'Mode d''emploi', '|Pour publier un document, veuillez choisir un catégorie dominante et attribuez l''accès de consultation.\r\n\r\nExemple si vous voulez que le document soit consultable par tous les membres de l''espace privé, choisir "Bureau OI - DGCIS - Membres OI - Partenaires DGCIS"\r\n\r\n ', 1, 0, 'textarea', 4, NULL, '*', 1, 0, 0, 0, 0, '{"field_checkbox_name":"","field_checkbox_value":"","field_textarea":"","field_defaultvaluetextarea":"Pour publier un document, veuillez choisir un cat\\u00e9gorie dominante et attribuez l''acc\\u00e8s de consultation.\\r\\n\\r\\nExemple si vous voulez que le document soit consultable par tous les membres de l''espace priv\\u00e9, choisir \\"Bureau OI - DGCIS - Membres OI - Partenaires DGCIS\\"\\r\\n\\r\\n ","galleryimage2":"1","galleryimage3":"1","gallerydescription":"1","field_selectable":"","field_selectable2":"","field_width":"","field_height":"","field_filter":"","field_size":"","field_maxlenght":"","field_defaultvalue":"","field_radiobutton_name":"","field_radiobutton_value":"","TMP":""}');

-- --------------------------------------------------------

--
-- Structure de la table `jnew_fieldsattach_categories_values`
--

CREATE TABLE IF NOT EXISTS `jnew_fieldsattach_categories_values` (
  `id` int(11) NOT NULL auto_increment,
  `catid` int(11) NOT NULL,
  `fieldsid` int(11) NOT NULL,
  `value` text NOT NULL,
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

--
-- Contenu de la table `jnew_fieldsattach_categories_values`
--


-- --------------------------------------------------------

--
-- Structure de la table `jnew_fieldsattach_groups`
--

CREATE TABLE IF NOT EXISTS `jnew_fieldsattach_groups` (
  `id` int(11) NOT NULL auto_increment,
  `title` varchar(255) NOT NULL,
  `note` varchar(150) default NULL,
  `description` text,
  `position` varchar(255) default NULL,
  `group_for` int(1) default NULL,
  `showtitle` tinyint(1) NOT NULL,
  `catid` varchar(100) NOT NULL,
  `articlesid` varchar(255) default NULL,
  `recursive` tinyint(1) NOT NULL,
  `language` varchar(7) NOT NULL,
  `ordering` int(11) NOT NULL,
  `published` tinyint(1) NOT NULL,
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=5 ;

--
-- Contenu de la table `jnew_fieldsattach_groups`
--

INSERT INTO `jnew_fieldsattach_groups` (`id`, `title`, `note`, `description`, `position`, `group_for`, `showtitle`, `catid`, `articlesid`, `recursive`, `language`, `ordering`, `published`) VALUES
(2, 'Type de document', '', '<p>Veuillez choisir le type de document</p>', '1', 0, 1, '47,48,49,50,51,52,53,54,55,56,57', '', 1, '*', 0, 0),
(3, 'Attacher un document', '', '<p>Cliquez sur parcourir pour ajouter un document.</p>', '0', 0, 1, '0', '', 0, '*', 0, 1),
(4, 'Instructions', '', '<p>Pour publier un document, veuillez choisir un catégorie dominante et attribuez l''accès de consultation.</p>\r\n<p>Exemple si vous voulez que le document soit consultable par tous les membres de l''espace privé, choisir "Bureau OI - DGCIS - Membres OI - Partenaires DGCIS"</p>\r\n<p> </p>', '1', 0, 1, '0', '', 0, '*', 0, 0);

-- --------------------------------------------------------

--
-- Structure de la table `jnew_fieldsattach_images`
--

CREATE TABLE IF NOT EXISTS `jnew_fieldsattach_images` (
  `id` int(11) NOT NULL auto_increment,
  `articleid` int(11) NOT NULL,
  `fieldsattachid` int(11) NOT NULL,
  `catid` int(11) default NULL,
  `title` varchar(255) NOT NULL,
  `image1` varchar(255) NOT NULL,
  `image2` varchar(255) NOT NULL,
  `image3` varchar(255) NOT NULL,
  `description` text NOT NULL,
  `ordering` int(11) NOT NULL,
  `published` tinyint(1) NOT NULL,
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

--
-- Contenu de la table `jnew_fieldsattach_images`
--


-- --------------------------------------------------------

--
-- Structure de la table `jnew_fieldsattach_values`
--

CREATE TABLE IF NOT EXISTS `jnew_fieldsattach_values` (
  `id` int(11) NOT NULL auto_increment,
  `articleid` int(11) NOT NULL,
  `fieldsid` int(11) NOT NULL,
  `value` text NOT NULL,
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=332 ;

--
-- Contenu de la table `jnew_fieldsattach_values`
--

INSERT INTO `jnew_fieldsattach_values` (`id`, `articleid`, `fieldsid`, `value`) VALUES
(161, 1326, 3, 'value0'),
(162, 1738, 6, ''),
(141, 1715, 3, 'conférence'),
(4, 1478, 1, 'listunits.zip|Doc 3'),
(5, 1478, 3, 'rapport'),
(6, 1486, 5, 'checkbox(1).zip|Mon document'),
(7, 1486, 3, 'rapport'),
(124, 1700, 6, ''),
(10, 1489, 6, 'paper.jpg|doc6'),
(11, 1489, 3, 'conférence'),
(160, 1326, 6, ''),
(159, 1734, 3, 'value0'),
(14, 1486, 6, ''),
(15, 1478, 6, ''),
(157, 1674, 3, 'value0'),
(152, 987, 6, ''),
(153, 987, 3, 'value0'),
(154, 1728, 6, ''),
(155, 1728, 3, 'value0'),
(158, 1734, 6, ''),
(156, 1674, 6, ''),
(149, 1722, 3, 'value0'),
(148, 1722, 6, ''),
(142, 1269, 6, ''),
(143, 1269, 3, 'value0'),
(144, 1717, 6, ''),
(145, 1717, 3, 'value0'),
(146, 1718, 6, ''),
(147, 1718, 3, 'value0'),
(49, 1593, 3, 'thèse'),
(48, 1593, 6, 'Rsultats 2004 de la douane franaise.pdf|fdsqgrbd'),
(56, 1613, 6, 'FFP-guide de reporting à destination des entreprises.pdf|Rendre compte des impacts économiques et sociétaux des investissements en formation professionnelle '),
(164, 1246, 6, ''),
(165, 1246, 3, 'value0'),
(163, 1738, 3, 'value0'),
(54, 1599, 6, 'Thésaurus-Bercy-V2-20131027.pdf|theausurus V2'),
(55, 1599, 3, 'étude'),
(57, 1613, 3, 'rapport'),
(58, 1614, 6, 'FFP-guide de reporting à destination des entreprises.pdf|grille de reporting formation professionnelle'),
(59, 1614, 3, 'rapport'),
(60, 1620, 6, ''),
(61, 1620, 3, 'autre'),
(167, 1740, 3, 'value0'),
(168, 1743, 6, ''),
(166, 1740, 6, ''),
(140, 1715, 6, 'doc_plateforme_franco_allemande.pdf|Présentation/slide table ronde N°2  franco-allemande'),
(66, 1626, 6, ''),
(67, 1626, 3, 'autre'),
(68, 1356, 6, ''),
(69, 1356, 3, 'autre'),
(70, 1463, 6, ''),
(71, 1463, 3, 'autre'),
(72, 1461, 6, ''),
(73, 1461, 3, 'autre'),
(74, 1462, 6, ''),
(75, 1462, 3, 'autre'),
(76, 1456, 6, ''),
(77, 1456, 3, 'autre'),
(80, 1628, 6, ''),
(81, 1628, 3, 'autre'),
(82, 1629, 6, ''),
(83, 1629, 3, 'autre'),
(84, 1630, 6, ''),
(85, 1630, 3, 'autre'),
(86, 1631, 6, ''),
(87, 1631, 3, 'autre'),
(88, 1632, 6, ''),
(89, 1632, 3, 'autre'),
(90, 1633, 6, ''),
(91, 1633, 3, 'autre'),
(92, 1634, 6, ''),
(93, 1634, 3, 'autre'),
(117, 1678, 3, 'livre'),
(96, 1636, 6, ''),
(97, 1636, 3, 'autre'),
(111, 7, 3, 'autre'),
(110, 7, 6, ''),
(116, 1678, 6, 'Gouvernance - Livre Blanc de lObservatoire de limmatériel.pdf|Livre Blanc  : « L’immatériel : nouvelle gouvernance pour l’entreprise »'),
(114, 1645, 6, ''),
(115, 1645, 3, 'value0'),
(106, 1649, 6, 'Thésaurus-Bercy-V2-20131027.pdf|Thesaurus Bercy V2'),
(107, 1649, 3, 'rapport'),
(108, 1650, 6, '|Les Métiers de la PI au service de la compétitivité des organisations'),
(109, 1650, 3, 'étude'),
(112, 4, 6, ''),
(113, 4, 3, 'autre'),
(118, 1679, 6, 'immateriel_pole_competitivite.pdf|Rapport : &quot;valorisation des actifs immatériels des pôles de compéttivité et des clusters&quot;'),
(119, 1679, 3, 'rapport'),
(120, 1681, 6, 'Innovation_collaborative_et_PI_INPI.pdf|Innovation collaborative et propriété intellectuelle'),
(121, 1681, 3, 'autre'),
(122, 1682, 6, 'CIR projet amendement.pdf|Crédit Impôt Recherche « formats » Audiovisuels et numériques'),
(123, 1682, 3, 'proposition de recherche'),
(125, 1700, 3, 'value0'),
(126, 1702, 6, ''),
(127, 1702, 3, 'value0'),
(128, 1704, 6, 'Pôles de Compétitivité.pdf|Valorisation des actifs immatériels des pôles de compétitivité et clusters'),
(129, 1704, 3, 'présentation'),
(130, 1705, 6, 'Tax_issues_in_the_new_digital_environment_YY2877.pdf|Tax issues in the new digital environment'),
(131, 1705, 3, 'étude'),
(132, 1706, 6, 'Rapport-CESE-CI-Final.pdf|Proposition de politique publique en faveur du capital immatériel pour la France'),
(133, 1706, 3, 'rapport'),
(134, 1708, 6, 'Présentation CMP  CapDigital.pdf|Note d’information sur la constitution d’un Centre Multiservices Partagés Audiovisuel et Numérique'),
(135, 1708, 3, 'présentation'),
(136, 1709, 6, ''),
(137, 1709, 3, 'value0'),
(138, 1710, 6, ''),
(139, 1710, 3, 'rapport'),
(169, 1743, 3, 'value0'),
(170, 1744, 6, ''),
(171, 1744, 3, 'value0'),
(172, 1746, 6, ''),
(173, 1746, 3, 'value0'),
(174, 1747, 6, ''),
(175, 1747, 3, 'value0'),
(176, 1748, 6, ''),
(177, 1748, 3, 'value0'),
(178, 1750, 6, ''),
(179, 1750, 3, 'value0'),
(180, 1761, 6, ''),
(181, 1761, 3, 'value0'),
(182, 1762, 6, ''),
(183, 1762, 3, 'value0'),
(184, 1763, 6, ''),
(185, 1763, 3, 'value0'),
(186, 1149, 6, ''),
(187, 1149, 3, 'value0'),
(198, 1789, 6, ''),
(196, 1788, 6, ''),
(197, 1788, 3, 'value0'),
(195, 1787, 3, 'value0'),
(194, 1787, 6, ''),
(199, 1789, 3, 'value0'),
(200, 1790, 6, ''),
(201, 1790, 3, 'value0'),
(202, 1792, 6, 'GT_label_Centre_formation.pdf|&quot;Label des centres de formation des clubs professionnels de football'),
(203, 1792, 3, 'présentation'),
(204, 1793, 6, 'Label_Centre_club_pro.pdf|Label des centres de formation des clubs pros de football'),
(205, 1793, 3, 'présentation'),
(206, 1794, 6, ''),
(207, 1794, 3, 'value0'),
(208, 1796, 6, ''),
(209, 1796, 3, 'value0'),
(210, 1797, 6, ''),
(211, 1797, 3, 'value0'),
(212, 1802, 6, ''),
(213, 1802, 3, 'value0'),
(214, 1803, 6, ''),
(215, 1803, 3, 'value0'),
(216, 1804, 6, ''),
(217, 1804, 3, 'value0'),
(218, 1809, 6, ''),
(219, 1809, 3, 'value0'),
(220, 1810, 6, ''),
(221, 1810, 3, 'value0'),
(222, 1811, 6, ''),
(223, 1811, 3, 'value0'),
(224, 1812, 6, ''),
(225, 1812, 3, 'value0'),
(226, 1813, 6, ''),
(227, 1813, 3, 'value0'),
(228, 1821, 6, ''),
(229, 1821, 3, 'value0'),
(230, 1822, 6, ''),
(231, 1822, 3, 'value0'),
(232, 1823, 6, ''),
(233, 1823, 3, 'value0'),
(234, 1824, 6, ''),
(235, 1824, 3, 'value0'),
(236, 1825, 6, ''),
(237, 1825, 3, 'value0'),
(238, 1826, 6, ''),
(239, 1826, 3, 'value0'),
(240, 1827, 6, ''),
(241, 1827, 3, 'value0'),
(242, 1828, 6, ''),
(243, 1828, 3, 'value0'),
(244, 1829, 6, ''),
(245, 1829, 3, 'value0'),
(246, 1831, 6, ''),
(247, 1831, 3, 'value0'),
(248, 1832, 6, ''),
(249, 1832, 3, 'value0'),
(250, 1294, 6, ''),
(251, 1294, 3, 'value0'),
(252, 1835, 6, ''),
(253, 1835, 3, 'value0'),
(254, 1836, 6, ''),
(255, 1836, 3, 'value0'),
(256, 1837, 6, ''),
(257, 1837, 3, 'value0'),
(258, 1839, 6, ''),
(259, 1839, 3, 'value0'),
(260, 1840, 6, ''),
(261, 1840, 3, 'value0'),
(262, 1841, 6, ''),
(263, 1841, 3, 'value0'),
(264, 1842, 6, ''),
(265, 1842, 3, 'value0'),
(266, 1843, 6, ''),
(267, 1843, 3, 'value0'),
(268, 1844, 6, ''),
(269, 1844, 3, 'value0'),
(270, 1845, 6, ''),
(271, 1845, 3, 'value0'),
(272, 1846, 6, ''),
(273, 1846, 3, 'value0'),
(274, 1847, 6, ''),
(275, 1847, 3, 'value0'),
(276, 1313, 6, ''),
(277, 1313, 3, 'value0'),
(278, 95, 6, ''),
(279, 95, 3, 'value0'),
(280, 1268, 6, ''),
(281, 1268, 3, 'value0'),
(282, 1849, 6, ''),
(283, 1849, 3, 'value0'),
(284, 1850, 6, ''),
(285, 1850, 3, 'value0'),
(286, 1851, 6, ''),
(287, 1851, 3, 'value0'),
(288, 1852, 6, ''),
(289, 1852, 3, 'value0'),
(290, 1853, 6, ''),
(291, 1853, 3, 'value0'),
(292, 1854, 6, ''),
(293, 1854, 3, 'value0'),
(294, 1312, 6, ''),
(295, 1312, 3, 'value0'),
(296, 1267, 6, ''),
(297, 1267, 3, 'value0'),
(298, 1856, 6, ''),
(299, 1856, 3, 'value0'),
(300, 1859, 6, ''),
(301, 1859, 3, 'value0'),
(302, 1860, 6, ''),
(303, 1860, 3, 'value0'),
(304, 1458, 6, ''),
(305, 1458, 3, 'value0'),
(306, 1861, 6, ''),
(307, 1861, 3, 'value0'),
(308, 1862, 6, ''),
(309, 1862, 3, 'value0'),
(310, 1459, 6, ''),
(311, 1459, 3, 'value0'),
(312, 1864, 6, ''),
(313, 1864, 3, 'value0'),
(314, 1865, 6, ''),
(315, 1865, 3, 'value0'),
(316, 1866, 6, ''),
(317, 1866, 3, 'value0'),
(318, 1867, 6, ''),
(319, 1867, 3, 'value0'),
(320, 1868, 6, ''),
(321, 1868, 3, 'value0'),
(322, 1881, 6, ''),
(323, 1881, 3, 'value0'),
(324, 1164, 6, ''),
(325, 1164, 3, 'value0'),
(326, 1883, 6, ''),
(327, 1883, 3, 'value0'),
(328, 1886, 6, ''),
(329, 1886, 3, 'value0'),
(330, 1892, 6, ''),
(331, 1892, 3, 'value0');

-- --------------------------------------------------------

--
-- Structure de la table `jnew_finder_filters`
--

CREATE TABLE IF NOT EXISTS `jnew_finder_filters` (
  `filter_id` int(10) unsigned NOT NULL auto_increment,
  `title` varchar(255) NOT NULL,
  `alias` varchar(255) NOT NULL,
  `state` tinyint(1) NOT NULL default '1',
  `created` datetime NOT NULL default '0000-00-00 00:00:00',
  `created_by` int(10) unsigned NOT NULL,
  `created_by_alias` varchar(255) NOT NULL,
  `modified` datetime NOT NULL default '0000-00-00 00:00:00',
  `modified_by` int(10) unsigned NOT NULL default '0',
  `checked_out` int(10) unsigned NOT NULL default '0',
  `checked_out_time` datetime NOT NULL default '0000-00-00 00:00:00',
  `map_count` int(10) unsigned NOT NULL default '0',
  `data` text NOT NULL,
  `params` mediumtext,
  PRIMARY KEY  (`filter_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

--
-- Contenu de la table `jnew_finder_filters`
--


-- --------------------------------------------------------

--
-- Structure de la table `jnew_finder_links`
--

CREATE TABLE IF NOT EXISTS `jnew_finder_links` (
  `link_id` int(10) unsigned NOT NULL auto_increment,
  `url` varchar(255) NOT NULL,
  `route` varchar(255) NOT NULL,
  `title` varchar(255) default NULL,
  `description` varchar(255) default NULL,
  `indexdate` datetime NOT NULL default '0000-00-00 00:00:00',
  `md5sum` varchar(32) default NULL,
  `published` tinyint(1) NOT NULL default '1',
  `state` int(5) default '1',
  `access` int(5) default '0',
  `language` varchar(8) NOT NULL,
  `publish_start_date` datetime NOT NULL default '0000-00-00 00:00:00',
  `publish_end_date` datetime NOT NULL default '0000-00-00 00:00:00',
  `start_date` datetime NOT NULL default '0000-00-00 00:00:00',
  `end_date` datetime NOT NULL default '0000-00-00 00:00:00',
  `list_price` double unsigned NOT NULL default '0',
  `sale_price` double unsigned NOT NULL default '0',
  `type_id` int(11) NOT NULL,
  `object` mediumblob NOT NULL,
  PRIMARY KEY  (`link_id`),
  KEY `idx_type` (`type_id`),
  KEY `idx_title` (`title`),
  KEY `idx_md5` (`md5sum`),
  KEY `idx_url` (`url`(75)),
  KEY `idx_published_list` (`published`,`state`,`access`,`publish_start_date`,`publish_end_date`,`list_price`),
  KEY `idx_published_sale` (`published`,`state`,`access`,`publish_start_date`,`publish_end_date`,`sale_price`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

--
-- Contenu de la table `jnew_finder_links`
--


-- --------------------------------------------------------

--
-- Structure de la table `jnew_finder_links_terms0`
--

CREATE TABLE IF NOT EXISTS `jnew_finder_links_terms0` (
  `link_id` int(10) unsigned NOT NULL,
  `term_id` int(10) unsigned NOT NULL,
  `weight` float unsigned NOT NULL,
  PRIMARY KEY  (`link_id`,`term_id`),
  KEY `idx_term_weight` (`term_id`,`weight`),
  KEY `idx_link_term_weight` (`link_id`,`term_id`,`weight`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Contenu de la table `jnew_finder_links_terms0`
--


-- --------------------------------------------------------

--
-- Structure de la table `jnew_finder_links_terms1`
--

CREATE TABLE IF NOT EXISTS `jnew_finder_links_terms1` (
  `link_id` int(10) unsigned NOT NULL,
  `term_id` int(10) unsigned NOT NULL,
  `weight` float unsigned NOT NULL,
  PRIMARY KEY  (`link_id`,`term_id`),
  KEY `idx_term_weight` (`term_id`,`weight`),
  KEY `idx_link_term_weight` (`link_id`,`term_id`,`weight`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Contenu de la table `jnew_finder_links_terms1`
--


-- --------------------------------------------------------

--
-- Structure de la table `jnew_finder_links_terms2`
--

CREATE TABLE IF NOT EXISTS `jnew_finder_links_terms2` (
  `link_id` int(10) unsigned NOT NULL,
  `term_id` int(10) unsigned NOT NULL,
  `weight` float unsigned NOT NULL,
  PRIMARY KEY  (`link_id`,`term_id`),
  KEY `idx_term_weight` (`term_id`,`weight`),
  KEY `idx_link_term_weight` (`link_id`,`term_id`,`weight`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Contenu de la table `jnew_finder_links_terms2`
--


-- --------------------------------------------------------

--
-- Structure de la table `jnew_finder_links_terms3`
--

CREATE TABLE IF NOT EXISTS `jnew_finder_links_terms3` (
  `link_id` int(10) unsigned NOT NULL,
  `term_id` int(10) unsigned NOT NULL,
  `weight` float unsigned NOT NULL,
  PRIMARY KEY  (`link_id`,`term_id`),
  KEY `idx_term_weight` (`term_id`,`weight`),
  KEY `idx_link_term_weight` (`link_id`,`term_id`,`weight`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Contenu de la table `jnew_finder_links_terms3`
--


-- --------------------------------------------------------

--
-- Structure de la table `jnew_finder_links_terms4`
--

CREATE TABLE IF NOT EXISTS `jnew_finder_links_terms4` (
  `link_id` int(10) unsigned NOT NULL,
  `term_id` int(10) unsigned NOT NULL,
  `weight` float unsigned NOT NULL,
  PRIMARY KEY  (`link_id`,`term_id`),
  KEY `idx_term_weight` (`term_id`,`weight`),
  KEY `idx_link_term_weight` (`link_id`,`term_id`,`weight`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Contenu de la table `jnew_finder_links_terms4`
--


-- --------------------------------------------------------

--
-- Structure de la table `jnew_finder_links_terms5`
--

CREATE TABLE IF NOT EXISTS `jnew_finder_links_terms5` (
  `link_id` int(10) unsigned NOT NULL,
  `term_id` int(10) unsigned NOT NULL,
  `weight` float unsigned NOT NULL,
  PRIMARY KEY  (`link_id`,`term_id`),
  KEY `idx_term_weight` (`term_id`,`weight`),
  KEY `idx_link_term_weight` (`link_id`,`term_id`,`weight`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Contenu de la table `jnew_finder_links_terms5`
--


-- --------------------------------------------------------

--
-- Structure de la table `jnew_finder_links_terms6`
--

CREATE TABLE IF NOT EXISTS `jnew_finder_links_terms6` (
  `link_id` int(10) unsigned NOT NULL,
  `term_id` int(10) unsigned NOT NULL,
  `weight` float unsigned NOT NULL,
  PRIMARY KEY  (`link_id`,`term_id`),
  KEY `idx_term_weight` (`term_id`,`weight`),
  KEY `idx_link_term_weight` (`link_id`,`term_id`,`weight`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Contenu de la table `jnew_finder_links_terms6`
--


-- --------------------------------------------------------

--
-- Structure de la table `jnew_finder_links_terms7`
--

CREATE TABLE IF NOT EXISTS `jnew_finder_links_terms7` (
  `link_id` int(10) unsigned NOT NULL,
  `term_id` int(10) unsigned NOT NULL,
  `weight` float unsigned NOT NULL,
  PRIMARY KEY  (`link_id`,`term_id`),
  KEY `idx_term_weight` (`term_id`,`weight`),
  KEY `idx_link_term_weight` (`link_id`,`term_id`,`weight`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Contenu de la table `jnew_finder_links_terms7`
--


-- --------------------------------------------------------

--
-- Structure de la table `jnew_finder_links_terms8`
--

CREATE TABLE IF NOT EXISTS `jnew_finder_links_terms8` (
  `link_id` int(10) unsigned NOT NULL,
  `term_id` int(10) unsigned NOT NULL,
  `weight` float unsigned NOT NULL,
  PRIMARY KEY  (`link_id`,`term_id`),
  KEY `idx_term_weight` (`term_id`,`weight`),
  KEY `idx_link_term_weight` (`link_id`,`term_id`,`weight`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Contenu de la table `jnew_finder_links_terms8`
--


-- --------------------------------------------------------

--
-- Structure de la table `jnew_finder_links_terms9`
--

CREATE TABLE IF NOT EXISTS `jnew_finder_links_terms9` (
  `link_id` int(10) unsigned NOT NULL,
  `term_id` int(10) unsigned NOT NULL,
  `weight` float unsigned NOT NULL,
  PRIMARY KEY  (`link_id`,`term_id`),
  KEY `idx_term_weight` (`term_id`,`weight`),
  KEY `idx_link_term_weight` (`link_id`,`term_id`,`weight`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Contenu de la table `jnew_finder_links_terms9`
--


-- --------------------------------------------------------

--
-- Structure de la table `jnew_finder_links_termsa`
--

CREATE TABLE IF NOT EXISTS `jnew_finder_links_termsa` (
  `link_id` int(10) unsigned NOT NULL,
  `term_id` int(10) unsigned NOT NULL,
  `weight` float unsigned NOT NULL,
  PRIMARY KEY  (`link_id`,`term_id`),
  KEY `idx_term_weight` (`term_id`,`weight`),
  KEY `idx_link_term_weight` (`link_id`,`term_id`,`weight`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Contenu de la table `jnew_finder_links_termsa`
--


-- --------------------------------------------------------

--
-- Structure de la table `jnew_finder_links_termsb`
--

CREATE TABLE IF NOT EXISTS `jnew_finder_links_termsb` (
  `link_id` int(10) unsigned NOT NULL,
  `term_id` int(10) unsigned NOT NULL,
  `weight` float unsigned NOT NULL,
  PRIMARY KEY  (`link_id`,`term_id`),
  KEY `idx_term_weight` (`term_id`,`weight`),
  KEY `idx_link_term_weight` (`link_id`,`term_id`,`weight`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Contenu de la table `jnew_finder_links_termsb`
--


-- --------------------------------------------------------

--
-- Structure de la table `jnew_finder_links_termsc`
--

CREATE TABLE IF NOT EXISTS `jnew_finder_links_termsc` (
  `link_id` int(10) unsigned NOT NULL,
  `term_id` int(10) unsigned NOT NULL,
  `weight` float unsigned NOT NULL,
  PRIMARY KEY  (`link_id`,`term_id`),
  KEY `idx_term_weight` (`term_id`,`weight`),
  KEY `idx_link_term_weight` (`link_id`,`term_id`,`weight`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Contenu de la table `jnew_finder_links_termsc`
--


-- --------------------------------------------------------

--
-- Structure de la table `jnew_finder_links_termsd`
--

CREATE TABLE IF NOT EXISTS `jnew_finder_links_termsd` (
  `link_id` int(10) unsigned NOT NULL,
  `term_id` int(10) unsigned NOT NULL,
  `weight` float unsigned NOT NULL,
  PRIMARY KEY  (`link_id`,`term_id`),
  KEY `idx_term_weight` (`term_id`,`weight`),
  KEY `idx_link_term_weight` (`link_id`,`term_id`,`weight`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Contenu de la table `jnew_finder_links_termsd`
--


-- --------------------------------------------------------

--
-- Structure de la table `jnew_finder_links_termse`
--

CREATE TABLE IF NOT EXISTS `jnew_finder_links_termse` (
  `link_id` int(10) unsigned NOT NULL,
  `term_id` int(10) unsigned NOT NULL,
  `weight` float unsigned NOT NULL,
  PRIMARY KEY  (`link_id`,`term_id`),
  KEY `idx_term_weight` (`term_id`,`weight`),
  KEY `idx_link_term_weight` (`link_id`,`term_id`,`weight`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Contenu de la table `jnew_finder_links_termse`
--


-- --------------------------------------------------------

--
-- Structure de la table `jnew_finder_links_termsf`
--

CREATE TABLE IF NOT EXISTS `jnew_finder_links_termsf` (
  `link_id` int(10) unsigned NOT NULL,
  `term_id` int(10) unsigned NOT NULL,
  `weight` float unsigned NOT NULL,
  PRIMARY KEY  (`link_id`,`term_id`),
  KEY `idx_term_weight` (`term_id`,`weight`),
  KEY `idx_link_term_weight` (`link_id`,`term_id`,`weight`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Contenu de la table `jnew_finder_links_termsf`
--


-- --------------------------------------------------------

--
-- Structure de la table `jnew_finder_taxonomy`
--

CREATE TABLE IF NOT EXISTS `jnew_finder_taxonomy` (
  `id` int(10) unsigned NOT NULL auto_increment,
  `parent_id` int(10) unsigned NOT NULL default '0',
  `title` varchar(255) NOT NULL,
  `state` tinyint(1) unsigned NOT NULL default '1',
  `access` tinyint(1) unsigned NOT NULL default '0',
  `ordering` tinyint(1) unsigned NOT NULL default '0',
  PRIMARY KEY  (`id`),
  KEY `parent_id` (`parent_id`),
  KEY `state` (`state`),
  KEY `ordering` (`ordering`),
  KEY `access` (`access`),
  KEY `idx_parent_published` (`parent_id`,`state`,`access`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=2 ;

--
-- Contenu de la table `jnew_finder_taxonomy`
--

INSERT INTO `jnew_finder_taxonomy` (`id`, `parent_id`, `title`, `state`, `access`, `ordering`) VALUES
(1, 0, 'ROOT', 0, 0, 0);

-- --------------------------------------------------------

--
-- Structure de la table `jnew_finder_taxonomy_map`
--

CREATE TABLE IF NOT EXISTS `jnew_finder_taxonomy_map` (
  `link_id` int(10) unsigned NOT NULL,
  `node_id` int(10) unsigned NOT NULL,
  PRIMARY KEY  (`link_id`,`node_id`),
  KEY `link_id` (`link_id`),
  KEY `node_id` (`node_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Contenu de la table `jnew_finder_taxonomy_map`
--


-- --------------------------------------------------------

--
-- Structure de la table `jnew_finder_terms`
--

CREATE TABLE IF NOT EXISTS `jnew_finder_terms` (
  `term_id` int(10) unsigned NOT NULL auto_increment,
  `term` varchar(75) NOT NULL,
  `stem` varchar(75) NOT NULL,
  `common` tinyint(1) unsigned NOT NULL default '0',
  `phrase` tinyint(1) unsigned NOT NULL default '0',
  `weight` float unsigned NOT NULL default '0',
  `soundex` varchar(75) NOT NULL,
  `links` int(10) NOT NULL default '0',
  PRIMARY KEY  (`term_id`),
  UNIQUE KEY `idx_term` (`term`),
  KEY `idx_term_phrase` (`term`,`phrase`),
  KEY `idx_stem_phrase` (`stem`,`phrase`),
  KEY `idx_soundex_phrase` (`soundex`,`phrase`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

--
-- Contenu de la table `jnew_finder_terms`
--


-- --------------------------------------------------------

--
-- Structure de la table `jnew_finder_terms_common`
--

CREATE TABLE IF NOT EXISTS `jnew_finder_terms_common` (
  `term` varchar(75) NOT NULL,
  `language` varchar(3) NOT NULL,
  KEY `idx_word_lang` (`term`,`language`),
  KEY `idx_lang` (`language`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Contenu de la table `jnew_finder_terms_common`
--

INSERT INTO `jnew_finder_terms_common` (`term`, `language`) VALUES
('a', 'en'),
('about', 'en'),
('after', 'en'),
('ago', 'en'),
('all', 'en'),
('am', 'en'),
('an', 'en'),
('and', 'en'),
('ani', 'en'),
('any', 'en'),
('are', 'en'),
('aren''t', 'en'),
('as', 'en'),
('at', 'en'),
('be', 'en'),
('but', 'en'),
('by', 'en'),
('for', 'en'),
('from', 'en'),
('get', 'en'),
('go', 'en'),
('how', 'en'),
('if', 'en'),
('in', 'en'),
('into', 'en'),
('is', 'en'),
('isn''t', 'en'),
('it', 'en'),
('its', 'en'),
('me', 'en'),
('more', 'en'),
('most', 'en'),
('must', 'en'),
('my', 'en'),
('new', 'en'),
('no', 'en'),
('none', 'en'),
('not', 'en'),
('noth', 'en'),
('nothing', 'en'),
('of', 'en'),
('off', 'en'),
('often', 'en'),
('old', 'en'),
('on', 'en'),
('onc', 'en'),
('once', 'en'),
('onli', 'en'),
('only', 'en'),
('or', 'en'),
('other', 'en'),
('our', 'en'),
('ours', 'en'),
('out', 'en'),
('over', 'en'),
('page', 'en'),
('she', 'en'),
('should', 'en'),
('small', 'en'),
('so', 'en'),
('some', 'en'),
('than', 'en'),
('thank', 'en'),
('that', 'en'),
('the', 'en'),
('their', 'en'),
('theirs', 'en'),
('them', 'en'),
('then', 'en'),
('there', 'en'),
('these', 'en'),
('they', 'en'),
('this', 'en'),
('those', 'en'),
('thus', 'en'),
('time', 'en'),
('times', 'en'),
('to', 'en'),
('too', 'en'),
('true', 'en'),
('under', 'en'),
('until', 'en'),
('up', 'en'),
('upon', 'en'),
('use', 'en'),
('user', 'en'),
('users', 'en'),
('veri', 'en'),
('version', 'en'),
('very', 'en'),
('via', 'en'),
('want', 'en'),
('was', 'en'),
('way', 'en'),
('were', 'en'),
('what', 'en'),
('when', 'en'),
('where', 'en'),
('whi', 'en'),
('which', 'en'),
('who', 'en'),
('whom', 'en'),
('whose', 'en'),
('why', 'en'),
('wide', 'en'),
('will', 'en'),
('with', 'en'),
('within', 'en'),
('without', 'en'),
('would', 'en'),
('yes', 'en'),
('yet', 'en'),
('you', 'en'),
('your', 'en'),
('yours', 'en');

-- --------------------------------------------------------

--
-- Structure de la table `jnew_finder_tokens`
--

CREATE TABLE IF NOT EXISTS `jnew_finder_tokens` (
  `term` varchar(75) NOT NULL,
  `stem` varchar(75) NOT NULL,
  `common` tinyint(1) unsigned NOT NULL default '0',
  `phrase` tinyint(1) unsigned NOT NULL default '0',
  `weight` float unsigned NOT NULL default '1',
  `context` tinyint(1) unsigned NOT NULL default '2',
  KEY `idx_word` (`term`),
  KEY `idx_context` (`context`)
) ENGINE=MEMORY DEFAULT CHARSET=utf8;

--
-- Contenu de la table `jnew_finder_tokens`
--


-- --------------------------------------------------------

--
-- Structure de la table `jnew_finder_tokens_aggregate`
--

CREATE TABLE IF NOT EXISTS `jnew_finder_tokens_aggregate` (
  `term_id` int(10) unsigned NOT NULL,
  `map_suffix` char(1) NOT NULL,
  `term` varchar(75) NOT NULL,
  `stem` varchar(75) NOT NULL,
  `common` tinyint(1) unsigned NOT NULL default '0',
  `phrase` tinyint(1) unsigned NOT NULL default '0',
  `term_weight` float unsigned NOT NULL,
  `context` tinyint(1) unsigned NOT NULL default '2',
  `context_weight` float unsigned NOT NULL,
  `total_weight` float unsigned NOT NULL,
  KEY `token` (`term`),
  KEY `keyword_id` (`term_id`)
) ENGINE=MEMORY DEFAULT CHARSET=utf8;

--
-- Contenu de la table `jnew_finder_tokens_aggregate`
--


-- --------------------------------------------------------

--
-- Structure de la table `jnew_finder_types`
--

CREATE TABLE IF NOT EXISTS `jnew_finder_types` (
  `id` int(10) unsigned NOT NULL auto_increment,
  `title` varchar(100) NOT NULL,
  `mime` varchar(100) NOT NULL,
  PRIMARY KEY  (`id`),
  UNIQUE KEY `title` (`title`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=6 ;

--
-- Contenu de la table `jnew_finder_types`
--

INSERT INTO `jnew_finder_types` (`id`, `title`, `mime`) VALUES
(1, 'Category', ''),
(2, 'Contact', ''),
(3, 'Article', ''),
(4, 'News Feed', ''),
(5, 'Web Link', '');

-- --------------------------------------------------------

--
-- Structure de la table `jnew_jevents_catmap`
--

CREATE TABLE IF NOT EXISTS `jnew_jevents_catmap` (
  `evid` int(12) NOT NULL auto_increment,
  `catid` int(11) NOT NULL default '1',
  `ordering` int(5) unsigned NOT NULL default '0',
  UNIQUE KEY `key_event_category` (`evid`,`catid`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=2 ;

--
-- Contenu de la table `jnew_jevents_catmap`
--

INSERT INTO `jnew_jevents_catmap` (`evid`, `catid`, `ordering`) VALUES
(1, 58, 0);

-- --------------------------------------------------------

--
-- Structure de la table `jnew_jevents_exception`
--

CREATE TABLE IF NOT EXISTS `jnew_jevents_exception` (
  `ex_id` int(12) NOT NULL auto_increment,
  `rp_id` int(12) NOT NULL default '0',
  `eventid` int(12) NOT NULL default '1',
  `eventdetail_id` int(12) NOT NULL default '0',
  `exception_type` int(2) NOT NULL default '0',
  `startrepeat` datetime NOT NULL default '0000-00-00 00:00:00',
  `oldstartrepeat` datetime NOT NULL default '0000-00-00 00:00:00',
  `tempfield` datetime NOT NULL default '0000-00-00 00:00:00',
  PRIMARY KEY  (`ex_id`),
  KEY `eventid` (`eventid`),
  KEY `rp_id` (`rp_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

--
-- Contenu de la table `jnew_jevents_exception`
--


-- --------------------------------------------------------

--
-- Structure de la table `jnew_jevents_icsfile`
--

CREATE TABLE IF NOT EXISTS `jnew_jevents_icsfile` (
  `ics_id` int(12) NOT NULL auto_increment,
  `srcURL` varchar(255) NOT NULL default '',
  `label` varchar(30) NOT NULL default '',
  `filename` varchar(120) NOT NULL default '',
  `icaltype` tinyint(3) NOT NULL default '0',
  `isdefault` tinyint(3) NOT NULL default '0',
  `ignoreembedcat` tinyint(3) NOT NULL default '0',
  `state` tinyint(3) NOT NULL default '1',
  `access` int(11) unsigned NOT NULL default '0',
  `catid` int(11) NOT NULL default '1',
  `created` datetime NOT NULL default '0000-00-00 00:00:00',
  `created_by` int(11) unsigned NOT NULL default '0',
  `created_by_alias` varchar(100) NOT NULL default '',
  `modified_by` int(11) unsigned NOT NULL default '0',
  `refreshed` datetime NOT NULL default '0000-00-00 00:00:00',
  `autorefresh` tinyint(3) NOT NULL default '0',
  `overlaps` tinyint(3) NOT NULL default '0',
  PRIMARY KEY  (`ics_id`),
  UNIQUE KEY `label` (`label`),
  KEY `stateidx` (`state`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=2 ;

--
-- Contenu de la table `jnew_jevents_icsfile`
--

INSERT INTO `jnew_jevents_icsfile` (`ics_id`, `srcURL`, `label`, `filename`, `icaltype`, `isdefault`, `ignoreembedcat`, `state`, `access`, `catid`, `created`, `created_by`, `created_by_alias`, `modified_by`, `refreshed`, `autorefresh`, `overlaps`) VALUES
(1, '', 'Default', 'Initial ICS File', 2, 1, 0, 1, 1, 58, '0000-00-00 00:00:00', 0, '', 0, '0000-00-00 00:00:00', 0, 0);

-- --------------------------------------------------------

--
-- Structure de la table `jnew_jevents_repetition`
--

CREATE TABLE IF NOT EXISTS `jnew_jevents_repetition` (
  `rp_id` int(12) NOT NULL auto_increment,
  `eventid` int(12) NOT NULL default '1',
  `eventdetail_id` int(12) NOT NULL default '0',
  `duplicatecheck` varchar(32) NOT NULL default '',
  `startrepeat` datetime NOT NULL default '0000-00-00 00:00:00',
  `endrepeat` datetime NOT NULL default '0000-00-00 00:00:00',
  PRIMARY KEY  (`rp_id`),
  UNIQUE KEY `duplicatecheck` (`duplicatecheck`),
  KEY `eventid` (`eventid`),
  KEY `eventstart` (`eventid`,`startrepeat`),
  KEY `eventend` (`eventid`,`endrepeat`),
  KEY `eventdetail` (`eventdetail_id`),
  KEY `startrepeat` (`startrepeat`),
  KEY `startend` (`startrepeat`,`endrepeat`),
  KEY `endrepeat` (`endrepeat`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=18 ;

--
-- Contenu de la table `jnew_jevents_repetition`
--

INSERT INTO `jnew_jevents_repetition` (`rp_id`, `eventid`, `eventdetail_id`, `duplicatecheck`, `startrepeat`, `endrepeat`) VALUES
(1, 1, 1, '092a18957b6250ee7321685274c72df5', '2013-10-29 08:45:00', '2013-10-29 18:30:00'),
(2, 2, 2, 'e90e1a8fe41a8ccf33fcd8a319809211', '2013-11-13 08:00:00', '2013-11-13 17:00:00'),
(4, 4, 4, '679e3c22a6445f60fe11707250fae6c5', '2013-11-10 00:00:00', '2013-11-20 23:59:59'),
(8, 8, 8, 'fefd676f7d992e46d50c8e526018b982', '2013-12-17 17:30:00', '2013-12-17 19:30:00'),
(9, 9, 9, 'ac89b5e3a156460f690bc1c845f945ef', '2013-11-26 15:00:00', '2013-11-26 19:00:00'),
(11, 11, 11, '84717a6e28b6e67f534a7c44c3a0dcf6', '2013-11-26 17:00:00', '2013-11-26 19:00:00'),
(12, 12, 12, '5e877df210129ce6334ddc2698b650e4', '2013-12-12 09:30:00', '2013-12-12 12:00:00'),
(13, 13, 13, 'f55ab50120e0fc71047750d01662aa18', '2013-12-11 08:00:00', '2013-12-11 19:00:00'),
(14, 14, 14, 'e5fa364251291380102ae8f707af3905', '2013-12-11 08:00:00', '2013-12-11 19:00:00'),
(16, 16, 16, 'fd735b21e8d6ed2d1f1d778b07d29e1d', '2014-03-26 08:00:00', '2014-03-26 11:00:00'),
(17, 17, 17, '7d416b631876c9e4f5a1efc0e785349b', '2014-05-15 08:00:00', '2014-05-15 12:00:00');

-- --------------------------------------------------------

--
-- Structure de la table `jnew_jevents_rrule`
--

CREATE TABLE IF NOT EXISTS `jnew_jevents_rrule` (
  `rr_id` int(12) NOT NULL auto_increment,
  `eventid` int(12) NOT NULL default '1',
  `freq` varchar(30) NOT NULL default '',
  `until` int(12) NOT NULL default '1',
  `untilraw` varchar(30) NOT NULL default '',
  `count` int(6) NOT NULL default '1',
  `rinterval` int(6) NOT NULL default '1',
  `bysecond` varchar(50) NOT NULL default '',
  `byminute` varchar(50) NOT NULL default '',
  `byhour` varchar(50) NOT NULL default '',
  `byday` varchar(50) NOT NULL default '',
  `bymonthday` varchar(50) NOT NULL default '',
  `byyearday` varchar(50) NOT NULL default '',
  `byweekno` varchar(50) NOT NULL default '',
  `bymonth` varchar(50) NOT NULL default '',
  `bysetpos` varchar(50) NOT NULL default '',
  `wkst` varchar(50) NOT NULL default '',
  PRIMARY KEY  (`rr_id`),
  KEY `eventid` (`eventid`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=18 ;

--
-- Contenu de la table `jnew_jevents_rrule`
--

INSERT INTO `jnew_jevents_rrule` (`rr_id`, `eventid`, `freq`, `until`, `untilraw`, `count`, `rinterval`, `bysecond`, `byminute`, `byhour`, `byday`, `bymonthday`, `byyearday`, `byweekno`, `bymonth`, `bysetpos`, `wkst`) VALUES
(1, 1, 'none', 0, '', 1, 1, '', '', '', 'TU', '', '', '', '', '', ''),
(2, 2, 'none', 0, '', 1, 1, '', '', '', 'WE', '', '', '', '', '', ''),
(4, 4, 'none', 0, '', 1, 1, '', '', '', '+1WE,+2WE,+3WE,+4WE,+5WE', '', '', '', '', '', ''),
(8, 8, 'none', 0, '', 1, 1, '', '', '', '+1TU,+2TU,+3TU,+4TU,+5TU', '', '', '', '', '', ''),
(9, 9, 'none', 0, '', 1, 1, '', '', '', '+1TU,+2TU,+3TU,+4TU,+5TU', '', '', '', '', '', ''),
(11, 11, 'none', 0, '', 1, 1, '', '', '', 'TU', '', '', '', '', '', ''),
(12, 12, 'none', 0, '', 1, 1, '', '', '', '+1TH,+2TH,+3TH,+4TH,+5TH', '', '', '', '', '', ''),
(13, 13, 'none', 0, '', 1, 1, '', '', '', 'WE', '', '', '', '', '', ''),
(14, 14, 'none', 0, '', 1, 1, '', '', '', 'WE', '', '', '', '', '', ''),
(16, 16, 'none', 0, '', 1, 1, '', '', '', 'WE', '', '', '', '', '', ''),
(17, 17, 'none', 0, '', 1, 1, '', '', '', '+1TH,+2TH,+3TH,+4TH,+5TH', '', '', '', '', '', '');
