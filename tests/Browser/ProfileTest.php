<?php

namespace Tests\Browser;

use Illuminate\Foundation\Testing\DatabaseMigrations;
use Laravel\Dusk\Browser;
use Tests\DuskTestCase;

class ProfileTest extends DuskTestCase
{
    public function testEditProfile()
    {
        $this->browse(function (Browser $browser) {
            // 1. Login
            $browser->visit('/')
                ->type('email', 'everald@gmail.com')
                ->type('password', '12345678')
                ->press('Log in')
                ->pause(1000)
                ->assertPathIs('/dashboard')
                ->screenshot('after-login');

            // 2. Navigasi ke halaman profile (asumsi ada menu/navigasi ke profile)
            $browser->click('a[href*="profile"]') // Sesuaikan dengan selector menu profile
                ->pause(1000)
                ->assertSee('Profile')
                ->screenshot('profile-page');

            // 3. Isi form edit profile
            $browser->within('form[action*="updateprofile"]', function (Browser $form) {
                $form->type('input[name="name"]', 'Everald Updated')
                    ->type('input[name="email"]', 'everald.updated@gmail.com')
                    ->type('input[name="phone"]', '08164867330')
                    ->type('input[name="password"]', 'newpassword123')
                    ->screenshot('filled-profile-form');
            });

            // 5. Submit form
            $browser->press('button[type="submit"]')
                ->waitForText('Success Update!', 10)
                ->assertSee('Success Update!')
                ->screenshot('after-profile-update');

        });
    }
}
