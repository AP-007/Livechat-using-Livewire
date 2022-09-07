<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use App\Models\Message;

class MessagesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $ask = (int) $this->command->ask('How many messages do you want to generate', 100);
        $users = User::all();
        Message::factory($ask)->make()->each(function ($message) use($users) {
            $message->user_id = $users->random()->id;
            $message->receiver = User::where('is_admin', true)->first()->id;
            $message->save();
        });
    }
}
