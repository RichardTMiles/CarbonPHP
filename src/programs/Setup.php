<?php
/**
 *
 * Im not sure what I want to do with this.
 *
 * Created by IntelliJ IDEA.
 * User: richardmiles
 * Date: 2/6/19
 * Time: 11:51 PM
 */

namespace CarbonPHP\Programs;


use CarbonPHP\CarbonPHP;
use CarbonPHP\Database;
use CarbonPHP\Error\ErrorCatcher;
use CarbonPHP\Interfaces\iCommand;
use Throwable;

class Setup implements iCommand
{
    use ColorCode, MySQL {
        cleanUp as removeFiles;
    }

    private string $configFile;

    public function usage() : void
    {
        // TODO - create setup program
        print <<<usage


        The setup program can be used to initialize and update a projects configuration files. 
        Currently it does not do this, but here is what it does do.  
        
        
        -r --rebuild                 Update the projects database configurations.

        --mysql_native_password      Change mysql to default to a native password.
        
        
usage;

    }

    public function run($argv) : void
    {
        $argc = count($argv);

        if ($argc === 0) {
            $this->usage();
            exit(1);
        }

        for ($i = 0; $i < $argc; $i++) {
            switch ($argv[$i]) {
                default:
                    print 'Invalid argument ' . $argv[$i] . PHP_EOL;
                    $this->usage();
                    exit(1);
                case '-r':
                case '--rebuild':
                    self::colorCode('Rebuilding Database');
                    Database::setUp(false, true);   // Redirect = false
                    // this is going to the CLI so no need to run/attach redirect scripts
                    exit(0);
                case '--mysql_native_password':
                    $this->mysql_native_password();
                    exit(0);
            }
        }

        // TODO - create this setup
        if (empty($this->config['SITE']['CONFIG'])) {
            print 'The [\'SITE\'][\'CONFIG\'] option is missing. It does not look like CarbonPHP is setup correctly. Run `>> php index.php setup` to fix this.' . PHP_EOL;
            exit(1);
        }

        if (false === $parse = file_get_contents($this->config['SITE']['CONFIG'])){
            print 'Cloud not get contents of ' . $this->config['SITE']['CONFIG'] . "\n\n";
            exit(1);
        }

        $this->configFile = $this->config['SITE']['CONFIG'];

        foreach ($this->options() as $key => $value) {
            if (!preg_match("#'$key'\s*=>\s*\n*\[([^\]])*],#", $parse, $matches)) {
                unset($this->config[$key]);
            } else {
                exit($matches);
            }
        }
    }

    public function cleanUp() : void
    {
        // TODO: Implement cleanUp() method.
    }


    private function options(): array
    {
        return [
            'DATABASE' => [

                'DB_HOST' => '',                        // IP

                'DB_NAME' => '',                        // Schema

                'DB_USER' => '',                        // User

                'DB_PASS' => '',                        // Password

                'DB_BUILD' => '',                       // This framework sets up its-self implicitly

                'REBUILD' => false                      // Initial Setup todo - remove this check
            ],

            'SITE' => [
                'URL' => 'carbonphp.com',    // Evaluated and if not the accurate Redirect. Local php server okay. Remove for any domain

                'ROOT' => CarbonPHP::$app_root,          // This was defined in our ../index.php

                'CACHE_CONTROL' => [
                    'ico|pdf|flv' => 'Cache-Control: max-age=29030400, public',

                    'jpg|jpeg|png|gif|swf|xml|txt|css|js|woff2|tff|svg' => 'Cache-Control: max-age=604800, public',

                    'html|htm|php|hbs' => 'Cache-Control: max-age=0, private, public',
                ],

                'CONFIG' => __FILE__,               // Send to sockets

                'TIMEZONE' => 'America/Phoenix',    //  Current timezone

                'TITLE' => 'Root • Prerogative',    // Website title

                'VERSION' => '4.9.0',               // Add link to semantic versioning

                'SEND_EMAIL' => 'richard@miles.systems',     // I send emails to validate accounts

                'REPLY_EMAIL' => 'richard@miles.systems',

                'HTTP' => true   // I assume that HTTP is okay by default
            ],


            'SESSION' => [
                'REMOTE' => false,             // Store the session in the SQL database

                'SERIALIZE' => [ ],           // These global variables will be stored between session

                'PATH' => '',

                'CALLBACK' => function () {         // optional variable $reset which would be true if a url is passed to startApplication()

                },
            ],

            'SOCKET' => [
                'WEBSOCKETD' => false,
                'PORT' => 8888,
                'DEV' => true,
                'SSL' => [
                    'KEY' => '',
                    'CERT' => ''
                ]
            ],


            // ERRORS on point
            'ERROR' => [
                'LOCATION' => CarbonPHP::$app_root . 'logs' . DS ,

                'LEVEL' =>  E_ALL | E_STRICT,  // php ini level

                'STORE' =>  true,      // Database if specified and / or File 'LOCATION' in your system

                'SHOW' =>  true,       // Show errors on browser

                'FULL' => true        // Generate custom stacktrace will high detail - DO NOT set to TRUE in PRODUCTION
            ],

            'VIEW' => [
                'VIEW' => 'view/',  // This is where the MVC() function will map the HTML.PHP and HTML.HBS . See Carbonphp.com/mvc

                'WRAPPER' => 'Documentation/Wrapper.php',     // View::content() will produce this
            ],

        ];
    }

