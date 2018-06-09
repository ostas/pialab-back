<?php

/*
 * Copyright (C) 2015-2018 Libre Informatique
 *
 * This file is licenced under the GNU LGPL v3.
 * For the full copyright and license information, please view the LICENSE.md
 * file that was distributed with this source code.
 */

namespace PiaApi\Command;

use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Input\InputOption;
use PiaApi\Entity\Pia\Structure;
use PiaApi\Entity\Pia\StructureType;
use Symfony\Component\Security\Core\Encoder\EncoderFactoryInterface;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\Console\Style\SymfonyStyle;

class CreateStructureCommand extends Command
{
    /**
     * @var EncoderFactoryInterface
     */
    private $encoderFactory;

    /**
     * @var EntityManagerInterface
     */
    protected $entityManager;

    /**
     * @var SymfonyStyle
     */
    protected $io;

    public function __construct(
        EntityManagerInterface $entityManager
    ) {
        $this->entityManager = $entityManager;
        parent::__construct();
    }

    protected function configure()
    {
        $this
            ->setName('pia:structure:create')
            ->setDescription('Creates a new Structure.')
            ->addOption('name', null, InputOption::VALUE_REQUIRED, 'The name of the structure')
            ->addOption('type', null, InputOption::VALUE_REQUIRED, 'The type of the structure')
            ->setHelp(<<<EOT
The <info>%command.name%</info> command creates a new Structure.

<info>php %command.full_name% [--name=...] [--type=...]</info>

EOT
            );
    }

    protected function execute(InputInterface $input, OutputInterface $output): void
    {
        $this->io = new SymfonyStyle($input, $output);

        $name = $input->getOption('name');
        $type = $input->getOption('type');

        $structTypeRepo = $this->entityManager->getRepository(StructureType::class);
        $structType = $structTypeRepo->findOneBy(['name' => $type]);
        if ($structType === null) {
            $structType = new StructureType($type);
        }

        $structure = new Structure($name);
        $structure->setType($structType);

        $this->entityManager->persist($structType);
        $this->entityManager->persist($structure);
        $this->entityManager->flush();

        $this->io->success(sprintf('Structure "%s" of type "%s" successfully created !', $structure->getName(), $structType->getName()));
    }
}