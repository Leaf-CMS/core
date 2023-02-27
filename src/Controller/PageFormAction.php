<?php

namespace Leaf\Core\src\Controller;

use Leaf\Core\src\Service\LeafPageService;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use Symfony\Component\Routing\Annotation\Route;

class PageFormAction
{
    public function __construct(private LeafPageService $leafPageService)
    {
    }

    #[Route('/api/page/{type}')]
    public function __invoke(Request $request)
    {
        $type = $request->get('type');

        $leafPageType = $this->leafPageService->getLeafPageByType($type);

        if($leafPageType === null) {
            throw new NotFoundHttpException();
        }

        $reflection = new \ReflectionClass($leafPageType);

        $properties = $reflection->getProperties();
    }
}