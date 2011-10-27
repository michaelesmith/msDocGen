#!/usr/bin/php
<?php

require __DIR__ . '/vendor/Symfony/Component/ClassLoader/UniversalClassLoader.php';
use Symfony\Component\ClassLoader\UniversalClassLoader;

$loader = new UniversalClassLoader();

// register classes with namespaces
$loader->registerNamespaces(array(
    'Symfony\Component' => __DIR__ . '/vendor',
));

// activate the autoloader
$loader->register();



use Symfony\Component\Console\Application;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Output\OutputInterface;
 
$console = new Application();
$console
    ->register('parse')
    ->setDefinition(array(
        new InputArgument('input', InputArgument::REQUIRED, 'input file'),
        new InputArgument('output', InputArgument::OPTIONAL, 'output file'),
    ))
    ->setDescription('Parses the file and renders its output as comments')
    ->setCode(function (InputInterface $input, OutputInterface $output) {
        $filenameIn = $input->getArgument('input');
        $filenameOut = $input->getArgument('output') ? $input->getArgument('output') : $filenameIn;
 
			$parser = function ($filenameIn987654321){
				$output987654321 = '';
				$file987654321 = file($filenameIn987654321);

				foreach($file987654321 as $line987654321){
					if(substr($line987654321, 0, 3) == '///'){
						continue;
					}
					ob_start();
					$evalLine987654321 = str_replace(array('<?php'), null, $line987654321);
					eval($evalLine987654321);
					$result987654321 = trim(ob_get_clean());
					$output987654321 .= sprintf($result987654321 ? "%s\n///%s\n" : "%s\n", trim($line987654321), str_replace(array("\r\n", "\n\r", "\n", "\r"), "\n///", $result987654321));
				}
			
				return $output987654321;
			};

			$result = $parser($filenameIn);
			file_put_contents($filenameOut, $result);

			$output->writeln(sprintf('Parsed contents of <info>%s</info> into <info>%s</info>', $filenameIn, $filenameOut));
    })
;
$console->run();
