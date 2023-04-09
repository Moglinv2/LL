<script setup>
import { Head, Link } from "@inertiajs/inertia-vue3";
import { onMounted, ref } from "vue";

onMounted(() => {
    $("#selectPlan").niceSelect();
    $("#selectPayment").niceSelect();
});

defineProps({
    canLogin: Boolean,
    canRegister: Boolean,
    laravelVersion: String,
    phpVersion: String,
});

let amount = ref(250);
let currency = ref("btc");
</script>

<template>
    <Head title="Welcome" />

    <header>
        <nav class="navbar navbar-expand-xl">
            <div class="container">
                <Link class="navbar-brand" href="/">
                    <img
                        src="assets/images/logo.png"
                        alt="Logo"
                        class="logo"
                        style="width: 200px; height: 100px"
                    />
                </Link>
                <div class="navbar__out order-2 order-xl-3">
                    <div class="nav__group__btn">
                        <Link
                            :href="route('login')"
                            class="button active__btn d-none d-sm-block"
                        >
                            Log In
                        </Link>
                        <Link
                            :href="route('register')"
                            class="button d-none d-sm-block"
                        >
                            Sign Up
                        </Link>
                    </div>
                    <button
                        class="navbar-toggler"
                        type="button"
                        data-bs-toggle="collapse"
                        data-bs-target="#primaryNav"
                        aria-controls="primaryNav"
                        aria-expanded="false"
                        aria-label="Toggle Primary Nav"
                    >
                        <span class="icon-bar top-bar"></span>
                        <span class="icon-bar middle-bar"></span>
                        <span class="icon-bar bottom-bar"></span>
                    </button>
                </div>
                <div
                    class="collapse navbar-collapse justify-content-end order-3 order-xl-2"
                    id="primaryNav"
                >
                    <ul class="navbar-nav">
                        <li class="nav-item d-block d-sm-none">
                            <Link
                                :href="route('login')"
                                class="button button--last"
                                >Log In</Link
                            >
                        </li>
                        <li class="nav-item d-block d-sm-none">
                            <Link
                                :href="route('register')"
                                class="button button--last"
                                >Sign Up</Link
                            >
                        </li>
                    </ul>
                </div>
            </div>
        </nav>
    </header>
</template>

<style scoped>
.bg-gray-100 {
    background-color: #f7fafc;
    background-color: rgba(247, 250, 252, var(--tw-bg-opacity));
}

.border-gray-200 {
    border-color: #edf2f7;
    border-color: rgba(237, 242, 247, var(--tw-border-opacity));
}

.text-gray-400 {
    color: #cbd5e0;
    color: rgba(203, 213, 224, var(--tw-text-opacity));
}

.text-gray-500 {
    color: #a0aec0;
    color: rgba(160, 174, 192, var(--tw-text-opacity));
}

.text-gray-600 {
    color: #718096;
    color: rgba(113, 128, 150, var(--tw-text-opacity));
}

.text-gray-700 {
    color: #4a5568;
    color: rgba(74, 85, 104, var(--tw-text-opacity));
}

.text-gray-900 {
    color: #1a202c;
    color: rgba(26, 32, 44, var(--tw-text-opacity));
}

@media (prefers-color-scheme: dark) {
    .dark\:bg-gray-800 {
        background-color: #2d3748;
        background-color: rgba(45, 55, 72, var(--tw-bg-opacity));
    }

    .dark\:bg-gray-900 {
        background-color: #1a202c;
        background-color: rgba(26, 32, 44, var(--tw-bg-opacity));
    }

    .dark\:border-gray-700 {
        border-color: #4a5568;
        border-color: rgba(74, 85, 104, var(--tw-border-opacity));
    }

    .dark\:text-white {
        color: #fff;
        color: rgba(255, 255, 255, var(--tw-text-opacity));
    }

    .dark\:text-gray-400 {
        color: #cbd5e0;
        color: rgba(203, 213, 224, var(--tw-text-opacity));
    }
}
</style>
