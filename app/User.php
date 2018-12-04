<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Laravel\Passport\HasApiTokens;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Support\Facades\Auth;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password', 'gender', 'avatar', 'teacher', 'registry', 'public_id', 'bio', 'occupation', 'birth',
        'institution_id', 'course_id'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    public function roles() {
        return $this->belongsToMany(Role::class);
    }

    public function ideas() {
        return $this->hasMany(Idea::class);
    }

    public function course() {
        return $this->belongsTo(Course::class);
    }

    public function teacherRequest() {
        return $this->hasOne(TeacherRequest::class);
    }

    public function institution() {
        return $this->belongsTo(Institution::class);
    }

    public function likes() {
        return $this->hasMany(Like::class);
    }

    public function projects() {
        return $this->hasMany(Project::class);
    }

    public function roleProject() {
        return $this->belongsTo(RoleProject::class);
    }

    public function hasPermission(Permission $permission) {

        return $this->hasAnyRoles($permission->roles);

    }

    public function hasAnyRoles($roles) {

        if (is_array($roles) || is_object($roles)) {
            return !! $roles->intersect($this->roles)->count();
        }

        return $this->roles->contains('name', $roles);
    }

    // Verify Like
    public function verifyLike($idea_id) {

        $likes = Auth::user()->likes;
        $idea = Idea::find($idea_id);

        foreach($likes as $like) {
            if ($like->idea == $idea) {
                return true;
            }
        }
        return false;
    }

    public function dislike($idea_id) {
        $likes = Auth::user()->likes;

        foreach ($likes as $like) {
            if ($like->idea_id == $idea_id) {
                $like->delete();
            }
        }
    }
}
