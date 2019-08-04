<?php


namespace App\Controller;

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
    public $news = [ 'article1' => ['title' => 'Новость 1',
                                    'subtitle' => 'Краткое содержание новости #1',
                                    'text' => 'На сайте Госавтоинспекции появился интерактивный раздел, в котором 
                                    собрана информация о местах размещения средств фото- и видеофиксации нарушений
                                     на дорогах, сообщила официальный представитель МВД Ирина Волк. ',
                                    'image' => 'tree.jpg'],
                     'article2' => ['title' => 'Новость 2',
                                    'subtitle' => 'Краткое содержание новости #2',
                                    'text' => 'На сайте Госавтоинспекции появился интерактивный раздел, в котором 
                                    собрана информация о местах размещения средств фото- и видеофиксации нарушений
                                     на дорогах, сообщила официальный представитель МВД Ирина Волк.',
                                    'image' => 'boat.jpg'],
                     'article3' => ['title' => 'Новость 3',
                                    'subtitle' => 'Краткое содержание новости #3',
                                    'text' => 'На сайте Госавтоинспекции появился интерактивный раздел, в котором 
                                    собрана информация о местах размещения средств фото- и видеофиксации нарушений
                                     на дорогах, сообщила официальный представитель МВД Ирина Волк.',
                                    'image' => 'balloons.jpg'],
                     'article4' => ['title' => 'Новость 4',
                                    'subtitle' => 'Краткое содержание новости #4',
                                    'text' => 'На сайте Госавтоинспекции появился интерактивный раздел, в котором 
                                    собрана информация о местах размещения средств фото- и видеофиксации нарушений
                                     на дорогах, сообщила официальный представитель МВД Ирина Волк.',
                                    'image' => 'balloons.jpg'],
                     'article5' => ['title' => 'Новость 5',
                                    'subtitle' => 'Краткое содержание новости #5',
                                    'text' => 'На сайте Госавтоинспекции появился интерактивный раздел, в котором 
                                    собрана информация о местах размещения средств фото- и видеофиксации нарушений
                                     на дорогах, сообщила официальный представитель МВД Ирина Волк.',
                                    'image' => 'secretcave.jpg'],
                     'article6' => ['title' => 'Новость 6',
                                    'subtitle' => 'Краткое содержание новости #6',
                                    'text' => 'На сайте Госавтоинспекции появился интерактивный раздел, в котором 
                                    собрана информация о местах размещения средств фото- и видеофиксации нарушений
                                     на дорогах, сообщила официальный представитель МВД Ирина Волк.',
                                    'image' => 'pipe-sculpture.jpg'],
    ];

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

        return $this->render('welcome.html.twig',
            ['date' => date('d-m-Y'),'articles' => $this->news,
             'form' => $form->createView(),]
            );
    }



}