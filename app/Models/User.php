<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Tonysm\RichTextLaravel\Attachables\Attachable;
use Tonysm\RichTextLaravel\Attachables\AttachableContract;
use Tonysm\RichTextLaravel\Models\Traits\HasRichText;

class User extends Authenticatable implements AttachableContract
{
    const ATTACHABLE_CONTENT_TYPE = 'application/vnd.rich-text-laravel.user-mention+html';

    use HasFactory, Notifiable;
    use HasRichText;
    use Attachable;

    /**
     * The dynamic rich text attributes.
     *
     * @var array<int|string, string>
     */
    protected $richTextAttributes = [
        'bio',
    ];

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'bio',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    public function chirps(): HasMany
    {
        return $this->hasMany(Chirp::class);
    }

    public function richTextRender(array $options = []): string
    {
        return view('rich-texts.partials.mention', [
            'user' => $this,
        ])->render();
    }

    public function richTextContentType(): string
    {
        return static::ATTACHABLE_CONTENT_TYPE;
    }

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }
}
