<?php
/**
 * Created by PhpStorm.
 * User: Christabel
 * Date: 3/27/14
 * Time: 1:07 AM
 */

namespace CB\GrantBundle\Controller;


use CB\GrantBundle\Entity\GrantCycleInstance;
use CB\GrantBundle\Entity\PhaseInstance;
use CB\GrantBundle\Form\Model\ProjectToCycleType;
use CB\GrantBundle\Form\Type\GrantCycleInstanceType;
use Doctrine\Common\Collections\ArrayCollection;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

class GrantInstanceController extends Controller {
    public function viewAction($id) {
        $em = $this->getDoctrine()->getManager();
        $grantCycle = $em->getRepository('CBGrantBundle:GrantCycle')->find($id);
        $cycleInstance = $grantCycle->getGrantCycleInstance();

        return $this->render('CBGrantBundle:Default:AllGrantInstances.html.twig', array(
           'cycleInstance' => $cycleInstance,
           'grantCycle' => $grantCycle,
        ));
    }

    public function createAction($id, Request $request) {
        $em = $this->getDoctrine()->getManager();
        $grantCycle = $em->getRepository('CBGrantBundle:GrantCycle')->find($id);

        $grantCycleInstance= new GrantCycleInstance();
        $phases = $grantCycle->getPhase();

        $phaseInstances = new ArrayCollection();

        foreach( $phases as $phase ) {

            $phaseInstance = new PhaseInstance();
            $phaseInstances[] = $phaseInstance;
            $phaseInstance->setPhase($phase);

            if( $phase != $phases->first() ) {
                $phaseInstances->prev()->setNextPhaseInstance($phaseInstance);
                $phaseInstance->setPreviousPhaseInstance($phaseInstances->prev());
            }
            $grantCycleInstance->addPhaseInstance($phaseInstance);
        }

        $instanceForm = $this->createForm(new GrantCycleInstanceType(), $grantCycleInstance);
        $instanceForm->handleRequest($request);

        if($instanceForm->isValid()) {
            $grantCycleInstance->setGrantCycle($grantCycle);

            $areas = $grantCycleInstance->getResearchArea();
            foreach($grantCycleInstance->getResearchArea() as $area) {
                if($researchArea = $this->getDoctrine()->getRepository('CBGrantBundle:ResearchArea')->find($area->getResearchAreaTag())) {
                    $areas[] = $researchArea;
                    $grantCycleInstance->removeResearchAreon($area);
                }
            }

            $em = $this->getDoctrine()->getManager();
            $em->persist($grantCycleInstance);
            $em->flush();

            return $this->redirect($this->generateUrl('cb_grant_instance', array('id'=>$id)));
        } else {

            return $this->render('CBGrantBundle:Default:CreateGrantInstance.html.twig', array(
                'form'=>$instanceForm->createView(),
            ));
        }
    }

    public function addProjectAction($id, Request $request) {

        $em =  $this->getDoctrine()->getManager();
        // grant cycle instance id
        $instance = $em->getRepository('CBGrantBundle:GrantCycleInstance')->find($id);

        $formType = new ProjectToCycleType();
        $formType->setChoices($this->findProjects($em));

        $form = $this->createForm($formType);
        $form->handleRequest($request);

        if($form->isValid()) {
            $projectIds = $form['project']->getData();

            foreach( $projectIds as $pid ) {
                $project = $em->getRepository('CBProjectBundle:Project')->find($pid);
                $instance->addProject($project);
            }

            $em->persist($instance);
            $em->flush();

            return $this->redirect($this->generateUrl('cb_grant_instance', array('id'=>$instance->getGrantCycle()->getGrantCycleId())));
        } else {

            return $this->render('CBMainBundle:Default:CreateForm.html.twig', array(
                'form'=>$form->createView(),
            ));
        }

    }


    private function findProjects($em) {
        $proponentObjects = $em->getRepository('CBProjectBundle:Proponent')->findByAccountId($this->getUser()->getAccountId());

        $projects = new ArrayCollection();

        foreach($proponentObjects as $object) {
            $projects[] = $object->getProject();
        }

        return $projects;
    }
} 