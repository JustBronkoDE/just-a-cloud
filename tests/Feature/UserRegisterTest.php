<?php

namespace Tests\Feature;

use App\File;
use App\User;
use Tests\TestCase;
use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class UserRegisterTest extends TestCase
{
    /**
     * Creates Users with Files
     *
     * @return void
     */
    public function testCreateUsersWithFiles()
    {

		$user = factory(User::class,50)->create();
		$files = factory(File::class, 150)->create();
    }
}
