<?php

namespace Leaf\Core\src\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Serializer\SerializerInterface;

class PageCreateAction
{
    public function __construct(private SerializerInterface $serializer)
    {
    }

    public function __invoke(Request $request)
    {

    }
}