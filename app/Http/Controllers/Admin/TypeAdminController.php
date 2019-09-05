<?php


namespace App\Http\Controllers\Admin;


use Backpack\CRUD\app\Http\Controllers\CrudController;
use Illuminate\Support\Facades\Storage;
use Backpack\CRUD\CrudTrait;
use Illuminate\Http\Request;

class TypeAdminController extends CrudController {
  use CrudTrait;

  public function setup() {
    $this->crud->setModel("App\Models\Type");
    $this->crud->setRoute(config('backpack.base.route_prefix') . "/type");
    $this->crud->setEntityNameStrings('Type', 'Types');


    $this->crud->addColumn([
      'name' => 'id',
      'label' => 'ID'
    ]);

    $this->crud->addColumn([
      'name' => 'img_url',
      'label' => 'Logo',
      'type' => 'image',
      'disk' => 'public',
      'prefix' => '/type/'
    ]);

    $this->crud->addColumn([
      'name' => 'name',
      'labele' => 'Name'
    ]);

	  $this->crud->addColumn([
		  'name' => 'lang',
		  'labele' => 'Lang'
	  ]);


    $this->crud->addField([
      'name' => 'name',
      'type' => 'text',
      'label' => "Type Name"
    ]);
    $this->crud->addField([
      'name' => 'img_url',
      'label' => 'Image',
      'type' => 'image',
      'upload' => true,
      'disk' => 'public',
      'prefix' => '/type/'
    ]);

	  $this->crud->addField([
		  'name' => 'lang',
		  'type' => 'text',
		  'label' => "Language"
	  ]);

  }

  public function store(Request $request)
  {
    $fields = array_keys(request()->all());

    foreach ($fields as $field) {
      if ($field === 'img_url')
        $request[$field] = $this->newImage($request, $field, 'extras');
    }
    return parent::storeCrud($request);
  }

  public function update(Request $request)
  {

    $fields = array_keys(request()->all());
    foreach ($fields as $field) {
      if (\Str::endsWith($field, 'img_url'))
        $request[$field] = $this->processImage($request, $field, 'extras');
    }
    return parent::updateCrud($request);
  }

  /**
   * Stores the actual image to disk and returns the stored filename. Deletes previous file from disk, if any.
   *
   * @param $request
   * @param $attribute_name
   * @param null $store_in If not null, image is stored in a fake field
   * @return null|string
   */
  private function newImage($request, $attribute_name, $store_in = null)
  {
    $value = $request[$attribute_name];
    $type = 'pages';
    $destination_path = 'type';

    // if a new image was loaded
    if (\Str::startsWith($value, 'data:image')) {

      $image = \Image::make($value);
      switch ($image->mime()) {
        case 'image/png':
          $extension = '.png';
          break;
        default:
          $extension = '.jpg';
      }
      $filename = $type . '_' . $attribute_name . '_' . md5($value.time()) . $extension;
      Storage::disk('public')->put($destination_path . '/' . $filename, (string)$image->stream());
      $value = $filename;
    }

    return basename($value);
  }
  private function processImage($request, $attribute_name, $store_in = null)
  {
    $value = $request[$attribute_name];
    $prev_value = $this->crud->getCurrentEntry()->{$attribute_name};
    $type = 'pages';

    $destination_path = 'type';

    // if the image was erased
    if ($value == null) {
      $this->deleteImage($prev_value);
      $value = null;
    }

    // if a new image was loaded
    if (\Str::startsWith($value, 'data:image')) {
      $this->deleteImage($prev_value);
      $image = \Image::make($value);
      switch ($image->mime()) {
        case 'image/png':
          $extension = '.png';
          break;
        default:
          $extension = '.jpg';
      }
      $filename = $type . '_' . $attribute_name . '_' . md5($value.time()) . $extension;
      Storage::disk('public')->put($destination_path . '/' . $filename, (string)$image->stream());
      $value = $filename;
    }

    return basename($value);
  }

  private function deleteImage($value)
  {
    $type = 'type';
    if (!empty($value)) {
      $file = basename($value);
      $file_path = $type . '/' . $file;

      Storage::disk('public')->delete($file_path);
    }
  }

}
