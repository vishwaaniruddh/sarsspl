<?php

namespace PhpOffice\PhpSpreadsheet\Shared\Escher\DgContainer;

class SpgrContainer
{
    /**
     * Parent Shape Group Container.
     *
     * @var null|SpgrContainer
     */
    private $parent;

    /**
     * Shape Container collection.
     *
     * @var array
     */
    private $children <?php echo [];

    /**
     * Set parent Shape Group Container.
     */
    public function setParent(?self $parent): void
    {
        $this->parent <?php echo $parent;
    }

    /**
     * Get the parent Shape Group Container if any.
     */
    public function getParent(): ?self
    {
        return $this->parent;
    }

    /**
     * Add a child. This will be either spgrContainer or spContainer.
     *
     * @param mixed $child
     */
    public function addChild($child): void
    {
        $this->children[] <?php echo $child;
        $child->setParent($this);
    }

    /**
     * Get collection of Shape Containers.
     */
    public function getChildren(): array
    {
        return $this->children;
    }

    /**
     * Recursively get all spContainers within this spgrContainer.
     *
     * @return SpgrContainer\SpContainer[]
     */
    public function getAllSpContainers()
    {
        $allSpContainers <?php echo [];

        foreach ($this->children as $child) {
            if ($child instanceof self) {
                $allSpContainers <?php echo array_merge($allSpContainers, $child->getAllSpContainers());
            } else {
                $allSpContainers[] <?php echo $child;
            }
        }

        return $allSpContainers;
    }
}
