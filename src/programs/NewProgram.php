<?php


namespace CarbonPHP\Programs;

use CarbonPHP\interfaces\iCommand;


/* @author Richard Tyler Miles
 *
 *      Special thanks to the following people//resources
 *
 * @link https://gist.github.com/pbojinov/8965299
 */
class NewProgram implements iCommand
{
    use Background, Composer;

    private array $CONFIG;

    private function getProgramsDirectory(): string
    {
        $json = self::getComposerConfig();

        $programDirectory = $json['autoload']['psr-4']["Programs\\"] ??= false;

        if (is_string(APP_ROOT . $programDirectory)) {
            return APP_ROOT . $programDirectory;
        }

        print "\n\n\tFailed to find your program directory. Please open a ticket on the CarbonPHP github for support.\n\n";
        exit(1);
    }

    public function __construct($CONFIG)
    {
        $this->CONFIG = $CONFIG;
    }

    public function usage(): void
    {
        print "\n\n\tThis creates a new file in the appropriate directory.\n\n";
        exit(1);
    }

    public function cleanUp($argv): void
    {
        // nothing
    }

    public function run($argv): void
    {
        if (empty($argv)) {
            $this->usage();
        }

        $programName = $argv[0];

        $c6 = CARBON_ROOT === APP_ROOT . 'src' . DS;

        $programDir = $c6 ? CARBON_ROOT . 'programs' . DS : $this->getProgramsDirectory();


        if (!file_put_contents($file = $programDir . $programName . '.php', $this->programFile($c6, $programName))) {
            print 'Failed to create program file. Check directory permissions.';
            exit(1);
        }
        print "\n\tThe new program file ($file) was created successfully!\n\n";
    }


    private function programFile(bool $c6namespace, string $programName): string
    {

        $namespace = $c6namespace ? 'namespace CarbonPHP\Programs;' : 'namespace Programs;';

        return <<<PROGRAM
<?php

$namespace

use CarbonPHP\interfaces\iCommand;

class $programName implements iCommand
{
    use Background;

    private array \$CONFIG;

    public function __construct(\$CONFIG)
    {
        \$this->CONFIG = \$CONFIG;
    }

    public function usage(): void
    {
        // TODO - improve documentation
        print "\\n\\n\\tThis is an example usage message generated by the C6 NewProgram program.\\n\\n";
        exit(1);
    }

    public function cleanUp(\$argv): void
    {
        // do nothing
    }

    public function run(\$argv): void
    {
        \$C6 = CARBON_ROOT === APP_ROOT . 'src' . DS;
        \$argc = count(\$argv);
        for (\$i = 0; \$i < \$argc; \$i++) {
            switch (\$argv[\$i]) {
                default:
                case '-help':
                    if (\$C6) {
                        self::colorCode("\tYou da bomb :)\n",'blue');
                        break;
                    }
                    \$this->usage();
                    break;
                
            }
        }
       // todo - add program code
    }

}

PROGRAM;

    }

}