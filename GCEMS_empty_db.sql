-- phpMyAdmin SQL Dump
-- version 4.7.9
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Generation Time: Sep 09, 2018 at 04:05 AM
-- Server version: 5.7.21
-- PHP Version: 7.2.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `gcas_payroll`
--
CREATE DATABASE IF NOT EXISTS `gcas_payroll` DEFAULT CHARACTER SET utf8 COLLATE utf8_general_ci;
USE `gcas_payroll`;

-- --------------------------------------------------------

--
-- Table structure for table `constant_values`
--

DROP TABLE IF EXISTS `constant_values`;
CREATE TABLE IF NOT EXISTS `constant_values` (
  `ID` int(11) NOT NULL AUTO_INCREMENT,
  `Reference_Date` date DEFAULT NULL,
  PRIMARY KEY (`ID`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `employees`
--

DROP TABLE IF EXISTS `employees`;
CREATE TABLE IF NOT EXISTS `employees` (
  `Employee_Number` int(11) NOT NULL COMMENT 'Assigned by the county.  Is unique',
  `First_Name` varchar(45) NOT NULL,
  `Middle_Name` varchar(45) DEFAULT NULL,
  `Last_Name` varchar(45) NOT NULL,
  `Pay_Rate` decimal(6,2) NOT NULL COMMENT 'This is the amount the employee will get paid at some rate. The rate is dependent on pay_rate_basis, which is dependent on hourly, salary, or contract.',
  `Sick_Days_Remaining` decimal(5,2) NOT NULL DEFAULT '0.00',
  `Vacation_Days_Remaining` decimal(5,2) NOT NULL DEFAULT '0.00',
  `Personal_Days_Remaining` decimal(5,2) NOT NULL DEFAULT '0.00',
  `FMLA_Days_Remaining` decimal(5,2) NOT NULL DEFAULT '0.00',
  `Is_Currently_Employed` enum('Y','N') DEFAULT 'Y' COMMENT 'This might end up being redundant data.  I should be able to ascertain this from the HireDate table.  Going to make this nullable for the time being.',
  `Is_On_Short_Term_Disability` enum('Y','N') NOT NULL DEFAULT 'N',
  `Is_On_Long_Term_Disability` enum('Y','N') NOT NULL DEFAULT 'N',
  `Is_On_FMLA` enum('Y','N') NOT NULL DEFAULT 'N',
  `username` varchar(45) NOT NULL COMMENT 'This might be removed in later versions as I learn how to do this stuff',
  `password` varchar(255) NOT NULL COMMENT 'See Username comment',
  `Is_PW_Expired` tinyint(1) NOT NULL DEFAULT '0' COMMENT 'Is password expired?\n0=no\n1=yes\n\nif yes, the user must change password on the next login.\nwhen password is changed, will change 1 to 0.',
  `Is_Account_Disabled` tinyint(1) NOT NULL DEFAULT '0' COMMENT 'If this is set to ''1'', the user should be unable to log into the account.',
  `remember_me` enum('0','1') NOT NULL DEFAULT '0' COMMENT 'remember_me is for use in the client login screen.  0 = do not remember me; 1 = remember me;',
  `email` varchar(45) DEFAULT NULL COMMENT 'This will store the employee''s email address for communication purposes.',
  `Inserted_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP COMMENT 'This will not be editable by any user.  This will keep a record of any changes.',
  `Deleted_at` datetime DEFAULT '9999-12-31 23:59:59' COMMENT 'This signifies a soft delete.  The entry will be marked as deleted but it will merely be hidden',
  PRIMARY KEY (`Employee_Number`,`Inserted_at`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='This table will store information about each employee.';

-- --------------------------------------------------------

--
-- Table structure for table `employee_hiredates`
--

DROP TABLE IF EXISTS `employee_hiredates`;
CREATE TABLE IF NOT EXISTS `employee_hiredates` (
  `Employee_Number` int(11) NOT NULL,
  `Hire_Date` date NOT NULL,
  `Termination_Date` date DEFAULT NULL,
  `Inserted_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `Deleted_at` datetime DEFAULT NULL,
  PRIMARY KEY (`Employee_Number`,`Hire_Date`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='Records the hire and termination dates of each employee.';

-- --------------------------------------------------------

--
-- Table structure for table `employee_jobtitles`
--

DROP TABLE IF EXISTS `employee_jobtitles`;
CREATE TABLE IF NOT EXISTS `employee_jobtitles` (
  `Employee_Number` int(11) NOT NULL,
  `Effective_Start_DateTime` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `Effective_End_DateTime` datetime DEFAULT NULL,
  `Inserted_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `Deleted_at` datetime DEFAULT NULL,
  `Job_Title_ID` int(11) NOT NULL,
  PRIMARY KEY (`Employee_Number`,`Job_Title_ID`),
  KEY `FK_job_title_ID` (`Job_Title_ID`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `employee_payrollhours`
--

DROP TABLE IF EXISTS `employee_payrollhours`;
CREATE TABLE IF NOT EXISTS `employee_payrollhours` (
  `Employee_Number` int(11) NOT NULL,
  `DateTime_In` datetime NOT NULL,
  `DateTime_Out` datetime DEFAULT NULL,
  `Is_24Hour_Shift` enum('Y','N') DEFAULT 'Y',
  `Is_Sick_Day` enum('Y','N') DEFAULT 'N',
  `Is_Vacation_Day` enum('Y','N') DEFAULT 'N',
  `Is_Personal_Day` enum('Y','N') DEFAULT 'N',
  `Is_Holiday` enum('Y','N') DEFAULT 'N',
  `Is_Berevement_Day` enum('Y','N') DEFAULT 'N',
  `Is_FMLA_Day` enum('Y','N') DEFAULT 'N',
  `Is_Short_Term_Disability_Day` enum('Y','N') DEFAULT 'N',
  `Is_Long_Term_Disability_Day` enum('Y','N') DEFAULT 'N',
  `Is_Night_Run` enum('Y','N') DEFAULT 'N',
  `Is_Payroll_Approved` enum('Y','N') DEFAULT 'N' COMMENT 'Payroll approved by administrator',
  `Payroll_Approved_By` int(11) DEFAULT NULL COMMENT 'By administrator',
  `Payroll_Approval_Date` datetime DEFAULT NULL COMMENT 'By administrator',
  `RegularTime` decimal(6,3) NOT NULL DEFAULT '0.000',
  `OverTime` decimal(6,3) NOT NULL DEFAULT '0.000',
  `NonWorkTime` decimal(6,3) NOT NULL DEFAULT '0.000',
  `NightTime` decimal(6,3) NOT NULL DEFAULT '0.000',
  `Inserted_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `Deleted_at` datetime DEFAULT NULL,
  `Has_Employee_Locked` enum('Y','N') NOT NULL DEFAULT 'N',
  `Employee_Locked_DateTime` datetime DEFAULT NULL,
  `Reason` varchar(256) DEFAULT ' ' COMMENT 'Used to document the run number for night runs and any other reasons for time not documented by other means.',
  PRIMARY KEY (`Employee_Number`,`DateTime_In`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 CHECKSUM=1;

-- --------------------------------------------------------

--
-- Table structure for table `employee_securityroles`
--

DROP TABLE IF EXISTS `employee_securityroles`;
CREATE TABLE IF NOT EXISTS `employee_securityroles` (
  `Effective_Start_DateTime` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `Effective_End_DateTime` datetime DEFAULT '9999-12-31 23:59:59',
  `Inserted_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP COMMENT 'Date/Time stamp when the change was entered into the database.',
  `Deleted_at` datetime DEFAULT '9999-12-31 23:59:59',
  `ID_Number` int(11) NOT NULL AUTO_INCREMENT,
  `Employee_Number` int(11) NOT NULL,
  `Security_Role_ID` int(11) DEFAULT NULL,
  PRIMARY KEY (`ID_Number`,`Inserted_at`,`Employee_Number`),
  KEY `E_SR_Foreign_Key_idx` (`Employee_Number`),
  KEY `SecurityRole_Foreign_Key_idx` (`Security_Role_ID`)
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8 COMMENT='Maps security roles to the individual employee.  Using this setup, each employee should be allowed multiple security roles.';

-- --------------------------------------------------------

--
-- Table structure for table `job_titles`
--

DROP TABLE IF EXISTS `job_titles`;
CREATE TABLE IF NOT EXISTS `job_titles` (
  `Job_Title_ID` int(11) NOT NULL AUTO_INCREMENT,
  `Job_Title` varchar(32) NOT NULL,
  `Duties` varchar(4048) DEFAULT NULL,
  `Pay_Type` enum('Hourly','Salary','Contract') NOT NULL,
  `Pay_Rate_Basis` enum('per Hour','per Month') NOT NULL,
  `Full_or_Part_Time` enum('Full Time','Part Time','Other') DEFAULT NULL,
  `Effective_Start_DateTime` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `Effective_End_DateTime` datetime DEFAULT NULL,
  `Inserted_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `Deleted_at` datetime DEFAULT NULL,
  PRIMARY KEY (`Job_Title_ID`)
) ENGINE=InnoDB AUTO_INCREMENT=17 DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `recoveryemails_enc`
--

DROP TABLE IF EXISTS `recoveryemails_enc`;
CREATE TABLE IF NOT EXISTS `recoveryemails_enc` (
  `ID` bigint(20) NOT NULL AUTO_INCREMENT,
  `Employee_Number` int(11) NOT NULL COMMENT 'Employee Number.  Foreign key to Employee.Employee_Number',
  `Token` varchar(64) NOT NULL COMMENT 'A Hash of the reset token.',
  `Creation_DateTime` datetime DEFAULT CURRENT_TIMESTAMP COMMENT 'Date/Time stamp of the creation of this token.',
  `Redeemed_DateTime` datetime DEFAULT NULL,
  PRIMARY KEY (`ID`),
  KEY `FK_Employee_Number_idx` (`Employee_Number`)
) ENGINE=InnoDB AUTO_INCREMENT=31 DEFAULT CHARSET=utf8 COMMENT='This table will be used to track password recovery attempts.';

-- --------------------------------------------------------

--
-- Table structure for table `security_roles`
--

DROP TABLE IF EXISTS `security_roles`;
CREATE TABLE IF NOT EXISTS `security_roles` (
  `Effective_Start_DateTime` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `Effective_End_DateTime` datetime NOT NULL DEFAULT '9999-12-31 23:59:59',
  `Inserted_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `Deleted_at` datetime NOT NULL DEFAULT '9999-12-31 23:59:59',
  `Security_Role_ID` int(11) NOT NULL AUTO_INCREMENT,
  `Security_Role_Name` varchar(45) NOT NULL,
  PRIMARY KEY (`Security_Role_ID`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `employee_hiredates`
--
ALTER TABLE `employee_hiredates`
  ADD CONSTRAINT `FK_Employee_HireDate` FOREIGN KEY (`Employee_Number`) REFERENCES `employees` (`Employee_Number`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `employee_jobtitles`
--
ALTER TABLE `employee_jobtitles`
  ADD CONSTRAINT `FK_Employee_Number` FOREIGN KEY (`Employee_Number`) REFERENCES `employees` (`Employee_Number`) ON UPDATE CASCADE,
  ADD CONSTRAINT `FK_job_title_ID` FOREIGN KEY (`Job_Title_ID`) REFERENCES `job_titles` (`Job_Title_ID`) ON UPDATE CASCADE;

--
-- Constraints for table `employee_payrollhours`
--
ALTER TABLE `employee_payrollhours`
  ADD CONSTRAINT `FK_Employee_PayrollHours` FOREIGN KEY (`Employee_Number`) REFERENCES `employees` (`Employee_Number`) ON UPDATE CASCADE,
  ADD CONSTRAINT `FK_Payroll_Approved_By` FOREIGN KEY (`Employee_Number`) REFERENCES `employees` (`Employee_Number`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `employee_securityroles`
--
ALTER TABLE `employee_securityroles`
  ADD CONSTRAINT `FK_Employee_SR` FOREIGN KEY (`Employee_Number`) REFERENCES `employees` (`Employee_Number`) ON UPDATE CASCADE,
  ADD CONSTRAINT `FK_SecurityRole` FOREIGN KEY (`Security_Role_ID`) REFERENCES `security_roles` (`Security_Role_ID`) ON UPDATE CASCADE;

--
-- Constraints for table `recoveryemails_enc`
--
ALTER TABLE `recoveryemails_enc`
  ADD CONSTRAINT `FK_rec_email_employee` FOREIGN KEY (`Employee_Number`) REFERENCES `employees` (`Employee_Number`) ON UPDATE CASCADE;

--
-- Add default user information into the system
-- This section was manually added by Jim Baize
-- Sept 14, 2018
--

INSERT INTO `employees`
  (`Employee_Number`, `First_Name`,`Last_Name`, `username`, `password`, `email`)
  VALUES (000000000, `Admin_First`, `Admin_Last`, `root`, `default_pass`, `default_email`);

INSERT INTO `employee_securityroles`
  (`Employee_Number`, `Security_Role_ID`)
  VALUES (000000000, 2);

--
-- End of the added section
--

COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
