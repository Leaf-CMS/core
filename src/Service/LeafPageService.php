<?php

namespace Leaf\Core\src\Service;

use Leaf\Core\src\Model\LeafPage;

class LeafPageService
{
    private static array $leafPageTypes = array();

    public function getLeafPageTypes(): array
    {
        if (count(self::$leafPageTypes) !== 0) {
            return self::$leafPageTypes;
        }

        foreach (get_declared_classes() as $class) {
            if (!is_subclass_of($class, LeafPage::class)) {
                continue;
            }

            self::$leafPageTypes[$class] = $class::getName();
        }

        return self::$leafPageTypes;
    }

    public function getLeafPageByType(string $type): ?string
    {
        foreach ($this->getLeafPageTypes() as $leafPageType => $leafPageTypeName) {
            if ($type === $leafPageTypeName) {
                return $leafPageType;
            }
        }

        return null;
    }
}