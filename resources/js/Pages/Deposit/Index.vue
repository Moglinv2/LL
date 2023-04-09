<script setup>
import AppLayout from "@/Layouts/AppLayout.vue";
import Welcome from "@/Jetstream/Welcome.vue";
import { ref } from "@vue/reactivity";
import QrcodeVue from "qrcode.vue";
import { Inertia } from "@inertiajs/inertia";

const props = defineProps({
    deposit_wallet: Object,
});

const currency = ref("");

const createDeposit = (ccy) => {
    currency.value = ccy;
    Inertia.post(
        route("deposits.store"),
        { currency: ccy },
        { preserveState: true, preserveScroll: true }
    );
};
</script>

<template>
    <AppLayout title="Dashboard">
        <div class="open__deposit">
            <h5>Open Deposit</h5>
        </div>
        <form class="actionForm">
            <fieldset class="group">
                <p class="legen legen__active">Select Payment System</p>
                <div
                    class="payment__system__checkbox__wrapper payment__system__method"
                >
                    <div class="row">
                        <div
                            @click="createDeposit('btc')"
                            class="col-md-6 col-lg-6"
                        >
                            <div
                                class="payment__system__checkbox__single"
                                :class="{
                                    payment__system__checkbox__single__active:
                                        currency == 'btc',
                                }"
                            >
                                <div class="pay__system">
                                    <div class="payment__checkbox__inner">
                                        <div class="payment__system__icon">
                                            <img
                                                src="https://cdn.jsdelivr.net/gh/atomiclabs/cryptocurrency-icons@bea1a9722a8c63169dcc06e86182bf2c55a76bbc/svg/color/btc.svg"
                                                alt="Currency"
                                            />
                                        </div>
                                        <div
                                            class="payment__system__icon__info"
                                        >
                                            <h6>Bitcoin</h6>
                                            <p class="tertiary">BTC</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div
                            @click="createDeposit('usdt')"
                            class="col-md-6 col-lg-6"
                        >
                            <div
                                class="payment__system__checkbox__single"
                                :class="{
                                    payment__system__checkbox__single__active:
                                        currency == 'usdt',
                                }"
                            >
                                <div class="pay__system">
                                    <div class="payment__checkbox__inner">
                                        <div class="payment__system__icon">
                                            <img
                                                src="https://cdn.jsdelivr.net/gh/atomiclabs/cryptocurrency-icons@bea1a9722a8c63169dcc06e86182bf2c55a76bbc/svg/color/usdt.svg"
                                                alt="Currency"
                                            />
                                        </div>
                                        <div
                                            class="payment__system__icon__info"
                                        >
                                            <h6>USDT</h6>
                                            <p class="tertiary">USDT</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </fieldset>

            <fieldset class="group">
                <!-- <p class="legen" :class="{ 'legen__active': (form.plan !== '') }">Enter amount</p> -->
                <div
                    class="payment__system__checkbox__wrapper"
                    v-if="deposit_wallet"
                >
                    <div class="text-center">
                        <QrcodeVue
                            class="mx-auto border-8 border-gray-800"
                            :value="deposit_wallet.address"
                            :size="250"
                        />
                        <br />
                        <h5
                            style="
                                text-transform: uppercase;
                                text-align: center;
                                margin-top: 12px;
                            "
                        >
                            {{ deposit_wallet.currency }}
                        </h5>
                        <span>{{ deposit_wallet.address }}</span>
                    </div>
                </div>
            </fieldset>
        </form>
    </AppLayout>
</template>
