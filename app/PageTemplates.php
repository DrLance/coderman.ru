<?php

namespace App;

trait PageTemplates
{
    /*
    |--------------------------------------------------------------------------
    | Page Templates for Backpack\PageManager
    |--------------------------------------------------------------------------
    |
    | Each page template has its own method, that define what fields should show up using the Backpack\CRUD API.
    | Use snake_case for naming and PageManager will make sure it looks pretty in the create/update form
    | template dropdown.
    |
    | Any fields defined here will show up after the standard page fields:
    | - select template
    | - page name (only seen by admins)
    | - page title
    | - page slug
    */

    private function services()
    {
        $this->crud->addField([   // CustomHTML
          'name'  => 'metas_separator',
          'type'  => 'custom_html',
          'value' => '<br><h2>' . trans('backpack::pagemanager.metas') . '</h2><hr>',
        ]);
        $this->crud->addField([
          'name'     => 'meta_title',
          'label'    => trans('backpack::pagemanager.meta_title'),
          'fake'     => true,
          'store_in' => 'extras',
        ]);
        $this->crud->addField([
          'name'     => 'meta_description',
          'label'    => trans('backpack::pagemanager.meta_description'),
          'fake'     => true,
          'store_in' => 'extras',
        ]);
        $this->crud->addField([
          'name'     => 'meta_keywords',
          'type'     => 'textarea',
          'label'    => trans('backpack::pagemanager.meta_keywords'),
          'fake'     => true,
          'store_in' => 'extras',
        ]);
        $this->crud->addField([   // CustomHTML
          'name'  => 'content_separator',
          'type'  => 'custom_html',
          'value' => '<br><h2>' . trans('backpack::pagemanager.content') . '</h2><hr>',
        ]);
        $this->crud->addField([
          'name'        => 'content',
          'label'       => trans('backpack::pagemanager.content'),
          'type'        => 'wysiwyg',
          'placeholder' => trans('backpack::pagemanager.content_placeholder'),
          'options'     => [
            'extraPlugins' => 'autogrow, panelbutton, preview, image2, font, ajax, about,balloonpanel,codesnippet,
            panelbutton,uploadfile,placeholder
            ',
              'autoGrow_onStartup' => true,
              'codeSnippet_theme' => 'github',
              'toolbarLocation' => 'bottom'
          ],
        ]);
    }

    private function about_us()
    {
        $this->crud->addField([
          'name'        => 'content',
          'label'       => trans('backpack::pagemanager.content'),
          'type'        => 'wysiwyg',
          'options'     => [
            'extraPlugins' => 'autogrow',
            'autoGrow_onStartup' => true

          ],
          'placeholder' => trans('backpack::pagemanager.content_placeholder'),
        ]);
    }

    private function articles()
    {
        $this->crud->addField([   // CustomHTML
          'name'  => 'metas_separator',
          'type'  => 'custom_html',
          'value' => '<br><h2>' . trans('backpack::pagemanager.metas') . '</h2><hr>',
        ]);
        $this->crud->addField([
          'name'     => 'meta_title',
          'label'    => trans('backpack::pagemanager.meta_title'),
          'fake'     => true,
          'store_in' => 'extras',
        ]);
        $this->crud->addField([
          'name'     => 'meta_description',
          'label'    => trans('backpack::pagemanager.meta_description'),
          'fake'     => true,
          'store_in' => 'extras',
        ]);
        $this->crud->addField([
          'name'     => 'meta_keywords',
          'type'     => 'textarea',
          'label'    => trans('backpack::pagemanager.meta_keywords'),
          'fake'     => true,
          'store_in' => 'extras',
        ]);
        $this->crud->addField(
          [   // select_from_array
            'name'        => 'type',
            'label'       => "Type",
            'type'        => 'select_from_array',
            'options'     => ['news' => 'News', 'articles' => 'Articles'],
            'allows_null' => true,
          ]
        );
        $this->crud->addField(
          [   // select_from_array
            'name'  => 'excerpt',
            'label' => "excerpt",
            'type'  => 'textarea',
          ]
        );
        $this->crud->addField([   // CustomHTML
          'name'  => 'content_separator',
          'type'  => 'custom_html',
          'value' => '<br><h2>' . trans('backpack::pagemanager.content') . '</h2><hr>',
        ]);

        $this->crud->addField([
          'name'        => 'content',
          'label'       => trans('backpack::pagemanager.content'),
          'type'        => 'tinymce',
          'placeholder' => trans('backpack::pagemanager.content_placeholder'),
          'options'     => [
            'toolbar_sticky' => true,
            'file_picker_callback' => "elFinderBrowser",
            'fontsize_formats' => '6px 7px 8px 9px 10px 11px 12px 13px 14px 16px 17px 18px 24px 36px 48px',
            'toolbar' => 'insertfile undo redo | styleselect | bold italic | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | link image | print preview media fullpage | forecolor backcolor emoticons',
            'plugins' => 'advlist,autolink,link,image,imagetools,lists,charmap,print,preview,hr,anchor,pagebreak,spellchecker,
            searchreplace,wordcount,visualblocks,visualchars,code,fullscreen,insertdatetime,media,nonbreaking,table,
            emoticons,template,paste,help,autoresize,legacyoutput',
          ],
        ]);
    }
}
