<script setup>
import AppLayout from '@/Layouts/AppLayout.vue';
import { useForm, usePage } from '@inertiajs/inertia-vue3';
const form = useForm({
    withdraw_address: usePage().props.value.user.withdraw_address
});

const storeWallet = () => {
    form.post(route('wallet.store'));
}
</script>

<template>
    <AppLayout title="Wallet">
        <div class="open__deposit">
            <h5>Wallet</h5>
        </div>
        <form @submit.prevent="storeWallet()" id="walletForm" class="actionForm">
            <fieldset class="group">
                <p class="legen legen__active">Your Wallet address</p>
                <div class="payment__system__checkbox__wrapper">
                    <div class="withdraw__amount">
                        <label class="secondary content__space--extra--small">Wallet
                            address</label>
                        <input type="text" v-model="form.withdraw_address" class="mb-0"
                            required="required" placeholder="Enter Your Address" />
                    </div>
                </div>
            </fieldset>
            <fieldset class="group">
                <p class="legen">
                    <button type="submit" class="button">Save Wallet Address</button>
                </p>
                <div class="payment__system__plan"></div>
            </fieldset>
        </form>
    </AppLayout>
</template>
