<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Media;
use App\Role;
use App\User;
use App\Category;
use App\Product;

use Freshbitsweb\Laratables\Laratables;

class DataTablesController extends Controller
{
  /**
   * Return data for medias.
   *
   * @return Json
   */
  public function getDataTablesMediasData() {
    return Laratables::recordsOf(Media::class);
  }

  /**
   * Return data for roles.
   *
   * @return Json
   */
  public function getDataTablesRolesData() {
    return Laratables::recordsOf(Role::class);
  }

  /**
   * Return data for users.
   *
   * @return Json
   */
  public function getDataTablesUsersData() {
    return Laratables::recordsOf(User::class);
  }

  /**
   * Return data for products.
   *
   * @return Json
   */
  public function getDataTablesProductsData() {
    return Laratables::recordsOf(Product::class, function($query) {
      return $query->whereStatus('publish');
    });
  }

  /**
   * Return data for categories.
   *
   * @return Json
   */
  public function getDataTablesProductCategoriesData() {
    return Laratables::recordsOf(Category::class, function($query) {
      return $query->whereType('product');
    });
  }
}
