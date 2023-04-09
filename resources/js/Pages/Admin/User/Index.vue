<template>
    <app-layout title="Users">
        <div class="flex flex-col justify-start mb-4">
            <jet-input
                v-model="params.name"
                type="text"
                class="w-1/4 text-sm rounded-md border-gray-300"
                placeholder="Name"
            />
        </div>

        <div class="overflow-x-auto mb-8">
            <table class="container whitespace-no-wrap">
                <thead>
                    <tr
                        class="text-xs font-semibold tracking-wide text-left text-gray-500 uppercase border-b dark:border-gray-700 bg-gray-50 dark:text-gray-400 dark:bg-gray-800"
                    >
                        <th class="px-4 py-3">ID</th>
                        <th class="px-4 py-3">Name</th>
                        <th class="px-4 py-3">Deposits</th>
                        <th class="px-4 py-3">Payouts</th>
                        <th class="px-4 py-3 text-center">Actions</th>
                    </tr>
                </thead>
                <tbody class="divide-y dark:divide-gray-700 dark:bg-gray-800">
                    <tr
                        v-for="user in users.data"
                        :key="user.id"
                        class="text-gray-700 dark:text-gray-400"
                    >
                        <td class="px-4 py-3">{{ user.id }}</td>
                        <td class="px-4 py-3">{{ user.name }}</td>
                        <td class="px-4 py-3">
                            {{ currency(user.deposits_sum_amount) }}
                        </td>
                        <td class="px-4 py-3">
                            {{ currency(user.withdraws_sum_amount) }}
                        </td>
                        <td class="px-4 py-3 space-x-4 text-center">
                            <Link
                                class="bg-primary px-2 rounded"
                                as="button"
                                :href="
                                    route('admin.users.deposits.index', user)
                                "
                            >
                                DEPOSITS
                            </Link>

                            <button
                                class="bg-success px-2 rounded mx-4 uppercase"
                                @click="changeRole(user)"
                            >
                                {{ user.role }}
                            </button>

                            <!-- <button
                                class="bg-danger px-2 rounded"
                                @click="banUser(user)"
                            >
                                BANEAR
                            </button> -->
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>

        <div class="flex text-gray-400 my-4 mx-4">
            <button
                class="bg-primary px-4 rounded"
                v-if="users.prev_page_url"
                @click.prevent="params.page -= 1"
            >
                Previous
            </button>

            <button
                class="bg-primary px-4 rounded"
                v-if="users.next_page_url"
                @click.prevent="params.page += 1"
            >
                Next
            </button>
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
        users: Object,
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
        changeRole(user) {
            Swal.fire({
                title: "Are you sure?",
                text: `Do you want toggle ${user.name} Role?`,
                icon: "warning",
                showCancelButton: true,
                confirmButtonColor: "#3085d6",
                cancelButtonColor: "#d33",
                confirmButtonText: "Confirm",
            }).then((result) => {
                if (result.isConfirmed) {
                    this.$inertia.post(route("admin.users.role.toggle", user));
                }
            });
        },

        changeBalance(user) {
            Swal.fire({
                title: "User Balance",
                input: "number",
                inputValue: user.balance,
                showCancelButton: true,
                inputValidator: (value) => {
                    return new Promise((resolve) => {
                        if (value == "") {
                            resolve("You need to select a reason");
                        } else {
                            resolve();
                        }
                    });
                },
            }).then((res) => {
                if (res.isConfirmed) {
                    this.$inertia.put(this.route("admin.users.update", user), {
                        balance: res.value,
                    });
                }
            });
        },

        banUser(user) {
            Swal.fire({
                title: `Banear Usuario (${user.name})`,
                showCancelButton: true,
            }).then((res) => {
                if (res.isConfirmed) {
                    this.$inertia.delete(
                        this.route("admin.users.destroy", user)
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
