<?php
/**
 * Created by IntelliJ IDEA.
 * User: rmiles
 * Date: 6/26/2018
 * Time: 3:21 PM
 */

declare(strict_types=1);

namespace Tests;

use CarbonPHP\Tables\Carbon_Users as Users;
use CarbonPHP\Database;

/**
 * @runTestsInSeparateProcesses
 */
final class UserTest extends Config
{

    public array $user = [];

    /**
     * Ideally this is run with a fresh build. If not, the relation between create new users
     * must depend on can be deleted. This is cyclic and can not be annotated.
     */
    public function setUp(): void /* The :void return type declaration that should be here would cause a BC issue */
    {
        parent::setUp();

        $_SERVER['REQUEST_TIME'] = time();

        $this->user = [];

        Users::Get($this->user, null, [
            Users::WHERE => [
                Users::USER_USERNAME => Config::ADMIN_USERNAME
            ]
        ]);
    }



    public function testUserCanBeCreated(): string
    {
        if (!empty($this->user)) {
            $this->testUserCanBeDeleted();
        }

        $this->assertInternalType('string', $id = Users::Post([
            Users::USER_TYPE => 'Athlete',
            Users::USER_IP => '127.0.0.1',
            Users::USER_SPORT => 'GOLF',
            Users::USER_EMAIL_CONFIRMED => 1,
            Users::USER_USERNAME => Config::ADMIN_USERNAME,
            Users::USER_PASSWORD => Config::ADMIN_PASSWORD,
            Users::USER_EMAIL => 'richard@miles.systems',
            Users::USER_FIRST_NAME => 'Richard',
            Users::USER_LAST_NAME => 'Miles',
            Users::USER_GENDER => 'Male'
        ]), 'No string ID was returned');

        $this->commit();

        /** @noinspection PhpStrictTypeCheckingInspection */
        return $id;
    }


    /**
     * @depends testUserCanBeCreated
     */
    public function testUserCanBeRetrieved(): void
    {
        $this->user = [];
        $this->assertTrue(
            Users::Get($this->user, null, [
                    Users::WHERE => [
                        Users::USER_USERNAME => Config::ADMIN_USERNAME
                    ],
                    Users::PAGINATION => [
                        Users::LIMIT => 1
                    ]
                ]
            ));

        $this->assertInternalType('array', $this->user);

        $this->assertArrayHasKey(
            Users::COLUMNS[Users::USER_EMAIL],
            $this->user);

    }

    /**
     * @depends testUserCanBeRetrieved
     */
    public function testUserCanBeUpdated(): void
    {
        $this->assertTrue(
            Users::Get($this->user, null, [
                    Users::WHERE => [
                        Users::USER_USERNAME => Config::ADMIN_USERNAME
                    ]
                ]
            ));

        $this->user = $this->user[0];

        $this->assertTrue(
            Users::Put($this->user,
                $this->user[Users::COLUMNS[Users::USER_ID]],
                [
                    Users::USER_FIRST_NAME => 'lil\'Rich'
                ]));

        $this->commit();

        $this->user = [];

        $this->assertTrue(
            Users::Get($this->user, null, [
                    Users::WHERE => [
                        Users::USER_USERNAME => Config::ADMIN_USERNAME
                    ],
                    Users::PAGINATION => [
                        Users::LIMIT => 1
                    ]
                ]
            ));

        $this->assertEquals('lil\'Rich',
            $this->user[Users::COLUMNS[Users::USER_FIRST_NAME]]);
    }


    /**
     * @depends testUserCanBeRetrieved
     */
    public function testUserCanBeDeleted(): void
    {
        $this->user = [];

        Users::Get($this->user, null, [
            Users::WHERE => [
                Users::USER_USERNAME => Config::ADMIN_USERNAME
            ],
            Users::PAGINATION => [
                Users::LIMIT => 1
            ]
        ]);

        $this->assertNotEmpty($this->user,
            'User (' . Config::ADMIN_USERNAME . ') does not appear to exist.');

        $this->assertTrue(
            Users::Delete($this->user,
                $this->user[Users::COLUMNS[Users::USER_ID]], [])
        );

        $this->assertEmpty($this->user);

        $this->user = [];

        Users::Get($this->user, null, [
            Users::WHERE => [
                Users::USER_USERNAME => Config::ADMIN_USERNAME
            ],
            Users::PAGINATION => [
                Users::LIMIT => 1
            ]
        ]);

        $this->assertEmpty($this->user);
    }
}