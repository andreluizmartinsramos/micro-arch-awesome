<?php

namespace App\Command;

use App\Entity\Usuario;
use App\Utils\Validator;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Style\SymfonyStyle;

class AppUsuarioCreateCommand extends Command
{
    protected static $defaultName = 'app:usuario:create';

    /** @var SymfonyStyle */
    private $io;

    private $validator;

    private $em;

    public function __construct(Validator $validator, EntityManagerInterface $em) {
        parent::__construct();
        $this->validator = $validator;
        $this->em = $em;
    }

    protected function configure() {
        $this
            ->setDescription('Criação de usuários')
            ->addArgument('email', InputArgument::OPTIONAL)
            ->addArgument('dr', InputArgument::OPTIONAL);
    }

    protected function initialize(InputInterface $input, OutputInterface $output) {
        $this->io = new SymfonyStyle($input, $output);
    }

    protected function interact(InputInterface $input, OutputInterface $output) {
        if (null !== $input->getArgument('dr') && null !== $input->getArgument('email')) {
            return;
        }

        $this->io->title('Add Usuário Command Interactive Wizard');

        // Ask for the email if it's not defined
        $email = $input->getArgument('email');
        if (null !== $email) {
            $this->io->text(' > <info>Email</info>: ' . $email);
        } else {
            $email = $this->io->ask('email', null, [$this->validator, 'validateEmail']);
            $input->setArgument('email', $email);
        }


        // Ask for the password if it's not defined
        $dr = $input->getArgument('dr');
        if (null !== $dr) {
            $this->io->text(' > <info>DR</info>: ' . $dr);
        } else {
            $dr = $this->io->ask('dr', null, [$this->validator, 'validateDr']);
            $input->setArgument('dr', mb_strtoupper($dr));
        }

    }

    protected function execute(InputInterface $input, OutputInterface $output) {
        $email = $input->getArgument('email');
        $dr = $input->getArgument('dr');

        $this->validateUserData($email, $dr);

        $usuario = new Usuario();
        $usuario->setEmail($email);
        $usuario->setDr($dr);

        $apiKey = hash('sha256', uniqid());
        $usuario->setApiKey($apiKey);

        $roleApi = $this->em->getRepository('App:Role')->findOneBy(['name' => 'ROLE_API']);
        $usuario->addRole($roleApi);

        $this->em->persist($usuario);
        $this->em->flush();

        $this->io->success('Usuário criado com sucesso!');
    }

    private function validateUserData($email, $dr)
    {
        $this->validator->validateDr($dr);
        $this->validator->validateEmail($email);

        $existingEmail = $this->em->getRepository('App:Usuario')->findOneBy(['email' => $email]);

        if (null !== $existingEmail) {
            throw new \RuntimeException('Este emails já está cadastrado');
        }
    }

}
