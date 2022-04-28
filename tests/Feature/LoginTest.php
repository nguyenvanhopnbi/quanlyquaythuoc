<?php

namespace Tests\Feature;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Http\Client\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Str;
use Tests\TestCase;

class LoginTest extends TestCase
{
    use RefreshDatabase;

    public function test_is_redirected_if_already_logged_in()
    {
        $this->actingAs(User::factory()->create())
            ->get(route('login'))
            ->assertRedirect('/');
    }

    public function test_can_redirect_to_provider()
    {
        Http::fake();

        $this->get(route('login'));

        Http::assertSent(function (Request $request) {
            return Str::of($request->url())->is(env('URL_AUTHENICATION_SERVICE') . '*');
        });
    }
}
