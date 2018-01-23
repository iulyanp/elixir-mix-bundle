<?php

namespace Iulyanp\ElixirMixBundle\Command;

use Symfony\Bundle\FrameworkBundle\Command\ContainerAwareCommand;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Filesystem\Exception\IOExceptionInterface;
use Symfony\Component\Filesystem\Filesystem;

/**
 * Class ElixirMixCommand.
 */
class ElixirMixCommand extends ContainerAwareCommand
{
    /**
     * Configure.
     */
    public function configure()
    {
        $this->setName('mix:init')
            ->setDescription('Init the bootstrap package.json and webpack.mix.js files.');
    }

    /**
     * @param InputInterface  $input
     * @param OutputInterface $output
     *
     * @return void
     */
    public function execute(InputInterface $input, OutputInterface $output)
    {
        $this->writeInfo($output, 'Installing laravel mix...');

        $container = $this->getContainer();
        $appDir = $container->getParameter('kernel.root_dir');
        $rootDir = $this->getRootDir($appDir);

        try {
            $fs = new Filesystem();

            $packageContent = realpath(dirname(__FILE__)).'/../package.json';
            $packagePath = sprintf('%s%s', $rootDir, 'package.json');
            $fs->copy($packageContent, $packagePath);

            $webpackMixContent = realpath(dirname(__FILE__)).'/../webpack.mix.js.dist';
            $webpackMixPath = sprintf('%s%s', $rootDir, 'webpack.mix.js');
            $fs->copy($webpackMixContent, $webpackMixPath);
        } catch (IOExceptionInterface $e) {
            $this->writeError($output, $e->getMessage());
        }

        $this->writeInfo($output, "You're all set. Go and build something amazing.");
    }

    /**
     * @param OutputInterface $output
     * @param string          $error
     *
     * @return mixed
     */
    private function writeError(OutputInterface $output, $error)
    {
        return $output->writeln('<error>'.$error.'</error>');
    }

    /**
     * @param OutputInterface $output
     * @param string          $message
     *
     * @return mixed
     */
    private function writeInfo(OutputInterface $output, $message)
    {
        return $output->writeln(sprintf('<info>%s</info>', $message));
    }

    /**
     * @param $appDir
     *
     * @return string
     */
    private function getRootDir($appDir)
    {
        return sprintf('%s%s%s%s', $appDir, DIRECTORY_SEPARATOR, '..', DIRECTORY_SEPARATOR);
    }
}
