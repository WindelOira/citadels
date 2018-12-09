<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\Blade;

use Form;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
      Schema::defaultStringLength(191);

      Blade::component('components.partials.page-header', 'page_header');
      Blade::component('admin.components.uploader', 'uploader');

      Form::component('bsText', 'components.forms.text', ['name', 'value' => NULL, 'attr' => []]);
      Form::component('bsEmail', 'components.forms.email', ['name', 'value' => NULL, 'attr' => []]);
      Form::component('bsPassword', 'components.forms.password', ['name', 'attr' => []]);
      Form::component('bsTextarea', 'components.forms.textarea', ['name', 'value' => NULL, 'attr' => []]);
      Form::component('bsEditor', 'components.forms.editor', ['name', 'value' => NULL]);
      Form::component('bsSelect', 'components.forms.select', ['name', 'options' => [], 'default' => NULL, 'attr' => []]);
      Form::component('bsFile', 'components.forms.file', ['name', 'attr' => []]);
      Form::component('bsButton', 'components.forms.button', ['name', 'value' => NULL, 'type' => 'button', 'attr' => []]);
    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }
}
