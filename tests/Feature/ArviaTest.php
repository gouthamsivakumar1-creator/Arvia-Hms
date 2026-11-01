<?php

namespace Tests\Feature;

use App\Models\SmsFormat;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;
use Tests\TestCase;

class ArviaTest extends TestCase
{
    use RefreshDatabase;

    public function test_login_shows_arvia_and_keeps_the_upstream_credit(): void
    {
        $this->get('/')
            ->assertOk()
            ->assertSee('Arvia Biotech Pvt Ltd')
            ->assertSee('arvia-logo.svg', false)
            ->assertSee('Based on')
            ->assertSee('GPL-3.0')
            ->assertDontSee('icthospital-logo', false);
    }

    public function test_patient_identifier_is_abha_not_cnic(): void
    {
        $this->assertTrue(Schema::hasColumn('patient', 'abha_number'));
        $this->assertFalse(Schema::hasColumn('patient', 'cnic'));
    }

    public function test_blank_messaging_url_is_refused_and_never_defaults_to_the_vendor(): void
    {
        $this->actingAs(User::create([
            'firstname' => 'Admin', 'lastname' => 'User', 'email' => 'admin@arvia.test', 'login' => 'admin',
            'desc' => '', 'group' => 'Admin', 'password' => bcrypt('x'),
        ]));

        $this->post('/ictcore', [
            'type' => 'sms', 'ictcore_url' => '', 'ictcore_user' => 'u', 'ictcore_password' => 'p', 'ictcore_account_id' => '1',
        ]);

        $this->assertSame(0, DB::table('ictcore_integration')->where('ictcore_url', 'like', '%ict.vision%')->count());
        $this->assertSame(0, DB::table('ictcore_integration')->count());
    }

    public function test_default_timezone_is_india(): void
    {
        $this->assertStringContainsString('APP_TIMEZONE=Asia/Kolkata', file_get_contents(base_path('.env.example')));
    }

    public function test_sms_format_model_uses_its_own_table(): void
    {
        $this->assertSame('smsFormat', (new SmsFormat)->getTable());
    }
}
