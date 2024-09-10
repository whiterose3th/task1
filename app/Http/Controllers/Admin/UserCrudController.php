<?php

namespace App\Http\Controllers\Admin;

use App\Models\User;
use App\Http\Requests\UserRequest;
use Backpack\CRUD\app\Http\Controllers\CrudController;
use Backpack\CRUD\app\Library\CrudPanel\CrudPanelFacade as CRUD;
use Spatie\Permission\Models\Role;

/**
 * Class UserCrudController
 * @package App\Http\Controllers\Admin
 * @property-read \Backpack\CRUD\app\Library\CrudPanel\CrudPanel $crud
 */
class UserCrudController extends CrudController
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
        CRUD::setModel(User::class);
        CRUD::setRoute(config('backpack.base.route_prefix') . '/user');
        CRUD::setEntityNameStrings('user', 'users');

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

        CRUD::addColumn([
            'name' => 'name',
            'label' => 'Name',
            'type' => 'text',
        ]);

        CRUD::addColumn([
            'name' => 'email',
            'label' => 'Email',
            'type' => 'email',
        ]);

        CRUD::addColumn([
            'name' => 'roles',
            'label' => 'Roles',
            'type' => 'model_function',
            'function_name' => 'getRoleNamesDisplay',
            'limit' => 100,
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

        CRUD::setValidation(UserRequest::class);

        CRUD::addField([
            'name' => 'name',
            'label' => 'Name',
            'type' => 'text',
        ]);

        CRUD::addField([
            'name' => 'email',
            'label' => 'Email',
            'type' => 'email',
        ]);

        CRUD::addField([
            'label'     => 'Roles',
            'type'      => 'select_multiple',
            'name'      => 'roles', 
            'entity'    => 'roles', 
            'attribute' => 'name', 
            'model'     => Role::class, 
            'pivot'     => true, 
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
    
        // Modify 'name' field to include the edit button
        CRUD::modifyField('name', [
            'attributes' => ['readonly' => 'readonly'],  // Set field as read-only
            'suffix' => view('vendor.backpack.crud.buttons.edit_field_button', ['crud' => $this->crud, 'entry' => $this->crud->getCurrentEntry()])->render(), // Render button with data
        ]);
    
        // Modify 'email' field to include the edit button
        CRUD::modifyField('email', [
            'attributes' => ['readonly' => 'readonly'],  // Set field as read-only
            'suffix' => view('vendor.backpack.crud.buttons.edit_field_button', ['crud' => $this->crud, 'entry' => $this->crud->getCurrentEntry()])->render(), // Render button with data
        ]);
    }

    /**
     * Override update function to handle custom behavior.
     */
    public function update(UserRequest $request)
    {
        $user = $this->crud->getCurrentEntry();

        $this->crud->update($user->id, $request->except('password'));

        return redirect()->back()->with('success', 'User updated successfully');
    }
}
