<script setup>
import AppLayout from "@/Layouts/AppLayout.vue";
import Overview from "./Partials/Overview.vue";
import LotteryNumbers from "./Partials/LotteryNumbers.vue";
import { ref } from "@vue/reactivity";

defineProps({
    last_numbers: Array,
    active_tickets: Array,
    ticket_price: Number,
});

let selectedTab = ref("lotteryNumbers");
</script>

<template>
    <AppLayout title="Lottery">
        <div class="dashboard__head">
            <h5>Lottery</h5>
        </div>

        <div class="dashboard__lottery__tab__btn__wrapper">
            <a
                class="button dashboard__lottery__tab__btn"
                :class="{
                    dashboard__lottery__tab__btn__active:
                        selectedTab == 'overview',
                }"
                @click="selectedTab = 'overview'"
                >Overview</a
            >
            <a
                class="button dashboard__lottery__tab__btn"
                :class="{
                    dashboard__lottery__tab__btn__active:
                        selectedTab == 'lotteryNumbers',
                }"
                @click="selectedTab = 'lotteryNumbers'"
                >Pick Numbers</a
            >
        </div>

        <div
            class="dashboard__lottery__tab__content"
            id="overview"
            v-if="selectedTab == 'overview'"
        >
            <Overview
                :last_numbers="last_numbers"
                :active_tickets="active_tickets"
            />
        </div>

        <div
            class="dashboard__lottery__tab__content"
            id="lotteryNumbers"
            v-if="selectedTab == 'lotteryNumbers'"
        >
            <LotteryNumbers :ticket_price="ticket_price" />
        </div>
    </AppLayout>
</template>
