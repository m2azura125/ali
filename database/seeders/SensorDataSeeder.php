<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\SensorData;
use App\Models\User;
use Carbon\Carbon;

class SensorDataSeeder extends Seeder
{
    /**
     * Triangular Membership Function (trimf)
     * Matches the ESP32 implementation.
     */
    private function trimf(float $x, float $a, float $b, float $c): float
    {
        if ($x <= $a || $x >= $c) {
            return 0.0;
        } elseif ($x == $b) {
            return 1.0;
        } elseif ($x > $a && $x < $b) {
            return ($x - $a) / ($b - $a);
        } else {
            return ($c - $x) / ($c - $b);
        }
    }

    /**
     * Fuzzy Sugeno Logic calculation
     * Matches the ESP32 logic exactly.
     */
    private function fuzzySugeno(float $suhu, float $ph, float $ntu): float
    {
        $s = [
            $this->trimf($suhu, 10, 20, 25),
            $this->trimf($suhu, 25, 32, 37),
            $this->trimf($suhu, 37, 50, 70),
        ];

        $p = [
            $this->trimf($ph, 4, 5, 6.5),
            $this->trimf($ph, 6.5, 7.5, 8.5),
            $this->trimf($ph, 8.5, 10.5, 12),
        ];

        $k = [
            $this->trimf($ntu, -1, 0, 1),
            $this->trimf($ntu, 1, 2, 5),
            $this->trimf($ntu, 5, 25, 50),
        ];

        // ruleOutput[3][3][3]
        $ruleOutput = [
            // i = 0 (Cold)
            [
                [0, 0, 0],
                [0, 0, 0],
                [0, 0, 0],
            ],
            // i = 1 (Normal temperature)
            [
                [0, 1, 0], // pH Acid: NTU [Jernih (0), Bisa Dipakai (1), Kekeruhan (0)]
                [1, 1, 0], // pH Normal: NTU [Jernih (1), Bisa Dipakai (1), Kekeruhan (0)]
                [0, 0, 0], // pH Base: NTU [Jernih (0), Bisa Dipakai (0), Kekeruhan (0)]
            ],
            // i = 2 (Hot)
            [
                [0, 0, 0],
                [0, 0, 0],
                [0, 0, 0],
            ]
        ];

        $sum_wz = 0.0;
        $sum_w = 0.0;

        for ($i = 0; $i < 3; $i++) {
            for ($j = 0; $j < 3; $j++) {
                for ($l = 0; $l < 3; $l++) {
                    $w = $s[$i] * $p[$j] * $k[$l];
                    $z = $ruleOutput[$i][$j][$l];
                    $sum_wz += $w * $z;
                    $sum_w += $w;
                }
            }
        }

        if ($sum_w == 0.0) {
            return 0.0;
        }
        return $sum_wz / $sum_w;
    }

    public function run(): void
    {
        // Clean existing sensor data first
        SensorData::truncate();

        // Get all warga users
        $wargas = User::where('role', 'warga')->get();
        $now = Carbon::now();

        foreach ($wargas as $user) {
            // Generate 120 data points over the last 5 days
            for ($i = 120; $i >= 0; $i--) {
                $timestamp = (clone $now)->subMinutes($i * 60); // spaced hourly

                if ($user->username === 'krisna') {
                    // Profile 1 (Krisna): Mid-range fluctuation
                    $temperature = 31.0 + (sin($i / 8) * 4.5) + (rand(-10, 10) / 10);
                    $ph = 7.2 + (cos($i / 12) * 2.0) + (rand(-20, 20) / 100);
                    $ntu = 2.2 + (sin($i / 15) * 2.2) + (rand(-10, 10) / 10);
                } elseif ($user->username === 'siti') {
                    // Profile 2 (Bu Siti): Super clean, normal, highly stable
                    $temperature = 26.5 + (sin($i / 10) * 1.5) + (rand(-5, 5) / 10);
                    $ph = 7.4 + (cos($i / 18) * 0.4) + (rand(-10, 10) / 100);
                    $ntu = 0.5 + (sin($i / 20) * 0.3) + (rand(-2, 2) / 10);
                } else {
                    // Profile 3 (Pak Rahman): Warmer, basic, higher turbidity (turbid water)
                    $temperature = 33.0 + (cos($i / 6) * 2.0) + (rand(-8, 8) / 10);
                    $ph = 8.1 + (sin($i / 10) * 0.8) + (rand(-15, 15) / 100);
                    $ntu = 12.5 + (cos($i / 8) * 10.0) + (rand(-15, 15) / 10);
                }

                // Constrain values to logical bounds
                if ($ph < 0) $ph = 0;
                if ($ph > 14) $ph = 14;
                if ($ntu < 0) $ntu = 0;

                // Calculate fuzzy output using the exact ESP32 rules
                $fuzzyOut = $this->fuzzySugeno($temperature, $ph, $ntu);

                // Relay Status: ON if fuzzy output >= 0.5
                $relay_status = ($fuzzyOut >= 0.5);

                SensorData::create([
                    'user_id' => $user->id,
                    'ph' => round($ph, 2),
                    'ntu' => round($ntu, 1),
                    'temperature' => round($temperature, 1),
                    'fuzzy' => round($fuzzyOut, 2),
                    'relay_status' => $relay_status,
                    'created_at' => $timestamp,
                    'updated_at' => $timestamp,
                ]);
            }
        }
    }
}
