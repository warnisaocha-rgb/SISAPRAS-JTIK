<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BebasPinjam extends Model
{
    use HasFactory;

    protected $table = 'bebas_pinjams';

    protected $fillable = [
        'kode_pengajuan',
        'user_id',
        'keperluan',
        'tgl_pengajuan',
        'status_lab_komputer',
        'petugas_lab_komputer',
        'tgl_lab_komputer',
        'catatan_lab_komputer',
        'status_lab_jaringan',
        'petugas_lab_jaringan',
        'tgl_lab_jaringan',
        'catatan_lab_jaringan',
        'status_ruang_inventaris',
        'petugas_ruang_inventaris',
        'tgl_ruang_inventaris',
        'catatan_ruang_inventaris',
        'status_final',
        'tgl_disahkan_final',
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    /**
     * Buat QR Code SVG offline standar ISO/IEC 18004 (Byte mode, ECC Level L, Versi 1-4)
     */
    public static function makeQrSvg(string $text, int $pixelSize = 76): string
    {
        $bytes = array_values(unpack('C*', substr($text, 0, 78)) ?: []);
        $len = count($bytes);

        $versions = [
            1 => ['size' => 21, 'total' => 26, 'data' => 19, 'ecc' => 7, 'align' => []],
            2 => ['size' => 25, 'total' => 44, 'data' => 34, 'ecc' => 10, 'align' => [6, 18]],
            3 => ['size' => 29, 'total' => 70, 'data' => 55, 'ecc' => 15, 'align' => [6, 22]],
            4 => ['size' => 33, 'total' => 100, 'data' => 80, 'ecc' => 20, 'align' => [6, 26]],
        ];

        $cfg = $versions[4];
        foreach ($versions as $v) {
            if ($len + 2 <= $v['data']) {
                $cfg = $v;
                break;
            }
        }
        $bytes = array_slice($bytes, 0, max(0, $cfg['data'] - 2));
        $len = count($bytes);

        // Bangun bitstream mode Byte (0100) + panjang 8-bit + data
        $bits = [0, 1, 0, 0];
        for ($i = 7; $i >= 0; $i--) {
            $bits[] = ($len >> $i) & 1;
        }
        foreach ($bytes as $b) {
            for ($i = 7; $i >= 0; $i--) {
                $bits[] = ($b >> $i) & 1;
            }
        }
        $maxBits = $cfg['data'] * 8;
        for ($t = 0; $t < 4 && count($bits) < $maxBits; $t++) {
            $bits[] = 0;
        }
        while (count($bits) % 8 !== 0) {
            $bits[] = 0;
        }
        $dataCodewords = [];
        for ($i = 0; $i < count($bits); $i += 8) {
            $val = 0;
            for ($j = 0; $j < 8; $j++) {
                $val = ($val << 1) | $bits[$i + $j];
            }
            $dataCodewords[] = $val;
        }
        $padBytes = [0xEC, 0x11];
        $padIdx = 0;
        while (count($dataCodewords) < $cfg['data']) {
            $dataCodewords[] = $padBytes[$padIdx % 2];
            $padIdx++;
        }

        // Reed-Solomon GF(256) primitif 0x11D
        $gfExp = array_fill(0, 512, 0);
        $gfLog = array_fill(0, 256, 0);
        $x = 1;
        for ($i = 0; $i < 255; $i++) {
            $gfExp[$i] = $x;
            $gfExp[$i + 255] = $x;
            $gfLog[$x] = $i;
            $x <<= 1;
            if ($x & 0x100) {
                $x ^= 0x11D;
            }
        }

        $gen = [1];
        for ($i = 0; $i < $cfg['ecc']; $i++) {
            $next = array_fill(0, count($gen) + 1, 0);
            $factor = $gfExp[$i];
            for ($j = 0; $j < count($gen); $j++) {
                $next[$j] ^= $gen[$j];
                if ($gen[$j] !== 0) {
                    $next[$j + 1] ^= $gfExp[$gfLog[$gen[$j]] + $gfLog[$factor]];
                }
            }
            $gen = $next;
        }

        $rem = array_fill(0, $cfg['ecc'], 0);
        foreach ($dataCodewords as $b) {
            $factor = $b ^ array_shift($rem);
            $rem[] = 0;
            if ($factor !== 0) {
                for ($j = 0; $j < $cfg['ecc']; $j++) {
                    if ($gen[$j + 1] !== 0) {
                        $rem[$j] ^= $gfExp[$gfLog[$gen[$j + 1]] + $gfLog[$factor]];
                    }
                }
            }
        }
        $allCodewords = array_merge($dataCodewords, $rem);

        $n = $cfg['size'];
        $mod = array_fill(0, $n, array_fill(0, $n, false));
        $func = array_fill(0, $n, array_fill(0, $n, false));

        $setFunc = function (int $r, int $c, bool $dark) use (&$mod, &$func, $n) {
            if ($r >= 0 && $r < $n && $c >= 0 && $c < $n) {
                $mod[$r][$c] = $dark;
                $func[$r][$c] = true;
            }
        };

        $drawFinder = function (int $row, int $col) use ($setFunc) {
            for ($dr = -1; $dr <= 7; $dr++) {
                for ($dc = -1; $dc <= 7; $dc++) {
                    $dist = max(abs($dr - 3), abs($dc - 3));
                    $dark = ($dr >= 0 && $dr <= 6 && $dc >= 0 && $dc <= 6) && ($dist === 0 || $dist === 3 || $dist === 1);
                    if ($dist === 2) $dark = false;
                    $setFunc($row + $dr, $col + $dc, $dark);
                }
            }
        };

        $drawFinder(0, 0);
        $drawFinder(0, $n - 7);
        $drawFinder($n - 7, 0);

        $align = $cfg['align'];
        foreach ($align as $ar) {
            foreach ($align as $ac) {
                $overlapsFinder = ($ar <= 8 && $ac <= 8) || ($ar <= 8 && $ac >= $n - 9) || ($ar >= $n - 9 && $ac <= 8);
                if ($overlapsFinder) continue;
                for ($dr = -2; $dr <= 2; $dr++) {
                    for ($dc = -2; $dc <= 2; $dc++) {
                        $dist = max(abs($dr), abs($dc));
                        $setFunc($ar + $dr, $ac + $dc, $dist !== 1);
                    }
                }
            }
        }

        for ($i = 8; $i < $n - 8; $i++) {
            $setFunc(6, $i, $i % 2 === 0);
            $setFunc($i, 6, $i % 2 === 0);
        }
        $setFunc($n - 8, 8, true);

        for ($i = 0; $i <= 8; $i++) {
            if (!$func[8][$i]) $func[8][$i] = true;
            if (!$func[$i][8]) $func[$i][8] = true;
        }
        for ($i = $n - 8; $i < $n; $i++) {
            $func[8][$i] = true;
        }
        for ($i = $n - 7; $i < $n; $i++) {
            $func[$i][8] = true;
        }

        // Tempatkan bit codeword zig-zag kanan-ke-kiri
        $bitIdx = 0;
        $totalBits = count($allCodewords) * 8;
        $up = true;
        for ($right = $n - 1; $right >= 1; $right -= 2) {
            if ($right === 6) $right = 5;
            for ($vert = 0; $vert < $n; $vert++) {
                $r = $up ? ($n - 1 - $vert) : $vert;
                for ($j = 0; $j < 2; $j++) {
                    $c = $right - $j;
                    if (!$func[$r][$c]) {
                        $bit = false;
                        if ($bitIdx < $totalBits) {
                            $byte = $allCodewords[intdiv($bitIdx, 8)];
                            $bit = (($byte >> (7 - ($bitIdx % 8))) & 1) === 1;
                            $bitIdx++;
                        }
                        $mod[$r][$c] = $bit;
                    }
                }
            }
            $up = !$up;
        }

        $applyFormat = function (array &$grid, int $mask) use ($n) {
            $data = (0b01 << 3) | $mask;
            $remBits = $data << 10;
            for ($i = 14; $i >= 10; $i--) {
                if (($remBits >> $i) & 1) {
                    $remBits ^= (0x537 << ($i - 10));
                }
            }
            $fmt = (($data << 10) | $remBits) ^ 0x5412;

            for ($i = 0; $i <= 5; $i++) $grid[8][$i] = (($fmt >> (14 - $i)) & 1) === 1;
            $grid[8][7] = (($fmt >> 8) & 1) === 1;
            $grid[8][8] = (($fmt >> 7) & 1) === 1;
            $grid[7][8] = (($fmt >> 6) & 1) === 1;
            for ($i = 0; $i <= 5; $i++) $grid[5 - $i][8] = (($fmt >> (5 - $i)) & 1) === 1;

            for ($i = 0; $i <= 6; $i++) $grid[$n - 1 - $i][8] = (($fmt >> (14 - $i)) & 1) === 1;
            for ($i = 0; $i <= 7; $i++) $grid[8][$n - 8 + $i] = (($fmt >> (7 - $i)) & 1) === 1;
        };

        $maskCond = function (int $m, int $r, int $c): bool {
            return match ($m) {
                0 => ($r + $c) % 2 === 0,
                1 => $r % 2 === 0,
                2 => $c % 3 === 0,
                3 => ($r + $c) % 3 === 0,
                4 => (intdiv($r, 2) + intdiv($c, 3)) % 2 === 0,
                5 => (($r * $c) % 2 + ($r * $c) % 3) === 0,
                6 => ((($r * $c) % 2 + ($r * $c) % 3) % 2) === 0,
                default => ((($r + $c) % 2 + ($r * $c) % 3) % 2) === 0,
            };
        };

        $bestMask = 0;
        $bestPenalty = PHP_INT_MAX;
        $bestGrid = $mod;

        for ($m = 0; $m < 8; $m++) {
            $cand = $mod;
            for ($r = 0; $r < $n; $r++) {
                for ($c = 0; $c < $n; $c++) {
                    if (!$func[$r][$c] && $maskCond($m, $r, $c)) {
                        $cand[$r][$c] = !$cand[$r][$c];
                    }
                }
            }
            $applyFormat($cand, $m);

            $penalty = 0;
            for ($r = 0; $r < $n; $r++) {
                $runColor = $cand[$r][0];
                $runLen = 1;
                for ($c = 1; $c < $n; $c++) {
                    if ($cand[$r][$c] === $runColor) {
                        $runLen++;
                    } else {
                        if ($runLen >= 5) $penalty += 3 + ($runLen - 5);
                        $runColor = $cand[$r][$c];
                        $runLen = 1;
                    }
                }
                if ($runLen >= 5) $penalty += 3 + ($runLen - 5);
            }
            for ($c = 0; $c < $n; $c++) {
                $runColor = $cand[0][$c];
                $runLen = 1;
                for ($r = 1; $r < $n; $r++) {
                    if ($cand[$r][$c] === $runColor) {
                        $runLen++;
                    } else {
                        if ($runLen >= 5) $penalty += 3 + ($runLen - 5);
                        $runColor = $cand[$r][$c];
                        $runLen = 1;
                    }
                }
                if ($runLen >= 5) $penalty += 3 + ($runLen - 5);
            }
            for ($r = 0; $r < $n - 1; $r++) {
                for ($c = 0; $c < $n - 1; $c++) {
                    $v = $cand[$r][$c];
                    if ($v === $cand[$r][$c + 1] && $v === $cand[$r + 1][$c] && $v === $cand[$r + 1][$c + 1]) {
                        $penalty += 3;
                    }
                }
            }

            if ($penalty < $bestPenalty) {
                $bestPenalty = $penalty;
                $bestMask = $m;
                $bestGrid = $cand;
            }
        }

        $quiet = 2;
        $vb = $n + ($quiet * 2);
        $path = '';
        for ($r = 0; $r < $n; $r++) {
            for ($c = 0; $c < $n; $c++) {
                if ($bestGrid[$r][$c]) {
                    $px = $c + $quiet;
                    $py = $r + $quiet;
                    $path .= "M{$px},{$py}h1v1h-1z";
                }
            }
        }

        return '<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 ' . $vb . ' ' . $vb . '" width="' . $pixelSize . '" height="' . $pixelSize . '" shape-rendering="crispEdges" role="img" aria-label="QR Verifikasi Surat"><rect width="100%" height="100%" fill="#FFFFFF"/><path d="' . $path . '" fill="#000000"/></svg>';
    }
}
