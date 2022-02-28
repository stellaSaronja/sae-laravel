<?php

namespace Tests\Feature;

use App\Models\Posting;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class ExampleTest extends TestCase
{
    /**
     * A basic test example.
     *
     * @return void
     */
    public function test_example()
    {
        $response = $this->get('/');

        $response->assertStatus(200);
    }

    public function test_failure()
    {
        $response = $this->get('/nothingasdada');

        $response->assertStatus(404);
    }

    public function test_create()
    {
        $response = $this->get(route('postings.create'));

        $response->assertRedirect('login');
    }

    public function test_postings()
    {
        $response = $this->get('/postings');

        $response->assertSeeText('postings');
        $response->assertDontSeeText('Error');
    }

    public function test_show_posting()
    {
        $p = Posting::factory()->create();

        $response = $this->get('/postings/' . $p->slug);

        $response->assertSeeText($p->title);

        // $this->assertDatabaseHas('postings', ['id' => $p->id]);
    }
}
