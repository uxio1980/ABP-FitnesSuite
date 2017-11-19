-- MySQL Script generated by MySQL Workbench
-- mar 31 oct 2017 19:41:07 CET
-- Model: New Model    Version: 1.0
-- MySQL Workbench Forward Engineering

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";

-- -----------------------------------------------------
-- Create user and DB
-- -----------------------------------------------------

CREATE USER IF NOT EXISTS 'fitnessuser'@'localhost'
  IDENTIFIED BY 'fitnesspass' ;
CREATE DATABASE IF NOT EXISTS `fitnessdb` DEFAULT CHARACTER SET utf8 ;
GRANT ALL PRIVILEGES ON `fitnessdb` . * TO 'fitnessuser'@'localhost' ;
use `fitnessdb` ;

