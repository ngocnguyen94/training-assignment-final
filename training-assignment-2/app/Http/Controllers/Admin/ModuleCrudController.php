<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests\ModuleRequest;
use Backpack\CRUD\app\Http\Controllers\CrudController;
use Backpack\CRUD\app\Library\CrudPanel\CrudPanelFacade as CRUD;
use Illuminate\Support\Facades\Log;

/**
 * Class ModuleCrudController
 * @package App\Http\Controllers\Admin
 * @property-read \Backpack\CRUD\app\Library\CrudPanel\CrudPanel $crud
 */
class ModuleCrudController extends CrudController
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
        CRUD::setModel(\App\Models\Module::class);
        CRUD::setRoute(config('backpack.base.route_prefix') . '/module');
        CRUD::setEntityNameStrings('module', 'modules');
    }

    /**
     * Define what happens when the List operation is loaded.
     *
     * @see  https://backpackforlaravel.com/docs/crud-operation-list-entries
     * @return void
     */
    protected function setupListOperation()
    {
        CRUD::orderBy('id', 'ASC');

        CRUD::addColumn([
            // any type of relationship
            'name'         => 'academy_program_id', // name of relationship method in the model
            'type'         => 'relationship',
            'label'        => 'Program', // Table column heading
            'entity'       => 'program', // the method that defines the relationship in your Model
            'attribute'    => 'name', // foreign key attribute that is shown to user
            'model'        => 'App\Models\Program', // foreign key model
        ]);

        CRUD::addColumn(['name' => 'name', 'type' => 'text']);
        CRUD::addColumn(['name' => 'slug', 'type' => 'text']);

        CRUD::addColumn([
            // run a function on the CRUD model and show its return value
            'name'  => 'order',
            'label' => 'Order', // Table column heading
            'type'  => 'model_function',
            'function_name' => 'getOrder', // the method in your Model
            // 'function_parameters' => [$one, $two], // pass one/more parameters to that method
            // 'limit' => 100, // Limit the number of characters shown
         ]);

         CRUD::addColumn([
            // run a function on the CRUD model and show its return value
            'name'  => 'parent_id',
            'label' => 'Parent Module', // Table column heading
            'type'  => 'model_function',
            'function_name' => 'getParentModule', // the method in your Model
            // 'function_parameters' => [$one, $two], // pass one/more parameters to that method
            // 'limit' => 100, // Limit the number of characters shown
         ]);
    }

    /**
     * Define what happens when the Create operation is loaded.
     *
     * @see https://backpackforlaravel.com/docs/crud-operation-create
     * @return void
     */
    protected function setupCreateOperation()
    {
        CRUD::setValidation(ModuleRequest::class);

        // CRUD::addField(
        //     [
        //         'label' => "Program",
        //         'type' => "select2",
        //         'name' => 'academy_program_id', // the db column for the foreign key
        //         'entity'    => 'program', // the method that defines the relationship in your Model
        //         'model'     => 'App\Models\Program', // foreign key model
        //         'attribute' => 'name', // foreign key attribute that is shown to user
        //     ]
        // );

        CRUD::addField([
            'label'       => "Program", // Table column heading
            'type'        => "select2_from_ajax",
            'name'        => 'academy_program_id', // the column that contains the ID of that connected entity
            'entity'      => 'program', // the method that defines the relationship in your Model
            'model'       => 'App\Models\Program', // foreign key model
            'attribute'   => "name", // foreign key attribute that is shown to user
            'placeholder' => "Select a Program", // placeholder for the select
            'method'      => 'GET', // optional - HTTP method to use for the AJAX call (GET, POST)
            'minimum_input_length' => 0, // THIS IS A MUST!!! NOT OPTIONAL!!!
            'allows_null' => false,
            'data_source' => url('/api/program'),
        ]);

        // CRUD::addField(
        //     [
        //         'label' => "Parent Module",
        //         'type' => "select",
        //         'name' => 'parent_id', // the db column for the foreign key
        //         'entity'    => 'parent', // the method that defines the relationship in your Model
        //         'model'     => 'App\Models\Module', // foreign key model
        //         'attribute' => 'display_name', // foreign key attribute that is shown to user
        //         'allows_null'   => true,
        //         'options'   => (function ($query) {
        //             // Remove itself from select so that it cannot select itself as parent
        //             return $query->where('id', '<>', $this->crud->getCurrentEntryId())->get();
        //         })
        //      ]
        // );

        CRUD::addField([
            // 1-n relationship
            'label'       => "Parent Module", // Table column heading
            'type'        => "select2_from_ajax",
            'name'        => 'parent_id', // the column that contains the ID of that connected entity
            'entity'      => 'parent', // the method that defines the relationship in your Model
            'model'       => 'App\Models\Module', // foreign key model
            'attribute'   => "display_name", // foreign key attribute that is shown to user
            'placeholder' => "Select a Parent Module", // placeholder for the select
            'allows_null' => true,
            'method'      => 'GET', // optional - HTTP method to use for the AJAX call (GET, POST)
            'minimum_input_length' => 0, // THIS IS A MUST!!! NOT OPTIONAL!!!
            'dependencies'=> ['program'], // when a dependency changes, this select2 is reset to null
            'data_source' => url('/api/module/parent-module', [$this->crud->getCurrentEntryId() == false ? 0 : $this->crud->getCurrentEntryId()]),
        ]);

        CRUD::field('order')->type('number')->hint('The order the modules will appear in.')->tab('Details');
        CRUD::field('name')->type('text')->tab('Details');
        CRUD::field('slug')->type('text')->hint('Part of the URL that will identify this program. Will be automatically generated from the title if left empty.')->tab('Details');
        CRUD::field('description')->type('ckeditor')->tab('Details');
        CRUD::field('sub_modules_intro')->type('ckeditor')->tab('Details');

        CRUD::addField([
            'label' => "Banner Image",
            'name' => "banner_image",
            'type' => 'image',
            'crop' => true,
            'aspect_ratio' => 2,
            'tab' => 'Media'
        ]);
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
