<script setup>
import { Head, Link, useForm } from "@inertiajs/inertia-vue3";
import JetAuthenticationCard from "@/Jetstream/AuthenticationCard.vue";
import JetAuthenticationCardLogo from "@/Jetstream/AuthenticationCardLogo.vue";
import JetButton from "@/Jetstream/Button.vue";
import JetInput from "@/Jetstream/Input.vue";
import JetCheckbox from "@/Jetstream/Checkbox.vue";
import JetLabel from "@/Jetstream/Label.vue";
import JetValidationErrors from "@/Jetstream/ValidationErrors.vue";
import { onMounted } from "vue";

onMounted(() => {
    $(".language-select").niceSelect();
});

defineProps({
    canResetPassword: Boolean,
    status: String,
});

const form = useForm({
    email: "",
    password: "",
    remember: false,
});

const submit = () => {
    form.transform((data) => ({
        ...data,
        remember: form.remember ? "on" : "",
    })).post(route("login"), {
        onFinish: () => form.reset("password"),
    });
};
</script>

<template>
    <Head title="Log in" />

    <header>
        <nav class="navbar navbar-expand-xl">
            <div class="container">
                <Link class="navbar-brand" href="/">
                    <img
                        src="/assets/images/onix_white.png"
                        width="125"
                        alt="Onix Logo"
                    />
                </Link>
                <div class="navbar__out order-2 order-xl-3">
                    <select class="language-select">
                        <option value="english">En</option>
                        <option value="australia">Aus</option>
                        <option value="brazil">Bra</option>
                        <option value="argentina">Arg</option>
                    </select>
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
                        class="navbar-toggler d-block d-sm-none"
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
                    class="collapse navbar-collapse tertiary--nav justify-content-end order-3 order-xl-2"
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
    <!-- ==== #header end ==== -->

    <!-- ==== page wrapper start ==== -->
    <div
        class="page__wrapper bg__img"
        data-background="./assets/images/register-bg.png"
    >
        <!-- ==== #page animation start ==== -->
        <div class="page__animation">
            <img
                src="assets/images/Metaverso.png"
                alt="Bitcoin"
                class="bitcoin"
            />
            <img
                src="assets/images/VectorMetaverso2.png"
                alt="Litecoin"
                class="litecoin"
            />
            <img
                src="assets/images/VectorMetaverso1.png"
                alt="Ethereum"
                class="ethereum"
            />
            <img
                src="assets/images/VectorMetaverso2.png"
                alt="Litecoin"
                class="eth--small"
            />
            <img
                src="assets/images/VectorMetaverso1.png"
                alt="Ethereum"
                class="btc"
            />
        </div>
        <!-- ==== #page animation end ==== -->
    </div>
    <!-- ==== #page wrapper end ==== -->

    <!-- ==== login form start ==== -->
    <section class="register">
        <div class="container">
            <JetValidationErrors class="mb-4" />

            <div v-if="status" class="mb-4 font-medium text-sm text-green-600">
                {{ status }}
            </div>

            <div class="register__area login__area">
                <h3 class="content__space--small text-center">Welcome Back!</h3>
                <p class="text-center mb-55">Enter your details below.</p>
                <form @submit.prevent="submit()">
                    <div class="input__area text-start content__space">
                        <label for="loginMail" class="content__space--small"
                            >Your Name</label
                        >
                        <input
                            type="email"
                            v-model="form.email"
                            placeholder="Enter Email"
                            required="required"
                        />
                    </div>
                    <div class="input__area text-start content__space--small">
                        <label for="loginMail" class="content__space--small"
                            >Enter Password</label
                        >
                        <div class="show__hide__password">
                            <input
                                type="password"
                                v-model="form.password"
                                placeholder="Enter Password"
                                required="required"
                            />
                            <i
                                class="fas fa-eye-slash login__toggle__password"
                            ></i>
                        </div>
                    </div>
                    <div class="input__area__alt cta__space">
                        <div class="input__area__alt__inner">
                            <input
                                type="checkbox"
                                v-model="form.remember"
                                checked="checked"
                            />
                            <label for="rememberPass">Remember Me</label>
                        </div>
                        <a href="javascript:void(0)">Forget Your Password</a>
                    </div>
                    <button type="submit" class="button content__space">
                        LOG IN
                    </button>
                    <p class="text-center">
                        Don't have an account?
                        <Link :href="route('register')">SIGN UP</Link>
                    </p>
                </form>
            </div>
        </div>
    </section>
    <!-- ==== #login form end ==== -->

    <!-- Scroll To Top -->
    <a href="javascript:void(0)" class="scrollToTop">
        <i class="fas fa-angle-double-up"></i>
    </a>
</template>
