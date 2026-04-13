<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class EmployeeAccountSeeder extends Seeder
{
    /**
     * Seed the application's database with employee login accounts.
     */
    public function run(): void
    {
        $credentials = [];

        User::firstOrCreate(
            ['username' => 'adminpsubdk0000s'],
            [
                'name' => 'Admin Monitoring',
                'password' => Hash::make('admin1234'),
            ]
        );

        $target = 50;
        while (count($credentials) < $target) {
            $username = 'psubdk'.str_pad((string) random_int(0, 9999), 4, '0', STR_PAD_LEFT).'s';

            if (User::where('username', $username)->exists()) {
                continue;
            }

            $plainPassword = $this->generateRandomPassword(8);

            $user = User::create([
                'name' => 'Karyawan '.(count($credentials) + 1),
                'username' => $username,
                'password' => Hash::make($plainPassword),
            ]);

            $credentials[] = [
                'name' => $user->name,
                'username' => $username,
                'password' => $plainPassword,
            ];
        }

        $lines = [
            'Daftar akun otomatis karyawan',
            'Tanggal: '.now()->format('Y-m-d H:i:s'),
            '==========================================',
            'Admin: username=adminpsubdk0000s password=admin1234',
            '',
        ];

        foreach ($credentials as $index => $credential) {
            $lines[] = sprintf(
                '%02d. %s | username=%s | password=%s',
                $index + 1,
                $credential['name'],
                $credential['username'],
                $credential['password']
            );
        }

        file_put_contents(storage_path('users.txt'), implode(PHP_EOL, $lines).PHP_EOL);
    }

    private function generateRandomPassword(int $length): string
    {
        $characters = 'abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789';
        $maxIndex = strlen($characters) - 1;
        $password = '';

        for ($i = 0; $i < $length; $i++) {
            $password .= $characters[random_int(0, $maxIndex)];
        }

        return $password;
    }
}
