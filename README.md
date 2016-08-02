# SUI-TABLE
Semantic-UI table builder for Laravel.

## Version Compatibility

 Laravel  | Suitable
:---------|:----------
 5.2.x    | 1.x
 5.3.x    | 2.x

## Installation

### Install Package

``` bash
$ composer require laravolt/suitable
```

### Service Provider

    Laravolt\Suitable\ServiceProvider::class,

### Facade

    'Suitable'  => Laravolt\Suitable\Facade::class,

## Usage

``` php
{!! Suitable::source(User::all())
->id('table1')
->title('Users')
->columns([
    new \Laravolt\Suitable\Components\Checkall(),
    ['header' => 'Nama', 'field' => 'name'],
    ['header' => 'Email', 'field' => 'email'],
])
->render() !!}
```
