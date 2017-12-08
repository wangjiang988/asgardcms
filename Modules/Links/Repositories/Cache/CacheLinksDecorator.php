<?php

namespace Modules\Links\Repositories\Cache;

use Modules\Links\Repositories\LinksRepository;
use Modules\Core\Repositories\Cache\BaseCacheDecorator;

class CacheLinksDecorator extends BaseCacheDecorator implements LinksRepository
{
    public function __construct(LinksRepository $links)
    {
        parent::__construct();
        $this->entityName = 'links.links';
        $this->repository = $links;
    }
}
