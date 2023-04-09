<script setup>
import AppLayout from "@/Layouts/AppLayout.vue";
import { Link } from "@inertiajs/inertia-vue3";

defineProps({
    total_crypto_deposits: Number,
    total_manual_deposits: Number,
    total_paid: Number,
    total_funds: Number,
});
</script>

<template>
    <AppLayout title="Finances">
        <div class="available__balance">
            <div class="row">
                <div class="col-md-6 col-lg-4">
                    <div class="available__balance__single column__space">
                        <div class="balance__left">
                            <p class="tertiary">Total Crypto Deposits</p>
                            <h5>{{ currency(total_crypto_deposits || 0) }}</h5>
                        </div>
                    </div>
                </div>
                <div class="col-md-6 col-lg-4">
                    <div class="available__balance__single column__space">
                        <div class="balance__left">
                            <p class="tertiary">Totals Manual Deposits</p>
                            <h5>{{ currency(total_manual_deposits || 0) }}</h5>
                        </div>
                    </div>
                </div>
            </div>

            <div class="row my-4">
                <div class="col-md-6 col-lg-4">
                    <div class="available__balance__single column__space">
                        <div class="balance__left">
                            <p class="tertiary">Totals Paid</p>
                            <h5>{{ currency(total_paid || 0) }}</h5>
                        </div>
                    </div>
                </div>
                <div class="col-md-6 col-lg-4">
                    <div class="available__balance__single column__space">
                        <div class="balance__left">
                            <p class="tertiary">Total Funds</p>
                            <h5>{{ currency(total_funds || 0) }}</h5>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </AppLayout>
</template>
