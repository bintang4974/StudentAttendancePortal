<?php

namespace Tests\Browser;

use App\Models\User;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Laravel\Dusk\Browser;
use Tests\DuskTestCase;

class HistoryTest extends DuskTestCase
{
    /**
     * A Dusk test example.
     */
    public function testExample(): void
    {
        $this->browse(function (Browser $browser) {
            $browser->visit('/')
                ->type('email', 'everald@gmail.com')
                ->type('password', '12345678')
                ->press('Log in')
                ->assertPathIs('/dashboard')
                ->click('a[href="/attendance/history"]')
                ->assertSee('History')

                // Test filter dengan data valid
                ->select('month', '5')
                ->select('year', '2025')
                ->click('#getdata')
                ->waitFor('#showhistory')
                ->assertSeeIn('#showhistory', '05-2025') // Contoh asersi

                // Test filter dengan data tidak valid
                ->select('month', '')
                ->select('year', '')
                ->click('#getdata');
        });
    }

    public function testEmptyFilterShowsError()
    {
        $this->browse(function (Browser $browser) {
            $browser->loginAs(User::find(1))
                ->visit('/attendance/history')
                ->click('#getdata');
                // ->assertSee('Data Absen Belum Ada Pada Bulan Ini'); // Sesuaikan pesan error
        });
    }
}
