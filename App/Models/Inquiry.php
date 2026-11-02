<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Inquiry extends Model
{
    use HasFactory;

    protected $table = 'inquiries'; // Pastikan nama tabel benar

    protected $fillable = [
        'user_id',    // <--- TAMBAHAN PENTING (Agar tahu siapa pengirimnya)
        'property_id',
        'name',
        'email',
        'phone',
        'subject',    // <--- TAMBAHAN PENTING (Untuk judul pesan)
        'message',
        'status',
        'notes',
        'assigned_to'
    ];

    protected $casts = [
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
    ];

    // Relasi ke Property
    public function property()
    {
        return $this->belongsTo(Property::class);
    }

    // Relasi ke User (Agent)
    public function assignedAgent()
    {
        return $this->belongsTo(User::class, 'assigned_to');
    }
    
    // Relasi ke User (Pengirim)
    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
}