<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Serie extends Model{
    public $timestamps = false;
    protected $fillable = ['name'];
    protected $appends = ['links'];

    public function episodes(){
        return $this->hasMany(Episode::class);
    }

    public function getLinksAttribute(): array
    {
        return [
            'self' => '/api/series/' .$this->id,
            'episodes' => '/api/series/' .$this->id. '/episodes'
        ];
    }
}
?>