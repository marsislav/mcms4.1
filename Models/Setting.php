<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Setting extends Model
{
    protected $fillable = [
        'site_name', 'logo', 'contact_number', 'contact_email', 'address',
        'site_info', 'facebook', 'instagram', 'twitter', 'tiktok',
        'linkedin', 'vkontakte', 'youtube', 'skype',
        'footer_text1', 'footer_text2', 'footer_text3',
        'homepage_type', 'homepage_id',
        'mail_host', 'mail_port', 'mail_username', 'mail_password', 'mail_encryption', 'mail_from_address',
    ];

    public function homePage()
    {
        return $this->belongsTo(Page::class, 'homepage_id');
    }
}
