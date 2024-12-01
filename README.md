## Table of contents
* [General info](#general-info)
* [Technologies](#technologies)
* [Status](#status)
* [Installation](#installation)

## General info
Assignment test solution
## Technologies
* Laravel 11
* sqlite db

## Status
The project is: completed

## Installation
* clone the project
* cd inside the project
* run cp .env.example .env
* run php artisan key:generate
* run composer install
* create primary database and module databases
* run php artisan migrate:fresh --seed to migrate and seed shared data
* run php artisan module-migrate Modulename to migrate module
