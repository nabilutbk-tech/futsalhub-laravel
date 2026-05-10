<?php

namespace Tests\Unit;

use App\Models\User;
use PHPUnit\Framework\TestCase;

class UserRoleTest extends TestCase
{
    public function test_user_is_admin()
    {
        $user = new User();
        $user->role = 'admin';

        $this->assertTrue($user->role === 'admin');
        $this->assertFalse($user->role === 'user');
    }
}