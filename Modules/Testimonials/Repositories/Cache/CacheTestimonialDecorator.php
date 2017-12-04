<?php

namespace Modules\Testimonials\Repositories\Cache;

use Modules\Testimonials\Repositories\TestimonialRepository;
use Modules\Core\Repositories\Cache\BaseCacheDecorator;

class CacheTestimonialDecorator extends BaseCacheDecorator implements TestimonialRepository
{
    public function __construct(TestimonialRepository $testimonial)
    {
        parent::__construct();
        $this->entityName = 'testimonials.testimonials';
        $this->repository = $testimonial;
    }
}
