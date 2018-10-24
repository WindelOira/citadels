<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Role;
use App\User;

use Freshbitsweb\Laratables\Laratables;

class DataTablesController extends Controller
{
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
}