    private function configSetup($config): void
    {
        $configFile = <<<CONFIG
<?php
/**
 * The file is automatically generated by the code generator (CG).
 *
 *  Invalid options and code outside the optional ['SESSION']['CALLBACK']
 *  Will be removed if the file is regenerated. If you think code should live
 *  here, I suggest you add it before the start of `new CarbonPHP('pathToThisFile')`.
 *
 *  To Update/Regenerate
 *
 *     >> php index.php setup
 *
 *
 *  This will open a menu for further options.
 *
 *  Edits made to values already present in this file will be saved.
 *
 *  Available Options:
 *
 * @type \$PHP = [
 *       'AUTOLOAD' => string array []                       // Provide PSR-4 namespace roots
 *       'SITE' => [
 *           'URL' => string '',                                  // Server Url name you do not need to chane in remote development
 *           'ROOT' => string '__FILE__',                         // This was defined in our ../index.php
 *           'CACHE_CONTROL' => [                                 // Key value map of \$extension => \$headers
 *                      'png|jpg|gif|jpeg|bmp|icon|js|css' => 'Cache-Control: max-age=<seconds>',
 *                      'woff|woff2|map|hbs|eotv' => 'Cache-Control: no-cache ',              // if the extension is found the headers provided will be sent
 *           ],
 *           'CONFIG' => string __FILE__,                         // Send to sockets
 *           'TIMEZONE' => string 'America/Chicago',              // Current timezone TODO - look up php
 *           'TITLE' => string 'Carbon 6',                        // Website title
 *           'VERSION' => string /phpversion(),                   // Add link to semantic versioning
 *           'SEND_EMAIL' => string '',                           // I send emails to validate accounts
 *           'REPLY_EMAIL' => string '',
 *           'HTTP' => bool true
 *       ],
 *       'DATABASE' => [
 *           'DB_DSN'  => string '',                        // Host and Database get put here
 *           'DB_USER' => string '',
 *           'DB_PASS' => string '',
 *           'DB_BUILD'=> string '',                        // Absolute file path to your database set up file
 *           'REBUILD' => bool false
 *       ],
 *       'SESSION' => [
 *           'REMOTE' => bool true,             // Store the session in the SQL database
 *           'SERIALIZE' => [],                 // These global variables will be stored between session
 *           'CALLBACK' => callable,
 *       'SOCKET' => [
 *           'HOST' => string '',               // The IP or DNS server to connect ws or wss with
 *           'WEBSOCKETD' => bool false,
 *           'PORT' => int 8888,
 *           'DEV' => bool false,
 *           'SSL' => [
 *               'KEY' => string '',
 *               'CERT' => string ''
 *           ]
 *       ],
 *       'ERROR' => [
 *           'LEVEL' => (int) E_ALL | E_STRICT,
 *           'STORE' => (bool) true,                // Database if specified and / or File 'LOCATION' in your system
 *           'SHOW' => (bool) true,                 // Show errors on browser
 *           'FULL' => (bool) true                  // Generate custom stacktrace will high detail - DO NOT set to TRUE in PRODUCTION
 *       ],
 *       'VIEW' => [
 *           'VIEW' => string '/',          // This is where the MVC() function will map the HTML.PHP and HTML.HBS . See Carbonphp.com/mvc
 *          'WRAPPER' => string '',         // View::content() will produce this
 *      ],
 * ]
 * @throws \Exception
 */

return [
CONFIG;

        $buildVar = static function ($config, $levels = 1) use (&$buildVar) : string {
            $string = PHP_EOL;
            foreach ($config as $key => $value) {
                $string .= str_repeat("\t", $levels) ."'$key' => ";
                if (\is_callable($value)) {
                    $string .= "'',\n";
                } elseif (\is_array($value)) {
                    $string .= "[\n" . $buildVar($value, $levels+1) . "\n" . str_repeat("\t", $levels) . "],\n\n";
                } else {
                    $string .= "'$value',\n";
                }
            }
            return $string;
        };

        $configFile = $buildVar($config);

        print $configFile . PHP_EOL . PHP_EOL . PHP_EOL; // todo - create this program
    }
}