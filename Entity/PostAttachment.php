<?php

namespace KFI\CmsBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use KFI\UploadBundle\Entity\EntityUpload;

/**
 *
 * @ORM\Entity
 * @ORM\Table(
 *      name="kfi_cms_post_attachment",
 *      uniqueConstraints={@ORM\UniqueConstraint(columns={"parent_id", "upload_id"})}
 * )
 */
class PostAttachment extends EntityUpload
{
    /**
     *  @ORM\ManyToOne(targetEntity="Post",
     *      inversedBy="attachments", cascade={"persist"} )
     *  @ORM\JoinColumn(name="parent_id", nullable=false,
     *      referencedColumnName="id", onDelete="CASCADE")
     */
    private $parent;

    /**
     * Set parent
     *
     * @param Post $parent
     * @return PostAttachment
     */
    public function setParent($parent)
    {
        $this->parent = $parent;

        return $this;
    }

    /**
     * Get parent
     *
     * @return Post
     */
    public function getParent()
    {
        return $this->parent;
    }
}