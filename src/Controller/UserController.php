<?php

namespace App\Controller;

use App\Entity\User;
use App\Form\UserPasswordType;
use App\Form\UserType;
use Doctrine\ORM\EntityManager;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Core\Validator\Constraints\UserPassword;

class UserController extends AbstractController
{
    #[Route('/user/edition/{id}', name: 'user.edit', methods:['GET','POST']) ]
    /**
     * This controller allow us to edit user's profile
     *
     * @param User $user
     * @param Request $request
     * @param EntityManagerInterface $manager
     * @return Response
     */
    public function edit(User $user, Request $request, EntityManagerInterface $manager, UserPasswordHasherInterface $hasher): Response
    {
        if( !$this->getUser() ){
            return $this->redirectToRoute('login');
        }

        if($this->getUser() !== $user) {
            return $this->redirectToRoute('admin.property.index');
        }

        $form = $this->createForm(UserType::class, $user);

        $form->handleRequest($request);
        // if($form->isSubmitted() && $form->isValid()){
        if($form->isSubmitted() ){
            $user = $form->getData();
            if($hasher->isPasswordValid(
                        $user, 
                        $form->getData()->getPlainPassword()
                        )
            ){
                $user = $form->getData();
                // dd($user);
                $manager->persist($user);
                $manager->flush();

                $this->addFlash(
                    'success',
                    'Les modifications ont été prises en compte.'
                );
                return $this->redirectToRoute('property.index');

            }else{
                $this->addFlash(
                    'warning',
                    'Le mot de passe est incorrect.'
                );
            }
        }

        return $this->render('user/edit.html.twig', [
            'form' => $form->createView(),
        ]);
    }

    #[Route('/user/edition-password/{id}', name: 'user.edit.password') ]
    public function editPassword(User $user, Request $request, UserPasswordHasherInterface $hasher, EntityManagerInterface $manager): Response
    {
        $form = $this->createForm(UserPasswordType::class);
        $form->handleRequest($request);
        if($form->isSubmitted() ) {
            if($hasher->isPasswordValid($user, $form->getData()['plainPassword'])){

                $user->setPassword( $hasher->hashPassword($user, $form->getData()['newPassword']) );
                
                $manager->persist($user);
                $manager->flush();
                // dd( $user );
                $this->addFlash(
                    'success',
                    'Le mot de passe a été modifié.'
                );
                return $this->redirectToRoute('property.index');

            }else{
                $this->addFlash(
                    'warning',
                    'Le mot de passe est incorrect.'
                );
            }

        }
        return $this->render('user/edit_password.html.twig',
                            [
                                'form'=>$form->createView()
                            ]
                );
    }


}
