<section>
    <header>
        <h2 class="text-lg font-medium text-black-900 dark:text-black-100">
            {{ __('Actualizar Contraseña') }}
        </h2>

        <p class="mt-1 text-sm text-gray-600 dark:text-gray-400">
            {{ __('Asegúrese de que su cuenta utilice una contraseña larga y aleatoria para mantenerse segura.') }}
        </p>
    </header>

    <form method="post" action="{{ route('password.update') }}" class="mt-6 space-y-6">
        @csrf
        @method('put')

        <div>
            <x-input-label for="update_password_current_password" :value="__('Current Password')" class="label-black " />
            <x-text-input id="update_password_current_password" name="current_password" type="password" class="mt-1 block w-full input-gray-light" autocomplete="current-password" />
            <x-input-error :messages="$errors->updatePassword->get('current_password')" class="mt-2 error-message" />
        </div>

        <div>
            <x-input-label for="update_password_password" :value="__('New Password')" class="label-black "/>
            <x-text-input id="update_password_password" name="password" type="password" class="mt-1 block w-full input-gray-light" autocomplete="new-password" />
            <x-input-error :messages="$errors->updatePassword->get('password')" class="mt-2 error-message" />
        </div>

        <div>
            <x-input-label for="update_password_password_confirmation" :value="__('Confirm Password')" class="label-black "/>
            <x-text-input id="update_password_password_confirmation" name="password_confirmation" type="password" class="mt-1 block w-full input-gray-light" autocomplete="new-password" />
            <x-input-error :messages="$errors->updatePassword->get('password_confirmation')" class="mt-2 error-message" />
        </div>

        <div class="flex items-center gap-4">
            <x-primary-button>{{ __('Guardar') }}</x-primary-button>

            @if (session('status') === 'password-updated')
                <p
                    x-data="{ show: true }"
                    x-show="show"
                    x-transition
                    x-init="setTimeout(() => show = false, 2000)"
                    class="text-sm text-gray-600 dark:text-gray-400"
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