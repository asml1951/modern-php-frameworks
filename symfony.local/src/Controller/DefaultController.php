<?php


namespace App\Controller;

use App\Entity\Article;
use App\Entity\Rubric;
use App\Entity\Towns;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Response;

class DefaultController extends AbstractController
{
    /**
     * @Route("/", name="default")
     */

    public function index()
    {
        $towns = new Towns();
        $form = $this->createFormBuilder($towns)
            ->add('name', ChoiceType::class,
                ['choices' => [], 'attr' => ['class' => 'js-example-data-array']])
            ->add('save', SubmitType::class, ['label' => 'Искать'])
            ->getForm();

        $news = $this->getDoctrine()->getRepository(Article::class)->getLatestNews();

        return $this->render('welcome.html.twig',
            ['articles' => $news,
             'form' => $form->createView(),
             'date' => date('d-m-Y')]
            );
    }

    /**
     * @Route("/arch", name="archive")
     * @param Request $request
     * @return Response
     */
    public function moveToArchive(Request $request)
    {
        $entityManager = $this->getDoctrine()->getManager();
        $articles = $entityManager->getRepository(Article::class)
            ->getByDateAndRubric($request->get('date'), $request->get('rubrics'));
        foreach ($articles as $article) {
            $article->setArchived(1);
        }
        $entityManager->flush();
        return new Response('OK! Архивированы все новости ранее '. $request->get('date'));

    }
}