<template>
    <app-layout title="Payments">
        <div class="overflow-x-auto mb-8">
            <table class="container whitespace-no-wrap">
                <thead>
                    <tr
                        class="text-xs font-semibold tracking-wide text-left text-gray-500 uppercase border-b dark:border-gray-700 bg-gray-50 dark:text-gray-400 dark:bg-gray-800"
                    >
                        <th class="px-4 py-3">ID</th>
                        <th class="px-4 py-3">USER</th>
                        <th class="px-4 py-3">ADDRESS</th>
                        <th class="px-4 py-3">AMOUNT</th>
                        <th class="px-4 py-3">STATUS</th>
                        <th class="px-4 py-3">ACTION</th>
                    </tr>
                </thead>
                <tbody class="divide-y dark:divide-gray-700 dark:bg-gray-800">
                    <tr
                        v-for="payment in payments.data"
                        :key="payment.id"
                        class="text-gray-700 dark:text-gray-400"
                    >
                        <td class="px-4 py-3">{{ payment.id }}</td>
                        <td class="px-4 py-3">{{ payment.user.name }}</td>
                        <td class="px-4 py-3">
                            {{ payment.user.withdraw_address }}
                        </td>
                        <td class="px-4 py-3">
                            {{ currency(payment.amount) }}
                        </td>
                        <td class="px-4 py-3">{{ payment.status }}</td>
                        <td class="px-4 py-3">
                            <span
                                v-if="payment.status == 'pending'"
                                @click="acceptPayment(payment)"
                                class="cursor-pointer"
                            >
                                <svg
                                    xmlns="http://www.w3.org/2000/svg"
                                    style="height: 30px"
                                    fill="none"
                                    viewBox="0 0 24 24"
                                    stroke="currentColor"
                                    stroke-width="2"
                                >
                                    <path
                                        stroke-linecap="round"
                                        stroke-linejoin="round"
                                        d="M17 9V7a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2m2 4h10a2 2 0 002-2v-6a2 2 0 00-2-2H9a2 2 0 00-2 2v6a2 2 0 002 2zm7-5a2 2 0 11-4 0 2 2 0 014 0z"
                                    />
                                </svg>
                            </span>

                            <span
                                v-if="payment.status == 'pending'"
                                @click="denyPayment(payment)"
                                class="cursor-pointer"
                            >
                                <svg
                                    xmlns="http://www.w3.org/2000/svg"
                                    style="height: 30px"
                                    fill="none"
                                    viewBox="0 0 24 24"
                                    stroke="currentColor"
                                    stroke-width="2"
                                >
                                    <path
                                        stroke-linecap="round"
                                        stroke-linejoin="round"
                                        d="M9.172 16.172a4 4 0 015.656 0M9 10h.01M15 10h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"
                                    />
                                </svg>
                            </span>
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>

        <div class="flex text-gray-400">
            <span
                v-if="payments.prev_page_url"
                @click.prevent="params.page -= 1"
                >Previous</span
            >
            <span
                v-if="payments.next_page_url"
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
import Swal from "sweetalert2";

export default defineComponent({
    components: {
        AppLayout,
        Link,
    },

    props: {
        payments: Object,
    },

    data() {
        return {
            params: {
                page: 1,
            },
        };
    },

    methods: {
        acceptPayment(payment) {
            Swal.fire({
                title: "Are you sure?",
                showCancelButton: true,
                confirmButtonColor: "#1e3a8a",
                cancelButtonColor: "#d33",
                confirmButtonText: "Yes, pay it!",
            }).then((result) => {
                if (result.isConfirmed) {
                    this.$inertia.put(
                        this.route("admin.payments.update", payment),
                        { status: "paid" }
                    );
                }
            });
        },

        makePaymentAutomatic(payment) {
            Swal.fire({
                title: `Make Payment Automatic`,
                html:
                    `User: <b>${payment.user.name}</b><br>` +
                    `Amount: <b>${payment.total}</b><br>` +
                    `To: <b>${payment.user.withdraw_address}</b><br>`,
                showCancelButton: true,
                confirmButtonText: "Pay",
                allowOutsideClick: () => !Swal.isLoading(),
            }).then((result) => {
                if (result.isConfirmed) {
                    Swal.fire({
                        title: `Please Enter Your Password`,
                        input: "password",
                        inputLabel: "Password",
                        inputAttributes: {
                            autocapitalize: "off",
                        },
                        showCancelButton: true,
                        confirmButtonText: "Pay",
                        allowOutsideClick: () => !Swal.isLoading(),
                    }).then((result) => {
                        if (result.isConfirmed) {
                            const password = result.value;
                            this.$inertia.post(
                                this.route("admin.payments.automate", payment),
                                { password }
                            );
                        }
                    });
                }
            });
        },

        denyPayment(payment) {
            Swal.fire({
                title: "Select Deny Reason",
                input: "select",
                inputOptions: {
                    invalid_address: "Invalid Address",
                    invalid_user: "Invalid User",
                    other: "Other",
                },
                inputPlaceholder: "Deny Reason",
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
                    const denyReason = res.value;
                    this.$inertia.put(
                        this.route("admin.payments.update", payment),
                        { status: "deny", reason: denyReason }
                    );
                }
            });
        },
    },

    watch: {
        params: {
            handler() {
                this.$inertia.reload({ data: this.params, only: ["payments"] });
            },
            deep: true,
        },
    },
});
</script>
