<?php

namespace Tests\Browser;

use Illuminate\Foundation\Testing\DatabaseMigrations;
use Laravel\Dusk\Browser;
use Tests\DuskTestCase;

class StudentTest extends DuskTestCase
{
    // public function testAddStudentThroughAdminPanel()
    // {
    //     $this->browse(function (Browser $browser) {
    //         // 1. Login sebagai admin
    //         $browser->visit('/panel')
    //             ->type('email', 'bintank@gmail.com') // Email admin
    //             ->type('password', '12345678') // Password admin
    //             ->press('Sign in')
    //             ->waitForLocation('/panel/dashboardadmin')
    //             ->assertPathIs('/panel/dashboardadmin')
    //             ->screenshot('admin-dashboard');

    //         // 2. Buka dropdown Data Master
    //         $browser->click('li.nav-item:has(.nav-link:contains("Data Master"))')
    //             ->pause(500) // Tunggu animasi dropdown
    //             ->screenshot('dropdown-data-master');

    //         // 3. Pilih menu Student dari dropdown
    //         $browser->visit('/student')
    //             ->assertSee('Data Mahasiswa')
    //             ->screenshot('student-list-page');

    //         // 4. Klik tombol tambah mahasiswa
    //         $browser->click('#btnInputstudent')
    //             ->waitFor('#modal-inputstudent')
    //             ->assertSee('Tambah Mahasiswa')
    //             ->screenshot('add-student-modal');

    //         // 5. Isi form tambah mahasiswa
    //         $browser->within('#frmStudent', function (Browser $form) {
    //             $form->type('input[name="name"]', 'John Doe')
    //                 ->type('input[name="activity_id"]', 'ACT123')
    //                 ->type('input[name="nim"]', '123456789')
    //                 ->type('input[name="email"]', 'john.doe@example.com')
    //                 ->type('input[name="phone"]', '08123456789')
    //                 ->type('input[name="university"]', 'Universitas Test')
    //                 ->select('select[name="gender"]', 'Laki-laki')
    //                 ->type('textarea[name="placement"]', 'Jl. Test No. 123')
    //                 ->attach('input[name="photo"]', __DIR__ . '/test-photo.jpg')
    //                 ->select('select[name="department_id"]', '1')
    //                 ->select('select[name="position_id"]', '1')
    //                 ->select('select[name="mentor_id"]', '1')
    //                 ->screenshot('filled-student-form');
    //         });

    //         // 6. Submit form
    //         $browser->press('button[type="submit"]:contains("Save changes")')
    //             ->waitForText('Data berhasil disimpan')
    //             ->assertSee('Data berhasil disimpan')
    //             ->screenshot('after-submit-student');

    //         // 7. Verifikasi data muncul di tabel
    //         $browser->assertSee('John Doe')
    //             ->assertSee('123456789')
    //             ->screenshot('student-added-to-list');
    //     });
    // }

    public function testAdminNavigationToStudentPage()
    {
        $this->browse(function (Browser $browser) {
            // 1. Login sebagai admin
            $browser->visit('/panel')
                ->type('email', 'bintank@gmail.com')
                ->type('password', '12345678')
                ->press('Sign in')
                ->waitForLocation('/panel/dashboardadmin')
                ->assertPathIs('/panel/dashboardadmin')
                ->screenshot('admin-dashboard');

            // 2. Buka dropdown Data Master
            $browser->click('.nav-item:has(.nav-link:contains("Data Master"))')
                ->pause(500) // Tunggu animasi dropdown
                ->assertVisible('.dropdown-menu')
                ->screenshot('data-master-dropdown');

            // 3. Klik menu Data Mahasiswa dalam dropdown
            $browser->click('.dropdown-item:contains("Data Mahasiswa")')
                ->waitForLocation('/student')
                ->assertSee('Data Mahasiswa')
                ->assertVisible('#btnInputstudent')
                ->screenshot('student-list-page');

            // 4. Klik tombol Tambah
            $browser->click('#btnInputstudent')
                ->waitFor('#modal-inputstudent')
                ->within('#modal-inputstudent', function (Browser $modal) {
                    $modal->assertSee('Tambah Mahasiswa')
                        ->screenshot('add-student-modal');

                    // 5. Isi form dengan data minimal
                    $modal->type('input[name="name"]', 'John Doe')
                        ->type('input[name="nim"]', '123456789')
                        ->select('select[name="department_id"]', '1')
                        ->press('button[type="submit"]')
                        ->waitForText('Data berhasil disimpan');
                });

            // 6. Verifikasi data di tabel
            $browser->assertSee('John Doe')
                ->assertSee('123456789')
                ->screenshot('student-added-success');
        });
    }
}
