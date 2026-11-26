<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Submission extends Model
{
    use HasFactory;

    // TODO 2: Tambahkan 'nilai' dan 'catatan_dosen' ke $fillable, serta lengkapi logika status nilai ('Belum Dinilai', 'Lulus' >= 70, 'Perlu Perbaikan')
    protected $fillable = [
        'assignment_id',
        'user_id',
        'jawaban',
        'submitted_at',
        'nilai',
        'catatan_dosen'
    ];

    protected $casts = [
        'nilai' => 'integer',
        'submitted_at' => 'datetime',
    ];

    public function assignment(): BelongsTo
    {
        return $this->belongsTo(Assignment::class);
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function getStatusNilaiAttribute(): string
    {
        // TODO 2: Lengkapi logika status nilai ('Belum Dinilai' jika null, 'Lulus' jika >= 70, selain itu 'Perlu Perbaikan')
        if (is_null($this->nilai)) {
            return 'Belum Dinilai';
        } elseif ($this->nilai >= 70) {
            return 'Lulus';
        } else {
            return 'Perlu Perbaikan';
        }
    }
}
