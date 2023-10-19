<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Laravel\Sanctum\HasApiTokens;

class Solicitation extends Model
{
    use HasApiTokens, HasFactory;

    protected $fillable = [
        'description',
        'quantity',
        'price',
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }

    // metodo de acesso que seta e convert o para o tipo de dado correto sem a mascara para o atributo
    public function setPriceAttribute($value)
    {
        if (empty($value)) {
            $this->attributes['price'] = null;
        } else {
            $this->attributes['price'] = floatval($this->convertStringToDouble($value));
        }       
    }

    //metodo de acesso retorna o valor em R$.
   public function getPriceAttribute($value)
   {
       if(empty($value)){
           return null;
       }else{
           return number_format($value, 2,',', '.');
       }       
   }

    private function convertStringToDouble($param) 
    {
        if (empty($param)) {
            return null;
        }

        return str_replace(',', '.', str_replace('.', '', $param ));
    }
}
