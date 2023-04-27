<?php
use Illuminate\Contracts\Validation\Rule;
use App\Models\User;

class CheckUserEmail implements Rule
{
    public function passes($attribute, $value)
    {
        return ! User::where('email', $value)->where('role', 'admin')->exists();
    }

    public function message()
    {
        return 'The email belongs to an admin user.';
    }
}

