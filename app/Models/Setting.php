<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Setting extends Model
{
    protected $fillable = [
        'site_name',
        'address',
        'contact_number',
        'contact_email',
        'site_info', 
        'facebook',
        'instagram',
        'twitter',
        'tiktok',
        'linkedin',
        'vkontakte',
        'youtube',
        'skype',
        'footer_text1',
        'footer_text2',
        'footer_text3',
        'logo'
    ];
}