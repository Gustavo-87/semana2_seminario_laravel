<x-guest-layout>
    <div class="mb-4 text-sm text-gray-600">
        Se ha enviado un código de verificación de 6 dígitos a tu correo electrónico.
        El código será válido durante 5 minutos.
    </div>

    @if (session('status'))
        <div class="mb-4 font-medium text-sm text-green-600">
            {{ session('status') }}
        </div>
    @endif

    <form method="POST" action="{{ route('otp.verify.post') }}">
        @csrf

        <div>
            <x-input-label for="code" value="Código de verificación" />

            <x-text-input
                id="code"
                class="block mt-1 w-full"
                type="text"
                name="code"
                :value="old('code')"
                required
                autofocus
                inputmode="numeric"
                autocomplete="one-time-code"
                maxlength="6"
                pattern="[0-9]{6}"
            />

            <x-input-error :messages="$errors->get('code')" class="mt-2" />
        </div>

        <div class="flex items-center justify-end mt-4">
            <x-primary-button>
                Verificar código
            </x-primary-button>
        </div>
    </form>

    <form method="POST" action="{{ route('otp.resend') }}" class="mt-4">
        @csrf

        <button
            type="submit"
            class="text-sm text-gray-600 underline hover:text-gray-900"
        >
            Reenviar código
        </button>
    </form>
</x-guest-layout>
