<?php

namespace Tests\Browser;

use Illuminate\Foundation\Testing\DatabaseMigrations;
use Laravel\Dusk\Browser;
use Tests\DuskTestCase;

class PembayaranTest extends DuskTestCase
{
    /**
     * A Dusk test example.
     *
     * @return void
     */
    public function testReservationForm()
    {
        $this->browse(function (Browser $browser) {
            // Visit the reservation page
            $browser->visit('/bukti_pembayaran'); // Ensure page loaded successfully

            // Fill and submit the form for payment method "Bayar"
            $browser->attach('bukti_pembayaran', storage_path('app/public/test_images/bukti_pembayaran.jpg'))
            ->select('bpjs', '0')
                ->press('Submit')
                ->assertSee('Success Message'); // Ensure reservation is successful

            // Alternatively, you can test submission for BPJS payment method as well
            // Fill and submit the form for payment method "BPJS"
            $browser->select('bpjs', '1')
                ->attach('ktp', storage_path('app/public/test_images/ktp.jpg'))
                ->attach('surat_rujukan', storage_path('app/public/test_images/surat_rujukan.jpg'))
                ->attach('bpjs_card', storage_path('app/public/test_images/bpjs_card.jpg'))
                ->press('Submit')
                ->assertSee('Success Message'); // Ensure reservation is successful
        });
    }
}
