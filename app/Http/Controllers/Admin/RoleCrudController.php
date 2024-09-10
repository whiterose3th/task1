<?php

namespace App\Http\Controllers\Admin;

use App\Models\Role; 
use Spatie\Permission\Models\Permission; 
use App\Http\Requests\RoleRequest;
use Backpack\CRUD\app\Http\Controllers\CrudController;
use Backpack\CRUD\app\Library\CrudPanel\CrudPanelFacade as CRUD;

/**
 * Class RoleCrudController
 * @package App\Http\Controllers\Admin
 * @property-read \Backpack\CRUD\app\Library\CrudPanel\CrudPanel $crud
 */
class RoleCrudController extends CrudController
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
        CRUD::setModel(\App\Models\Role::class); 
        CRUD::setRoute(config('backpack.base.route_prefix') . '/role');
        CRUD::setEntityNameStrings('role', 'roles');

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
        if (!backpack_user()->hasAnyRole(['admin', 'user'])) {
            abort(403, 'Unauthorized action.');
        }

        CRUD::column('name')->label('Role Name');
        CRUD::addColumn([
            'name'  => 'permissions',
            'label' => 'Permissions',
            'type'  => 'select_multiple',
            'entity' => 'permissions', 
            'attribute' => 'name',
            'model' => Permission::class, 
        ]);
    }

    /**
     * Define what happens when the Create operation is loaded.
     * 
     * @return void
     */
    protected function setupCreateOperation()
    {
        if (!backpack_user()->hasRole('admin')) {
            abort(403, 'Unauthorized action.');
        }

        CRUD::setValidation(RoleRequest::class);

        CRUD::field('name')->label('Role Name')->type('text');

        CRUD::addField([
            'label' => "Permissions",
            'type' => 'select2_multiple',
            'name' => 'permissions',
            'entity' => 'permissions',
            'attribute' => 'name',
            'model' => Permission::class, 
            'pivot' => true,
        ]);
    }

    /**
     * Define what happens when the Update operation is loaded.
     * 
     * @return void
     */
    protected function setupUpdateOperation()
    {
        if (!backpack_user()->hasRole('admin')) {
            abort(403, 'Unauthorized action.');
        }

        $this->setupCreateOperation();
    }
}
