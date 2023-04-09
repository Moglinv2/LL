<script setup>
import { Head, Link, useForm, usePage } from "@inertiajs/inertia-vue3";
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

const form = useForm({
    name: "",
    email: "",
    password: "",
    password_confirmation: "",
    referer_code: usePage().props.value.referer,
    terms: true,
});

const submit = () => {
    form.post(route("register"), {
        onFinish: () => form.reset("password", "password_confirmation"),
    });
};
</script>

<template>
    <Head title="Register" />
    <!-- ==== topbar end ==== -->

    <!-- ==== header start ==== -->
    <header>
        <nav class="navbar navbar-expand-xl">
            <div class="container">
                <a class="navbar-brand" href="index.php">
                    <img
                        src="/assets/images/onix_white.png"
                        width="125"
                        alt="Onix Logo"
                    />
                </a>
                <div class="navbar__out order-2 order-xl-3">
                    <select class="language-select">
                        <option value="english">En</option>
                        <option value="australia">Aus</option>
                        <option value="brazil">Bra</option>
                        <option value="argentina">Arg</option>
                    </select>
                    <div class="nav__group__btn">
                        <a
                            :href="route('login')"
                            class="button d-none d-sm-block"
                        >
                            Log In
                        </a>
                        <a
                            :href="route('register')"
                            class="button active__btn d-none d-sm-block"
                        >
                            Sign Up
                        </a>
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
            <img src="assets/images/btc.png" alt="Bitcoin" class="bitcoin" />
            <img src="assets/images/ltc.png" alt="Litecoin" class="litecoin" />
            <img src="assets/images/eth.png" alt="Ethereum" class="ethereum" />
        </div>
        <!-- ==== #page animation end ==== -->
    </div>
    <!-- ==== #page wrapper end ==== -->

    <!-- ==== register form start ==== -->
    <section class="register">
        <div class="container">
            <div class="register__area">
                <h3 class="content__space--small text-center">
                    Become a New Investor
                </h3>
                <p class="text-center mb-55">
                    Become one of our investors and start making money
                </p>
                <form @submit.prevent="submit()">
                    <div class="input__grp content__space">
                        <div class="row d-flex align-items-start">
                            <div class="col-md-6">
                                <div class="input__area text-start">
                                    <label
                                        for="fullName"
                                        class="content__space--small"
                                        >Your Name</label
                                    >
                                    <input
                                        type="text"
                                        v-model="form.name"
                                        placeholder="Your Full Name"
                                        required="required"
                                    />
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="input__area text-start">
                                    <label
                                        for="mail"
                                        class="content__space--small"
                                        >Your E-mail</label
                                    >
                                    <input
                                        type="email"
                                        v-model="form.email"
                                        placeholder="Your E-mail Address"
                                        required="required"
                                    />
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="input__grp content__space">
                        <div class="row d-flex align-items-start">
                            <div class="col-md-6">
                                <div class="input__area text-start">
                                    <label
                                        for="regiPass"
                                        class="content__space--small"
                                        >Define Password</label
                                    >
                                    <div class="show__hide__password">
                                        <input
                                            type="password"
                                            v-model="form.password"
                                            placeholder="Define Password"
                                            required="required"
                                        />
                                        <i
                                            class="fas fa-eye-slash toggle__password"
                                        ></i>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="input__area text-start">
                                    <label
                                        for="retypePass"
                                        class="content__space--small"
                                        >Retype Password</label
                                    >
                                    <div class="show__hide__password">
                                        <input
                                            type="password"
                                            v-model="form.password_confirmation"
                                            placeholder="Retype Password"
                                            required="required"
                                        />
                                        <i
                                            class="fas fa-eye-slash retype__toggle__password"
                                        ></i>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <button type="submit" class="button content__space">
                        SIGN UP
                    </button>
                    <p class="text-center">
                        Already have an account?
                        <Link :href="route('login')">LOGIN</Link>
                    </p>
                </form>
            </div>
        </div>
    </section>
    <!-- ==== #register form end ==== -->

    <!-- Scroll To Top -->
    <a href="javascript:void(0)" class="scrollToTop">
        <i class="fas fa-angle-double-up"></i>
    </a>
</template>
