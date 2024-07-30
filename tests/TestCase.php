<?php

namespace Tests;

use Illuminate\Foundation\Testing\TestCase as BaseTestCase;
use Tests\Traits\AdditionalAssertions;

abstract class TestCase extends BaseTestCase
{
    //
    use AdditionalAssertions;
}
