# laravel-component
:bulb: Several starter interfaces and abstract classes for laravel projects

## Contents
1. [Installation](#installation)
2. [Usage](#usage)
  1. [Directory Structure](#directory-structure)
  2. [Controllers](#controllers)
  3. [Repositories](#repositories)

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
    
    ...
}
```

### Repositories
#### Interfaces _aka_ Contracts
```php
<?php
namespace Acme\Components\Users\Admin;

use MichaelT\Component\Admin\Contracts\RepoContract;
use MichaelT\Component\Admin\Contracts\SearchableContract;

interface UsersRepoContract extends RepoContract, SearchableContract
{
}
```

#### Repository
```php
<?php
namespace Acme\Components\Users\Admin;

use Acme\Components\Users\User;
use MichaelT\Component\Admin\ComponentRepo;
use Acme\Components\Users\Admin\UsersRepoContract;

class UsersRepo extends ComponentRepo implements UsersRepoContract
{
    public function __construct(User $model)
    {
        parent::__construct($model);
        $this->setComponent('user');
    }

    public function all()
    {
        return $this->model->get();
    }

    public function paginate()
    {
        return $this->model
            ->paginate($this->getPerPage());
    }

    public function find($id)
    {
        try {
            return $this->model->findOrFail($id);
        } catch (\Exception $e) {
            throw new \FindAdminException($this->error('find'));
        }
    }
    
    ...
}
```
