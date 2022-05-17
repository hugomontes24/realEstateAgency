<?php
namespace App\Controller;

use App\Entity\Property;
use App\Repository\PropertyRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Doctrine\ORM\EntityManagerInterface;
use Doctrine\Persistence\ManagerRegistry;
use Doctrine\Persistence\ObjectManager;
use Symfony\Component\String\Slugger\SluggerInterface;

class PropertyController extends AbstractController
{
    /**
     * @var PropertyRepository
     */
    private PropertyRepository $repository;

    /**
     * @var EntityManagerInterface
     */
    private EntityManagerInterface $oEm;

     /**
     * @var ManagerRegistry
     */
    private ManagerRegistry $doctrine;


    private SluggerInterface $slugger;

    public function __construct( PropertyRepository $repository, ManagerRegistry $doctrine, EntityManagerInterface $oEm, SluggerInterface $slugger )
    {
        $this->repository = $repository;
        $this->oEm = $oEm;
        $this->slugger = $slugger;
    }

    /**
     * @Route("/biens", name="property.index")
     * @return Response
     */ 
    public function index(ManagerRegistry $doctrine, PropertyRepository $repository): Response
    // public function index(): Response
    {
        // requete insert into
        // $oProperty = new Property();
        // $oProperty->setTitle('Dix bien')
        //     ->setSlug('dix-bien')
        //     ->setPrice(200000)
        //     ->setRooms(4)
        //     ->setBedrooms(3)
        //     ->setDescription('Une petite description')
        //     ->setSurface(60)
        //     ->setFloor(4)
        //     ->setHeat(1)
        //     ->setCity('Paris')
        //     ->setAddress('1 Avenue Champs Elysées')
        //     ->setPostalCode('74000')
        //     ;

        // J'instancie une instance de ObjectManager
        // $oEm =new ManagerRegistry();
        // $oEm = $doctrine->getManager();
        // $oEm->persist($oProperty);
        // $oEm->flush();

        // $property = $this->repository->findAllVisible();
        // $property[0]->setSold(true);
        // $this->oEm->flush();
       

    

        return $this->render('property/index.html.twig', [
            'current_menu' => 'properties'
        ]);
    }

  

    /**
     * @Route("/biens/{slug}-{id}", name="property.show", requirements={"slug": "[a-z0-9\-]*"})
     * @return Response
     */ 
    // public function show($slug, $id): Response
    public function show(Property $property, string $slug): Response
    {
        if($property->getSlug() !== $slug){
            return $this->redirectToRoute('property.show', [
                'id' => $property->getId(),
                'slug'=> $property->getSlug()
            ], 301);
        }
        // $property = $this->repository->find($id);
        $slug = $this->slugger->slug( $property->getTitle() );
        $property->setSlug($slug);

        return $this->render('property/show.html.twig', [
            'property' => $property,
            'current_menu' => 'properties'
        ]);
    }




}       