<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;
use App\Invoice;

/**
 * Class InvoiceTest
 * @package Tests\Feature
 */
class InvoiceTest extends TestCase
{
    use RefreshDatabase;

    /**
     * Tests that given an appropriate payload, invoices are created correctly.
     */
    public function testsInvoicesAreCreatedCorrectly()
    {
        $payload = [
            'address_line_1' => 'address_line_1',
            'address_line_2' => 'address_line_2',
            'address_line_3' => 'address_line_3',
            'address_line_4' => 'address_line_4',
            'postcode' => 'postcode',
        ];

        $this->json('POST', '/api/invoice', $payload)
            ->assertStatus(200)
            ->assertJson([
                'id' => 1,
                'address_line_1' => 'address_line_1',
                'address_line_2' => 'address_line_2',
                'address_line_3' => 'address_line_3',
                'address_line_4' => 'address_line_4',
                'postcode' => 'postcode'
            ]);
    }


    /**
     * Tests that multiple invoices can be fetched
     */
    public function testsInvoicesAreFetchedCorrectly()
    {
        factory(Invoice::class)->create([
            'address_line_1' => 'address line_1',
            'address_line_2' => 'address line_2',
            'address_line_3' => 'address line_3',
            'address_line_4' => 'address line_4',
            'postcode' => 'postcode',
        ]);

        factory(Invoice::class)->create([
            'address_line_1' => 'address_line 1',
            'address_line_2' => 'address_line 2',
            'address_line_3' => 'address_line 3',
            'address_line_4' => 'address_line 4',
            'postcode' => 'postcode 2',
        ]);

        $this->json('GET', '/api/invoice')
            ->assertStatus(200)
            ->assertJson([
                [
                    'address_line_1' => 'address line_1',
                    'address_line_2' => 'address line_2',
                    'address_line_3' => 'address line_3',
                    'address_line_4' => 'address line_4',
                    'postcode' => 'postcode',
                ],
                [
                    'address_line_1' => 'address_line 1',
                    'address_line_2' => 'address_line 2',
                    'address_line_3' => 'address_line 3',
                    'address_line_4' => 'address_line 4',
                    'postcode' => 'postcode 2',
                ]
            ])
            ->assertJsonStructure([
                '*' => ['id', 'address_line_1', 'address_line_2', 'address_line_3', 'address_line_4', 'created_at', 'updated_at'],
            ]);
    }


    /**
     * Tests that a singular invoice can be fetched via Id
     */
    public function testsSingleInvoiceIsFetchedCorrectly()
    {
        factory(Invoice::class)->create([
            'address_line_1' => 'address line_1',
            'address_line_2' => 'address line_2',
            'address_line_3' => 'address line_3',
            'address_line_4' => 'address line_4',
            'postcode' => 'postcode',
        ]);

        factory(Invoice::class)->create([
            'address_line_1' => 'address_line 1',
            'address_line_2' => 'address_line 2',
            'address_line_3' => 'address_line 3',
            'address_line_4' => 'address_line 4',
            'postcode' => 'postcode 2',
        ]);

        factory(Invoice::class)->create([
            'address_line_1' => 'address line 1',
            'address_line_2' => 'address line 2',
            'address_line_3' => 'address line 3',
            'address_line_4' => 'address line 4',
            'postcode' => 'postcode 3',
        ]);

        $this->json('GET', '/api/invoice/1/')
            ->assertStatus(200)
            ->assertJson([
                'address_line_1' => 'address line_1',
                'address_line_2' => 'address line_2',
                'address_line_3' => 'address line_3',
                'address_line_4' => 'address line_4',
                'postcode' => 'postcode',
            ])
            ->assertJsonStructure([
                'id', 'address_line_1', 'address_line_2', 'address_line_3', 'address_line_4', 'created_at', 'updated_at',
            ]);
    }
}
