<?php

namespace Tests\Feature;

use App\Contact;
use Carbon\Carbon;
use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class ContactsTest extends TestCase
{

    use RefreshDatabase;

    /**
     * @test
     */
    public function a_contact_can_be_added()
    {
        //$this->withoutExceptionHandling();
        $this->post('/api/contacts',$this->data());

        $contact = Contact::first();

        //$this->assertCount(1,Contact::all());
        $this->assertEquals('Test Name',$contact->name);
        $this->assertEquals('test@email.com',$contact->email);
        $this->assertEquals('2000-01-01',$contact->birthday->format('Y-m-d'));
        $this->assertEquals('ABC String',$contact->company);
    }

    /**
     * @test
     * 必須項目のテスト
     */
    public function fields_are_required(){
        collect(['name','email','birthday','company'])
            ->each(function($field){
                $response = $this->post('/api/contacts',
                    array_merge($this->data(),[$field => ''])
                );

                $response->assertSessionHasErrors($field);
                $this->assertCount(0,Contact::all());
            });
    }

    /**
     * @test
     * email形式のテスト
     */
    public function email_must_be_a_valid_email(){
        $response = $this->post('/api/contacts',
            array_merge($this->data(),['email' => 'NOT AN EMAIL'])
        );

        $response->assertSessionHasErrors('email');
        $this->assertCount(0,Contact::all());
    }

    /**
     * @test
     * 日付形式のテスト
     */
    public function birthdays_are_properly_stored(){

        $this->withoutExceptionHandling();

        $response = $this->post('/api/contacts',
            array_merge($this->data())
        );

        $this->assertCount(1,Contact::all());
        $this->assertInstanceOf(Carbon::class,Contact::first()->birthday);
        $this->assertEquals('2000-01-01',Contact::first()->birthday->format('Y-m-d'));
    }


    /**
     * @test
     */
    public function a_name_is_required(){
        //Tips nameを抜いたデータを用意する
        $response = $this->post('/api/contacts',
            array_merge($this->data(),['name' => ''])
        );

        $response->assertSessionHasErrors('name');
        $this->assertCount(0,Contact::all());
    }

    /**
     * @test
     */
    public function email_is_required(){
        //Tips emailを抜いたデータを用意する
        $response = $this->post('/api/contacts',
            array_merge($this->data(),['email' => ''])
        );

        $response->assertSessionHasErrors('email');
        $this->assertCount(0,Contact::all());
    }

    private function data(){
        return [
            'name' => 'Test Name',
            'email' => 'test@email.com',
            'birthday' => '2000-01-01',
            'company' => 'ABC String'
        ];
    }
}
