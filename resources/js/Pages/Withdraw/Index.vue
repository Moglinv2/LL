<script setup>
import AppLayout from '@/Layouts/AppLayout.vue';
import { useForm } from '@inertiajs/inertia-vue3';

const form = useForm({
    amount: 0,
})

const storeWithdraw = () => {
    form.post(route('withdraws.store'))
}
</script>

<template>
    <AppLayout title="Withdraws">
    <div class="open__deposit">
        <h5>BALANCE WITHDRAW</h5>
    </div>
    <form @submit="storeWithdraw()" id="withdrawalForm" class="actionForm">
        <fieldset class="group">
            <p class="legen legen__active">Withdrawal of funds</p>
            <div class="payment__system__checkbox__wrapper">
                <div class="withdraw__amount">
                    <label class="secondary content__space--extra--small">Enter The
                        amount</label>
                    <input type="number" v-model="form.amount" required="required"
                        placeholder="296" min="1" />
                    <p class="tertiary">*Minimum withdraw is 50 USDT</p>
                </div>
            </div>
        </fieldset>
        <fieldset class="group">
            <p class="legen" :class="{ 'legen__active': (form.amount > 0)}">Wallet address</p>
            <div class="payment__system__checkbox__wrapper" v-if="form.amount > 0">
                <div class="withdraw__amount">
                    <label class="secondary content__space--extra--small">Confirm your wallet
                        address</label>
                    <input type="text" name="wall__add" id="wallAdd" class="mb-0"
                        required="required" :value="$page.props.user.withdraw_address" placeholder="Enter Wallet Address" disabled/>
                </div>
            </div>
        </fieldset>
        <fieldset class="group">
            <p class="legen legen__active">Operation Confirmation</p>
            <div class="plan__cta text-start" style="margin-top:24px">
                <button class="button primary" type="submit">Withdraw Funds</button>
            </div>            
        </fieldset>
    </form>
    </AppLayout>
</template>
