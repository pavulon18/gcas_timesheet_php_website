SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;

--
-- Add default user information into the system
-- This section was manually added by Jim Baize
-- Sept 14, 2018
--

INSERT INTO `employees`
  (`Employee_Number`, `First_Name`,`Last_Name`, `username`, `password`, `email`)
  VALUES (000000000, `Admin_First`, `Admin_Last`, `default_user`, `default_pass`, `default_email`);

INSERT INTO `security_roles`
  (`Security_Role_Name`)
  VALUES (`Employee`);

INSERT INTO `security_roles`
  (`Security_Role_Name`)
  VALUES (`Administrator`);

INSERT INTO `employee_securityroles`
  (`Employee_Number`)
  VALUES (000000000);

INSERT INTO `employee_securityroles`
  (`Security_Role_ID`)
  VALUES (`Select Security_Role_ID from Security_Roles WHERE Security_Role_Name is Administrator`);
--
-- End of the added section
--

COMMIT;
