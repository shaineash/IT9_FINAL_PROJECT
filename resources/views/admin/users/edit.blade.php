<x-app-layout>
    <div class="max-w-2xl mx-auto px-6 py-8">
        <button onclick="history.back()" class="inline-flex items-center gap-2 px-4 py-2 bg-[#0f0f0f] border border-[#2a2a2a] text-[#f5f5f0] rounded-xl hover:border-[#c9a77c] hover:bg-[#c9a77c]/10 transition-colors duration-300 text-sm font-medium mb-6">
            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path>
            </svg>
            Go Back
        </button>

        <div class="mb-8">
            <h1 class="font-serif text-3xl text-[#f5f5f0]">Edit User</h1>
            <p class="text-[#8a8a8a] text-sm mt-1">Update user information</p>
        </div>

        <form method="POST" action="{{ route('admin.users.update', $user) }}" class="luxury-form-card luxury-form-inner space-y-6">
            @csrf
            @method('PUT')

            <!-- Name -->
            <div>
                <label for="name" class="block text-sm font-medium text-[#f5f5f0] mb-2">Full Name</label>
                <input type="text" name="name" id="name" value="{{ old('name', $user->name) }}" required
                    class="w-full px-4 py-2.5 bg-[#0f0f0f] border border-[#2a2a2a] rounded-lg text-[#f5f5f0] focus:outline-none focus:border-[#c9a77c] focus:ring-1 focus:ring-[#c9a77c] transition-all">
                @error('name') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
            </div>

            <!-- Email -->
            <div>
                <label for="email" class="block text-sm font-medium text-[#f5f5f0] mb-2">Email Address</label>
                <input type="email" name="email" id="email" value="{{ old('email', $user->email) }}" required
                    class="w-full px-4 py-2.5 bg-[#0f0f0f] border border-[#2a2a2a] rounded-lg text-[#f5f5f0] focus:outline-none focus:border-[#c9a77c] focus:ring-1 focus:ring-[#c9a77c] transition-all">
                @error('email') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
            </div>

            <!-- Password -->
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <div>
                    <label for="password" class="block text-sm font-medium text-[#f5f5f0] mb-2">New Password (leave blank to keep)</label>
                    <input type="password" name="password" id="password"
                        class="w-full px-4 py-2.5 bg-[#0f0f0f] border border-[#2a2a2a] rounded-lg text-[#f5f5f0] focus:outline-none focus:border-[#c9a77c] focus:ring-1 focus:ring-[#c9a77c] transition-all">
                    @error('password') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
                </div>

                <div>
                    <label for="password_confirmation" class="block text-sm font-medium text-[#f5f5f0] mb-2">Confirm Password</label>
                    <input type="password" name="password_confirmation" id="password_confirmation"
                        class="w-full px-4 py-2.5 bg-[#0f0f0f] border border-[#2a2a2a] rounded-lg text-[#f5f5f0] focus:outline-none focus:border-[#c9a77c] focus:ring-1 focus:ring-[#c9a77c] transition-all">
                </div>
            </div>

            <!-- Actions -->
            <div class="flex items-center gap-4 pt-4 border-t border-[#2a2a2a]">
                <button type="submit" class="px-6 py-2.5 bg-[#c9a77c] text-[#0f0f0f] text-sm font-medium tracking-wider rounded-lg hover:bg-[#e8d5a7] transition-colors duration-300">
                    Update User
                </button>
                <a href="{{ route('admin.users.index') }}" class="px-6 py-2.5 border border-[#2a2a2a] text-[#f5f5f0] text-sm font-medium rounded-lg hover:border-[#c9a77c] transition-colors duration-300">
                    Cancel
                </a>
            </div>
        </form>
    </div>
</x-app-layout>
