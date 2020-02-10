<?php


namespace App\Http\Controllers\Admin;

use Backpack\CRUD\app\Http\Controllers\CrudController;
use Backpack\CRUD\app\Http\Controllers\Operations;

class PostAdminController extends CrudController
{
    use Operations\ListOperation;
    use Operations\DeleteOperation;
    use Operations\ShowOperation;

    use Operations\CreateOperation {
        store as traitStore;
    }
    use Operations\UpdateOperation {
        update as traitUpdate;
    }

    public function setup()
    {
        $this->crud->setModel("App\Models\Post");
        $this->crud->setRoute(config('backpack.base.route_prefix') . "/posts");
        $this->crud->setEntityNameStrings('Blog', 'Blogs');
        $this->crud->orderBy('id');

    }

    protected function setupListOperation()
    {

        $this->crud->addColumn([
          'name'  => 'id',
          'label' => 'ID',
        ]);

    }


    protected function setupCreateOperation()
    {
    }

}
