<script setup lang="ts">
import { Head, Link } from '@inertiajs/vue3';
import Header from '@/Components/Header.vue';

defineProps<{
    canLogin?: boolean;
    canRegister?: boolean;
    laravelVersion: string;
    phpVersion: string;
}>();

function handleImageError() {
    document.getElementById('screenshot-container')?.classList.add('!hidden');
    document.getElementById('docs-card')?.classList.add('!row-span-1');
    document.getElementById('docs-card-content')?.classList.add('!flex-row');
    document.getElementById('background')?.classList.add('!hidden');
}
</script>

<template>
    <Head title="Welcome" />
    <Header />
    <div class="bg-gray-50 text-black/50 dark:bg-black dark:text-white/50">
        <div class="relative flex min-h-screen flex-col items-center justify-center selection:bg-[#FF2D20] selection:text-white">
            <div class="relative w-full max-w-2xl px-6 lg:max-w-7xl">
                <!-- Header with Navigation -->


                <!-- Main Content Area -->
                <div class="flex flex-col items-center justify-center mt-10">
                    <h1 class="text-3xl font-bold text-center text-black dark:text-white">
                        Welcome to Your Application!
                    </h1>
                    <p class="mt-4 text-lg text-center text-black dark:text-white/70">
                        This is a test page to explore Laravel + Inertia + Vue3 integration. You can toggle themes, test authentication, and more.
                    </p>

                    <div class="mt-6 space-x-4">
                        <Link
                            :href="route('dashboard')"
                            class="px-4 py-2 bg-blue-500 text-white rounded-lg transition hover:bg-blue-600 dark:bg-blue-700 dark:hover:bg-blue-800"
                        >
                            Go to Dashboard
                        </Link>
                        <Link
                            :href="route('profile.edit')"
                            class="px-4 py-2 bg-green-500 text-white rounded-lg transition hover:bg-green-600 dark:bg-green-700 dark:hover:bg-green-800"
                        >
                            Edit Profile
                        </Link>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>
