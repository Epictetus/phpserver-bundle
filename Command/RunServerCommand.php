<?php

namespace Webkatte\PHPServerBundle\Command;

use Symfony\Bundle\FrameworkBundle\Command\ContainerAwareCommand;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Output\OutputInterface;

/**
 * Command for using built in PHP 5.4 web server.
 */
class RunServerCommand extends ContainerAwareCommand
{
    const SERVER_COMMAND    = 'php -S %s:%d -t %s';
    const SERVER_START      = '<info>Symfony2 Development server started at </info><comment>%s</comment>';
    const SERVER_URL        = '<info>Your application URL: </info><comment>http://%s:%d/app_%s.php</comment>';
    const SERVER_WEBROOT    = '<info>Document root set to: </info><comment>%s</comment>';
    const SERVER_CANCEL     = '<info>Press </info><comment>Ctrl + C</comment><info> to quit.</info>';
    const PHP_ERROR         = '<error>PHP 5.4.x is required to use this command.</error>';

    protected function configure()
    {
        $this
            ->setName('server:run')
            ->addOption('host', null, InputOption::VALUE_REQUIRED, 'Hostname for running server', 'localhost')
            ->addOption('port', null, InputOption::VALUE_REQUIRED, 'Port for running server (usually running on ports < 1024 require sudo)', '8080')
            ->setDescription('Runs PHP\'s 5.4 built-in server')
        ;
    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {
        if (PHP_VERSION_ID < 50400) {
            $output->writeln(self::PHP_ERROR);
        } else {
            $host = $input->getOption('host');
            $port = $input->getOption('port');
            $env = $input->getOption('env');

            if ($env === 'prod') {
                $env = '';
            }

            $webroot = realpath($this->getApplication()->getKernel()->getRootDir() . '/../web');
            $command = vsprintf(self::SERVER_COMMAND, compact('host', 'port', 'webroot'));

            $output->writeln(sprintf(self::SERVER_START, date('r')));
            $output->writeln(sprintf(self::SERVER_URL, $host, $port, $env));
            $output->writeln(sprintf(self::SERVER_WEBROOT, $webroot));
            $output->writeln('');
            $output->writeln(self::SERVER_CANCEL);

            system($command);
        }
    }
}
