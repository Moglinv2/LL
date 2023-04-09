<script setup>
import { ref, inject } from "vue";
import { useForm } from "@inertiajs/inertia-vue3";

const form = useForm({
    referer_profit_1: inject("config.referer_profit_1", "10"),
    referer_profit_2: inject("config.referer_profit_2", "8"),
    referer_profit_3: inject("config.referer_profit_3", "6"),
});

const updateRefererSetting = () => {
    form.post(route("admin.settings.store"), {
        errorBag: "updateRefererSetting",
        preserveScroll: true,
    });
};
</script>

<template>
    <div class="settings__tab__content">
        <div class="settings__tab__content__inner">
            <form @submit.prevent="updateRefererSetting()">
                <div class="input__area text-start content__space">
                    <label
                        for="plan_duration"
                        class="content__space--extra--small"
                        >Referer Profit Level 1</label
                    >
                    <div class="show__hide__password">
                        <input
                            type="text"
                            id="plan_duration"
                            placeholder=""
                            v-model="form.referer_profit_1"
                            required="required"
                        />
                    </div>
                </div>

                <div class="input__area text-start content__space">
                    <label
                        for="plan_duration"
                        class="content__space--extra--small"
                        >Referer Profit Level 2</label
                    >
                    <div class="show__hide__password">
                        <input
                            type="text"
                            id="plan_duration"
                            placeholder=""
                            v-model="form.referer_profit_2"
                            required="required"
                        />
                    </div>
                </div>

                <div class="input__area text-start content__space">
                    <label
                        for="plan_duration"
                        class="content__space--extra--small"
                        >Referer Profit Level 3</label
                    >
                    <div class="show__hide__password">
                        <input
                            type="text"
                            id="plan_duration"
                            placeholder=""
                            v-model="form.referer_profit_3"
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
