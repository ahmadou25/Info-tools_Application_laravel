<?php

namespace App\Actions\Fortify;

use App\Models\Team;
use App\Models\User;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Laravel\Fortify\Contracts\CreatesNewUsers;
use Laravel\Jetstream\Jetstream;

class CreateNewUser implements CreatesNewUsers
{
    use PasswordValidationRules;

    /**
     * Validate and create a newly registered user with a team.
     *
     * @param  array<string, string>  $input
     */
    public function create(array $input): User
    {
        // Validation des champs
        Validator::make($input, [
            'last_name' => ['required', 'string', 'max:255'],
            'first_name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => $this->passwordRules(),
            'role' => ['required', 'in:Manager,Salesperson'],
            'terms' => Jetstream::hasTermsAndPrivacyPolicyFeature() ? ['accepted', 'required'] : '',
        ])->validate();

        // Transaction pour créer l'utilisateur et son équipe
        return DB::transaction(function () use ($input) {
            // Création de l'utilisateur
            $user = User::create([
                'last_name' => $input['last_name'],
                'first_name' => $input['first_name'],
                'email' => $input['email'],
                'password' => Hash::make($input['password']),
                'role' => $input['role'],
            ]);

            // Création de l'équipe personnelle de l'utilisateur
            $team = $this->createTeam($user);
            
            // Assigner l'équipe actuelle à l'utilisateur
            $user->current_team_id = $team->id; // Assurez-vous de stocker l'ID de l'équipe
            $user->save();

            return $user;
        });
    }

    /**
     * Crée une équipe personnelle pour l'utilisateur.
     */
    protected function createTeam(User $user): Team
    {
        return Team::forceCreate([
            'user_id' => $user->id,
            'name' => explode(' ', $user->first_name, 2)[0]."'s Team", // Utilise le prénom de l'utilisateur pour nommer l'équipe
            'personal_team' => true,
        ]);
    }
}
