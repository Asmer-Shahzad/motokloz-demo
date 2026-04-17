<?php

namespace Tests\Feature;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class ChatControllerStartOrGetTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function it_stores_motokloz_source_in_session_and_redirects(): void
    {
        $buyer = User::factory()->create();

        $response = $this->actingAs($buyer)
            ->post(route('chat.start'), [
                'inventory_id' => 10,
                'dealer_id'    => 20,
                'source'       => 'motokloz',
            ]);

        $response->assertRedirect(route('chat.show', [$buyer->id, 20, 10]));

        $this->assertEquals(
            'motokloz',
            session("chat_source_{$buyer->id}_20_10")
        );
    }

    /** @test */
    public function it_stores_diskloz_source_in_session_and_redirects(): void
    {
        $buyer = User::factory()->create();

        $response = $this->actingAs($buyer)
            ->post(route('chat.start'), [
                'inventory_id' => 55,
                'dealer_id'    => 77,
                'source'       => 'diskloz',
            ]);

        $response->assertRedirect(route('chat.show', [$buyer->id, 77, 55]));

        $this->assertEquals(
            'diskloz',
            session("chat_source_{$buyer->id}_77_55")
        );
    }

    /** @test */
    public function it_defaults_source_to_motokloz_when_not_provided(): void
    {
        $buyer = User::factory()->create();

        $this->actingAs($buyer)
            ->post(route('chat.start'), [
                'inventory_id' => 1,
                'dealer_id'    => 2,
            ]);

        $this->assertEquals(
            'motokloz',
            session("chat_source_{$buyer->id}_2_1")
        );
    }

    /** @test */
    public function same_params_twice_returns_same_redirect_url_idempotency(): void
    {
        $buyer = User::factory()->create();

        $params = [
            'inventory_id' => 30,
            'dealer_id'    => 40,
            'source'       => 'motokloz',
        ];

        $first  = $this->actingAs($buyer)->post(route('chat.start'), $params);
        $second = $this->actingAs($buyer)->post(route('chat.start'), $params);

        $expectedUrl = route('chat.show', [$buyer->id, 40, 30]);

        $first->assertRedirect($expectedUrl);
        $second->assertRedirect($expectedUrl);
    }

    /** @test */
    public function it_rejects_invalid_source_value(): void
    {
        $buyer = User::factory()->create();

        $response = $this->actingAs($buyer)
            ->post(route('chat.start'), [
                'inventory_id' => 1,
                'dealer_id'    => 2,
                'source'       => 'invalid_platform',
            ]);

        $response->assertSessionHasErrors('source');
    }

    /** @test */
    public function unauthenticated_user_is_redirected_to_login(): void
    {
        $response = $this->post(route('chat.start'), [
            'inventory_id' => 1,
            'dealer_id'    => 2,
            'source'       => 'motokloz',
        ]);

        $response->assertRedirect(route('login'));
    }
}
