<?php

namespace KFI\CMSBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use KFI\UploadBundle\Entity\EntityHasUploads;

/**
 *
 * @ORM\Entity
 * @ORM\Table(
 *      name="cms_page_attachment",
 *      uniqueConstraints={@ORM\UniqueConstraint(columns={"parent_id", "upload_id"})}
 * )
 */
class PageAttachment extends EntityHasUploads
{
    /**
     *  @ORM\ManyToOne(targetEntity="Product",
     *      inversedBy="attachments", cascade={"persist"} )
     *  @ORM\JoinColumn(name="parent_id", nullable=false,
     *      referencedColumnName="id", onDelete="CASCADE")
     */
    private $parent;

    /**
     * Set parent
     *
     * @param Page $parent
     * @return PageAttachment
     */
    public function setParent($parent)
    {
        $this->parent = $parent;

        return $this;
    }

    /**
     * Get parent
     *
     * @return Page
     */
    public function getParent()
    {
        return $this->parent;
    }
}