<?php

namespace Database\Seeders;

use App\Models\User;
use App\Enums\WalletType;
use Illuminate\Database\Seeder;

class WalletSeeder extends Seeder
{
    public function run(): void
    {
        $user = User::first();
        $user->wallets()->createMany([
            [
                'name' => 'General Wallet',
                'type' => WalletType::General,
            ],
            [
                'name' => 'Savings Wallet',
                'type' => WalletType::Saving,
            ],
        ]);
    }
}
