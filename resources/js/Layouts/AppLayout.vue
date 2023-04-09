<script setup>
import { ref } from "vue";
import { Inertia } from "@inertiajs/inertia";
import { Head, Link } from "@inertiajs/inertia-vue3";
import JetApplicationMark from "@/Jetstream/ApplicationMark.vue";
import JetBanner from "@/Jetstream/Banner.vue";
import JetDropdown from "@/Jetstream/Dropdown.vue";
import JetDropdownLink from "@/Jetstream/DropdownLink.vue";
import JetNavLink from "@/Jetstream/NavLink.vue";
import JetResponsiveNavLink from "@/Jetstream/ResponsiveNavLink.vue";

defineProps({
    title: String,
});

const showingNavigationDropdown = ref(false);
const sidebarIsOpened = ref();

const switchToTeam = (team) => {
    Inertia.put(
        route("current-team.update"),
        {
            team_id: team.id,
        },
        {
            preserveState: false,
        }
    );
};

const logout = () => {
    Inertia.post(route("logout"));
};
</script>

<template>
    <Head :title="title" />

    <!-- <JetBanner /> -->

    <!-- ==== header start ==== -->
    <header class="header__dashboard header__alt">
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
                    <div class="dashboard__nav">
                        <div class="profile__meta">
                            <a href="javascript:void(0)" class="profile__small">
                                <img
                                    src="/assets/images/avatar.png"
                                    alt="Profile Image"
                                />
                            </a>
                            <div class="profile__info">
                                <div class="profile__info__head">
                                    <div>
                                        <img
                                            src="/assets/images/avatar.png"
                                            alt="User"
                                        />
                                    </div>
                                    <div class="profile__head__content">
                                        <a href="settings.php">Roger Smith</a>
                                        <p class="tertiary">
                                            <a
                                                href="/cdn-cgi/l/email-protection"
                                                class="__cf_email__"
                                                data-cfemail="fd8f929a988fc5c9bd9a909c9491d39e9290"
                                                >[email&#160;protected]</a
                                            >
                                        </p>
                                    </div>
                                </div>
                                <a href="settings.php">Personal Info</a>
                                <a href="settings.php">Payout Settings</a>
                                <a href="#">Logout</a>
                            </div>
                        </div>
                    </div>
                    <button
                        @click="sidebarIsOpened = true"
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
            </div>
        </nav>
    </header>
    <!-- ==== #header end ==== -->

    <!-- ==== dashboard section start ==== -->
    <div class="dashboard section__space__bottom">
        <div class="container">
            <div class="dashboard__area">
                <div class="row">
                    <div class="col-xxl-3">
                        <div
                            class="sidebar"
                            :class="{ sidebar__active: sidebarIsOpened }"
                        >
                            <a href="javascript:void(0)" class="close__sidebar">
                                <i class="fas fa-times"></i>
                            </a>
                            <div class="sidenav__wrapper">
                                <ul v-if="$page.props.user.role == 'admin'">
                                    <li>
                                        <Link
                                            :href="route('admin.users.index')"
                                            :class="{
                                                sidenav__active:
                                                    route().current(
                                                        'admin.users.index'
                                                    ),
                                            }"
                                        >
                                            <img
                                                src="/assets/images/icons/dashboard.png"
                                                alt="dashboard"
                                            />
                                            Users
                                        </Link>
                                    </li>

                                    <li>
                                        <Link
                                            :href="
                                                route('admin.payments.index')
                                            "
                                            :class="{
                                                sidenav__active:
                                                    route().current(
                                                        'admin.payments.index'
                                                    ),
                                            }"
                                        >
                                            <img
                                                src="/assets/images/icons/dashboard.png"
                                                alt="dashboard"
                                            />
                                            Payments
                                        </Link>
                                    </li>

                                    <li>
                                        <Link
                                            :href="
                                                route('admin.finances.index')
                                            "
                                            :class="{
                                                sidenav__active:
                                                    route().current(
                                                        'admin.finances.index'
                                                    ),
                                            }"
                                        >
                                            <img
                                                src="/assets/images/icons/dashboard.png"
                                                alt="dashboard"
                                            />
                                            Finances
                                        </Link>
                                    </li>

                                    <li>
                                        <Link
                                            :href="
                                                route('admin.settings.index')
                                            "
                                            :class="{
                                                sidenav__active:
                                                    route().current(
                                                        'admin.settings.index'
                                                    ),
                                            }"
                                        >
                                            <img
                                                src="/assets/images/icons/dashboard.png"
                                                alt="dashboard"
                                            />
                                            Settings
                                        </Link>
                                    </li>
                                </ul>

                                <ul
                                    v-if="
                                        $page.props.user.role == 'user' ||
                                        $page.props.user.role == 'reseller'
                                    "
                                >
                                    <li>
                                        <Link
                                            :href="route('dashboard')"
                                            :class="{
                                                sidenav__active:
                                                    route().current(
                                                        'dashboard'
                                                    ),
                                            }"
                                        >
                                            <img
                                                src="/assets/images/icons/dashboard.png"
                                                alt="dashboard"
                                            />
                                            Dashboard
                                        </Link>
                                    </li>
                                    <li>
                                        <Link
                                            :href="route('deposits.index')"
                                            :class="{
                                                sidenav__active:
                                                    route().current(
                                                        'deposits.index'
                                                    ),
                                            }"
                                        >
                                            <img
                                                src="/assets/images/icons/deposit.png"
                                                alt="Deposit"
                                            />
                                            Deposit
                                        </Link>
                                    </li>
                                    <li>
                                        <Link
                                            :href="route('withdraws.index')"
                                            :class="{
                                                sidenav__active:
                                                    route().current(
                                                        'withdraws.index'
                                                    ),
                                            }"
                                        >
                                            <img
                                                src="/assets/images/icons/withdraw.png"
                                                alt="Withdrawal"
                                            />
                                            Withdrawal
                                        </Link>
                                    </li>
                                    <li>
                                        <Link
                                            :href="route('investments.index')"
                                            :class="{
                                                sidenav__active:
                                                    route().current(
                                                        'investments.index'
                                                    ),
                                            }"
                                        >
                                            <img
                                                src="/assets/images/icons/investment.png"
                                                alt="Investment"
                                            />
                                            My Investments
                                        </Link>
                                    </li>
                                    <li>
                                        <Link
                                            :href="route('lottery.index')"
                                            :class="{
                                                sidenav__active:
                                                    route().current(
                                                        'lottery.index'
                                                    ),
                                            }"
                                        >
                                            <img
                                                src="/assets/images/icons/lottery.png"
                                                alt="Lottery"
                                            />
                                            Lottery
                                        </Link>
                                    </li>
                                    <li>
                                        <Link
                                            :href="route('referers.index')"
                                            :class="{
                                                sidenav__active:
                                                    route().current(
                                                        'referers.index'
                                                    ),
                                            }"
                                        >
                                            <img
                                                src="/assets/images/icons/affiliate.png"
                                                alt="Affiliate Program"
                                            />
                                            Affiliate Program
                                        </Link>
                                    </li>
                                    <li>
                                        <Link
                                            :href="route('wallet.index')"
                                            :class="{
                                                sidenav__active:
                                                    route().current(
                                                        'wallet.index'
                                                    ),
                                            }"
                                        >
                                            <img
                                                src="/assets/images/icons/wallets.png"
                                                alt="Wallets"
                                            />
                                            Wallets
                                        </Link>
                                    </li>
                                    <!-- <li>
                                        <Link :href="route('history')">
                                            <img src="/assets/images/icons/history.png" alt="History" /> History
                                        </Link>
                                    </li> -->
                                    <li>
                                        <Link
                                            :href="route('settings')"
                                            :class="{
                                                sidenav__active:
                                                    route().current('settings'),
                                            }"
                                        >
                                            <img
                                                src="/assets/images/icons/settings.png"
                                                alt="Settings"
                                            />
                                            Settings
                                        </Link>
                                    </li>
                                </ul>

                                <hr />
                                <ul class="logout">
                                    <li>
                                        <a @click="logout()">
                                            <img
                                                src="/assets/images/icons/logout.png"
                                                alt="Logout"
                                            />
                                            Logout
                                        </a>
                                    </li>
                                </ul>
                            </div>
                            <!-- <div class="sidenav__wrapper sidenav__footer">
                                <h6>Last Login</h6>
                                <hr />
                                <div class="sidenav__time">
                                    <p class="tertiary"><img src="/assets/images/icons/login.png" alt="Login" />
                                        02.01.2022</p>
                                    <p class="tertiary">15:48:13</p>
                                </div>
                            </div> -->
                        </div>
                    </div>
                    <div class="col-xxl-9">
                        <div class="main__content">
                            <div class="collapse__sidebar">
                                <h4>Dashboard</h4>
                                <a
                                    href="javascript:void(0)"
                                    class="collapse__sidebar__btn"
                                >
                                    <i class="fas fa-bars"></i>
                                </a>
                            </div>

                            <slot></slot>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div
        class="overlay"
        :class="{ overlay__active: sidebarIsOpened }"
        @click="sidebarIsOpened = false"
    ></div>
    <!-- ==== #dashboard section end ==== -->

    <!-- ==== footer section start ==== -->
    <footer class="footer">
        <div class="container">
            <div class="footer__nav">
                <a href="index.php" class="logo">
                    <img
                        src="/assets/images/onix_white.png"
                        width="125"
                        alt="Onix Logo"
                    />
                </a>
                <ul>
                    <li>
                        <a href="about-us.php">About</a>
                    </li>
                    <li>
                        <a href="investment-plan.php">Investment</a>
                    </li>
                    <li>
                        <a href="contact-us.php">Contact Us</a>
                    </li>
                    <li>
                        <a href="privacy-policy.php">Privacy Policy</a>
                    </li>
                    <li>
                        <a href="terms-of-use.php">Terms of Use</a>
                    </li>
                </ul>
            </div>
            <div class="footer__credit">
                <div class="row d-flex align-items-center">
                    <div class="col-lg-4">
                        <div class="footer__credit__right">
                            <div class="social text-center text-lg-end">
                                <a href="javascript:void(0)">
                                    <i class="fab fa-facebook-f"></i>
                                </a>
                                <a href="javascript:void(0)">
                                    <i class="fab fa-twitter"></i>
                                </a>
                                <a href="javascript:void(0)">
                                    <i class="fab fa-instagram"></i>
                                </a>
                                <a href="javascript:void(0)">
                                    <i class="fab fa-linkedin-in"></i>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="footer__animation">
            <img
                src="/assets/images/footer/footer-left-illustration.png"
                alt="Footer Illustration"
                class="left__illustration"
            />
            <img
                src="/assets/images/footer/footer-right-illustration.png"
                alt="Footer Illustration"
                class="right__illustration"
            />
        </div>
    </footer>
    <!-- ==== #footer section end ==== -->

    <!-- Scroll To Top -->
    <a href="javascript:void(0)" class="scrollToTop">
        <i class="fas fa-angle-double-up"></i>
    </a>
</template>
