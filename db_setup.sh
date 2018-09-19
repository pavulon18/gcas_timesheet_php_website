#!/bin/bash

# pseudo-code first
#
# Will need to determine the OS and act accordingly.  This may not even work
# on Windows.
#
# either need the credentials for a root or other appropriately gifted user
# OR
# the user will need to create the user for this database first.
#
# run the schema creation script
#
# insert Employee_Number, username, hashed password into employees
# insert Employee_Number, Security Level into employee_securityroles

#############
# Find and replace default values with values sourced from the user.
# For right now, I am putting my own information in here.  This will need to be
# changed to accept input from the user.
#############

sed -i -e 's/Admin_First/Jim/g' GCEMS_empty_db.sql
sed -i -e 's/Admin_Last/Baize/g' GCEMS_empty_db.sql
sed -i -e 's/root/jbaize/g' GCEMS_empty_db.sql
sed -i -e 's/default_pass/pass/g' GCEMS_empty_db.sql
sed -i -e 's/default_mail/pavulon@hotmail.com/g' GCEMS_empty_db.sql