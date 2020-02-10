<?php


namespace App\Http\Controllers\Admin;

use App\Models\Type;
use Backpack\CRUD\app\Http\Controllers\CrudController;
use Illuminate\Support\Facades\Storage;
use Illuminate\Http\Request;

class BlogAdminController extends CrudController
{
    use \Backpack\CRUD\app\Http\Controllers\Operations\ListOperation;
    use \Backpack\CRUD\app\Http\Controllers\Operations\DeleteOperation;
    use \Backpack\CRUD\app\Http\Controllers\Operations\ShowOperation;

    use \Backpack\CRUD\app\Http\Controllers\Operations\CreateOperation {
        store as traitStore;
    }
    use \Backpack\CRUD\app\Http\Controllers\Operations\UpdateOperation {
        update as traitUpdate;
    }

    public function setup()
    {
        $this->crud->setModel("App\Models\Blog");
        $this->crud->setRoute(config('backpack.base.route_prefix') . "/blogs");
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
