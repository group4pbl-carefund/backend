<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Laravel\Sanctum\HasApiTokens;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{

    /** @use HasFactory<\Database\Factories\UserFactory> */
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    protected $fillable = [
        'full_name',
        'email',
        'phone',
        'date_of_birth',
        'gender',
        'address',
        'city',
        'state',
        'country',
        'is_verified',
        'role',
        'password',
        'email_verified_at',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var list<string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

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

    public function donations()
    {
        return $this->hasMany(Donation::class);
    }

    public function programs()
    {
        return $this->hasMany(Program::class, 'created_by');
    }

    public function identities()
    {
        return $this->hasMany(UserIdentity::class);
    }

    public function sessions()
    {
        return $this->hasMany(UserSession::class);
    }

    public function termsAgreements()
    {
        return $this->hasMany(UserTermsAgreement::class);
    }

    public function securityMonitorings()
    {
        return $this->hasMany(SecurityMonitoring::class);
    }

    public function educationArticles()
    {
        return $this->hasMany(EducationArticle::class, 'author_id');
    }

    public function educationViews()
    {
        return $this->hasMany(EducationView::class);
    }
}
