<?php

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\WithoutMiddleware;

uses(RefreshDatabase::class, WithFaker::class, WithoutMiddleware::class);

beforeEach(function () {
    // Load the application
    $this->app = require __DIR__.'/../bootstrap/app.php';
});