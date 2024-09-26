<?php

use App\Models\User;
use Illuminate\Auth\Events\Registered;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;
use Livewire\Attributes\Layout;
use Livewire\Volt\Component;

new #[Layout('layouts.guest')] class extends Component
{
    public string $name = '';
    public string $email = '';
    public string $password = '';
    public string $password_confirmation = '';

    /**
     * Handle an incoming registration request.
     */
    public function register(): void
    {
        $validated = $this->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'lowercase', 'email', 'max:255', 'unique:'.User::class],
            'password' => ['required', 'string', 'confirmed', Rules\Password::defaults()],
        ]);

        $validated['password'] = Hash::make($validated['password']);

        event(new Registered($user = User::create($validated)))->assignRole([\App\RoleEnum::USER]);

        Auth::login($user);

        $this->redirect(route('home', absolute: false), navigate: true);
    }
}; ?>

<div class="container  d-flex align-items-center justify-content-center">
    <div class="col-md-6 col-lg-4">
        <form wire:submit="register" class="card p-4 shadow">
            <!-- Name -->
            <div class="form-group mb-3">
                <x-input-label for="name" :value="__('Name')" />
                <x-text-input wire:model="name" id="name" class="form-control block mt-1 w-full" type="text" name="name" required autofocus autocomplete="name" />
                <x-input-error :messages="$errors->get('name')" class="mt-2" />
            </div>



            <!-- Email Address -->
            <div class="form-group mb-3">
                <x-input-label for="email" :value="__('Email')" />
                <x-text-input wire:model="email" id="email" class="form-control block mt-1 w-full" type="email" name="email" required autocomplete="username" />
                <x-input-error :messages="$errors->get('email')" class="mt-2" />
            </div>

            <!-- Password -->
            <div class="form-group mb-3">
                <x-input-label for="password" :value="__('Password')" />
                <x-text-input wire:model="password" id="password" class="form-control block mt-1 w-full"
                              type="password"
                              name="password"
                              required autocomplete="new-password" />
                <x-input-error :messages="$errors->get('password')" class="mt-2" />
            </div>

            <!-- Confirm Password -->
            <div class="form-group mb-3">
                <x-input-label for="password_confirmation" :value="__('Confirm Password')" />
                <x-text-input wire:model="password_confirmation" id="password_confirmation" class="form-control block mt-1 w-full"
                              type="password"
                              name="password_confirmation" required autocomplete="new-password" />
                <x-input-error :messages="$errors->get('password_confirmation')" class="mt-2" />
            </div>

            <div class="d-flex justify-content-between align-items-center">
                <a class="text-sm text-gray-600 dark:text-gray-400 hover:text-gray-900 dark:hover:text-gray-100" href="{{ route('Login') }}" wire:navigate>
                    {{ __('Already registered?') }}
                </a>

                <x-primary-button class="btn btn-primary ms-3">
                    {{ __('Register') }}
                </x-primary-button>
            </div>
        </form>
    </div>
</div>

