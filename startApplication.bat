@echo off

SET mypath="%~dp0"
echo %mypath:~0,-1%

SET NEWLINE=^& echo.

FIND /C /I "dev.carbonphp.com" %WINDIR%\system32\drivers\etc\hosts
IF %ERRORLEVEL% NEQ 0 ECHO %NEWLINE%^127.0.0.1 dev.carbonphp.com>>%WINDIR%\System32\drivers\etc\hosts

php -S dev.carbonphp.com:80 index.php || php -S dev.carbonphp.com:8080 index.php