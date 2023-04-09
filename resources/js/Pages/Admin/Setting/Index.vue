<script setup>
import { provide } from "vue";
import AppLayout from "@/Layouts/AppLayout.vue";
import { ref } from "@vue/reactivity";
import Plan from "./Partials/Plan.vue";
import Referers from "./Partials/Referers.vue";
import Withdraw from "./Partials/Withdraw.vue";
import Lottery from "./Partials/Lottery.vue";

let selectedTab = ref("plan");

const props = defineProps({
    settings: Object,
});

for (let setting of Object.keys(props.settings)) {
    provide(`config.${setting}`, props.settings[setting]);
}
</script>

<template>
    <AppLayout title="Settings">
        <div class="dashboard__head">
            <h5>Settings</h5>
        </div>
        <div class="settings__tab__wrapper">
            <div class="settings__tab__btn__wrapper">
                <a
                    class="settings__tab__btn"
                    :class="{
                        settings__tab__btn__active: selectedTab == 'plan',
                    }"
                    @click="selectedTab = 'plan'"
                    >Plan</a
                >

                <a
                    class="settings__tab__btn"
                    :class="{
                        settings__tab__btn__active: selectedTab == 'referers',
                    }"
                    @click="selectedTab = 'referers'"
                    >Referers</a
                >

                <a
                    class="settings__tab__btn"
                    :class="{
                        settings__tab__btn__active: selectedTab == 'withdraw',
                    }"
                    @click="selectedTab = 'withdraw'"
                    >Withdraws</a
                >

                <a
                    class="settings__tab__btn"
                    :class="{
                        settings__tab__btn__active: selectedTab == 'lottery',
                    }"
                    @click="selectedTab = 'lottery'"
                    >Lottery</a
                >
            </div>

            <div class="settings__tab__content__wrapper">
                <Plan v-if="selectedTab == 'plan'" />

                <Referers v-if="selectedTab == 'referers'" />

                <Withdraw v-if="selectedTab == 'withdraw'" />

                <Lottery v-if="selectedTab == 'lottery'" />
            </div>
        </div>
    </AppLayout>
</template>
