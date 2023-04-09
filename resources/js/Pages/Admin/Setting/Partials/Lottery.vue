<script setup>
import { ref, inject } from "vue";
import { useForm } from "@inertiajs/inertia-vue3";

const form = useForm({
    ticket_price: inject("config.ticket_price", "25"),
    hits_profit_4: inject("config.hits_profit_4", "25"),
    hits_profit_5: inject("config.hits_profit_5", "50"),
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
                        for="ticket_price"
                        class="content__space--extra--small"
                        >Ticket Price</label
                    >
                    <div class="show__hide__password">
                        <input
                            type="text"
                            id="ticket_price"
                            placeholder=""
                            v-model="form.ticket_price"
                            required="required"
                        />
                    </div>
                </div>

                <div class="input__area text-start content__space">
                    <label
                        for="hits_profit_4"
                        class="content__space--extra--small"
                        >Hits Profit 4</label
                    >
                    <div class="show__hide__password">
                        <input
                            type="text"
                            id="hits_profit_4"
                            placeholder=""
                            v-model="form.hits_profit_4"
                            required="required"
                        />
                    </div>
                </div>

                <div class="input__area text-start content__space">
                    <label
                        for="hits_profit_5"
                        class="content__space--extra--small"
                        >Hits Profit 5</label
                    >
                    <div class="show__hide__password">
                        <input
                            type="text"
                            id="hits_profit_5"
                            placeholder=""
                            v-model="form.hits_profit_5"
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
