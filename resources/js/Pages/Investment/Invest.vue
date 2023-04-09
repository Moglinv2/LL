<script setup>
import { inject } from "vue";
import { useForm } from "@inertiajs/inertia-vue3";

const props = defineProps({
    is_rocket_active: Boolean,
    rocket_price: Number,
});

const form = useForm({
    plan: "",
    amount: 250,
});

const selectPlan = (plan) => {
    if (plan == "rocket" && props.is_rocket_active) {
        return;
    }

    form.plan = plan;
};

const createInvested = () => {
    form.post(route("investments.store"));
};
</script>

<template>
    <div class="open__deposit" style="margin-top: 20px">
        <h5>Open Investment</h5>
    </div>

    <form @submit.prevent="createInvested()" class="actionForm">
        <fieldset class="group">
            <p class="legen legen__active">Select Investment Plan</p>
            <div class="payment__system__checkbox__wrapper">
                <div class="row">
                    <div class="col-lg-6">
                        <div
                            class="checkbox__investment__plan"
                            :class="{
                                checkbox__investment__plan__active:
                                    form.plan == 'eco',
                            }"
                            @click="selectPlan('eco')"
                        >
                            <div class="investment__item">
                                <div class="investment__item__inner">
                                    <img
                                        style="width: 100px; height: 100px"
                                        src="/assets/images/eco.png"
                                        alt="EcoBoost"
                                    />
                                    <div
                                        class="investment__item__content text-center"
                                    >
                                        <p class="secondary text-center">
                                            EcoBoost
                                        </p>
                                        <hr />
                                        <h4
                                            class="text-center content__space--small"
                                        >
                                            {{
                                                inject(
                                                    "config.plan_profit",
                                                    0.7
                                                )
                                            }}%
                                        </h4>
                                        <p class="text-center">
                                            Daily for
                                            {{
                                                inject(
                                                    "config.plan_duration",
                                                    200
                                                )
                                            }}
                                            days
                                        </p>
                                        <hr />
                                        <div class="invest__limit">
                                            <div
                                                class="d-flex align-items-center justify-content-between"
                                            >
                                                <p>Min. Invest</p>
                                                <p>$50</p>
                                            </div>
                                        </div>
                                        <div class="invest__limit mb-35">
                                            <div
                                                class="d-flex align-items-center justify-content-between"
                                            >
                                                <p>Max. Invest</p>
                                                <p>$10000</p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col-lg-6">
                        <div
                            class="checkbox__investment__plan"
                            :class="{
                                checkbox__investment__plan__active:
                                    form.plan == 'rocket',
                            }"
                            @click="selectPlan('rocket')"
                        >
                            <div class="investment__item">
                                <div class="investment__item__inner">
                                    <img
                                        style="width: 100px; height: 100px"
                                        src="/assets/images/startup.png"
                                        alt="Spo-11"
                                    />
                                    <div
                                        class="investment__item__content text-center"
                                    >
                                        <p class="secondary text-center">
                                            EcoRocket
                                        </p>
                                        <hr />
                                        <h4
                                            class="text-center content__space--small"
                                        >
                                            {{
                                                inject(
                                                    "config.boost_profit",
                                                    1.7
                                                )
                                            }}%
                                        </h4>
                                        <p class="text-center">
                                            30 days of Nitro
                                        </p>
                                        <hr />
                                        <div
                                            class="invest__limit content__space--small"
                                        >
                                            <div
                                                class="d-flex align-items-center justify-content-between"
                                            ></div>
                                        </div>
                                        <div class="invest__limit cta__space">
                                            <div
                                                class="d-flex align-items-center justify-content-between"
                                            >
                                                <p>
                                                    Get this paying 5% of active
                                                    investment monthly
                                                </p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </fieldset>
        <fieldset class="group">
            <p class="legen" :class="{ legen__active: form.plan !== '' }">
                Enter amount
            </p>
            <div
                class="payment__system__checkbox__wrapper"
                v-if="form.plan !== ''"
            >
                <div class="plan__select" v-if="form.plan == 'eco'">
                    <label class="secondary content__space--extra--small"
                        >Enter The amount</label
                    >
                    <input
                        type="number"
                        v-model="form.amount"
                        required="required"
                        placeholder="296"
                        min="1"
                    />
                </div>
                <div class="row mb-25">
                    <div class="col-lg-7">
                        <div class="daily-profit column__space">
                            <p class="secondary mb-20">Investment amount</p>
                            <h3>
                                <span
                                    v-if="form.plan == 'eco'"
                                    class="range__output__value"
                                    >{{ currency(form.amount) }}</span
                                >

                                <span
                                    v-if="form.plan == 'rocket'"
                                    class="range__output__value"
                                    >{{ currency(rocket_price) }}</span
                                >
                            </h3>
                        </div>
                    </div>
                </div>
                <div class="plan__cta text-start">
                    <button class="button primary" type="submit">
                        Start Invest Now
                    </button>
                </div>
            </div>
        </fieldset>
    </form>
</template>
