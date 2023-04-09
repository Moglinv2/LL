<script setup>
import AppLayout from "@/Layouts/AppLayout.vue";
import Welcome from "@/Jetstream/Welcome.vue";
import { Link } from "@inertiajs/inertia-vue3";
import WeeklyLottery from "../Partials/WeeklyLottery.vue";

defineProps({
    last_deposit: Object,
    last_withdraw: Object,
    stats: Object,
    reward_points: Number,
    referers_count: Array,
});
</script>

<template>
    <AppLayout title="Dashboard">
        <div class="balance">
            <div class="row">
                <div class="col-lg-6">
                    <div class="balance__single column__space">
                        <div class="balance__img">
                            <img
                                src="assets/images/dashboard/total-balance.png"
                                alt="Total balance"
                            />
                        </div>
                        <div class="balance__content">
                            <p>Total Balance</p>
                            <h5>{{ currency($page.props.user.balance) }}</h5>
                            <div class="last__action">
                                <p class="tertiary">Last Deposit:</p>
                                <p class="tertiary">
                                    {{ currency(last_deposit?.amount || 0) }}
                                </p>
                            </div>
                            <Link :href="route('deposits.index')" class="button"
                                >Make New Deposit</Link
                            >
                        </div>
                    </div>
                </div>
                <div class="col-lg-6">
                    <div class="balance__single balance__alt__content">
                        <div class="balance__img">
                            <img
                                src="assets/images/dashboard/total-earned.png"
                                alt="Total balance"
                            />
                        </div>
                        <div class="balance__content">
                            <p>Total Earned</p>
                            <h5>{{ currency($page.props.user.profit) }}</h5>
                            <div class="last__action">
                                <p class="tertiary">Last Withdrawal:</p>
                                <p class="tertiary">
                                    {{ currency(last_withdraw?.amount || 0) }}
                                </p>
                            </div>
                            <a :href="route('withdraws.index')" class="button"
                                >Withdraw Funds</a
                            >
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="available__balance">
            <div class="row">
                <div class="col-md-6 col-lg-4">
                    <div class="available__balance__single column__space">
                        <center>
                            <img
                                src="/assets/images/trx.png"
                                width="75"
                                height="75"
                                alt="Tron"
                            />
                        </center>
                        <div class="balance__left">
                            <p class="tertiary">Total Staked</p>
                            <h5>{{ currency(stats["staked"]) }}</h5>
                        </div>
                    </div>
                </div>
                <div class="col-md-6 col-lg-4">
                    <div class="available__balance__single column__space">
                        <center>
                            <img
                                src="/assets/images/ecolot.png"
                                width="150"
                                height="75"
                                alt="Tron"
                            />
                        </center>
                        <div class="balance__left">
                            <p class="tertiary">Available Balance</p>
                            <h5>{{ currency(stats["lottery"]) }}</h5>
                        </div>
                    </div>
                </div>
                <div class="col-md-6 col-lg-4">
                    <div class="available__balance__single column__space">
                        <center>
                            <img
                                src="/assets/images/arbol.png"
                                width="150"
                                height="75"
                                alt="Tron"
                            />
                        </center>
                        <div class="balance__left">
                            <p class="tertiary">Available Balance</p>
                            <h5>{{ currency(stats["arbol"]) }}</h5>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <WeeklyLottery />

        <div class="affiliate__links">
            <div class="row">
                <div class="col-lg-8">
                    <div class="affiliate__link column__space">
                        <h5>Your Affiliate Link</h5>
                        <div class="copy">
                            <p>
                                {{
                                    route("register", {
                                        referer: $page.props.user.referer_code,
                                    })
                                }}
                            </p>
                            <a
                                @click="
                                    copy(
                                        route('register', {
                                            referer:
                                                $page.props.user.referer_code,
                                        })
                                    )
                                "
                                class="button"
                                >Copy link</a
                            >
                        </div>
                    </div>
                </div>
                <div class="col-lg-4">
                    <div class="rank">
                        <h6>Rewards Points</h6>
                        <h5>{{ reward_points }}</h5>
                        <img
                            src="assets/images/dashboard/hands.png"
                            alt="Ranks"
                        />
                    </div>
                </div>
            </div>
        </div>

        <div class="level">
            <div class="row">
                <div
                    v-for="(referer_count, index) in referers_count"
                    :key="index"
                    class="col-md-6 col-lg-4"
                >
                    <div class="level__single column__space">
                        <a href="#" class="button">{{ index + 1 }} Level</a>
                        <p>
                            {{ referer_count["total"] }} /
                            {{ referer_count["active"] }}
                        </p>
                        <p class="tertiary">Partners / Active</p>
                    </div>
                </div>
            </div>
        </div>
    </AppLayout>
</template>
