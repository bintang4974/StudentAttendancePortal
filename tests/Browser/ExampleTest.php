<?php

namespace Tests\Browser;

use Illuminate\Foundation\Testing\DatabaseMigrations;
use Laravel\Dusk\Browser;
use Tests\DuskTestCase;

class ExampleTest extends DuskTestCase
{
    /**
     * A basic browser test example.
     */
    // public function basicexample(): void
    // {
    //     $this->browse(function (Browser $browser) {
    //         $browser->visit('/')
    //             ->type('email', 'everald@gmail.com')
    //             ->type('password', '12345678')
    //             ->press('Log in')
    //             ->pause(1000)
    //             ->assertPathIs('/dashboard');
    //     });
    // }
    public function testAttendanceFormWithFakeLocationAndImage()
    {
        $this->browse(function (Browser $browser) {
            // Login sebagai user
            $browser->visit('/')
                ->type('email', 'everald@gmail.com')
                ->type('password', '12345678')
                ->press('Log in')
                ->pause(1000)
                ->assertPathIs('/dashboard')
                ->click('a[href="/attendance/create"]') // halaman presensi
                ->assertSee('Presensi')
                ->pause(5000)


                // Set lokasi dan gambar secara manual (simulasi)
                ->script([
                    "document.getElementById('location').value = '-7.2565280548557825,112.7375558738815';",
                    "window.image = 'data:image/jpeg;base64," . base64_encode(file_get_contents(public_path('storage/uploads/absensi/fake-selfie.png'))) . "';"
                ]);

            // // Klik tombol presensi
            $browser->press('#takeattendance')
                ->pause(3000) // tunggu respon ajax
                ->assertDialogOpened('Success!')
                ->acceptDialog();
        });
    }
}
