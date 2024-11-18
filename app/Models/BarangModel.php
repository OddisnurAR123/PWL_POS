<?php

namespace App\Models;

use App\Http\Middleware\Authenticate;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Tymon\JWTAuth\Contracts\JWTSubject;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Foundation\Auth\User as Authenticatable;

class BarangModel extends Authenticatable implements JWTSubject
{
    public function getJWTIdentifier()
    {
        return $this->getKey();
    }

    public function getJWTCustomClaims()
    {
        return [];
    }
    use HasFactory;

    protected $table = 'm_barang'; // Mendefinisikan nama tabel yang digunakan oleh model ini
    protected $primaryKey = 'barang_id'; // Mendefinisikan primary key dari tabel yang digunakan

    protected $fillable = ['kategori_id','barang_kode','barang_nama', 'harga_beli', 'harga_jual', 'image'];

    public function kategori():BelongsTo
    {
        return $this->belongsTo(KategoriModel::class, 'kategori_id','kategori_id');
    }
    public function barang():HasMany
    {
        return $this->hasMany(StockModel::class, 'stock_id', 'stock_id');
    }
    protected function image(): Attribute{
        return Attribute::make(
            get: fn ($image) => url('/storage/post'. $image),
        );
    }
}