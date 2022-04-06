<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests\ProgramRequest;
use Backpack\CRUD\app\Http\Controllers\CrudController;
use Backpack\CRUD\app\Library\CrudPanel\CrudPanelFacade as CRUD;

/**
 * Class ProgramCrudController
 * @package App\Http\Controllers\Admin
 * @property-read \Backpack\CRUD\app\Library\CrudPanel\CrudPanel $crud
 */
class ProgramCrudController extends CrudController
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
        CRUD::setModel(\App\Models\Program::class);
        CRUD::setRoute(config('backpack.base.route_prefix') . '/program');
        CRUD::setEntityNameStrings('program', 'programs');
    }

    /**
     * Define what happens when the List operation is loaded.
     *
     * @see  https://backpackforlaravel.com/docs/crud-operation-list-entries
     * @return void
     */
    protected function setupListOperation()
    {
        CRUD::column('name');
        CRUD::column('slug');
        CRUD::column('status');
    }

    /**
     * Define what happens when the Create operation is loaded.
     *
     * @see https://backpackforlaravel.com/docs/crud-operation-create
     * @return void
     */
    protected function setupCreateOperation()
    {
        CRUD::setValidation(ProgramRequest::class);

        CRUD::addField([
            'name'        => 'status',
            'label'       => "Status",
            'type'        => 'select2_from_array',
            'options'     => ['DRAFT' => 'Draft', 'LIVE' => 'Live', 'ARCHIVED' => 'Archived'],
            'allows_null' => false,
        ]);

        CRUD::field('name')->type('text')->tab('Details');
        CRUD::field('slug')->type('text')->hint('Part of the URL that will identify this program. Will be automatically generated from the title if left empty.')->tab('Details');
        CRUD::field('subtitle')->type('text')->hint('e.g. $2000 draw every 3 months!')->tab('Details');
        CRUD::field('description')->type('ckeditor')->tab('Details');
        CRUD::field('short_description')->type('ckeditor')->tab('Details');

        CRUD::addField([
            'label' => "Banner Image",
            'name' => "banner_image",
            'type' => 'image',
            'crop' => true,
            'aspect_ratio' => 2,
            'tab' => 'Media'
        ]);

        CRUD::addField([
            'label' => "Logo Image",
            'name' => "logo_image",
            'type' => 'image',
            'crop' => true,
            'aspect_ratio' => 1,
            'tab' => 'Media'
        ]);

        CRUD::addField([
            'name'     => 'tab_info',
            'label'    => "Information Tab",
            'type'     => 'checkbox',
            'fake'     => true,
            'store_in' => 'meta',
            'tab'      => 'Resources'
        ]);

        CRUD::addField([
            'name'     => 'tab_employers',
            'label'    => "Employers Tab",
            'type'     => 'checkbox',
            'fake'     => true,
            'store_in' => 'meta',
            'tab'      => 'Resources'
        ]);

        CRUD::addField([
            'name'     => 'tab_articles',
            'label'    => "Articles Tab",
            'type'     => 'checkbox',
            'fake'     => true,
            'store_in' => 'meta',
            'tab'      => 'Resources'
        ]);

        CRUD::field('about_infos')->type('ckeditor')->tab('Resources');
        CRUD::field('about_banner')->type('ckeditor')->tab('Resources');

        CRUD::addField([
            // n-n relationship
            'label'       => "Articles", // Table column heading
            'type'        => "select2_from_ajax_multiple",
            'name'        => 'articles', // a unique identifier (usually the method that defines the relationship in your Model)
            'placeholder' => "Select articles", // placeholder for the select
            'entity'      => 'articles', // the method that defines the relationship in your Model
            'attribute'   => "title", // foreign key attribute that is shown to user,
            'model'       => "App\Models\Article", // foreign key model
            'data_source' => url("api/article"), // url to controller search function (with /{id} should return model)
            'pivot'       => false, // on create&update, do you need to add/delete pivot table entries?
            'minimum_input_length' => 2, // minimum characters to type before querying results
            'store_in'    => 'articles',
            'tab'         => 'Resources',

            // OPTIONAL
            // 'delay' => 500, // the minimum amount of time between ajax requests when searching in the field
            // 'model'                => "App\Models\City", // foreign key model
            // 'placeholder'          => "Select a city", // placeholder for the select
            // 'minimum_input_length' => 2, // minimum characters to type before querying results
            // 'include_all_form_fields'  => false, // optional - only send the current field through AJAX (for a smaller payload if you're not using multiple chained select2s)
        ]);

        // CRUD::addField([
        //     // 1-n relationship
        //     'label'       => "Articles", // Table column heading
        //     'type'        => "select2_from_ajax",
        //     'name'        => 'parent_id', // the column that contains the ID of that connected entity
        //     'entity'      => 'parent', // the method that defines the relationship in your Model
        //     'model'       => 'App\Models\Module', // foreign key model
        //     'attribute'   => "display_name", // foreign key attribute that is shown to user
        //     'placeholder' => "Select a Parent Module", // placeholder for the select
        //     'allows_null' => true,
        //     'method'      => 'GET', // optional - HTTP method to use for the AJAX call (GET, POST)
        //     'minimum_input_length' => 0, // THIS IS A MUST!!! NOT OPTIONAL!!!
        //     'dependencies'=> ['program'], // when a dependency changes, this select2 is reset to null
        //     'data_source' => url('/api/module/parent-module', [$this->crud->getCurrentEntryId() == false ? 0 : $this->crud->getCurrentEntryId()]),
        // ]);
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
