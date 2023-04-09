<template>
    <app-layout :title="`Depositos ${user.name}`">
        <div class="flex justify-start mb-4">
            <button
                class="text-gray-400 px-4 rounded bg-success"
                @click="makeDeposit()"
            >
                Depositar
            </button>
        </div>

        <div class="overflow-x-auto mb-8">
            <table class="container whitespace-no-wrap">
                <thead>
                    <tr
                        class="text-xs font-semibold tracking-wide text-left text-gray-500 uppercase border-b dark:border-gray-700 bg-gray-50 dark:text-gray-400 dark:bg-gray-800"
                    >
                        <th class="px-4 py-3">ID</th>
                        <th class="px-4 py-3">Amount</th>
                        <th class="px-4 py-3">Actions</th>
                    </tr>
                </thead>
                <tbody class="divide-y dark:divide-gray-700 dark:bg-gray-800">
                    <tr
                        v-for="deposit in deposits.data"
                        :key="deposit.id"
                        class="text-gray-700 dark:text-gray-400"
                    >
                        <td class="px-4 py-3">{{ deposit.id }}</td>
                        <td class="px-4 py-3">
                            {{ currency(deposit.amount) }}
                        </td>
                        <td class="px-4 py-3 space-x-4">
                            <button
                                class="bg-danger px-2 rounded"
                                @click="deleteDeposit(deposit)"
                            >
                                Eliminar
                            </button>
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>

        <div class="flex text-gray-500">
            <span
                v-if="deposits.prev_page_url"
                @click.prevent="params.page -= 1"
                >Previous</span
            >
            <span
                v-if="deposits.next_page_url"
                @click.prevent="params.page += 1"
                >Next</span
            >
        </div>
    </app-layout>
</template>

<script>
import { defineComponent } from "vue";
import AppLayout from "@/Layouts/AppLayout.vue";
import { Link } from "@inertiajs/inertia-vue3";
import JetInput from "@/Jetstream/Input.vue";
import Swal from "sweetalert2";

export default defineComponent({
    components: {
        AppLayout,
        JetInput,
        Link,
    },

    props: {
        user: Object,
        deposits: Object,
    },

    data() {
        return {
            params: {
                name: "",
                page: 1,
            },
        };
    },

    methods: {
        makeDeposit() {
            Swal.fire({
                title: "Deposit Amount",
                input: "number",
                showCancelButton: true,
            }).then((res) => {
                if (res.isConfirmed) {
                    this.$inertia.post(
                        this.route("admin.users.deposits.store", this.user),
                        { amount: res.value }
                    );
                }
            });
        },

        deleteDeposit(deposit) {
            Swal.fire({
                title: `Eliminar Deposito?`,
                showCancelButton: true,
            }).then((res) => {
                if (res.isConfirmed) {
                    this.$inertia.delete(
                        this.route("admin.deposits.destroy", deposit)
                    );
                }
            });
        },
    },

    watch: {
        params: {
            handler() {
                this.$inertia.reload({ data: this.params, only: ["users"] });
            },
            deep: true,
        },
    },
});
</script>
