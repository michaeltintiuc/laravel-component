# laravel-component
:bulb: Several starter interfaces and abstract classes for laravel projects

## Contents
1. [Installation](#installation)
2. [Usage](#usage)
  1. [Directory Structure](#directory-structure)
  2. [Controllers](#controllers)

## Installation

Require via composer
```shell
composer require michaeltintiuc/laravel-component
``````

## Usage

### Directory structure
_TODO_

### Controllers
```php
<?php
namespace Acme\Components\Users\Admin;

use Illuminate\Http\Request;
use MichaelT\Component\Admin\ComponentController;

class UsersController extends ComponentController
{
    public function __construct(Request $request, PostTagsRepo $repo)
    {
        parent::__construct($request, $repo);
        $this->setComponent('user');
        $this->setBaseView('admin.users');
        $this->setSearchRoute('admin.users.index');
    }

    public function index(Request $request)
    {
        if ($request->has('search')) {
            return $this->search($request->search);
        }

        $this->setTitle('All users');
        $this->setHeading('Users list');
        $users = $this->repo->all();

        return $this->view('index')
            ->with(compact('users'));
    }
}
```
