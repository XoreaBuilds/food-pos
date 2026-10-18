<div class="p-6">
    <h1 class="text-2xl font-bold mb-6">Users</h1>

    {{-- Add user form --}}
    <form wire:submit="createUser" class="bg-white border rounded-lg p-4 mb-6 max-w-md space-y-3">
        <h2 class="font-semibold">Add New User</h2>

        <div>
            <input wire:model="name" type="text" placeholder="Name" class="w-full border rounded px-3 py-2 text-sm">
            @error('name')
            <p class="text-red-600 text-xs mt-1">{{ $message }}</p> @enderror
        </div>

        <div>
            <input wire:model="email" type="email" placeholder="Email" class="w-full border rounded px-3 py-2 text-sm">
            @error('email')
            <p class="text-red-600 text-xs mt-1">{{ $message }}</p> @enderror
        </div>

        <div>
            <input wire:model="password" type="password" placeholder="Password"
                class="w-full border rounded px-3 py-2 text-sm">
            @error('password')
            <p class="text-red-600 text-xs mt-1">{{ $message }}</p> @enderror
        </div>

        <div>
            <select wire:model="selectedRole" class="w-full border rounded px-3 py-2 text-sm">
                <option value="">Select role</option>
                @forelse(($roles ?? []) as $role)
                    <option value="{{ $role->name }}">{{ ucfirst($role->name) }}</option>
                @empty
                    <option value="" disabled>No roles available</option>
                @endforelse
            </select>
            @error('selectedRole')
            <p class="text-red-600 text-xs mt-1">{{ $message }}</p> @enderror
        </div>

        <button type="submit" class="bg-blue-600 text-white px-4 py-2 rounded text-sm">Add User</button>
    </form>

    {{-- User list --}}
    <table class="w-full text-sm bg-white border rounded-lg">
        <thead>
            <tr class="border-b text-left">
                <th class="p-3">Name</th>
                <th class="p-3">Email</th>
                <th class="p-3">Role</th>
                <th class="p-3"></th>
            </tr>
        </thead>
        <tbody>
            @forelse(($users ?? []) as $user)
                <tr class="border-b">
                    <td class="p-3">{{ $user->name }}</td>
                    <td class="p-3">{{ $user->email }}</td>
                    <td class="p-3">{{ $user->roles->pluck('name')->implode(', ') ?: '—' }}</td>
                    <td class="p-3">
                        <button wire:click="deleteUser({{ $user->id }})" wire:confirm="Delete this user?"
                            class="text-red-600 text-xs hover:underline">Delete</button>
                    </td>
                </tr>
            @empty
                <tr>
                    <td class="p-3 text-gray-500" colspan="4">No users found.</td>
                </tr>
            @endforelse
        </tbody>
    </table>
</div>
