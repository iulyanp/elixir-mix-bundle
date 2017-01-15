ElixirMixBundle
===================

ElixirMixBundle is a Symfony bundle that integrates [Laravel Mix](https://github.com/JeffreyWay/laravel-mix). 
The purpose of the bundle is to offer the `mix()` twig function. This is exactly the same `mix()` function from Laravel 
blade template system.

### Requirements

Before you start installing this bundle you first have to ensure that Node.js and NPM are installed on your machine. 

## Installation

### Step 1: Require the bundle with composer

Open your terminal and run one of the following commands to download the bundle into your vendor directory.

If you have composer installed globally you can run:
```
$ composer require iulyanp/elixir-mix-bundle
```
Else you can go with:
```
$ php composer.phar require iulyanp/elixir-mix-bundle
```

### Step 2: Register the bundle in your AppKernel class

Register the bundle in the app/AppKernel.php file of your project:

```
<?php
/** app/AppKernel.php */

class AppKernel extends Kernel
{
    public function registerBundles()
    {
        $bundles = array(

            new Iulyanp\ElixirMixBundle\IulyanpElixirMixBundle(),
        );
    }
}
```

### Step 3: Initialize larave-mix package
If you already have installed `Node.js`, `npm` you should be all set to run:

```
$ php bin/console mix:init
```

A base `package.json` and `webpack.mix.js` file will be generated into your project root directory.

Then run `npm install` to install all the dependencies and [laravel-mix](https://github.com/JeffreyWay/laravel-mix).

### Usage
Now you can use mix() function to version a file like this:
```
<link rel="stylesheet" type="text/css" href="{{ mix('css/app.css') }}" />
```

### License
The ElixirMixBundle is open-sourced software licensed under the [MIT license](https://opensource.org/licenses/MIT).
