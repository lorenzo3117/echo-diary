<div class="card">
    <div class="card-body">
        <h2 class="card-title">{{ __('Delete Account') }}</h2>

        <p>{{ __('Once your account is deleted, all of its resources and data will be permanently deleted. Before deleting your account, please download any data or information that you wish to retain.') }}</p>

        <div class="card-actions">
            <x-form-submit x-data="" x-on:click.prevent="$dispatch('open-modal', 'confirm-user-deletion')" variant="error">
                {{ __('Delete Account') }}
            </x-form-submit>
        </div>

        <x-modal name="confirm-user-deletion" :show="$errors->userDeletion->isNotEmpty()" focusable>
            <div class="card">
                <div class="card-body">
                    <h2 class="card-title">{{ __('Are you sure you want to delete your account?') }}</h2>

                    <p class="text-danger">
                        {{ __('Once your account is deleted, all of its resources and data will be permanently deleted. Please enter your password to confirm you would like to permanently delete your account.') }}
                    </p>

                    <form method="post" action="{{ route('profile.destroy') }}">
                        @csrf
                        @method('delete')

                        <x-input type="password" label="{{ __('Password') }}" name="password-deletion" />

                        <div class="card-actions">
                            <x-form-submit variant="error">
                                {{ __('Delete Account') }}
                            </x-form-submit>
                            <x-form-submit variant="default" x-on:click="$dispatch('close')">
                                {{ __('Cancel') }}
                            </x-form-submit>
                        </div>
                    </form>
                </div>
            </div>
        </x-modal>
    </div>
</div>
