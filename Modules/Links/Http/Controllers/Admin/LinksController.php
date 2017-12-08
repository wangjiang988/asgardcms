<?php

namespace Modules\Links\Http\Controllers\Admin;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Modules\Links\Entities\Links;
use Modules\Links\Http\Requests\CreateLinksRequest;
use Modules\Links\Http\Requests\UpdateLinksRequest;
use Modules\Links\Repositories\LinksRepository;
use Modules\Core\Http\Controllers\Admin\AdminBaseController;

class LinksController extends AdminBaseController
{
    /**
     * @var LinksRepository
     */
    private $links;

    public function __construct(LinksRepository $links)
    {
        parent::__construct();

        $this->links = $links;
    }

    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index()
    {
        //$links = $this->links->all();

        return view('links::admin.links.index', compact(''));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create()
    {
        return view('links::admin.links.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  CreateLinksRequest $request
     * @return Response
     */
    public function store(CreateLinksRequest $request)
    {
        $this->links->create($request->all());

        return redirect()->route('admin.links.links.index')
            ->withSuccess(trans('core::core.messages.resource created', ['name' => trans('links::links.title.links')]));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  Links $links
     * @return Response
     */
    public function edit(Links $links)
    {
        return view('links::admin.links.edit', compact('links'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  Links $links
     * @param  UpdateLinksRequest $request
     * @return Response
     */
    public function update(Links $links, UpdateLinksRequest $request)
    {
        $this->links->update($links, $request->all());

        return redirect()->route('admin.links.links.index')
            ->withSuccess(trans('core::core.messages.resource updated', ['name' => trans('links::links.title.links')]));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  Links $links
     * @return Response
     */
    public function destroy(Links $links)
    {
        $this->links->destroy($links);

        return redirect()->route('admin.links.links.index')
            ->withSuccess(trans('core::core.messages.resource deleted', ['name' => trans('links::links.title.links')]));
    }
}
