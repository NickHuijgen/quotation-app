<?php

namespace Tests\Feature;

use App\Models\Quotation;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Support\Facades\Artisan;
use Tests\TestCase;
use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class QuotationTest extends TestCase
{
//    use DatabaseMigrations;
use RefreshDatabase;
    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function setUp(): void
    {
        parent::setUp(); // TODO: Change the autogenerated stub

        //Create a fresh migration, a quotation and a user before each test
        $this->artisan('migrate:fresh');

        User::factory()->create();
        Quotation::factory()->create();
    }

    public function test_index_quotations()
    {
        //Create 3 new quotations
        $quotation = Quotation::factory(3)->create();

        //Create a get request to the index function
        $response = $this->get('/api/quotations');

        //Check if the created quotation is displayed and assert there are no errors
        $response->assertJsonCount(4)
            ->assertStatus(200);
    }

    public function test_show_quotation()
    {
        //Create a new quotation
        $quotation = Quotation::factory()->create();

        //Create a get request to the show function with the newly created quotation's id
        $response = $this->get('/api/quotations/' . $quotation->id);

        //Check if the attributes of the created quotation are displayed and assert there are no errors
        $response->assertSee($quotation->customer_first_name)
            ->assertSee($quotation->id)
            ->assertJsonCount(1)
            ->assertStatus(200);
    }

    public function test_make_quotation()
    {
        //Create a new quotation
        $response = $this->post('/api/quotations/', [
            'user_id' => 1,
            'customer_first_name' => 'John',
            'customer_last_name' => 'Doe',
            'customer_email' => 'test@example.com',
            'customer_city' => 'Utrecht',
            'customer_street' => 'Street',
            'customer_postal_code' => '1234AA',
            'customer_house_number' => 10,
            'status' => 'In progress',
        ]);

        //Check if the quotation was made with the correct attributes
        $response->assertSee('John')
                 ->assertSee('test@example.com')
                 ->assertStatus(201);
    }

    public function test_update_quotation ()
    {
        //Create a new quotation
        $quotation = Quotation::factory()->create();

        //Try to change the customers first name to 'John'
        $response = $this->putJson('api/quotations/' . $quotation->id, [
            'customer_first_name' => 'John'
        ]);

        //Check if the first name was changed to 'John'
        $response->assertSee('John')
            ->assertStatus(200);
    }

    public function test_delete_quotation ()
    {
        //Create a new quotation
        $quotation = Quotation::factory()->create();

        //Attempt to delete the quotation and check for errors
        $this->delete('/api/quotations/' . $quotation->id)
            ->assertStatus(200);

        //Check if the quotation can still be displayed
        $response = $this->get('/api/quotations/' . $quotation->id);
        $response->assertStatus(404);
    }

    public static function tearDownAfterClass(): void
    {
//        parent::tearDownAfterClass();
//        Artisan::call('migrate:fresh');
        parent::tearDownAfterClass();

    }
}
