<?php

namespace App\Entity;

use App\Repository\UserRepository;
use Doctrine\ORM\Mapping as ORM;
use phpDocumentor\Reflection\Types\Null_;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;
use Symfony\Component\Security\Core\User\PasswordAuthenticatedUserInterface;
use Symfony\Component\Security\Core\User\UserInterface;
use Symfony\Component\Validator\Constraints as Assert;

#[ORM\Entity(repositoryClass: UserRepository::class)]
#[ORM\EntityListeners( ['App\EntityListener\UserListener'] )]
#[UniqueEntity('username')]
class User implements UserInterface, PasswordAuthenticatedUserInterface
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: 'integer')]
    private int $id;

    #[ORM\Column(type: 'string', length: 255)]
    #[Assert\NotBlank()]
    #[Assert\Length(min: 2, max: 255)]
    private string $username;

    #[ORM\Column(type: 'string', length: 255)]
    #[Assert\NotBlank()]
    #[Assert\Length(min: 2, max: 255)]
    private string $password = 'password';

    #[Assert\Length(min: 2, max: 255)]
    private ?string $plainPassword;

    #[ORM\Column(type: 'json')]
    #[Assert\NotNull()]
    private array $roles = ['ROLE_ADMIN'];

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getUsername(): ?string
    {
        return $this->username;
    }

    public function setUsername(string $username): self
    {
        $this->username = $username;

        return $this;
    }

    public function getPassword(): ?string
    {
        return $this->password;
    }

    public function setPassword(string $password): self
    {
        $this->password = $password;

        return $this;
    }

    /**
     * Returns the roles granted to the user
     *
     * @return array
     */
    public function getRoles(): array
    {
        return ['ROLE_ADMIN'];
    }

    public function setRoles(array $roles): self
    {
        $this->roles = $roles;

        return $this;
    }


    /**
     * @return string|null The salt
     */
    public function getSalt()
    {
        return null;
    }

    /**
     * Removes sensitive data from the user.
     *
     * @return void
     */
    public function eraseCredentials()
    {
        
    }

    public function getUserIdentifier(): string
    {
        return $this->username;
    }

    /**
     * String representation of objecrt
     *
     * @return string
     */
    public function serialize()
    {
        return $this->serialize([
            $this->id,
            $this->username,
            $this->password
        ]);
    }

    /**
     * Constructs the object
     *
     * @param string $serialized
     * @return void
     */
    public function unserialize(string $serialized)
    {
        list (
            $this->id,
            $this->username,
            $this->password,
        ) = unserialize(
                $serialized, 
                ['allowed_classes' => false]
            );
    }

    public function getPlainPassword(): ?string
    {
        return $this->plainPassword;
    }

    public function setPlainPassword(string $plainPassword): self
    {
        $this->plainPassword = $plainPassword;

        return $this;
    }

   
}
