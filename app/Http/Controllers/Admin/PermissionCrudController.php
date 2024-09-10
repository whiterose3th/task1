<?php

namespace App\Http\Controllers\Admin;

use App\Models\Permission;
use App\Http\Requests\PermissionRequest;
use Backpack\CRUD\app\Http\Controllers\CrudController;
use Backpack\CRUD\app\Library\CrudPanel\CrudPanelFacade as CRUD;

/**
 * Class PermissionCrudController
 * @package App\Http\Controllers\Admin
 * @property-read \Backpack\CRUD\app\Library\CrudPanel\CrudPanel $crud
 */
class PermissionCrudController extends CrudController
{
    use \Backpack\CRUD\app\Http\Controllers\Operations\ListOperation;
    use \Backpack\CRUD\app\Http\Controllers\Operations\CreateOperation;
    use \Backpack\CRUD\app\Http\Controllers\Operations\UpdateOperation;
    use \Backpack\CRUD\app\Http\Controllers\Operations\DeleteOperation;
    use \Backpack\CRUD\app\Http\Controllers\Operations\ShowOperation;

    /**
     * Configure the CrudPanel object. Apply settings to all operations.
     * 
     * @return void
     */
    public function setup()
    {
        CRUD::setModel(\App\Models\Permission::class);
        CRUD::setRoute(config('backpack.base.route_prefix') . '/permission');
        CRUD::setEntityNameStrings('permission', 'permissions');

        if (!backpack_user()->hasRole('admin')) {
            CRUD::denyAccess(['create', 'update', 'delete']);
        }
    }

    /**
     * Define what happens when the List operation is loaded.
     * 
     * @return void
     */
    protected function setupListOperation()
    {
        CRUD::column('id')->label('ID');
        CRUD::column('name')->label('Permission Name');
        CRUD::column('guard_name')->label('Guard')->type('text');
        CRUD::column('created_at')->label('Created At')->type('datetime');
        CRUD::column('updated_at')->label('Updated At')->type('datetime');
    }

    /**
     * Define what happens when the Create operation is loaded.
     * 
     * @return void
     */
    protected function setupCreateOperation()
    {
        CRUD::setValidation(PermissionRequest::class);

        CRUD::field('name')->label('Permission Name')->type('text')->attributes(['placeholder' => 'Enter permission name']);
        CRUD::field('guard_name')->label('Guard')->type('text')->value('web');
    }

    /**
     * Define what happens when the Update operation is loaded.
     * 
     * @return void
     */
    protected function setupUpdateOperation()
    {
        $this->setupCreateOperation();
    }
}
