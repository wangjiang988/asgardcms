<?php

use Illuminate\Routing\Router;
/** @var Router $router */

$router->group(['prefix' =>'/links'], function (Router $router) {
    $router->bind('links', function ($id) {
        return app('Modules\Links\Repositories\LinksRepository')->find($id);
    });
    $router->get('links', [
        'as' => 'admin.links.links.index',
        'uses' => 'LinksController@index',
        'middleware' => 'can:links.links.index'
    ]);
    $router->get('links/create', [
        'as' => 'admin.links.links.create',
        'uses' => 'LinksController@create',
        'middleware' => 'can:links.links.create'
    ]);
    $router->post('links', [
        'as' => 'admin.links.links.store',
        'uses' => 'LinksController@store',
        'middleware' => 'can:links.links.create'
    ]);
    $router->get('links/{links}/edit', [
        'as' => 'admin.links.links.edit',
        'uses' => 'LinksController@edit',
        'middleware' => 'can:links.links.edit'
    ]);
    $router->put('links/{links}', [
        'as' => 'admin.links.links.update',
        'uses' => 'LinksController@update',
        'middleware' => 'can:links.links.edit'
    ]);
    $router->delete('links/{links}', [
        'as' => 'admin.links.links.destroy',
        'uses' => 'LinksController@destroy',
        'middleware' => 'can:links.links.destroy'
    ]);
// append

});
