<?php

namespace App;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'nim', 'email', 'password', 'role', 'status', 'whatsapp', 'user_type'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    /**
     * User type constants
     */
    const USER_TYPE_MAHASISWA = 'mahasiswa';
    const USER_TYPE_UMUM = 'umum';

    /**
     * Role constants
     */
    const ROLE_ADMIN = 'admin';
    const ROLE_ADMIN_UPSKILL = 'admin_upskill';
    const ROLE_OPERATOR = 'operator';
    const ROLE_REGULAR = 'regular';
    const ROLE_PREMIUM = 'premium';

    /**
     * Status constants
     */
    const STATUS_ACTIVE = 'active';
    const STATUS_INACTIVE = 'inactive';
    const STATUS_REJECTED = 'rejected';

    public function transaksi()
    {
        return $this->hasOne('App\Transaksi');
    }

    public function sertifikats()
    {
        return $this->hasMany('App\Sertifikat');
    }

    public function kelas()
    {
        return $this->belongsToMany('App\Kelas', 'user_kelas')->withTimestamps();
    }

    public function materi()
    {
        return $this->belongsToMany('App\Materi', 'progress', 'user_id', 'materi_id')->withPivot('completed_at')->withTimestamps();
    }

    public function eventRegistrations()
    {
        return $this->hasMany('App\EventRegistration');
    }

    /**
     * Scopes for user types
     */
    public function scopeMahasiswa($query)
    {
        return $query->where('user_type', self::USER_TYPE_MAHASISWA);
    }

    public function scopeUmum($query)
    {
        return $query->where('user_type', self::USER_TYPE_UMUM);
    }

    /**
     * Scopes for roles
     */
    public function scopeAdmins($query)
    {
        return $query->whereIn('role', [self::ROLE_ADMIN, self::ROLE_ADMIN_UPSKILL, self::ROLE_OPERATOR]);
    }

    public function scopeUsers($query)
    {
        return $query->whereIn('role', [self::ROLE_REGULAR, self::ROLE_PREMIUM]);
    }

    /**
     * Scopes for status
     */
    public function scopeActive($query)
    {
        return $query->where('status', self::STATUS_ACTIVE);
    }

    public function scopePending($query)
    {
        return $query->where('status', self::STATUS_INACTIVE);
    }

    public function scopeRejected($query)
    {
        return $query->where('status', self::STATUS_REJECTED);
    }

    /**
     * Helper methods
     */
    public function isMahasiswa()
    {
        return $this->user_type === self::USER_TYPE_MAHASISWA;
    }

    public function isUmum()
    {
        return $this->user_type === self::USER_TYPE_UMUM;
    }

    public function isAdmin()
    {
        return $this->role === self::ROLE_ADMIN;
    }

    public function isAdminUpskill()
    {
        return $this->role === self::ROLE_ADMIN_UPSKILL;
    }

    public function isOperator()
    {
        return $this->role === self::ROLE_OPERATOR;
    }

    public function isAnyAdmin()
    {
        return in_array($this->role, [self::ROLE_ADMIN, self::ROLE_ADMIN_UPSKILL, self::ROLE_OPERATOR]);
    }

    public function isRegular()
    {
        return $this->role === self::ROLE_REGULAR;
    }

    public function isPremium()
    {
        return $this->role === self::ROLE_PREMIUM;
    }

    public function isActive()
    {
        return $this->status === self::STATUS_ACTIVE;
    }

    public function isPending()
    {
        return $this->status === self::STATUS_INACTIVE;
    }

    public function isRejected()
    {
        return $this->status === self::STATUS_REJECTED;
    }

    public function getAngkatanAttribute()
    {
        return $this->nim ? substr($this->nim, 0, 2) : null;
    }

    public function getSemesterAttribute()
    {
        if (!$this->nim || !$this->isMahasiswa()) {
            return null;
        }

        $angkatan = (int) $this->angkatan;
        $entryYear = 2000 + $angkatan;

        $currentYear = (int) date('Y');
        $currentMonth = (int) date('m');

        $yearsPassed = $currentYear - $entryYear;
        $semesterNumber = $yearsPassed * 2 + ($currentMonth > 6 ? 1 : 0);

        return $semesterNumber > 0 ? $semesterNumber : 1;
    }

    /**
     * Get semester for a specific date (for historical filtering)
     */
    public function getSemesterAtDate($date = null)
    {
        if (!$this->nim || !$this->isMahasiswa()) {
            return null;
        }

        $angkatan = (int) $this->angkatan;
        $entryYear = 2000 + $angkatan;

        if ($date) {
            $targetDate = new \DateTime($date);
            $currentYear = (int) $targetDate->format('Y');
            $currentMonth = (int) $targetDate->format('m');
        } else {
            $currentYear = (int) date('Y');
            $currentMonth = (int) date('m');
        }

        $yearsPassed = $currentYear - $entryYear;
        $semesterNumber = $yearsPassed * 2 + ($currentMonth > 6 ? 1 : 0);

        return $semesterNumber > 0 ? $semesterNumber : 1;
    }

    /**
     * Scope for filtering by semester
     */
    public function scopeBySemester($query, $semester)
    {
        if (!$semester || $semester === 'null') {
            return $query->where(function($q) {
                $q->whereNull('nim')
                  ->orWhere('user_type', '!=', self::USER_TYPE_MAHASISWA);
            });
        }

        return $query->where('user_type', self::USER_TYPE_MAHASISWA)
                    ->where('nim', '!=', '')
                    ->where('nim', 'IS NOT', null)
                    ->whereRaw('
                        CASE
                            WHEN user_type = "mahasiswa" AND nim IS NOT NULL AND nim != ""
                            THEN
                                (2000 + CAST(SUBSTRING(nim, 1, 2) AS UNSIGNED)) * 2 +
                                CASE WHEN MONTH(CURRENT_DATE()) > 6 THEN 1 ELSE 0 END
                            ELSE NULL
                        END = ?
                    ', [$semester]);
    }

    /**
     * Scope for filtering by semester at registration date
     */
    public function scopeBySemesterAtRegistration($query, $semester)
    {
        if (!$semester || $semester === 'null') {
            return $query->where(function($q) {
                $q->whereNull('nim')
                  ->orWhere('user_type', '!=', self::USER_TYPE_MAHASISWA);
            });
        }

        return $query->where('user_type', self::USER_TYPE_MAHASISWA)
                    ->where('nim', '!=', '')
                    ->where('nim', 'IS NOT', null)
                    ->whereRaw('
                        CASE
                            WHEN user_type = "mahasiswa" AND nim IS NOT NULL AND nim != ""
                            THEN
                                (2000 + CAST(SUBSTRING(nim, 1, 2) AS UNSIGNED)) * 2 +
                                CASE WHEN MONTH(created_at) > 6 THEN 1 ELSE 0 END
                            ELSE NULL
                        END = ?
                    ', [$semester]);
    }

    /**
     * Get user type display name
     */
    public function getUserTypeDisplayAttribute()
    {
        return $this->user_type === self::USER_TYPE_MAHASISWA ? 'Mahasiswa' : 'Umum';
    }

    /**
     * Get role display name
     */
    public function getRoleDisplayAttribute()
    {
        $roles = [
            self::ROLE_ADMIN => 'Administrator',
            self::ROLE_ADMIN_UPSKILL => 'Admin Upskill',
            self::ROLE_OPERATOR => 'Operator',
            self::ROLE_REGULAR => 'Regular',
            self::ROLE_PREMIUM => 'Premium'
        ];

        return $roles[$this->role] ?? $this->role;
    }

    /**
     * Get status display name
     */
    public function getStatusDisplayAttribute()
    {
        $statuses = [
            self::STATUS_ACTIVE => 'Aktif',
            self::STATUS_INACTIVE => 'Menunggu Persetujuan',
            self::STATUS_REJECTED => 'Ditolak'
        ];

        return $statuses[$this->status] ?? $this->status;
    }
}
