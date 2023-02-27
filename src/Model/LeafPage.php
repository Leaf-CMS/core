<?php

namespace Leaf\Core\src\Model;

use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping\Column;
use Doctrine\ORM\Mapping\JoinColumn;
use Doctrine\ORM\Mapping\ManyToOne;
use Doctrine\ORM\Mapping\OneToMany;

class LeafPage
{
    public static string $leafName = "page";

    #[Column(name: 'id', type: 'string', nullable: false)]
    private string $id;

    #[Column(name: 'slug', type: 'string', nullable: true)]
    private ?string $slug = null;

    #[Column(name: 'title', type: 'string', nullable: false)]
    protected string $title;

    #[Column(name: 'path', type: 'string', nullable: false)]
    private string $path;

    #[Column(name: 'content', type: 'text', nullable: true)]
    private ?string $content = null;

    #[ManyToOne(targetEntity: LeafPage::class)]
    #[JoinColumn(name: 'parent_id', referencedColumnName: 'id', nullable: true)]
    private ?LeafPage $parent;

    /**
     * @var Collection<int, LeafPage>
     */
    #[OneToMany(mappedBy: 'parent', targetEntity: LeafPage::class)]
    private Collection $children;

    public function __construct(string $id, string $title, string $slug, ?LeafPage $parent)
    {
        $this->title = $title;
        $this->slug = $slug;
        $this->parent = $parent;
        $this->updatePath();
    }

    public static function getLeafName(): string
    {
        return self::$leafName;
    }

    public function getSlug(): string
    {
        return $this->slug;
    }

    public function setSlug(string $slug): void
    {
        $this->slug = $slug;
        $this->updatePath();
    }

    public function updatePath(): void {
        if($this->parent === null) {
            $this->path = $this->slug;
        }

        $this->path = sprintf("%s/%s", $this->parent->getPath(), $this->slug);

        foreach ($this->children as $child) {
            $child->updatePath();
        }

    }

    public function getTitle(): string
    {
        return $this->title;
    }

    public function setTitle(string $title): void
    {
        $this->title = $title;
    }

    public function getPath(): string
    {
        return $this->path;
    }

    public function getParent(): ?LeafPage
    {
        return $this->parent;
    }

    public function setParent(?LeafPage $parent): void
    {
        $this->parent = $parent;
    }

    public function getChildren(): array
    {
        return $this->children;
    }

    public function setChildren(array $children): void
    {
        $this->children = $children;
    }

    public function addChild(LeafPage $page) {
        $this->children[] = $page;
    }
}