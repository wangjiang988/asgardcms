<?php

namespace Modules\Testimonials\Http\Controllers\Admin;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Modules\Testimonials\Entities\Testimonial;
use Modules\Testimonials\Http\Requests\CreateTestimonialRequest;
use Modules\Testimonials\Http\Requests\UpdateTestimonialRequest;
use Modules\Testimonials\Repositories\TestimonialRepository;
use Modules\Core\Http\Controllers\Admin\AdminBaseController;

class TestimonialController extends AdminBaseController
{
    /**
     * @var TestimonialRepository
     */
    private $testimonial;

    public function __construct(TestimonialRepository $testimonial)
    {
        parent::__construct();

        $this->testimonial = $testimonial;
    }

    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index()
    {
        $testimonials = $this->testimonial->all();

        return view('testimonials::admin.testimonials.index', compact('testimonials'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create()
    {
        return view('testimonials::admin.testimonials.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  CreateTestimonialRequest $request
     * @return Response
     */
    public function store(CreateTestimonialRequest $request)
    {
        $this->testimonial->create($request->all());

        return redirect()->route('admin.testimonials.testimonial.index')
            ->withSuccess(trans('core::core.messages.resource created', ['name' => trans('testimonials::testimonials.title.testimonials')]));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  Testimonial $testimonial
     * @return Response
     */
    public function edit(Testimonial $testimonial)
    {
        return view('testimonials::admin.testimonials.edit', compact('testimonial'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  Testimonial $testimonial
     * @param  UpdateTestimonialRequest $request
     * @return Response
     */
    public function update(Testimonial $testimonial, UpdateTestimonialRequest $request)
    {
        $this->testimonial->update($testimonial, $request->all());

        return redirect()->route('admin.testimonials.testimonial.index')
            ->withSuccess(trans('core::core.messages.resource updated', ['name' => trans('testimonials::testimonials.title.testimonials')]));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  Testimonial $testimonial
     * @return Response
     */
    public function destroy(Testimonial $testimonial)
    {
        $this->testimonial->destroy($testimonial);

        return redirect()->route('admin.testimonials.testimonial.index')
            ->withSuccess(trans('core::core.messages.resource deleted', ['name' => trans('testimonials::testimonials.title.testimonials')]));
    }
}
