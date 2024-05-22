
-- phpMyAdmin SQL Dump
-- version 4.7.0
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1
-- Généré le :  22 mai 2024 à 11:51
-- Version du serveur :  5.7.17
-- Version de PHP :  7.1.3

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données :  `Gestion_des_projets_tuteurés`
--

-- --------------------------------------------------------

--
-- Structure de la table `Admis`
--


CREATE TABLE
    `BUTRT1_lg409538`.`Admis` ( 
      `id_admis` VARCHAR NOT NULL AUTO_INCREMENT ,
      `mdp` VARCHAR NOT NULL ,
      PRIMARY KEY (`id_admis`)) ENGINE = InnoDB; 

--
-- Déchargement des données de la table `Admis`
--

INSERT INTO `Admis` (`id_admis`, `mdp`,) VALUES

--Commme groooos


CREATE TABLE
    `BUTRT1_lg409538`.`Etudiants` ( 
      `id_etud` VARCHAR NOT NULL AUTO_INCREMENT ,
      `mdp` VARCHAR NOT NULL ,
      PRIMARY KEY (`id_etud`)) ENGINE = InnoDB;

--
-- Déchargement des données de la table `Etudiants`
--

INSERT INTO `Etudiants` (`id_etud`, `mdp`,) VALUES

--Commme groooos


CREATE TABLE
    `BUTRT1_lg409538`.`Profs` ( 
      `id_profs` VARCHAR NOT NULL AUTO_INCREMENT ,
      `mdp` VARCHAR NOT NULL ,
      PRIMARY KEY (`id_profs`)) ENGINE = InnoDB; 

--
-- Déchargement des données de la table `Profs`
--

INSERT INTO `Admis` (`id_profs`, `mdp`,) VALUES

--Commme groooos


CREATE TABLE 
    `BUTRT1_lg409538`.`Sujets` (
    `id_sujet` VARCHAR NOT NULL AUTO_INCREMENT ,
    `nom` VARCHAR NOT NULL ,
    `id_profs` VARCHAR NOT NULL ,
    `id_etud` VARCHAR NOT NULL ,
    PRIMARY KEY (`id_sujets`)) ENGINE = InnoDB; 

--
-- Déchargement des données de la table `Sujets`
--

INSERT INTO `Admis` (`id_sujet`, `mdp`,) VALUES

--Commme groooos

