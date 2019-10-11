<?php

namespace Tests\Feature;

use App\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Support\Facades\DB;
use Tests\TestCase;

class UsersModuleTest extends TestCase
{
    use RefreshDatabase;

    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function test_it_load_users_list_page()
    {

        factory(User::class)->create([
            'name' => 'Reinaldo'
        ]);

        factory(User::class)->create([
            'name' => 'Naldo'
        ]);

        $response = $this->get('/usuarios');

        $response->assertStatus(200)->assertSee('Reinaldo', 'Naldo');
    }

    public function test_it_load_users_list_page_is_empty()
    {
        

        $response = $this->get('/usuarios');

        $response->assertStatus(200)->assertSee('No hay usuarios registrados');
    }
    
    public function test_it_load_users_details_page()
    {

        $user = factory(User::class)->create([
            'name' => 'Alberto'
        ]);

        $response = $this->get('/usuarios/'.$user->id);

        $response->assertStatus(200)->assertSee('Alberto');
    }

    public function test_it_create_new_users()
    {

        $response = $this->get('/usuarios/nuevo');

        $response->assertStatus(200)->assertSee('Crear usuario nuevo');
    }

    public function test_it_display_a_404_error_if_user_is_not_found(){
        
        $response = $this->get('/usuarios/999');

        $response->assertStatus(404)->assertSee('Usuario no encontrado');
    }

    public function test_it_creates_a_new_user (){
       
        $this->post('/usuarios',[
            'name' => 'Reinaldo',
            'email' => 'reinaldo@reinaldo.com',
            'password' => '12345'
        ])->assertRedirect('usuarios');

        $this->assertDatabaseHas('users',[
            'name' => 'Reinaldo',
            'email' => 'reinaldo@reinaldo.com',
            // 'password' => '12345'
        ]);
    }

    
}
