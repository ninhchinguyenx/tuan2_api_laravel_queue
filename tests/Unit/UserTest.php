<?php

namespace Tests\Unit;

use PHPUnit\Framework\TestCase;
use App\Models\User;
use InvalidArgumentException;

class UserTest extends TestCase
{

    public function testCanGetUserName() {
        $user = new User(["name" => "test3","email" =>"test123@admin.com"]);
        $this->assertEquals("test3", $user->getName());
    }

    public function testCanGetUserEmail() {
        $user = new User(["name" => "test3","email" =>"test123@admin.com"]);
        
        $this->assertEquals("test123@admin.com", $user->getEmail());
    }

    public function testCanSetValidEmail() {
        $user = new User(["name" => "test3","email" =>"test123@admin.com"]);
        $user->setEmail("test123@example.com");
        $this->assertEquals("test123@example.com", $user->getEmail());
    }

    public function testSetEmailThrowsExceptionOnInvalidEmail() {
        $this->expectException(InvalidArgumentException::class);
        
        $user = new User(["name" => "test3","email" =>"test123@admin.com"]);
        $user->setEmail("invalid-email"); // Không đúng định dạng email
    }
}
