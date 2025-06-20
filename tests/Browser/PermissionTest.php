<?php

namespace Tests\Browser;

use Illuminate\Foundation\Testing\DatabaseMigrations;
use Laravel\Dusk\Browser;
use Tests\DuskTestCase;

class PermissionTest extends DuskTestCase
{
    /**
     * A Dusk test example.
     */
    public function testExample(): void
    {
        $this->browse(function (Browser $browser) {
            // 1. Login
            $browser->visit('/')
                ->type('email', 'everald@gmail.com')
                ->type('password', '12345678')
                ->press('Log in')
                ->assertPathIs('/dashboard')
                ->screenshot('after-login');

            // 2. Navigasi ke halaman permission
            $browser->click('a[href="/attendance/permission"]') // Sesuaikan dengan route permission
                ->assertSee('Permission')
                ->screenshot('permission-page');

            // 3. Klik tombol tambah permission
            $browser->click('a[href="/attendance/creatpermission"]')
                ->waitForLocation('/attendance/creatpermission')
                ->assertSee('Izin / Sakit')
                ->screenshot('create-permission-page');

            // 4. Isi form permission
            $today = now()->format('Y-m-d');
            $browser->type('date', $today)
                ->select('status', 'i') // i untuk izin
                ->type('description', 'Permohonan izin untuk keperluan keluarga')
                ->screenshot('filled-permission-form');

            // 5. Submit form
            $browser->press('.btn-primary.w-100')
                ->waitForLocation('/attendance/permission')
                ->assertSee('Permohonan izin untuk keperluan keluarga')
                ->screenshot('after-submit-permission');

            // 6. Verifikasi data muncul di list permission
            $browser->assertSee(date('d-m-Y', strtotime($today)))
                ->assertSee('Izin')
                ->assertSee('Waiting')
                ->screenshot('permission-list');
        });
    }
}
