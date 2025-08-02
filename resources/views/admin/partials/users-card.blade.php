@php
    use App\Models\User;
    use App\Enum\UserRole;
@endphp

<div class="card">
    <div class="card-body">
        <h2>Users</h2>

        <form method="GET" action="{{ route('admin.dashboard') }}" class="hstack">
            @csrf

            <x-form.input placeholder="{{ __('Username') }}" name="username" value="{{ $input['username'] ?? null }}"
                          :required="false"/>
            <x-form.input placeholder="{{ __('Email') }}" name="email" value="{{ $input['email'] ?? null }}"
                          :required="false"/>
            <x-form.select placeholder="{{ __('Select a role') }}" name="role" value="{{ $input['role'] ?? null }}"
                           :options="$roles" :required="false"/>

            <x-form.submit-button>{{ __('Search') }}</x-form.submit-button>
            <div>
                <x-link href="{{ route('admin.dashboard') }}" asButton>{{ __('Clear') }}</x-link>
            </div>
        </form>

        <div class="overflow-x-auto">
            <table class="table">
                <thead>
                <tr>
                    <th>ID</th>
                    <th>Username</th>
                    <th>Email</th>
                    @can('seeRoles', User::class)
                        <th>Roles</th>
                    @endcan
                    <th class="text-right">Actions</th>
                </tr>
                </thead>
                <tbody>
                @foreach ($users as $user)
                    <tr>
                        <th>{{ $user->id }}</th>
                        <td>{{ $user->username }}</td>
                        <td>{{ $user->email }}</td>
                        @can('see-roles', User::class)
                            <td>
                                @if($user->role === UserRole::USER->value)
                                    <x-badge variant="neutral">{{ strtoupper($user->role) }}</x-badge>
                                @else
                                    <x-badge variant="primary">{{ strtoupper($user->role) }}</x-badge>
                                @endif
                            </td>
                        @endcan
                        <td class="hstack justify-end gap-2">
                            <x-link href="{{ route('profile.show', $user) }}">View</x-link>
                            @can('update-roles', $user)
                                <x-link x-data="" x-on:click.prevent="$dispatch('open-modal', 'user-{{ $user->id }}-roles')">
                                    Roles
                                </x-link>
                            @endcan
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>

        @foreach ($users as $user)
            @can('updateRoles', $user)
                <x-modal name="user-{{ $user->id }}-roles" focusable>
                    <h2>{{ __('User roles') }}</h2>

                    <form method="post" action="{{ route('admin.user.roles', $user) }}" class="vstack">
                        @csrf

                        @foreach($roles as $role)
                            <x-form.radio :label="strtoupper($role)"
                                          name="role"
                                          :for="$role"
                                          :value="$role"
                                          checked="{{ $user->role == $role }}"
                            />
                        @endforeach

                        <x-form.submit-button>
                            {{ __('Update user') }}
                        </x-form.submit-button>
                    </form>
                </x-modal>
            @endcan
        @endforeach

        @if($users->isEmpty())
            <tr class="text-center">
                <td colspan="5">{{ __('No users found') }}</td>
            </tr>
        @endif

        {{ $users->onEachSide(1)->links() }}
    </div>
</div>
