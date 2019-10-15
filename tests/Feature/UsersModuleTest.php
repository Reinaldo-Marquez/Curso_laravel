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
               
        $this->post('/usuarios/',[
            'name' => 'Reinaldo',
            'email' => 'reinaldo2@reinaldo.com',
            'password' => '12345'
        ])->assertRedirect('/usuarios');

        $this->assertCredentials([
            'name' => 'Reinaldo',
            'email' => 'reinaldo2@reinaldo.com',
            'password' => '12345'
        ]);
    }

    public function test_the_name_is_required (){
        $this->from('/usuarios/nuevo')->post('/usuarios/',[
            'name' => '',
            'email' => 'reinaldo2@reinaldo.com',
            'password' => '12345'
        ])->assertRedirect('/usuarios/nuevo')->assertSessionHasErrors(['name' => 'El campo de nombre es obligatorio']);

        $this->assertEquals(0, User::count()); //esto es quivalente a lo de abajo!

        // $this->assertDatabaseMissing('users',[
        //     'email' => 'reinaldo2@reinaldo.com'
        // ]);
    }

    public function test_the_email_is_required (){
        $this->from('/usuarios/nuevo')->post('/usuarios/',[
            'name' => 'Reinaldo',
            'email' => '',
            'password' => '12345'
        ])->assertRedirect('/usuarios/nuevo')->assertSessionHasErrors(['email']);

        $this->assertEquals(0, User::count());
    }

    public function test_the_password_is_required (){
        $this->from('/usuarios/nuevo')->post('/usuarios/',[
            'name' => 'Reinaldo',
            'email' => 'reinaldo2@reinaldo.com',
            'password' => ''
        ])->assertRedirect('/usuarios/nuevo')->assertSessionHasErrors(['password']);

        $this->assertEquals(0, User::count());
    }

    public function test_required_email_validated (){
        $this->from('/usuarios/nuevo')->post('/usuarios/',[
            'name' => 'Reinaldo',
            'email' => 'correo-no-valido',
            'password' => '12345'
        ])->assertRedirect('/usuarios/nuevo')->assertSessionHasErrors(['email']);

        $this->assertEquals(0, User::count());
    }

    public function test_email_most_be_unique (){

        factory(User::class)->create([
            'email' => 'reinaldo2@reinaldo.com',
        ]);

        $this->from('/usuarios/nuevo')->post('/usuarios/',[
            'name' => 'Reinaldo',
            'email' => 'reinaldo2@reinaldo.com',
            'password' => '12345'
        ])->assertRedirect('/usuarios/nuevo')->assertSessionHasErrors(['email']);

        $this->assertEquals(1, User::count());
    }

    public function test_load_the_edit_user_page()
    {
        $user = factory(User::class)->create();

        $response = $this->get("/usuarios/{$user->id}/editar");

        $response->assertStatus(200)->assertViewIs('users.edit')->assertSee('Editar Usuario')->assertViewHas('user', $user);
    }

    public function test_it_update_a_user (){
        
        $user = factory(User::class)->create();
       
        $this->put("/usuarios/{$user->id}",[
            'name' => 'Reinaldo',
            'email' => 'reinaldo2@reinaldo.com',
            'password' => '12345'
        ])->assertRedirect("/usuarios/{$user->id}");

        $this->assertCredentials([
            'name' => 'Reinaldo',
            'email' => 'reinaldo2@reinaldo.com',
            'password' => '12345'
        ]);
    }
    
    public function test_the_update_name_is_required (){

        $user = factory(User::class)->create();

        $this->from("/usuarios/{$user->id}/editar")->put("/usuarios/{$user->id}",[
            'name' => '',
            'email' => 'reinaldo2@reinaldo.com',
            'password' => '12345'
        ])->assertRedirect("/usuarios/{$user->id}/editar")->assertSessionHasErrors(['name']);

        $this->assertDatabaseMissing('users', [
            'email' => 'reinaldo2@reinaldo.com'
        ]);  
    }

        public function test_the_email_is_required_to_upload (){
            $user = factory(User::class)->create();

            $this->from("/usuarios/{$user->id}/editar")->put("/usuarios/{$user->id}",[
                'name' => 'Reinaldo',
                'email' => '',
                'password' => '12345'
            ])->assertRedirect("/usuarios/{$user->id}/editar")->assertSessionHasErrors(['email']);
    
            $this->assertDatabaseMissing('users', [
                'name' => 'Reinaldo'
            ]); 
    }

    public function test_required_email_validated_to_upload (){

        $user = factory(User::class)->create();

        $this->from("/usuarios/{$user->id}/editar")->put("/usuarios/{$user->id}",[
            'name' => 'Reinaldo',
            'email' => 'correo-no-valido',
            'password' => '12345'
        ])->assertRedirect("/usuarios/{$user->id}/editar")->assertSessionHasErrors(['email']);
        
        $this->assertDatabaseMissing('users', [
            'name' => 'Reinaldo'
        ]);

    
    }

    public function test_email_most_be_unique_to_upload (){

        self::markTestIncomplete();
        return;

        factory(User::class)->create([
            'email' => 'reinaldo2@reinaldo.com',
        ]);

        $this->from('/usuarios/nuevo')->post('/usuarios/',[
            'name' => 'Reinaldo',
            'email' => 'reinaldo2@reinaldo.com',
            'password' => '12345'
        ])->assertRedirect('/usuarios/nuevo')->assertSessionHasErrors(['email']);

        $this->assertEquals(1, User::count());
    }

    public function test_the_password_is_required_to_upload (){
        $user = factory(User::class)->create();

        $this->from("/usuarios/{$user->id}/editar")->put("/usuarios/{$user->id}",[
            'name' => 'Reinaldo',
            'email' => 'reinaldo2@reinaldo.com',
            'password' => ''
        ])->assertRedirect("/usuarios/{$user->id}/editar")->assertSessionHasErrors(['password']);

        $this->assertDatabaseMissing('users', [
            'email' => 'reinaldo2@reinaldo.com'
        ]); 
    }
}
