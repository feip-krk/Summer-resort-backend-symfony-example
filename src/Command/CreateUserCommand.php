<?php

declare(strict_types=1);

namespace App\Command;

use App\Entity\User;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\Console\Attribute\AsCommand;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;

#[AsCommand(name: 'app:create-user')]
class CreateUserCommand extends Command
{
    private $entityManager;
    private $passwordEncoder;

    public function __construct(EntityManagerInterface $entityManager, UserPasswordHasherInterface $passwordEncoder)
    {
        parent::__construct();

        $this->entityManager = $entityManager;
        $this->passwordEncoder = $passwordEncoder;
    }

    protected function configure()
    {
        $this
            ->setDescription('Создает нового пользователя.')
            ->addArgument('email', InputArgument::REQUIRED, 'Email пользователя.')
            ->addArgument('password', InputArgument::REQUIRED, 'Пароль пользователя.')
            ->addArgument('role', InputArgument::REQUIRED, 'Роль пользователя (например, ROLE_ADMIN).');
    }

    protected function execute(InputInterface $input, OutputInterface $output): int
    {
        $email = $input->getArgument('email');
        $password = $input->getArgument('password');
        $role = $input->getArgument('role');

        $user = new User();
        $user->setEmail($email);
        $user->setRoles([$role]);
        $user->setPassword($this->passwordEncoder->hashPassword($user, $password));

        $this->entityManager->persist($user);
        $this->entityManager->flush();

        $output->writeln('Пользователь ' . $email . ' успешно создан с ролью ' . $role);

        return Command::SUCCESS;
    }
}
