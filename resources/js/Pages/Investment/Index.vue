<script setup>
import { provide } from "vue";
import AppLayout from "@/Layouts/AppLayout.vue";
import { useForm } from "@inertiajs/inertia-vue3";
import Invest from "./Invest.vue";
import History from "./History.vue";

const props = defineProps({
    is_rocket_active: Boolean,
    rocket_price: Number,
    investments: Object,
    settings: Object,
});

for (let setting of Object.keys(props.settings)) {
    provide(`config.${setting}`, props.settings[setting]);
}

const form = useForm({
    currency: "",
    amount: 0,
    address: "",
});
</script>

<template>
    <AppLayout title="Investments">
        <div class="dashboard__head">
            <h5>Investments</h5>
        </div>

        <Invest
            :rocket_price="rocket_price"
            :is_rocket_active="is_rocket_active"
        />

        <History :investments="investments" />
    </AppLayout>
</template>
