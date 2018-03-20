<?php
namespace PlatformBundle\DataFixtures\ORM;

use PlatformBundle\Entity\Advert;
use PlatformBundle\Entity\AdvertSkill;
use PlatformBundle\Entity\Application;
use PlatformBundle\Entity\Image;
use Doctrine\Common\DataFixtures\FixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;

class LoadAdvert implements FixtureInterface
{
	// Dans l'argument de la méthode load, l'objet $manager est l'EntityManager
	public function load(ObjectManager $em)
	{
		// Liste des noms de catégorie à ajouter
		$liste = array
		(
            array
            (
                'title'         => 'Recherche développeur Symfony',
                'author'        => 'Eglantine',
                'content'       => "Nous recherchons un développeur Symfony débutant sur Lyon. Blabla…",
                'image'         => 'http://sdz-upload.s3.amazonaws.com/prod/upload/job-de-reve.jpg',
                'application'   => array
                (
                    array('author' => 'Marine', 'content' => 'J\'ai toutes les qualités requises.'),
                    array('author' => 'Pierre', 'content' => 'Je suis très motivé.'),
                ),
            ),
            array
            (
                'title'         => 'Poste de CP en cours',
                'author'        => 'Delilah',
                'content'       => "Lorem ipsou",
                'image'         => null,
                'application'   => array
                (
                    array('author' => 'Corvo', 'content' => 'Disponible.'),
                    array('author' => 'Emily', 'content' => 'En attente de réponse.'),
                ),
            ),
            array
            (
                'title'         => 'Développement d\'une Super IA, recherche ingénieur',
                'author'        => 'Cave Johnson',
                'content'       => "Recherche ingénieur en intelligence artificiel",
                'image'         => 'http://localhost/dev/asset/img/specimen/animaux.jpg',
                'application'   => null,
            ),
		);
        $listSkills = $em->getRepository('PlatformBundle:Skill')->findAll();

		foreach($liste as $info)
		{
            $advert = new Advert();
            $advert
                ->setTitle($info['title'])
                ->setAuthor($info['author'])
                ->setContent($info['content']);
            // On peut ne pas définir ni la date ni la publication, car ces attributs sont définis automatiquement dans le constructeur

            // Création de l'entité Image
            if(!empty($info['image']))
            {
                $image = new Image();
                $image->setUrl($info['image']);
                $image->setAlt(basename($info['image']));

                // On lie l'image à l'annonce
                $advert->setImage($image);
            }
            $em->persist($advert);

            if(!empty($info['application'])) foreach($info['application'] as $candidate)
            {
                $application = new Application();
                $application
                    ->setAuthor($candidate['author'])
                    ->setContent($candidate['content'])
                    ->setAdvert($advert);

                $em->persist($application);
            }

            // Association de compétences à l'annonce
            foreach($listSkills as $skill)
            {
                $advertSkill = new AdvertSkill();
                $advertSkill->setAdvert($advert)->setSkill($skill)->setLevel('Expert');
                $em->persist($advertSkill);
            }
		}

        $em->flush();
	}
}