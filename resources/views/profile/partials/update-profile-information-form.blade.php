<section>
    <header>
        <h2 class="text-lg font-medium text-gray-900 dark:text-black-100">
            {{ __('información del perfil') }}
        </h2>

        <p class="mt-1 text-sm text-gray-600 dark:text--400">
            {{ __("Actualice la información del perfil y la dirección de correo electrónico de su cuenta.") }}
        </p>
    </header>

    <form id="send-verification" method="post" action="{{ route('verification.send') }}">
        @csrf
    </form>

    <form method="post" action="{{ route('profile.update') }}" class="mt-6 space-y-6">
        @csrf
        @method('patch')

        <div>
            <x-input-label for="name" :value="__('Nombre')" class="label-black" />
            <x-text-input id="name" name="name" type="text" class="mt-1 block w-full input-gray-light" :value="old('name', $user->name)" autofocus autocomplete="name" />
            <x-input-error class="mt-2 error-message" :messages="$errors->get('name')" />
        </div>
        

        <div>
            <x-input-label for="email" :value="__('Email')" class="label-black" />
            <x-text-input id="email" name="email" type="email" class="mt-1 block w-full input-gray-light" :value="old('email', $user->email)" autocomplete="username" />
            <x-input-error class="mt-2 error-message" :messages="$errors->get('email')" />

            @if ($user instanceof \Illuminate\Contracts\Auth\MustVerifyEmail && ! $user->hasVerifiedEmail())
                <div>
                    <p class="text-sm mt-2 text-gray-800 dark:text-gray-200">
                        {{ __('Your email address is unverified.') }}

                        <button form="send-verification" class="underline text-sm text-gray-600 dark:text-gray-400 hover:text-gray-900 dark:hover:text-gray-100 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 dark:focus:ring-offset-gray-800">
                            {{ __('Click here to re-send the verification email.') }}
                        </button>
                    </p>

                    @if (session('status') === 'verification-link-sent')
                        <p class="mt-2 font-medium text-sm text-green-600 dark:text-green-400">
                            {{ __('A new verification link has been sent to your email address.') }}
                        </p>
                    @endif
                </div>
            @endif
        </div>

        <div class="flex items-center gap-4">
            <x-primary-button>{{ __('Guardar') }}</x-primary-button>

            @if (session('status') === 'profile-updated')
                <p
                    x-data="{ show: true }"
                    x-show="show"
                    x-transition
                    x-init="setTimeout(() => show = false, 2000)"
                    class="text-sm text-black-600 dark:text-black-400"
                >{{ __('Saved.') }}</p>
            @endif
        </div>
    </form>
</section>


<style>
    /* Agrega estas clases en tu archivo de estilos CSS o en tu etiqueta <style> en el documento */
.label-black {
    color: black; /* Color del label */
}

.input-gray-light {
    background-color: #f2f2f2; /* Color de fondo del input (gris claro) */
    color: black; /* Color del texto del input */
}

/* Opcional: Estilo para el mensaje de error */
.error-message {
    color: red;
}

</style>