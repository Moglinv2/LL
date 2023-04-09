<script setup>
import { ref, inject } from "vue";
import { useForm } from "@inertiajs/inertia-vue3";

const form = useForm({
    plan_duration: inject("config.plan_duration", "200"),
    plan_profit: inject("config.plan_profit", "0.4"),
    boost_profit: inject("config.plan_profit", "1.7"),
});

const updatePLanSetting = () => {
    form.post(route("admin.settings.store"), {
        errorBag: "updatePlanSetting",
        preserveScroll: true,
    });
};
</script>

<template>
    <div class="settings__tab__content">
        <div class="settings__tab__content__inner">
            <form @submit.prevent="updatePLanSetting()">
                <div class="input__area text-start content__space">
                    <label
                        for="plan_duration"
                        class="content__space--extra--small"
                        >Plan Duration (Days)</label
                    >
                    <div class="show__hide__password">
                        <input
                            type="text"
                            id="plan_duration"
                            placeholder=""
                            v-model="form.plan_duration"
                            required="required"
                        />
                    </div>
                </div>

                <div class="input__area text-start content__space">
                    <label
                        for="plan_profit"
                        class="content__space--extra--small"
                        >Plan Profit (% Daily)</label
                    >
                    <div class="show__hide__password">
                        <input
                            type="text"
                            id="plan_profit"
                            placeholder=""
                            v-model="form.plan_profit"
                            required="required"
                        />
                    </div>
                </div>

                <div class="input__area text-start content__space">
                    <label
                        for="plan_profit"
                        class="content__space--extra--small"
                        >Boost Profit (%)</label
                    >
                    <div class="show__hide__password">
                        <input
                            type="text"
                            id="plan_profit"
                            v-model="form.boost_profit"
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
