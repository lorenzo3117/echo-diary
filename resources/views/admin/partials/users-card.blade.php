<div class="card">
    <div class="card-body">
        <h2>Users</h2>

        <form method="GET" action="{{ route('admin.dashboard') }}" class="hstack">
            @csrf

            <x-input placeholder="{{ __('Username') }}" name="username" value="{{ $input['username'] ?? null }}" :required="false"/>
            <x-input placeholder="{{ __('Email') }}" name="email" value="{{ $input['email'] ?? null }}" :required="false"/>
            <x-select placeholder="{{ __('Select a role') }}" name="role" value="{{ $input['role'] ?? null }}" :options="$roles" :required="false"/>

            <x-form-submit>{{ __('Search') }}</x-form-submit>
        </form>

        <div class="overflow-x-auto">
            <table class="table">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Username</th>
                        <th>Email</th>
                        <th>Roles</th>
                        <th class="text-right">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($users as $user)
                    <tr>
                        <th>{{ $user->id }}</th>
                        <td>{{ $user->username }}</td>
                        <td>{{ $user->email }}</td>
                        <td>
                            @foreach ($user->roles as $role)
                                @if($role->name === 'user')
                                    <x-badge variant="neutral">{{ strtoupper($role->name) }}</x-badge>
                                @else
                                    <x-badge variant="primary">{{ strtoupper($role->name) }}</x-badge>
                                @endif
                            @endforeach
                        </td>
                        <td class="text-right">
                            <x-link href="{{ route('profile.show', $user) }}">View</x-link>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
                @if($users->isEmpty())
                    <tr class="text-center">
                        <td colspan="5">{{ __('No users found') }}</td>
                    </tr>
                @endif
            </table>
        </div>

        {{ $users->onEachSide(1)->links() }}
    </div>
</div>
