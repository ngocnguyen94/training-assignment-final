<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests\ArticleRequest;
use Backpack\CRUD\app\Http\Controllers\CrudController;
use Backpack\CRUD\app\Library\CrudPanel\CrudPanelFacade as CRUD;

/**
 * Class ArticleCrudController
 * @package App\Http\Controllers\Admin
 * @property-read \Backpack\CRUD\app\Library\CrudPanel\CrudPanel $crud
 */
class ArticleCrudController extends CrudController
{
    use \Backpack\CRUD\app\Http\Controllers\Operations\ListOperation;
    use \Backpack\CRUD\app\Http\Controllers\Operations\CreateOperation;
    use \Backpack\CRUD\app\Http\Controllers\Operations\UpdateOperation;
    use \Backpack\CRUD\app\Http\Controllers\Operations\DeleteOperation;

    /**
     * Configure the CrudPanel object. Apply settings to all operations.
     *
     * @return void
     */
    public function setup()
    {
        CRUD::setModel(\App\Models\Article::class);
        CRUD::setRoute(config('backpack.base.route_prefix') . '/article');
        CRUD::setEntityNameStrings('article', 'articles');
        CRUD::addButtonFromModelFunction('line', 'open_google', 'openGoogle', 'beginning');
    }

    /**
     * Define what happens when the List operation is loaded.
     *
     * @see  https://backpackforlaravel.com/docs/crud-operation-list-entries
     * @return void
     */
    protected function setupListOperation()
    {
        CRUD::orderBy('created_at', 'DESC');

        CRUD::addColumn(['name' => 'id', 'type' => 'text']);
        CRUD::addColumn(['name' => 'title', 'type' => 'text']);
        CRUD::addColumn(['name' => 'slug', 'type' => 'text']);

        /**
         * Columns can be defined using the fluent syntax or array syntax:
         * - CRUD::column('price')->type('number');
         * - CRUD::addColumn(['name' => 'price', 'type' => 'number']);
         */
    }

    /**
     * Define what happens when the Create operation is loaded.
     *
     * @see https://backpackforlaravel.com/docs/crud-operation-create
     * @return void
     */
    protected function setupCreateOperation()
    {
        CRUD::setValidation(ArticleRequest::class);

        CRUD::addField([   // Hidden
            'name'  => 'type',
            'type'  => 'hidden',
            'value' => 'Article',
        ]);

        CRUD::field('title')->type('text')->tab('Details');
        CRUD::field('slug')
            ->type('text')
            ->hint('Part of the URL that will identify this program. Will be automatically generated from the title if left empty.')
            ->tab('Details');

        CRUD::field('description')->type('ckeditor')->tab('Details');

        CRUD::addField([
            'name'        => 'status',
            'label'       => "Status",
            'type'        => 'select2_from_array',
            'options'     => ['DRAFT' => 'Draft', 'LIVE' => 'Live', 'ARCHIVED' => 'Archived'],
            'allows_null' => false,
            'tab'         => 'Details',
        ]);

        CRUD::addField([
            'name'  => 'publish_date',
            'type'  => 'date_picker',
            'label' => 'Date',
            'default' => date('Y-m-d'),
            // optional:
            'date_picker_options' => [
                'todayBtn' => 'linked',
                'format'   => 'yyyy-mm-dd',
                'language' => 'en'
            ],
            'tab'          => 'Details'
        ]);

        CRUD::addField([
            'label' => "Banner Image",
            'name' => "banner_image",
            'type' => 'image',
            'crop' => true,
            'aspect_ratio' => 0,
            'tab' => 'Media'
        ]);

        CRUD::addField([
            'label' => "Mobile Banner Image",
            'name' => "mobile_banner_image",
            'type' => 'image',
            'crop' => true,
            'aspect_ratio' => 0,
            'tab' => 'Media'
        ]);

        /**
         * Fields can be defined using the fluent syntax or array syntax:
         * - CRUD::field('price')->type('number');
         * - CRUD::addField(['name' => 'price', 'type' => 'number']));
         */
    }

    /**
     * Define what happens when the Update operation is loaded.
     *
     * @see https://backpackforlaravel.com/docs/crud-operation-update
     * @return void
     */
    protected function setupUpdateOperation()
    {
        $this->setupCreateOperation();
    }
}
