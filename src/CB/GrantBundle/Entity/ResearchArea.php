<?php

namespace CB\GrantBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * PriorityResearchArea
 *
 * @ORM\Table(name="research_area",
 *              uniqueConstraints={
 *                  @ORM\UniqueConstraint(name="unique_research_area_1", columns={"research_area_tag","grant_cycle_instance_ID"}),
 *                  @ORM\UniqueConstraint(name="unique_research_area_2", columns={"research_area_tag","project_ID"})
 *                  })
 * @ORM\Entity
 *
 */
class ResearchArea
{
    /**
     * @var integer
     * @ORM\Id
     * @ORM\Column(name="research_area_ID", type="integer")
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $id;

    /**
     * @var string
     * @ORM\Column(name="research_area_tag", type="string", length=255, nullable=false)
     */
    private $researchAreaTag;


    /**
     * @var integer
     * @ORM\Column(name="grant_cycle_instance_ID", type="integer")
     */
    private $grantCycleInstanceId;

    /**
     * @var integer
     * @ORM\Column(name="project_ID", type="integer")
     */
    private $projectId;

    /**
     * @var \CB\GrantBundle\Entity\GrantCycleInstance
     *
     * @ORM\ManyToMany(targetEntity="CB\GrantBundle\Entity\GrantCycleInstance", inversedBy="priorityResearchArea")
     * @ORM\JoinTable(name="grant_cycle_under_research_area",
     *   joinColumns={
     *     @ORM\JoinColumn(name="research_area_ID", referencedColumnName="research_area_ID")
     *   },
     *   inverseJoinColumns={
     *     @ORM\JoinColumn(name="grant_cycle_instance_ID", referencedColumnName="grant_cycle_instance_ID")
     *
     *      }
     * )
     */
    private $grantCycleInstance;


    /**
     * @var \CB\ProjectBundle\Entity\Project
     *
     * @ORM\ManyToMany(targetEntity="CB\ProjectBundle\Entity\Project")
     * @ORM\JoinTable(name="project_under_research_area",
     *   joinColumns={
     *      @ORM\JoinColumn(name="research_area_ID", referencedColumnName="research_area_ID")
     *      },
     *   inverseJoinColumns={
     *     @ORM\JoinColumn(name="project_ID", referencedColumnName="project_ID")
     *   }
     * )
     */
    private $project;

    /**
     * Set researchAreaTag
     *
     * @param string $researchAreaTag
     * @return ResearchArea
     */
    public function setResearchAreaTag($researchAreaTag)
    {
        $this->researchAreaTag = $researchAreaTag;

        return $this;
    }

    /**
     * Get researchAreaTag
     *
     * @return string 
     */
    public function getResearchAreaTag()
    {
        return $this->researchAreaTag;
    }

    /**
     * Set grantCycleInstance
     *
     * @param \CB\GrantBundle\Entity\GrantCycleInstance $grantCycleInstance
     * @return ResearchArea
     */
    public function setGrantCycleInstance(\CB\GrantBundle\Entity\GrantCycleInstance $grantCycleInstance = null)
    {
        $this->grantCycleInstance = $grantCycleInstance;

        return $this;
    }

    /**
     * Get grantCycleInstance
     *
     * @return \CB\GrantBundle\Entity\GrantCycleInstance 
     */
    public function getGrantCycleInstance()
    {
        return $this->grantCycleInstance;
    }
    /**
     * Constructor
     */
    public function __construct()
    {
        $this->grantCycleInstance = new \Doctrine\Common\Collections\ArrayCollection();
        $this->project = new \Doctrine\Common\Collections\ArrayCollection();
    }

    /**
     * Add grantCycleInstance
     *
     * @param \CB\GrantBundle\Entity\GrantCycleInstance $grantCycleInstance
     * @return ResearchArea
     */
    public function addGrantCycleInstance(\CB\GrantBundle\Entity\GrantCycleInstance $grantCycleInstance)
    {
        $this->grantCycleInstance[] = $grantCycleInstance;

        return $this;
    }

    /**
     * Remove grantCycleInstance
     *
     * @param \CB\GrantBundle\Entity\GrantCycleInstance $grantCycleInstance
     */
    public function removeGrantCycleInstance(\CB\GrantBundle\Entity\GrantCycleInstance $grantCycleInstance)
    {
        $this->grantCycleInstance->removeElement($grantCycleInstance);
    }

    /**
     * Add project
     *
     * @param \CB\ProjectBundle\Entity\Project $project
     * @return ResearchArea
     */
    public function addProject(\CB\ProjectBundle\Entity\Project $project)
    {
        $this->project[] = $project;

        return $this;
    }

    /**
     * Remove project
     *
     * @param \CB\ProjectBundle\Entity\Project $project
     */
    public function removeProject(\CB\ProjectBundle\Entity\Project $project)
    {
        $this->project->removeElement($project);
    }

    /**
     * Get project
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getProject()
    {
        return $this->project;
    }

    /**
     * Get id
     *
     * @return integer 
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set grantCycleInstanceId
     *
     * @param integer $grantCycleInstanceId
     * @return ResearchArea
     */
    public function setGrantCycleInstanceId($grantCycleInstanceId)
    {
        $this->grantCycleInstanceId = $grantCycleInstanceId;

        return $this;
    }

    /**
     * Get grantCycleInstanceId
     *
     * @return integer 
     */
    public function getGrantCycleInstanceId()
    {
        return $this->grantCycleInstanceId;
    }

    /**
     * Set projectId
     *
     * @param integer $projectId
     * @return ResearchArea
     */
    public function setProjectId($projectId)
    {
        $this->projectId = $projectId;

        return $this;
    }

    /**
     * Get projectId
     *
     * @return integer 
     */
    public function getProjectId()
    {
        return $this->projectId;
    }
}
