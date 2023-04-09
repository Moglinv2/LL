<script setup>
import { ref, inject } from "vue";
import { useForm } from "@inertiajs/inertia-vue3";

const form = useForm({
    min_withdraw_amount: inject("config.min_withdraw_amount", "200"),
    withdraw_fee: inject("config.withdraw_fee", "2"),
});

const updateWithdrawSetting = () => {
    form.post(route("admin.settings.store"), {
        errorBag: "updateWithdrawSetting",
        preserveScroll: true,
    });
};
</script>

<template>
    <div class="settings__tab__content">
        <div class="settings__tab__content__inner">
            <form @submit.prevent="updateWithdrawSetting()">
                <div class="input__area text-start content__space">
                    <label
                        for="min_withdraw_amount"
                        class="content__space--extra--small"
                        >Min Amount</label
                    >
                    <div class="show__hide__password">
                        <input
                            type="text"
                            id="min_withdraw_amount"
                            placeholder=""
                            v-model="form.min_withdraw_amount"
                            required="required"
                        />
                    </div>
                </div>

                <div class="input__area text-start content__space">
                    <label
                        for="withdraw_fee"
                        class="content__space--extra--small"
                        >Withdraw Fee (%)</label
                    >
                    <div class="show__hide__password">
                        <input
                            type="text"
                            id="withdraw_fee"
                            placeholder=""
                            v-model="form.withdraw_fee"
                            required="required"
                        />
                    </div>
                </div>

                <div class="btn__group">
                    <button type="reset" class="button">Discard</button>
                    <button type="submit" class="button">Submit</button>
                </div>
            </form>
        </div>
    </div>
</template>
