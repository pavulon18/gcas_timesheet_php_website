@ECHO OFF
setlocal DISABLEDELAYEDEXPANSION
SET BIN_TARGET=%~dp0/../pds/skeleton/bin/pds-skeleton
php "%BIN_TARGET%" %*
